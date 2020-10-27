<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to controllers and models
    require("../functions/controller/userController.php");
    require("../functions/controller/achievementController.php");

    require("../functions/model/user.php");
    require("../functions/model/achievement.php");
    require("../functions/model/userAchievement.php");

    // Making a instace of the controllers
    $userCtrl = new UserController();
    $achievementCtrl = new AchievementController();

    // Checking if feedback on create account is given
    $profileError = null;

    if (isset($_GET['error'])) {
        $profileError = $_GET['error'];
    }

    // Starting session to see if user is logged in
    session_start();
    // Variable for the user ID
    $userID = null;

    // Checking if user is logged in
    if (isset($_SESSION["userID"])) {
        // Filling the userID
        $userID = $_SESSION["userID"];
    } else {
        // Sending user to login page
        header("Location: login");
    }

    // Getting the user info
    $userModel = $userCtrl->getUser($userID);

    // Checking if button is pressed
    if (isset($_POST["btnSubmit"])) {
        // Getting the values of the input types
        $password = htmlspecialchars($_POST['txtPassword']);
        $newPassword = htmlspecialchars($_POST["txtNewPassword"]);
        $newPasswordConfirm = htmlspecialchars($_POST["txtConfirmNewPassword"]);

        // Checking if all fields are filled in
        if (!empty($newPassword) || !empty($newPasswordConfirm || !empty($password))) {
            // Checking if password and password confirm are the same
            if ($newPassword == $newPasswordConfirm && password_verify($password, $userModel->getPassword())) {
                // Sending the variables to the container
                $userModel->setPassword($password);
                
                if($userCtrl->updateUserPassword($userModel)) {
                    // Reloading the page with an error
                    header("Location: profile?error=none");
                }
            } else {
               // Reloading the page with an error
               header("Location: profile?error=2");
            }  
        } else {
            // Reloading the page with an error
            header("Location: profile?error=1");
        }
    }

    /* 
     * Updating the user points
     */
    // List with point achievements
    $listAchievements = array(42, 43, 44);

    // updating the progress towards the achievemetns
    $achievementCtrl->updateAchievementProgress($listAchievements, $userModel);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            // Including the head with links to stylesheets, icons, fonts and meta tags
            require("include/head.php");
        ?>

        <!-- Adding page specific CSS -->
        <link rel="stylesheet" href="../assets/styling/pages/profile.css">
    </head>

    <body>
        <main class="content" id="content">
            <?php
                // Including the sidebar menu
                // Also showing points
                require("include/menu.php");
            ?>

            <article class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="container__title">Profile</h1>
                    </div>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="email" class="form__label">Email</label>
                            <input type="email" name="txtEmail" id="email" class="form-control form__input" value="<?php echo $userModel->getEmail(); ?>" onchange="emailValidation()" min="1" max="100" disabled required>
                            <span id="feedbackEmail" class="form__feedback"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="username" class="form__label">Username</label>
                            <input type="text" name="txtUsername" id="username" class="form-control form__input" value="<?php echo $userModel->getUsername(); ?>" onchange="usernameValidation()" min="1" max="25" disabled required>
                            <span id="feedbackUsername" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <label for="loginPassword" class="form__label">Password</label>
                            <input type="password" name="txtPassword" id="loginPassword" class="form-control form__input" placeholder="Enter your old password..." onchange="loginPasswordValidation()" min="1" max="20" required>
                            <span id="feedbacLoginkPassword" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="password" class="form__label">New password</label>
                            <input type="password" name="txtNewPassword" id="password" class="form-control form__input" onchange="passwordValidation()" min="1" max="20" required>
                            <span id="feedbackPassword" class="form__feedback"></span>
                        </div>

                        <div class="col-sm-6">
                            <label for="passwordConfirm" class="form__label">Confrim new password</label>
                            <input type="password" name="txtConfirmNewPassword" id="passwordConfirm" class="form-control form__input" onchange="passwordConfirmValidation()" min="1" max="20" required>
                            <span id="feedbackPasswordConfirm" class="form__feedback"></span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <input type="submit" name="btnSubmit" value="Change password" class="form__button">
                            <?php
                                // Display error if not null
                                if ($profileError != null) {
                                    switch ($profileError) {
                                        case "none":
                                            ?>
                                               <span class="form__feedback feedback--good">Password has been changed.</span>
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
                </form>

                <div class="bankrupt">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="bankrupt__title">No more points?</h2>
                        </div>

                        <div class="col-sm-12">
                            <button class="bankrupt__button" onclick="openBankruptModal()">Start over</button>
                        </div>
                    </div>
                </div>
            </article>
        </main>

        <?php
            // Including Javascript files
            require("include/script.php");

            // Including modals
            require("modal/profile-bankrupt.php");

            // Getting the achievements of the user
            $achievementsUser = $achievementCtrl->getAchievementsUser($userModel);

            // Checking if user has gotton any achievements
            $newAchievementsRewared = array();
            $newAchievementsRewared = $achievementCtrl->checkForNewAchievementsUser($achievementsUser, $newAchievementsRewared, 0);

            // Checking if their are new achievements the user has not seen yet
            if ($newAchievementsRewared != null) {
                // Looping throug the new achievements and making a pop-up appear with them
                foreach ($newAchievementsRewared as $achievement) {
                    // Getting the pop-up modal
                    require("modal/achievement-rewared.php");

                    // Setting seen 1 for seen
                    $achievement->setSeen(1);

                    // Updating the seen status of the achievement
                    $achievementCtrl->updateAchievementSeen($achievement);
                }
            }
        ?>

        <script>
            // Adding navbar item active styling to driver overview navbar link
            addActieveNavbar("profile");
        </script>
    </body>
</html>