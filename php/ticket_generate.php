<?php
require 'connection.php';
require 'session.php';
$ClientID = $ClientData;
$attachmentFilePath = "";
$current_date= date("Y-m-d");
if (isset($_POST["name"])) {
	$name=$_POST['name'];
}else{
	$name='';
}
if (isset($_POST["email"])) {
	$email=$_POST['email'];
}else{
	$email='';
}
if (isset($_POST["mobile"])) {
	$mobile=$_POST['mobile'];
}else{
	$mobile='';
}
if (isset($_POST["priority"])) {
	$priority=$_POST['priority'];
}else{
	$priority='';
}
if (isset($_POST["date"])) {
	$date=$_POST['date'];
}else{
	$date='';
}
if (isset($_POST["subject"])) {
	$subject=$_POST['subject'];
}else{
	$subject='';
}

if(empty($_FILES['data']['name'])){
    $file="";
}
else {
    $data = $_FILES['data']['name'];
    $file_ext=strtolower(end(explode('.',$_FILES['data']['name'])));
    $data_type = $_FILES['data']['type'];
    $size = $_FILES['data']['size'];
    $data_tmp = $_FILES['data']['tmp_name'];
    $select="select * from `tickets` order by Id DESC LIMIT 1";
    $selected = mysqli_query($conn, $select);
    while($row=mysqli_fetch_array($selected)){
    $num = $row['Id'];
    $Id = 1+$num;
    }
    $file = $Id.".".$file_ext;
}
$data_folder = "../wp-content/uploads/wpfiles/file/";   
move_uploaded_file($data_tmp , "$data_folder".$file);

$issendEMails = false;

