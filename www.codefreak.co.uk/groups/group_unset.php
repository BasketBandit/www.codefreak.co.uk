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

<?php
if ($errJoin != "") {
	echo "<div class='container'>";
	echo $errJoin;
	echo "</div><br>";
}

$result = mysqli_query($db,"SELECT * FROM db_groups WHERE group_visibility = 0");
$n1=0; $n2=0;

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		$Group = $row['GroupID'];
		$resrank =  mysqli_fetch_array(mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $Group AND UserID = $userID"));
		echo "<a href='https://www.codefreak.co.uk/groups/?id=".$row["GroupID"]."'>";
		echo "<div class='group container' style='background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(".$row["group_banner"].");'>\n";
        echo "<div class='group-title'>".$row["group_name"]. "</div> <br> <div class='group-description'>" .$row["group_description"] ."</div>";
		
		if($row['group_privacy'] == 0) { 
			if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $Group AND UserID = $userID")) == 1) { 
			echo "<div class='group-rank " .$resrank['group_rank']."'>".$resrank['group_rank']."</div>"; 
			} else {
			echo "<div class='group-join'><form method='get'><input type='hidden' name='user' value=".$userID."><button type='submit' class='btn btn-block success' name='groupID' value=".$Group.">Join Group</button><input type='hidden' name='action' value='join'></form></div>"; 
			};
		} else { 
			if(mysqli_num_rows(mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $Group AND UserID = $userID")) == 1) { echo "<div class='group-rank " .$resrank['group_rank']."'>".$resrank['group_rank']."</div>"; 
			} else { 
			echo "<div class='group-private'>Private Group</div>"; 
			};
		};
		// The idea of this mess is; If the group is public, either show join button or show rank if already a member OR if the group is private, display as such unless a member and then display the rank instead.
		
		echo "</div></a>\n";
    }
} else {
    echo "<div class='container'>No groups! :(</div>";
}
?>

</body>
</html>