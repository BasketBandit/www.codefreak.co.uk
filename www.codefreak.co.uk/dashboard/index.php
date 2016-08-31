<?php
//error_reporting(E_ALL);
//ini_set('display_errors', true);

 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_check.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_retrieve.php';
 
 require_once '/var/www/static.codefreak.co.uk/structure/data/data_self.php';
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

<!-- NAVIGATION BUTTONS -->
<div id="profile-commands" class="container radius">
<a href="https://www.codefreak.co.uk/dashboard/"><div id="profile-dashboard" class="btn success">Dashboard</div></a>
<a href="https://www.codefreak.co.uk/profiles/"><div id="profile-search" class="btn success">Profiles</div></a>
<a href="https://www.codefreak.co.uk/groups/"><div id="profile-groups" class="btn success">Groups</div></a>
<a href="update.php"><div id="profile-update" class="btn warning">Update</div></a>
<a href="settings.php"><div id="profile-edit" class="btn danger">Edit Profile</div></a>
</div>
<!-- NAVIGATION BUTTONS END -->

<br>

<?php
if (file_exists($file0)) {
	echo "<div class='container text'>";
    echo "<div class='btn btn-block info'>Dashboard was last updated: " . date ("F d Y H:i:s.", filemtime($file0)) ."</div>";
	echo "</div>";
}
?>

<br> 

<!-- USER INFORMATION -->
<div id="profile" class="<?php echo $userData['account_rank']; ?> container radius">
<div id="profile-username" class="title <?php if ($userData['displayUsername'] == 0) { echo "hidden"; } ?>"><?php echo $userData['username']; ?></div>
<div id="profile-image" class="<?php if ($userData['displayAvatar'] == 0) { echo "hidden"; } ?>"><img style="width:130px;height:130px" class="profile-image radius" src="https://static.codefreak.co.uk/userdata/<?php echo hash('sha256',$userData['username']) ?>/<?php echo hash('sha256',$userData['username']) ?>_gravatarLarge.jpg" alt=""></div>
</div>
<!-- USER INFORMATION END -->

<br>

<?php if ($userData['displayTwitch'] == 0) { if ($userData['displaySteam'] == 0) { echo "<div class='container rounded'><a href='settings'><div class='btn btn-block danger'>Your dashboard is looking vacant, click here to fix that!</div></a></div>"; }}; ?>

<!-- TWITCH INFORMATION -->
<?php if ($userData['displayTwitch'] == 1) { include '/var/www/static.codefreak.co.uk/structure/modules/module_twitch.php'; }; ?>
<!-- TWITCH INFORMATION END -->

<!-- STEAM INFORMATION -->
<?php if ($userData['displaySteam'] == 1) { include '/var/www/static.codefreak.co.uk/structure/modules/module_steam.php'; }; ?>
<!-- STEAM INFORMATION END -->

<script type="text/javascript" src="https://static.codefreak.co.uk/assets/js/scripts.js"></script>


</body> 
</html>