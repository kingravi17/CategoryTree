<?php

require 'connection.php';
$connect    = Connect();
$name=$_POST['name'];
$id=$_POST['id'];

$query = "
 SET FOREIGN_KEY_CHECKS=0;
";
$result = mysqli_query($connect, $query);

$query = "
 INSERT INTO `category` ( `name`, `parent_id`) VALUES
( '$name', $id);
";
$result = mysqli_query($connect, $query);

$query = "
 SET FOREIGN_KEY_CHECKS=1;
";
$result = mysqli_query($connect, $query);

?>