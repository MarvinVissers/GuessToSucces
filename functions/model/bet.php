<?php
    /**
    * @author Marvin Vissers
    */
    class Bet {
        // Creating the variables
        private $ID;
        private $user;
        private $season;
        private $grandPrix;
        private $categorie;
        private $points;
        private $betOn;
        private $odds;
        private $status;
        private $rewaredPayed;

        /**
         * Creates a new instance of Bet
         * 
         * @param ID ID of the bet in the database
         * @param user User of who the bet is
         * @param season Season of the Grand Prix where the bet is placed on
         * @param grandPrix Grand Prix on wich is betted
         * @param categorie Categorie on wich the user betted
         * @param points Points the user betted
         * @param betOn the driver/constructor on wich the user has bet
         * @param odds Odds of the bet. Is at least 1
         * @param status Status of the bet
         * @param rewaredPayed If the reward is payed. 1 is yes, 0 is not, null is lost or bet is still open
         */
        public function __construct($ID, $user, $season, $grandPrix, $categorie, $points, $betOn, $odds, $status, $rewaredPayed) {
            // Setting the given values equal to the variables in the class
            $this->ID = $ID;
            $this->user = $user;
            $this->season = $season;
            $this->grandPrix = $grandPrix;
            $this->categorie = $categorie;
            $this->points = $points;
            $this->betOn = $betOn;
            $this->odds = $odds;
            $this->status = $status;
            $this->rewaredPayed = $rewaredPayed;
        }

        public function getID() {
            return $this->ID;
        }
    
        public function setID($ID) {
            $this->ID = $ID;
        }

        public function getUser() {
            return $this->user;
        }
    
        public function setUser($user) {
            $this->user = $user;
        }

        public function getSeason() {
            return $this->season;
        }
    
        public function setSeason($season) {
            $this->season = $season;
        }

        public function getGrandPrix() {
            return $this->grandPrix;
        }
    
        public function setGrandPrix($grandPrix) {
            $this->grandPrix = $grandPrix;
        }

        public function getCategorie() {
            return $this->categorie;
        }
    
        public function setCategorie($categorie) {
            $this->categorie = $categorie;
        }

        public function getPoints() {
            return $this->points;
        }
    
        public function setPoints($points) {
            $this->points = $points;
        }

        public function getBetOn() {
            return $this->betOn;
        }
    
        public function setBetOn($betOn) {
            $this->betOn = $betOn;
        }

        public function getOdds() {
            return $this->odds;
        }
    
        public function setOdds($odds) {
            $this->odds = $odds;
        }

        public function getStatus() {
            return $this->status;
        }
    
        public function setStatus($status) {
            $this->status = $status;
        }

        public function getRewaredPayed() {
            return $this->rewaredPayed;
        }
    
        public function setRewaredPayed($rewaredPayed) {
            $this->rewaredPayed = $rewaredPayed;
        }
    }
?>