<?php 
class News_model extends CI_Model 
{    public $droot = "";
   function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('thumb');       
        $this->droot=DocumentRoot; 
        
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
	
	
	      function location_by_area($area_id)
	{
	 $res=$this->db->query("select * from sch_zone where zone_locationid=".$area_id." and status=1 order by location asc");
	 return $res->result_array();
	}
        /*====================================================================
	 #####################Add Gallery ########################
	 ====================================================================*/
         function add_news()
        {
            
           $thumbimage="";
            if(!empty($_FILES['image']['name']))
            {
         $thumbimage=str_replace("'","",$_FILES['image']['name']);
		 $thumbimage=str_replace("'","",$thumbimage);
		 $thumbimage=str_replace("/","",$thumbimage);
		 $thumbimage=str_replace(" ","",$thumbimage);
		 $thumbimage=str_replace("%","",$thumbimage);
		 
		 $thumbimage=rand()."_".$thumbimage;
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$thumbimage);
         
            }
            
			$resss=$this->db->query("select * from sch_zone where zone_id=".$_POST['news_area']."")->row_array();
            $news_area= $resss['cityname'];
			
            $news_title= mysql_real_escape_string($_POST['news_title']);
            $description= $_POST['description'];
            
             $seo_url= str_replace(' ', '-', trim($_POST['news_title'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($seo_url));
            
	    $data=array( 
                        'news_seourl'=>$seo_url,
                        'news_title'=>$news_title,                        
                        'news_area'=>mysql_real_escape_string($_POST['news_area']),
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
						'news_id'=>$_POST['news_area'],
                        'news_area'=>$news_area,
                        'news_location'=>mysql_real_escape_string($_POST['news_location']),
			            'description'=>$description,
                        'image'=>$thumbimage                        
		           );
          
				$query=$this->db->insert('sch_news',$data);
        }
        
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_news()
	{
            $thumbimage="";
            if(!empty($_FILES['image']['name']))
            {
                 $thumbimage=str_replace("'","",$_FILES['image']['name']);
		 $thumbimage=str_replace("'","",$thumbimage);
		 $thumbimage=str_replace("/","",$thumbimage);
		 $thumbimage=str_replace(" ","",$thumbimage);
		 $thumbimage=str_replace("%","",$thumbimage);
		 
		 $thumbimage=rand()."_".$thumbimage;
		 
         copy($_FILES['image']['tmp_name'],$this->droot."/public/eventimage/".$thumbimage);
         
            }else{$thumbimage=$_POST['hidden_image'];}
            
            $news_title= mysql_real_escape_string($_POST['news_title']);
            $description= $_POST['description'];
            
             $seo_url= str_replace(' ', '-', trim($_POST['news_title'])); // Replaces all spaces with hyphens.
             $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '',strtolower($seo_url));
        
	   $data=array( 
                        'news_seourl'=>$seo_url,
                        'news_title'=>$news_title,                       
                        'news_area'=>mysql_real_escape_string($_POST['news_area']),
                        'short_description'=>mysql_real_escape_string($_POST['short_description']), 
			'description'=>$description,
                        'image'=>$thumbimage                        
		           );
				   $this->db->where('id',$_POST['news_id']);
				   $query=$this->db->update('sch_news',$data);
                    
                                 
	}
}
	