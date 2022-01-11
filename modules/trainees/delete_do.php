<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	$id=slash($_GET["id"]);
	$trainees = doquery( "select * from trainees where id = '".$id."' ", $dblink );
	if( numrows( $trainees ) > 0 ) {
		$trainee = dofetch( $trainees );
		deleteFile($file_upload_root."trainee_cnic/".$trainee["cnic_photo_front"]);
		deleteFile($file_upload_root."trainee_cnic/".$trainee["cnic_photo_back"]);
		doquery("delete from trainees where id='".$id."'",$dblink);
	}
	header("Location: trainees_manage.php");
	die;
}