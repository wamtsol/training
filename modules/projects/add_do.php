<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["projects_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO projects (department_id, title) VALUES ('".slash($department_id)."', '".slash($title)."')";
		doquery($sql,$dblink);
		unset($_SESSION["projects_manage"]["add"]);
		header('Location: projects_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["projects_manage"]["add"][$key]=$value;
		header('Location: projects_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}