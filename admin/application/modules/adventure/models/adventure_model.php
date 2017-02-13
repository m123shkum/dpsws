<?php 
class Adventure_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
        $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz";    
        
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
        function add_adventure()
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
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/adventureimage/".$thumbimage);
         
            }
            
            $title= mysql_real_escape_string($_POST['title']);
            $description= $_POST['description'];           
        
	   $data=array( 
                        'title'=>$title,
                        'address'=>mysql_real_escape_string($_POST['address']), 
                        'adventure_area'=>mysql_real_escape_string($_POST['adventure_area']),
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$description,
                        'image'=>$thumbimage                        
		           );
          
				$query=$this->db->insert('sch_adventure',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_adventure()
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
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/adventureimage/".$thumbimage);
         @unlink($this->droot."/public/adventureimage/".$_POST['hidden_image']);
            }else{$thumbimage=$_POST['hidden_image'];}
            
            $title= mysql_real_escape_string($_POST['title']);
            $description= $_POST['description'];
        
	   $data=array( 
                        'title'=>$title,
                        'address'=>mysql_real_escape_string($_POST['address']), 
                        'adventure_area'=>mysql_real_escape_string($_POST['adventure_area']),
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$description,
                        'image'=>$thumbimage                        
		           );
				   $this->db->where('id',$_POST['adventure_id']);
				   $query=$this->db->update('sch_adventure',$data);
                    
                                 
	}
}
	