<!doctype html>
<html>

<?php $GroupID = $_GET['id']; ?>

<head>
<?php include '/var/www/static.codefreak.co.uk/structure/includes/meta.ssi'; ?>
</head>

<body>
<?php include '/var/www/static.codefreak.co.uk/structure/includes/head.ssi'; ?>

<br>
<!-- DASHBOARD BUTTONS -->
<div id="profile-commands" class="container radius">
<a href="https://www.codefreak.co.uk/dashboard/"><div id="profile-dashboard" class="btn success">Dashboard</div></a>
<a href="https://www.codefreak.co.uk/profiles/"><div id="profile-search" class="btn success">Profiles</div></a>
<a href="https://www.codefreak.co.uk/groups/"><div id="profile-groups" class="btn success">Groups</div></a>
<a href="https://www.codefreak.co.uk/groups/?id=<?php echo $groupset ?>&page=members"><div id="profile-members" class="btn warning">Members</div></a>
<?php 
$isadmin = mysqli_num_rows(mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $GroupID AND UserID = $userID AND group_rank = 'admin'" ));
if($isadmin == 1) {
?>
<a href="https://www.codefreak.co.uk/groups/?id=<?php echo $groupset ?>&page=settings"><div id="profile-settings" class="btn danger">Edit Group</div></a>
<?php } ?>
</div>

<br>
<!-- DASHBOARD BUTTONS END -->

<?php switch ($_GET['page']) { // PHP Switch to choose between the group pages, I figured it was easier this way than to actually try and make a conventional navigation.
	case "": // Case "" is the default page where no $_GET param have been passed other than the ID param to load the page.
 ?>

<?php
$GroupData = mysqli_query($db,"SELECT * FROM db_groups WHERE GroupID = $GroupID");
$GroupData = mysqli_fetch_array($GroupData);
echo "<div id='group-banner' class='container radius'>";
echo "<div id='group-name' class='group-name'>".$GroupData['group_name']."</div>";
echo "</div>";
?>

<br>

<div class="container">
<?php
$result = mysqli_query($db,"SELECT * FROM db_groups_posts WHERE GroupID = $GroupID ORDER BY `post_created` DESC");

$n1=0; $n2=0;

// If there are any posts, recursively load them.
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
		
		$post = mysqli_query($db,"SELECT username FROM db_identification WHERE UserID = $row[UserID]");
		$post = mysqli_fetch_array($post);
		$posthash = hash("sha256",$post["username"]);
		
		$comments = mysqli_query($db,"SELECT * FROM db_groups_posts_comments WHERE PostID = $row[PostID]");
		
		echo "<div class='post'>\n";
        echo "<div class'post-author'><a href='https://www.codefreak.co.uk/profiles/?username=".$post["username"]."'><img style='width:55px;height:55px;' src='https://static.codefreak.co.uk/userdata/".$posthash."/".$posthash."_gravatarLarge.jpg' alt''/></a>\n
		<a href='https://www.codefreak.co.uk/profiles/?username=".$post["username"]."'><div class='post-author'>&nbsp;".$post["username"]."</div></a></div> <div class='post-date'>".$row['post_created']."</div>\n 
		<a href='https://www.codefreak.co.uk/groups/?post=".$row['PostID'] ."'><div class='post-permalink'>Permalink</div></a>\n <hr> \n";
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

<hr class="container">

<?php 
$ismem = mysqli_num_rows(mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $GroupID AND UserID = $userID"));

if($ismem == 1) { ?>

<div id="post-create" class="container">
<form method="post">
<textarea id="post-input" type="text" name="post-contents" placeholder="Write something..."></textarea>
<button type="submit" class="btn btn-xxblock success" name="post-submit">Post</button>
</form>
</div>

<?php  } else { echo "<div class='container btn-x info'>You need to be a member of this group to post!</div>"; }?>

<?php if($errMSG != "") { echo $errMSG; }; ?>

<br>


<style>
#group-banner {
	background:url('<?php echo $GroupData['group_banner'] ?>');
	background-size:cover;
	background-color:rgba(102,102,102,0.2);
}
</style>

<?php
break;

case "settings": // Case settings; Its clearly easier and more efficient to store the settings and members pages in their own files instead of trying to put all the code on this page just for 2/3 of it to be ignored.
require_once 'settings.php';
break;
};
?>

</body>
</html>