/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/tags.js ***!
  \******************************/
/* Description:
 * The resource tagging system works with three different main
 * collections.
 * 1.) tag-container: the list of all tags that exist for the user to 
 * choose from.
 * 2.) resource-tags: the human-readable list of tags associated
 * with the resource.
 * 3.) resource-tag-ids: the id's of all tags to be submitted with the
 * resource. (This collection is hidden from the user.)
 * 
 * When a user clicks on a tag in the tag-container collection, it 
 * should add that tag to the resource-tags collection as well as
 * the id of said tag in the resource-tag-ids collection.
 * 
 * When a user clicks on a tag in the resource-tags collection, it
 * should remove that tag from both the resource-tags collection
 * itself as well as the resource-tag-ids collection.
 ********************************************************************/

/* Pre:  all resource tags
 * Post:  onclick function to remove resource tag
 * Purpose: Adds a tag to the array of tags associated with a 
 * resource.
 ********************************************************************/
function addTag(tag) {
  console.log("ADDING...");
  console.log(tag); // gather elements to input, display, and submit to the form

  var tagInput = document.createElement('input');
  var resourceTags = document.getElementById('resource-tags');
  var resourceTagIds = document.getElementById('resource-tag-ids'); // create the input element

  tagInput.type = 'hidden';
  tagInput.name = 'tags[' + resourceTags.childElementCount + '][id]';
  tagInput.value = tag.dataset.tid;
  tagInput.classList.add('resource-tag-id'); // add tags to respective containers

  newTag = resourceTags.appendChild(tag);
  resourceTagIds.appendChild(tagInput); // link remove function to new tag

  newTag.onclick = removeTag.bind(this, newTag, tagInput);
}
/* Pre:  tag to remove, tag id to remove
 * Post:  onclick function to add resource tag
 * Purpose: Removes tag and tag id from respective collections
 * and resets resource tag id collection name indices.
 ********************************************************************/


function removeTag(tag, tagInput) {
  // gather collections to re-add tag and remove id
  var tagContainer = document.getElementById('tag-container');
  var resourceTagIds = document.getElementById('resource-tag-ids'); // remove id from resource tag ids collection

  resourceTagIds.removeChild(tagInput); // move tag from resource tag collection to tag container collection

  oldTag = tagContainer.appendChild(tag); // change function to add tag

  oldTag.onclick = addTag.bind(this, oldTag); // reset index on names of resource tag ids

  resetTagIndices();
}
/* Pre:  name of class containing name indices to reset
 * Post:  none
 * Purpose: Resets all the indices of the specified class collection.
 * Mainly used for resetting tag id indices.
 ********************************************************************/


function resetTagIndices() {
  var collectionClass = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : "resource-tag-id";
  var collection = document.getElementsByClassName(collectionClass);

  for (index = 0; index < collection.length; index++) {
    collection[index].name = "tags[" + index + "][id]";
  }
}
/* Pre:  none
 * Post:  onclick function
 * Purpose: Links all tags to the add or remove function.
 ********************************************************************/


window.onload = function () {
  // bind tag container to add function.
  var tags = document.getElementsByClassName('tag-container-tag');

  for (index = 0; index < tags.length; index++) {
    tags[index].onclick = addTag.bind(this, tags[index]);
  } // bind resource tags to remove function


  var resourceTags = document.getElementsByClassName('resource-tag');
  var resourceTagIds = document.getElementsByClassName('resource-tag-id');

  for (index = 0; index < resourceTags.length; index++) {
    resourceTags[index].onclick = removeTag.bind(this, resourceTags[index], resourceTagIds[index]);
  }
};
/******/ })()
;