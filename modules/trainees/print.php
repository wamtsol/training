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
	<th colspan="12">
    	<h2>Trainees Report</h2>
        <p>
        	<?php
			echo "List of";
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
    <th width="15%">Name</th>
    <th width="15%">Father/Husband Name</th>
    <th width="8%">CNIC</th>
    <th width="8%">DOB</th>
    <th width="8%">DOI</th>
    <th width="8%">Contact</th>
    <th width="10%">Course</th>
    <th width="10%">District</th>
    <th width="10%">Trainee Status</th>
</tr>
<?php
$total_batches = $total_trainees = 0;
if( numrows( $rs ) > 0 ) {
	$sn = 1;
	while( $r = dofetch( $rs ) ) {
        ?>
		<tr>
            <td class="text-center"><?php echo $sn++?></td>
            <td><?php echo unslash($r["name"]);?></td>
            <td><?php echo unslash($r["father_name"]);?></td>
            <td><?php echo unslash($r["cnic"]);?></td>
            <td><?php echo date_convert($r["birth_date"]);?></td>
            <td><?php echo date_convert($r["cnic_issue_date"]);?></td>
            <td><?php echo unslash($r["contact"]);?></td>
            <td><?php echo unslash($r["address"]);?></td>
            <td><?php echo '--';?></td>
            <td><?php echo getStatusType($r["trainee_status_id"]);?></td>
        </tr>
		<?php
	}
}
?>
</table>
<?php
die;