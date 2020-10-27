<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/betDB.php");
    require_once("../functions/datalayer/api/infoAPI.php");
    require_once("../functions/helper/validate.php");

    class betController {

        // Creating variables for the importent files
        private $betDB;   
        private $infoAPI;
        private $validate;
    
        /* Creating a new instance of BetController */
        public function __construct() {
            $this->betDB = new BetDB();
            $this->infoAPI = new InfoAPI();
            $this->validate = new Validate();
        }
        
        /**
         * Function to get the bets of the user
         * 
         * @return betsListUser a list with all the bets of the user
         */
        public function getBetsUser($userModel, $status) {
            // Creating an array to fill it in de datalayer->api
            $betsListUser = array();

            // Calling the function in de datalayer to fill the array
            $betsListUser = $this->betDB->getBetsUser($userModel, $status);

            // Returning the list given from the Database class
            return $betsListUser;
        }

        /**
         * Function to get the drivers of the API for the bets
         * 
         * @return driversList an array with all drivers
         */
        public function getDrivers($season) {
            // Creating the array
            $driversList = array();

            // Filling the array
            $driversList = $this->infoAPI->getDrivers($season);

            // Returning the filled list
            return $driversList;
        }

         /**
         * Function to get the constructors of the API for the bets
         * 
         * @return constructorsList an array with all constructors
         */
        public function getConstructors($season) {
            // Creating the array
            $constructorsList = array();

            // Filling the array
            $constructorsList = $this->infoAPI->getConstructors($season);

            // Returning the filled list
            return $constructorsList;
        }

        /**
         * Function to return the name of the driver
         * 
         * @param driverModel the model of the driver
         * @param apiId the id of driver in the api
         * @param i the offset of the driverModel
         * 
         * @return driverName name of the Driver bet on
         * Expemple: Instead of kevin_magnussen you get Kevin Magnussen
         */
        public function getDriverBetOn($driverModel, $apiId, $i) {
            // Checking if betOn = apiId
            if (strcmp($driverModel[$i]->getDriverId(), $apiId) == 0) {
                $driverName = $driverModel[$i]->getGivenName() . " " . $driverModel[$i]->getFamilyName();

                return $driverName;
            } else {
                $i++;

                // Going through the function again
                return $this->getDriverBetOn($driverModel, $apiId, $i);
            }
        }

        /**
         * Function to return the name of the constructor
         * 
         * @param constructorModel the model of the constructor
         * @param apiId the id of driver in the api
         * @param i the offset of the driverModel
         * 
         * @return driverName name of the Driver bet on
         * Expemple: Instead of mclaren you get McLaren
         */
        public function getConstructorBetOn($constructorModel, $apiId, $i) {
            // Checking if betOn = apiId
            if (strcmp($constructorModel[$i]->getConstructorId(), $apiId) == 0) {
                $constructorName = $constructorModel[$i]->getName();

                return $constructorName;
            } else {
                $i++;

                // Going through the function again
                return $this->getConstructorBetOn($constructorModel, $apiId, $i);
            }
        }

        /**
         *  Function to get all categories
         * 
         * @return categoriesList an array with all categories
         */
        public function getCategories() {
            // Creating the array
            $categoriesList = array();

            // Filling the array
            $categoriesList = $this->betDB->getCategories();

            // Returning the filled list
            return $categoriesList;
        }

        /**
         * Function to delete an open bet
         */
        public function deleteBet($betID, $betPoints, $userModel) {
            // Checking the betID and points on the back-end
            $validateBetID = $this->validate->validateInput($betID, "/^[0-9]+$/", 1, 11);
            $validateBetPoints = $this->validate->validateInput($betPoints, "/^[0-9]+$/", 2, 11);

            // Checking if all validations are passed
            if ($validateBetID && $validateBetPoints) {
                // Creating variable to check function outcom
                $betDeleted = $this->betDB->deleteBet($betID, $betPoints, $userModel);

                // Checking if betDeleted return true
                if ($betDeleted) {
                    // Getting the current url
                    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    // Reloading page with succes message
                    echo '<script>location.replace("'.$currentURL.'");</script>';
                } else {
                    echo "<script>alert('Bet could not be deleted, try again later');</script>";
                }
            } else {
                echo "<script>alert('Bet could not be deleted, try again later. Something with back-end validation or something');</script>";
            }
        }

        /**
         * Function to update an open bet
         */
        public function updateBet($betID, $betOnId, $betPointsNew, $betPointsOld, $userModel) {
            // Checking the betID and points on the back-end
            $validateBetID = $this->validate->validateInput($betID, "/^[0-9]+$/", 1, 11);
            $validateBetOnId = $this->validate->validateInput($betOnId, "/^[a-zA-Z0-9_.-]*$/", 1, 100);
            $validateBetPointsNew = $this->validate->validateInput($betPointsNew, "/^[0-9]+$/", 2, 11);
            $validateBetPointsOld = $this->validate->validateInput($betPointsOld, "/^[0-9]+$/", 2, 11);

            // Checking if all validations are passed
            if ($validateBetID && $validateBetOnId && $validateBetPointsNew && $validateBetPointsOld) {
                // Creating variable to check function outcom
                $betUpdated = $this->betDB->updateBet($betID, $betOnId, $betPointsNew, $betPointsOld, $userModel);
                // Checking if betDeleted return true
                if ($betUpdated) {
                    // Getting the current url
                    $currentURL = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    // Reloading page with succes message
                    echo '<script>location.replace("'.$currentURL.'");</script>';
                } else {
                    echo "<script>alert('Bet could not be updated, try again later');</script>";
                }
            } else {
                echo "<script>alert('Bet could not be updated, try again later. Something with back-end validation or something');</script>";
            }
        }

        /**
         * Function to calculate the odds of a bet
         * 
         * 
         */
    }  
?>