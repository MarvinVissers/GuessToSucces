<?php
    /**
    * @author Marvin Vissers
    */
    class Location {
        // Creating the variables
        private $let;
        private $long;
        private $location;
        private $country;

        /**
         * Creates a new instance of Location
         * 
         * @param let is the altitude of a circuit. How high above sea-level
         * @param long is how long the circuit is
         * @param location is the town or city the circuit is based
         * @param country is the country where you can find the circuit
         */
        public function __construct($let, $long, $location, $country) {
            // Setting the given values equal to the variables in the class
            $this->let = $let;
            $this->long = $long;
            $this->location = $location;
            $this->country = $country;
        }

        public function getLet() {
            return $this->let;
        }
    
        public function setLet($let) {
            $this->let = $let;
        }

        public function getLong() {
            return $this->long;
        }
    
        public function setLong($long) {
            $this->long = $long;
        }

        public function getLocation() {
            return $this->location;
        }
    
        public function setLocation($location) {
            $this->location = $location;
        }

        public function getCountry() {
            return $this->country;
        }
    
        public function setCountry($country) {
            $this->country = $country;
        }
    }
?>