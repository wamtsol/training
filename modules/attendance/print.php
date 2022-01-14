<?php
if(!defined("APP_START")) die("No Direct Access");
$sql="select a.* from trainees a left join trainees_2_center b on a.id = b.trainee_id where center_id = '".$center_id."' order by name";
$rs = doquery( $sql, $dblink );
$trainee_att = array();
$attendance = doquery("select * from attendance where center_id = '".$center_id."'", $dblink);
if( numrows( $attendance ) > 0 ) {
    while( $attend = dofetch( $attendance ) ) {
        //print_r($attendance_date);
        $trainee_att[] = $attend;
    }
};   
//print_r($trainee_att);die;       
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
</style>
<table width="100%" cellspacing="0" cellpadding="0">
<tr class="head">
	<th colspan="10">
    	<h1><?php echo get_config( 'site_title' )?></h1>
    	<h2>Attendance List</h2>
        <p>
        	<?php
			echo "List of";
            
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
    <?php 
    foreach($trainee_att as $date){
        ?>
        <th width="5%"><?php echo $date["date"]?></th>
        <?php

    }
    ?>
    <th width="5%">Absent</th>
</tr>
<?php
if( numrows( $rs ) > 0 ) {
	$sn = 1;
	while( $r = dofetch( $rs ) ) {
        foreach($trainee_att as $att){
            // print_r($att);
        $attendance = doquery("select * from attendance_records where attendance_id = '".$att["id"]."' and trainee_id = '".$r["id"]."'", $dblink);
        }
        ?>
		<tr>
            <td class="text-center"><?php echo $sn++?></td>
            <td><?php echo unslash($r["name"]);?></td>
            <?php 
    foreach($trainee_att as $date){
        ?>
            <td><i class="fa fa-check" style="color: #0f0"></i></td>
            <?php

    }
    ?>
            <td></td>
        </tr>
		<?php
	}
}
?>
</table>
<?php
die;