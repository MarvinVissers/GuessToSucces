<?php
    /**
    * @author Marvin Vissers
    */
    class AverageSpeed {
        // Creating the variables
        private $units;
        private $speed;

        /**
         * Creates a new instance of averageSpeed
         * 
         * @param units the units in wich the speed is measured
         * @param speed the average speed
         */
        public function __construct($units, $speed) {
            // Setting the given values equal to the variables in the class
            $this->units = $units;
            $this->speed = $speed;
        }

        public function getUnits() {
            return $this->units;
        }
    
        public function setUnits($units) {
            $this->units = $units;
        }

        public function getUrl() {
            return $this->speed;
        }
    
        public function setSpeed($speed) {
            $this->speed = $speed;
        }
    }
?>