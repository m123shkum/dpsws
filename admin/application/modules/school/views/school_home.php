<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1><small>Manage School</small></h1>
       <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="icon-file-alt"></i>School</li>
      </ol>
      <div class="row-fluid">
        <div class="span6">         
            <div class="pull-right" style="max-width: 700px;">              
           
                <form id="search"  name="search" action="<?php echo site_url();?>school/search" method="get">
                <div class="input-group">
                     <label class="inner-label">Search by name:</label>
                     <input type="text"  value="<?php if(isset($_GET['school_name'])){echo $_GET['school_name'];}?>"  name="school_name" style="width:206px;" id="school_name" class="form-control serch-field">
                
                <input type="hidden" name="perpage" id="perpage">
                <select style="max-width:130px;" class="form-control" name="are_name" id="are_name" onchange="locationshow(this.value);">
                    <option value="">-Select Area-</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='faridabad'){?> selected<?php }}?> value="faridabad">Faridabad</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='gurgaon'){?> selected<?php }}?> value="gurgaon">Gurgaon</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='delhi'){?> selected<?php }}?> value="delhi">Delhi</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='noida'){?> selected<?php }}?> value="noida">Noida</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='ghaziabad'){?> selected<?php }}?> value="ghaziabad">Ghaziabad</option>
                    <option <?php if(isset($_GET['are_name'])){ if($_GET['are_name']=='greater noida'){?> selected<?php }}?> value="greater noida">Greater Noida</option>                    
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
            <br> <br>
          <a style="text-decoration:none;float:right;" href="<?=base_url().'school/add';?>"><span class="btn add-btn"></span></a>

       
          <div class="sort-row">
          
            <label class="inner-label">Show:</label>
            <select onchange="perPage(this.value)" style="width:140px;" class="form-control per" name="per_pages" id="per_pages">               
              <option <?php if($perpage==10) { echo 'selected="selected"';} ?> value="10">10</option>
              <option <?php if($perpage==20) { echo 'selected="selected"';} ?> value="20">20</option>
              <option <?php if($perpage==50) { echo 'selected="selected"';} ?> value="50">50</option>
              <option <?php if($perpage==100) { echo 'selected="selected"';} ?> value="100">100</option>
            </select>
            
            <div class="sort-by">
            <label class="inner-label">Sort by:</label>
            <select onchange="pageSort(this.value)" style="width:140px;" class="form-control per" name="sort_by" id="sort_by">
              <option value="asc">-Select-</option>
              <option <?php if($order=='paid'){ echo "selected='selected'";}?> value="paid">Paid</option>
              <option <?php if($order=='unpaid'){ echo "selected='selected'";}?> value="unpaid">Unpaid</option>
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
      <?php if($this->session->flashdata('success')){  echo $this->session->flashdata('success'); }  
      
      if(isset($_GET['delete']))
      {
          echo '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been Deleted ! </div>';
      }
      ?>
    </div>
  </div>
  <div class="panel panel-default"> 
    <!-- Default panel contents --> 
    
    <!-- Table -->
    <?php $class='style="background-color:#f5f5f5"'; $j=1; if(count($results) >0) {  ?>
    <form name="delete_column" id="delete_column" action="<?php echo site_url();?>school/multidelete" method="post" onsubmit="return checkrec();">
        <input type="hidden" name="deletecurl"  id="curl" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
    <table class="table">
      <tr <?php echo $class;?>>
          <td><input style="width:70px;" class="btn btn-xs btn-danger" type="submit" name="submit" value="DELETE"/>
          <input onclick="select_all();" type="checkbox" name="selectall" id="selectall" value="all">
          </td>
        <td><strong>S.No</strong></td>
        <td><strong>School Name</strong></td>
       <td><strong>Owner Name</strong></td>
         <td><strong>Area/Location</strong></td>         
         <td><strong>Reg.Date</strong></td>
          <td><strong>Expiry Date</strong></td>
         <td><strong>Paid</strong></td>
         <td></td>
         <td></td>
      </tr>
      <?php 
      $k=$startlimit;
      foreach($results as $data) { if($j%2==0) { $class='style="background-color:#f5f5f5"'; } else { $class='style="background-color:#fff"';} 
        $k++;
        $user_res=$this->db->query("select id,owner_name from sch_user where id=".$data['user_id']."")->row_array();
	  ?>
      <tr <?php echo $class;?>>
           <td><input style="visibility: visible;" type="checkbox" name="columnechck[]" value="<?=$data['id']?>"/></td>    
        <td><?php echo $k;?></td>
        <td><?php echo stripslashes(ucwords($data['school_name']));?></td>
        <td><?php echo ucwords($user_res['owner_name']);?></td>
        <td><?php echo $data['location'];?>(<?php echo $data['area_name'];?>)</td>   
        <td><?php echo date("d-M-Y",strtotime($data['reg_date']));?></td>
        <td><?php if($data['expirydate']!='0000-00-00'){echo date("d-M-Y",strtotime($data['expirydate']));}?></td>
        <td><?php if($data['Ispaid']=='y'){echo "Yes";}else{echo "No";}?></td>   
        <td>
            <a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>school/jobs/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon">Jobs</i>
          </a>&nbsp;          
       <a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>school/gallery/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon">Gallery</i>
             <a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>school/management/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon">Management</i>
          </a>&nbsp;<a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>school/noticeboard/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update"><i class="glyphicon">Noticeboard</i>
          </a>&nbsp; 
         <a style="background-color: #3a2556;" rel="tooltip" alt="Update" href="<?=base_url()?>school/payment/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon"> Payment</i>
          </a>
           </td>
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
          
          <a rel="tooltip" alt="Update" href="<?=base_url()?>school/edit/<?=$data['id']?>"  class="btn btn-xs btn-info" data-original-title="Update">
            <i class="glyphicon glyphicon-edit"> Edit</i>
          </a>
               <button onclick="getVal(<?=$data['id']?>)" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete1" data-title="Delete User" data-message="Are you sure you want to delete this user ?"> <i class="glyphicon glyphicon-trash"></i> Delete</button></td>
      </tr>
      <?php $j++; } ?>
    </table>
    </form>
    <?php } else { echo "Sorry!! No result found.";} ?>
  </div>
  <div class="pagination-wrp">
    <?php echo $links;?>
  </div>
  
