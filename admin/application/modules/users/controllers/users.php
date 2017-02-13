<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Users extends MX_Controller {
 
  function __construct()
       {
           parent::__construct();
           
		   $this->load->model('Users_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	
                  $this->load->helper('language');
                  $this->lang->load('form_validation','english');	                  
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
   function index($sort_by='name',$perpage=0,$offset=0)
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
						$perpage=20;
						$data['perpage']='';
					}
					if($sort_by=='name-asc')
					{
						$order='order by owner_name asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by owner_name desc';
					}
					else
					{
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_user")->num_rows();
					
					$config['base_url'] = base_url()."users/index/$sort_by/$perpage";                
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
				   $data['user_results']=$this->db->query("select * from sch_user $order limit $offset,$limit")->result_array();
				   $this->load->view('users_home',$data);
			
			
			
		}
   }
   	/*====================================================================
	 #############################Serach##################################
	 ====================================================================*/
    public function search($search_text='',$perpage=0,$offset=0)
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
				$perpage=20;
				$data['perpage']='';
			}
 			$data['order']='';
            $numrosw=$this->db->query("select * from sch_user where (owner_name like '%".$search_text."%' or email like '%".$search_text."%' or user_type like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."users/index/$search_text";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=2;			
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
                   $data['startlimit']=$offset;
		   $data['user_results']=$this->db->query("select * from sch_user where (owner_name like '%".$search_text."%' or email like '%".$search_text."%' or user_type like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('users_home',$data);
			
		}
   }
   	/*====================================================================
	 #####################Add Users########################
	 ====================================================================*/
    public function add()
    {   
	$data['countrys']=$this->Users_model->allcountry();
        $data['owner_name'] = "";
        $data['email'] = "";
        $data['passwords'] = "";
        $data['user_type'] = ""; 
                                                
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['usersRegister'])) {                                           
						$chk=$this->db->query("select * from sch_user where email='".$_POST['email']."'")->num_rows();
						
						if($chk > 0)
						{
						$data['owner_name'] = $_POST['owner_name'];
                                                $data['email'] = $_POST['email'];
                                                $data['passwords'] = $_POST['passwords'];
                                                $data['user_type'] = $_POST['user_type'];                                                
                                                
                                                    //$this->session->set_flashdata('info', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-info"><strong>Notice !</strong> This Email already exist..! </div>');
					         //redirect('users/add');
                                                  
                                                  $data['exist_error'] = sprintf($this->lang->line('email_exist'),$_POST['email']);                                                  
                                                 
                                                  $this->load->view('users_add',$data);
						}
						else
						{
						  $this->Users_model->add_user();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> New User added successfully..! </div>');
					     redirect('users/index','refresh');
						}
						

					}
					else
					{
					 $this->load->view('users_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Users########################
	 ====================================================================*/
	 function edit($mid=''){
             $data['countrys']=$this->Users_model->allcountry();
        $data['owner_name'] = "";
        $data['email'] = "";
        $data['passwords'] = "";
        $data['user_type'] = "";
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($mid=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['user_data']=$this->Users_model->recordById($mid);
                         $result=$this->Users_model->recordById($mid);
                         
                         $data['states']=$this->Users_model->state_by_country($result['country']);
                         $data['citys']=$this->Users_model->city_by_state($result['state']);
					 $this->load->view('users_edit',$data);
				}
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
			              
                        if(isset($_POST['usersUpdate'])) 
                        {  
                         $chk=$this->db->query("select * from sch_user where email='".$_POST['email']."'")->num_rows();
                         
                         if($_POST['hidden_email']==$_POST['email']){$chk=0;}	                         
						if($chk > 0)
						{
						 $data['owner_name'] = $_POST['owner_name'];
                                                 $data['email'] = $_POST['email'];                                                 
                                                 $data['user_type'] = $_POST['user_type'];      
                                                 $data['exist_error'] = sprintf($this->lang->line('email_exist'),$_POST['email']);                                                  
                                                 
                                                 $mid=$_POST['users_id'];
                                                 $data['user_data']=$this->Users_model->recordById($mid);
                                                 $result=$this->Users_model->recordById($mid);
                                                 //Country state city
                                                 $data['countrys']=$this->Users_model->allcountry();
                                                 $data['states']=$this->Users_model->state_by_country($result['country']);
                                                 $data['citys']=$this->Users_model->city_by_state($result['state']);
                                                 
                                                 //Call View file
                                                 $this->load->view('users_edit',$data);
					         
						}
                                                else{
                                                
				 $this->Users_model->update_user();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('users');
                                                }
                        }                        
				
			
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_user where id='".$_POST['delid']."'");
                          $this->db->query("DELETE from sch_school where user_id='".$_POST['delid']."'");
                          $this->db->query("DELETE from sch_teacher_details where user_id='".$_POST['delid']."'");
                          $this->db->query("DELETE from sch_vendor_details where user_id='".$_POST['delid']."'");
                          
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('user');
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
			    redirect('users');
		  }
		  
		  
	}
        
        function getstate($contryid)
        {            
            $data['states_result']=$this->Users_model->state_by_country($contryid);           
            $this->load->view('getstate',$data);
        }
        
        function getcity($ststeid)
        {            
            
            $data['citys_result']=$this->Users_model->city_by_state($ststeid);           
            $this->load->view('getcity',$data);
        }
		
 
}
 