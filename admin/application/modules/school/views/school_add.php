<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>
<link href="<?=base_url()?>public/css/autosugcss/jquery.coolautosuggest.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>public/css/autosugcss/jquery.coolfieldset.css" rel="stylesheet" type="text/css" />
<link href="<?=base_url()?>public/css/datepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/jquery.coolautosuggest.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/jquery.coolfieldset.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/bootstrap-datepicker.js"></script>
<script language="javascript" type="text/javascript" src="<?=base_url()?>public/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?=SiteUrl?>public/js/jquery.form.js"></script>
<style>
.form-group.required .control-label:after { content:"*"; color: red; }
</style>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h1 class="page-header"><small>Manage School</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>school"><i class="icon-file-alt"></i>School</a></li>
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
         <?php echo form_open(base_url().'school/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addschool","id"=>"addschool")) ?>

            <input type="hidden" name="schoolRegister" value='Register'>  
            <div class="col-lg-6">                                   
                   <div class="form-group">
                     <label class="control-label">School Name*</label>
                     <input class="form-control" type="text" name="school_name" id="school_name">
                     <div id="schoolErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Seo Url* (Word separated with dash "-")</label>
                     <input class="form-control" type="text" onblur="checkSeourl2(this.value)" name="seo_url" id="seo_url">
                     <div id="seo_urlErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Owner Name*</label>
                     <input class="form-control" type="text" name="owner_name" id="owner_name">                     
                  </div>
                 <div class="form-group">
                     <label class="control-label">Owner Email*</label>
                     <input class="form-control" type="text" name="email" id="email"> 
                     <div id="emailErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Password*</label>
                     <input class="form-control" type="password" name="password" id="password">  
                     <div id="passwordErr" style="color:#C33"></div>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Registration No.</label>
                     <input class="form-control" type="text" name="registrationno" id="registrationno">
                     <div id="registrationnoErr" style="color:#C33"></div>
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Owner Contact no*</label>
                     <input maxlength="12" class="form-control" type="text" name="contact_no" id="contact_no">                     <div id="contact_noErr" style="color:#C33"></div>
                  </div>
                 
                <div class="form-group">
                     <label class="control-label">Coordinator Name</label>
                     <input class="form-control" type="text" name="co_name" id="co_name">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Coordinator Email</label>
                     <input class="form-control" type="text" name="co_email" id="co_email">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Coordinator Contact no</label>
                     <input maxlength="12" class="form-control" type="text" name="co_contactno" id="co_contactno">                     
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Select Board</label>
                    <select class="form-control" id="board" name="board">
                    <option value="">- - Select - -</option>
                    <option value="cbse">CBSE</option>
                    <option value="igsce">IGSCE</option>
                    <option value="ib">IB</option>
                    <option value="state board">State Board</option>
                    <option value="other">Other</option>
                    </select>                     
                  </div>
                <div class="form-group">
                     <label class="control-label"> Select Category</label>
                        <select class="form-control" id="category" name="category">
                        <option value="">- - Select - -</option>
                         <option value="boarding">Boarding</option>
                        <option value="day boarding">Day Boarding</option>
                         <option value="play">Play</option>
                        <option value="primary">Primary</option>
                        <option value="secondary">Secondary</option>
                        <option value="senior secondary">Sr. Secondary</option>
                       
                        <option value="other">Other</option>
                        </select>
                  </div>
                <div class="form-group">
                     <label class="control-label">Select Sub Category</label>
                     <select class="form-control" id="sub_category" name="sub_category">
                    <option value="">- - Select Sub Category - -</option>
                    <option value="coed">Co-ed</option>
                    <option value="girls">Girls</option>
                    <option value="boys">Boys</option>
                    </select>
                  </div>
                          
                 
                <div class="form-group">
                     <label class="control-label">Phone No.</label>
                     <input class="form-control" type="text" name="phone" id="phone" maxlength="12">                    
                  </div>
            
                    
                   <div class="form-group">
                     <label class="control-label">Location/Address*</label>
                     <input class="form-control" type="text" name="address" id="address" > 
                     <div id="addressErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Latitude*</label>
                     <input class="form-control" type="text" name="latitude" id="latitude"> 
                  </div>
                <div class="form-group">
                     <label class="control-label">Longitude*</label>
                     <input class="form-control" type="text" name="langitude" id="langitude"> 
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Pin code*</label>
                     <input onKeyPress="return isNumberKey(event)" maxlength="10" class="form-control" type="text" name="pincode" id="pincode">                     
                  </div>   
                
                <div class="form-group">
                     <label class="control-label">Receptionist mobile</label>
                     <input onKeyPress="return isNumberKey(event)" maxlength="11" class="form-control" type="text" name="receptionist_mobile" id="receptionist_mobile">                     
               </div> 
                <div class="form-group">
                     <label class="control-label">Receptionist landline</label>
                     <input class="form-control" type="text" name="receptionist_landline" id="receptionist_landline">                     
               </div> 
                
                <div class="form-group">
                     <label class="control-label">Director mobile</label>
                     <input onKeyPress="return isNumberKey(event)" maxlength="11" class="form-control" type="text" name="director_mobile" id="director_mobile">                     
               </div> 
                
                <div class="form-group">
                     <label class="control-label">Director landline</label>
                     <input class="form-control" type="text" name="director_landline" id="director_landline">                     
               </div> 
                
                 <div class="form-group">
                     <label class="control-label">Facebook Url</label>
                     <input class="form-control" type="text" name="facebookurl" id="facebookurl">                     
               </div> 
                <div class="form-group">
                     <label class="control-label">Twitter Url</label>
                     <input class="form-control" type="text" name="twitterurl" id="twitterurl">                     
               </div> 
                 <div class="form-group">
                     <label class="control-label">Googleplus Url</label>
                     <input class="form-control" type="text" name="googleplusurl" id="googleplusurl">                     
               </div> 
                
                
                
                
                   <div class="form-group">
                       <label class="control-label">Website <span>(e.g. www.abc.com) </span></label>
                     <input class="form-control" type="text" name="website" id="website">
                     <div id="websiteErr" style="color:#C33"></div>
                  </div>
                <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(function() {
    
$( "#established_date" ).datepicker({ 
            dateFormat: "dd-mm-yy",
             changeYear:true
            });
            $( "#start_date" ).datepicker({ 
            dateFormat: "mm/dd/yy",
            changeYear:true
            });
});
</script>
                <div class="form-group">
                     <label class="control-label">Established Date</label>
                     <input class="form-control" type="text" name="established_date" id="established_date">                     
                     <div id="established_dateErr" style="color:#C33"></div>
                  </div>
                       
                   <div class="form-group">
                     <label class="control-label">About School</label>                     
                     <textarea name="description" id="content" class="form-control"></textarea>    
                      <input type="hidden" name="description_test" id="description_test"/>
                     <?php echo display_ckeditor($ckeditor_2); ?>
                  </div>
                           
                   <div class="form-group">
                     <label class="control-label">Admission Procedure</label>                                         
                     <textarea name="admission_detail" id="admission_detail"></textarea>
                     <input type="hidden" name="admission_detail_test" id="admission_detail_test"/>
                     <?php echo display_ckeditor($ckeditor_5); ?>
                  </div>
                  <div class="form-group">
                     <label class="control-label">Curriculum</label>                                         
                     <textarea name="curriculum" id="curriculum"></textarea>
                     <input type="hidden" name="curriculum_test" id="curriculum_test"/>
                     <?php echo display_ckeditor($ckeditor_6); ?>
                  </div>
                   
                   <div class="form-group">
                     <label class="control-label">Facility</label>                                         
                     <textarea name="facility" id="facility"></textarea>
                     <input type="hidden" name="facility_test" id="facility_test"/>
                     <?php echo display_ckeditor($ckeditor_7); ?>
                  </div>

                           
                   <div class="form-group">
                     <label class="control-label">State*</label>
                     <select class="form-control" name="state" id="state" onchange="areashow(this.value);">
            <option value="">--Select State--</option>
			<?php foreach($states AS $state){?>
            <option value="<?php echo $state['zone_id']?>"><?php echo $state['name']?></option>
            <?php }?>
            </select>
                     <div id="stateErr" style="color:#C33"></div>
                  </div>
                           
                   <div class="form-group" id="area_divid">
                     <label class="control-label">Area*</label>
                     <span id="areadivid">
                     <select class="form-control" name="area" id="area">
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
                     <label class="control-label">Cover Image (Min Size:1354 X 425)</label>                     
                     <input class="form-control" type="file" name="image" id="image">
                     <div id="imageErr" style="color:#C33"></div>
                  </div>
                             
                   <div class="form-group">
                     <label class="control-label">Thumbnail Image (Min Size:300 X 200)</label>                     
                     <input class="form-control" type="file" name="thumbnail" id="thumbnail">
                     <div id="thumbnailimageErr" style="color:#C33"></div>
                  </div>
                 
                 <div class="form-group">
                     <label class="control-label">Newly Added</label>                    
                     <input type="checkbox" name="newly_open" id="newly_open">                     
                  </div>
                  <!-- <div class="form-group">
                     <label class="control-label">Best School</label>                    
                     <input type="checkbox" name="featured" id="featured">                     
                  </div> -->

                  <div class="form-group">
                     <label class="control-label">Admission Open</label>                    
                     <input type="checkbox" name="admission_open" id="admission_open">                     
                  </div>
                   <div class="form-group">
                     <label class="control-label">Ispaid*</label>                    
                     <select class="form-control" style="max-width:120px;" id="ispaid" name="ispaid" onchange="openpaid_div(this.value);">                   
                    <option value="n">No</option>
                    <option value="y">Yes</option>
                    </select> 
                  </div>
              <div id="paid_div" style="display:none">
                    <div class="form-group">
                     <label class="control-label">Select Duration*</label>
                     <select style="max-width:200px;" name="duration" id="duration" class="form-control">                         
                         <option value="3month">3 Month</option>
                         <option value="6month">6 Month</option>
                         <option value="1year">1 Year</option>
                         <option value="2year">2 Year</option>
                     </select>                     
                  </div>
                 <div class="form-group">
                     <label class="control-label">Amount*</label>
                     <input style="max-width:200px;" class="form-control" onKeyPress="return isNumberKey(event)" maxlength="8" type="text" name="amount" id="amount">                     
                  </div>
                  <div class="form-group">
                     <label class="control-label">Start Date</label>
                     <input class="form-control" type="text" name="start_date" id="start_date">                                          
                  </div>
                  
              </div>
                
                
              </div> 
             
                <div class="form-group" style="padding-top:30px;">
               <img style="display:none;" id="loader" src="<?=base_url()?>/public/images/loader.gif">
               <button tabindex="27" type="button" class="btn btn-primary" id="loader_button" onclick="valid_frm()">Submit</button>
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
    
     $("#image").change(function (e) {    
   var _URL = window.URL;
   var file, img;
   var w,h;
   if ((file = this.files[0])) {
       img = new Image();
       img.onload = function () {
       w= this.width;
       h= this.height;       
       if(w<1354 && h<425)
       {
           document.getElementById("imageErr").innerHTML='Image must be Min size 1354 X 425 px';
           document.getElementById("image").value="";
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

$("#thumbnail").change(function (e) {    
   var _URL = window.URL;
   var file, img;
   var w,h;
   if ((file = this.files[0])) {
       img = new Image();
       img.onload = function () {
       w= this.width;
       h= this.height;       
       if(w<300 && h<200)
       {
           document.getElementById("thumbnailimageErr").innerHTML='Image must be Min size 300 X 200 px';
           document.getElementById("thumbnail").value="";
           return false;
       }
       else
       {
           document.getElementById("thumbnailimageErr").innerHTML='';
           return true;
       }
       
       };
       img.src = _URL.createObjectURL(file);
   }   
   
});

    function openpaid_div(v)
    {
        if(v=='y')
        {
         $("#paid_div").show();
        }else{ $("#paid_div").hide();} 
    }
    
    function isNumberKey(evt)

      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;



         return true;

      }
      
    function isNumberKey3(evt,val,idval)
      {
	  
	   if(val.charAt(0)=='0'){ document.getElementById(idval).value=""; return false;}
	   
         var charCode = (evt.which) ? evt.which : event.keyCode			 

         if (charCode > 31 && (charCode < 48 || charCode > 57))
		 { 
		   return false;		
		}else{			 	     
		  return true;	
		 }

      }	 
      
function locationshow(areaid)
{
 
	   var strURL='<?=base_url()?>school/getlocation?areaid='+areaid;         
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
  
	  var strURL='<?=base_url()?>school/getarea?state_id='+state_id; 
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

function checkSeourl2(seourl)
{
    $.post("<?php echo base_url()?>school/checkSeourl2",{seourl:seourl},function(response) {
	  
	   var response= response.replace(/^[\s]+/,'').replace(/[\s]+$/,'').replace(/[\s]{2,}/,' ');
           if(response=='exist')
           {   document.getElementById("seo_url").style.borderColor='red';	 
               document.getElementById('seo_url').focus();                     
               document.getElementById('seo_urlErr').innerHTML="Already Exist !";
               return false;
           }else{
            document.getElementById("seo_url").style.borderColor='';   
            document.getElementById('seo_urlErr').innerHTML="";}
          	 
		 });
    
}

function valid_frm() { 
	var school_name = document.getElementById("school_name").value;    
        var seo_url=document.getElementById("seo_url").value;     
        var owner_name= document.getElementById("owner_name").value;  
         var contact_no = document.getElementById("contact_no").value;
        var address = document.getElementById("address").value;
        var website = document.getElementById("website").value;
        var email=document.getElementById('email').value;
        var state=document.getElementById('state').value;
        var area=document.getElementById('area').value;
        var location=document.getElementById('location').value;
	var latitude=document.getElementById('latitude').value;
        var langitude=document.getElementById('langitude').value;
        var password=document.getElementById('password').value;
         //var registrationno=document.getElementById('registrationno').value;
        var pincode= document.getElementById('pincode').value;
                
        var description=CKEDITOR.instances.content.getData();
        document.getElementById("description_test").value=description;
        
        var description3=CKEDITOR.instances.admission_detail.getData();
        document.getElementById("admission_detail_test").value=description3;
        
        var description4=CKEDITOR.instances.curriculum.getData();
        document.getElementById("curriculum_test").value=description4;
        var description5=CKEDITOR.instances.facility.getData();
        document.getElementById("facility_test").value=description5;
        
        
	var cnt=0;        
        var aa=/\s/;
        
	if(school_name=='')
	{
	    document.getElementById("school_name").style.borderColor='red';
            document.getElementById('school_name').focus();
	    cnt++;
            return false;
	}else{document.getElementById("school_name").style.borderColor='';}
        
        if(seo_url=='')
	{
	    document.getElementById("seo_url").style.borderColor='red';
            document.getElementById('seo_url').focus();            
	    cnt++;
            return false;
	}else{document.getElementById("seo_url").style.borderColor='';}
        
         if(aa.test(seo_url))
	 {
             	document.getElementById("seo_url").style.borderColor='red';
                document.getElementById("seo_url").focus();		
		document.getElementById('seo_urlErr').innerHTML="Blank space not allowed !"; 
                return false;
	 }else{document.getElementById('seo_urlErr').innerHTML="";}
        
        if(owner_name=='')
	{
	    document.getElementById("owner_name").style.borderColor='red';
            document.getElementById('owner_name').focus();            
	    cnt++;
            return false;
	}else{document.getElementById("owner_name").style.borderColor='';}
        
        
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
                
         
         if(contact_no=='')
	{
		document.getElementById("contact_no").style.borderColor='red';
                document.getElementById('contact_no').focus();		                        
                        return false;
	    cnt++;
	}else{document.getElementById("contact_no").style.borderColor='';}
	 
	if(contact_no!='')
	{
         if(contact_no.length<10)
         {
             document.getElementById("contact_no").style.borderColor='red';
             document.getElementById('contact_noErr').innerHTML="Invalid contact no."; 
             document.getElementById('contact_no').focus();
                return false;
         }else{document.getElementById("contact_no").style.borderColor='';
             document.getElementById('contact_noErr').innerHTML="";}
      }
        
        if(address=='')
	{
		document.getElementById("address").style.borderColor='red';
                document.getElementById('address').focus();
                cnt++;
                return false;
	    
	}else{document.getElementById("address").style.borderColor='';}
        
         if(pincode=='')
	{
		document.getElementById("pincode").style.borderColor='red';
                document.getElementById('pincode').focus();
                cnt++;
                return false;
	    
	}else{document.getElementById("pincode").style.borderColor='';}
        
        
        if(latitude=='')
	{
		document.getElementById("latitude").style.borderColor='red';
                document.getElementById('latitude').focus();
                cnt++;
                return false;
	    
	}else{document.getElementById("latitude").style.borderColor='';}
        
        if(langitude=='')
	{
		document.getElementById("langitude").style.borderColor='red';
                document.getElementById('langitude').focus();
                cnt++;
                return false;
	    
	}else{document.getElementById("langitude").style.borderColor='';}
        
        
        
        if(website!='') 
        {
          var web= /^(www)+\.[a-zA-Z0-9_\-\.]+\.([A-Za-z]{2,4})$/;	
	  var web2= /^(www)+\.[a-zA-Z0-9_\-\.]+\.([A-Za-z]{2,4})+\.([A-Za-z]{2,4})$/;
         
         if(web.test(website)==false && web2.test(website)==false)
	 {
		document.getElementById("website").style.borderColor='red';
                document.getElementById('website').focus();		
		document.getElementById('websiteErr').innerHTML="Invalid domain name !";			
		return false;
	 }else{document.getElementById("website").style.borderColor='';
             document.getElementById('websiteErr').innerHTML="";}
       } 
       
        
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
         
         
         var ispaid=document.getElementById('ispaid').value;
         
         if(ispaid=='y')
         {
             var amount=document.getElementById('amount').value;
             if(amount=='')
	    {     
	       document.getElementById("amount").style.borderColor='red';	               		
               document.getElementById('amount').focus();
               return false;
	    }else{document.getElementById("amount").style.borderColor='';
                }
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
		//document.getElementById("addschool").submit();
                $("#addschool").ajaxForm({
                success: function(response) { 
                  if(response=="exist_email"){
                      document.getElementById("email").style.borderColor='red';	 
                     document.getElementById('email').focus();                     
                     document.getElementById('emailErr').innerHTML="Email-id Already Exist !";
                      document.getElementById("loader_button").style.display='block';
                     document.getElementById("loader_button2").style.display='block';
                     document.getElementById("loader").style.display='none';    
                     return false;
                 }else if(response=="seoexist")
                 {
                       document.getElementById("seo_url").style.borderColor='red';	 
                        document.getElementById('seo_url').focus();                     
                        document.getElementById('seo_urlErr').innerHTML="Already Exist! Seo url must be unique.";
                        document.getElementById("loader_button").style.display='block';
                     document.getElementById("loader_button2").style.display='block';
                     document.getElementById("loader").style.display='none';
                        return false;
                 }else{ window.location="<?php echo base_url()?>school/";}
                 
                }
                }).submit();
	}

}



</script>
<!--bs-callout bs-callout-danger alert-dismissable-->