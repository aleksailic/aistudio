<?php
	$mysqli_host = 'localhost';
	$mysqli_username = 'root';
	$mysqli_password = 'passwordhere';
	$mysqli_db='ai_studio';

	$link= new mysqli($mysqli_host,$mysqli_username,$mysqli_password,$mysqli_db) or die("Error connecting to the database");
?>
