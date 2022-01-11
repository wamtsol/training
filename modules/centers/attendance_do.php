<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["attendance_save"])){
	$id = slash( $_POST[ "id" ] );
	$date = date_dbconvert( $_POST[ "date" ] );
	$students = json_decode($_POST["students"]);
	$attendance = doquery( "select * from attendance a inner join admin b on a.user_id = b.id where center_id = '".$id."' and date='". $date."'", $dblink );
	$status = 1;
	if( numrows( $attendance ) > 0 ) {
		$attendance = dofetch( $attendance );
		$attendance_id = $attendance["id"];
		
	}
	else {
		doquery( "insert into attendance(center_id, date, user_id) values('".$id."', '".$date."', '".$_SESSION[ "logged_in_admin" ][ "id" ]."')", $dblink );
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
	
	header("Location: centers_manage.php?tab=list&msg=".url_encode( "Attendance has been taken successfully." ));
	die;
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$sql="select * from centers where id = '".slash($_GET["id"])."'";
	$rs=doquery($sql,$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
		$date = slash( $_GET[ "date" ] );
	}
	else{
		header("Location: centers_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: centers_manage.php?tab=list");
	die;
}