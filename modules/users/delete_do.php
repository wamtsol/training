<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["id"]) && !empty($_GET["id"])){
	$id=slash($_GET["id"]);
	$users = doquery( "select * from users where id = '".$id."' ", $dblink );
	if( numrows( $users ) > 0 ) {
		$user = dofetch( $users );
		doquery("delete from users_2_center where user_id='".$id."'",$dblink);
		doquery("delete from users where id='".$id."'",$dblink);
	}
	header("Location: users_manage.php");
	die;
}