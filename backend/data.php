<?php
  /**
  * Checking whether a file exists and $ isset assigns answer.
  */
	if (file_exists('backend/to_do_list.db')) {
		$isset = TRUE;
	} else $isset = FALSE;

  /**
  * Open the database file and when it is missing, it creates it.
  */
  class MyDB extends SQLite3 {
    function __construct() {
      $this->open('backend/to_do_list.db');
    }
  }
  $db = new MyDB();

  /**
  * Checks if the table exists in the database, where it is missing, it creates it.
  */
  if (!$isset) {
    $sql_create = "CREATE TABLE TO_DO_LIST(ID INTEGER PRIMARY KEY, NAME TEXT NOT NULL, DONE BOOLEAN default 0)";
    $db->exec($sql_create);
  }

  /**
  * Saves records from the database to variables to pass to index.php.
  */
  $sql = "SELECT * FROM TO_DO_LIST";

  $id = [];
  $name = [];
  $done = [];

  $ret = $db->query($sql);
  while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
    $id[] = $row['ID'];
    $name[] = $row['NAME'];
    $done[] = $row['DONE'];
  }

  $db->close();