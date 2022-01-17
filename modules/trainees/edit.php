<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title">Edit Trainee</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Trainees</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="trainees_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>        	
<form class="form-horizontal form-horizontal-left" role="form" action="trainees_manage.php?tab=edit" method="post" enctype="multipart/form-data" name="frmAdd">
    <input type="hidden" name="id" value="<?php echo $id;?>">
    <div class="form-group">
        <div class="row">
        	<div class="col-sm-2 control-label">
            	<label class="form-label" for="center_id">Center/Trade </label>
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
                <input type="text" title="Enter Enter Father/Husband Name" value="<?php echo $father_name; ?>" name="father_name" id="father_name" class="form-control" />
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
                    <option value="0"<?php echo ($gender=="0")? " selected":"";?>>Male</option>
                    <option value="1"<?php echo ($gender=="1")? " selected":"";?>>Female</option>
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
                <input id="cnic" maxlength="15" type="text" title="Enter CNIC" value="<?php echo $cnic; ?>" name="cnic" id="cnic" class="form-control" />
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
                <?php if(!empty($cnic_photo_front)) { ?>
                    <a href="<?php echo $file_upload_root?>trainee_cnic/<?php echo $cnic_photo_front; ?>" target="_blank">
                        <img src="<?php echo $file_upload_root?>trainee_cnic/<?php echo $cnic_photo_front; ?>"  alt="image" title="<?php echo $id;?>" style="width: 50px;margin-right: 10px;" />
                    </a>
                    <input type="checkbox" name="delete_image_front" id="delete_image_front" class="delete-image" value="1" />&nbsp;<label for="delete_image_front">Delete This Image</label>
                <?php } ?>
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
                <?php if(!empty($cnic_photo_back)) { ?>
                    <a href="<?php echo $file_upload_root?>trainee_cnic/<?php echo $cnic_photo_back; ?>" target="_blank">
                        <img src="<?php echo $file_upload_root?>trainee_cnic/<?php echo $cnic_photo_back; ?>"  alt="image" title="<?php echo $id;?>" style="width: 50px;margin-right: 10px;" />
                    </a>
                    <input type="checkbox" name="delete_image_back" id="delete_image_back" class="delete-image" value="1" />&nbsp;<label for="delete_image_back">Delete This Image</label>
                <?php } ?>
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
                <label class="form-label" for="cnic_issue_date">CNIC Issue Date</label>
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
                <label class="form-label" for="address">Course</label>
            </div>
            <div class="col-sm-10">
                <input type="text" title="Enter Course" value="<?php echo $address; ?>" name="address" id="address" class="form-control" />
            </div>
        </div>
    </div>
    <?php if($_SESSION["logged_in_admin"]["admin_type_id"]==1 || $_SESSION["logged_in_admin"]["admin_type_id"]==7 || $_SESSION["logged_in_admin"]["admin_type_id"]==8 || $_SESSION["logged_in_admin"]["admin_type_id"]==9 || $_SESSION["logged_in_admin"]["admin_type_id"]==12){?>
    <div class="form-group">
        <div class="row">
            <div class="col-sm-2 control-label">
                <label class="form-label" for="trainee_status_id">Trainee Status</label>
            </div>
            <div class="col-sm-10">
                <select name="trainee_status_id" title="Choose Option">
                    <option value="0">Select Trainee Status</option>
                    <option value="1" <?php echo($trainee_status_id==1)?"selected":"";?>>Clear</option>
                    <option value="2" <?php echo($trainee_status_id==2)?"selected":"";?>>Already Registered</option>
                    <option value="3" <?php echo($trainee_status_id==3)?"selected":"";?>>Invalid Cnic</option>
                </select>
            </div>
        </div>
    </div>
    <?php }
    else{
        ?>
        <input type="hidden" name="trainee_status_id" value="0">
        <?php
    }
    ?>
    <div class="form-group">
    	<div class="row">
            <div class="col-sm-2 control-label">
                <label for="company" class="form-label"></label>
            </div>
            <div class="col-sm-10">
                <input type="submit" value="Update" class="btn btn-default btn-l" name="trainees_edit" title="Update Record" />
            </div>
        </div>
  	</div>
</form>