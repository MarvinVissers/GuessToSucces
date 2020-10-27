<?php
    /**
    * @author Marvin Vissers
    */
    class ConstructorStandings {
        // Creating the variables
        private $position;
        private $positionText;
        private $points;
        private $wins;
        private $Constructor;

        /**
         * Creates a new instance of ConstructorStandings
         * 
         * @param position position of the constructor.
         * @param positionText offical position of the constructor. For when 2 constructors have the same amount of points
         * @param points points of the constructor
         * @param wins Amount of wins the constructor has in the season
         * @param Constructor Constructor model
         */
        public function __construct($position, $positionText, $points, $wins, $Constructor) {
            $this->position = $position;
            $this->positionText = $positionText;
            $this->points = $points;
            $this->wins = $wins;
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

        public function getConstructor() {
            return $this->Constructor;
        }

        public function setConstructor($Constructor) {
            $this->Constructor = $Constructor;
        }
    }
?>