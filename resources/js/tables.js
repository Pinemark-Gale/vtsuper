/* Pre: none
 * Post: adds show/hide capability to expand button
 * Purpose: On window load add functions to all expand buttons 
 * to expand row with additional information.
 ********************************************************************/
window.onload = function() {
    // grab all expand buttons
    var expandButtons = document.getElementsByClassName("expand-col");
    var index;

    for (index = 0; index < expandButtons.length; index++) {
        expandButtons[index].addEventListener("click", function() {
            // toggle bottom border of row
            this.parentElement.classList.toggle('bottom-border');

            // toggle hidden row visibility
            this.parentElement.nextElementSibling.classList.toggle('hidden');

            // rotate expand button
            this.classList.toggle('active-expand-col');
        })
    }
}