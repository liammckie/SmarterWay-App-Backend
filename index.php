<?php
require 'php/connection.php'; 
require_once 'php/session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SCS | Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <!-- Favicon icon -->
      <link rel="icon" href="files/assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <!-- waves.css -->
      <link rel="stylesheet" href="files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- feather icon -->
      <link rel="stylesheet" type="text/css" href="files/assets/icon/feather/css/feather.css">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="files/bower_components/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="files/assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="files/assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="files/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Data Table Css -->
      <link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="files/assets/pages/data-table/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="files/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="files/assets/css/pages.css">
      <link rel="stylesheet" type="text/css" href="files/assets/css/widget.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
    <style>
        .main-menu-header{
            margin-top:40px;
        }
        .drop:hover>.drop-menu {
          display: block;
          color:skyblue;
          padding-left:10px;
          margin-top:-10px;
          margin-left:100px;
        }
        .drop>.drop-toggle{
            color:white;
            font-size:15px;
            margin-left:100px;
        }
        .drop-list{
            color:black;
        }
        .drop-list:hover {
          color:skyblue;
        }
        .drop>.drop-toggle:active {
            pointer-events: none;
        }
    </style>
  </head>
  <body>
            <?php require('header.php'); ?>
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                      <div class="page-header" style="background-color:#160e3f;" >
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8 ">
                                      <div class="page-header-title">
                                          <h4 class="m-b-10">Smart Cleaning Solutions</h4>
                                      </div>
                                      <ul class="breadcrumb">
                                          <li class="breadcrumb-item">
                                              <a href="index">
                                                  <i class="feather icon-home"></i>
                                              </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#">Home</a> 
                                          </li>
                                          <li class="dropdown drop"> 
                                            <p class="dropdown-toggle drop-toggle" data-toggle="dropdown"><i class="fas fa-ticket-alt"></i>  Raise Ticket
                                            <span class="caret"></span></p>
                                            <ul class="dropdown-menu drop-menu">
                                              <li><a href="generate_ticket"><span class="drop-list">Generate Ticket</span></a></li>
                                              <li><a href="view_tickets"><span class="drop-list">View Tickets</span></a></li>
                                            </ul>
                                          </li>
                                          
                                      </ul> 
                                  </div>
                                  
                              </div>
                          </div>
                      </div>
                      <!-- [ breadcrumb ] end -->
                      <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <div class="row">

                                            <!-- site Analytics card start -->
                                            <div class="col-lg-5 col-md-12 ">
                                                <div class="card">
                                                    <div class="card-header borderless">
                                                        <h5>Site Ticket Analytics</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <!--div id="seo-ecommerce-barchart" style="height: 375px"></div-->
                                                        <?php
                                                            $query = "SELECT Status, count(*) as number FROM tickets where ClientID = '".$ClientData."' GROUP BY Status";  
                                                            $result = mysqli_query($conn, $query); 
                                                        ?>
                                                        <div class="col-md-12">  
                                                            <h6 align="center" style="width:100%; height: 100%;">Percentage of Open, Assigned, Closed and Rejected Tickets</h6>  
                                                              
                                                            <div id="piechart" style="height: 250px;"></div>  
                                                       </div>  
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 col-md-12" Style="margin-top:20px;">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a href="checkin">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-green">
                                                                            <?php
                                                                                $date = date("Y-m-d");
                                                                                $query = mysqli_query($conn, "SELECT * FROM `clientcleaninglog` WHERE (clientID ='".$ClientData."') AND (checkInDate like '%$date%')");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Check In</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-sign-in-alt f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-c-green">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Today</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="feather icon-trending-up text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="checkout">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-red">
                                                                            <?php
                                                                                $date = date("Y-m-d");
                                                                                $query = mysqli_query($conn, "SELECT * FROM clientcheckoutlog WHERE (checkIdID ='".$ClientData."') AND (createdTime like '%$date%')");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Check Out</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-sign-out-alt f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-c-red">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Today</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="feather icon-trending-down text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="consumable_order">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-green">
                                                                            <?php
                                                                                $date = date("Y-m-d");
                                                                                $query = mysqli_query($conn, "SELECT * FROM quantityrequest where (ClientID ='".$ClientData."') AND CreatedDate like '%$date%'");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Order</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-cart-arrow-down f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-c-green">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Today</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="feather icon-trending-up text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <a href="checkin">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-yellow">
                                                                            <?php
                                                                                $query = mysqli_query($conn, "SELECT * FROM `clientcleaninglog` WHERE (clientID ='".$ClientData."')");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Check In</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-sign-in-alt f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-c-yellow">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Total</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="feather icon-trending-up text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="checkout">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-blue">
                                                                            <?php
                                                                                $query = mysqli_query($conn, "SELECT * FROM clientcheckoutlog WHERE (checkIdID ='".$ClientData."')");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Check Out</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-sign-out-alt f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-c-blue">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Total</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="feather icon-trending-down text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="view_tickets">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 class="text-c-red">
                                                                            <?php
                                                                                $date = date("Y-m-d");
                                                                                $query = mysqli_query($conn, "SELECT * FROM tickets where (ClientID ='".$ClientData."') AND Date like '%$date%'");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Tickets</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="feather icon-bar-chart-2 f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer bg-c-red">
                                                                <div class="row align-items-center">
                                                                    <div class="col-9">
                                                                        <p class="text-white m-b-0">Today</p>
                                                                    </div>
                                                                    <div class="col-3 text-right">
                                                                        <i class="feather icon-trending-up text-white f-16"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div>    
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/kL39I1t-Q00" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            </div>
                                                            <h6 style="text-align:center;">Childcare Cleaning Services Video Overview</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="view_tickets">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 style="color:#B0C4DE;">
                                                                            <?php
                                                                                $query = mysqli_query($conn, "SELECT * FROM tickets where (ClientID ='".$ClientData."')");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Tickets</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="feather icon-bar-chart-2 f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="height:45px;"></div>
                                                            <div class="card-footer" style="background-color:#B0C4DE">
                                                                <div class="row align-items-center">
                                                                    <div class="col col-auto">
                                                                        <div class="map-area">
                                                                            <h6 class="m-0">
                                                                                <?php
                                                                                    $query = mysqli_query($conn, "SELECT * FROM tickets where (ClientID ='".$ClientData."')");
                                                                                    $number=mysqli_num_rows($query);
                                                                                    echo $number;
                                                                                ?>
                                                                            </h6>
                                                                            <p class="text-muted m-0">Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col col-auto">
                                                                        <div class="map-area">
                                                                            <h6 class="m-0">
                                                                                <?php
                                                                                    $date = date("Y-m-d");
                                                                                    $query = mysqli_query($conn, "SELECT * FROM tickets where (ClientID ='".$ClientData."') AND Date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
                                                                                    $number=mysqli_num_rows($query);
                                                                                    echo $number;
                                                                                ?>
                                                                            </h6>
                                                                            <p class="text-muted m-0">Month</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col col-auto">
                                                                        <div class="map-area">
                                                                            <h6 class="m-0">
                                                                                <?php
                                                                                    $date = date("Y-m-d");
                                                                                    $query = mysqli_query($conn, "SELECT * FROM tickets where (ClientID ='".$ClientData."') AND Date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
                                                                                    $number=mysqli_num_rows($query);
                                                                                    echo $number;
                                                                                ?>
                                                                            </h6>
                                                                            <p class="text-muted m-0">Week</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <a href="consumable_order">
                                                        <div class="card">
                                                            <div class="card-block">
                                                                <div class="row align-items-center">
                                                                    <div class="col-8">
                                                                        <h4 style="color:#98FB98;">
                                                                            <?php
                                                                                $date = date("Y-m-d");
                                                                                $query = mysqli_query($conn, "SELECT * FROM quantityrequest where (ClientID ='".$ClientData."')");
                                                                                $number=mysqli_num_rows($query);
                                                                                echo $number;
                                                                            ?>
                                                                        </h4>
                                                                        <h6 class="text-muted m-b-0">Order</h6>
                                                                    </div>
                                                                    <div class="col-4 text-right">
                                                                        <i class="fas fa-cart-arrow-down f-28"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="height:45px;"></div>
                                                            <div class="card-footer" style="background-color:#D3D3D3;">
                                                                <div class="row align-items-center">
                                                                    <div class="col col-auto">
                                                                        <div class="map-area">
                                                                            <h6 class="m-0">
                                                                                <?php
                                                                                    $query = mysqli_query($conn, "SELECT * FROM quantityrequest where (ClientID ='".$ClientData."')");
                                                                                    $number=mysqli_num_rows($query);
                                                                                    echo $number;
                                                                                ?>
                                                                            </h6>
                                                                            <p class="text-muted m-0">Total</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col col-auto">
                                                                        <div class="map-area">
                                                                            <h6 class="m-0">
                                                                                <?php
                                                                                    $date = date("Y-m-d");
                                                                                    $query = mysqli_query($conn, "SELECT * FROM quantityrequest where (ClientID ='".$ClientData."') AND CreatedDate >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)");
                                                                                    $number=mysqli_num_rows($query);
                                                                                    echo $number;
                                                                                ?>
                                                                            </h6>
                                                                            <p class="text-muted m-0">Month</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col col-auto">
                                                                        <div class="map-area">
                                                                            <h6 class="m-0">
                                                                                <?php
                                                                                    $date = date("Y-m-d");
                                                                                    $query = mysqli_query($conn, "SELECT * FROM quantityrequest where (ClientID ='".$ClientData."') AND CreatedDate >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)");
                                                                                    $number=mysqli_num_rows($query);
                                                                                    echo $number;
                                                                                ?>
                                                                            </h6>
                                                                            <p class="text-muted m-0">Week</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </a>
                                                    </div>

                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('footer.php'); ?>
<!-- Required Jquery -->
<script type="text/javascript" src="files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- waves js -->
    <script src="files/assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- Float Chart js -->
    <script src="files/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="files/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="files/assets/pages/chart/float/curvedLines.js"></script>
    <script src="files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
    <!-- amchart js -->
    <script src="files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="files/assets/pages/widget/amchart/serial.js"></script>
    <script src="files/assets/pages/widget/amchart/light.js"></script>
    <!-- Custom js -->
    <script src="files/assets/js/pcoded.min.js"></script>
    <script src="files/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="files/assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="files/assets/js/script.min.js"></script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load('current', {'packages':['corechart']});  
           google.charts.setOnLoadCallback(drawChart);  
           function drawChart()  
           {  
                var data = google.visualization.arrayToDataTable([  
                          ['Status', 'Number'],  
                          <?php  
                          while($row = mysqli_fetch_array($result))  
                          {  
                               echo "['".$row["Status"]."', ".$row["number"]."],";  
                          }  
                          ?>  
                     ]);  
                var options = {  
                      title: '',  
                      //is3D:true,  
                      pieHole: 0.2  
                     };  
                var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
                chart.draw(data, options);  
           }  
           </script>
</body>
</html>
