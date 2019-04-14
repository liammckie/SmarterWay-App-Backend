<?php
$conn = mysqli_connect("162.241.218.43","vbeasyco_scs","vbeasyco_scs");
if($conn){
	mysqli_select_db($conn, 'smart_production_10APR_restore');
}else{
	die("Connection error: " . mysqli_connect_error());
}
?>
