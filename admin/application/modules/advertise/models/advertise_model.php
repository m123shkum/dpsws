<?php 
class Advertise_model extends CI_Model 
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
       function allstates()
	{
	 $res=$this->db->query("select * from sch_zone where country_id=99 and status=1");
	 return $res->result_array();
	}
     
        //One single record BY Id
        function oneRecordById($id,$table)
	{
	 $res=$this->db->query("select * from $table where id=$id");
	 return $res->row_array();
	}
	
        /*====================================================================
	 #####################Add Gallery ########################
	 ====================================================================*/
        function add_advertise()
        {
            
            if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/advertise/".$image);
            }
           
        
	  $data=array(                          
                        'area_name'=>$_POST['area_name'],
                        'image_title'=>mysql_real_escape_string($_POST['image_title']),
                        'link'=>mysql_real_escape_string($_POST['link']),
			'image'=>$image,
                        'ord'=>$_POST['ord'],
                        'size'=>$_POST['size']
		           );	          
				$query=$this->db->insert('sch_advertise',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_advertise()
	{
            $image=$_POST['hidden_image'];
	    if(!empty($_FILES['image']['name']))
            {
                unlink($this->droot."/public/advertise/".$_POST['hidden_image']);                
                
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);
		 
		 $image=rand()."_".$image;
		 
            copy($_FILES['image']['tmp_name'],$this->droot."/public/advertise/".$image);
            }
            
            $data=array(                          
                        'area_name'=>$_POST['area_name'],
                        'image_title'=>mysql_real_escape_string($_POST['image_title']),
                        'link'=>mysql_real_escape_string($_POST['link']),
			'image'=>$image,
                        'ord'=>$_POST['ord'],
                        'size'=>$_POST['size']
		           );
				   $this->db->where('id',$_POST['advert_id']);
				   $query=$this->db->update('sch_advertise',$data);
                    
                                 
	}
}
	