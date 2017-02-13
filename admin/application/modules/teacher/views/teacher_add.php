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
      <h1 class="page-header"><small>Manage Teacher</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>teacher"><i class="icon-file-alt"></i>Teacher</a></li>
        <li class="active"><i class="icon-file-alt"></i>Add</li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'teacher';?>"><img src="<?=base_url()?>public/images/back-btn.png"></a>
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
         <?php echo form_open(base_url().'teacher/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addtteacher","id"=>"addtteacher","onsubmit"=>"return valid_frm()")) ?>
            <input type="hidden" name="teacherRegister" value='teacherRegister'>                        
            <div class="col-lg-6">                
               
                <div class="form-group">
                     <label class="control-label">Name*</label>
                     <input class="form-control" type="text" name="name" id="name">
                     <div id="nameErr" style="color:#C33"></div>
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Email*</label>
                     <input class="form-control" type="text" name="email" id="email"> 
                     <div id="emailErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Password*</label>
                     <input class="form-control" type="password" name="password" id="password">  
                     <div id="passwordErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Category</label>
                     <select class="form-control" name="teacher_category" id="teacher_category">
                                    <option value="teaching">Teaching </option>
                                    <option value="nonteaching">Non Teaching </option>
                     </select>
                     
                  </div>
                            
                   <div class="form-group">
                     <label class="control-label">Contact No.*</label>
                     <input class="form-control" type="text" name="mobileno" id="mobileno" onKeyPress="return isNumberKey(event)" maxlength="12">
                     <div id="mobilenoErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Landline No.</label>
                     <input class="form-control" type="text" name="landline" id="landline" onKeyPress="return isNumberKey(event)" maxlength="12">                    
                  </div>
                         
                   <div class="form-group">
                     <label class="control-label">Address*</label>
                     <input class="form-control" type="text" name="address" id="address"> 
                     <div id="addressErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Pincode</label>
                     <input class="form-control" type="text" name="pincode" id="pincode">                     
                  </div>                
                        
                   <div class="form-group">
                     <label class="control-label">Resume Headline*</label>
                     <input class="form-control" type="text" name="resume_headline" id="resume_headline">
                     <div id="resume_headlineErr" style="color:#C33"></div>
                  </div>  
                <div class="form-group">
                     <label class="control-label">Key Skills*</label>
                     <input class="form-control" type="text" name="keyskills" id="keyskills">
                     <div id="keyskillsErr" style="color:#C33"></div>
                  </div> 
                <div class="form-group">
                     <label class="control-label">Total Work Experience</label>
                     <select name="expyear" id="expyear" class="form-control" style="width:100px;" onchange="getmaxvalue(this.value);">
                    <option value="">Year</option>
                    <option value="0">Fresher</option>
                   <? for($i=1;$i<=30;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>                    
                    </select>&nbsp; &nbsp;
                    <span id="maxid"> <select name="expmonth" id="expmonth" class="form-control" style="width:100px;">
                    <option value="">Month</option>
                    <option value="0">Fresher</option>
                   <? for($i=1;$i<=12;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>                    
                        </select></span>
                  </div> 
                <div class="form-group">
                     <label class="control-label">Current Salary</label>
                    <select name="salinlakh" id="salinlakh" class="form-control" style="width:100px;">
                    <option value="">Lacs</option>
                    <option value="0">0</option>
                   <? for($i=1;$i<=50;$i++){?>
                   <option value="<?php echo $i*100000?>"><?php echo $i?></option>                  
                    <? }?>                    
                    </select>
            <select name="salinth" id="salinth" class="form-control" style="width:100px;">
                    <option value="">Thousands</option>
                    <option value="0">0</option>
                   <?php 
				   $i=0;
				   while($i<=90){
				   
				   $i+=5;
				   ?>
                    <option value="<?php echo $i*1000?>"><?=$i?></option>                    
                    <? }?>                    
                    </select>  Per Anum
                  </div>
                   
                         
                   <div class="form-group">
                     <label class="control-label">State*</label>
                     <select class="form-control" name="state" id="state" onchange="areashow(this.value);">
            <option value="0">--Select State--</option>
			<?php foreach($states AS $state){?>
            <option value="<?=$state['zone_id']?>"><?php echo $state['name']?></option>
            <?php }?>
            </select>
                     <div id="stateErr" style="color:#C33"></div>
                  </div>
                            
                   <div class="form-group" id="area_divid">
                     <label class="control-label">Area*</label>
                     <span id="areadivid">
                     <select class="form-control" name="area" id="area" onchange="locationshow(this.value);">
            <option value="">-- Select Area --</option>            
                     </select></span>
                     <div id="areaErr" style="color:#C33"></div>
                  </div>
                       
                   <div class="form-group" id="location_divid">
                     <label class="control-label">Location*</label>
                     <span id="Locationdivid">
                     <select class="form-control" name="location" id="location">
            <option value="">-- Select Location --</option>	            
                     </select></span>
                     <div id="locationErr" style="color:#C33"></div>
                  </div>               
                         
                   <div class="form-group">
                     <label class="control-label">Resume (Doc,Pdf format only)</label>                        
                <input class="form-control" type="file" name="resume" id="resume">
                     <div id="resumeErr" style="color:#C33"></div>
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
      
   function locationshow(areaid)
{
 
	   strURL='<?=base_url()?>teacher/getlocation/'+areaid;           
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
function areashow(state_id)
{ 
  
	   strURL='<?=base_url()?>teacher/getarea/'+state_id;
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
						document.getElementById('areadivid').innerHTML=req.responseText;																	
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
	var name = document.getElementById("name").value;
        var email=document.getElementById('email').value;
        var mobileno = document.getElementById("mobileno").value;
        var landline = document.getElementById("landline").value;
        var address = document.getElementById("address").value;
        var resume_headline = document.getElementById("resume_headline").value;
        var keyskills = document.getElementById("keyskills").value;        
        var password=document.getElementById("password").value;        
        
        var state=document.getElementById('state').value;
        var area=document.getElementById('area').value;
        var location=document.getElementById('location').value;
        
        var resume=document.getElementById('resume').value;
	
	var cnt=0;
         var aa=/\s/;
        
	if(name=='')
	{
		document.getElementById("name").style.borderColor='red';
                 document.getElementById('name').focus();
	    cnt++;
	}else{document.getElementById("name").style.borderColor='';}
        
        
        if(email=='')
	{
	    document.getElementById("email").style.borderColor='red';
            document.getElementById('email').focus();
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
	}else{document.getElementById("password").style.borderColor='';}
         
         if(password!='') 
        {        
	 if(aa.test(password))
	 {
             	document.getElementById("password").style.borderColor='red';
                document.getElementById("password").focus();		
		document.getElementById('passwordErr').innerHTML="Blank space not allowed !"; 
                return false;
	 }else{document.getElementById('passwordErr').innerHTML="";}         
         
         if(password.length<7)
         {
             document.getElementById("password").style.borderColor='red';
                document.getElementById('passwordErr').innerHTML="Password must be of 7-15 characters !"; 
                return false;
         }else{document.getElementById("password").style.borderColor='';
             document.getElementById('passwordErr').innerHTML="";}         
        } 
        
       
       
        if(mobileno=='')
	{
		document.getElementById("mobileno").style.borderColor='red';
                document.getElementById('mobileno').focus();
	    cnt++;
	}else{document.getElementById("mobileno").style.borderColor='';}
	 
	if(mobileno!='')
        {
            if(mobileno.length<10)
             {
                    document.getElementById("mobileno").style.borderColor='red';
                    document.getElementById('mobileno').focus();
                    document.getElementById('mobilenoErr').innerHTML="Invalid mobile number!";
                    return false;
             }else{document.getElementById('mobilenoErr').innerHTML="";} 
        }
        
        if(address=='')
	{
		document.getElementById("address").style.borderColor='red';
                document.getElementById('address').focus();
	    cnt++;
	}else{document.getElementById("address").style.borderColor='';}
        
        if(resume_headline=='')
	{
		document.getElementById("resume_headline").style.borderColor='red';
                document.getElementById('resume_headline').focus();
	    cnt++;
	}else{document.getElementById("resume_headline").style.borderColor='';}
        
        if(keyskills=='')
	{
		document.getElementById("keyskills").style.borderColor='red';
                document.getElementById('keyskills').focus();
	    cnt++;
	}else{document.getElementById("keyskills").style.borderColor='';}
       
       
        
        if(state==0)
	 {     cnt++;
	       document.getElementById("state").style.borderColor='red';
               document.getElementById('state').focus(); 
               return false;
	 }else{document.getElementById("state").style.borderColor='';
             document.getElementById('stateErr').innerHTML="";}
         
         
            if(area=='')
	    {     cnt++;
	       document.getElementById("area").style.borderColor='red';	  
               document.getElementById('area').focus(); 
               return false;
	    }else{document.getElementById("area").style.borderColor='';
                document.getElementById('areaErr').innerHTML="";}
            
            if(location=='')
	    {     cnt++;
	       document.getElementById("location").style.borderColor='red';
               document.getElementById('location').focus(); 
               return false;
	    }else{document.getElementById("location").style.borderColor='';
                document.getElementById('locationErr').innerHTML="";}
         
         
        if(resume=='')
	    {     cnt++;
	       document.getElementById("resume").style.borderColor='red';
               document.getElementById('resume').focus(); 
               return false;
	    }else{document.getElementById("resume").style.borderColor=''; }
          
        
        if(resume!='')
        {
           var ext = resume.split('.').pop();	
		
		if(ext!='doc' && ext!='docx' && ext!='pdf')
		{		
		 document.getElementById('resumeErr').innerHTML="Only (doc,docx,pdf) format support!";	
		 document.getElementById('resume').focus(); 
		 return false;
		}else{document.getElementById('resumeErr').innerHTML="";}
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
		document.getElementById("addtteacher").submit();
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