<?php
    /**
    * @author Marvin Vissers
    */
    class UserAchievement {
        // Creating the variables
        private $user;
        private $achievement;
        private $achievementProgress;
        private $receivedAt;
        private $seen;

        /**
         * Creates a new instance of UserAchievement
         * 
         * @param user User model
         * @param achievement Achievement model
         * @param achievementProgress progress towards the achievement
         * @param receivedAt Timestamp on wich achievement is received, can be null
         * @param seen 1 if user has seen the achievement pop-up, 0 for not seen the pop-up, null is not received achievement yet
         */
        public function __construct($user, $achievement, $achievementProgress, $receivedAt, $seen) {
            // Setting the given values equal to the variables in the class
            $this->user = $user;
            $this->achievement = $achievement;
            $this->achievementProgress = $achievementProgress;
            $this->receivedAt = $receivedAt;
            $this->seen = $seen;
        }

        public function getUser() {
            return $this->user;
        }
    
        public function setUser($user) {
            $this->user = $user;
        }

        public function getAchievement() {
            return $this->achievement;
        }
    
        public function setAchievement($achievement) {
            $this->achievement = $achievement;
        }

        public function getAchievementProgress() {
            return $this->achievementProgress;
        }
    
        public function setAchievementProgress($achievementProgress) {
            $this->achievementProgress = $achievementProgress;
        }

        public function getReceivedAt() {
            return $this->receivedAt;
        }
    
        public function setReceivedAt($receivedAt) {
            $this->receivedAt = $receivedAt;
        }

        public function getSeen() {
            return $this->seen;
        }
    
        public function setSeen($seen) {
            $this->seen = $seen;
        }
    }
?>