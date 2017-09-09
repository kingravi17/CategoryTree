<?php
require 'connection.php';
$connect    = Connect();
$name=$_POST['name'];
$replace=$_POST['replace'];

$query = "
 update category set name='$replace' where name='$name' ;
";
$result = mysqli_query($connect, $query);

?>