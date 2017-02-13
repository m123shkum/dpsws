<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Jobsapply extends MX_Controller {
 
  function __construct()
       {
           parent::__construct();
           
		   $this->load->model('Jobsapply_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	
                  $this->load->helper('language');
                  $this->lang->load('form_validation','english');	                  
                  
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
						$order='order by applieddate asc';
					}
					else if($sort_by=='date-desc')
					{
						$order='order by applieddate desc';
					}
					else
					{
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("SELECT jp.id,jp.role,jp.job_title,jp.school_name,jp.school_id,aj.applied_id,aj.jobpostid,aj.applieddate,aj.userid,tch.name,tch.resume FROM sch_school_job AS jp, sch_teacher_details AS tch, sch_applied_job AS aj WHERE jp.id=aj.jobpostid AND tch.user_id=aj.userid")->num_rows();
					
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
                                   $qu="SELECT jp.id,jp.role,jp.job_title,jp.school_name,jp.school_id,aj.applied_id ,aj.jobpostid,aj.applieddate,aj.userid,tch.name,tch.resume FROM sch_school_job AS jp, sch_teacher_details AS tch, sch_applied_job AS aj WHERE jp.id=aj.jobpostid AND tch.user_id=aj.userid";
				   $data['jobsapply_results']=$this->db->query("$qu $order limit $offset,$limit")->result_array();
				   $this->load->view('jobsapply_home',$data);
			
			
			
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
            $numrosw=$this->db->query("SELECT jp.id,jp.role,jp.job_title,jp.school_name,jp.school_id,aj.applied_id,aj.jobpostid,aj.applieddate,aj.userid,tch.name FROM sch_school_job AS jp, sch_teacher_details AS tch, sch_applied_job AS aj "
                    . "WHERE (tch.name like '%".$search_text."%' OR jp.school_name like '%".$search_text."%' OR jp.role like '%".$search_text."%') and jp.id=aj.jobpostid AND tch.user_id=aj.userid")->num_rows();
            
			$config['base_url'] = base_url()."jobsapply/search/$search_text/$perpage";                
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			$config['page_query_string']='FALSE';
			$config['uri_segment']=5;			
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
                   $qu="SELECT jp.id,jp.role,jp.job_title,jp.school_name,jp.school_id,aj.applied_id,aj.jobpostid,aj.applieddate,aj.userid,tch.name,tch.resume FROM sch_school_job AS jp, sch_teacher_details AS tch, sch_applied_job AS aj "
                    . "WHERE (tch.name like '%".$search_text."%' OR jp.school_name like '%".$search_text."%' OR jp.role like '%".$search_text."%') and jp.id=aj.jobpostid AND tch.user_id=aj.userid";
                   $data['jobsapply_results']=$this->db->query("$qu limit $offset,$limit")->result_array();
	       $this->load->view('jobsapply_home',$data);
			
		}
   }
   	   
				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
			  $this->db->query("DELETE from sch_applied_job where applied_id='".$_POST['delid']."'");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('user');
		  }
		  
	}
      	
 
}
 