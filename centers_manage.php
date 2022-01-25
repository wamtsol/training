<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'centers_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "add", "edit", "status", "delete", "bulk_action", "report", "inception_report", "report_csv");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}
$q="";
$extra='';
$is_search=false;
if(isset($_GET["department_id"])){
    $department_id=slash($_GET["department_id"]);
    $_SESSION["centers_manage"]["department_id"]=$department_id;
}
if(isset($_SESSION["centers_manage"]["department_id"])){
    $department_id=$_SESSION["centers_manage"]["department_id"];
}
else{
    $department_id="";
}
if($department_id!=""){
    $extra.=" and department_id='".$department_id."'";
    $is_search=true;
}

if(isset($_GET["project_id"])){
	$project_id=slash($_GET["project_id"]);
	$_SESSION["centers_manage"]["project_id"]=$project_id;
}
if(isset($_SESSION["centers_manage"]["project_id"])){
    $project_id=$_SESSION["centers_manage"]["project_id"];
}
else{
    $project_id="";
}
if($project_id!=""){
	$extra.=" and project_id='".$project_id."'";
	$is_search=true;
}
if(isset($_GET["district_id"])){
	$district_id=slash($_GET["district_id"]);
	$_SESSION["centers_manage"]["district_id"]=$district_id;
}
if(isset($_SESSION["centers_manage"]["district_id"])){
    $district_id=$_SESSION["centers_manage"]["district_id"];
}
else{
    $district_id="";
}
if($district_id!=""){
	$extra.=" and district_id='".$district_id."'";
	$is_search=true;
}
if(isset($_GET["incharge_user_id"])){
	$incharge_user_id=slash($_GET["incharge_user_id"]);
	$_SESSION["centers_manage"]["incharge_user_id"]=$incharge_user_id;
}
if(isset($_SESSION["centers_manage"]["incharge_user_id"])){
    $incharge_user_id=$_SESSION["centers_manage"]["incharge_user_id"];
}
else{
    $incharge_user_id = $_SESSION["logged_in_admin"]["linked_user"];
}
if($incharge_user_id!=""){
	$extra.=" and incharge_user_id='".$incharge_user_id."'";
	$is_search=true;
}
if(isset($_GET["q"])){
	$q=slash($_GET["q"]);
	$_SESSION["centers_manage"]["q"]=$q;
}
if(isset($_SESSION["centers_manage"]["q"])){
    $q=$_SESSION["centers_manage"]["q"];
}
else{
    $q="";
}
if(!empty($q)){
	$extra.=" and center like '%".$q."%'";
	$is_search=true;
}
$adminId = '';
$depId = '';
$linkedUser='';
if($_SESSION["logged_in_admin"]["admin_type_id"]!=1){
	$adminId = "and admin_type_id = '".$_SESSION["logged_in_admin"]["admin_type_id"]."'";
	$depId = "and department_id = '".$department_id."'";
	$linkedUser = "and id = '".$_SESSION["logged_in_admin"]["linked_user"]."'";
}
$sql="select a.*, b.title, b.duration, b.total_batches, b.total_no_of_trainees, b.min_qualification from centers a inner join projects b on a.project_id = b.id where 1 $extra order by center";
switch($tab){
	case 'add':
		include("modules/centers/add_do.php");
	break;
	case 'edit':
		include("modules/centers/edit_do.php");
	break;
	case 'delete':
		include("modules/centers/delete_do.php");
	break;
	case 'status':
		include("modules/centers/status_do.php");
	break;
	case 'bulk_action':
		include("modules/centers/bulkactions.php");
	break;
	case 'report':
		include("modules/centers/report.php");
	break;
	case 'inception_report':
		include("modules/centers/inception_report.php");
	break;
    case 'report_csv':
        include("modules/centers/report_csv.php");
    break;
}
?>
<?php include("include/header.php");?>
	<div class="container-widget row">
    	<div class="col-md-12">
		  <?php
            switch($tab){
                case 'list':
                    include("modules/centers/list.php");
                break;
                case 'add':
                    include("modules/centers/add.php");
                break;
                case 'edit':
                    include("modules/centers/edit.php");
                break;
            }
          ?>
    	</div>
  	</div>
</div>
<?php include("include/footer.php");?>