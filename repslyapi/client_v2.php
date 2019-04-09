<?php
include "config.php";
include "geocode.php";

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

function updateTimeSchedue($IsAlarmclientID){
    echo "<br/>"."https://scsportal.com.au/alam_esclation/alarmschedular.php?IsAlarmclientID=".$IsAlarmclientID;
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => "https://scsportal.com.au/alam_esclation/alarmschedular.php?IsAlarmclientID=".$IsAlarmclientID,
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET"
	 
	));
    $response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);
}

$colsList = "ClientID,TimeStamp,Code,Name,Active,Tag,Territory,RepresentativeCode,RepresentativeName,StreetAddress,ZIP,ZIPExt,City,State,Country,Email,Phone,Mobile,Website,ContactName,ContactTitle,Note,Status,PriceLists";
$colsListArray = explode(',',$colsList);


$j=1;

$data_array_get= [];
$Clients = [];


for($i=0;$i<$j;$i++){
	$cTimeStamp = getTimeStamp(1);
	$data = getData($cTimeStamp);
	

	if(array_key_exists("Clients",$data)){
		$Clients = $data["Clients"];
		echo count($Clients)."<br/>";
		/*if(count($Clients)==50)
			$j++;*/
		$ijk =0;
		foreach($Clients as $datas){
		    
		   // echo $ijk++;
		    
		    
			$ClientID = "";
			$TimeStamp = "";
			$Code = "";
			$Name = "";
			$Active = "";
			$Tag = "";
			$Territory = "";
			$RepresentativeCode = "";
			$RepresentativeName = "";
			$StreetAddress = "";
			$ZIP = "";
			$ZIPExt = "";
			$City = "";
			$State = "";
			$Country = "";
			$Email = "";
			$Phone = "";
			$Mobile = "";
			$Website = "";
			$ContactName = "";
			$ContactTitle = "";
			$Note = "";
			$Status = "";
			$PriceLists = "";
			$CustomFields = "";
			
			$Status = $datas["Status"];
			
			if($Status!="Active Account"){
			    $ClientID = $datas["ClientID"];
			    $del_Client = "DELETE FROM Clients WHERE ClientID = ".$ClientID;
			    $query_result = mysqli_query($conn, $del_Client);
			    $del_AlarmSchedule = "DELETE FROM AlarmSchedule WHERE ClientID = ".$ClientID;
			    $query_AlarmSchedule = mysqli_query($conn, $del_AlarmSchedule);
			    $del_message_cleaner_am = "DELETE FROM message_cleaner_am WHERE clientID = ".$ClientID;
			    $query_message_cleaner_am = mysqli_query($conn, $del_message_cleaner_am);
			    $del_subcontractordetails = "DELETE FROM subcontractordetails WHERE clientID = ".$ClientID;
			    $query_subcontractordetails = mysqli_query($conn, $del_subcontractordetails);
			}
			
			
			if($Status!="Active Account")
			    continue;
			
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
			$PriceLists = implode(',',$datas["PriceLists"]);
			$CustomFields = $datas["CustomFields"];
			
			// Check Client Exist or Not.
			$get_ClientList = "SELECT * FROM Clients WHERE ClientID = ".$ClientID ;
			$query_result = mysqli_query($conn, $get_ClientList);
			
			if(mysqli_num_rows($query_result) > 0){
				
				$first_query_result = [];
				
				while($rows_Details = mysqli_fetch_assoc($query_result)){
					$first_query_result = $rows_Details;
					break;
				}
				
				
				 $update_query = "
								UPDATE Clients
								SET TimeStamp = '$TimeStamp',
									Code = 	'$Code',
									Name = 	'$Name',
									Active = '$Active',
									Tag = '$Tag',
									Territory = '$Territory',
									RepresentativeCode = '$RepresentativeCode',
									RepresentativeName = '$RepresentativeName',
									StreetAddress = '$StreetAddress',
									ZIP = '$ZIP',
									ZIPExt = '$ZIPExt',
									City = '$City',
									State = '$State',
									Country = '$Country',
									Email = '$Email',
									Phone = '$Phone',
									Mobile = '$Mobile',
									Website = '$Website',
									ContactName = '$ContactName',
									ContactTitle = '$ContactTitle',
									Note = '$Note',
									Status = '$Status',
									PriceLists = '$PriceLists'
								WHERE	ClientID = $ClientID";
								
								
					$query_update = mysqli_query($conn, $update_query);
					
				
					
					$get_ClientList_update = "SELECT * FROM Clients WHERE ClientID = ".$ClientID ;
					$get_ClientList_update_Query = mysqli_query($conn, $get_ClientList_update);
					
					$second_query_result = [];
					
					while($result_recond = mysqli_fetch_assoc($get_ClientList_update_Query)){
						$second_query_result = $result_recond;		
						break;
					}
					
					$lat = $first_query_result['gps_lat'] ;
					$lng = $first_query_result['gps_lng'] ;
					$isNeedtoChange = false;
					if(strtolower(getAddress($second_query_result)) != strtolower(getAddress($first_query_result)) || $second_query_result['gps_lat'] == ''){ // Update New LatLong
						$rows_data = geoCode($second_query_result);
						//print_r($rows_data);
						if(count($rows_data)==2){
						    $isNeedtoChange = true;
						     $lat = $rows_data['lat'] ;
					         $lng = $rows_data['lng'] ;
						    
							 $update_lat_long = "Update Clients
												SET gps_lat = '".$rows_data['lat']."',
													gps_lng = '".$rows_data['lng']."'
												WHERE ClientID = '$ClientID'
												
												";
												
							//"<br/>Update GeoCode</br/>";
							$update_geo_code = mysqli_query($conn, $update_lat_long);
						}
					}
					
					if(($first_query_result['timeZoneId'] == "" && $first_query_result['timeZoneName'] == "") || $isNeedtoChange){
					    $rowResponse = getTimeZoneName($lat,$lng);
					    
					    
					    
					     $update_timeZone = "Update Clients
												SET timeZoneId = '".$rowResponse['timeZoneId']."',
													timeZoneName = '".$rowResponse['timeZoneName']."'
												WHERE ClientID = '$ClientID'
												";
												
							//"<br/>Update GeoCode</br/>";
							$update_geo_code = mysqli_query($conn,  $update_timeZone );
					    
					}
					
				
			}else{
			    
				$insertQuery = "INSERT INTO Clients 
							(ClientID,TimeStamp,Code,Name,Active,Tag,Territory,RepresentativeCode,RepresentativeName,StreetAddress,ZIP,ZIPExt,City,State,Country,Email,Phone,Mobile,Website,ContactName,ContactTitle,Note,Status,PriceLists,password,login_status)
							VALUES
							('$ClientID','$TimeStamp','$Code','$Name','$Active','$Tag','$Territory','$RepresentativeCode','$RepresentativeName','$StreetAddress','$ZIP','$ZIPExt','$City','$State','$Country','$Email','$Phone','$Mobile','$Website','$ContactName','$ContactTitle','$Note','$Status','$PriceLists',123456,2);
							";
				$mysqli_query = mysqli_query($conn,$insertQuery);
				
			
				
				/*
    				1. AlarmSchedule
                    2. message_cleaner_am
                    3. subcontractordetails
				*/
				$insert_alarm_schedule = "INSERT INTO AlarmSchedule (ClientID) SELECT $ClientID";
				mysqli_query($conn, $insert_alarm_schedule);
				
				$insert_message_cleaner_am = "INSERT INTO message_cleaner_am (clientID) SELECT $ClientID";
				mysqli_query($conn, $insert_message_cleaner_am);
				
				$insert_subcontractordetails = "INSERT INTO subcontractordetails (clientID) SELECT $ClientID";
				mysqli_query($conn, $insert_subcontractordetails);
				
				$get_ClientList_update = "SELECT * FROM Clients WHERE ClientID = '".$ClientID."'" ;
				$get_ClientList_update_Query = mysqli_query($conn, $get_ClientList_update);
				$second_query_result = [];
				while($result_recond = mysqli_fetch_assoc($get_ClientList_update_Query)){
					$second_query_result = $result_recond;		
					break;
				}
				
				
				
				
				if(count($second_query_result ) > 0){
					$rows_data = geoCode($second_query_result);
					
					
					if(count($rows_data )==2){ //UPDATE Clients GeoCode
						
						$update_lat_long = "Update 	Clients
											SET gps_lat = '".$rows_data['lat']."',
												gps_lng = '".$rows_data['lng']."'
											WHERE ClientID = '$ClientID'
											
											";
												
						$update_geo_code = mysqli_query($conn, $update_lat_long);
						
						
						$rowResponse = getTimeZoneName($rows_data['lat'],$rows_data['lng']);
					    
					    $update_timeZone = "Update 	Clients
												SET timeZoneId = '".$rowResponse['timeZoneId']."',
													timeZoneName = '".$rowResponse['timeZoneName']."'
												WHERE ClientID = '$ClientID'
												";
												
							//"<br/>Update GeoCode</br/>";
							$update_geo_code = mysqli_query($conn,  $update_timeZone );
					}
				}
			}
			
			// Delete Previous customfields Data 
			$delete_oldcustome_data = "DELETE FROM customfields WHERE clientID = $ClientID";
			$mysqli_delte_rows = mysqli_query($conn, $delete_oldcustome_data);
				
			//continue; // For escaping the situation ....
			if(count($CustomFields) > 0){
				// Inserting All the Custom Fields.
    			foreach($CustomFields as $v2){
    				$key = addslashes($v2["Field"]);
    				$value = addslashes($v2["Value"]);
    				
    				$insertCustomField = "INSERT INTO customfields
    									(clientID, Field,Value)
    									values ($ClientID, '$key','$value')
    					
    				";
    				$mysqli_query = mysqli_query($conn,$insertCustomField);
    			}//Insert Records
    			
    			// Update Code for File Wise Data....
    			//--------------************-------------------
    			$update_CustomFieldData = " Update message_cleaner_am
                                            SET notificationtocleaner = (SELECT VALUE FROM customfields a WHERE a.clientID = message_cleaner_am.clientID AND Field like '[message from AM to cleaner].Notification to cleaner' LIMIT 0,1),
                                                DueDate = (SELECT VALUE FROM customfields a WHERE a.clientID = message_cleaner_am.clientID AND Field like '[message from AM to cleaner].Date due by must be in (31\/12\/2018 Format)' LIMIT 0,1),
                                                message = (SELECT VALUE FROM customfields a WHERE a.clientID = message_cleaner_am.clientID AND Field like '[message from AM to cleaner].Message to cleaner' LIMIT 0,1)
                                            WHERE clientID = $ClientID";
    			mysqli_query($conn,$update_CustomFieldData);
    			
    			//For Contracter Details Update
    		   $update_ContracterDetails = "   Update subcontractordetails
                                                SET SubContractorsBusinessName = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Sub Contractors Business Name' LIMIT 0,1),
                                                    SubContractorsContactName = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Sub Contractors Contact Name' LIMIT 0,1),
                                                    SubContractorEmail = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Sub Contractor Email' LIMIT 0,1),
                                                    SubcontractorsMobile = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Subcontractors Mobile' LIMIT 0,1),
                                                    DirectorsMobile = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Directors Mobile' LIMIT 0,1),
                                                    DirectorsEmail = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Directors Email' LIMIT 0,1),
                                                    OperationsEmail = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Operations Email' LIMIT 0,1),
                                                    OperationsMobile = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Operations Mobile' LIMIT 0,1),
                                                    AccountManagerName = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Account Manager Name' LIMIT 0,1),
                                                    AccountManagersEmail = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Account Managers Email' LIMIT 0,1),
                                                    Accountmanagermobile = (SELECT VALUE FROM customfields a WHERE a.clientID = subcontractordetails.clientID AND Field = '[Subcontractors Details].Account manager mobile' LIMIT 0,1)
                                                WHERE clientID = $ClientID ";
    			
    			mysqli_query($conn,$update_ContracterDetails);
    			
    			$update_Alarm_Schedule = " Update AlarmSchedule
                        SET IsAlarmActive = (SELECT Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Do you wish to activate the Alarm Escalation Protocol' LIMIT 0,1),
                        	IsAlarmActiveMonday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Monday Yes\/No?' LIMIT 0,1),
                            IsAlarmActiveTuesday = (SELECT Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Tuesday Yes\/No?' LIMIT 0,1),
                        	IsAlarmActiveWednesday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Wednesday Yes\/No?' LIMIT 0,1),
                        	IsAlarmActiveThursday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Thursday Yes\/No?' LIMIT 0,1),
                        	IsAlarmActiveFriday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Wednesday Yes\/No?' LIMIT 0,1),
                        	IsAlarmActiveSaturday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Friday Yes\/No?' LIMIT 0,1),
                        	IsAlarmActiveSunday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Activate Alarm for Saturday Yes\/No?' LIMIT 0,1),
                        
                        	EarliestCleanTimeMonday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Monday, look for check in (earliest starting time)' LIMIT 0,1),
                        	EarliestCleanTimeTuesday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Tuesday, look for check in (earliest starting time)' LIMIT 0,1),
                        	EarliestCleanTimeWednesday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Wednesday, look for check in (earliest starting time)' LIMIT 0,1),
                        	EarliestCleanTimeThursday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Thursday, look for check in (earliest starting time)' LIMIT 0,1),
                        	EarliestCleanTimeFriday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Friday, look for check in (earliest starting time)' LIMIT 0,1),
                        	EarliestCleanTimeSaturday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Saturday, look for check in (earliest starting time)' LIMIT 0,1),
                        	EarliestCleanTimeSunday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Sunday, look for check in (earliest starting time)' LIMIT 0,1),
                        
                        	DealineCleanTimeMonday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Mondays cleaning deadline in hours' LIMIT 0,1),
                        	DealineCleanTimeTuesday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Tuesdays cleaning deadline in hours' LIMIT 0,1),
                        	DealineCleanTimeWednesday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Wenesday cleaning deadline in hours' LIMIT 0,1),
                        	DealineCleanTimeThursday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Thursday\'s cleaning deadline in hours' LIMIT 0,1),
                        	DealineCleanTimeFriday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Friday\'s cleaning deadline in hours' LIMIT 0,1),
                        	DealineCleanTimeSaturday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Saurday\'s cleaning deadline in hours' LIMIT 0,1),
                        	DealineCleanTimeSunday = (SELECT  Value From customfields c WHERE AlarmSchedule.ClientID = c.clientID AND FIELD ='[Alarm Escalation Protocol].Sundays cleaning deadline in hours' LIMIT 0,1)
                                
                        WHERE clientID = $ClientID  ";
    		
    		    mysqli_query($conn,$update_Alarm_Schedule);
    		    
    		    echo $ClientID;
    		    updateTimeSchedue($ClientID);
			}
		}
	}
	
	if(array_key_exists("MetaCollectionResult",$data)){
		if(array_key_exists("LastTimeStamp",$data["MetaCollectionResult"])){
			$LastTimeStamp = $data["MetaCollectionResult"]["LastTimeStamp"];
			if($LastTimeStamp != "0")
			    setTimeStamp(1,$LastTimeStamp);
		//echo $LastTimeStamp;
		}else{	
			$j--;
		}
	}
}

    /*  Comment By Nayan

            $body = "Hi<br/>AutoSchedular Run... <br/> Total ".count($Clients)."New Records ";

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
        	$mail->FromName = "VBEasy";
        	$mail->AddCC('scspl.nayan@gmail.com', 'Nayan Babariya');
        	$mail->addAddress('rajshakya@vbeasy.com', 'Raj VBEasy');
        	
        	//$mail->AddCC('scspl.nayan@gmail.com', 'Nayan Babariya');
        	
        	//$mail->addAddress($address['Email'], $address['User']);
        	//$mail->addAddress('scspl.nayan@gmail.com', "Nayan Patel");
        
        	
        	$mail->isHTML = true;
        	$mail->Subject = "Repsly Auto Schedule - ".date('Y-m-d H:i:s');
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
	        

    */
// Updating Custom Fields details
