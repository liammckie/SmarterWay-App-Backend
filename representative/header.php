<?php
include("api/api.php");
session_start();
if(empty($_SESSION['Id'])){
   echo "<script type='text/javascript'>window.location='index';</script>";
}
?>
    <!-- Favicon icon -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1" >
	    
            <span class="fa fa-bar"></span>
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="home"><span class="fa fa-area-chart"></span> SCS<span class="dashboard_text">Representative</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">Dashboard</li>
              <li class="treeview">
                <a href="home">
                <i class="fa fa-home"></i> <span>Home</span>
                </a>
              </li>
			  <li class="treeview">
                <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Proposal</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  <li><a href="proposal"><i class="fa fa-angle-right"></i> Generate Proposal</a></li>
                  <li><a href="view_proposal"><i class="fa fa-angle-right"></i> View Proposals</a></li>
                </ul>
              </li>
              
              <li class="treeview">
                <a href="clients">
                <i class="fa fa-handshake-o"></i> <span>Clients</span>
                </a>
              </li>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
			</div>
			<div class="header-right">
				
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/2.jpg" alt=""> </span> 
									<div class="user-name">
										<p><?php 
										    $obj=new API();
                                            $result=$obj->getRepresentative($_SESSION['Id']);     
                                            if(mysqli_num_rows($result)>0){
                                                $row=mysqli_fetch_assoc($result);
                                                echo $row['Name'];
                                            } 
                                            ?></p>
										<span>Representativ</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="profile"><i class="fa fa-suitcase"></i> Profile</a> </li> 
								<li> <a href="logout"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->

		