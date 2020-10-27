<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/achievementDB.php");

    class AchievementController {

        // Creating variables for the importent files
        private $AchievementDB;   
    
        /* Creating a new instance of AchievementController */
        public function __construct() {
            $this->AchievementDB = new AchievementDB();
        }
        
        /**
         * Function to get the achievements of the user
         * 
         * @return achievementsListUser a list with al the achievements of the user orderd on if the user gotten then and then on their ID
         */
        public function getAchievementsUser($userModel) {
            // Creating an array to fill it in de datalayer
            $achievementsListUser = array();

            // Calling the function in de datalayer to fill the array
            $achievementsListUser = $this->AchievementDB->getAchievementsUser($userModel);

            // Returning the list given from the Database class
            return $achievementsListUser;
        }

        /**
         * Function to update the achievement progress for the points
         * 
         * @param achievementList a list with the achievement id's for the database to get
         * @param userModel the model of the user 
         */
        public function updateAchievementProgress($achievementList, $userModel) {
            // Creating an array to fill it later in the datalayer
            $userAchievementModel = array();

            // Filling the array
            $userAchievementModel = $this->AchievementDB->getAchievementsUserByIds($userModel, $achievementList, $userAchievementModel, 0);

            // Looping through the achievements and setting the progress
            foreach ($userAchievementModel as $uaModel) {
                $uaModel->setAchievementProgress($userModel->getPoints());
            }

            // Updating the achievement progress in the database
            $this->AchievementDB->updateAchievementProgress($userAchievementModel);
        }

        /**
         * Function to check if the user has any new achievements
         * 
         * @param achievementsListUser the list of the achievements
         * @param newAchievementsRewared the list of the new achievements, get filled in the fucntion
         * @param i the number of offset in the array to check for new achievements
         * 
         * @return newAchievementsRewared a list of achievements the user has gotton and not seen yet
         */
        public function checkForNewAchievementsUser($achievementsListUser, $newAchievementsRewared, $i) {
            if ($i < count($achievementsListUser)){
                // Getting the array offset
                $achievementUser = $achievementsListUser[$i];

                // Making variables for to check the the progress, if the user has received and if the user has seen the achievement
                $achievementProgressUser = $this->checkAchievementProgressUser($achievementUser->getAchievementProgress(), $achievementUser->getAchievement()->getRewaredAt());
                $achievementReceivedByUser = $this->checkAchievementReceivedByUser($achievementUser->getReceivedAt());
                $achievementSeenByUser = $this->checkAchievementSeenByUser($achievementUser->getSeen());

                // echo "Bij achievement " . $achievementUser->getAchievement()->getID() . " is de progress = " . $achievementProgressUser . " of het ontvangen = " . $achievementReceivedByUser . " en of die gezien is = " . $achievementSeenByUser . "<br>";

                // Checking if the user has an achievements wich he/she has not seen yet
                if ($achievementProgressUser && $achievementReceivedByUser && $achievementSeenByUser) {
                    // Adding row to the array
                    array_push($newAchievementsRewared, $achievementUser);
                }

                // Going through the function again with diffrent number
                $i++;
                return $this->checkForNewAchievementsUser($achievementsListUser, $newAchievementsRewared, $i);
            } else {
                // Returning the filled arry
                return $newAchievementsRewared;
            }
        }

        /**
         * Function to check if Achievements progress of the user is equal or better than the rewared at number
         * This function supports checkForNewAchievementsUser to keep it clean
         * 
         * @param achievementProgressUser the progress of the user towards the achievement
         * @param achievementRewaredAt the number at wich an achievement is rewared
         * 
         * @return true if user progress is equal or better than the rewaredAt number
         * @return false if the user progress is smaller than the rewaredAt number
         */
        private function checkAchievementProgressUser($achievementProgressUser, $achievementRewaredAt) {
            // Checking the progress of the achievement
            if ($achievementProgressUser >= $achievementRewaredAt) {
                return true;
            } else {
                return false;
            }   
        }

        /**
         * Function to check if the achievement is received by the user and he/she has seen it
         * This function supports checkForNewAchievementsUser to keep it clean
         * 
         * @param achievementUserReceivedAt the timestamp the user got the achievement
         * 
         * @return true if the user has received the achievement
         * @return false if the user has not received the achievement
         */
        private function checkAchievementReceivedByUser($achievementUserReceivedAt) {
            // Checking if the user has received the achievement
            if ($achievementUserReceivedAt != null && $achievementUserReceivedAt != '') {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function to check if the achievement is received by the user and he/she has seen it
         * This function supports checkForNewAchievementsUser to keep it clean
         * 
         * @param achievementSeenByUser if the user has seen the pop-up with the achievement
         * 
         * @return true if the user has not seen the achievement pop-up
         * @return false if the user has not received the achievement or has seen the achievement pop-up
         */
        private function checkAchievementSeenByUser($achievementSeenByUser) {
            // Checking if the user has received the achievement
            if ($achievementSeenByUser == 0) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function to update the seen status of the achievement
         * 
         * @param userAchievementModal the modal of the user_achievement
         */
        public function updateAchievementSeen($userAchievementModel) {
            // sending the variables to the database layer
            $this->AchievementDB->updateAchievementSeen($userAchievementModel);
        }
    }  
?>