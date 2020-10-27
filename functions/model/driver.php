<?php
    /**
    * @author Marvin Vissers
    */
    class Driver {
        // Creating the variables
        private $driverId;
        private $permanentNumber;
        private $code;
        private $url;
        private $givenName;
        private $familyName;
        private $dateOfBirth;
        private $nationality;

        /**
         * Creates a new instance of Driver
         * 
         * @param driverId Id of the driver in the api
         * @param permantNumber Number wich the drivers races with. Only for newer drivers
         * @param code 3 digit letter code of the driver
         * @param url link to driver wikipedia
         * @param givenName firstname of the driver
         * @param familyName surname of the driver
         * @param dateOfBirht date on wich the driver was born
         * @param nationality is the country where the driver comes from
         */
        public function __construct($driverId, $permanentNumber, $code, $url, $givenName, $familyName, $dateOfBirth, $nationality) {
            $this->driverId = $driverId;
            $this->permanentNumber = $permanentNumber;
            $this->code = $code;
            $this->url = $url;
            $this->givenName = $givenName;
            $this->familyName = $familyName;
            $this->dateOfBirth = $dateOfBirth;
            $this->nationality = $nationality;
        }

        public function getDriverId() {
            return $this->driverId;
        }
    
        public function setDriverId($driverId) {
            $this->driverId = $driverId;
        }

        public function getPermanentNumber() {
            return $this->permanentNumber;
        }
    
        public function setPermanentNumber($permanentNumber) {
            $this->permanentNumber = $permanentNumber;
        }

        public function getCode() {
            return $this->code;
        }
    
        public function setCode($code) {
            $this->code = $code;
        }

        public function getUrl() {
            return $this->url;
        }
    
        public function setUrl($url) {
            $this->url = $url;
        }

        public function getGivenName() {
            return $this->givenName;
        }
    
        public function setGivenName($givenName) {
            $this->givenName = $givenName;
        }

        public function getFamilyName() {
            return $this->familyName;
        }
    
        public function setFamilyName($familyName) {
            $this->familyName = $familyName;
        }

        public function getDateOfBirth() {
            return $this->dateOfBirth;
        }
    
        public function setDateOfBirth($dateOfBirth) {
            $this->dateOfBirth = $dateOfBirth;
        }

        public function getNationality() {
            return $this->nationality;
        }
    
        public function setNationality($nationality) {
            $this->nationality = $nationality;
        }
    }
?>