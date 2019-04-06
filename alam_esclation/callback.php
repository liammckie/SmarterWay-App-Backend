<?php 
include "db_config.php";
function stripslashes_deep($value) {
  $value = is_array($value) ?
    array_map('stripslashes_deep', $value) :
    stripslashes($value);
  return $value;
}

// First, grab the form data.  Some things to note:                               
// 1.  PHP replaces the '.' in 'data.json' with an underscore.                    
// 2.  Your fields names will appear in the JSON data in all lower-case,          
//     with underscores for spaces.                                               
// 3.  We need to handle the case where PHP's 'magic_quotes_gpc' option           
//     is enabled and automatically escapes quotation marks.                      

$unescaped_post_data = $_POST;

$attributes = $unescaped_post_data;


if(is_array($attributes)){
    $CallSid = $attributes["CallSid"];
    $CallStatus = $attributes["CallStatus"];
   
    
    	$_update_rows = "Update alaram_esc_log 
    	                SET callstatus = '$CallStatus' 
    	                WHERE ResponseID = '$CallSid'";
	    mysqli_query($conn, $_update_rows);
	    
	    if($CallStatus == "completed"){ //Flow execution stop.....
	    
	        $select_Id = "SELECT * FROM alaram_esc_log  WHERE ResponseID = '$CallSid'";
	        $sel_result_query = mysqli_query($conn, $select_Id);
	        $ASDWID = 0;
	        while($result_data = mysqli_fetch_assoc($sel_result_query)){
	            $ASDWID = $result_data["ASDWID"];
	        }
	        
	    
	        $update_rows_data = "Update alaram_esc_log
                        	     SET status= 3
                        	     WHERE ASDWID = '$ASDWID' AND status = 0   ";
                        	        
            mysqli_query($conn,  $update_rows_data);
            
            $update_rows_master_data = "Update AlarmScheduleDayWise
                                	     SET IsAlaramCompleted = 2
                                	      WHERE ASDWID = '$ASDWID'";
                        	        
            mysqli_query($conn,  $update_rows_master_data);
	    }
	    
}



$dataAttributes = array_map(function($value, $key) {
    return $key.'="'.$value.'"';
}, array_values($attributes), array_keys($attributes));

$dataAttributes = implode(' ', $dataAttributes);


file_put_contents(time().'.txt', $dataAttributes);