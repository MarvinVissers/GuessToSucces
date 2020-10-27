/**
 * File with all JavaScript functions of view/index.php
 */

// Variables for the driver winnar categorie
const driverIdCategorie1 = document.getElementById("BetOnIdCategorie1");
const driverNameCategorie1 = document.getElementById("BetOnCategorieOddsLabel1");
const oddsCategorie1 = document.getElementById("betOnCategorieOdds1");
const pointsCategorie1 = document.getElementById("betOnCategoriePoints1");
const betPotentialPayout1 = document.getElementById("betOnCategoriePotentialPayout1");
// Variables for the constructor winnar categorie
const constructorId2 = document.getElementById("BetOnIdCategorie2");
const constructorNameCategorie2 = document.getElementById("BetOnCategorieOddsLabel2");
const oddsCategorie2 = document.getElementById("betOnCategorieOdds2");
const pointsCategorie2 = document.getElementById("betOnCategoriePoints2");
const betPotentialPayout2 = document.getElementById("betOnCategoriePotentialPayout2");
// Variables for the driver fastest lap categorie
const driverIdCategorie3 = document.getElementById("BetOnIdCategorie3");
const driverNameCategorie3 = document.getElementById("BetOnCategorieOddsLabel3");
const oddsCategorie3 = document.getElementById("betOnCategorieOdds3");
const pointsCategorie3 = document.getElementById("betOnCategoriePoints3");
const betPotentialPayout3 = document.getElementById("betOnCategoriePotentialPayout3");
// Variables for the constructor winnar categorie
const constructorId4 = document.getElementById("BetOnIdCategorie4");
const constructorNameCategorie4 = document.getElementById("BetOnCategorieOddsLabel4");
const oddsCategorie4 = document.getElementById("betOnCategorieOdds4");
const pointsCategorie4 = document.getElementById("betOnCategoriePoints4");
const betPotentialPayout4 = document.getElementById("betOnCategoriePotentialPayout4");

// Storing the values of the driver winnar when the user clicks on 1
function setDriverWinnarBetOn(driverId, driverName, odds) {
    // Store the values in the webstorage
    setDriverWinnar(driverId);
    setDriverNameWinnar(driverName);
    setDriverWinnarOdds(odds);

    // Filling the categorie bet
    driverIdCategorie1.value = getDriverWinnar(); 
    driverNameCategorie1.innerHTML = getDriverNameWinnar(); 
    oddsCategorie1.value = getDriverWinnarOdds();       
}      

// Storing the values of the constructor winnar when the user clicks on 1
function setConstructorWinnarBetOn(constructorId, constructorName, odds) {
    // Store the values in the webstorage
    setConstructorWinnar(constructorId);
    setConstructorNameWinnar(constructorName);
    setConstructorWinnarOdds(odds);

    // Filling the categorie bet
    constructorId2.value = getConstructorWinnar(); 
    constructorNameCategorie2.innerHTML = getConstructorNameWinnar(); 
    oddsCategorie2.value = getConstructorWinnarOdds(); 
}  

// Storing the values of the driver fastest lap when the user clicks on 1
function setDriverFastestLapBetOn(driverId, driverName, odds) {
    // Store the values in the webstorage
    setDriverFastestLap(driverId);
    setDriverFastestLapName(driverName);
    setDriverFastestLaprOdds(odds);

    // Filling the categorie bet
    driverIdCategorie3.value = getDriverFastestLap(); 
    driverNameCategorie3.innerHTML = getDriverFastestLapName(); 
    oddsCategorie3.value = getDriverFastestLaprOdds(); 
}

// Storing the values of the constructor winnar when the user clicks on 1
function setConstructorFastestLapBetOn(constructorId, constructorName, odds) {
    // Store the values in the webstorage
    setConstructorWinnar(constructorId);
    setConstructorNameWinnar(constructorName);
    setConstructorWinnarOdds(odds);

    // Filling the categorie bet
    constructorId4.value = getConstructorWinnar(); 
    constructorNameCategorie4.innerHTML = getConstructorNameWinnar(); 
    oddsCategorie4.value = getConstructorWinnarOdds(); 
}

/**
 * Setting all values in the fields
 */
// Driver winnar
if (getDriverWinnar().length != 0) {
    // Filling the categorie bet
    driverIdCategorie1.value = getDriverWinnar(); 
    driverNameCategorie1.innerHTML = getDriverNameWinnar(); 
    oddsCategorie1.value = getDriverWinnarOdds(); 
    pointsCategorie1.value = getDriverWinnarPoints();

    // Calculating the possible payout
    betPotentialPayout1.value = Math.round(oddsCategorie1.value * pointsCategorie1.value);
}
// Constructor winnar
if (getConstructorWinnar().length != 0) {
    // Filling the categorie bet
    constructorId2.value = getConstructorWinnar(); 
    constructorNameCategorie2.innerHTML = getConstructorNameWinnar(); 
    oddsCategorie2.value = getConstructorWinnarOdds(); 
    pointsCategorie2.value = getConstructorWinnarPoints();

    // Calculating the possible payout
    betPotentialPayout2.value = Math.round(oddsCategorie2.value * pointsCategorie2.value);
}
// Driver fastest lap
if (getDriverFastestLap().length != 0) {
    // Filling the categorie bet
    driverIdCategorie3.value = getDriverFastestLap(); 
    driverNameCategorie3.innerHTML = getDriverFastestLapName(); 
    oddsCategorie3.value = getDriverFastestLaprOdds(); 
    pointsCategorie3.value = getDriverFastestLapPoints();

    // Calculating the possible payout
    betPotentialPayout3.value = Math.round(oddsCategorie3.value * pointsCategorie3.value);
}
// Constructor fastest lap
if (getConstructorFastestLap().length != 0) {
    // Filling the categorie bet
    constructorId4.value = getConstructorWinnar(); 
    constructorNameCategorie4.innerHTML = getConstructorNameWinnar(); 
    oddsCategorie4.value = getConstructorWinnarOdds(); 
    pointsCategorie4.value = getConstructorFastestLapPoints();

    // Calculating the possible payout
    betPotentialPayout4.value = Math.round(oddsCategorie4.value * pointsCategorie4.value);
}
