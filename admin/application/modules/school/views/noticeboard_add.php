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
      <h1 class="page-header"><small>Manage School Notice Board</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>school/noticeboard/<?php echo $school_id?>"><i class="icon-file-alt"></i>School Notice Board</a></li>
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
         <?php echo form_open(base_url().'school/addnoticeboard/'.$school_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_noticeboard","id"=>"add_noticeboard","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="noticeboardForm" value='noticeboardForm'>  
            <input type="hidden" name="school_id" value='<?php echo $school_id?>'>              
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Title*</label>
                     <input class="form-control" type="text" name="title" id="title">                    
                  </div>                       
                   <div class="form-group">
                     <label class="control-label">Content</label>
                     <textarea name="description" id="content"></textarea> 
                     <?php echo display_ckeditor($ckeditor_2); ?>                     
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
        
       var title = document.getElementById("title").value;	
	var cnt=0;        
         
	if(title=='')
	{
		document.getElementById("title").style.borderColor='red';
	    cnt++;
            document.getElementById("title").focus();
	}else{document.getElementById("title").style.borderColor='';}
       
        
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
		document.getElementById("add_noticeboard").submit();
	}


}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->