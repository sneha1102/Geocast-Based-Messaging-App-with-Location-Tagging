<?php

require_once __DIR__ . '/config.php';


$markers = array();
$sql = "select lat,lng,posts from markers";
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if($res = $mysqli->query($sql)){
	while($row=$res->fetch_assoc()){
                $lat = $row['lat'];
	        $lng = $row['lng'];
		$posts=$row['posts'];
                $data= array("lat"=>$lat,"lng"=>$lng,"posts"=>$posts);
                $marker[] = $data;
	}

        $markers = array("markers"=>$marker);

        echo json_encode($markers);
}


?>
