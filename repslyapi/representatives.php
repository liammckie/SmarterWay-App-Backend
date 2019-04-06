<?php
include "config.php";

function getData($timeStamp){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://api.repsly.com/v3/export/representatives",
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
    
	$data = getData($cTimeStamp);

	if(array_key_exists("Representatives",$data)){
		$Clients = $data["Representatives"];
		
			$insertQuery_truncate = " Truncate Table representatives
							";
					
			$mysqli_query = mysqli_query($conn,$insertQuery_truncate);
			
		foreach(	$Clients  as $datas){
			
			$Code = $datas["Code"];
			$Name = $datas["Name"];
			$Note = $datas["Note"];
			$UserID = $datas["UserID"];
			$Password = $datas["Password"];
			$Email = $datas["Email"];
			$Phone = $datas["Phone"];
			$Mobile = $datas["Mobile"];
			$Territory = $datas["Territory"];
			$Active = $datas["Active"];
			
		
			if($Active!=1)
			    continue;
			
			$insertQuery = " INSERT INTO  representatives
							(Code, Name, Note, UserID, Password, Email, Phone, Mobile, Territory, Active)
							VALUES
							('$Code','$Name','$Note','$UserID','$Password','$Email','$Phone','$Mobile','$Territoty','$Active');
							";
							
							echo "<br/>";
			$mysqli_query = mysqli_query($conn,$insertQuery);
			echo 'Complete Data Inserted';
		}
	}
}