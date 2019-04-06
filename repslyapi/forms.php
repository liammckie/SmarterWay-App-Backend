<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/forms/".$timeStamp,
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
print_r($data['Forms'][0]);

exit;*/

$j=1;

for($i=0;$i<$j;$i++){
	$LastID = getTimeStamp(4);
	$data = getData($LastID);
	
	if(array_key_exists("Forms",$data)){
		$Forms = $data["Forms"];
		
		foreach($Forms as $datas){
			
			$FormID = $datas['FormID'];
			$FormName = $datas['FormName'];
			$ClientCode = $datas['ClientCode'];
			$ClientName = $datas['ClientName'];
			$DateAndTime = jsonToTimeStamp($datas['DateAndTime']);
			$RepresentativeCode = $datas['RepresentativeCode'];
			$RepresentativeName = $datas['RepresentativeName'];
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
			$SignatureURL = $datas['SignatureURL'];
			$VisitStart = jsonToTimeStamp($datas['VisitStart']);
			$VisitEnd = jsonToTimeStamp($datas['VisitEnd']);
			$Items = $datas['Items'];
			$VisitID = $datas['VisitID'];

			
			$insertQuery = " INSERT INTO forms 
							(FormID,FormName,ClientCode,ClientName,DateAndTime,RepresentativeCode,RepresentativeName,StreetAddress,ZIP,ZIPExt,City,State,Country,Email,Phone,Mobile,Territory,Longitude,Latitude,SignatureURL,VisitStart,VisitEnd,VisitID)
							VALUES
							('$FormID','$FormName','$ClientCode','$ClientName','$DateAndTime','$RepresentativeCode','$RepresentativeName','$StreetAddress','$ZIP','$ZIPExt','$City','$State','$Country','$Email','$Phone','$Mobile','$Territory','$Longitude','$Latitude','$SignatureURL','$VisitStart','$VisitEnd','$VisitID');
							";
			$mysqli_query = mysqli_query($conn,$insertQuery);
			
			
			foreach($Items as $k){
				$Field = $k['Field'];
				$Value = $k['Value'];
				
				$insertItems = "INSERT INTO forms_items
									(FormID	, Field,Value)
									values ($FormID, '$Field','$Value')
					
				";
				$mysqli_query = mysqli_query($conn,$insertItems);
				
			}
		}
	}
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastID",$data["MetaCollectionResult"])){
			$LastID = $data["MetaCollectionResult"]["LastID"];
			setTimeStamp(4,$LastID);
			
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