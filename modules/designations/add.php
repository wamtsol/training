<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["designations_manage"]["add"])){
	extract($_SESSION["designations_manage"]["add"]);	
}
else{
	$title="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Designation</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Designations</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="designations_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="designations_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd"  onSubmit="return checkFields();">
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="title">Title <span class="red">*</span></label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Title" value="<?php echo $title; ?>" name="title" id="title" class="form-control" />
            </div>
        </div>
    </div>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="designations_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>