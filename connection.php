<?php
function Connect()
{
 $dbhost = "localhost";
 $dbuser = "id380181_kingravi17";
 $dbpass = "ravi3893";
 $dbname = "id380181_test";

 // Create connection
 $conn=mysqli_connect($dbhost ,$dbuser , $dbpass, $dbname) or die($conn->connect_error);

 return $conn;
}
 
?>
