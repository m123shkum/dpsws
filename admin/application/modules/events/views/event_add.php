<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>

<?php $open_time=array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 PM","13:00 PM","13:30 PM","14:00 PM","14:30 PM","15:00 PM","15:30 PM","16:00 PM","16:30 PM","17:00 PM","17:30 PM","18:00 PM","18:30 PM","19:00 PM","19:30 PM","20:00 PM");
$closed_time=array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 AM","12:30 PM","13:00 PM","13:30 PM","14:00 PM","14:30 PM","15:00 PM","15:30 PM","16:00 PM","16:30 PM","17:00 PM","17:30 PM","18:00 PM","18:30 PM","19:00 PM","19:30 PM","20:00 PM");?>

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
                    <label class="control-label" style="min-width: 91px;">Age Group</label>
             <select style="width:120px; display: inline;" name="min_age" id="min_age" onchange="getmaxvalue(this.value);" class="form-control">
			<?php for($i=1;$i<=50;$i++){?>
            <option value="<?php echo $i?>"><?php echo $i?></option>
            <?php }?>
             </select> To
                <span id="maxid">             
             <select style="width:120px; display: inline;" name="max_age" id="max_age" class="form-control">             
             <?php for($i=2;$i<=50;$i++){?>
             <option value="<?php echo $i?>"><?php echo $i?></option>
             <?php }?>
             </select>
             </span>Years
                  </div>
                
                <div class="form-group">
                    <label class="control-label" style="min-width: 91px;">Timing</label>
             <select style="width:120px; display: inline;" name="start_time" id="start_time" onchange="getendTiming(this.value);" class="form-control">
			<?php for($i=0;$i<count($open_time);$i++){?>
            <option value="<?php echo $open_time[$i]?>-<?php echo $i?>"><?php echo $open_time[$i]?></option>
            <?php }?>
             </select> To
                <span id="endtimeid">             
             <select style="width:120px; display: inline;" name="end_time" id="end_time" class="form-control">             
             <?php for($j=1;$j<count($closed_time);$j++){?>
             <option value="<?php echo $closed_time[$j]?>"><?php echo $closed_time[$j]?></option>
             <?php }?>
             </select>
             </span>
                  </div>
                
                  <div class="form-group">
                     <label class="control-label">Activities</label>
                     <ul>
                         <?php foreach($event_activities AS $event_activity){?>
                         <li><?php echo ucfirst($event_activity['activity_name'])?><input value="<?php echo strtolower($event_activity['activity_name'])?>" class="form-control" type="checkbox" name="activities[]">  </li>
                         <?php }?>                        
                     </ul>
                  </div>
                
                <div class="form-group">
                     <label class="control-label">Program Fee</label>
                     <input style="max-width:100px;" onkeypress="return isNumberKey(event);" class="form-control" type="text" name="program_fee" id="program_fee">                     
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
                     <select name="event_area" class="form-control" style="max-width:200px;" onchange="locationshow(this.value);">
                         <option value="">--Select Area--</option>
                         <option value="4697">Delhi</option>                         
                         <option value="4155">Faridabad</option>
                         <option value="4157">Gurgaon</option>
                         <option value="4533">Noida</option>
                         <option value="4511">Ghaziabad</option> 
                         <option value="4515">Greater Noida</option> 
                     </select>                   
                    
                  </div>

                  <div class="form-group" id="location_divid">
                     <label class="control-label">Location*</label>
                     <span id="Locationdivid">
                     <select class="form-control" name="event_location" id="event_location" style="max-width:200px;">
                    <option value="">-- Select Location --</option>			
                     </select></span>                     
                  </div>  
                     
                   <div class="form-group">
                     <label class="control-label">Event Image* (Min Size:200 X 200)</label>
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
    function locationshow(areaid)
{
 
	   var strURL='<?=base_url()?>events/getlocation?areaid='+areaid;         
	   //alert(strURL);
	   //var req = getXMLHTTP();
	   //
	   var req;
if (window.XMLHttpRequest)
  {
  req=new XMLHttpRequest();
  }
else
  {
  req=new ActiveXObject("Microsoft.XMLHTTP");
  }
	   //
	   
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {							
						document.getElementById('Locationdivid').innerHTML=req.responseText;																	
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	

}	

function getendTiming(starttime)
{
   var strURL='<?php echo base_url()?>events/getendTiming?starttime='+starttime;	   
	   var req;
if (window.XMLHttpRequest)
  {
  req=new XMLHttpRequest();
  }
else
  {
  req=new ActiveXObject("Microsoft.XMLHTTP");
  }
	   //
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {							
						document.getElementById('endtimeid').innerHTML=req.responseText;																	
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
    
}
    
function getmaxvalue(minid)
{ 
	var  strURL='<?php echo base_url()?>events/getmaxexp?minid='+minid;	   
	   var req;
if (window.XMLHttpRequest)
  {
  req=new XMLHttpRequest();
  }
else
  {
  req=new ActiveXObject("Microsoft.XMLHTTP");
  }
	   //
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {							
						document.getElementById('maxid').innerHTML=req.responseText;																	
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}	

}	

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
       if(w<150 || h<150)
       {
           document.getElementById("eventimage_Err").innerHTML='Image must be Min size 200 x 200 px';
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
            return false;
	}else{document.getElementById("start_date").style.borderColor='';}
        
        if(end_date=='')
	{
		document.getElementById("end_date").style.borderColor='red';
	    cnt++;
            return false;
	}else{document.getElementById("end_date").style.borderColor='';}
        
        
        if(image=='')
	{
		document.getElementById("image").style.borderColor='red';
	    cnt++;
            return false;
	}else{document.getElementById("image").style.borderColor='';}
        
        if(image!='')
	{
                var ext = image.split('.').pop();
                
                if(ext!='png' && ext!='jpg' && ext!='gif' && ext!='JPG' && ext!='JPEG' && ext!='jpeg')
		{		
                 cnt++;   
		 document.getElementById('eventimage_Err').innerHTML="Only (png,jpg,gif) format support!";	
		 document.getElementById('image').focus(); 
                 return false;
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