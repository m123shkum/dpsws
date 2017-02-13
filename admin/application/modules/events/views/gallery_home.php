<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1><small>Manage Event Gallery</small></h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url();?>events"><i class="icon-file-alt"></i>Event</a></li>
        <li class="active"><i class="icon-file-alt"></i>Gallery</li>
      </ol>
      <div class="row-fluid">
        <div class="span6">                       
          
          <a style="text-decoration:none;" href="<?=base_url().'events/addgallery/'.$event_id;?>"><span class="btn add-btn"></span></a>
          
          
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
        <td><strong>Image Title</strong></td>
        <td><strong>Image</strong></td>  
         <td><strong>Order</strong></td>                  
         <td>&nbsp;</td> 
         
      </tr>
      <?php foreach($results as $data) { if($j%2==0) { $class='style="background-color:#f5f5f5"'; } else { $class='style="background-color:#fff"';} 

	  ?>
      <tr <?php echo $class;?>>
        <td><?php echo $j;?></td>
        <td><?php echo ucwords($data['image_title']);?></td>        
        <td>
        <img src="<?php echo SiteUrl?>timthumb.php?src=<?php echo SiteUrl?>public/eventimage/<?php echo $data['image']?>&w=140&h=135" />
        </td>
        <td><?php echo $data['ord'];?></td>
        <td> 
            <?php if($data['status']==1) {  ?>
           <a rel="tooltip" alt="Click for deactivate" onclick="return statusAdmin('<?=$data['id']?>','0')" href="javascript:void(0);" class="btn btn-xs btn-info" data-original-title="Click for deactivate">
            <i class="glyphicon glyphicon-ok-sign">Active</i>
          </a>
         <?php }  else { ?>
            <a rel="tooltip" alt="Click for activate"  onclick="return statusAdmin('<?=$data['id']?>','1')"   href="javascript:void()"  class="btn btn-xs btn-danger" title="Click for activate">
            <i class="glyphicon glyphicon-ok-circle">Inactive</i>
          </a>
         <?php } ?>
            
          <a rel="tooltip" alt="Update" href="<?=base_url()?>events/editgallery/<?php echo $event_id?>/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon glyphicon-edit"> Edit</i>
          </a>
          <button onclick="getVal(<?=$data['id']?>)" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete1" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete</button>
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
    <form action="<?=base_url()?>events/changeStatus_gallery" method="post" id="cngststus">
           <input type="hidden" name="uid"  id="uid" value="">
           <input type="hidden" name="event_id"  id="event_id" value="<?php echo $event_id?>">
           <input type="hidden" name="statustype"  id="statustype" value="">
           <input type="hidden" name="curl"  id="curl" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">

   </form>
  <!--===========================================--->
<script type="text/javascript">
function statusAdmin(id,s) {
document.getElementById("statustype").value=s;
document.getElementById("uid").value=id;
document.getElementById("cngststus").submit();
}
function perPage(val) { 
var sort_by=document.getElementById("sort_by").value;

  window.location='<?=base_url()?>school/index/'+sort_by+'/'+val+'/0'; 
}
function pageSort(sort_by) { 
	  window.location='<?=base_url()?>school/index/'+sort_by+'/0/0';
}
function serachAdmin()
{
	var search_text=document.getElementById("search_text").value;
	 search_text=search_text.replace(/\s+/g, '-').toLowerCase();
	 search_text=search_text.replace('@', '~')
     search_text=search_text.trim();
	window.location='<?=base_url()?>school/searchevent/<?php echo $event_id?>/'+search_text;
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
        <form action="<?=base_url()?>school/deletegallery" method="post">
           <input type="hidden" name="event_id" value="<?php echo $event_id?>">  
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
