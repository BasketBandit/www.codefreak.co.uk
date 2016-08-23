<?php
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';
 
 //ini_set('display_errors', 1);
 //error_reporting(E_ALL);
 
 $loggeduser = $_SESSION['user'];
 $usersearch = $_GET['username'];
 
 if(isset($_SESSION['user'])) {
 $res2 = mysqli_query($db,"SELECT account_rank, username, account_email FROM db_identification WHERE username='$loggeduser'");
 $SELFuserData = mysqli_fetch_array($res2); 
 $grav_url_small = "https://www.gravatar.com/avatar/" .md5(strtolower(trim($SELFuserData['account_email']))) ."?d=mm&s=" . 30;
 }
 
 if(!isset($usersearch)) { 
 	include '/var/www/www.codefreak.co.uk/profiles/profile_unset.php';
 } else {
	include '/var/www/www.codefreak.co.uk/profiles/profile_set.php';
 }
 
?> 

