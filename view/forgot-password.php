<?php
    // Requireing the controller and models
    require("../functions/controller/passwordResetController.php");
    require("../functions/model/passwordReset.php");
    require("../functions/model/user.php");

    $passwordResetCtrl = new PasswordResetController();

    // Checking if feedback on forgot password
    $forgotPasswordError = null;

    if (isset($_GET['error'])) {
        $forgotPasswordError = $_GET['error'];
    }

    // Checking if button is pressed
    if (isset($_POST["btnSubmit"])) {
        // Getting the values of the input types
        $username = htmlspecialchars($_POST["txtUsername"]);

        // Checking if all fields are filled in
        if (!empty($username)) {
            // Putting the variabels in the User model
            $userModel = new User(null, $username, null, null, null);

            // Sending the model to the send reset password function in the controller
            $resetLinkSend = $passwordResetCtrl->sendPasswordResetLink($userModel);

            if ($resetLinkSend) {
                // Reloading the page with an succes message
                header("Location: forgot-password?error=none");
            }
        } else {
            // Reloading the page with an error
            header("Location: forgot-password?error=1");
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
        <link rel="stylesheet" href="../assets/styling/pages/forgot-password.css">
    </head>

    <body>
        <main class="forgot-password">
            <section class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="container__title">
                            Password forgotten
                        </h1>
                    </div>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="username" class="form__label">Username</label>
                            <input type="text" name="txtUsername" id="username" class="form-control form__input" onchange="usernameValidation()" min="1" max="25" required>
                            <span id="feedbackUsername" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" name="btnSubmit" value="Send email" id="btnForm" class="btn form__button">
                            <?php
                                // Display error if not null
                                if ($forgotPasswordError != null) {
                                    switch ($forgotPasswordError) {
                                        case 'none':
                                            ?>
                                                <p class="form__feedback feedback--good">Email has been send to your email.</p>
                                            <?php
                                            break;
                                        case "1":
                                            ?>
                                               <span class="form__feedback feedback--bad">Email must be field in.</span>
                                            <?php
                                            break;
                                        case "2":
                                            ?>
                                                <span class="form__feedback feedback--bad">Email is not valid.</span>
                                            <?php
                                            break;
                                        case "3":
                                            ?>
                                                <span class="form__feedback feedback--bad">No account found with this email.</span>
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
                            <p class="forgot-password__actions">
                                <a href="login" class="login--link">Back to login</a>
                                <a href="create-account" class="create-account--link">Create account</a>
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