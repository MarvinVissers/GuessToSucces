<?php
    // Requireing the user controller and user model
    require("../functions/controller/userController.php");
    require("../functions/model/user.php");
    require("../functions/model/achievement.php");

    $userCtrl = new userController();

    // Checking if feedback on create account is given
    $createAccountError = null;

    if (isset($_GET['error'])) {
        $createAccountError = $_GET['error'];
    }

    // Checking if button is pressed
    if (isset($_POST["btnSubmit"])) {
        // Getting the values of the input types
        $email = htmlspecialchars($_POST["txtEmail"]);
        $username = htmlspecialchars($_POST["txtUsername"]);
        $password = htmlspecialchars($_POST["txtPassword"]);
        $passwordConfirm = htmlspecialchars($_POST["txtPasswordConfirm"]);

        // Checking if all fields are filled in
        if (!empty($email) || !empty($username) || !empty($password) || !empty($passwordConfirm)) {
            // Checking if password and password confirm are the same
            if ($password == $passwordConfirm) {
                // Putting the variables in User model
                $userModel = new User(null, $username, $email, $password, null);

                // Sending the variables to the container
                $userCtrl->userAdd($userModel, $passwordConfirm);
            } else {
               // Reloading the page with an error
               header("Location: create-account?error=2");
            }  
        } else {
            // Reloading the page with an error
            header("Location: create-account?error=1");
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
        <link rel="stylesheet" href="../assets/styling/pages/create-account.css">
    </head>

    <body>
        <main class="create-account">
            <section class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="container__title">
                            Create an account
                        </h1>
                    </div>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email" class="form__label">Email</label>
                            <input type="email" name="txtEmail" id="email" class="form-control form__input" onchange="emailValidation()" min="1" max="100" required>
                            <span id="feedbackEmail" class="form__feedback"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="username" class="form__label">Username</label>
                            <input type="text" name="txtUsername" id="username" class="form-control form__input" onchange="usernameValidation()" min="1" max="25" required>
                            <span id="feedbackUsername" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="password" class="form__label">Password</label>
                            <input type="password" name="txtPassword" id="password" class="form-control form__input" onchange="passwordValidation()" min="1" max="20" required>
                            <span id="feedbackPassword" class="form__feedback"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="passwordConfirm" class="form__label">Confirm password</label>
                            <input type="password" name="txtPasswordConfirm" id="passwordConfirm" class="form-control form__input" onchange="passwordConfirmValidation()" min="1" max="20" required>
                            <span id="feedbackPasswordConfirm" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" name="btnSubmit" value="Create account" id="btnForm" class="btn form__button">
                            <?php
                                // Display error if not null
                                if ($createAccountError != null) {
                                    switch ($createAccountError) {
                                        case "1":
                                            ?>
                                            <span class="form__feedback feedback--bad">All fields must be filled in.</span>
                                            <?php
                                            break;
                                        case "2":
                                            ?>
                                                <span class="form__feedback feedback--bad">Passwords do not match.</span>
                                            <?php
                                            break;    
                                        case "3":
                                            ?>
                                                <span class="form__feedback feedback--bad">Email is already used by someone else.</span>
                                            <?php
                                            break;        
                                        case "4":
                                            ?>
                                                <span class="form__feedback feedback--bad">Username is already used by someone else.</span>
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
                            <p class="create-account__actions">
                                <a href="login" class="login--link">Already have an account?</a>
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