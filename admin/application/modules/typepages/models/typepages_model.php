<?php 
class Typepages_model extends CI_Model 
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
       

   function update_typepages()
	{
          $image="";
          if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/worthimage/".$image);
         @unlink($this->droot."/public/worthimage/".$_POST['hidden_image']); 
            }else{$image=$_POST['hidden_image'];}
            
            $title= mysql_real_escape_string($_POST['title']);                                   
            $content= $_POST['content'];   
            
        
	    $data=array(                          
                        'title'=>$title,  
                        'meta_keyword'=>mysql_real_escape_string($_POST['meta_keyword']), 
                        'meta_description'=>mysql_real_escape_string($_POST['meta_description']), 
                        'short_description'=>mysql_real_escape_string($_POST['short_description']),                 
                        'content'=>$content,
                        'image'=>$image
		           );
				   $this->db->where('id',$_POST['typepages_id']);
				   $query=$this->db->update('sch_user_type',$data);
                    
                                 
	}
}
	