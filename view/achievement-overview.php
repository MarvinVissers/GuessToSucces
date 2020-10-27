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

    // Getting the current drivers leaderboards
    $achievementListUser = $achievementCtrl->getAchievementsUser($userModel);

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

        <!-- Adding page specific styling -->
        <link rel="stylesheet" href="../assets/styling/pages/achievement-overview.css">
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
                        <h1 class="container__title">Achievements</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="achiements">
                            <ul class="achievements__list">
                                <?php
                                    // Looping throug the achievements
                                    foreach($achievementListUser as $achievement) {
                                        // Checking if achievement is 
                                        if ($achievement->getSeen() != null) {
                                            ?>
                                                <li class="achievement__item">
                                                    <div class="achievement__wrapper">
                                                        <img src="../assets/images/<?php echo $achievement->getAchievement()->getPicture(); ?>" class="achievement__img" alt="<?php echo $achievement->getAchievement()->getName(); ?> icon">

                                                        <div class="achievement__text">
                                                            <h6 class="achievement__title"><?php echo $achievement->getAchievement()->getName(); ?></h6>
                                                            <p class="achievement__description"><?php echo $achievement->getAchievement()->getDescription(); ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                        } else {
                                            // Checking if achievement is hidden. 1 means the visibility of the achievement and hidden are not equal
                                            if (strcmp($achievement->getAchievement()->getVisibility(), "Hidden") == 1) {
                                                ?>
                                                    <li class="achievement__item achievement--locked">
                                                        <div class="achievement__wrapper">
                                                            <img src="../assets/images/<?php echo $achievement->getAchievement()->getPicture(); ?>" class="achievement__img" alt="<?php echo $achievement->getAchievement()->getName(); ?> icon">

                                                            <div class="achievement__text">
                                                                <h6 class="achievement__title"><?php echo $achievement->getAchievement()->getName(); ?></h6>
                                                                <p class="achievement__description"><?php echo $achievement->getAchievement()->getDescription(); ?></p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                <?php
                                            }
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </article>
        </main>

        <?php
            // Including Javascript files
            require("include/script.php");

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
            addActieveNavbar("achievement-overview");
        </script>
    </body>
</html>