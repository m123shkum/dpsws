<?php 
class Teacher_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
       $this->droot=DocumentRoot;  
        
    }
	/*====================================================================
	 ###################Get Commor record ##################
	 ====================================================================*/
       
        function allstates()
	{
	 $res=$this->db->query("select * from sch_zone where country_id=99 and status=1");
	 return $res->result_array();
	}
	function area_by_state($state_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_cityid=".$state_id." and zone_cityid!=0 and status=1");
	 return $res->result_array();
	}
        function location_by_area($area_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_locationid=".$area_id." and zone_locationid!=0 and status=1");
	 return $res->result_array();
	}
                
        function qualification()
        {
            $res=$this->db->query("select * from sch_qualification_type where status=1 order by name");
	    return $res->result_array();
        }
        
	function recordById($uid)
	{
	 $res=$this->db->query("select * from sch_teacher_details where id=$uid");
	 return $res->row_array();
	}
	
        function schoolUsers()
        {
          $res=$this->db->query("select id,owner_name,email from sch_user where user_type='school' and status=1 order by owner_name asc");
	  return $res->result_array();
        }
        
        //One single record BY Id
        function oneRecordById($id,$table)
	{
	 $res=$this->db->query("select * from $table where id=$id");
	 return $res->row_array();
	}
	  
  function add_education()
  {         
           
		$data=array(
                            'user_id'=>$_POST['teacher_id'],
                            'institution'=>mysql_real_escape_string($_POST['institution']),
                            'board_university'=>mysql_real_escape_string($_POST['board_university']),                    
                            'year_passing'=>$_POST['year_passing'],  
                            'major_subject'=>$_POST['major_subject'], 
                            'marks'=>$_POST['marks'],
                            'degree'=>$_POST['degree']                            
                               );
               // print_r($data);
                $query=$this->db->insert('sch_teacher_eduinfo',$data);
            
  }
  
  function update_education()
  {           
	  
           
		$data=array(                            
                            'institution'=>mysql_real_escape_string($_POST['institution']),
                            'board_university'=>mysql_real_escape_string($_POST['board_university']),                    
                            'year_passing'=>$_POST['year_passing'],  
                            'major_subject'=>$_POST['major_subject'], 
                            'marks'=>$_POST['marks'],
                            'degree'=>$_POST['degree'] 
                               );
               // print_r($data);                
                $this->db->where('id',$_POST['edu_id']);
	       $query=$this->db->update('sch_teacher_eduinfo',$data);
                
            
  }
  
  function add_profession()
  {
                      
	  // $res=$this->db->query("SELECT * from sch_teacher_details where id=".$_POST['teacher_id']."")->row_array(); 
           
		$data=array(
                            'user_id'=>$_POST['teacher_id'],
                            'organization'=>mysql_real_escape_string($_POST['organization']),
                            'designation'=>mysql_real_escape_string($_POST['designation']),                    
                            'duration_start_year'=>$_POST['start_year'],  
                            'duration_start_month'=>$_POST['start_month'], 
                            'duration_end_year'=>$_POST['end_year'],
                            'duration_end_month'=>$_POST['end_month'],
                            'brief_job_description'=>mysql_real_escape_string($_POST['brief_job_description']),
                            'specific_experience'=>mysql_real_escape_string($_POST['specific_experience'])
                               );
               // print_r($data);
                $query=$this->db->insert('sch_professional_experience',$data);
            
  }
  
  function update_profession()
  {           
	  
           
		$data=array(                            
                            'organization'=>mysql_real_escape_string($_POST['organization']),
                            'designation'=>mysql_real_escape_string($_POST['designation']),                    
                            'duration_start_year'=>$_POST['start_year'],  
                            'duration_start_month'=>$_POST['start_month'], 
                            'duration_end_year'=>$_POST['end_year'],
                            'duration_end_month'=>$_POST['end_month'],
                            'brief_job_description'=>mysql_real_escape_string($_POST['brief_job_description']),
                            'specific_experience'=>mysql_real_escape_string($_POST['specific_experience'])
                               );
               // print_r($data);                
                $this->db->where('id',$_POST['profes_id']);
	       $query=$this->db->update('sch_professional_experience',$data);
                
            
  }

   function add_teacher()
   {
       
       $resume="";
          if(!empty($_FILES['resume']['name']))
            {
                 $resume=str_replace("'","",$_FILES['resume']['name']);
		 $resume=str_replace("'","",$resume);
		 $resume=str_replace("/","",$resume);
		 $resume=str_replace(" ","",$resume);
		 $resume=str_replace("%","",$resume);		 
		 $resume=rand()."_".$resume;		 
         copy($_FILES['resume']['tmp_name'],$this->droot."/public/resume/".$resume);		          
            }
            
            
            
            $name= mysql_real_escape_string($_POST['name']);
            $mobileno= $_POST['mobileno'];
            $landline= $_POST['landline']; 
            $exp_year= $_POST['expyear'];  
            $exp_month = $_POST['expmonth'];  
            
            $totalmonth=$_POST['expyear']*12+$_POST['expmonth'];
            $currentsalary=$_POST['salinlakh']+$_POST['salinth']; 
           
            $salinlakh= $_POST['salinlakh'];
            $salinth= $_POST['salinth'];
            $address= mysql_real_escape_string($_POST['address']);
            
            $keyskills= $_POST['keyskills'];
            
            $resume_headline=$_POST['resume_headline'];
            $pincode=$_POST['pincode'];
            
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['state']."")->row_array();
             $state= $res['name'];
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['area']."")->row_array();
             $area= $res['cityname'];
             
             $location= $_POST['location'];    
             
              $data2=array(  
                        'email'=>mysql_real_escape_string($_POST['email']),
                        'owner_name'=>$name,
			'contact_no'=>$mobileno,
                        'password'=>md5($_POST['password']),
                        'user_type'=>'teacher',
                        'reg_date'=>date("Y-m-d",time()),
                        'verified'=>'y',
                        'status'=>'1'                       
                  );
              
              $query=$this->db->insert('sch_user',$data2);
              $insert_id=$this->db->insert_id();
              
        
	  $data=array(  
                        'user_id'=>$insert_id,
                        'name'=>$name,
			'mobileno'=>$mobileno,
                        'landline'=>$landline,
                        'total_exp_month'=>$totalmonth,
                        'exp_year'=>$exp_year,  
                        'exp_month'=>$exp_month,
                        'currentsalary'=>$currentsalary,
                        'salaryinlac'=>$salinlakh,
                        'salaryinthousand'=>$salinth,
                        'keyskills'=>$keyskills,
                        'teacher_category'=>$_POST['teacher_category'],
                        'address'=>$address,
                        'resume_headline'=>$resume_headline,
                        'pincode'=>$pincode,                        
                        'state_id'=>$_POST['state'],  
                        'state_name'=>$state,  
                        'area_id'=>$_POST['area'],  
                        'area_name'=>$area, 
                        'location'=>$location,
                        'resume'=>$resume                        
		           );
          
          $query=$this->db->insert('sch_teacher_details',$data);
   }
   
   function update_teacher()
	{
	  $resume=$_POST['hidden_resume'];
          if(!empty($_FILES['resume']['name']))
            {
                 $resume=str_replace("'","",$_FILES['resume']['name']);
		 $resume=str_replace("'","",$resume);
		 $resume=str_replace("/","",$resume);
		 $resume=str_replace(" ","",$resume);
		 $resume=str_replace("%","",$resume);
		 
		 $resume=rand()."_".$resume;
		 
         copy($_FILES['resume']['tmp_name'],$this->droot."/public/resume/".$resume);		 
         @unlink($this->droot."/public/resume/".$_POST['hidden_resume']); 
            }
            
            
            
            $name= mysql_real_escape_string($_POST['name']);
            $mobileno= $_POST['mobileno'];
            $landline= $_POST['landline']; 
            $exp_year= $_POST['expyear'];  
            $exp_month = $_POST['expmonth'];  
            
            $totalmonth=$_POST['expyear']*12+$_POST['expmonth'];
            $currentsalary=$_POST['salinlakh']+$_POST['salinth']; 
           
            $salinlakh= $_POST['salinlakh'];
            $salinth= $_POST['salinth'];
            $address= mysql_real_escape_string($_POST['address']);
            
            $keyskills= $_POST['keyskills'];
            
            $resume_headline=$_POST['resume_headline'];
            $pincode=$_POST['pincode'];
            
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['state']."")->row_array();
             $state= $res['name'];
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['area']."")->row_array();
             $area= $res['cityname'];
             
             $location= $_POST['location'];        
        
	  $data=array(  
                        'name'=>$name,
			'mobileno'=>$mobileno,
                        'landline'=>$landline,
                        'total_exp_month'=>$totalmonth,
                        'exp_year'=>$exp_year,  
                        'exp_month'=>$exp_month,
                        'currentsalary'=>$currentsalary,
                        'salaryinlac'=>$salinlakh,
                        'salaryinthousand'=>$salinth,
                        'keyskills'=>$keyskills,
                        'teacher_category'=>$_POST['teacher_category'],
                        'address'=>$address,
                        'resume_headline'=>$resume_headline,
                        'pincode'=>$pincode,                        
                        'state_id'=>$_POST['state'],  
                        'state_name'=>$state,  
                        'area_id'=>$_POST['area'],  
                        'area_name'=>$area, 
                        'location'=>$location,
                        'resume'=>$resume                        
		           );	
				   $this->db->where('id',$_POST['teacher_id']);
				   $query=$this->db->update('sch_teacher_details',$data);
                                   
               if($_POST['password']!='')        
               {
              $data2=array(                          
                        'owner_name'=>$name,
			'contact_no'=>$mobileno,
                        'password'=>md5($_POST['password']),
                  );                     
               }else{
                   $data2=array(                          
                        'owner_name'=>$name,
			'contact_no'=>$mobileno                        
                  );
               }
              
              $this->db->where('id',$_POST['userr_id']);
              $query=$this->db->update('sch_user',$data2);
                    
                                 
	}
        
        /*====================================================================
	 #####################Add Event########################
	 ====================================================================*/
        function add_event()
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
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$thumbimage);
         
            }
            
            $event_title= mysql_real_escape_string($_POST['event_title']);
            $description= $_POST['description'];
            $published_date= $_POST['start_date'];            
        
	   $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'event_title'=>$event_title,
			'description'=>$description,
                        'image'=>$thumbimage,
                        'published_date'=>$published_date,
                        'expiry_date'=>$_POST['end_date']
		           );
          
				$query=$this->db->insert('sch_school_event',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_event()
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
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$thumbimage);
         @unlink($this->droot."/public/eventimage/".$_POST['hidden_image']); 
            }else{$thumbimage=$_POST['hidden_image'];}
            
            $event_title= mysql_real_escape_string($_POST['event_title']);
            $description= $_POST['description'];
            $published_date= $_POST['start_date'];            
        
	  $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'event_title'=>$event_title,
			'description'=>$description,
                        'image'=>$thumbimage,
                        'published_date'=>$published_date,
                        'expiry_date'=>$_POST['end_date']
		           );	
				   $this->db->where('id',$_POST['event_id']);
				   $query=$this->db->update('sch_school_event',$data);
                    
                                 
	}
        
        /*====================================================================
	 #####################Add Event########################
	 ====================================================================*/
        function add_gallery()
        {
            
            if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/schoolimage/".$image);
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);            
            $ord=$_POST['ord'];
        
	  $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'image_title'=>$image_title,
			'image'=>$image,
                        'ord'=>$ord
		           );	          
				$query=$this->db->insert('sch_school_image',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_gallery()
	{
            $image=$_POST['hidden_image'];
	    if(!empty($_FILES['image']['name']))
            {
                unlink($this->droot."/public/schoolimage/".$_POST['hidden_image']);               
                
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);
		 
		 $image=rand()."_".$image;
		 
            copy($_FILES['image']['tmp_name'],$this->droot."/public/schoolimage/".$image);
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);            
            $ord=$_POST['ord'];
        
	  $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'image_title'=>$image_title,
			'image'=>$image,
                        'ord'=>$ord
		           );
				   $this->db->where('id',$_POST['image_id']);
				   $query=$this->db->update('sch_school_image',$data);
                    
                                 
	}
        
        //Job ADD Update function
        function add_job()
        {  
		$data=array(
                            'school_id'=>$_POST['school_id'],
                            'job_title'=>mysql_real_escape_string($_POST['job_title']),
                            'ref_code'=>mysql_real_escape_string($_POST['reference_code']), 
                            'job_type'=>$_POST['job_type'],
                            'nov'=>$_POST['nov'],
                            'ug'=>$_POST['ug-qualifications'], 
                            'pg'=>$_POST['pg-qualifications'], 
                            'doct'=>$_POST['doctorate'], 
                            'other_qualification'=>$_POST['other_qualification'], 
                            'job_summary_description'=>$_POST['job_summary_description'], 
                            'job_detail'=>$_POST['job_detail'],
                            'skills'=>mysql_real_escape_string($_POST['skills']),
                            'role'=>mysql_real_escape_string($_POST['role']),
                            'minexpyear'=>$_POST['minimum-experience'],
                            'maxexpyear'=>$_POST['maximum-experience'],
                            'min_exp_month'=>$_POST['minimum-experience']*12,
                            'max_exp_month'=>$_POST['maximum-experience']*12,
                            'min_salary'=>$_POST['minimum_salary'],
                            'max_salary'=>$_POST['maximum_salary'],
                            'job_location'=>$_POST['job_location'],
                            'entry_date'=>date("Y-m-d",time())
                               );
             
		$this->db->insert('sch_school_job',$data);	 
					 
        }
        
        function update_job()
        {  
		$data=array(
                            'school_id'=>$_POST['school_id'],
                            'job_title'=>mysql_real_escape_string($_POST['job_title']),
                            'ref_code'=>mysql_real_escape_string($_POST['reference_code']), 
                            'job_type'=>$_POST['job_type'],
                            'nov'=>$_POST['nov'],
                            'ug'=>$_POST['ug-qualifications'], 
                            'pg'=>$_POST['pg-qualifications'], 
                            'doct'=>$_POST['doctorate'], 
                            'other_qualification'=>$_POST['other_qualification'], 
                            'job_summary_description'=>$_POST['job_summary_description'], 
                            'job_detail'=>$_POST['job_detail'],
                            'skills'=>$_POST['skills'],
                            'role'=>$_POST['role'],
                            'minexpyear'=>$_POST['minimum-experience'],
                            'maxexpyear'=>$_POST['maximum-experience'],
                            'min_exp_month'=>$_POST['minimum-experience']*12,
                            'max_exp_month'=>$_POST['maximum-experience']*12,
                            'min_salary'=>$_POST['minimum_salary'],
                            'max_salary'=>$_POST['maximum_salary'],
                            'job_location'=>$_POST['job_location']                            
                               );             
		$this->db->where('id',$_POST['job_id']);
                $this->db->update('sch_school_job',$data);	 
					 
        }
}
	