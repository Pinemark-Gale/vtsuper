/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/form-activity.js ***!
  \***************************************/
/* Description: A set of functions used to add fitb, mc, or sa 
 * questions when creating a activity.
 ********************************************************************/

/* Pre:  edit and create views for activities
 * Post:  reset indicies of inputs/labels
 * Purpose: Reset the indicies of inputs and labels of activity 
 * questions to avoid data loss due to the same index is submitted
 * in a form array.
 ********************************************************************/
function reset_indicies() {
  /* gather all other question elements */
  var questions = document.getElementsByClassName('activity_question');
  /* reset index of all other elements to stop duplicate numbers from 
   * appearing (using regular expression to replace index/numbers) */

  for (q_index = 0; q_index < questions.length; q_index++) {
    /* change label to match input names */
    questions[q_index].setAttribute('for', questions[q_index].getAttribute('for').replace(/[0-9]+/, q_index));
    /* reset input array indicies */

    for (i_index = 0; i_index < questions[q_index].childElementCount - 1; i_index++) {
      console.log(questions[q_index].children[i_index]);
      questions[q_index].children[i_index].setAttribute('name', questions[q_index].children[i_index].getAttribute('name').replace(/[0-9]+/, q_index));
    }
  }
}
/* Pre:  create_view
 * Post:  delete question (label and child elements)
 * Purpose: Deletes a question from the activity creation form.
 ********************************************************************/


function remove_element(to_remove) {
  /* delete the question */
  to_remove.remove();
  /* reset indicies of other questions */

  reset_indicies();
}
/* Pre:  edit_view
 * Post:  delete question (label and child elements)
 * Purpose: Deletes a question from the activity edit form.
 ********************************************************************/


function remove_parent(label_button) {
  /* delete the question */
  label_button.parentElement.remove();
  /* reset indicies of other questions */

  reset_indicies();
}
/* Pre:  function to be onloaded to FITB button
 * Post:  onclick function create question or delete
 * Purpose: Create FITB questions for an activity.
 ********************************************************************/


function add_fitb() {
  var order = document.getElementById('question-container').childElementCount;
  var label = document.createElement('label');
  label.setAttribute('class', 'activity_question');
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
/* Pre:  number
 * Post:  letter equivalent
 * Purpose: Translate MC answer number to corresponding MC
 * placement letter.
 ********************************************************************/


function translate_placement(number) {
  switch (number) {
    case 0:
      return "a)";
      break;

    case 1:
      return "b)";
      break;

    case 2:
      return "c)";
      break;

    case 3:
      return "d)";
      break;

    default:
      return "z)";
  }
}
/* Pre:  function to be onloaded to MC button
 * Post:  onclick function create question or delete
 * Purpose: Create MC questions for an activity.
 ********************************************************************/


function add_mc() {
  var order = document.getElementById('question-container').childElementCount;
  var label = document.createElement('label');
  label.setAttribute('class', 'activity_question');
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
    var correct_label = document.createElement('label');
    correct_label.setAttribute('class', 'correct_button');
    correct_label.setAttribute('for', 'module[' + order + '][correct][]');
    correct_label.setAttribute('label', 'answer correctness');
    correct_label.innerHTML = 'Incorrect';
    var correct_answer = document.createElement('input');
    correct_answer.setAttribute('name', 'module[' + order + '][correct][]');
    correct_answer.setAttribute('type', 'hidden');
    correct_answer.setAttribute('value', '0');
    correct_label.appendChild(correct_answer);
    correct_label.addEventListener('click', function () {
      var child = this.childNodes[1];

      if (child.value == "1") {
        this.childNodes[1].setAttribute('value', 0);
        child = this.childNodes[1];
        this.innerHTML = "Incorrect";
        this.appendChild(child);
      } else if (child.value == "0") {
        this.childNodes[1].setAttribute('value', 1);
        child = this.childNodes[1];
        this.innerHTML = "Correct";
        this.appendChild(child);
      }
    });
    var placement = document.createElement('input');
    placement.setAttribute('name', 'module[' + order + '][placement][]');
    placement.setAttribute('type', 'text');
    placement.setAttribute('class', 'placement');
    placement.setAttribute('value', translate_placement(i));
    var answer = document.createElement('input');
    answer.setAttribute('name', 'module[' + order + '][answer][]');
    answer.setAttribute('type', 'text');
    answer.setAttribute('placeholder', 'answer');
    label.appendChild(correct_label);
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
  label.setAttribute('class', 'activity_question');
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
  /* for activity edit view if questions already exist */


  var editDeleteButtons = document.getElementsByClassName('label_button');

  for (var index = 0; index < editDeleteButtons.length; index++) {
    editDeleteButtons[index].onclick = remove_parent.bind(this, editDeleteButtons[index]);
  }
  /* for activity edit view if MC answer already exists */


  var editCorrectButtons = document.getElementsByClassName('correct_button');

  for (var index = 0; index < editCorrectButtons.length; index++) {
    editCorrectButtons[index].addEventListener('click', function () {
      var child = this.childNodes[1];

      if (child.value == "1") {
        this.childNodes[1].setAttribute('value', 0);
        child = this.childNodes[1];
        this.innerHTML = "Incorrect";
        this.appendChild(child);
      } else if (child.value == "0") {
        this.childNodes[1].setAttribute('value', 1);
        child = this.childNodes[1];
        this.innerHTML = "Correct";
        this.appendChild(child);
      }
    });
  }
};
/******/ })()
;