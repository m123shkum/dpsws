<?php 
class Vendor_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');
        $this->droot=DocumentRoot;     
        
    }
	/*====================================================================
	 ###################Get Commor record ##################
	 ====================================================================*/
       
        function allstates()
	{
	 $res=$this->db->query("select * from sch_zone where country_id=99 and status=1");
	 return $res->result_array();
	}
	function area_by_state($state_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_cityid=".$state_id." and status=1");
	 return $res->result_array();
	}
        function location_by_area($area_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_locationid=".$area_id." and status=1");
	 return $res->result_array();
	}
                
        
	function recordById($uid)
	{
	 $res=$this->db->query("select * from sch_vendor_details where id=$uid");
	 return $res->row_array();
	}	
        
        
        //One single record BY Id
        function oneRecordById($id,$table)
	{
	 $res=$this->db->query("select * from $table where id=$id");
	 return $res->row_array();
	}
        function oneRowbyField($table,$field,$val)
        {
            $res=$this->db->query("select * from $table where $field=$val");
	   return $res->row_array();
        }
	
        
        //#######Update Payment#########
        function update_payment()
        {
            if($_POST['duration']=='3month')
            {
                $mth=3;
            }
            if($_POST['duration']=='6month')
            {
                $mth=6;
            }
            if($_POST['duration']=='1year')
            {
                $mth=12;
            }
            if($_POST['duration']=='2year')
            {
                $mth=24;
            }
            
            $expdate=strtotime($_POST['start_date']."+$mth month");
            $expdate=date("Y-m-d",$expdate);
            
            $arr=explode("/",$_POST['start_date']);
            $stdate=$arr[2]."-".$arr[0]."-".$arr[1];
            
            //echo $stdate.$expdate;die;
            
            $data=array(
                        'vendor_id'=>$_POST['vendor_id'], 
                        'amount'=>$_POST['amount'], 
                        'start_date'=>$stdate, 
                        'expiry_date'=>$expdate, 
                        'duration'=>$_POST['duration'],      
                                       );
            
                                   $query=$this->db->insert('sch_vendor_payment_inventory',$data);
                                   
            $data2=array(
                        'Ispaid'=>"y",  
                        'expirydate'=>$expdate,
                        'status'=>1
                        );             
            
                                   $this->db->where('id',$_POST['vendor_id']);
				   $query=$this->db->update('sch_vendor_details',$data2);
            $data3=array(
                        'Ispaid'=>"y",
                        'status'=>1
                         );             
            
                                   $this->db->where('id',$_POST['vendoruser_id']);
				   $query=$this->db->update('sch_user',$data3);                       
            
        }
        
        
        
	
	/*====================================================================
	 #####################Update Vendor########################
	 ====================================================================*/
         function add_vendor()
	{
	     $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['state']."")->row_array();
             $state= $res['name'];
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['area']."")->row_array();
             $area= $res['cityname'];
             
             $location= $_POST['location'];
             
              $mon=$tue=$wed=$thu=$fri= $sat= $sun="";
            if(isset($_POST['mon']))
		   {
		    $mon=$_POST['start_montime']."=".$_POST['end_montime'];
		   }
		   if(isset($_POST['tue']))
		   {
		    $tue=$_POST['start_tuetime']."=".$_POST['end_tuetime'];
		   }
		   if(isset($_POST['wed']))
		   {
		    $wed=$_POST['start_wedtime']."=".$_POST['end_wedtime'];
		   }
		   if(isset($_POST['thu']))
		   {
		    $thu=$_POST['start_thutime']."=".$_POST['end_thutime'];
		   }
		   if(isset($_POST['fri']))
		   {
		    $fri=$_POST['start_fritime']."=".$_POST['end_fritime'];
		   }
		   if(isset($_POST['sat']))
		   {
		    $sat=$_POST['start_sattime']."=".$_POST['end_sattime'];
		   }
		   if(isset($_POST['sun']))
		   {
		    $sun=$_POST['start_suntime']."=".$_POST['end_suntime'];
		   }
                   //echo count($_POST['payment']);die;
                   //Payment checked
                   $card_accepted="";
                   $allcard="";
                   if(isset($_POST['selectall']))
                   {
                      $card_accepted="Cash,Master Card,Visa Card,Debit Cards,Money Orders,Cheques,Credit Card";
                      $allcard="all";
                   }else{
                       if(isset($_POST['payment']))
                       {
                       for($i=0;$i<count($_POST['payment']);$i++)
                       {
                           if($i<count($_POST['payment'])-1)
                           {
                            $dot=",";
                           }else{$dot="";}
                           
                           $card_accepted=$card_accepted.$_POST['payment'][$i].$dot;
                       }
                       }
                   }                  
                   
                   $data=array( 'email'=>mysql_real_escape_string($_POST['email']),		
                                'owner_name'=>	mysql_real_escape_string($_POST['owner_name']),		
                                'password'=>md5($_POST['password']),
                                'user_type'=>'vendor',
                                'reg_date'=>date("Y-m-d",time()),
                                'verified'=>'y',
                                'status'=>1,
		           );		  
                   $query=$this->db->insert('sch_user',$data);
                   $user_insertid=$this->db->insert_id();
                   
             $data=array(
                        'user_id'=>$user_insertid,
                        'vendor_name'=>mysql_real_escape_string($_POST['designation']),
                        'designation'=>mysql_real_escape_string($_POST['owner_name']), 
                        'mobileno'=>mysql_real_escape_string($_POST['mobileno']), 
                        'landline'=>mysql_real_escape_string($_POST['landline']),
                        'fax_no'=>mysql_real_escape_string($_POST['fax_no']),
                        'fax_no2'=>mysql_real_escape_string($_POST['fax_no2']), 
                        'toll_free_number'=>mysql_real_escape_string($_POST['toll_free_number']), 
                        'toll_free_number2'=>mysql_real_escape_string($_POST['toll_free_number2']), 
                        'emailid'=>mysql_real_escape_string($_POST['email']), 
                        'website'=>mysql_real_escape_string($_POST['website']), 
                        'card_accepted'=>$card_accepted, 
                        'allcard'=>$allcard, 
                        'year_estb'=>mysql_real_escape_string($_POST['year_estb']), 
                        'annual_turnover'=>$_POST['annual_turnover'], 
                        'noe'=>$_POST['noe'], 
                        'prof_assoc'=>$_POST['prof_assoc'], 
                        'certification'=>$_POST['certification'], 
                        'keywords'=>$_POST['keywords'], 
                        'reg_date'=>date("Y-m-d",time()),
                        'business_name'=>mysql_real_escape_string($_POST['business_name']), 
                        'building'=>mysql_real_escape_string($_POST['building']), 
                        'street'=>mysql_real_escape_string($_POST['street']),
                        'landmark'=>mysql_real_escape_string($_POST['landmark']), 
                        'pincode'=>$_POST['pincode'], 
                        'state_id'=>$_POST['state'],  
                        'state_name'=>$state,  
                        'area_id'=>$_POST['area'],  
                        'area_name'=>$area, 
                        'location'=>$location,
                        'status'=>1, 
                               );                            
		
                 $query=$this->db->insert('sch_vendor_details',$data);
                 $insert_vendorid=$this->db->insert_id();
                //Update vendor timing
                   $data=array(
                                   'vendor_id'=>$insert_vendorid,							
					'mon'=>	$mon,		
					'tue'=>	$tue,		
					'wed'=>	$wed,		
					'thu'=>	$thu,		
					'fri'=>	$fri,
					'sat'=>	$sat,
					'sun'=>	$sun
		           );		  
                   $query=$this->db->insert('sch_vendor_timing',$data);
                  
                   //
                    
                                 
	}

   function update_vendor()
	{
	     $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['state']."")->row_array();
             $state= $res['name'];
             $res=$this->db->query("select * from sch_zone where zone_id=".$_POST['area']."")->row_array();
             $area= $res['cityname'];
             
             $location= $_POST['location'];
             
              $mon=$tue=$wed=$thu=$fri= $sat= $sun="";
            if(isset($_POST['mon']))
		   {
		    $mon=$_POST['start_montime']."=".$_POST['end_montime'];
		   }
		   if(isset($_POST['tue']))
		   {
		    $tue=$_POST['start_tuetime']."=".$_POST['end_tuetime'];
		   }
		   if(isset($_POST['wed']))
		   {
		    $wed=$_POST['start_wedtime']."=".$_POST['end_wedtime'];
		   }
		   if(isset($_POST['thu']))
		   {
		    $thu=$_POST['start_thutime']."=".$_POST['end_thutime'];
		   }
		   if(isset($_POST['fri']))
		   {
		    $fri=$_POST['start_fritime']."=".$_POST['end_fritime'];
		   }
		   if(isset($_POST['sat']))
		   {
		    $sat=$_POST['start_sattime']."=".$_POST['end_sattime'];
		   }
		   if(isset($_POST['sun']))
		   {
		    $sun=$_POST['start_suntime']."=".$_POST['end_suntime'];
		   }
                   //echo count($_POST['payment']);die;
                   //Payment checked
                   $card_accepted="";
                   $allcard="";
                   if(isset($_POST['selectall']))
                   {
                      $card_accepted="Cash,Master Card,Visa Card,Debit Cards,Money Orders,Cheques,Credit Card";
                      $allcard="all";
                   }else{
                       if(isset($_POST['payment']))
                       {
                       for($i=0;$i<count($_POST['payment']);$i++)
                       {
                           if($i<count($_POST['payment'])-1)
                           {
                            $dot=",";
                           }else{$dot="";}
                           
                           $card_accepted=$card_accepted.$_POST['payment'][$i].$dot;
                       }
                       }
                   }                  
                   
                   //Update vendor timing
                   $data=array(	
					'vendor_id'=>$_POST['vendor_id'],							
					'mon'=>	$mon,		
					'tue'=>	$tue,		
					'wed'=>	$wed,		
					'thu'=>	$thu,		
					'fri'=>	$fri,
					'sat'=>	$sat,
					'sun'=>	$sun
		           );
		  if($_POST['time_num']==0)
                  {                   
                   $query=$this->db->insert('sch_vendor_timing',$data);
                  }else{
                      $this->db->where('vendor_id',$_POST['vendor_id']);
                      $this->db->update('sch_vendor_timing',$data);
                  }
                   //
             
             $data=array(
                        'designation'=>mysql_real_escape_string($_POST['designation']), 
                        'mobileno'=>mysql_real_escape_string($_POST['mobileno']), 
                        'landline'=>mysql_real_escape_string($_POST['landline']),
                        'fax_no'=>mysql_real_escape_string($_POST['fax_no']),
                        'fax_no2'=>mysql_real_escape_string($_POST['fax_no2']), 
                        'toll_free_number'=>mysql_real_escape_string($_POST['toll_free_number']), 
                        'toll_free_number2'=>mysql_real_escape_string($_POST['toll_free_number2']), 
                        'emailid'=>mysql_real_escape_string($_POST['email']), 
                        'website'=>mysql_real_escape_string($_POST['website']), 
                        'card_accepted'=>$card_accepted, 
                        'allcard'=>$allcard, 
                        'year_estb'=>mysql_real_escape_string($_POST['year_estb']), 
                        'annual_turnover'=>$_POST['annual_turnover'], 
                        'noe'=>$_POST['noe'], 
                        'prof_assoc'=>$_POST['prof_assoc'], 
                        'certification'=>$_POST['certification'], 
                        'keywords'=>$_POST['keywords'], 
                 
                        'business_name'=>mysql_real_escape_string($_POST['business_name']), 
                        'building'=>mysql_real_escape_string($_POST['building']), 
                        'street'=>mysql_real_escape_string($_POST['street']),
                        'landmark'=>mysql_real_escape_string($_POST['landmark']), 
                        'pincode'=>$_POST['pincode'], 
                        'state_id'=>$_POST['state'],  
                        'state_name'=>$state,  
                        'area_id'=>$_POST['area'],  
                        'area_name'=>$area, 
                        'location'=>$location                            
                               );               
             
		$this->db->where('id',$_POST['vendor_id']);
                $this->db->update('sch_vendor_details',$data);
                
                
                //User Table update
                      if($_POST['password']!='') 
                      {
                        $data=array(  
                            'owner_name'=>mysql_real_escape_string($_POST['owner_name']), 
                            'email'=>mysql_real_escape_string($_POST['email']), 
                        'contact_no'=>$_POST['mobileno'], 
                        'password'=>md5($_POST['password'])
                                       );
                      }else{
                          $data=array(  
                              'owner_name'=>mysql_real_escape_string($_POST['owner_name']), 
                              'email'=>mysql_real_escape_string($_POST['email']), 
                              'contact_no'=>$_POST['mobileno'],                                                                                              
                                       );
                      }
                                   $this->db->where('id',$_POST['vendoruser_id']);
				   $query=$this->db->update('sch_user',$data);
                    
                                 
	}
        
       
        
        /*====================================================================
	 #####################Add Event########################
	 ====================================================================*/
        function add_gallery()
        {
            
            if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/vendorimage/".$image);
            }
            $image_title= mysql_real_escape_string($_POST['image_title']);                        
        
	  $data=array(  
                        'vendor_id'=>$_POST['vendor_id'],
                        'image_title'=>$image_title,
			'image'=>$image,                        
		           );	          
				$query=$this->db->insert('sch_vendor_pictures',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_gallery()
	{
            $image=$_POST['hidden_image'];
	    if(!empty($_FILES['image']['name']))
            {
                 $image=str_replace("'","",$_FILES['image']['name']);
		 $image=str_replace("'","",$image);
		 $image=str_replace("/","",$image);
		 $image=str_replace(" ","",$image);
		 $image=str_replace("%","",$image);		 
		 $image=rand()."_".$image;		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/vendorimage/".$image);
         @unlink($this->droot."/public/vendorimage/".$_POST['hidden_image']);                       
            }
            
            $image_title= mysql_real_escape_string($_POST['image_title']);                        
        
	    $data=array(
                        'image_title'=>$image_title,
			'image'=>$image                        
		           );
				   $this->db->where('id',$_POST['image_id']);
				   $query=$this->db->update('sch_vendor_pictures',$data);
                    
                                 
	}       
       
}
	