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
    	<h2>Attendance Report</h2>
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
            if( !empty( $incharge_user_id ) ){
                ?>
                <?php echo " Prepared by (Designation): ".get_field( get_field( $incharge_user_id, "users", "designation_id" ), "designations", "title" );?>
                <?php
            }
			?>
        </p>
    </th>
</tr>
<tr>
    <th width="2%" class="text-center">S.No</th>
    <th>Name of Trade</th>
    <th width="8%" class="text-center">Duration</th>
    <th width="12%">Name of Institute</th>
    <th width="12%">Prescribed Qualification</th>
    <th width="8%">Date of Start</th>
    <th width="10%">Selected</th>
    <th width="10%">Joined</th>
    <th width="12%">Date of Completed</th>
</tr>
<?php
if( numrows( $rs ) > 0 ) {
	$sn = 1;
	while( $r = dofetch( $rs ) ) {
        $selected_trainees = doquery("select a.* from trainees a inner join trainees_2_center b on a.id = b.trainee_id where a.trainee_status_id = 1 and center_id = '".$r["id"]."'", $dblink);
        ?>
		<tr>
            <td class="text-center"><?php echo $sn++?></td>
            <td><?php echo unslash($r["title"]); ?></td>
            <td class="text-center"><?php echo unslash($r["duration"]); ?></td>
            <td><?php echo get_field($r["district_id"], "districts", "name");?></td>
            <td>Literate</td>
            <td><?php echo date_convert($r["start_date"]);?></td>
            <td class="text-center"><?php echo numrows($selected_trainees);?></td>
            <td class="text-center"></td>
            <td><?php echo date_convert($r["end_date"]);?></td>
        </tr>
		<?php
	}
}
?>
</table>
<?php
die;