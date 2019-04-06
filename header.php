  <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- [ Header ] start -->
            <nav class="navbar header-navbar pcoded-header" style="background-color:#160e3f; height:90px;">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                        <i class="fas fa-bars f-20"></i>
                    </a>
                        <a href="index">
                        <img class="img-fluid" src="files/assets/image/logo/smarticon.png" alt="smartclean-Logo" width="40%" style="width:55%; height:80px" />
                    </a>
                        <a class="mobile-options waves-effect waves-light">
                        <i class="feather icon-more-horizontal"></i>
                    </a>
                    </div>
                    <div class="navbar-container container-fluid" >
                        <ul class="nav-left">
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                <i class="full-screen feather icon-maximize"></i>
                            </a>
                            </li>
                        </ul>
                        <ul class="nav-right" >
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                	<?php 
                            		$data=mysqli_query($conn,"select * from `Clients` where ClientID = '".$ClientData."' LIMIT 1");
                                	while($row=mysqli_fetch_assoc($data)){
                                	?>
                                    <div class="dropdown-toggle" data-toggle="dropdown">
                                        <?php
                                        if($row['profile_image'] != NULL){
                                        ?>
                                        <img class="user-img img-radius" src="wp-content/uploads/wpfiles/profile/<?php  echo $row['profile_image']; ?>" style="width:40px; height:40px;">                                                                    </a>
                                        <?php
                                        }
                                        else{
                                        ?>
                                        <img class="user-img img-radius" src="files/assets/image/user-male-icon.jpg">
                                        <?php    
                                        }
                                        ?>
                                        <span><?php echo $row['Name']; ?> (<?php echo $row['Code']; ?>)</span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" >
                                        <li>
                                            <a href="php/logout">
                                            <i class="feather icon-log-out"></i> Logout
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- [ Header ] end -->

            
            <div class="pcoded-main-container" >
                <div class="pcoded-wrapper">
                    <!-- [ navigation menu ] start -->
                    <nav class="pcoded-navbar">
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <?php
                                        if($row['profile_image'] != NULL){
                                        ?>
                                        <img class="user-img img-radius" src="wp-content/uploads/wpfiles/profile/<?php  echo $row['profile_image']; ?>" style="width:65px; height:65px; border: 1px solid #808080;">                                                                    </a>
                                        <?php
                                        }
                                        else{
                                        ?>
                                        <img class="user-img img-radius" src="files/assets/image/user-male-icon.jpg">
                                        <?php    
                                        }
                                    ?>
                                    <div class="user-details">
                                        <p id="more-details"><?php echo $row['Name']; ?> (<?php echo $row['Code']; ?>) <i class="feather icon-chevron-down m-l-10"></i></p>
                                    </div>
                                </div>
                                <?php
                            	}
                            	?>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="profile">
                                            <i class="feather icon-user"></i>View Profile
                                        </a>
                                            <a href="php/logout">
                                            <i class="feather icon-log-out"></i>Logout
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pcoded-navigation-label"></div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu active pcoded-trigger">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark"  style="background-color:">
                                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                    	<li class="">
                                            <a href="index" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Home</span>
                                            </a> 
                                        </li>
                                        <li class="">
                                            <a href="scope_of_work" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Scope of Work</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="alarm_escalation" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Alarm Escalation</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="consumable_order" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Consumable Order</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="proof_of_service" class="waves-effect waves-dark">
                                                <span class="pcoded-mtext">Proof of Service</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)"  class="waves-effect waves-dark " >
                                    <span class="pcoded-micon">
                                        <i class="feather icon-sidebar"></i>
                                    </span>
                                    <span class="pcoded-mtext">Visits</span>
                                    
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="checkin" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Check In</span>
                                        </a>
                                        </li>
                                        <li class=" ">
                                            <a href="checkout" class="waves-effect waves-dark">
                                            <span class="pcoded-mtext">Check Out</span>
                                        </a>
                                            
                                        </li>
                                    </ul>
                                </li>
                                <li class="pcoded-hasmenu">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                    <span class="pcoded-micon">
                                        <i class="feather icon-menu"></i>
                                    </span>
                                    <span class="pcoded-mtext">Raise Ticket</span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="generate_ticket" class="waves-effect waves-dark">
                                            <span id="generate" class="pcoded-mtext">Generate Ticket</span>
                                        </a>
                                        </li> 
                                        <li class="">
                                            <a href="view_tickets" class="waves-effect waves-dark">
                                            <span id="ticket" class="pcoded-mtext">View Tickets</span>
                                        </a>
                                        </li>
                                           
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <!-- [ navigation menu ] end -->
