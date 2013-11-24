<?php
require('connect.inc.php');

// Output JSON
function outputJSON($msg, $status = 'error'){
    header('Content-Type: application/json');
    die(json_encode(array(
        'data' => $msg,
        'status' => $status
    )));
}

$dir_name = substr(str_shuffle(MD5(microtime())), 0, 10); // 6c468fs23g
$dir_path='themes/'.$dir_name;
 if (!file_exists($dir_path)) {
    mkdir($dir_path, 0777, true);
}else{
    outputJSON("Error creating unique directory: ".$dir_name);
}

/*// Check for errors
if($_FILES['SelectedFile']['error'] > 0){
    outputJSON('An error ocurred when uploading.');
}

// Check filetype
if($_FILES['SelectedFile']['type'] != 'audio/ogg'){
    outputJSON('Unsupported filetype uploaded.');
}

// Check filesize
if($_FILES['SelectedFile']['size'] > 500000){
    outputJSON('File uploaded exceeds maximum upload size.');
}

// Check if the file exists
if(file_exists('themes/' . $_FILES['SelectedFile']['name'])){
    outputJSON('File with that name already exists.');
}*/

//Upload file
if(!move_uploaded_file($_FILES['SelectedFile']['tmp_name'], $dir_path.'/' . $_FILES['SelectedFile']['name'])){
    outputJSON('Error uploading file - check destination is writeable.');
}

// Success!
outputJSON('File uploaded successfully to "' . $dir_path.'/' . $_FILES['SelectedFile']['name'] . '".', 'success');