/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/form-activity.js ***!
  \***************************************/
/* Description: A set of functions used to add fitb, mc, or sa 
 * questions when creating a activity.
 ********************************************************************/
function remove_element(to_remove) {
  to_remove.remove();
}
/* Pre:  function to be onloaded to FITB button
 * Post:  onclick function create question or delete
 * Purpose: Create FITB questions for an activity.
 ********************************************************************/


function add_fitb() {
  var label = document.createElement('label');
  label.setAttribute('for', 'question_fitb[]');
  label.setAttribute('label', 'Fill in the Blank Question');
  label.innerHTML = 'Fill in the Blank Question';
  var question = document.createElement('input');
  question.setAttribute('name', 'question_fitb[]');
  question.setAttribute('type', 'text');
  question.setAttribute('placeholder', 'question');
  var answer = document.createElement('input');
  answer.setAttribute('name', 'answer_fitb[]');
  answer.setAttribute('type', 'text');
  answer.setAttribute('placeholder', 'answer');
  var delete_button = document.createElement('button');
  delete_button.innerHTML = 'Delete Question';

  delete_button.onclick = function () {
    remove_element(label);
  };

  var container = document.getElementById('question-container');
  container.appendChild(label);
  label.appendChild(question);
  label.appendChild(answer);
  label.appendChild(delete_button);
}
/* Pre:  function to be onloaded to MC button
 * Post:  onclick function create question or delete
 * Purpose: Create MC questions for an activity.
 ********************************************************************/


function add_mc() {
  var label = document.createElement('label');
  label.setAttribute('for', 'question_mc[]');
  label.setAttribute('label', 'Multiple Choice Question');
  label.innerHTML = 'Multiple Choice Question';
  var question = document.createElement('input');
  question.setAttribute('name', 'question_mc[]');
  question.setAttribute('type', 'text');
  question.setAttribute('placeholder', 'question');
  var delete_button = document.createElement('button');
  delete_button.innerHTML = 'Delete Question';

  delete_button.onclick = function () {
    remove_element(label);
  };

  var container = document.getElementById('question-container');
  container.appendChild(label);
  label.appendChild(question);

  for (var i = 0; i < 4; i++) {
    var placement = document.createElement('input');
    placement.setAttribute('name', 'placement_mc[]');
    placement.setAttribute('type', 'text');
    placement.setAttribute('placeholder', 'placement: for example \"a)\"');
    var answer = document.createElement('input');
    answer.setAttribute('name', 'answer_mc[]');
    answer.setAttribute('type', 'text');
    answer.setAttribute('placeholder', 'answer');
    label.appendChild(placement);
    label.appendChild(answer);
  }

  label.appendChild(delete_button);
}
/* Pre:  function to be onloaded to SA button
 * Post:  onclick function create question or delete
 * Purpose: Create SA questions for an activity.
 ********************************************************************/


function add_sa() {
  var label = document.createElement('label');
  label.setAttribute('for', 'question_sa[]');
  label.setAttribute('label', 'Short Answer');
  label.innerHTML = 'Short Answer';
  var question = document.createElement('input');
  question.setAttribute('name', 'question_sa[]');
  question.setAttribute('type', 'text');
  question.setAttribute('placeholder', 'question');
  var answer = document.createElement('input');
  answer.setAttribute('name', 'answer_sa[]');
  answer.setAttribute('type', 'text');
  answer.setAttribute('placeholder', 'expected answer');
  var delete_button = document.createElement('button');
  delete_button.innerHTML = 'Delete Question';

  delete_button.onclick = function () {
    remove_element(label);
  };

  var container = document.getElementById('question-container');
  container.appendChild(label);
  label.appendChild(question);
  label.appendChild(answer);
  label.appendChild(delete_button);
}
/* Pre:  none
 * Post:  onclick function
 * Purpose: Links all activity elements to proper functions.
 ********************************************************************/


window.onload = function () {
  document.getElementById('button-fitb').onclick = function () {
    add_fitb();
  };

  document.getElementById('button-mc').onclick = function () {
    add_mc();
  };

  document.getElementById('button-sa').onclick = function () {
    add_sa();
  };
};
/******/ })()
;