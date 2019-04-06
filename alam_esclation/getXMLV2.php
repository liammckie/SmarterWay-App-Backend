<?php
include "db_config.php";
$voiceMessage = "Welcome Raj Test Voic Email $testNayn";

if(isset($_GET['alarm_id'])){
    $alarrm_id = (int)$_GET['alarm_id'];
    
    $select_message = "SELECT * FROM alaram_esc_log WHERE alarm_id = ".$alarrm_id;
    $query_response = mysqli_query($conn, $select_message);
    
    while($result = mysqli_fetch_assoc($query_response)){
        $voiceMessage = $result["TextMessage"];
    }
    
}


$note=<<<XML
<Response>
<Say voice="alice">$voiceMessage</Say>
    <Gather input="speech dtmf" timeout="5" numDigits="1" action="http://scsportal.com.au/alam_esclation/callbackV2.php" method="post" finishOnKey="#">
        <Say>Please press 1 for stop alarm escellation and press # for end call.</Say>
    </Gather>
</Response>
XML;

$xml=new SimpleXMLElement($note);
header("Content-type: text/xml; charset=utf-8");
echo $xml->asXML();
