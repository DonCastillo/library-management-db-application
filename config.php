<?php

// $DB_HOST = 'vconroy.cs.uleth.ca';
$DB_HOST = 'localhost';
// $DB_USER = 'casd3660';
$DB_USER = 'root';
// $DB_PASS = 'db29059';
$DB_PASS = 'password';
// $DB_NAME = 'casd3660';
$DB_NAME = 'library';

$APP_NAME = 'Library Management Application';
$APP_LOGO = '';
$APP_TIMEZONE = 'America/Edmonton';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

session_start();
?>
