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
      <h1 class="page-header"><small>Manage Subscriber</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>newsletter"><i class="icon-file-alt"></i>Subscriber</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'newsletter'?>"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
  <div class="row" id="scrolopen">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
        <?php if(isset($exist_error)){?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Exist! </strong>This email-id has been already exist..! </div>
        <?php }?>
         <?php echo form_open(base_url().'newsletter/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"newsletter","id"=>"newsletter","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="newsletterForm" value='newsletterForm'>   
            <input type="hidden" name="subscriber_id" value='<?php echo $results['id']?>'>   
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Email-Id*</label>
                     <input class="form-control" type="text" name="email" id="email" value="<?php echo $results['newsletter_email']?>">
                     <div id="emailErr" style="color:#C33"></div>
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
   function valid_frm() { 
        
        
        var email = document.getElementById("email").value;	
         
	var cnt=0;
        
         
	if(email=='')
	{
		document.getElementById("email").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("email").style.borderColor='';}
        var reg =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;	

	 if(email!='')
	{
	 if(reg.test(email)==false)
	 {		
		document.getElementById("email").style.borderColor='red';
                document.getElementById('email').focus();		
		document.getElementById('emailErr').innerHTML="Invalid Email-Id !";
		return false;
	 }else{document.getElementById('emailErr').innerHTML="";} 
       }  
        
	
	if(cnt>0)
	{
		//document.getElementById("scrolopen").scrollIntoView();
		return false;
	}
	else
	{
		document.getElementById("loader_button").style.display='none';
                document.getElementById("loader_button2").style.display='none';
		document.getElementById("loader").style.display='block';                
		document.getElementById("newsletter").submit();
	}

}

</script>
<!--bs-callout bs-callout-danger alert-dismissable-->