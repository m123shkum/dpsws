<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Typecontent extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
		   $this->load->model('Typecontent_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	   
                   $this->load->helper('ckeditor');	
                  $this->droot=$_SERVER['DOCUMENT_ROOT'];  
                  
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
						$perpage=15;
						$data['perpage']='';
					}
                                        if($sort_by=='type-asc')
					{
						$order='order by type_name asc';
					}
					else if($sort_by=='type-desc')
					{
						$order='order by type_name desc';
					}
					else
					{
						$order='order by id desc';
					}					
                                       
                                        $data['order']=$sort_by;
                                        
					$numrosw=$this->db->query("select * from sch_usertype_details")->num_rows();
					
					$config['base_url'] = base_url()."typecontent/index/$perpage";                
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
                                  // echo "select * from sch_usertype_details $order limit $offset,$limit";
				   $data['results']=$this->db->query("select * from sch_usertype_details $order limit $offset,$limit")->result_array();
                                   $this->load->view('typecontent_home',$data);
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
            $numrosw=$this->db->query("select * from sch_usertype_details where (tab_name like '%".$search_text."%' or type_name like '%".$search_text."%' or title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."typecontent/index/$search_text";                
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
		   $data['results']=$this->db->query("select * from sch_usertype_details where (tab_name like '%".$search_text."%' or type_name like '%".$search_text."%' or title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('typecontent_home',$data);
			
		}
   }  
        
    public function add()
    {    
        $data['user_types']=$this->db->query("SELECT * from sch_user_type")->result_array();
         
        $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			),
 
			//Replacing styles from the "Styles tool"
			'styles' => array(
 
				//Creating a new style named "style 1"
				'style 3' => array (
					'name' 		=> 	'Green Title',
					'element' 	=> 	'h3',
					'styles' => array(
						'color' 	=> 	'Green',
						'font-weight' 	=> 	'bold'
					)
				)
 
			)
		);	
		//
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['typecontentForm'])) {                                           						
						
					      $this->Typecontent_model->add_typecontent();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Record has been added successfully..! </div>');
					     redirect('typecontent');
					}
					else
					{
					 $this->load->view('typecontent_add',$data);
					}
					
			  
			
		
	}      
        
    
	 /*====================================================================
	 #####################Edit Typepages########################
	 ====================================================================*/
	 function edit($page_id){     
             $data['user_types']=$this->db->query("SELECT * from sch_user_type")->result_array();
             $data['ckeditor_2'] = array(
 
			//ID of the textarea that will be replaced
			'id' 	=> 	'content',
			'path'	=>	'public/js/ckeditor',			
 
			//Optionnal values
			'config' => array(
				'width' 	=> 	"750px",	//Setting a custom width
				'height' 	=> 	'230px',	//Setting a custom height				
			),
 
			//Replacing styles from the "Styles tool"
			'styles' => array(
 
				//Creating a new style named "style 1"
				'style 3' => array (
					'name' 		=> 	'Green Title',
					'element' 	=> 	'h3',
					'styles' => array(
						'color' 	=> 	'Green',
						'font-weight' 	=> 	'bold'
					)
				)
 
			)
		);	
		//
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($page_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Typecontent_model->oneRecordById($page_id,"sch_usertype_details");                         
                         $this->load->view('typecontent_edit',$data);
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
			              
                        if(isset($_POST['typecontentForm'])) 
                        {                       
				 $this->Typecontent_model->update_typecontent();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('typecontent');
                                               
                        }                        
				
			
       }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                        
                      $this->db->query("DELETE from sch_usertype_details where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('typecontent');
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
				   $query=$this->db->update('sch_usertype_details',$data);
			  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('typecontent');
		  }
		  
		  
	}
 
}
 