<?php
    /**
    * @author Marvin Vissers
    */
    class Achievement {
        // Creating the variables
        private $ID;
        private $name;
        private $description;
        private $rewardedAt;
        private $picture;
        private $points;
        private $visibility;

        /**
         * Creates a new instance of Achievement
         * 
         * @param ID ID of the achievement in the database
         * @param name Username of the suer
         * @param description Email of the user
         * @param rewardedAt the amount of times you need to achieve something for the reward
         * @param picture Password of the user
         * @param points Points the user
         * @param visibility If a achievement is only visible ones earned or not
         */
        public function __construct($ID, $name, $description, $rewardedAt, $picture, $points, $visibility) {
            $this->ID = $ID;
            $this->name = $name;
            $this->description = $description;
            $this->rewardedAt = $rewardedAt;
            $this->picture = $picture;
            $this->points = $points;
            $this->visibility = $visibility;
        }

        public function getID() { 
            return $this->ID;
        }
    
        public function setID($ID) {
            $this->ID = $ID;
        }

        public function getName() {
            return $this->name;
        }
    
        public function setName($name) {
            $this->name = $name;
        }

        public function getDescription() {
            return $this->description;
        }
    
        public function setDescription($description) {
            $this->description = $description;
        }

        public function getRewaredAt() {
            return $this->rewardedAt;
        }
    
        public function setRewaredAt($rewardedAt) {
            $this->rewardedAt = $rewardedAt;
        }

        public function getPicture() {
            return $this->picture;
        }
    
        public function setPicture($picture) {
            $this->picture = $picture;
        }

        public function getPoints() {
            return $this->points;
        }
    
        public function setPoints($points) {
            $this->points = $points;
        }

        public function getVisibility() {
            return $this->visibility;
        }
    
        public function setVisibility($visibility) {
            $this->visibility = $visibility;
        }
    }
?>