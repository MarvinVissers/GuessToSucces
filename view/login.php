<?php
    // Requireing the user controller and user model
    require("../functions/controller/userController.php");
    require("../functions/model/user.php");

    $userCtrl = new userController();

    // Checking if feedback on login is given
    $loginError = null;

    if (isset($_GET['error'])) {
        $loginError = $_GET['error'];
    }

    // Checking if button is pressed
    if (isset($_POST["btnSubmit"])) {
        // Getting the values of the input types
        $username = htmlspecialchars($_POST["txtUsername"]);
        $password = htmlspecialchars($_POST["txtPassword"]);

        // Checking if all fields are filled in
        if (!empty($username) || !empty($password)) {
            // Putting the variabels in the User model
            $userModel = new User(null, $username, null, $password, null);

            // Sending the model to the login function in the controller
            $userCtrl->userLogin($userModel);
        } else {
            // Reloading the page with an error
            header("Location: login?error=1");
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
        <link rel="stylesheet" href="../assets/styling/pages/login.css">
    </head>

    <body>
        <main class="login">
            <section class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="container__title">
                            Login on Guess to Succes
                        </h1>
                    </div>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="username" class="form__label">Username</label>
                            <input type="text" name="txtUsername" id="username" class="form-control form__input" onchange="loginUsernameValidation()" min="1" max="25" required>
                            <span id="feedbackUsername" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="loginPassword" class="form__label">Password</label>
                            <input type="password" name="txtPassword" id="loginPassword" class="form-control form__input" onchange="loginPasswordValidation()" min="1" max="20" required>
                            <span id="feedbacLoginkPassword" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label class="form__checkbox">Keep me logged in
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" name="btnSubmit" value="Login" id="btnForm" class="btn form__button">
                            <?php
                                // Display error if not null
                                if ($loginError != null) {
                                    switch ($loginError) {
                                        case "1":
                                            ?>
                                               <span class="form__feedback feedback--bad">All fields must be filled in.</span>
                                            <?php
                                            break;
                                        case "2":
                                            ?>
                                                <span class="form__feedback feedback--bad">No account found with this email and password.</span>
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
                            <p class="login__actions">
                                <a href="forgot-password" class="forgot-password--link">Forgot password?</a>
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