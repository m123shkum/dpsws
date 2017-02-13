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
      <h1 class="page-header"><small>Manage Event Gallery</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>events/gallery/<?php echo $event_id?>"><i class="icon-file-alt"></i>Event Gallery</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
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
         <?php echo form_open(base_url().'events/updategallery/'.$event_id,array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"edit_gallery","id"=>"edit_gallery","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="galleryForm" value='galleryForm'>  
            <input type="hidden" name="event_id" value='<?php echo $event_id?>'>              
            <input type="hidden" name="image_id" value='<?php echo $results['id']?>'> 
            <input type="hidden" name="hidden_image" id="hidden_image" value='<?php echo $results['image']?>'> 
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Image Title*</label>
                     <input class="form-control" type="text" name="image_title" id="image_title" value="<?php echo $results['image_title']?>">
                     <div id="image_titleErr" style="color:#C33"></div>
                  </div>
                              
                   <div class="form-group">
                     <label class="control-label">Sort order</label>
                     <input style="width:80px;" class="form-control" type="text" name="ord" id="ord" value="<?php echo $results['ord']?>">                     
                  </div>
             
                
                   <div class="form-group">
                       
                       <label class="control-label">Image <br><small>(Min Size:700 X 300)</small></label>
                     
                     <input type="file" name="image" id="image">
                     <div id="imageErr" style="color:#C33"></div>
                  </div>                
                 <img src="<?php echo SiteUrl?>timthumb.php?src=<?php echo SiteUrl?>public/eventimage/<?php echo $results['image']?>&w=200&h=200" />
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
      
   $("#image").change(function (e) {    
   var _URL = window.URL;
   var file, img;
   var w,h;
   if ((file = this.files[0])) {
       img = new Image();
       img.onload = function () {
       w= this.width;
       h= this.height;       
       if(w<700 || h<300)
       {
           document.getElementById("imageErr").innerHTML='Image must be Min Size 700 x 300 px';
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

function valid_frm() { 
        
        
      var image_title = document.getElementById("image_title").value;	
        var image = document.getElementById("image").value;
        var hidden_image = document.getElementById("hidden_image").value;
        
         
	var cnt=0;
        
         
	if(image_title=='')
	{
		document.getElementById("image_title").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("image_title").style.borderColor='';}
                
        if(image=='' && hidden_image=='')
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
		document.getElementById("edit_gallery").submit();
	}

}

</script>
<!--bs-callout bs-callout-danger alert-dismissable-->