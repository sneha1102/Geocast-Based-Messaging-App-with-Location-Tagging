<?php
$response = array();
include 'db_connect.php';
include 'functions.php';
$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$lat = $data->lat;
$lon = $data->lon;
/*
$username = "xyz";
$lat ="26";
$lon = "54";
*/
if(isset($username) && isset($lat) &&isset($lon)){
	//Query to enter location of user
		$insertQuery  = "INSERT INTO member1(username,lat,lon) VALUES (?,?,?)";
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("sss",$username,$lat,$lon);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "User location inserted";
			$stmt->close();
		}
}
		else{
		$response["status"] = 1;
		$response["message"] = "error";
	}
	print json_encode($response);
?>