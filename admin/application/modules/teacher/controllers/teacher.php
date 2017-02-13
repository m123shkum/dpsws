<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Teacher extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
                   
		   $this->load->model('Teacher_model');
		   $this->load->library('pagination');		   
                  //$this->load->helper('language');
                  $this->load->helper(array('ckeditor','language'));
                  $this->lang->load('form_validation','english');
                 $this->droot=DocumentRoot;  
                 // $this->load->driver('cache');
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
   public function index($sort_by='name',$perpage=0,$offset=0)
   {// $this->cache->clean();
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
            $uid=$this->session->userdata('userid');
					
					if($perpage!=0)
					{
						$perpage=$perpage;
						$data['perpage']=$perpage;
					}
					else
					{
						$perpage=20;
						$data['perpage']='';
					}
					if($sort_by=='date-asc')
					{
                                            
						$order='order by user.reg_date asc';
                                                //echo $order; die;
					}
					else if($sort_by=='date-desc')
					{
						$order='order by user.reg_date desc';
					}
					else
					{
						$order='order by stch.id desc';
					}
                                       
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select stch.user_id,stch.id as teacher_id,stch.name,stch.keyskills,stch.resume,user.email,user.status,user.reg_date,user.verified from sch_teacher_details AS stch JOIN sch_user AS user ON stch.user_id=user.id")->num_rows();
					
					$config['base_url'] = base_url()."teacher/index/$sort_by/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=5;			
					//===============================
					$config['full_tag_open'] = '<ul class="pagination">';
					$config['full_tag_close'] = '</ul>';
					$config['first_link'] = false;
					$config['last_link'] = false;
					$config['first_tag_open'] = '<li>';
					$config['first_tag_close'] = '</li>';
					$config['prev_link'] = '<<';
					$config['prev_tag_open'] = '<li class="prev">';
					$config['prev_tag_close'] = '</li>';
					$config['next_link'] = '>>';
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '</li>';
					$config['last_tag_open'] = '<li>';
					$config['last_tag_close'] = '</li>';
					$config['cur_tag_open'] =  '<li class="active"><a href="#">';
					$config['cur_tag_close'] = '</a></li>';
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
					//===============================
				   $this->pagination->initialize($config);	
				   $limit=$perpage;
				   $data['links']=$this->pagination->create_links();  
                                   $data['startlimit']=$offset;
                                 
				   $data['results']=$this->db->query("select stch.user_id,stch.id as teacher_id,stch.name,stch.keyskills,stch.resume,user.email,user.status,user.reg_date,user.verified from sch_teacher_details AS stch JOIN sch_user AS user ON stch.user_id=user.id $order limit $offset,$limit")->result_array();
				   $this->load->view('teacher_home',$data);
			
			
			
		}
   }
   	/*====================================================================
	 #############################Serach##################################
	 ====================================================================*/
    public function search()
   { 
        
        if(isset($_GET['per_page']))
		{
			$offset=$_GET['per_page'];
			if($offset=='')
			{
				$offset=0;
			}
			
		}else{$offset=0;}      
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
			 $con2="";		
                    if($_GET['are_name']!='')
                    { 
                        $con2="area_name like '%".$_GET['are_name']."%'";
                        
                        $are_name=$_GET['are_name'];            
                        $res=$this->db->query("SELECT * from sch_zone where cityname='".$are_name."'")->row_array();            
                        $areaid=$res['zone_id'];            
                        $data['location_result']=$this->Teacher_model->location_by_area($areaid);
                        
                    }
                    $con3="";
                    if($_GET['location']!='')
                   { 
                     $con3="location like '%".$_GET['location']."%'";
                   }
                   
                   $sqlcon="where 1";
                   
                   if($_GET['keyskills']!='')
                  {
                   //$con2="($con2)";
                   $sqlcon=$sqlcon." and (keyskills like '%".$_GET['keyskills']."%' OR name like '%".$_GET['keyskills']."%' OR email like '%".$_GET['keyskills']."%')";
                  }
                   
                   if($con2!='')
                  {
                   $con2="($con2)";
                   $sqlcon=$sqlcon." and ".$con2;
                  }
      
                  if($con3!='')
                 {
                  $con3="($con3)";
                  $sqlcon=$sqlcon." and ".$con3;
                 }
 			//$data['order']='';
                 if($_GET['perpage']!='')
                 {
                     $perpage=$_GET['perpage'];
                 }else{ $perpage=50;}
                 
                $data['perpage']= $perpage;
                 // $numrosw=$this->db->query("select * from sch_school $sqlcon")->num_rows();   
                        
            $numrosw=$this->db->query("select stch.user_id,stch.id as teacher_id,stch.name,stch.keyskills,stch.area_name,stch.location,stch.resume,user.email,user.status,user.reg_date,user.verified from sch_teacher_details AS stch JOIN sch_user AS user ON stch.user_id=user.id $sqlcon")->num_rows();
            
			$config['base_url'] = base_url()."teacher/search?are_name=".$_GET['are_name']."&location=".$_GET['location']."&keyskills=".$_GET['keyskills']."&perpage=".$_GET['perpage'];             
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			//$config['page_query_string']='FALSE';
			//$config['uri_segment']=4;			
            //===============================
			//===============================
					$config['full_tag_open'] = '<ul class="pagination">';
					$config['full_tag_close'] = '</ul>';
					$config['first_link'] = false;
					$config['last_link'] = false;
					$config['first_tag_open'] = '<li>';
					$config['first_tag_close'] = '</li>';
					$config['prev_link'] = '<<';
					$config['prev_tag_open'] = '<li class="prev">';
					$config['prev_tag_close'] = '</li>';
					$config['next_link'] = '>>';
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '</li>';
					$config['last_tag_open'] = '<li>';
					$config['last_tag_close'] = '</li>';
					$config['cur_tag_open'] =  '<li class="active"><a href="#">';
					$config['cur_tag_close'] = '</a></li>';
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
					//===============================
			//===============================
           $this->pagination->initialize($config);	
	       $limit=$perpage;
	           $data['links']=$this->pagination->create_links();		  
                   $data['startlimit']=$offset;
                   
		   $data['results']=$this->db->query("select stch.user_id,stch.id as teacher_id,stch.name,stch.keyskills,stch.area_name,stch.location,stch.resume,user.email,user.status,user.reg_date,user.verified from sch_teacher_details AS stch JOIN sch_user AS user ON stch.user_id=user.id $sqlcon order by stch.id desc limit $offset,$limit")->result_array();
                
               $data['order']="name";    
	       $this->load->view('teacher_home',$data);
			
		}
   }
   	
   
    public function add()
    {        
        
         $data['states']=$this->Teacher_model->allstates();        
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['teacherRegister'])) { 

                                             $chk=$this->db->query("select * from sch_user where email='".$_POST['email']."'")->num_rows();
                                             if($chk > 0)
						{
                                                 $data['exist_error'] = "This Email-id(".$_POST['email'].") is already exist !";
                                                 
                                                  $this->load->view('teacher_add',$data);
                                                
                                                }else
						{
						  $this->Teacher_model->add_teacher();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> New teacher added successfully..! </div>');
					     redirect('teacher');
						}
					}
					else
					{
					 $this->load->view('teacher_add',$data);
					}
					
			  
			
		
	} 
    
	 /*====================================================================
	 #####################Edit Users########################
	 ====================================================================*/
	 function edit($sid=''){  
             
             $data['states']=$this->Teacher_model->allstates();
             $data['school_users']=$this->Teacher_model->schoolUsers();
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($sid=='')
				{
					redirect('admin');
				}   
				else
				{
	                 $data['results']=$this->Teacher_model->recordById($sid);
                         
                         $result=$this->Teacher_model->recordById($sid);               
                         $data['user_result']=$this->db->query("SELECT * from sch_user where id=".$result['user_id']."")->row_array();
                         
                         $data['area_result']=$this->Teacher_model->area_by_state($result['state_id']);
                         $data['location_result']=$this->Teacher_model->location_by_area($result['area_id']);
		         
                         $this->load->view('teacher_edit',$data);
				}
		}
	 }
         
         

	/*====================================================================
	 #####################Update Users#####################
	 ====================================================================*/
	  public function  update()
          { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['teacherUpdate'])) 
                        {                       
				 $this->Teacher_model->update_teacher();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('teacher');
                                               
                        }                        
				
			
      }
     
      
      
       function education($teacher_id,$perpage=0,$offset=0)
        {
            if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
            $uid=$this->session->userdata('userid');
					
					if($perpage!=0)
					{
						$perpage=$perpage;
						$data['perpage']=$perpage;
					}
					else
					{
						$perpage=10;
						$data['perpage']='';
					}
					
					$order="order by id";
					$numrosw=$this->db->query("select * from sch_teacher_eduinfo where user_id=$teacher_id")->num_rows();
					
					$config['base_url'] = base_url()."teacher/education/$teacher_id/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=5;			
					//===============================
					$config['full_tag_open'] = '<ul class="pagination">';
					$config['full_tag_close'] = '</ul>';
					$config['first_link'] = false;
					$config['last_link'] = false;
					$config['first_tag_open'] = '<li>';
					$config['first_tag_close'] = '</li>';
					$config['prev_link'] = '<<';
					$config['prev_tag_open'] = '<li class="prev">';
					$config['prev_tag_close'] = '</li>';
					$config['next_link'] = '>>';
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '</li>';
					$config['last_tag_open'] = '<li>';
					$config['last_tag_close'] = '</li>';
					$config['cur_tag_open'] =  '<li class="active"><a href="#">';
					$config['cur_tag_close'] = '</a></li>';
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
					//===============================
				   $this->pagination->initialize($config);	
				   $limit=$perpage;
				   $data['links']=$this->pagination->create_links();
				   $data['results']=$this->db->query("select * from sch_teacher_eduinfo where user_id=$teacher_id $order limit $offset,$limit")->result_array();
				   $data['teacher_id']=$teacher_id; 
                                   $data['row']=$this->Teacher_model->oneRecordById($teacher_id,"sch_teacher_details");
                                   $this->load->view('education_home',$data);
			
			
			
		}
        }
        
        
    
    public function addeducation($teacher_id)
    {   	
        $data['qualifications']=$this->Teacher_model->qualification();  
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['educationForm'])) {                                           						
						
					      $this->Teacher_model->add_education();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Education has been added successfully..! </div>');
					     redirect('teacher/education/'.$teacher_id);
					}
					else
					{                                            
                                         $data['teacher_id']=$teacher_id;   
					 $this->load->view('education_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Event########################
	 ====================================================================*/
	public function editeducation($teacher_id='',$edu_id)
        {              
          $data['qualifications']=$this->Teacher_model->qualification(); 
          
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($teacher_id=='' || $edu_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Teacher_model->oneRecordById($edu_id,"sch_teacher_eduinfo");
                         $data['teacher_id']=$teacher_id;
                         $this->load->view('education_edit',$data);
				}
		}
	 }
         
          public function  updateeducation() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['educationForm'])) 
                        {                       
				 $this->Teacher_model->update_education();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('teacher/education/'.$_POST['teacher_id']);
                                               
                        }                        
				
			
   }
         
         
         function deleteeducation() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_teacher_eduinfo where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('teacher/education/'.$_POST['teacher_id']);
		  }
		  
	}
      
      
     
	
      
      
        function profession($teacher_id,$perpage=0,$offset=0)
        {
            if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
            $uid=$this->session->userdata('userid');
					
					if($perpage!=0)
					{
						$perpage=$perpage;
						$data['perpage']=$perpage;
					}
					else
					{
						$perpage=10;
						$data['perpage']='';
					}
					
					$order="order by id";
					$numrosw=$this->db->query("select * from sch_professional_experience where user_id=$teacher_id")->num_rows();
					
					$config['base_url'] = base_url()."teacher/profession/$teacher_id/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=5;			
					//===============================
					$config['full_tag_open'] = '<ul class="pagination">';
					$config['full_tag_close'] = '</ul>';
					$config['first_link'] = false;
					$config['last_link'] = false;
					$config['first_tag_open'] = '<li>';
					$config['first_tag_close'] = '</li>';
					$config['prev_link'] = '<<';
					$config['prev_tag_open'] = '<li class="prev">';
					$config['prev_tag_close'] = '</li>';
					$config['next_link'] = '>>';
					$config['next_tag_open'] = '<li>';
					$config['next_tag_close'] = '</li>';
					$config['last_tag_open'] = '<li>';
					$config['last_tag_close'] = '</li>';
					$config['cur_tag_open'] =  '<li class="active"><a href="#">';
					$config['cur_tag_close'] = '</a></li>';
					$config['num_tag_open'] = '<li>';
					$config['num_tag_close'] = '</li>';
					//===============================
				   $this->pagination->initialize($config);	
				   $limit=$perpage;
				   $data['links']=$this->pagination->create_links();
				   $data['results']=$this->db->query("select * from sch_professional_experience where user_id=$teacher_id $order limit $offset,$limit")->result_array();
				   $data['teacher_id']=$teacher_id; 
                                   $data['row']=$this->Teacher_model->oneRecordById($teacher_id,"sch_teacher_details");
                                   $this->load->view('profession_home',$data);
			
			
			
		}
        }
        
        
    
    public function addprofession($teacher_id)
    {   	
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['professionForm'])) {                                           						
						
					      $this->Teacher_model->add_profession();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Profession has been added successfully..! </div>');
					     redirect('teacher/profession/'.$teacher_id);
					}
					else
					{                                            
                                         $data['teacher_id']=$teacher_id;   
					 $this->load->view('profession_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Event########################
	 ====================================================================*/
	public function editprofession($teacher_id='',$profes_id){              
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($teacher_id=='' || $profes_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Teacher_model->oneRecordById($profes_id,"sch_professional_experience");
                         $data['teacher_id']=$teacher_id;
                         $this->load->view('profession_edit',$data);
				}
		}
	 }
         
          public function  updateprofession() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['professionForm'])) 
                        {                       
				 $this->Teacher_model->update_profession();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('teacher/profession/'.$_POST['teacher_id']);
                                               
                        }                        
				
			
   }
         
         
         function deleteprofession() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_professional_experience where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('teacher/profession/'.$_POST['teacher_id']);
		  }
		  
	}
       
        
        function getarea($state_id)
        {            
            $data['area_result']=$this->Teacher_model->area_by_state($state_id);           
            $this->load->view('getarea',$data);
        }
        
        function getlocation($areaid)
        {            
            
            $data['location_result']=$this->Teacher_model->location_by_area($areaid);           
            $this->load->view('getlocation',$data);
        }
        
        function getsearchlocation()
        {            
            $are_name=$_GET['are_name'];
            
            $res=$this->db->query("SELECT * from sch_zone where cityname='".$are_name."'")->row_array();
            
            $areaid=$res['zone_id'];
            
            $data['location_result']=$this->School_model->location_by_area($areaid);           
            $this->load->view('getsearchlocation',$data);
        }
        
        function getmaxexp()
       {
           //echo $_GET['minid'];die;
           $this->load->view('getmaxexp');
       }
       
       
       function delete() {
		  if(isset($_POST['delid']))
		  {
                      $res=$this->db->query("SELECT user_id from sch_teacher_details where id=".$_POST['delid']."")->row_array();
                      
                          $this->db->query("DELETE from sch_user where id=".$res['user_id']."");
                          $this->db->query("DELETE from sch_teacher_eduinfo where user_id=".$res['user_id']."");
                          $this->db->query("DELETE from sch_professional_experience where user_id=".$res['user_id']."");
                          
			  $this->db->query("DELETE from sch_teacher_details where id=".$_POST['delid']."");                         
                          
                          
                          
                          
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('teacher');
		  }
		  
	}
        function changeStatus() 
        {
		  if(isset($_POST['uid']))
		  {
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		                     );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_user',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('teacher');
		  }
		  
		  
	}
   
}
 