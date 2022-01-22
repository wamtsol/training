<?php
if(!defined("APP_START")) die("No Direct Access");

?>
<div class="page-header">
	<h1 class="title">Batches</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Batches</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> 
        	<a href="centers_manage.php?tab=add" class="btn btn-light editproject">Add New Batch</a> 
            <a id="topstats" class="btn btn-light" href="#"><i class="fa fa-search"></i></a> 
            <a class="btn print-btn" href="centers_manage.php?tab=report"><i class="fa fa-print" aria-hidden="true"></i></a>
            <a class="btn btn-sm btn-white" href="centers_manage.php?tab=inception_report">Inception Report</a>
            <a class="btn print-btn" href="centers_manage.php?tab=report_csv">CSV</a>
    	</div> 
    </div> 
</div>
<ul class="topstats clearfix search_filter"<?php if($is_search) echo ' style="display: block"';?>>
    <li class="col-xs-12 col-lg-12 col-sm-12">
    	<div>
        	<form class="form-horizontal" action="" method="get">
                <div class="col-sm-2">
                    <select name="department_id" id="department_id" class="custom_select select_multiple">
                        <option value=""<?php echo ($department_id=="")? " selected":"";?>>Select Department</option>
                        <?php
                        $res=doquery("select a.* from departments a $admin_type_department where a.status = 1 order by title",$dblink);
                        if(numrows($res)>=0){
                            while($rec=dofetch($res)){
                                ?>
                                <option value="<?php echo $rec["id"]?>" <?php echo($department_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"])?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                	<select name="project_id" id="project_id" class="custom_select select_multiple">
                        <option value=""<?php echo ($project_id=="")? " selected":"";?>>Select Course</option>
                        <?php
                        $res=doquery("select * from projects where status = 1 order by title",$dblink);
                        if(numrows($res)>=0){
                            while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>" <?php echo($project_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["title"])?></option>
                            <?php
                            }
                        }	
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                	<select name="district_id" id="district_id" class="custom_select select_multiple">
                        <option value=""<?php echo ($district_id=="")? " selected":"";?>>Select District</option>
                        <?php
                        $res=doquery("select * from districts where status = 1 order by name",$dblink);
                        if(numrows($res)>=0){
                            while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>" <?php echo($district_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["name"])?></option>
                            <?php
                            }
                        }	
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                	<select name="incharge_user_id" id="incharge_user_id" class="custom_select select_multiple">
                    <?php if($_SESSION["logged_in_admin"]["admin_type_id"]==1){?> <option value=""<?php echo ($incharge_user_id=="")? " selected":"";?>>Select Incharge User</option><?php }?>
                        <?php
                        $res=doquery("select * from users where status = 1 and id = '".$_SESSION["logged_in_admin"]["linked_user"]."' order by name",$dblink);
                        if(numrows($res)>=0){
                            while($rec=dofetch($res)){
                            ?>
                            <option value="<?php echo $rec["id"]?>" <?php echo($district_id==$rec["id"])?"selected":"";?>><?php echo unslash($rec["name"])?></option>
                            <?php
                            }
                        }	
                        ?>
                    </select>
                </div>
                <div class="col-sm-2">
                  <input type="text" title="Enter String" value="<?php echo $q;?>" name="q" id="search" class="form-control" >  
                </div>
                <div class="col-sm-2 text-left">
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
                <th class="text-center" width="3%"><div class="checkbox checkbox-primary">
                    <input type="checkbox" id="select_all" value="0" title="Select All Records">
                    <label for="select_all"></label></div></th>
                <th width="15%">Course</th>
                <th width="12%">District</th>
                <th width="8%">Duration</th>
                <th width="8%">Total batches</th>
                <th width="8%">Total trainees</th>
                <th width="10%">Batch</th>
                <th width="15%">Min Qualification</th>
                <th width="15%">Incharge User</th>
                <th width="8%">Trainers</th>
                <th width="8%">Trainees</th>
                <th width="10%">Attendance</th>
                <th width="5%" class="text-center">Status</th>
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
                        <td class="text-center"><div class="checkbox margin-t-0 checkbox-primary">
                            <input type="checkbox" name="id[]" id="<?php echo "rec_".$sn?>"  value="<?php echo $r["id"]?>" title="Select Record" />
                            <label for="<?php echo "rec_".$sn?>"></label></div>
                        </td>
                        <td><?php echo get_field($r["project_id"], "projects", "title");?></td>
                        <td><?php echo get_field($r["district_id"], "districts", "name");?></td>
                        <td><?php echo (unslash($r["duration"])?:'--');?></td>
                        <td><?php echo (unslash($r["total_batches"])?:'--');?></td>
                        <td><?php echo (unslash($r["total_no_of_trainees"])?:'--');?></td>
                        <td><?php echo (unslash($r["center"])?:'--'); ?></td>
                        <td><?php echo (unslash($r["min_qualification"])?:'--'); ?></td>
                        <td><?php echo get_field($r["incharge_user_id"], "users", "name"); ?></td>
                        <td><a href="users_manage.php?center_id=<?php echo $r["id"]?>" class="btn btn-sm btn-primary fancybox_iframe">Trainers</a></td>
                        <td><a href="trainees_manage.php?center_id=<?php echo $r["id"]?>" class="btn btn-sm btn-primary fancybox_iframe">Trainees</a></td>
                        <td><a href="attendance_manage.php?tab=list&center_id=<?php echo $r["id"]?>" class="btn btn-sm btn-primary fancybox_iframe">Attendance</a></td>
                        <td class="text-center">
                            <a href="centers_manage.php?id=<?php echo $r['id'];?>&tab=status&s=<?php echo ($r["status"]==0)?1:0;?>">
                                <?php
                                if($r["status"]==0){
                                    ?>
                                    <img src="images/offstatus.png" alt="Off" title="Set Status On">
                                    <?php
                                }
                                else{
                                    ?>
                                    <img src="images/onstatus.png" alt="On" title="Set Status Off">
                                    <?php
                                }
                                ?>
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="centers_manage.php?tab=edit&id=<?php echo $r['id'];?>"><img title="Edit Record" alt="Edit" src="images/edit.png"></a>&nbsp;&nbsp;
                            <a onclick="return confirm('Are you sure you want to delete')" href="centers_manage.php?id=<?php echo $r['id'];?>&amp;tab=delete"><img title="Delete Record" alt="Delete" src="images/delete.png"></a>
                        </td>
                    </tr>  
                    <?php 
                    $sn++;
                }
                ?>
                <tr>
                    <td colspan="8" class="actions">
                        <select name="bulk_action" class="" id="bulk_action" title="Choose Action">
                            <option value="null">Bulk Action</option>
                            <option value="delete">Delete</option>
                            <option value="statuson">Set Status On</option>
                            <option value="statusof">Set Status Off</option>
                        </select>
                        <input type="button" name="apply" value="Apply" id="apply_bulk_action" class="btn btn-light" title="Apply Action"  />
                    </td>
                    <td colspan="7" class="paging" title="Paging" align="right"><?php echo pages_list($rows, "centers", $sql, $pageNum)?></td>
                </tr>
                <?php	
            }
            else{	
                ?>
                <tr>
                    <td colspan="15"  class="no-record">No Result Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
     </table>
</div>