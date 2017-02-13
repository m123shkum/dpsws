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
	
        /*====================================================================
	 #####################Add Gallery ########################
	 ====================================================================*/
        function add_event()
        {
            
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
            
            $event_title= mysql_real_escape_string($_POST['event_title']);
            $description= $_POST['description'];
            
            $arr=explode("-",$_POST['start_date']);
            $published_date=$arr[2]."-".$arr[1]."-".$arr[0];
            
            $arr2=explode("-",$_POST['end_date']);
            $end_date=$arr2[2]."-".$arr2[1]."-".$arr2[0];
            
             $seo_url= str_replace(' ', '-', trim($_POST['event_title'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($seo_url));
        
	   $data=array( 
                        'event_seourl'=>$seo_url,
                        'event_title'=>$event_title,
                        'address'=>mysql_real_escape_string($_POST['address']), 
                        'event_area'=>mysql_real_escape_string($_POST['event_area']),
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$description,
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
         
            }else{$thumbimage=$_POST['hidden_image'];}
            
            $event_title= mysql_real_escape_string($_POST['event_title']);
            $description= $_POST['description'];
            
            $arr=explode("-",$_POST['start_date']);
            $published_date=$arr[2]."-".$arr[1]."-".$arr[0];
            
            $arr2=explode("-",$_POST['end_date']);
            $end_date=$arr2[2]."-".$arr2[1]."-".$arr2[0];
            
             $seo_url= str_replace(' ', '-', trim($_POST['event_title'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($seo_url));
        
	   $data=array( 
                        'event_seourl'=>$seo_url,
                        'event_title'=>$event_title,
                        'address'=>mysql_real_escape_string($_POST['address']), 
                        'event_area'=>mysql_real_escape_string($_POST['event_area']),
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$description,
                        'image'=>$thumbimage,
                        'published_date'=>$published_date,
                        'expiry_date'=>$end_date
		           );
				   $this->db->where('id',$_POST['event_id']);
				   $query=$this->db->update('sch_events',$data);
                    
                                 
	}
}
	