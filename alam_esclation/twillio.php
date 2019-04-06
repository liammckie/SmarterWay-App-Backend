<?php

	//BASIC Configuration
	$accountID = "AC39ba32137f384212413cd9a9c6fb31e1";
	$key = "AC39ba32137f384212413cd9a9c6fb31e1";
	$secret = "808ecd5f22321baeb31c9e14fa9fa137";
	$baseUrl = "https://api.twilio.com/2010-04-01/Accounts/";
	$fromMobileNumber = "+61476855993";
	define('FROM',$fromMobileNumber);
	define('CALL','Calls.json');
	define('SMS','Messages.json');

	function getParam($array_data){
		return http_build_query($array_data);
	}
	
	function sendReq($params, $mName){ // send Twillio SMS
		global $accountID;
		global $baseUrl;
		global $key,$secret;
		$curl = curl_init();
		$postField = getParam($params);
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $baseUrl.$accountID."/".$mName,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $postField,
		  CURLOPT_HTTPHEADER => array(
			"Cache-Control: no-cache",
			"Content-Type: application/x-www-form-urlencoded"
		  ),
		));
		curl_setopt($curl, CURLOPT_USERPWD, $key . ":" . $secret);
		$response = curl_exec($curl);
		$err = curl_error($curl);
        
        echo "<br/>";
        echo $response;
        echo "<br/>";
        
		curl_close($curl);

		if ($err) {
		  return json_decode($err,true);
		} else {
		  return json_decode($response,true);
		}
	}
	
	function sendSMS($arrayRow){
		global $conn;
		$_data_sms = [];
		$_data_sms["To"] = $arrayRow["MobileNo"];
		$_data_sms["From"] = FROM;
		$_data_sms["Body"] = $arrayRow["TextMessage"];

		$data_sms = sendReq($_data_sms, SMS);
		$sid = "";
		if(array_key_exists("sid",$data_sms)){
			$sid = $data_sms["sid"];
		}
		if($sid){
			$_update_rows = "Update alaram_esc_log SET Status = 2, ResponseID = '$sid' WHERE alarm_id = ".$arrayRow["alarm_id"];
			mysqli_query($conn, $_update_rows);
		}
	}
	
	function call($arrayRow){ //for Call Reuest
		global $conn;
		$_data_call = [];
		$_data_call["From"] = FROM;
		$_data_call["To"] = $arrayRow["MobileNo"];
		$_data_call["StatusCallbackMethod"] = "POST";
		$_data_call["Url"] = "http://scsportal.com.au/alam_esclation/getXML.php?alarm_id=".$arrayRow["alarm_id"];
		$_data_call["StatusCallback"] = "http://scsportal.com.au/alam_esclation/callback.php";
		//$_data_call["Url"] = "http://scs.vbeasy.com/alam_esclation/getXML.php?alarm_id=".$arrayRow["alarm_id"];
		//$_data_call["StatusCallback"] = "http://scs.vbeasy.com/alam_esclation/callback.php";

		$data_call = sendReq($_data_call, CALL);
		$sid = "";
		$uri = "";
		$callstatus = "";
		if(array_key_exists("sid",$data_call)){
			$sid = $data_call["sid"];
			$uri = "https://api.twilio.com/".$data_call["uri"];
			$callstatus = $data_call["status"];
		}
		if($sid){
			$_update_rows = "Update alaram_esc_log SET Status = 2, ResponseID = '$sid', uri='$uri', callstatus = '$callstatus' WHERE alarm_id = ".$arrayRow["alarm_id"];
			mysqli_query($conn, $_update_rows);
		}
	}

    function callDial($arrayRow){ //for Call Reuest
		global $conn;
		$_data_call = [];
		$_data_call["From"] = FROM;
		$_data_call["To"] = $arrayRow["MobileNo"];
		$_data_call["StatusCallbackMethod"] = "POST";
		$_data_call["Url"] = "http://scsportal.com.au/alam_esclation/getXMLV2.php?alarm_id=".$arrayRow["alarm_id"];
		$_data_call["StatusCallback"] = "http://scsportal.com.au/alam_esclation/callbackV2.php";
	   	//$_data_call["Url"] = "http://scs.vbeasy.com/alam_esclation/getXMLV2.php?alarm_id=".$arrayRow["alarm_id"];
		//$_data_call["StatusCallback"] = "http://scs.vbeasy.com/alam_esclation/callbackV2.php";


		$data_call = sendReq($_data_call, CALL);
		$sid = "";
		$uri = "";
		$callstatus = "";
		if(array_key_exists("sid",$data_call)){
			$sid = $data_call["sid"];
			$uri = "https://api.twilio.com/".$data_call["uri"];
			$callstatus = $data_call["status"];
		}
		if($sid){
			$_update_rows = "Update alaram_esc_log SET Status = 2, ResponseID = '$sid', uri='$uri', callstatus = '$callstatus' WHERE alarm_id = ".$arrayRow["alarm_id"];
			mysqli_query($conn, $_update_rows);
		}
	}


