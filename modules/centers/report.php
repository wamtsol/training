<?php
if(!defined("APP_START")) die("No Direct Access");  
$rs = doquery($sql, $dblink);    
?>
<style>
h1, h2, h3, p {
    margin: 0 0 10px;
}

body {
    margin:  0;
    font-family:  Arial;
    font-size:  11px;
}
.head th, .head td{ border:0;}
th, td {
    border: solid 1px #000;
    padding: 5px 5px;
    font-size: 14px;
	vertical-align:top;
    font-weight: bold;
}
table table th, table table td{
	padding:3px;
}
table {
    border-collapse:  collapse;
	max-width:1200px;
	margin:0 auto;
}
.text-center{ text-align:center}
.text-right{ text-align:right}
.nastaleeq{font-family: 'NafeesRegular'; direction:rtl; unicode-bidi: embed; text-align:right; font-size: 18px;  }
</style>
<table width="100%" cellspacing="0" cellpadding="0">
<tr class="head">
	<th colspan="10">
    	<h1><?php echo get_config( 'site_title' )?></h1>
    	<h2>Progress Report</h2>
        <p>
        	<?php
			echo "List of";
            if( !empty( $project_id ) ){
                ?>
                Course: <?php echo get_field($project_id, "projects", "title" )."<br>";?>
                <?php
            }
            if( !empty( $district_id ) ){
                ?>
                District: <?php echo get_field($district_id, "districts", "name" )."<br>";?>
                <?php
            }
			?>
        </p>
    </th>
</tr>
<tr>
    <th width="2%" class="text-center">S.No</th>
    <th width="15%">Course</th>
    <th width="12%">District</th>
    <th width="8%" class="text-center">Duration</th>
    <th width="8%" class="text-center">Total batches</th>
    <th width="8%" class="text-center">Total trainees</th>
    <th width="10%" class="text-center">No of Batch Completed</th>
    <th width="10%" class="text-center">No of Trainee Trained</th>
    <th width="10%" class="text-center">Remaining Batch</th>
    <th width="10%" class="text-center">Remaining Trainee to be trained</th>
    <th width="10%">Batch</th>
    <th width="15%">Min Qualification</th>
    <th width="15%">Incharge User</th>
</tr>
<?php
$total_batches = $total_trainees = 0;
if( numrows( $rs ) > 0 ) {
	$sn = 1;
	while( $r = dofetch( $rs ) ) {
        $total_batches += $r["total_batches"];
        $total_trainees += $r["total_no_of_trainees"];
        $completed_batch = dofetch(doquery("select count(id) as count from centers where status = 1 and end_date < '".date('Y-m-d')."' and id = '".$r['id']."'", $dblink));
        $trained = dofetch(doquery("select count(a.id) as count from trainees a inner join trainees_2_center b on a.id = b.trainee_id inner join centers c on b.center_id = c.id where trainee_status_id = 1 and end_date < '".date('Y-m-d')."' and center_id = '".$r['id']."'", $dblink));
        ?>
		<tr>
            <td class="text-center"><?php echo $sn++?></td>
            <td><?php echo unslash($r["title"]); ?></td>
            <td><?php echo get_field($r["district_id"], "districts", "name");?></td>
            <td class="text-center"><?php echo unslash($r["duration"]); ?></td>
            <td class="text-center"><?php echo unslash($r["total_batches"]); ?></td>
            <td class="text-center"><?php echo unslash($r["total_no_of_trainees"]);?></td>
            <td class="text-center"><?php echo $completed_batch["count"];?></td>
            <td class="text-center"><?php echo $trained["count"];?></td>
            <td class="text-center"><?php echo $r["total_batches"]-$completed_batch["count"];?></td>
            <td class="text-center"><?php echo $r["total_no_of_trainees"]-$trained["count"];?></td>
            <td><?php echo unslash($r["center"]); ?></td>
            <td><?php echo unslash($r["min_qualification"]); ?></td>
            <td><?php echo get_field($r["incharge_user_id"], "users", "name"); ?></td>
        </tr>
		<?php
	}
}
?>
<tr>
    <th class="text-right" colspan="4">Total</th>
    <th><?php echo $total_batches;?></th>
    <th><?php echo $total_trainees;?></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
</tr>
</table>
<?php
die;