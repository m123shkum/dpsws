<?php 
class Newsletter_model extends CI_Model 
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
        function add_newsletter()
        {
           
            $email= mysql_real_escape_string($_POST['email']);                       
        
	  $data=array(                          
                        'newsletter_email'=>$email,                        
                        'reg_date'=>date("Y-m-d",time())
		           );	          
				$query=$this->db->insert('sch_subscriber',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_newsletter()
	{
          $email= mysql_real_escape_string($_POST['email']); 
          $data=array(                          
                        'newsletter_email'=>$email,                                                
		           );
				   $this->db->where('id',$_POST['subscriber_id']);
				   $query=$this->db->update('sch_subscriber',$data);
                    
                                 
	}
}
	