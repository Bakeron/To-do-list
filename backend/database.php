<?php
  /**
  * Open the database file and when it is missing, it creates it.
  */
  class MyDB extends SQLite3 {
      function __construct() {
         $this->open('to_do_list.db');
      }
   }
   $db = new MyDB();

  /**
  * Checks if there is a given value $_POST["value"] from the file scripts.js.
  *
  * Adds a new record to the database.
  */
  if (isset($_POST["value"])) {
    $value = $_POST['value'];
    $id = $_POST['id'];
    $sql_insert = "INSERT INTO TO_DO_LIST(ID,NAME) VALUES ('$id','$value')";
    $db->query($sql_insert);
  }

  /**
  * Checks if there is a given value $_POST["delete"]from the file scripts.js.
  *
  * Adds a new record to the database.
  */
  if (isset($_POST["delete"])) {

    $id = $_POST['delete'];
    $sql_delete = "DELETE FROM TO_DO_LIST WHERE ID = '$id'";
    $db->exec($sql_delete);

  $startID = $id + 1;
  for ($i = $startID; $i < 50; $i++) {
    $g = $i - 1;
    $sql_replace = "UPDATE TO_DO_LIST SET ID = '$g' WHERE ID = '$i'";
    $db->exec($sql_replace);
  }
}

  /**
  * Checks if there is a given value $_POST["check"] from the file scripts.js.
  *
  * Adds a new record to the database.
  */
  if (isset($_POST["check"])) {
    $value = $_POST['check'];
    $id = $_POST['id'];
    $sql_checkbox = "UPDATE TO_DO_LIST SET DONE = '$value' WHERE ID = '$id'";
    $db->exec($sql_checkbox);
  }

$db->close();