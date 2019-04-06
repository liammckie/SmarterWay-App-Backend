<?php
require_once '../php/connection.php';
require_once '../php/admin_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SCS | Admin :: Home</title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <!-- Favicon icon -->
      <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
      <!-- waves.css -->
      <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- feather icon -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">
      <!-- ico font -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Data Table Css -->
      <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css">
      <link rel="stylesheet" type="text/css" href="../files/assets/css/widget.css">
      <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>    
       <style>
           .piechart{
               Height: 250px;
           }
           @media only screen and (max-width: 600px) {
                .piechart {
                    height:200px;
                    width:122%;
                    padding-right:7%;
                }
            }
            .main-menu-header{
                margin-top:40px;
            }
            .ticket-tab{
                margin-left:100px;
            }
            .text-tab:hover{
                color:skyblue;
            }
       </style>   
  </head>

  <body>
        <?php require_once('header.php'); ?>
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                      <div class="page-header" style="background-color:#160e3f;">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h4 class="m-b-10">Admin</h4>
                                      </div>
                                      <ul class="breadcrumb">
                                          <li class="breadcrumb-item">
                                              <a href="index">
                                                  <i class="feather icon-home"></i>
                                              </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Home</a>
                                          </li>
                                          <li class="ticket-tab"><a href="view_tickets"><span class="text-tab"><i class="fas fa-ticket-alt"></i>  View Tickets</span></a></li>
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
                                            <div class="col-lg-3 col-md-6">
                                                <a href="clients">
                                                <div class="card bg-c-blue total-card">
                                                    <div class="card-block">
                                                        <div class="text-left"><br/>
                                                            <h4>
                                                                <?php
                                                                    $query = mysqli_query($conn, "SELECT * FROM Clients  where Id != '".$AdminData."'");
                                                                    $number=mysqli_num_rows($query);
                                                                    echo $number;
                                                                ?>
                                                            </h4>
                                                            <p class="m-0">Total Clients</p>
                                                        </div>
                                                        <span class="label bg-c-blue value-badges"><i class="feather icon-trending-up text-white f-16"></i></span>
                                                    </div>
                                                    <i class="fas fa-users" style="text-align: center; color:white; font-size:90px; margin-bottom:20px;"></i>
                                                    
                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <a href="representatives">
                                                <div class="card bg-c-red total-card">
                                                    <div class="card-block">
                                                        <div class="text-left"><br/>
                                                            <h4>
                                                                <?php
                                                                    $query = mysqli_query($conn, "SELECT * FROM representatives");
                                                                    $number=mysqli_num_rows($query);
                                                                    echo $number;
                                                                ?>
                                                            </h4>
                                                            <p class="m-0">Total Representatives</p>
                                                        </div>
                                                        <span class="label bg-c-red value-badges"><i class="feather icon-trending-up text-white f-16"></i></span>
                                                    </div>
                                                    <i class="fas fa-user-tie" style="text-align: center; color:white; font-size:90px; margin-bottom:20px;"></i>
                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <a href="view_tickets">
                                                <div class="card total-card" style="background-color:#696969;">
                                                    <div class="card-block">
                                                        <div class="text-left"><br/>
                                                            <h4>
                                                                <?php
                                                                    $query = mysqli_query($conn, "SELECT * FROM tickets");
                                                                    $number=mysqli_num_rows($query);
                                                                    echo $number;
                                                                ?>
                                                            </h4>
                                                            <p class="m-0">Total Tickets</p>
                                                        </div>
                                                        <span class="label value-badges"><i class="feather icon-trending-up text-white f-16"></i></span>
                                                    </div>
                                                    <i class="fas fa-ticket-alt" style="text-align: center; color:white; font-size:90px; margin-bottom:20px;"></i>
                                                </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <a href="consumable_order">
                                                <div class="card total-card" style="background-color:#010B3D;">
                                                    <div class="card-block">
                                                        <div class="text-left"><br/>
                                                            <h4>
                                                                <?php
                                                                    $query = mysqli_query($conn, "SELECT * FROM quantityrequest");
                                                                    $number=mysqli_num_rows($query);
                                                                    echo $number;
                                                                ?>
                                                            </h4>
                                                            <p class="m-0">Total Orders</p>
                                                        </div>
                                                        <span class="label value-badges"><i class="feather icon-trending-up text-white f-16"></i></span>
                                                    </div>
                                                    <i class="fas fa-cart-arrow-down" style="text-align: center; color:white; font-size:90px; margin-bottom:20px;"></i>
                                                </div>
                                                </a>
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
                                                                                $query = mysqli_query($conn, "SELECT * FROM clientcleaninglog where checkInDate like '%$date%'");
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
                                                                                $query = mysqli_query($conn, "SELECT * FROM clientcheckoutlog where createdTime like '%$date%'");
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
                                                                                $query = mysqli_query($conn, "SELECT * FROM quantityrequest where CreatedDate like '%$date%'");
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
                                                                                $query = mysqli_query($conn, "SELECT * FROM clientcleaninglog");
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
                                                                                $query = mysqli_query($conn, "SELECT * FROM clientcheckoutlog");
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
                                                                                $query = mysqli_query($conn, "SELECT * FROM tickets where Date like '%$date%'");
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
                                            <!-- site Analytics card end -->
                                            <div class="col-lg-5 col-md-12">
                                                <div class="card">
                                                    <div class="card-header borderless">
                                                        <h5>Site Ticket Analytics</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <!--div id="seo-ecommerce-barchart" style="height: 375px"></div-->
                                                        <?php
                                                            $query = "SELECT Status, count(*) as number FROM tickets GROUP BY Status" ;  
                                                            $result = mysqli_query($conn, $query);
                                                        ?>
                                                        <div class="col-md-11">  
                                                            <h6 align="center" style="width:100%; height: 100%;">Percentage of Open, Assigned, Closed and Rejected Tickets</h6>  
                                                             
                                                            <div id="piechart" class="piechart"></div>
                                                       </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once '../footer.php'; ?>
<!-- Required Jquery -->
    <script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
    <script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
    <!-- waves js -->
    <script src="../files/assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
    <!-- Float Chart js -->
    <script src="../files/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="../files/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="../files/assets/pages/chart/float/curvedLines.js"></script>
    <script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
    <!-- amchart js -->
    <script src="../files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="../files/assets/pages/widget/amchart/serial.js"></script>
    <script src="../files/assets/pages/widget/amchart/light.js"></script>
    <!-- Google map js -->
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script type="text/javascript" src="../files/assets/pages/google-maps/gmaps.js"></script>
    <!-- Custom js -->
    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="../files/assets/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="../files/assets/js/script.min.js"></script>
    <script type="text/javascript" src="../files/piechart.js"></script>  
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
