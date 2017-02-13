<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Marketrequest extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
		   $this->load->model('Marketrequest_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	   
                   $this->load->helper('ckeditor');	
                  $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz";  
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
  function index($sort_by='date',$perpage=0,$offset=0)
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
                                        if($sort_by=='date-asc')
					{
						$order='order by reuest_date asc';
					}
					else if($sort_by=='date-desc')
					{
						$order='order by reuest_date desc';
					}
                                        else
					{
						$order='order by id desc';
					}                                       
                                        
                                        $data['order']=$sort_by;
					
                                        
                                        
					$numrosw=$this->db->query("select * from sch_marketbuy")->num_rows();
					
					$config['base_url'] = base_url()."marketrequest/index/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_marketbuy $order limit $offset,$limit")->result_array();
                                   $this->load->view('marketrequest_home',$data);
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
            $numrosw=$this->db->query("select * from sch_marketbuy where (name like '%".$search_text."%' OR email like '%".$search_text."%' OR category like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."marketrequest/search/$search_text";                
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
		   $data['results']=$this->db->query("select * from sch_marketbuy where (name like '%".$search_text."%' OR email like '%".$search_text."%' OR category like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('marketrequest_home',$data);
			
		}
   }   	
        
   
   function reply($sid=''){  
                         
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
	                 $data['results']=$this->Marketrequest_model->oneRecordById($sid,"sch_marketbuy");                         
                         $this->load->view('reply_view',$data);
				}
		}
	 }
      
    function action_reply()
    {
        //print_r($_POST);die;
        if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['replyForm'])) 
                        { 
                           $this->Marketrequest_model->save_reply();  
                           
                           $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px; margin-top: 42px;margin-bottom: 10px;" class="alert alert-success"><strong>Success!</strong> Request has been sended successfully..! </div>');
                          redirect('marketrequest');
                        }
                        
    }
        
				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                        
                      $this->db->query("DELETE from sch_marketbuy where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('marketrequest');
		  }
		  
	}
        
       
 
}
 