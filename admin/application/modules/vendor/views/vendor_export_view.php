<?php
$output = "Id,Vendor Name,Email,Keywords,Contact,Business name,Address,StateId,AreaId,Location";

$output .="\n";

foreach($results AS $row){ 
    $rss=$this->db->query("SELECT owner_name from sch_user where id=".$row['user_id']."")->row_array();    
    
      $output .='"'.$row['id'].'",'.'"'.$row['vendor_name'].'",'.'"'.$row['emailid'].'",'.'"'.$row['keywords'].'",'.'"'.$row['mobileno'].'",'.'"'.$row['business_name'].'",'.'"'.$row['street'].'",'.'"'.$row['state_id'].'",'.'"'.$row['area_id'].'",'.'"'.$row['location'].'",';
      $output .="\n";
  }    

$filename = "vendordata.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;
	
?>  
  


