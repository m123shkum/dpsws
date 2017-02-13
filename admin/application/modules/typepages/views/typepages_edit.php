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
      <h1 class="page-header"><small>Manage User Type</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>typepages"><i class="icon-file-alt"></i>User Type</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</a></li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none;" href="<?=base_url().'typepages'?>">Back</a>
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
         <?php echo form_open(base_url().'typepages/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"edit_typepages","id"=>"edit_typepages","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="typepagesForm" value='typepagesForm'>   
            <input type="hidden" name="typepages_id" value='<?php echo $results['id']?>'>   
            <input type="hidden" name="hidden_image" id="hidden_image" value='<?php echo $results['image']?>'> 
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Title*</label>
                     <input class="form-control" type="text" name="title" id="title" value="<?php echo $results['title']?>">
                     <div id="image_titleErr" style="color:#C33"></div>
                  </div>  
                                             
                   <div class="form-group">
                     <label class="control-label">Meta keyword</label>
                     <textarea rows="8" cols="8" class="form-control" name="meta_keyword" id="meta_keyword"><?php echo $results['meta_keyword']?></textarea>
                  </div>
                 <div class="form-group">
                     <label class="control-label">Meta Description</label>
                     <textarea rows="8" cols="8" class="form-control" name="meta_description" id="meta_description"><?php echo $results['meta_description']?></textarea>
                  </div>
                 <div class="form-group">
                     <label class="control-label">Short Description*</label>
                     <textarea maxlength="150" rows="8" cols="8" class="form-control" name="short_description" id="short_description"><?php echo $results['short_description']?></textarea>
                  </div>
                          
                   <div class="form-group">
                     <label class="control-label">Content*</label>                     
                     <textarea class="form-control" name="content" id="content"><?php echo $results['content']?></textarea>
                     <?php echo display_ckeditor($ckeditor_2); ?>
                     <div id="contentErr" style="color:#C33"></div>
                  </div>
                <div class="form-group">
                    <?php if($results['image']!=''){?>
                    <img src="<?php echo SiteUrl?>timthumb.php?src=<?php echo SiteUrl?>public/worthimage/<?php echo $results['image']?>&w=150&h=130" />
                    <?php }else{?>
                    <img src="<?php echo SiteUrl?>timthumb.php?src=<?php echo SiteUrl?>public/images/no_image.jpg&w=150&h=130" />
                    <?php }?>
                    <label class="control-label">Image (Size Max:500 X 500)</label>
                     <input class="form-control" type="file" name="image" id="image">    
                     <div id="image_Err" style="color:#C33"></div>
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
    {    var charCode = (evt.which) ? evt.which : event.keyCode
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
       if(w>500 && h>500)
       {
           document.getElementById("image_Err").innerHTML='Image must be 500 x 500 px';
           document.getElementById("image").value="";
           return false;
       }
       else
       {
           document.getElementById("image_Err").innerHTML='';
           return true;
       }
       
       };
       img.src = _URL.createObjectURL(file);
   }   
   
});   
      
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
        
        
        var title = document.getElementById("title").value;	
        var content = document.getElementById("content").value;
        var image=document.getElementById("image").value;
        var hidden_image=document.getElementById("hidden_image").value;
        var short_description=document.getElementById("short_description").value;
         
	var cnt=0;
        
         
	if(title=='')
	{
		document.getElementById("title").style.borderColor='red';
                document.getElementById("title").focus();
                return false;
	    cnt++;
	}else{document.getElementById("title").style.borderColor='';}
        
        if(short_description=='')
	{
		document.getElementById("short_description").style.borderColor='red';
                document.getElementById("short_description").focus();
                return false;
	    cnt++;
	}else{document.getElementById("short_description").style.borderColor='';}
                
        if(content=='')
	{
		document.getElementById("content").style.borderColor='red';
                
	    cnt++;
	}else{document.getElementById("content").style.borderColor='';}
        
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
		 document.getElementById('image_Err').innerHTML="Only (png,jpg,gif) format support!";	
		 document.getElementById('image').focus(); 		 
		}else{document.getElementById('image_Err').innerHTML="";}
        }
        
	
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
		document.getElementById("edit_typepages").submit();
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