<?php
if(!defined("APP_START")) die("No Direct Access");  
$sql="select a.*, b.title, b.duration, b.total_batches, b.total_no_of_trainees, b.min_qualification from centers a inner join projects b on a.project_id = b.id where 1 $extra order by center";
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
.container{
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
}
.header-bottom {
    padding-top: 10px;
    padding-bottom: 10px;
    margin-bottom: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.logo-text {
    text-align: center;
}
.logo-text h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 300;
}
.logo-text h1 {
    margin: 0;
    font-size: 28px;
    text-transform: uppercase;
    font-weight: bold;
}
.logo-text h3 {
    margin: 0;
    font-size: 22px;
    text-transform: capitalize;
    line-height: 24px;
}
.logo-text {
    text-align: center;
}
.logo-text h2 {
    margin: 0;
    font-size: 26px;
    font-weight: 300;
}
.logo-text h1 {
    margin: 0;
    font-size: 28px;
    text-transform: uppercase;
    font-weight: bold;
}
.logo-text h3 {
    margin: 0;
    font-size: 22px;
    text-transform: capitalize;
    line-height: 24px;
}
</style>
<div id="header">
    <div class="container">
        <div class="header-bottom">
            <div class="logo">
                <img src="images/main-logo.png" />
            </div>
            <div class="logo-text">
                <h2>Project Management Unit</h2>
                <h1>Benazir Bhutto Shaheed</h1>
                <h3>Human Resource research & development board<br> livestock & fisheries department<br> government of sindh</h3>
            </div>
            <div class="logo">
                <img src="images/second-logo.png" />
            </div>
        </div>
    </div>
</div>
<table width="100%" cellspacing="0" cellpadding="0">
<tr class="head">
	<th colspan="10">
    	<h2>Inception Report</h2>
        <p>
        	<?php
			echo "List of";
            if( !empty( $department_id ) ){
                ?>
                Department: <?php echo get_field($department_id, "departments", "title" )."<br>";?>
                <?php
            }
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
    <th width="10%">District</th>
    <th width="10%">Prescribed Qualification</th>
    <th width="8%">Date of Start</th>
    <th width="12%">Date of Completed</th>
    <th width="10%">Selected</th>
    <th width="10%">Joined</th>
</tr>
<?php
$total_selected = $total_joined = 0;
if( numrows( $rs ) > 0 ) {
	$sn = 1;
	while( $r = dofetch( $rs ) ) {
        $selected_trainees = doquery("select a.* from trainees a inner join trainees_2_center b on a.id = b.trainee_id where center_id = '".$r["id"]."'", $dblink);
        $total_selected += numrows($selected_trainees);
        $joined_trainees = doquery("select a.* from trainees a inner join trainees_2_center b on a.id = b.trainee_id where a.trainee_status_id = 1 and center_id = '".$r["id"]."'", $dblink);
        $total_joined += numrows($joined_trainees);
        ?>
		<tr>
            <td class="text-center"><?php echo $sn++?></td>
            <td><?php echo unslash($r["title"]); ?></td>
            <td class="text-center"><?php echo unslash($r["duration"]); ?></td>
            <td><?php echo unslash($r["center"]);?></td>
            <td><?php echo get_field($r["district_id"], "districts", "name");?></td>
            <td>Literate</td>
            <td><?php echo date_convert($r["start_date"]);?></td>
            <td><?php echo date_convert($r["end_date"]);?></td>
            <td class="text-center"><?php echo numrows($selected_trainees);?></td>
            <td class="text-center"><?php echo numrows($joined_trainees);?></td>
        </tr>
		<?php
	}
}
?>
<tr>
    <th colspan="8" align="right">Total</th>
    <th><?php echo $total_selected;?></th>
    <th><?php echo $total_joined;?></th>
</tr>
</table>
<?php
die;