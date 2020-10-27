<?php

require('PHPMailer/PHPMailerAutoload.php');

class Mailer {

    // Making a varible for PHPMailer
    private $mail;

    public function __construct() {
        $this->mail = new PHPMailer();
    }

    /**
     * Function to send a email
     * 
     * @return true if mail was send
     * @return false if mail was not send
     */
    public function sendMail($mailto, $subject, $body) {
        $this->mail->isSMTP();
        $this->mail->SMTPDebug = 0;                                                         // Setting for debugging the mail 0 = none, 1 = Only big events, 2 = full
        $this->mail->SMTPAuth = true;                                                       // Setting the mail on secure
        $this->mail->Host = "smtp.gmail.com";                                               // Host of mail
        $this->mail->Port = 25;                                                             // Port on wich to send the mail
        $this->mail->Username = "mailservermarvin@gmail.com";                               // Username to mailserver gmail
        $this->mail->Password = "vissers20";                                                // Password to mailserver gmail
        $this->mail->setFrom("mailservermarvin@gmail.com", "guesstosuccess.nl");            // Mail wich the user sees is the mail from
        $this->mail->AddAddress($mailto);                                                   // Addres to wich to send the mail to
        $this->mail->Subject = $subject;
        // Settings to style the email like a html file
        $this->mail->isHTML(true);
        $this->mail->Body = $body;

        // Checking if the mail was send
        if($this->mail->send()){
            return true;
        } else{
            return false;
        }
    }
}