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
      <h1 class="page-header"><small>Manage Users</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>users"><i class="icon-file-alt"></i>User</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'users';?>"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'users/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"adduser","id"=>"adduser","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="usersUpdate" value='Update'>  
            <input type="hidden" name="hidden_email" value='<?php echo $user_data['email']?>'>  
            <input type="hidden" name="users_id" value='<?php echo $user_data['id']?>'>  
            <div class="col-lg-6">  
                <div class="form-group">
                     <label class="control-label">User Type*</label>
                     <select class="form-control" name="user_type" id="user_type">
                         <option value="">--Select Type--</option>
                         <option <?php if($user_data['user_type']=='school'){?> selected <?php }?> value="school">School</option>
                         <option <?php if($user_data['user_type']=='teacher'){?> selected <?php }?> value="teacher">Teacher</option>
                         <option <?php if($user_data['user_type']=='vendor'){?> selected <?php }?> value="vendor">Vendor</option>
                         <option <?php if($user_data['user_type']=='student'){?> selected <?php }?> value="student">Student</option>
                         <option <?php if($user_data['user_type']=='parent'){?> selected <?php }?> value="parent">Parent</option>
                     </select>                     
                     <div id="typeErr" style="color:#C33"></div>
                  </div>
                   <div class="form-group">
                     <label class="control-label">Name*</label>
                     <input class="form-control" type="text" name="owner_name" id="owner_name" value="<?php echo $user_data['owner_name']?>">
                     <div id="nameErr" style="color:#C33"></div>
                  </div>
                         
                   <div class="form-group">
                     <label class="control-label">Email*</label>
                     <input class="form-control" type="text" name="email" id="email" value="<?php echo $user_data['email']?>">
                     <div id="emailErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Password</label>
                     <input class="form-control" type="password" name="user_password" id="user_password">    
                     <div id="passwordErr" style="color:#C33"></div>
                  </div>
                 <div class="form-group">
                     <label class="control-label">Confirm Password</label>
                     <input class="form-control" type="password" name="user_conf_password" id="user_conf_password">  
                     <div id="cpasswordErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Ispaid*</label>
                     <select class="form-control" name="ispaid" style="max-width:120px;">
                         <option <?php if($user_data['Ispaid']=='n'){?> selected <?php }?>  value="n">No</option>
                     <option <?php if($user_data['Ispaid']=='y'){?> selected <?php }?> value="y">Yes</option>
                     </select>
                     
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
	var name = document.getElementById("owner_name").value;
        var email = document.getElementById("email").value;        
        var user_type = document.getElementById("user_type").value;
        var user_password = document.getElementById("user_password").value; 
        var user_conf_password = document.getElementById("user_conf_password").value; 
	
	var cnt=0;
        
         if(user_type=='')
	{
		document.getElementById("user_type").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("user_type").style.borderColor='';}
	
	if(name=='')
	{
		document.getElementById("owner_name").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("owner_name").style.borderColor='';}
        
        var ck_name = /^[A-Za-z0-9 ]{3,20}$/;
        if(name!='')
        {
        if(ck_name.test(name)==false)
	 {		
	    document.getElementById("owner_name").style.borderColor='red';	
            document.getElementById('owner_name').focus();		
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
       
       
       if(user_password!='')
	{
            var aa=/\s/;
	 if(aa.test(user_password))
	 {
           document.getElementById("user_password").style.borderColor='red';  
           document.getElementById('passwordErr').innerHTML="Blank space not allowed !";
           return false;
         }else{document.getElementById('passwordErr').innerHTML="";}
         if(user_password.length<7)
         {
             document.getElementById("user_password").style.borderColor='red';  
           document.getElementById('passwordErr').innerHTML="Password must be of 7-15 characters !";
           return false;
         }else{document.getElementById('passwordErr').innerHTML="";}
         
         if(user_password!=user_conf_password)
	 {
             document.getElementById("user_conf_password").style.borderColor='red';  
           document.getElementById('cpasswordErr').innerHTML="Password and confirm password must be same !";
           return false;
         }else{document.getElementById('cpasswordErr').innerHTML="";}
         
         
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
		document.getElementById("adduser").submit();
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