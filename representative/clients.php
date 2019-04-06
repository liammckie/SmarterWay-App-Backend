<!DOCTYPE HTML>
<html>
<head>
<title>SCS | Representative</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Favicon icon -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->
 
 <!-- js-->
 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
<!--//webfonts--> 

<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}
</style>


	<!-- requried-jsfiles-for owl -->
	<link href="css/owl.carousel.css" rel="stylesheet">
	<script src="js/owl.carousel.js"></script>
		<script>
			$(document).ready(function() {
				$("#owl-demo").owlCarousel({
					items : 3,
					lazyLoad : true,
					autoPlay : true,
					pagination : true,
					nav:true,
				});
			});
		</script>
	<!-- //requried-jsfiles-for owl -->
	<!-- Required js for view more  -->
	
	<script type="text/javascript">
		$(document).ready(function(){
										var clientCount = 10;
										//going to load_clients.php to get more clients infomation
										$("#show").click(function(){
										    $('#comment2').hide();
    										clientCount = clientCount + 10;
    										$("#comment").load("load_clients.php",{
    											clientNewCount:clientCount
    										});
																		
										});
		});
	</script>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<?php require_once('header.php'); ?>
	    <div id="page-wrapper">
			<div class="main-page">  
			    <!--h3 class="title1">Proposal</h3-->
                <!-- [ page content ] start -->
                <div class="row">
                	<div class="col-md-12">
                        <!-- Individual Column Searching (Select Inputs) start -->
                        <div class="card">
                            <div class="card-header">
                                <h4>All Clients of Smart Cleaning</h4><hr/>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive table-responsive">
                                    
                                    <div id="comment2">
                                    <table id="footer-select" class="table table-striped table-bordered nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Client ID</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
										    $obj=new API();
                                            $result=$obj->getClients($_SESSION['Name']);     
                                            if(mysqli_num_rows($result)>0){
                                                while($row=mysqli_fetch_assoc($result)){
                                            ?>                                         
                                                <tr>
                                                    <td><?php echo ++$counter; ?></td>
                                                    <td><?php echo "<a href='client?Id=".$row['ClientID']."' style='color:#4680ff;'>".$row['ClientID']."</a>"; ?></td>
                                                    <td><?php echo $row['ClientName']; ?></td>
                                                    <td><?php echo $row['State Full'] ;?></td>
                                                    <td><?php echo $row['Current Status'] ;?></td>
                                                </tr>
                                            <?php
                                                }
                                            }
                                            else{
                                            echo "<td colspan='5'>NNo Data Available in Database</td>";
                                            }
                                            ?>
                                            
                                        </tbody>
                                    
                                    </table>
                                    
                                    </div>
                                    <!--div href="#" id="comment">
                                        
                                    </div>
                                    <div style="text-align:right;">
                                        <a href="#" id="show" class="btn btn-primary">Show more</a>
                                    </div-->
                                </div>
                            </div>
                        </div>
                        <!-- Individual Column Searching (Select Inputs) end -->
                        
                    </div>
                </div>
            </div>
        </div>
    <?php require_once('footer.php'); ?>
</div>

<script>
function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
</script>
		
		
		<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
  
   
</body>
</html>
