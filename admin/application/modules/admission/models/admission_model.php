<?php 
class Admission_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
        $this->droot=$_SERVER['DOCUMENT_ROOT']."/schoolz";    
        
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
        function add_testimonial()
        {
            $image="";
          if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/worthimage/".$image);
            }
            
            $title= mysql_real_escape_string($_POST['title']);                       
            $short_content= mysql_real_escape_string($_POST['short_content']); 
            $content= $_POST['content'];            
            
        
	  $data=array(                          
                        'title'=>$title,
                        'short_content'=>$short_content,
                        'content'=>$content,
                        'image'=>$image
		           );	          
				$query=$this->db->insert('sch_testimonials',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_admission()
	{   
        
           $image="";
          if(!empty($_FILES['applicant_image']['name']))
            {
                 $image=str_replace("'","",$_FILES['applicant_image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['applicant_image']['tmp_name'],$this->droot."/public/applicantimage/".$image);
            }else{$image=$_POST['hidden_image'];}
            
            $dob=$_POST['date']."/".$_POST['month']."/".$_POST['year'];
        
	    $data=array(   
                            'fname'=>mysql_real_escape_string($_POST['fname']),
                            'mname'=>mysql_real_escape_string($_POST['mname']),                     
                            'lname'=>mysql_real_escape_string($_POST['lname']), 
                            'dob'=>$dob,
                            'age'=>mysql_real_escape_string($_POST['age']),
                            'gender'=>mysql_real_escape_string($_POST['gender']),
                            'raddress'=>mysql_real_escape_string($_POST['raddress']),
                            'pincode'=>mysql_real_escape_string($_POST['pincode']),
                            'contactno'=>mysql_real_escape_string($_POST['contactno']),
                            'rdistance'=>mysql_real_escape_string($_POST['rdistance']),
                            'family_income'=>mysql_real_escape_string($_POST['family_income']),
                            'religion'=>mysql_real_escape_string($_POST['religion']),
                            'father_name'=>mysql_real_escape_string($_POST['father_name']),
                            'father_qualify'=>mysql_real_escape_string($_POST['father_qualify']),
                           'father_occupation'=>mysql_real_escape_string($_POST['father_occupation']),
                           'father_designation'=>mysql_real_escape_string($_POST['father_designation']),
                           'father_mobile'=>mysql_real_escape_string($_POST['father_mobile']),
                           'father_phone'=>mysql_real_escape_string($_POST['father_phone']),
                           'father_ofc_address'=>mysql_real_escape_string($_POST['father_ofc_address']),
                           'father_monthly_income'=>mysql_real_escape_string($_POST['father_monthly_income']),
                           'mother_name'=>mysql_real_escape_string($_POST['mother_name']),
                           'mother_qualify'=>mysql_real_escape_string($_POST['mother_qualify']),
                           'mother_occupation'=>mysql_real_escape_string($_POST['mother_occupation']),
                           'mother_designation'=>mysql_real_escape_string($_POST['mother_designation']),
                           'mother_phone'=>mysql_real_escape_string($_POST['mother_phone']),
                           'mother_mobile'=>mysql_real_escape_string($_POST['mother_mobile']),
                           'mother_ofc_address'=>mysql_real_escape_string($_POST['mother_ofc_address']),
                 'mother_monthly_income'=>mysql_real_escape_string($_POST['mother_monthly_income']),
                  'applicantimage'=>$image          
		           );
				   $this->db->where('id',$_POST['admission_id']);
				   $query=$this->db->update('sch_school_admission',$data);
                    
                                 
	}
}
	