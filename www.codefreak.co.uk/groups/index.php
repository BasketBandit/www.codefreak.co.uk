<?php
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_check.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_retrieve.php';
 
 require_once '/var/www/static.codefreak.co.uk/assets/php/Parsedown.php';
 
 $parsedown = new Parsedown();
 
 //ini_set('display_errors', 1);
 //error_reporting(E_ALL);
 
 $userID = $userData['UserID'];
 $groupset = $_GET['id'];
 
 if(!isset($groupset)) { 
 	include '/var/www/www.codefreak.co.uk/groups/group_unset.php';
 } else {
	include '/var/www/www.codefreak.co.uk/groups/group_set.php';
 }
 
 if(isset($_POST['post-submit'])) {
	 $originalpost = $_POST['post-contents'];
	 $editedpost = trim($originalpost);
	 $editedpost = htmlspecialchars($editedpost);
	 $submitpost = mysqli_query($db,"INSERT INTO db_groups_posts (GroupID, UserID, post_contents) VALUES('$groupset', '$userID', '".addslashes($editedpost)."');");
	 
  if ($submitpost) {
   $errTyp = "success";
   $errMSG = "Post successful!";
   header("refresh:0.5;");
  } else {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..."; 
  } 
 }
	 
?>