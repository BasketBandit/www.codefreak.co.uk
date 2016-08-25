<?php 
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_init.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_connect.php';
 require_once '/var/www/static.codefreak.co.uk/structure/session/session_check.php'; 
 require_once '/var/www/static.codefreak.co.uk/structure/session/db_retrieve.php';

if(isset($_POST['save'])) { 
	 	 
 $steam = trim($_POST['account_steam']);
 $steam = strip_tags($steam);
 
 $twitch = trim($_POST['account_twitch']);
 $twitch = strip_tags($twitch);
 
 $twitter = trim($_POST['account_twitter']);
 $twitter = strip_tags($twitter);
 
 $banner = trim($_POST['account_banner']);
 $banner = strip_tags($banner);
 
 $background = trim($_POST['account_background']);
 $background = strip_tags($background);
 
 $displayUsername = trim(isset($_POST['displayUsername'][0]) ? 1 : 0);
 $displayAvatar = trim(isset($_POST['displayAvatar'][0]) ? 1 : 0);
 $displayGroups = trim(isset($_POST['displayGroups'][0]) ? 1 : 0);
 $displayTwitch = trim(isset($_POST['displayTwitch'][0]) ? 1 : 0);
 $displaySteam = trim(isset($_POST['displaySteam'][0]) ? 1 : 0);
  
 $query = "UPDATE db_identification SET account_steam='$steam', account_twitch='$twitch', account_twitter='$twitter', account_banner='$banner', account_background='$background', displayUsername='$displayUsername', displayAvatar='$displayAvatar', displayTwitch='$displayTwitch', displaySteam='$displaySteam', displayGroups='$displayGroups' WHERE username='$username'";
 $res = mysqli_query($db,$query);
  
  if ($res) {
   $errTyp = "success";
   $errMSG = "Update successful! Refreshing in 2 seconds...";
   header("refresh:2;");
  } else {
   $errTyp = "danger";
   $errMSG = "Something went wrong, refreshing in 2 seconds...";
   header("refresh:2;");
  } 
 
}
?>

<!doctype html>
<html>

<head>
<?php include '/var/www/static.codefreak.co.uk/structure/includes/meta.ssi'; ?>
</head>

<body>

<?php include '/var/www/static.codefreak.co.uk/structure/includes/head.ssi'; ?>
<br>

<!-- DASHBOARD BUTTONS -->
<?php include '/var/www/static.codefreak.co.uk/structure/includes/navigation.ssi'; ?>
<!-- DASHBOARD BUTTONS END -->

<div class="container">

<!-- UNCHANGABLE STUFF (UNLESS CONTACTED DIRECTLY) -->

<table class="profile-tables" cl>
<th>Profile</th> <th>Value</th>
<tr>
<td>Username</td> <td><?php echo $userData['username'] ?></td>
</tr>
<tr>
<td>Email Address</td> <td><?php echo $userData['account_email'] ?></td>
</tr>
<tr>
<td>Login IP</td> <td><?php echo $userData['ipv4_loginlast'] ?></td>
</tr>
</table>

</div>

<!-- UNCHANGABLE STUFF END -->

<br>&nbsp;<br>

<!-- EDIT PROFILE -->

<div class="container">

<form method="post">

<table id="profile-settings" class="profile-tables">
<th>Setting</th><th>Current</th><th>New</th>
<tr>
<td>Banner (URL) (117:20)</td> <td><?php echo $userData['account_banner'] ?></td> <td><input type="text" name="account_banner" class="btn" value="<?php echo $userData['account_banner'] ?>" /></td>
</tr>
<tr>
<td>Background Image (URL)</td> <td><?php echo $userData['account_background'] ?></td> <td><input type="text" name="account_background" class="btn" value="<?php echo $userData['account_background'] ?>" /></td>
</tr>
</table>

<br>

<table id="profile-checks" class="profile-tables">
<th>Setting</th><th>Value</th>
<tr>
<td>Display Username (Banner)</td> <td><input type='checkbox' name='displayUsername[0]' value='1' <?php if ($userData['displayUsername'] == 1) { echo "checked"; } ?>></td> 
</tr>
<tr>
<td>Display Avatar (Banner)</td> <td><input type='checkbox' name='displayAvatar[0]' value='1' <?php if ($userData['displayAvatar'] == 1) { echo "checked"; } ?>></td>
</tr>
<tr>
<td>Display Groups (Module)</td> <td><input type='checkbox' name='displayGroups[0]' value='1' <?php if ($userData['displayGroups'] == 1) { echo "checked"; } ?>></td>
</tr>
<tr>
<td>Display Twitch (Module)</td> <td><input type='checkbox' name='displayTwitch[0]' value='1' <?php if ($userData['displayTwitch'] == 1) { echo "checked"; } ?>></td>
</tr>
<tr>
<td>Display Steam (Module)</td> <td><input type='checkbox' name='displaySteam[0]' value='1' <?php if ($userData['displaySteam'] == 1) { echo "checked"; } ?>></td>
</tr>
</table>

<br>

<table id="profile-accounts" class="profile-tables">
<th>Profile</th><th>Current</th><th>New</th>
<tr>
<td>Steam ID (ID64 or customURL)</td> <td><?php echo $userData['account_steam'] ?></td> <td><input id="restrict_steam" type="text" name="account_steam" class="btn" value="<?php echo $userData['account_steam'] ?>" /></td>
</tr>
<tr>
<td>Twitch Username</td> <td><?php echo $userData['account_twitch'] ?></td> <td><input id="restrict_twitch" type="text" name="account_twitch" class="btn" value="<?php echo $userData['account_twitch'] ?>" /></td>
</tr>
<tr>
<td>Twitter Username</td> <td>@<?php echo $userData['account_twitter'] ?></td> <td><input id="restrict_twitter" type="text" name="account_twitter" class="btn" value="<?php echo $userData['account_twitter'] ?>" /></td>
</tr>
</table>

<br>

<button type="submit" class="btn btn-xxblock success" name="save">Save</button><a href="dashboard"><div class="btn btn-xxblock danger">Cancel</div></a>
</form>

<br>

   <?php if ( isset($errMSG) ) { ?>
    <div class="form-group"><div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>"><span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?></div></div>
   <?php } ?>
   
</div>

<script>
  $("#restrict_steam").alphanum({
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
  
  $("#restrict_twitch").alphanum({
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
  
  $("#restrict_twitter").alphanum({
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

<!-- EDIT PROFILE END -->

</body>
</html>