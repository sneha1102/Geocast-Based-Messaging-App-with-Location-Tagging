<?php
$response = array();
include 'db_connect.php';

$data = json_decode(file_get_contents("php://input"));

$title = $data->title;
$message=$data->message;

/*
$title = "ram";
$message="hello";
*/
if(isset($title) && isset($message)){
/*

	print($username);
*/	
	
 
		
		
		//Query to register new user
		$insertQuery  = "INSERT INTO posts(title,message) VALUES (?,?)";
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("ss",$title,$message);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "post inserted";
			$stmt->close();
		}
	
	
	
	
}
else{
	$response["status"] = 1;
	$response["message"] = "error";
}

//header('Content-Type: application/json')
print json_encode($response);
?>



