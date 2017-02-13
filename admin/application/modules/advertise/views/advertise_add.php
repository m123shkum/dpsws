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
      <h1 class="page-header"><small>Manage Advertise</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>advertise"><i class="icon-file-alt"></i>Advertise</a></li>
        <li class="active"><i class="icon-file-alt"></i>Add</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
   <a href="javascript:void(0);" onclick="javascript:history.go(-1)"><img src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'advertise/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_advertise","id"=>"add_advertise","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="advertiseForm" value='advertiseForm'>             
             
            <div class="col-lg-6">    
                <div class="form-group">
                     <label class="control-label">Area*</label>
                     <select name="area_name" id="area_name" class="form-control">                        
                         <option value="">Select a Area</option>           
            <option value="Delhi">Delhi</option>
            <option value="Faridabad">Faridabad</option>            
            <option value="Gurgaon">Gurgaon</option>
            <option value="Noida">Noida</option>
            <option value="Ghaziabad">Ghaziabad</option>
            <option value="Greater Noida">Greater Noida</option>
                     </select>
                     <div id="area_nameError" style="color:#C33"></div>
                  </div>
                
                   <div class="form-group">
                     <label class="control-label">Image Title*</label>
                     <input class="form-control" type="text" name="image_title" id="image_title">
                     <div id="image_titleError" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                     <label class="control-label">Link</label>
                     <input class="form-control" type="text" name="link" id="link">                     
                  </div> 
                         
                   <div class="form-group">
                     <label class="control-label">Sort order</label>
                     <input onKeyPress="return isNumberKey(event)" style="width:80px;" class="form-control" type="text" name="ord" id="ord">                     
                  </div>    
                
                <div class="form-group">
                     <label class="control-label">Image Size</label>
                     <select name="size" id="size" class="form-control">
                         <option value="">Select A Size</option>                        
                         <option value="250X250">(250 X 250)</option>
                         <option value="160X600">(160 X 600)</option>
                     </select>
                     <div id="sizeError" style="color:#C33"></div>
                  </div>
                                           
                   <div class="form-group">
                     <label class="control-label">Image (Max Size:400 X 600)</label>
                     <input class="form-control" type="file" name="image" id="image">
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
    function isNumberKey(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
         return true;
      }

 $("#image").change(function (e) {    
   var _URL = window.URL;
   var file, img;
   var w,h;
   if ((file = this.files[0])) {
       img = new Image();
       img.onload = function () {
       w= this.width;
       h= this.height;       
       if(w>400 && h>600)
       {
           document.getElementById("imageErr").innerHTML='Image must be 400 x 600 px';
           document.getElementById("add_advertise").reset();
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
        
        var area_name = document.getElementById("area_name").value;	
        var image_title = document.getElementById("image_title").value;	
        var image = document.getElementById("image").value;
        var size= document.getElementById("size").value;
         
	var cnt=0;
        
        if(area_name=='')
	{
		document.getElementById("area_name").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("area_name").style.borderColor='';}
        
         
	if(image_title=='')
	{
		document.getElementById("image_title").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("image_title").style.borderColor='';}
                
        if(image=='')
	{
		document.getElementById("image").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("image").style.borderColor='';}
        
        	
		
	if(image!='')
	{
                var ext = image.split('.').pop();
                
                if(ext!='png' && ext!='jpg' && ext!='gif' && ext!='JPG' && ext!='JPEG' && ext!='jpeg')
		{		
                 cnt++;   
		 document.getElementById('imageErr').innerHTML="Only (png,jpg,gif) format support!";	
		 document.getElementById('image').focus(); 		 
		}else{document.getElementById('imageErr').innerHTML="";}
        }
        
        if(size=='')
	{
		document.getElementById("size").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("size").style.borderColor='';}
        
	
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
		document.getElementById("add_advertise").submit();
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