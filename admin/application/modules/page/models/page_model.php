<?php 
class Page_model extends CI_Model 
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
        function add_page()
        {
            
            $page_title= mysql_real_escape_string($_POST['page_title']);            
            $meta_title= mysql_real_escape_string($_POST['meta_title']);            
            $meta_keyword= mysql_real_escape_string($_POST['meta_keyword']);            
            $meta_description= mysql_real_escape_string($_POST['meta_description']); 
            $short_content= mysql_real_escape_string($_POST['short_content']); 
            $content= $_POST['content'];  
            
            $seo_url= str_replace(' ', '-', strtolower($_POST['page_title'])); // Replaces all spaces with hyphens.
             $seo_url= str_replace('&', 'and', strtolower($seo_url));
            // $seo_url=preg_replace('/[^A-Za-z0-9\-]/', '', $seo_url);
            
        
	  $data=array(  
                        'seo_url'=>$seo_url,
                        'page_title'=>$page_title,
			'meta_title'=>$meta_title,
                        'meta_keyword'=>$meta_keyword,
                        'meta_description'=>$meta_description,
                        'content'=>$content,
                        'ord'=>$_POST['ord'],
                        'display_area'=>$_POST['display_area']
		           );	          
				$query=$this->db->insert('sch_pages',$data);
        }
        
        /*====================================================================
	 #####################Update Event ########################
	 ====================================================================*/

   function update_page()
	{
            $page_title= mysql_real_escape_string($_POST['page_title']);            
            $meta_title= mysql_real_escape_string($_POST['meta_title']);            
            $meta_keyword= mysql_real_escape_string($_POST['meta_keyword']);            
            $meta_description= mysql_real_escape_string($_POST['meta_description']);  
            $short_content= mysql_real_escape_string($_POST['short_content']); 
            $content= $_POST['content'];            
            
             $seo_url= str_replace(' ', '-', strtolower($_POST['page_title'])); // Replaces all spaces with hyphens.
             $seo_url= str_replace('&', 'and', strtolower($seo_url));
             //$seo_url=preg_replace('/[^A-Za-z0-9\-]/', '', $seo_url);
	  $data=array( 
                        'seo_url'=>$seo_url,   
                        'page_title'=>$page_title,
			'meta_title'=>$meta_title,
                        'meta_keyword'=>$meta_keyword,
                        'meta_description'=>$meta_description,
                        'content'=>$content,
                         'ord'=>$_POST['ord'],
                        'display_area'=>$_POST['display_area']
		           );
				   $this->db->where('id',$_POST['page_id']);
				   $query=$this->db->update('sch_pages',$data);
                    
                                 
	}
}
	