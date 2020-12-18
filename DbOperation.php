<?php
 
class DbOperation
{
    //Database connection link
    private $con;
 
    //Class constructor
    function __construct()
    {
        //Getting the DbConnect.php file
        require_once dirname(__FILE__) . '/DbConnect.php';
 
        //Creating a DbConnect object to connect to the database
        $db = new DbConnect();
 
        //Initializing our connection link of this class
        //by calling the method connect of DbConnect class
        $this->con = $db->connect();
    }
 
    //storing token in database 
    public function registerDevice($username,$token){
        if(!$this->isEmailExist($username)){
            $stmt = $this->con->prepare("INSERT INTO devices (username, token) VALUES (?,?) ");
            $stmt->bind_param("ss",$username,$token);
            if($stmt->execute())
                return 0; //return 0 means success
            return 1; //return 1 means failure
        }else{
            return 2; //returning 2 means email already exist
        }
    }
 
    //the method will check if email already exist 
    private function isEmailexist($username){
        $stmt = $this->con->prepare("SELECT id FROM devices WHERE username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $stmt->store_result();
        $num_rows = $stmt->num_rows;
        $stmt->close();
        return $num_rows > 0;
    }
 
    //getting all tokens to send push to all devices
    public function getAllTokens(){
        $stmt = $this->con->prepare("SELECT token,lat,lon FROM member join devices on member.username=devices.username");
        $stmt->execute(); 
        $result = $stmt->get_result();
        $tokens = array(); 
		$lat1 =26.7836363;
		$lon1 =92.8388228;
		$unit="K";
        while($token = $result->fetch_assoc()){
			$lat2=$token['lat'];
		$lon2=$token['lon'];
		$theta = $lon1 - $lon2;
		$unit="K";
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
  if ($unit == "K") {
    $dista= ($miles * 1.609344);
  } else if ($unit == "N") {
      $dista= ($miles * 0.8684);
    } else {
        $dista= $miles;
      }
	  if($dista<10000000){
            array_push($tokens, $token['token']);
	  }
        }
        return $tokens; 
    }
 
 /*
  public function distance($lat2, $lon2, $unit) {
  //latt1 & long1 for P1 (My Location)
  $lat1 =26.7836363;
  $lon1 =95.8388228;
  
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
 */
 
    //getting a specified token to send push to selected device
    public function getTokenByEmail($username){
        $stmt = $this->con->prepare("SELECT token,lat,lon FROM member join devices on member.username=devices.username WHERE devices.username = ?");
        $stmt->bind_param("s",$username);
        $stmt->execute(); 
        $result = $stmt->get_result()->fetch_assoc();
		$lat2=$result['lat'];
		$lon2=$result['lon'];
		$lat1 =26.7836363;
		$lon1 =92.8388228;
		$theta = $lon1 - $lon2;
		$unit="K";
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);
  if ($unit == "K") {
    $dista= ($miles * 1.609344);
  } else if ($unit == "N") {
      $dista= ($miles * 0.8684);
    } else {
        $dista= $miles;
      }
        if($dista<1000000)
			return array($result['token']);   
		else
			return -1;
	
			
    }
 /*
    //getting all the registered devices from database 
    public function getAllDevices(){
        $stmt = $this->con->prepare("SELECT * FROM devices");
        $stmt->execute();
        $result = $stmt->get_result();
        return $result; 
    }
	*/
	
	public function getAllDevices(){
        $stmt = $this->con->prepare("SELECT * FROM member join devices on member.username=devices.username");
        $stmt->execute();
        $result = $stmt->get_result();
		return $result; 
    }
	
	public function getAllPosts(){
        $stmt = $this->con->prepare("SELECT * FROM posts");
        $stmt->execute();
        $result = $stmt->get_result();
		return $result; 
    }
	
	
	
	
	
	
 





	
}