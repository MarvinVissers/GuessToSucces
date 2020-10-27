<?php
    /**
     * @author Marvin Vissers
     */
    class Odds {

        // Creating the variables
        private $odds;
        private $categorie;
        private $driver;
        private $constructor;
        private $position;
        private $season;

        /**
         * Creates a new instance of Odds
         * 
         * @param odds the odds of something happening
         * @param categorie categorie of the odds
         * @param driver driver object
         * @param constructor constructor object
         * @param position the position of the driver/constructor
         * @param season the season of the result
         */
        public function __construct($odds, $categorie, $driver, $constructor, $position, $season) {
            $this->odds = $odds;
            $this->categorie = $categorie;
            $this->driver = $driver;
            $this->constructor = $constructor;
            $this->position = $position;
            $this->season = $season;
        }

        public function getOdds() {
            return $this->odds;
        }
    
        public function setOdds($odds) {
            $this->odds = $odds;
        }

        public function getCategorie() {
            return $this->categorie;
        }
    
        public function setCategorie($categorie) {
            $this->categorie = $categorie;
        }

        public function getDriver() {
            return $this->driver;
        }
    
        public function setDriver($driver) {
            $this->driver = $driver;
        }

        public function getConstructor() {
            return $this->constructor;
        }
    
        public function setConstructor($constructor) {
            $this->constructor = $constructor;
        }

        public function getPosition() {
            return $this->position;
        }

        public function setPosition($position) {
            $this->position = $position;
        }

        public function getSeason() {
            return $this->season;
        }

        public function setSeason($season) {
            $this->season = $season;
        }
    }
?>