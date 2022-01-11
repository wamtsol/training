<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["trainees_add"])){
	extract($_POST);
	$err="";
	if(empty($name) || $gender=="")
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO trainees (name, gender, cnic, birth_date) VALUES ('".slash($name)."', '".slash($gender)."', '".slash($cnic)."', '".date_dbconvert($birth_date)."')";
		doquery($sql,$dblink);
		$id=inserted_id();
		if(!empty($_FILES["cnic_photo_front"]["tmp_name"])){
			$cnic_photo_front=getFilename($_FILES["cnic_photo_front"]["name"], $id."front");
			move_uploaded_file($_FILES["cnic_photo_front"]["tmp_name"], $file_upload_root."trainee_cnic/".$cnic_photo_front);
			$sql="Update trainees set cnic_photo_front='".$cnic_photo_front."' where id=$id";
			doquery($sql,$dblink);
		}
		if(!empty($_FILES["cnic_photo_back"]["tmp_name"])){
			$cnic_photo_back=getFilename($_FILES["cnic_photo_back"]["name"], $id."back");
			move_uploaded_file($_FILES["cnic_photo_back"]["tmp_name"], $file_upload_root."trainee_cnic/".$cnic_photo_back);
			$sql="Update trainees set cnic_photo_back='".$cnic_photo_back."' where id=$id";
			doquery($sql,$dblink);
		}
		unset($_SESSION["trainees_manage"]["add"]);
		header('Location: trainees_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["trainees_manage"]["add"][$key]=$value;
		header('Location: trainees_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}