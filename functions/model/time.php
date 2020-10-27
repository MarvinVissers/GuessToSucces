<?php
    /**
    * @author Marvin Vissers
    */
    class Time {
        // Creating the variables
        private $millis;
        private $time;

        /**
         * Creates a new instance of Time
         * 
         * @param millis time in miliseconds
         * @param time time like string
         */
        public function __construct($millis, $time) {
            // Setting the given values equal to the variables in the class
            $this->millis = $millis;
            $this->time = $time;
        }

        public function getMillis() {
            return $this->millis;
        }
    
        public function setMillis($millis) {
            $this->millis = $millis;
        }

        public function getTime() {
            return $this->time;
        }
    
        public function setTime($time) {
            $this->time = $time;
        }
    }
?>