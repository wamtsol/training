<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["departments_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO departments (title, admin_type_id) VALUES ('".slash($title)."', '".slash($admin_type_id)."')";
		doquery($sql,$dblink);
		unset($_SESSION["departments_manage"]["add"]);
		header('Location: departments_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["departments_manage"]["add"][$key]=$value;
		header('Location: departments_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}