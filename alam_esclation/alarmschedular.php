<?php 

die(); // 13 April 6:15pm - Please read below comment

/** 

This script is untable and is continuously creating connections to the databases that are not closed off.
DB Queries executed by for loop on line 40 resolve an error.
This will need to be repaired to prevent server from crashing. 

PHP Warning:  mysqli_fetch_assoc() expects parameter 1 to be mysqli_result, 
boolean given in /var/app/current/alam_esclation/alarmschedular.php on line 40

This script has been terminated prior to it's execution on 13 April 6:15pm by Daynis

*/


include "db_config.php";





//echo "Current Time : ".time();

$offset = get_timezone_offset('UTC','Australia/Melbourne');
$offset_time = time() + $offset;

$cDate  = gmdate("Y-m-d H:i:00", $offset_time);
$jobCheckingDate = gmdate("Y-m-d", $offset_time); 

$currentDay = date("l",strtotime($cDate)); // Get the day
$earlierTime = "EarliestCleanTime".$currentDay;
$deadlineTime = "DealineCleanTime".$currentDay;
$IsAlarmActive = "IsAlarmActive".$currentDay;

$IsAlarmclientID = "";
$modifyClientId = 0;
if(isset($_GET['IsAlarmclientID'])){
    $IsAlarmclientID = " AND C.ClientID = ".$_GET['IsAlarmclientID'];
    $modifyClientId = $_GET['IsAlarmclientID'];
}


function getListOfAlarmEsce(){
    global $conn,$earlierTime,$deadlineTime,$IsAlarmActive, $IsAlarmclientID;
    
    $select_ClientList = "SELECT C.Name as SiteName  ,C.Code, C.ClientID ,$earlierTime as CheckTime,  $deadlineTime as CheckEndTime, timeZoneId, timeZoneName, s.*
                          FROM AlarmSchedule a 
                            INNER JOIN Clients C ON C.ClientID = a.ClientID AND status = 'Active Account'  $IsAlarmclientID 
                            INNER JOIN subcontractordetails s ON s.clientID = a.ClientID 
                          WHERE IsAlarmActive = 'Yes' AND $IsAlarmActive = 'Yes'
                          ";
    $mysqli_Data = mysqli_query($conn, $select_ClientList );
    $rowsData = [];
    while($result = mysqli_fetch_assoc( $mysqli_Data)){
        $rowsData[] = $result;    
    }
    return $rowsData;
}

function getTime($t){
    //$t = str_replace(":00"," ",$t);
    $t = explode(":00",$t);

    return $t[0].":00";
}

$respnse =  getListOfAlarmEsce();

echo "<pre>";

print_r($respnse );

