<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["designations_add"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO designations (title) VALUES ('".slash($title)."')";
		doquery($sql,$dblink);
		unset($_SESSION["designations_manage"]["add"]);
		header('Location: designations_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["designations_manage"]["add"][$key]=$value;
		header('Location: designations_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}