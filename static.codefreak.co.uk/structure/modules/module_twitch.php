<div id="twitch" class="container radius">

<div class="container-title"><div class="btn btn-block success">Twitch</div></div>

<a href="https://www.twitch.tv/<?php echo $twitchData['display_name']; ?>" target="_blank"><div class="btn danger"><?php echo $twitchData['display_name']; ?></div></a>
<div class="btn info">Language: <?php echo $twitchData['broadcaster_language']; ?></div>  
<div class="btn info">Followers: <?php echo $twitchData['followers']; ?></div> 

<iframe id="twitch-player" src="https://player.twitch.tv/?channel=<?php echo $twitchData['display_name']; ?>" frameborder="0" scrolling="no"></iframe>

</div>

<br>