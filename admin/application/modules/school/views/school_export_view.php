<?php
$output = "Id,School Name,Seourl,Owner Name,Email,Address,Contact,Board,Category,Subcategory,StateId,AreaId,Location,Latitude,Longitude";

$output .="\n";

foreach($results AS $row){ 
    $rss=$this->db->query("SELECT owner_name from sch_user where id=".$row['user_id']."")->row_array();
    if(count($rss)>0)
    {
        $ownername=$rss['owner_name'];
    }else{$ownername="";}
    
      $output .='"'.$row['id'].'",'.'"'.$row['school_name'].'",'.'"'.$row['seo_url'].'",'.'"'.$ownername.'",'.'"'.$row['email'].'",'.'"'.$row['address'].'",'.'"'.$row['contact'].'",'.'"'.$row['board'].'",'.'"'.$row['category'].'",'.'"'.$row['sub_category'].'",'.'"'.$row['state_id'].'",'.'"'.$row['area_id'].'",'.'"'.$row['location'].'",'.'"'.$row['latitude'].'",'.'"'.$row['langitude'].'",';
      $output .="\n";
  }    

$filename = "schooldata.csv";
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename='.$filename);

echo $output;
exit;
	
?>  
  


