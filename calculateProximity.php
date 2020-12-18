<?php 
require('db.php');






//$latt = $_POST["Latitude"];
//$long = $_POST["Longitude"];
//$dist = $_POST["Distance"];
//echo $latt;
//echo $long;
//echo $dist;


$conn=mysqli_connect($db_server,$db_user,$db_pass,$db_name);

if($conn)
{
    echo "projectloc database connection successful ";
    echo "<br>";
    $result = mysqli_query($conn,"SELECT * FROM member join devices on member.username=devices.username");
    
    while($row = mysqli_fetch_assoc($result))
    {
        $dista=distance($row["lat"],$row["lon"],"K");
        
        if($dista <500)
        {
            //then that user will recive the message
            echo $dista;
            echo "<br>";
        }
    }
  

}

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

mysqli_close($conn);

?>