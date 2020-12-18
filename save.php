<?php

require_once __DIR__ . '/config.php';

$lat = $_POST['lat'];

$lng = $_POST['lng'];

$posts = $_POST['posts'];

//$lat='23';
//$lng='55';
//$posts="I need your help";


if(!empty($lat) && !empty($lng)){
	$sql = "insert into markers(lat,lng,posts) values(?,?,?)";

	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$stmt = $mysqli->prepare($sql);

        $stmt->bind_param("sss",$lat,$lng,$posts);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
}

?>
