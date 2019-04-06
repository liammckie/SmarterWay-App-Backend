<!DOCTYPE HTML>
<html>
<head>
<title>SCS | Proposal :: Representative</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Favicon icon -->
<link rel="icon" href="images/favicon.ico" type="image/x-icon">

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- search css-->
<link rel="stylesheet" href="css/bootstrap-select.min.css" />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
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

</style>

<!-- Client Data By Id -->
<script>
function showUser(str) {
  if (str=="") {
    document.getElementById("txtHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("txtHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","api/getuser.php?q="+str,true);
  xmlhttp.send();
}
</script>

<!-- Categories Data By Main Category -->
<script>
function showCategories(str) {
  if (str=="") {
    document.getElementById("catHint").innerHTML="";
    return;
  } 
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("catHint").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("GET","api/getCategories.php?q="+str,true);
  xmlhttp.send();
}
</script>

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

<!-- search -->
<style>
    .selectpicker{
        border: 0px;
        outline: 0;
        background: transparent;
    }
</style>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<?php require_once('header.php'); ?>
	    <div id="page-wrapper">
			<div class="main-page">  
			    <!--h3 class="title1">Proposal</h3-->
			    <form id="regForm" class="form-horizontal" action="api/proposal.php" method="POST">    
			    
                  <!-- One "tab" for each step in the form: -->
					
                  <div class="tab">
                      <div>
                          <div class="row">
    						<div class="form-three widget-shadow">
                                <div class="form-group">
                					<label for="selector1" class="">SELECT A CLIENT</label>
                					<div class="">
                					    <select name="clients" id="" class="slectpicker" data-live-search="true" onchange="showUser(this.value)">
                					        <option disabled="" selected="">Choose</option>
                					        <option value="new">New</option>
                					        <?php 
                					        require 'api/config.php';
                					        $sql = "SELECT `ClientID`, `ClientName` FROM `gsheet_master_proposal` WHERE ClientID > 0 ORDER BY ClientID";
                                            $query = mysqli_query($conn, $sql);
                                                if($query){
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                            ?>
                					        <option value="<?php echo $row['ClientID']; ?>" ><?php echo $row['ClientID']." (".$row['ClientName'].")"; ?></option></hr>
                					        <?php } } ?>
                					    </select>
                					</div>
                				</div><hr/>
                				<div id="txtHint"></div>
                              </div>
						  </div>
					  </div>
                  </div>
                  
                  <div class="tab">
                      <div>
                          <div class="row">
    						<div class="form-three widget-shadow">
    						    <!--h4 class="title1">PROPOSAL CATEGOIES</h4><hr/-->
    						    
								<div class="form-group">
									<label for="selector1" class="col-sm-5 ">PROPOSAL CATEGORIES </label>
									                					<div class="">
                					    <select name="selector1 clients" id="selector1" class="form-control1" onchange="showCategories(this.value)">
                					        <option>Choose</option>
                					        <?php
                					        $sql = "SELECT DISTINCT(Category) FROM `gsheet_vb_templates`";
                                            $query = mysqli_query($conn, $sql);
                                                if($query){
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                            ?>
                					        <option value="<?php echo $row['Category']; ?>" ><?php echo $row['Category']; ?></option></hr>
                					        <?php } } ?>
                					    </select>
                					</div>
                				</div><hr/>
                				<div id="catHint"><b>Categories info will be listed here.</b></div>
							</div>
						  </div>
					  </div>
                  </div>
                  
                  <div class="tab">
                      <div>
                          <div class="row">
    						<div class="form-three widget-shadow">
    						    <h4 class="title1">CLIENT AGREEMENT ACCEPTANCE</h4><hr/>
    						    <?php 
    					        $sqlrep = "SELECT * FROM `representatives`";
                                $queryrep = mysqli_query($conn, $sqlrep);
                                $row = mysqli_fetch_assoc($queryrep)
                                ?>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-5 ">SALES REPRESENTATIVE</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="<?php echo $row['Name']; ?>">
									</div>
									<div class="col-sm-1">
										<p class="help-block"></p>
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-5 ">DATE AGREEMENT SIGNED</label>
									<div class="col-sm-7">
										<input type="date" class="form-control1" id="" value="DATE AGREEMENT SIGNED">
									</div>
								</div>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-5 ">BUSINESS TRADING NAME</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="BUSINESS TRADING NAME">
									</div>
								</div>
								<div class="form-group">
									<label for="txtarea1" class="col-sm-5 ">BUSINESS TRADING ADDRESS</label>
									<div class="col-sm-7">
									    <textarea name="txtarea1" id="txtarea1" cols="50" rows="4" class="form-control1">ENTER BUSINESS TRADING ADDRESS HERE...</textarea>
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">COMPANY NAME OF BUSINESS OWNERSHIP</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="COMPANY NAME OF BUSINESS OWNERSHIP">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">TRUST NAME OF OPERATING BUSINESS (if applicable)</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="TRUST NAME OF OPERATING BUSINESS">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">DIRECTORS NAME OF THE ENTITY</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="DIRECTORS NAME OF THE ENTITY">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">DIRECTORS NAME OF THE ENTITY</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="DIRECTORS NAME OF THE ENTITY">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">BUSINESS ACN</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="BUSINESS ACN">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">BUSINESS ABN</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="" value="BUSINESS ABN">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">EMAIL ADDRESS FOR BILLING PURPOSE</label>
									<div class="col-sm-7">
										<input type="email" class="form-control1" id="" value="EMAIL ADDRESS FOR BILLING PURPOSE">
									</div>
								</div>
								<div class="form-group">
									<label for="disabledinput" class="col-sm-5 ">PRIMARY SITE CONTACT NAME</label>
									<div class="col-sm-7">
										<input type="number" class="form-control1" id="" value="PRIMARY SITE CONTACT NAME">
									</div>
								</div>
								<div class="form-group">
									<label for="selector1" class="col-sm-5 ">SERVICE FREQUENCY </label>
									<div class="col-sm-7">
									    <select name="selector1" id="selector1" class="form-control1">
    										<option value="1 DAY">1 DAY</option>
    										<option value="2 DAYS">2 DAYS</option>
    										<option value="3 DAYS">3 DAYS</option>
    										<option value="4 DAYS">4 DAYS</option>
    										<option value="5 DAYS">5 DAYS</option>
    										<option value="6 DAYS">6 DAYS</option>
    										<option value="1 WEEK">1 WEEK</option>
									    </select>
									</div>
								</div>
    						</div>
    					</div>
                    </div>
                  </div>
                  
                  <div class="tab">
                      <div>
                          <div class="row">
    						<div class="form-three widget-shadow">
                            <h4 class="title1">SELECT REQUERED DOCUMENTS</h4><hr/>
								<div class="form-group">
									<div class="col-sm-6">
									    <input type="checkbox" value="page1">
										<span>Page 1</span>
									</div>
									<div class="col-sm-6">
										<p class="help-block"></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				  </div>
                  <div style="overflow:auto;">
                    <div style="float:right;">
                      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                    </div>
                  </div>
                  <!-- Circles which indicates the steps of the form: -->
                  <div style="text-align:center;margin-top:40px;">
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                    <span class="step"></span>
                  </div>
                </form>
			    
            </div>
        </div>
    <?php require_once('footer.php'); ?>
</div>

<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

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
    <!-- JQuery js -->
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- search js -->
    <script src="js/bootstrap-select.min.js"></script>
   
</body>
</html>
