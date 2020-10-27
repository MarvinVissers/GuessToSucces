<?php
    /**
     * @author Marvin Vissers
     */

    // Linking to classes in the database layer
    require_once("../functions/datalayer/database/passwordResetDB.php");
    require_once("../functions/datalayer/database/userDB.php");
    // Linking to the helper classes
    require_once("../functions/helper/validate.php");
    require_once('../functions/helper/mailer.php');

    class PasswordResetController {

        // Creating variables for the importent files
        private $passwordResetDB;
        private $userDB;
        private $validate; 
        private $mailer;
    
        /* Creating a new instance of PasswordResetController */
        public function __construct() {
            $this->passwordResetDB = new PasswordResetDB();
            $this->userDB = new UserDB;
            $this->validate = new Validate();
            $this->mailer = new Mailer();
        }

        /**
         * Functions to send email to user to reset their password
         * 
         * @return true if reset link is made in the database and mail is send
         */
        public function sendPasswordResetLink($userModel) {
            // validating the username on the backend
            $validateUsername = $this->validate->validateInput($userModel->getUsername(), "/^[a-zA-Z0-9_.-]*$/", 1, 25);

            // Checking the result
            if ($validateUsername) {
                // Getting the user information
                $userModel = $this->userDB->getUserByUsername($userModel);

                // Creating a selector and token to verify the reset link
                $selector = bin2hex(random_bytes(8));
                $token = random_bytes(32);

                // Creating a expire date/time for the link
                $linkExpires = date("U") + 1800;

                // Filling the passwordReset model
                $passwordResetModel = new PasswordReset(null, $userModel->getID(), $selector, $token, $linkExpires);

                // Deleting any previous reset links, and inserting a new one
                $passwordResetLinkAdded = $this->passwordResetDB->addPasswordResetLink($passwordResetModel);

                // Checking the result of the function
                if ($passwordResetLinkAdded) {
                    /* 
                     * Setting up the mail
                     */ 
                    // Creating the reset url
                    $resetURL = "http://localhost:8000/guesstosucces/view/reset-password?selector=" . $selector . "&validator=" .bin2hex($token);

                    // Creating the body for the email
                    $mailBody = "
                        <body>
                            <h2 style='text-align:left; color:#212121; font-size:2.5rem; padding-bottom:20px; display:block; font-family: 'Open Sans', sans-serif', sans-serif;'>Change your password</h2>

                            <p style='font-size:16px; line-height:1.5; color:#212121; font-family: 'Open Sans', sans-serif; line-height:1.5;'>Use the link below to fill in a new password, this link will expire within 59 minutes of you receiving this mail. </p>
                            <p style='font-size:16px; line-height:1.5; color:#212121; font-family: 'Open Sans', sans-serif; line-height:1.5;'>Link: <a href='".$resetURL."' style='text-decoration: underline;'>".$resetURL."</a></p>
                        </body>
                    ";

                    /*
                     * Sending the email
                     */
                    $mailSend = $this->mailer->sendMail($userModel->getEmail(), "Reset your password", $mailBody);
                    
                    // Checking if mail is send
                    if ($mailSend) {
                        // Mail is send
                        return true;
                    } else {
                        // Something went wrong
                        echo '<script>location.replace("forgot-password?error=4");</script>';
                    }
                } else {
                    // Reloading the page with an error
                    header("Location: forgot-password?error=4");
                }
            } else {
                // Reloading the page with an error
                header("Location: forgot-password?error=2");
            }
        }

        /**
         * Function to check if the reset link is valid
         * 
         * @return true if link is valid
         * @return false if link is not valid
         */
        public function checkValidResetLink($passwordResetModel) {
            // Creating a variable to keep the function result in
            $selectorTokenExist = $this->passwordResetDB->checkValidResetLink($passwordResetModel);

            // checking result
            if ($selectorTokenExist) {
                return true;
            } else {
                return false;
            }
        }
    }
?>