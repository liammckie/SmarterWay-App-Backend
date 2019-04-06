<?php
require_once '../php/connection.php';
require_once '../php/admin_session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>SCS | Admin :: Close Ticket</title>
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
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>    
        <style>
            .main-menu-header{
                margin-top:40px;
            }
            
@import('https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.0/css/bootstrap.min.css') 

.funkyradio div {
  clear: both;
  overflow: hidden;
}

.funkyradio label {
  width: 100%;
  border-radius: 3px;
  border: 1px solid #D1D3D4;
  font-weight: normal;
}

* {box-sizing: border-box;}
textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

.container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

/* custom styles */

label {
  display: block;
}
input {
  border: 1px solid #c4c4c4;
  border-radius: 5px;
  background-color: #fff;
  padding: 3px 5px;
  box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
  width: 190px;
}

        </style>
  </head>

  <body>
            <?php require_once('header.php'); ?>
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                      <div class="page-header" style="background-color:#160e3f">
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
                                          <li class="breadcrumb-item"><a href="#!">Close Ticket</a>
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
                                               
                                                    <div class="card-block">
                                                        <div class="dt-responsive table-responsive">
                                                            <h6></h6>                                                
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <!-- Individual Column Searching (Select Inputs) end -->
                                                
                                                <div class="container">
                                                <form action="../php/ticket_closed" method="POST" enctype="multipart/form-data">
                                                    <h5>Close This Ticket</h5>
                                                    <hr/>
                                                            <div>
                                                                <label for="subject">Details Of Ticket Closure</label>
                                                                <textarea id="subject" name="message" placeholder="Write Message..." style="height:200px" required></textarea>
                                                            </div>
                                                            
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <?php
                                                                        $Id=$_GET['Id']; 
                                                                        $data=mysqli_query($conn,"select * from `tickets` where Id='$Id'");
                                                                        while($row=mysqli_fetch_array($data)){
                                                                        
                                                                    ?>
                                                                    <input type="hidden" name="Id" value="<?php echo $row[0]; ?>"/>
                                                                    <input type="hidden" name="ClientID" value="<?php echo $row[1]; ?>"/>
                                                                    <input type="hidden" name="priority" value="<?php echo $row[6]; ?>"/>
                                                                    <input type="hidden" name="name" value="<?php echo $row['Name']; ?>"/>
                                                                    <input type="hidden" name="email" value="<?php echo $row['Email']; ?>"/>
                                                                    <input type="hidden" name="mobile" value="<?php echo $row['Mobile']; ?>"/>
                                                                    <?php
                                                                     } ?>
                                                                </div>      
                                                                
                                                                <div class="col-md-4">
                                                                    <label>Attach A File</label> 
                                                                    <input type="file" name="data">
                                                                </div>
                                                            </div>
                                                            
                                                            <div>
                                                                <div style="margin-top:20px;">
                                                                    <input class="btn btn-danger" type="submit" value="Close Ticket" >
                                                                </div>
                                                            </div>
                                                      </form>
                                                    </div>
                                                    
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
<!-- modernizr js -->
<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- data-table js -->
<script src="../files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="../files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="../files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Custom js -->
<script src="../files/assets/pages/data-table/js/data-table-custom.js"></script>
<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="../files/assets/js/script.js"></script>

</body>

</html>

