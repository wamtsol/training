<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["departments_edit"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update departments set `title`='".slash($title)."' where id='".$id."'";
		doquery($sql,$dblink);
		unset($_SESSION["departments_manage"]["edit"]);
		header('Location: departments_manage.php?tab=list&msg='.url_encode("Successfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["departments_manage"]["edit"][$key]=$value;
		header("Location: departments_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from departments where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
		if(isset($_SESSION["departments_manage"]["edit"]))
			extract($_SESSION["departments_manage"]["edit"]);
	}
	else{
		header("Location: departments_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: departments_manage.php?tab=list");
	die;
}