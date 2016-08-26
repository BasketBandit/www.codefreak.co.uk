<?php
if($_GET['action'] = "join") { 
////
   $GroupID = $_GET['join'];
   $private = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM db_groups WHERE GroupID = $GroupID"));
   if($private['group_privacy'] == 0) { 
     ///
	 if($_GET['user'] == $userID) { 
	 	$GroupID = $_GET['join'];
	 	$val = mysqli_query($db,"SELECT UserID, GroupID FROM db_groups_membership WHERE GroupID =".$GroupID);
	 	$val = mysqli_fetch_array($val);
		$errJoin = "";
		// 
	 	if($query = mysqli_num_rows(mysqli_query($db,"SELECT UserID, GroupID FROM db_groups_membership WHERE GroupID = ".$GroupID." AND UserID = ".$userID)) == 0) {
			mysqli_query($db,"INSERT INTO db_groups_membership (UserID, GroupID, group_rank) VALUES('$userID','$groupID', 'member')");
			header("refresh:5;url=https://www.codefreak.co.uk/groups/"); 
			$errJoin = "";
	 	} else {
	    	$errJoin = "<div class='btn btn-block danger'>You are already in this group!</div>";
	 	};
		//
	 };
	 ///
   } else { $errJoin = "<div class='btn btn-block danger'>This group is private.</div>"; };
}; 
//// 
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
	switch($_GET) {
	case !isset($_GET['post']):
?>

<?php
if ($errJoin != "") {
	echo "<div class='container'>";
	echo $errJoin;
	echo "</div><br>";
}

$result = mysqli_query($db,"SELECT * FROM db_groups WHERE group_visibility = 0");
$n1=0; $n2=0;

// If there are any groups, recursively load them.
if (mysqli_num_rows($result) > 0) {
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
			echo "<div class='group-join'><form method='get'><input type='hidden' name='user' value=".$userID."><button type='submit' class='btn btn-block success' name='join' value=".$Group.">Join Group</button><input type='hidden' name='action' value='join'></form></div>"; 
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

<?php 
	break;
	case isset($_GET['post']):
?>

<div class="container">
<?php
$PostID = $_GET['post'];
$result = mysqli_query($db,"SELECT * FROM db_groups_posts WHERE PostID = $PostID");
$n1=0; $n2=0;

// If there are any posts, recursively load them.
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		
		$post = mysqli_query($db,"SELECT username FROM db_identification WHERE UserID = $row[UserID]");
		$post = mysqli_fetch_array($post);
		$posthash = hash("sha256",$post["username"]);
		
		$comments = mysqli_query($db,"SELECT * FROM db_groups_posts_comments WHERE PostID = $row[PostID]");
		
		$resultgroup = mysqli_query($db,"SELECT * FROM db_groups WHERE GroupID = $row[GroupID]");
		$resultgroup = mysqli_fetch_array($resultgroup);
		
		echo "\n<div class='post'>\n";
        echo "<a href='https://www.codefreak.co.uk/profiles/?username=".$post["username"]."'><div class'post-author'><img style='width:55px;height:55px;' src='https://static.codefreak.co.uk/userdata/".$posthash."/".$posthash."_gravatarLarge.jpg' alt''/>\n";
		echo "<div class='post-author'>&nbsp;".$post["username"]." posted to <a href='https://www.codefreak.co.uk/groups/?id=".$row['GroupID'] ."'><b>".$resultgroup['group_name']."</b></a></div></div></a> <div class='post-date'>".$row['post_created']."</div>\n <hr>\n";
		echo "<div class='post-contents'>" .$parsedown->text(preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"1100\" height=\"619\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$row["post_contents"])) ."</div>";
		echo "</div>\n";
		
		// If there are any comments, recursively load them.
		if (mysqli_num_rows($comments) > 0) {	
			while($comment = mysqli_fetch_assoc($comments)) {
				
				$contribute = mysqli_query($db,"SELECT username FROM db_identification WHERE UserID = $comment[UserID]");
				$contribute = mysqli_fetch_array($contribute);
				$contributehash = hash("sha256",$contribute["username"]);
						
		echo "<div class='post-comment'>
		<a href='https://www.codefreak.co.uk/profiles/?username=".$contribute["username"]."'><img class='user-comment-avatar' style='width:45px;height:45px;' src='https://static.codefreak.co.uk/userdata/".$contributehash."/".$contributehash."_gravatarLarge.jpg' alt''/></a> 
		<div class='comment-contents'><a href='https://www.codefreak.co.uk/profiles/?username=".$contribute["username"]."'><b>".$contribute["username"]."</b></a> ".$comment['comment_contents']."<br> <span class='comment-time'>" .$comment['comment_created']."</span></div></div>";
		}};
		
		echo "<div class='post-comments'>\n
		<form method='post'>\n
		<input type='hidden' name='PostID' value='".$row['PostID']."'/>\n
		<input class='comment-input' type='text' name='comment-contents' placeholder='Leave a comment...' autocomplete='off'/>\n
		</form>\n
		</div>\n";
    }
} else {
    echo "<div class='container'> No posts! :( </div>";
}
?>
</div>
		
<?php		
	break;
	};
?>

</body>
</html>