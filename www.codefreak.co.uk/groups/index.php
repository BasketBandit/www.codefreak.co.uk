<?php
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_check.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_retrieve.php';
 
 //ini_set('display_errors', 1);
 //error_reporting(E_ALL);
 
 $grav_url_small = "https://www.gravatar.com/avatar/" .md5(strtolower(trim($userData['account_email']))) ."?d=mm&s=" . 30;
 $grav_url_large = "https://www.gravatar.com/avatar/" .md5(strtolower(trim($userData['account_email']))) ."?d=mm&s=" . 180;
 
 $userID = $userData['UserID'];
 $groupName = $_GET['group'];
 
 if(!isset($groupName)) { 
 	include '/var/www/www.codefreak.co.uk/groups/group_unset.php';
 } else {
	include '/var/www/www.codefreak.co.uk/groups/group_set.php';
 }
 
?>