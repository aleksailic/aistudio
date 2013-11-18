<?php
	session_start();
	if( empty($_POST['username']) || empty($_POST['pass'])){
		//not logged in
	}else{
		//ckeck if login info is correct
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>AI Studio v0.1</title>
	<meta charset="utf-8">
	<script src="http://codeorigin.jquery.com/jquery-1.10.2.min.js"></script>
	<script src="js/prefixfree.min.js"></script>

	<script src="js/Breakout.min.js"></script>

	<link rel="stylesheet" href="circle.skin/circle.player.css">
	<script type="text/javascript" src="js/jquery.transform2d.js"></script>
	<script type="text/javascript" src="js/jquery.grab.js"></script>
	<script type="text/javascript" src="js/jquery.jplayer.js"></script>
	<script type="text/javascript" src="js/mod.csstransforms.min.js"></script>
	<script type="text/javascript" src="js/circle.player.js"></script>


	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/modal.css">
	<script src="js/modal.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<nav id="auth_header">
		<ul>
			<li><a href="#">Login</a></li>
			<li><a href="#">Settings</a></li>
			<li><a href="#">About</a></li>
		</ul>
	</nav>
	<div id="wrapper">
		<ul class="button_list">
			<li>
				<div id="btn0" class="cp-jplayer"></div>
				<div id="cp_container_0" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div>
			</li>
			<li><div id="btn1" class="cp-jplayer"></div>
				<div id="cp_container_1" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn2" class="cp-jplayer"></div>
				<div id="cp_container_2" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn3" class="cp-jplayer"></div>
				<div id="cp_container_3" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn4" class="cp-jplayer"></div>
				<div id="cp_container_4" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn5" class="cp-jplayer"></div>
				<div id="cp_container_5" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn6" class="cp-jplayer"></div>
				<div id="cp_container_6" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn7" class="cp-jplayer"></div>
				<div id="cp_container_7" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn8" class="cp-jplayer"></div>
				<div id="cp_container_8" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
			<li><div id="btn9" class="cp-jplayer"></div>
				<div id="cp_container_9" class="cp-container">
					<div class="cp-buffer-holder">
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder">
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li>
					</ul>
				</div></li>
		</ul>
		<a class="btn3d" id="play" href="javascript:void(0);">PLAY</a>
		<a class="btn3d" id="load" href="javascript:void(0);">LOAD</a>
		<a class="btn3d" id="save" href="javascript:void(0);">SAVE</a>
		<a class="btn3d" id="record" href="javascript:void(0);">REC</a>
	</div>
	<div class="modal">
		<div id="close"></div>
		
		<div id="about">©2013 <a target="_blank" href="http://codepen.io/aleksailic">Aleka Ilic</a>. All rights reserved.</div>
		<div id="settings">
			<div id="theme_upload">Please log in so that you can upload your own music scheme</div>
			<!--<div id="theme_upload">
				Upload your own music scheme (*.zip)<br>
				<input name="upload" id="upload" accept="application/zip" type="file">
			</div>-->
				<label for='theme_select'>Select your theme:</label>
				<select id="theme_select" name="theme_select">asd
					<option>piano</option>
					<option>SHM-The one</option>
					<option>guitar</option>
				</select>
			<br>
				<label for='key_bindings'>Change key bindings:</label>
				<button name="key_binding" id="key_bindings">change</button>
				<a href="http://www.foreui.com/articles/Key_Code_Table.htm" target="_blank" style="font-size:12px;">sheet</a>
			<br>
			<div style="margin-top:-5px;">
				<label for="release">Button toggle:</label>
				<div name="release" id="release" class="onoffswitch">
					<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" checked>
					<label class="onoffswitch-label" for="myonoffswitch">
					<div class="onoffswitch-inner"></div>
					<div class="onoffswitch-switch"></div>
					</label>
				</div> 
			</div>
		</div>
		<div id="login">
			<form action="index.php" method="POST">
				<input type="text" name="username" placeholder="Username" id="username">
				<input type="password" name="pass" placeholder="Password" id="pass">
				<input type="submit">
				<a href="#">Register</a>
			</form>
			<form style="display:none;" action="register.php" method="POST">
				<input type="text" name="username" placeholder="Username" id="username">
				<input type="password" name="pass" placeholder="Password" id="pass">
				<input type="email" name="mail" placeholder="E-Mail" id="mail">
				<input type="submit">
				<a href="#">Login</a>
			</form>
			
		</div>
	</div>
</html>