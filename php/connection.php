<?php
$conn = mysqli_connect("wordpressdb.cfkyixhewlor.ap-southeast-2.rds.amazonaws.com","smart_mobile","&e3|MnuQYXQM");
if($conn){
	mysqli_select_db($conn, "smart_mobile_production");
}else{
	die("Connection error: " . mysqli_connect_error());
}
?>
