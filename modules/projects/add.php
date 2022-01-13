<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["projects_manage"]["add"])){
	extract($_SESSION["projects_manage"]["add"]);	
}
else{
	$title="";
    $department_id="";
}
?>
<div class="page-header">
	<h1 class="title">Add New Project/Course</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Projects/Course</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="projects_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>
<form class="form-horizontal form-horizontal-left" role="form" action="projects_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd"  onSubmit="return checkFields();">
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="department_id">Department</label>
            </div>
            <div class="col-sm-10">
                <select name="department_id" title="Choose Option">
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
                <input type="submit" value="SUBMIT" class="btn btn-default btn-l" name="projects_add" title="Submit Record" />
            </div>
        </div>
  	</div>  
</form>