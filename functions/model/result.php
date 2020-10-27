<?php
    /**
     * @author Marvin Vissers
     */
    class Result {
        // Creating the variables
        private $number;
        private $position;
        private $positionText;
        private $points;
        private $driver;
        private $constructor;
        private $grid;
        private $laps;
        private $status;
        private $time;
        private $fastestLap;

        /**
         * Creates a new instance of Result
         * 
         * @param number the number wich the driver races with
         * @param position position the driver finished in
         * @param positionText position tekst of the driver, if 2 driver finish at the same time
         * @param driver driver object
         * @param constructor constructor object
         * @param grid starting position of the driver
         * @param laps laps raced
         * @param status status of the result
         * @param time time object
         * @param fastestLap fastest lap object
         */
        public function __construct($number, $position, $positionText, $points, $driver, $constructor, $grid, $laps, $status, $time, $fastestLap) {
            $this->number = $number;
            $this->position = $position;
            $this->positionText = $positionText;
            $this->points = $points;
            $this->driver = $driver;
            $this->constructor = $constructor;
            $this->grid = $grid;
            $this->laps = $laps;
            $this->status = $status;
            $this->time = $time;
            $this->fastestLap = $fastestLap;
        }

        public function getNumber() {
            return $this->number;
        }
    
        public function setNumber($number) {
            $this->number = $number;
        }

        public function getPosition() {
            return $this->position;
        }
    
        public function setPosition($position) {
            $this->position = $position;
        }

        public function getPositionText() {
            return $this->positionText;
        }
    
        public function setPositionText($positionText) {
            $this->positionText = $positionText;
        }

        public function getPoints() {
            return $this->points;
        }
    
        public function setPoints($points) {
            $this->points = $points;
        }

        public function getDriver() {
            return $this->driver;
        }
    
        public function setDriver($driver) {
            $this->driver = $driver;
        }

        public function getConstructor() {
            return $this->constructor;
        }
    
        public function setConstructor($constructor) {
            $this->constructor = $constructor;
        }

        public function getGrid() {
            return $this->grid;
        }
    
        public function setGrid($grid) {
            $this->grid = $grid;
        }

        public function getLaps() {
            return $this->laps;
        }
    
        public function setLaps($laps) {
            $this->laps = $laps;
        }

        public function getStatus() {
            return $this->status;
        }
    
        public function setStatus($status) {
            $this->status = $status;
        }

        public function getTime() {
            return $this->time;
        }
    
        public function setTime($time) {
            $this->time = $time;
        }

        public function getFastestLap() {
            return $this->fastestLap;
        }
    
        public function setFastestLap($fastestLap) {
            $this->fastestLap = $fastestLap;
        }
    }
?>