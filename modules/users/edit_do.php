<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["users_edit"])){
	extract($_POST);
	$err="";
	if(empty($name))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update users set `designation_id`='".slash($designation_id)."', `name`='".slash($name)."', `gender`='".slash($gender)."', `cnic`='".slash($cnic)."', `appointment_date`='".date_dbconvert($appointment_date)."' where id='".$id."'";
		doquery($sql,$dblink);
		if(!empty($_FILES["cnic_photo_front"]["tmp_name"]) || isset($delete_image_front)){
			$prev_icon=doquery("select cnic_photo_front from users where id=$id",$dblink);
			if(numrows($prev_icon)>0){
				$p_icon=dofetch($prev_icon);
				deleteFile($file_upload_root."user_cnic/".$p_icon["cnic_photo_front"]);
				$sql="Update users set cnic_photo_front='' where id='".$id."'";
				doquery($sql,$dblink);
			}
			if(!empty($_FILES["cnic_photo_front"]["tmp_name"])){
				$cnic_photo_front=getFilename($_FILES["cnic_photo_front"]["name"], $id."front");
				move_uploaded_file($_FILES["cnic_photo_front"]["tmp_name"], $file_upload_root."user_cnic/".$cnic_photo_front);
				$sql="Update users set cnic_photo_front='".slash($cnic_photo_front)."' where id='".$id."'";
				doquery($sql,$dblink);
			}
		}
		if(!empty($_FILES["cnic_photo_back"]["tmp_name"]) || isset($delete_image_back)){
			$prev_icon=doquery("select cnic_photo_back from users where id=$id",$dblink);
			if(numrows($prev_icon)>0){
				$p_icon=dofetch($prev_icon);
				deleteFile($file_upload_root."user_cnic/".$p_icon["cnic_photo_back"]);
				$sql="Update users set cnic_photo_back='' where id='".$id."'";
				doquery($sql,$dblink);
			}
			if(!empty($_FILES["cnic_photo_back"]["tmp_name"])){
				$cnic_photo_back=getFilename($_FILES["cnic_photo_back"]["name"], $id."back");
				move_uploaded_file($_FILES["cnic_photo_back"]["tmp_name"], $file_upload_root."user_cnic/".$cnic_photo_back);
				$sql="Update users set cnic_photo_back='".slash($cnic_photo_back)."' where id='".$id."'";
				doquery($sql,$dblink);
			}
		}
		doquery("delete from users_2_center where user_id='".$id."'", $dblink);
		if(isset( $center_ids ) && count( $center_ids ) > 0 ) {
			foreach( $center_ids as $center_id ) {
				doquery( "insert into users_2_center(user_id, center_id) values( '".$id."', '".$center_id."' )", $dblink );
			}
		}
		unset($_SESSION["users_manage"]["edit"]);
		header('Location: users_manage.php?tab=list&msg='.url_encode("Successfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["users_manage"]["edit"][$key]=$value;
		header("Location: users_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from users where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
			$appointment_date=date_convert($appointment_date);
			$center_ids = array();
			$sql="select * from users_2_center where user_id='".$id."'";
			$rs1 = doquery( $sql, $dblink );
			if( numrows( $rs1 ) > 0 ) {
				while( $r1 = dofetch( $rs1 ) ) {
					$center_ids[] = $r1[ "center_id" ];
				}
			}
		if(isset($_SESSION["users_manage"]["edit"]))
			extract($_SESSION["users_manage"]["edit"]);
	}
	else{
		header("Location: users_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: users_manage.php?tab=list");
	die;
}