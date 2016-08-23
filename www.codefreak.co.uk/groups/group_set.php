<!doctype html>
<html>

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
<a href="https://www.codefreak.co.uk/groups/?group=<?php echo $groupName ?>&page=members"><div id="profile-members" class="btn warning">Members</div></a>
<a href="https://www.codefreak.co.uk/groups/?group=<?php echo $groupName ?>&page=settings"><div id="profile-settings" class="btn danger">Edit Group</div></a>
</div>

<br>
<!-- DASHBOARD BUTTONS END -->

<div class="container">
</div>

</body>
</html>