/* Description: A few functions to flip the switch on whether inputs
 * are enabled or disabled. Mainly used in admin-forms. 
 ********************************************************************/

/* Pre:  element containing label and input of page section
 * Post:  onclick function to disable page section
 * Purpose: Enable the input of a page section to be added to a page
 * store or update.
 ********************************************************************/
function enable(section) {
    // enable input
    section.childNodes[1].removeAttribute('disabled');

    // change UI to reflect input
    section.classList.add('enabled');
    section.classList.remove('disabled');

    // bind disable function
    section.onclick = disable.bind(this, section);
}

/* Pre:  element containing label and input of page section
 * Post:  onclick function to enable page section
 * Purpose: Disable input so it isn't added to a page section store
 * or update.
 ********************************************************************/
function disable(section) {
    // disable input
    section.childNodes[1].setAttribute('disabled', '');

    // change UI to reflect input
    section.classList.add('disabled');
    section.classList.remove('enabled');

    // binde enable function
    section.onclick = enable.bind(this, section);
}


/* Pre:  none
 * Post:  onclick function
 * Purpose: Links all page section elements to proper functions.
 ********************************************************************/
window.onload = function() {
    // gather array items
    var items = document.getElementsByClassName('array-item');

    // set onclick functions to either disable or enable input
    for (index = 0; index < items.length; index++) {
        if (items[index].classList.contains('enabled')) {
            items[index].onclick = disable.bind(this, items[index]);
        } else if (items[index].classList.contains('disabled')) {
            items[index].onclick = enable.bind(this, items[index]);
        }
    }
}