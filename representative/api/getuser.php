<?php
$q = intval($_GET['q']);
require 'config.php';
$sql="SELECT * FROM gsheet_master_proposal WHERE ClientID = '".$q."'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<!--div class="form-group">
	<label for="selector1" class="col-sm-5 ">Client ID</label>
	<div class="col-sm-7">
	    <input type="text" class="form-control1" id="disabledinput" disabled="" value="<?php //echo $row['ClientID']; ?>">
	</div>
</div-->
<div class="form-group">
	<label for="selector1" class="col-sm-5 ">Client Name</label>
	<div class="col-sm-7">
	    <input type="text" name="ClientName" class="form-control1" id="" value="<?php echo $row['ClientName']; ?>">
	</div>
</div>
<div class="form-group">
	<label for="selector1" class="col-sm-5 ">Phone</label>
	<div class="col-sm-7">
	    <input type="text" name="ClientPhone" class="form-control1" id="" value="<?php echo $row['Phone']; ?>">
	</div>
</div>
<div class="form-group">
	<label for="selector1" class="col-sm-5 ">Email</label>
	<div class="col-sm-7">
	    <input type="email" name="ClientEmail" class="form-control1" id="" value="<?php echo $row['Email']; ?>" required="">
	</div>
</div>
<div class="form-group">
	<label for="selector1" class="col-sm-5 ">Location Address</label>
	<div class="col-sm-7">
	    <input type="text" name="ClientAddress" class="form-control1" id="" value="<?php echo $row['Location Address']; ?>">
	</div>
</div>

<div class="form-group">
	<label for="selector1" class="col-sm-5 ">Suburb</label>
	<div class="col-sm-7">
	    <input type="text" name="ClientSuburb" class="form-control1" id="" value="<?php echo $row['Suburb']; ?>">
	</div>
</div>

<div class="form-group">
	<label for="selector1" class="col-sm-5 ">State Full</label>
	<div class="col-sm-7">
	    <input type="text" name="StateFull" class="form-control1" id="" value="<?php echo $row['State Full']; ?>">
	</div>
</div>

<div class="form-group">
	<label for="selector1" class="col-sm-5 ">Post Code</label>
	<div class="col-sm-7">
	    <input type="number" name="PostCode" class="form-control1" id="" value="<?php echo $row['Post Code']; ?>">
	</div>
</div>
