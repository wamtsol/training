<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'trainees_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "add", "edit", "status", "delete", "bulk_action", "offer_letter", "report_csv", "print");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}
$q="";
$qr="";
$extra='';
$is_search=false;
if(isset($_GET["center_id"])){
    $center_id=slash($_GET["center_id"]);
    $_SESSION["trainees_manage"]["center_id"]=$center_id;
}
if(isset($_SESSION["trainees_manage"]["center_id"])){
    $center_id=$_SESSION["trainees_manage"]["center_id"];
}
else{
    $center_id="";
}
if($center_id!=""){
    $extra.=" and center_id='".$center_id."'";
    $is_search=true;
}
if(isset($_GET["project_id"])){
    $project_id=slash($_GET["project_id"]);
    $_SESSION["trainees_manage"]["project_id"]=$project_id;
}
if(isset($_SESSION["trainees_manage"]["project_id"])){
    $project_id=$_SESSION["trainees_manage"]["project_id"];
}
else{
    $project_id="";
}
if($project_id!=""){
    $qr="left join centers c on c.id = b.center_id";
    $extra.=" and c.project_id='".$project_id."'";
    $is_search=true;
}
if(isset($_GET["trainee_status_id"])){
    $trainee_status_id=slash($_GET["trainee_status_id"]);
    $_SESSION["trainees_manage"]["list"]["trainee_status_id"]=$trainee_status_id;
}
if(isset($_SESSION["trainees_manage"]["list"]["trainee_status_id"]))
    $trainee_status_id=$_SESSION["trainees_manage"]["list"]["trainee_status_id"];
else
    $trainee_status_id="";
if($trainee_status_id!=""){
    $extra.=" and trainee_status_id='".$trainee_status_id."'";
    $is_search=true;
}
if(isset($_GET["q"])){
    $q=slash($_GET["q"]);
    $_SESSION["trainees_manage"]["q"]=$q;
}
if(isset($_SESSION["trainees_manage"]["q"])){
    $q=$_SESSION["trainees_manage"]["q"];
}
else{
    $q="";
}
if(!empty($q)){
    $extra.=" and name like '%".$q."%' || cnic like '%".$q."%'";
    $is_search=true;
}
$sql="select a.* from trainees a left join trainees_2_center b on a.id = b.trainee_id $qr where 1 $extra order by name";
switch($tab){
	case 'add':
		include("modules/trainees/add_do.php");
	break;
	case 'edit':
		include("modules/trainees/edit_do.php");
	break;
	case 'delete':
		include("modules/trainees/delete_do.php");
	break;
	case 'status':
		include("modules/trainees/status_do.php");
	break;
	case 'bulk_action':
		include("modules/trainees/bulkactions.php");
	break;
	case 'offer_letter':
		include("modules/trainees/offer_letter.php");
	break;
    case 'report_csv':
        include("modules/trainees/report_csv.php");
    break;
    case 'print':
        include("modules/trainees/print.php");
    break;
}
?>
<?php include("include/header.php");?>
	<div class="container-widget row">
    	<div class="col-md-12">
		  <?php
            switch($tab){
                case 'list':
                    include("modules/trainees/list.php");
                break;
                case 'add':
                    include("modules/trainees/add.php");
                break;
                case 'edit':
                    include("modules/trainees/edit.php");
                break;
            }
          ?>
    	</div>
  	</div>
</div>
<?php include("include/footer.php");?>