<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["trainees_edit"])){
	extract($_POST);
	$err="";
	if($center_ids=="" || empty($name) || empty($father_name) || empty($cnic) || empty($birth_date) || $gender=="")
		$err="Fields with (*) are Mandatory.<br />";
    if ( !empty($cnic) && !preg_match('/^\d{5}[-]\d{7}[-]\d{1}$/', $cnic))
        $err .= 'Invalid cnic<br>';
    if(numrows(doquery("select id from trainees where cnic='".slash($cnic)."' and id<>'".$id."'", $dblink))>0)
        $err.='CNIC already exists.<br />';
    if(get_age( date_dbconvert( $birth_date ), "") < 18 || get_age( date_dbconvert( $birth_date ), "") > 35)
        $err .= "Out of age.<br> Age is under (18 to 35)";
    
	if($err==""){
		$sql="Update trainees set `name`='".slash($name)."', `father_name`='".slash($father_name)."', `gender`='".slash($gender)."', `cnic`='".slash($cnic)."', `birth_date`='".date_dbconvert($birth_date)."', `cnic_issue_date`='".date_dbconvert($cnic_issue_date)."', `contact`='".slash($contact)."', `address1`='".slash($address1)."', `address`='".slash($address)."', `trainee_status_id`='".slash($trainee_status_id)."' where id='".$id."'";
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
		doquery("delete from trainees_2_center where trainee_id='".$id."'", $dblink);
		if(isset( $center_ids ) && count( $center_ids ) > 0 ) {
			foreach( $center_ids as $center_id ) {
				doquery( "insert into trainees_2_center(trainee_id, center_id) values( '".$id."', '".$center_id."' )", $dblink );
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
            $cnic_issue_date=date_convert($cnic_issue_date);
			$center_ids = array();
			$sql="select * from trainees_2_center where trainee_id='".$id."'";
			$rs1 = doquery( $sql, $dblink );
			if( numrows( $rs1 ) > 0 ) {
				while( $r1 = dofetch( $rs1 ) ) {
					$center_ids[] = $r1[ "center_id" ];
				}
			}
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