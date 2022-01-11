<?php
include("include/db.php");
include("include/utility.php");
include("include/session.php");
include("include/paging.php");
define("APP_START", 1);
$filename = 'centers_manage.php';
include("include/admin_type_access.php");
$tab_array=array("list", "add", "edit", "status", "delete", "bulk_action", "attendance", "trainee_list");
if(isset($_REQUEST["tab"]) && in_array($_REQUEST["tab"], $tab_array)){
	$tab=$_REQUEST["tab"];
}
else{
	$tab="list";
}

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
	case 'attendance':
		include("modules/centers/attendance_do.php");
	break;
	case "trainee_list":
		$id = slash( $_REQUEST[ "id" ] );
		$date = slash( $_REQUEST[ "date" ] );
		$student_list = array();
		$attendance = doquery( "select * from attendance a inner join admin b on a.user_id = b.id where center_id = '".$id."' and date='".date_dbconvert( $date )."'", $dblink );
		$students = doquery( "select b.* from trainees_2_center a inner join trainees b on a.trainee_id = b.id where center_id = '".$id."' and b.status=1 order by b.name", $dblink );
		if( numrows( $students ) > 0 ) {
			while( $student = dofetch( $students ) ){
				if( numrows($attendance) == 0 || numrows( doquery( "select * from attendance_records where trainee_id='".$student[ "id" ]."'", $dblink ) ) > 0 ) {
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
                    include("modules/centers/list.php");
                break;
                case 'add':
                    include("modules/centers/add.php");
                break;
                case 'edit':
                    include("modules/centers/edit.php");
                break;
				case 'attendance':
                    include("modules/centers/attendance.php");
                break;
            }
          ?>
    	</div>
  	</div>
</div>
<?php include("include/footer.php");?>