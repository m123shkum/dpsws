<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Schoolz Administration</title>

<!-- Core CSS - Include with every page -->
<link href="<?=base_url()?>public/css/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url()?>public/font-awesome/css/font-awesome.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700,300italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
<script src="<?=base_url()?>public/js/jquery-1.10.2.js"></script> 
<!-- Page-Level Plugin CSS - Forms -->

<!-- SB Admin CSS - Include with every page -->
<link href="<?=base_url()?>public/css/sb-admin.css" rel="stylesheet">
</head>

<body>
<div id="wrapper">
  <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
    <a class="navbar-brand" href="<?php echo base_url();?>user/home"><img src="<?php echo base_url();?>/public/images/logo.png"></a> 
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
    <!-- /.navbar-header -->
    
    <ul class="nav navbar-top-links navbar-right">
    
      <li><ol class="glyphicon glyphicon-user" style="margin-right:10px;"></ol><small><?php echo ucfirst($this->session->userdata('user_type'));?> ( <strong><?php echo $this->session->userdata('user_name');?> </strong>)</small></li>
      <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);"> <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i> </a>
        <ul class="dropdown-menu dropdown-user">
        <!--  <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a> </li>-->
          <li><a href="<?php echo base_url();?>user/account"><i class="fa fa-gear fa-fw"></i> Settings</a> </li>
          <li class="divider"></li>
          <li><a href="<?php echo base_url();?>user/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a> </li>
        </ul>
        <!-- /.dropdown-user --> 
      </li>
      <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->