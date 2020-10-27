<?php
    /**
    * @author Marvin Vissers
    */
    class Circuit {
        // Creating the variables
        private $circuitId;
        private $url;
        private $circuitName;
        private $location;

        /**
         * Creates a new instance of Circuit
         * 
         * @param circuitId is the Id of the circuit in de API
         * @param url is the url to the wikipedia page
         * @param circuitName is the name of the circuit
         * @param location is the location of the circuit
         */
        public function __construct($circuitId, $url, $circuitName, $location) {
            // Setting the given values equal to the variables in the class
            $this->circuitId = $circuitId;
            $this->url = $url;
            $this->circuitName = $circuitName;
            $this->location = $location;
        }

        public function getCircuitId() {
            return $this->circuitId;
        }
    
        public function setCircuitId($circuitId) {
            $this->circuitId = $circuitId;
        }

        public function getUrl() {
            return $this->url;
        }
    
        public function setUrl($url) {
            $this->url = $url;
        }

        public function getCircuitName() {
            return $this->circuitName;
        }
    
        public function setCircuitName($circuitName) {
            $this->circuitName = $circuitName;
        }

        public function getLocation() {
            return $this->location;
        }
    
        public function setLocation($location) {
            $this->location = $location;
        }
    }
?>