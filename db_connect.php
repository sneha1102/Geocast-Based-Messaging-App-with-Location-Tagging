<?php

define('DB_USER', "root"); // db user
define('DB_PASSWORD', ""); // db password 
define('DB_DATABASE', "androiddeft"); // database name
define('DB_SERVER', "localhost"); // db server
 
$con = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
//mysqli_set_charset($con,'utf8');
 
// Check connection
/*
if(mysqli_connect_errno())
{
	print "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
	print "Hello success";
*/
?>