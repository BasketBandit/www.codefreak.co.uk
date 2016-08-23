<?php 
 $res = mysqli_query($db,"SELECT * FROM db_identification WHERE username='$usersearch'");
 $userData = mysqli_fetch_array($res);
 
 if ($userSearch != "") {
 if ($userData) {
   $errTyp = "success";
   require_once 'data_user.php';
  } else {
   $errTyp = "danger";
   $errMSG = "<br><div class='btn btn-block danger'>Username not recognised.</div>"; 
  };
 }
 
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

<div class="container">
<?php
if ($errJoin != "") {
	echo $errJoin;
}

$unres = mysqli_query($db,"SELECT username, account_banner FROM db_identification WHERE username!='root'");
$n1=0; $n2=0;

if (mysqli_num_rows($unres) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($unres)) {
		$IUN = $row['username'];
		$UBN = $row['account_banner'];
		echo "<a href='?username=".$row['username']."'>";
		echo "<div class='profile' style='background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(".$row["account_banner"].");'>";
        echo "<div class='profile-title'>".$row["username"]. "</div>"; 
		echo "</div>";
		echo "</a>";
    }
} else {
    echo "No profiles! :(";
}
?>

<br>
<?php echo "<div>Total accounts: " .mysqli_num_rows($unres). "</div>" ?>

</div>

</body>
</html>