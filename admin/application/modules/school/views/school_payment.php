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
      <h1 class="page-header"><small>Manage Payment</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>school"><i class="icon-file-alt"></i>School</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>  
  <a style="text-decoration:none;" href="javascript:void(0);" onclick="javascript:history.go(-1)"><img src="<?=base_url()?>public/images/back-btn.png"></a>
  
  <div class="row" id="scrolopen">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-body">
         <?php if($this->session->flashdata('success')){  echo $this->session->flashdata('success'); }  
         if(isset($exist_error))
         {
             ?>
            <div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Notice !</strong> <?php echo $exist_error?></div>
         <?php }
         
         function dateDiff($start, $end) {
  $start_ts = strtotime($start);
  $end_ts = strtotime($end);
  $diff = $end_ts - $start_ts;
  return round($diff / 86400);
}
         //echo dateDiff(date('Y-m-d'), $results['expirydate']); 
         ?>
            <p>Previous Payment Details:</p>  
            <?php foreach($payments AS $payment){?>
            <p>Amount:<?php echo $payment['amount']?>, Start Date: <?php echo date("d-m-Y",strtotime($payment['start_date']))?> Expiry Date:<?php echo date("d-m-Y",strtotime($payment['expiry_date']))?></p>
            <?php }?>
            
         <?php echo form_open(base_url().'school/action_payment',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"schoolpayment","id"=>"schoolpayment","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="paymentUpdate" value='Update'>  
            <input type="hidden" name="school_id" value='<?php echo $results['id']?>'>           
            <input type="hidden" name="schooluser_id" value='<?php echo $results['user_id']?>'>
            <div class="col-lg-6"> 
                   <div class="form-group">
                     <label class="control-label">Select Duration*</label>
                     <select style="max-width:200px;" name="duration" id="duration" class="form-control">
                         <option value="">--Select--</option>
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
                     <label class="control-label">Start Date*</label>
                     <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(function() {
    
$( "#start_date" ).datepicker({ 
            dateFormat: "mm/dd/yy",
            });        
        
});
</script>
<input style="max-width:200px;"  class="form-control" type="text" name="start_date" id="start_date">                     
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
	var duration = document.getElementById("duration").value;
        var amount = document.getElementById("amount").value;
        var start_date = document.getElementById("start_date").value;        
	
	var cnt=0;
        
	if(duration=='')
	{
	    document.getElementById("duration").style.borderColor='red';
            document.getElementById('duration').focus();
	    cnt++;
	}else{document.getElementById("duration").style.borderColor='';}
        
        if(amount=='')
	{
	    document.getElementById("amount").style.borderColor='red';
            document.getElementById('amount').focus();
	    cnt++;
	}else{document.getElementById("amount").style.borderColor='';}
        
        if(start_date=='')
	{
	    document.getElementById("start_date").style.borderColor='red';
            document.getElementById('start_date').focus();
	    cnt++;
	}else{document.getElementById("start_date").style.borderColor='';}
        
	
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
		document.getElementById("schoolpayment").submit();
	}

}


</script>
<!--bs-callout bs-callout-danger alert-dismissable-->