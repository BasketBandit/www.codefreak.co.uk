<?php
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';
 
 //ini_set('display_errors', 1);
 //error_reporting(E_ALL);
 
 $loggeduser = $_SESSION['user'];
 $usersearch = $_GET['username'];
 
 if(isset($_SESSION['user'])) {
 $res = mysqli_query($db,"SELECT account_rank, username, account_email FROM db_identification WHERE username='$loggeduser'");
 $userData = mysqli_fetch_array($res); 
 }
 
 if(!isset($usersearch)) { 
 	include '/var/www/www.codefreak.co.uk/profiles/profile_unset.php';
 } else {
	include '/var/www/www.codefreak.co.uk/profiles/profile_set.php';
 }
 
?> 

