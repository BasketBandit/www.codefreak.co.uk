<?php
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';

 if (isset($_SESSION['user'])!="" ) {
  header("Location: /dashboard/");
  exit;
 }
 
 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
 
 if(isset($_POST['btn-login'])) { 
  
  $username = $_POST['username'];
  $password = $_POST['account_password']; 
  $username = strip_tags(trim($username));
  $password = strip_tags(trim($password));
  
  $password = hash('sha256', $password); // Password hashing using SHA256
  
  $res = mysqli_query($db,"SELECT UserID, username, account_password FROM db_identification WHERE username='$username'");
  $row = mysqli_fetch_array($res); // Fetches database array with usernames and passwords.
  $count = mysqli_num_rows($res); // Must be a single row returned. (Obviously)
  $updateip = mysqli_query($db,"UPDATE db_identification SET ipv4_loginlast='$ip' WHERE username='$username'");
  
  if( $count == 1 && $row['account_password']==$password ) {
   $_SESSION['user'] = $row['username'];
   $updateip;
   header("Location: dashboard");
  } else {
   $errMSG = "Incorrect username/password, please try again.";
  }
 }
?>

<!doctype html>
<html>

<head>
<?php include '/var/www/static.codefreak.co.uk/structure/includes/meta.ssi';?>
</head>

<body id="login-page">

<div id="container">

<div id="login-box" class="center">
<form method="post" autocomplete="off">
    
    <div id="login-image"><img id="login-imageA" src="https://static.codefreak.co.uk/assets/img/yotsuba.png" alt=""></div>
    
    <div id="login-username"><input type="text" id="login-border1" class="btn btn-50block" name="username" placeholder="Username" required /></div>
    
    <br>
    
    <div id="login-password"><input type="password" id="login-border2" class="btn btn-50block" name="account_password" placeholder="Password" required /></div>
    
	<br>
    
    <div id="login-button"><button type="submit" class="btn btn-50block success" name="btn-login">Login</button></div>
    
</form>   
</div>

<?php if (isset($errMSG)) { ?>
 <?php echo "<div id='login-error' class='btn danger'>" .$errMSG ."</div>" ?>
<?php } ?>

</div>

<div id="login-search" class="center">
<a href="profile"><div class="btn btn-block success">Search</div></a>
</div>

</body>
</html>