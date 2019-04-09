<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/photos/".$timeStamp,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
		"Authorization: Basic N0YwQkE4MDMtQUNGQi00RDZDLUI3RkQtNkUwOTg3ODU1RDQ3OjQwOTVGRkQ1LTI2NDItNDg3NC1BNDBFLUU2NDY1OEE2NTU3MQ=="
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
	  return [];
	} else {
		return json_decode($response,true);
	} 
}

/*
$data = getData(0);
echo "<pre>";
print_r(array_keys($data['Photos'][0]));

exit;
*/

$j=1;

for($i=0;$i<$j;$i++){
	$LastID = getTimeStamp(5);
	$data = getData($LastID);
	
	if(array_key_exists("Photos",$data)){
		$Photos = $data["Photos"];
		
		foreach($Photos as $datas){
			
			$PhotoID = $datas['PhotoID'];
			$ClientCode = $datas['ClientCode'];
			$ClientName = $datas['ClientName'];
			$Note = $datas['Note'];
			$DateAndTime = jsonToTimeStamp($datas['DateAndTime']);
			$PhotoURL = addslashes($datas['PhotoURL']);
			$RepresentativeCode = $datas['RepresentativeCode'];
			$RepresentativeName = $datas['RepresentativeName'];
			$VisitID = $datas['VisitID'];
			
			
			$insertQuery = " INSERT INTO photos 
							(PhotoID,ClientCode,ClientName,Note,DateAndTime,PhotoURL,RepresentativeCode,RepresentativeName,VisitID)
							VALUES
							('$PhotoID','$ClientCode','$ClientName','$Note','$DateAndTime','$PhotoURL','$RepresentativeCode','$RepresentativeName','$VisitID');
							";
			$mysqli_query = mysqli_query($conn,$insertQuery);
			
			
		
			
		}
	}
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastID",$data["MetaCollectionResult"])){
			$LastID = $data["MetaCollectionResult"]["LastID"];
			setTimeStamp(5,$LastID);
			
			if($data["MetaCollectionResult"]["TotalCount"] == 0){
				$j--;
			}else{
				$j++;
			}
			
		}else{
			
			$j--;
		}
	}
	
	if($i==0){
		$j=-1;
	}
}