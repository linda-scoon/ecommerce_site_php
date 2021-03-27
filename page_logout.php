<?php
require('includes/application_top.php');
unset($_SESSION['email']);
$_SESSION['state_msg'] = "You have been successfully logged out";
header("Location: index.php");
