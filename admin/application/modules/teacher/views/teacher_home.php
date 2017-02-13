<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1><small>Manage Teacher</small></h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="icon-file-alt"></i>Teacher</li>
      </ol>
      <div class="row-fluid">
        <div class="span6">         
          <div class="pull-right" style="max-width: 827px;">
            <label class="inner-label">Search by Name or Email or Key Skills:</label>
            <form id="search"  name="search" action="<?php echo site_url();?>teacher/search" method="get">
              <div class="input-group">
                <input type="text" name="keyskills" style="width:200px;" id="keyskills" value="<?php if(isset( $search_text)) { echo $search_text; } ?>" class="form-control serch-field">
                 <input type="hidden" name="perpage" id="perpage">
                <select style="max-width:130px;" class="form-control" name="are_name" id="are_name" onchange="locationshow(this.value);">
                    <option value="">-Select Area-</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='faridabad'){?> selected<?php }}?> value="faridabad">Faridabad</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='gurgaon'){?> selected<?php }}?> value="gurgaon">Gurgaon</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='delhi'){?> selected<?php }}?> value="delhi">Delhi</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='gurgaon'){?> selected<?php }}?> value="gurgaon">Noida</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='ghaziabad'){?> selected<?php }}?> value="ghaziabad">Ghaziabad</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='greater noida'){?> selected<?php }}?> value="greater noida">Greater Noida</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='jhajjar'){?> selected<?php }}?> value="jhajjar">Jhajjar</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='rewari'){?> selected<?php }}?> value="rewari">Rewari</option>
                     <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='rohtak'){?> selected<?php }}?> value="rohtak">Rohtak</option>
                </select>
                <span id="Locationdivid">
                <select style="max-width:150px;" class="form-control" name="location" id="location">
                    <option value="">-Select Location-</option>
                    <?php 
                    if(isset($location_result)){
                    foreach($location_result AS $location){?>
                    <option <?php if($_GET['location']==$location['location']){?> selected <?php }?> value="<?php echo $location['location']?>"><?php echo $location['location']?></option>
                    <?php }?>
                    <?php }?>
                </select>
                </span>
                 
                <button type="submit" class="btn sub-btn">Search</button>
              </div>
            </form>
          </div>
              <a style="text-decoration:none;" href="<?=base_url().'teacher/add';?>"><span class="btn add-btn"></span></a>
          <div class="sort-row">
          
            <label class="inner-label">Show:</label>
            <select onchange="perPage(this.value)" style="width:140px;" class="form-control per" name="per_page" id="per_page">               
              <option <?php if($perpage==10) { echo 'selected="selected"';} ?> value="10">10</option>
              <option <?php if($perpage==20) { echo 'selected="selected"';} ?> value="20">20</option>
              <option <?php if($perpage==50) { echo 'selected="selected"';} ?> value="50">50</option>
              <option <?php if($perpage==100) { echo 'selected="selected"';} ?> value="100">100</option>
            </select>
            
            <div class="sort-by">
            <label class="inner-label">Sort by:</label>
            <select onchange="pageSort(this.value)" style="width:140px;" class="form-control per" name="sort_by" id="sort_by">
              <option value="asc">-Select-</option>
              <option <?php if($order=='date-asc'){ echo "selected='selected'";}?> value="date-asc">Reg. Date asc</option>
              <option <?php if($order=='date-desc'){ echo "selected='selected'";}?> value="date-desc">Reg. Date desc</option>
            </select>
            </div>
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
        <td><strong>Name</strong></td>  
        <td><strong>Email-Id</strong></td> 
        <td><strong>Resume</strong></td>
        <td><strong>Reg.Date</strong></td>
        <td><strong>Verified</strong></td>
        <td></td>
         <td></td>
      </tr>
      <?php 
      $k=$startlimit;
      foreach($results as $data) { if($j%2==0) { $class='style="background-color:#f5f5f5"'; } else { $class='style="background-color:#fff"';} 
        $k++;
	  ?>
      <tr <?php echo $class;?>>
        <td><?php echo $k;?></td>
        <td><?php echo ucwords($data['name']);?></td>   
        <td><?php echo $data['email'];?></td>
       
         <td><?php if($data['resume']!=''){?>
             <a href="<?=SiteUrl?>public/resume/<?php echo $data['resume'];?>">Download Resume</a>
         <?php }?>
         </td>  
          <td><?php echo date("d-M-Y",strtotime($data['reg_date']));?></td>
          <td><?php if($data['verified']=='y'){echo "Yes";}else{echo "No";}?></td>
          
         <td><a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>teacher/profession/<?=$data['user_id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon"> Professional</i>
          </a>
         <a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>teacher/education/<?=$data['user_id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon"> Education</i>
          </a>
         </td>        
           <td>
               <?php if($data['status']==1) {  ?>
           <a rel="tooltip" alt="Click for deactivate" onclick="return statusAdmin('<?=$data['user_id']?>','0')" href="javascript:void(0);" class="btn btn-xs btn-info" data-original-title="Click for deactivate">
            <i class="glyphicon glyphicon-ok-sign">Active</i>
          </a>
         <?php }  else { ?>
            <a rel="tooltip" alt="Click for activate"  onclick="return statusAdmin('<?=$data['user_id']?>','1')"   href="javascript:void()"  class="btn btn-xs btn-danger" title="Click for activate">
            <i class="glyphicon glyphicon-ok-circle">Inactive</i>
          </a>
         <?php } ?>
            
          <a rel="tooltip" alt="Update" href="<?=base_url()?>teacher/edit/<?=$data['teacher_id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon glyphicon-edit"> Edit</i>
          </a>
               <button onclick="getVal(<?=$data['teacher_id']?>)" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete1" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete</button></td>
      </tr>
      <?php $j++; } ?>
    </table>
    <?php } else { echo "Sorry!! No result found.";} ?>
  </div>
  <div class="pagination-wrp">
    <?php echo $links;?>
  </div>  
    
    <!--===================status changes form =====-->
    <form action="<?=base_url()?>teacher/changeStatus" method="post" id="cngststus">
           <input type="hidden" name="uid"  id="uid" value="">
           <input type="hidden" name="statustype"  id="statustype" value="">
           <input type="hidden" name="curl"  id="curl" value="<?=base_url()?>teacher">

   </form>
  <!--===========================================--->
<script type="text/javascript"> 
    
function locationshow(are_name)
{
 
	   strURL='<?=base_url()?>school/getsearchlocation?are_name='+are_name;           
	   //alert(strURL);
	   //var req = getXMLHTTP();
	   //
	   var req;
if (window.XMLHttpRequest)
  {
  req=new XMLHttpRequest();
  }
else
  {
  req=new ActiveXObject("Microsoft.XMLHTTP");
  }
	   //
	   
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {							
						document.getElementById('Locationdivid').innerHTML=req.responseText;																	
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	

}	

    function getVal(id)
{
	document.getElementById("delid").value=id;
        
}

function statusAdmin(id,s) {
document.getElementById("statustype").value=s;
document.getElementById("uid").value=id;
document.getElementById("cngststus").submit();
}

function perPage(val) { 
var sort_by=document.getElementById("sort_by").value;

  window.location='<?=base_url()?>teacher/index/'+sort_by+'/'+val+'/0/0'; 
}
function pageSort(sort_by) { 
	  window.location='<?=base_url()?>teacher/index/'+sort_by+'/0/0';
}
function serachAdmin()
{
	var search_text=document.getElementById("search_text").value;
	 search_text=search_text.replace(/\s+/g, '-').toLowerCase();
	 search_text=search_text.replace('@', '~')
     search_text=search_text.trim();
	window.location='<?=base_url()?>teacher/search/'+search_text;
	return false;
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
        <form action="<?=base_url()?>teacher/delete" method="post">
           <input type="hidden" name="delid"  id="delid" value="">          
           <input type="hidden" name="curl"  id="curl" value="<?=base_url()?>teacher">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger" id="confirm">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('../common/footer_view');?>
