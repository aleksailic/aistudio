<?php
	session_start();
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



	<script type="text/javascript">
		$(document).ready(function(){

			/*
			 * Instance CirclePlayer inside jQuery doc ready
			 *
			 * CirclePlayer(jPlayerSelector, media, options)
			 *   jPlayerSelector: String - The css selector of the jPlayer div.
			 *   media: Object - The media object used in jPlayer("setMedia",media).
			 *   options: Object - The jPlayer options.
			 *
			 * Multiple instances must set the cssSelectorAncestor in the jPlayer options. Defaults to "#cp_container_0" in CirclePlayer.
			 */

			var myCirclePlayer = new CirclePlayer("#btn0",
			{
				oga: "piano/0.ogg"
			}, {
				cssSelectorAncestor: "#cp_container_0"
			});

		});
		</script>
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
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div>
			</li>
			<li><div id="btn1" class="cp-jplayer"></div>
				<div id="cp_container_1" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn2" class="cp-jplayer"></div>
				<div id="cp_container_2" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn3" class="cp-jplayer"></div>
				<div id="cp_container_3" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn4" class="cp-jplayer"></div>
				<div id="cp_container_4" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn5" class="cp-jplayer"></div>
				<div id="cp_container_5" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn6" class="cp-jplayer"></div>
				<div id="cp_container_6" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn7" class="cp-jplayer"></div>
				<div id="cp_container_7" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn8" class="cp-jplayer"></div>
				<div id="cp_container_8" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
			<li><div id="btn9" class="cp-jplayer"></div>
				<div id="cp_container_9" class="cp-container">
					<div class="cp-buffer-holder"> <!-- .cp-gt50 only needed when buffer is > than 50% -->
						<div class="cp-buffer-1"></div>
						<div class="cp-buffer-2"></div>
					</div>
					<div class="cp-progress-holder"> <!-- .cp-gt50 only needed when progress is > than 50% -->
						<div class="cp-progress-1"></div>
						<div class="cp-progress-2"></div>
					</div>
					<div class="cp-circle-control"></div>
					<ul class="cp-controls">
						<li><a class="cp-play" tabindex="1">play</a></li>
						<li><a class="cp-pause" style="display:none;" tabindex="1">pause</a></li> <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
					</ul>
				</div></li>
		</ul>
	</div>

	<div class="modal">
		<div id="close"></div>
		
		<div id="about">©2013 <a target="_blank" href="http://codepen.io/aleksailic">Aleka Ilic</a>. All rights reserved.</div>
		<div id="settings">
			Settings will go here
		</div>
		<div id="login">
			Login will go here
		</div>
	</div>
</html>