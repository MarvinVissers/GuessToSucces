<?php
    /**
    * @author Marvin Vissers
    */
    class Race {
        // Creating the variables
        private $season;
        private $round;
        private $url;
        private $raceName;
        private $circuit;
        private $date;
        private $time;
        private $results;

        /**
         * Creates a new instance of Race
         * 
         * @param season season of the race
         * @param round round of the race in the calender
         * @param url link to race wikipedia
         * @param raceName name of the race
         * @param circuit circuit on wich the race is raced
         * @param date date of the race
         * @param time time of the race
         * @param results the results of the race
         */
        public function __construct($season, $round, $url, $raceName, $circuit, $date, $time, $results) {
            $this->season = $season;
            $this->round = $round;
            $this->url = $url;
            $this->raceName = $raceName;
            $this->circuit = $circuit;
            $this->date = $date;
            $this->time = $time;
            $this->results = $results;
        }

        public function getSeason() {
            return $this->season;
        }
    
        public function setSeason($season) {
            $this->season = $season;
        }

        public function getRound() {
            return $this->round;
        }
    
        public function setRound($round) {
            $this->round = $round;
        }

        public function getUrl() {
            return $this->url;
        }
    
        public function setUrl($url) {
            $this->url = $url;
        }

        public function getRaceName() {
            return $this->raceName;
        }
    
        public function setRaceName($raceName) {
            $this->raceName = $raceName;
        }

        public function getCircuit() {
            return $this->circuit;
        }
    
        public function setCircuit($circuit) {
            $this->circuit = $circuit;
        }

        public function getDate() {
            return $this->date;
        }
    
        public function setDate($date) {
            $this->date = $date;
        }

        public function getTime() {
            return $this->time;
        }
    
        public function setTime($time) {
            $this->time = $time;
        }   

        public function getResults() {
            return $this->results;
        }
    
        public function setResults($results) {
            $this->results = $results;
        }  
    }
?>