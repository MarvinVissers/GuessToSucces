<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to controllers and models
    require("../functions/controller/userController.php");
    require("../functions/controller/standingsController.php");
    require("../functions/controller/achievementController.php");

    require("../functions/model/user.php");
    require("../functions/model/driver.php");
    require("../functions/model/constructor.php");
    require("../functions/model/driverstandings.php");
    require("../functions/model/achievement.php");
    require("../functions/model/userAchievement.php");

    // Making a instace of the controllers
    $userCtrl = new UserController();
    $standingsCtrl = new StandingsController();
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
    $driverStandings = $standingsCtrl->getDriverStandings();

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
        <link rel="stylesheet" href="../assets/styling/pages/create-account.css">
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
                        <h1 class="container__title">Current driver championship standings</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                <tr> <td>Position</td> <td>Name</td> <td>Constructor</td> <td>Number</td> <td>Nationality</td> <td>Points</td> <td>More info</td> </tr>
                            </thead>

                            <tbody>
                                <?php
                                    // Looping through the current Driver stanings
                                    foreach ($driverStandings as $driver) {
                                        ?>
                                            <tr>
                                                <td><?php echo $driver->getPositionText(); ?></td>
                                                <td><?php echo $driver->getDriver()->getGivenName() . " " . $driver->getDriver()->getFamilyName(); ?></td>
                                                <td><?php echo $driver->getConstructor()->getName(); ?></td>
                                                <td><?php echo $driver->getDriver()->getPermanentNumber(); ?></td>
                                                <td><?php echo $driver->getDriver()->getNationality(); ?></td>
                                                <td><?php echo $driver->getPoints(); ?></td>
                                                <td><a href="<?php echo $driver->getDriver()->getUrl(); ?>" class="table--link" target="_blank" rel="noopener noreferrer">Wikipedia</a></td>
                                            </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
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
            addActieveNavbar("driver-overview");
        </script>
    </body>
</html>