<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	doquery("delete from centers where id='".slash($_GET["id"])."'",$dblink);
	header("Location: centers_manage.php");
	die;
}