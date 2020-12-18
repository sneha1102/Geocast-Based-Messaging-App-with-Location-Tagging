<?php
$response = array();
include 'db_connect.php';
include 'functions.php';
//Get the input request parameters

$inputJSON = file_get_contents('php://input');
$json = utf8_encode($inputJSON);
$input = json_decode($json);
//$dataJSON = rtrim($inputJSON,"\0");
//$inputJSON = stripslashes(html_entity_decode($inputJSON));
//$input = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/','',$inputJSON), TRUE); //convert JSON into array
//$input = json_decode(preg_replace('/[[:cntrl:]]','',$dataJSON), TRUE); //convert JSON into array





$username = $input->username;
$password = $input->password;
$fullName = $input->fullName;
$lat=$input->lat;
$lon=$input->lon;

/*
$username = $input["username"];
$password = $input["password"];
$fullName = $input["fullName"];
$lat=$input["lat"];
$lon=$input["lon"];
*/
/*
$data = json_decode(file_get_contents("php://input"),true);

$username = $data->username;
$password = $data->password;
$fullName = $data->fullName;
$lat = $data->lat;
$lon = $data->lon;
*/
/*
$username = urldecode($_POST['username']);
$password = urldecode($_POST['password']);
$fullName = urldecode($_POST['fullName']);
*/
/*
$username = $_GET['username'];
$password = $_GET['password'];
$fullName = $_GET['fullName'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
*/
/*
$username="xyzz";	
$password="1111";
$fullName="tezuu";
$lon="12";
$lat="23";
*/
//print_r($data);
//echo $data
//Check for Mandatory parameters
if(isset($username) && isset($password) && isset($fullName) && isset($lat) &&isset($lon)){
	
	
	//Check if user already exist
	if(!userExists($username)){
 
		//Get a unique Salt
		$salt         =  getSalt();
		
		//Generate a unique password Hash
		$passwordHash =  password_hash(concatPasswordWithSalt($password,$salt),PASSWORD_DEFAULT);
		
		//Query to register new user
		$insertQuery  = "INSERT INTO member(username, fullName, password_hash, salt,lat,lon) VALUES (?,?,?,?,?,?)";
		if($stmt = $con->prepare($insertQuery)){
			$stmt->bind_param("ssssss",$username,$fullName,$passwordHash,$salt,$lat,$lon);
			$stmt->execute();
			$response["status"] = 0;
			$response["message"] = "User created";
			$stmt->close();
		}
	}
	
	else{
		$response["status"] = 1;
		$response["message"] = "User exists";
	}
	
}
else{
	$response["status"] = 2;
	$response["message"] = "Missing mandatory parameters";
}

//header('Content-Type: application/json')
print json_encode($response);
?>