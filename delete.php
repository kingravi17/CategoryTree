<?php

echo "YES";

$connect = mysqli_connect("localhost", "id380181_kingravi17", "ravi3893", "id380181_test");
$name=$_POST['name'];


$query = "
 DELETE FROM category  WHERE name = 'Cars' ";
 $result = mysqli_query($connect, $query3);

?>