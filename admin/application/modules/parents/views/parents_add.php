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
      <h1 class="page-header"><small>Manage Parent</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>parents"><i class="icon-file-alt"></i>Parent</a></li>
        <li class="active"><i class="icon-file-alt"></i>Add</li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="javascript:void(0);" onclick="javascript:history.go(-1)"><img src="<?=base_url()?>public/images/back-btn.png"></a>
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
         <?php echo form_open(base_url().'parents/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addparent","id"=>"addparent","onsubmit"=>"return valid_frm()")) ?>
            <input type="hidden" name="parentRegister" value='parentRegister'>                        
            <div class="col-lg-6">                                                     
                   <div class="form-group">
                     <label class="control-label">Name*</label>
                     <input class="form-control" type="text" name="owner_name" id="owner_name">
                     
                  </div>
                  <div class="form-group">
                     <label class="control-label">Email-Id*</label>
                     <input class="form-control" type="text" name="email" id="email">    
                     <span id="emailErr" style="color:red"></span>
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Password*</label>
                     <input class="form-control" type="password" name="password" id="password">    
                     <span id="passwordErr" style="color:red"></span>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Contact No.</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="contact_no" id="contact_no">                    
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Country*</label>                                     
                     <select class="form-control" name="country_id" id="country_id" onchange="state_show(this.value)">
                     <option value="0">--Select Country--</option>     
                     <?php foreach($countrys AS $data){?>                     
                     <option value="<?php echo $data['country_id']?>"><?php echo $data['name']?></option>
                     <?php }?>
                     </select>                     
                     <div id="countryErr" style="color:#C33"></div>
                  </div>
                  <div class="form-group">
                     <label class="control-label">State*</label> 
                     <span id="statedivid">                                        
                     <select class="form-control" name="state_id" id="state_id">
                     <option value="0">--Select State--</option>                      
                     </select>       
                     </span>
                                   
                     <div id="stateErr" style="color:#C33"></div>
                  </div>
                  
                  <div class="form-group">
                     <label class="control-label">City*</label>
                     <input class="form-control" type="text" name="city" id="city">
                     <div id="cityErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Address</label>
                     <input class="form-control" type="text" name="address" id="address">                    
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
      
  function state_show(contid)
{
 
	   strURL='<?=base_url()?>parents/getstate?contid='+contid;         
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
						document.getElementById('statedivid').innerHTML=req.responseText;																	
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	

}   

function valid_frm() { 
	
        
        var owner_name = document.getElementById("owner_name").value;
        var password = document.getElementById("password").value;
        var email= document.getElementById("email").value;
        
        var country_id = document.getElementById("country_id").value;
		var state_id = document.getElementById("state_id").value;
		var city = document.getElementById("city").value;
        
	var cnt=0;
        
	if(owner_name=='')
	{
		document.getElementById("owner_name").style.borderColor='red';
                document.getElementById('owner_name').focus();
                 return false;
	    cnt++;
	}else{document.getElementById("owner_name").style.borderColor='';}
         
        if(email=='')
	{
	    document.getElementById("email").style.borderColor='red';
            document.getElementById('email').focus();
            return false;
	    cnt++;
	}else{document.getElementById("email").style.borderColor='';}
        if(email!='')
            {
                var reg =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;	
                if(reg.test(email)==false)
                 {
                        document.getElementById("email").style.borderColor='red';                        
                        document.getElementById('email').focus();	
                        document.getElementById('emailErr').innerHTML="Invalid Email-id !";
                        return false;
                 }else{document.getElementById("email").style.borderColor='';
                       }
            }
            
         if(password=='')
	{
		document.getElementById("password").style.borderColor='red';
                document.getElementById('password').focus();
                 return false;
	    cnt++;
	}else{document.getElementById("password").style.borderColor='';}   
            
        
        if(password!='')
	{
            var aa=/\s/;
	 if(aa.test(password))
	 {
           document.getElementById("password").style.borderColor='red'; 
           document.getElementById('passwordErr').innerHTML="Blank space not allowed !";
           return false;
         }else{document.getElementById('passwordErr').innerHTML="";}
         if(password.length<7)
         {
             document.getElementById("password").style.borderColor='red';  
           document.getElementById('passwordErr').innerHTML="Password must be of 7-15 characters !";
           return false;
         }else{document.getElementById('passwordErr').innerHTML="";}
         
	}
        
        if(country_id=='0')
	 {	 	
                document.getElementById("country_id").style.borderColor='red'; 
 		document.getElementById('country_id').focus();		
				
		cnt++;
                return false;
	 }else{document.getElementById("country_id").style.borderColor='';}
	 
	  if(state_id=='0')
	 {	 	
                document.getElementById("state_id").style.borderColor='red'; 
 		document.getElementById('state_id').focus();				
		cnt++;
                return false;
	 }else{document.getElementById("state_id").style.borderColor='';}
	 
	  if(city=='')
	 {	 	
                document.getElementById("city").style.borderColor='red'; 
 		document.getElementById('city').focus();				
		cnt++;
                return false;
	 }else{document.getElementById("city").style.borderColor='';}
        
	
	
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
		document.getElementById("addparent").submit();
	}

}


function getmaxvalue(minid)
{ 
	   strURL='<?php echo base_url()?>teacher/getmaxexp?minid='+minid;	   
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
						document.getElementById('maxid').innerHTML=req.responseText;																	
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
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