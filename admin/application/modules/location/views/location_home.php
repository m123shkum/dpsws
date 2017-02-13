<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache"); 
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1><small>Manage Location</small></h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>        
        <li class="active"><i class="icon-file-alt"></i>Location</li>
      </ol>
      <div class="row-fluid">
        <div class="span6">              
          <div class="pull-right" style="max-width: 700px;">
            <label class="inner-label">Search by location:</label>
            <form id="search"  name="search" action="<?php echo site_url();?>location/search" method="get">
              <div class="input-group">
                  <input value="<?php if(isset($_GET['location_name'])){ echo $_GET['location_name'];}?>"  type="text" name="location_name" style="width:206px;" id="location_name" class="form-control serch-field">
                <input type="hidden" name="perpage" id="perpage">
                <select style="max-width:130px; margin-left: 10px;" class="form-control" name="are_name" id="are_name" onchange="locationshow(this.value);">
                    <option value="">-Select Area-</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='faridabad'){?> selected<?php }}?> value="faridabad">Faridabad</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='gurgaon'){?> selected<?php }}?> value="gurgaon">Gurgaon</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='delhi'){?> selected<?php }}?> value="delhi">Delhi</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='noida'){?> selected<?php }}?> value="noida">Noida</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='ghaziabad'){?> selected<?php }}?> value="ghaziabad">Ghaziabad</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='greater noida'){?> selected<?php }}?> value="greater noida">Greater Noida</option>                    
                </select>
                
                <button type="submit" class="btn sub-btn">Search</button>
              </div>
            </form>
          </div>
          
          <a style="text-decoration:none;" href="<?=base_url().'location/add'?>"><span class="btn add-btn"></span></a>

       
          <div class="sort-row">
          
            <label class="inner-label">Show:</label>
            <select onchange="perPage(this.value)" style="width:140px;" class="form-control per" name="per_page" id="per_page">
              <option <?php if($perpage==10) { echo 'selected="selected"';} ?> value="10">10</option>
              <option <?php if($perpage==20) { echo 'selected="selected"';} ?> value="20">20</option>
              <option <?php if($perpage==50) { echo 'selected="selected"';} ?> value="50">50</option>
              <option <?php if($perpage==100) { echo 'selected="selected"';} ?> value="100">100</option>
            </select>
          </div>
          
        </div>
        <div class="span6"> </div>
      </div>
      <div> </div>
      <div style="clear:both;"></div>

      <div class="pagination-wrp" style="border:none;">
        <?php  echo $links; ?>
      </div>
      <?php if($this->session->flashdata('success')){  echo $this->session->flashdata('success'); }  ?>
    </div>
  </div>
  <div class="panel panel-default"> 
    <!-- Default panel contents --> 
    
    <!-- Table -->
    <?php $class='style="background-color:#f5f5f5"'; $j=1; if(count($results) >0) {  ?>
    <table class="table">
      <tr <?php echo $class;?>>
        <td><strong>S.No</strong></td>
        <td><strong>Location</strong></td>
        <td><strong>City</strong></td>   
        <td>&nbsp;</td>  
      </tr>
      <?php 
       $k=$startlimit;
      foreach($results as $data) { if($j%2==0) { $class='style="background-color:#f5f5f5"'; } else { $class='style="background-color:#fff"';} 

      // $ress=$this->db->query("SELECT * from sch_zone where cityname=".$data['zone_locationid']."")->row_array();  
	$cityres=$this->db->query("SELECT * from sch_zone where zone_id=".$data['zone_locationid']."")->row_array();  
      $k++;
        ?>
      <tr <?php echo $class;?>>
        <td><?php echo $k;?></td>
        <td><?php echo ucfirst($data['location']);?></td>                
        <td><?php echo $cityres['cityname'];?></td>                
        <td>    
            <?php if($data['status']==1) {  ?>
           <a rel="tooltip" alt="Click for deactivate" onclick="return statusAdmin('<?=$data['zone_id']?>','0')" href="javascript:void(0);" class="btn btn-xs btn-info" data-original-title="Click for deactivate">
            <i class="glyphicon glyphicon-ok-sign">Active</i>
          </a>
         <?php }  else { ?>
            <a rel="tooltip" alt="Click for activate"  onclick="return statusAdmin('<?=$data['zone_id']?>','1')"   href="javascript:void()"  class="btn btn-xs btn-danger" title="Click for activate">
            <i class="glyphicon glyphicon-ok-circle">Inactive</i>
          </a>
         <?php } ?>
          <a rel="tooltip" alt="Update" href="<?=base_url()?>location/edit/<?=$data['zone_id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon glyphicon-edit"> Edit</i>
          </a>
          <button onclick="getVal(<?=$data['zone_id']?>)" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete1" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete</button>
           </td>
      </tr>
      <?php $j++; } ?>
    </table>
    <?php } else { echo "Sorry!! No result found.";} ?>
  </div>
  <div class="pagination-wrp">
    <?php echo $links;?>
  </div>
   <!--===================status changes form =====-->
    <form action="<?=base_url()?>location/changeStatus" method="post" id="cngststus">
           <input type="hidden" name="uid"  id="uid" value="">
           <input type="hidden" name="statustype"  id="statustype" value="">
           <input type="hidden" name="curl"  id="curl" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">

   </form>
  <!--===========================================--->

  <!--===========================================--->
<script type="text/javascript">
    function statusAdmin(id,s) {
document.getElementById("statustype").value=s;
document.getElementById("uid").value=id;
document.getElementById("cngststus").submit();
}

function perPage(val) { 
//var sort_by=document.getElementById("sort_by").value;

  window.location='<?=base_url()?>location/index/0/'+val+'/0'; 
}
function pageSort(sort_by) { 
	  window.location='<?=base_url()?>location/index/'+sort_by+'/0/0';
}
function serachAdmin()
{
	var search_text=document.getElementById("search_text").value;
	 search_text=search_text.replace(/\s+/g, '-').toLowerCase();
	 search_text=search_text.replace('@', '~')
     search_text=search_text.trim();
	window.location='<?=base_url()?>location/search/'+search_text+'/0';
	return false;
}
function getVal(id)
{
	
        document.getElementById("delid").value=id;
        
}
</script> 
  <!-- /.row --> 
  
</div>

<!-- Modal Dialog -->
<div class="modal fade" id="confirmDelete1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Delete Confirmation</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete ?</p>
      </div>
      <div class="modal-footer">
        <form action="<?=base_url()?>location/delete" method="post">           
           <input type="hidden" name="delid"  id="delid" value="">
           <input type="hidden" name="curl"  id="curl" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" id="confirm">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->
<?php $this->load->view('../common/footer_view');?>
