<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["trainees_manage"]["add"])){
	extract($_SESSION["trainees_manage"]["add"]);	
}
else{
    $name="";
    $father_name="";
    $gender="";
    $cnic="";
    $birth_date=date("d/m/Y");
    $cnic_issue_date=date("d/m/Y");
    $contact="";
    $trainee_status_id=0;
    $center_ids=isset($_SESSION["trainees_manage"]["center_id"])?[$_SESSION["trainees_manage"]["center_id"]]:array();
}
?>
<div class="page-header">
	<h1 class="title">Add New Trainee</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Trainees</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="trainees_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="trainees_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="center_id">Batch </label>
            </div>
            <div class="col-sm-10">
                <select name="center_ids[]" id="center_id" multiple="multiple" class="select_multiple" title="Choose Option">
                    <?php
                    $res=doquery("select * from centers where status = 1 order by center",$dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                        ?>
                        <option value="<?php echo $rec["id"]?>"<?php echo(isset($center_ids) && in_array( $rec["id"], $center_ids))?"selected":"";?>><?php echo get_field($rec["district_id"], "districts", "name")." ".unslash($rec["center"])?></option>
                        <?php			
                        }			
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="name">Name <span class="red">*</span></label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Name" value="<?php echo $name; ?>" name="name" id="name" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="father_name">Father/Husband Name </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Father/Husband Name" value="<?php echo $father_name; ?>" name="father_name" id="father_name" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="gender">Gender <span class="red">*</span></label>
            </div>
            <div class="col-sm-10">
                <select name="gender" id="gender">
                    <option value="0">Male</option>
                    <option value="1">Female</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="cnic">CNIC</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter CNIC" value="<?php echo $cnic; ?>" name="cnic" id="cnic" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="cnic_photo_front">CNIC Photo Front</label>
            </div>
            <div class="col-sm-10">
                <input type="file" title="Select Image" name="cnic_photo_front" id="cnic_photo_front" class="form-control">
            </div>
        </div>
  	</div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="cnic_photo_back">CNIC Photo Back</label>
            </div>
            <div class="col-sm-10">
                <input type="file" title="Select Image" name="cnic_photo_back" id="cnic_photo_back" class="form-control">
            </div>
        </div>
  	</div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="birth_date">Birth Date</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Date" value="<?php echo $birth_date; ?>" name="birth_date" id="birth_date" class="form-control date-picker" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="cnic_issue_date">Cnic Issue Date</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Cnic Issue Date" value="<?php echo $cnic_issue_date; ?>" name="cnic_issue_date" id="cnic_issue_date" class="form-control date-picker" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="contact">Contact</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Contact" value="<?php echo $contact; ?>" name="contact" id="contact" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="trainee_status_id">Trainee Status</label>
            </div>
            <div class="col-sm-10">
                <select name="trainee_status_id" title="Choose Option">
                    <option value="0">Select Trainee Status</option>
                    <option value="1">Clear</option>
                    <option value="2">Already Registered</option>
                    <option value="3">Invalid Cnic</option>
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="trainees_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>