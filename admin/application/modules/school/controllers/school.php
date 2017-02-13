<?php 
ob_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
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
   public function index($sort_by='paid',$perpage=0,$offset=0)
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
					if($sort_by=='paid')
					{
						$order='order by Ispaid desc';
					}
					else if($sort_by=='unpaid')
					{
						$order='order by Ispaid asc';
					}
                                        else if($sort_by=='date-asc')
					{
						$order='order by reg_date asc';
					}
                                        else if($sort_by=='date-desc')
					{
						$order='order by reg_date desc';
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
       
   
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else
		{                    
	            $con2="";		
                    if($_GET['are_name']!='')
                    { 
                        $con2="area_name like '%".$_GET['are_name']."%'";
                        
                        $are_name=$_GET['are_name'];            
                        $res=$this->db->query("SELECT * from sch_zone where cityname='".$are_name."'")->row_array();            
                        $areaid=$res['zone_id'];            
                        $data['location_result']=$this->School_model->location_by_area($areaid);
                    }
                    $con3="";
                    if($_GET['location']!='')
                   { 
                     $con3="location like '%".$_GET['location']."%'";
                   }
                   
                   $sqlcon="where 1";
                   
                   if($_GET['school_name']!='')
                  {
                   //$con2="($con2)";
                   $sqlcon=$sqlcon." and school_name like '%".$_GET['school_name']."%'";
                  }
                   
                   if($con2!='')
                  {
                   $con2="($con2)";
                   $sqlcon=$sqlcon." and ".$con2;
                  }
      
                  if($con3!='')
                 {
                  $con3="($con3)";
                  $sqlcon=$sqlcon." and ".$con3;
                 }
 			//$data['order']='';
                 if($_GET['perpage']!='')
                 {
                     $perpage=$_GET['perpage'];
                 }else{ $perpage=50;}
                 
                        //if($_REQUEST[''])
                        $numrosw=$this->db->query("select * from sch_school $sqlcon")->num_rows();            
            
			//$config['base_url'] = base_url()."school/index/$search_text";         
                        $config['base_url'] = base_url()."school/search?are_name=".$_GET['are_name']."&location=".$_GET['location']."&school_name=".$_GET['school_name']."&perpage=".$_GET['perpage'];
                        
			$config['total_rows'] = $numrosw;
                        $config['per_page'] = $perpage;   
			//$config['page_query_string']='TRUE';
			//$config['uri_segment']=4;			
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
	       $limit=$config['per_page'];
	       $data['links']=$this->pagination->create_links();		  
                   $data['startlimit']=$offset;
                   $data['perpage']=$perpage;
                   
                    $data['order']='paid';
                  // echo "select * from sch_school $sqlcon order by id desc limit $offset,$limit";
                    $data['results']=$this->db->query("select * from sch_school $sqlcon order by Ispaid desc limit $offset,$limit")->result_array();   
		   //$data['results']=$this->db->query("select * from sch_school where (school_name like '%".$search_text."%' or area_name like '%".$search_text."%' or location like '%".$search_text."%' or address like '%".$search_text."%')$paidby order by id desc limit $offset,$limit")->result_array();
	       
                   $this->load->view('school_home',$data);
			
		}
   }
   
    public function search2($search_text='',$perpage=0,$offset=0)
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
                       
                       $chk=$this->db->query("select * from sch_user where email='".$_POST['email']."' and id!=".$_POST['schooluser_id']."")->num_rows();
                                             if($chk > 0)
						{
                                                 echo "exist_email";return false;
                                                
                                                }
				 $this->School_model->update_school();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px; margin-top: 42px;margin-bottom: 10px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
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
                          $this->db->query("DELETE from sch_school_noticeboard where school_id=".$_POST['delid']."");
                           $this->db->query("DELETE from sch_school_managment where school_id=".$_POST['delid']."");
                           $this->db->query("DELETE from sch_admissionapply where school_id=".$_POST['delid'].""); 
                          
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
        
        function getsearchlocation()
        {            
            $are_name=$_GET['are_name'];
            
            $res=$this->db->query("SELECT * from sch_zone where cityname='".$are_name."'")->row_array();
            
            $areaid=$res['zone_id'];
            
            $data['location_result']=$this->School_model->location_by_area($areaid);           
            $this->load->view('getsearchlocation',$data);
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
	
	
	/*---------------------------------------------------------------------------------------------------------*/
        
        //Management Function
        
        function management($school_id,$sort_by='name',$perpage=0,$offset=0)
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
						$order='order by id desc';
					}
					$data['order']=$sort_by;
					$numrosw=$this->db->query("select * from sch_school_managment where school_id=$school_id")->num_rows();
					
					$config['base_url'] = base_url()."school/management/$school_id/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_school_managment where school_id=$school_id $order limit $offset,$limit")->result_array();
				   $data['school_id']=$school_id; 
                                   $data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                                   $this->load->view('managment_home',$data);
			
			
			
		}
        }
        
        
  
        
     public function addmanagement($school_id)
    {    
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['galleryForm'])) {                                           						
						
					      $this->School_model->add_management();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Management has been added successfully..! </div>');
					     redirect('school/management/'.$school_id);
					}
					else
					{                                            
                                         $data['school_id']=$school_id;   
					 $this->load->view('management_add',$data);
					}
					
			  
			
		
	}        
    
        
	 /*====================================================================
	 #####################Edit Gallery########################
	 ====================================================================*/
	 function editmanagement($school_id='',$management_id){                  
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($school_id=='' || $management_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->School_model->oneRecordById($management_id,"sch_school_managment");
                         $data['school_id']=$school_id;
                         $this->load->view('management_edit',$data);
				}
		}
	 }
        
        
        
        
       /* 
        function editmanagement($school_id){                  
             
	 
	                 $data['results']=$this->School_model->oneRecordById($school_id,"sch_school_managment");
                         $data['school_id']=$school_id;
                         $this->load->view('management_edit',$data);
		
	 }
         */
         
		 
		      function deletemanagement() {
		  if(isset($_POST['delid']))
		  {
			$row=$this->School_model->oneRecordById($_POST['delid'],"sch_school_managment");
                        unlink($this->droot."/public/schoolimage/".$row['management_photo']);
                        unlink($this->droot."/public/schoolimage/thumb_".$row['management_photo']);
       //echo $k="DELETE from sch_school_managment where id=".$_POST['delid']."";
                          $this->db->query("DELETE from sch_school_managment where id=".$_POST['delid']."");
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('school/management/'.$_POST['school_id']);
		  }
		  
	}
		 
		 
		 
		 

	/*====================================================================
	 #####################Update Event#####################
	 ====================================================================*/
	  public function  updatemanagement() { 
		if(!$this->session->userdata('userid'))
			{
				redirect('user/login');
			}
			              
                        if(isset($_POST['galleryForm'])) 
                        {                       
				 $this->School_model->update_management();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				 redirect('school/management/'.$_POST['school_id']);
                        }                        
				
			
   }
   
   public function searchmanagement($school_id,$search_text='',$perpage=0,$offset=0)
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
   
   public function export_import()
    {
        if(isset($_POST['type']))
        {
        if($_POST['type']=='export')
        {        
         $data['results']=  $this->db->query("SELECT * from sch_school where area_id=".$_POST['area']."")->result_array();   
         $this->load->view('school_export_view',$data);
        }
        //############Import School data#############
        else{
            $area_notmatch="";
          if(!empty($_FILES['importfile']['name']))
            {                 		 
              if(copy($_FILES['importfile']['tmp_name'],$this->droot."/public/schoolimport/".$_FILES['importfile']['name']))
              {
                  $csv_file ="$this->droot/public/schoolimport/".$_FILES['importfile']['name']; // Name of your CSV file
                  $csvfile = fopen($csv_file, 'r');
                  $theData = fgets($csvfile);  //must be this line for import CSV
                  
                  $column_array = explode(",", $theData);
                  $column_error="";
                  //print_r($column_array);die;
                  if($column_array[0]!='Id' || $column_array[1]!='School Name' || $column_array[2]!='Seourl' || $column_array[3]!='Owner Name' || $column_array[4]!='Email' || $column_array[5]!='Address' || $column_array[6]!='Contact' || $column_array[7]!='Board' || $column_array[8]!='Category' || $column_array[9]!='Subcategory' || $column_array[10]!='StateId' || $column_array[11]!='AreaId' || $column_array[12]!='Location' || $column_array[13]!='Latitude')
                  {
                      $column_error="yes";
                      $data['column_error']="yes";
                  }                  
                  
                  if(count($column_array)!=15)
                  {
                      //$data['invalid_col']="invalid_col";  
                      $column_error="yes";
                      $data['column_error']="yes";
                  }
            if($column_error=="")      
            {
        while (($data = fgetcsv($csvfile, 1000, ",")) !== FALSE)
        {   
            $email=preg_replace('/\s+/', '',$data[4]);
            $email=strtolower($email);                
            $num=$this->db->query("SELECT * from sch_user where email='".$email."'")->num_rows();
            
            $address=mysql_real_escape_string(ucfirst($data[5]));
            
             $school_name=mysql_real_escape_string(ucwords(strtolower($data[1])));
             
             $seo_url= str_replace(' ', '-', trim($school_name));             
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '', strtolower($seo_url));  
                          $area_notmatch="";
           if($data[0]!='')
           {            
              
              if($_POST['area']==$data[11])
               {
                  $ress3=$this->db->query("SELECT user_id from sch_school where id='".$data[0]."'")->row_array();
                  $this->db->query("UPDATE sch_user set owner_name='".$data[3]."' where id=".$ress3['user_id']."");
                  
                  $seo_url2=$data[2];
               $query="UPDATE sch_school set seo_url='".$seo_url2."',school_name='".$school_name."',address ='".$address."',contact ='".$data[6]."',board ='".$data[7]."',category ='".$data[8]."',sub_category ='".$data[9]."',state_id ='".$data[10]."',area_id ='".$data[11]."',location ='".$data[12]."',latitude ='".$data[13]."',langitude ='".$data[14]."' where id=".$data[0]."";
               //echo $query;
               $column_error="";
              $this->db->query($query);
               }else{
                   $column_error="yes";
                   $area_notmatch="yes";                   
               }
              // 
                                       
           
           }//If email available
           else{
               if($_POST['area']==$data[11])
               {
                  // 
                 $num=$this->db->query("SELECT * from sch_user where email='".$email."'")->num_rows();
                // $num=0;
                  
                 if($num==0 || $email=='')
                 {
                    // echo $data[11];die;
                     $num1=$this->db->query("SELECT * from sch_zone where location='".$data[12]."'")->num_rows();
                     
                      $location=ucfirst($data[12]);
                      
                    if($num1==0)
                    {                        
                     $this->db->query("INSERT into sch_zone(zone_locationid,location) values('$data[11]','$location')");
                    }
                
                  $res=$this->db->query("select * from sch_zone where zone_id=".$data[10]."")->row_array();
                  $state= $res['name'];
                  $res=$this->db->query("select * from sch_zone where zone_id=".$data[11]."")->row_array();
                  $area= $res['cityname'];                  
                
                  $owner_name=str_replace("'","",$data[3]);
                
                 $password=md5('school121');
                 $reg_date=date("Y-m-d",time());             
                $this->db->query("INSERT into sch_user(email,owner_name,contact_no,password,user_type,reg_date,status) values('$email','$owner_name','$data[6]','$password','school','$reg_date',1)");           
                
                $insert_id= $this->db->insert_id();    
                //$insert_id=11;
              
                $seo_url2=$seo_url;
                if($data[2]!='')
                {
                    $seo_url2=$data[2];
                }
                
                //
                $board=str_replace("-","",strtolower($data[7]));
                $category=str_replace("-","",strtolower($data[8]));
                $sub_category=str_replace("-","",strtolower($data[9]));
                
           
         $query="INSERT into sch_school(user_id,school_name,board,category,sub_category,contact,email,address,state_id,state_name,area_id,area_name,location,latitude,langitude,reg_date,status) values"
           . "($insert_id,"
           . "'$school_name',"
           . "'$board',"
           . "'$category',"
           . "'$sub_category',"
           . "'$data[6]',"
           . "'$email',"
           . "'$address',"
           . "'$data[10]',"
           . "'$state','$data[11]','$area','$location','$data[13]','$data[14]',"
           . "'$reg_date',1)";       
             //echo $query."<br>";     
             $this->db->query($query);
             $sch_insert_id= $this->db->insert_id();  
             $num2=$this->db->query("SELECT * from sch_school where seo_url='".$seo_url2."'")->num_rows();
             if($num2>0)
             {   
                $this->db->query("UPDATE sch_school set seo_url='".$seo_url2.$sch_insert_id."' where id=$sch_insert_id");
                 }else{$this->db->query("UPDATE sch_school set seo_url='".$seo_url2."' where id=$sch_insert_id");}
             
                 }//Email exist
                // else{echo "Email Exist:".$email."<br>";}                 
               }
               
              }
        }
        fclose($csvfile);
                  if($column_error==''){            
                  $data['sucess_msg']="Record has been Imported.";
                  }
            }
              }
            
            
          }
            }
            $data['area_notmatch']=$area_notmatch;
            $this->load->view('school_importexport_view',$data);
         
        }else{ 
        
            $data['test']="test";        
            $this->load->view('school_importexport_view',$data);
        }
        
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
   
   public function multidelete()
   {
       //print_r($_POST);die;
       
       for($i=0;$i<count($_POST['columnechck']);$i++)
     {
       $schoolid=$_POST['columnechck'][$i];
       
       $ress=$this->db->query("SELECT * from sch_school where id=".$schoolid."")->row_array();      
       
       //echo "DELETE from sch_user where id=".$ress['user_id']."";
       $this->db->query("DELETE from sch_user where id=".$ress['user_id']."");
       //echo "DELETE from sch_school where id=".$schoolid.""."<br>";
        $this->db->query("DELETE from sch_school where id=".$schoolid."");
        
                          $this->db->query("DELETE from sch_school_event where school_id=".$schoolid."");
                          $this->db->query("DELETE from sch_school_image where school_id=".$schoolid."");
                          $this->db->query("DELETE from sch_school_job where school_id=".$schoolid."");
                          $this->db->query("DELETE from sch_payment_inventory where school_id=".$schoolid."");
                          $this->db->query("DELETE from sch_school_noticeboard where school_id=".$schoolid."");
                           $this->db->query("DELETE from sch_school_managment where school_id=".$schoolid."");
                           $this->db->query("DELETE from sch_admissionapply where school_id=".$schoolid."");
       
     }	
     
     redirect($_POST['deletecurl']."&delete=y");
       
   }
 
}
 