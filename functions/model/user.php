<?php
    /**
    * @author Marvin Vissers
    */
    class User {
        // Creating the variables
        private $ID;
        private $username;
        private $email;
        private $password;
        private $points;

        /**
         * Creates a new instance of User
         * 
         * @param ID ID of the user in the database
         * @param username Username of the suer
         * @param email Email of the user
         * @param password Password of the user
         * @param points Points the user
         */
        public function __construct($ID, $username, $email, $password, $points) {
            $this->ID = $ID;
            $this->username = $username;
            $this->email = $email;
            $this->password = $password;
            $this->points = $points;
        }

        public function getID() {
            return $this->ID;
        }
    
        public function setID($ID) {
            $this->ID = $ID;
        }

        public function getUsername() {
            return $this->username;
        }
    
        public function setUsername($username) {
            $this->username = $username;
        }

        public function getEmail() {
            return $this->email;
        }
    
        public function setEmail($email) {
            $this->email = $email;
        }

        public function getPassword() {
            return $this->password;
        }
    
        public function setPassword($password) {
            $this->password = $password;
        }

        public function getPoints() {
            return $this->points;
        }
    
        public function setPoints($points) {
            $this->points = $points;
        }
    }
?>