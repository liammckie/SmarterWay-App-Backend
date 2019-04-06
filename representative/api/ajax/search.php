<?php
    $key=$_GET['key'];
    $array = array();
    require '../config.php';
    $query=mysqli_query($conn, "select * from Clients where Name LIKE '%{$key}%'");
    /*while($row=mysqli_fetch_assoc($query))
    {
      $array[] = $row['Name'];
    }*/
    if($query){
        $records = [];
        while ($record = mysqli_fetch_assoc($query)) {
        $array[] = $record;
        }
    }
    echo json_encode($array);
    mysqli_close($conn);
?>