<?php
    /**
    * @author Marvin Vissers
    */
    class DriverStandings {
        // Creating the variables
        private $position;
        private $positionText;
        private $points;
        private $wins;
        private $Driver;
        private $Constructor;

        /**
         * Creates a new instance of DriverStandings
         * 
         * @param position position of the Driver
         * @param positionText offical position of the Driver. For if 2 Drivers have the same amount of points
         * @param points amount of points the driver has in that season
         * @param wins amount of wins the driver has in that season
         * @param Driver Driver instance
         * @param Constructor Constructor instance
         */
        public function __construct($position, $positionText, $points, $wins, $Driver, $Constructor) {
            $this->position = $position;
            $this->positionText = $positionText;
            $this->points = $points;
            $this->wins = $wins;
            $this->Driver = $Driver;
            $this->Constructor = $Constructor;
        }

        public function getPosition() {
            return $this->position;
        }
    
        public function setPosition($position) {
            $this->position = $position;
        }

        public function getPositionText() {
            return $this->positionText;
        }
    
        public function setPositionText($positionText) {
            $this->positionText = $positionText;
        }

        public function getPoints() {
            return $this->points;
        }
    
        public function setPoints($points) {
            $this->points = $points;
        }

        public function getWins() {
            return $this->wins;
        }
    
        public function setWins($wins) {
            $this->wins = $wins;
        }

        public function getDriver() {
            return $this->Driver;
        }

        public function setDriver($Driver) {
            $this->Driver = $Driver;
        }

        public function getConstructor() {
            return $this->Constructor;
        }

        public function setConstructor($Constructor) {
            $this->Constructor = $Constructor;
        }
    }
?>