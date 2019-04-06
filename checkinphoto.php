<?php
require_once 'php/connection.php';
require_once 'php/session.php';
$data=mysqli_query($conn,"select * from `clientcleaninglog` where cleaning_logId = '".$_GET['cleaning_logId']."' LIMIT 1");
while($row=mysqli_fetch_array($data)){
?>
<html>
    <head>
        <title>SCS | Checkin Photo</title>
    </head>
    <body>
        <div style="text-align:center;">
            <?php echo '<img src="../../wp-content/uploads/wpfiles/CheckinPhotos/'.$row[3].'" alt="Image Not Found" width="500px"/>'; ?>
        </div>
    </body>
</html>
<?php 
}
?>
