<?php
 session_start();
 
 if (!isset($_SESSION['user'])) {
  header("Location:http://www.codefreak.co.uk");
 } else if(isset($_SESSION['user'])!="") {
  header("Location: /dashboard/");
 }
 
 if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['user']);
  header("Location:http://www.codefreak.co.uk");
  exit;
 }