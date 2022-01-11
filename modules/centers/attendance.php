<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title"> Student's Attendance</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Attendance</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> <a href="centers_manage.php" class="btn btn-light editproject">Back to List</a> </div>
  	</div>
</div>        	
<form class="form-horizontal form-horizontal-left" role="form" action="centers_manage.php?tab=attendance" method="post" enctype="multipart/form-data" name="frmAdd">
    <input type="hidden" name="id" id="id" value="<?php echo $id;?>">
    <input type="hidden" name="date" id="date" value="<?php echo $date;?>">
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
    <div class="clearfix form-actions">
        <div class="row">
            <div class="col-md-offset-3 col-md-9">
                <button class="btn btn-info" type="submit" name="attendance_save" title="Save Attendance">
                    <i class="ace-icon fa fa-check bigger-110"></i>
                    Save Attendance
                </button>
            </div>
        </div>
    </div>
</form>