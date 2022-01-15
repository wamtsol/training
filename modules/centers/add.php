<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["centers_manage"]["add"])){
	extract($_SESSION["centers_manage"]["add"]);	
}
else{
	$project_id="";
    $district_id="";
    $center="";
    $incharge_user_id="";
    $start_date="";
    $end_date="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Batch</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Batches</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="centers_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="centers_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="project_id">Course</label>
            </div>
            <div class="col-sm-10">
                <select name="project_id" title="Choose Option">
                    <option value="0">Select Course</option>
                    <?php
                    $res=doquery("select * from projects where status=1 order by title", $dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>"<?php echo($project_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
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
                <label class="form-label" for="district_id">District</label>
            </div>
            <div class="col-sm-10">
                <select name="district_id" title="Choose Option">
                    <option value="0">Select District</option>
                    <?php
                    $res=doquery("select * from districts where status=1 order by name", $dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>"<?php echo($district_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["name"]); ?></option>
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
            	<label class="form-label" for="center">Batch <span class="red">*</span></label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Batch" value="<?php echo $center; ?>" name="center" id="center" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="incharge_user_id">Incharge User</label>
            </div>
            <div class="col-sm-10">
                <select name="incharge_user_id" title="Choose Option">
                    <option value="0">Select Incharge User</option>
                    <?php
                    $res=doquery("select * from users where status=1 order by name", $dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>"<?php echo($incharge_user_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["name"]); ?></option>
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
            	<label class="form-label" for="start_date">Start Date</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Date" value="<?php echo $start_date; ?>" name="start_date" id="start_date" class="form-control date-picker" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="end_date">End Date</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Date" value="<?php echo $end_date; ?>" name="end_date" id="end_date" class="form-control date-picker" />
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="centers_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>