<?php
session_start();
if(empty($_SESSION['Id'])){
	unset($_SESSION['Id']);
	$AdminData = '';
	echo "<script>window.location.href='../login';</script>";
} 
else{
    if($_SESSION['login_timestamp']){
        if((time() - $_SESSION['login_timestamp']) > 600){ // 120 = 2 * 60  
            header("location:../php/logout");  
        }else{
 		    $_SESSION['login_timestamp'] = time();   
		}
    }else{
	unset($_SESSION['login_timestamp']);
	}
	$AdminData = $_SESSION['Id'];
}
?>
