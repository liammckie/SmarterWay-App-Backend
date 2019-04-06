<?php

eval("\$j = '/Date(1497120177000)/';");
echo $j."<br/>";
$j = str_replace("/Date","",$j);
$j = str_replace("/","",$j);
eval("\$j = $j;");
echo $j."<br/>";
$j = (int)substr($j,0,10);
echo date("Y-m-d H:i:s", $j);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.repsly.com/v3/export/clientnotes/0",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Authorization: Basic N0YwQkE4MDMtQUNGQi00RDZDLUI3RkQtNkUwOTg3ODU1RDQ3OjQwOTVGRkQ1LTI2NDItNDg3NC1BNDBFLUU2NDY1OEE2NTU3MQ==",
    "Cache-Control: no-cache",
    "Postman-Token: 63e5630d-fdf6-418c-b13f-218e618b9c21"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	echo "<pre>";
  print_r(json_decode($response,true));
}