if(is_array($respnse)){
    foreach($respnse as $key){ //Resposne Check with TimeZoneWise....
        
        if($key["timeZoneId"]=="")
            continue;
        
        echo "=======================================================<br/>";
        echo $key["timeZoneId"]."<br/>";
         $currentOffset = get_timezone_offset('UTC',$key["timeZoneId"]);
        $currentOffsetSiteTime = time() + $currentOffset ;
        
        echo "<br/>Current Offset : ".time();
        
        echo "<br/>Current Updated Offset :-".$currentOffsetSiteTime;
        
        
        $currentDateTime  = gmdate("Y-m-d H:i:00", $currentOffsetSiteTime);
        echo "<br/>CurrentTime".$currentDateTime;
        $setDateTimeCheck  = gmdate("Y-m-d ".getTime($key["CheckTime"]).":00", $currentOffsetSiteTime);
        echo "<br/>CheckinEligibleTime".$setDateTimeCheck;
        
        $new_time = date("Y-m-d H:i:s", strtotime(strtolower($key["CheckEndTime"])." ".$setDateTimeCheck)); // $now + 3 hours
        echo "<br/>New Time".$new_time;
        
        $getRunnableUtcTime =  strtotime($new_time) - $currentOffset; // For Unix TimeStamp Check
        echo "<br/>RunableUtCTime : ".$getRunnableUtcTime;
        
        $runabbleTime  = gmdate("Y-m-d H:i:s", $getRunnableUtcTime);
        echo "<br/>Runnable DateTime : ".$runabbleTime;
        //exit;
        
        $job_ClientID = $key["ClientID"];
        $job_unixtime = $getRunnableUtcTime;
        $job_StartTime = $runabbleTime;
        $job_UTCOffset = $currentOffset;
        $jobDate = gmdate("Y-m-d", $getRunnableUtcTime);
        //Set Master Job Details....
        
        $job_Id = 0;
        
        $clientCheck = "";
        
        
        $clientCheck  = " AND ClientID = $job_ClientID";
        
        $checkClientIsexist = "SELECT * FROM AlarmScheduleDayWise WHERE  date(jobdate) = '".$jobCheckingDate."' ".$clientCheck;
        $check_Query_Result = mysqli_query($conn, $checkClientIsexist);
        
        
        if(mysqli_num_rows($check_Query_Result) == 0){ // Insert if this jobz
            $insertJob = " INSERT INTO AlarmScheduleDayWise (ClientID, unixtime, StartTime, UTCOffset, jobdate)
                        VALUES($job_ClientID, '$job_unixtime', '$job_StartTime', '$job_UTCOffset','$jobCheckingDate')
                     ";
    
            $insertMasterjob = mysqli_query($conn, $insertJob);
            $job_Id = mysqli_insert_id($conn);
        }else{ //Update the Job
          
            while($result_job = mysqli_fetch_assoc($check_Query_Result)){
                 $job_Id = $result_job["ASDWID"];
            }
            
             $UpdateJob = " Update AlarmScheduleDayWise
                            SET ClientID = $job_ClientID, 
                                unixtime = '$job_unixtime', 
                                StartTime= '$job_StartTime', 
                                UTCOffset= '$job_UTCOffset
                            WHERE ASDWID =  $job_Id
                     ";
    
            $UpdateMasterjob = mysqli_query($conn, $UpdateJob);
            
            $deleteChildJob = "DELETE FROM alaram_esc_log WHERE ASDWID = ".$job_Id;
             mysqli_query($conn, $deleteChildJob);
            
        }
        
       
        
        if($job_Id > 0){
            //Insert Data as per ProtocolWise...
            //1.	Automated phonecall to subby plus txt message to AM.
                // SubContractor Message : 
            if($key["SubcontractorsMobile"] != "" ){
                $name = $key["SubContractorsBusinessName"];
                $MobileNo = $key["SubcontractorsMobile"];
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                $ExecuteDate = $runabbleTime;
                $email = $key["AccountManagersEmail"];
                
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType, stageid, EmailNotification)
                                VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_unixtime',  '$MobileNo', '$TextMessage', 0, 2, 0,'$email')";
                mysqli_query($conn, $insertJob);
            }
            
            if($key["Accountmanagermobile"] != ""){
                $name = $key["AccountManagerName"];
                $MobileNo = $key["Accountmanagermobile"];
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                
                $ExecuteDate = $runabbleTime;
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType, stageid)
                                     VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_unixtime',  '$MobileNo', '$TextMessage', 0, 1, 0)";
                mysqli_query($conn, $insertJob);
            }
                            
    
            //2.	5 mins - Automated phone call to AM
            if($key["Accountmanagermobile"] != ""){
                $name = $key["AccountManagerName"];
                $MobileNo = $key["Accountmanagermobile"];
                $email = $key["OperationsEmail"];
                
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                
                $getRunnableUtcTime = $getRunnableUtcTime + (5*60);
                echo "<br/> AM: Runnable time :- ".$getRunnableUtcTime;
                
                $job_UTCOffset = $getRunnableUtcTime;
                $ExecuteDate = gmdate("Y-m-d H:i:s",  $job_UTCOffset);
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType, stageid,EmailNotification)
                                VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_UTCOffset',  '$MobileNo', '$TextMessage', 0, 2,1,'$email')";
                mysqli_query($conn, $insertJob);
            }
    
            //3.	5 mins – Second call to AM
            if($key["Accountmanagermobile"] != ""){
                $name = $key["AccountManagerName"];
                $MobileNo = $key["Accountmanagermobile"];
                $email = $key["OperationsEmail"];
                 
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                
                $getRunnableUtcTime = $getRunnableUtcTime + (5*60);
                echo "<br/> 2AM: Runnable time :- ".$getRunnableUtcTime;
                
                 $job_UTCOffset = $getRunnableUtcTime;
                $ExecuteDate = gmdate("Y-m-d H:i:s",  $job_UTCOffset);
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType,stageid, EmailNotification)
                                VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_UTCOffset',  '$MobileNo', '$TextMessage', 0,1, '$email')";
                mysqli_query($conn, $insertJob);
            }
            
            //4.	5 mins – Automated phone call to OPS
            if($key["OperationsMobile"] != ""){
                $name = "Sir";//$key["AccountManagerName"];
                $MobileNo = $key["OperationsMobile"];
                $email = $key["DirectorsEmail"];
                
                
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                
               $getRunnableUtcTime = $getRunnableUtcTime + (5*60);
                echo "<br/> OPS: Runnable time :- ".$getRunnableUtcTime;
                 $job_UTCOffset = $getRunnableUtcTime;
                $ExecuteDate = gmdate("Y-m-d H:i:s",  $job_UTCOffset);
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType,stageid, EmailNotification)
                                VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_UTCOffset',  '$MobileNo', '$TextMessage', 0, 2,2,'$email')";
                mysqli_query($conn, $insertJob);
            }
            
            //5.	5 mins – Second call to OPS
            if($key["OperationsMobile"] != ""){
                $name = "Sir";//$key["AccountManagerName"];
                $MobileNo = $key["OperationsMobile"];
                $email = $key["DirectorsEmail"];
                
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                
                $getRunnableUtcTime = $getRunnableUtcTime + (5*60);
                echo "<br/> 2OPS: Runnable time :- ".$getRunnableUtcTime;
                
                $job_UTCOffset = $getRunnableUtcTime;
                $ExecuteDate = gmdate("Y-m-d H:i:s",  $job_UTCOffset);
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType,stageid, EmailNotification)
                                VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_UTCOffset',  '$MobileNo', '$TextMessage', 0, 2,2,'$email')";
                mysqli_query($conn, $insertJob);
            }
            //6.  5 mins – Automated Phone call to GM
            if($key["DirectorsMobile"] != ""){
                
                $name = "Sir";//$key["AccountManagerName"];
                $MobileNo = $key["DirectorsMobile"];
                $TextMessage = "Hello Mr.".$name.", Your Site : ".$key["SiteName"]."(".$key["Code"].") cleaning Deadling time is over. Please check site..";
                
                $getRunnableUtcTime = $getRunnableUtcTime + (5*60);
                echo "<br/> GM: Runnable time :- ".$getRunnableUtcTime;
                
                $job_UTCOffset = $getRunnableUtcTime;
                $ExecuteDate = gmdate("Y-m-d H:i:s",  $job_UTCOffset);
                
                $insertJob = "  INSERT INTO alaram_esc_log (clientID, ASDWID, Name, ExecuteDate, UTCTime, MobileNo, TextMessage, Status, RequestType,stageid)
                                VALUES($job_ClientID, $job_Id, '$name', '$ExecuteDate', '$job_UTCOffset',  '$MobileNo', '$TextMessage', 0, 2,3)";
                mysqli_query($conn, $insertJob);
            }
        }
    }
}


?>