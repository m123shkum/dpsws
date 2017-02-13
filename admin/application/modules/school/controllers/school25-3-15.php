<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class School extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
                   
		   $this->load->model('School_model');
		   $this->load->library('pagination');		   
                  //$this->load->helper('language');
                  $this->load->helper(array('ckeditor','language'));
                  $this->lang->load('form_validation','english');
                  $this->droot=$_SERVER['DOCUMENT_ROOT'];  
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
						$perpage=50;
						$data['perpage']=$perpage;
					}
					if($sort_by=='name-asc')
					{
						$order='order by school_name asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by school_name desc';
					}
					else
					{
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_school")->num_rows();
					
					$config['base_url'] = base_url()."school/index/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_school $order limit $offset,$limit")->result_array();
				   $this->load->view('school_home',$data);
			
			
			
		}
   }
   	/*====================================================================
	 #############################Serach##################################
	 ====================================================================*/
    public function search($search_text='',$perpage=0,$offset=0)
   { 
        $arr=explode("_",$search_text);
        $search_text=$arr[0];
       $paidby="";
        if($arr[1]!='0')
        {
            $paidby=" and Ispaid='".$arr[1]."'";
        }
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
			if($perpage!=0)
            {
				$perpage=$perpage;
				$data['perpage']=$perpage;
			}
			else
			{
				$perpage=50;
				$data['perpage']='';
			}
 			$data['order']='';
                        //if($_REQUEST[''])
            $numrosw=$this->db->query("select * from sch_school where (school_name like '%".$search_text."%' or area_name like '%".$search_text."%' or location like '%".$search_text."%' or address like '%".$search_text."%')$paidby")->num_rows();
            
			$config['base_url'] = base_url()."school/index/$search_text";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=4;			
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
		   $search_text=str_replace('-',' ',$search_text);
		    $search_text=str_replace('~','@',$search_text);
		   $data['search_text']=$search_text;
                   $data['paidby']=$arr[1];
                   $data['startlimit']=$offset;
                  
		   $data['results']=$this->db->query("select * from sch_school where (school_name like '%".$search_text."%' or area_name like '%".$search_text."%' or location like '%".$search_text."%' or address like '%".$search_text."%')$paidby order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('school_home',$data);
			
		}
   }
   	/*====================================================================
	 #####################Add Users########################
	 ====================================================================*/
    public function add()
    {        
        $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);	
		//
        $data['ckeditor_3'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'chairman',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"500px",	//Setting a custom width
				'height' 	=> 	'150px',	//Setting a custom height				
			)
 
			
		);
             
             $data['ckeditor_4'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'noticeboard',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);
             
             $data['ckeditor_5'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'admission_detail',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);
             
             $data['ckeditor_6'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'curriculum',
			'path'	=>	'public/js/ckeditor',		
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
 
			
		);
             
             $data['ckeditor_7'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'facility',
			'path'	=>	'public/js/ckeditor',		
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
 
			
		);
		//
        
         $data['states']=$this->School_model->allstates();
         $data['school_users']=$this->School_model->schoolUsers();
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['schoolRegister'])) { 
                                            
                                            /*$registrationno=$_POST['registrationno'];
                           $num=$this->db->query("SELECT * from sch_school where registrationno='".$_POST['registrationno']."'")->num_rows();         
                        if($num>0)
                       {
                         echo "exist";return false;
                       }*/
                                            $seourl=$_POST['seo_url'];
                            $chk=$this->db->query("SELECT * from sch_school where seo_url ='".$seourl."'")->num_rows(); 
                                                 if($chk > 0)
						{
                                                 echo "seoexist";return false;                                                
                                                }
                                                
                                             $chk=$this->db->query("select * from sch_user where email='".$_POST['email']."'")->num_rows();
                            
                            
                                             if($chk > 0)
						{
                                                 echo "exist_email";return false;
                                                
                                                }else
						{
						  $this->School_model->add_school();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> New School added successfully..! </div>');
					     //redirect('school');
						}
					}
					else
					{
					 $this->load->view('school_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Users########################
	 ====================================================================*/
	 function edit($sid=''){  
             $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',		
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
 
			
		);	
             
             $data['ckeditor_6'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'curriculum',
			'path'	=>	'public/js/ckeditor',		
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
 
			
		);	
		//
             $data['ckeditor_3'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'chairman',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
 
			
		);
             
             $data['ckeditor_4'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'noticeboard',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);
             $data['ckeditor_5'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'admission_detail',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);
             
             $data['ckeditor_7'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'facility',
			'path'	=>	'public/js/ckeditor',		
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"820px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
 
			
		);
		//
             
             $data['states']=$this->School_model->allstates();
             $data['school_users']=$this->School_model->schoolUsers();
             
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
	                 $data['results']=$this->School_model->recordById($sid);                         
                         
                         $result=$this->School_model->recordById($sid);    
                         $data['user_results']=$this->db->query("select * from sch_user where id=".$result['user_id']."")->row_array();
                         
                         $data['area_result']=$this->School_model->area_by_state($result['state_id']);
                         $data['location_result']=$this->School_model->location_by_area($result['area_id']);
		         
                         $this->load->view('school_edit',$data);
				}
		}
	 }
         
         function payment($sid)
         {
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
                         $data['payments']=$this->db->query("SELECT * from sch_payment_inventory where school_id=$sid")->result_array();         
	                 $data['results']=$this->School_model->recordById($sid);                    
                         $result=$this->School_model->recordById($sid);                             
                         $this->load->view('school_payment',$data);
				}
		}
             
         }
         
         //########Payment Update########//
         public function  action_payment() 
        { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['paymentUpdate'])) 
                        {                       
				 $this->School_model->update_payment();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Payment has been updated successfully..! </div>');
				  
                                  redirect('school/payment/'.$_POST['school_id']);
                                               
                        }                        
				
			
       }
         

	/*====================================================================
	 #####################Update Users#####################
	 ====================================================================*/
	  public function  update() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['schoolUpdate'])) 
                        {     
                            
                            $seourl=$_POST['seo_url'];
                            $num=$this->db->query("SELECT * from sch_school where seo_url ='".$seourl."' and id!=".$_POST['school_id']."")->num_rows(); 
                           /*$registrationno=$_POST['registrationno'];
                           $num=$this->db->query("SELECT * from sch_school where registrationno='".$_POST['registrationno']."' and id!=".$_POST['school_id']."")->num_rows();         
                        if($num>0)
                       {
                         echo "exist";return false;
                       }*/
                       if($num>0)
                       {
                         echo "seoexist";return false;
                       }
				 $this->School_model->update_school();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  //redirect('school');
                                               
                        }                        
				
			
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                      $ress=$this->db->query("SELECT * from sch_school where id=".$_POST['delid']."")->row_array();
                      
                      $this->db->query("DELETE from sch_user where id=".$ress['user_id']."");
                      
                      
			  $this->db->query("DELETE from sch_school where id=".$_POST['delid']."");
                          $this->db->query("DELETE from sch_school_event where school_id=".$_POST['delid']."");
                          $this->db->query("DELETE from sch_school_image where school_id=".$_POST['delid']."");
                          $this->db->query("DELETE from sch_school_job where school_id=".$_POST['delid']."");
                          $this->db->query("DELETE from sch_payment_inventory where school_id=".$_POST['delid']."");
                          
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school');
		  }
		  
	}
        function changeStatus() 
        {
		  if(isset($_POST['uid']))
		  {
                      $ress=$this->db->query("SELECT user_id from sch_school where id=".$_POST['uid']."")->row_array();
                      
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		                      );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_school',$data);
                                   
                          $data2=array(	 
					 'status'=>$_POST['statustype'],
		                      );	
		
				   $this->db->where('id',$ress['user_id']);
				   $query=$this->db->update('sch_user',$data2);          
                                   
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school');
		  }
		  
		  
	}
        
        function changeStatus_gallery() 
        {
		  if(isset($_POST['uid']))
		  {
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		           );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_school_image',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school');
		  }
		  
		  
	}
        
        function changeStatus_event()
        {
            if(isset($_POST['uid']))
		  {
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		           );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_school_event',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school');
		  }
            
        }
        
        function getarea()
        {           
            $state_id=$_GET['state_id'];
            $data['area_result']=$this->School_model->area_by_state($state_id);           
            $this->load->view('getarea',$data);
        }
        
        function getlocation()
        {            
            $areaid=$_GET['areaid'];
            
            $data['location_result']=$this->School_model->location_by_area($areaid);           
            $this->load->view('getlocation',$data);
        }
        // ############### Event And Gallery Function ###############
	
        function event($school_id,$sort_by='name',$perpage=0,$offset=0)
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
					if($sort_by=='name-asc')
					{
						$order='order by event_title asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by event_title desc';
					}
					else
					{
						$order='order by event_title asc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_school_event where school_id=$school_id")->num_rows();
					
					$config['base_url'] = base_url()."school/event/$school_id/$sort_by/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=6;			
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
				   $data['results']=$this->db->query("select * from sch_school_event where school_id=$school_id $order limit $offset,$limit")->result_array();
				   $data['school_id']=$school_id; 
                                   $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                                   $this->load->view('event_home',$data);
			
			
			
		}
        }
        
        
    
    public function addevent($school_id)
    {    
        $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);	
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['eventForm'])) {                                           						
						
					      $this->School_model->add_event();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Event has been added successfully..! </div>');
					     redirect('school/event/'.$school_id);
					}
					else
					{                                            
                                         $data['school_id']=$school_id;   
					 $this->load->view('event_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Event########################
	 ====================================================================*/
	 function editevent($school_id='',$event_id){  
             $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);	
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($school_id=='' || $event_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->School_model->oneRecordById($event_id,"sch_school_event");
                         $data['school_id']=$school_id;
                         $this->load->view('event_edit',$data);
				}
		}
	 }
         
         

	/*====================================================================
	 #####################Update Event#####################
	 ====================================================================*/
	  public function  updateevent() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['editForm'])) 
                        {                       
				 $this->School_model->update_event();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('school/event/'.$_POST['school_id']);
                                               
                        }                        
				
			
   }
   
   public function searchevent($school_id,$search_text='',$perpage=0,$offset=0)
   { 
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
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
 			$data['order']='';
            $numrosw=$this->db->query("select * from sch_school_event where (event_title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."school/searchevent/$school_id/$search_text/$perpage";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=6;			
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
		   $search_text=str_replace('-',' ',$search_text);
		    $search_text=str_replace('~','@',$search_text);
		   $data['search_text']=$search_text;
		   $data['results']=$this->db->query("select * from sch_school_event where (event_title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	          $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                  $data['school_id']=$school_id;  
                  $this->load->view('event_home',$data);
			
		}
   }
   
   
   
   
   
   
      // ############### Jobs Function ###############
	
        function jobs($school_id,$sort_by='name',$perpage=0,$offset=0)
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
					if($sort_by=='name-asc')
					{
						$order='order by event_title asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by event_title desc';
					}
					else
					{
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_school_job where school_id=$school_id")->num_rows();
					
					$config['base_url'] = base_url()."school/jobs/$school_id/$sort_by/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=6;			
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
				   $data['results']=$this->db->query("select * from sch_school_job where school_id=$school_id $order limit $offset,$limit")->result_array();
				   $data['school_id']=$school_id; 
                                   $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                                   $this->load->view('jobs_home',$data);
			
			
			
		}
        }
        
        
    function getmaxexp()
   {
       //echo $_GET['minid'];die;
       $this->load->view('getmaxexp');
   }
   
   function getmaxsal()
   {
       $this->load->view('getmaxsal');
   }
   
    public function addjob($school_id)
    {    
        $data['citys']=$this->School_model->allstates(); 
        
        $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'job_summary_description',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
                            
                               'toolbar' 	=> 	array(	//Setting a custom toolbar
					array('Bold', 'Italic','Underline','Strike',"Unlink","Anchor"),
					array('FontSize','Styles','Link','Format','TextColor','BGColor','Smiley'),					
					'/'
				)
			)
		);	
        $data['ckeditor_3'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'job_detail',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(	
                            'width' 	=> 	"600px",	//Setting a custom width
				'height' 	=> '230px',
                               'toolbar' 	=> 	array(	//Setting a custom toolbar
					array('Bold', 'Italic','Underline','Strike',"Unlink","Anchor"),
					array('FontSize','Styles','Link','Format','TextColor','BGColor','Smiley'),					
					'/'
				)
			)
		);
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['jobForm'])) {                                           						
						
					      $this->School_model->add_job();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Job has been added successfully..! </div>');
					     redirect('school/jobs/'.$school_id);
					}
					else
					{                                            
                                         $data['school_id']=$school_id;   
					 $this->load->view('job_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Event########################
	 ====================================================================*/
	 function editjob($school_id='',$event_id){  
             $data['citys']=$this->School_model->allstates(); 
        
        $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'job_summary_description',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
                            
                               'toolbar' 	=> 	array(	//Setting a custom toolbar
					array('Bold', 'Italic','Underline','Strike',"Unlink","Anchor"),
					array('FontSize','Styles','Link','Format','TextColor','BGColor','Smiley'),					
					'/'
				)
			)
		);	
        $data['ckeditor_3'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'job_detail',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(	
                            'width' 	=> 	"600px",	//Setting a custom width
				'height' 	=> '230px',
                               'toolbar' 	=> 	array(	//Setting a custom toolbar
					array('Bold', 'Italic','Underline','Strike',"Unlink","Anchor"),
					array('FontSize','Styles','Link','Format','TextColor','BGColor','Smiley'),					
					'/'
				)
			)
		);	
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($school_id=='' || $event_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->School_model->oneRecordById($event_id,"sch_school_job");
                         $data['school_id']=$school_id;
                         $this->load->view('job_edit',$data);
				}
		}
	 }
         
         

	/*====================================================================
	 #####################Update Event#####################
	 ====================================================================*/
	  public function  updatejob() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['editForm'])) 
                        {                       
				 $this->School_model->update_job();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('school/jobs/'.$_POST['school_id']);
                                               
                        }                        
				
			
   }
   
   public function searchjobs($school_id,$search_text='',$perpage=0,$offset=0)
   { 
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
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
 			$data['order']='';
            $numrosw=$this->db->query("select * from sch_school_job where (job_title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."school/searchjobs/$school_id/$search_text/$perpage";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=6;			
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
		   $search_text=str_replace('-',' ',$search_text);
		    $search_text=str_replace('~','@',$search_text);
		   $data['search_text']=$search_text;
		   $data['results']=$this->db->query("select * from sch_school_job where (job_title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	          $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                  $data['school_id']=$school_id;  
                  $this->load->view('jobs_home',$data);
			
		}
   }
   
   function deletejob() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_school_job where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school/jobs/'.$_POST['school_id']);
		  }
		  
	}
        
        function changeJobStatus() 
        {
		  if(isset($_POST['uid']))
		  {
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		           );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_school_job',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			   redirect('school/jobs/'.$_POST['school_id']);
		  }
		  
		  
	}

   
   

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function deleteevent() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_school_event where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school/event/'.$_POST['school_id']);
		  }
		  
	}
        
        //Gallery Function
        function gallery($school_id,$sort_by='name',$perpage=0,$offset=0)
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
					if($sort_by=='name-asc')
					{
						$order='order by image_title asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by image_title desc';
					}
					else
					{
						$order='order by image_title asc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_school_image where school_id=$school_id")->num_rows();
					
					$config['base_url'] = base_url()."school/gallery/$school_id/$sort_by/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=6;			
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
				   $data['results']=$this->db->query("select * from sch_school_image where school_id=$school_id $order limit $offset,$limit")->result_array();
				   $data['school_id']=$school_id; 
                                   $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                                   $this->load->view('gallery_home',$data);
			
			
			
		}
        }
        
        
    
    public function addgallery($school_id)
    {    
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['galleryForm'])) {                                           						
						
					      $this->School_model->add_gallery();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Gallery has been added successfully..! </div>');
					     redirect('school/gallery/'.$school_id);
					}
					else
					{                                            
                                         $data['school_id']=$school_id;   
					 $this->load->view('gallery_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Gallery########################
	 ====================================================================*/
	 function editgallery($school_id='',$event_id){                  
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($school_id=='' || $event_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->School_model->oneRecordById($event_id,"sch_school_image");
                         $data['school_id']=$school_id;
                         $this->load->view('gallery_edit',$data);
				}
		}
	 }
         
         

	/*====================================================================
	 #####################Update Event#####################
	 ====================================================================*/
	  public function  updategallery() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['galleryForm'])) 
                        {                       
				 $this->School_model->update_gallery();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('school/gallery/'.$_POST['school_id']);
                                               
                        }                        
				
			
   }
   
   public function searchgallery($school_id,$search_text='',$perpage=0,$offset=0)
   { 
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
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
 			$data['order']='';
            $numrosw=$this->db->query("select * from sch_school_event where (event_title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."school/searchevent/$school_id/$search_text/$perpage";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=6;			
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
		   $search_text=str_replace('-',' ',$search_text);
		    $search_text=str_replace('~','@',$search_text);
		   $data['search_text']=$search_text;
		   $data['results']=$this->db->query("select * from sch_school_event where (event_title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	          $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                  $data['school_id']=$school_id;  
                  $this->load->view('event_home',$data);
			
		}
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function deletegallery() {
		  if(isset($_POST['delid']))
		  {
			$row=$this->School_model->oneRecordById($_POST['delid'],"sch_school_image");
                        unlink($this->droot."/public/schoolimage/".$row['image']);
                        unlink($this->droot."/public/schoolimage/thumb_".$row['image']);
                        
                      $this->db->query("DELETE from sch_school_image where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school/gallery/'.$_POST['school_id']);
		  }
		  
	}
        
        
        //############Notice Board###########
   
    function noticeboard($school_id,$sort_by='name',$perpage=0,$offset=0)
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
					if($sort_by=='name-asc')
					{
						$order='order by title asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by title desc';
					}
					else
					{
						$order='order by title asc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_school_noticeboard where school_id=$school_id")->num_rows();
					
					$config['base_url'] = base_url()."school/noticeboard/$school_id/$sort_by/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=6;			
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
				   $data['results']=$this->db->query("select * from sch_school_noticeboard where school_id=$school_id $order limit $offset,$limit")->result_array();
				   $data['school_id']=$school_id; 
                                   $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                                   $this->load->view('noticeboard_home',$data);
			
			
			
		}
        }
        
    public function addnoticeboard($school_id)
    {    
        $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);	
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['noticeboardForm'])) {                                           						
						
					      $this->School_model->add_noticeboard();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Event has been added successfully..! </div>');
					     redirect('school/noticeboard/'.$school_id);
					}
					else
					{                                            
                                         $data['school_id']=$school_id;   
					 $this->load->view('noticeboard_add',$data);
					}
					
			  
			
		
	}            
	
   public function editnoticeboard($school_id='',$noticeboard_id){  
             $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			)
		);	
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($school_id=='' || $noticeboard_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->School_model->oneRecordById($noticeboard_id,"sch_school_noticeboard");
                         $data['school_id']=$school_id;
                         $this->load->view('noticeboard_edit',$data);
				}
		}
	 }
    public function  updatenoticeboard() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['noticeboardForm'])) 
                        {                       
				 $this->School_model->update_noticeboard();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('school/noticeboard/'.$_POST['school_id']);
                                               
                        }                        
				
			
   }
   
   public function searchnoticeboard($school_id,$search_text='',$perpage=0,$offset=0)
   { 
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
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
 			$data['order']='';
            $numrosw=$this->db->query("select * from sch_school_noticeboard where (title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."school/searchnoticeboard/$school_id/$search_text/$perpage";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=6;			
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
		   $search_text=str_replace('-',' ',$search_text);
		    $search_text=str_replace('~','@',$search_text);
		   $data['search_text']=$search_text;
		   $data['results']=$this->db->query("select * from sch_school_noticeboard where (title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	          $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                  $data['school_id']=$school_id;  
                  $this->load->view('noticeboard_home',$data);
			
		}
   }
   
    function deletenoticeboard() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_school_noticeboard where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school/noticeboard/'.$_POST['school_id']);
		  }
		  
	}
        
        function changeStatus_noticeboard() 
        {
		  if(isset($_POST['uid']))
		  {
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		           );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_school_noticeboard',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			   redirect('school/noticeboard/'.$_POST['school_id']);
		  }
		  
		  
	}
   //#################
        
        public function export_school()
   {
       $data['results']=  $this->db->query("SELECT * from sch_school")->result_array();
       
       $this->load->view('school_export_view',$data);
       
   }
   
   public function import_school()
   {
       if(isset($_POST['importForm']))
       {
         //$importfile="importdata.csv";
          if(!empty($_FILES['importfile']['name']))
            {                 		 
              if(copy($_FILES['importfile']['tmp_name'],$this->droot."/public/schoolimport/".$_FILES['importfile']['name']))
              {
                  $csv_file ="$this->droot/public/schoolimport/".$_FILES['importfile']['name']; // Name of your CSV file
                  $csvfile = fopen($csv_file, 'r');
                  $theData = fgets($csvfile);  //must be this line for import CSV
                  
        while (($data = fgetcsv($csvfile, 1000, ",")) !== FALSE)
        {   
            $email=preg_replace('/\s+/', '',$data[3]);
            $email=strtolower($email);                
            $num=$this->db->query("SELECT * from sch_user where email='".$email."'")->num_rows();
            //$userres=$this->db->query("SELECT user_id from sch_school where id='".$data[0]."'")->row_array();
            
			if($email==''){$num=0;}
			
            $address=mysql_real_escape_string(ucwords(strtolower($data[4])));
            
             $school_name=ucwords(strtolower($data[1]));
             $seo_url= str_replace(' ', '-', trim($school_name));
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($seo_url));  
             
              $school_name= str_replace('-', ' ', ucwords($seo_url)); 
                         
           if($num>0)
           {            
            if($data[3]!='')
            {    
                //$this->db->query("UPDATE sch_school set seo_url='".$seo_url."',school_name='".$school_name."',address ='".$address."',contact ='".$data[5]."',board ='".$data[6]."',category ='".$data[7]."',sub_category ='".$data[8]."',state_id ='".$data[9]."',area_id ='".$data[10]."',location ='".$data[11]."',latitude ='".$data[12]."',langitude ='".$data[13]."' where id=".$data[0]."");    
                //$this->db->query("UPDATE sch_user set owner_name='".$data[2]."' where id=".$userres['user_id']."");
            }   
            
           }//If email available
           else{
                 //$num=$this->db->query("SELECT * from sch_user where email='".$email."'")->num_rows();
				 $num=0;
                 if($num==0)
                 {
                     $num1=$this->db->query("SELECT * from sch_zone where location='".$data[11]."'")->num_rows();
                     
                      $location=ucfirst($data[11]);
                      
                    if($num1==0)
                    {                        
                     $this->db->query("INSERT into sch_zone(zone_locationid,location) values('$data[10]','$location')");
                    }
                    
                   
                
                  $res=$this->db->query("select * from sch_zone where zone_id=".$data[9]."")->row_array();
                  $state= $res['name'];
                  $res=$this->db->query("select * from sch_zone where zone_id=".$data[10]."")->row_array();
                  $area= $res['cityname'];                  
                
                
                 $password=md5('school121');
                 $reg_date=date("Y-m-d",time());             
                 $this->db->query("INSERT into sch_user(email,owner_name,contact_no,password,user_type,reg_date) values('$email','$data[2]','$data[5]','$password','school','$reg_date')");  
                
                $insert_id= $this->db->insert_id();    
              
           
         $query="INSERT into sch_school(user_id,school_name,board,category,sub_category,contact,email,address,state_id,state_name,area_id,area_name,location,latitude,langitude,reg_date,status) values"
           . "($insert_id,"
           . "'$school_name',"
           . "'$data[6]',"
           . "'$data[7]',"
           . "'$data[8]',"
           . "'$data[5]',"
           . "'$data[3]',"
           . "'$address',"
           . "'$data[9]',"
           . "'$state','$data[10]','$area','$location','$data[12]','$data[13]',"
           . "'$reg_date',1)";       
             //echo $query;
            // mysql_query($query);
              $this->db->query($query);
                 }//Email exist
                 else{echo "Email Exist:".$email."<br>";}
                 
               }
        }
        fclose($csvfile);
                  
              }
            }
            
            
            $data['sucess_msg']="Record has been Imported.";
            
       }
       $data['test']="test";
       $this->load->view('school_import_view',$data);
       
   }
   
   public function checkreg()
   {       
       
        $registrationno=$_POST['registrationno'];
        $num=$this->db->query("SELECT * from sch_school where registrationno='".$_POST['registrationno']."' and id!=".$_POST['school_id']."")->num_rows();         
        if($num>0)
        {
            echo "exist";return false;
        }else{echo "ok";return false;}
       
       
       
   }
   
   public function checkreg2()
   {       
       
        $registrationno=$_POST['registrationno'];
        $num=$this->db->query("SELECT * from sch_school where registrationno='".$_POST['registrationno']."'")->num_rows();         
        if($num>0)
        {
            echo "exist";return false;
        }else{echo "ok";return false;}
       
       
       
   }
   
   
   public function checkSeourl()
   {       
       
        $seourl=$_POST['seourl'];
        $num=$this->db->query("SELECT * from sch_school where seo_url ='".$seourl."' and id!=".$_POST['school_id']."")->num_rows();         
        if($num>0)
        {
            echo "exist";return false;
        }else{echo "ok";return false;}
       
       
       
   }
   
   public function checkSeourl2()
   {       
       
        $seourl=$_POST['seourl'];
        $num=$this->db->query("SELECT * from sch_school where seo_url ='".$seourl."'")->num_rows();         
        if($num>0)
        {
            echo "exist";return false;
        }else{echo "ok";return false;}
       
       
       
   }
 
}
 