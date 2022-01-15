<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_POST["centers_edit"])){
	extract($_POST);
	$err="";
	if(empty($center))
		$err="Fields with (*) are Mandatory.<br />";
	if($err==""){
		$sql="Update centers set `project_id`='".slash($project_id)."', `district_id`='".slash($district_id)."', `center`='".slash($center)."', `incharge_user_id`='".slash($incharge_user_id)."', `end_date`='".date_dbconvert($end_date)."', `start_date`='".date_dbconvert($start_date)."' where id='".$id."'";
		doquery($sql,$dblink);
		unset($_SESSION["centers_manage"]["edit"]);
		header('Location: centers_manage.php?tab=list&msg='.url_encode("Successfully Updated"));
		die;
	}
	else{
		foreach($_POST as $key=>$value)
			$_SESSION["centers_manage"]["edit"][$key]=$value;
		header("Location: centers_manage.php?tab=edit&err=".url_encode($err)."&id=$id");
		die;
	}
}
/*----------------------------------------------------------------------------------*/
if(isset($_GET["id"]) && $_GET["id"]!=""){
	$rs=doquery("select * from centers where id='".slash($_GET["id"])."'",$dblink);
	if(numrows($rs)>0){
		$r=dofetch($rs);
		foreach($r as $key=>$value)
			$$key=htmlspecialchars(unslash($value));
			$end_date = date_convert($end_date);
			$start_date = date_convert($start_date);
		if(isset($_SESSION["centers_manage"]["edit"]))
			extract($_SESSION["centers_manage"]["edit"]);
	}
	else{
		header("Location: centers_manage.php?tab=list");
		die;
	}
}
else{
	header("Location: centers_manage.php?tab=list");
	die;
}