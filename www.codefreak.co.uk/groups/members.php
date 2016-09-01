<div class="container">

<?php // I will try to comment all of this code so it can be easily understood in the future.
$members = mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $GroupID"); // $members is equal to a SQL query that gets all information from the membership database table that matches the current groups ID.

if (mysqli_num_rows($members) > 0) { // If there are more than 0 rows (If there are any members)
    while($account = mysqli_fetch_assoc($members)) { // While recursively running through this associative array (Every member who is in the group.)
		$user = mysqli_query($db,"SELECT username FROM db_identification WHERE UserID = $account[UserID]"); // $user is equal to a SQL query which finds the username of every user who's id was retrieved in the previous query.
		$user = mysqli_fetch_array($user); // Fetch an array of all of that users data, in this case it only fetches the username.
		$userhash = hash("sha256",$user["username"]); // Use SHA256 and hash their username. (This is who I store userdata, just with hashed usernames, its almost pointless but they will always be unique because usernames are unique and it looks cool.
		
		echo "<div class='group-members'><a href='https://www.codefreak.co.uk/profiles/?username=".$user["username"]."'><img style='width:55px;height:55px;' src='https://static.codefreak.co.uk/userdata/".$userhash."/".$userhash."_gravatarLarge.jpg' alt''/></a>\n"; // Once everything has been done, echo this string onto the page.
	}
} else { echo "This group has no members! :( <br> You can be the first to join!"; } // If there aren't more than 0 members, echo this message.

?>  
 
</div>

</body>
</html>