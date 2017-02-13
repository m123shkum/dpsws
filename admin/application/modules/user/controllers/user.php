<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class User extends MX_Controller {
 
    function __construct()
       {
           parent::__construct();
		   $this->load->model('User_model');
		   $this->load->library('pagination');
		   $this->load->helper('url');	
                   $this->load->driver('cache');
                   $this->clear_cache();
        }
  
  function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
  
   public function index()
   {
      $this->load->view('login_view');
   }
   
   public function home()
   {
	   $totalusers=$this->db->query("select * from sch_user ")->num_rows();
       $totalregisteredvendor=$this->db->query("select * from sch_user where user_type='vendor'")->num_rows();
       $totalregisteredschool=$this->db->query("select * from sch_user where user_type='school'")->num_rows();
       $totalregisteredparent=$this->db->query("select * from sch_user where user_type='teacher'")->num_rows();
	   if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
		else{
	       $data['totalusers']=$totalusers;
                $data['totalregisteredparent']=$totalregisteredparent;
                $data['totalregisteredschool']=$totalregisteredschool;
                $data['totalregisteredvendor']=$totalregisteredvendor;
	      $this->load->view('home_view',$data);
		}
   }
  
  
  public function login()
	{	
	  //check session user
		if($this->session->userdata('userid'))
		{
			redirect('user/home');
		}
	  if(isset($_POST['userLogin']))
		{
		 $email=  mysql_real_escape_string($_POST['email']);	
		 $password=md5(mysql_real_escape_string($_POST['password']));
		 
		 $query=$this->db->query("select * from sch_admin where email='".$email."' and password='".$password."'");	
		 
		 if($query->num_rows>0)
			{
				//=======upadte last login===================
				 // date_default_timezone_set('Asia/Calcutta');
				 $current_date = date('Y-m-d H:i:s');
				 $last_login=array('last_login'=>$current_date);   
				 //$this->db->where('email',$email);
                                 //$this->db->update('users',$last_login);
				//===========================================
				$res=$query->row_array();				
				$this->session->set_userdata('userid',$res['id']);				
                                $this->session->set_userdata('emailid',$res['email']);	
				$this->session->set_userdata('user_name',$res['username']);	
				$this->session->set_userdata('user_type',$res['user_type']);	
				if(isset($_POST['remember']))
	            {		  
	                 setcookie("emailid", $email, time()+3600);
	                 setcookie("userpasw", $_POST['password'], time()+3600);
	            }
	            else
				{
		             if(isset($_COOKIE['emailid']))
			         {
				      setcookie("emailid", $email, time()-3600);
	                  setcookie("userpasw", $_POST['password'], time()-3600);
			         }
		         }	
				     $this->session->set_flashdata('success', '<div class="alert alert-success"> <strong>Success!</strong>You have successfully logged in.</div>');	
				     redirect('user/home');
				
			}else{
				   
				     $this->session->set_flashdata('err', '<div style="background-color: #f2dede;line-height: 0;height: 23px;
    padding-left: 17px;" class="alert alert-info"><strong>Error!</strong> Incorrect login details email / password ! </div>');
					 redirect('user/login');
				 }
		 
		}
		else{
			
	              $this->load->view('user/login_view');
	  }		
	}        
	
	
        
        
    public function forgotpassword()
	{
		if($this->session->userdata('userid'))
		{
			redirect('myaccount');
		}
		
		  $this->load->view('user/forgot_view');
	}
	public function forgot() {
		if(isset($_POST['email']))
		{
	      $email=$_POST['email'];			
			
			$query=$this->db->query("select * from sch_admin where email='".$email."'");
			
			if($query->num_rows>0)
			{
				$res=$query->row_array();		
				
				$passwd=$res['password'];
				$owner_name=$res['username'];	
				$contact_email=$res['email'];		

			 //Mail ******* 
			   $subject = "Password reset for your Schoolz admin"; 
               $headers = "From: Schoolz<vikash.ranjan@aksinteractive.com>\r\n";   
               $headers .= 'MIME-Version: 1.0' . "\r\n";
               $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";                       
				
				$body = "<table width='700' align='center' cellspacing='0' cellpadding='10' border='0' bgcolor='#FFFFFF' style='border:1px solid #e0e0e0'>
	<tbody>
    	<tr><td><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='375' valign='middle' style='background:#ffd500; text-align:center; color:#fff; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9pt; min-height: 45.75pt;'></td>
  </tr>
</table></td>
		</tr><tr><td><p>Hello ".ucwords($owner_name)."!! Your password has been reset with a temporary password.  For security, we recommend you to change your password after log in.</p>		
		<p>&nbsp;</p><p>Email : ".$email."</p><p>Temporary Password: ".$passwd."</p>
                <p>&nbsp;</p><p><strong>Regards,</strong></p><p>Schoolz Team</p>E: info@schoolz.com<br /></p></td></tr><tr><td height='15px;'>&nbsp;</td></tr><tr><td bgcolor='#000' align='center' style='color:#fff;text-align:center'><p style='font-size:12px;margin:0'>Thank you</p></td></tr></tbody></table>";
               @mail($email, $subject, $body ,$headers);
			   
			    $this->session->set_flashdata('err', '<div class="alert alert-success"> <strong>Success!</strong> Your password has been sent to your email address.</div>');	
				 redirect('user/login');
					 
     	}
		else
		{
			  $this->session->set_flashdata('err', '<div style="background-color: #f2dede;line-height: 0;height: 23px;
    padding-left: 17px;" class="alert alert-info"> This email address does not exist in the database.</div>');
		     redirect('user/forgotpassword');
		}
		}
	else
	{
		redirect('user/login');
	}
 }
 
   //Change password
  public function accountUpdate()
  {      
     if(isset($_POST['account']))
     {
        if($_POST['old_password']!='' && $_POST['new_password']!='') 
        {
            $password=md5($_POST['old_password']);
            $new_password=md5($_POST['new_password']);
             $query=$this->db->query("select * from sch_admin where password='".$password."'");	
            if($query->num_rows>0)
	    {   
               $this->db->query("UPDATE sch_admin set password='".$new_password."' where id=".$_POST['users_id']."");  
               $data['success']="Password has been changed ! ";
            }else{                
		$data['error']=	"Old password did not match ! ";
            }
            $data['user_data']=$this->User_model->recordById($this->session->userdata('userid'));
            $this->load->view('user/account_view',$data);   
        }else{         
            $this->db->query("UPDATE sch_admin set username='".$_POST['name']."',email='".$_POST['email']."',contact_email1='".$_POST['contact_email1']."',contact_email2='".$_POST['contact_email2']."' where id=".$_POST['users_id']."");  
            $data['success']="Account has been successfully updated ! ";
            $data['user_data']=$this->User_model->recordById($this->session->userdata('userid'));
            $this->load->view('user/account_view',$data); 
          }
     }
  }
   public function account()
	{	
	  //check session user
		if(!$this->session->userdata('userid'))
		{
			redirect('user/login');
		}
	  if(isset($_POST['changepwd']))
		{
		 $email=  mysql_real_escape_string($_POST['email']);	
		 $password=md5(mysql_real_escape_string($_POST['password']));
		 
		 $query=$this->db->query("select * from sch_admin where email='".$email."' and password='".$password."'");	
		 
		 if($query->num_rows>0)
			{
				//=======upadte last login===================
				 // date_default_timezone_set('Asia/Calcutta');
				 $current_date = date('Y-m-d H:i:s');
				 $last_login=array('last_login'=>$current_date);   
				 //$this->db->where('email',$email);
                                 //$this->db->update('users',$last_login);
				//===========================================
				$res=$query->row_array();				
				$this->session->set_userdata('userid',$res['id']);				
                                $this->session->set_userdata('emailid',$res['email']);	
				$this->session->set_userdata('user_name',$res['username']);	
				$this->session->set_userdata('user_type',$res['user_type']);	
				if(isset($_POST['remember']))
	            {		  
	                 setcookie("emailid", $email, time()+3600);
	                 setcookie("userpasw", $_POST['password'], time()+3600);
	            }
	            else
				{
		             if(isset($_COOKIE['emailid']))
			         {
				      setcookie("emailid", $email, time()-3600);
	                  setcookie("userpasw", $_POST['password'], time()-3600);
			         }
		         }	
				     $this->session->set_flashdata('success', '<div class="alert alert-success"> <strong>Success!</strong>You have successfully logged in.</div>');	
				     redirect('user/account');
				
			}else{
				   
				     $this->session->set_flashdata('err', '<div style="background-color: #f2dede;line-height: 0;height: 23px;
    padding-left: 17px;" class="alert alert-info"><strong>Error!</strong> Incorrect login details email / password ! </div>');
					 redirect('user/account');
				 }
		 
		}
		else{
			
	            $data['user_data']=$this->User_model->recordById($this->session->userdata('userid'));
                    $this->load->view('user/account_view',$data);
	          }		
	}     
        
        
        public function logout()
	{   
            $ss=$this->session->userdata('userid');
           unset($ss);
           
            $this->session->unset_userdata('userid');
            $this->session->unset_userdata('emailid');            
            $this->session->sess_destroy();
            $this->cache->clean();
            
	
	$this->session->set_flashdata('err', '<div style="background-color: #f2dede;line-height: 0;height: 23px;
    padding-left: 17px;" class="alert alert-success"><strong>Success!</strong> You have successfully logout. ! </div>');
	redirect('user/login','refresh');
        
	}
   
}

 
/* End of file hmvc.php */
/* Location: ./application/widgets/hmvc/controllers/hmvc.php */
