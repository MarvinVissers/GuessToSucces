<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/api/standingsAPI.php");

    class StandingsController {

        // Creating variables for the importent files
        private $StandingsAPI;   
    
        /* Creating a new instance of StandingsController */
        public function __construct() {
            $this->StandingsAPI = new StandingsAPI();
        }
        
        /**
         * Function to get the current driver championship results of the api
         * 
         * @return driverStandings a list with the world cup stand of the current season for drivers
         */
        function getDriverStandings() {
            // Creating an array to fill it in de datalayer->api
            $driverStandings = array();

            // Calling the function in de datalayer to fill the array
            $driverStandings = $this->StandingsAPI->getDriverStandings();

            // Returning the list given from the Database class
            return $driverStandings;
        }

        /**
         * Function to get the current constructor championship results of the api
         * 
         * @return constructorStandings a list with the world cup stand of the current season for constructors
         */
        function getConstructorStandings() {
            // Creating an array to fill it in de datalayer->api
            $constructorStandings = array();

            // Calling the function in de datalayer to fill the array
            $constructorStandings = $this->StandingsAPI->getConstructorStandings();

            // Returning the list given from the Database class
            return $constructorStandings;
        }

        /**
         * Function to get the results of a season
         * 
         * @return resultListSeason a list with all results of the season
         */
        public function getResultsSeason($season) {
            // Creating an array for the results to fill it later
            $resultsSeason = array();

            // Filling the array
            $resultsSeason = $this->StandingsAPI->getResultsSeason($season);

            // Returning the filled array
            return $resultsSeason;
        }
    }  
?>