<?php
    /**
    * @author Marvin Vissers
    */
    
    // Linking to controllers and models
    require("../functions/controller/userController.php");
    require("../functions/controller/calenderController.php");
    require("../functions/controller/achievementController.php");
 
    require("../functions/model/user.php");
    require("../functions/model/race.php");
    require("../functions/model/circuit.php");
    require("../functions/model/location.php");
    require("../functions/model/achievement.php");
    require("../functions/model/userAchievement.php");

    // Making a instace of the controllers
    $userCtrl = new UserController();
    $calenderCtrl = new CalenderController();
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
    $currentSeasonCalender = $calenderCtrl->getCalenderCurrentSeason();

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

        <!-- Including main.js here to convert race local date|time to user local date|time -->
        <script src="../assets//script/main.js"></script>
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
                        <h1 class="container__title">Current season calender</h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-hover">
                            <thead>
                                <tr> <td>Round</td> <td>Name</td> <td>Country</td> <td>Date</td> <td>Time</td> <td>Actions</td> </tr>
                            </thead>

                            <tbody>
                                <?php
                                    // Getting the current Grand Prix
                                    $nextGrandPrix = $calenderCtrl->getNextGrandPrix($currentSeasonCalender);

                                    // Looping through the current season races
                                    foreach ($currentSeasonCalender as $race) {
                                        // Checking if this is the current grand prix
                                        if ($race->getRound() == $nextGrandPrix->getRound()) {
                                            // Adding active class to table row
                                            ?>
                                                <tr id="race<?php echo $race->getRound(); ?>" class="table--current">
                                            <?php
                                        } else {
                                            ?>
                                                <tr id="race<?php echo $race->getRound(); ?>" >
                                            <?php
                                        }
                                        // Using id's in the td to convert the date|time to the local dat|time of the user
                                        ?>
                                                <td><?php echo $race->getRound(); ?></td>
                                                <td><?php echo $race->getRaceName(); ?></td>
                                                <td><?php echo $race->getCircuit()->getLocation()->getCountry()?></td>
                                                <td><span id="date-round-<?php echo $race->getRound(); ?>"><?php echo $race->getDate(); ?></span></td>
                                                <td><span id="time-round-<?php echo $race->getRound(); ?>"><?php echo $race->getTime(); ?></span></td>
                                                <td>
                                                    <a class="table--link" onclick="toggleTrackInfo('track<?php echo $race->getRound(); ?>', 'race<?php echo $race->getRound(); ?>')">Circuit info</a>
                                                    <a href="<?php echo $race->getUrl(); ?>" class="table--link" target="_blank" rel="noopener noreferrer">Wikipedia</a>
                                                </td>
                                            </tr>

                                            <!-- Table for track info -->
                                            <tr class="row--hidden" id="track<?php echo $race->getRound(); ?>">
                                                <td class="table__td-table" colspan="6">
                                                    <table class="table table-hover table--nested">
                                                        <thead>
                                                            <td>Circuit name</td>  <td>City</td> <td>Length</td> <td>Altitude</td> <td>More info</td>
                                                        </thead>

                                                        <tbody>
                                                            <tr>
                                                                <td><?php echo $race->getCircuit()->getCircuitName(); ?></td>
                                                                <td><?php echo $race->getCircuit()->getLocation()->getLocation(); ?></td>
                                                                <td><?php echo $race->getCircuit()->getLocation()->getLong(); ?></td>
                                                                <td><?php echo $race->getCircuit()->getLocation()->getLet(); ?></td>
                                                                <td><a href="<?php echo $race->getCircuit()->geturl(); ?>" class="table--link" target="_blank" rel="noopener noreferrer">Wikipedia</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <script>
                                                // Converting the local date|time of the Race to the local date|time of the user
                                                // Getting the date
                                                var date = new Date("<?php echo $race->getDate() . " " . $race->getTime() ?>");

                                                // calling the function
                                                convertRaceLocalDateTimeToUserLocalDateTime("date-round-" + <?php echo $race->getRound(); ?>, "time-round-" + <?php echo $race->getRound(); ?>, date)
                                            </script>
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
            addActieveNavbar("calender-overview");
        </script>
    </body>
</html>