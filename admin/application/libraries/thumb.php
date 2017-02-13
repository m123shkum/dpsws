<?php 
class thumb
{
function createThumb($upload_image,$file,$thumbnail,$new_w,$new_h){


	$system=explode('.',$file);
	if ($system[1]=='jpg' || $system[1]=='JPG' || $system[1]=='jpeg' || $system[1]=='JPEG')
	{
		$source=imagecreatefromjpeg($upload_image);
	}
	if (preg_match('/png/',$system[1])){
		$source=imagecreatefrompng($upload_image);
	}
	if (preg_match('/gif/',$system[1])){
		$source=imagecreatefromgif($upload_image);
	}
				//
				
                //$width = imagesx($source);
                //$height = imagesy($source);
				
				$old_x=imageSX($source);
               $old_y=imageSY($source);
  
				$thumb_w=$new_w;
$thumb_h=$new_h;

if ($old_x > $old_y) {
    if($old_x >$new_w)
	  $thumb_w=$new_w;
	 else
	    $thumb_w=$old_x;
		
	$ratio=$old_x/$old_y;
    if($old_y >$new_h)
	  $thumb_h=$new_w/$ratio;
	 else
	    $thumb_h=$old_y; 
}
if ($old_x < $old_y) {
    $ratio=$old_x/$old_y;
  if($old_x >$new_w)
	$thumb_w=$new_h*$ratio;
	else
	    $thumb_w=$old_x;	
	 if($old_y >$new_h)
	   $thumb_h=$new_h;
	 else
	    $thumb_h=$old_y;
	
}
if ($old_x == $old_y) {
	$thumb_w=$new_w;
	$thumb_h=$new_h;
}
  
  $newwidth=$thumb_w;
  $newheight=$thumb_h;
  // Load the images
$thumb = imagecreatetruecolor($new_w, $new_h);
//$source = imagecreatefromjpeg($upload_image);
 imagecopyresampled($thumb,$source,0,0,0,0,$new_w, $new_h,$old_x,$old_y); 
// Save the new file to the location specified by $thumbnail
//imagejpeg($thumb, $thumbnail,100);
if (preg_match("/png/",$system[1]))
     {
	   imagepng($thumb, $thumbnail,100); 
      }
	  elseif (preg_match("/gif/",$system[1]))
     {
	   imagegif($thumb, $thumbnail,100); 
      }
	 else 
	 {
	  imagejpeg($thumb, $thumbnail,100);
     }
}

}

//////////////////////////////////////////////////////////////
?>