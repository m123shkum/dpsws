<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Banner extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
		   $this->load->model('Banner_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	                  
                  $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz";  
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
  function index($sort_by='',$perpage=0,$offset=0)
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
					if($sort_by=='order-asc')
					{
						$order='order by ord asc';
					}
					else if($sort_by=='order-desc')
					{
						$order='order by ord desc';
					}
					else
					{
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_banner")->num_rows();
					
					$config['base_url'] = base_url()."banner/index/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_banner $order limit $offset,$limit")->result_array();
                                   $this->load->view('banner_home',$data);
			
			
			
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
            $numrosw=$this->db->query("select * from sch_banner where (image_title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."banner/index/$search_text";                
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
		   $data['results']=$this->db->query("select * from sch_banner where (image_title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('banner_home',$data);
			
		}
   }   	
        
    public function add()
    {    
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['bannerForm'])) {                                           						
						
					      $this->Banner_model->add_banner();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Banner has been added successfully..! </div>');
					     redirect('banner');
					}
					else
					{
					 $this->load->view('banner_add');
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Gallery########################
	 ====================================================================*/
	 function edit($banner_id){                  
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($banner_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Banner_model->oneRecordById($banner_id,"sch_banner");                         
                         $this->load->view('banner_edit',$data);
				}
		}
	 }
         
         

	/*====================================================================
	 #####################Update Event#####################
	 ====================================================================*/
	  public function  update()
          { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['bannerForm'])) 
                        {                       
				 $this->Banner_model->update_banner();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('banner');
                                               
                        }                        
				
			
       }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
			$row=$this->Banner_model->oneRecordById($_POST['delid'],"sch_banner");
                        unlink($this->droot."/public/banner/".$row['image']);                        
                        
                      $this->db->query("DELETE from sch_banner where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('banner');
		  }
		  
	}
        
        function changeStatus() 
        {
            //echo print_r($_POST);die;
		  if(isset($_POST['uid']))
		  {
			  
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		           );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_banner',$data);
			  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('page');
		  }
		  
		  
	}
 
}
 