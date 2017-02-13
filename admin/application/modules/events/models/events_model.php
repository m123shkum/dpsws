<?php 
class Events_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');       
        $this->droot=DocumentRoot; 
        
    }
	/*====================================================================
	 ###################Get Common record ##################
	 ====================================================================*/
        //One single record BY Id
        function oneRecordById($id,$table)
	{
	 $res=$this->db->query("select * from $table where id=$id");
	 return $res->row_array();
	}
        
        function location_by_area($area_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_locationid=".$area_id." and status=1 order by location asc");
	 return $res->result_array();
	}
	
        /*====================================================================
	 #####################Add Gallery ########################
	 ====================================================================*/
        function add_event()
        {
            $activities="";
            
            for($i=0;$i<count($_POST['activities']);$i++)
            {
                if($i<count($_POST['activities'])-1)
                {
                    $dot=",";
                }else{$dot="";}
                
                $activities=$activities.$_POST['activities'][$i].$dot;
            }
            
            //echo $activities;die;
            
            
           $thumbimage="";
            if(!empty($_FILES['image']['name']))
            {
                 $thumbimage=str_replace("'","",$_FILES['image']['name']);
		 $thumbimage=str_replace("'","",$thumbimage);
		 $thumbimage=str_replace("/","",$thumbimage);
		 $thumbimage=str_replace(" ","",$thumbimage);
		 $thumbimage=str_replace("%","",$thumbimage);
		 
		 $thumbimage=rand()."_".$thumbimage;
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$thumbimage);
         
            }
            
            $resss=$this->db->query("select * from sch_zone where zone_id=".$_POST['event_area']."")->row_array();
            $event_area= $resss['cityname'];
           
            
            $arr=explode("-",$_POST['start_date']);
            $published_date=$arr[2]."-".$arr[1]."-".$arr[0];
            
            $arr2=explode("-",$_POST['end_date']);
            $end_date=$arr2[2]."-".$arr2[1]."-".$arr2[0];
            
            $timearr=explode("-",$_POST['start_time']);
            $start_time=$timearr[0];
            
             $seo_url= str_replace(' ', '-', trim($_POST['event_title'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($seo_url));
        
	   $data=array( 
                        'event_seourl'=>$seo_url,
                        'event_title'=>mysql_real_escape_string($_POST['event_title']),
                        'address'=>mysql_real_escape_string($_POST['address']), 
                        'area_id'=>$_POST['event_area'],
                        'event_area'=>$event_area,
                        'event_location'=>$_POST['event_location'],
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$_POST['description'],
                        'min_age'=>$_POST['min_age'],
                        'max_age'=>$_POST['max_age'],
                        'start_time'=>$start_time,
                        'end_time'=>$_POST['end_time'],   
                        'activities'=>mysql_real_escape_string($activities),
                        'program_fee'=>$_POST['program_fee'],
                        'image'=>$thumbimage,
                        'published_date'=>$published_date,
                        'expiry_date'=>$end_date
		           );
          
				$query=$this->db->insert('sch_events',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_event()
	{
           $activities="";
            
            for($i=0;$i<count($_POST['activities']);$i++)
            {
                if($i<count($_POST['activities'])-1)
                {
                    $dot=",";
                }else{$dot="";}
                
                $activities=$activities.$_POST['activities'][$i].$dot;
            }
            
            $thumbimage="";
            if(!empty($_FILES['image']['name']))
            {
                 $thumbimage=str_replace("'","",$_FILES['image']['name']);
		 $thumbimage=str_replace("'","",$thumbimage);
		 $thumbimage=str_replace("/","",$thumbimage);
		 $thumbimage=str_replace(" ","",$thumbimage);
		 $thumbimage=str_replace("%","",$thumbimage);
		 
		 $thumbimage=rand()."_".$thumbimage;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$thumbimage);
         
          @unlink($this->droot."/public/eventimage/".$_POST['hidden_image']);
         
            }else{$thumbimage=$_POST['hidden_image'];}
            
            
            $resss=$this->db->query("select * from sch_zone where zone_id=".$_POST['event_area']."")->row_array();
            $event_area= $resss['cityname'];
            
            $arr=explode("-",$_POST['start_date']);
            $published_date=$arr[2]."-".$arr[1]."-".$arr[0];
            
            $arr2=explode("-",$_POST['end_date']);
            $end_date=$arr2[2]."-".$arr2[1]."-".$arr2[0];
            
            $timearr=explode("-",$_POST['start_time']);
            $start_time=$timearr[0];
            
             $seo_url= str_replace(' ', '-', trim($_POST['event_title'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($seo_url));
        
	   $data=array( 
                        'event_seourl'=>$seo_url,
                        'event_title'=>mysql_real_escape_string($_POST['event_title']),
                        'address'=>mysql_real_escape_string($_POST['address']), 
                        'area_id'=>$_POST['event_area'],
                        'event_area'=>$event_area,
                        'event_location'=>$_POST['event_location'],
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$_POST['description'],
                        'min_age'=>$_POST['min_age'],
                        'max_age'=>$_POST['max_age'],
                        'start_time'=>$start_time,
                        'end_time'=>$_POST['end_time'],   
                        'activities'=>mysql_real_escape_string($activities),
                        'program_fee'=>$_POST['program_fee'],
                        'image'=>$thumbimage,
                        'published_date'=>$published_date,
                        'expiry_date'=>$end_date
		           );
				   $this->db->where('id',$_POST['event_id']);
				   $query=$this->db->update('sch_events',$data);
                    
                                 
	}
        
        
        function add_gallery()
        {
            
            if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$image);
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);            
            $ord=$_POST['ord'];
        
	  $data=array(  
                        'event_id'=>$_POST['event_id'],
                        'image_title'=>$image_title,
			'image'=>$image,
                        'ord'=>$ord
		           );	          
				$query=$this->db->insert('sch_event_image',$data);
        }        
       
   function update_gallery()
	{
            $image=$_POST['hidden_image'];
	    if(!empty($_FILES['image']['name']))
            {   
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);
		 
		 $image=rand()."_".$image;		 
            copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$image);
            
             unlink($this->droot."/public/eventimage/".$_POST['hidden_image']);     
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);            
            $ord=$_POST['ord'];
        
	  $data=array( 
                        'image_title'=>$image_title,
			'image'=>$image,
                        'ord'=>$ord
		           );
				   $this->db->where('id',$_POST['image_id']);
				   $query=$this->db->update('sch_event_image',$data);
                    
                                 
	}
}
	