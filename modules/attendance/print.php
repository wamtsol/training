<?php
if(!defined("APP_START")) die("No Direct Access");
$sql="select a.* from trainees a left join trainees_2_center b on a.id = b.trainee_id where center_id = '".$center_id."' order by name";
$rs = doquery( $sql, $dblink );
$trainee_att = array();
$attendance = doquery("select * from attendance where center_id = '".$center_id."' order by date desc", $dblink);
if( numrows( $attendance ) > 0 ) {
    while( $attend = dofetch( $attendance ) ) {
        $trainee_att[] = $attend;
                        
    }
};        
?>
<link type="text/css" rel="stylesheet" href="css/font-awesome.min.css" />
<link type="text/css" rel="stylesheet" href="css/font-awesome.css" />
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
	<th colspan="50">
    	<!-- <h1><?php echo get_config( 'site_title' )?></h1> -->
    	<h2>Attendance List</h2>
        <p>
        	<?php
			echo "List of";
            if( !empty( $date_from ) || !empty( $date_to ) ){
                echo "<br />Date";
            }
            if( !empty( $date_from ) ){
                echo " from ".$date_from;
            }
            if( !empty( $date_to ) ){
                echo " to ".$date_to."<br>";
            }
            if( !empty( $project_id ) ){
                ?>
                Course: <?php echo get_field($project_id, "projects", "title" )."<br>";?>
                <?php
            }
            if( !empty( $center_id ) ){
                ?>
                Center: <?php echo get_field($center_id, "centers", "center" )."<br>";?>
                <?php
            }
			?>
        </p>
    </th>
</tr>
<tr>
    <th width="2%" class="text-center">S.No</th>
    <th>Trainee</th>
    <th width="12%">Father Name</th>
    <th width="12%">CNIC</th>
    <?php 
    foreach($trainee_att as $date){
        ?>
        <th width="10%"><?php echo $date["date"]?></th>
        <?php

    }
    ?>
    <th width="5%" class="text-center">Present</th>
    <th width="5%" class="text-center">Absent</th>
</tr>
<?php
if( numrows( $rs ) > 0 ) {
	$sn = 1;
	while( $r = dofetch( $rs ) ) {
        $attendance1 = doquery("select * from attendance a left join attendance_records b on a.id = b.attendance_id where center_id = '".$center_id."' and trainee_id = '".$r["id"]."'", $dblink);
        $st = [];
        foreach($trainee_att as $att){
            $attendance = dofetch(doquery("select * from attendance_records where attendance_id = '".$att["id"]."' and trainee_id = '".$r["id"]."'", $dblink));
            $st[] = $attendance;
        }
        ?>
		<tr>
            <td class="text-center"><?php echo $sn++?></td>
            <td><?php echo unslash($r["name"]);?></td>
            <td><?php echo unslash($r["father_name"]);?></td>
            <td><?php echo unslash($r["cnic"]);?></td>
            <?php 
            foreach($st as $s){
                ?>
                <td class="text-center"><?php echo $s?'<i class="fa fa-check" style="color: #0f0"></i>':'<i class="fa fa-close" style="color: #f00"></i>'?></td>
                <?php

            }
            ?>
            <td class="text-center"><?php echo numrows($attendance1)?></td>
            <td class="text-center"><?php echo count($st)-numrows($attendance1);?></td>
        </tr>
		<?php
	}
}
?>
</table>
<?php
die;