<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["attendance_add"])){
	$center_id = slash( $_POST[ "center_id" ] );
	$date = date_dbconvert( $_POST[ "date" ] );
	$students = json_decode($_POST["students"]);
	$attendance = doquery( "select * from attendance where center_id = '".$center_id."' and date='". $date."'", $dblink );
	$status = 1;
	//echo $_SESSION[ "logged_in_admin" ][ "linked_user" ];die;
	if( numrows( $attendance ) > 0 ) {
		$attendance = dofetch( $attendance );
		$attendance_id = $attendance["id"];
		
	}
	else {
		doquery( "insert into attendance(center_id, date, user_id) values('".$center_id."', '".$date."', '".$_SESSION[ "logged_in_admin" ][ "linked_user" ]."')", $dblink );
		$attendance_id = inserted_id();
	}
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
	
	header("Location: attendance_manage.php?tab=list&center_id=".$center_id."&msg=".url_encode( "Attendance has been taken successfully." ));
	die;
}