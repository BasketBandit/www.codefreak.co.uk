<?php 
$valrank =  mysqli_fetch_array(mysqli_query($db,"SELECT * FROM db_groups_membership WHERE GroupID = $GroupID AND UserID = $userID"));
if($valrank['group_rank'] != 'admin') {
	session_destroy(); 
	require_once 'kill_self.php';
}

if(isset($_POST['save'])) { 
	 	 
 $groupname = trim($_POST['group_name']);
 $groupname = strip_tags($groupname);
 
 $groupdescription = trim($_POST['group_description']);
 $groupdescription = strip_tags($groupdescription);
 
 $groupbanner = trim($_POST['group_banner']);
 $groupbanner = strip_tags($groupbanner);
 
 $groupprivacy = trim(isset($_POST['group_privacy'][0]) ? 1 : 0);
 $groupvisibility = trim(isset($_POST['group_visibility'][0]) ? 1 : 0);

 $query = "UPDATE db_groups SET group_name='$groupname', group_description='$groupdescription',	group_banner='$groupbanner', group_privacy='$groupprivacy',	group_visibility='$groupvisibility' WHERE GroupID = '$GroupID'";
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

$GroupData = mysqli_query($db,"SELECT * FROM db_groups WHERE GroupID = $GroupID");
$GroupData = mysqli_fetch_array($GroupData);

?>
<!-- EDIT GROUP -->

<div class="container">

<form method="post">

<table id="group-settings" class="group-tables">
<th>Setting</th><th>Current</th><th>New</th>
<tr>
<td>Group Name</td> <td><?php echo $GroupData['group_name'] ?></td> <td><input type="text" name="group_name" class="btn" value="<?php echo $GroupData['group_name'] ?>" /></td>
</tr>
<tr>
<td>Group Description</td> <td><?php echo $GroupData['group_description'] ?></td> <td><input type="text" name="group_description" class="btn" value="<?php echo $GroupData['group_description'] ?>" /></td>
</tr>
<tr>
<td>Group Banner (4:1 | 800x200)</td> <td><?php echo $GroupData['group_banner'] ?></td> <td><input type="text" name="group_banner" class="btn" value="<?php echo $GroupData['group_banner'] ?>" /></td>
</tr>
</table>

<br>

<table id="group-checks" class="group-tables">
<th>Setting</th><th>Value</th>
<tr>
<td>Group Privacy (Unchecked/Public | Checked/Private)</td> <td><input type='checkbox' name='group_privacy[0]' value='1' <?php if ($GroupData['group_privacy'] == 1) { echo "checked"; } ?>></td> 
</tr>
<tr>
<td>Group Visibility (Unchecked/Visible | Checked/Hidden)</td> <td><input type='checkbox' name='group_visibility[0]' value='1' <?php if ($GroupData['group_visibility'] == 1) { echo "checked"; } ?>></td>
</tr>
</table>

<br>

<button type="submit" class="btn btn-xxblock success" name="save">Save</button><a href="?id=<?php echo $_GET['id']?>"><div class="btn btn-xxblock danger">Cancel</div></a>
</form>

<br>

   <?php if ( isset($errMSG) ) { ?>
    <div class="form-group"><div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?>"><span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?></div></div>
   <?php } ?>
   
</div>

<!-- EDIT PROFILE END -->

</body>
</html>