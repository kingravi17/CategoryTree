<?php
require 'connection.php';
$connect    = Connect();
$name=$_POST['name'];

$query = "
 DELETE FROM category WHERE name='$name' ;
";
$result = mysqli_query($connect, $query);
echo "YES";
?>