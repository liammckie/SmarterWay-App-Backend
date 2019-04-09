<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/clients/".$timeStamp,
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

$colsList = "ClientID,TimeStamp,Code,Name,Active,Tag,Territory,RepresentativeCode,RepresentativeName,StreetAddress,ZIP,ZIPExt,City,State,Country,Email,Phone,Mobile,Website,ContactName,ContactTitle,Note,Status,PriceLists";
$colsListArray = explode(',',$colsList);


$j=1;

for($i=0;$i<$j;$i++){
	$cTimeStamp = getTimeStamp(1);
	$data = getData($cTimeStamp);
	
	if(array_key_exists("Clients",$data)){
		$Clients = $data["Clients"];
		echo count($Clients);
		if(count($Clients)==50)
			$j++;
		
		
		foreach($Clients as $datas){
			
			$ClientID = $datas["ClientID"];
			$TimeStamp = $datas["TimeStamp"];
			$Code = $datas["Code"];
			$Name = $datas["Name"];
			$Active = $datas["Active"];
			$Tag = $datas["Tag"];
			$Territory = $datas["Territory"];
			$RepresentativeCode = $datas["RepresentativeCode"];
			$RepresentativeName = $datas["RepresentativeName"];
			$StreetAddress = $datas["StreetAddress"];
			$ZIP = $datas["ZIP"];
			$ZIPExt = $datas["ZIPExt"];
			$City = $datas["City"];
			$State = $datas["State"];
			$Country = $datas["Country"];
			$Email = $datas["Email"];
			$Phone = $datas["Phone"];
			$Mobile = $datas["Mobile"];
			$Website = $datas["Website"];
			$ContactName = $datas["ContactName"];
			$ContactTitle = $datas["ContactTitle"];
			$Note = $datas["Note"];
			$Status = $datas["Status"];
			$PriceLists = implode(',',$datas["PriceLists"]);
			$CustomFields = $datas["CustomFields"];
			
			
			if($Status=="Active Account" && $Active==1)
			 {
			$get_ClientList = "SELECT * FROM Clients WHERE ClientID = ".$ClientID ;
			$query_result = mysqli_query($conn, $get_ClientList);
			
			    if(mysqli_num_rows($query_result) > 0){
				
				    $first_query_result = [];
				
				    while($rows_Details = mysqli_fetch_assoc($query_result)){
					    $first_query_result = $rows_Details;
					    break;
				    }
			    }else{
			$insertQuery = " INSERT INTO Clients 
							(ClientID,TimeStamp,Code,Name,Active,Tag,Territory,RepresentativeCode,RepresentativeName,StreetAddress,ZIP,ZIPExt,City,State,Country,Email,Phone,Mobile,Website,ContactName,ContactTitle,Note,Status,PriceLists,password,login_status)
							VALUES
							('$ClientID','$TimeStamp','$Code','$Name','$Active','$Tag','$Territory','$RepresentativeCode','$RepresentativeName','$StreetAddress','$ZIP','$ZIPExt','$City','$State','$Country','$Email','$Phone','$Mobile','$Website','$ContactName','$ContactTitle','$Note','$Status','$PriceLists',123456,2);
							";
			$mysqli_query = mysqli_query($conn,$insertQuery);
			    }
			}
		/*	foreach($CustomFields as $v2){
				$key = $v2["Field"];
				$value = $v2["Value"];
				$insertCustomField = "INSERT INTO customfields
									(clientID, Field,Value)
									values ($ClientID, '$key','$value')
					
				";
				$mysqli_query = mysqli_query($conn,$insertCustomField);
			}
			//Insert Records
			
			*/
		}
	}
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastTimeStamp",$data["MetaCollectionResult"])){
			$LastTimeStamp = $data["MetaCollectionResult"]["LastTimeStamp"];
			setTimeStamp(1,$LastTimeStamp);
		}else{
			
			$j--;
		}
	}
}