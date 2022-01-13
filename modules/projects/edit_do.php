<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["projects_edit"])){
	extract($_POST);
	$err="";
	if(empty($title))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update projects set `department_id`='".slash($department_id)."', `title`='".slash($title)."', `duration`='".slash($duration)."', `total_batches`='".slash($total_batches)."', `min_qualification`='".slash($min_qualification)."', `total_no_of_trainees`='".slash($total_no_of_trainees)."' where id='".$id."'";
		doquery($sql,$dblink);
		unset($_SESSION["projects_manage"]["edit"]);
		header('Location: projects_manage.php?tab=list&msg='.url_encode("Successfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["projects_manage"]["edit"][$key]=$value;
		header("Location: projects_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from projects where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
		if(isset($_SESSION["projects_manage"]["edit"]))
			extract($_SESSION["projects_manage"]["edit"]);
	}
	else{
		header("Location: projects_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: projects_manage.php?tab=list");
	die;
}