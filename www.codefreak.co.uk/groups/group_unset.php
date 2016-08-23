<?php
if($_GET['action'] = "join") { 
	///
	if($_GET['user'] == $userID) { 
	 	$groupID = $_GET['groupID'];
	 	$val = mysqli_query($db,"SELECT UserID, GroupID FROM db_groups_membership WHERE GroupID =".$groupID);
	 	$val = mysqli_fetch_array($val);
		$errJoin = "";
		// 
	 	if($query = mysqli_num_rows(mysqli_query($db,"SELECT UserID, GroupID FROM db_groups_membership WHERE GroupID = ".$groupID." AND UserID = ".$userID)) == 0) {
			mysqli_query($db,"INSERT INTO db_groups_membership (UserID, GroupID, group_rank) VALUES('$userID','$groupID', 'member')");
			header("refresh:5;url=https://www.codefreak.co.uk/groups/"); 
			$errJoin = "";
	 	} else {
	    	$errJoin = "<div class='btn btn-block danger'>You are already in this group!</div>";
	 	};
		//
	} 
	///
}; 
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

<?php
if ($errJoin != "") {
	echo $errJoin;
}

$result = mysqli_query($db,"SELECT * FROM db_groups");
$n1=0; $n2=0;
$group = $row['group_name'];

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$GID = $row['GroupID'];
		echo "<a href='https://www.codefreak.co.uk/groups/?group=".$row["group_name"]."'>";
		echo "<div class='group' style='background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(".$row["group_banner"].");'>";
        echo "<div class='group-title'>".$row["group_name"]. "</div> <br> <div class='group-description'>" .$row["group_description"] ."</div>";
		echo "<div class='group-join'><form method='get'><input type='hidden' name='user' value=".$userID."><button type='submit' class='btn btn-block success' name='groupID' value=".$GID.">Join Group</button><input type='hidden' name='action' value='join'></form></div>";
		echo "</div></a>";
    }
} else {
    echo "No groups! :(";
}
?>
</div>
</body>

</html>