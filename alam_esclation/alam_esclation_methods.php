<?php 
include "db_config.php";
include "twillio.php";

$cDate  = gmdate("Y-m-d H:i:00", time());
$checkingTime = strtotime($cDate);

echo $checkingTime;

echo "<br/>".gmdate("Y-m-d H:i:s", $checkingTime);

echo "<br/>";

//Get Data From Server 
	echo $_sel_alam_data = " SELECT *  
	                    FROM alaram_esc_log al
	                        INNER JOIN AlarmScheduleDayWise aw ON aw.ASDWID = al.ASDWID AND al.Status = 0 AND 	UTCTime  = '$checkingTime'
	                   ";
//exit;	                    
	 /*$_sel_alam_data = "SELECT *  
	                    FROM alaram_esc_log al
	                    WHERE alarm_id = 2 AND Status = 1 Limit 0,1";
	   */                 
	$_query_result = mysqli_query($conn, $_sel_alam_data);
	
	while($rows_update = mysqli_fetch_assoc($_query_result)){ //CALL & SMS Data
		$data = $rows_update;
		if($data['RequestType']==1){ // for SMS
			sendSMS($data);
		}else if($data['RequestType']==2){ // for CALL
			//call($data);
			callDial($data);
		}
	}


?>