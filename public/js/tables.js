/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/tables.js ***!
  \********************************/
// function getChildText(child, text) {
//     var toAdd = "";
//     var toIterate = child;
//     if (child instanceof Element && child.firstElementChild !== null) {
//         toIterate = child.children;
//     }
//     if (toIterate instanceof HTMLCollection) {
//         var toIterate = Array.from(toIterate);
//         for (var i = 0; i < toIterate.length; i++) {
//             text = getChildText(toIterate[i], text);
//         }
//     } else {
//         toAdd = child.innerHTML;
//         text.add(toAdd);
//     }
//     console.log("---------------");
//     console.log("Iteration Result: " + text);
//     console.log("Child With Child?" );
//     console.log(child instanceof Element && child.firstElementChild !== null);
//     console.log(toIterate);
//     console.log("---------------");
//     return text;
// }

/* Pre: none
 * Post: adds show/hide capability to expand button
 * Purpose: On window load add functions to all expand buttons 
 * to expand row with additional information.
 ********************************************************************/
window.onload = function () {
  /* ASSIGN EXPAND BUTTONS
   *************************************************/
  // grab all expand buttons
  var expandButtons = document.getElementsByClassName("expand-col");
  var index;

  for (index = 0; index < expandButtons.length; index++) {
    expandButtons[index].addEventListener("click", function () {
      // toggle bottom border of row
      this.parentElement.classList.toggle('bottom-border'); // toggle hidden row visibility

      this.parentElement.nextElementSibling.classList.toggle('hidden'); // rotate expand button

      this.classList.toggle('active-expand-col');
    });
  }
  /* ASSIGN SEARCH FILTER FUNCTION
  *************************************************/
  // var searchBar = document.getElementsByClassName("search-bar-input");
  // var tableBody = document.getElementsByClassName("table-body");
  // tableBody = tableBody[0].children;
  // console.log(tableBody);
  //  searchBar[0].addEventListener("input", function() {
  //     console.log(this.value);
  //     for (var i = 0; i < tableBody.length; i = i + 2) {
  //         var rowOneResults = new Set()
  //         var rowOne = tableBody[i].children;
  //         var rowTwo = tableBody[i + 1].children;
  //         console.log("STARTING ROW #" + i);
  //         var rowOneText = getChildText(rowOne, rowOneResults);
  //         console.log("ROW NUMBER: " + i);
  //         console.log(rowOneText);
  //      }
  //  }); 

};
/******/ })()
;