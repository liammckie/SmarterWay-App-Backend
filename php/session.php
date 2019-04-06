<?php
session_start();
if(empty($_SESSION['ClientID'])){
	unset($_SESSION['ClientID']);
	$ClientData = '';
	echo "<script>window.location.href='login';</script>";
}
else{
    if($_SESSION['login_timestamp']){
        if((time() - $_SESSION['login_timestamp']) > 600){ // 120 = 2 * 60  
            header("location:php/logout");  
        }else{
 		    $_SESSION['login_timestamp'] = time();   
		}
    }else{
	unset($_SESSION['login_timestamp']);
	}
	$ClientData = $_SESSION['ClientID'];
}	
?>
