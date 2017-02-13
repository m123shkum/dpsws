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
      <h1 class="page-header"><small>Manage School Job</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>school/event/<?php echo $school_id?>"><i class="icon-file-alt"></i>School Job</a></li>
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
         <?php echo form_open(base_url().'school/addjob/'.$school_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addjob_form","id"=>"addjob_form","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="jobForm" value='jobForm'>  
            <input type="hidden" name="school_id" value='<?php echo $school_id?>'>              
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Job Title*</label>
                     <input class="form-control" type="text" name="job_title" id="job_title">
                     <div id="job_title_error" style="color:#C33"></div>
                  </div>    
                <div class="form-group">
                     <label class="control-label">Ref Code*</label>
                     <input class="form-control" type="text" name="reference_code" id="reference_code">     
                     <div id="refcode_error" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Job Type</label>
                    <input name="job_type" id="permanent" type="radio" value="permanent" checked/> Permanent
             <input name="job_type" id="temporary" type="radio" value="temporary" /> Temporary
             <input name="job_type" id="internship" type="radio" value="internship" /> Internship
                  </div>
                
                <div class="form-group">
                     <label class="control-label">No. of vacancies</label>
                     <input style="width:60px;" onKeyPress="return isNumberKey(event)" class="form-control" type="text" name="nov" id="nov">                          
                  </div>
                 <div class="form-group">
                     <label class="control-label">Job Summary</label>
                    <textarea name="job_summary_description" id="job_summary_description" class="form-control"></textarea>
                        <?php echo display_ckeditor($ckeditor_2); ?>
                  </div>
                
                
                   <div class="form-group">
                     <label class="control-label">Job Details</label>
                     <textarea name="job_detail" id="job_detail" class="form-control"></textarea> 
                     <?php echo display_ckeditor($ckeditor_3); ?>                     
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Specify UG Qualifications</label>
                     <select name="ug-qualifications" id="ug-qualifications" class="form-control">           
                      <option value="" selected="selected">Select UG Qualifications</option>              
                            <option value="B.tech/B.E">B.tech/B.E</option>
                            <option value="Diploma">Diploma</option>
                            <option value="B.Sc">B.Sc</option>
                            <option value="B.Com">B.Com</option>
                            <option value="B.A">B. A.</option>
                            <option value="B.Arch">B.Arch</option>
                            <option value="BBA">BBA</option>
                            <option value="B.Pharma">B.Pharma</option>
                            <option value="BCA">BCA</option>
                            <option value="BDS">BDS</option>
                            <option value="BHM">BHM</option>
                            <option value="BVSC">BVSC</option>
                            <option value="LLB">LLB</option>
                            <option value="MBBS">MBBS</option>
                        </select>                   
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Specify PG Qualifications</label>
                    <select name="pg-qualifications" id="pg-qualifications" class="form-control">
            <option value="">Select PG Qualifications</option>
            <option value="M.tech">M.tech</option>
                            <option value="MBA/PGDM">MBA/PGDM</option>
                            <option value="MCA">MCA</option>
                            <option value="M.sc">M.Sc</option>                            
                            <option value="CA">CA</option>
                            <option value="CS">CS</option>
                            <option value="ICWA">ICWA</option>
                            <option value="Integrated PG">Integrated PG</option>
                            <option value="LLM">LLM</option>
                            <option value="M.A">M. A.</option>
                            <option value="M.Arch">M.Arch</option>
                            <option value="M.Ed">M.Ed</option>
                            <option value="M.Pharma">M.Pharma</option>
                            <option value="M.S/M.D">M.S/M.D</option>
                            <option value="MVSC">MVSC</option>
                            <option value="PG Diploma">PG Diploma</option>
            </select>                    
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Specify Doctorate/Ph.D</label>
                    <select name="doctorate" id="doctorate" class="form-control">
            
            <option value="">Select Doctorate</option>
            <option value="Doctrate Not Required">Doctrate Not Required</option>
                            <option value="Any Doctrate">Any Doctrate</option>
                            <option value="Ph.D">Ph.D</option>
                            <option value="M.Phil">M.Phil</option>
                            
            </select>                  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Other Qualification</label>
                    <input type="text" name="other_qualification" id="other-qualification" class="form-control"/>          
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Experience</label>
                     <select style="width:120px; display: inline;" name="minimum-experience" id="minimum-experience" onchange="getmaxvalue(this.value);" class="form-control">
             <option value="0">Minimum </option>
             <option value="0">Fresher</option>
			<?php for($i=1;$i<=50;$i++){?>
            <option value="<?php echo $i?>"><?php echo $i?></option>
            <?php }?>
             </select> 
                <span id="maxid">             
             <select style="width:120px; display: inline;" name="maximum-experience" id="maximum-experience" class="form-control">
             <option value="0"> Maximum </option>
             <?php for($i=1;$i<=50;$i++){?>
             <option value="<?php echo $i?>"><?php echo $i?></option>
             <?php }?>
             </select>
             </span>Years
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Salary</label>
                    <select style="width:120px; display: inline;" name="minimum_salary" id="minimum_salary" onchange="getmaxsalary(this.value);" class="form-control">
             <option value="0"> Minimum </option>
             <?php for($i=1;$i<=50;$i++){?>
            <option value="<?php echo $i*100000?>"><?php echo $i?></option>
            <?php }?>  
             </select> 
              <span id="maxsalid">              
             <select style="width:120px; display: inline;" name="maximum_salary" id="maximum_salary" class="form-control">
             <option value="0"> Maximum </option>
             <?php for($i=1;$i<=50;$i++){?>                                
                                <option value="<?php echo $i*100000?>"><?php echo $i?></option>
                                <?php }?> 
             </select>
             </span>Per Annum(In Lakhs)
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Job Location*</label>
                    <select name="job_location" id="job_location" class="form-control">
            <option value="">Select a Location</option>
            <?php foreach($citys AS $city){
				$cityname=ucfirst(strtolower($city['name']));
				?>
            <option value="<?php echo $cityname?>"><?php echo $cityname?></option>
            <?php }?>
            </select>
            <span id="location_error" style="color:#C33"></span>  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Keywords/skills*</label>
                    <input class="form-control" type="text" name="skills" id="skills"/>  
            <span id="skills_error" style="color:#C33"></span>  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Role*</label>
                    <input class="form-control" type="text" name="role" id="role"/>  
            <span id="role_error" style="color:#C33"></span>  
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
    

function valid_frm() { 
        
       var job_title=document.getElementById("job_title").value;
        var reference_code=document.getElementById("reference_code").value;
        var skills=document.getElementById("skills").value;
        var role=document.getElementById("role").value;
        var job_location=document.getElementById("job_location").value;
        
        
        if(job_title=='')
        {          
            document.getElementById("scrolopen").scrollIntoView();
            document.getElementById('job_title').focus();
            document.getElementById('job_title_error').innerHTML="Please enter job title";
           return false;
        }document.getElementById('job_title_error').innerHTML="";  
        
        if(reference_code=='')
        {          
            document.getElementById("scrolopen").scrollIntoView();
            document.getElementById('reference_code').focus();
           document.getElementById('refcode_error').innerHTML="Please enter reference code";
           return false;
        }document.getElementById('refcode_error').innerHTML=""; 
        
        
        if(job_location=='')
        {          
            
            document.getElementById('scrolopen').focus();
           document.getElementById('location_error').innerHTML="Please select location";
           return false;
        }document.getElementById('location_error').innerHTML=""; 
        
        if(skills=='')
        {          
            
            document.getElementById('skills').focus();
           document.getElementById('skills_error').innerHTML="Please enter Keywords/skills";
           return false;
        }document.getElementById('skills_error').innerHTML="";  
        
        if(role=='')
        {          
          
            document.getElementById('role').focus();
           document.getElementById('role_error').innerHTML="Please enter role";
           return false;
        }document.getElementById('role_error').innerHTML="";  	
	
	
		document.getElementById("loader_button").style.display='none';
                document.getElementById("loader_button2").style.display='none';
		document.getElementById("loader").style.display='block';
		document.getElementById("addjob_form").submit();
	

}


function getmaxvalue(minid)
{ 
	   strURL='<?php echo base_url()?>school/getmaxexp?minid='+minid;	   
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

function getmaxsalary(minid)
{
	   strURL='<?php echo base_url()?>school/getmaxsal?minid='+minid;	  
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
						document.getElementById('maxsalid').innerHTML=req.responseText;																	
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
    var date = new Date();
date.setDate(date.getDate()-1);
          $('#published_date').datepicker({              
                        startDate: date,
                        format: 'yyyy/mm/dd',
			autoclose: true
			//todayHighlight: true
           });
		     $('#end_date').datepicker({
				 format: 'yyyy/mm/dd',
			autoclose: true,
			todayHighlight: true
           });
		   $('#published_date').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});
			 $('#end_date').on('changeDate', function(ev){
				$(this).datepicker('hide');
			});
 </script> 
<!--bs-callout bs-callout-danger alert-dismissable-->