$attachmentFilePath = $data_folder.$file;
$tickets = "insert into `tickets` (ClientID, Priority, file, Auth_Date, Date, Message, Status, name, email, mobile) values ('$ClientID', '$priority', '$file', '$date', '$current_date', '$subject', 'Open', '$name', '$email', '$mobile')";
        mysqli_query($conn, $tickets);
	$issendEMails = true;
        echo"<script>alert('Raised Ticket Successfully');
			window.location.href='../generate_ticket';
			</script>";

	$issendEMails = true;
	if($issendEMails){
	    
	    
	    /*
    	1. Minor :- AM/ Client
	    2. Critical :- AM/ Representative/ Client/ Subcontractor
    	3. Major:- AM/ Representative/ Director/ Client/ Subcontractor
	    */
	    
	    	$seleect_AMEmail = "SELECT s.*, r.Name as RpName, r.Email as RpEmail 
								FROM `subcontractordetails` s
								INNER JOIN Clients c ON c.ClientID =  s.ClientID  AND s.ClientID = $ClientID
								LEFT JOIN  `representatives` r ON r.Code = c.RepresentativeCode
								LIMIT 0,1"; // AccountManagersEmail !=''  AND
			$query_result = mysqli_query($conn, $seleect_AMEmail);
			
			$emailDetailsTo = [];
			while($rows_Data = mysqli_fetch_assoc($query_result)){
			    $AM_Details = [];
			    $rows_Data["AccountManagersEmail"] = $rows_Data["AccountManagersEmail"]==""?"rajshakya@vbeasy.com":$rows_Data["AccountManagersEmail"];
			    $rows_Data["AccountManagerName"] = $rows_Data["AccountManagerName"]==""?"VBEasy Team":$rows_Data["AccountManagerName"];
			    if($rows_Data["AccountManagersEmail"] != ""){
			        $AM_Details["Email"] = $rows_Data["AccountManagersEmail"];
			        $AM_Details["Name"] =$rows_Data["AccountManagerName"];    
			    }
			    if(count($AM_Details) > 0){
			        array_push(	$emailDetailsTo, $AM_Details);
			    }
			    
			    if($priority=="Minor"){
			        
			        // Client Email
			        $clientEmail= [];
			        $clientEmail["Email"] = $email;
			        $clientEmail["Name"] = $name;
			   
			        if($email != ""){
			            array_push(	$emailDetailsTo,  $clientEmail);
			        }
			        
			        //Subcontractor
			        $subEmail= [];
			        $subEmail["Email"] = $row_Data["SubContractorEmail"];
			        $subEmail["Name"] = $row_Data["	SubContractorsContactName"];
			        
			        if($subEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $subEmail);
			        }
			    }
			    else if($priority=="Major"){
			        
			        // Client Email
			        $clientEmail= [];
			        $clientEmail["Email"] = $email;
			        $clientEmail["Name"] = $name;
			   
			        if($email != ""){
			            array_push(	$emailDetailsTo,  $clientEmail);
			        }
			        
			        // Representative 
			        $rpEmail= [];
			        $rpEmail["Email"] = $rows_Data["RpEmail"];
			        $rpEmail["Name"] = $rows_Data["RpName"];
			   
			        if($rpEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $rpEmail);
			        }
			        
			        //Subcontractor
			        $subEmail= [];
			        $subEmail["Email"] = $row_Data["SubContractorEmail"];
			        $subEmail["Name"] = $row_Data["	SubContractorsContactName"];
			        
			        if($subEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $subEmail);
			        }
			    }
			    else if($priority=="Critical"){
			        
			        // Client Email
			        $clientEmail= [];
			        $clientEmail["Email"] = $email;
			        $clientEmail["Name"] = $name;
			   
			        if($email != ""){
			            array_push(	$emailDetailsTo,  $clientEmail);
			        }
			        
			        // Representative 
			        $rpEmail= [];
			        $rpEmail["Email"] = $rows_Data["RpEmail"];
			        $rpEmail["Name"] = $rows_Data["RpName"];
			   
			        if($rpEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $rpEmail);
			        }
			        
			        // Director
			        $dirEmail= [];
			        $dirEmail["Email"] = $rows_Data["DirectorsEmail"];
			        $dirEmail["Name"] = "Director";
			   
			        if($dirEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $dirEmail);
			        }
			        
			        // Operations Manager
			        $OperaEmail= [];
			        $OperaEmail["Email"] = $row_Data["OperationsEmail"];
			        $OperaEmail["Name"] = "Operations Manager";
			        
			        if($OperaEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $OperaEmail);
			        }
			        
			        //Subcontractor
			        $subEmail= [];
			        $subEmail["Email"] = $row_Data["SubContractorEmail"];
			        $subEmail["Name"] = $row_Data["	SubContractorsContactName"];
			        
			        if($subEmail["Email"] != ""){
			            array_push(	$emailDetailsTo,  $subEmail);
			        }
			        
			    }
		}
	
	    if(count($emailDetailsTo) > 0){
	        
	        $body = "Hi,<br/>";
	        $body .= "Below is ticket raised from our valualbe client.";
	        $body .= "<br/><br/><b>Name</b>: ".$name;
	        $body .= "<br/><b>MobileNo</b>: ". $mobile;
	        $body .= "<br/><b>Email : </b>: ". $email;
	        $body .= "<br/><b>Ticket Priority : </b>: ". $priority;
	        $body .= "<br/><b>Ticket Status : </b> :Open";
	        $body .= "<br/><br/><b><u>Message from Client</u></b><br/><p>".$subject."</p>";
	        
	        $emailSubject = "[ $priority ] - client $name raised the ticket";
	        
	        
	        require_once "../restapi/phpmailer/vendor/autoload.php";
		$mail = new PHPMailer;
		//Enable SMTP debugging. 
		$mail->SMTPDebug = 0	;                               
		$mail->isSMTP = true;            
		$mail->Host = "box6171.bluehost.com";
		$mail->SMTPAuth = true;                          
		//$mail->Username = "developer@scs.vbeasy.com";                 
		//$mail->Password = "123!@#asd";    
		$mail->Username = "info@vbeasy.com";                 
		$mail->Password = "Vbeasy#2016";
		$mail->SMTPSecure = "tls";                           
		$mail->Port = 465;  
		if($attachmentFilePath != '')				
			$mail->addAttachment($attachmentFilePath);

		$mail->From = "info@vbeasy.com";
		$mail->FromName = "VB Easy";
        	
        	foreach($emailDetailsTo as $kData){
        	    echo $kData['Email']."<br/>";
        	    echo $kData['name']."<br/>";;
        	    $mail->addAddress($kData['Email'], $kData['Name']);
        	}
        	
        	$mail->AddCC('rajshakya@vbeasy.com', 'Raj VBEasy');
        	
        	$mail->isHTML = true;
        	$mail->Subject = $emailSubject;
        	$mail->Body = $body;
        	$mail->AltBody = "This is the plain text version of the email content";
        
        	if(!$mail->send()) 
        	{
        		//echo "email not send sucessfully to ";
        		echo 'Mailer Error: ' . $mail->ErrorInfo;
        	//	return true;
        	} 
        	else 
        	{   
        	    echo 'email send successfully';
        	}
	    }   
	}
?>
