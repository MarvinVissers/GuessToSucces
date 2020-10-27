<?php
    /**
    * @author Marvin Vissers
    */

    // Linking to controllers and models
    require("../functions/controller/userController.php");
    require("../functions/controller/standingsController.php");
    require("../functions/controller/betController.php");
    require("../functions/controller/oddsController.php");
    require("../functions/controller/calenderController.php");
    require("../functions/controller/achievementController.php");

    require("../functions/model/user.php");
    require("../functions/model/categorie.php");
    require("../functions/model/averageSpeed.php");
    require("../functions/model/time.php");
    require("../functions/model/fastestLap.php");
    require("../functions/model/driver.php");
    require("../functions/model/constructor.php");
    require("../functions/model/location.php");
    require("../functions/model/circuit.php");
    require("../functions/model/result.php");
    require("../functions/model/race.php");
    require("../functions/model/odds.php");
    require("../functions/model/bet.php");
    require("../functions/model/achievement.php");
    require("../functions/model/userAchievement.php");

    // Making a instace of the controllers
    $userCtrl = new UserController();
    $standingsCtrl = new StandingsController();
    $betCtrl = new BetController();
    $oddsCtrl = new OddsController();
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

    // Checking if the categorie is set
    $actieveCategorie = 1;

    if (isset($_GET['categorie'])) {
        $actieveCategorie = $_GET['categorie'];
    }

    // Getting the user info
    $userModel = $userCtrl->getUser($userID);

    // Getting a list of the categories
    $categorieList = $betCtrl->getCategories();

    // Checking if user wanted to place a bet
    if (isset($_POST["btnSubmit"])) {
        // Creating an array to fill it later
        $userBets = array();

        echo "Knop ingedrukt <br>";
        // Looping throug the categories and checking wich ones are empty
        for ($i=0; $i < count($categorieList); $i++) { 
            if (!empty($BetOnIdCategorie[$i])) {
                echo "Bet categorie not empty <br>";
            }
        }
    }

    // Getting this year and 6 years ago for historical data
    $thisYear =  date("Y");
    $tilTestYear = date("Y") - 6;
    // Array with all historical results
    $resultsOfSixYears = array();
    $thisYearsResults = array();

    // Getting the results of the past 6 years and putting them in an array
    for ($i=$thisYear; $i > $tilTestYear; $i--) { 
        $thisYearsResults = $standingsCtrl->getResultsSeason($i);
        array_push($resultsOfSixYears, $thisYearsResults);
    }

    // Checking if driver or constructor categorie is chosen
    $gridList = null;
    $listSort = null;

    if ($actieveCategorie == 1 || $actieveCategorie == 3) {
        // Getting the drivers
        $gridList = $betCtrl->getDrivers("current");
        $listSort = "Drivers";
    } else {
        // Getting the constructors
        $gridList = $betCtrl->getConstructors("current");
        $listSort = "Constructors";
    }

    // Getting this years calender to get the round
    $currentSeasonCalender = $calenderCtrl->getCalenderCurrentSeason();

    // Getting the current round
    $nextGrandPrix = $calenderCtrl->getNextGrandPrix($currentSeasonCalender);

    // Calclating odds
    $listOdds = null;
    $listOddsDriverWinnar = array();
    $circuitId = $nextGrandPrix->getCircuit()->getCircuitId();

    // Getting odds per categorie
    switch ($actieveCategorie) {
        case '4':
            $listOdds = $oddsCtrl->getOddsConstructorFastestLap($resultsOfSixYears, $listOddsDriverWinnar, $gridList, $circuitId, 0);
            break;
        case '3':
            $listOdds = $oddsCtrl->getOddsDriverFastestLap($resultsOfSixYears, $listOddsDriverWinnar, $gridList, $circuitId, 0);
            break;
        case '2':
            $listOdds = $oddsCtrl->getOddsConstructorWinnar($resultsOfSixYears, $listOddsDriverWinnar, $gridList, $circuitId, 0);
            break;
        default:
            $listOdds = $oddsCtrl->getOddsDriverWinnar($resultsOfSixYears, $listOddsDriverWinnar, $gridList, $circuitId, 0);
            break;
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
    </head>

    <body>
        <main class="content" id="content">
            <?php
                // Including the sidebar menu
                // Also showing points
                require("include/menu.php");
            ?>

            <!-- Adding page specific CSS -->
            <link rel="stylesheet" href="../assets/styling/pages/index.css">

            <article class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <h1 class="container__title">Place bets for <?php echo $nextGrandPrix->getRaceName(); ?></h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <ul class="categorie">
                            <?php 
                                foreach ($categorieList as $categorie) {

                                    // Checking wich categorie is actieve
                                    if ($categorie->getID() == $actieveCategorie) {
                                        ?>
                                            <li class="categorie__item categorie__item--active" id="<?php echo $categorie->getID(); ?>" onclick="changeBetCategorie(<?php echo $categorie->getID(); ?>)">
                                                <label class="categorie--text"><?php echo $categorie->getCategorie(); ?></label>
                                            </li>
                                        <?php
                                    } else {
                                        ?>
                                            <li class="categorie__item" id="<?php echo $categorie->getID(); ?>" onclick="changeBetCategorie(<?php echo $categorie->getID(); ?>)">
                                                <label class="categorie--text"><?php echo $categorie->getCategorie(); ?></label>
                                            </li>
                                        <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7">
                        <div class="f1grid">
                            <?php
                                // Checking the categorie
                                switch ($listSort) {
                                    case 'Constructors':
                                        // Looping through the constructor odds
                                        foreach ($listOdds as $odds) {
                                            // Getting the proper name of the driver
                                            $betOnName = $betCtrl->getConstructorBetOn($gridList, $odds->getConstructor()->getConstructorId(), 0);

                                            // Checking the categorie
                                            if ($actieveCategorie == 2) {
                                            ?>
                                                <div class="f1grid__position" onclick="setConstructorWinnarBetOn('<?php echo $odds->getConstructor()->getConstructorId(); ?>', '<?php echo $betOnName; ?>', <?php echo $odds->getOdds(); ?>)">
                                            <?php
                                            } else {
                                            ?>
                                                <div class="f1grid__position" onclick="setConstructorFastestLapBetOn('<?php echo $odds->getConstructor()->getConstructorId(); ?>', '<?php echo $betOnName; ?>', <?php echo $odds->getOdds(); ?>)">
                                            <?php
                                            }
                                            ?>
                                                    <div class="f1grid__inner">
                                                        <div class="f1grid__name"><?php echo $betOnName; ?></div>
                                                        <div class="f1grid__odds">Earn <?php echo $odds->getOdds(); ?> times your bet</div>
                                                    </div>
                                                </div>
                                            <?php
                                        } 
                                        break;
                                    
                                    default:
                                        // Looping through the driver odds
                                        foreach ($listOdds as $odds) {
                                            // Getting the proper name of the driver
                                            $betOnName = $betCtrl->getDriverBetOn($gridList, $odds->getDriver()->getDriverId(), 0);

                                            // Checking the categorie
                                            if ($actieveCategorie == 1) {
                                                ?>
                                                    <div class="f1grid__position" onclick="setDriverWinnarBetOn('<?php echo $odds->getDriver()->getDriverId() ?>', '<?php echo $betOnName; ?>', <?php echo $odds->getOdds(); ?>)">
                                                <?php
                                            } else {
                                                ?>
                                                    <div class="f1grid__position" onclick="setDriverFastestLapBetOn('<?php echo $odds->getDriver()->getDriverId() ?>', '<?php echo $betOnName; ?>', <?php echo $odds->getOdds(); ?>)">
                                                <?php
                                            }
                                            ?>
                                                    <div class="f1grid__inner">
                                                        <div class="f1grid__name"><?php echo $betOnName; ?></div>
                                                        <div class="f1grid__odds">Earn <?php echo $odds->getOdds(); ?> times your bet</div>
                                                    </div>
                                                </div>
                                            <?php
                                        } 
                                        break;
                                }
                            ?>
                        </div>
                    </div>

                    <div class="col-md-5">
                        <div class="bet">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="bet__inner">
                                <div class="bet__header">
                                    <h5 class="bet__title">Place bet</h5>
                                </div>

                                <div class="bet__body">
                                    <?php
                                        // Looping through all categories
                                        foreach ($categorieList as $categorie) {
                                            ?>
                                                <div class="bet-categorie" id="betCategorie<?php echo $categorie->getID(); ?>">
                                                    <div class="bet-categorie__head" onclick="toggleBetCategorie(<?php echo $categorie->getID(); ?>)">
                                                        <h6 class="bet-categorie__title"><?php echo $categorie->getCategorie(); ?></h6>
                                                        <?php
                                                            // Checking if categorie is actieve, then set the bet categorie open by default
                                                            if ($categorie->getID() == $actieveCategorie) {
                                                                ?>
                                                                    <i class="fas fa-angle-down bet-categorie--icon bet-categorie--icon--open" id="betCategorieIcon<?php echo $categorie->getID(); ?>"></i>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                    <i class="fas fa-angle-down bet-categorie--icon" id="betCategorieIcon<?php echo $categorie->getID(); ?>"></i>
                                                                <?php
                                                            }
                                                        ?>
                                                    </div>

                                                    <?php
                                                        // Checking if categorie is actieve, then set the bet categorie open by default
                                                        if ($categorie->getID() == $actieveCategorie) {
                                                            ?>
                                                                <div class="bet-categorie__body bet-categorie__body--open" id="betCategorieBody<?php echo $categorie->getID(); ?>">
                                                            <?php
                                                        } else {
                                                            ?>
                                                                <div class="bet-categorie__body" id="betCategorieBody<?php echo $categorie->getID(); ?>">
                                                            <?php
                                                        }
                                                    ?>
                                                        <div class="bet-categorie__beton">
                                                            <label for="BetOnCategorieOdds<?php echo $categorie->getID(); ?>" id="BetOnCategorieOddsLabel<?php echo $categorie->getID(); ?>" class="bet__label">No driver selected</label>
                                                            <input type="text" name="BetOnCategorieOdds<?php echo $categorie->getID(); ?>" id="betOnCategorieOdds<?php echo $categorie->getID(); ?>" class="form-control bet__input" value="0" readonly required>
                                                        </div>
    
                                                        <div class="bet-categorie__points">
                                                            <label for="betOnCategoriePoints<?php echo $categorie->getID(); ?>" class="bet__label">How much are you betting?</label>
                                                            <input type="number" name="txtBetOnCategoriePoints<?php echo $categorie->getID(); ?>" id="betOnCategoriePoints<?php echo $categorie->getID(); ?>" value="250" min="50" max="99999999999" step="50" class="form-control bet__input" onkeyup="betPointsCategorieValidation(<?php echo $categorie->getID(); ?>, <?php echo $userModel->getPoints(); ?>)" onchange="betPointsCategoriePossilbePayout(<?php echo $categorie->getID(); ?>, true)" required>
                                                        </div>

                                                        <div class="bet-categorie__payout">
                                                            <label for="betOnCategorieWin<?php echo $categorie->getID(); ?>" class="bet__label">Possible payout</label>
                                                            <input type="text" name="txtBetOnCategorieOdds<?php echo $categorie->getID(); ?>" id="betOnCategoriePotentialPayout<?php echo $categorie->getID(); ?>" value="0" class="form-control bet__input" readonly required>
                                                        </div>

                                                        <input type="hidden" name="txtBetOnIdCategorie<?php echo $categorie->getID(); ?>" id="BetOnIdCategorie<?php echo $categorie->getID(); ?>">
                                                    </div>
                                                </div>
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="bet__footer">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="bet__total">
                                                <span class="bet--label">You can win a total of: </span>
                                                <span class="bet--total"><span id="betTotalPossilbePayout">0</span> points</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <input type="submit" name="btnSubmit" id="btnForm" value="Place bet(s)" class="form__button form__button--full-width">
                                        </div>
                                    </div>
                                </div>
                            </form>
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
            addActieveNavbar("index");
        </script>
    </body>
</html>