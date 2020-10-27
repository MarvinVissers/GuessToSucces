<?php
    // Requireing the controller and models
    require("../functions/controller/passwordResetController.php");
    require("../functions/controller/userController.php");
    require("../functions/model/passwordReset.php");
    require("../functions/model/user.php");

    // Making instances of the controllers
    $passwordResetCtrl = new PasswordResetController();
    $userCtrl = new UserController();

    // Creating a PasswordReset to put the variables in
    $passwordResetModel = new PasswordReset(null, null, null, null, null);

    // Checking if passwordreset selector and token are set
    if (isset($_GET['selector']) && isset($_GET['validator'])) {
        // Filling the PasswordReset
        $passwordResetModel->setSelector($_GET['selector']);
        $passwordResetModel->setToken($_GET['validator']);

        // Checking if they exist in the database
        $selectorTokenExist =  $passwordResetCtrl->checkValidResetLink($passwordResetModel);

        if ($selectorTokenExist === false) {
            // Sending user back to login page
            header("Location: login");
        }
    } else {
        // Sending user back to login page
        header("Location: login");
    }

    // Checking if feedback on forgot password
    $resetPasswordError = null;

    if (isset($_GET['error'])) {
        $resetPasswordError = $_GET['error'];
    }

    // Checking if button is pressed
    if (isset($_POST["btnSubmit"])) {
        // Getting the values of the input types
        $password = htmlspecialchars($_POST["txtPassword"]);
        $passwordConfirm = htmlspecialchars($_POST["txtPasswordConfirm"]);

        // Checking if all fields are filled in
        if (!empty($password) && !empty($passwordConfirm)) {
            // Checking if passwords are the same
            if ($password == $passwordConfirm) {
                // Putting the variables in the User model
                $userModel = new User($passwordResetModel->getUserID(), null, null, $password, null);

                // Sending the model to the send reset password function in the controller
                $userPasswordUpdated = $userCtrl->updateUserPassword($userModel);

                if ($userPasswordUpdated) {
                    // Reloading the page with an succes message
                    header("Location: reset-password?selector=". $passwordResetModel->getSelector() ."&validator=". $passwordResetModel->getToken() ."&error=none");
                }
            } else {
                // Reloading the page with an error
                header("Location: reset-password?selector=". $passwordResetModel->getSelector() ."&validator=". $passwordResetModel->getToken() ."&error=2");
            }
        } else {
            // Reloading the page with an error
            header("Location: reset-password?selector=". $passwordResetModel->getSelector() ."&validator=". $passwordResetModel->getToken() ."&error=1");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Including the head with links to stylesheets, icons, fonts and meta tags
            require("include/head.php");
        ?>

        <!-- Adding page specific CSS -->
        <link rel="stylesheet" href="../assets/styling/pages/reset-password.css">
    </head>

    <body>
        <main class="reset-password">
            <section class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="container__title">
                            Reset password
                        </h1>
                    </div>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="password" class="form__label">Password</label>
                        <input type="password" name="txtPassword" id="password" class="form-control form__input" onchange="passwordValidation()" min="1" max="20" required>
                        <span id="feedbackPassword" class="form__feedback"></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label for="passwordConfirm" class="form__label">Confirm password</label>
                        <input type="password" name="txtPasswordConfirm" id="passwordConfirm" class="form-control form__input" onchange="passwordConfirmValidation()" min="1" max="20" required>
                        <span id="feedbackPasswordConfirm" class="form__feedback"></span>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" name="btnSubmit" value="Change password" id="btnForm" class="btn form__button">
                            <?php
                                // Display error if not null
                                if ($resetPasswordError != null) {
                                    switch ($resetPasswordError) {
                                        case 'none':
                                            ?>
                                                <span class="form__feedback feedback--good">Password has been updated, you will be redirected to the login page.</span>
                                                <script>
                                                    // Redirect the user to the login page after a couple of seconds
                                                    setTimeout("location.href = 'login';", 3500);
                                                </script>
                                            <?php
                                            break;
                                        case "1":
                                            ?>
                                               <span class="form__feedback feedback--bad">Password must be filled in.</span>
                                            <?php
                                            break;
                                        case "2":
                                            ?>
                                                <span class="form__feedback feedback--bad">Passwords do not match.</span>
                                            <?php
                                            break;
                                        case "3":
                                            ?>
                                                <span class="form__feedback feedback--bad">Password is not valid.</span>
                                            <?php
                                            break;
                                        default:
                                            ?>
                                                <span class="form__feedback feedback--bad">Something went wrong, try again now or later.</span>
                                            <?php
                                            break;
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="reset-password__actions">
                                <a href="login" class="login--link">Back to login</a>
                            </p>
                        </div>
                    </div>
                </form>
            </section>
        </main>

        <?php
            // Including JavaScirpt files
            require("include/script.php");
        ?>
    </body>
</html>