<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/database.php");

    class UserDB {
        // Creating variable for database connection
        private $db; 
    
        /* Creating a new instance of UserDB */
        public function __construct() {
            // Making a connection with the database
            $database = new Database();
            $this->db = $database->getConnection();
        }

        /**
         * Function to check if the email is already used
         * 
         * @return 1 - email is unique
         * @return 2 - email is already used
         * @return 3 - An error occured
         */
        public function checkUserEmailUsed($email) {    
            // Creating a query to check if the email already exist
            $queryUniqueEmail = "SELECT email FROM user";
            $stm = $this->db->prepare($queryUniqueEmail);
            $stm->bindParam(1, $email);
            if ($stm->execute()) {
                // Getting all the emails
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the emails
                foreach ($result as $user) {
                    // Checking if the email is the same as the entered email
                    if ($user->email == $email) {
                        // Returning 2 because email was found
                        return 2;
                    }
                }
                // Returning 1 because nothing was found
                return 1;
            } else {
                return 3;
            }
        }
    
        /**
         * Function to check if the username is already used
         * 
         * @return 1 - Username is unique
         * @return 2 - Username is already used
         * @return 3 - An error occured
         */
        public function checkUsernameUsed($username) {    
            // Creating a query to check if the username already exist
            $queryUniqueUsername = "SELECT username FROM user";
            $stm = $this->db->prepare($queryUniqueUsername);
            $stm->bindParam(1, $username);
            if ($stm->execute()) {
                // Getting all the usernames
                $result = $stm->fetchAll(PDO::FETCH_OBJ);
                // Looping through the usernames
                foreach ($result as $user) {
                    // Checking if the usernames is the same as the entered usernames
                    if ($user->username == $username) {
                        // Returning 2 because username was found
                        return 2;
                    }
                }
                // Returning 1 because nothing was found
                return 1;
            } else {
                return 3;
            }
        }

        /**
         * Function to get the user by username
         * 
         * @return userModel a Model filled with all info of the user
         */
        public function getUserByUsername($userModel) {
            // Making a variable for username
            $username = $userModel->getUsername();

            // Query to add user to the database
            $query = "SELECT * FROM user WHERE username = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $username);
            if ($stm->execute()) {
                // Getting the result
                $result = $stm->fetch(PDO::FETCH_OBJ);

                // Filling the userModel
                $userModel->setID($result->ID);
                $userModel->setEmail($result->email);
                $userModel->setPassword($result->password);
                $userModel->setPoints($result->points);
            }

            // Returning the userModel
            return $userModel;
        }

        /** 
         * Funtion to create a new account for the user
         * 
         * @return true if user is added
         * @return false if something happend why the user cannot be added
         */
        public function userAdd($userModel) {
            // Creating variables voor de data used in the query
            $username = $userModel->getUsername();
            $email = $userModel->getEmail();
            // $password = $$userModel->getPassword();

            // Hashing the password
            $hasedPassword = password_hash("wachtwoord", PASSWORD_DEFAULT);

            // Query to add user to the database
            $query = "INSERT INTO user(username, email, password) VALUES(?, ?, ?)";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $username);
            $stm->bindParam(2, $email);
            $stm->bindParam(3, $hasedPassword);
            if ($stm->execute()) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function to add achievement to user
         * 
         * @return true if all achievements are connected to user
         * @return false if 1 or more achievements could not be connected to the user
         */
        public function connectAchievementsToUser($userModel, $achievementList) {
            try {
                // Looping through achievements
                foreach ($achievementList as $achievement) {
                    // Getting the id's
                    $userID = $userModel->getID();
                    $achievementID = $achievement->getID();

                    // Creating a query to insert a row in user_achievement for every achievement
                    $query = "INSERT INTO user_achievement(userID, achievementID) VALUES(?, ?)";
                    $stm = $this->db->prepare($query);
                    $stm->bindParam(1, $userID);
                    $stm->bindParam(2, $achievementID);
                    $stm->execute();
                }

                return true;
            } catch (\Throwable $th) {
                return false;
            }
        }

        /**
         * Function to log user in
         * 
         * @return userID the ID of the user account found
         */
        public function userLogin($userModel) {
            // Making a variable for the username
            $username = $userModel->getUsername();
            $password = $userModel->getPassword();

            $query = "SELECT ID, password FROM user WHERE username = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $username);
            if ($stm->execute()) {
                // Getting the user
                $result = $stm->fetch(PDO::FETCH_OBJ);

                // Checking if passwords match
                if (password_verify($password, $result->password)) {
                    // Gettint the userID and returning it
                    $userID = $result->ID;

                    return $userID;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }

        // /**
        // * Function to add a row of values to the insert query for achievements
        // * @return iets String with all insert rows of user_achievements
        // */
        // Ass arrayslice and offset to make it recursieve
        // Shit with array, had to make a new one each time
        // public function addInsertRowUserAchievements() {
        //     if (count($achievementList) <= $) {
        //         # code...
        //     }
        //         // Creating variables voor de data used in the query
        //         $userID = $userModel->getID();
        //         $achievementID = $achievement->getID();
        //         echo $userID . " ";
        //         echo $achievementID . "<br>";

        //         // Creating a query to insert a row in user_achievement for every achievement
        //         $query = "INSERT INTO user_achievement(userID, achievementID) VALUES(?, ?)";
        //         $stm = $this->db->prepare($query);
        //         $stm->bindParam(1, $userID);
        //         $stm->bindParam(2, $achievementID);
        //         $stm->execute(); 
        //     }
        // }

        /**
         * Function to get user by id
         * 
         * @return userModel the model filled with the user info
         * @return null if the query failed
         */
         public function getUser($userID) {
            $userModel = null;

            // Making a query to get the user by ID
            $query = "SELECT * FROM user WHERE ID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            if ($stm->execute()) {
                // Getting the user
                $result = $stm->fetch(PDO::FETCH_OBJ);

                // Filling the user model
                $userModel = new User($userID, $result->username, $result->email, $result->password, $result->points);
            }

            // Returning the userModel
            return $userModel;
        }

        /**
         * Function to reset user points to 1000
         * Function also removes open bets and updates the achievementProgress
         * 
         * @return true if query executed
         * @return false if something went wrong
         */
        public function resetUserPoints($userModel) {
            // Making variabels for in the query
            $userID = $userModel->getID();
            $status = "Open";

            // Making a query to reset the user points
            // Delete the open bets of the user
            // Update the achievement progress
            $query = "START TRANSACTION;
                      UPDATE user SET points = 1000 WHERE ID = ?;
                      DELETE FROM bet WHERE status = ? AND userID = ?;
                      COMMIT;";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $status);
            $stm->bindParam(3, $userID);
            if ($stm->execute()) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function to change the password of the user
         * 
         * @return true if password is changed
         * @return false if password is not changed
         */
        public function updateUserPassword($userModel) {
            // Creating variables for in the query
            $userID = $userModel->getID();
            $password = $userModel->getPassword();

            // Hasing the password
            $hasedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Query to update the user password
            $query = "UPDATE user SET password = ? WHERE ID = ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $hasedPassword);
            if ($stm->execute()) {
                return true;
            }

            // If query doesn't execute
            return false;
        }
    }
?>
