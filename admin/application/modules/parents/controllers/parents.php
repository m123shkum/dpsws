<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Parents extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
                   
		   $this->load->model('Parents_model');
		   $this->load->library('pagination');		   
                  //$this->load->helper('language');
                  $this->load->helper(array('ckeditor','language'));
                  $this->lang->load('form_validation','english');
                  $this->droot=$_SERVER['DOCUMENT_ROOT'];  
                  $this->load->driver('cache');
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
   public function index($sort_by='name',$perpage=0,$offset=0)
   { 
       $this->cache->clean();
   
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
						$perpage=15;
						$data['perpage']='';
					}
					if($sort_by=='name-asc')
					{
						$order='order by business_name asc';
					}
					else if($sort_by=='name-desc')
					{
						$order='order by business_name desc';
					}
					else
					{
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_user where user_type='parents'")->num_rows();
					
					$config['base_url'] = base_url()."parents/index/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_user where user_type='parents' $order limit $offset,$limit")->result_array();
				   $this->load->view('parents_home',$data);
			
			
			
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
				$perpage=10;
				$data['perpage']='';
			}
 			$data['order']='';
            $numrosw=$this->db->query("select * from sch_user where (owner_name like '%".$search_text."%' or email like '%".$search_text."%' or state_name like '%".$search_text."%' or city like '%".$search_text."%') and user_type='parents'")->num_rows();
            
			$config['base_url'] = base_url()."parents/search/$search_text";                
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
                   $data['startlimit']=$offset;
		   $data['results']=$this->db->query("select * from sch_user where (owner_name like '%".$search_text."%' or email like '%".$search_text."%' or state_name like '%".$search_text."%' or city like '%".$search_text."%') and user_type='parents' order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('parents_home',$data);
			
		}
   }
   	/*====================================================================
	 #####################Add Users########################
	 ====================================================================*/
    public function add()
    {    
        
         $data['countrys']=$this->Parents_model->allcountry();
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['parentRegister'])) { 
                                            $chk=$this->db->query("select * from sch_user where email='".$_POST['email']."'")->num_rows();
                                             if($chk > 0)
						{
                                                 $data['exist_error'] = "This Email-id(".$_POST['email'].") is already exist !";
                                                 
                                                  $this->load->view('parents_add',$data);
                                                
                                                }
                                                else{						
					      $this->Parents_model->add_parent();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> New Parent added successfully..! </div>');
					     redirect('parents');
                                                }
					}
					else
					{
					 $this->load->view('parents_add',$data);
					}
		
	}       
        
        function getstate()
        {            
		   $contryid=$_GET['contid'];
            $data['states_result']=$this->Parents_model->state_by_country($contryid);           
            $this->load->view('getstate',$data);
        }
    
	 /*====================================================================
	 #####################Edit Users########################
	 ====================================================================*/
   function edit($sid='')
    {       
           $data['countrys']=$this->Parents_model->allcountry();
           
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
                                    
	                 $data['results']=$this->Parents_model->recordById($sid);                         
                         $result=$this->Parents_model->recordById($sid);                         
                         $data['states_result']=$this->Parents_model->state_by_country($result['country']);
                         
                         $this->load->view('parents_edit',$data);
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
			              
                        if(isset($_POST['parentsUpdate'])) 
                        {                       
				 $this->Parents_model->update_parent();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('parents','refresh');
                                               
                        }                        
				
			
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_user where id=".$_POST['delid']."");
                           $this->db->query("DELETE from sch_childprofile where parent_id=".$_POST['delid']."");
                          
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('parents','refresh');
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
			    redirect('parents','refresh');
		  }
		  
		  
	}
        
        function getarea($state_id)
        {            
            $data['area_result']=$this->Vendor_model->area_by_state($state_id);           
            $this->load->view('getarea',$data);
        }
        
        function getlocation($areaid)
        {            
            
            $data['location_result']=$this->Vendor_model->location_by_area($areaid);           
            $this->load->view('getlocation',$data);
        }
        			
	
        //Kids Function
        function kids($parent_id,$perpage=0,$offset=0)
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
					
                                        $order='order by id desc';					
					$numrosw=$this->db->query("select * from sch_childprofile where parent_id=$parent_id")->num_rows();
					
					$config['base_url'] = base_url()."parents/kids/$parent_id/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_childprofile where parent_id=$parent_id $order limit $offset,$limit")->result_array();
				   $data['parent_id']=$parent_id;                                   
                                   $this->load->view('kid_home',$data);
			
			
			
		}
        }
        
        
    
    public function addkid($parent_id)
    {    
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['kidForm'])) { 
						
					      $this->Parents_model->add_kid();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Kid has been added successfully..! </div>');
					     redirect('parents/kids/'.$parent_id);
					}
					else
					{                                            
                                         $data['parent_id']=$parent_id;   
					 $this->load->view('kid_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Gallery########################
	 ====================================================================*/
	 function editkid($parent_id='',$kid_id){                  
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($parent_id=='' || $kid_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Parents_model->oneRecordById($kid_id,"sch_childprofile");
                         $data['parent_id']=$parent_id;
                         $this->load->view('kid_edit',$data);
				}
		}
	 }
         
         

	/*====================================================================
	 #####################Update Event#####################
	 ====================================================================*/
	  public function  updatekid() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['kidForm'])) 
                        {                       
				 $this->Parents_model->update_kid();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('parents/kids/'.$_POST['parent_id']);
                                               
                        }                        
				
			
   }
   
   public function searchkid($parent_id,$search_text='',$perpage=0,$offset=0)
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
            $numrosw=$this->db->query("select * from sch_childprofile where (fname like '%".$search_text."%' OR lname like '%".$search_text."%' OR mname like '%".$search_text."%') and parent_id=$parent_id")->num_rows();
            
			$config['base_url'] = base_url()."parents/searchkid/$parent_id/$search_text/$perpage";                
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
		   $data['results']=$this->db->query("select * from sch_childprofile where (fname like '%".$search_text."%' OR lname like '%".$search_text."%' OR mname like '%".$search_text."%') and parent_id=$parent_id order by id desc limit $offset,$limit")->result_array();
	         
                  $data['parent_id']=$parent_id;  
                  $this->load->view('kid_home',$data);
			
		}
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function deletekid() {
		  if(isset($_POST['delid']))
		  {
			$row=$this->Vendor_model->oneRecordById($_POST['delid'],"sch_vendor_pictures");
                        @unlink($this->droot."/public/vendorimage/".$row['image']);                       
                        
                      $this->db->query("DELETE from sch_vendor_pictures where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('vendor/gallery/'.$_POST['vendor_id']);
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
				   $query=$this->db->update('sch_vendor_pictures',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			   redirect('vendor/gallery/'.$_POST['vendor_id']);
		  }
		  
		  
	}
 
}
 