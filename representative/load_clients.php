<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 	<script type="text/javascript">
	$(document).ready(function(){
		var clientCount = 10;
		$("#show").click(function(){
			clientCount = clientCount + 10;
			$("#comment").append("load_clients.php",{
				clientNewCount:clientCount
			});
		});
	});
    </script>
</head>
<body>
    <div class="card">
        <div class="card-block">
            <div class="dt-responsive table-responsive">
                <table id="footer-select" class="table table-striped table-bordered nowrap">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Client ID</th>
                            <th>Name</th>
                            <th>Account</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <div id="comment">
                            <?php 
                            $clientNewCount = $_POST['clientNewCount'];
                            require_once 'api/config.php';
                            $data=mysqli_query($conn,"SELECT * FROM `gsheet_master_proposal` LIMIT $clientNewCount");
                            $counter = 0;
                            while($row=mysqli_fetch_array($data))
                            {
                            ?>                                                                                        
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td><?php echo "<a href='client?Id=".$row['ClientID']."' style='color:#4680ff;'>".$row['ClientID']."</a>"; ?></td>
                                <td><?php echo $row['1']; ?></td>
                                <td><?php echo $row['3'];  ?></td>
                                <td><?php echo $row['4']." ".$row['5']." ".$row['7']." ".$row['8']; ?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>