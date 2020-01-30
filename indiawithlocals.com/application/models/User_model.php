<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model 
{

	 function __construct(){ 
        parent::__construct(); 
        //$this->load->database(); 
    }

	//check register email
	public function register_valid($email)
	{
   
		$query = $this->db->where('host_email',$email )
			              ->get('users');

		    if($query->num_rows()){
		  
		      	return $query->row()->id;
		        
		    }else{

		        return FALSE;
		    }
	}

	//insert register data before check email id
	public function register($data)
	{
       return $this->db->insert('users',$data);
	}
    
   
    public function register_final($status,$otp,$pass)
	{
      return $this->db->set('status', $status)
                      ->set('host_password',$pass)
                      ->set('otp',$otp) 
                      ->where('otp', $otp) 
                      ->update('users');
                      
	}
	public function get_id($pass)
	{
		$query = $this->db->where('host_password',$pass )
			              ->get('users');

		    if($query->num_rows()){
		  
		      	return $query->row()->id;
		        
		    }else{

		        return FALSE;
		    }
	}
	public function profile_id_create($data)
	{
        return $this->db->insert('users_profile',$data);
	}

	// public function resent_otp($email)
	// {
	// 	return $this->db->where('host_email',$email)
	// 	         ->delete('users');  
	// }

	public function resend_otp($otp,$email)
	{
		return $this->db->set('otp',$otp)
		                ->where('host_email',$email)
		                ->update('users');

	}

	public function login_valid($email,$password)
	{
		$query = $this->db->where('host_email', $email)
		                  ->where('host_password' , $password)
		                  ->get('users');
	      if($query->num_rows()){
	      	//echo "<pre>";
	      	//print_r($q->result()); exit;
	      	return $query->row()->id;
	          	//return TRUE;
	          }else{
	          	return FALSE;
	          }
       
	}
	public function forgot_pass($email_id)
	{
      $query = $this->db->where('host_email',$email_id)
                        ->get('users');
               if($query->num_rows())
               {
                return $query->row()->host_password;
               }else{
                 return FALSE;
               }
	}

	public function find_profile( $id )
	{

	   $query = $this->db->select( '*' )
		                 ->from( 'users' )
		                 ->where( 'users.id' , $id )
		                 ->join( 'users_profile' , 'users_profile.user_id = users.id' )
		                 ->get();
		    return $query->row();
   }

   public function get_state(){

   	$query =  $this->db->select('*')
   	                    ->from('state')
   	                    ->where('status','1')
   	                    ->get();
   	       return $query->result();

   }

   public function get_city($state_id){

   	$query =   $this->db->select('*')
   	                    ->from('city')
   	                    ->where('status','1')
   	                    ->where('state_id',$state_id)
   	                    ->get();
   	       return $query->result();

   }

   public function check_user_id( $user_id )
	{
		$query = $this->db->where( 'user_id' , $user_id )
		                  ->get( 'users_profile' );
	    if($query->num_rows()){
	      	return $query->row()->id;  	
	    }else{
	        return FALSE;
	    }
	}

	public function user_update( $id , array $data_user )
	{
        return   $this->db->where( 'id' , $id )
                          ->update( 'users' , $data_user );
	}

	public function user_profile_update( $profile_id , array $data_user_profile )
	{
        return   $this->db->where( 'id' , $profile_id )
                          ->update( 'users_profile' , $data_user_profile );
	}

	public function user_profile_insert( $data_user_profile )
	{

        return $this->db->insert( 'users_profile' , $data_user_profile );

	}

	public function retrieveImg($user_id)
	{
		$query = $this->db->where('user_id',$user_id)
		          ->get('users_profile');

		    if($query->num_rows()){
	      	   return $query->row()->profile_picture;  	
	        }else{
	          return FALSE;
	        }
	}
	public function retrieveadhaar($user_id)
	{
		$query = $this->db->where('user_id',$user_id)
		          ->get('adhaar_number_doc');

		    if($query->num_rows()){
	      	   return $query->row()->adhaar_number_doc;  	
	        }else{
	          return FALSE;
	        }
	}
	public function removeImg($user_id ,array $img){
		
		return $this->db->where('user_id',$user_id)
		                ->update('users_profile',$img); 
       
	}
	public function removeadhaar($user_id ,array $adhaar){
		
		return $this->db->where('user_id',$user_id)
		                ->update('adhaaar_number_doc',$adhaar); 
       
	}
	
}

?>