<?php
    /**
    * @author Marvin Vissers
    */
    class FastestLap {
        // Creating the variables
        private $rank;
        private $lap;
        private $time;
        private $averageSpeed;

        /**
         * Creates a new instance of FastestLap
         * 
         * @param rank the rank of the lap in the race
         * @param lap the lap on wich the fastest lap is gotton
         * @param time the time object of the lap
         * @param averageSpeed the averagespeed object of the lap
         */
        public function __construct($rank, $lap, $time, $averageSpeed) {
            // Setting the given values equal to the variables in the class
            $this->rank = $rank;
            $this->lap = $lap;
            $this->time = $time;
            $this->averageSpeed = $averageSpeed;
        }

        public function getRank() {
            return $this->rank;
        }
    
        public function setRank($rank) {
            $this->rank = $rank;
        }

        public function getLap() {
            return $this->lap;
        }
    
        public function setLap($lap) {
            $this->lap = $lap;
        }

        public function getTime() {
            return $this->time;
        }
    
        public function setTime($time) {
            $this->time = $time;
        }

        public function getAverageSpeed() {
            return $this->averageSpeed;
        }
    
        public function setAverageSpeed($averageSpeed) {
            $this->averageSpeed = $averageSpeed;
        }
    }
?>