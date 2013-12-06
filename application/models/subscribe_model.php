<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe_model extends CI_Model {

	public function set_access_token( $data )
	{
		$this->db->insert('instagram_auth', $data);	
	}

	public function get_access_token()
	{
		$token = "";
		$query = $this->db->query('SELECT * FROM instagram_auth ORDER BY id DESC LIMIT 1');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $token = $row->access_token;
		   
		   if(!$token){
		   		$token ='';
		   }
		}
		
		return $token;
	}



	public function set_hashtag( $data )
	{
		$this->db->insert('instagram_hashtag', $data);	;
	}

	public function get_hashtag()
	{
		$hash = "";
	
		$query = $this->db->query('SELECT * FROM instagram_hashtag ORDER BY id DESC  LIMIT 1');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $hash = $row->hashtag;
		   
		   if(!$hash){
		   		$hash ='';
		   }
		}
		
		return $hash;
	}



	public function min_id(){
	
		$min_id = null;
	
		$query = $this->db->query('SELECT * FROM instagram_feed ORDER BY c_time DESC');

		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
		   $min_id = $row->min_id;
		   if(!$min_id){
		   	$min_id ='';
		   }
		}
		
		return $min_id;

	}

	public function start_polling( ) {

	    $time = $this->input->post( 'time' );
	    if( !is_numeric( $time ) ) {
	        return array();
	    }
		
	    while( true ) {

	        $this->db->select( '*' );
	        $this->db->from( 'instagram_feed' );

	       
	        $this->db->where( 'add_time >=',$time);
	        // add 2 minutes to time for moderation delay
	        $this->db->where( 'add_time < UNIX_TIMESTAMP(DATE_SUB(NOW(),INTERVAL 2 MINUTE))');

	        $this->db->where( 'banned', 0 );
	        $this->db->order_by( 'id', 'desc' );
	        $query = $this->db->get();

	        $photos = array();

	        if( $query->num_rows() > 0 ) {
	          
	            foreach($query->result_array() as $row)
			    {    
			         $photos[] = $row;
			    }
	            
	        }

	        return $photos;

	        sleep( 1 );
	    }
	}



	public function admin_start_polling( ) {

	    $time = $this->input->post( 'time' );
	    if( !is_numeric( $time ) ) {
	        return array();
	    }
		
	    while( true ) {

	        $this->db->select( '*' );
	        $this->db->from( 'instagram_feed' );
	        $this->db->where( 'add_time >=',$time);
	        $this->db->order_by( 'id', 'desc' );
	        $query = $this->db->get();

	        $photos = array();

	        if( $query->num_rows() > 0 ) {
	            
	            foreach($query->result_array() as $row)
			    {    
			         $photos[] = $row;
			    }
	            
	        }

	        return $photos;

	        sleep( 1 );
	    }
	}

	public function admin_list_all()
	{
		 $this->db->select( '*' );
	     $this->db->from( 'instagram_feed' );
	     $this->db->where( 'banned', 0 );
	     $this->db->order_by( 'id', 'desc' );

	     $query = $this->db->get();

	     $photos = array();

        if( $query->num_rows() > 0 ) {
            
            foreach($query->result_array() as $row)
		    {    
		         $photos[] = $row;
		    }

            
        }

        return $photos;
	}

	public function admin_ban_photo( $id )
	{
		$query = $this->db->query('UPDATE instagram_feed SET banned = 1 WHERE id = "'.$id.'"');

		return $query;

	}

	// public function for live frontend feed
	public function list_all()
	{
		 $this->db->select( '*' );
	     $this->db->from( 'instagram_feed' );
	     $this->db->order_by( 'id', 'desc' );
	     // add 2 minutes to time for moderation delay
		 $this->db->where( "add_time < UNIX_TIMESTAMP(DATE_SUB(NOW(),INTERVAL 2 MINUTE))" );

	     $this->db->where( 'banned', 0 );
	     $this->db->limit( 10 );
	     $query = $this->db->get();

	     $photos = array();

        if( $query->num_rows() > 0 ) {
            
            foreach($query->result_array() as $row)
		    {    
		         $photos[] = $row;
		    }

            
        }

        return $photos;
	}

	public function add_tag($data){
		
		$query = $this->db->get_where('instagram_feed', array('media_id'=>$data['media_id']));
		if($query->num_rows() > 0){
			return FALSE;	
		}else{
			$this->db->insert('instagram_feed', $data);	
		}

	}

}




?>