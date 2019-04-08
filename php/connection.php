<?php
$conn = mysqli_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);

if($conn){
mysqli_select_db($conn, $_SERVER['DB_NAME']);
}else
{
die("Connection error: " . mysqli_connect_error());
}
?>
