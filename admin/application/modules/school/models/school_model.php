<?php 
class School_model extends CI_Model 
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
	 $res=$this->db->query("select * from sch_zone where zone_cityid=".$state_id." and status=1");
	 return $res->result_array();
	}
        function location_by_area($area_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_locationid=".$area_id." and status=1 order by location asc");
	 return $res->result_array();
	}
                
        
	function recordById($uid)
	{
	 $res=$this->db->query("select * from sch_school where id=$uid");
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
	 
        ///############Notice Board###########
         function add_noticeboard()
        {            
            $title= mysql_real_escape_string($_POST['title']);
            $description= $_POST['description'];            
        
	   $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'title'=>$title,
			'content'=>$description
                        );
          
				$query=$this->db->insert('sch_school_noticeboard',$data);
        }
        
        function update_noticeboard()
        {            
            $title= mysql_real_escape_string($_POST['title']);
            $description= $_POST['description'];            
        
	   $data=array( 
                        'title'=>$title,
			'content'=>$description
                        );
           
                        $this->db->where('id',$_POST['noticeboard_id']);
	                $query=$this->db->update('sch_school_noticeboard',$data);
          
				
        }
	 



     /*==========================================================
       ##########################add management#######################
         * ==========================================================*/
       
        function add_management()
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
            $management_name= mysql_real_escape_string($_POST['management_name']); 
            $managemenat_designation= mysql_real_escape_string($_POST['managemenat_designation']);
            $ord=$_POST['ord'];
        
		  
				   if($image!="")
				   {
					   $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'management_name'=>$management_name,
                        'managemenat_designation'=>$managemenat_designation,
			'management_photo'=>$image,
                        'sortorder'=>$ord
		           );	
				   }else{
					   
					     $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'management_name'=>$management_name,
                        'managemenat_designation'=>$managemenat_designation,
	
                        'sortorder'=>$ord
		           );
					   }
				$query=$this->db->insert('sch_school_managment',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_management()
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
            $management_name= mysql_real_escape_string($_POST['management_name']);            
            $managemenat_designation=$_POST['managemenat_designation'];
        
	  $data=array(  
                        'school_id'=>$_POST['school_id'],
                        'management_name'=>$management_name,
			'management_photo'=>$image,
                        'managemenat_designation'=>$managemenat_designation
		           );
				   $this->db->where('id',$_POST['image_id']);
				   $query=$this->db->update('sch_school_managment',$data);
                    
                                 
	}
       
	   
	/*====================================================================
	 #####################Add school########################
	 ====================================================================*/
	function add_school()
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
         copy($_FILES['image']['tmp_name'],$this->droot."/public/schoolimage/".$image);
            }
            $thumbimage="";
            if(!empty($_FILES['thumbnail']['name']))
            {
                 $thumbimage=str_replace("'","",$_FILES['thumbnail']['name']);
		 $thumbimage=str_replace("'","",$thumbimage);
		 $thumbimage=str_replace("/","",$thumbimage);
		 $thumbimage=str_replace(" ","",$thumbimage);
		 $thumbimage=str_replace("%","",$thumbimage);
		 
		 $thumbimage=rand()."_".$thumbimage;		 
         copy($_FILES['thumbnail']['tmp_name'],$this->droot."/public/schoolimage/".$thumbimage);		 
         
            }
        
            $school_name= mysql_real_escape_string($_POST['school_name']);
            $contact= $_POST['contact_no'];
            $phone= $_POST['phone'];            
            $email= $_POST['email'];  
            $address= mysql_real_escape_string($_POST['address']);
            $pincode= $_POST['pincode'];  
            //$short_description= mysql_real_escape_string($_POST['short_description']);
            
            
            $description= $_POST['description_test'];
           // $chairman= $_POST['chairman_test'];
            $admission_detail= $_POST['admission_detail_test'];           
            $curriculum= $_POST['curriculum_test'];
            $facility= $_POST['facility_test'];
            $website=$_POST['website'];
            
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['state']."")->row_array();
             $state= $res['name'];
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['area']."")->row_array();
             $area= $res['cityname'];
             
             $location= $_POST['location'];

           $newly_open="n";
           if(isset($_POST['newly_open']))
           {
               $newly_open='y';
           } 
           
           $featured=0;
           
           $admission_open=0;
           if(isset($_POST['admission_open']))
           {
               $admission_open=1;
           }
                                 
            
           if($_POST['established_date']!='')
           {
            $arr2=explode("-",$_POST['established_date']);
            $extablish_date=$arr2[2]."-".$arr2[1]."-".$arr2[0];
           }else{$extablish_date='0000-00-00';}
            
           
           $data=array(
                       'email'=>$_POST['email'], 
                       'owner_name'=>mysql_real_escape_string($_POST['owner_name']),                         
                        'contact_no'=>mysql_real_escape_string($_POST['contact_no']), 
                        'co_name'=>mysql_real_escape_string($_POST['co_name']), 
                        'co_email'=>mysql_real_escape_string($_POST['co_email']), 
                        'co_contactno'=>$_POST['co_contactno'],
                        'password'=>md5($_POST['password']),
                        'user_type'=>'school',
                        'reg_date'=>date("Y-m-d",time()),
                        'verified'=>'y',
                        'status'=>'1',
                        'Ispaid'=>$_POST['ispaid']    
                       );
                       $query=$this->db->insert('sch_user',$data);    
                       $insert_id= $this->db->insert_id();
          
             //$seo_url= str_replace(' ', '-', trim($_POST['school_name'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($_POST['seo_url']));
        
	  $data=array(  'user_id'=>$insert_id, 
                        'registrationno'=>mysql_real_escape_string($_POST['registrationno']),
                        'seo_url'=>$seo_url, 
                        'admission_open'=>$admission_open, 
                        'school_name'=>$school_name,
                        'board'=>$_POST['board'],
                        'category'=>$_POST['category'],
                        'sub_category'=>$_POST['sub_category'],              
			'contact'=>$contact,
                        'phone'=>$phone,    
                        'email'=>$email,  
                        'address'=>$address,
                        'pincode'=>$pincode, 
              
                        'receptionist_mobile'=>$_POST['receptionist_mobile'],
                        'receptionist_landline'=>$_POST['receptionist_landline'],
                        'director_mobile'=>$_POST['director_mobile'],
                        'director_landline'=>$_POST['director_landline'],
                        'facebookurl'=>$_POST['facebookurl'],
                        'twitterurl'=>$_POST['twitterurl'],
                        'googleplusurl'=>$_POST['googleplusurl'],
              
                        'description'=>$description,              
              'admission_detail'=>$admission_detail,              
              'curriculum'=>$curriculum,
              'facility'=>$facility,
                        'website'=>$website,
                        'state_id'=>$_POST['state'],  
                        'state_name'=>$state,  
                        'area_id'=>$_POST['area'],  
                        'area_name'=>$area, 
                        'location'=>$location,
                        'latitude'=>$_POST['latitude'], 
                        'langitude'=>$_POST['langitude'],
                        'image'=>$image,
                        'thumbnail'=>$thumbimage,
                        'reg_date'=>date("Y-m-d",time()),
                        'established_date'=>$extablish_date, 
                        'featured'=>$featured,
                        'newly_open'=>$newly_open,                         
                        'Ispaid'=>$_POST['ispaid']
		           );	
          
				$query=$this->db->insert('sch_school',$data);
                                
                                $school_insertid=$this->db->insert_id();
                      //#############Payment module
           if($_POST['ispaid']=='y')    
           {
               
             if($_POST['duration']=='3month')
            {
                $mth=3;
            }
            if($_POST['duration']=='6month')
            {
                $mth=6;
            }
            if($_POST['duration']=='1year')
            {
                $mth=12;
            }
            if($_POST['duration']=='2year')
            {
                $mth=24;
            }
            
            $expdate=strtotime($_POST['start_date']."+$mth month");
            $expdate=date("Y-m-d",$expdate);
            
            $arr=explode("/",$_POST['start_date']);
            $stdate=$arr[2]."-".$arr[0]."-".$arr[1];
            
            //echo $stdate.$expdate;die;
            
            $data=array(
                        'school_id'=>$school_insertid, 
                        'amount'=>$_POST['amount'], 
                        'start_date'=>$stdate, 
                        'expiry_date'=>$expdate, 
                        'duration'=>$_POST['duration'],      
                                       );
            
                                   $query=$this->db->insert('sch_payment_inventory',$data); 
              
              $data2=array(
                        'expirydate'=>$expdate,
                        'status'=>1
                         );   
              
              $this->db->where('id',$school_insertid);
              $query=$this->db->update('sch_school',$data2);
           }
                                
                                   
	  
	}
	/*====================================================================
	 #####################Update User########################
	 ====================================================================*/

   function update_school()
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
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/schoolimage/".$image);		 
         @unlink($this->droot."/public/schoolimage/".$_POST['hidden_image']); 
            }else{$image=$_POST['hidden_image'];}
            
            $thumbimage="";
            if(!empty($_FILES['thumbnail']['name']))
            {
                 $thumbimage=str_replace("'","",$_FILES['thumbnail']['name']);
		 $thumbimage=str_replace("'","",$thumbimage);
		 $thumbimage=str_replace("/","",$thumbimage);
		 $thumbimage=str_replace(" ","",$thumbimage);
		 $thumbimage=str_replace("%","",$thumbimage);
		 
		 $thumbimage=rand()."_".$thumbimage;
		 
         copy($_FILES['thumbnail']['tmp_name'],$this->droot."/public/schoolimage/".$thumbimage);
            }else{$thumbimage=$_POST['thumbhidden_image'];}
       
            $school_name= mysql_real_escape_string($_POST['school_name']);
            $contact= $_POST['contact_no'];
            $phone= $_POST['phone']; 
            $email= $_POST['email'];            
            $address= mysql_real_escape_string($_POST['address']);
            $pincode= $_POST['pincode'];  
            //$short_description= mysql_real_escape_string($_POST['short_description']);
             $description= $_POST['description_test'];
            //$chairman= $_POST['chairman_test'];
            $admission_detail= $_POST['admission_detail_test'];           
            $curriculum= $_POST['curriculum_test'];
            $facility= $_POST['facility_test'];
            $website=$_POST['website'];
            
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['state']."")->row_array();
             $state= $res['name'];
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['area']."")->row_array();
             $area= $res['cityname'];
             
             $location= $_POST['location'];
           
           $newly_open="n";
           if(isset($_POST['newly_open']))
           {
               $newly_open='y';
           } 
           $featured=0;
           
           $admission_open=0;
           if(isset($_POST['admission_open']))
           {
               $admission_open=1;
           }
           
           if($_POST['expirydate']!='')
           {
            $arr=explode("-",$_POST['expirydate']);
            $expirydate=$arr[2]."-".$arr[1]."-".$arr[0];
           }else{$expirydate=date("Y-m-d",time());}
            
           if($_POST['established_date']!='')
           {
            $arr2=explode("-",$_POST['established_date']);
            $extablish_date=$arr2[2]."-".$arr2[1]."-".$arr2[0];
           }else{$extablish_date='0000-00-00';}
           
           
             //$seo_url= str_replace(' ', '-', trim($_POST['school_name'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($_POST['seo_url']));
        
        
	  $data=array(  
                        'seo_url'=>$seo_url, 
                        'registrationno'=>mysql_real_escape_string($_POST['registrationno']),
                        'admission_open'=>$admission_open, 
                        'school_name'=>$school_name,
                        'board'=>$_POST['board'],
                        'category'=>$_POST['category'],
                        'sub_category'=>$_POST['sub_category'],              
			'contact'=>$contact,
                        'phone'=>$phone,    
                        'email'=>$email,  
                        'address'=>$address,
                        'pincode'=>$pincode,  
                        'receptionist_mobile'=>$_POST['receptionist_mobile'],
                        'receptionist_landline'=>$_POST['receptionist_landline'],
                        'director_mobile'=>$_POST['director_mobile'],
                        'director_landline'=>$_POST['director_landline'],
                        'facebookurl'=>$_POST['facebookurl'],
                        'twitterurl'=>$_POST['twitterurl'],
                        'googleplusurl'=>$_POST['googleplusurl'],
              
                        'description'=>$description,             
              'admission_detail'=>$admission_detail,              
              'curriculum'=>$curriculum,
              'facility'=>$facility,
                        'website'=>$website,
                        'state_id'=>$_POST['state'],  
                        'state_name'=>$state,  
                        'area_id'=>$_POST['area'],  
                        'area_name'=>$area, 
                        'location'=>$location,
                        'latitude'=>$_POST['latitude'], 
                        'langitude'=>$_POST['langitude'],
                        'image'=>$image,
                        'thumbnail'=>$thumbimage,
                        'established_date'=>$extablish_date, 
                        'featured'=>$featured,
                        'newly_open'=>$newly_open,
                        'Ispaid'=>$_POST['ispaid'],
                        'expirydate'=>$expirydate                        
		           );	
				   $this->db->where('id',$_POST['school_id']);
				   $query=$this->db->update('sch_school',$data);
                    
                        //User Table update
                      if($_POST['password']!='') 
                      {
                        $data=array(  
                         'email'=>$_POST['email'],   
                         'owner_name'=>mysql_real_escape_string($_POST['owner_name']),                           
                        'contact_no'=>$_POST['contact_no'], 
                        'password'=>md5($_POST['password']),      
                        'co_name'=>mysql_real_escape_string($_POST['co_name']), 
                        'co_email'=>mysql_real_escape_string($_POST['co_email']), 
                        'co_contactno'=>$_POST['co_contactno']                       
                                       );
                      }else{
                          $data=array( 
                        'email'=>$_POST['email'],      
                        'owner_name'=>mysql_real_escape_string($_POST['owner_name']),
                        'contact_no'=>$_POST['contact_no'],                         
                        'co_name'=>mysql_real_escape_string($_POST['co_name']), 
                        'co_email'=>mysql_real_escape_string($_POST['co_email']), 
                        'co_contactno'=>$_POST['co_contactno']                       
                                       );
                      }
                                   $this->db->where('id',$_POST['schooluser_id']);
				   $query=$this->db->update('sch_user',$data);
                                 
	}
        
        function update_payment()
        {
            if($_POST['duration']=='3month')
            {
                $mth=3;
            }
            if($_POST['duration']=='6month')
            {
                $mth=6;
            }
            if($_POST['duration']=='1year')
            {
                $mth=12;
            }
            if($_POST['duration']=='2year')
            {
                $mth=24;
            }
            
            $expdate=strtotime($_POST['start_date']."+$mth month");
            $expdate=date("Y-m-d",$expdate);
            
            $arr=explode("/",$_POST['start_date']);
            $stdate=$arr[2]."-".$arr[0]."-".$arr[1];
            
            //echo $stdate.$expdate;die;
            
            $data=array(
                        'school_id'=>$_POST['school_id'], 
                        'amount'=>$_POST['amount'], 
                        'start_date'=>$stdate, 
                        'expiry_date'=>$expdate, 
                        'duration'=>$_POST['duration'],      
                                       );
            
                                   $query=$this->db->insert('sch_payment_inventory',$data);
                                   
            $data2=array(
                        'Ispaid'=>"y",  
                        'expirydate'=>$expdate,
                        'status'=>1  
                                       );             
            
                                   $this->db->where('id',$_POST['school_id']);
				   $query=$this->db->update('sch_school',$data2);
            $data3=array(
                        'Ispaid'=>"y",
                        'status'=>1  
                                       );             
            
                                   $this->db->where('id',$_POST['schooluser_id']);
				   $query=$this->db->update('sch_user',$data3);                       
            
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
	