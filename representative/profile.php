<!DOCTYPE HTML>
<html>
<head>
<title>SCS | Representative</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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

/*profile card is class used in prfile page */

.profile-card
{
    height:100%;
    width:100%;
    background-color:#ffffff;
}
.col-40{
    width:40%;
}
.col-60{
    width:60%;
}
.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 120px;
  height:120px;
  background-color:white;
  border-radius:100%;
  margin-top:-130px;
  border:2px solid white;
}
.center:hover{
    
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
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<?php require_once('header.php'); ?>
	    <div id="page-wrapper">
			<div class="main-page">  
			    <!--h3 class="title1">Proposal</h3-->
                <div class="row">
                    <div class="col-md-12 chart-layer1-right"> 
					    <div class="user-marorm">
					        <?php
							    $obj=new API();
                                $result=$obj->getRepresentative($_SESSION['Id']); 
                                $row=mysqli_fetch_assoc($result);
                                
                            ?>
					        <div class="malorum-top">			
					        </div>
					        <div class="malorm-bottom">
    							<span> 
    							    <img data-toggle="modal" data-target="#myModal" class="center" src="../files/assets/image/user-male-icon.jpg"> 
                                </span>
    							<h2><?php echo $row['Name']; ?></h2>
    							<p></p>
    						</div>
				        </div>
				    </div>
	                <div class="clearfix"></div>
	           </div>
	           <div class="row">
	                <div class="col-md-12">
                        <div class="main-content">
                            <div class="profile-card">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3></h3><hr/>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="col-sm-12">
                                            <span>Name</span>
                                            <span style="margin:5%;">:</span>
                                            <span><?php echo $row['Name']; ?></span>
                                        <hr/>
                                        </div>
                                        <div class="col-sm-12">
                                            <span>Email</span>
                                            <span style="margin:5%;">:</span>
                                            <span><?php echo $row['Email']; ?></span>
                                        <hr/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-sm-12">
                                            <span>Phone</span>
                                            <span style="margin:5%;">:</span>
                                            <span><?php echo $row['Phone']; ?></span>
                                        <hr/>
                                        </div>
                                        <div class="col-sm-12">
                                            <span>Mobile</span>
                                            <span style="margin:5%;">:</span>
                                            <span><?php echo $row['Mobile']; ?></span> 
                                        <hr/>
                                        </div>
                                    </div>
                                    <hr/>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
				
            </div>
        </div>
    </div>
       
       
    <?php require_once('footer.php'); ?>
   
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <!-- Modal body -->
            <div class="compose-right widget-shadow">
        		<div class="panel-default">
        		    <button type="button" class="close" data-dismiss="modal" style="padding:10px;">&times;</button>
        			<div class="panel-heading">
        				Compose New Message 	
        			</div>
        		    <div class="panel-body">
                        <form class="com-mail" action="#" method="post" enctype="multipart/form-data">
            				<div class="form-group">
            					<div class="btn btn-default btn-file">
            						<i class="fa fa-paperclip"></i> IMAGE
            						<input type="file" name="img">
            					</div>
            					<p class="help-block">Max. 50MB</p>
            				</div>
            				<input type="submit" value="Update" class="btn btn-info"> 
            			</form>
            		</div>
        		</div>
            </div>
        </div>
    </div>
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
   
 <?php require_once('footer.php'); ?>

   
</body>
</html>
