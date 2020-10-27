<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to controllers and models
    require("../functions/controller/userController.php");
    require("../functions/controller/betController.php");
    require("../functions/controller/achievementController.php");

    require("../functions/model/user.php");
    require("../functions/model/driver.php");
    require("../functions/model/constructor.php");
    require("../functions/model/categorie.php");
    require("../functions/model/bet.php");
    require("../functions/model/achievement.php");
    require("../functions/model/userAchievement.php");

    // Making a instace of the controllers
    $userCtrl = new UserController();
    $betCtrl = new betController();
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

    // Getting the betting status
    $betStatus = null;

    if (isset($_GET['status'])) {
        // Filling the status
        $betStatus = $_GET['status'];
    } else {
        // Filling the status
        $betStatus = "Open";
    }

    // Creating variabels for the driver and constructor list to fill them later
    $driversList = null;
    $constructorsList = null;

    // Checking if only current season needs to be gotton or all
    if (strcmp($betStatus, "Open") == 0) {
        // Getting the drivers
        $driversList = $betCtrl->getDrivers("current");
        
        // Getting the constructors
        $constructorsList = $betCtrl->getConstructors("current");
    } else {
        // Getting the drivers
        $driversList = $betCtrl->getDrivers(null);

        // Getting the constructors
        $constructorsList = $betCtrl->getConstructors(null);
    }

    // Getting the current drivers leaderboards
    $betListUser = $betCtrl->getBetsUser($userModel, $betStatus);

    // Getting a list of the categories
    $categorieList = $betCtrl->getCategories();

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
        <link rel="stylesheet" href="../assets/styling/pages/bet-overview.css">
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
                        <h1 class="container__title">Betting overview</h1>
                    </div>
                </div>

                <div class="bet-overview">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form">
                        <div class="row">
                            <div class="col-sm-6">
                                <select name="cbxStatus" id="status" class="form-control form__select" onchange="changeStatus()">
                                    <?php
                                        switch ($betStatus) {
                                            case "Done":
                                                ?>
                                                    <option value="Open">Open</option>
                                                    <option value="Done" selected="selected">Done</option>
                                                <?php
                                                break;
                                            
                                            default:
                                                ?>
                                                    <option value="Open" selected="selected">Open</option>
                                                    <option value="Done">Done</option>
                                                <?php
                                                break;
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <div class="search__icon"><i class='fas search--icon'>&#xf002;</i></div>
                                <input class="form-control input--icon" id="Filter" type="text" placeholder="Search..." min="3" onchange="searchBet()">
                            </div>
                        </div>
                    </form>

                    <div class="bet-overview__cards">
                        <div class="row">
                            <?php
                                // Looping through the results
                                foreach ($betListUser as $bet) {

                                    // Calculating potential payout
                                    $payout = $bet->getPoints() * $bet->getOdds();
                                    
                                    $betOnName;

                                    // Checking if categorie is driver or constructor
                                    if (strpos($bet->getCategorie()->getCategorie(), "Driver") !== false) {
                                        // Getting the proper name of the driver
                                        $betOnName = $betCtrl->getDriverBetOn($driversList, $bet->getBetOn(), 0);
                                    } else if (strpos($bet->getCategorie()->getCategorie(), "Constructor") !== false) {
                                        // Getting the proper name of the constructor
                                        $betOnName = $betCtrl->getConstructorBetOn($constructorsList, $bet->getBetOn(), 0);
                                    }

                                    // Getting the proper circuit name
                                    $circuit = str_replace("_", " ", $bet->getGrandPrix());

                                    ?>
                                        <div class="col-sm-4" id="<?php echo $bet->getID(); ?>">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                                                        <h5 class="card-title card__info"><?php echo $bet->getCategorie()->getCategorie() . ": " . $betOnName; ?></h5>
                                                        <?php
                                                            // Checking if bet is open
                                                            if (strcmp($bet->getStatus(), 'Open') == 0) {
                                                                // Showing edit option
                                                        ?>
                                                                <!-- Card edit title, only visible in edit state -->
                                                                <h5 class="card-title card__edit card--hide">
                                                                    <?php echo $bet->getCategorie()->getCategorie(); ?>: 

                                                                    <select name="cbxBetOn" id="betOnId<?php echo $bet->getID(); ?>" class="card__input form-control form__select">
                                                                        <?php
                                                                            // Checking if categorie is driver or constructor
                                                                            if (strpos($bet->getCategorie()->getCategorie(), "Driver") !== false) {
                                                                                // Looping throug the drivers and selecting their proper names
                                                                                foreach ($driversList as $driver) {
                                                                                    // Getting the proper name of the driver
                                                                                    $betOnName = $betCtrl->getDriverBetOn($driversList, $driver->getDriverId(), 0);

                                                                                    if($driver->getDriverId() == $bet->getBetOn()){
                                                                                        ?>
                                                                                            <option value="<?php echo $driver->getDriverId(); ?>" selected="selected"><?php echo $betOnName ?></option>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                            <option value="<?php echo $driver->getDriverId(); ?>"><?php echo $betOnName ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            } else if (strpos($bet->getCategorie()->getCategorie(), "Constructor") !== false) {
                                                                                // Looping throug the drivers and selecting their proper names
                                                                                foreach ($constructorsList as $constructor) {
                                                                                    // Getting the proper name of the driver
                                                                                    $betOnName = $betCtrl->getConstructorBetOn($constructorsList, $constructor->getConstructorId(), 0);

                                                                                    if($constructor->getConstructorId() == $bet->getBetOn()){
                                                                                        ?>
                                                                                            <option value="<?php echo $constructor->getConstructorId(); ?>" selected="selected"><?php echo $betOnName ?></option>
                                                                                        <?php
                                                                                    } else {
                                                                                        ?>
                                                                                            <option value="<?php echo $constructor->getConstructorId(); ?>"><?php echo $betOnName ?></option>
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                            }                     
                                                                        ?>
                                                                    </select>
                                                                </h5>
                                                        <?php
                                                            }
                                                        ?>
                                                        <h6 class="card-subtitle mb-2"><?php echo $bet->getSeason() . " " . $circuit; ?></h6>

                                                        <div class="card__info">
                                                            <p class="card-text card--no-margin">Points bet: <?php echo $bet->getPoints(); ?> points</p>
                                                            <p class="card-text">payout: <?php echo $payout; ?> points</p>
                                                            <p class="card-text">Status: <?php echo $bet->getStatus(); ?></p>
                                                        </div>

                                                        <!-- Card edit points, only visible in edit state -->
                                                        <?php
                                                            // Only showing card actions on open bets
                                                            if (strcmp($bet->getStatus(), 'Open') == 0) {
                                                        ?>
                                                                <div class="card__edit card--hide">
                                                                    <p class="card-text card--no-margin card--input">Points bet: <input type="number" name="txtPoints" id="betPoints<?php echo $bet->getID(); ?>" class="form-control card__input" value="<?php echo $bet->getPoints(); ?>" required></p>
                                                                    <p class="card-text card--input">payout: <input type="text" name="txtPayout" id="betPayout<?php echo $bet->getID(); ?>" class="form-control card__input" value="<?php echo $payout; ?>" disabled></p>
                                                                    <p class="card-text">Status: <?php echo $bet->getStatus(); ?></p>
                                                                </div>

                                                                <div class="card__links card__info">
                                                                    <a href="javascript:void(0);" class="card__link" onclick="toggleEditBetState(<?php echo $bet->getID(); ?>)">Edit bet</a> 
                                                                    <a href="javascript:void(0);" class="card__link" onclick="openDeleteBetModal(<?php echo $bet->getID(); ?>, <?php echo $bet->getPoints(); ?>)">Cancel bet</a>
                                                                </div>

                                                                <!-- Card edit links, only visible in edit state -->
                                                                <div class="card__links card__edit card--hide">
                                                                    <a href="javascript:void(0);" class="card__link" onclick="openUpdateBetModal(<?php echo $bet->getID(); ?>, 'betOnId<?php echo $bet->getID(); ?>', 'betPoints<?php echo $bet->getID(); ?>', <?php echo $bet->getPoints(); ?>)">Save changes</a> 
                                                                    <a href="javascript:void(0);" class="card__link" onclick="toggleEditBetState(<?php echo $bet->getID(); ?>)">Cancel edit</a>
                                                                </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </article>
        </main>

        <?php
            // Including Javascript files
            require("include/script.php");

            // Including modals
            require("modal/bet-delete.php");
            require("modal/bet-update.php");

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
            addActieveNavbar("bet-overview");
        </script>
    </body>
</html>