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
      <h1 class="page-header"><small>Manage Parent's Kids</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>parents/kids/<?php echo $parent_id?>"><i class="icon-file-alt"></i>Parent's Kids</a></li>
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
         <?php echo form_open(base_url().'parents/addkid/'.$parent_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_kid","id"=>"add_kid","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="kidForm" value='kidForm'>  
            <input type="hidden" name="parent_id" value='<?php echo $parent_id?>'>                                                   
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">First Name:*</label>
                     <input class="form-control" type="text" name="fname" id="fname">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Middle Name:*</label>
                     <input class="form-control" type="text" name="mname" id="mname">                     
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Surname:</label>
                     <input class="form-control" type="text" name="lname" id="lname">                     
                  </div>
               
                <div class="form-group">
                     <label class="control-label"><b>Date of Birth</b>:*</label>
                    <select name="date" id="date" class="birth-field" onchange="getage();">
                    <option value="">Date</option>  
                    <? for($i=1;$i<=31;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>
                    </select>
                     <?php
					$montarr=array('January','February','March','April','May','June','July','August','September','October','November','December');
					?>
                     <select name="month" id="month" class="birth-field" onchange="getage();">  
                    <option value="">Month</option>                 
                    <?php 
					$j=0;
					for($i=0;$i<12;$i++){
					$j++;
					?>
                    <option value="<?=$j?>"><?=$montarr[$i]?></option>                                 
                    <? }?>
                   
                    </select>  
                     <?php
					$st=1990;
					$curyear=date('Y')-1;
					?>
                     <select name="year" id="year" class="birth-field" onchange="getage();">
                    <option value="">Year</option>
                   <? for($i=$st;$i<=$curyear;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>
                    </select>  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Present Age (in words):*</label>
                     <input class="form-control" readonly type="text" name="age" id="age">                     
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Sex:</label>                    
                     <input type="radio" name="gender" value="male" checked=""> Male <input name="gender" type="radio" value="female"> Female
                  </div>
                <div class="form-group">
                     <label class="control-label">Residence Address:*</label>
                     <input class="form-control" type="text" name="raddress" id="raddress">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Pin Code:*</label>
                     <input maxlength="10" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="pincode" id="pincode">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Phone No.:*</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="child_contactno" id="child_contactno">    
                     <div id="child_contactnoErr" style="color:#C33"></div>
                  </div>                  
                
                <div class="form-group">
                     <label class="control-label">Family Income (Annual):*</label>
                     <input onkeypress="return isNumberKey(event)" class="form-control" type="text" name="family_income" id="family_income" placeholder="Lakh">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Religion:*</label>
                     <input class="form-control" type="text" name="religion" id="religion">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label"><b>Father's Name in Full:*</b></label>
                     <input class="form-control" type="text" name="father_name" id="father_name">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label"><b>Educational & Professional Qualification:*</b></label>
                     <input class="form-control" type="text" name="father_qualify" id="father_qualify">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Occupation (with full details):*</label>
                     <input class="form-control" type="text" name="father_occupation" id="father_occupation">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Designation:*</label>
                     <input class="form-control" type="text" name="father_designation" id="father_designation">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Mobile No.:*</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="father_mobile" id="father_mobile">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Phone No.:</label>
                     <input maxlength="12" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="father_phone" id="father_phone" >                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Official Address:*</label>
                     <input class="form-control" type="text" name="father_ofc_address" id="father_ofc_address">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Monthly Income:*</label>
                     <input class="form-control" type="text" name="father_monthly_income" id="father_monthly_income">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label"><b>Mother's name in Full:*</b></label>
                     <input class="form-control" type="text" name="mother_name" id="mother_name">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Educational & Professional Qualification:</label>
                     <input class="form-control" type="text" name="mother_qualify" id="mother_qualify">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Occupation (with full details):</label>
                     <input class="form-control" type="text" name="mother_occupation" id="mother_occupation">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Designation:</label>
                     <input class="form-control" type="text" name="mother_designation" id="mother_designation">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Phone No.:</label>
                     <input maxlength="12" class="form-control" type="text" name="mother_phone" id="mother_phone">                     
                  </div>               
                
                <div class="form-group">
                     <label class="control-label">Mobile No:</label>
                     <input maxlength="12" class="form-control" type="text" name="mother_mobile" id="mother_mobile">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Official Address:</label>
                     <input class="form-control" type="text" name="mother_ofc_address" id="mother_ofc_address">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Monthly Income:</label>
                     <input onkeypress="return isNumberKey(event)" class="form-control" type="text" name="mother_monthly_income" id="mother_monthly_income">                     
                  </div>
                
                  
                   <div class="form-group">
                       
                     <label class="control-label">Upload Photo (Min Size:250 X 250)</label>
                     
                     <input class="form-control" type="file" name="applicant_image" id="applicant_image">
                     <div id="imageErr" style="color:#C33"></div>
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
    function getage()
{
    var dd=$("#date").val();
    var mm=$("#month").val();
    var yy=$("#year").val();
    
    if(dd!='' && mm!='' && yy!='')
    {
       var today_date = new Date();       
       var user_date = new Date(yy,mm,dd);

        var today_date = new Date();
        var diff_date =  today_date - user_date;

var num_years = diff_date/31536000000;
var num_months = (diff_date % 31536000000)/2628000000;
var num_days = ((diff_date % 31536000000) % 2628000000)/86400000;

if(Math.floor(num_years)>0)
{    
var age_diff=Math.floor(num_years)+" Years "+Math.floor(num_months)+" Month";
}else{var age_diff=Math.floor(num_months)+" Month";}

        
                    
        document.getElementById('age').value=age_diff;
    }
      
}

    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }
      
 $("#applicant_image").change(function (e) {    
   var _URL = window.URL;
   var file, img;
   var w,h;
   if ((file = this.files[0])) {
       img = new Image();
       img.onload = function () {
       w= this.width;
       h= this.height;       
       if(w<250 && h<250)
       {
           document.getElementById("imageErr").innerHTML='Image must be Min size 250 x 250 px';
           document.getElementById("applicant_image").value="";
           return false;
       }
       else
       {
           document.getElementById("imageErr").innerHTML='';
           return true;
       }
       
       };
       img.src = _URL.createObjectURL(file);
   }   
   
});  

function valid_frm() { 
        
        
        var fname = document.getElementById("fname").value;	
        var mname = document.getElementById("mname").value;	       
        
        var date = document.getElementById("date").value;	
        var month = document.getElementById("month").value;	
        var year = document.getElementById("year").value;	
        var raddress = document.getElementById("raddress").value;	
        
        var pincode = document.getElementById("pincode").value;	
        var child_contactno = document.getElementById("child_contactno").value;	
        var family_income = document.getElementById("family_income").value;	
        var religion = document.getElementById("religion").value;	
        var father_name = document.getElementById("father_name").value;	
        var father_qualify = document.getElementById("father_qualify").value;	
        var father_occupation = document.getElementById("father_occupation").value;	
       var father_designation = document.getElementById("father_designation").value;	
       var father_mobile = document.getElementById("father_mobile").value;	
       var father_ofc_address = document.getElementById("father_ofc_address").value;	       
       var father_monthly_income = document.getElementById("father_monthly_income").value;
       
       var mother_name = document.getElementById("mother_name").value;       
        
        
        var applicant_image = document.getElementById("applicant_image").value;
         
	var cnt=0;
        
         
	if(fname=='')
	{
		document.getElementById("fname").style.borderColor='red';
                 document.getElementById('fname').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("fname").style.borderColor='';}
        
        if(mname=='')
	{
		document.getElementById("mname").style.borderColor='red';
                 document.getElementById('mname').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("mname").style.borderColor='';}
        
        if(date=='')
	{
		document.getElementById("date").style.borderColor='red';
                 document.getElementById('date').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("date").style.borderColor='';}
        
        if(month=='')
	{
		document.getElementById("month").style.borderColor='red';
                 document.getElementById('month').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("month").style.borderColor='';}
        if(year=='')
	{
		document.getElementById("year").style.borderColor='red';
                 document.getElementById('year').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("year").style.borderColor='';}
        
        if(raddress=='')
	{
		document.getElementById("raddress").style.borderColor='red';
                 document.getElementById('raddress').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("raddress").style.borderColor='';}
        
        if(pincode=='')
	{
		document.getElementById("pincode").style.borderColor='red';
                 document.getElementById('pincode').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("pincode").style.borderColor='';}
        
        if(child_contactno=='')
	{
		document.getElementById("child_contactno").style.borderColor='red';
                 document.getElementById('child_contactno').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("child_contactno").style.borderColor='';}
        
        if(child_contactno.length<10)
             {
                 document.getElementById("child_contactno").style.borderColor='red';
                    document.getElementById('child_contactnoErr').innerHTML="Invalide phone no. !"; 
                    return false;
             }else{document.getElementById("child_contactno").style.borderColor='';
                 document.getElementById('child_contactnoErr').innerHTML="";}
        
        if(family_income=='')
	{
		document.getElementById("family_income").style.borderColor='red';
                 document.getElementById('family_income').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("family_income").style.borderColor='';}
        
        if(religion=='')
	{
		document.getElementById("religion").style.borderColor='red';
                 document.getElementById('religion').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("religion").style.borderColor='';}
        if(father_name=='')
	{
		document.getElementById("father_name").style.borderColor='red';
                 document.getElementById('father_name').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_name").style.borderColor='';}
        
        if(father_qualify=='')
	{
		document.getElementById("father_qualify").style.borderColor='red';
                 document.getElementById('father_qualify').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_qualify").style.borderColor='';}
        
         if(father_occupation=='')
	{
		document.getElementById("father_occupation").style.borderColor='red';
                 document.getElementById('father_occupation').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_occupation").style.borderColor='';}
        
        if(father_designation=='')
	{
		document.getElementById("father_designation").style.borderColor='red';
                 document.getElementById('father_designation').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_designation").style.borderColor='';}
        
        if(father_mobile=='')
	{
		document.getElementById("father_mobile").style.borderColor='red';
                 document.getElementById('father_mobile').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_mobile").style.borderColor='';}
        
        if(father_ofc_address=='')
	{
		document.getElementById("father_ofc_address").style.borderColor='red';
                 document.getElementById('father_ofc_address').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_ofc_address").style.borderColor='';}
        
        if(father_monthly_income=='')
	{
		document.getElementById("father_monthly_income").style.borderColor='red';
                 document.getElementById('father_monthly_income').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("father_monthly_income").style.borderColor='';}
        
        if(mother_name=='')
	{
		document.getElementById("mother_name").style.borderColor='red';
                 document.getElementById('mother_name').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("mother_name").style.borderColor='';}
        
        if(applicant_image=='')
	{
		document.getElementById("applicant_image").style.borderColor='red';
                 document.getElementById('applicant_image').focus(); 
                return false;
	    cnt++;
	}else{document.getElementById("applicant_image").style.borderColor='';}
        	
		
	if(applicant_image!='')
	{
                var ext = applicant_image.split('.').pop();
                
                if(ext!='png' && ext!='jpg' && ext!='gif' && ext!='JPG' && ext!='JPEG' && ext!='jpeg')
		{		
                 cnt++;   
		 document.getElementById('imageErr').innerHTML="Only (png,jpg,gif) format support!";	
		 document.getElementById('applicant_image').focus(); 		 
		}else{document.getElementById('imageErr').innerHTML="";}
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
		document.getElementById("add_kid").submit();
	}

}
</script>

<!--bs-callout bs-callout-danger alert-dismissable-->