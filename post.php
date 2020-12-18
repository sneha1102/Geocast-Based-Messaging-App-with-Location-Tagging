<?php
$response = array();
//include 'db_connect.php';
include 'login.php';
 
//Get the input request parameters
/*
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array
$username = $_GET['username'];
$password = $_GET['password'];
*/
$data = json_decode(file_get_contents("php://input"));
$post="hello";
//$post = $data->post;
if(isset($post)){
	
	$insertQuery   = " INSERT INTO userpost(username,post) VALUES (?,?)";
	if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("ss",$username,$post);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "User posted";
			$stmt->close();
		}
		else{
		$response["status"] = 1;
		$response["message"] = "error";
	}
}
	print json_encode($response);
?>