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
      <h1 class="page-header"><small>Manage Admission</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>admission"><i class="icon-file-alt"></i>Admission</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>  
  <a style="text-decoration:none;" href="<?=base_url().'admission';?>"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'admission/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"admission_form","id"=>"admission_form","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="admissionForm" value='admissionForm'>   
            <input type="hidden" name="admission_id" value='<?php echo $results['id']?>'>      
            <input type="hidden" id="hidden_image" name="hidden_image" value='<?php echo $results['applicantimage']?>'>
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">First Name*</label>
                     <input class="form-control" type="text" name="fname" id="fname" value="<?php echo $results['fname']?>">
                     <div id="image_titleErr" style="color:#C33"></div>
                  </div>  
                                             
                   <div class="form-group">
                     <label class="control-label">Middle Name</label>
                   <input class="form-control" type="text" name="mname" id="mname" value="<?php echo $results['mname']?>">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Surname</label>
                   <input class="form-control" type="text" name="lname" id="lname" value="<?php echo $results['lname']?>">
                  </div>
                <?php $arr=explode("/",$results['dob']);
                
                $dd=$arr[0];
                $mm=$arr[1];
                $yy=$arr[2];
                ?>
                <div class="form-group">
                     <label class="control-label">Date of Birth</label>
                  <select name="date" id="date" class="birth-field">
                    <option value="">Date</option>  
                    <? for($i=1;$i<=31;$i++){?>
                    <option <?php if($dd==$i){?> selected<?php }?> value="<?=$i?>"><?=$i?></option>                    
                    <? }?>
                    </select>
                    <?php
					$montarr=array('January','February','March','April','May','June','July','August','September','October','November','December');
					?>
                     <select name="month" id="month" class="birth-field">  
                    <option value="">Month</option>                 
                    <?php 
					$j=0;
					for($i=0;$i<12;$i++){
					$j++;
					?>
                    <option <?php if($mm==$j){?> selected<?php }?> value="<?=$j?>"><?=$montarr[$i]?></option>                                 
                    <? }?>
                   
                    </select> 
                     <?php
					$st=1980;
					$curyear=date('Y')-10;
					?>
                     <select name="year" id="year" class="birth-field">
                    <option value="">Year</option>
                   <? for($i=$st;$i<=$curyear;$i++){?>
                    <option <?php if($yy==$i){?> selected<?php }?> value="<?=$i?>"><?=$i?></option>                    
                    <? }?>
                    </select>   
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Present Age (in words)</label>
                     <input value="<?php echo $results['age']?>" class="form-control" onkeypress="return stringonly(event)" type="text" name="age" id="age">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Sex</label>
                   <input type="radio" name="gender" <?php if($results['gender']=='male'){?> checked <?php }?> value="male"> Male <input <?php if($results['gender']=='female'){?> checked <?php }?> name="gender" type="radio" value="female"> Female
                  </div>
                <div class="form-group">
                     <label class="control-label">Residence Address</label>
                     <input class="form-control" type="text" name="raddress" id="raddress" value="<?php echo $results['raddress']?>">
                  </div>
               
                 <div class="form-group">
                     <label class="control-label">Pin Code</label>
                     <input class="form-control" value="<?php echo $results['pincode']?>" maxlength="10" onkeypress="return isNumberKey(event)" type="text" name="pincode" id="pincode">
                  </div>
                <div class="form-group">
                     <label class="control-label">Phone No</label>
                     <input class="form-control" type="text" value="<?php echo $results['contactno']?>" maxlength="12" onkeypress="return isNumberKey(event)" type="text" name="contactno" id="contactno">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Our Residence is</label>
                     <input class="form-control" value="<?php echo $results['rdistance']?>" onkeypress="return isNumberKey(event)" name="rdistance" id="rdistance">
                  </div>
                <div class="form-group">
                     <label class="control-label">Family Income (Annual)</label>
                     <input class="form-control" type="text" value="<?php echo $results['family_income']?>" onkeypress="return isNumberKey(event)" name="family_income" id="family_income">
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Religion</label>
                     <input type="radio" <?php if($results['religion']=='hindu'){?> checked <?php }?> value="hindu" name="religion"> Hindu <input name="religion" type="radio" value="muslim" <?php if($results['religion']=='muslim'){?> checked <?php }?>> Muslim <input <?php if($results['religion']=='sikh'){?> checked <?php }?> value="sikh" name="religion" type="radio"> Sikh <input name="religion" <?php if($results['religion']=='christian'){?> checked <?php }?> type="radio" value="christian"> Christian
                  </div>
                <div class="form-group">
                     <label class="control-label">Father's Name in Full</label>
                     <input class="form-control" type="text" value="<?php echo $results['father_name']?>" name="father_name" id="father_name">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Father's Name in Full</label>
                     <input class="form-control" type="text" value="<?php echo $results['father_qualify']?>" name="father_qualify" id="father_qualify">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Occupation (with full details)</label>
                     <input class="form-control" type="text" value="<?php echo $results['father_occupation']?>" name="father_occupation" id="father_occupation">
                  </div>
                <div class="form-group">
                     <label class="control-label">Designation</label>
                     <input class="form-control" type="text" value="<?php echo $results['father_designation']?>" name="father_designation" id="father_designation">
                  </div>
                <div class="form-group">
                     <label class="control-label">Mobile No.</label>
                     <input class="form-control" value="<?php echo $results['father_designation']?>" maxlength="12" onkeypress="return isNumberKey(event)" name="father_mobile" id="father_mobile" type="text">
                  </div>
                <div class="form-group">
                     <label class="control-label">Phone No.</label>
                     <input class="form-control" value="<?php echo $results['father_designation']?>" maxlength="12" onkeypress="return isNumberKey(event)" name="father_phone" id="father_phone" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Official Address</label>
                     <input class="form-control" value="<?php echo $results['father_ofc_address']?>" name="father_ofc_address" id="father_ofc_address" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Monthly Income</label>
                     <input class="form-control" value="<?php echo $results['father_monthly_income']?>" name="father_monthly_income" id="father_monthly_income" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Mother's name in Full</label>
                     <input class="form-control" value="<?php echo $results['mother_name']?>" name="mother_name" id="mother_name" type="text">
                  </div>
                <div class="form-group">
                     <label class="control-label">Educational & Professional Qualification</label>
                     <input class="form-control" value="<?php echo $results['mother_qualify']?>" name="mother_qualify" id="mother_qualify" type="text">
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Occupation (with full details)</label>
                     <input class="form-control" value="<?php echo $results['mother_occupation']?>" name="mother_occupation" id="mother_occupation" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Designation</label>
                     <input class="form-control" value="<?php echo $results['mother_designation']?>" name="mother_designation" id="mother_designation" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Phone No.</label>
                     <input class="form-control" maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $results['mother_phone']?>" name="mother_phone" id="mother_phone" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Mobile No.</label>
                     <input class="form-control" maxlength="12" onkeypress="return isNumberKey(event)" value="<?php echo $results['mother_mobile']?>" name="mother_mobile" id="mother_mobile" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Official Address</label>
                     <input class="form-control" value="<?php echo $results['mother_ofc_address']?>" name="mother_ofc_address" id="mother_ofc_address" type="text">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Monthly Income</label>
                     <input class="form-control" value="<?php echo $results['mother_monthly_income']?>" name="mother_monthly_income" id="mother_monthly_income" type="text">
                  </div>
                                
                <div class="form-group">
                     <label class="control-label">Upload photo* (Size Max:300 X 300)</label>                     
                     <img src="<?php echo SiteUrl?>timthumb.php?src=<?php echo SiteUrl?>public/applicantimage/<?php echo $results['applicantimage']?>&w=150&h=130" />
                    <input id="uploadFile" placeholder="Choose File" disabled="disabled" class="file" /> 
                     <input class="upload" type="file" name="applicant_image" id="applicant_image" value="<?php echo $results['applicantimage']?>">                     
                     <div id="applicant_image_error" style="color:#C33"></div>
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
    $("#applicant_image").change(function (e) {    
   var _URL = window.URL;
   var file, img;
   var w,h;
   if ((file = this.files[0])) {
       img = new Image();
       img.onload = function () {
       w= this.width;
       h= this.height;       
       if(w>300 && h>300)
       {
           document.getElementById("applicant_image_error").innerHTML='Image must be 500 x 500 px';
           document.getElementById("applicant_image").value="";
           return false;
       }
       else
       {
           document.getElementById("applicant_image_error").innerHTML='';
           return true;
       }
       
       };
       img.src = _URL.createObjectURL(file);
   }   
   document.getElementById("uploadFile2").value = this.value;
   
});  


