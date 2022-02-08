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
  var order = document.getElementById('question-container').childElementCount;
  var label = document.createElement('label');
  label.setAttribute('for', 'module[' + order + '][question]');
  label.setAttribute('label', 'Fill in the Blank Question');
  label.innerHTML = 'Fill in the Blank Question';
  var type = document.createElement('input');
  type.setAttribute('name', 'module[' + order + '][type]');
  type.setAttribute('type', 'hidden');
  type.setAttribute('value', 'fitb');
  var question = document.createElement('input');
  question.setAttribute('name', 'module[' + order + '][question]');
  question.setAttribute('type', 'text');
  question.setAttribute('placeholder', 'question');
  var answer = document.createElement('input');
  answer.setAttribute('name', 'module[' + order + '][answer][]');
  answer.setAttribute('type', 'text');
  answer.setAttribute('placeholder', 'answer');
  var delete_button = document.createElement('button');
  delete_button.innerHTML = 'Delete Question';

  delete_button.onclick = function () {
    remove_element(label);
  };

  var container = document.getElementById('question-container');
  container.appendChild(label);
  label.appendChild(type);
  label.appendChild(question);
  label.appendChild(answer);
  label.appendChild(delete_button);
}
/* Pre:  function to be onloaded to MC button
 * Post:  onclick function create question or delete
 * Purpose: Create MC questions for an activity.
 ********************************************************************/


function add_mc() {
  var order = document.getElementById('question-container').childElementCount;
  var label = document.createElement('label');
  label.setAttribute('for', 'module[' + order + '][question]');
  label.setAttribute('label', 'Multiple Choice Question');
  label.innerHTML = 'Multiple Choice Question';
  var type = document.createElement('input');
  type.setAttribute('name', 'module[' + order + '][type]');
  type.setAttribute('type', 'hidden');
  type.setAttribute('value', 'mc');
  var question = document.createElement('input');
  question.setAttribute('name', 'module[' + order + '][question]');
  question.setAttribute('type', 'text');
  question.setAttribute('placeholder', 'question');
  var delete_button = document.createElement('button');
  delete_button.innerHTML = 'Delete Question';

  delete_button.onclick = function () {
    remove_element(label);
  };

  var container = document.getElementById('question-container');
  container.appendChild(label);
  label.appendChild(type);
  label.appendChild(question);

  for (var i = 0; i < 4; i++) {
    var placement = document.createElement('input');
    placement.setAttribute('name', 'module[' + order + '][placement][]');
    placement.setAttribute('type', 'text');
    placement.setAttribute('placeholder', 'placement: for example \"a)\"');
    var answer = document.createElement('input');
    answer.setAttribute('name', 'module[' + order + '][answer][]');
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
  var order = document.getElementById('question-container').childElementCount;
  var label = document.createElement('label');
  label.setAttribute('for', 'module[' + order + '][question]');
  label.setAttribute('label', 'Short Answer');
  label.innerHTML = 'Short Answer';
  var type = document.createElement('input');
  type.setAttribute('name', 'module[' + order + '][type]');
  type.setAttribute('type', 'hidden');
  type.setAttribute('value', 'sa');
  var question = document.createElement('input');
  question.setAttribute('name', 'module[' + order + '][question]');
  question.setAttribute('type', 'text');
  question.setAttribute('placeholder', 'question');
  var answer = document.createElement('input');
  answer.setAttribute('name', 'module[' + order + '][answer][]');
  answer.setAttribute('type', 'text');
  answer.setAttribute('placeholder', 'expected answer');
  var delete_button = document.createElement('button');
  delete_button.innerHTML = 'Delete Question';

  delete_button.onclick = function () {
    remove_element(label);
  };

  var container = document.getElementById('question-container');
  container.appendChild(label);
  label.appendChild(type);
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