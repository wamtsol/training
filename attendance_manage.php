<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'attendance_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "add", "edit", "delete", "trainee_list");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}

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
		$students = doquery( "select b.* from trainees_2_center a inner join trainees b on a.trainee_id = b.id where center_id = '".$center_id."' and b.status=1 order by b.name", $dblink );
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
					"status" => $status
				);
			}
		}
		echo json_encode($student_list);
		die;
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