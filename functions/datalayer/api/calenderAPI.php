<?php
    class CalenderAPI {
        
        /**
         * Function to get the calender of the current season
         * 
         * @return calender an array with all Grand Prixs on the current season calender
         */
        public function getCalenderCurrentSeason() {
            // Creating an array for the results to fill it later
            $calender = array();

            // Setting up the get request
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://ergast.com/api/f1/current.json",
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
                // Filling the Location
                $Location = new Location($result['Circuit']['Location']['lat'], $result['Circuit']['Location']['long'], $result['Circuit']['Location']['locality'], $result['Circuit']['Location']['country']);

                // Filling the Circuit
                $Circuit = new circuit($result['Circuit']['circuitId'], $result['Circuit']['url'], $result['Circuit']['circuitName'], $Location);

                // Filling the calender
                $calenderModel = new Race($result['season'], $result['round'], $result['url'], $result['raceName'], $Circuit, $result['date'], $result['time'], null);
                array_push($calender, $calenderModel);
            }

            // returning the filled calender
            return $calender;
        }
    }  
?>