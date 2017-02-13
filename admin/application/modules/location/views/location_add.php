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
      <h1 class="page-header"><small>Manage Location</small></h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>user/home"><i class="icon-dashboard"></i> Dashboard</a></li>
        <li class="active"><a href="<?php echo site_url();?>location"><i class="icon-file-alt"></i>Location</a></li>
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
         <?php echo form_open(base_url().'location/add',array("enctype"=>"multipart/form-data", "method"=>"post","name"=>"addlocation","id"=>"addlocation","onsubmit"=>"return valid_frm()")) ?>

            <input type="hidden" name="locationForm" value='locationForm'>             
             <?php 
             $state_results=$this->db->query("SELECT * from sch_zone where country_id=99 and status=1")->result_array();
             ?>
            <div class="col-lg-6">   
                <div class="form-group">
                     <label class="control-label">Select City</label>
                     <select name="cityname" id="cityname" class="form-control" style="width:200px;">
                         <option value="">--Select--</option>
                         <?php foreach($state_results AS $state_result){
                             $city_results=$this->db->query("SELECT * from sch_zone where zone_cityid=".$state_result['zone_id']." and status=1")->result_array();
                             foreach($city_results AS $city_result){
                             ?>
                         <option value="<?php echo $city_result['zone_id']?>"><?php echo $city_result['cityname']?></option>
                         <?php }?>
                         
                         <?php }?>
                     </select>
                  </div>
                   <div class="form-group">
                     <label class="control-label">Location*</label>
                     <input class="form-control" type="text" name="location" id="location">                     
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
function valid_frm() { 
        
        var cityname = document.getElementById("cityname").value;	
        var location = document.getElementById("location").value;
        
         
	var cnt=0;
        
         
	if(cityname=='')
	{
		document.getElementById("cityname").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("cityname").style.borderColor='';}
                
        if(location=='')
	{
		document.getElementById("location").style.borderColor='red';
	    cnt++;
	}else{document.getElementById("location").style.borderColor='';}
        
	
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
		document.getElementById("addlocation").submit();
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