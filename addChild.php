<?php
require 'connection.php';
$connect    = Connect();
$parent=$_POST['name'];
$child=$_POST['children'];

$query = "
 select * from category where name='$parent' ;
";
$result = mysqli_query($connect, $query);
$row=$result->fetch_assoc();
$id = (int) $row['id'];


$query = "
 insert into category(name , parent_id) values('$child', $id) ;
";
$result = mysqli_query($connect, $query);

?>

?>