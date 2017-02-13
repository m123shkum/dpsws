<?php 
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");

$arr=explode("/",$_SERVER['REQUEST_URI']);
//print_r($arr);
$classactive1=$classactive2=$classactive3=$classactive4=$classactive5=$classactive6=$classactive7=$classactive8=$classactive9=$classactive10=$classactive11=$classactive12=$classactive13=$classactive14=$classactive15=$classactive16=$classactive17=$classactive18=$classactive19=$classactive20=$classactive21="";
if(in_array('schoolsignup',$arr))
{
        $classactive1=' class="active"';
}
if(in_array('feedback',$arr))
{
        $classactive2=' class="active"';
}

if(in_array('marketrequest',$arr))
{
        $classactive3=' class="active"';
}
if(in_array('school',$arr))
{
        $classactive4=' class="active"';
}

if(in_array('parents',$arr))
{
        $classactive5=' class="active"';
}
if(in_array('vendor',$arr))
{
        $classactive6=' class="active"';
}
if(in_array('teacher',$arr))
{
        $classactive7=' class="active"';
}

if(in_array('jobsapply',$arr))
{
        $classactive8=' class="active"';
}
if(in_array('banner',$arr))
{
        $classactive9=' class="active"';
}

if(in_array('page',$arr))
{
        $classactive10=' class="active"';
}
if(in_array('events',$arr))
{
        $classactive11= 'class="active"';
}
if(in_array('testimonial',$arr))
{
        $classactive12=' class="active"';
}
if(in_array('typecontent',$arr))
{
        $classactive13=' class="active"';
}

if(in_array('newsletter',$arr))
{
        $classactive14=' class="active"';
}

if(in_array('advertise',$arr))
{
        $classactive15=' class="active"';
}
if(in_array('admission',$arr))
{
        $classactive16=' class="active"';
}
if(in_array('location',$arr))
{
        $classactive17=' class="active"';
}
if(in_array('career',$arr))
{
        $classactive18=' class="active"';
}
if(in_array('news',$arr))
{
        $classactive19=' class="active"';
}
if(in_array('users',$arr))
{
        $classactive20=' class="active"';
}
if(in_array('usertypetestitmonial',$arr))
{
        $classactive20=' class="active"';
}
?>
<div class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
          <li> <a href="<?php echo base_url();?>user/home"> Dashboard</a> </li>             
          <li> <a <?php echo $classactive1?> href="<?php echo base_url();?>schoolsignup/"> School Request</a> </li>       
          <li> <a <?php echo $classactive2?> href="<?php echo base_url();?>experts">Expert Advise</a> </li>
          <li> <a <?php echo $classactive18?> href="<?php echo base_url();?>career">Career</a> </li>
          <li> <a <?php echo $classactive3?> href="<?php echo base_url();?>marketrequest">Market Place Request</a> </li>          
          <li> <a <?php echo $classactive20?> href="<?php echo base_url();?>users"> Users Management</a> </li> 
          <li> <a <?php echo $classactive4?> href="<?php echo base_url();?>school/"> School Management</a> </li> 
          <li> <a <?php echo $classactive5?> href="<?php echo base_url();?>parents/"> Parents Management</a> </li>
          <li> <a <?php echo $classactive6?> href="<?php echo base_url();?>vendor/">Vendor Management</a> </li>
          <li> <a <?php echo $classactive7?> href="<?php echo base_url();?>teacher/">Teacher Management</a> </li>
          <li> <a <?php echo $classactive8?> href="<?php echo base_url();?>jobsapply">View Applied Jobs</a> </li>
          <li> <a <?php echo $classactive9?> href="<?php echo base_url();?>banner/"> Banner Management</a> </li>         
          <li> <a <?php echo $classactive10?> href="<?php echo base_url();?>page/"> Page Management</a> </li>  
          <li> <a <?php echo $classactive11?> href="<?php echo base_url();?>events/"> Event Management</a> </li>
          <li> <a <?php echo $classactive19?> href="<?php echo base_url();?>news/"> News Management</a> </li>
          <li> <a <?php echo $classactive12?> href="<?php echo base_url();?>testimonial/"> Testimonials Management</a> </li>
           
           <li> <a <?php echo $classactive20?> href="<?php echo base_url();?>usertypetestitmonial/"> User Testimonials Management</a> </li>
<!--           <li> <a href="<?php echo base_url();?>adventure/"> Adventure Management</a> </li>-->
          <!--<li> <a href="<?php echo base_url();?>typepages/"> User Type</a> </li>   -->         
         <li> <a <?php echo $classactive13?> href="<?php echo base_url();?>typecontent/"> User Type Content</a> </li>        
         
          <li> <a <?php echo $classactive14?> href="<?php echo base_url();?>newsletter/">Subscriber Management</a> </li>
          <li> <a <?php echo $classactive15?> href="<?php echo base_url();?>advertise/">Advertise Management</a> </li>
          <li> <a <?php echo $classactive16?> href="<?php echo base_url();?>admission/">Admission Applied</a> </li>
<!--          <li> <a href="<?php echo base_url();?>caf/">Caf Applied</a> </li>-->
          <li> <a <?php echo $classactive17?> href="<?php echo base_url();?>location/">Location Management</a> </li>        
          <li> <a href="<?php echo base_url();?>school/export_import/">School Import/Export</a> </li>        
        </ul>
        <!-- /#side-menu --> 
      </div>
      <!-- /.sidebar-collapse --> 
    </div>
	</nav>
    