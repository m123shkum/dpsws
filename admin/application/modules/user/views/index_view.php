<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Nordic</title>
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
          <h3 class="panel-title">LOGIN</h3>
        </div>
         <?php if($this->session->flashdata('err')){  echo $this->session->flashdata('err'); }  ?>   
        <div class="panel-body">
         <?php echo form_open(base_url().'user/login',array("method"=>"post","name"=>"loginfrm","id"=>"loginfrm","onsubmit"=>"return valid_frm()")) ?>
            <input type="hidden" name="userLogin" value='Login'>
            <fieldset>
              <div class="form-group">
              <label>Email</label>
                <input class="form-control" type="email" name="primary_email" id="primary_email" value="<? if(isset($_COOKIE['emailid'])){echo $_COOKIE['emailid'];}?>" autofocus>
               <div id="emailErr" style="color:#C33"></div>
              </div>
              <div class="form-group">
              <label>Password</label>
                <input class="form-control" name="password" onKeydown="Javascript: if (event.keyCode==13) valid_frm();" id="password" type="password" value="<? if(isset($_COOKIE['userpasw'])){ echo $_COOKIE['userpasw'];}?>" type="password"> <div id="passwordErr" style="color:#C33"></div>
              </div>
              <div class="checkbox">
                <label>
                  <input name="remember" id="remember" <?php if(isset($_COOKIE['emailid'])){?> checked="checked" <?php }?> type="checkbox" value="y">
                Remember me on this computer </label>
              </div>
              <div class="submit-row">
              <div class="submit-row-border"></div>
              <!-- Change this to a button or input when using this as a form --> 
              <a type="javascript:void();" onClick="return valid_frm();" class="btn btn-lg btn-success btn-block"></a>
            </fieldset>
          <?=form_close()?>  
          <div class="submit-row-border"></div>
        </div>
        	  <div class="forgot-row">
              <a href="<?=base_url()?>user/forgotpassword"><span>Forgot password</span></a>
              <a href="<?=base_url()?>user/register"><span> Register</span></a>
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
    var email = document.getElementById("primary_email").value;
	var password = document.getElementById("password").value;
	var reg =/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	var cnt=0;
	if(email=='')
	{
		document.getElementById("emailErr").innerHTML='Enter your login email !';
		document.getElementById("primary_email").style.borderColor='red';
	    cnt++;
	}
	else if(reg.test(email)==false)
	{
		document.getElementById("emailErr").innerHTML='Invalid email address !';
		document.getElementById("primary_email").style.borderColor='red';
	    cnt++;
	}
	else
	{
		document.getElementById("emailErr").innerHTML='';
		document.getElementById("primary_email").style.borderColor='';
	}
	if(password=='')
	{
		document.getElementById("passwordErr").innerHTML='Enter your login password !';
		document.getElementById("password").style.borderColor='red';
	    cnt++;
	}
	else
	{
		document.getElementById("passwordErr").innerHTML='';
		document.getElementById("password").style.borderColor='';
	}
	
	if(cnt>0)
	{
		return false;
	}
	else
	{
		
		document.getElementById("loginfrm").submit();
	}
	
}
</script>
</body>
</html>