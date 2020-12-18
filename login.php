<?php
$response = array();
include 'db_connect.php';
include 'functions.php';
 
//Get the input request parameters
/*
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array
$username = $_GET['username'];
$password = $_GET['password'];
*/
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;


//$fullName = $data->fullName;
/*
$username="boy";
$lat="16";
$lon="20";
$password="11";
$fullName="boy";
*/
//Check for Mandatory parameters
if(isset($username) && isset($password)){
	
	$query    = "SELECT fullName,password_hash, salt FROM member WHERE username = ?";
	
	if($stmt = $con->prepare($query)){
		$stmt->bind_param("s",$username);
		$stmt->execute();
		$stmt->bind_result($fullName,$passwordHashDB,$salt);
		if($stmt->fetch()){
			//Validate the password
			if(password_verify(concatPasswordWithSalt($password,$salt),$passwordHashDB)){
				$response["status"] = 0;
				$response["message"] = "Login successful";
				$response["fullName"] = $fullName;
			}
			else{
				$response["status"] = 1;
				$response["message"] = "Invalid username and password combination";
			}
		}
		else{
			$response["status"] = 1;
			$response["message"] = "Invalid username and password combination";
		}
		
		$stmt->close();
	}
}
else{
	$response["status"] = 2;
	$response["message"] = "Missing mandatory parameters";
}
//Display the JSON response
//header('Content-Type: application/json')
print json_encode($response);
?>