<?php
require_once 'php/connection.php';
require_once 'php/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SCS | Alarm Escalation</title>
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
       <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
        <style>
            .main-menu-header{
                margin-top:40px;
            }
        </style>
  </head>

  <body>
    <?php require('header.php'); ?>
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                      <div class="page-header" style="background-color:#160e3f;">
                          <div class="page-block">
                              <div class="row align-items-center">
                                  <div class="col-md-8">
                                      <div class="page-header-title">
                                          <h4 class="m-b-10">Smart Cleaning Solutions</h4>
                                      </div>
                                      <ul class="breadcrumb">
                                          <li class="breadcrumb-item">
                                              <a href="index">
                                                  <i class="feather icon-home"></i>
                                              </a>
                                          </li>
                                          <li class="breadcrumb-item"><a href="#!">Alarm Escalation</a>
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
                                        	<div class="col-md-12">
                                                <!-- Individual Column Searching (Select Inputs) start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Alarm Escalation Schedule</h5>
                                                        
                                                    </div>
                                                    <div class="card-block">
                                                        
                                                        <?php
                                                            $data=mysqli_query($conn,"SELECT * FROM `AlarmSchedule` WHERE ClientID = '".$ClientData."' LIMIT 1");
                                                            while($row=mysqli_fetch_assoc($data)){
                                                        ?>
                                                        <div class="dt-responsive table-responsive">
                                                            <table class="table table-striped">
                                                                <tr><td>IsAlarmActive</td><td><?php echo $row['IsAlarmActive']; ?></td></tr>
                                                                <tr><td>IsAlarmActiveMonday</td><td><?php echo $row['IsAlarmActiveMonday']; ?></td></tr>
                                                                <tr><td>EarliestCleanTimeMonday</td><td><?php echo $row['EarliestCleanTimeMonday']; ?></td></tr>
                                                                <tr><td>DealineCleanTimeMonday</td><td><?php echo $row['DealineCleanTimeMonday']; ?></td></tr>
                                                                <tr><td>IsAlarmActiveTuesday</td><td><?php echo $row['IsAlarmActiveTuesday']; ?></td></tr>
                                                                <tr><td>EarliestCleanTimeTuesday</td><td><?php echo $row['EarliestCleanTimeTuesday']; ?></td></tr>
                                                                <tr><td>DealineCleanTimeTuesday</td><td><?php echo $row['DealineCleanTimeTuesday']; ?></td></tr>
                                                                <tr><td>IsAlarmActiveWednesday</td><td><?php echo $row['IsAlarmActiveWednesday']; ?></td></tr>
                                                                <tr><td>EarliestCleanTimeWednesday</td><td><?php echo $row['EarliestCleanTimeWednesday']; ?></td></tr>
                                                                <tr><td>DealineCleanTimeWednesday</td><td><?php echo $row['DealineCleanTimeWednesday']; ?></td></tr>
                                                                <tr><td>IsAlarmActiveThursday</td><td><?php echo $row['IsAlarmActiveThursday']; ?></td></tr> 
                                                                <tr><td>EarliestCleanTimeThursday</td><td><?php echo $row['EarliestCleanTimeThursday']; ?></td></tr>
                                                                <tr><td>DealineCleanTimeThursday</td><td><?php echo $row['DealineCleanTimeThursday']; ?></td></tr>
                                                                <tr><td>IsAlarmActiveFriday</td><td><?php echo $row['IsAlarmActiveFriday']; ?></td></tr> 
                                                                <tr><td>EarliestCleanTimeFriday</td><td><?php echo $row['EarliestCleanTimeFriday']; ?></td></tr> 
                                                                <tr><td>DealineCleanTimeFriday</td><td><?php echo $row['DealineCleanTimeFriday']; ?></td></tr> 
                                                                <tr><td>IsAlarmActiveSaturday</td><td><?php echo $row['IsAlarmActiveSaturday']; ?></td></tr>
                                                                <tr><td>EarliestCleanTimeSaturday</td><td><?php echo $row['EarliestCleanTimeSaturday']; ?></td></tr>
                                                                <tr><td>DealineCleanTimeSaturday</td><td><?php echo $row['DealineCleanTimeSaturday']; ?></td></tr>
                                                                <tr><td>IsAlarmActiveSunday</td><td><?php echo $row['IsAlarmActiveSunday']; ?></td></tr>
                                                                <tr><td>EarliestCleanTimeSunday</td><td><?php echo $row['EarliestCleanTimeSunday']; ?></td></tr> 
                                                                <tr><td>DealineCleanTimeSunday</td><td><?php echo $row['DealineCleanTimeSunday']; ?></td></tr>
                                                                <tr><td>createddate</td><td><?php echo $row['createddate']; ?></td></tr>
                                                                <tr><td>modifyddate</td><td><?php echo $row['modifyddate']; ?></td></tr>
                                                            </table>
                                                        </div>
                                                        <?php
                                                            } 
                                                        ?>
                                                    </div>
                                                </div>
                                                <!-- Individual Column Searching (Select Inputs) end -->
                                                
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
<?php require_once 'footer.php' ?>

<!-- Required Jquery -->
<script type="text/javascript" src="files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- waves js -->
<script src=files/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="files/bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- data-table js -->
<script src="files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Custom js -->
<script src="files/assets/pages/data-table/js/data-table-custom.js"></script>
<script src="files/assets/js/pcoded.min.js"></script>
<script src="files/assets/js/vertical/vertical-layout.min.js"></script>
<script src="files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="files/assets/js/script.js"></script>


</body>

</html>
