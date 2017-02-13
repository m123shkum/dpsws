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
<?php $open_time=array("08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","Open 24 Hrs");
$closed_time=array("08:00","08:30","09:00","09:30","10:00","10:30","11:00","11:30","12:00","12:30","13:00","13:30","14:00","14:30","15:00","15:30","16:00","16:30","17:00","17:30","18:00","18:30","19:00","19:30","20:00","20:30","21:00","21:30","22:00","22:30","23:00","Open 24 Hrs");?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><small>Manage Vendor</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>vendor"><i class="icon-file-alt"></i>Vendor</a></li>
        <li class="active"><i class="icon-file-alt"></i>Add</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a href="javascript:void(0);" onclick="javascript:history.go(-1)"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'vendor/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addvendor","id"=>"addvendor","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="vendorRegister" value='Register'>  
            <div class="col-lg-6">  
                <div class="form-group">
                     <label class="control-label">Name*</label>
                     <input class="form-control" type="text" name="owner_name" id="owner_name">
                     <div id="owner_nameErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Email-Id*</label>
                     <input class="form-control" type="text" name="email" id="email">
                     <div id="emailErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Password*</label>
                     <input class="form-control" type="password" name="password" id="password">
                     <div id="passwordErr" style="color:#C33"></div>
                  </div>
                
                   <div class="form-group">
                     <label class="control-label">Business Name*</label>
                     <input class="form-control" type="text" name="business_name" id="business_name">
                     <div id="schoolErr" style="color:#C33"></div>
                  </div>
                            
                   <div class="form-group">
                     <label class="control-label">Building*</label>
                     <input class="form-control" type="text" name="building" id="building">
                     <div id="contactErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Address*</label>
                     <input class="form-control" type="text" name="street" id="street">                    
                  </div>
                <div class="form-group">
                     <label class="control-label">Landmark*</label>
                     <input class="form-control" type="text" name="landmark" id="landmark">                    
                  </div>
                   
                <div class="form-group">
                     <label class="control-label">Pincode</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="pincode" id="pincode">                     
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
                     <label class="control-label">Designation</label>
                     <input class="form-control" type="text" name="designation" id="designation">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Mobile No</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="mobileno" id="mobileno">                     
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Landline No.</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="landline" id="landline">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Fax No.</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="fax_no" id="fax_no">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Fax No 2.</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="fax_no2" id="fax_no2">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Toll Free No</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="toll_free_number" id="toll_free_number">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Toll Free No 2</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="toll_free_number2" id="toll_free_number2">                     
                  </div>               
                <div class="form-group">
                     <label class="control-label">Website</label>
                     <input class="form-control" type="text" name="website" id="website">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Hours of Operation </label>
                      <p>
                  Mon
                  <input type="checkbox" name="mon" id="mon">                 
                  <select name="start_montime">
				  <?php foreach ($open_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>

                  <select name="end_montime">
				 <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>
                <p>
                  Tue
                  <input type="checkbox" name="tue" id="tue"/>
                  
                  <select name="start_tuetime">
                   <?php foreach ($open_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                  <select name="end_tuetime">
                   <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>
                <p>
                  Wed
                  <input type="checkbox" name="wed" id="wed"/>                   
                  <select name="start_wedtime">
                 <?php foreach ($open_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                  <select name="end_wedtime">
                    <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>
                <p>
                  Thu
                  <input type="checkbox" name="thu" id="thu"/>
                 
                  <select name="start_thutime">
                  <?php foreach ($open_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                  <select name="end_thutime">
                  <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>
                <p>
                 Fri
                  <input type="checkbox" name="fri" id="fri"/>
                    
                  <select name="start_fritime">
                   <?php foreach ($open_time as $key=>$val){?>
                    <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                  <select name="end_fritime">
                   <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>
                <p>
                  Sat
                  <input type="checkbox" name="sat" id="sat"/>
                                     <select name="start_sattime">
                    <?php foreach ($open_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                  <select name="end_sattime">
                <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>
                <p>
                  Sun
                  <input type="checkbox" name="sun" id="sun"/>                  
                  <select name="start_suntime">
                    <?php foreach ($open_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                  <select name="end_suntime">
                 <?php foreach ($closed_time as $key=>$val){?>
                       <option value="<?php echo $val;?>"><?php echo $val;?></option>
                  <?php }?>
                  </select>
                </p>                  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Payment modes accepted by you</label>
                     Select All<input onclick="select_all();" type="checkbox" name="selectall" id="selectall" value="all">
                    Cash<input type="checkbox" name="payment[]" value="Cash">
                    Master Card<input type="checkbox" name="payment[]" value="Master Card">
                    Visa Card<input type="checkbox" name="payment[]" value="Visa Card">
                    Debit Cards<input type="checkbox" name="payment[]" value="Debit Cards">
                    Money Orders<input type="checkbox" name="payment[]" value="Money Orders">
                    Cheques<input type="checkbox" name="payment[]" value="Cheques">
                    Credit Card<input type="checkbox" name="payment[]" value="Credit Card">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Year of Establishment</label>
                     <input maxlength="5" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="year_estb" id="year_estb">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Annual Turnover</label>
                     <input maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="annual_turnover" id="annual_turnover">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Number of Employees</label>
                     <input maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="noe" id="noe">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Professional Associations</label>
                     <input class="form-control" type="text" name="prof_assoc" id="prof_assoc">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Certifications</label>
                     <input class="form-control" type="text" name="certification" id="certification">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Business Keywords</label>
                     <textarea class="form-control" name="keywords" placeholder="Words with comma separated"></textarea>                    
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
    function select_all()
{
    var cards = addvendor.elements['payment[]'].length;
    if(addvendor.elements['selectall'].checked)
    {
    for(i = 0; i < cards; i++)
	{   
         addvendor.elements['payment[]'][i].checked=true;
       } 
   }else{
       for(i = 0; i < cards; i++)
	{   
         addvendor.elements['payment[]'][i].checked=false;
       } 
   }
}

    function isNumberKey(evt)

      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;



         return true;

      }
      
   function locationshow(areaid)
{
 
	   strURL='<?=base_url()?>vendor/getlocation/'+areaid;           
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
  
	   strURL='<?=base_url()?>vendor/getarea/'+state_id;
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
    
        var owner_name=document.getElementById("owner_name").value;
        var email=document.getElementById("email").value;
        var password=document.getElementById("password").value;
        
	var business_name = document.getElementById("business_name").value;
        var building = document.getElementById("building").value;
        var street = document.getElementById("street").value;
        var landmark = document.getElementById("landmark").value;
        var pincode=document.getElementById('pincode').value;
       var state=document.getElementById('state').value;
        var area=document.getElementById('area').value;
        var location=document.getElementById('location').value;
       
	var cnt=0;
        var aa=/\s/;
        
        if(owner_name=='')
	{
		document.getElementById("owner_name").style.borderColor='red';
                document.getElementById('owner_name').focus();
                return false;	    
	}else{document.getElementById("owner_name").style.borderColor='';}
        
        if(email=='')
	{
		document.getElementById("email").style.borderColor='red';
                document.getElementById('email').focus();
                return false;	    
	}else{document.getElementById("email").style.borderColor='';}
        
        if(email!='')
            {
                var reg =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;	
                if(reg.test(email)==false)
                 {
                        document.getElementById("email").style.borderColor='red';
                        document.getElementById('email').focus();		
                        document.getElementById('emailErr').innerHTML="Invalid Email-Id !"; 
                        return false;
                 }else{document.getElementById("email").style.borderColor='';
                       document.getElementById('emailErr').innerHTML="";}
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
        
	if(business_name=='')
	{
		document.getElementById("business_name").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("business_name").style.borderColor='';}
       
        if(building=='')
	{
		document.getElementById("building").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("building").style.borderColor='';}	
        
        if(street=='')
	{
		document.getElementById("street").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("street").style.borderColor='';}
       
        
        if(state==0)
	 {     cnt++;
	       document.getElementById("state").style.borderColor='red';	               		
	 }else{document.getElementById("state").style.borderColor='';
             document.getElementById('stateErr').innerHTML="";}
         
         
            if(area=='')
	    {     cnt++;
	       document.getElementById("area").style.borderColor='red';	               		
	    }else{document.getElementById("area").style.borderColor='';
                document.getElementById('areaErr').innerHTML="";}
            
            if(location=='')
	    {     cnt++;
	       document.getElementById("location").style.borderColor='red';	               		
	    }else{document.getElementById("location").style.borderColor='';
                document.getElementById('locationErr').innerHTML="";}
        
	
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
		document.getElementById("addvendor").submit();
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