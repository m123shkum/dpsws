<?php 
class Banner_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
        $this->droot=$_SERVER['DOCUMENT_ROOT']."/beta";    
        
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
        function add_banner()
        {
            
            if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);
		 
		 $image=rand()."_".$image;
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/banner/".$image);
		 
         //===========================generate thumbnail====================== 
		 /*$upload_image =$this->droot."/public/banner/".$image;
		 $thumbnail=$this->droot."/public/banner/thumb_".$image;
		 $new_width = "197";
		 $new_height ="135";
		 $this->thumb->createThumb($upload_image,$image,$thumbnail,$new_width,$new_height ); */   
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);   
            $link= mysql_real_escape_string($_POST['link']); 
            $ord=$_POST['ord'];
        
	  $data=array(                          
                        'image_title'=>$image_title,
                        'link'=>$link,
			'image'=>$image,
                        'ord'=>$ord
		           );	          
				$query=$this->db->insert('sch_banner',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_banner()
	{
            $image=$_POST['hidden_image'];
	    if(!empty($_FILES['image']['name']))
            {
                unlink($this->droot."/public/banner/".$_POST['hidden_image']);                
                
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);
		 
		 $image=rand()."_".$image;
		 
            copy($_FILES['image']['tmp_name'],$this->droot."/public/banner/".$image);
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);    
            $link= mysql_real_escape_string($_POST['link']);
            $ord=$_POST['ord'];
        
	  $data=array(                          
                        'image_title'=>$image_title,
                        'link'=>$link,
			'image'=>$image,
                        'ord'=>$ord
		           );
				   $this->db->where('id',$_POST['image_id']);
				   $query=$this->db->update('sch_banner',$data);
                    
                                 
	}
}
	