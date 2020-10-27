<?php
    /**
     * @author Marvin Vissers
     */

    class OddsController {
    
        // Creating variables for in the class
        private $currentYear;
        private $offsetYear;
        private $multiplier;

        /* Creating a new instance of OddsController */
        public function __construct() {
            // Adding values to the variabels
            $this->currentYear = date("Y");
            $this->offsetYear = 0;
            $this->multiplier = 1;
        }

        /**
         * Functions to get the odds for the driver winnar
         * 
         * @param results an array with results of the last past years. Count is on season
         * @param listOddsDriverWinnar an array with the odds of the driver winning
         * @param gridList an array with all drivers on the grid
         * @param circuitId the circuit on wich will be raced
         * @param offset the offset of the gridlist
         * 
         * @return listOddsDriverWinnar list with the odds for the driver winnar 
         */
        public function getOddsDriverWinnar($results, $listOddsDriverWinnar, $gridList, $circuitId, $offset) {  
            // Checking if offset is smaller than driver on the grid                     
            if ($offset < count($gridList)) {
                // Getting the offset of the grid
                $gridListOffset = $gridList[$offset];

                // Getting the variabels for the function
                $driver = $gridListOffset;

                if (!empty($resultsDriver)) {
                    unset($resultsDriver);
                }

                $resultsDriver = array();

                // Getting the finishes of the driver
                $driverResults = $this->getPositions($results, $driver, null, 0, $this->offsetYear, $circuitId, $this->multiplier, $resultsDriver, null, 1);
                array_push($resultsDriver, $driverResults);

                // Calculating the average position of the driver
                $oddsDriver = @$this->calculateAveragePosistion($resultsDriver, null, 0, 0, count($results), $driver, null, 1);
                array_push($listOddsDriverWinnar, $oddsDriver);

                // Updating variables for the function
                $offset++;
                return $this->getOddsDriverWinnar($results, $listOddsDriverWinnar, $gridList, $circuitId, $offset);
            } else {
                // Sorting the array from lowest to highest odds
                usort($listOddsDriverWinnar, array($this, "compareOdds")); 

                // Returning the filled array
                return $listOddsDriverWinnar;
            }
        }

        /**
         * Functions to get the odds for the constructor winnar
         * 
         * @param results the results of the formule1 the past years
         * @param listOddsConstructorWinnar an array with the odds for the constructor winnar
         * @param gridList an array with an constructors on the grid
         * @param circuitId the circuit on wich is raced
         * @param offset the offset of the gridList
         * 
         * @return listOddsConstructorWinnar list with the odds for the constructor winnar 
         */
        public function getOddsConstructorWinnar($results, $listOddsConstructorWinnar, $gridList, $circuitId, $offset) {
            // Checking if offset is smaller than constructors on the grid
            if ($offset < count($gridList)) {
                // Getting the offset of the grid
                $gridListOffset = $gridList[$offset];

                // Getting the variabels for the function
                $constructor = $gridListOffset;

                if (!empty($resultsConstructor)) {
                    unset($resultsConstructor);
                }

                $resultsConstructor = array();

                // Getting the finishes of the driver
                $constructorResults = $this->getPositions($results, null, $constructor, 0, $this->offsetYear, $circuitId, $this->multiplier, null, $resultsConstructor, 2);
                array_push($resultsConstructor, $constructorResults);

                // Calculating the average position of the driver
                $oddsConstructor = @$this->calculateAveragePosistion(null, $resultsConstructor, 0, 0, count($results), null, $constructor, 2);
                array_push($listOddsConstructorWinnar, $oddsConstructor);

                // Updating variables for the function
                $offset++;
                return $this->getOddsConstructorWinnar($results, $listOddsConstructorWinnar, $gridList, $circuitId, $offset);
            } else {
                // Sorting the array from lowest to highest odds
                usort($listOddsConstructorWinnar, array($this, "compareOdds")); 

                // Returning the filled array
                return $listOddsConstructorWinnar;
            }
        }

        /**
         * Functions to get the odds for the driver fastest lap
         * 
         * @param results the results of the formule1 the past years
         * @param listOddsDriverFastestLap an array with the odds for the driver fastest lap
         * @param gridList an array with an driver on the grid
         * @param circuitId the circuit on wich is raced
         * @param offset the offset of the gridList
         * 
         * @return listOddsDriverFastestLap list with the odds for the driver fastest lap 
         */
        public function getOddsDriverFastestLap($results, $listOddsDriverFastestLap, $gridList, $circuitId, $offset) {
            // Checking if offset is smaller than driver on the grid
            if ($offset < count($gridList)) {
                // Getting the offset of the grid
                $gridListOffset = $gridList[$offset];

                // Getting the variabels for the function
                $driver = $gridListOffset;

                if (!empty($resultsDriver)) {
                    unset($resultsDriver);
                }

                $resultsDriver = array();

                // Getting the finishes of the driver
                $driverResults = $this->getPositions($results, $driver, null, 0, $this->offsetYear, $circuitId, $this->multiplier, $resultsDriver, null, 3);
                array_push($resultsDriver, $driverResults);

                // Calculating the average position of the driver
                $oddsDriver = @$this->calculateAveragePosistion($resultsDriver, null, 0, 0, count($results), $driver, null, 3);
                array_push($listOddsDriverFastestLap, $oddsDriver);

                // Updating variables for the function
                $offset++;
                return $this->getOddsDriverFastestLap($results, $listOddsDriverFastestLap, $gridList, $circuitId, $offset);
            } else {
                // Sorting the array from lowest to highest odds
                usort($listOddsDriverFastestLap, array($this, "compareOdds")); 

                // Returning the filled array
                return $listOddsDriverFastestLap;
            }
        }

        /**
         * Functions to get the odds for the constructor fastest lap
         * 
         * @param results the results of the formule1 the past years
         * @param listOddsConstructorFastestLap an array with the odds for the constructor fastest lap
         * @param gridList an array with an constructors on the grid
         * @param circuitId the circuit on wich is raced
         * @param offset the offset of the gridList
         * 
         * @return listOddsConstructorFastestLap list with the odds for the constructor fastest lap 
         */
        public function getOddsConstructorFastestLap($results, $listOddsConstructorFastestLap, $gridList, $circuitId, $offset) {
            // Checking if offset is smaller than constructors on the grid
            if ($offset < count($gridList)) {
                // Getting the offset of the grid
                $gridListOffset = $gridList[$offset];

                // Getting the variabels for the function
                $constructor = $gridListOffset;

                if (!empty($resultsConstructor)) {
                    unset($resultsConstructor);
                }

                $resultsConstructor = array();

                // Getting the finishes of the driver
                $constructorResults = $this->getPositions($results, null, $constructor, 0, $this->offsetYear, $circuitId, $this->multiplier, null, $resultsConstructor, 4);
                array_push($resultsConstructor, $constructorResults);

                // Calculating the average position of the driver
                $oddsConstructor = @$this->calculateAveragePosistion(null, $resultsConstructor, 0, 0, count($results), null, $constructor, 4);
                array_push($listOddsConstructorFastestLap, $oddsConstructor);

                // Updating variables for the function
                $offset++;
                return $this->getOddsConstructorFastestLap($results, $listOddsConstructorFastestLap, $gridList, $circuitId, $offset);
            } else {
                // Sorting the array from lowest to highest odds
                usort($listOddsConstructorFastestLap, array($this, "compareOdds")); 

                // Returning the filled array
                return $listOddsConstructorFastestLap;
            }
        }

        /**
         * Function to loop through the results and calculate the average position
         * 
         * @param resultsDriver the results of the driver
         * @param resultsConstructor the results of the constructor
         * @param offset the offset of the season
         * @param totalPosition the total position of the driver/constructor
         * @param season the season of with results
         * @param driver the driver object
         * @param constructor the constructor object
         * @param categorie the categorie of the odds
         * 
         * @return oddsDriver the odds of the driver
         * @return oddsConstructor the odds of the constructor
         */
        private function calculateAveragePosistion($resultsDriver, $resultsConstructor, $offset, $totalPositions, $seasons, $driver, $constructor, $categorie) {   
            // Checking if the result of the driver is empty
            if (!empty($resultsDriver)) {
                // Looping throug the results of the season
                if ($offset < $seasons) {
                    // Looping through the results of the driver
                    foreach ($resultsDriver[0][$offset] as $result) {
                        $totalPositions += $result->getPosition();
                    }

                    // Updating the variables for the function
                    $offset++;
                    return $this->calculateAveragePosistion($resultsDriver, $resultsConstructor, $offset, $totalPositions, $seasons, $driver, $constructor, $categorie);
                } else {
                    // Calculating the average position
                    $odds = $totalPositions / 10;

                    // Setting the odds
                    $oddsDriver = new Odds($odds, null, $driver, null, null, $this->currentYear);

                    // checking the categorie
                    if ($categorie == 1) {
                        $oddsDriver->setCategorie(1);
                    } else {
                        $oddsDriver->setCategorie(3);
                    }

                    return $oddsDriver;
                }
            } else if (!empty($resultsConstructor)) {
                if ($offset < count($offset)) {
                    // Looping throug the results of the season
                    if ($offset < $seasons) {
                        // Looping through the results of the driver
                        foreach ($resultsConstructor[0][$offset] as $result) {
                            $totalPositions += $result->getPosition();
                        }

                        // Updating the variables for the function
                        $offset++;
                        return $this->calculateAveragePosistion($resultsDriver, $resultsConstructor, $offset, $totalPositions, $seasons, $driver, $constructor, $categorie);
                    }
                } else {
                    // Calculating the average position
                    $odds = $totalPositions / 10;

                    // Setting the odds
                    $oddsConstructor = new Odds($odds, null, null, $constructor, null, $this->currentYear);

                    // checking the categorie
                    if ($categorie == 2) {
                        $oddsConstructor->setCategorie(1);
                    } else {
                        $oddsConstructor->setCategorie(3);
                    }

                    return $oddsConstructor;
                }
            }
        }

        /**
         * Function to check wich of the odds is lower
         * 
         * @param odd1 the odds of the first driver/constructor
         * @param odd2 the odds of the second driver/constructor
         * 
         * @return odd2 the odds of the first driver/constructor
         */
        private function compareOdds ($odd1, $odd2) {
            return $odd1->getOdds() > $odd2->getOdds(); 
        }

        /**
         * Function to loop through this season and the last 5 seasons
         * 
         * @param results an array with all results
         * @param driver driver object
         * @param constructor the constructor object
         * @param raceOffset the offset of the races in the array
         * @param season the season of the results
         * @param circuitId the circuit on wich is raced
         * @param multiplier the multiplier for the results
         * @param resultsDriver the array with the results of the driver
         * @param resultsConstructor the array with the results of the constructor
         * @param categorie the categorie of the odds
         * 
         * @return resultsDriver the array with the resutls of the constructor
         * @return resultsConstructor the array with the resutls of the constructor
         */
        private function getPositions($results, $driver, $constructor, $raceOffset, $season, $circuitId, $multiplier, $resultsDriver, $resultsConstructor, $categorie) {
            // Checking the categorie, 1 and 3 are driver categories
            if ($categorie == 1 || $categorie == 3) {
                // Checking if a row in the array is unchecked
                if ($season < count($results)) {
                    // Getting the array offset
                    $resultSeason = $results[$season];

                    // Getting the rounds of the season
                    $seasonRounds = count($resultSeason);

                    // Calling the loop through season
                    $driverResults = $this->loopThroughSeason($driver, $constructor, $resultSeason, $seasonRounds, $circuitId, $resultsDriver, $resultsConstructor, $categorie);
                    array_push($resultsDriver, $driverResults);

                    // Updating variables for the function
                    $season++;
                    return $this->getPositions($results, $driver, $constructor, $raceOffset, $season, $circuitId, $multiplier, $resultsDriver, $resultsConstructor, $categorie);
                } else {
                    return $resultsDriver;
                }
            } else {
                // Checking if a row in the array is unchecked
                if ($season < count($results)) {
                    // Getting the array offset
                    $resultSeason = $results[$season];

                    // Getting the rounds of the season
                    $seasonRounds = count($resultSeason);

                    // Calling the loop through season
                    $constructorResults = $this->loopThroughSeason($driver, $constructor, $resultSeason, $seasonRounds, $circuitId, $resultsDriver, $resultsConstructor, $categorie);
                    array_push($resultsConstructor, $constructorResults);

                    // Updating variables for the function
                    $season++;
                    return $this->getPositions($results, $driver, $constructor, $raceOffset, $season, $circuitId, $multiplier, $resultsDriver, $resultsConstructor, $categorie);
                } else {
                    return $resultsConstructor;
                }
            }
        }

        /**
         * Function to loop throug a single season
         * 
         * @param driver driver object
         * @param constructor constructor object
         * @param resultSeason the results of the season, in array form
         * @param seasonRounds the rounds of the season
         * @param raceOffset the offset of the races in the array
         * @param circuitId the circuit on wich is raced
         * @param multiplier the multiplier for the results
         * @param resultsDriver the array with the results of the driver
         * @param resultsConstructor the results of the constructor
         * @param categorie the categorie of the odds
         * 
         * @return resultsDriver the array with the results of the driver
         * @return resultsConstructor the array with the best results of the constructor
         */
        private function loopThroughSeason($driver, $constructor, $resultSeason, $seasonRounds, $circuitId, $resultsDriver, $resultsConstructor, $categorie) {
            // Checking the categorie, 1 and 3 are driver categories
            if ($categorie == 1 || $categorie == 3) {
                if (!empty($resultsDriver)) {
                    unset($resultsDriver);

                    $resultsDriver = array();
                }

                // Looping through all the races
                for ($i=0; $i < $seasonRounds; $i++) { 
                    $driverResults = array();
                    $result = false;

                    if ($resultSeason[$i]->getSeason() == $this->currentYear) {
                        // In the current year we take every race in account
                        $resultsRace = $resultSeason[$i]->getResults();
                        $raceSeason = $resultSeason[$i]->getSeason();

                        // Looping through the resutls
                        $driverResults = $this->loopThroughRace($driver, $constructor, $resultsRace, 0, $circuitId, $this->multiplier, $resultsDriver, true, $raceSeason, $categorie);
                        
                        $result = true;
                    } 
                    if ($resultSeason[$i]->getCircuit()->getCircuitId() == $circuitId && $this->currentYear != $resultSeason[$i]->getSeason()) {
                        // Else only where the circuit is equal to where is raced
                        $resultsRace = $resultSeason[$i]->getResults();
                        $raceSeason = $resultSeason[$i]->getSeason();

                        // Looping through the resutls
                        $driverResults = $this->loopThroughRace($driver, $constructor, $resultsRace, 0, $circuitId, $this->multiplier, $resultsDriver, false, $raceSeason, $categorie);
                        
                        $result = true;
                    }

                    // Checking if result was found
                    if ($result) {
                        // Checking if it is the current season if so, return right away
                        if ($this->currentYear != $resultSeason[$i]->getSeason()) {
                            // Pushing the results to the array
                            array_push($resultsDriver, $driverResults);

                            // Returning the filled array
                            return $resultsDriver;
                        } else {
                            // Pushing the results to the array
                            array_push($resultsDriver, $driverResults);
                        }
                    }
                }

                // Returning the filled array
                return $resultsDriver;
            } else {
                // Checking if the constructor results are filled
                if (!empty($constructorResults)) {
                    unset($constructorResults);

                    $constructorResults = array();
                }

                // Looping through all the races
                for ($i=0; $i < $seasonRounds; $i++) { 
                    $constructorResults = array();
                    $result = false;

                    if ($resultSeason[$i]->getSeason() == $this->currentYear) {
                        // In the current year we take every race in account
                        $resultsRace = $resultSeason[$i]->getResults();
                        $raceSeason = $resultSeason[$i]->getSeason();

                        // Looping through the resutls
                        $constructorResults = $this->loopThroughRace($driver, $constructor, $resultsRace, 0, $circuitId, $this->multiplier, $resultsDriver, true, $raceSeason, $categorie);
                        
                        $result = true;
                    } 
                    if ($resultSeason[$i]->getCircuit()->getCircuitId() == $circuitId && $this->currentYear != $resultSeason[$i]->getSeason()) {
                        // Else only where the circuit is equal to where is raced
                        $resultsRace = $resultSeason[$i]->getResults();
                        $raceSeason = $resultSeason[$i]->getSeason();

                        // Looping through the resutls
                        $constructorResults = $this->loopThroughRace($driver, $constructor, $resultsRace, 0, $circuitId, $this->multiplier, $resultsDriver, false, $raceSeason, $categorie);
                        
                        $result = true;
                    }

                    // Checking if result was found
                    if ($result) {
                        // Checking if it is the current season if so, return right away
                        if ($this->currentYear != $resultSeason[$i]->getSeason()) {
                            // Pushing the results to the array
                            array_push($resultsConstructor, $constructorResults);

                            // Returning the filled array
                            return $resultsConstructor;
                        } else {
                            // Pushing the results to the array
                            array_push($resultsConstructor, $constructorResults);
                        }
                    }
                }

                // Returning the filled array
                return $resultsConstructor;
            }
        }

        /**
         * Function to loop through the results of 1 season
         * 
         * @param driver driver object
         * @param constructor constructor object
         * @param resultsRace the results of the race, in array form
         * @param resultsOffset the offset of the results in the array
         * @param circuitId the circuit on wich is raced
         * @param multiplier the multiplier for the results
         * @param resultsDriver the array with the results of the driver
         * @param currentseason boolean to check if the season is the current season
         * @param raceSeason the season of the race
         * @param categorie the categorie of the odds
         * 
         * @return resultsDriver the array with the results of the driver or best results of the constructor
         */
        private function loopThroughRace($driver, $constructor, $resultsRace, $resultsOffset, $circuitId, $multiplier, $resultsDriver, $currentSeason, $raceSeason, $categorie) {
            // Checking the categorie, 1 and 3 are driver categories
            if ($categorie == 1 || $categorie == 3) {
                // Checking if the results array is empty
                if (!empty($resultsDriver)) {
                    unset($resultsDriver);
                }
                $resultsDriver = array();

                // Checking if the driver is equal to the driver the calcution is for
                if ($resultsOffset < count($resultsRace)) {
                    $driverResult = $resultsRace[$resultsOffset];

                    // Checking if the results are from the right driver
                    if ($driverResult->getDriver()->getDriverId() == $driver->getDriverId()) {

                        if($currentSeason === true){
                            // Checking the categorie
                            if ($categorie == 1) {
                                // Driver winnar categorie
                                // Filling the odds object and putting it in the array
                                $positionDriver = new Odds(null, 1, $driver, null, $driverResult->getPosition(), $raceSeason);
                            } else {
                                // Driver fastest lap categorie
                                // Filling the odds object and putting it in the array
                                $positionDriver = new Odds(null, 1, $driver, null, $driverResult->getFastestLap()->getRank(), $raceSeason);
                            }

                            // Returning the position
                            return $positionDriver;
                        } else {
                            // Updating the multiplier, this makes later result count less heavy towards succes
                            $multiplier += 0.5;

                            // Checking the categorie
                            if ($categorie == 1) {
                                // Driver winnar categorie
                                // Setting the position
                                $position = $driverResult->getPosition() * $multiplier;

                                // Filling the odds object and putting it in the array
                                $positionDriver = new Odds(null, 1, $driver, null, $position, $raceSeason);
                            } else {
                                // Driver fastest lap categorie
                                // Setting the position
                                $position = $driverResult->getPosition() * $multiplier;

                                // Filling the odds object and putting it in the array
                                $positionDriver = new Odds(null, 1, $driver, null, $position, $raceSeason);
                            }

                            // Returning the position
                            return $positionDriver; 
                        }
                    }

                    // Updating the variables
                    $resultsOffset++;
                    return $this->loopThroughRace($driver, $constructor, $resultsRace, $resultsOffset, $circuitId, $multiplier, $resultsDriver, $currentSeason, $raceSeason, $categorie);
                } else {
                    // Odds object voor lege driver vullen
                    // Updating the multiplier, this makes later result count less heavy towards succes
                    $multiplier += 0.5;
                    $position = 20 * $multiplier;

                    if ($categorie == 1) {
                        // Filling the odds object and putting it in the array
                        $positionDriver = new Odds(null, 1, $driver, null, $position, $raceSeason);
                    } else {
                        // Filling the odds object and putting it in the array
                        $positionDriver = new Odds(null, 3, $driver, null, $position, $raceSeason);
                    }

                    return $positionDriver; 
                }
            } else {
                // Checking if the results array is empty
                if (!empty($resultsContructor)) {
                    unset($resultsContructor);
                }
                $resultsContructor = array();

                // Checking if the driver is equal to the driver the calcution is for
                if ($resultsOffset < count($resultsRace)) {
                    $resultsContructor = $resultsRace[$resultsOffset];

                    // Checking if the results are from the right driver
                    if ($resultsContructor->getConstructor()->getConstructorId() == $constructor->getConstructorId()) {

                        if($currentSeason === true){
                            // Checking the categorie
                            if ($categorie == 2) {
                                // Constructor winnar categorie
                                // Filling the odds object and putting it in the array
                                $positionConstructor = new Odds(null, 2, null, $constructor, $resultsContructor->getPosition(), $raceSeason);
                            } else {
                                // Constructor fastest lap categorie
                                // Filling the odds object and putting it in the array
                                $positionConstructor = new Odds(null, 4, null, $constructor, $resultsContructor->getFastestLap()->getRank(), $raceSeason);
                            }

                            return $positionConstructor;
                        } else {
                            // Updating the multiplier, this makes later result count less heavy towards succes
                            $multiplier += 0.5;

                            if ($categorie == 2) {
                                // Constructor winnar categorie
                                $position = $resultsContructor->getPosition() * $multiplier;

                                // Filling the odds object and putting it in the array
                                $positionConstructor = new Odds(null, 2, null, $constructor, $resultsContructor->getPosition(), $raceSeason);
                            } else {
                                // Constructor fastest lap categorie
                                $position = $resultsContructor->getPosition() * $multiplier;

                                // Filling the odds object and putting it in the array
                                $positionConstructor = new Odds(null, 4, null, $constructor, $resultsContructor->getFastestLap()->getRank(), $raceSeason);
                            }

                            return $positionConstructor; 
                        }
                    }

                    // Updating the variables
                    $resultsOffset++;
                    return $this->loopThroughRace($driver, $constructor, $resultsRace, $resultsOffset, $circuitId, $multiplier, $resultsDriver, $currentSeason, $raceSeason, $categorie);
                } else {
                    // Odds object voor lege constructor vullen
                    // Updating the multiplier, this makes later result count less heavy towards succes
                    $multiplier += 0.5;
                    $position = 20 * $multiplier;

                    // Checking the categorie
                    if ($categorie == 2) {
                        // Filling the odds object and putting it in the array
                        $positionConstructor = new Odds(null, 2, null, $constructor, $position, $raceSeason);
                    } else {
                        // Filling the odds object and putting it in the array
                        $positionConstructor = new Odds(null, 4, null, $constructor, $position, $raceSeason);
                    }

                    return $positionConstructor; 
                }
            }
        }
    }
?>