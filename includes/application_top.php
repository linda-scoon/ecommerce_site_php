<?php
include('configure.php');

if (DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
require('includes/functions/func_db.php');
require('includes/functions/func_validate.php');
include('includes/functions/func_img.php');

// connect to the database
$conn = db_connect($config);