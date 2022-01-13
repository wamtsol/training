<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["attendance_edit"])){
	extract($_POST);
	$students = json_decode($_POST["students"]);
	$status = 1;
	doquery("Update attendance set `center_id`='".slash($center_id)."', `date`='".date_dbconvert($date)."', `user_id`='".slash($user_id)."' where id='".$id."'", $dblink);
	foreach( $students as $student ) {
		if( $student->status ) {
			if( numrows( doquery( "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$id."'", $dblink ) ) == 0 ) {
				doquery( "insert into attendance_records(attendance_id, trainee_id) values( '".$id."', '".$student->id."')", $dblink );
			}
		}
		else{
			//echo "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$id."'";die;
			$rs = doquery( "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$id."'", $dblink );
			if( numrows( $rs ) > 0 ) {
				$r = dofetch( $rs );
				doquery( "delete from attendance_records where attendance_id='".$id."'", $dblink );
			}
		}
		
	}
	
	header("Location: attendance_manage.php?tab=list&msg=".url_encode( "Attendance has been taken successfully." ));
	die;
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$sql="select * from attendance where id = '".slash($_GET["id"])."'";
	$rs=doquery($sql,$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
	}
	else{
		header("Location: attendance_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: attendance_manage.php?tab=list");
	die;
}