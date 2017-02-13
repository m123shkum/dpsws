<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>
<link href="<?=base_url()?>public/css/autosugcss/jquery.coolautosuggest.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>public/css/autosugcss/jquery.coolfieldset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>public/css/datepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/jquery.coolautosuggest.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/jquery.coolfieldset.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/bootstrap.min.js"></script>
<style>
.form-group.required .control-label:after { content:"*"; color: red; }
</style>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><small>Manage School Import/Export</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>        
        <li class="active"><i class="icon-file-alt"></i>School Import/Export</li>        
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>  
  <div class="row" id="scrolopen">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
            <?php if(isset($area_notmatch) && $area_notmatch!=''){ ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Error !</strong> No record found in sheet from your selected area.</div>
            <?php }?>
            
         <?php //if($this->session->flashdata('info')){  echo $this->session->flashdata('info'); }  
         if(isset($column_error))
         {             
         ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Error !</strong> Invalid column please checked.</div>
         <?php
         }
         if(isset($sucess_msg))
         {
             ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Success !</strong> <?php echo $sucess_msg?></div>
         <?php }
         ?>
         <?php echo form_open(base_url().'school/export_import/',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"import_school","id"=>"import_school","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="import_exportForm" value='import_exportForm'>              
             
            <div class="col-lg-6">  
                <div class="form-group">
                     <label class="control-label">Area</label>
                     <select style="width:200px;" class="form-control" name="area" id="area">
                         <option value="">--Select Area--</option>                         
                         <option value="4697">Delhi</option>
                         <option value="4155">Faridabad</option>
                         <option value="4157">Gurgaon</option>
                         <option value="4511">GHAZIABAD</option>
                         <option value="4515">Greater Noida</option>
                         <option value="4533">Noida</option>
                     </select>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Import/Export</label>
                     <select style="width:200px;" class="form-control" name="type" id="type" onchange="openimportfile(this.value);">
                         <option value="">--Select Import/Export--</option>
                         <option value="import">Import</option>
                         <option value="export">Export</option>                        
                     </select>
                  </div>
                
                <div class="form-group" style="display:none;" id="importfile_id">
                     <label class="control-label">Upload File* (Only .CSV file supported)</label>
                     <input class="form-control" type="file" name="importfile" id="importfile">                     
                     <div id="importfile_Err" style="color:#C33"></div>
                  </div>
                
                <div class="form-group" style="padding-top:30px;">
               <img style="display:none;" id="loader" src="<?=base_url()?>/public/images/loader.gif">
               <button tabindex="27" type="submit" class="btn btn-primary" id="loader_button">Submit</button>               
              </div>
              </div> 
            
                
            <?=form_close()?>
              </div>
          
          <!-- /.row (nested) --> 
        </div>
        <!-- /.panel-body --> 
      </div>
      <!-- /.panel --> 
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row --> 
</div>
<?php $this->load->view('../common/footer_view');?>
<script type="text/javascript">    
    
function openimportfile(val)
{
    if(val=='import')
    {
        $("#importfile_id").show();
    }else{$("#importfile_id").hide();}
    
}

function valid_frm() { 
       
         var area=document.getElementById("area").value;
         var type=document.getElementById("type").value;         
         
         if(area=='')
	{
		document.getElementById("area").style.borderColor='red';
                document.getElementById('area').focus(); 
                return false;	   
	}else{document.getElementById("area").style.borderColor='';}
        
         if(type=='')
	{
		document.getElementById("type").style.borderColor='red';
                document.getElementById('type').focus(); 
                return false;	   
	}else{document.getElementById("type").style.borderColor='';}
        
         
         if(type=='import')
         {
             var importfile=document.getElementById("importfile").value;
	if(importfile=='')
	{
		document.getElementById("importfile").style.borderColor='red';
                document.getElementById('importfile').focus(); 
                return false;	   
	}else{document.getElementById("importfile").style.borderColor='';}
        
        if(importfile!='')
	{
                var ext = importfile.split('.').pop();
                
                if(ext!='csv')
		{		                
		 document.getElementById('importfile_Err').innerHTML="Only excel (.CSV) format support!";	
		 document.getElementById('importfile').focus(); 
                 return false;	  
		}else{document.getElementById('importfile_Err').innerHTML="";}
                
                document.getElementById("loader_button").style.display='none';               
		document.getElementById("loader").style.display='block';
        }
         }
        
		
		document.getElementById("import_school").submit();
	

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->