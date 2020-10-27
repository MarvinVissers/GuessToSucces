<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/database.php");

    class PasswordResetDB {

        // Creating variable for database connection
        private $db; 
    
        /* Creating a new instance of PasswordResetDB */
        public function __construct() {
            // Making a connection with the database
            $database = new Database();
            $this->db = $database->getConnection();
        }

        /**
         * Funtion to delete any reset links the user had
         * 
         * @return true if all reset links were deleted
         * @return false if something went wrong
         */
        public function addPasswordResetLink($passwordResetModel) {
            // Creating variables to use in the query's
            $userID = $passwordResetModel->getUserID();
            $selector = $passwordResetModel->getSelector();
            $token = $passwordResetModel->getToken();
            $linkExpires = $passwordResetModel->getLinkExpires();

            // Hashing the token
            $hashedToken = password_hash($token, PASSWORD_DEFAULT);

            // Query to first delete all password reset links of the user to then add one
            $query = "START TRANSACTION;
                      DELETE FROM passwordreset WHERE userID = ?;
                      INSERT INTO passwordreset(userID, selector, token, linkExpires) VALUES(?, ?, ?, ?);
                      COMMIT;";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $userID);
            $stm->bindParam(2, $userID);
            $stm->bindParam(3, $selector);
            $stm->bindParam(4, $hashedToken);
            $stm->bindParam(5, $linkExpires);
            if ($stm->execute()) {
                // Returning true if the query executed
               return true;
            }

            // Returning false if something went wrong
            return false;
        }

        /**
         * Function to check if the reset link is valid
         * 
         * @return true if link is valid
         * @return false if link is not valid
         */
         public function checkValidResetLink($passwordResetModel) {
            // Making variables to use in the query
            $selector = $passwordResetModel->getSelector();
            $token = $passwordResetModel->getToken();
            $linkExpires = date("U");

            // Setting the token to Binary like in the database
            $tokenBin = hex2bin($token);

            // Query to get the links where selector is equal and link expires is smaller than now
            $query = "SELECT * FROM passwordreset WHERE selector = ? AND linkExpires > ?";
            $stm = $this->db->prepare($query);
            $stm->bindParam(1, $selector);
            $stm->bindParam(2, $linkExpires);
            if ($stm->execute()) {
                // Getting the results
                $result = $stm->fetch(PDO::FETCH_OBJ);

                // Getting the token of the database
                $tokenDB = $result->token;

                // Checking if token is equal to the database token
                if (password_verify($tokenBin, $tokenDB)) {
                    // Filling the passwordReset model
                    $passwordResetModel->setID($result->ID);
                    $passwordResetModel->setUserID($result->userID);
                    $passwordResetModel->setLinkExpires($result->linkExpires);
                    
                    // Link is valid
                    return true;
                } else {
                    // Link is invalid
                    return false;
                }
            } else {
                // Returning false if query failed
                return false;
            }
        }
    }
?>
