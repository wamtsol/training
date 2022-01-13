<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_SESSION["attendance_manage"]["add"])){
	extract($_SESSION["attendance_manage"]["add"]);	
}
else{
	$center_id=$_SESSION["attendance_manage"]["center_id"];
	$user_id="";
	$date=date('d/m/Y');
}
?>
<div class="page-header">
	<h1 class="title"> Student's Attendance</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Attendance</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="attendance_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>        	
<form class="form-horizontal form-horizontal-left" role="form" action="attendance_manage.php?tab=add" method="post" enctype="multipart/form-data" name="frmAdd">
    <input type="hidden" name="center_id" id="id" value="<?php echo $center_id;?>">
    <input type="hidden" name="id" id="ida" value="">
    <div class="row">
        <div class="col-md-2"><input type="text" name="date" id="date" value="<?php echo $date?>" class="date-picker"></div>
        <div class="col-md-3">
            <select name="user_id" id="user_id" class="custom_select">
                <option value=""<?php echo ($user_id=="")? " selected":"";?>>Select Trainer</option>
                <?php
                $res=doquery("select a.* from users a left join users_2_center b on a.id = b.user_id where status = 1 and center_id = '".$center_id."' order by name",$dblink);
                if(numrows($res)>=0){
                    while($rec=dofetch($res)){
                    ?>
                    <option value="<?php echo $rec["id"]?>" <?php echo($user_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["name"])?></option>
                    <?php
                    }
                }	
                ?>
            </select>
        </div>
    </div>
    <style>
    .student_list{
        padding:10px;
        border:solid 1px;
        border-radius: 5px;
    }
    .student_item{
        display:block;
        padding:5px;
        border-bottom: solid 1px;
        cursor:pointer;
    }
    #present_list .student_item{ background-color:#CFF;}
    #absent_list .student_item{ background-color:#FCF;}
    </style>
    <div class="form-group" ng-app="attendance" ng-controller="attendanceController">
        <input type="hidden" name="students" id="present" value="{{students}}">
        <div class="row">
            <div class="col-sm-6">
                <h2>Present Students</h2>
                <div class="student_list" id="present_list">
                    <div ng-repeat="student in students|filter:{status:true}" class="student_item" ng-dblclick="student.status=!student.status">
                        <span>{{ $index+1 }}.</span> {{ student.name }}
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h2>Absent Students</h2>
                <div class="student_list" id="absent_list">
                    <div ng-repeat="student in students|filter:{status:false}" class="student_item" ng-dblclick="student.status=!student.status">
                        <span>{{ $index+1 }}</span> {{ student.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="attendance_add" title="Save Attendance">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Save Attendance
                </button>
            </div>
        </div>
    </div>
</form>