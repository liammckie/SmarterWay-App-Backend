<?php
require_once '../php/connection.php';
require_once '../php/admin_session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SCS | Admin :: Profile</title>
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
                    <div class="page-header" style="background: #160e3f;">
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
                                        <li class="breadcrumb-item"><a href="#!">Profile</a>
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
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <!--profile cover start-->
                                        <?php 
                            			$data=mysqli_query($conn,"select * from `Clients` where Id = '".$_SESSION['Id']."' LIMIT 1");
                                		while($row=mysqli_fetch_array($data)){
                                		?>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="cover-profile">
                                                    <div class="profile-bg-img">
                                                        <img class="profile-bg-img img-fluid" src="../files/assets/images/user-profile/bg-img1.jpg" alt="">
                                                        <div class="card-block user-info">
                                                            <div class="col-md-12">
                                                                <div class="media-left">
                                                                    <abbr title="Change Your Profile Image">
                                                                        <a href="#" class="profile-image">
                                                                            <?php
                                                                            if($row[3] != NULL){
                                                                            ?>
                                                                            <img data-toggle="modal" data-target="#myModal" class="user-img img-radius" src="../wp-content/uploads/wpfiles/profile/<?php  echo $row[3]; ?>" width="100px" height="100px">                                                                    </a>
                                                                            <?php
                                                                            }
                                                                            else{
                                                                            ?>
                                                                            <img data-toggle="modal" data-target="#myModal" class="user-img img-radius" src="../files/assets/image/user-male-icon.jpg" width="100px" height="100px">
                                                                            <?php    
                                                                            }
                                                                            ?>
                                                                        </a>
                                                                    </abbr>
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
                                                                <button id="edit-btn" type="button" class="btn btn-sm btn-primary waves-effect waves-light float-right">
                                                                    <i class="icofont icofont-edit"></i>
                                                                </button>
                                                            </div>
                                                            
                                                            <div class="card-block">
                                                                <?php 
                            					                $data=mysqli_query($conn,"select * from `Clients` where Id = '".$_SESSION['Id']."' LIMIT 1");
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
                                                                                                        <th scope="row">GPS Latitude</th>
                                                                                                        <td><?php echo $row['28'] ?></td>
                                                                                                    </tr>
                                                                                                    <tr>
                                                                                                        <th scope="row">GPS Longitude</th>
                                                                                                        <td><?php echo $row['29'] ?></td>
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
                                                            	<form action="../php/update_profile" method="post" enctype="multipart/form-data">
                                                            	<div class="edit-info">
                                                                    <div class="row">
                                                                        <div class="col-lg-12">
                                                                            <div class="general-info form-material">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 ">
                                                                                        <div class="material-group">
                                                                                            <div class="material-addone">
                                                                                                <i class="icofont icofont-user"></i>
                                                                                            </div>
                                                                                            <div class="form-group form-primary">
                                                                                                <input type="text" name="name" class="form-control" required="">
                                                                                                <span class="form-bar"></span>
                                                                                                <label class="float-label">Full Name</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="material-group">
                                                                                            <div class="material-addone">
                                                                                                <i class="icofont icofont-mobile-phone"></i>
                                                                                            </div>
                                                                                            <div class="form-group form-primary">
                                                                                                <input type="text" name="mobile" class="form-control" required="">
                                                                                                <span class="form-bar"></span>
                                                                                                <label class="float-label">Mobile Number</label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                        <div class="col-lg-6">
        
                                                                                            <div class="material-group">
                                                                                                <div class="material-addone">
                                                                                                    <i class="icofont icofont-earth"></i>
                                                                                                </div>
                                                                                                <div class="form-group form-primary">
                                                                                                    <input type="text" name="latitude" class="form-control" required="">
                                                                                                    <span class="form-bar"></span>
                                                                                                    <label class="float-label">Latitude</label>
                                                                                                </div>
                                                                                            </div>
        
        
                                                                                            <div class="material-group">
                                                                                                <div class="material-addone">
                                                                                                    <i class="icofont icofont-earth"></i>
                                                                                                </div>
                                                                                                <div class="form-group form-primary">
                                                                                                    <input type="text" name="longitude" class="form-control" required="">
                                                                                                    <span class="form-bar"></span>
                                                                                                    <label class="float-label">Longitude</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                <!-- end of table col-lg-6 -->
                                                                            </div>
                                                                            <!-- end of row -->
                                                                            <div class="text-center">
                                                                                <button type="submit" class="btn btn-primary waves-effect waves-light m-r-20">Save</button>
                                                                                <a href="#!" id="edit-cancel" class="btn btn-default waves-effect">Cancel</a>
                                                                            </div>
                                                                        </div>
                                                                        <!-- end of edit info -->
                                                                        </form>
                                                                    </div>
                                                                    <!-- end of col-lg-12 -->
                                                                </div>
                                                                <!-- end of row -->
                                                            </div>
                                                            	
                                                            </div>
                                                        </div>
                                                    </div> 
                                                    
                                                </div>
                                                </div
                                                
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
    
    <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Select Your Profile Image</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
            <form action="../php/admin_profile" method="post" enctype="multipart/form-data">
                <input type="file" name="img"/>
                <button type="submit" class="btn btn-info">Update</button>
            </form>
        </div>
        
      </div>
</body>

</html>
