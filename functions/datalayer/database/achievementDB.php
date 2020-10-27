<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/database.php");

    class AchievementDB {

        // Creating variable for database connection
        private $db; 
    
        /* Creating a new instance of AchievementDB */
        public function __construct() {
            // Making a connection with the database
            $database = new Database();
            $this->db = $database->getConnection();
        }

        /**
         * Funtion to create a new account for the user
         * 
         * @return achievementsList an array with all achievements the user can get
         */
        public function getAchievements() {
            // Creating a array to fill it later
            $achievementsList = array();

            // Query to get the achievements
            $query = "SELECT * FROM achievements";
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                // Getting all the encrypted emails
                $result = $stm->fetchAll(PDO::FETCH_OBJ);

                // Looping through the emails
                foreach ($result as $achievement) {
                    // Filling the Achievement model
                    $achievement = new Achievement($achievement->achievementID, $achievement->name, $achievement->description, $achievement->rewaredAt, $achievement->picture, $achievement->points, $achievement->visibility);
                    array_push($achievementsList, $achievement);
                }
            }

            // Returning the full list
            return $achievementsList;
        }

        /**
         * Function to get a specific achievement
         * 
         * @param userModel the user of wich to get the achievement
         * @param achievementsList array of achievement wich needs to be gotton
         * @param userAchievementModel the model that gets filled with the function
         * @param offset the offset of the achievements
         * 
         * @param userAchievementModel the userAchievementModel of the achievement
         */
        public function getAchievementsUserByIds($userModel, $achievementsList, $userAchievementModel, $offset) {
            if ($offset < count($achievementsList)) {
                // Creating variables for the query
                $userID = $userModel->getID();
                $achievemenID = $achievementsList[$offset];

                // Query to get a achievement from the user_achievement
                $query = "SELECT * FROM user_achievement ua
                          INNER JOIN achievement ac ON ua.achievementID = ac.ID
                          WHERE ua.userID = ? AND ua.achievementID = ?";
                $stm = $this->db->prepare($query);
                $stm->bindParam(1, $userID);
                $stm->bindParam(2, $achievemenID);
                if ($stm->execute()) {
                    // Getting the user
                    $result = $stm->fetch(PDO::FETCH_OBJ);
                    
                    // Filling the achievement
                    $achievementModel = new Achievement($result->achievementID, $result->name, $result->description, $result->rewaredAt, $result->picture, $result->points, $result->visibility);

                    // Filling the userAchievement model
                    $ua = new UserAchievement($userModel, $achievementModel, $result->achievementProgress, $result->receivedAt, $result->seen);
                    array_push($userAchievementModel, $ua);
                }

                // Updating the variables for the funtion
                $offset++;
                return $this->getAchievementsUserByIds($userModel, $achievementsList, $userAchievementModel, $offset);
            } else {
                // Returning the filled array
                return $userAchievementModel;
            }
        }

        /**
         * Funtion to create a new account for the user
         * 
         * @return achievementsList an array with all achievements the user can get
         */
        public function getAchievementsUser($userModel) {
            // Creating a array to fill it later
            $achievementsList = array();

            // Creating variables for in the query
            $userID = $userModel->getID();

            // Query to get the achievements of user
            // These achievents are then order by wether they are achieved and then their ID
            $query = "SELECT ac.ID AS 'achievementID', ac.name, ac.description, ac.picture, ac.rewaredAt, ac.visibility, ua.achievementProgress, ua.receivedAt, ua.seen, us.ID AS 'userID'
                      FROM user_achievement ua
                      INNER JOIN achievement ac ON ac.ID = ua.achievementID
                      INNER JOIN user us ON ua.userID = us.ID
                      WHERE us.ID = ?
                      ORDER BY ua.seen DESC, ac.ID ASC";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            if ($stm->execute()) {
                // Getting all the encrypted emails
                $result = $stm->fetchAll(PDO::FETCH_OBJ);

                // Looping through the emails
                foreach ($result as $ua) {
                    // Filling the Achievement model
                    $achievement = new Achievement($ua->achievementID, $ua->name, $ua->description, $ua->rewaredAt, $ua->picture, null, $ua->visibility);

                    // Filling the UserAchievement model
                    $userAchievement = new UserAchievement($userModel, $achievement, $ua->achievementProgress, $ua->receivedAt, $ua->seen);
                    array_push($achievementsList, $userAchievement);
                }
            }

            // Returning the full list
            return $achievementsList;
        }

        /**
         * Function to update the seen status of the achievement
         * 
         * @param userAchievementModal the modal of the user_achievement
         */
        public function updateAchievementSeen($userAchievementModel) {
            // Making variables for in the query
            $userID = $userAchievementModel->getUser()->getID();
            $achievementID = $userAchievementModel->getAchievement()->getID();
            $uaSeen = $userAchievementModel->getSeen();
            
            // Making a query to update the seen status of an achievement linked to a user
            $query = "UPDATE user_achievement SET seen = ? WHERE userID = ? AND achievementID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $uaSeen);
            $stm->bindParam(2, $userID);
            $stm->bindParam(3, $achievementID);
            $stm->execute();    
        }

        /**
         * Function to update the progress to an achievement
         * 
         * @param userAchievementModel a model of the user achievements that need to be updated
         * 
         * @return true if all achievement progress is updatet
         */
        public function updateAchievementProgress($userAchievementModel) {
            foreach ($userAchievementModel as $achievement) {
                // Making variables for the query
                $userID = $achievement->getUser()->getID();
                $achievementID = $achievement->getAchievement()->getID();
                $progress = $achievement->getAchievementProgress();

                // Query to update the achievement progress
                $query = "UPDATE user_achievement SET achievementProgress = ? WHERE userID = ? AND achievementID = ?";
                $stm = $this->db->prepare($query);
                $stm->bindParam(1, $progress);
                $stm->bindParam(2, $userID);
                $stm->bindParam(3, $achievementID);
                $stm->execute();

                // Checking if achievement is earned
                if ($progress >= $achievement->getAchievement()->getRewaredAt() && empty($achievement->getReceivedAt()) && empty($achievement->getSeen())) {
                    // Rewarding the user the achievement
                    $this->giveUserAchievement($achievement);
                }
            }
        }

        /**
         * Function to reward user with achievement
         * 
         * @param userAchievementModel the user_achievement model of the achievement
         */
        public function giveUserAchievement($userAchievementModel) {
            // Creating variables for the function
            $userID = $userAchievementModel->getUser()->getID();
            $achievementID = $userAchievementModel->getAchievement()->getID();
            $date = date("Y-m-d");

            // Calculating the new user points
            $newUserPoints = $userAchievementModel->getUser()->getPoints() + $userAchievementModel->getAchievement()->getPoints();

            var_dump($newUserPoints);

            // Query to update achievement so it is unlocked, after that update the user points
            $query = "UPDATE user_achievement SET receivedAt = ?, seen = 0 WHERE userID = ? AND achievementID = ?;
                      UPDATE user SET points = ? WHERE ID = ?;";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $date);
            $stm->bindParam(2, $userID);
            $stm->bindParam(3, $achievementID);
            $stm->bindParam(4, $newUserPoints);
            $stm->bindParam(5, $userID);
            $stm->execute();
        }
    }
?>
