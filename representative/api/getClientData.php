<?php
require_once ("config.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
if (! empty($_POST["ClientID"])) {
    $sql = "SELECT * FROM `gsheet_master_proposal` WHERE ClientID = '" . $_POST["ClientID"] . "' ";
    $query = mysqli_query($conn, $sql);
    if($query){
        $records = [];
        while ($record = mysqli_fetch_assoc($query)) {
        $records[] = $record;
        }
    }
}
echo json_encode($records);die; 
}
else{
    $error["response"] = "Your request methods is not valid";
	$error["responseCode"] = "404";
	echo json_encode($error);
}
?>
