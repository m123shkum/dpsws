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
      <h1 class="page-header"><small>Manage User</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>users"><i class="icon-file-alt"></i>User</a></li>
        <li class="active"><i class="icon-file-alt"></i>Add</a></li>
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
         if(isset($exist_error))
         {
             ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Notice !</strong> <?php echo $exist_error?></div>
         <?php }
         ?>
         <?php echo form_open(base_url().'users/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"adduser","id"=>"adduser","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="usersRegister" value='Register'>  
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">User Type*</label>
                     <select class="form-control" name="user_type" id="user_type" onchange="opentag(this.value);">
                         <option value="">--Select Type--</option>
                         <option value="school">School</option>
                         <option value="teacher">Teacher</option>
                         <option value="vendor">Vendor</option>
                         <option value="student">Student</option>
                         <option value="parent">Parent</option>
                     </select>                     
                     <div id="typeErr" style="color:#C33"></div>
                  </div>                           
                   <div class="form-group">
                     <label class="control-label">Name*</label>
                     <input class="form-control" type="text" name="owner_name" id="owner_name" value="<?php echo $owner_name?>">
                     <div id="nameErr" style="color:#C33"></div>
                  </div>    
                <div id="school_field" style="display:none;">
                    <div class="form-group">
                     <label class="control-label">School Name*</label>
                     <input class="form-control" type="text" name="school_name" id="school_name">                     
                  </div>
                    <div class="form-group">
                     <label class="control-label">Address*</label>
                     <input class="form-control" type="text" name="address" id="address">                     
                  </div>
                    <div class="form-group">
                     <label class="control-label">Contact no*</label>
                     <input onkeypress="return isNumberKey(event)" class="form-control" type="text" name="contact" id="contact" maxlength="12">                     
                     <div id="contactErr" style="color:#C33"></div>
                  </div>
                    <div class="form-group">
                     <label class="control-label">Board*</label>
                     <select name="board" id="board" class="form-control">
                                    <option value="">- - Please Select - -</option>                                    
                                    <option value="ib">IB</option>
                                    <option value="cbse">CBSE</option>
                                </select>
                  </div>
                    <div class="form-group">
                     <label class="control-label">Category*</label>
                     <select name="category" id="category" class="form-control">
                                    <option value="">- - Please Select - -</option>                                    
                                    <option value="primary">Primary</option>
                                    <option value="secondary">Secondary</option>
                                     <option value="play">Play</option>
                                     <option value="boarding">Boarding</option>
                                </select>
                  </div>
                    <div class="form-group">
                     <label class="control-label">Sub Category*</label>
                     <select name="sub_category" id="sub_category" class="form-control">
                                    <option value="">- - Please Select - -</option>                                    
                                    <option value="coed">Co-ed</option>
                                    <option value="girls">Girls</option>
                                     <option value="boys">Boys</option>
                                     
                                </select>
                  </div>
                    
                </div>
                   <div class="form-group">
                     <label class="control-label">Email*</label>
                     <input class="form-control" type="text" name="email" id="email" value="<?php echo $email?>">
                     <div id="emailErr" style="color:#C33"></div>
                  </div>                             
                   <div class="form-group">
                     <label class="control-label">Password*</label>
                     <input class="form-control" type="password" name="passwords" id="passwords" value="<?php echo $passwords?>">
                     <div id="pwdErr" style="color:#C33"></div>
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
    function opentag(type)
    {
        if(type=='school')
        {
            $("#school_field").show();                        
        }else{$("#school_field").hide();}
    }

function valid_frm() { 
	var name = document.getElementById("owner_name").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("passwords").value;
        var user_type = document.getElementById("user_type").value;
         
         
	var cnt=0;
        
         
	
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
       
       if(user_type=='school')
            {         
               
               var school_name=$("#school_name").val();
               var address=$("#address").val();
                var contact=$("#contact").val();
                var board=$("#board").val();
                var category=$("#category").val();
                var sub_category=$("#sub_category").val();
                
                if(school_name=='')
               {
                document.getElementById("school_name").style.borderColor='red';
                document.getElementById('school_name').focus();
                return false;
               }else{                 
                 document.getElementById("school_name").style.borderColor='';}
             
               if(address=='')
               {
                document.getElementById("address").style.borderColor='red';
                document.getElementById('address').focus();
                return false;
               }else{                 
                 document.getElementById("address").style.borderColor='';}
               if(contact=='')
               {
                document.getElementById("contact").style.borderColor='red';
                document.getElementById('contact').focus();
                return false;
               }else{                 
                 document.getElementById("contact").style.borderColor='';}
             if(contact!='')
            {
              if(contact.length<10)
              {
                    document.getElementById("contact").style.borderColor='red';
                    document.getElementById('contact').focus();
                    document.getElementById('contactErr').innerHTML="Invalid contact number!";
                    return false;
              }else{document.getElementById('contactErr').innerHTML="";} 
            }
        
              if(board=='')
               {
                document.getElementById("board").style.borderColor='red';
                document.getElementById('board').focus();
                return false;
               }else{                 
                 document.getElementById("board").style.borderColor='';}
               if(category=='')
               {
                document.getElementById("category").style.borderColor='red';
                document.getElementById('category').focus();
                return false;
               }else{                 
                 document.getElementById("category").style.borderColor='';}
             if(sub_category=='')
               {
                document.getElementById("sub_category").style.borderColor='red';
                document.getElementById('sub_category').focus();
                return false;
               }else{                 
                 document.getElementById("sub_category").style.borderColor='';}
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
       if(password=='')
	 {      
	 	document.getElementById("passwords").style.borderColor='red';	
                cnt++;
	 }else{document.getElementById('pwdErr').innerHTML="";} 
         
        if(password!='') 
        {
        aa=/\s/;
	 if(aa.test(password))
	 {
             	document.getElementById("passwords").style.borderColor='red';
                document.getElementById('passwords').focus();		
		document.getElementById('pwdErr').innerHTML="Blank space not allowed !"; 
                return false;
	 }else{document.getElementById('pwdErr').innerHTML="";}         
         
         if(password.length<7)
         {
             document.getElementById("passwords").style.borderColor='red';
                document.getElementById('pwdErr').innerHTML="Password must be of 7-15 characters !"; 
         }else{document.getElementById("passwords").style.borderColor='';
             document.getElementById('pwdErr').innerHTML="";}
         
        }
         
	     
     if(user_type=='')
	{
		document.getElementById("user_type").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("user_type").style.borderColor='';}
         
        
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
		document.getElementById("registerfrm").submit();
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