<?php 
class Parents_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
        $this->droot=$_SERVER['DOCUMENT_ROOT'];    
        
    }
	/*====================================================================
	 ###################Get Commor record ##################
	 ====================================================================*/
    
       function allcountry()
	{
	 $res=$this->db->query("select * from sch_country where status=1");
	 return $res->result_array();
	}
        
        function state_by_country($country_id)
	{
	 $res=$this->db->query("select * from sch_zone2 where country_id=$country_id");
	 return $res->result_array();
	}
       
        function allstates()
	{
	 $res=$this->db->query("select * from sch_zone where country_id=99 and status=1");
	 return $res->result_array();
	}
	function area_by_state($state_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_cityid=".$state_id." and status=1");
	 return $res->result_array();
	}
        function location_by_area($area_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_locationid=".$area_id." and status=1");
	 return $res->result_array();
	}
                
        
	function recordById($uid)
	{
	 $res=$this->db->query("select * from sch_user where id=$uid");
	 return $res->row_array();
	}	
        
        
        //One single record BY Id
        function oneRecordById($id,$table)
	{
	 $res=$this->db->query("select * from $table where id=$id");
	 return $res->row_array();
	}
        function oneRowbyField($table,$field,$val)
        {
            $res=$this->db->query("select * from $table where $field=$val");
	   return $res->row_array();
        }
	
	
	/*====================================================================
	 #####################Update Parent########################
	 ====================================================================*/

        function add_parent()
	{       
            $state_name="";
            $res=$this->db->query("SELECT * from sch_zone2 where zone_id=".$_POST['state_id']."")->row_array();
            if(count($res)>0){
            $state_name=$res['name'];}
            
	     $data=array(
                        'owner_name'=>mysql_real_escape_string($_POST['owner_name']), 
                        'email'=>mysql_real_escape_string($_POST['email']), 
                        'password'=>md5($_POST['password']), 
                        'pwd'=>$_POST['password'],
                        'user_type'=>'parents',
                        'contact_no'=>mysql_real_escape_string($_POST['contact_no']),
                        'address'=>mysql_real_escape_string($_POST['address']),
                        'country'=>$_POST['country_id'],
                        'state'=>$_POST['state_id'],
                        'state_name'=>$state_name,
                        'city'=>mysql_real_escape_string($_POST['city']),  
                        'reg_date'=>date("Y-m-d",time())
                        );
                  
                  $query=$this->db->insert('sch_user',$data);                   
                                 
	}
        
        
   function update_parent()
	{
            $state_name="";
            $res=$this->db->query("SELECT * from sch_zone2 where zone_id=".$_POST['state_id']."")->row_array();
            if(count($res)>0){
            $state_name=$res['name'];}
       
	     if($_POST['password']!='')
             {             
             $data=array(
                        'owner_name'=>mysql_real_escape_string($_POST['owner_name']), 
                        'password'=>md5($_POST['password']), 
                        'pwd '=>$_POST['password'],
                        'contact_no'=>mysql_real_escape_string($_POST['contact_no']),
                        'address'=>mysql_real_escape_string($_POST['address']),
                        'country'=>$_POST['country_id'],
                        'state'=>$_POST['state_id'],
                        'state_name'=>$state_name,
                        'city'=>mysql_real_escape_string($_POST['city'])
                               );               
             }else{                 
                 $data=array(
                        'owner_name'=>mysql_real_escape_string($_POST['owner_name']),                        
                        'contact_no'=>mysql_real_escape_string($_POST['contact_no']),
                        'address'=>mysql_real_escape_string($_POST['address']),
                        'country'=>$_POST['country_id'],
                        'state'=>$_POST['state_id'],
                        'state_name'=>$state_name,
                        'city'=>mysql_real_escape_string($_POST['city'])
                               );               
                  }
                  
             
		$this->db->where('id',$_POST['parents_id']);
                $this->db->update('sch_user',$data);
                    
                                 
	}
        
       
        
        /*====================================================================
	 #####################Add Event########################
	 ====================================================================*/
        function add_kid()
        {
            
            $image="";
            if(!empty($_FILES['applicant_image']['name']))
            {
                 $image=str_replace("'","",$_FILES['applicant_image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
            copy($_FILES['applicant_image']['tmp_name'],$this->droot."/public/applicantimage/".$image);             
            } 
            
            $dob=$_POST['date']."/".$_POST['month']."/".$_POST['year'];   
            
            //$school_email=$_POST['school_email'];
            
            $child_name= $_POST['fname'];            
                   
            
	     $data=array(   'parent_id'=>$_POST['parent_id'],                   
                            'fname'=>mysql_real_escape_string($_POST['fname']),
                            'mname'=>mysql_real_escape_string($_POST['mname']),                     
                            'lname'=>mysql_real_escape_string($_POST['lname']), 
                            'dob'=>$dob,
                            'age'=>mysql_real_escape_string($_POST['age']),
                            'gender'=>mysql_real_escape_string($_POST['gender']),
                            'raddress'=>mysql_real_escape_string($_POST['raddress']),
                            'pincode'=>mysql_real_escape_string($_POST['pincode']),
                            'contactno'=>mysql_real_escape_string($_POST['child_contactno']),                            
                            'family_income'=>mysql_real_escape_string($_POST['family_income']),
                            'religion'=>mysql_real_escape_string($_POST['religion']),
                            'father_name'=>mysql_real_escape_string($_POST['father_name']),
                            'father_qualify'=>mysql_real_escape_string($_POST['father_qualify']),
                           'father_occupation'=>mysql_real_escape_string($_POST['father_occupation']),
                           'father_designation'=>mysql_real_escape_string($_POST['father_designation']),
                           'father_mobile'=>mysql_real_escape_string($_POST['father_mobile']),
                           'father_phone'=>mysql_real_escape_string($_POST['father_phone']),
                           'father_ofc_address'=>mysql_real_escape_string($_POST['father_ofc_address']),
                           'father_monthly_income'=>mysql_real_escape_string($_POST['father_monthly_income']),
                           'mother_name'=>mysql_real_escape_string($_POST['mother_name']),
                           'mother_qualify'=>mysql_real_escape_string($_POST['mother_qualify']),
                           'mother_occupation'=>mysql_real_escape_string($_POST['mother_occupation']),
                           'mother_designation'=>mysql_real_escape_string($_POST['mother_designation']),
                           'mother_phone'=>mysql_real_escape_string($_POST['mother_phone']),
                           'mother_mobile'=>mysql_real_escape_string($_POST['mother_mobile']),
                           'mother_ofc_address'=>mysql_real_escape_string($_POST['mother_ofc_address']),
                 'mother_monthly_income'=>mysql_real_escape_string($_POST['mother_monthly_income']),
                  'applicantimage'=>$image
                               );
             
				$query=$this->db->insert('sch_childprofile',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_kid()
	{
            $image="";
            if(!empty($_FILES['applicant_image']['name']))
            {
                 $image=str_replace("'","",$_FILES['applicant_image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
            copy($_FILES['applicant_image']['tmp_name'],$this->droot."/public/applicantimage/".$image); 
            @unlink($this->droot."/public/applicantimage/".$_POST['hidden_image']);
            } else{$image=$_POST['hidden_image'];}
            
            $dob=$_POST['date']."/".$_POST['month']."/".$_POST['year'];   
            
            //$school_email=$_POST['school_email'];
            
            $child_name= $_POST['fname'];            
                   
            
	     $data=array(                            
                            'fname'=>mysql_real_escape_string($_POST['fname']),
                            'mname'=>mysql_real_escape_string($_POST['mname']),                     
                            'lname'=>mysql_real_escape_string($_POST['lname']), 
                            'dob'=>$dob,
                            'age'=>mysql_real_escape_string($_POST['age']),
                            'gender'=>mysql_real_escape_string($_POST['gender']),
                            'raddress'=>mysql_real_escape_string($_POST['raddress']),
                            'pincode'=>mysql_real_escape_string($_POST['pincode']),
                            'contactno'=>mysql_real_escape_string($_POST['child_contactno']),
                            'rdistance'=>mysql_real_escape_string($_POST['rdistance']),
                            'family_income'=>mysql_real_escape_string($_POST['family_income']),
                            'religion'=>mysql_real_escape_string($_POST['religion']),
                            'father_name'=>mysql_real_escape_string($_POST['father_name']),
                            'father_qualify'=>mysql_real_escape_string($_POST['father_qualify']),
                           'father_occupation'=>mysql_real_escape_string($_POST['father_occupation']),
                           'father_designation'=>mysql_real_escape_string($_POST['father_designation']),
                           'father_mobile'=>mysql_real_escape_string($_POST['father_mobile']),
                           'father_phone'=>mysql_real_escape_string($_POST['father_phone']),
                           'father_ofc_address'=>mysql_real_escape_string($_POST['father_ofc_address']),
                           'father_monthly_income'=>mysql_real_escape_string($_POST['father_monthly_income']),
                           'mother_name'=>mysql_real_escape_string($_POST['mother_name']),
                           'mother_qualify'=>mysql_real_escape_string($_POST['mother_qualify']),
                           'mother_occupation'=>mysql_real_escape_string($_POST['mother_occupation']),
                           'mother_designation'=>mysql_real_escape_string($_POST['mother_designation']),
                           'mother_phone'=>mysql_real_escape_string($_POST['mother_phone']),
                           'mother_mobile'=>mysql_real_escape_string($_POST['mother_mobile']),
                           'mother_ofc_address'=>mysql_real_escape_string($_POST['mother_ofc_address']),
                 'mother_monthly_income'=>mysql_real_escape_string($_POST['mother_monthly_income']),
                  'applicantimage'=>$image
                               );
             
                $this->db->where('id',$_POST['kid_id']);
                $this->db->update('sch_childprofile',$data);
                    
                                 
	}       
       
}
	