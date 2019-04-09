<?php
set_time_limit ( 0 );

$conn = mysqli_connect($_SERVER['DB_HOST'],$_SERVER['DB_USER'],$_SERVER['DB_PASSWORD']);
if($conn){
mysqli_select_db($conn, $_SERVER['DB_NAME']);
}else
{
die("Connection error: " . mysqli_connect_error());
}

function getTimeStamp($methodID){
	global $conn;
	$sel_timestamp = "SELECT * FROM timestampmanagement WHERE requestType = ".$methodID;
	$query_result = mysqli_query($conn, $sel_timestamp);
	
	$timeStamp = 0;
	while($row = mysqli_fetch_array($query_result)){
		$timeStamp = $row["nextTimeStamp"];	
	}
	return $timeStamp;
}

function setTimeStamp($methodID,$timeStamp){
	global $conn;
	$update_timestamp = "Update timestampmanagement 
							SET nextTimeStamp = '$timeStamp'
							WHERE requestType = ".$methodID;
	$query_result = mysqli_query($conn, $update_timestamp);
}

function jsonToTimeStamp($j){
	if($j==null || $j=="")
		return '';
	$j = str_replace("/Date","",$j);
	$j = str_replace("/","",$j);
	//echo $j."<br/>";
	eval("\$j = $j;");
	$j = (int)substr($j,0,10);
	return date("Y-m-d H:i:s", $j);
}

//setTimeStamp(1,0);
//echo getTimeStamp(1);

?>
