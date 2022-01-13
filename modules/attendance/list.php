<?php
if(!defined("APP_START")) die("No Direct Access");
if(isset($_GET["center_id"]) && !empty($_GET["center_id"])){
    $center=dofetch(doquery("select * from centers where id='".slash($_GET["center_id"])."'", $dblink)); 
}
$q="";
$extra='';
$is_search=false;
if(isset($_GET["date"])){
	$date=slash($_GET["date"]);
	$_SESSION["attendance_manage"]["date"]=$date;
}
if(isset($_SESSION["attendance_manage"]["date"])){
    $date=$_SESSION["attendance_manage"]["date"];
}
else{
    $date=date("d/m/Y");
}
if(!empty($date)){
	$extra.=" and date = '".date_dbconvert($date)."'";
	$is_search=true;
}
?>
<div class="page-header">
	<h1 class="title">Attendance</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Attendance</li>
  	</ol>
    <div class="right">
    	<div class="btn-group" role="group" aria-label="..."> 
        	<a href="attendance_manage.php?tab=add&center_id=<?php echo $center["id"]?>&date=<?php echo $date?>" class="btn btn-light editproject">Add New Attendance</a> 
            <a id="topstats" class="btn btn-light" href="#"><i class="fa fa-search"></i></a> 
    	</div> 
    </div>
</div>
<ul class="topstats clearfix search_filter"<?php if($is_search) echo ' style="display: block"';?>>
    <li class="col-xs-12 col-lg-12 col-sm-12">
    	<div>
        	<form class="form-horizontal" action="" method="get">
                <input type="hidden" name="center_id" value="<?php echo $center["id"];?>">
                <div class="col-sm-2">
                  <input type="text" title="Enter Date" value="<?php echo $date;?>" name="date" id="search" class="form-control date-picker">  
                </div>
                <div class="col-sm-3 text-left">
                    <input type="button" class="btn btn-danger btn-l reset_search" value="Reset" alt="Reset Record" title="Reset Record" />
                    <input type="submit" class="btn btn-default btn-l" value="Search" alt="Search Record" title="Search Record" />
                </div>
            </form>
        </div>
  	</li>
</ul>
<div class="panel-body table-responsive">
	<table class="table table-hover list">
    	<thead>
            <tr>
                <th width="2%" class="text-center">S.No</th>
                <th width="15%">Date</th>
                <th width="12%">Total Trainees</th>
                <th width="12%">Present Trainees</th>
                <th width="20%" class="text-center">Status</th>
                <th width="5%" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql="select * from attendance where center_id = '".$center["id"]."' $extra order by date desc";
            $rs=show_page($rows, $pageNum, $sql);
            if(numrows($rs)>0){
                $sn=1;
                while($r=dofetch($rs)){             
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $sn;?></td>
                        <td><?php echo date_convert($r["date"]); ?></td>
                        <td>
                            <?php
                            $count = dofetch( doquery( "select count(1) from trainees_2_center where center_id = '".$r[ "center_id" ]."'", $dblink ) );
                            echo $count[ "count(1)" ];
                            ?>
                        </td>
                        <td>
                            <?php
                            $count = dofetch( doquery( "select count(1) from attendance_records a inner join trainees_2_center b on a.trainee_id = b.trainee_id where center_id = '".$r[ "center_id" ]."' and attendance_id='".$r["id"]."'", $dblink ) );
                            echo $count[ "count(1)" ];
                            ?>
                        </td>
                        <td class="text-center">
                            <?php
                                echo '<i class="fa fa-check" style="color: #0f0"></i> Attendance Taken by '.get_field($r["user_id"], "users", "name");
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="attendance_manage.php?tab=edit&center_id=<?php echo $r['center_id'];?>&id=<?php echo $r['id'];?>&date=<?php echo $r['date'];?>"><img title="Edit Record" alt="Edit" src="images/edit.png"></a>&nbsp;&nbsp;
                            <a onclick="return confirm('Are you sure you want to delete')" href="attendance_manage.php?id=<?php echo $r['id'];?>&amp;tab=delete"><img title="Delete Record" alt="Delete" src="images/delete.png"></a>
                        </td>
                    </tr>  
                    <?php 
                    $sn++;
                }
                ?>
                <?php	
            }
            else{	
                ?>
                <tr>
                    <td colspan="6"  class="no-record">No Result Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
     </table>
</div>