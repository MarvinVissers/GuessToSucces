/**
* @author Marvin Vissers
* 
* Quick explanation of JavaScript webstorage: 
* JavaScript webstorage allows you to store prefrences or input values on the computer of the user
* Its makes usage of getters and setters to store and get stored information. 
* There is session webstorage to keep it as long as the page is open in the browser
* Link to w3schools explanation: https://www.w3schools.com/html/html5_webstorage.asp
*/

/**
 * 
 * Driver winnar
 * 
 */
// Setting the driver winnar
function setDriverWinnar(driver) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverWinnar", driver);
    }   
}

// Getting the driver winnar
function getDriverWinnar() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverWinnar");
    }
}

// Setting the driver winnar name
function setDriverNameWinnar(driver) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverNameWinnar", driver);
    }   
}

// Getting the driver winnar name
function getDriverNameWinnar() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverNameWinnar");
    }
}

// Setting the odds for the driver winnar
function setDriverWinnarOdds(odds) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverWinnarOdds", odds);
    }   
}

// Getting the odds for the driver winnar
function getDriverWinnarOdds() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverWinnarOdds");
    }
}

// Setting the points bet on driver winner
function setDriverWinnarPoints(points) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverWinnarPoints", points);
    }  
}

// Getting the points bet on driver winner
function getDriverWinnarPoints() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverWinnarPoints");
    } 
}

/**
 * 
 * Constructor winnar
 * 
 */
// Setting the constructor winnar
function setConstructorWinnar(constructor) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorWinnar", constructor);
    }   
}

// Getting the constructor winnar
function getConstructorWinnar() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorWinnar");
    }
}

// Setting the constructor winnar name
function setConstructorNameWinnar(constructor) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorNameWinnar", constructor);
    }   
}

// Getting the constructor winnar name
function getConstructorNameWinnar() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorNameWinnar");
    }
}

// Setting the odds for the constructor winnar
function setConstructorWinnarOdds(odds) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorWinnarOdds", odds);
    }   
}

// Getting the odds for the constructor winnar
function getConstructorWinnarOdds() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorWinnarOdds");
    }
}

// Setting the points bet on constructor winner
function setConstructorWinnarPoints(points) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorWinnarPoints", points);
    }  
}

// Getting the points bet on constructor winner
function getConstructorWinnarPoints() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorWinnarPoints");
    } 
}

/**
 * 
 * Driver fastest lap
 * 
 */
// Setting the driver fastest lap
function setDriverFastestLap(driver) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverFastestLap", driver);
    }   
}

// Getting the driver fastest lap
function getDriverFastestLap() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverFastestLap");
    }
}

// Setting the driver fastest lap name
function setDriverFastestLapName(driver) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverNameFastestLap", driver);
    }   
}

// Getting the driver fastest lap name
function getDriverFastestLapName() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverNameFastestLap");
    }
}

// Setting the odds for the driver fastest lap
function setDriverFastestLaprOdds(odds) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverFastestLapOdds", odds);
    }   
}

// Getting the odds for the driver fastest lap
function getDriverFastestLaprOdds() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverFastestLapOdds");
    }
}

// Setting the points bet on driver fastest lap
function setDriverFastestLapPoints(points) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("driverFastestLapPoints", points);
    }  
}

// Getting the points bet on driver fastest lap
function getDriverWinnarPoints() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("driverFastestLapPoints");
    } 
}

/**
 * 
 * Constructor fastest lap
 * 
 */
// Setting the constructor fastest lap
function setConstructorFastestLap(constructor) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorFastestLap", constructor);
    }   
}

// Getting the constructor winnar
function getConstructorFastestLap() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorFastestLap");
    }
}

// Setting the constructor fastest lap name
function setConstructorNameFastestLap(constructor) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorNameFastestLap", constructor);
    }   
}

// Getting the constructor fastest lap name
function getConstructorNameFastestLap() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorNameFastestLap");
    }
}

// Setting the odds for the constructor fastest lap
function setConstructorFastestLapOdds(odds) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorFastestLapOdds", odds);
    }   
}

// Getting the odds for the constructor fastest lap
function getConstructorFastestLapOdds() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorFastestLapOdds");
    }
}

// Setting the points bet on constructor fastest lap
function setConstructorFastestLapPoints(points) {
    if (typeof(Storage) !== "undefined") {
        sessionStorage.setItem("constructorWinnarPoints", points);
    }  
}

// Getting the points bet on constructor fastest lap
function getConstructorFastestLapPoints() {
    if (typeof(Storage) !== "undefined") {
        return sessionStorage.getItem("constructorWinnarPoints");
    } 
}

/**
 * 
 * General function using webstorage
 * 
 */
// Function to store all points bet on values
function setPointsCategorie(categorie, points) {
    // Using a swicht to check wich categorie is send
    switch (categorie) {
        case 4:
            setConstructoFastestLapPoints(points);
            break;
        case 3:
            setDriverFastestLapPoints(points);
            break;
        case 2:
            setConstructorWinnarPoints(points);
            break;
        default: setDriverWinnarPoints(points);
            break;
    }
}
