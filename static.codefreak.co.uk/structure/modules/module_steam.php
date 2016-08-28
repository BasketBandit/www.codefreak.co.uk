<div id="steam" class="container radius">

<div class="container-title"><div class="btn btn-block success">Steam</div></div>

<a href="<?php echo $steamData['profileurl']; ?>" target="_blank"><div class="btn danger"><?php echo $steamData['personaname']; ?></div></a>
<div class="btn info">Location: <?php echo $steamData['loccountrycode']; ?></div>
<div class="btn info">Created: <?php echo gmdate("j M Y, g:i a", $steamData['timecreated']); ?></div>
<?php if($_GET['username'] != "") { ?><a href="steam://friends/add/<?php echo $steamData['steamid'] ?>"><div class="btn warning">Add Friend</div></a> <?php } ?>

<br>&nbsp;<br>

<!--<img id="steam-avatar" src="https://static.codefreak.co.uk/userdata/<?php //if(isset($_GET['username'])) { echo hash('sha256',$SearchData['username']); echo "/"; echo hash('sha256',$SearchData['username']); } else { echo hash('sha256',$userData['username']); echo "/"; echo hash('sha256',$userData['username']); }?>_steamAvatar.jpg" alt="">-->

<br>&nbsp;<br>

<div id="steam-bans">
<div id="ban1" class="btn"><?php echo $steamBans['VACBanned'] ?></div>
<div id="ban2" class="btn"><?php echo $steamBans['NumberOfVACBans'] ?></div>
<div id="ban3" class="btn"><?php echo $steamBans['NumberOfGameBans'] ?></div>
<div id="ban4" class="btn"><?php echo $steamBans['CommunityBanned'] ?></div>
<div id="ban5" class="btn"><?php echo $steamBans['EconomyBan'] ?></div>
</div>

<br>

<div id="steam-container">

<span class="dark">MOST PLAYED GAMES (<?php echo $steamGames['game_count'] ?> TOTAL)</span> <br>

<?php
	$loop = 0;
	foreach ($steamGames['games'] as $games) {	
	echo "<div class='steam-group'><a class='sort' href='http://store.steampowered.com/app/" .$games['appid'] ."/' target='_blank'>" ."<div class='steam-games'
	 style='background-image:url(http://media.steampowered.com/steamcommunity/public/images/apps/" .$games['appid'] ."/" .$games['img_logo_url'] .".jpg)'>" 
	 ."</div></a><div title='" .round((float)$games['playtime_forever'] / 60, 2) 
	 ."' class='btn steam-hours default'><span>" .round((float)$games['playtime_forever'] / 60, 2) ." HOURS</span></div></div>" ."\n"; 
	 $loop++;
	 if ($loop >= 5) {
		 break;
	 }
	};
?>
</div>

</div>

<br>
