<?php $this->load->view('../common/header_view');?>
<?php $this->load->view('../common/left_view');?>
<div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1>Dashboard </h1>
        <ol class="breadcrumb">
          <li class="active"><i class="fa fa-dashboard"></i> Dashboard</li>
        </ol>
        
       <div class="sort-row">
           <label class="inner-label"><i>Total No. of Users Registered : <?php echo $totalusers; ?></i></label>
       </div>
           <div class="sort-row">
        <label class="inner-label"><i>Total No. of Parent Registered : <?php echo $totalregisteredparent; ?></i></label>
       </div>
          <div class="sort-row">
        <label class="inner-label"><i>Total No. of School Registered : <?php echo $totalregisteredschool; ?></i></label>
       </div>
          <div class="sort-row">
        <label class="inner-label"><i>Total No. of Vendor Registered : <?php echo $totalregisteredvendor; ?></i></label>
       </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
<?php $this->load->view('../common/footer_view');?>