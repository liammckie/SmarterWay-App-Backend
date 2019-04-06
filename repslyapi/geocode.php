<?php
function getLatLong($address){
	$address = urlencode($address);
	$url = "https://maps.googleapis.com/maps/api/geocode/json?address=".$address."&key=AIzaSyBw18IVeAA09adBjLjCaYNsy_QBTwyH-M8";
	
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
		"Cache-Control: no-cache",
		"Postman-Token: 910a74a5-bfc0-48af-8d8d-1a9c98719a16"
	  ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
	if ($err) {
	  return array("Error"=>$err);
	} else {
		
	  return  json_decode($response,true);
	}
}

function getAddress($row){
	return $row['StreetAddress'].",".$row['ZIP'].",".",".$row['City'].",".$row['State'].",".$row['Country'] ;
}

function geoCode($row){
	$response = [];
	$address = getAddress($row);
	$geoCode = getLatLong($address);
	
	// Checking the GeoCode Generated or Not??
	if(array_key_exists("results",$geoCode)){
		if(count($geoCode["results"]) > 0){
			if(array_key_exists("geometry",$geoCode["results"][0])){
				if($geoCode["results"][0]["geometry"]){
					return $response = $geoCode["results"][0]["geometry"]["location"];
				}
			}
		}
	}
	return $response;
}


function getTimeZoneName($lat,$long){
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://maps.googleapis.com/maps/api/timezone/json?location=".$lat.",".$long."&timestamp=".time()."&key=AIzaSyBw18IVeAA09adBjLjCaYNsy_QBTwyH-M8",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Cache-Control: no-cache",
        "Postman-Token: 56087528-6af6-430a-8e29-cf68c4d8873a"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      return [];
    }else {
      return json_decode($response,true);
    }
    
}

//$geoCode = getLatLong("214 Glengala Road, 320, Sunshine, Victoria, Australia");

//echo "<pre>";
//print_r($geoCode);
//echo "</pre>";

?>

