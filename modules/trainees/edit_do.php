<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["trainees_edit"])){
	extract($_POST);
	$err="";
	if(empty($name) || $gender=="")
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update trainees set `name`='".slash($name)."', `gender`='".slash($gender)."', `cnic`='".slash($cnic)."', `birth_date`='".date_dbconvert($birth_date)."' where id='".$id."'";
		doquery($sql,$dblink);
		if(!empty($_FILES["cnic_photo_front"]["tmp_name"]) || isset($delete_image_front)){
			$prev_icon=doquery("select cnic_photo_front from trainees where id=$id",$dblink);
			if(numrows($prev_icon)>0){
				$p_icon=dofetch($prev_icon);
				deleteFile($file_upload_root."trainee_cnic/".$p_icon["cnic_photo_front"]);
				$sql="Update trainees set cnic_photo_front='' where id='".$id."'";
				doquery($sql,$dblink);
			}
			if(!empty($_FILES["cnic_photo_front"]["tmp_name"])){
				$cnic_photo_front=getFilename($_FILES["cnic_photo_front"]["name"], $id."front");
				move_uploaded_file($_FILES["cnic_photo_front"]["tmp_name"], $file_upload_root."trainee_cnic/".$cnic_photo_front);
				$sql="Update trainees set cnic_photo_front='".slash($cnic_photo_front)."' where id='".$id."'";
				doquery($sql,$dblink);
			}
		}
		if(!empty($_FILES["cnic_photo_back"]["tmp_name"]) || isset($delete_image_back)){
			$prev_icon=doquery("select cnic_photo_back from trainees where id=$id",$dblink);
			if(numrows($prev_icon)>0){
				$p_icon=dofetch($prev_icon);
				deleteFile($file_upload_root."trainee_cnic/".$p_icon["cnic_photo_back"]);
				$sql="Update trainees set cnic_photo_back='' where id='".$id."'";
				doquery($sql,$dblink);
			}
			if(!empty($_FILES["cnic_photo_back"]["tmp_name"])){
				$cnic_photo_back=getFilename($_FILES["cnic_photo_back"]["name"], $id."back");
				move_uploaded_file($_FILES["cnic_photo_back"]["tmp_name"], $file_upload_root."trainee_cnic/".$cnic_photo_back);
				$sql="Update trainees set cnic_photo_back='".slash($cnic_photo_back)."' where id='".$id."'";
				doquery($sql,$dblink);
			}
		}
		unset($_SESSION["trainees_manage"]["edit"]);
		header('Location: trainees_manage.php?tab=list&msg='.url_encode("Successfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["trainees_manage"]["edit"][$key]=$value;
		header("Location: trainees_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from trainees where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
			$birth_date=date_convert($birth_date);
		if(isset($_SESSION["trainees_manage"]["edit"]))
			extract($_SESSION["trainees_manage"]["edit"]);
	}
	else{
		header("Location: trainees_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: trainees_manage.php?tab=list");
	die;
}