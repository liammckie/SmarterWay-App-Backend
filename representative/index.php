<?php
include("api/api.php");
session_start();
if(isset($_SESSION['Id'])){
    echo "<script type='text/javascript'>window.location='home';</script>";
}else{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>SCS | Login :: Representatives</title>
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

<!-- font-awesome icons CSS-->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts-->
 
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

</head> 
<body >
<div class="main-content">
	<!-- main content start-->
	<div id="page-wrapper">
		<div class="main-page login-page ">
			<h2 class="title1">Representative Login</h2>
			<div class="widget-shadow">
				<div class="login-body">
					<form action="" method="post">
						<input type="text" class="user" name="userid" placeholder="Enter Your Username" value="<?php if(isset($_COOKIE['userid'])){echo $_COOKIE['userid']; } ?>" required="">
						<input type="password" name="password" class="lock" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password']; } ?>" required="">
						<div class="checkbox"><label for="remember">Remember me &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label><input type="checkbox" name="remember" id="remember"></div>
						<input type="submit" name="Sign In" value="Sign In">
					</form>
				</div>
			</div>
		</div>
	</div>
	<!--footer-->
	<?php require_once 'footer.php'; ?>
    <!--//footer-->
</div>
	
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
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
</body>
</html>
<?php
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST'){
    $userid=$_POST['userid'];
    $password=$_POST['password'];
    
    if(isset($_POST['remember'])){
        setcookie("userid", $userid, time() + 3600*24);
        setcookie("password", $password, time() + 3600*24);
    }
    $obj=new API();
    $result=$obj->getLogin($userid,$password);     
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $_SESSION['Id']=$row['id'];
        $_SESSION['Name']=$row['Name'];
       
        if(isset($_SESSION['Id'])){    
            echo"<script>window.location='home';</script>";
        }
    }
    else{
        echo "<script type='text/javascript'>alert('Please Enter Valid Credential');</script>";    
    }
   
}
}
?>