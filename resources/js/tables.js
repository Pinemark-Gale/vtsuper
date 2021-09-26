/* Pre:  rowId
 * Post:  adds show/hide capability to row + icon
 * Purpose: Finds every row and adds the show and hide 
 * functionality to + (expand-col class) icon.
 ********************************************************************/
function itemTableRowExpand(rowId) {
    // gather row elements
    var row = document.getElementsByClassName(rowId);

    // switch bottom border off on row
    for (index = 0; index < row.length; index++) {
        row[index].classList.toggle('row-bottom');
    }

    // gather sub-row elements
    var subRow = document.getElementsByClassName("sub-" + rowId);
   
    // toggle sub-row hiding (already has bottom border)
    for (index = 0; index < row.length; index++) {
        subRow[index].classList.toggle('hide-row');
    }

    // switch icon from a + to a x
    document.getElementById("expand-" + rowId).classList.toggle("active-expand-col");
}

/* Pre:  none
 * Post:  onclick function
 * Purpose: Links all + (expand-col class) icons to the
 * itemTableRowExpand function with the proper parameter.
 ********************************************************************/
window.onload = function() {
    var expandButtons = document.getElementsByClassName('expand-col');
    for (index = 0; index < expandButtons.length; index++) {
        expandButtons[index].onclick = itemTableRowExpand.bind(this, 'row-' + index);
    }
}