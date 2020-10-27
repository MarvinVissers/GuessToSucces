<?php
    /**
    * @author Marvin Vissers
    */
    class Constructor {
        // Creating the variables
        private $constructorId;
        private $url;
        private $name;
        private $nationality;

        /**
         * Creates a new instance of Constructor
         * 
         * @param constructorId is the id of the constructor in de API
         * @param url is the link to the wikipedia of the constructor
         * @param name is the name of the constructor
         * @param nationality is the country where the constructor comes from
         */
        public function __construct($constructorId, $url, $name, $nationality) {
            // Setting the given values equal to the variables in the class
            $this->constructorId = $constructorId;
            $this->url = $url;
            $this->name = $name;
            $this->nationality = $nationality;
        }

        public function getConstructorId() {
            return $this->constructorId;
        }
    
        public function setConstructorId($constructorId) {
            $this->constructorId = $constructorId;
        }

        public function getUrl() {
            return $this->url;
        }
    
        public function setUrl($url) {
            $this->url = $url;
        }

        public function getName() {
            return $this->name;
        }
    
        public function setName($name) {
            $this->name = $name;
        }

        public function getNationality() {
            return $this->nationality;
        }
    
        public function setNationality($nationality) {
            $this->nationality = $nationality;
        }
    }
?>