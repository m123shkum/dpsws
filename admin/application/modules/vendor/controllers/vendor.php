<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Vendor extends MX_Controller {
 public $droot = "";
  function __construct()
       {
           parent::__construct();
                   
		   $this->load->model('Vendor_model');
		   $this->load->library('pagination');		   
                  //$this->load->helper('language');
                  $this->load->helper(array('ckeditor','language'));
                  $this->lang->load('form_validation','english');
                   $this->droot=DocumentRoot;  
                  $this->load->driver('cache');
                  
        }
   /*==================================================================
   #############################Home###################################
   ===================================================================*/		
   public function index($sort_by='date',$perpage=0,$offset=0)
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
						$perpage=10;
						$data['perpage']='';
					}
					if($sort_by=='date-asc')
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
					$numrosw=$this->db->query("select * from sch_vendor_details")->num_rows();
					
					$config['base_url'] = base_url()."vendor/index/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_vendor_details $order limit $offset,$limit")->result_array();
				   $this->load->view('vendor_home',$data);
			
			
			
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
            $numrosw=$this->db->query("select * from sch_vendor_details where (vendor_name like '%".$search_text."%' OR business_name  like '%".$search_text."%' or emailid like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."vendor/search/$search_text";                
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
		   $data['results']=$this->db->query("select * from sch_vendor_details where ( vendor_name like '%".$search_text."%' OR business_name  like '%".$search_text."%' or emailid like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	       $this->load->view('vendor_home',$data);
			
		}
   }
   	/*====================================================================
	 #####################Add Users########################
	 ====================================================================*/
    public function add()
    {    
         $data['states']=$this->Vendor_model->allstates();
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['vendorRegister'])) {
                                            
                                            $chk=$this->db->query("select * from sch_user where email='".$_POST['email']."'")->num_rows();
                                             if($chk > 0)
						{
                                                 $data['exist_error'] = "This Email-id is already exist !";
                                                 
                                                  $this->load->view('vendor_add',$data);
                                                
                                                }
                                            else{
						
					      $this->Vendor_model->add_vendor();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> New Vendor added successfully..! </div>');
					     redirect('vendor');
                                            }
					}
					else
					{
					 $this->load->view('vendor_add',$data);
					}
		
	}        
    
	 /*====================================================================
	 #####################Edit Users########################
	 ====================================================================*/
   function edit($sid='')
    {        $data['states']=$this->Vendor_model->allstates();
             
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
                                    $data['payment_array']=array();
                                    
	                 $data['results']=$this->Vendor_model->recordById($sid);
                         
                         $result=$this->Vendor_model->recordById($sid);                         
                         $data['area_result']=$this->Vendor_model->area_by_state($result['state_id']);
                         $data['location_result']=$this->Vendor_model->location_by_area($result['area_id']);
		         
                         $data['vendor_time']=$this->Vendor_model->oneRowbyField("sch_vendor_timing","vendor_id",$result['id']);   
                         $data['payment_array']=explode(",",$result['card_accepted']);
                         
                         $this->load->view('vendor_edit',$data);
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
			              
                        if(isset($_POST['vendorUpdate'])) 
                        {                       
				 $this->Vendor_model->update_vendor();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('vendor','refresh');
                                               
                        }                        
				
			
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function delete() {
		  if(isset($_POST['delid']))
		  {
                      $res=$this->db->query("select user_id from sch_vendor_details where id=".$_POST['delid']."")->row_array();
			  $this->db->query("DELETE from sch_vendor_details where id=".$_POST['delid']."");
                          $this->db->query("DELETE from sch_vendor_pictures where vendor_id=".$_POST['delid']."");
                          
                          $this->db->query("DELETE from sch_user where id=".$res['user_id']."");
                          
                          $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been deleted successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('vendor','refresh');
		  }
		  
	}
        function changeStatus() 
        {
		  if(isset($_POST['uid']))
		  {
                      $res=$this->db->query("select user_id from sch_vendor_details where id=".$_POST['uid']."")->row_array();
                      
                      $data=array(	 
				  'status'=>$_POST['statustype'],
		                 );
				   $this->db->where('id',$res['user_id']);
				   $query=$this->db->update('sch_user',$data);
                                   
                      
			  $data=array(	 
					 'status'=>$_POST['statustype'],
		                      );	
		
				   $this->db->where('id',$_POST['uid']);
				   $query=$this->db->update('sch_vendor_details',$data);	  
			  
			  $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success !</strong> Status updated successfully..! </div>');
			   redirect($_POST['curl']);
		  }
		  else
		  {
			    redirect('vendor','refresh');
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
        			
	
        //Gallery Function
        function gallery($vendor_id,$sort_by='name',$perpage=0,$offset=0)
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
					$numrosw=$this->db->query("select * from sch_vendor_pictures where vendor_id=$vendor_id")->num_rows();
					
					$config['base_url'] = base_url()."vendor/gallery/$vendor_id/$sort_by/$perpage";                
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
				   $data['results']=$this->db->query("select * from sch_vendor_pictures where vendor_id=$vendor_id $order limit $offset,$limit")->result_array();
				   $data['vendor_id']=$vendor_id; 
                                   //$data['row']=$this->School_model->oneRecordById($school_id,"sch_school");
                                   $this->load->view('gallery_home',$data);
			
			
			
		}
        }
        
        
    
    public function addgallery($vendor_id)
    {    
         
        if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
			$uid=$this->session->userdata('userid');			
					if(isset($_POST['galleryForm'])) {                                           						
						
					      $this->Vendor_model->add_gallery();	
					      $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success! </strong>Gallery has been added successfully..! </div>');
					     redirect('vendor/gallery/'.$vendor_id);
					}
					else
					{                                            
                                         $data['vendor_id']=$vendor_id;   
					 $this->load->view('gallery_add',$data);
					}
					
			  
			
		
	}        
    
	 /*====================================================================
	 #####################Edit Gallery########################
	 ====================================================================*/
	 function editgallery($vendor_id='',$image_id){                  
             
	 if(!$this->session->userdata('userid'))
		{
			
			redirect('user/login');
		}
		else
		{
				if($vendor_id=='' || $image_id=='')
				{
					redirect('admin');
				}
				else
				{
	                 $data['results']=$this->Vendor_model->oneRecordById($image_id,"sch_vendor_pictures");
                         $data['vendor_id']=$vendor_id;
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
				 $this->Vendor_model->update_gallery();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Records has been updated successfully..! </div>');
				  redirect('vendor/gallery/'.$_POST['vendor_id']);
                                               
                        }                        
				
			
   }
   
   public function searchgallery($vendor_id,$search_text='',$perpage=0,$offset=0)
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
            $numrosw=$this->db->query("select * from sch_vendor_pictures where (image_title like '%".$search_text."%')")->num_rows();
            
			$config['base_url'] = base_url()."vendor/searchgallery/$vendor_id/$search_text/$perpage";                
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
		   $data['results']=$this->db->query("select * from sch_vendor_pictures where (image_title like '%".$search_text."%') order by id desc limit $offset,$limit")->result_array();
	         
                  $data['vendor_id']=$vendor_id;  
                  $this->load->view('gallery_home',$data);
			
		}
   }

				
	/*====================================================================
	 #####################Delete Users#####################
	 ====================================================================*/
    function deletegallery() {
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
        
        //###########Payment#########
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
                         $data['payments']=$this->db->query("SELECT * from sch_vendor_payment_inventory where vendor_id=$sid")->result_array();         
	                 $data['results']=$this->Vendor_model->recordById($sid);                    
                         $result=$this->Vendor_model->recordById($sid);                             
                         $this->load->view('vendor_payment',$data);
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
				 $this->Vendor_model->update_payment();	
				 $this->session->set_flashdata('success', '<div style="line-height: 0;height: 23px; padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> Payment has been updated successfully..! </div>');
				  
                                  redirect('vendor/payment/'.$_POST['vendor_id']);
                                               
                        }                        
				
			
       }
       
       public function export_vendor()
   {
       $data['results']=  $this->db->query("SELECT * from sch_vendor_details")->result_array();
       
       $this->load->view('vendor_export_view',$data);
       
   }
   
    public function import_vendor()
   {
       if(isset($_POST['importForm']))
       {
         //$importfile="importdata.csv";
          if(!empty($_FILES['importfile']['name']))
            {                 		 
              if(copy($_FILES['importfile']['tmp_name'],$this->droot."/public/vendorimport/".$_FILES['importfile']['name']))
              {
                  $csv_file ="$this->droot/public/vendorimport/".$_FILES['importfile']['name']; // Name of your CSV file
                  $csvfile = fopen($csv_file, 'r');
                  $theData = fgets($csvfile);  //must be this line for import CSV
                  
        while (($data = fgetcsv($csvfile, 1000, ",")) !== FALSE)
        {   
            $email=preg_replace('/\s+/', '',$data[2]);
            $email=strtolower($email);                
            $num=$this->db->query("SELECT * from sch_user where email='".$email."'")->num_rows();
            
            $vendorname=mysql_real_escape_string($data[1]);
            $keywords=mysql_real_escape_string($data[3]);
            $contact=mysql_real_escape_string($data[4]);
            $businessname=mysql_real_escape_string($data[5]);
            $street=mysql_real_escape_string($data[6]);
                         
           if($num>0)
           {            
            if($data[2]!='')
            {    
                $this->db->query("UPDATE sch_vendor_details set vendor_name ='".$vendorname."',mobileno='".$contact."',street ='".$street."',business_name ='".$businessname."',state_id ='".$data[7]."',area_id ='".$data[8]."',location ='".$data[9]."' where id=".$data[0]."");            
            }   
            
           }//If email available
           else{
                 $num=$this->db->query("SELECT * from sch_user where email='".$email."'")->num_rows();
                 if($num==0)
                 {
                     $num1=$this->db->query("SELECT * from sch_zone where location='".$data[9]."'")->num_rows();
                     
                      $location=ucfirst($data[9]);
                      
                    if($num1==0)
                    {                        
                     $this->db->query("INSERT into sch_zone(zone_locationid,location) values('$data[8]','$location')");
                    }
                    
                   
               
                  $res=$this->db->query("select * from sch_zone where zone_id=".$data[7]."")->row_array();
                  if(count($res)>0)
                  {
                   $state= $res['name'];
                  }else{$state="";}
                  
                  $res=$this->db->query("select * from sch_zone where zone_id=".$data[8]."")->row_array();                  
                  if(count($res)>0)
                  {
                   $area= $res['cityname'];
                  }else{$area="";}
                  $area= $res['cityname'];                  
                
                
                 $password=md5('password');
                 $reg_date=date("Y-m-d",time());             
                $this->db->query("INSERT into sch_user(email,owner_name,contact_no,password,user_type,reg_date) values('$email','$data[1]','$contact','$password','vendor','$reg_date')");           
                $insert_id= $this->db->insert_id();    
              
           
         $query="INSERT into sch_vendor_details(user_id,vendor_name,mobileno,emailid,business_name ,street,state_id,state_name,area_id,area_name,location,reg_date,status) values"
           . "($insert_id,"
           . "'$vendorname',"
           . "'$contact',"
           . "'$email',"
           . "'$businessname',"
           . "'$street',"
           . "'$data[7]',"
           . "'$state',"
           . "'$data[8]',"
           . "'$area','$location',"
           . "'$reg_date',1)";       
             //echo $query;
            // mysql_query($query);
              $this->db->query($query);
                 }//Email exist
                 else{echo "Email Exist:".$email."<br>";}
                 
               }
        }
        
                  
              }
            }
            
            
            $data['sucess_msg']="Record has been Imported.";
            fclose($csvfile);
       }
       $data['test']="test";
       $this->load->view('vendor_import_view',$data);
       
   }
 
}
 