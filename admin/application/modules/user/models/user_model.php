<?php 
class User_model extends CI_Model 
{
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function city_by_country($country_id)
	{
	 $res=$this->db->query("select * from cities where country_id=$country_id");
	 return $res->row_array();
	}
	
	function allcountry()
	{
	 $res=$this->db->query("select * from countries order by name asc");
	 return $res->result_array();
	}
        
        function recordById($uid)
	{
	 $res=$this->db->query("select * from sch_admin where id=$uid");
	 return $res->row_array();
	}
    	

}
	

