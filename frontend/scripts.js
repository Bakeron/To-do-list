/*
  Enable strict mode.
 */
"use strict";

/**
 * Download tags home to the variables.
 */
var list = document.querySelector(".to-do-list .list"),
    button_trash = document.getElementsByClassName("trash"),
    change_checkBox = document.getElementsByClassName("checkbox"),
    button_text = document.getElementById('button_text'),
    data = "";

/**
 * [sendAjax Receives json to send Post Ajax to database.php.]
 * @param  {json} data - Receives object json.
 * @return {void}      
 */
function sendAjax(data) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "./backend/database.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send(data);
}

/**
 * [deleteOrChangeCheckboxClick Track the click of a button.]
 * @param  {number} add Adds 1 after adding add a new task.
 * @return {void}
 */
function deleteOrChangeCheckboxClick(add) {
  var max_length = 0;
  if (add) max_length = button_trash.length - 1 + 1; 
  else max_length = button_trash.length - 1;
  for (var i = 0; i < max_length; i++) {
    button_trash[i].addEventListener("click", deleteValueAjaxToPhp, false);
    change_checkBox[i].addEventListener("click", changeCheckBoxAjaxToPhp, false);
  }
}

/**
 * [changeCheckBoxAjaxToPhp Json is preparing to send the php database.]
 * @param  {event} e Keeps track of the currently clicked.
 * @return {void}
 */
function changeCheckBoxAjaxToPhp(e) {
  var id_element = e.target.parentNode.id;
  for (var i = 0; i <= change_checkBox.length - 1; i++) {
    var checked = e.target.checked;
    if (checked) {
      e.target.parentNode.className = 'checked';
      e.target.setAttribute('checked','checked');
      data = "check=1" + "&id=" + id_element;
    }
    else {
      e.target.parentNode.className = '';
      e.target.removeAttribute('checked');
      data = "check=0" + "&id=" + id_element;
    }
  }
  sendAjax(data);
  deleteOrChangeCheckboxClick();
};

/**
 * [insertHTML Adds a new element li.]
 * @return {void}
 */
function insertHTML() {
  var li = document.createElement('li'),
      input = document.createElement('input'),
      span = document.createElement('span'),
      h2 = document.createElement('h2'),
      text = document.createTextNode(button_text.value),
      trash = document.createElement('img'),
      number = list.childElementCount - 2;

  input.setAttribute('type','checkbox');
  input.setAttribute('class','checkbox');
  li.appendChild(input);
  li.appendChild(span);
  span.setAttribute('class','vertical-bars');
  li.setAttribute('id', number)
  h2.appendChild(text);
  li.appendChild(h2);
  trash.setAttribute('src','/to-do-list/frontend/trash.png');
  trash.setAttribute('class','trash');
  li.appendChild(trash);

  var penultimate_element_list = list.querySelector("li:nth-child(" + list.childElementCount + ")");
  list.insertBefore(li, penultimate_element_list);
}

/**
 * [sendValueAjaxToPhp Json is preparing to send the php database.]
 * @return {void}
 */
function sendValueAjaxToPhp() {
  var id_element = list.childElementCount - 2,
      add = 0;
  data = "value=" + button_text.value + "&id=" + id_element;
  if (button_text.value !== "") {
    insertHTML();
    sendAjax(data);
    add = 1;
    deleteOrChangeCheckboxClick(add);
  }
}

/**
 * [deleteValueAjaxToPhp Json is preparing to send the php database.]
 * @param  {event} e Keeps track of the currently clicked.
 * @return {void}
 */
function deleteValueAjaxToPhp(e) {
  var delete_element = e.target.parentNode,
      next_element = delete_element.nextElementSibling,
      add_id = 0;
  data = "delete=" + delete_element.id;
  delete_element.parentNode.removeChild(delete_element);
  for (var i = next_element.id; i < button_trash.length + 1; i++) {
    add_id = i - 1;
    if (next_element.id !== 'li_button') {
      next_element.setAttribute('id', add_id);
      next_element = next_element.nextElementSibling;
    }
  }
  sendAjax(data);
  deleteOrChangeCheckboxClick();
}

/**
 * Track the click of a button.
 */
button_click.addEventListener("click", sendValueAjaxToPhp, false);
deleteOrChangeCheckboxClick(1);

button_text.onkeypress = function(e){
  if (!e) e = window.event;
  var keyCode = e.keyCode || e.which;
  if (keyCode == '13' && button_text.value !== ""){
    sendValueAjaxToPhp();
  }
}