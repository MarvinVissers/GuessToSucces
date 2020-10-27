<?php
    // Including database layer class
    require("../functions/datalayer/api/calenderAPI.php");

    class CalenderController {
        
        // Creating variables for the importent files
        private $calenderAPI;

        /* Creating a new instance of CalenderController */
        public function __construct() {
            $this->calenderAPI = new CalenderAPI();
        }

        /**
         * Function to get the calender of the current season
         * 
         * @return calenderCurrentSeason an array with all Grand Prixs of the current season
         */
        public function getCalenderCurrentSeason() {
            // Creating an array to fill it later
            $calenderCurrentSeason = array();

            // Filling the calender and returning it
            $calenderCurrentSeason = $this->calenderAPI->getCalenderCurrentSeason();

            return $calenderCurrentSeason;
        }

        /**
         * Function to get the next Grand Prix on the calender
         * 
         * @param calender the Grand Prix calender
         * 
         * @return nextGrandPrix the round of the next Grand PRix
         */
        public function getNextGrandPrix($calender) {
            // Variable for the next grand prix
            $dateNextGrandPrix = date("U") - 1800;

            // Looping through the calender
            foreach($calender as $grandPrix){
                // Setting grand prix date to time
                $thisGrandPrix = strtotime($grandPrix->getDate());

                // Checking if this is bigger than the next grand prix
                if ($thisGrandPrix > $dateNextGrandPrix) {
                    // Returning the first grand prix since its next
                    return $grandPrix;
                }
            }
        }
    }
?>