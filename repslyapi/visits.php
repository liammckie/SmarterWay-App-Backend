<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/visits/".$timeStamp,
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
print_r(array_keys($data['Visits'][0]));

exit;
*/


$j=1;

for($i=0;$i<$j;$i++){
	$cTimeStamp = getTimeStamp(3);
	$data = getData($cTimeStamp);
	
	if(array_key_exists("Visits",$data)){
		$Visits = $data["Visits"];
		echo count($Visits)."<br/>";
		if(count($Visits)==50)
			$j++;
		
		
		foreach($Visits as $datas){
			
			$VisitID	= $datas["VisitID"];
			$TimeStamp	= $datas["TimeStamp"];
			$Date	= jsonToTimeStamp($datas["Date"]);
			$RepresentativeCode	= $datas["RepresentativeCode"];
			$RepresentativeName	= $datas["RepresentativeName"];
			$ExplicitCheckIn	= $datas["ExplicitCheckIn"];
			$DateAndTimeStart	= jsonToTimeStamp($datas["DateAndTimeStart"]);
			$DateAndTimeEnd	= jsonToTimeStamp($datas["DateAndTimeEnd"]);
			$ClientCode	= $datas["ClientCode"];
			$ClientName	= $datas["ClientName"];
			$StreetAddress	= $datas["StreetAddress"];
			$ZIP	= $datas["ZIP"];
			$ZIPExt	= $datas["ZIPExt"];
			$City	= $datas["City"];
			$State	= $datas["State"];
			$Country	= $datas["Country"];
			$Territory	= $datas["Territory"];
			$LatitudeStart	= $datas["LatitudeStart"];
			$LongitudeStart	= $datas["LongitudeStart"];
			$LatitudeEnd	= $datas["LatitudeEnd"];
			$LongitudeEnd	= $datas["LongitudeEnd"];
			$PrecisionStart	= $datas["PrecisionStart"];
			$PrecisionEnd	= $datas["PrecisionEnd"];
			$VisitStatusBySchedule	= $datas["VisitStatusBySchedule"];
			$VisitEnded	= $datas["VisitEnded"];

			
			$insertQuery = " INSERT INTO visits 
							(VisitID,TimeStamp,Date,RepresentativeCode,RepresentativeName,ExplicitCheckIn,DateAndTimeStart,DateAndTimeEnd,ClientCode,ClientName,StreetAddress,ZIP,ZIPExt,City,State,Country,Territory,LatitudeStart,LongitudeStart,LatitudeEnd,LongitudeEnd,PrecisionStart,PrecisionEnd,VisitStatusBySchedule,VisitEnded)
							VALUES
							('$VisitID','$TimeStamp','$Date','$RepresentativeCode','$RepresentativeName','$ExplicitCheckIn','$DateAndTimeStart','$DateAndTimeEnd','$ClientCode','$ClientName','$StreetAddress','$ZIP','$ZIPExt','$City','$State','$Country','$Territory','$LatitudeStart','$LongitudeStart','$LatitudeEnd','$LongitudeEnd','$PrecisionStart','$PrecisionEnd','$VisitStatusBySchedule','$VisitEnded');
							";
			$mysqli_query = mysqli_query($conn,$insertQuery);
		}
	}
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastTimeStamp",$data["MetaCollectionResult"])){
			$LastTimeStamp = $data["MetaCollectionResult"]["LastTimeStamp"];
			setTimeStamp(3,$LastTimeStamp);
		}else{
			
			$j--;
		}
	}
	
	// if($i==2)
		// $j = 0;
}