<?php
	/* File : Rest.inc.php
	 * Author : VB Easy
	*/
	class REST {
		
		public $_allow = array();
		public $_content_type = "application/json";
		public $_request = array();
		
		private $_method = "";		
		private $_code = 200;
		
		public function __construct(){
			$this->inputs();
		}
		
		public function get_referer(){
			return $_SERVER['HTTP_REFERER'];
		}
		
		public function response($data,$status){
			$this->_code = ($status)?$status:200;
			$this->set_headers();
			echo $data;
			exit;
		}
		
		private function get_status_message(){
			$status = array(
						100 => 'Continue',  
						101 => 'Switching Protocols',  
						200 => 'OK',
						201 => 'Created',  
						202 => 'Accepted',  
						203 => 'Non-Authoritative Information',  
						204 => 'No Content',  
						205 => 'Reset Content',  
						206 => 'Partial Content',  
						300 => 'Multiple Choices',  
						301 => 'Moved Permanently',  
						302 => 'Found',  
						303 => 'See Other',  
						304 => 'Not Modified',  
						305 => 'Use Proxy',  
						306 => '(Unused)',  
						307 => 'Temporary Redirect',  
						400 => 'Bad Request',  
						401 => 'Unauthorized',  
						402 => 'Payment Required',  
						403 => 'Forbidden',  
						404 => 'Not Found',  
						405 => 'Method Not Allowed',  
						406 => 'Not Acceptable',  
						407 => 'Proxy Authentication Required',  
						408 => 'Request Timeout',  
						409 => 'Conflict',  
						410 => 'Gone',  
						411 => 'Length Required',  
						412 => 'Precondition Failed',  
						413 => 'Request Entity Too Large',  
						414 => 'Request-URI Too Long',  
						415 => 'Unsupported Media Type',  
						416 => 'Requested Range Not Satisfiable',  
						417 => 'Expectation Failed',  
						500 => 'Internal Server Error',  
						501 => 'Not Implemented',  
						502 => 'Bad Gateway',  
						503 => 'Service Unavailable',  
						504 => 'Gateway Timeout',  
						505 => 'HTTP Version Not Supported');
			return ($status[$this->_code])?$status[$this->_code]:$status[500];
		}
		
		public function get_request_method(){
			return $_SERVER['REQUEST_METHOD'];
		}
		
		private function json($data){
			if(is_array($data)){
				return json_encode($data);
			}
		}
		
		private function inputs(){
			switch($this->get_request_method()){
				case "POST":
					$this->_request = $this->cleanInputs($_POST);
					break;
				case "GET":
				case "DELETE":
					$this->_request = $this->cleanInputs($_GET);
					break;
				case "PUT":
					parse_str(file_get_contents("php://input"),$this->_request);
					$this->_request = $this->cleanInputs($this->_request);
					break;
				default:
					$this->response('',406);
					break;
			}
		}		
		
		private function cleanInputs($data){
			$clean_input = array();
			if(is_array($data)){
				foreach($data as $k => $v){
					$clean_input[$k] = $this->cleanInputs($v);
				}
			}else{
				if(get_magic_quotes_gpc()){
					$data = trim(stripslashes($data));
				}
				$data = strip_tags($data);
				$clean_input = trim($data);
			}
			return $clean_input;
		}		
		
		private function set_headers(){
			header("HTTP/1.1 ".$this->_code." ".$this->get_status_message());
			header("Content-Type:".$this->_content_type);
		}
		
		public function signupchecking(){
				$_data = $_GET;
				$FirstName =array_key_exists('FirstName', $_data)?$_data["FirstName"]:'';
				$LastName = array_key_exists('LastName', $_data)?$_data["LastName"]:'';
				$Email = array_key_exists('Email', $_data)?$_data["Email"]:'';
				$MobileNo = array_key_exists('MobileNo', $_data)?$_data["MobileNo"]:'';
				$Password = array_key_exists('Password', $_data)?$_data["Password"]:'';
				$error=array();
				if($FirstName=='')
					$error = $this->setError($error,'FirstName should not empty');
				if($LastName=='')
					
					$error = $this->setError($error,'LastName should not empty');
				if($Email=='')
					$error = $this->setError($error,'Email should not empty');
				if($MobileNo=='')
					$error = $this->setError($error,'MobileNo should not empty');
				if($Password=='')
					$error = $this->setError($error,'Password should not empty');
				
				if(count($error)>0){
					$error = array("code"=>401,"errors"=>$error);
					$this->response($this->json($error),200);
					exit();
				}
				else{
					// checking mobile no and Email in DB
					
					$sel = "SELECT MAP_UR_Email FROM map_userregistration WHERE MAP_UR_Email = '".$Email."'  OR MAP_UR_MobileNo = '".$MobileNo."'";
					$q  = mysql_query($sel);
					
					$rec = mysql_num_rows($q);
					if($rec > 0){
							
					$error = array("code"=>200,"errors"=>"Your email id or mobile number already registered with us.");
					$this->response($this->json($error),200);
					
						
					}else{
						
						
						$ins_rec = "INSERT INTO  map_userregistration
									(MAP_UR_Email, MAP_UR_FirstName, MAP_UR_LastName, MAP_UR_Password, MAP_UR_MobileNo)
									VALUES
									('".$Email."','".$FirstName."','".$LastName."','".md5($Password)."','".$MobileNo."')
									";
						$query = mysql_query($ins_rec);
						$id = mysql_insert_id();
						
					$error = array("code"=>200,"errors"=>"Your are successfully regisered with us. Your unique ID number is ".$id  );					
					$this->response($this->json($error),200);
					
						
					}
						
				
				}
				
				
				
		}
		
		
		public function addlocation(){
				$error["error"] = "you can not use get methods";
				$this->response($this->json($error),500);
		}
		
		
		public function setError($array,$msg){
			$array[]= $msg;
			return $array;
		}
		
		
	}	
?>