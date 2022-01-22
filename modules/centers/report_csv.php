<?php
if(!defined("APP_START")) die("No Direct Access");
$rs = doquery( $sql, $dblink );
if(numrows($rs)>0){
    header('Content-Type: text/csv; charset=utf-8');
    header("Content-Disposition: attachment; filename=batches.csv");
    $fh = fopen( 'php://output', 'w' );
    if( !empty( $department_id ) || !empty( $project_id ) || !empty( $district_id ) || !empty( $incharge_user_id ) || !empty( $q ) ){
        fputcsv($fh,array('Department:',  get_field($department_id, "departments", "title"), '', 'Course:',  get_field($project_id, "projects", "title"), '', 'District:',  get_field($district_id, "districts", "name"), '', 'Select Incharge User:', get_field($incharge_user_id, "users", "name"), '', 'Search:',  $q));
    }
    fputcsv($fh,array('S.no','COURSE','DISTRICT','DURATION','TOTAL BATCHES','TOTAL TRAINEES','BATCH','MIN QUALIFICATION','INCHARGE USER'));
    $sn=1;
    while($r=dofetch($rs)){
        fputcsv($fh,array(
            $sn++,
            get_field($r["project_id"], "projects", "title"),
            get_field($r["district_id"], "districts", "name"),
            unslash($r["duration"]),
            unslash($r["total_batches"]),
            unslash($r["total_no_of_trainees"]),
            unslash($r["center"]),
            unslash($r["min_qualification"]),
            get_field($r["incharge_user_id"], "users", "name")
        ));
    }
    fclose($fh);
}
die;
?>
