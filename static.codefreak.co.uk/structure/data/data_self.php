<?php
$username = $_SESSION['user'];
$username = hash('sha256',$username);

	if (!is_dir($username)) {
		mkdir("/var/www/static.codefreak.co.uk/userdata/" .$username);
	}
	
	$file0 = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamSummary.json";
	$file1 = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamBadges.json";
	$file2 = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamBans.json";
	$file3 = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamGamesOwned.json";
	
	$file4 = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_twitch.json";
	
	$size = filesize($file0);

if ($size <= 0) {
	
	// WRITE FILE
	
	$write0 = fopen("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamSummary.json", "w") or die("Update failed, please contact developer!");
	$write1 = fopen("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamBadges.json", "w") or die("Update failed, please contact developer!");
	$write2 = fopen("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamBans.json", "w") or die("Update failed, please contact developer!");
	$write3 = fopen("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamGamesOwned.json", "w") or die("Update failed, please contact developer!");
	
	$write4 = fopen("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_twitch.json", "w") or die("Update failed, please contact developer!");

	// CURL_INIT
	
	$ch0 = curl_init();
	$ch1 = curl_init();
	$ch2 = curl_init();
	$ch3 = curl_init();
	
	$ch4 = curl_init();
	
	// STEAM ID CONVERSION
	
	$api = "https://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=3FEF28E142BAC5A33F6B221FF3EB1CE3&vanityurl=" .$userData['account_steam'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $api);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$json = curl_exec($ch);
	$decoded = json_decode($json, true);
	
	if ($decoded['response']['success'] == 1) {
	$steamID = $decoded['response']['steamid'];
	} else { $steamID = $userData['account_steam']; }
	
	// API LINKS
		
	$api0 = "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=3FEF28E142BAC5A33F6B221FF3EB1CE3&steamids=" .$steamID ."&format=json"; 
	$api1 =	"https://api.steampowered.com/IPlayerService/GetBadges/v1/?key=3FEF28E142BAC5A33F6B221FF3EB1CE3&steamid=" .$steamID ."&format=json";
	$api2 = "https://api.steampowered.com/ISteamUser/GetPlayerBans/v1/?key=3FEF28E142BAC5A33F6B221FF3EB1CE3&steamids=" .$steamID ."&format=json";
	$api3 = "https://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=3FEF28E142BAC5A33F6B221FF3EB1CE3&steamid=" .$steamID ."&include_appinfo=1&format=json";
	
	$api4 = "https://api.twitch.tv/kraken/channels/" .$userData['account_twitch'];
	
	// DATA COLLECTION
	
	curl_setopt($ch0, CURLOPT_URL, $api0);
	curl_setopt($ch0, CURLOPT_RETURNTRANSFER, 1);
	$json0 = curl_exec($ch0);
	fwrite($write0, $json0);
	
	curl_setopt($ch1, CURLOPT_URL, $api1);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	$json1 = curl_exec($ch1);
	fwrite($write1, $json1);
	
	curl_setopt($ch2, CURLOPT_URL, $api2);
	curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
	$json2 = curl_exec($ch2);
	fwrite($write2, $json2);
	
	curl_setopt($ch3, CURLOPT_URL, $api3);
	curl_setopt($ch3, CURLOPT_RETURNTRANSFER, 1);
	$json3 = curl_exec($ch3);
	fwrite($write3, $json3);
	
	curl_setopt($ch4, CURLOPT_URL, $api4);
	curl_setopt($ch4, CURLOPT_RETURNTRANSFER, 1);
	$json4 = curl_exec($ch4);
	fwrite($write4, $json4);
	
	// JSON DECODE
	
	$steamData = file_get_contents($file0);
	$steamData = json_decode($steamData, true);
	$steamData = $steamData['response']['players']['0'];
	
	$steamBadges = file_get_contents($file1);
	$steamBadges = json_decode($steamBadges, true);
	$steamBadges = $steamBadges['response'];
	
	$steamBans = file_get_contents($file2);
	$steamBans = json_decode($steamBans, true);
	$steamBans = $steamBans['players']['0'];
	
	$steamGames = file_get_contents($file3);
	$steamGames = json_decode($steamGames, true);
	$steamGames = $steamGames['response'];
	
	// SAVE STEAM IMAGE
	
	$avatar = $steamData['avatarfull'];
	$image = file_get_contents($avatar);
	file_put_contents("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamAvatar.jpg", $image);
	$steamImage = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_steamAvatar.jpg";
	chmod($steamImage, 0775);
	
	// SAVE GRAVATAR ICON
	
	$grav_url_small = "https://www.gravatar.com/avatar/" .md5(strtolower(trim($userData['account_email']))) ."?d=mm&s=" . 30;
    $grav_url_large = "https://www.gravatar.com/avatar/" .md5(strtolower(trim($userData['account_email']))) ."?d=mm&s=" . 130;
	
	$gravatarSmall = $grav_url_small;
	$imageGS = file_get_contents($gravatarSmall);
	file_put_contents("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_gravatarSmall.jpg", $imageGS);
	$gravatarSmall = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_gravatarSmall.jpg";
	chmod($gravatarSmall, 0775);
	
	$gravatarLarge = $grav_url_large;
	$imageGL = file_get_contents($gravatarLarge);
	file_put_contents("/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_gravatarLarge.jpg", $imageGL);
	$gravatarLarge = "/var/www/static.codefreak.co.uk/userdata/" .$username ."/" .$username ."_gravatarLarge.jpg";
	chmod($gravatarLarge, 0775);
	
	//
	
	$twitchData = file_get_contents($file4);
	$twitchData = json_decode($twitchData, true);
	
	} else {
	
	$steamData = file_get_contents($file0);
	$steamData = json_decode($steamData, true);
	$steamData = $steamData['response']['players']['0'];
	
	$steamBadges = file_get_contents($file1);
	$steamBadges = json_decode($steamBadges, true);
	$steamBadges = $steamBadges['response'];
	
	$steamBans = file_get_contents($file2);
	$steamBans = json_decode($steamBans, true);
	$steamBans = $steamBans['players']['0'];
	
	$steamGames = file_get_contents($file3);
	$steamGames = json_decode($steamGames, true);
	$steamGames = $steamGames['response'];
	
	//
	
	$twitchData = file_get_contents($file4);
	$twitchData = json_decode($twitchData, true);
		
	}
	
	// SORT GAMES
	
	usort($steamGames['games'], function($a, $b) {
   	if ($a['playtime_forever'] == $b['playtime_forever']) {
      	return 0;
   	}
   		return $a['playtime_forever'] < $b['playtime_forever'] ? 1 : -1;
	});
?>