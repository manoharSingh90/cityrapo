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
	public function uniqueNumber($mobileNo)
	{
      $query =  $this->db->where('host_mob_no',$mobileNo)
			              ->get('users');
					return $query->result();	  
	}
    
   
    public function register_final($status,$otp,$pass)
	{
      return $this->db->set('status', $status)
                      ->set('host_password',$pass)
                      ->set('otp',$otp) 
                      ->where('otp', $otp) 
                      ->update('users');
                      
	}
	
	//=========== mobile number unique by robin on 23-01-19===============//
	public function register($data)
	{
       return $this->db->insert('users',$data);
	}
	//=========== END::on 23-01-19 =================//
	
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
                return $query->row();
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
   	                    //->where('status','1')
						->order_by("state_name", "asc")
   	                    ->get();
   	       return $query->result();

   }

   public function get_city($state_id){

   	$query =   $this->db->select('*')
   	                    ->from('city')
   	                   // ->where('status','1')
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
	
  public function updateUser_hostStatus($id){
       $data = array('admin_status'=>4,'created_at'=>date('y-m-d h:s'));
		  $this->db->set('admin_status','admin_status',false);
		  $this->db->where('id',$id);
		  $this->db->update('users',$data);
	   
	  }
	  
public function check_pass( $id , $password ){
		$query = $this->db->where('id', $id)
		           ->where('host_password' , $password)
		           ->get('users');
		   if($query->num_rows() > 0){
	      	// echo "<pre>";
	      	 return $query->result();
	      	//return $query->row()->id;
	          	//return TRUE;
	          }else{
	          	return FALSE;
	          }   

	}
	
public function update_pass( $id , $new_password){
		return $this->db->set('host_password',$new_password)
		                ->where('id',$id)
		                ->update('users');

	}
	
public function fetch_status($email){
	$sqldata = $this->db->select('id,admin_status,host_first_name,host_last_name,host_email')
	                    ->from('users')
						->where('admin_status!=',0)
						->where('host_email',$email)
						->get();
			return $sqldata->result();			
}

public function updatePassWord($email,$randpass,$id){
	//$data = array('host_password'=>$randpass);
	$this->db->set('host_password',$randpass)
	         ->where('host_email',$email)
			 ->where('id',$id)
	         ->update('users');
	return 'pass_success';
}

public function fetchInterestData(){
	$data = $this->db->select('*')
	              ->from('my_interest')
				  ->get();
			return $data->result();	  
}

public function fetchAllCities(){
	$citydata = $this->db->select('*')
	              ->from('city')
				  ->get();
			return $citydata->result();	
	
}

//======= Social login user exist or not function =============//
public function checkUserEmail($emailId){
	$condition = array('host_email'=>$emailId);
	$sqlData = $this->db->select('*')
	                    ->from('users')
						->where($condition)
						->get();
			return 	$sqlData->result();		
}

//========= Insert Social Data function ==========//
public function insertSocialData($insertdata){
	$sqlData = $this->db->insert('users' , $insertdata);
	 return $sqlData;
}

//=========== fetch Social data ============//
public function fetchSocialData($providerType,$userMailId,$providerId){
	
 $data = array('host_email'=>$userMailId,'provider_type'=>$providerType,'provider_id'=>$providerId);
 
 $sqlQuery = $this->db->select('*')
                      ->from('users')
					  ->where($data)
					  ->get();
		return $sqlQuery->result();			  
}

public function social_login_update($mobile,$iam,$hostid){
	$data = array('host_mob_no'=>$mobile,'i_am'=>$iam);
	$this->db->set($data)
	         ->where('id',$hostid)
			 ->update('users');
	return "update_success";		 
}

//======== function start for iwl comnucation languages =======//
public function fetchIwlLanguage(){
	$data = $this->db->select('*')
	                 ->from('iwl_languages')
					 ->get();
			return $data->result();		 
}

public function fetchTermsConditions(){
	
	$dataSet = $this->db->select('*')
	                    ->from('terms_condition')
                        ->get();
                return $dataSet->result();						
}

//============= Contact Query Form Function Start==========//
public function insertContactData($data){
	$this->db->insert('contacts',$data);
	return true;
}

//========= get user old password =======//
public function getOldPassword($id,$email){
	$dataSet = $this->db->select('*')
	                    ->from('users')
						->where(['id'=>$id,'host_email'=>$email])
                        ->get();
                return $dataSet->result();
}

//========= Update Reset Password ==========//
public function updateResetPass($userId,$userEmail,$newPass){
	$data = array('host_password'=>$newPass);
	$this->db->set($data)
	         ->where(['id'=>$userId,'host_email'=>$userEmail])
			 ->update('users');
	return true;	
}


//=========== set expire reset pass time function =========//
public function updateExpPassTime($timeVal,$email_id){
	$dataset = array('exp_pass_time'=>$timeVal);
	$this->db->set($dataset)
	         ->where(['host_email'=>$email_id])
			 ->update('users');
	return true;
}


}

?>