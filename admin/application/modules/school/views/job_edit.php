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
        <li class="active"><a href="<?php echo site_url();?>school/jobs/<?php echo $school_id?>"><i class="icon-file-alt"></i>School Job</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'school/jobs/'.$school_id;?>"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'school/updatejob/'.$school_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"editjob_form","id"=>"editjob_form","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="editForm" value='editForm'>  
            <input type="hidden" name="school_id" value='<?php echo $school_id?>'>   
            <input type="hidden" name="job_id" value='<?php echo $results['id']?>'> 
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Job Title*</label>
                     <input value="<?php echo $results['job_title']?>" class="form-control" type="text" name="job_title" id="job_title">
                     <div id="job_title_error" style="color:#C33"></div>
                  </div>    
                <div class="form-group">
                     <label class="control-label">Ref Code*</label>
                     <input value="<?php echo $results['ref_code']?>" class="form-control" type="text" name="reference_code" id="reference_code">     
                     <div id="refcode_error" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Job Type</label>
                     <input <?php if($results['job_type']=='permanent'){?> checked<?php }?> name="job_type" id="permanent" type="radio" value="permanent"/> Permanent
             <input <?php if($results['job_type']=='temporary'){?> checked <?php }?> name="job_type" id="temporary" type="radio" value="temporary" /> Temporary
             <input <?php if($results['job_type']=='internship'){?> checked <?php }?> name="job_type" id="internship" type="radio" value="internship" /> Internship
                  </div>
                
                <div class="form-group">
                     <label class="control-label">No. of vacancies</label>
                     <input value="<?php echo $results['nov']?>" style="width:60px;" onKeyPress="return isNumberKey(event)" class="form-control" type="text" name="nov" id="nov">                          
                  </div>
                 <div class="form-group">
                     <label class="control-label">Job Summary</label>
                    <textarea name="job_summary_description" id="job_summary_description" class="form-control"><?php echo $results['job_summary_description']?></textarea>
                        <?php echo display_ckeditor($ckeditor_2); ?>
                  </div>
                
                
                   <div class="form-group">
                     <label class="control-label">Job Details</label>
                     <textarea name="job_detail" id="job_detail" class="form-control"><?php echo $results['job_detail']?></textarea> 
                     <?php echo display_ckeditor($ckeditor_3); ?>                     
                  </div>
                
                 <div class="form-group">
                     <label class="control-label">Specify UG Qualifications</label>
                     <select name="ug-qualifications" id="ug-qualifications" class="form-control">           
                      <option value="" selected="selected">Select UG Qualifications</option>              
                           <option <?php if($results['ug']=='B.tech/B.E'){?> selected<?php }?> value="B.tech/B.E">B.tech/B.E</option>
                            <option <?php if($results['ug']=='Diploma'){?> selected<?php }?> value="Diploma">Diploma</option>
                            <option <?php if($results['ug']=='B.Sc'){?> selected<?php }?> value="B.Sc">B.Sc</option>
                            <option <?php if($results['ug']=='B.Com'){?> selected<?php }?> value="B.Com">B.Com</option>
                            <option <?php if($results['ug']=='B.A'){?> selected<?php }?> value="B.A">B. A.</option>
                            <option <?php if($results['ug']=='B.Arch'){?> selected<?php }?> value="B.Arch">B.Arch</option>
                            <option <?php if($results['ug']=='BBA'){?> selected<?php }?> value="BBA">BBA</option>
                            <option <?php if($results['ug']=='B.Pharma'){?> selected<?php }?> value="B.Pharma">B.Pharma</option>
                            <option <?php if($results['ug']=='BCA'){?> selected<?php }?> value="BCA">BCA</option>
                            <option <?php if($results['ug']=='BDS'){?> selected<?php }?> value="BDS">BDS</option>
                            <option <?php if($results['ug']=='BHM'){?> selected<?php }?> value="BHM">BHM</option>
                            <option <?php if($results['ug']=='BVSC'){?> selected<?php }?> value="BVSC">BVSC</option>
                            <option <?php if($results['ug']=='LLB'){?> selected<?php }?> value="LLB">LLB</option>
                            <option <?php if($results['ug']=='MBBS'){?> selected<?php }?> value="MBBS">MBBS</option>
                        </select>                   
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Specify PG Qualifications</label>
                    <select name="pg-qualifications" id="pg-qualifications" class="form-control">
            <option value="">Select PG Qualifications</option>
            <option <?php if($results['pg']=='MBA/PGDM'){?> selected<?php }?> value="MBA/PGDM">MBA/PGDM</option>
                            <option <?php if($results['pg']=='MCA'){?> selected<?php }?> value="MCA">MCA</option>
                            <option <?php if($results['pg']=='M.sc'){?> selected<?php }?> value="M.sc">M.Sc</option>                            
                            <option <?php if($results['pg']=='CA'){?> selected<?php }?> value="CA">CA</option>
                            <option <?php if($results['pg']=='CS'){?> selected<?php }?> value="CS">CS</option>
                            <option <?php if($results['pg']=='ICWA'){?> selected<?php }?> value="ICWA">ICWA</option>
                            <option <?php if($results['pg']=='Integrated PG'){?> selected<?php }?> value="Integrated PG">Integrated PG</option>
                            <option <?php if($results['pg']=='LLM'){?> selected<?php }?> value="LLM">LLM</option>
                            <option <?php if($results['pg']=='M.A'){?> selected<?php }?> value="M.A">M. A.</option>
                            <option <?php if($results['pg']=='M.Arch'){?> selected<?php }?> value="M.Arch">M.Arch</option>
                            <option <?php if($results['pg']=='M.Ed'){?> selected<?php }?> value="M.Ed">M.Ed</option>
                            <option <?php if($results['pg']=='M.Pharma'){?> selected<?php }?> value="M.Pharma">M.Pharma</option>
                            <option <?php if($results['pg']=='M.S/M.D'){?> selected<?php }?> value="M.S/M.D">M.S/M.D</option>
                            <option <?php if($results['pg']=='MVSC'){?> selected<?php }?> value="MVSC">MVSC</option>
                            <option <?php if($results['pg']=='PG Diploma'){?> selected<?php }?> value="PG Diploma">PG Diploma</option>
            </select>                    
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Specify Doctorate/Ph.D</label>
                    <select name="doctorate" id="doctorate" class="form-control">
            
            <option value="">Select Doctorate</option>
             <option <?php if($results['pg']=='Doctrate Not Required'){?> selected<?php }?> value="Doctrate Not Required">Doctrate Not Required</option>
                            <option <?php if($results['doct']=='Any Doctrate'){?> selected<?php }?> value="Any Doctrate">Any Doctrate</option>
                            <option <?php if($results['doct']=='Ph.D'){?> selected<?php }?> value="Ph.D">Ph.D</option>
                            <option <?php if($results['doct']=='M.Phil'){?> selected<?php }?> value="M.Phil">M.Phil</option>
                            
            </select>                  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Other Qualification</label>
                    <input value="<?php echo $results['other_qualification']?>" type="text" name="other_qualification" id="other-qualification" class="form-control"/>          
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Experience</label>
                     <select style="width:120px; display: inline;" name="minimum-experience" id="minimum-experience" onchange="getmaxvalue(this.value);" class="form-control">
             <option value="0">Minimum </option>
             <option value="0">Fresher</option>
			<?php for($i=1;$i<=50;$i++){?>
            <option <?php if($results['minexpyear']==$i){?> selected<?php }?> value="<?php echo $i?>"><?php echo $i?></option>
            <?php }?>
             </select> 
                <span id="maxid">             
             <select style="width:120px; display: inline;" name="maximum-experience" id="maximum-experience" class="form-control">
             <option value="0"> Maximum </option>
             <?php for($i=1;$i<=50;$i++){?>
             <option <?php if($results['maxexpyear']==$i){?> selected<?php }?> value="<?php echo $i?>"><?php echo $i?></option>
             <?php }?>
             </select>
             </span>Years
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Salary</label>
                    <select style="width:120px; display: inline;" name="minimum_salary" id="minimum_salary" onchange="getmaxsalary(this.value);" class="form-control">
             <option value="0"> Minimum </option>
             <?php for($i=1;$i<=50;$i++){?>
            <option <?php if($results['min_salary']==$i*100000){?> selected<?php }?> value="<?php echo $i*100000?>"><?php echo $i?></option>
            <?php }?>  
             </select> 
              <span id="maxsalid">              
             <select style="width:120px; display: inline;" name="maximum_salary" id="maximum_salary" class="form-control">
             <option value="0"> Maximum </option>
             <?php for($i=1;$i<=50;$i++){?>                                
                                <option <?php if($results['max_salary']==$i*100000){?> selected<?php }?> value="<?php echo $i*100000?>"><?php echo $i?></option>
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
            <option <?php if($results['job_location']==$cityname){?> selected<?php }?> value="<?php echo $cityname?>"><?php echo $cityname?></option>
            <?php }?>
            </select>
            <span id="location_error" style="color:#C33"></span>  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Keywords/skills*</label>
                     <input value="<?php echo $results['skills']?>" class="form-control" type="text" name="skills" id="skills"/>  
            <span id="skills_error" style="color:#C33"></span>  
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Role*</label>
                    <input value="<?php echo $results['role']?>" class="form-control" type="text" name="role" id="role"/>  
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
		document.getElementById("editjob_form").submit();
	

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