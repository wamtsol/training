<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["centers_add"])){
	extract($_POST);
	$err="";
	if(empty($center))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO centers (project_id, district_id, center, incharge_user_id) VALUES ('".slash($project_id)."', '".slash($district_id)."', '".slash($center)."', '".slash($incharge_user_id)."')";
		doquery($sql,$dblink);
		unset($_SESSION["centers_manage"]["add"]);
		header('Location: centers_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["centers_manage"]["add"][$key]=$value;
		header('Location: centers_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}