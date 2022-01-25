<?php
if(!defined("APP_START")) die("No Direct Access");
$rs = doquery( $sql, $dblink );
if(numrows($rs)>0){
    header('Content-Type: text/csv; charset=utf-8');
    header("Content-Disposition: attachment; filename=trainees.csv");
    $fh = fopen( 'php://output', 'w' );
    if( !empty( $center_id ) || !empty( $trainee_status_id ) || !empty( $project_id ) || !empty( $q ) ){
        fputcsv($fh,array('Course:',  get_field($project_id, "projects","title"), '', 'Batch:',  get_field($center_id, "centers","center"), '', 'Status:',  getStatusType($trainee_status_id), '', 'Search:',  $q));
    }
    fputcsv($fh,array('S.no','NAME','FATHER/HUSBAND NAME','CNIC','DOB','DOI','CONTACT','COURSE','TRAINEE STATUS'));
    $sn=1;
    while($r=dofetch($rs)){
        fputcsv($fh,array(
            $sn++,
            $r["name"],
            $r["father_name"],
            $r["cnic"],
            $r["birth_date"],
            $r["cnic_issue_date"],
            $r["contact"],
            $r["address"],
            getStatusType($r["trainee_status_id"])
        ));
    }
    fclose($fh);
}
die;
?>
