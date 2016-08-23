<?php
 ob_start();
 session_start();
 if(isset($_SESSION['user'])!="" ){
 	header("Location: dashboard");
 }
	
 include_once 'db_connect.php';

 $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

 if(isset($_POST['btn-signup'])) {
  
 $uname = trim($_POST['uname']);
 $email = trim($_POST['email']);
 $upass = trim($_POST['pass']);
 
 $uname = strip_tags($uname);
 $email = strip_tags($email);
 $upass = strip_tags($upass);
 
 // password encrypt using SHA256();
 $password = hash('sha256', $upass);
 
 // check email exist or not
 $result = mysqli_query($db,"SELECT account_email FROM db_identification WHERE account_email='$email'");
 
 $count = mysqli_num_rows($result); // if email not found then proceed
 
 if ($count==0) {
 
  $res = mysqli_query($db,"INSERT INTO db_identification (username, account_email, account_password, account_created, ipv4_registered, displaySteam, displayTwitch) VALUES('$uname','$email','$password', CURRENT_TIMESTAMP, '$ip', '0', '0');");
  
  if ($res) {
   $errTyp = "success";
   $errMSG = "successfully registered, you will be directed to the login page!";
   header("refresh:2;url=http://www.codefreak.co.uk");
  } else {
   $errTyp = "danger";
   $errMSG = "Something went wrong, try again later..."; 
  } 
   
 } else {
  $errTyp = "warning";
  $errMSG = "Sorry Email already in use ...";
 }
 
}
?>
<!doctype html>
<html>
<head>
<meta charset=utf-8" />
<title>www.codefreak.co.uk | Register</title>
<?php include 'meta.ssi'; ?>
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off">
    
     <div class="col-md-12">
        
         <div class="form-group">
             <h2 id="title" class="light">CODEFREAK</h2>
            </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon restrict"><span class="glyphicon glyphicon-user"></span></span>
             <input id="restrict_username" type="text" name="uname" class="form-control" placeholder="Username" required />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
             <input type="email" name="email" class="form-control" placeholder="Email" required />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input id="restrict" type="password" name="pass" class="form-control" placeholder="Password" required />
                </div>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="https://www.codefreak.co.uk"><div class="btn btn-block success">Login</div></a> <br>
             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
            <div class="form-group">
             <a href="index.php">Sign in Here...</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>

<script>
  $("#restrict_username").alphanum({
    allow              : '_',
    disallow           : '',
    allowSpace         : false,
    allowNumeric       : true,
    allowUpper         : true,
    allowLower         : true,
    allowCaseless      : true,
    allowLatin         : true,
    allowOtherCharSets : false,
    forceUpper         : false,
    forceLower         : false,
    maxLength          : NaN
  });
</script>

</body>
</html>