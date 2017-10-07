<?php
require_once 'app/init.php';

$db = new DB;
$googleClient = new Google_Client;

$auth = new GoogleAuth($db, $googleClient);

if ($auth->checkRedirectCode()) {
	header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Game</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="style.css"/> 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="./js/jquery.stayInWebApp.min.js"></script>
	<script type="text/javascript">
	function lookup(){
		var searchTxt = $('#username_box').val();
		$.post('lookup.php', {searchVal: searchTxt},
			function (output){
				$('#username_box').val(output);
			});
	}
	function sqlOptions(){
		var sOption = $('#sqlopts').val();
		$.post('lookup.php', {sqlOptions: sOption},
			function (output){
				$('#scoretable').html(output);
		});
	}
	window.onload = function() {
  		lookup();
  		sqlOptions();
  	};
	</script>
	<script src="./js/main.js"></script>
</head>

<body>
<div id="page">

<!--Main Page-->
	<div id="open" class="appPage">

	<i class="fa fa-diamond fa-5x fa-spin" style="margin-top: 30px; color: white;" ></i></br>
	<h1>Game Spot</h1></br>
	<div id="buttons">
		<button id="play">Play</button>
		<button id="TopP">Top Players</button>
		</br>
		
		<?php if(!$auth->isLoggedIn()): ?>
			<a href="go.php"><button id="signin_button" ><i class="fa fa-google"></i> Sign In</button></a>
		<?php else: ?>
			<button id="account_button">My Account</button>
			<a href="logout.php" ><button id="signout_button" >Sign Out</button></a>
			
		<?php endif; ?>
	</div>
	</div>

<!--Games-->
	<div id="games" class="appPage">
		<i class="fa fa-arrow-left fa-2x backPage" ></i>
		<div style="text-align:center;">
			<h1>Games</h1>
			<a href="./games/2048"><div class="gameButton">2048</div></a>
			<a href="./games/hextris"><div class="gameButton">Hextris</div></a>
			<a href="./games/FloppyBird"><div class="gameButton">Floppy Bird</div></a>
			<a href="./games/Zop"><div class="gameButton">Zop</div></a>
			<a href="./games/Pacman"><div class="gameButton">Pacman</div></a>

		</div>
	</div>

<!--Top Players Page-->
	<div id="topPlayers" class="appPage">
		<i  class="fa fa-arrow-left fa-2x backPage" ></i>
		<div style="text-align:center;width: 95vw;margin: 0 auto;">
		<h1>Top Players</h1>
		<div class="dropdown">
			<select id="sqlopts" onchange="sqlOptions();" class="dropdown-select">
				<option selected >All Games</option>
				<option>2048</option>
				<option>Hextris</option>
				<option>Floppy Bird</option>
				<option>Zop</option>
				<option>Pacman</option>
			</select>
		</div>
		<table cellspacing="0" align="center" style="width:100%;">
			 <thead>
			    <tr>
			      <th style="width:2%;"></th>
			      <th style="width:42%;">Player</th> 
			      <th style="width:20%;">Score</th> 
			      <th>Game</th>
			    </tr>
			  </thead>
              </table>
              <div class="scrolls2">
              <table cellspacing="0" align="center" style="width:100%;padding-top:0px;">
			  <tbody id="scoretable">
			  	
			  </tbody>
		</table>
		</div>
		</div>
	</div>

<!--Account Page-->
	<div id="account_page" class="appPage">
	<i class="fa fa-arrow-left fa-2x backPage"></i>
	</br>
			Username
			</br>
			<span id="u_cont">
			<input id="username_box" type="text" style="" readonly="true" value="" maxlength="25"><span id="lock_inp"><i id="lockunlock" class="fa fa-lock fa-2x"></i></span>
			</span>
	</div>
</div>
</body>
</html>