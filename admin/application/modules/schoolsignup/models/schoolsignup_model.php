<?php 
class Schoolsignup_model extends CI_Model 
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
        function add_testimonial()
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
            }
            
            $title= mysql_real_escape_string($_POST['title']);                       
            $short_content= mysql_real_escape_string($_POST['short_content']); 
            $content= $_POST['content'];            
            
        
	  $data=array(                          
                        'title'=>$title,
                        'short_content'=>$short_content,
                        'content'=>$content,
                        'image'=>$image
		           );	          
				$query=$this->db->insert('sch_testimonials',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_caf()
	{   
        
	    $data=array(                          
                        'caf_name'=>mysql_real_escape_string($_POST['caf_name']),
                        'caf_fathername'=>mysql_real_escape_string($_POST['caf_fathername']),
                        'caf_mothername'=>mysql_real_escape_string($_POST['caf_mothername']),
                        'caf_email'=>mysql_real_escape_string($_POST['caf_email']),
                        'caf_contctno'=>mysql_real_escape_string($_POST['caf_contctno']),
                'caf_details'=>mysql_real_escape_string($_POST['caf_details']),
                'reg_date'=>date("Y-m-d",time())
                
		           );
				   $this->db->where('id',$_POST['caf_id']);
				   $query=$this->db->update('sch_caf',$data);
                    
                                 
	}
}
	