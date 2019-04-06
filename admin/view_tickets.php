<?php
require_once '../php/connection.php';
require_once '../php/admin_session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>SCS | Admin :: View Tickets</title>
     <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
                                          <li class="breadcrumb-item"><a href="#!">Raised Tickets</a>
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
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Material tab card start -->
                                                <div class="card">
                                                    <div class="card-block">
                                                        <!-- Row start -->
                                                        <div class="row m-b-30">
                                                            <div class="col-lg-12 col-xl-12">
                                                                <div class="sub-title"><h4>View Your Tickets Detail</h4></div>
                                                                <!-- Nav tabs -->
                                                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                                                    <li class="nav-item">
                                                                        <a class="nav-link active" data-toggle="tab" href="#home3" role="tab">All</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#messages3" role="tab">Open</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#Assigned" role="tab">Assigned</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#profile3" role="tab">Rejected</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" data-toggle="tab" href="#settings3" role="tab">Closed</a>
                                                                        <div class="slide"></div>
                                                                    </li>
                                                                </ul>
                                                                <!-- Tab panes -->
                                                                <div class="tab-content card-block">
                                                                    <div class="tab-pane active" id="home3" role="tabpanel">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5>All Tickets Detail</h5>
                                                                                <span></span>
                                                                            </div>
                                                                            <div class="card-block">
                                                                                <div class="dt-responsive table-responsive">
                                                                                    <table id="footer-select" class="table table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Details Of Ticket Closure</th>
                                                                                                <th>Ticket Closure Proof</th>
                                                                                                <th>Closed Date</th>
                                                                                                <th>Status</th>
                                                                                                <th></th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                            $data=mysqli_query($conn,"select * from `tickets` INNER JOIN `Clients` ON tickets.clientID=Clients.ClientId ORDER BY tickets.Id DESC");
                                                                                            $counter = 0;
                                                                                            while($row=mysqli_fetch_array($data)){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo ++$counter; ?></td>
                                                                                                <td><?php echo $row[0]; ?></td>
                                                                                                <td><?php $originalDate = $row[4]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?></td>
                                                                                                <td><?php echo $row['Code']; ?></td>
                                                                                                <td><?php echo $row['Name']; ?></td>
                                                                                                <td><?php echo $row['name']; ?></td>
                                                                                                <td><?php echo $row['email']; ?></td>
                                                                                                <td><?php echo $row['mobile']; ?></td>
                                                                                                <td><?php echo $row[2]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/file/<?php echo $row[3] ?>'  style='color:#4680ff;' target='_blank'><?php if($row[3] != NULL){ echo "View Attached File"; } ?></a></td>
                                                                                                <td><?php $originalDate = $row[5]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row[6]; ?></td>
                                                                                                <td><?php echo $row[8]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/admin_file/<?php echo $row[9] ?>'  style='color:#4680ff;'target='_blank'><?php if($row[9] != NULL){ echo "View Ticket Closure Proof"; } ?></a></td>
                                                                                                <td><?php if($row[7] == "Closed"){ $originalDate = $row[10]; echo    $newDate = date("d-m-Y", strtotime($originalDate));} ?> </td>
                                                                                                <td>
                                                                                                    <?php 
                                                                                                        if($row[7] == "Open"){
                                                                                                            echo "<button type='button' class='btn btn-success'>Open</button>";
                                                                                                        }
                                                                                                        else if($row[7] == "Assigned"){
                                                                                                            echo "<button type='button' class='btn btn-info'>Assigned</button>";
                                                                                                        }
                                                                                                        else if($row[7] == "Closed"){
                                                                                                            echo "<button type='button' class='btn btn-danger'>Closed</button>";
                                                                                                        }
                                                                                                        else if($row[7] == "Rejected"){
                                                                                                            echo "<button type='button' class='btn btn-warning'>Rejected</button>";
                                                                                                        }
                                                                                                    ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <?php
                                                                                                    if($row[7] != "Closed"){
                                                                                                    ?>
                                                                                                    <div class="dropdown">
                                                                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                                                          Update Status
                                                                                                        </button>
                                                                                                        <div class="dropdown-menu">
                                                                                                        <?php
                                                                                                            echo "<form method='POST' action='../php/ticket_status?Id=".$row[0]."''><input type='hidden' value='Open' name='Status'><button class='dropdown-item' >Open</button></form>";
                                                                                                            echo "<form method='POST' action='../php/ticket_status?Id=".$row[0]."''><input type='hidden' value='Assigned' name='Status'><button class='dropdown-item'>Assigned</button></form>";
                                                                                                            echo "<form method='POST' action='../php/ticket_status?Id=".$row[0]."''><input type='hidden' value='Rejected' name='Status'><button class='dropdown-item'>Rejected</button></form>";
                                                                                                            echo "<a class='dropdown-item' href='close_ticket?Id=".$row[0]."'>Closed</a>";
                                                                                                        ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <?php
                                                                                                    }
                                                                                                    ?>
									                                                           	</td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tbody>
                                                                                        <tfoot style="display:none;">
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th></th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                // Setup - add a text input to each footer cell
                                                                                                $('#total tfoot th').each( function () {
                                                                                                    var title = $(this).text();
                                                                                                    $(this).html( '<input type="text" placeholder="Search... " value="" '+title+'" />' );
                                                                                                } );
                                                                                             
                                                                                                // DataTable
                                                                                                var table = $('#total').DataTable();
                                                                                             
                                                                                                // Apply the search
                                                                                                table.columns().every( function () {
                                                                                                    var that = this;
                                                                                             
                                                                                                    $( 'input', this.footer() ).on( 'keyup change', function () {
                                                                                                        if ( that.search() !== this.value ) {
                                                                                                            that
                                                                                                                .search( this.value )
                                                                                                                .draw();
                                                                                                        }
                                                                                                    } );
                                                                                                } );
                                                                                            } );
                                                                                            
                                                                                        </script>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                  
                                                                    </div>
                                                                    
                                                                    <div class="tab-pane" id="new" role="tabpanel">
                                                                        
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5>New Tickets</h5>
                                                                                
                                                                            </div>
                                                                            <div class="card-block">
                                                                                <div class="dt-responsive table-responsive">
                                                                                    <table id="example" class="table table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th></th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                            $data=mysqli_query($conn,"select * from `tickets` INNER JOIN `Clients` ON tickets.clientID=Clients.ClientId WHERE tickets.Status = 'New' Order BY tickets.Id DESC");
                                                                                            $counter = 0;
                                                                                            while($row=mysqli_fetch_array($data)){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo ++$counter; ?></td>
                                                                                                <td><?php echo $row[0]; ?></td>
                                                                                                <td><?php $originalDate = $row[4]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row['Code']; ?></td>
                                                                                                <td><?php echo $row['Name']; ?></td>
                                                                                                <td><?php echo $row['name']; ?></td>
                                                                                                <td><?php echo $row['email']; ?></td>
                                                                                                <td><?php echo $row['mobile']; ?></td>
                                                                                                <td><?php echo $row[2]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/file/<?php echo $row[3] ?>'  style='color:#4680ff;' target='_blank'><?php if($row[3] != NULL){ echo "View Attached File"; } ?></a></td>
                                                                                                <td><?php $originalDate = $row[5]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row[6]; ?></td>
                                                                                                <td>
                                                                                                    <div class="dropdown">
                                                                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                                                                          Update Status
                                                                                                        </button>
                                                                                                        <div class="dropdown-menu">
                                                                                                        <?php
                                                                                                            echo "Ticket";
                                                                                                        ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                            
                                                                                        </tbody>
                                                                                        <tfoot style="display:none;">
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th></th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                // Setup - add a text input to each footer cell
                                                                                                $('#example tfoot th').each( function () {
                                                                                                    var title = $(this).text();
                                                                                                    $(this).html( '<input type="text" placeholder="Search " value="" '+title+'" />' );
                                                                                                } );
                                                                                             
                                                                                                // DataTable
                                                                                                var table = $('#example').DataTable();
                                                                                             
                                                                                                // Apply the search
                                                                                                table.columns().every( function () {
                                                                                                    var that = this;
                                                                                             
                                                                                                    $( 'input', this.footer() ).on( 'keyup change', function () {
                                                                                                        if ( that.search() !== this.value ) {
                                                                                                            that
                                                                                                                .search( this.value )
                                                                                                                .draw();
                                                                                                        }
                                                                                                    } );
                                                                                                } );
                                                                                            } );
                                                                                            
                                                                                        </script>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="tab-pane" id="profile3" role="tabpanel">
                                                                        
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5>Rejected Tickets</h5>
                                                                              
                                                                            </div>
                                                                            <div class="card-block">
                                                                                <div class="dt-responsive table-responsive">
                                                                                    <table id="example2" class="table table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                            $data=mysqli_query($conn,"select * from `tickets` INNER JOIN `Clients` ON tickets.clientID=Clients.ClientId WHERE tickets.Status = 'Rejected' Order By tickets.Id DESC");
                                                                                            $counter = 0;
                                                                                            while($row=mysqli_fetch_array($data)){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo ++$counter; ?></td>
                                                                                                <td><?php echo $row[0]; ?></td>
                                                                                                <td><?php $originalDate = $row[4]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row['Code']; ?></td>
                                                                                                <td><?php echo $row['Name']; ?></td>
                                                                                                <td><?php echo $row['name']; ?></td>
                                                                                                <td><?php echo $row['email']; ?></td>
                                                                                                <td><?php echo $row['mobile']; ?></td>
                                                                                                <td><?php echo $row[2]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/file/<?php echo $row[3] ?>'  style='color:#4680ff;' target='_blank'><?php if($row[3] != NULL){ echo "View Attached File"; } ?></a></td>
                                                                                                
                                                                                                <td><?php $originalDate = $row[5]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row[6]; ?></td>
                                                                                                <td><button type="button" class="btn btn-warning"><?php echo $row[7]; ?></button></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tbody>
                                                                                        <tfoot style="display:none;">
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                // Setup - add a text input to each footer cell
                                                                                                $('#example2 tfoot th').each( function () {
                                                                                                    var title = $(this).text();
                                                                                                    $(this).html( '<input type="text" placeholder="Search " value="" '+title+'" />' );
                                                                                                } );
                                                                                             
                                                                                                // DataTable
                                                                                                var table = $('#example2').DataTable();
                                                                                             
                                                                                                // Apply the search
                                                                                                table.columns().every( function () {
                                                                                                    var that = this;
                                                                                             
                                                                                                    $( 'input', this.footer() ).on( 'keyup change', function () {
                                                                                                        if ( that.search() !== this.value ) {
                                                                                                            that
                                                                                                                .search( this.value )
                                                                                                                .draw();
                                                                                                        }
                                                                                                    } );
                                                                                                } );
                                                                                            } );
                                                                                            
                                                                                            
                                                                                            </script>
                                                                                            
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tab-pane" id="messages3" role="tabpanel">
                                                                        
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5>Open Tickets</h5>
                                                                                <span></span>
                                                                            </div>
                                                                            <div class="card-block">
                                                                                <div class="dt-responsive table-responsive">
                                                                                    <table id="example3" class="table table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                            $data=mysqli_query($conn,"select * from `tickets` INNER JOIN `Clients` ON tickets.clientID=Clients.ClientId WHERE tickets.Status = 'Open' Order By tickets.Id DESC");
                                                                                            $counter = 0;
                                                                                            while($row=mysqli_fetch_array($data)){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo ++$counter; ?></td>
                                                                                                <td><?php echo $row[0]; ?></td>
                                                                                                <td><?php $originalDate = $row[4]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row['Code']; ?></td>
                                                                                                <td><?php echo $row['Name']; ?></td>
                                                                                                <td><?php echo $row['name']; ?></td>
                                                                                                <td><?php echo $row['email']; ?></td>
                                                                                                <td><?php echo $row['mobile']; ?></td>
                                                                                                <td><?php echo $row[2]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/file/<?php echo $row[3] ?>'  style='color:#4680ff;' target='_blank'><?php if($row[3] != NULL){ echo "View Attached File"; } ?></a></td>
                                                                                                <td><?php $originalDate = $row[5]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row[6]; ?></td>
                                                                                                <td><button type="button" class="btn btn-success"><?php echo $row[7]; ?></button></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tbody>
                                                                                        <tfoot style="display:none;">
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                // Setup - add a text input to each footer cell
                                                                                                $('#example3 tfoot th').each( function () {
                                                                                                    var title = $(this).text();
                                                                                                    $(this).html( '<input type="text" placeholder="Search " value="" '+title+'" />' );
                                                                                                } );
                                                                                             
                                                                                                // DataTable
                                                                                                var table = $('#example3').DataTable();
                                                                                             
                                                                                                // Apply the search
                                                                                                table.columns().every( function () {
                                                                                                    var that = this;
                                                                                             
                                                                                                    $( 'input', this.footer() ).on( 'keyup change', function () {
                                                                                                        if ( that.search() !== this.value ) {
                                                                                                            that
                                                                                                                .search( this.value )
                                                                                                                .draw();
                                                                                                        }
                                                                                                    } );
                                                                                                } );
                                                                                            } );
                                                                                            
                                                                                            
                                                                                            </script>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    
                                                                    <div class="tab-pane" id="settings3" role="tabpanel">
                                                                        
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5>Closed Tickets</h5>
                                                                                <span></span>
                                                                            </div>
                                                                            <div class="card-block">
                                                                                <div class="dt-responsive table-responsive">
                                                                                    <table id="example4" class="table table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Details Of Ticket Closure</th>
                                                                                                <th>Ticket Closure Proof</th>
                                                                                                <th>Closed Date</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                            $data=mysqli_query($conn,"select * from `tickets` INNER JOIN `Clients` ON tickets.clientID=Clients.ClientId WHERE tickets.Status = 'Closed' Order By tickets.Id DESC");
                                                                                            $counter = 0;
                                                                                            while($row=mysqli_fetch_array($data)){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo ++$counter; ?></td>
                                                                                                <td><?php echo $row[0] ?></td>
                                                                                                <td><?php $originalDate = $row[4]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row['Code']; ?></td>
                                                                                                <td><?php echo $row['Name']; ?></td>
                                                                                                <td><?php echo $row['name']; ?></td>
                                                                                                <td><?php echo $row['email']; ?></td>
                                                                                                <td><?php echo $row['mobile']; ?></td>
                                                                                                <td><?php echo $row[2]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/file/<?php echo $row[3] ?>'  style='color:#4680ff;' target='_blank'><?php if($row[3] != NULL){ echo "View Attached File"; } ?></a></td>
                                                                                                <td><?php $originalDate = $row[5]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row[6]; ?></td>
                                                                                                <td><?php echo $row[8]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/admin_file/<?php echo $row[9] ?>'  style='color:#4680ff;' target='_blank'><?php if($row[9] != NULL){ echo "View Ticket Closure Proof"; } ?></a></td>
                                                                                                <td><?php $originalDate = $row[10]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><button type="button" class="btn btn-danger"><?php echo $row[7]; ?></button></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tbody>
                                                                                        <tfoot style="display:none;">
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Details Of Ticket Closure</th>
                                                                                                <th>Ticket Closure Proof</th>
                                                                                                <th>Closed Date</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                // Setup - add a text input to each footer cell
                                                                                                $('#example4 tfoot th').each( function () {
                                                                                                    var title = $(this).text();
                                                                                                    $(this).html( '<input type="text" placeholder="Search " value="" '+title+'" />' );
                                                                                                } );
                                                                                             
                                                                                                // DataTable
                                                                                                var table = $('#example4').DataTable();
                                                                                             
                                                                                                // Apply the search
                                                                                                table.columns().every( function () {
                                                                                                    var that = this;
                                                                                             
                                                                                                    $( 'input', this.footer() ).on( 'keyup change', function () {
                                                                                                        if ( that.search() !== this.value ) {
                                                                                                            that
                                                                                                                .search( this.value )
                                                                                                                .draw();
                                                                                                        }
                                                                                                    } );
                                                                                                } );
                                                                                            } );
                                                                                            
                                                                                            
                                                                                            </script>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="tab-pane" id="Assigned" role="tabpanel">
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <h5>Assigned Tickets</h5>
                                                                            </div>
                                                                            <div class="card-block">
                                                                                <div class="dt-responsive table-responsive">
                                                                                    <table id="assigned" class="table table-striped table-bordered nowrap">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php
                                                                                            $data=mysqli_query($conn,"select * from `tickets` INNER JOIN `Clients` ON tickets.clientID=Clients.ClientId WHERE tickets.Status = 'Assigned' Order By tickets.Id DESC");
                                                                                            $counter = 0;
                                                                                            while($row=mysqli_fetch_array($data)){
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td><?php echo ++$counter; ?></td>
                                                                                                <td><?php echo $row[0]; ?></td>
                                                                                                <td><?php $originalDate = $row[4]; echo $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row['Code']; ?></td>
                                                                                                <td><?php echo $row['Name']; ?></td>
                                                                                                <td><?php echo $row['name']; ?></td>
                                                                                                <td><?php echo $row['email']; ?></td>
                                                                                                <td><?php echo $row['mobile']; ?></td>
                                                                                                <td><?php echo $row[2]; ?></td>
                                                                                                <td><a href='../wp-content/uploads/wpfiles/file/<?php echo $row[3] ?>'  style='color:#4680ff;' target='_blank'>View Attached File</a></td>
                                                                                                <td><?php $originalDate = $row[5]; echo    $newDate = date("d-m-Y", strtotime($originalDate)); ?> </td>
                                                                                                <td><?php echo $row[6]; ?></td>
                                                                                                <td><button type="button" class="btn btn-info"><?php echo $row[7]; ?></button></td>
                                                                                            </tr>
                                                                                            <?php
                                                                                            }
                                                                                            ?>
                                                                                        </tbody>
                                                                                        <tfoot style="display:none">
                                                                                            <tr>
                                                                                                <th>S. No.</th>
                                                                                                <th>Ticket ID</th>
                                                                                                <th>Date</th>
                                                                                                <th>Client ID</th>
                                                                                                <th>Client Name </th>
                                                                                                <th>Ticket Raiser Name</th>
                                                                                                <th>Email</th>
                                                                                                <th>Mobile No.</th>
                                                                                                <th>Message</th>
                                                                                                <th>File</th>
                                                                                                <th>Auth Date</th>
                                                                                                <th>Priority</th>
                                                                                                <th>Status</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                        <script>
                                                                                            $(document).ready(function() {
                                                                                                // Setup - add a text input to each footer cell
                                                                                                $('#assigned tfoot th').each( function () {
                                                                                                    var title = $(this).text();
                                                                                                    $(this).html( '<input type="text" placeholder="Search " value="" '+title+'" />' );
                                                                                                } );
                                                                                             
                                                                                                // DataTable
                                                                                                var table = $('#assigned').DataTable();
                                                                                             
                                                                                                // Apply the search
                                                                                                table.columns().every( function () {
                                                                                                    var that = this;
                                                                                             
                                                                                                    $( 'input', this.footer() ).on( 'keyup change', function () {
                                                                                                        if ( that.search() !== this.value ) {
                                                                                                            that
                                                                                                                .search( this.value )
                                                                                                                .draw();
                                                                                                        }
                                                                                                    } );
                                                                                                } );
                                                                                            } );
                                                                                            
                                                                                            
                                                                                        </script>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Material tab card end -->
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
