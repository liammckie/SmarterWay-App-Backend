<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/clientNotes/".$timeStamp,
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

$j=1;

for($i=0;$i<$j;$i++){
	$LastID = getTimeStamp(2);
	$data = getData($LastID);
	
	if(array_key_exists("ClientNotes",$data)){
		$Clients = $data["ClientNotes"];
		echo count($Clients);
		if(count($Clients)==50)
			$j++;
		
		
		foreach($Clients as $datas){
			
			$ClientNoteID = $datas['ClientNoteID'];
			$TimeStamp = $datas['TimeStamp'];
			$DateAndTime = jsonToTimeStamp($datas['DateAndTime']);
			$RepresentativeCode = $datas['RepresentativeCode'];
			$RepresentativeName = $datas['RepresentativeName'];
			$ClientCode = $datas['ClientCode'];
			$ClientName = $datas['ClientName'];
			$StreetAddress = $datas['StreetAddress'];
			$ZIP = $datas['ZIP'];
			$ZIPExt = $datas['ZIPExt'];
			$City = $datas['City'];
			$State = $datas['State'];
			$Country = $datas['Country'];
			$Email = $datas['Email'];
			$Phone = $datas['Phone'];
			$Mobile = $datas['Mobile'];
			$Territory = $datas['Territory'];
			$Longitude = $datas['Longitude'];
			$Latitude = $datas['Latitude'];
			$Note = $datas['Latitude'];
			$VisitID = $datas['VisitID'];

			
			
			
			$insertQuery = " INSERT INTO clientnotes 
							(ClientNoteID,TimeStamp,DateAndTime,RepresentativeCode,RepresentativeName,ClientCode,ClientName,StreetAddress,ZIP,ZIPExt,City,State,Country,Email,Phone,Mobile,Territory,Longitude,Latitude,Note,VisitID)
							VALUES
							('$ClientNoteID','$TimeStamp','$DateAndTime','$RepresentativeCode','$RepresentativeName','$ClientCode','$ClientName','$StreetAddress','$ZIP','$ZIPExt','$City','$State','$Country','$Email','$Phone','$Mobile','$Territory','$Longitude','$Latitude','$Note','$VisitID');
							";
			$mysqli_query = mysqli_query($conn,$insertQuery);
		}
	}
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastID",$data["MetaCollectionResult"])){
			$LastID = $data["MetaCollectionResult"]["LastID"];
			setTimeStamp(2,$LastID);
		}else{
			
			$j--;
		}
	}
}