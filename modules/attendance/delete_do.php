<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	doquery("delete from attendance where id='".slash($_GET["id"])."'",$dblink);
	doquery( "delete from attendance_records where attendance_id='".slash($_GET["id"])."'", $dblink );
	header("Location: attendance_manage.php");
	die;
}