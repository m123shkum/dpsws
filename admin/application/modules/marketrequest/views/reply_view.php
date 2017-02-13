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
      <h1 class="page-header"><small>Reply</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>marketrequest"><i class="icon-file-alt"></i>Market Place</a></li>
        <li class="active"><i class="icon-file-alt"></i>Reply</li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="javascript:void(0)"><img onclick="javascript:history.go(-1)" src="<?=base_url()?>public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'marketrequest/action_reply',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"reply_form","id"=>"reply_form","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="replyForm" value='replyForm'>   
            <input type="hidden" name="marketbuy_id" value='<?php echo $results['id']?>'>               
            <input type="hidden" name="marketbuy_email" value='<?php echo $results['email']?>'>
            <input type="hidden" name="marketbuy_name" value='<?php echo $results['name']?>'>
            <div class="col-lg-6">  
                
                <div class="form-group">
                     <label class="control-label">Category</label>
                    <?php echo ucfirst($results['category'])?>                  
                  </div>  
                
                   <div class="form-group">
                     <label class="control-label">Name</label>
                    <?php echo ucfirst($results['name'])?>                  
                  </div>  
                                             
                   <div class="form-group">
                     <label class="control-label">Email</label>
                   <?php echo $results['email']?>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Contact No.</label>
                   <?php echo $results['contactno']?>
                  </div>
                <div class="form-group">
                     <label class="control-label">Message</label>
                   <?php echo $results['message']?>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Reply Message</label>
                     <textarea cols="10" rows="5" name="reply_message" id="reply_message" class="form-control"></textarea>  
                  </div>   
                
              </div>
                        
                <div class="form-group" style="padding-top:30px;">
               <img style="display:none;" id="loader" src="<?=base_url()?>/public/images/loader.gif">
               <button tabindex="27" type="submit" class="btn btn-primary" id="loader_button">Send</button>               
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
        
                var reply_message=$("#reply_message").val();
            
            if(reply_message=='')
            {
                document.getElementById("reply_message").style.borderColor='red';
                document.getElementById("reply_message").focus();
                return false;
            }else{                 
                 document.getElementById("reply_message").style.borderColor='';}
        
	
		document.getElementById("loader_button").style.display='none';
                document.getElementById("loader_button2").style.display='none';
		document.getElementById("loader").style.display='block';
		document.getElementById("reply_form").submit();
	

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->