function stringonly(evt)
{
// alert(vall);
 evt = (evt) ? evt : event;
            var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
          ((evt.which) ? evt.which : 0));
            if (charCode > 32 && (charCode < 65 || charCode > 90) &&
          (charCode < 97 || charCode > 122)) {
                return false;
            }
            return true;
 
}
    function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;



         return true;

      }
      
   
function valid_frm() { 
        
        
       var fname=$("#fname").val();
            var date=$("#date").val();
            var month=$("#month").val();
            var year=$("#year").val();
            var address=$("#address").val();
            var age=$("#age").val();
            var raddress=$("#raddress").val();
            
            var pincode=$("#pincode").val();
            var contactno=$("#contactno").val();
            var rdistance=$("#rdistance").val();
            var family_income=$("#family_income").val();
            
          var father_name=$("#father_name").val();
          var father_qualify=$("#father_qualify").val();
          var father_designation=$("#father_designation").val();
          var father_mobile=$("#father_mobile").val();
          var father_ofc_address=$("#father_ofc_address").val();
          var father_monthly_income=$("#father_monthly_income").val();
          
          
          
          var mother_name=$("#mother_name").val();
          var mother_qualify=$("#mother_qualify").val();          
            
            
            var applicant_image=$("#applicant_image").val();
             var hidden_image=$("#hidden_image").val();
            
        
        
            
            if(fname=='')
            {
                document.getElementById("fname").style.borderColor='red';
                document.getElementById('fname').focus();
                return false;
            }else{                 
                 document.getElementById("fname").style.borderColor='';}
             
             
             
             
             if(date=='')
            {
                document.getElementById("date").style.borderColor='red';
                document.getElementById('date').focus();
                return false;
            }else{                 
                 document.getElementById("date").style.borderColor='';}
             
             if(month=='')
            {
                document.getElementById("month").style.borderColor='red';
                document.getElementById('month').focus();
                return false;
            }else{                 
                 document.getElementById("month").style.borderColor='';}
             
             if(year=='')
            {
                document.getElementById("year").style.borderColor='red';
                document.getElementById('year').focus();
                return false;
            }else{                 
                 document.getElementById("year").style.borderColor='';}
             
             
         if(applicant_image=='' && hidden_image=='')
	{
	   document.getElementById("uploadFile").style.borderColor='red';
           document.getElementById('applicant_image').focus();
           document.getElementById("admission_form").scrollIntoView();
	   return false;
	}else{document.getElementById("uploadFile").style.borderColor='';}
        
        if(applicant_image!='')
	{
                var ext = applicant_image.split('.').pop();
                
                if(ext!='png' && ext!='jpg' && ext!='gif' && ext!='JPG' && ext!='JPEG' && ext!='jpeg')
		{
		 document.getElementById('applicant_image_error').innerHTML="Only (png,jpg,gif) format support!";	
		 document.getElementById('applicant_image').focus(); 	
                 document.getElementById("admission_form").scrollIntoView();
                 return false;
		}else{document.getElementById('applicant_image_error').innerHTML="";}
        }
             
             
             if(age=='')
            {
                document.getElementById("age").style.borderColor='red';
                document.getElementById('age').focus();
                return false;
            }else{                 
                 document.getElementById("age").style.borderColor='';}
             
            if(raddress=='')
            {
                document.getElementById("raddress").style.borderColor='red';
                document.getElementById('raddress').focus();
                return false;
            }else{                 
                 document.getElementById("raddress").style.borderColor='';}
             
             if(pincode=='')
            {
                document.getElementById("pincode").style.borderColor='red';
                document.getElementById('pincode').focus();
                return false;
            }else{                 
                 document.getElementById("pincode").style.borderColor='';}
                          
            
            if(contactno=='')
            {
                document.getElementById("contactno").style.borderColor='red';
                document.getElementById('contactno').focus();
                return false;
            }else{                 
                 document.getElementById("contactno").style.borderColor='';}
             
             if(rdistance=='')
            {
                document.getElementById("rdistance").style.borderColor='red';
                document.getElementById('rdistance').focus();
                return false;
            }else{                 
                 document.getElementById("rdistance").style.borderColor='';}
             
             if(family_income=='')
            {
                document.getElementById("family_income").style.borderColor='red';
                document.getElementById('family_income').focus();
                return false;
            }else{                 
                 document.getElementById("family_income").style.borderColor='';}
             
             if(father_name=='')
            {
                document.getElementById("father_name").style.borderColor='red';
                document.getElementById('father_name').focus();
                return false;
            }else{                 
                 document.getElementById("father_name").style.borderColor='';}
             
             if(father_qualify=='')
            {
                document.getElementById("father_qualify").style.borderColor='red';
                document.getElementById('father_qualify').focus();
                return false;
            }else{                 
                 document.getElementById("father_qualify").style.borderColor='';}
             
             if(father_occupation=='')
            {
                document.getElementById("father_occupation").style.borderColor='red';
                document.getElementById('father_occupation').focus();
                return false;
            }else{                 
                 document.getElementById("father_occupation").style.borderColor='';}
             
             if(father_designation=='')
            {
                document.getElementById("father_designation").style.borderColor='red';
                document.getElementById('father_designation').focus();
                return false;
            }else{                 
                 document.getElementById("father_designation").style.borderColor='';}
             
             if(father_mobile=='')
            {
                document.getElementById("father_mobile").style.borderColor='red';
                document.getElementById('father_mobile').focus();
                return false;
            }else{                 
                 document.getElementById("father_mobile").style.borderColor='';}
             
             if(father_ofc_address=='')
            {
                document.getElementById("father_ofc_address").style.borderColor='red';
                document.getElementById('father_ofc_address').focus();
                return false;
            }else{                 
                 document.getElementById("father_ofc_address").style.borderColor='';}
             
             if(father_monthly_income=='')
            {
                document.getElementById("father_monthly_income").style.borderColor='red';
                document.getElementById('father_monthly_income').focus();
                return false;
            }else{                 
                 document.getElementById("father_monthly_income").style.borderColor='';}
             
           if(mother_name=='')
            {
                document.getElementById("mother_name").style.borderColor='red';
                document.getElementById('mother_name').focus();
                return false;
            }else{                 
                 document.getElementById("mother_name").style.borderColor='';}  
            if(mother_qualify=='')
            {
                document.getElementById("mother_qualify").style.borderColor='red';
                document.getElementById('mother_qualify').focus();
                return false;
            }else{                 
                 document.getElementById("mother_qualify").style.borderColor='';}  
        
        
	
		document.getElementById("loader_button").style.display='none';
                document.getElementById("loader_button2").style.display='none';
		document.getElementById("loader").style.display='block';
		document.getElementById("admission_form").submit();
	

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->