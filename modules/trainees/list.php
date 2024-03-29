<?php
if(!defined("APP_START")) die("No Direct Access");
?>
<div class="page-header">
	<h1 class="title">Trainees</h1>
  	<ol class="breadcrumb">
    	<li class="active">Manage Trainees</li>
  	</ol>
  	<div class="right">
    	<div class="btn-group" role="group" aria-label="..."> 
        	<a href="trainees_manage.php?tab=add" class="btn btn-light editproject <?php if(get_field($center_id, "centers",  "end_date")<date("Y-m-d") && $_SESSION["logged_in_admin"]["admin_type_id"]!=1){?>disabled<?php }?>">Add New Trainee</a> 
            <a id="topstats" class="btn btn-light" href="#"><i class="fa fa-search"></i></a>
            <a class="btn print-btn" href="trainees_manage.php?tab=report_csv">CSV</a>
            <a class="btn print-btn" href="trainees_manage.php?tab=print"><i class="fa fa-print" aria-hidden="true"></i></a>
    	</div> 
    </div> 
</div>
<ul class="topstats clearfix search_filter"<?php if($is_search) echo ' style="display: block"';?>>
    <li class="col-xs-12 col-lg-12 col-sm-12">
    	<div>
        	<form class="form-horizontal" action="" method="get">
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
                	<select name="trainee_status_id" id="trainee_status_id" title="Choose Option">
                        <option value="">Select Status</option>
                        <option value="1" <?php echo($trainee_status_id==1)?"selected":"";?>>Clear</option>
                        <option value="2" <?php echo($trainee_status_id==2)?"selected":"";?>>Already Registered</option>
                        <option value="3" <?php echo($trainee_status_id==3)?"selected":"";?>>Invalid Cnic</option>
                        <option value="4" <?php echo($trainee_status_id==4)?"selected":"";?>>Not Joined</option>
                    </select>
                </div>
                <div class="col-sm-2">
                  <input type="text" title="Enter String" value="<?php echo $q;?>" name="q" id="search" class="form-control" >  
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
                <th class="text-center" width="3%"><div class="checkbox checkbox-primary">
                    <input type="checkbox" id="select_all" value="0" title="Select All Records">
                    <label for="select_all"></label></div></th>
                <th width="15%">Name</th>
                <th width="15%">Father/Husband Name</th>
                <th width="8%">CNIC</th>
                <th width="8%">DOB</th>
                <th width="8%">DOI</th>
                <th width="8%">Contact</th>
                <th width="10%">Course</th>
                <th width="10%">District</th>
                <th width="10%">Trainee Status</th>
                <th width="5%" class="text-center">Status</th>
                <th width="8%" class="text-center">Actions</th>
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
                        <td><?php echo unslash($r["name"]);?></td>
                        <td><?php echo unslash($r["father_name"]);?></td>
                        <td><?php echo unslash($r["cnic"]);?></td>
                        <td><?php echo date_convert($r["birth_date"]);?></td>
                        <td><?php echo date_convert($r["cnic_issue_date"]);?></td>
                        <td><?php echo unslash($r["contact"]);?></td>
                        <td><?php echo unslash($r["address"]);?></td>
                        <td><?php echo '--';?></td>
                        <td><?php echo getStatusType($r["trainee_status_id"]);?></td>
                        <td class="text-center">
                            <a href="trainees_manage.php?id=<?php echo $r['id'];?>&tab=status&s=<?php echo ($r["status"]==0)?1:0;?>">
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
                            <?php if($_SESSION["logged_in_admin"]["admin_type_id"]==1){?>
                            <a href="trainees_manage.php?tab=edit&id=<?php echo $r['id'];?>"><img title="Edit Record" alt="Edit" src="images/edit.png"></a>&nbsp;&nbsp;
                            <a onclick="return confirm('Are you sure you want to delete')" href="trainees_manage.php?id=<?php echo $r['id'];?>&amp;tab=delete"><img title="Delete Record" alt="Delete" src="images/delete.png"></a>
                            <?php if($r["trainee_status_id"]==1){?><a href="trainees_manage.php?tab=offer_letter&id=<?php echo $r['id'];?>"><img title="Print Letter" alt="Edit" src="images/view.png"></a><?php }?>
                            <?php } else{ echo "--";}?>
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
                    <td colspan="5" class="paging" title="Paging" align="right"><?php echo pages_list($rows, "trainees", $sql, $pageNum)?></td>
                </tr>
                <?php	
            }
            else{	
                ?>
                <tr>
                    <td colspan="10"  class="no-record">No Result Found</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
     </table>
</div>