<?php
require_once 'php/connection.php';
require_once 'php/session.php';
$data=mysqli_query($conn,"select * from `clientcheckoutlog` where checkoutId = '".$_GET['checkoutId']."' LIMIT 1");
while($row=mysqli_fetch_array($data)){
?>
<html>
    <head>
        <title>SCS | Checkout Photo</title>
    </head>
    <body>
        <div style="text-align:center;">
            <?php echo '<img src="../../wp-content/uploads/wpfiles/CheckoutPhotos/'.$row[2].'" alt="Image Not Found" width="500px"/>'; ?>
        </div>
    </body>
</html>
<?php 
}
?>
