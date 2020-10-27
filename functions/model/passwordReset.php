<?php
    /**
    * @author Marvin Vissers
    */
    class PasswordReset {
        // Creating the variables
        private $id;
        private $userID;
        private $selector;
        private $token;
        private $linkExpires;

        /**
         * Creates a new instance of PasswordReset
         * 
         * @param id ID of the password reset row
         * @param userID to keep track of the links per user
         * @param selector the selector for the link
         * @param token token to verify the link
         * @param linkExpires time the link expires
         */
        public function __construct($id, $userID, $selector, $token, $linkExpires) {
            // Setting the given values equal to the variables in the class
            $this->id = $id;
            $this->userID = $userID;
            $this->selector = $selector;
            $this->token = $token;
            $this->linkExpires = $linkExpires;
        }

        public function getID() {
            return $this->id;
        }
    
        public function setID($id) {
            $this->id = $id;
        }

        public function getUserID() {
            return $this->userID;
        }
    
        public function setUserID($userID) {
            $this->userID = $userID;
        }

        public function getSelector() {
            return $this->selector;
        }
    
        public function setSelector($selector) {
            $this->selector = $selector;
        }

        public function getToken() {
            return $this->token;
        }
    
        public function setToken($token) {
            $this->token = $token;
        }

        public function getLinkExpires() {
            return $this->linkExpires;
        }
    
        public function setLinkExpires($linkExpires) {
            $this->linkExpires = $linkExpires;
        }
    }
?>