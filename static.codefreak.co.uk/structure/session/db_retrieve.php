<?php
 $username = $_SESSION['user'];
 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 
 $res = mysqli_query($db,"SELECT * FROM db_identification WHERE username='$username'");
 $userData = mysqli_fetch_array($res);
 
 if($ip != $userData['ipv4_loginlast']) {
	 header("Location: logout?logout");
 }
?>