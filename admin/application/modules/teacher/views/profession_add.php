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
      <h1 class="page-header"><small>Manage Teacher Profession</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>teacher/profession/<?php echo $teacher_id?>"><i class="icon-file-alt"></i>Teacher Profession</a></li>
        <li class="active"><i class="icon-file-alt"></i>Add</li>
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
         <?php echo form_open(base_url().'teacher/addprofession/'.$teacher_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_profession","id"=>"add_profession","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="professionForm" value='professionForm'>  
            <input type="hidden" name="teacher_id" value='<?php echo $teacher_id?>'>             
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Organization*</label>
                     <input class="form-control" type="text" name="organization" id="organization">
                     <div id="organizationErr" style="color:#C33"></div>
                  </div>                                                                      
                   <div class="form-group">
                     <label class="control-label">Designation</label>
                    <input class="form-control" type="text" name="designation" id="designation">
                    
                     <div id="designationErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Duration</label>
                    <?php
					$montarr=array('JAN','FEB','MARCH','APRIL','MAY','JUNE','JULY','AUG','SEPT','OCT','NOV','DEC');
					?>
                <select name="start_month" id="duration">  
                    <option value="0">Month</option>                 


                    <?php 
					$j=0;
					for($i=0;$i<12;$i++){
					$j++;
					?>
                    <option value="<?=$montarr[$i]?>"><?=$montarr[$i]?></option>                                 
                    <? }?>                   
                    </select> &nbsp;
                                 
                    <?php
					$st=1940;
					$curyear=date('Y');
					?>
                    <select name="start_year">
                    <option value="0">Year</option>
                   <? for($i=$st;$i<=$curyear;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>
                    </select>
                    
                     &nbsp;To&nbsp; <?php
					$montarr=array('JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC');
					?>
                    <select name="end_month">  
                    <option value="0">Month</option>                 
                    <?php 
					$j=0;
					for($i=0;$i<12;$i++){
					$j++;
					?>
                    <option value="<?=$montarr[$i]?>"><?=$montarr[$i]?></option>                                 
                    <? }?>                   
                    </select>               
                                            
                    <?php
					$st=1940;
					$curyear=date('Y');
					?>
                    
                    <select name="end_year">
                    <option value="0">Till Date</option>
                   <? for($i=$st;$i<=$curyear;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>                    
                    </select>    
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Brief Job Description</label>
                    <input class="form-control" type="text" name="brief_job_description" id="brief_job_description">
                  </div>
                 <div class="form-group">
                     <label class="control-label">Mention any Specific Experience / Achievements</label>
                    <input class="form-control" type="text" name="specific_experience" id="specific_experience">
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
      

function valid_frm() { 
        
        
         var organization=document.getElementById("organization").value;
        var designation=document.getElementById("designation").value;        
        
        var cnt=0;
        if(organization=='')
        {         
            cnt++;        
            document.getElementById("organization").style.borderColor='red';
            document.getElementById('organization').focus();                
           return false;
        }else{document.getElementById("name").style.borderColor='';}
        
        if(designation=='')
        {          
            cnt++;            
            document.getElementById('designation').focus();
             document.getElementById("designation").style.borderColor='red';          
           return false;
        }else{document.getElementById("designation").style.borderColor='';          }
	
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
		document.getElementById("add_profession").submit();
	}

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->