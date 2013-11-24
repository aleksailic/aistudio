<?php
	session_start();
	require ('connect.inc.php');

	$stream = array("error"=>array(),"valid"=>array());

	if ( isset($_POST['name']) ){ //login or register form sent
		require('connect.inc.php');

		if($_POST['name']=='login'){ // check login
			if( !empty($_POST['username']) && !empty($_POST['pass']) ){

				$username = $link->escape_string($_POST['username']);
				$pass = md5($_POST['pass']);

				$query = $link->query("SELECT * FROM `users` WHERE `username`='$username' AND `password`='$pass'") or die("Error executing the query");
				if($query->num_rows==0){
					array_push($stream["error"], "Login info incorrect");
				}else if($query->num_rows==1){
					$obj=$query->fetch_object();
					$_SESSION['username']=$obj->username;
					array_push($stream["valid"], "Successfully logged in. Welcome ".$obj->fullname);
				}	
			}else{
				array_push($stream["error"], "Some of the fields were empty!");
			}
		}else if($_POST['name']=='register'){ //register user
			if( !empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['mail']) && !empty($_POST['fullname']) && filter_var( $_POST['mail'], FILTER_VALIDATE_EMAIL ) ){
				$username = $link->escape_string($_POST['username']);
				$pass = md5($_POST['pass']);
				$email=$link->escape_string($_POST['mail']);
				$fullname=$link->escape_string($_POST['fullname']);

				//check if username is unique
				$query = $link->query("SELECT * FROM `users` WHERE `username`='$username'") or die("Error executing the query");
				if($query->num_rows!==0){
					array_push($stream["error"], "username already exists");
				}else{
					$query = $link->query("INSERT INTO `users` (`username`,`password`,`email`,`fullname`) VALUES ('$username','$pass','$email','$fullname')") or die("Error inserting data into database");

					array_push($stream["valid"], "Successfully registered. You are free to log in".$fullname);
				}

			}else{
				array_push($stream["error"], "Some of the fields were empty or didn't pass validation!");
			}
		}
	}


	if( isset($_GET['logout']) ){
		unset($_SESSION['username']);
		array_push($stream["valid"], "Successfully logged out");
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
	<link rel="stylesheet" type="text/css" href="css/theme_admin.css">
	<script src="js/modal.js"></script>
	<script src="js/main.js"></script>
</head>
<body>
	<nav id="auth_header">
		<ul>
			<?php
				if( !isset($_SESSION['username']) ){
					echo '<li><a href="#">Login</a></li>';
				}
			?>
			<li><a href="#">Settings</a></li>
			<li><a href="#">FAQ</a></li>
			<li><a href="#">About</a></li>
		</ul>
	</nav>
	<nav id="logged_header">
		<ul>
			<?php
				if(isset($_SESSION['username']) && !empty($_SESSION["username"])){
					echo '<li style="margin-right:5px;font-size:16px;">'.$_SESSION['username'].' : </li>';
					echo '<li><a href="index.php?logout=true">Logout</a></li>';
					echo '<li><a id="theme_admin_btn" href="#">My themes</a></li>';
				}
			?>
		</ul>
	</nav>
	<div id="stream">
	<?php
		foreach ($stream["error"] as $value) {
			echo '<p style="color:rgb(255,0,0);">'.$value.'</p><br>';
		}
		foreach ($stream["valid"] as $value) {
			echo '<p style="color:rgb(0,255,0);">'.$value.'</p><br>';
		}
	?>
	</div>
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
	<div id="nav_modal" class="modal">
		<div class="close"></div>
		
		<div id="about">©2013 <a target="_blank" href="http://codepen.io/aleksailic">Aleka Ilic</a>. All rights reserved.</div>
		<div id="settings">
			<div id="theme_upload">
				<?php
					if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
						echo 'Upload your own music scheme (*.ogg)'.'<BR>';
						echo '<form method="post" action="upload.php" enctype="multipart/form-data">';
						echo '<input name="filesToUpload[]" id="filesToUpload" type="file" accept="audio/ogg" multiple="" />';
						echo '</form>';
					}else{
						echo 'Please log in so that you can upload your own music scheme';
					}
				?>
			</div>
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
		<?php
			if(!isset($_SESSION['username'])){
				echo '<div id="login">';
				echo ' 	<form action="index.php" method="POST" id="register-form"> ';
				echo ' 		<input type="text" name="fullname" placeholder="Full Name" id="fullname"> ';
				echo ' 		<input type="text" name="username" placeholder="Username" id="username"> ';
				echo ' 		<input type="password" name="pass" placeholder="Password" id="pass"> ';
				echo ' 		<input type="email" name="mail" placeholder="E-Mail" id="mail"> ';
				echo ' 		<input type="hidden" name="name" value="register"> ';
				echo ' 		<input type="submit"> ';
				echo ' 		<a href="javascript:changeForm()">Login</a> ';
				echo ' 	</form> ';
				echo ' 	<form action="index.php" method="POST" id="login-form"> ';
				echo ' 		<input type="text" name="username" placeholder="Username" id="username"> ';
				echo ' 		<input type="password" name="pass" placeholder="Password" id="pass"> ';
				echo ' 		<input type="hidden" name="name" value="login"> ';
				echo ' 		<input type="submit"> ';
				echo ' 		<a href="javascript:changeForm()">Register</a> ';
				echo ' 	</form> ';	
				echo '</div>';
			}
		?>
	</div>

	
	
</html>