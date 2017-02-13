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
      <h1 class="page-header"><small>Manage Page</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>page"><i class="icon-file-alt"></i>Page</a></li>
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
         <?php echo form_open(base_url().'page/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addpage","id"=>"addpage","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="pageForm" value='pageForm'>             
             
            <div class="col-lg-6">                
                   <div class="form-group">
                     <label class="control-label">Page Title*</label>
                     <input class="form-control" type="text" name="page_title" id="page_title">                     
                  </div>
                <div class="form-group">
                     <label class="control-label">Sort Order</label>
                     <input style="width:100px;" onkeypress="return isNumberKey(event)" class="form-control" type="text" name="ord" id="ord">                     
                  </div>
                 <div class="form-group">
                     <label class="control-label">Display in header/footer</label>
                     <select name="display_area">
                         <option value="">--Select--</option>
                         <option value="header">Header</option>
                         <option value="footer">Footer</option>
                         <option value="both">Both</option>
                     </select>
                  </div>
                
                            
                   <div class="form-group">
                     <label class="control-label">Meta Title</label>
                     <input class="form-control" type="text" name="meta_title" id="meta_title">                     
                  </div>
                            
                   <div class="form-group">
                     <label class="control-label">Meta keyword</label>
                     <input class="form-control" type="text" name="meta_keyword" id="meta_keyword">                     
                  </div>
                            
                   <div class="form-group">
                     <label class="control-label">Meta Description</label>
                     <input class="form-control" type="text" name="meta_description" id="meta_description">                     
                  </div>
                           
                   <div class="form-group">
                     <label class="control-label">Short Content</label>
                     <textarea rows="8" cols="8" class="form-control" name="short_content" id="short_content"></textarea>
                  </div>
                          
                   <div class="form-group">
                     <label class="control-label">Content*</label>                     
                     <textarea name="content" id="content"></textarea>
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
        
        
        var page_title = document.getElementById("page_title").value;	
        var content = document.getElementById("content").value;
        
         
	var cnt=0;
        
         
	if(page_title=='')
	{
		document.getElementById("page_title").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("page_title").style.borderColor='';}
                
        if(content=='')
	{
		document.getElementById("content").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("content").style.borderColor='';}
        
	
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
		document.getElementById("addpage").submit();
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