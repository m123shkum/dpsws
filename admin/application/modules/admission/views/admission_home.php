<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1><small>Manage Admission</small></h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>        
        <li class="active"><i class="icon-file-alt"></i>Admission</li>
      </ol>
      <div class="row-fluid">
        <div class="span6">              
            <div class="pull-right" style="max-width: 595px;">
            <label class="inner-label">Search by Applicant name OR School name :</label>
            <form  name="search" action="" method="post">
              <div class="input-group">
                <input type="text" name="search_text" style="width:206px;" id="search_text" value="<?php if(isset( $search_text)) { echo $search_text; } ?>" class="form-control serch-field"><button type="submit" onclick="return serachAdmin()" class="btn sub-btn">Search</button>
              </div>
            </form>
          </div>
       
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
        <td><strong>Applicant Name</strong></td>
        <td><strong>School Name</strong></td>
        <td><strong>DOB</strong></td>        
        <td><strong>Contact No</strong></td>
        <td><strong>Apply Date</strong></td>
        <td><strong>Application</strong></td>
        <td></td>
      </tr>
      <?php 
      $k=$startlimit;
      foreach($results as $data) { if($j%2==0) { $class='style="background-color:#f5f5f5"'; } else { $class='style="background-color:#fff"';} 
          $k++;            
	  ?>
      <tr <?php echo $class;?>>
        <td><?php echo $k;?></td>
        <td><?php echo ucfirst($data['fname']." ".$data['lname']);?></td>  
        <td><?php echo ucfirst($data['school_name']);?></td>
        <td><?php echo ucfirst($data['dob']);?></td>        
        <td><?php echo $data['contactno'];?></td>
        <td><?php echo date("d M Y",strtotime($data['apply_date']));?></td>
        <td>           
            <a rel="tooltip" target="blank" href="<?=SiteUrl?>public/child_pdf/<?=$data['child_pdf']?>" data-original-title="Update">
            <img src="<?php echo base_url()?>public/images/pdf.png"/>
          </a>
          
        </td>
        <td><button onclick="getVal(<?=$data['aplyid']?>)" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete1" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete</button></td>
      </tr>
      <?php $j++; } ?>
    </table>
    <?php } else { echo "Sorry!! No result found.";} ?>
  </div>
  <div class="pagination-wrp">
    <?php echo $links;?>
  </div>
   
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

  window.location='<?=base_url()?>admission/index/'+val+'/0'; 
}
function pageSort(sort_by) { 
	  window.location='<?=base_url()?>admission/index/'+sort_by+'/0/0';
}
function serachAdmin()
{
	var search_text=document.getElementById("search_text").value;
	 search_text=search_text.replace(/\s+/g, '-').toLowerCase();
	 search_text=search_text.replace('@', '~')
     search_text=search_text.trim();
	window.location='<?=base_url()?>admission/search/'+search_text;
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
        <form action="<?=base_url()?>admission/delete" method="post">           
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
