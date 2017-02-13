<?php 
class Users_model extends CI_Model 
{
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	/*====================================================================
	 ###################Get Commor record ##################
	 ====================================================================*/
        function allcountry()
	{
	 $res=$this->db->query("select * from sch_country order by name asc");
	 return $res->result_array();
	}  
        function state_by_country($country_id)
	{
	 $res=$this->db->query("select * from sch_zone where country_id=$country_id");
	 return $res->result_array();
	}
	function city_by_state($stae_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_cityid=$stae_id");
	 return $res->result_array();
	}
	function recordById($uid)
	{
	 $res=$this->db->query("select * from sch_user where id=$uid");
	 return $res->row_array();
	}
	
	  
	 

	/*====================================================================
	 #####################Add user by Super admin########################
	 ====================================================================*/
	function add_user()
	{	
        
            $owner_name= mysql_real_escape_string($_POST['owner_name']);
            $email= mysql_real_escape_string($_POST['email']);
            $password= md5($_POST['passwords']);
            $user_type= $_POST['user_type'];
        
	  $data=array(  'owner_name'=>$owner_name,
			'email'=>$email,
                        'password'=>$password,
                        'user_type'=>$user_type,                        
                        'ip'=>$_SERVER['REMOTE_ADDR'],
                        'reg_date'=>date("Y-m-d",time())
		           );	
          
				$query=$this->db->insert('sch_user',$data);
                                $insert_id=$this->db->insert_id();
                                //####School Add
          if($_POST['user_type']=='school')                      
          {    
             $seo_url= str_replace(' ', '-', $_POST['school_name']); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '', $seo_url);
             
             $data=array(   
                            'user_id'=>$insert_id,
                            'seo_url'=>$seo_url,
                            'school_name'=>mysql_real_escape_string($_POST['school_name']),
                            'board'=>mysql_real_escape_string($_POST['board']),
                            'category'=>mysql_real_escape_string($_POST['category']),
                            'sub_category'=>mysql_real_escape_string($_POST['sub_category']),
                            'contact'=>mysql_real_escape_string($_POST['contact']),
                            'email'=>$email,
                            'address'=>mysql_real_escape_string($_POST['address']), 
                            'reg_date'=>date("Y-m-d",time())
                               );
             $query=$this->db->insert('sch_school',$data);
          } 
          
          if($_POST['user_type']=='vendor')                      
          {   
            
             $data=array(   
                            'user_id'=>$insert_id,                            
                            'vendor_name'=>mysql_real_escape_string($_POST['owner_name']),
                            'emailid'=>$email
                               );
             $query=$this->db->insert('sch_vendor_details',$data);
          } 
          
          if($_POST['user_type']=='teacher')                      
          {   
            
             $data=array(   
                            'user_id'=>$insert_id,                            
                            'name'=>mysql_real_escape_string($_POST['owner_name'])                           
                               );
             $query=$this->db->insert('sch_teacher_details',$data);
          } 
            //
                                   
	  
	}
	/*====================================================================
	 #####################Update User########################
	 ====================================================================*/

   function update_user()
	{
	    $owner_name= mysql_real_escape_string($_POST['owner_name']);
            $email= mysql_real_escape_string($_POST['email']);            
            $user_type= $_POST['user_type'];            
        
         if($_POST['user_password']!='')
         {
             $data=array(  'owner_name'=>$owner_name,
                        'password'=>md5($_POST['user_password']),
                        'pwd'=>$_POST['user_password'],
			'email'=>$email,                        
                        'user_type'=>$user_type,   
                        'Ispaid'=>$_POST['ispaid']
		           );
	  
         }else{
             
             $data=array(  'owner_name'=>$owner_name,
			'email'=>$email,                        
                        'user_type'=>$user_type,   
                        'Ispaid'=>$_POST['ispaid']
		           );	
              }
         
				   $this->db->where('id',$_POST['users_id']);
				   $query=$this->db->update('sch_user',$data);
                    
                                 
	}
}
	