<?php
    /**
    * @author Marvin Vissers
    */

    // Including the user controller
    require("../functions/controller/userController.php");

    // Making a instace of the user controller
    $userCtrl = new UserController();

    // Logging the user out
    $userCtrl->userLogout();
?>