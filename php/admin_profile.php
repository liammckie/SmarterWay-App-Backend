<?php
require('connection.php');
session_start();
$Id = $_SESSION['Id'];
$img = $_FILES['img']['name'];
$img_type = $_FILES['img']['type'];
$img_size = $_FILES['img']['size'];
$img_tmp = $_FILES['img']['tmp_name'];
$image_folder = "../wp-content/uploads/wpfiles/profile/";

$file_ext=strtolower(end(explode('.',$_FILES['img']['name'])));
$file = $Id.".".$file_ext;

move_uploaded_file($img_tmp , "$image_folder".$file);

	$sql = "update `Clients` set profile_image = '$file' where Id = '$Id'";
			mysqli_query($conn, $sql);
		

    	header('location: ../admin/profile');
?>
