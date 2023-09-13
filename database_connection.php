<?php

$databaseHost = "db";
$databaseUsername = "db";
$databasePassword = "db";
$databaseName = "db";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($databaseHost, $databaseUsername, $databasePassword, $databaseName);

//$connection = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if (!$mysqli) {
    echo "Database connection failed.";
    die();
}