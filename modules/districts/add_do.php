<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["districts_add"])){
	extract($_POST);
	$err="";
	if(empty($name))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="INSERT INTO districts (name) VALUES ('".slash($name)."')";
		doquery($sql,$dblink);
		unset($_SESSION["districts_manage"]["add"]);
		header('Location: districts_manage.php?tab=list&msg='.url_encode("Successfully Added"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["districts_manage"]["add"][$key]=$value;
		header('Location: districts_manage.php?tab=add&err='.url_encode($err));
		die;
	}
}