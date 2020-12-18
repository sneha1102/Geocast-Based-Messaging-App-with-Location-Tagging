<?php
$response = array();

 include 'login.php';
 $data = json_decode(file_get_contents("php://input"));
 /*$username="boy";
$lat="18";
$lon="25";
*/
$username = $data->username;
$lat = $data->lat;
$lon = $data->lon;
if(isset($username)){
	$query1= "UPDATE member set lat=?,lon=? where username=?";
	if($stmt1 = $con->prepare($query1)){
		$stmt1->bind_param("sss",$lat,$lon,$username);
		$stmt1->execute();
		$response["status"] = 0;
			$response["message"] = "User updated";
		$stmt1->close();
	}	
}
else {
	$response["status"] = 1;
			$response["message"] = "Missing mandatory parameters";

}
	
print json_encode($response);
?>