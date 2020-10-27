/**
 * File with all fade-in functions
 */

/**
 * Section fade-ins 
 */
// Array with all section that should fade-in
let sectionArray = document.getElementsByClassName("section--fade-in");

window.addEventListener('scroll', fadeIn ); 

// Function om de fade-in class te activeren
function fadeIn() {
    for (var i = 0; i < sectionArray.length; i++) {
        var section = sectionArray[i]
        var distInView = section.getBoundingClientRect().top - window.innerHeight + 300;
        if (distInView < 0) {
            section.classList.add("section--visible");
        }
    }
}
// Activating the function
fadeIn();

/**
 * Sidebar fade-ins 
 */
// Array with all sidebars
let sidebarArray = document.getElementsByClassName("sidebar--fade-in");

window.addEventListener("load", function() {
    let sidebarArray = document.getElementsByClassName("sidebar--fade-in");

    for (let i = 0; i < sidebarArray.length; i++) {
        const sidebar = sidebarArray[i];
        sidebar.classList.add("sidebar--visible");
    }
});
