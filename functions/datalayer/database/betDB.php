<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/database.php");

    class BetDB {

        // Creating variables for the database connection
        private $db;   
    
        /* Creating a new instance of BetDB */
        public function __construct() {
            $database = new Database();
            $this->db = $database->getConnection();
        }
        
        /**
         * Function to get the achievements of the user
         * 
         * @return betsListUser a list with all the bets of the user
         */
        function getBetsUser($userModel, $status) {
            // Creating an array to fill it later
            $betsListUser = array();

            // Creating variables for in the query
            $userID = $userModel->getID();

            // Checking the status, status done means bets that aren't open anymore
            $query = null;

            // Checking the status
            if (strcmp($status, 'Open') == 0) {
                // Status is open
                // Query to get all bets of the user that are open
                $query = "SELECT bet.ID AS 'betID', bet.userID, bet.season, bet.grandPrix, bet.categorieID, cat.categorie, bet.points, bet.betOn, bet.odds, bet.status, bet.rewardPayed
                          FROM bet 
                          INNER JOIN categorie cat ON bet.categorieID = cat.ID
                          WHERE userID = ? AND status = 'Open'
                          ORDER BY bet.ID DESC";
            } else {
                // Query to get all bets of the user that are done
                $query = "SELECT bet.ID AS 'betID', bet.userID, bet.season, bet.grandPrix, bet.categorieID, cat.categorie, bet.points, bet.betOn, bet.odds, bet.status, bet.rewardPayed
                          FROM bet 
                          INNER JOIN categorie cat ON bet.categorieID = cat.ID
                          WHERE userID = ? AND status != 'Open'
                          ORDER BY bet.season DESC, bet.ID DESC";
            }

            // Executing the query
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            if ($stm->execute()) {
                // Getting all the encrypted emails
                $result = $stm->fetchAll(PDO::FETCH_OBJ);

                // Looping through the emails
                foreach ($result as $bet) {
                    // Filling the categorie model
                    $categorieModel = new Categorie($bet->categorieID, $bet->categorie);

                    // Filling the Bet model
                    $betModel = new Bet($bet->betID, $userModel, $bet->season, $bet->grandPrix, $categorieModel, $bet->points, $bet->betOn, $bet->odds, $bet->status, $bet->rewardPayed);
                    array_push($betsListUser, $betModel);
                }
            }
            
            // Returning the filled array
            return $betsListUser;
        }

        /**
         * Function to the categories
         * 
         * @return categoriesList an array with all categories
         */
        public function getCategories() {
            // Creating the array
            $categoriesList = array();

            // Making a query to get all categories
            $query = "SELECT * FROM categorie ORDER BY ID ASC";
            $stm = $this->db->prepare($query);
            if ($stm->execute()) {
                // Getting all the encrypted emails
                $result = $stm->fetchAll(PDO::FETCH_OBJ);

                // Looping through the emails
                foreach ($result as $categorie) {
                    // Filling the categorie Model
                    $categorieModel = new Categorie($categorie->ID, $categorie->categorie);
                    array_push($categoriesList, $categorieModel);
                }
            }

            // Returning the filled list
            return $categoriesList;
        }

        /**
         * Function to delete open bet of user
         * 
         * @return true if query is executed
         * @return false if something goes wrong
         */
        public function deleteBet($betID, $betPoints, $userModel) {
            // Creating variables for in the query
            $userID = $userModel->getID();
            $points = $userModel->getPoints() + $betPoints;

            // Making a query to delete the bet
            $query = "START TRANSACTION;
                      DELETE FROM bet WHERE ID = ?;
                      UPDATE user SET points = ? WHERE ID = ?;
                      COMMIT;";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $betID);
            $stm->bindParam(2, $points);
            $stm->bindParam(3, $userID);

            // Checking if the query executed
            if ($stm->execute()) {
                return true;
            } else {
                return false;
            }
        }

        /**
         * Function to update an open bet
         * 
         * @return true if query is executed
         * @return false if something goes wrong
         */
        public function updateBet($betID, $betOnId, $betPointsNew, $betPointsOld, $userModel) {
            // Making variabels for the query
            $userID = $userModel->getID();
            $totalUserPoints = $userModel->getPoints() + $betPointsOld;
            $userPointsMinusBetPoints = $totalUserPoints - $betPointsNew;

            // Query to update the bet by first giving the user their points back to later take them from them
            $query = "START TRANSACTION;
                      UPDATE user SET points = ? WHERE ID = ?;
                      UPDATE bet SET points = ?, betOn = ? WHERE ID = ?;
                      UPDATE user SET points = ? WHERE ID = ?;
                      COMMIT;";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $totalUserPoints);
            $stm->bindParam(2, $userID);
            $stm->bindParam(3, $betPointsNew);
            $stm->bindParam(4, $betOnId);
            $stm->bindParam(5, $betID);
            $stm->bindParam(6, $userPointsMinusBetPoints);
            $stm->bindParam(7, $userID);
            
            echo $query;

            // Checking if query is executed
            if ($stm->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }  
?>