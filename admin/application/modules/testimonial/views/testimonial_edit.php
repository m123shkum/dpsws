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
      <h1 class="page-header"><small>Manage Testimonial</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>testimonial"><i class="icon-file-alt"></i>Testimonial</a></li>
        <li class="active"><i class="icon-file-alt"></i>Update</li>
      </ol>
    </div>
    <!-- /.col-lg-12 --> 
  </div>
  <!-- /.row -->
  <div style="color:red;margin-bottom:12px;">  All (*) fields are required !   </div>
  <a style="text-decoration:none; float: right;" href="javascript:void(0);"><img onclick="javascript:history.go(-1)" src="<?=base_url()?>/public/images/back-btn.png" /></a>
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
         <?php echo form_open(base_url().'testimonial/update',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"testimonialfrm","id"=>"testimonialfrm","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="testimonialForm" value='testimonialForm'>   
            <input type="hidden" name="testimonial_id" value='<?php echo $results['id']?>'>   
            <input type="hidden" name="hidden_image" value='<?php echo $results['image']?>'> 
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Testimonial Title*</label>
                     <input class="form-control" type="text" name="title" id="title" value="<?php echo stripslashes($results['title'])?>">
                     <div id="image_titleErr" style="color:#C33"></div>
                  </div>  
                <div class="form-group">
                     <label class="control-label">Author Name*</label>
                     <input class="form-control" value="<?php echo $results['author_name']?>" type="text" name="author_name" id="author_name">                     
                  </div>
                  <div class="form-group">
                     <label class="control-label">Profession*</label>
                     <input class="form-control" value="<?php echo $results['profession']?>" type="text" name="profession" id="profession">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">School Name</label>
                     <input class="form-control" value="<?php echo $results['tschool_name']?>" type="text" name="tschool_name" id="tschool_name">                     
                  </div>
                 <div class="form-group">
                     <label class="control-label">Url</label>
                     <input class="form-control" value="<?php echo $results['website']?>" type="text" name="website" id="website">                                       <div id="website_Err" style="color:#C33"></div>
                  </div>
                                             
                   <div class="form-group">
                     <label class="control-label">Short Content*</label>
                     <textarea rows="8" cols="8" class="form-control" name="short_content" id="short_content"><?php echo stripslashes($results['short_content'])?></textarea>
                  </div>                          
                  
                <div class="form-group">
                    <img src="<?php echo SiteUrl?>timthumb.php?src=<?php echo SiteUrl?>public/worthimage/<?php echo $results['image']?>&w=150&h=130" />
                     <label class="control-label">Image (Size Max:300 X 300)</label>
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
        
        var title = document.getElementById("title").value;	
        var author_name = document.getElementById("author_name").value;	
        var profession = document.getElementById("profession").value;	
        
        var short_content = document.getElementById("short_content").value;        
         
	var cnt=0;
        
         
	if(title=='')
	{
		document.getElementById("title").style.borderColor='red';
	    cnt++;
            document.getElementById("title").focus();
            return false
	}else{document.getElementById("title").style.borderColor='';}
        
        
        if(author_name=='')
	{
		document.getElementById("author_name").style.borderColor='red';
	    cnt++;
            document.getElementById("author_name").focus();
            return false
	}else{document.getElementById("author_name").style.borderColor='';}
                
                
         if(profession=='')
	{
		document.getElementById("profession").style.borderColor='red';
	    cnt++;
            document.getElementById("profession").focus();
            return false
	}else{document.getElementById("profession").style.borderColor='';}
                
        if(short_content=='')
	{
		document.getElementById("short_content").style.borderColor='red';
	    cnt++;
             document.getElementById("short_content").focus();
            return false
	}else{document.getElementById("short_content").style.borderColor='';}
        
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
		document.getElementById("testimonialfrm").submit();
	}

}
function isNumberKey(evt)
      {

         var charCode = (evt.which) ? evt.which : event.keyCode

         if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;

         return true;

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