<!--===================status changes form =====-->
    <form action="<?=base_url()?>school/changeStatus" method="post" id="cngststus">
           <input type="hidden" name="uid"  id="uid" value="">
           <input type="hidden" name="statustype"  id="statustype" value="">
           <input type="hidden" name="curl"  id="curl" value="http://<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">

   </form>
  <!--===========================================--->
  <!--===========================================--->
<script type="text/javascript">
    
 function select_all()
{
    var cards = delete_column.elements['columnechck[]'].length;
    if(delete_column.elements['selectall'].checked)
    {
    for(i = 0; i < cards; i++)
	{   
         delete_column.elements['columnechck[]'][i].checked=true;
       } 
   }else{
       for(i = 0; i < cards; i++)
	{   
         delete_column.elements['columnechck[]'][i].checked=false;
       } 
   }
}

    function checkrec()
{
    
 var destCount = delete_column.elements['columnechck[]'].length;
   var ss='false';
   
   
	
	for(i = 0; i < destCount; i++)
	{
		
     if(delete_column.elements['columnechck[]'][i].checked){
      ss='true';	  
      }
    }
	//alert(ss);return false;
        
	if(ss=='false')
	{
		alert('Please select at least one record !');
		return false;
	}
        
        var ok = confirm("Are you sure to Delete multiple record?");
    if (!ok) return false;
    
	//$("#update_column").submit();
        document.getElementById("delete_column").submit();    
}

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

    function statusAdmin(id,s) {
document.getElementById("statustype").value=s;
document.getElementById("uid").value=id;
document.getElementById("cngststus").submit();
}

function perPage(val) 
{
  document.getElementById("perpage").value=val;
  document.getElementById("search").submit();
}
function pageSort(sort_by) { 
	  window.location='<?=base_url()?>school/index/'+sort_by+'/0/0';
}
function serachAdmin()
{
	var search_text=document.getElementById("search_text").value;
        var paidby=document.getElementById("paidby").value;
        
	 search_text=search_text.replace(/\s+/g, '-').toLowerCase();
	 search_text=search_text.replace('@', '~')
     search_text=search_text.trim();
	window.location='<?=base_url()?>school/search/'+search_text+'_'+paidby;
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
        <form action="<?=base_url()?>school/delete" method="post">
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
