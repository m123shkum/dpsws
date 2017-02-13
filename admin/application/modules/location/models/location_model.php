<?php 
class Location_model extends CI_Model 
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
	 $res=$this->db->query("select * from $table where zone_id=$id");
	 return $res->row_array();
	}
	
        /*====================================================================
	 #####################Add Gallery ########################
	 ====================================================================*/
        function add_location()
        {   
        
	  $data=array( 
                        'zone_locationid'=>$_POST['cityname'],
                        'location'=>ucfirst($_POST['location'])
		           );	          
				$query=$this->db->insert('sch_zone',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_location()
	{
                $data=array( 
                        'zone_locationid'=>$_POST['cityname'],
                        'location'=>ucfirst($_POST['location'])
		           );
				   $this->db->where('zone_id',$_POST['zone_id']);
				   $query=$this->db->update('sch_zone',$data);
                    
                                 
	}
}
	