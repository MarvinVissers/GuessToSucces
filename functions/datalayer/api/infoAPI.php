<?php
    class InfoAPI {
        
        /**
         * Function to get the drivers for the bets
         * 
         * @return Drivers an array with all drivers
         */
        public function getDrivers($season) {
            // Creating an array for the results to fill it later
            $drivers = array();

            // Setting up the get request
            $curl = curl_init();

            if (strcmp($season, 'current') == 0) {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://ergast.com/api/f1/current/drivers.json?limit=50",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));
            } else {
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://ergast.com/api/f1/drivers.json?limit=1000",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));
            }

            // Executing the request
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            // Getting the response and setting it in an array
            $response = json_decode($response, true);

            // Looping through response to put the response in the array
            foreach ($response['MRData']['DriverTable']['Drivers'] as $result) {
                // Filling the Driver model
                $driver = new Driver($result['driverId'], null, null, $result['url'], $result['givenName'], $result['familyName'], $result['dateOfBirth'], $result['nationality']);

                array_push($drivers, $driver);
            }

            // returning the filled array with Drivers
            return $drivers;
        }

        /**
         * Function to get the constructors for the bets
         * 
         * @return Constructors an array with all drivers
         */
        public function getConstructors($season) {
            // Creating an array for the results to fill it later
            $constructors = array();

            // Setting up the get request
            $curl = curl_init();

            // Checking the season
            if (strcmp($season, 'current') == 0) {
                // calling for current season constructors
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://ergast.com/api/f1/current/constructors.json?limit=20",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));
            } else {
                // Calling for all constructors
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://ergast.com/api/f1/constructors.json?limit=1000",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                ));
            }

            // Executing the request
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            // Getting the response and setting it in an array
            $response = json_decode($response, true);

            // Looping through response to put the response in the array
            foreach ($response['MRData']['ConstructorTable']['Constructors'] as $result) {
                // Filling the Driver model
                $constructor = new Constructor($result['constructorId'], $result['url'], $result['name'], $result['nationality']);

                array_push($constructors, $constructor);
            }

            // returning the filled array with Drivers
            return $constructors;
        }
    }  
?>