<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/dailyworkingtime/".$timeStamp,
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
print_r(array_keys($data['DailyWorkingTime'][0]));

exit;
*/

$j=1;

for($i=0;$i<$j;$i++){
	$LastID = getTimeStamp(6);
	$data = getData($LastID);
	
	if(array_key_exists("DailyWorkingTime",$data)){
		$DailyWorkingTime = $data["DailyWorkingTime"];
		
		foreach($DailyWorkingTime as $datas){
			
			
			
			
			$DailyWorkingTimeID = $datas['DailyWorkingTimeID'];
			$Date = jsonToTimeStamp($datas['Date']);
			$DateAndTimeStart = jsonToTimeStamp($datas['DateAndTimeStart']);
			$DateAndTimeEnd = jsonToTimeStamp($datas['DateAndTimeEnd']);
			$Length = $datas['Length'];
			$MileageStart = $datas['MileageStart'];
			$MileageEnd = $datas['MileageEnd'];
			$MileageTotal = $datas['MileageTotal'];
			$LatitudeStart = $datas['LatitudeStart'];
			$LongitudeStart = $datas['LongitudeStart'];
			$LatitudeEnd = $datas['LatitudeEnd'];
			$LongitudeEnd = $datas['LatitudeEnd'];
			$RepresentativeCode = $datas['RepresentativeCode'];
			$RepresentativeName = $datas['RepresentativeName'];
			$Note = $datas['Note'];
			$Tag = $datas['Tag'];
			$NoOfVisits = $datas['NoOfVisits'];
			$MinOfVisits = jsonToTimeStamp($datas['MinOfVisits']);
			$MaxOfVisits = jsonToTimeStamp($datas['MaxOfVisits']);
			$MinMaxVisitsTime = $datas['MinMaxVisitsTime'];
			$TimeAtClient = $datas['TimeAtClient'];
			$TimeInTravel = $datas['TimeInTravel'];
			$TimeInPause = $datas['TimeInPause'];

			
			
			$insertQuery = " INSERT INTO dailyworkingtime 
							(DailyWorkingTimeID,Date,DateAndTimeStart,DateAndTimeEnd,Length,MileageStart,MileageEnd,MileageTotal,LatitudeStart,LongitudeStart,LatitudeEnd,LongitudeEnd,RepresentativeCode,RepresentativeName,Note,Tag,NoOfVisits,MinOfVisits,MaxOfVisits,MinMaxVisitsTime,TimeAtClient,TimeInTravel,TimeInPause)
							VALUES
							('$DailyWorkingTimeID','$Date','$DateAndTimeStart','$DateAndTimeEnd','$Length','$MileageStart','$MileageEnd','$MileageTotal','$LatitudeStart','$LongitudeStart','$LatitudeEnd','$LongitudeEnd','$RepresentativeCode','$RepresentativeName','$Note','$Tag','$NoOfVisits','$MinOfVisits','$MaxOfVisits','$MinMaxVisitsTime','$TimeAtClient','$TimeInTravel','$TimeInPause');
							";
			$mysqli_query = mysqli_query($conn,$insertQuery);
			
		}
	}
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastID",$data["MetaCollectionResult"])){
			$LastID = $data["MetaCollectionResult"]["LastID"];
			setTimeStamp(6,$LastID);	
			
			if($data["MetaCollectionResult"]["TotalCount"] == 0){
				$j--;
			}else{
				$j++;
			}
			
		}else{
			
			$j--;
		}
	}
	
	// if($i==0){
		// $j=-1;
	// }
}