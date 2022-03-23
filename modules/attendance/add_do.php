<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["attendance_add"])){
	extract($_POST);
	$err="";
	if(numrows(doquery("select id from attendance where date='".date_dbconvert($date)."'", $dblink))>0)
		$err='Date already exists.<br />';
	$students = json_decode($_POST["students"]);
	$status = 1;
	if($err==""){
		doquery( "insert into attendance(center_id, date, user_id) values('".$center_id."', '".date_dbconvert($date)."', '".$user_id."')", $dblink );
		$attendance_id = inserted_id();
	
		foreach( $students as $student ) {
			if( $student->status ) {
				if( numrows( doquery( "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$attendance_id."'", $dblink ) ) == 0 ) {
					doquery( "insert into attendance_records(attendance_id, trainee_id) values( '".$attendance_id."', '".$student->id."')", $dblink );
				}
			}
			else {
				$rs = doquery( "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$attendance_id."'", $dblink );
				if( numrows( $rs ) > 0 ) {
					$r = dofetch( $rs );
					doquery( "delete from attendance_records where attendance_id='".$attendance_id."'", $dblink );
				}
			}
		}
		header("Location: attendance_manage.php?tab=list&msg=".url_encode( "Attendance has been taken successfully." ));
	}
	else{
		
		header('Location: attendance_manage.php?tab=add&err='.url_encode($err));
		die;
	}
	die;
}