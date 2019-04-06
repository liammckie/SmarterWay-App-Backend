<style>
    .inputlevel{
        border: 0;
        outline: 0;
        background: transparent;
    }
    .category{
        background-color: #222d32;
        color: white;
    }
    .category>input{
        margin: 10px;
    }
</style>
<?php
$q = $_GET['q'];
require 'config.php';
$sql="SELECT DISTINCT(`Sub Category`) FROM gsheet_vb_templates WHERE Category = '".$q."'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
$rows[] = $row;
	foreach ($rows as $row) {
		$categories = $row['Sub Category'];
	}    
?>
<div class="form-group">
    <div class="col-sm-12 category">
	    <input class="inputlevel" name="Category[]" type="text" id="" value="<?php echo $categories; ?>">
	</div>
</div>
<?php
$sqls='SELECT `Super Sub Category` FROM gsheet_vb_templates WHERE Category = "'.$q.'" AND `Sub Category` = "'.$categories.'"';
$results = mysqli_query($conn,$sqls);
while($rows = mysqli_fetch_assoc($results)){
?>
<div class="form-group">
    <div class="col-sm-5">
	    <input type="text" name="SubCategories[]" class="form-control1 inputlevel" value="<?php echo $rows['Super Sub Category']; ?>">
	</div>
	<div class="col-sm-7">
	    <select name="status[]" id="selector1" class="form-control1">
			<option value="DAILY">DAILY</option>
			<option value="TWICE WEEKLY">TWICE WEEKLY</option>
			<option value="WEEKLY">WEEKLY</option>
			<option value="BI-MONTHLY">BI-MONTHLY</option>
			<option value="MONTHLY">MONTHLY</option>
			<option value="QUARTERLY">QUARTERLY</option>
			<option value="BI-ANNUALLY">BI-ANNUALLY</option>
			<option value="YEARLY">YEARLY</option>
			<option value="PER CLEAN">PER CLEAN</option>
			<option value="AS REQUESTED">AS REQUESTED</option>
			<option value="MON TO FRI">MON TO FRI</option>
			<option value="WEEKENDS">WEEKENDS</option>
			<option value="TUE - THU - WEEKEND">TUE - THU - WEEKEND</option>
			<option value="MON - WED - FRI">MON - WED - FRI</option>
	    </select>
	</div>
</div>
<hr/>
<?php
}
}
?>