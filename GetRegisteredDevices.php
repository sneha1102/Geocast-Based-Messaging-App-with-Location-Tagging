
<?php

	require_once 'DbOperation.php';
 
	$db = new DbOperation(); 
	
	$devices = $db->getAllDevices();
 
	$response = array(); 
 
	$response['error'] = false; 
	$response['devices'] = array(); 
 
	while($device = $devices->fetch_assoc()){
		
		$temp = array();
		$temp['id']=$device['id'];
		$temp['username']=$device['username'];
		$temp['token']=$device['token'];
		//$temp['lat']=$device['lat'];
		//$temp['lon']=$device['lon'];
		array_push($response['devices'],$temp);
		//echo array($response);
	
	}
 
	echo json_encode($response);
	
	
	function distance($lat2, $lon2, $unit) {
  //latt1 & long1 for P1 (My Location)
  $lat1 =25.2154910;
  $lon1 =87.3713027;
  
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}
	


?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
