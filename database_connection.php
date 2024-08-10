<?php

// Database parameters.
$databaseHost = "db";
$databaseUsername = "db";
$databasePassword = "db";
$databaseName = "db";

// Ensure the MySQL client will throw the appropriate exceptions. This is the
// default setting for PHP 8.1.
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Connect to the database.
try {
  $mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);
} catch (mysqli_sql_exception $e) {
  // An error occurred when attempting to connect to the database.
  print('MySQLi connection error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine());
  exit();
}
