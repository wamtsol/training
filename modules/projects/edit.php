<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title">Edit Course</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Course</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="projects_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>        	
<form class="form-horizontal form-horizontal-left" role="form" action="projects_manage.php?tab=edit" method="post" enctype="multipart/form-data" name="frmAdd">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="department_id">Department</label>
            </div>
            <div class="col-sm-10">
                <select name="department_id" title="Choose Option" class="select_multiple">
                    <option value="0">Select Department</option>
                    <?php
                    $res=doquery("select * from departments where status=1 order by title", $dblink);
                    if(numrows($res)>0){
                        while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>"<?php echo($department_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]); ?></option>
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
            	<label class="form-label" for="title">Course <span class="red">*</span></label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Title" value="<?php echo $title; ?>" name="title" id="title" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="duration">Duration </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter duration" value="<?php echo $duration; ?>" name="duration" id="duration" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="total_batches">Total no of batches </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter batches" value="<?php echo $total_batches; ?>" name="total_batches" id="total_batches" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="total_no_of_trainees">Total no of trainees </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Total Trainees" value="<?php echo $total_no_of_trainees; ?>" name="total_no_of_trainees" id="total_no_of_trainees" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="min_qualification">Min Qualification </label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Qualification" value="<?php echo $min_qualification; ?>" name="min_qualification" id="min_qualification" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="Update" class="btn btn-default btn-l" name="projects_edit" title="Update Record" />
            </div>
        </div>
  	</div>
</form>