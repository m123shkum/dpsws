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
      <h1 class="page-header"><small>Manage Caf</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>caf"><i class="icon-file-alt"></i>Caf</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'events';?>"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'caf/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"caf_form","id"=>"caf_form","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="cafForm" value='cafForm'>   
            <input type="hidden" name="caf_id" value='<?php echo $results['id']?>'>               
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Applicant Name*</label>
                     <input class="form-control" type="text" name="caf_name" id="caf_name" value="<?php echo $results['caf_name']?>">
                     <div id="image_titleErr" style="color:#C33"></div>
                  </div>  
                                             
                   <div class="form-group">
                     <label class="control-label">Father's Name*</label>
                   <input class="form-control" type="text" name="caf_fathername" id="caf_fathername" value="<?php echo $results['caf_fathername']?>">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Mother's Name*</label>
                   <input class="form-control" type="text" name="caf_mothername" id="caf_mothername" value="<?php echo $results['caf_mothername']?>">
                  </div>
                <div class="form-group">
                     <label class="control-label">Email ID*</label>
                   <input class="form-control" type="text" name="caf_email" id="caf_email" value="<?php echo $results['caf_email']?>">
                   <span id="caf_emailErr"></span>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Phone No.*</label>
                   <input onkeypress="return isNumberKey(event)" maxlength="12" class="form-control" type="text" name="caf_contctno" id="caf_contctno" value="<?php echo $results['caf_contctno']?>">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Details</label>
                     <textarea maxlength="200" cols="50" rows="5" name="caf_details" id="caf_details"><?php echo stripslashes($results['caf_details'])?>                     </textarea>
                         
                  </div>
                
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
      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;



         return true;

      }
      
   
function valid_frm() { 
        
        
        var caf_name=$("#caf_name").val();
               var caf_fathername=$("#caf_fathername").val();
                var caf_mothername=$("#caf_mothername").val();
                var caf_email=$("#caf_email").val();
                var caf_contctno=$("#caf_contctno").val();
                var caf_details=$("#caf_details").val();
                
            
            if(caf_name=='')
            {
                document.getElementById("caf_name").style.borderColor='red';
                document.getElementById("caf_name").focus();
                return false;
            }else{                 
                 document.getElementById("caf_name").style.borderColor='';}
            
            if(caf_fathername=='')
            {
                document.getElementById("caf_fathername").style.borderColor='red';
                document.getElementById("caf_fathername").focus();
                return false;
            }else{                 
                 document.getElementById("caf_fathername").style.borderColor='';}
            
            if(caf_mothername=='')
            {
                document.getElementById("caf_mothername").style.borderColor='red';
                document.getElementById("caf_mothername").focus();
                return false;
            }else{                 
                 document.getElementById("caf_mothername").style.borderColor='';}             
            
             
            if(caf_email=='')
            {
                document.getElementById("caf_email").style.borderColor='red';
                document.getElementById("caf_email").focus();
                return false;
            }else{                 
                 document.getElementById("caf_email").style.borderColor='';}
             
             if(caf_email!='')
            {
                var reg =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;	
                if(reg.test(caf_email)==false)
                 {
                        document.getElementById("caf_email").style.borderColor='red';
                        document.getElementById("caf_email").focus();		
                        document.getElementById('caf_emailErr').innerHTML="Invalid Email-Id !"; 
                        return false;
                 }else{document.getElementById("caf_email").style.borderColor='';
                       document.getElementById('caf_emailErr').innerHTML="";}
            }
            
            if(caf_contctno=='')
            {
                document.getElementById("caf_contctno").style.borderColor='red';
                document.getElementById("caf_contctno").focus();
                return false;
            }else{                 
                 document.getElementById("caf_contctno").style.borderColor='';}
             
         if(caf_contctno.length<9)
         {
             document.getElementById("caf_contctno").style.borderColor='red';
                document.getElementById("caf_contctno").focus();
                return false;
         }else{document.getElementById("caf_contctno").style.borderColor='';
             } 
	
        
        
	
		document.getElementById("loader_button").style.display='none';
                document.getElementById("loader_button2").style.display='none';
		document.getElementById("loader").style.display='block';
		document.getElementById("caf_form").submit();
	

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->