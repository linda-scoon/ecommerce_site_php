<?php
require('includes/application_top.php');
unset($_SESSION['email']);
unset($_SESSION['checkout']);
$_SESSION['state_msg'] = "You have been successfully logged out";
header("Location: index.php");
