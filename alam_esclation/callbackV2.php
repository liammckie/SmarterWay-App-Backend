<?php 
include "db_config.php";

$note=<<<XML
<Response/>
XML;

$xml=new SimpleXMLElement($note);
header("Content-type: text/xml; charset=utf-8");
echo $xml->asXML();


function sendEmails($address,$subject,$body,$attachmentFilePath=''){
    require_once "../restapi/phpmailer/vendor/autoload.php";
    
    $mail = new PHPMailer;
    //Enable SMTP debugging. 
    $mail->SMTPDebug = 0	;                               
    $mail->isSMTP = true;            
    $mail->Host = "box6171.bluehost.com";
    $mail->SMTPAuth = true;                          
    $mail->Username = "developer@scs.vbeasy.com";                 
    $mail->Password = "123!@#asd";                           
    $mail->SMTPSecure = "tls";                           
    $mail->Port = 26;  
    if($attachmentFilePath != '')				
    $mail->addAttachment($attachmentFilePath);
    
    $mail->From = "developer@scs.vbeasy.com";
    $mail->FromName = "VBEasy Developer";
    $mail->AddCC('rajshakya@vbeasy.com', 'Raj');
    $mail->addAddress($address['Email'], $address['User']);
    //$mail->addAddress('scspl.nayan@gmail.com', "Nayan Patel");
    //$mail->addAddress('simplyanimaljobs@gmail.com', $address['User']);
    
    $mail->isHTML = true;
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AltBody = "This is the plain text version of the email content";
    
    if(!$mail->send()) 
    {
    //echo "email not send sucessfully to ";
    'Mailer Error: ' . $mail->ErrorInfo;
    return true;
    } 
    else 
    {
    return false;
    }
}

function stripslashes_deep($value) {
  $value = is_array($value) ?
    array_map('stripslashes_deep', $value) :
    stripslashes($value);
  return $value;
}

$unescaped_post_data = $_REQUEST;

$attributes = $unescaped_post_data;


if(is_array($attributes)){
    $CallSid = $attributes["CallSid"];
    $CallStatus = $attributes["CallStatus"];
     $msg = $attributes["msg"];
    $Digits = $attributes["Digits"];
    
    	$_update_rows = "Update alaram_esc_log 
    	                SET callstatus = '$CallStatus' 
    	                WHERE ResponseID = '$CallSid'";
	    mysqli_query($conn, $_update_rows);
	    
	    if($Digits=="1"){ //Flow execution stop.....
	    
	        $select_Id = "SELECT a.* , b.Name as SiteName
	                      FROM alaram_esc_log  a
	                        INNER JOIN Clients b ON b.ClientID = a.clientID
	                      WHERE a.ResponseID = '$CallSid'";
	        $sel_result_query = mysqli_query($conn, $select_Id);
	        $ASDWID = 0;
	        $email = "";
	        $BodyEmail = "";
	        $siteName = "";
	        while($result_data = mysqli_fetch_assoc($sel_result_query)){
	            $ASDWID = $result_data["ASDWID"];
	            $email = $result_data["EmailNotification"];
	            $BodyEmail = $result_data["TextMessage"];
	            $siteName =  $result_data["SiteName"];
	        }
	        
	    
	        $update_rows_data = "Update alaram_esc_log
                        	     SET status= 3
                        	     WHERE ASDWID = '$ASDWID' AND status = 0   ";
                        	        
            mysqli_query($conn,  $update_rows_data);
            
            $update_rows_master_data = "Update AlarmScheduleDayWise
                                	     SET IsAlaramCompleted = 2
                                	      WHERE ASDWID = '$ASDWID'";
                        	        
            mysqli_query($conn,  $update_rows_master_data);
            
            
            // Sending Emails to Higher Level Authority
            
            if($email != ""){
                $subject = " Alarm Essecalation Deadline time over for - ".$siteName;
		        
		        $emailSend['Email'] = $email;
		        $emailSend['User'] = "SmartCleaningTeam";
		        
		        $msg_body = str_replace("{{ClientName}}",$clientName,$msg_body);
		        
                sendEmails($emailSend,$subject ,$msg_body);
            }
            
	    }
	    
}



$dataAttributes = array_map(function($value, $key) {
    return $key.'="'.$value.'"';
}, array_values($attributes), array_keys($attributes));

$dataAttributes = implode(' ', $dataAttributes);


file_put_contents(time().'.txt', $dataAttributes);




