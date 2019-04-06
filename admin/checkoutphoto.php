<?php
require_once '../php/connection.php';
require_once '../php/admin_session.php';
$data=mysqli_query($conn,"select * from `clientcheckoutlog` where checkoutId = '".$_GET['checkoutId']."' LIMIT 1");
while($row=mysqli_fetch_array($data)){
?>
<html>
    <head>
        <title>SCS | Admin :: Checkout Photo</title>
    </head>
    <body>
        <div style="text-align:center;">
            <a href='../../wp-content/uploads/wpfiles/CheckoutPhotos/<?php echo $row[2] ?>'  style='color:#4680ff;' download>
                <?php echo '<img src="../../wp-content/uploads/wpfiles/CheckoutPhotos/'.$row[2].'" alt="Image Not Found" width="500px"/>'; ?>
            </a>
        </div>
    </body>
</html>
<?php 
}
?>
