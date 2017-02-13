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
      <h1 class="page-header"><small>Admin Setting</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>        
        <li class="active"><i class="icon-file-alt"></i>Setting</li>
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
         <?php //if($this->session->flashdata('info')){  echo $this->session->flashdata('info'); }  
         if(isset($error))
         {
             ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Error !</strong> <?php echo $error?></div>
         <?php }
         ?>
            <?php 
         if(isset($success))
         {
             ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Success :</strong> <?php echo $success?></div>
         <?php }
         ?>
         <?php echo form_open(base_url().'user/accountUpdate',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"account","id"=>"account","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="account" value='account'>  
            <input type="hidden" name="hidden_email" value='<?php echo $user_data['email']?>'>  
            <input type="hidden" name="users_id" value='<?php echo $user_data['id']?>'>  
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Name*</label>
                     <input class="form-control" type="text" name="name" id="name" value="<?php echo $user_data['username']?>">
                     <div id="nameErr" style="color:#C33"></div>
                  </div>
                          
                   <div class="form-group">
                     <label class="control-label">Email*</label>
                     <input class="form-control" type="text" name="email" id="email" value="<?php echo $user_data['email']?>">
                     <div id="emailErr" style="color:#C33"></div>
                  </div>     
                <div class="form-group">
                     <label class="control-label">Contact Email-1</label>
                     <input class="form-control" type="text" name="contact_email1" id="contact_email1" value="<?php echo $user_data['contact_email1']?>">
                     
                  </div>  
                <div class="form-group">
                     <label class="control-label">Contact Email-2</label>
                     <input class="form-control" type="text" name="contact_email2" id="contact_email2" value="<?php echo $user_data['contact_email2']?>">
                     
                  </div>
            
            <div id="pwd_div">
                    
                   <div class="form-group">
                     <label class="control-label">Old Password</label>
                     <input class="form-control" type="password" name="old_password" id="old_password">
                     <div id="passwordErr" style="color:#C33"></div>
                  </div>
                   <div class="form-group">
                     <label class="control-label">New Password</label>
                     <input class="form-control" type="password" name="new_password" id="new_password">
                     <div id="new_passwordErr" style="color:#C33"></div>
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
	var name = document.getElementById("name").value;
        var email = document.getElementById("email").value;        
        var old_password = document.getElementById("old_password").value;        
        var new_password = document.getElementById("new_password").value;        
         
         
	var cnt=0;
        
         
	
	if(name=='')
	{
		document.getElementById("name").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("name").style.borderColor='';}
        
        var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
        if(name!='')
        {
        if(ck_name.test(name)==false)
	 {		
	    document.getElementById("name").style.borderColor='red';	
            document.getElementById('name').focus();		
	     document.getElementById('nameErr').innerHTML="Special character not allowed !";
		return false;
	 }else{document.getElementById('nameErr').innerHTML="";} 
       }
       
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
       
        if(old_password!='')
	{
            if(new_password=='')
            {
                    document.getElementById("new_password").style.borderColor='red';
                cnt++;
            }else{document.getElementById("new_password").style.borderColor='';}
        }
       
       if(new_password!='')
	{   
            if(new_password.length<7)
           {
             document.getElementById("new_password").style.borderColor='red';
                document.getElementById('new_passwordErr').innerHTML="Password must be of 7-15 characters !"; 
                return false;
           }else{document.getElementById("new_password").style.borderColor='';
             document.getElementById('new_passwordErr').innerHTML="";} 
       }
       
	
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
		document.getElementById("account").submit();
	}

}
function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;

         return true;

      }

</script>

<!--bs-callout bs-callout-danger alert-dismissable-->