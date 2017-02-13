<?php 
class Marketrequest_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
        $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz"; 
        
        $res=$this->db->query("select * from sch_admin where id=1")->row_array();
        $this->configemail=$res['contact_email1'];
        
        $this->load->library('email');
         $config = array (
                  'mailtype' => 'html',
                  'charset'  => 'utf-8',
                  'priority' => '1'
                   );
           $this->email->initialize($config);
        
    }
	/*====================================================================
	 ###################Get Common record ##################
	 ====================================================================*/
        //One single record BY Id
        function oneRecordById($id,$table)
	{
	 $res=$this->db->query("select * from $table where id=$id");
	 return $res->row_array();
	}
	
        /*====================================================================
	 #####################Add Gallery ########################
	 ====================================================================*/
        function save_reply()
        {
            
            $reply_message= mysql_real_escape_string($_POST['reply_message']);                       
            $email=$_POST['marketbuy_email'];
            $name=$_POST['marketbuy_name'];
            
	      $data=array(              
                          'reply_status'=>'done',
                          'reply_text'=>$reply_message                        
		         );	          
				
                                   $this->db->where('id',$_POST['marketbuy_id']);
				   $query=$this->db->update('sch_marketbuy',$data);
                                   
                    //############# Mail Template############               
				
				$body = "<table width='700' align='center' cellspacing='0' cellpadding='10' border='0' bgcolor='#FFFFFF' style='border:1px solid #e0e0e0'>
	<tbody>
    	<tr><td style='background:#ffd900;'><table width='100%' border='0' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='375' style='text-align:center; color:#bb1313; font-weight:bold; font-family:Arial; font-size:16px;'></td>
    <td align='center'><img src='".base_url()."public/images/logo.png'/></td>
  </tr>
</table></td>
		</tr>
        <tr><td>&nbsp;</td></tr>        
        <tr><td>
		
		<p>Dear ".$name.",</p>		
		<p>".$_POST['reply_message']."</p>
                <p>&nbsp;</p>
				<p>Regards,</p>
				<p>Schoolz Team</p>								
        </td></tr>
        
<tr><td height='15px;'>&nbsp;</td></tr>
<tr>
<td bgcolor='#ffd900' align='center' style='color:000;text-align:center'><p style='font-size:12px;margin:0'>Thank you</p></td></tr></tbody></table>";
              //mail($email, $subject, $body ,$headers);   
              
               $this->email->from($this->configemail, 'Schoolz');
			$this->email->to($email);
			$this->email->subject('Schoolz: Market request reply by admin');
			$this->email->message($body);
			$this->email->send();
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_caf()
	{   
        
	    $data=array(                          
                        'caf_name'=>mysql_real_escape_string($_POST['caf_name']),
                        'caf_fathername'=>mysql_real_escape_string($_POST['caf_fathername']),
                        'caf_mothername'=>mysql_real_escape_string($_POST['caf_mothername']),
                        'caf_email'=>mysql_real_escape_string($_POST['caf_email']),
                        'caf_contctno'=>mysql_real_escape_string($_POST['caf_contctno']),
                'caf_details'=>mysql_real_escape_string($_POST['caf_details']),
                'reg_date'=>date("Y-m-d",time())
                
		           );
				   $this->db->where('id',$_POST['caf_id']);
				   $query=$this->db->update('sch_caf',$data);
                    
                                 
	}
}
	