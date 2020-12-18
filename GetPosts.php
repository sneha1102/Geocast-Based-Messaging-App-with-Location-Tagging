
<?php

	require_once 'DbOperation.php';
 
	$db = new DbOperation(); 
	
	$posts = $db->getAllPosts();
 
	$response = array(); 
 
	$response['error'] = false; 
	$response['posts'] = array(); 
 
	while($poste = $posts->fetch_assoc()){
		
		$temp = array();
		$temp['id']=$poste['id'];
		$temp['title']=$poste['title'];
		$temp['message']=$poste['message'];
		//$temp['lat']=$device['lat'];
		//$temp['lon']=$device['lon'];
		array_push($response['posts'],$temp);
		//echo array($response);
	
	}
 
	echo json_encode($response);
	
	
	
	


?>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
