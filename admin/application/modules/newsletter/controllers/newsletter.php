<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Newsletter extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
		   $this->load->model('Newsletter_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	   
                   $this->load->helper('ckeditor');	
                  $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz";  
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
  function index($perpage=0,$offset=0)
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
						$perpage=15;
						$data['perpage']='';
					}
					
                                        $order='order by id desc';					
					$numrosw=$this->db->query("select * from sch_subscriber")->num_rows();
					
					$config['base_url'] = base_url()."newsletter/index/$perpage";                
					$config['total_rows'] = $numrosw;
					$config['per_page'] = $perpage;   
					$config['page_query_string']='FALSE';
					$config['uri_segment']=4;			
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
				   $data['results']=$this->db->query("select * from sch_subscriber $order limit $offset,$limit")->result_array();
                                   $this->load->view('newsletter_home',$data);
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
            $numrosw=$this->db->query("select * from sch_subscriber where (newsletter_email like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."newsletter/search/$search_text";                
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
		   $data['results']=$this->db->query("select * from sch_subscriber where (newsletter_email like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('newsletter_home',$data);
			
		}
   }   	
        
    public function add()
    {   
        $data['email'] ="";  
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['newsletterForm'])) {
                                        $chk=$this->db->query("select * from sch_subscriber where newsletter_email='".$_POST['email']."'")->num_rows();
						
						if($chk > 0)
						{						
                                                $data['email'] = $_POST['email'];                                                                                                    
                                                $this->session->set_flashdata('exist_error', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Exist! </strong>This email-id has been already exist..! </div>');
                                                 
                                                  $this->load->view('newsletter_add',$data);
						}else{                                            
						
					      $this->Newsletter_model->add_newsletter();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Newsletter has been added successfully..! </div>');
					     redirect('newsletter');
                                                }
					}
					else
					{
					 $this->load->view('newsletter_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Gallery########################
	 ====================================================================*/
	 function edit($id){ 
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Newsletter_model->oneRecordById($id,"sch_subscriber");                         
                         $this->load->view('newsletter_edit',$data);
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
			              
                        if(isset($_POST['newsletterForm'])) 
                        {        
                            $data['results']=$this->Newsletter_model->oneRecordById($_POST['subscriber_id'],"sch_subscriber");   
                           
                            $chk=$this->db->query("select * from sch_subscriber where newsletter_email='".$_POST['email']."'")->num_rows();
						
						if($chk > 0)
						{						
                                                     // echo "fdf";die;    
                                                    $data['exist_error']="exist_error";
                                                 
                                                  $this->load->view('newsletter_edit',$data);
						}else{                                            
						
					      $this->Newsletter_model->update_newsletter();		
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
					     redirect('newsletter');
                                                }
                                               
                        } else{redirect('newsletter');}                       
				
			
       }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                        
                      $this->db->query("DELETE from sch_subscriber where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('newsletter');
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
				   $query=$this->db->update('sch_subscriber',$data);
			  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('newsletter');
		  }
		  
		  
	}
 
}
 