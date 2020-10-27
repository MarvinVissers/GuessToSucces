<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/userDB.php");
    require_once("../functions/datalayer/database/achievementDB.php");
    // Linking to the validation class
    require_once("../functions/helper/validate.php");

    class UserController {
        
        // Creating variables for the importent files
        private $userDB;
        private $validate; 
        private $achievementDB;
    
        /* Creating a new instance of UserController */
        public function __construct() {
            $this->userDB = new UserDB;
            $this->achievementDB = new achievementDB();
            $this->validate = new Validate();
        }

        /**
         * Function to create a new account for the user
         * When the funtion is complete the user will be send to home page logged in
         */
        public function userAdd($userModel) {
            // Validating the input on back-end
            $validateEmail = $this->validate->validateEmail($userModel->getEmail());
            $validateUsername = $this->validate->validateInput($userModel->getUsername(), "/^[a-zA-Z0-9_.-]*$/", 1, 25);
            $validatePassword = $this->validate->validateInput($userModel->getPassword(), "/^[a-zA-Z0-9@+_.!?|]*$/", 8, 20);

            // Checking if they all return true
            if ($validateEmail &&  $validateUsername && $validatePassword) {
                // Checking if email or username is already used
                $emailExist = $this->userDB->checkUserEmailUsed($userModel->getEmail());
                $usernameExist = $this->userDB->checkUsernameUsed($userModel->getUsername());

                if ($emailExist != 1) {
                    // Returning error if one or more failes
                    header("Location: create-account?error=3");
                } else if ($usernameExist != 1) {
                    // Returning error if one or more failes
                    header("Location: create-account?error=4");
                } else {
                    // Sending the model to the database layer create the account
                    if ($this->userDB->userAdd($userModel)) {
                        // Getting the user info by username and filling the userModel with it
                        $userModel = $this->userDB->getUserByUsername($userModel);

                        // Achievements ophalen
                        $achievementList = $this->achievementDB->getAchievements();

                        // Checking if achievements are connected
                        if($this->userDB->connectAchievementsToUser($userModel, $achievementList)) {
                            // Logging the user in with session
                            session_start();
                            $_SESSION['userID'] = $userModel->getID();

                            // Sending user to home page
                            header("Location: index");
                        } else {
                            // Returning with error
                            header("Location: create-account?error=5");
                        }
                    } else {
                        // Returning error if user account is not added
                        header("Location: create-account?error=5");
                    }
                }
            } else {
                // Returning error if one or more failes
                header("Location: create-account?error=5");
            }   
        }

        /* Function to log user in */
        /**
         * Function to log user in
         * When function is complete user is logged in with session
         */
        public function userLogin($userModel) {
            // Validating the input on back-end
            $validateUsername = $this->validate->validateInput($userModel->getUsername(), "/^[a-zA-Z0-9_.-]*$/", 1, 25);
            $validatePassword = $this->validate->validateInput($userModel->getPassword(), "/^[a-zA-Z0-9@+_.!?|]*$/", 8, 20);

            // Checking if they all return true
            if ($validateUsername && $validatePassword) {
                // Sending the data to the datalayer login function
                $userID = $this->userDB->userLogin($userModel);
                $userModel->setID($userID);

                if ($userModel->getID() != null) {
                    // Starting the session
                    session_start();
                    $_SESSION['userID'] = $userModel->getID();

                    // Sending the user to the home page
                    header("Location: index");
                } else {
                    // Reloading the page with an error
                    header("Location: login?error=2");
                }
            } else {
                // Reloading the page with an error
                header("Location: login?error=1");
            }
        }

        /**
         * Function to get user by id
         * 
         * @return userModel the model filled with the user info
         */
        public function getUser($userID) {
            // Calling the function
            $userModel = $this->userDB->getUser($userID);

            // Returning the filled model
            return $userModel;
        }

        /**
         * Function to change the password of the user
         * 
         * @return true if password is changed
         * @return false if password is not changed
         */
        public function updateUserPassword($userModel) {
            // Validating the new password
            $validatePassword = $this->validate->validateInput($userModel->getPassword(), "/^[a-zA-Z0-9@+_.!?|]*$/", 8, 20);

            // Checking if password is valid
            if ($validatePassword) {
                // Updating the password in the database
                $userPasswordChanged = $this->userDB->updateUserPassword($userModel);

                // Checking if it worked
                if ($userPasswordChanged) {
                    return true;
                } else {
                    // Getting the current url
                    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $newURL = $currentURL . "&error=4";
                    // Reloading page with error
                    header("Location: ". $newURL);
                }
            } else {
                // Getting the current url
                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $newURL = $currentURL . "&error=3";
                // Reloading page with error
                header("Location: ". $newURL);
            }
        }

        /**
         * Function to reset user points to 1000
         * Function also removes open bets and updates the achievementProgress
         */
        public function resetUserPoints($userModel) {
            // Sending variables to the databaselayer
            $resetUserPoints = $this->userDB->resetUserPoints($userModel);

            if ($resetUserPoints) {
                // Making an array to get the achievements
                $listAchievements = array(42, 43, 44, 69);

                $userModel->setPoints(1000);

                // Getting the userAchievementModel of those achievements
                // $userAchievementModel = array();
                $userAchievementModel = $this->achievementDB->getAchievementsUserByIds($userModel, $listAchievements, array(), 0);

                // Creating an array with the new achievement values
                $timesPointsReset = $userAchievementModel[3]->getAchievementProgress() + 1;
                $newAchievementProgress = array(1000, 1000, 1000, $timesPointsReset);

                // Updating the progress
                $userAchievementModel = $this->updateAchievementProgress($userAchievementModel, $newAchievementProgress, 0);

                // Updating the achievementProgress
                $this->achievementDB->updateAchievementProgress($userAchievementModel);

                $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                // Reloading page
                echo "<script>location.replace('$currentURL')</script>";
            } else {
                // Reloading page with error
                echo "<script>location.replace('4')</script>";
            }
        }

        /**
         * Function to change the achievement progress before updating in the database
         * 
         * @param userAchievementModel the list of achievements
         * @param newAchievementProgress the list with the new achievement values
         * @param offset the offset of the list of achievements
         * 
         * @return userAchievementModel the updatet list of achievements
         */
        private function updateAchievementProgress($userAchievementModel, $newAchievementProgress, $offset) {
            // Looping through the array
            foreach ($userAchievementModel as $achievement) {
                // Updating the achievementProgress
                $achievement->setAchievementProgress($newAchievementProgress[$offset]);
                $offset++;
            }

            return $userAchievementModel;
        }

        /**
         * Function to log user out
         * When function is completed session is destroyed and user is back at login screen
         */
        public function userLogout() {
            // Starting a session to unset and destroy it
            session_start();
            session_unset();
            session_destroy();

            // Sending the user back to the login page
            header("Location: login");
        }
    }
?>
