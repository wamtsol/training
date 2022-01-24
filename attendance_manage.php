<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'attendance_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "add", "edit", "delete", "trainee_list", "print");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}
$q="";
$extra='';
$is_search=false;
if(isset($_GET["project_id"])){
    $project_id=slash($_GET["project_id"]);
	$_SESSION["attendance_manage"]["project_id"]=$project_id;
}
if(isset($_SESSION["attendance_manage"]["project_id"])){
    $project_id=$_SESSION["attendance_manage"]["project_id"];
}
else{
    $project_id="";
}
if($project_id!=""){
	$extra.=" and project_id='".$project_id."'";
	$is_search=true;
}
if(isset($_GET["center_id"])){
    $center_id=slash($_GET["center_id"]);
    $_SESSION["attendance_manage"]["center_id"]=$center_id;
}
if(isset($_SESSION["attendance_manage"]["center_id"])){
    $center_id=$_SESSION["attendance_manage"]["center_id"];
}
else{
    $center_id="";
}
if($center_id!=""){
    $extra.=" and center_id='".$center_id."'";
    $is_search=true;
}
if( isset($_GET["date_from"]) ){
	$_SESSION["attendance_manage"]["date_from"] = $_GET["date_from"];
}
if(isset($_SESSION["attendance_manage"]["date_from"]) && !empty($_SESSION["attendance_manage"]["date_from"])){
	$date_from = $_SESSION["attendance_manage"]["date_from"];
}
else{
	$date_from = date("01/m/Y");
}
if( !empty($date_from) ){
	$extra.=" and date>='".date("Y/m/d", strtotime(date_dbconvert($date_from)))."'";
	$is_search=true;
}
if( isset($_GET["date_to"]) ){
	$_SESSION["attendance_manage"]["date_to"] = $_GET["date_to"];
}
if(isset($_SESSION["attendance_manage"]["date_to"]) && !empty($_SESSION["attendance_manage"]["date_to"])){
	$date_to = $_SESSION["attendance_manage"]["date_to"];
}
else{
	$date_to = date("d/m/Y");
}
if( !empty($date_to) ){
	$extra.=" and date<='".date_dbconvert($date_to)."'";
	$is_search=true;
}
$sql="select a.*  from attendance a left join centers c on a.center_id = c.id where 1 $extra order by date desc";
switch($tab){
	case 'add':
		include("modules/attendance/add_do.php");
	break;
	case 'edit':
		include("modules/attendance/edit_do.php");
	break;
	case 'delete':
		include("modules/attendance/delete_do.php");
	break;
	case "trainee_list":
		$center_id = slash( $_REQUEST[ "center_id" ] );
		$id = $_REQUEST[ "id" ]?slash( $_REQUEST[ "id" ] ):'';
		$date = slash( $_REQUEST[ "date" ] );
		$student_list = array();
		if(!empty($id)){
			$attendance = doquery( "select * from attendance where id = '".$id."' and center_id = '".$center_id."' and date='".date_dbconvert( $date )."'", $dblink );
		}
		else{
			$attendance = doquery( "select * from attendance where center_id = '".$center_id."' and date='".date_dbconvert( $date )."'", $dblink );
		}
		$students = doquery( "select b.* from trainees_2_center a inner join trainees b on a.trainee_id = b.id where center_id = '".$center_id."' and b.status=1 and b.trainee_status_id=1 order by b.name", $dblink );
		if( numrows( $students ) > 0 ) {
			while( $student = dofetch( $students ) ){
				if( numrows($attendance) == 0 || numrows( doquery( "select * from attendance_records where trainee_id='".$student[ "id" ]."'".(!empty($id)? "and `attendance_id`='".slash($id)."'":"")."", $dblink ) ) > 0 ) {
					$status = true;
				}
				else {
					$status = false;
				}
				$student_list[] = array(
					"id" => $student[ "id" ],
					"name" => unslash( $student[ "name" ] ),
					"father_name" => unslash( $student[ "father_name" ] ),
					"status" => $status
				);
			}
		}
		echo json_encode($student_list);
		die;
	break;
	case 'print':
		include("modules/attendance/print.php");
	break;
	
}
?>
<?php include("include/header.php");?>
	<div class="container-widget row">
    	<div class="col-md-12">
		  <?php
            switch($tab){
                case 'list':
                    include("modules/attendance/list.php");
                break;
                case 'edit':
                    include("modules/attendance/edit.php");
                break;
				case 'add':
                    include("modules/attendance/add.php");
                break;
            }
          ?>
    	</div>
  	</div>
</div>
<?php include("include/footer.php");?>