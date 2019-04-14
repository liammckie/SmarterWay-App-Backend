<?php
	/* File : Rest.inc.php
	 * Author : VB Easy
	*/
	
	
    require_once("Rest.inc.php");
	class API extends REST {
		public $data = "";
	  
		
        const DB_SERVER = "db-11-april-midnight.cfkyixhewlor.ap-southeast-2.rds.amazonaws.com";
        const DB_USER = "smart_mobile";
        const DB_PASSWORD = "&e3|MnuQYXQM";
        const DB = "smart_mobile_production";
		
	
		
	/*  		AWS RDS
	const DB_SERVER = "wordpressdb.cfkyixhewlor.ap-southeast-2.rds.amazonaws.com";
        const DB_USER = "smart_mobile";
        const DB_PASSWORD = "&e3|MnuQYXQM";
        const DB = "smart_mobile_production";
	*/		
		
	
		const val = 1;
		
		private $db = NULL;
	
		public function __construct(){
			parent::__construct();				// Init parent contructor
			$this->dbConnect();					// Initiate Database connection
		}
		
		function __destruct() {
			$this->dbConnectClose();
			//print "Destroying " . $this->db . "\n";
		}
		
		/*
		 *  Database connection 
		*/
		private function dbConnect(){
			$this->db = mysqli_connect(self::DB_SERVER,self::DB_USER,self::DB_PASSWORD);
			if($this->db)
				mysqli_select_db($this->db,self::DB);
				mysqli_set_charset($this->db, 'utf8');
		}
		
		private function dbConnectClose(){
			if($this->db)
				mysqli_close($this->db);
				$this->db = null; 
		}
		
		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function testapi(){
			echo 'test api';
			echo $conn = mysqli_connect_error($this->db);
		}
		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);// If the method not exist with in this class, response would be "Page not found".
		}
		
	
		 /* All Required Methods */
		 
			private function checkClientID($clientIDCode) {
				$clientID = 0;
				$sel_client_latlong_details = "SELECT * From `Clients` WHERE `Code` = $clientIDCode OR `ClientID` = $clientIDCode ";
				$query_client_latlong_details = mysqli_query($this->db,$sel_client_latlong_details);
				
				if(mysqli_num_rows($query_client_latlong_details) == 1){
				
					while($row_data = mysqli_fetch_assoc($query_client_latlong_details)){
						$clientID = $row_data['ClientID'];
					}
					return $clientID;
					
				}else{
					$response['message'] = 'No Data Found in checkClientID';
					$response['status'] = '0';
					$this->response($this->json($response),200);
				}
				return $clientID;
			}
			
		 
		    private function getLatlongSiteDetails(){// [Method use for get Site Current Latlong]
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					$this->response($this->json($error),404);
				}else{
					
					$data = $_POST;
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					$checkinId = 0;
					if(isset($data['clientID'])){
						$data['clientID'] = $this->checkClientID($data['clientID']);
						$response['message'] = $data['clientID'] ;
						if((int)$data['clientID'] > 0){
							
							$clientID = (int)$data['clientID'];// Get Client Details
							$sel_client_latlong_details = "SELECT * From 	Clients WHERE clientID =  $clientID";
							$query_client_latlong_details = mysqli_query($this->db,$sel_client_latlong_details);
							
							if(mysqli_num_rows($query_client_latlong_details) >=1){
								while($row_data = mysqli_fetch_assoc($query_client_latlong_details)){
									$response['data'] = $row_data;
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						}else{
							//$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required fields clientID, name, photo';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
		 
			private function getReplenishablesStock(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					$data = $_POST;
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					
					if(isset($data['clientID'])){
						$data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
							$clientID = (int)$data['clientID'];
							$sel_replenish_stock = "SELECT value as ResposibleStock FROM `customfields` 
													WHERE Field like '%[Replenishables Stock].%'
													AND (Field != '[Replenishables Stock].email address for' AND Field != '[Replenishables Stock].Contact name of person')
													AND clientID = $clientID
													AND (value is not null AND value !='')
													ORDER  BY FIELD";
							$query_result = mysqli_query($this->db,$sel_replenish_stock);
							
							if(mysqli_num_rows($query_result) > 0){
								
								while($rows = mysqli_fetch_assoc($query_result)){
									array_push(	$response['data'],$rows['ResposibleStock']);
									
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '1';
							}
							
							
						}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'You Not passed ClientID';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
					
				}
			}
			
			private function getProofOfServiceList(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					$data = $_POST;
					
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					
					$checkinId = (int)$data['checkInID'];
					
					if(isset($data['clientID']) && $checkinId > 0){
						$data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
						$date_current = "";
							if (function_exists('date_default_timezone_set'))
							{
							  date_default_timezone_set('australia/sydney');
							}

							$date_current = date('Y-m-d');
														
							$clientID = (int)$data['clientID'];
							$sel_proofofService = "SELECT replace(Field,'[Proof of Service].','') as zone,a.value as description,
													GROUP_CONCAT(b.imageName) as status
													FROM `customfields` a
														LEFT JOIN proofofservicedetails b ON b.checkinID = $checkinId AND b.clientID = a.clientID AND replace(Field,'[Proof of Service].','') =  b.fieldName AND b.value = a.value AND CAST(b.updateddate as Date) = '".$date_current."'
													WHERE Field like '%[Proof of Service].%'
													AND a.clientID = $clientID
													AND (a.value is not null AND a.value !='')
													GROUP BY  Field, a.value
													ORDER  BY Field";
							$query_result = mysqli_query($this->db,$sel_proofofService);
							
							if(mysqli_num_rows($query_result) > 0){
								
								while($rows = mysqli_fetch_assoc($query_result)){
									if($rows['status'] != "")
										$rows['status'] = 1;
									else 
										$rows['status'] = 0;
									array_push(	$response['data'],$rows);
									
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '1';
							}
						}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'You Not passed ClientID';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
					
				}
			}
			
			private function updateProofOfService(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					
					$data = $_POST;
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					$checkinId = 0;
					if(isset($data['clientID']) && isset($_FILES['photoproof'])){
						$data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
							$clientID = (int)$data['clientID'];
							$checkinId = (int)$data['checkInID'];
							$zoneName = $data['zoneName'];
							//$checkOutTime = $data['checkOutTime'];    
							
							//$response['data'] = $checkOutTime;
							
							$sel_replenish_stock = "SELECT * From clientcleaninglog WHERE clientID =  $clientID AND cleaning_logId = $checkinId ";//AND status <> 1 
							$query_result = mysqli_query($this->db,$sel_replenish_stock);
							
							$file_name = "";
							
							if(mysqli_num_rows($query_result) > 0){
								
								$sel_zoneListChecking = "SELECT replace(Field,'[Proof of Service].','') as zone,value as description FROM `customfields` 
													WHERE Field like '%[Proof of Service].%'
													AND clientID = $clientID
													AND (value is not null AND value !='')
													AND replace(Field,'[Proof of Service].','') = '$zoneName'
												";
								$query_result_zone_checking = mysqli_query($this->db,$sel_zoneListChecking);
								
								if(mysqli_num_rows($query_result_zone_checking)==0){
									$response['data'] = "";
									$response['message'] = "You requested wrong zone. Please check zone and send us correct zone";
									$response['status'] = "0";
									$this->response($this->json($response),200);
								}
								
								if(isset($_FILES['photoproof'])){ //Checking UserPhoto
								    $d_image = [];
								    $d_image[0] = $_FILES['photoproof'];
									$fileArray =  $d_image;//$this->reArrayFiles($_FILES['photoproof']);
									
									$data_zoneName = "";
									$data_value = "";
									while($result_checking_data = mysqli_fetch_assoc($query_result_zone_checking)){
										$data_zoneName = $result_checking_data['zone'];
										$data_value = $result_checking_data['description'];
									}
									
									
									
									
									foreach($fileArray as $a){
										$errors= array();
										$file_name = $a['name'];
										$file_size = $a['size'];
										$file_tmp = $a['tmp_name'];
										$file_type = $a['type'];
										//$file_ext=end((explode('.',$a['name'])));
										
										//$expensions= array("jpeg","jpg","png");
									  	
										/*if(in_array($file_ext,$expensions)=== false){
											$errors[]="extension not allowed, please choose a JPEG or PNG file.";
										}*/
									  
										/*if($file_size > 2097152) {
											$errors[]='File size must be excately 2 MB';
										}*/
									  
										if(empty($errors)==true) {
											//Inserting Checkout Logs.
											//$currentCheckinTime = $checkinTime;
											
										   /* $date_current = "";
                							if (function_exists('date_default_timezone_set'))
                							{
                							  date_default_timezone_set('australia/sydney');
                							}
                
                							$date_current = date('Y-m-d h-i-s');*/
											if(isset($_POST['current_date'])){	
											$date_current = $_POST['current_date'];
											}else{
											$date_current = '';
											}
											$insert_proof_update = "INSERT INTO 
															proofofservicedetails(checkinID, clientID, fieldName, value, updateddate) 
															VALUES($checkinId, $clientID, '$data_zoneName', '$data_value', '$date_current')
															";
											mysqli_query($this->db,$insert_proof_update );
											
											$insertedID = mysqli_insert_id($this->db);
											$checkinId = $insertedID;
											//$file_name = $insertedID.".".$file_ext;
											move_uploaded_file($file_tmp,"../wp-content/uploads/wpfiles/serviceProof/".$file_name);
											
											$update_proof = "Update proofofservicedetails
															SET	imageName = '$file_name'
																WHERE pr_id = $insertedID
																";
											
											
											
											mysqli_query($this->db,$update_proof);
											
											$response['message'] = 'You file upload sucessfully';
											$response['status'] = "1";
											
											$checkoutUrls = "../wp-content/uploads/wpfiles/serviceProof/".$file_name;
											if(file_exists($checkoutUrls)) {
											    $checkoutUrl = $_SERVER['HTTP_HOST']."/wp-content/uploads/wpfiles/serviceProof/".$file_name;
											} else {
											    $checkoutUrl = "Again Upload File";
											}
											$response['data']["imageUrl"] = [];
											array_push($response['data']["imageUrl"],$checkoutUrl);
											
										}else{ // If any error Found. we can check
											$response['message'] = 'You file is not valid';
											$response['status'] = "0";
											
										}
									}//File Array Looping End
								
								    
								   
								}else{
								    $response['message'] = 'Your file is not Found.';
								    $response['status'] = "1";
								    
								}
								
								
							}else{
								$response['message'] = 'You either logged out or your records not found.';
								$response['status'] = '1';
							}
							
							
						}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required fields clientID, name, photo';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
			
			private function getTicketDetails(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					$data = $_POST;
					
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					
					if(isset($data['clientID'])){
						$data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
							$clientID = (int)$data['clientID'];
							$sel_getTicketDetails = "SELECT *
													FROM tickets
													WHERE clientID = $clientID
													ORDER  BY Id DESC";
							$query_result = mysqli_query($this->db,$sel_getTicketDetails);
							
							if(mysqli_num_rows($query_result) > 0){
								
								while($rows = mysqli_fetch_assoc($query_result)){
									array_push(	$response['data'],$rows);
									
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '1';
							}
						}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'You Not passed ClientID';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
					
				}
			}
			
			private function getClientNotification(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}
				else{
					
					
					$data = $_POST;
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					$checkinId = 0;
					if(isset($data['clientID']) && isset($data['checkInID'])){
					    $data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
							$clientID = (int)$data['clientID'];
							$checkInID = (int)$data['checkInID'];
							if(isset($data['name'])){
							$name = $data['name'];
							}else{
							$name = '';
							}
						
						    $sel_clientNotification = "SELECT C.clientID ,sc.*,am.* , (SELECT COUNT(*) FROM tickets WHERE clientID = $clientID AND status = 'Open' ) as OpenTicket 
													From Clients C
													    INNER JOIN subcontractordetails sc ON sc.clientID = C.clientID
													    LEFT JOIN message_cleaner_am am ON am.clientID = C.clientID
													    INNER JOIN clientcleaninglog ccl ON ccl.clientID = C.clientID AND cleaning_logId = $checkInID AND ccl.status=1
													WHERE C.clientID =  $clientID";
							$query_result = mysqli_query($this->db,$sel_clientNotification);
							$response['data'] =$sel_clientNotification;
							while($rows = mysqli_fetch_assoc($query_result)){
									$rows['checkinId'] = $checkInID;
									$rows['OpenTicket'] = (int)$rows['OpenTicket'];
									
									$isMessageShowo = false;
        						    if(strtolower($rows["notificationtocleaner"]) == "yes"){
        						        $date = $rows["DueDate"];
        						        if($date!=""){
        						            $dates = preg_split('/\//',$date);
                                            $month = $dates[1];
                                            $day = $dates[0];
                                            $year = $dates[2];
                                    
                                            $finalDate = $year.'-'.$month.'-'.$day;
        						            if(date('Y-m-d') <= date_format(date_create($finalDate),"Y-m-d")){
        						                 $isMessageShowo =true;
        						            }
        						            //$isMessageShowo =date_create($finalDate);
        						            
        						        }else{
        						             $isMessageShowo = true;
        						        }
        						    }
        						    $rows["isMessageShow"] = (int)$isMessageShowo;
									
									$response['data'] = $rows;
									
									
								}
								$response['status'] = "1";
							
						}else{
							$response['message'] = 'Your clientID is not found. Or You logout.';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required fields clientID, name, photo';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
					
				}
			}
			
			private function getClientDeatails(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					
					
					$data = $_POST;
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					$checkinId = 0;
					if(isset($data['clientID']) && isset($data['name']) && isset($_FILES['photo'])){
					    $data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
							$clientID = (int)$data['clientID'];
							$name = $data['name'];
							$checkinTime = $data['checkinTime'];
							
							$checkinTime = ($checkinTime == ""?date('Y-m-d H:i:s'):$checkinTime);
						    $sel_replenish_stock = "SELECT * , (SELECT COUNT(*) FROM tickets WHERE clientID = $clientID AND status = 'Open' ) as OpenTicket 
													From Clients C
													    LEFT JOIN subcontractordetails sc ON sc.clientID = C.clientID
													    LEFT JOIN message_cleaner_am am ON am.clientID = C.clientID
													WHERE C.clientID =  $clientID";
							$query_result = mysqli_query($this->db,$sel_replenish_stock);
							$file_name = "";
							
							$response['data'] =	$sel_replenish_stock;
							
							if(mysqli_num_rows($query_result) > 0){
								
								if(isset($_FILES['photo'])){ // Checking UserPhoto
						
									$errors= array();
									$file_name = $_FILES['photo']['name'];
									$file_size = $_FILES['photo']['size'];
									$file_tmp = $_FILES['photo']['tmp_name'];
									$file_type = $_FILES['photo']['type'];
									$file_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
								  
									//$expensions= array("jpeg","jpg","png");
								  
									/*if(in_array($file_ext,$expensions)=== false){
										$errors[]="extension not allowed, please choose a JPEG or PNG file.";
									}*/
								  
									/*if($file_size > 2097152) {
										$errors[]='File size must be excately 2 MB';
									}*/
								  
									if(empty($errors)==true) {
										
										//Inserting Logs.
										$currentCheckinTime = $checkinTime;
										$insertNewLog = "INSERT INTO clientcleaninglog
											(clientID, cleanerName, checkInDate)
											VALUES($clientID,'$name','$currentCheckinTime')
										";
										
										
										mysqli_query($this->db,$insertNewLog );
										
										$insertedID = mysqli_insert_id($this->db);
										
										$checkinId = $insertedID;
										
										$file_name = $insertedID.".".$file_ext;
										
										 move_uploaded_file($file_tmp,"../wp-content/uploads/wpfiles/CheckinPhotos/".$file_name);
										 
										 $updateLog_Photos = "Update clientcleaninglog
															SET clearLoginPhoto = '$file_name'
															WHERE cleaning_logId = $insertedID 
										";
										mysqli_query($this->db,$updateLog_Photos );
										
										
										 
									}else{
										 
									}
								}
								
								while($rows = mysqli_fetch_assoc($query_result)){
									$rows['checkingFileNameUrl'] = $_SERVER['HTTP_HOST']."/wp-content/uploads/wpfiles/CheckinPhotos/".$file_name;
									$rows['checkinId'] = $checkinId;
									$rows['OpenTicket'] = (int)$rows['OpenTicket'];
									
									$isMessageShowo = false;
        						    if($rows["notificationtocleaner"] == "Yes"){
        						        $date = $rows["DueDate"];
        						        if($date!=""){
        						            $dates = preg_split('/\//',$date);
                                            $month = $dates[1];
                                            $day = $dates[0];
                                            $year = $dates[2];
                                    
                                            $finalDate = $year.'-'.$month.'-'.$day;
        						            if(date('Y-m-d') <= date_format(date_create($finalDate),"Y-m-d")){
        						                 $isMessageShowo =true;
        						            }
        						        }else{
        						             $isMessageShowo = true;
        						        }
        						        
        						        
        						    }
        						    $rows["isMessageShow"] = (int)$isMessageShowo;
									
									$response['data'] = $rows;
									
									
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
							
							
						}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required fields clientID, name, photo';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
					
				}
			}
			
			private function getClientCheckOut(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					
					
					$data = $_POST;
					$response = [];
					$response['message'] = "";
					$response['status'] = "";
					$response['data'] = [];//$data;
					$checkinId = 0;
					if(isset($data['clientID'])){
						$data['clientID'] = $this->checkClientID($data['clientID']);
						if((int)$data['clientID'] > 0){
							// Get Stocke Details
							$clientID = (int)$data['clientID'];
							$checkinId = (int)$data['checkInID'];
							if (isset($data["checkoutRemarks"])) {
							$checkoutRemarks = $data['checkoutRemarks'];
							}else{
							$checkoutRemarks = '';
							}
							$checkOutTime = $data['checkOutTime'];
							$checkOutTime = $checkOutTime == ""?date('Y-m-d H:i:s'):$checkOutTime;
							$response['data'] = $checkOutTime;
							
							$sel_replenish_stock = "SELECT * From clientcleaninglog WHERE clientID =  $clientID AND cleaning_logId = $checkinId";
							$query_result = mysqli_query($this->db,$sel_replenish_stock);
							
							$file_name = "";
							$response['data']= array("checkoutFiles"=> array(),"checkOutTime"=>$checkOutTime,'checkoutRemarks'=>$checkoutRemarks);
							
							if(mysqli_num_rows($query_result) > 0){
								
								$update_checkOutLogs = "UPDATE clientcleaninglog 
														SET checkOutDate = '$checkOutTime',
															status = 2,
															checkoutRemarks = '$checkoutRemarks'
															
														WHERE clientID =  $clientID AND cleaning_logId = $checkinId";
														
								mysqli_query($this->db,$update_checkOutLogs);
								
								
								if(isset($_FILES['photo'])){ // Checking UserPhoto
								
									$fileArray = $this->reArrayFiles($_FILES['photo']);
									foreach($fileArray as $a){
										$errors= array();
										$file_name = $a['name'];
										$file_size = $a['size'];
										$file_tmp = $a['tmp_name'];
										$file_type = $a['type'];
										$file_ext=strtolower(end(explode('.',$a['name'])));
										
										//$expensions= array("jpeg","jpg","png");
									  
										/*if(in_array($file_ext,$expensions)=== false){
											$errors[]="extension not allowed, please choose a JPEG or PNG file.";
										}*/
									  
										/*if($file_size > 2097152) {
											$errors[]='File size must be excately 2 MB';
										}*/
									  
										if(empty($errors)==true) {
											//Inserting Checkout Logs.
											
											$insertNewLog = "INSERT INTO clientcheckoutlog(checkIdID, createdTime) VALUES($clientID, '$checkOutTime')";
											mysqli_query($this->db,$insertNewLog );
											
											$insertedID = mysqli_insert_id($this->db);
											
											$checkinId = $insertedID;
											
											$file_name = $insertedID.".".$file_ext;
											
											 move_uploaded_file($file_tmp,"../wp-content/uploads/wpfiles/CheckoutPhotos/".$file_name);
											 
											 $updateLog_Photos = "	Update clientcheckoutlog
																	SET fileName = '$file_name'
																	WHERE checkoutId = $insertedID 
																";
											mysqli_query($this->db,$updateLog_Photos);
											
											$checkoutUrl = "http://".$_SERVER['HTTP_HOST']."/wp-content/uploads/wpfiles/CheckoutPhotos/".$file_name;
											array_push($response['data']["checkoutFiles"],$checkoutUrl);
											
										}else{ 
											
									
										}	
									}//File Array Looping End
								}else{
									$insertNewLog = "INSERT INTO clientcheckoutlog(checkIdID, createdTime) VALUES($clientID, '$checkOutTime')";
									mysqli_query($this->db,$insertNewLog );
								}
								$response['message'] = 'Sucessfully LogOut';
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '1';
							}
							
							
						}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required fields clientID, name, photo';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
					
				}
			}
			
			private function getAppVersionInfo()
			{
			    	$query_result = mysqli_query($this->db,"select * from app_version_check");
			    	$row=mysqli_fetch_assoc($query_result);
			    	echo json_encode($row);
			}
			
			private function setItemAdd(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					//$data_body = $this->getDataFromUrl('http://www.infinityinfoway.com',80,array('demo'=>'data'));
					
					//$this->sendEmails(['User'=>'Nayan'],'Test Certificates',$data_body);
					
					//exit;
					
					//$this->response($this->json(['Welomce']),200);
					
					//Receive the RAW post data.
					$content = trim(file_get_contents("php://input"));

					//Attempt to decode the incoming RAW post data from JSON.
					$decoded = json_decode($content, true);

					//If json_decode failed, the JSON is invalid.
					if(!is_array($decoded)){
						$this->response($this->json(['Received content contained invalid JSON!']),400);
						//throw new Exception('Received content contained invalid JSON!');
					}
					
					$decoded['clientID'] = $this->checkClientID($decoded['clientID']);
					$clientID = (int)$decoded["clientID"];
					$checkinId = (int)$decoded["checkinId"];
					$current_date = $decoded['current_date'];
					$current_date = $current_date == ""?date('Y-m-d H:i:s'):$current_date;
					$response['data'] = $current_date;
					$response['message'] = '';
					$response['status'] = 0;
					$response['data'] = [];
					//Checking the User Logged in Or Not.
					$select_userLoggedIn = "SELECT * 
											FROM clientcleaninglog
											WHERE clientID = $clientID AND cleaning_logId = $checkinId
											";
					$mysqli_Query_results = mysqli_query($this->db, $select_userLoggedIn);
					 //--AND status = 1
					
					if(mysqli_num_rows($mysqli_Query_results) == 1 OR 0==0){ //User Checkin Found.
						
						if(array_key_exists("ItemPurchaseRequest",$decoded)){
							
							//$this->response($this->json($decoded['ItemPurchaseRequest']),200);
						//	$insertQuantityDelete = "DELETE  FROM quantityrequest WHERE CheckInID = $checkinId AND ClientID = $clientID ";
						//	$query_resuls = mysqli_query($this->db, $insertQuantityDelete);
							
							print_r($decoded['ItemPurchaseRequest']);
							
							foreach($decoded['ItemPurchaseRequest'] as $k=>$v){
								
								$insertQuantity = "INSERT INTO quantityrequest
													(CheckInID, ClientID, ProductName, ProductQuantity, CreatedDate)
													VALUES('$checkinId','$clientID','".$v['itemName']."','".$v['qty']."','$current_date')";
												//	echo $k." key and value".$v;
													
							    	$query_resuls = mysqli_query($this->db, $insertQuantity);
							}
							
								
							// Sending Emails to AM for Getting the Details Of Stocks.
							$seleect_AMEmail = "SELECT * 
							                    FROM `subcontractordetails`
                                                WHere ClientID = $clientID"; // AccountManagersEmail !=''  AND
                            $query_result = mysqli_query($this->db, $seleect_AMEmail);
							
							if(mysqli_num_rows($query_result)==1 OR 0==0){
							    $AM_Email = "";
							    while($row_results = mysqli_fetch_assoc($query_result)){
							        $AM_Email = $row_results['AccountManagersEmail'];    
							    }
								//$AM_Email = "rajshakya@vbeasy.com";
							    if($AM_Email != ""){
							        //$AM_Email = "gscript16@gmail.com";
							        
							        $msg_body = "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css' integrity='sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO' crossorigin='anonymous'>

                                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
                                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js' integrity='sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49' crossorigin='anonymous'></script>
                                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js' integrity='sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy' crossorigin='anonymous'></script>
                                    
                                    <!---------------------eamil--tamplate----start--here------->
                                     
                                                <div class='container-fluid'>
                                                    <div class='container'>
                                                        <div class='row' style='border:1px solid#000;' >
                                                            
                                                            <div class='col-md-6'>
                                                               <img style='float:left; '  src='http://scs.vbeasy.com/emailtemplate/download.jpg' class='img-responsive' width='100px;' height='100px'> 
                                                            </div>
                                                            <div class='col-md-6'>
                                                                <span style='color:#3d3d3d;float:right;font-size: 13px;font-style: italic;margin-top: 20px; padding:10px; font-size: 14px; font-weight:normal;'>
                                    							'Australia's Best Commercial Cleaning Service'<span></span></span>
                                                            </div>
                                                            <div class='container' style='margin-top:4%;'>
                                                                <hr>
                                                            <div class='col-md-12'>
                                                                <p>Hi {{ClientName}},</strong></p>
                                                        <p><br /> Please Find Details.</p>";
							        
							        
							        $msg_body .= "<br/><b>Site Details</b><br/>";
        							
        							$select_clientDetails  = "SELECT C.* , sd.SubContractorsContactName, sd.AccountManagerName  FROM Clients C
        							                          LEFT JOIN subcontractordetails sd ON sd.clientID = C.ClientID AND sd.clientID = $clientID
        							                          WHERE C.ClientID = $clientID";
        							$query_clientResult = mysqli_query($this->db, $select_clientDetails);
        							$clientName = "";
        							while($rows = mysqli_fetch_assoc($query_clientResult)){
        							    $clientName  = $rows['Name'];
        							    $msg_body .= "<table class='table talbe-bordered' border='1px'><tr><td width='20%'>Name </td><td width='80%'> ".$rows['Name']."</td></tr>";
        							    $msg_body .= "<tr><td width='20%'>Address</td><td width='80%'> ".$rows['StreetAddress']."</td></tr>";
        							    
        							    $msg_body .= "<tr><td width='20%'>SubContractor Name</td><td width='80%'>  ".$rows['SubContractorsContactName']."</td></tr>";
        							    $msg_body .= "<tr><td width='20%'>Account Manager Name</td><td width='80%'>  ".$rows['AccountManagerName']."</td></tr></table>";
        							    
        							}
        							
							        $msg_body .= "<br/><hr/><br/><table class='table table-bordered'><tr><th>#</th><th>Item Name </th><th>Qty.</th></tr>";
							        $c=0;
							        foreach($decoded['ItemPurchaseRequest'] as $k=>$v){ 
							                $c++;
							              $msg_body .= "<tr><td>".$c."</td><td>".$v['itemName']."</td><td align='right'>".$v['qty']."</td></tr>";
        							}
        							
        							$msg_body .= "</table>";
        							
							        $msg_body .= "</br><p>Thank You</p>";
							        $msg_body .= "<span>SCS Team</span>";
							        
							        $subject = " Replenishables Stock - Requirements for ".$clientName;
							        
							        $emailSend['Email'] = $AM_Email;
							        $emailSend['User'] = "VBE Support";
							        
							        $msg_body = str_replace("{{ClientName}}",$clientName,$msg_body);
							        
                                    $this->sendEmails($emailSend,$subject ,$msg_body);
							        
							        
							    }else{
							        $response['message'] = 'Sucessfully Request Submitted but Email not set in AM';
							    }
							    
							}else{
							    $response['message'] = $seleect_AMEmail;//;'Sucessfully Request Submitted but Email not sended to AM';   
							}
							
							$response['status'] = '1';
							$this->response($this->json($response),200);
							
						}else{
							$response['message'] = 'Your request is not valid with valid Parameterss';
							$this->response($this->json($response),200);
						}
						
						
					}else{
						$response['message'] = 'You Either not checkin or your already checkout. Please first checkin on requested site and send Item Add request.';
						$this->response($this->json($response),200);
					}
					//$data = $_POST;
					$response = $decoded;
					
					
					
				}
			}
			
			private function getAMMessage(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					
					//Receive the RAW post data.
					$content = trim(file_get_contents("php://input"));

					//Attempt to decode the incoming RAW post data from JSON.
					$decoded = json_decode($content, true);

					//If json_decode failed, the JSON is invalid.
					if(!is_array($decoded)){
						$this->response($this->json(['Received content contained invalid JSON!']),400);
						//throw new Exception('Received content contained invalid JSON!');
					}
					
					$decoded['clientID'] = $this->checkClientID($decoded['clientID']);
					$clientID = (int)$decoded["clientID"];
					$response['message'] = '';
					$response['status'] = 0;
					$response['data'] = [];
					//Checking the User Logged in Or Not.
					$select_userLoggedIn = "SELECT * FROM message_cleaner_am 
					                        WHERE  clientID = $clientID 
											LIMIT 1";
					$mysqli_Query_results = mysqli_query($this->db, $select_userLoggedIn);
					 //--AND status = 1
					
					if(mysqli_num_rows($mysqli_Query_results) > 0 ){//User Checkin Found.
						$data_pus = [];
						while($row = mysqli_fetch_assoc($mysqli_Query_results)){
						    $isMessageShowo = false;
						    if($row["notificationtocleaner"] == "Yes"){
						        $date = $row["DueDate"];
						        if($date!=""){
						            $dates = preg_split('/\//',$date);
                                    $month = $dates[1];
                                    $day = $dates[0];
                                    $year = $dates[2];
                            
                                    $finalDate = $year.'-'.$month.'-'.$day;
						            if(date('Y-m-d') <= $finalDate){
						                 $isMessageShowo =true;
						            }
						        }else{
						             $isMessageShowo = true;
						        }
						        
						        
						    }
						    $row["isMessageShow"] = (int)$isMessageShowo;
						    
						    
							array_push($data_pus,$row);
						}
						$response['status'] = 1;
						$response['data'] = $data_pus;
							$this->response($this->json($response),200);
						
					}else{
						$response['message'] = 'No Message found from AM  =>'.$clientID;
						$this->response($this->json($response),200);
					}
					//$data = $_POST;
					$response = $decoded;
				}
			}
			
		
			private function setContactusRequest(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					
					$data = $_POST;
					$response['message'] = $_FILES;
					$response['status'] = 0;
					$response['data'] = [];
					
					$data['clientID'] = $this->checkClientID($data['clientID']);
					$clientID = (int)$data["clientID"];
					if($clientID > 0){
						$filePath = "";
						$name = $data["name"];
					//	$email = $data["email"];
						$comment = $data["comment"];
						$checkinID = (int)$data["checkInID"];
						$current_date = $data['current_date'];
						$current_date = $current_date == ""?date('Y-m-d H:i:s'):$current_date;
						$response['data'] = $current_date;
						$insert_cotnactUs = "INSERT INTO contactus (clientID, checkinID, name, message, CreatedDate)
											VALUES ('$clientID', '$checkinID', '$name', '$comment', '$current_date')
											";
						$query_ins_contactus = mysqli_query($this->db, $insert_cotnactUs);
						$contactUsID = mysqli_insert_id($this->db);
						
						if(isset($_FILES['photo'])){
							$filePath = "../wp-content/uploads/wpfiles/ContactUS/";
							$errors= array();
							$file_name = $_FILES['photo']['name'];
							$file_size = $_FILES['photo']['size'];
							$file_tmp = $_FILES['photo']['tmp_name'];
							$file_type = $_FILES['photo']['type'];
							$file_ext=strtolower(end(explode('.',$_FILES['photo']['name'])));
						  
							//$expensions= array("jpeg","jpg","png");
						  
							/*if(in_array($file_ext,$expensions)=== false){
								$errors[]="extension not allowed, please choose a JPEG or PNG file.";
							}*/
						  
							/*if($file_size > 2097152) {
								$errors[]='File size must be excately 2 MB';
							}*/
						  
							if(empty($errors)==true) {
							//	$file_name = md5(md5(md5($contactUsID))).".".$file_ext;
								 move_uploaded_file($file_tmp,"$filePath".$file_name);
								 
								 $updateLog_Photos = "Update contactus
													SET fileName = '$file_name'
													WHERE contact_id = $contactUsID";
								mysqli_query($this->db,$updateLog_Photos );
								
								$filePath .= $file_name;
								 $response['message'] ="Sucessfully Data Submited and Email sent to AM";// $filePath;
							}else{
								 $response['message'] = 'Sucessfully Request Submitted but Email not sent in AM';
							}
						}
							
						//Sending  Email		
						// Sending Emails to AM for Getting the Details Of Stocks.
						$seleect_AMEmail = "SELECT * 
											FROM `subcontractordetails`
											WHere ClientID = $clientID"; // AccountManagersEmail !=''  AND
						$query_result = mysqli_query($this->db, $seleect_AMEmail);
						
						if(mysqli_num_rows($query_result)==1){
							$AM_Email = "";
							while($row_results = mysqli_fetch_assoc($query_result)){
								$AM_Email = $row_results['AccountManagersEmail'];    
							}
							$AM_Email = $AM_Email;
							//$AM_Email = "gscript16@gmail.com";
							if($AM_Email != ""){
								//$AM_Email = "gscript16@gmail.com";
								
								$msg_body = "Hi,<br/><br/>Below detials submitted by Cleaner for Maintance.<br/>";
								$msg_body .= "<br/><b>Name :</b> ".$data['name'];
								$msg_body .= "<br/><b>Email :</b> ".$data['email'];
								$msg_body .= "<br/><b>Comments :</b> ".$data['comment'];
								
								$select_clientDetails  = "SELECT * FROM Clients WHERE ClientID = $clientID";
								$query_clientResult = mysqli_query($this->db, $select_clientDetails);
								$clientName = "";
								$msg_body .= "<br/><br/><b><u>Client Site Details</u></b>";
								while($rows = mysqli_fetch_assoc($query_clientResult)){
									$clientName  = $rows['Name'];
									$msg_body .= "<b>Name :</b> ".$rows['Name'];
									$msg_body .= "<br/><b>Representive Name :</b> ".$rows['RepresentiveName'];
									$msg_body .= "<br/><b>Address :</b> ".$rows['StreetAddress'];
								}
								
								$msg_body .= "<br/><br/>Thank You";
								$msg_body .= "<br/>Web Team";
								
								$subject = "Contact Us Request for client ".$clientName." From ".$decoded['name'];
								
								$emailSend['Email'] = $AM_Email;
								$emailSend['User'] = $clientName =="" ? "VBEasy Team": $clientName;
								
								$this->sendEmails($emailSend,$subject ,$msg_body, $filePath);
								$response['message'] ="Sucessfully Data Submited and Email sent to AM";// $filePath;
								
							}else{
								$response['message'] = 'Sucessfully Request Submitted but Email not set in AM';
							}
						}
						$response['status'] = 1;
					}else{
						$response['message'] = 'Your client Account is not found in our Records';
					}
					
					
					$this->response($this->json($response),200);
				}
			}
			
			
			private function getGeoDistance(){
				 if($this->get_request_method() != "POST"){
					$error["response"] = "Your request methods is not valid";
					$error["responseCode"] = "404";
					
					$this->response($this->json($error),404);
				}else{
					
					//Receive the RAW post data.
					$content = trim(file_get_contents("php://input"));

					//Attempt to decode the incoming RAW post data from JSON.
					$decoded = json_decode($content, true);

					//If json_decode failed, the JSON is invalid.
					if(!is_array($decoded)){
						$this->response($this->json(['Received content contained invalid JSON!']),400);
						//throw new Exception('Received content contained invalid JSON!');
					}
					
					$clientID = (int)$decoded["clientID"];
					$lat1 = (int)$decoded["lat1"];
					$lon1 = (int)$decoded["lon1"];
					$lon2 = (int)$decoded["lon2"];
					$lat2 = (int)$decoded["lat2"];
					$unit = (int)$decoded["unit"];
					
					
					$results = $this->getDistancePoint($lat1, $lon1, $lat2, $lon2);
					
					$this->response($this->json(['data'=>$results]),200);
					
					$response['message'] = '';
					$response['status'] = 0;
					$response['data'] = [];
					//Checking the User Logged in Or Not.
					$select_userLoggedIn = "SELECT * 
											FROM message_cleaner_am
											WHERE clientID = $clientID ";
					$mysqli_Query_results = mysqli_query($this->db, $select_userLoggedIn);
					 //--AND status = 1
					
					if(mysqli_num_rows($mysqli_Query_results) > 0 ){//User Checkin Found.
						$data_pus = [];
						while($row = mysqli_fetch_assoc($mysqli_Query_results)){
							array_push($data_pus,$row);
						}
						$response['status'] = 1;
						$response['data'] = $data_pus;
						
					}else{
						$response['message'] = 'No Message found from AM';
						$this->response($this->json($response),200);
					}
					
					$response = $decoded;
				}
			}
			
			private function reArrayFiles(&$file_post) {
				$file_ary = array();
				$file_count = count($file_post['name']);
				$file_keys = array_keys($file_post);

				for ($i=0; $i<$file_count; $i++) {
					foreach ($file_keys as $key) {
						$file_ary[$i][$key] = $file_post[$key][$i];
					}
				}

				return $file_ary;
			}
			
			private function getDataFromUrl($url, $port='80', $postData=''){
				
				$postDat = http_build_query($postData, '', '&amp;');
				$curl = curl_init();
				curl_setopt_array($curl, array(
				  CURLOPT_PORT => $port,
				  CURLOPT_URL => $url,
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 40,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => $postDat,
				  CURLOPT_HTTPHEADER => array(
					"Cache-Control: no-cache",
					"Content-Type: application/x-www-form-urlencoded"
				  ),
				));

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err) {
				  return "cURL Error #:" . $err;
				} else {
				  return $response;
				}
			}
			
			private function sendEmails($address,$subject,$body,$attachmentFilePath=''){
				require_once "phpmailer/vendor/autoload.php";
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
				//$mail->Port = 26;  
				if($attachmentFilePath != '')				
					$mail->addAttachment($attachmentFilePath);
				
				$mail->From = "info@vbeasy.com";
				$mail->FromName = "VB Easy";
				//$mail->AddCC('scspl.nayan@gmail.com', 'Nayan Babariya');
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
					echo 'Mailer Error: ' . $mail->ErrorInfo;
					return true;
				} 
				else 
				{
					return false;
				}
			}
			
			private function distance($lat1, $lon1, $lat2, $lon2, $unit) {
                $theta = $lon1 - $lon2;
                $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                $dist = acos($dist);
                $dist = rad2deg($dist);
                $miles = $dist * 60 * 1.1515;
                $unit = strtoupper($unit);
            
                if ($unit == "K") {
                    return ($miles * 1.609344);
                } else if ($unit == "N") {
                    return ($miles * 0.8684);
                } else {
                    return $miles;
                }
            }
            
            private function circle_distance($lat1, $lon1, $lat2, $lon2) {
              $rad = M_PI / 180;
              return acos(sin($lat2*$rad) * sin($lat1*$rad) + cos($lat2*$rad) * cos($lat1*$rad) * cos($lon2*$rad - $lon1*$rad)) * 6371;// Kilometers
            }
            
            private  function getDistancePoint($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
                // Calculate the distance in degrees
                $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));
        
                // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
                switch($unit) {
                    case 'km':
                        $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                        break;
                    case 'mi':
                        $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)
                        break;
                    case 'nmi':
                        $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)
                }
                return round($distance, $decimals);
            }
			
			private function json($data){
				if(is_array($data)){
					return json_encode($data);
				}
			}
	}
	
	// Initiiate Library
	$api = new API;
	$api->processApi();
	unset($api)
?>
