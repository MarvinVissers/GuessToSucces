<?php
    /**
     * @author Marvin Vissers
     */
    class StandingsAPI {
        
        /**
         * Function to get the current driver championship results of the api
         * 
         * @return $standings. Array with all information over the driver standings
         */
        public function getDriverStandings() {
            // Creating an array for the results to fill it later
            $standings = array();

            // Setting up the get request
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://ergast.com/api/f1/current/driverStandings.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            // Executing the request
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            // Getting the response and setting it in an array
            $response = json_decode($response, true);
            
            // Looping through response to put the response in the array
            foreach ($response['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'] as $result) {
                // Filling the Driver
                $Driver = new Driver($result['Driver']['driverId'], $result['Driver']['permanentNumber'], $result['Driver']['code'], $result['Driver']['url'], $result['Driver']['givenName'], $result['Driver']['familyName'], $result['Driver']['dateOfBirth'], $result['Driver']['nationality']);

                // Filling the Constructor
                $Constructor = new Constructor($result['Constructors'][0]['constructorId'], $result['Constructors'][0]['url'], $result['Constructors'][0]['name'], $result['Constructors'][0]['nationality']);

                // Filling the DriverStandings
                $DriverStandings = new DriverStandings($result['position'], $result['positionText'], $result['points'], $result['wins'], $Driver, $Constructor);
                array_push($standings, $DriverStandings);
            }

            // Returning the full list
            return $standings;
        }

        /**
         * Function to get the current constructor championship results of the api
         * 
         * @return $standings. Array with all information over the constructor standings
         */
        public function getConstructorStandings() {
            // Creating an array for the results to fill it later
            $standings = array();

            // Setting up the get request
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://ergast.com/api/f1/current/constructorStandings.json",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            // Executing the request
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            // Getting the response and setting it in an array
            $response = json_decode($response, true);
            
            // Looping through response to put the response in the array
            foreach ($response['MRData']['StandingsTable']['StandingsLists'][0]['ConstructorStandings'] as $result) {
                // Filling the Constructor
                $Constructor = new Constructor($result['Constructor']['constructorId'], $result['Constructor']['url'], $result['Constructor']['name'], $result['Constructor']['nationality']);

                // Filling the DriverStandings
                $ConstructorStandings = new ConstructorStandings($result['position'], $result['positionText'], $result['points'], $result['wins'], $Constructor);
                array_push($standings, $ConstructorStandings);
            }

            // Returning the full list
            return $standings;
        }

        /**
         * Function to get the result of a season
         * 
         * @return resultListSeason a list with all results of the season
         */
        public function getResultsSeason($season) {
            // Creating arrays for the results to fill it later
            $resultsSeason = array();

            // variable for the offset in the result of the api
            $round = 0;

            // Setting up the get request
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://ergast.com/api/f1/". $season ."/results.json?limit=1000",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
            ));

            // Executing the request
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            // Getting the response and setting it in an array
            $response = json_decode($response, true);
            
            // Looping through response to put the response in the array
            foreach ($response['MRData']['RaceTable']['Races'] as $result) {
                // Creating the array here to reset them every loop
                $resultsRace = array();
                $resultsObjectRace = array();

                // Filling the array for results
                $resultsRace = $result['Results'];

                $resultsObjectRace = $this->fillResultsRaceSeason($resultsRace, $resultsObjectRace, $round, 0);

                // Filling the location object
                $location = new Location($result['Circuit']['Location']['lat'], $result['Circuit']['Location']['long'], $result['Circuit']['Location']['locality'], $result['Circuit']['Location']['country']);

                // Filling the circuit object
                $circuit = new Circuit($result['Circuit']['circuitId'], $result['Circuit']['url'], $result['Circuit']['circuitName'], $location);

                // Filling the race object
                $race = new Race($result['season'], $result['round'], $result['url'], $result['raceName'], $circuit, $result['date'], $result['time'], $resultsObjectRace);
                array_push($resultsSeason, $race);
            }

            // Returning the filled list
            return $resultsSeason;
        }

        /**
         * Funtion to fill the results object of the race
         * This function support getResultsSeason to make sure it stays clean
         * 
         * @param resultsRace is the array with the results
         * @param resultsObjectRace is the array with the results in the object. This is the array being filled
         * @param round is the round of the season. This is also the offset for the races
         * @param resultOffset is the offset for the results
         * 
         * @return resultsRace the filled array with the results of the race */
        private function fillResultsRaceSeason($resultsRace, $resultsObjectRace, $round, $resultOffset) {
            if ($resultOffset < count($resultsRace)){
                // Getting the array offset
                $singleResultRace = $resultsRace[$resultOffset];

                // Filling the driver object, permanentnumber can be null
                $driver = new Driver($singleResultRace['Driver']['driverId'], null, $singleResultRace['Driver']['code'], $singleResultRace['Driver']['url'], $singleResultRace['Driver']['givenName'], $singleResultRace['Driver']['familyName'], $singleResultRace['Driver']['dateOfBirth'], $singleResultRace['Driver']['nationality']);
                if (!empty($singleResultRace['Driver']['permanentNumber'])) {
                    $driver->setPermanentNumber($singleResultRace['Driver']['permanentNumber']);
                }

                // Filling the constructor object
                $constructor = new Constructor($singleResultRace['Constructor']['constructorId'], $singleResultRace['Constructor']['url'], $singleResultRace['Constructor']['name'], $singleResultRace['Constructor']['nationality']);

                // Filling the time object, can be null
                $timeFinish = new Time(null, null);
                if(!empty($singleResultRace['Time'])) {
                    $timeFinish->setMillis($singleResultRace['Time']['millis']);
                    $timeFinish->setTime($singleResultRace['Time']['time']);
                }

                // Filling the fastest lap time object, can be null
                $timeFastestLap = new Time(null, null);
                if (!empty($singleResultRace['FastestLap']['Time'])) {
                    $timeFastestLap->setTime($singleResultRace['FastestLap']['Time']['time']);
                }

                // Filling the averagespeed object, can be null
                $averagespeed = new AverageSpeed(null, null);
                if(!empty($singleResultRace['FastestLap']['AverageSpeed'])) {
                    $averagespeed->setUnits($singleResultRace['FastestLap']['AverageSpeed']['units']);
                    $averagespeed->setSpeed($singleResultRace['FastestLap']['AverageSpeed']['speed']);
                }

                // Filling the fastestlap object, can be null
                $fastestlap = new FastestLap(null, null, null, null);
                if (!empty($singleResultRace['FastestLap'])) {
                    $fastestlap->setRank($singleResultRace['FastestLap']['rank']);
                    $fastestlap->setLap($singleResultRace['FastestLap']['rank']);
                    $fastestlap->setTime($timeFastestLap);
                    $fastestlap->setAverageSpeed($averagespeed);
                }

                // Filling the result object
                $raceResult = new Result($singleResultRace['number'], $singleResultRace['position'], $singleResultRace['positionText'], $singleResultRace['points'], $driver, $constructor, $singleResultRace['grid'], $singleResultRace['laps'], $singleResultRace['status'], $timeFinish, $fastestlap);
                array_push($resultsObjectRace, $raceResult);

                // Going through the function again with diffrent number
                $resultOffset++;
                return $this->fillResultsRaceSeason($resultsRace, $resultsObjectRace, $round, $resultOffset);
            } else {
                // Returning the filled array
                return $resultsObjectRace;
            }
        }
    }  
?>