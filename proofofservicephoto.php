<?php
require_once 'php/session.php';
require 'php/connection.php';
$data=mysqli_query($conn,"select * from `proofofservicedetails` where pr_id = '".$_GET['pr_id']."' LIMIT 1");
while($row=mysqli_fetch_array($data)){
?>
<html>
    <body>
        <head>
            <title>SCS | Proof of Service Photo</title>
        </head>
        <div style="text-align:center;">
            <a href='../../wp-content/uploads/wpfiles/serviceProof/<?php echo $row[4] ?>'  style='color:#4680ff;' download>
                <?php echo '<img src="../../wp-content/uploads/wpfiles/serviceProof/'.$row[4].'" alt="Image Not Found" width="500px" download/>'; ?>
            </a>
        </div>
    </body>
</html>
<?php 
}
?>
