<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Admission extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
		   $this->load->model('Admission_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	   
                   $this->load->helper('ckeditor');	
                  $this->droot=$_SERVER['DOCUMENT_ROOT'];  
                  
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
                                        
					$numrosw=$this->db->query("SELECT chp.id,chp.fname,chp.lname,chp.dob,ap.id as aplyid,ap.school_id ,ap.child_pdf,ap.apply_date,ap.child_id,sh.school_name FROM sch_childprofile AS chp, sch_school AS sh, sch_admissionapply AS ap WHERE chp.id=ap.child_id AND sh.id=ap.school_id order by ap.apply_date")->num_rows();
					
					$config['base_url'] = base_url()."admission/index/$perpage";                
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
				   $data['results']=$this->db->query("SELECT chp.id,chp.fname,chp.lname,chp.dob,chp.contactno,ap.id as aplyid,ap.school_id ,ap.apply_date,ap.child_pdf,ap.child_id,sh.school_name FROM sch_childprofile AS chp, sch_school AS sh, sch_admissionapply AS ap WHERE chp.id=ap.child_id AND sh.id=ap.school_id order by ap.apply_date desc limit $offset,$limit")->result_array();
                                   $this->load->view('admission_home',$data);
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
            $numrosw=$this->db->query("SELECT chp.id,chp.fname,chp.lname,chp.dob,chp.contactno,ap.id as aplyid,ap.school_id ,ap.child_pdf,ap.apply_date,ap.child_id,sh.school_name FROM sch_childprofile AS chp, sch_school AS sh, sch_admissionapply AS ap WHERE chp.id=ap.child_id AND sh.id=ap.school_id AND (chp.fname like '%".$search_text."%' OR chp.lname like '%".$search_text."%' OR sh.school_name like '%".$search_text."%') order by ap.apply_date")->num_rows();
            
			$config['base_url'] = base_url()."admission/index/$search_text";                
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
		   $data['results']=$this->db->query("SELECT chp.id,chp.fname,chp.lname,chp.dob,chp.contactno,ap.id as aplyid,ap.school_id ,ap.child_pdf,ap.apply_date,ap.child_id,sh.school_name FROM sch_childprofile AS chp, sch_school AS sh, sch_admissionapply AS ap WHERE chp.id=ap.child_id AND sh.id=ap.school_id AND (chp.fname like '%".$search_text."%' OR chp.lname like '%".$search_text."%' OR sh.school_name like '%".$search_text."%') order by ap.apply_date limit $offset,$limit")->result_array();
	       $this->load->view('admission_home',$data);
			
		}
   }   	
        
   
				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                      $res=  $this->db->query("select * from sch_admissionapply where id=".$_POST['delid']."")->row_array();
                      
                      @unlink($this->droot."/public/child_pdf/".$res['child_pdf']);
                      @unlink($this->droot."/public/child_pdf/".$res['receipt_pdf']);
                      
                      $this->db->query("DELETE from sch_admissionapply where id=".$_POST['delid']."");
                      
                      
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('admission');
		  }
		  
	}
        
       
 
}
 