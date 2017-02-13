<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Location extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
		   $this->load->model('Location_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	   
                   $this->load->helper('ckeditor');	
                  $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz";  
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
  function index($sort_by='0',$perpage=0,$offset=0)
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
						$perpage=50;
						$data['perpage']='';
					}
					if($sort_by=='title-asc')
					{
						$order='order by location asc';
					}
					else if($sort_by=='title-desc')
					{
						$order='order by location desc';
					}
					else
					{
						$order='order by zone_id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_zone where location!=''")->num_rows();
					
					$config['base_url'] = base_url()."location/index/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_zone where location!='' $order limit $offset,$limit")->result_array();
                                   $this->load->view('location_home',$data);
			
			
			
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
                
                if($_GET['perpage']!='')
                 {
                     $perpage=$_GET['perpage'];
                 }else{ $perpage=20;}
                
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{
                    $sqlcon="where 1";
                   
                   if($_GET['location_name']!='')
                  {
                   //$con2="($con2)";
                   $sqlcon=$sqlcon." and location like '%".$_GET['location_name']."%'";
                  }
                  
                  if($_GET['are_name']!='')
                  {
                   //$con2="($con2)";
                      $ress=$this->db->query("SELECT * from sch_zone where cityname='".$_GET['are_name']."'")->row_array(); 
                      
                   $sqlcon=$sqlcon." and zone_locationid=".$ress['zone_id']."";
                  }
                  
			
                        $numrosw=$this->db->query("select * from sch_zone $sqlcon")->num_rows();
                        
            
			$config['base_url'] = base_url()."location/search?are_name=".$_GET['are_name']."&location_name=".$_GET['location_name']."&perpage=".$_GET['perpage']; ;           
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			//$config['page_query_string']='FALSE';
			//$config['uri_segment']=5;			
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
                                   
                                   $data['perpage']=$perpage;
		   
		   $data['results']=$this->db->query("select * from sch_zone $sqlcon limit $offset,$limit")->result_array();
                   
	       $this->load->view('location_home',$data);
			
		}
   }   	
        
    public function add()
    {    
       
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['locationForm'])) {                                           						
						
					      $this->Location_model->add_location();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Location has been added successfully..! </div>');
					     redirect('location');
					}
					else
					{
					 $this->load->view('location_add');
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Location########################
	 ====================================================================*/
	 function edit($page_id){                 
            
             
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
	                 $data['results']=$this->Location_model->oneRecordById($page_id,"sch_zone");                         
                         $this->load->view('location_edit',$data);
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
			              
                        if(isset($_POST['locationForm'])) 
                        {                       
				 $this->Location_model->update_location();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('location');
                                               
                        }                        
				
			
       }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                        
                      $this->db->query("DELETE from sch_zone where zone_id =".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('location','refresh');
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
		
				   $this->db->where('zone_id ',$_POST['uid']);
				   $query=$this->db->update('sch_zone',$data);
			  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
                      //header("Cache-Control: no-cache, no-store, must-revalidate");
                      //header("Pragma: no-cache"); 
			    redirect('location','refresh');
		  }
		  
		  
	}
 
}
 