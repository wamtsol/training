<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["attendance_edit"])){
	$students = json_decode($_POST["students"]);
	extract($_POST);
	//$attendance = doquery( "select * from attendance where id = '".$id."'", $dblink );
	$status = 1;
	// if( numrows( $attendance ) > 0 ) {
	// 	$attendance = dofetch( $attendance );
	// 	$attendance_id = $attendance["id"];
	// 	$center_id = $center["id"];
		
	// }
	foreach( $students as $student ) {
		if( $student->status ) {
			if( numrows( doquery( "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$id."'", $dblink ) ) == 0 ) {
				doquery( "insert into attendance_records(attendance_id, trainee_id) values( '".$id."', '".$student->id."')", $dblink );
			}
		}
		else {
			$rs = doquery( "select * from attendance_records where trainee_id='".$student->id."' and attendance_id='".$id."'", $dblink );
			if( numrows( $rs ) > 0 ) {
				$r = dofetch( $rs );
				doquery( "delete from attendance_records where attendance_id='".$id."'", $dblink );
			}
		}
	}
	
	header("Location: attendance_manage.php?tab=list&center_id=".$center_id."&msg=".url_encode( "Attendance has been taken successfully." ));
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