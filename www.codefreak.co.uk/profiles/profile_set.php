<?php 
 $res = mysqli_query($db,"SELECT * FROM db_identification WHERE username='$usersearch'");
 $userData = mysqli_fetch_array($res);
 
 if ($userData) {
   $errTyp = "success";
   require_once '/var/www/static.codefreak.co.uk/structure/data/data_user.php';
  } else {
   $errTyp = "danger";
   $errMSG = "<br><div class='btn btn-block danger'>Username not recognised.</div>"; 
  };
 
?>

<!doctype html>
<html>

<head>
<?php include '/var/www/static.codefreak.co.uk/structure/includes/meta.ssi'; ?>

<style>
body {
	background:url('<?php echo $userData['account_background'] ?>');
	background-size:cover;
}

#profile {
	background:url('<?php echo $userData['account_banner'] ?>');
	background-size:cover;
	background-color:rgba(102,102,102,0.2);
}
</style>

</head>

<body>

<?php include '/var/www/static.codefreak.co.uk/structure/includes/head.ssi'; ?>

<br> 

<!-- DASHBOARD BUTTONS -->
<?php include '/var/www/static.codefreak.co.uk/structure/includes/navigation.ssi'; ?>
<!-- DASHBOARD BUTTONS END -->

<div id='profile-search' class="container">
<form method='get'><input class='btn btn-block' type='text' name='username' placeholder='Username'>
<button class='btn btn-block success' type='submit'>Search</button></form>

<?php echo $errMSG ?>
</div>

<br>

<?php
 $grav_url_large_search = "https://www.gravatar.com/avatar/" .md5(strtolower(trim($userData['account_email']))) ."?d=mm&s=" . 180;
?>

<!-- USER INFORMATION -->
<div id="profile" class="<?php echo $userData['account_rank']; ?> container radius">
<div id="profile-username" class="title <?php if ($userData['displayUsername'] == 0) { echo "hidden"; } ?>">&nbsp;<?php echo $userData['username']; ?></div>
<div id="profile-image" class="<?php if ($userData['displayAvatar'] == 0) { echo "hidden"; } ?>"><img class="profile-image radius" src="<?php echo $grav_url_large_search ?>" alt=""></div>

</div>
<!-- USER INFORMATION END -->

<br>

<!-- TWITCH INFORMATION -->
<?php if ($userData['displayTwitch'] == 1) { include '/var/www/static.codefreak.co.uk/structure/modules/module_twitch.php'; }; ?>
<!-- TWITCH INFORMATION END -->

<!-- STEAM INFORMATION -->
<?php if ($userData['displaySteam'] == 1) { include '/var/www/static.codefreak.co.uk/structure/modules/module_steam.php'; }; ?>
<!-- STEAM INFORMATION END -->

<script type="text/javascript" src="https://static.codefreak.co.uk/assets/js/scripts.js"></script>

</body>
</html>