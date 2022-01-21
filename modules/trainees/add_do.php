<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["trainees_add"])){
	extract($_POST);
	$err="";
	if($center_ids=="" || empty($name) || empty($father_name) || empty($cnic) || empty($birth_date) || $gender=="")
		$err="Fields with (*) are Mandatory.<br />";
    if ( !empty($cnic) && !preg_match('/^\d{5}[-]\d{7}[-]\d{1}$/', $cnic))
        $err .= 'Invalid cnic<br>';
    if(numrows(doquery("select id from trainees where cnic='".slash($cnic)."'", $dblink))>0)
        $err.='CNIC already exists.<br />';
    if(get_age( date_dbconvert( $birth_date ), "") < 18 || get_age( date_dbconvert( $birth_date ), "") > 35)
        $err .= "Out of age.<br> Age is under (18 to 35)";

	if($err==""){
		$sql="INSERT INTO trainees (name, father_name, gender, cnic, birth_date, cnic_issue_date, contact, address1, address, trainee_status_id) VALUES ('".slash($name)."', '".slash($father_name)."', '".slash($gender)."', '".slash($cnic)."', '".date_dbconvert($birth_date)."', '".date_dbconvert($cnic_issue_date)."', '".slash($contact)."', '".slash($address1)."', '".slash($address)."', '".slash($trainee_status_id)."')";
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
		if(isset( $center_ids ) && count( $center_ids ) > 0 ) {
			foreach( $center_ids as $center_id ) {
				doquery( "insert into trainees_2_center(trainee_id, center_id) values( '".$id."', '".$center_id."' )", $dblink );
			}
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