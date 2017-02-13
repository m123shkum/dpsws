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
      <h1 class="page-header"><small>Manage Type Content</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>typecontent"><i class="icon-file-alt"></i>Type Content</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'typecontent'?>"><img src="<?php echo site_url();?>public/images/back-btn.png"></a>
  <div class="row" id="scrolopen">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
         <?php //if($this->session->flashdata('info')){  echo $this->session->flashdata('info'); }  
         if(isset($exist_error))
         {
             ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Notice !</strong> <?php echo $exist_error?></div>
         <?php }
         ?>
         <?php echo form_open(base_url().'typecontent/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"edit_typecontent","id"=>"edit_typecontent","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="typecontentForm" value='typecontentForm'>   
            <input type="hidden" name="typecontent_id" value='<?php echo $results['id']?>'>               
             
            <div class="col-lg-6">    
                <div class="form-group">
                     <label class="control-label">User Type*</label>
                     <select class="form-control" name="user_type" id="user_type">
                         <option value="">--Select--</option> 
                         <?php foreach($user_types AS $user_type){?>
                         <option <?php if($results['type_id']==$user_type['id']){?> selected <?php }?> value="<?php echo $user_type['id']?>"><?php echo $user_type['name']?></option>
                         <?php }?>
                     </select>                    
                  </div>
                 <div class="form-group">
                     <label class="control-label">Tab Name*</label>
                     <input class="form-control" type="text" name="tab_name" id="tab_name" value="<?php echo $results['tab_name']?>">                     
                  </div>
                   <div class="form-group">
                     <label class="control-label">Title*</label>
                     <input class="form-control" type="text" name="title" id="title" value="<?php echo $results['title']?>">                     
                  </div>                                               
                  <div class="form-group">
                     <label class="control-label">Sort Order*</label>
                     <input value="<?php echo $results['ord']?>" style="max-width:90px;" class="form-control" type="text" name="ord" id="ord" onkeypress="return isNumberKey(event)" maxlength="3">                     
                </div> 
                          
                   <div class="form-group">
                     <label class="control-label">Content*</label>                     
                     <textarea class="form-control" name="content" id="content"><?php echo $results['content']?></textarea>
                     <?php echo display_ckeditor($ckeditor_2); ?>
                     <div id="contentErr" style="color:#C33"></div>
                  </div>   
                  
                  
                  
   <?php /*?>               <div class="form-group">
                     <label class="control-label">Content*</label>                     
                     <textarea class="form-control" name="blue_content" id="blue_content"><?php echo $results['blue_content']?></textarea>
                     <?php echo display_ckeditor($ckeditor_3); ?>
                     <div id="contentErr" style="color:#C33"></div>
                  </div>             
                
              </div>
              <?php */?>
              <div class="form-group">
                     <label class="control-label">link*</label>
                     <input class="form-control" type="text" name="link" id="title" value="<?php echo $results['link']?>">                     
                  </div>  
                        
                <div class="form-group" style="padding-top:30px;">
               <img style="display:none;" id="loader" src="<?=base_url()?>/public/images/loader.gif">
               <button tabindex="27" type="submit" class="btn btn-primary" id="loader_button">Submit</button>
               <button tabindex="28" type="reset" class="btn btn-primary" onclick="reset();" id="loader_button2">Reset</button>
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
    function isNumberKey(evt)
    {    var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }     
       
      
    function isNumberKey3(evt,val,idval)
      {
	  
	   if(val.charAt(0)=='0'){ document.getElementById(idval).value=""; return false;}
	   
         var charCode = (evt.which) ? evt.which : event.keyCode			 

         if (charCode > 31 && (charCode < 48 || charCode > 57))
		 { 
		   return false;		
		}else{			 	     
		  return true;	
		 }

      }	 
      
   
function valid_frm() { 
        
        var user_type=document.getElementById("user_type").value;
        var tab_name = document.getElementById("tab_name").value;
        var title = document.getElementById("title").value;	
        var ord = document.getElementById("ord").value;
        
	var cnt=0;
         
          if(user_type=='')
	{
		document.getElementById("user_type").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("user_type").style.borderColor='';}
        
         if(tab_name=='')
	{
		document.getElementById("tab_name").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("tab_name").style.borderColor='';}
        
	if(title=='')
	{
		document.getElementById("title").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("title").style.borderColor='';}
        
        if(ord=='')
	{
		document.getElementById("ord").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("ord").style.borderColor='';}
                
       
	if(cnt>0)
	{
		document.getElementById("scrolopen").scrollIntoView();
		return false;
	}
	else
	{
		document.getElementById("loader_button").style.display='none';
                document.getElementById("loader_button2").style.display='none';
		document.getElementById("loader").style.display='block';
		document.getElementById("registerfrm").submit();
	}

}

</script>
<script type="text/javascript">
          $('#start_date').datepicker({
			 format: 'yyyy/mm/dd',
              // startDate: '-3d'
			autoclose: true,
			todayHighlight: true
           });
		     $('#end_date').datepicker({
				 format: 'yyyy/mm/dd',
			autoclose: true,
			todayHighlight: true
           });
		   $('#start_date').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});
			 $('#end_date').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});
 </script>  
<!--bs-callout bs-callout-danger alert-dismissable-->