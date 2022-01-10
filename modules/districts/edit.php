<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title">Edit District</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Districts</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="districts_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>        	
<form class="form-horizontal form-horizontal-left" role="form" action="districts_manage.php?tab=edit" method="post" enctype="multipart/form-data" name="frmAdd">
    <input type="hidden" name="id" value="<?php echo $id;?>">
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
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="Update" class="btn btn-default btn-l" name="districts_edit" title="Update Record" />
            </div>
        </div>
  	</div>
</form>