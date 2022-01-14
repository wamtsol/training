<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["users_add"])){
	extract($_POST);
	$err="";
	if(empty($name) || $gender=="")
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO users (designation_id, name, gender, cnic, appointment_date, releaving_date) VALUES ('".slash($designation_id)."', '".slash($name)."', '".slash($gender)."', '".slash($cnic)."', '".date_dbconvert($appointment_date)."', '".date_dbconvert($releaving_date)."')";
		doquery($sql,$dblink);
		$id=inserted_id();
		if(isset( $center_ids ) && count( $center_ids ) > 0 ) {
			foreach( $center_ids as $center_id ) {
				doquery( "insert into users_2_center(user_id, center_id) values( '".$id."', '".$center_id."' )", $dblink );
			}
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