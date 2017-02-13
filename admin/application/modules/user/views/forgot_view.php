<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Schoolz Administration</title>
<!-- Core CSS - Include with every page -->
<link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">
<!-- SB Admin CSS - Include with every page -->
<link href="<?=base_url()?>public/css/sb-admin.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
    <div class="logo-row"><img src="<?=base_url()?>public/images/logo.png" width="220"></div>
      <div class="login-panel panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Forgot Password</h3>
        </div>
         <?php if($this->session->flashdata('err')){  echo $this->session->flashdata('err'); }  ?>   
        <div class="panel-body">
         <?php echo form_open(base_url().'user/forgot',array("method"=>"post","name"=>"forgotfrm","id"=>"forgotfrm","onsubmit"=>"return valid_frm()")) ?>
            <input type="hidden" name="forgotfrm" value='submit'>
            <fieldset>
              <div class="form-group">
              <label>Email</label>
                <input class="form-control" type="email" name="email" onKeydown="Javascript: if (event.keyCode==13) valid_frm();" id="email" value="" autofocus>
               <div id="emailErr" style="color:#C33"></div>
              </div>
             

              <div class="submit-row">
              <div class="submit-row-border"></div>
              <!-- Change this to a button or input when using this as a form --> 
              <a type="javascript:void();" onClick="return valid_frm();" class="btn btn-submit btn-success btn-block"></a>
            </fieldset>
            <?=form_close()?>  
          <div class="submit-row-border"></div>
        </div>
        	  <div class="forgot-row">
              <a href="<?=base_url()?>user/login"><span>Login</span></a>
              </div>
      </div>
    </div>
    </div>
  </div>
</div>
<!-- Core Scripts - Include with every page --> 
<script src="<?=base_url()?>public/js/jquery-1.10.2.js"></script> 
<script src="<?=base_url()?>public/js/bootstrap.min.js"></script> 
<script src="<?=base_url()?>public/js/plugins/metisMenu/jquery.metisMenu.js"></script> 
<!-- SB Admin Scripts - Include with every page --> 
<script src="<?=base_url()?>public/js/sb-admin.js"></script>

<script type="text/javascript">
function valid_frm() { 
    var email = document.getElementById("email").value;
	var reg =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var cnt=0;
	if(email=='')
	{
		document.getElementById("emailErr").innerHTML='Enter your email Id!';
		document.getElementById("email").style.borderColor='red';
	    cnt++;
	}
	else if(reg.test(email)==false)
	{
		document.getElementById("emailErr").innerHTML='Invalid email address !';
		document.getElementById("email").style.borderColor='red';
	    cnt++;
	}
	else
	{
		document.getElementById("emailErr").innerHTML='';
		document.getElementById("email").style.borderColor='';
	}
	
	if(cnt>0)
	{
		return false;
	}
	else
	{
		
		document.getElementById("forgotfrm").submit();
	}
	
}
</script>
</body>
</html>