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
      <h1 class="page-header"><small>Manage Teacher Education</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>teacher/education/<?php echo $teacher_id?>"><i class="icon-file-alt"></i>Teacher Education</a></li>
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
         <?php echo form_open(base_url().'teacher/addeducation/'.$teacher_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_education","id"=>"add_education","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="educationForm" value='educationForm'>  
            <input type="hidden" name="teacher_id" value='<?php echo $teacher_id?>'>             
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Institution*</label>
                     <input class="form-control" type="text" name="institution" id="institution">                     
                  </div>                                                                      
                   <div class="form-group">
                     <label class="control-label">Board/University*</label>
                    <input class="form-control" type="text" name="board_university" id="board_university">
                  </div>
                <div class="form-group">
                     <label class="control-label">Year of Passing*</label>
                   <?php
					$st=1940;
					$curyear=date('Y');
					?>
                    
                     <select style="max-width:150px;" class="form-control" name="year_passing" id="year_passing">
                    <option value="">-- Select --</option>
                   <? for($i=$st;$i<=$curyear;$i++){?>
                    <option value="<?=$i?>"><?=$i?></option>                    
                    <? }?>
                    
                    </select>
                  </div>
                 <div class="form-group">
                     <label class="control-label">Major Subjects*</label>
                    <input class="form-control" type="text" name="major_subject" id="major_subject">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Marks (% or CGPA)*</label>
                     <input onkeypress="return isNumberKey2(event);" class="form-control" type="text" name="marks" id="marks">
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Educational Qualifications*</label>
                    <select class="form-control" name="degree" id="degree">
                    <option value="">-- Select Qualification --</option>
                     <?php 
						 foreach($qualifications as $qualification){
						 ?>
                     <option value="<?php echo $qualification['name']?>"><?php echo $qualification['name']?></option>
                     <?php }?>
                     </select>
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
    function isNumberKey2(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 46 || charCode > 57))
            return false;
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
        
        
        var institution=document.getElementById("institution").value;
        var board_university=document.getElementById("board_university").value;
        var year_passing=document.getElementById("year_passing").value;
        var major_subject=document.getElementById("major_subject").value;
        var marks=document.getElementById("marks").value;
        var degree=document.getElementById("degree").value;
        
        var cnt=0;
        
        if(institution=='')
        {         
            cnt++;
            document.getElementById('institution').focus();
            document.getElementById("institution").style.borderColor='red';            
           return false;
        }else{document.getElementById("institution").style.borderColor='';}
        
        if(board_university=='')
        {   cnt++;
            document.getElementById('board_university').focus();
            document.getElementById("board_university").style.borderColor='red';           
           return false;
        }else{document.getElementById("board_university").style.borderColor='';}
        
        
        if(year_passing=='')
        {         cnt++;
            document.getElementById('year_passing').focus();
            document.getElementById("year_passing").style.borderColor='red'; 
           return false;
        }else{document.getElementById("year_passing").style.borderColor='';}
        
        if(major_subject=='')
        {   cnt++;
            document.getElementById('major_subject').focus();
            document.getElementById("major_subject").style.borderColor='red';          
           return false;
        }else{document.getElementById("major_subject").style.borderColor='';}
        
        if(marks=='')
        {         cnt++;           
            document.getElementById('marks').focus();
           document.getElementById("marks").style.borderColor='red';          
           return false;
        }else{document.getElementById("marks").style.borderColor='';}
        
        if(degree=='')
        {          cnt++;
            document.getElementById('degree').focus();
            document.getElementById("degree").style.borderColor='red';          
           return false;
        }else{document.getElementById("degree").style.borderColor='';}
        
	
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
		document.getElementById("add_education").submit();
	}

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->