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
$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (!$mysqli) {
    // If
    echo "Database connection failed.";
    die();
}