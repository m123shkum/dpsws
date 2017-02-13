<?php 
class Typecontent_model extends CI_Model 
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
       

   function update_typecontent()
	{          
          
            $tab_name= mysql_real_escape_string($_POST['tab_name']);
            $title= mysql_real_escape_string($_POST['title']);                                   
            $content= $_POST['content'];   
            
            $res=$this->db->query("SELECT * from sch_user_type where id=".$_POST['user_type'])->row_array();
            $type_name=$res['name'];
            
	    $data=array(   
                        'type_id'=>$_POST['user_type'],
                        'type_name'=>$type_name,
                        'tab_name'=>$tab_name,
                        'title'=>$title,                          
                        'content'=>$content,
						'link'=>$_POST['link'],
                        'ord'=>$_POST['ord']
		              );
				   $this->db->where('id',$_POST['typecontent_id']);
				   $query=$this->db->update('sch_usertype_details',$data);
                    
                                 
	}
        
    function add_typecontent()
	{          
          
            $tab_name= mysql_real_escape_string($_POST['tab_name']);
            $title= mysql_real_escape_string($_POST['title']);                                   
            $content= $_POST['content'];   
            
            $res=$this->db->query("SELECT * from sch_user_type where id=".$_POST['user_type'])->row_array();
            $type_name=$res['name'];
        
	    $data=array(  
                        'type_id'=>$_POST['user_type'],
                        'type_name'=>$type_name,
                        'tab_name'=>$tab_name,
                        'title'=>$title,                          
                        'content'=>$content,
						 'ord'=>$_POST['ord']
		           );
            $query=$this->db->insert('sch_usertype_details',$data);				 
                    
                                 
	}
}
	