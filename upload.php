<?php
	require('connect.inc.php');
	session_start();

	// Output JSON
	function outputJSON($msg, $status = 'error',$dir=null){
	    header('Content-Type: application/json');
	    die(json_encode(array(
	        'data' => $msg,
	        'status' => $status,
	        'dir' => $dir
	    )));
	}

	// REarange array
	function reArrayFiles(&$file_post) {
	    $file_ary = array();
	    $file_count = count($file_post['name']);
	    $file_keys = array_keys($file_post);
	    for ($i=0; $i<$file_count; $i++) {
	        foreach ($file_keys as $key) {
	            $file_ary[$i][$key] = $file_post[$key][$i];
	        }
	    }
	    return $file_ary;
	}

	//Check if user is logged in
	if(!isset($_SESSION["username"])){
	    outputJSON("You are not logged in...You sneaky little fellow! You used form without logging in");
	}else{
	    $username=$_SESSION["username"];
	}

	//check if theme name is set
	if(  isset( $_POST['name'] ) && !empty( $_POST['name'] )  ){
		$theme_name=$_POST['name'];
	}else{
		outputJSON("Name for the new theme is not set");
	}

	//check if any files were uploaded
	if(!isset($_FILES['files'])){
		outputJSON("You didn't upload anything. WUT");
	}else{ //FORMAT THE ARRAY SO IT IS MORE CLEAR WHAT IS INSIDE IT
		$file_array=reArrayFiles($_FILES['files']);
	}

	//check for errors
	foreach($file_array as $file){
		if($file['error']>0){
			outputJSON('An error occured while uploading');
		}
	}

	//check if user uploaded 10 files
	if(count($file_array)!=10){
		outputJSON("You must upload exactly 10 files");
	}

	//check the combined size
	$combined_size=0;
	foreach($file_array as $file){
		$combined_size+=$file['size'];
	}
	if($combined_size>5242880){
		outputJSON("Your files are too large and exceed the 5MB combined limit");
	}

	//check file type
	foreach($file_array as $file){
		$extension=strtolower(substr($file['name'], strpos($file['name'],'.') + 1));
		if($extension!='ogg'){
			outputJSON("Files are not in the .ogg format");
		}
	}

	//Create unique folder name
	$dir_name = substr(str_shuffle(MD5(microtime())), 0, 10); // 6c468fs23g
	$dir_path='themes/'.$dir_name;
	 if (!file_exists($dir_path)) {
	    mkdir($dir_path, 0777, true);
	}else{
	    outputJSON("Error creating unique directory: ".$dir_name);
	}

	//Upload file
	$count=0;
	foreach($file_array as $file){
		if( !move_uploaded_file( $file['tmp_name'], $dir_path.'/'.$count.'.ogg' )){
			outputJSON("Error uploading files");
		}
		$count++;
	}

	// Success!
	$query=$link->query("INSERT INTO `custom_themes` (`id`,`name`,`author`) VALUES ('$dir_name','$theme_name','$username')") or outputJSON("error updating db");
	outputJSON('Files uploaded successfully to "'.$dir_path.'"', 'success',$dir_name);
?>