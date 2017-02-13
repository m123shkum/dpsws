<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1><small>Manage Teacher Education</small></h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>teacher"><i class="icon-file-alt"></i>Teacher</a></li>
        <li class="active"><i class="icon-file-alt"></i>Education</li>
      </ol>
      <div class="row-fluid">
        <div class="span6">   
            <strong>(Add In descending order)</strong>
          <div class="pull-right">                      
          </div>
          
          <a style="text-decoration:none;" href="<?=base_url().'teacher/addeducation/'.$teacher_id;?>"><span class="btn add-btn"></span></a>
          
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
        <td><strong>Institution</strong></td>
         <td><strong>Board_university</strong></td>  
         <td><strong>Degree</strong></td> 
         <td></td>
         
      </tr>
      <?php foreach($results as $data) { if($j%2==0) { $class='style="background-color:#f5f5f5"'; } else { $class='style="background-color:#fff"';} 

	  ?>
      <tr <?php echo $class;?>>
        <td><?php echo $j;?></td>
        <td><?php echo ucfirst($data['institution']);?></td>        
        <td><?php echo ucfirst($data['board_university']);?></td>
        <td><?php echo ucfirst($data['degree']);?></td>
        <td>
          <a rel="tooltip" alt="Update" href="<?=base_url()?>teacher/editeducation/<?php echo $teacher_id?>/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
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
	window.location='<?=base_url()?>school/searchevent/<?php echo $teacher_id?>/'+search_text;
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
        <form action="<?=base_url()?>teacher/deleteeducation" method="post">
           <input type="hidden" name="teacher_id" value="<?php echo $teacher_id?>">  
           <input type="hidden" name="delid"  id="delid" value="">
           <input type="hidden" name="curl"  id="curl" value="<?php echo $_SERVER['REDIRECT_QUERY_STRING'];?>">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" id="confirm">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->
<?php $this->load->view('../common/footer_view');?>
