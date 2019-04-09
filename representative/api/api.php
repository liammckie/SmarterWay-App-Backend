<?php 
define("SERVER","162.241.218.43");
define("USERNAME","vbeasyco_scs");
define("PASSWORD","vbeasyco_scs");
define("DATABASE","vbeasyco_scs_proposal");

Class API{
    function getconnection(){
        $conn=mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);
        return $conn;
    }
    
    function getLogin($userid,$password){
        $conn= $this->getconnection();
        $sql="select * from representatives where UserID='$userid' AND Password ='$password'";
        $result=$conn->query($sql);
        return $result;
    }
    
    function getRepresentative($id){     
        $conn=$this->getconnection();
        $sql="select * from representatives where id=$id";
        $result=$conn->query($sql);
        return $result;
    }
    
    function getProposal($representative_name){     
        $conn=$this->getconnection();
        $sql="select * from proposal where Representative='$representative_name'";
        $result=$conn->query($sql);
        return $result;
    }
    
    function getClients($representative_name){     
        $conn=$this->getconnection();
        $sql="select * from gsheet_master_proposal where Representative='$representative_name'";
        $result=$conn->query($sql);
        return $result;
    }
    
}
?>