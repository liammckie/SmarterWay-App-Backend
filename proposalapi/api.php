<?php
	/* File : Rest.inc.php
	 * Author :  VB Easy
	*/
	
    require_once("Rest.inc.php");
	class API extends REST {
		
		public $data = "";
		const DB_SERVER = "smart-mobile-production.cfkyixhewlor.ap-southeast-2.rds.amazonaws.com";
        const DB_USER = "smart_mobile";
        const DB_PASSWORD = "&e3|MnuQYXQM";
        const DB = "smart_mobile_production";
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
		}

		public function testapi()
		{
			echo 'ready for use';
			mysqli_connect_error($this->db);
		}
		
		/*
		 * Public method for access api.
		 * This method dynmically call the method based on the query string
		 *
		 */
		public function processApi(){
			$func = strtolower(trim(str_replace("/","",$_REQUEST['rquest'])));
			if((int)method_exists($this,$func) > 0)
				$this->$func();
			else
				$this->response('',404);// If the method not exist with in this class, response would be "Page not found".
		}
		
	
		 	/* All Required Methods */
		 	
		 	
		 	private function searchClientData(){// [Method use for search ClientData]
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
					if(isset($data['search']) && ($data['representative_name'])){
						$search = $data['search'];
						$representative_name = $data['representative_name'];
						//if($search > 0){
							
							$sel_client = "SELECT * From gsheet_master_proposal WHERE (ClientName LIKE '$search%' OR ClientID LIKE '$search%') AND Representative = '$representative_name'";
							$query_sel_client = mysqli_query($this->db,$sel_client);
							
							if(mysqli_num_rows($query_sel_client) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_client)){
									array_push($response['data'],$row_data);
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						/*}else{
							$response['message'] = 'Your ClientID is not found. Please enter valid ClientID';
							$response['status'] = '0';
						}*/
					}else{
						$response['message'] = 'Please submit required fields representative_name, search';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}

		 	private function login(){// [Verify Repreentative Login]
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
					if(isset($data['user_id']) && ($data['password'])){
						//if((int)$data['clientID'] > 0){
							
							$user_id = $data['user_id'];// Get Client Details
							$password = $data['password'];
							$check_login = "SELECT * From representatives WHERE UserID='$user_id' and Password='$password'";
							$query_login = mysqli_query($this->db,$check_login);
							
							if(mysqli_num_rows($query_login) == 1){
								while($row_data = mysqli_fetch_assoc($query_login)){
									$response['data'] = $row_data;
								}
								$response['message'] = 'Successfully Login';
								$response['status'] = "1";
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						/*}else{
							$response['message'] = 'Your clientID is not found. Please enter valid clientID';
							$response['status'] = '0';
						}*/
					}else{
						$response['message'] = 'Please submit required fields clientID, name, photo';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}


		 	private function getClientList(){// [Method use for get Clients Details]
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
			        
			        if(isset($data['representative_name'])){
			            if(!empty($data['representative_name'])){
			                
			                $representative_name = $data['representative_name'];// Get Client Details
			                $sel_client_details = "SELECT * From gsheet_master_proposal WHERE Representative = '$representative_name'";
			                $query_client_details = mysqli_query($this->db,$sel_client_details);
			                if(mysqli_num_rows($query_client_details) > 0){
			                    while($row_data = mysqli_fetch_assoc($query_client_details)){
			                    	//$rows[] = $row_data;
			                    	//$response['data'] = $rows;
			                        array_push(	$response['data'],$row_data);
			                        
			                    }
			                    $response['status'] = "1";
			                    
			                }else{
			                    $response['message'] = 'No Data Found of This Representative';
			                    $response['status'] = '0';
			                }
			            }else{
			                $response['message'] = 'This Representative Clients not found. Please enter valid Representative Name';
			                $response['status'] = '0';
			            }
			        }else{
			            $response['message'] = 'Please submit required fields representative_name;';
			            $response['status'] = '0';
			        }
			        $this->response($this->json($response),200);
			    }
			}

			private function getClientData(){// [Method use for get ClientData]
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
					if(isset($data['ClientID'])){
						$ClientID = $data['ClientID'];
						if($ClientID > 0){
							
							$sel_client = "SELECT * From gsheet_master_proposal WHERE ClientID = '$ClientID' LIMIT 1";
							$query_sel_client = mysqli_query($this->db,$sel_client);
							
							if(mysqli_num_rows($query_sel_client) == 1){
								while($row_data = mysqli_fetch_assoc($query_sel_client)){
									array_push($response['data'],$row_data);
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						}else{
							$response['message'] = 'Your ClientID is not found. Please enter valid ClientID';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required field ClientID';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
		 
		    private function getMainCategories(){// [Method use for get Categories]
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
					if(isset($data['main_category'])){
						$categories = $data['main_category'];
						if($categories == 'main_category'){
							
							$sel_main_categories = "SELECT DISTINCT(Category) FROM `gsheet_vb_templates`";
							$query_sel_main_categories = mysqli_query($this->db,$sel_main_categories);
							
							if(mysqli_num_rows($query_sel_main_categories) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_main_categories)){
									array_push($response['data'],$row_data);
								}
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						}else{
							$response['message'] = 'Your categories is not found. Please enter valid category data';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required field main_category';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
			
			private function getMoreCategories(){// [Method use for get All Categories]
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
					if(isset($data['main_category'])){
						$main_categories = $data['main_category'];
						//if($categories == 'maincategories'){
							
							$sel_categories = "SELECT DISTINCT(`Sub Category`) FROM `gsheet_vb_templates` where Category='$main_categories'";
							$query_sel_categories = mysqli_query($this->db,$sel_categories);
							if(mysqli_num_rows($query_sel_categories) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_categories)){
									//array_push($category['data'],$row_data);
									$rows_data[] = $row_data;
									foreach ($rows_data as $row_data) {
										$categories = $row_data['Sub Category'];
									}
									//array_push($response['data'],$categories);
									$sel_sub_categories = "SELECT `Super Sub Category` FROM `gsheet_vb_templates` where `Category`='$main_categories' AND `Sub Category`='$categories'";
									$query_sel_sub_categories = mysqli_query($this->db,$sel_sub_categories);
									if(mysqli_num_rows($query_sel_sub_categories) > 0){
									    $response['data'][$categories] = [];
										while($rows = mysqli_fetch_assoc($query_sel_sub_categories)){
											array_push($response['data'][$categories],$rows);
										}
										//$response['status'] = "1";
									}
								}
								$response['message'] = 'Successfully Data Fetched';
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						/*}else{
							$response['message'] = 'Your categories is not found. Please enter valid category';
							$response['status'] = '0';
						}*/
					}else{
						$response['message'] = 'Please submit required field main_category';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
			
			
			private function getMore(){// [Method use for get All Categories]
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
					if(isset($data['main_category'])){
						$main_categories = $data['main_category'];
						//if($categories == 'maincategories'){
							
							$sel_categories = "SELECT DISTINCT(`Sub Category`), `Super Sub Category` FROM `gsheet_vb_templates` where Category='$main_categories'";
							$query_sel_categories = mysqli_query($this->db,$sel_categories);
							if(mysqli_num_rows($query_sel_categories) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_categories)){
									//array_push($response['data'],$row_data);
									$rows_data[] = $row_data;
									$response['data']['Sub Categories'] = [];
									foreach ($rows_data as $row_data) {
										$categories = $row_data['Sub Category'];
										array_push($response['data']['Sub Categories'],$row_data);
									}
									//array_push($response['data']['Sub Categories'],$row_data);
									//$response['data'] = $categories;
									$sel_sub_categories = "SELECT `Super Sub Category` FROM `gsheet_vb_templates` where `Category`='$main_categories' AND `Sub Category`='$categories'";
									$query_sel_sub_categories = mysqli_query($this->db,$sel_sub_categories);
									if(mysqli_num_rows($query_sel_sub_categories) > 0){
									   // $response['data']['categories'] = $categories;
									    //$response['data']['Sub Categories'[$categories]] = [];
										while($rows = mysqli_fetch_assoc($query_sel_sub_categories)){
											//array_push($response['data']['Sub Categories'[$categories]],$rows);
										}
										//$response['status'] = "1";
										
									}
								}
								$response['message'] = 'Successfully Data Fetched';
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						/*}else{
							$response['message'] = 'Your categories is not found. Please enter valid category';
							$response['status'] = '0';
						}*/
					}else{
						$response['message'] = 'Please submit required field main_category';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
			

			private function getCategories(){// [Method use for get Categories]
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
					if(isset($data['main_category'])){
						$categories = $data['main_category'];
						//if($categories == 'maincategories'){
							
							$sel_categories = "SELECT DISTINCT(`Sub Category`) FROM `gsheet_vb_templates` where Category='$categories'";
							$query_sel_categories = mysqli_query($this->db,$sel_categories);
							
							if(mysqli_num_rows($query_sel_categories) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_categories)){
									array_push($response['data'],$row_data);
								}
								$response['message'] = 'Successfully Data Fetched';
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						/*}else{
							$response['message'] = 'Your categories is not found. Please enter valid category';
							$response['status'] = '0';
						}*/
					}else{
						$response['message'] = 'Please submit required field main_category';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}


			private function getSubCategories(){// [Method use for get Sub Categories]
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
					if(isset($data['category_name']) && $data['main_category']){
						$main_categories = $data['main_category'];
						$categories = $data['category_name'];
						//if($categories == 'maincategories'){
							
							$sel_categories = "SELECT * FROM `gsheet_vb_templates` where `Category`='$main_categories' AND `Sub Category`='$categories'";
							$query_sel_categories = mysqli_query($this->db,$sel_categories);
							
							if(mysqli_num_rows($query_sel_categories) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_categories)){
									array_push($response['data'],$row_data);
								}
								$response['message'] = 'Successfully Data Fetched';
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						/*}else{
							$response['message'] = 'Your categories is not found. Please enter valid category';
							$response['status'] = '0';
						}*/
					}else{
						$response['message'] = 'Please submit required field main_category , category_name';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
			}
			
			private function getProposal(){// [Method use for get Proposal]
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
					if(isset($data['representative_name'])){
						$representative_name = $data['representative_name'];
						if(!empty($representative_name)){
							$sel_categories = "SELECT DISTINCT p.id, p.main_categories, p.date, p.Representative, p.ClientID, c.ClientName, p.file FROM `proposal` p LEFT JOIN `gsheet_master_proposal` c on p.ClientID = c.ClientID WHERE p.Representative = '$representative_name' ORDER BY p.id";
							$query_sel_categories = mysqli_query($this->db,$sel_categories);
							
							if(mysqli_num_rows($query_sel_categories) > 0){
								while($row_data = mysqli_fetch_assoc($query_sel_categories)){
								    $file_name =  $row_data['file'];
								    $row_data['file'] = $_SERVER['HTTP_HOST']."/wp-content/uploads/wpfiles/proposal/".$file_name;
									array_push($response['data'],$row_data);
								}
								$response['message'] = 'Successfully Data Fetched';
								$response['status'] = "1";
								
							}else{
								$response['message'] = 'No Data Found';
								$response['status'] = '0';
							}
						}else{
							$response['message'] = 'Your Proposal is not found. Please enter valid representative_name';
							$response['status'] = '0';
						}
					}else{
						$response['message'] = 'Please submit required field representative_name';
						$response['status'] = '0';
					}
					$this->response($this->json($response),200);
				}
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
?>