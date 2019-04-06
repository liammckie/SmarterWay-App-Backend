
<?php

require ('connection.php');
session_start();
$Id = $_SESSION['Id'];
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];

$update_profile = "UPDATE `Clients` SET Name='$name', Mobile='$mobile', gps_lat='$latitude', gps_lng='$longitude' WHERE Id ='$Id'";

mysqli_query($conn,$update_profile);
echo "<script>window.location.href='../admin/profile';</script>";
?>