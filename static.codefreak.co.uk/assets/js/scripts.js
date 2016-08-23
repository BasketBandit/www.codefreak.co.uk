	
	try {
	var n = 0;
	} catch(err) {};
	
	try {
	var a = "achievement-overlay";
	} catch(err) {};
	
	try {
	var ban1 = document.getElementById("ban2").innerHTML;
	} catch(err) {};
	
	try {
	var ban2 = document.getElementById("ban3").innerHTML;
	} catch(err) {};
	
	try {
	var ban3 = document.getElementById("ban6").innerHTML;
	} catch(err) {};
	
	try {
	var profilestate = document.getElementById("profilestate").innerHTML;
	} catch(err) {};

try {	
switch (profilestate) {
	case "":
		document.getElementById("profilestate").innerHTML = "OFFLINE";
		document.getElementById("profilestate").className += " offline";
		break;
	case "0":
		document.getElementById("profilestate").innerHTML = "OFFLINE";
		document.getElementById("profilestate").className += " offline";
		break;
	case "1":
		document.getElementById("profilestate").innerHTML = "ONLINE";
		if (document.getElementById("game-info").innerHTML != "") {
			document.getElementById("profilestate").className += " success";
		} else {
			document.getElementById("profilestate").className += " info";
			document.getElementById("sectionXX").remove();
		};
		break;
	case "2":
		document.getElementById("profilestate").innerHTML = "BUSY";
		document.getElementById("profilestate").className += " warning";
		break;
	case "3":
		document.getElementById("profilestate").innerHTML = "AWAY";
		document.getElementById("profilestate").className += " info";
		break;
	case "4":
		document.getElementById("profilestate").innerHTML = "SNOOZE";
		document.getElementById("profilestate").className += " info";
		break;
	case "5":
		document.getElementById("profilestate").innerHTML = "lOOKING TO TRADE";
		document.getElementById("profilestate").className += " info";
		break;
	case "6":
		document.getElementById("profilestate").innerHTML = "LOOKING TO PLAY";
		document.getElementById("profilestate").className += " info";
		break;
};
} catch(err) {};

try {
if (document.getElementById("hourstotal").innerHTML == "") {
	document.getElementById("hourstotal").innerHTML = "0";
};
} catch(err) {};

try {
if (document.getElementById("game-ip").innerHTML == "") {
	document.getElementById("game-ip").innerHTML = "N/A";
}
} catch(err) {};

try {
if (document.getElementById("steam-privacy").innerHTML == "1") {
	document.getElementById("steam-privacy").innerHTML = "PRIVATE PROFILE";
	document.getElementById("steam-privacy").className += " danger";
	document.getElementById("steam").innerHTML = "<img id='private' src='../../a/img/private.png' alt='private'>";
} else {
	document.getElementById("steam-privacy").innerHTML = "PUBLIC PROFILE";
	document.getElementById("steam-privacy").className += " success";
};
} catch(err) {};
	
try {
	document.getElementById("ban6").innerHTML = ban3 + " DAY(S) SINCE LAST BAN";
} catch(err) {};

try {
if (ban1 == "1") {
	var banmessage1 = " VAC BAN";
} else {
	var banmessage1 = " VAC BANS";
};
} catch(err) {};

try {
if (ban2 == "1") {
	var banmessage2 = " GAME BAN";
} else {
	var banmessage2 = " GAME BANS";
};
} catch(err) {};

try {
if (document.getElementById("ban1").innerHTML != "") {
	document.getElementById("ban1").className += " danger";
	document.getElementById("ban1").innerHTML = "VAC BANNED";
} else {
	document.getElementById("ban1").className += " success"
	document.getElementById("ban1").innerHTML = "NOT VAC BANNED"; 
};
} catch(err) {};

try {
if (document.getElementById("ban2").innerHTML != "0") {
	document.getElementById("ban2").className += " danger";
	document.getElementById("ban2").innerHTML = ban1 + banmessage1;
} else { 
	document.getElementById("ban2").className += " success";
	document.getElementById("ban2").innerHTML = "NO VAC BANS";
};
} catch(err) {};

try {
if (document.getElementById("ban3").innerHTML != "0") {
	document.getElementById("ban3").className += " danger";
	document.getElementById("ban3").innerHTML = ban2 + banmessage2;
} else { 
	document.getElementById("ban3").className += " success";
	document.getElementById("ban3").innerHTML = "NO GAME BANS"
};
} catch(err) {};

try {
if (document.getElementById("ban4").innerHTML != false) {
	document.getElementById("ban4").className += " danger";
	document.getElementById("ban4").innerHTML = "COMMUNITY BAN" 
} else { 
	document.getElementById("ban4").className += " success";
	document.getElementById("ban4").innerHTML = "NO COMMUNITY BAN" 
};
} catch(err) {};

try {
if (document.getElementById("ban5").innerHTML == "none") {
	document.getElementById("ban5").className += " success";
	document.getElementById("ban5").innerHTML = "NO ECONOMY BAN" 
} else {
	if(document.getElementById("ban5").innerHTML == "probation") {  
	document.getElementById("ban5").className += " warning";
	document.getElementById("ban5").innerHTML = "PROBATION"
	} else {
	document.getElementById("ban5").className += " danger";
	document.getElementById("ban5").innerHTML = "ECONOMY BAN"
}};
} catch(err) {};