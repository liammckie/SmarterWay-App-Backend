<?php
require_once '../php/connection.php';
require_once '../php/admin_session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SCS | Admin :: Client</title>
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
                                          <li class="breadcrumb-item"><a href="#!">Client Profile</a>
                                          </li>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!--profile cover start-->
                                        <?php 
                            			$data=mysqli_query($conn,"select * from `Clients` where ClientID = '".$_GET['Id']."' LIMIT 1");
                                		while($row=mysqli_fetch_array($data)){
                                		?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="cover-profile">
                                                    <div class="profile-bg-img">
                                                        <img class="profile-bg-img img-fluid" src="../files/assets/images/user-profile/bg-img1.jpg" alt="bg-img">
                                                        <div class="card-block user-info">
                                                            <div class="col-md-12">
                                                                <div class="media-left">
                                                                    <a href="#" class="profile-image">
                                                                        <?php
                                                                        if($row[3] != NULL){
                                                                        ?>
                                                                        <img class="user-img img-radius" src="../wp-content/uploads/wpfiles/profile/<?php  echo $row[3]; ?>" width="100px" height="100px" style="background-color:white;">                                                                    </a>
                                                                        <?php
                                                                        }
                                                                        else{
                                                                        ?>
                                                                        <img class="user-img img-radius" src="../files/assets/image/user-male-icon.jpg" width="100px" height="100px">
                                                                        <?php    
                                                                        }
                                                                        ?>
                                                                    </a>
                                                                </div>
                                                                <div class="media-body row">
                                                                    <div class="col-lg-12">
                                                                        <div class="user-title">
                                                                            <h2><?php echo $row['Name']; ?></h2>
                                                                            <span class="text-white"><?php echo $row['StreetAddress']." ".$row['City']." ".$row['State']." ".$row['Country']; ?></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    	}
                                    	?>
                                                <!-- tab content start -->
                                                <div class="tab-content">
                                                    <!-- tab panel personal start -->
                                                    <div class="tab-pane active" id="personal" role="tabpanel">
                                                        <!-- personal card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">About</h5>
                                                            </div>
                                                            <div class="card-block">
                                                                <?php 
                            					                $data=mysqli_query($conn,"select * from `Clients` where ClientID = '".$_GET['Id']."'  LIMIT 1");
                                				                while($row=mysqli_fetch_array($data)){
                                				                ?>
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table m-0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">Full Name</th>
                                                                                                        <td><?php echo $row['Name'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Client ID</th>
                                                                                                        <td><?php echo $row['Code'] ?></td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr>
                                                                                                        <th scope="row">Location</th>
                                                                                                        <td><?php echo $row['StreetAddress']." ".$row['City']." ".$row['State']." ".$row['Country']; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Phone Number</th>
                                                                                                        <td><?php echo $row['Phone'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Mobile Number</th>
                                                                                                        <td><?php echo $row[21] ?></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">Email</th>
                                                                                                        <td><?php echo $row['Email'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">GPS Latitude</th>
                                                                                                        <td><?php echo $row['28'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">GPS Longitude</th>
                                                                                                        <td><?php echo $row['29'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Representative Name</th>
                                                                                                        <td><?php echo $row[12] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Representative Code</th>
                                                                                                        <td><?php echo $row[11] ?></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <!-- end of table col-lg-6 -->
                                                                                </div>
                                                                                <!-- end of row -->
                                                                            </div>
                                                                            <!-- end of general info -->
                                                                        </div>
                                                                        <!-- end of col-lg-12 -->
                                                                    </div>
                                                                    <!-- end of row -->
                                                                </div>
                                                                <?php
                                                            	}
                                                            	?>
                                                            </div>
                                                            	
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                                
                                                    <!-- tab content start -->
                                                <div class="tab-content">
                                                    <!-- tab panel personal start -->
                                                    <div class="tab-pane active" id="personal" role="">
                                                        <!-- personal card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">Message From Account Manager</h5>
                                                                <!--<button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light float-right">
                                                                    <i class="icofont icofont-edit"></i>
                                                                </button>-->
                                                            </div>
                                                            <?php
                                                            $data=mysqli_query($conn,"SELECT * FROM `message_cleaner_am` WHERE clientID = '".$_GET['Id']."' LIMIT 1");
                                                            while($row=mysqli_fetch_array($data)){
                                                            ?>
                                                            <div class="card-block">
                                                                
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-xl-12">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table m-0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">Notification to cleaner</th>
                                                                                                        <td><?php echo $row["notificationtocleaner"];?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Date due by must be in (31/12/2018)</th>
                                                                                                        <td><?php echo $row["DueDate"]; ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Message to cleaner</th>
                                                                                                        <td><?php echo $row["message"]; ?></td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                            </div>
                                                                            <!-- end of general info -->
                                                                        </div>
                                                                        <!-- end of col-lg-12 -->
                                                                    </div>
                                                                    <!-- end of row -->
                                                                </div>
                                                                
                                                            	
                                                            	
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                                
                                                 <div class="tab-content">
                                                    <!-- tab panel personal start -->
                                                    <div class="tab-pane active" id="personal" role="">
                                                        <!-- personal card start -->
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-header-text">More Details</h5>
                                                                <!--<button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light float-right">
                                                                    <i class="icofont icofont-edit"></i>
                                                                </button>-->
                                                            </div>
                                                            <?php
                                                            $data=mysqli_query($conn,"select * from `subcontractordetails` where clientID = '".$_GET['Id']."'  LIMIT 11");
                                                            while($row=mysqli_fetch_array($data)){
                                                            ?>
                                                            <div class="card-block">
                                                                
                                                                <div class="view-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table m-0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">SubContractors Business Name</th>
                                                                                                        <td><?php echo $row[2] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">SubContractors Contact Name</th>
                                                                                                        <td><?php echo $row[8] ?></td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr>
                                                                                                        <th scope="row">SubContractors Email</th>
                                                                                                        <td><?php echo $row[7] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">SubContractors Mobile</th>
                                                                                                        <td>
                                                                                                            <?php echo $row[6]; ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Directors Email</th>
                                                                                                        <td><?php echo $row[4] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Directors Mobile</th>
                                                                                                        <td>
                                                                                                            <?php echo $row[10]; ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 col-xl-6">
                                                                                        <div class="table-responsive">
                                                                                            <table class="table m-0">
                                                                                                <tbody>
                                                                                                    <tr>
                                                                                                        <th scope="row">Account Manager Name</th>
                                                                                                        <td><?php echo $row['AccountManagerName'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Account Managers Email</th>
                                                                                                        <td><?php echo $row[3] ?></td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr>
                                                                                                        <th scope="row">Account Manager Mobile</th>
                                                                                                        <td>
                                                                                                            <?php echo $row[9]; ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Operations Manager Email</th>
                                                                                                        <td><?php echo $row[5] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">Operations Manager Mobile</th>
                                                                                                        <td>
                                                                                                            <?php echo $row[11]; ?>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- end of general info -->
                                                                        </div>
                                                                        <!-- end of col-lg-12 -->
                                                                    </div>
                                                                    <!-- end of row -->
                                                                </div>	
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                            
                                            </div>
                                            <!-- Page-body end -->
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
    <script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- ck editor -->
    <script src="../files/assets/pages/ckeditor/ckeditor.js"></script>
    <!-- echart js -->
    <script src="../files/assets/pages/chart/echarts/js/echarts-all.js" type="text/javascript"></script>
    <script src="../files/assets/pages/user-profile.js"></script>
    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
    <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="../files/assets/js/script.js"></script>
</body>

</html>
