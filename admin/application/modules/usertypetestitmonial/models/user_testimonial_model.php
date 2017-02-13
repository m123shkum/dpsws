<?php 
class User_testimonial_model extends CI_Model 
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
	 
	  function add_testimonial()
        {
        /*    $image="";
          if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/worthimage/".$image);
            }*/
            
            $title= mysql_real_escape_string($_POST['title']);                       
            //$short_content= mysql_real_escape_string($_POST['short_content']); 
        
	  $data=array(                          
                        'title'=>$title,
                        'description'=>$_POST['description']
                       
                       
		           );	          
				$query=$this->db->insert('sch_usertype_testimonial',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_testimonial()
	{
       /*   $image="";
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
            $short_content= mysql_real_escape_string($_POST['short_content']); */
        
	   $data=array(                          
                        'title'=>$_POST['title'],
                        'description'=>$_POST['description']
                      /* 'profession'=>mysql_real_escape_string($_POST['profession']),
                        'tschool_name'=>mysql_real_escape_string($_POST['tschool_name']),
                        'website'=>mysql_real_escape_string($_POST['website']),
                        'short_content'=>$short_content,                       
                        'image'=>$image*/
		           );
				   $this->db->where('id',$_POST['testimonial_id']);
				   $query=$this->db->update('sch_usertype_testimonial',$data);
                    
                                 
	}
}
	