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
      <h1 class="page-header"><small>Manage Event</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>events/"><i class="icon-file-alt"></i>Event</a></li>
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
         <?php echo form_open(base_url().'events/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"add_event","id"=>"add_event","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="eventForm" value='eventForm'>  
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Event Title*</label>
                     <input class="form-control" type="text" name="event_title" id="event_title">
                     <div id="event_titleErr" style="color:#C33"></div>
                  </div>   
                <div class="form-group">
                     <label class="control-label">Short Description</label>
                     <textarea cols="10" rows="5" name="short_description" id="short_description" class="form-control"></textarea>  
                  </div>
                
                   <div class="form-group">
                     <label class="control-label">Description</label>
                     <textarea name="description" id="content" class="form-control"></textarea> 
                     <?php echo display_ckeditor($ckeditor_2); ?>
                     <div id="descriptionErr" style="color:#C33"></div>
                  </div>
              
            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script>
$(function() {
    
$( "#start_date" ).datepicker({ 
            dateFormat: "dd-mm-yy",
            minDate: 0,
            changeYear:true
            });
        $( "#end_date" ).datepicker({ 
            dateFormat: "dd-mm-yy",
            minDate: 0,
            changeYear:true
            });
        
});
</script>
            
                       
                   <div class="form-group">
                     <label class="control-label">Published Date*</label>
                     <input class="form-control" type="text" name="start_date" id="start_date">                     
                    
                  </div>
                 <div class="form-group">
                     <label class="control-label">End Date*</label>
                     <input class="form-control" type="text" name="end_date" id="end_date">                     
                    
                  </div>
                  <div class="form-group">
                     <label class="control-label">Address*</label>
                     <input class="form-control" type="text" name="address" id="address">                     
                    
                  </div>
                 <div class="form-group">
                     <label class="control-label">Area*</label>
                     <select name="event_area" class="form-control" style="max-width:150px;">
                         <option value="Delhi">Delhi</option>                         
                         <option value="Faridabad">Faridabad</option>
                         <option value="Gurgaon">Gurgaon</option>
                          <option value="Noida">Noida</option>
                         <option value="Ghaziabad">Ghaziabad</option> 
                         <option value="Greater Noida">Greater Noida</option> 
                     </select>                   
                    
                  </div>
                     
                   <div class="form-group">
                     <label class="control-label">Event Image* (Size Max:300 X 300)</label>
                     <input class="form-control" type="file" name="image" id="image">                     
                     <div id="eventimage_Err" style="color:#C33"></div>
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
       if(w>300 && h>300)
       {
           document.getElementById("eventimage_Err").innerHTML='Image must be 300 x 300 px';
           document.getElementById("image").value="";
           return false;
       }
       else
       {
           document.getElementById("eventimage_Err").innerHTML='';
           return true;
       }
       
       };
       img.src = _URL.createObjectURL(file);
   }   
   
});   

function valid_frm() { 
        
        
        var event_title = document.getElementById("event_title").value;	        
        var image=document.getElementById("image").value;
        var end_date=document.getElementById("end_date").value;
         var start_date=document.getElementById("start_date").value;
         
         
	var cnt=0;
        
         
	if(event_title=='')
	{
		document.getElementById("event_title").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("event_title").style.borderColor='';}
                
        if(start_date=='')
	{
		document.getElementById("start_date").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("start_date").style.borderColor='';}
        
        if(end_date=='')
	{
		document.getElementById("end_date").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("end_date").style.borderColor='';}
        
        
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
		 document.getElementById('eventimage_Err').innerHTML="Only (png,jpg,gif) format support!";	
		 document.getElementById('image').focus(); 		 
		}else{document.getElementById('eventimage_Err').innerHTML="";}
        }
        
	
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
		document.getElementById("add_event").submit();
	}

}


</script>

<!--bs-callout bs-callout-danger alert-dismissable-->