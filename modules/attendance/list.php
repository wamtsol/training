<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title">Attendance</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Attendance</li>
  	</ol>
    <div class="right">
    	<div class="btn-group" role="group" aria-label="..."> 
        	<a href="attendance_manage.php?tab=add" class="btn btn-light editproject">Add New Attendance</a> 
            <a id="topstats" class="btn btn-light" href="#"><i class="fa fa-search"></i></a> 
            <a class="btn print-btn" href="attendance_manage.php?tab=print" target="_blank"><i class="fa fa-print" aria-hidden="true"></i></a>
    	</div> 
    </div>
</div>
<ul class="topstats clearfix search_filter"<?php if($is_search) echo ' style="display: block"';?>>
    <li class="col-xs-12 col-lg-12 col-sm-12">
    	<div>
        	<form class="form-horizontal" action="" method="get">
                <div class="col-sm-2">
                	<select name="project_id" id="project_id" class="custom_select select_multiple">
                        <option value=""<?php echo ($project_id=="")? " selected":"";?>>Select Project</option>
                        <?php
                        $res=doquery("select * from projects where status = 1 order by title",$dblink);
                        if(numrows($res)>=0){
                            while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>" <?php echo($project_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"]);?></option>
                            <?php
                            }
                        }	
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <select name="center_id" id="center_id" class="custom_select select_multiple">
                        <option value=""<?php echo ($center_id=="")? " selected":"";?>>Select Batch</option>
                        <?php
                        $res=doquery("select * from centers where status = 1 order by center",$dblink);
                        if(numrows($res)>=0){
                            while($rec=dofetch($res)){
                                ?>
                                <option value="<?php echo $rec["id"]?>" <?php echo($center_id==$rec["id"])?"selected":"";?>><?php echo get_field($rec["district_id"], "districts", "name")." ".unslash($rec["center"])?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                  <input type="text" title="Enter Date From" value="<?php echo $date_from;?>" name="date_from" id="search" class="form-control date-picker">  
                </div>
                <div class="col-sm-2">
                  <input type="text" title="Enter Date To" value="<?php echo $date_to;?>" name="date_to" id="search" class="form-control date-picker">  
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
                            $count = dofetch( doquery( "select count(1) from trainees_2_center inner join trainees on trainees_2_center.trainee_id = trainees.id where center_id = '".$r[ "center_id" ]."' and trainee_status_id = 1", $dblink ) );
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
                            <a href="attendance_manage.php?tab=edit&id=<?php echo $r['id'];?>"><img title="Edit Record" alt="Edit" src="images/edit.png"></a>&nbsp;&nbsp;
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