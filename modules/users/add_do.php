<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["users_add"])){
	extract($_POST);
	$err="";
	if(empty($name) || $gender=="")
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO users (designation_id, name, gender, cnic, appointment_date) VALUES ('".slash($designation_id)."', '".slash($name)."', '".slash($gender)."', '".slash($cnic)."', '".date_dbconvert($appointment_date)."')";
		doquery($sql,$dblink);
		$id=inserted_id();
		if(!empty($_FILES["cnic_photo_front"]["tmp_name"])){
			$cnic_photo_front=getFilename($_FILES["cnic_photo_front"]["name"], $id."front");
			move_uploaded_file($_FILES["cnic_photo_front"]["tmp_name"], $file_upload_root."user_cnic/".$cnic_photo_front);
			$sql="Update users set cnic_photo_front='".$cnic_photo_front."' where id=$id";
			doquery($sql,$dblink);
		}
		if(!empty($_FILES["cnic_photo_back"]["tmp_name"])){
			$cnic_photo_back=getFilename($_FILES["cnic_photo_back"]["name"], $id."back");
			move_uploaded_file($_FILES["cnic_photo_back"]["tmp_name"], $file_upload_root."user_cnic/".$cnic_photo_back);
			$sql="Update users set cnic_photo_back='".$cnic_photo_back."' where id=$id";
			doquery($sql,$dblink);
		}
		unset($_SESSION["users_manage"]["add"]);
		header('Location: users_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["users_manage"]["add"][$key]=$value;
		header('Location: users_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}