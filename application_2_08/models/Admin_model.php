<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_model extends CI_Model
{
	 function __construct(){ 
        parent::__construct(); 
        $this->load->database(); 
    }
	
	public function fetchAdminData($email = null, $pass= null){
	  
	  $conditions = array('email'=>$email,'password'=>md5($pass));
	  $sql = $this->db->select('id,name,email,password,status,admin_type')
	                  ->from('admin')
					  ->where($conditions)					 
					  ->get();
		  return $sql->result();			  
	}
	
	public function fetchUserItineries($param){
	     //$adminStatus = array('1', '2','3','4');		 
		$sqlset = $this->db->select('creates_itinerary.*,users_profile.user_id,users_profile.services_offered,
		                            users_profile.host_verification_type, users.host_first_name AS HOST_F_NAME, users.host_last_name AS HOST_L_NAME, users.host_mob_no AS HOST_MOBILE, users.host_email AS HOST_EMAIL')
	                  ->from('creates_itinerary')
					  ->join('users_profile','users_profile.user_id = creates_itinerary.user_id')
					  ->join('users','users.id = creates_itinerary.user_id')
					 //->where_in('creates_itinerary.admin_status', $adminStatus)
					 ->where($param)
					 ->order_by('id','desc')
					  ->get();
		  return $sqlset->result();
		}
		
  public function fetchApprovedItineries($param){	     
		$sqlset = $this->db->select('creates_itinerary.*,users_profile.user_id,users_profile.services_offered,
		                            users_profile.host_verification_type, users.host_first_name AS HOST_F_NAME, users.host_last_name AS HOST_L_NAME, users.host_mob_no AS HOST_MOBILE, users.host_email AS HOST_EMAIL')
	                  ->from('creates_itinerary')
					  ->join('users_profile','users_profile.user_id = creates_itinerary.user_id')
					  ->join('users','users.id = creates_itinerary.user_id')
					 //->where('creates_itinerary.admin_status', 5)					
					 //->or_where('creates_itinerary.admin_status', 6)
					  ->where($param)
					  ->order_by('id','desc')
					 ->get();
		  return $sqlset->result();
		}
	
 public function fetchDisabledItinerary($itinerary_id){	     
		$sqlset = $this->db->select('creates_itinerary.*')
	                  ->from('creates_itinerary')									
					 ->where('creates_itinerary.admin_status', 6)
					 ->where('creates_itinerary.id', $itinerary_id)
					 ->get();
		  return $sqlset->result();
		}
		
		
	public function fetchRequest($param){		
		 $query = $this->db->select('users.*,users_profile.id,users_profile.user_id,users_profile.city,users_profile.services_offered')
		                     ->from('users')
							 ->join('users_profile','users.id = users_profile.user_id')
							 ->where($param)
							 ->order_by("users.id", "desc")
							 ->get();
					return $query->result();
			
		}
	
	//============ search filter function =============//
	public function searchfetchRequest($status){			   
			 $query = $this->db->select('users.*,users_profile.id,users_profile.user_id,users_profile.city,users_profile.services_offered')
		                     ->from('users')
							 ->join('users_profile','users.id = users_profile.user_id')
							 ->where('users.admin_status!=',5)
							 ->where('users.admin_status',$status)
							 ->get();
					return $query->result();	
			
		}
 //=============== End search filter ==================//		
		
	public function fetchHostEmail($hostId){
		 $sqldata = $this->db->select('id,host_email,host_first_name,host_last_name,host_mob_no,host_password')
		                     ->from('users')
							 ->where('id',$hostId)
							 ->get();
		  return $sqldata->result();
		}
	/*	
	public function fetchAdminEmail_old($hostId){
		 $sqldata = $this->db->select('email')
		                     ->from('admin')
							 ->where('id',$hostId)
							 ->get();
		  return $sqldata->row();
		}
*/
		public function fetchAdminEmail($table,$field,$con)   {
      $data = $this->db
                    ->select($field)
                    ->from($table)
                    ->where($con)
                    ->get();
        $result = $data->row();
           return ($data->num_rows() >0)?$result->$field:FALSE;
    }

		
   public function updateHostStatus($hostid,$status){
	      $data = array('admin_status'=>$status);
		 // $this->db->set('admin_status','admin_status',false);
		  $this->db->where('id',$hostid);
		  $this->db->update('users',$data);
		  return 'success';
	   }
	   
	public function rejectionHostMail($id,$reason){
	      date_default_timezone_set('Asia/Calcutta'); 
		  $date = date("Y-m-d h:i:s"); 
	      $data = array('user_id'=>$id,'reason'=>$reason,'created_at'=>$date);
		  $this->db->insert('host_reason_history',$data);
		  
		}
		
	public function hostHistory($id){
		   $sqlData = $this->db->select('*')
		                       ->from('host_reason_history')
							   ->where('user_id',$id)
							   ->where('reason_status',0)
							   ->get();
				return $sqlData->result();		   
		}
		
  public function getHostProfile($id){      
	   $sqlData = $this->db->select('*')
	                    ->from('users_profile')
						->join('users','users_profile.user_id = users.id')
						->where('user_id',$id)
						->get();
				return $sqlData->result();		
	  }

 //============= START:: HOST HISTORY Updated status function =============//
 public function updateHostHistory($id,$reasonstatus){
          date_default_timezone_set('Asia/Calcutta'); 
		  $date = date("Y-m-d h:i:s"); 
	     $data = array('reason_status'=>$reasonstatus,'created_at'=>$date);		
		  $this->db->where('user_id',$id);
		  $this->db->update('host_reason_history',$data);
		  return 'success';
	 }	  
//============= END:: HOST HISTORY Updated status function =============//

 public function fetchAllHost($param){
	  $sqlquery = $this->db->select('users.*,users_profile.id,users_profile.user_id,users_profile.city,users_profile.services_offered,
	                                users_profile.host_verification_type,users_profile.verified_by')
		                     ->from('users')
							 ->join('users_profile','users.id = users_profile.user_id')
							 ->where($param)
							 ->order_by("users.id", "desc")
							 ->get();
					return $sqlquery->result();
	 }
	 
 public function updateHostProfile($id,$veriftype,$verified,$guidebadge,$hostTypeStatus){
	   $data = array('host_verification_type'=>$veriftype,'verified_by'=>$verified,'guide_badges'=>$guidebadge,
	   'host_type_status'=>$hostTypeStatus);	   
	   $this->db->where('user_id',$id);
	   $this->db->update('users_profile',$data);
	 }
	 
 public function fetchHostProfiles($id){
	  $sqldata = $this->db->select('users.id,users.host_first_name,users.host_last_name,users.host_mob_no,users.host_email,users.i_am,
	                               users.admin_status,users_profile.id,users_profile.user_id,users_profile.profile_picture,
								   users_profile.gender,users_profile.nationality,users_profile.date_of_birth,users_profile.description,
								   users_profile.permanent_address_1,users_profile.permanent_address_2,users_profile.permanent_address_3,
								   users_profile.state,users_profile.city,users_profile.pin_code,users_profile.associated_companies,
								   users_profile.company_name,users_profile.company_address_1,users_profile.company_address_2,users_profile.company_state,
								   users_profile.company_city,users_profile.company_pin_code,users_profile.interest,users_profile.services_offered,
								   users_profile.preferred_cities,users_profile.host_before,users_profile.preferred_languages,users_profile.known_languages,
								   users_profile.host_verification_type,users_profile.verified_by,users_profile.adhaar_number,
								   users_profile.adhaar_number_doc,users_profile.pan_number,users_profile.pan_number_doc,users_profile.passport_number,
								   users_profile.passport_number_doc,users_profile.license_guide_number,users_profile.license_guide_number_doc,
								   users_profile.gst_pin,users_profile.gst_pin_doc,users_profile.tmp_address_1,users_profile.tmp_address_2,users_profile.tmp_address_3,users_profile.tmp_state,users_profile.tmp_city,users_profile.tmp_pin_code')
							->from('users')
							->join('users_profile','users.id = users_profile.user_id')
							->where('users.admin_status',5)
							->where('users_profile.user_id',$id)
							->get();
							
				return $sqldata->result();			
	 }
	 
 public function fetchAllCities(){
	  $sqlData = $this->db->select('id,city_name')
	                      ->from('city')
						  ->get();
				return $sqlData->result();		  
	 }
	 
	 
//============= login status ================//

 public function getLoginStatus($loginUserid){
	$queryData = $this->db->select('id,admin_status')
	                      ->from('users')
						  ->where('id',$loginUserid)
						  ->get();
			return $queryData->result();			  
	
  }
//============= END:: login status ===========//

//============ START Itinerary Request function =============//
public function fetchRequestItinerary($itineraryId){
	
	$sqlData = $this->db->select('*')
	                    ->from('creates_itinerary')
						->where('id',$itineraryId)
						->get();
				return $sqlData->result();		
}

public function gethostId($id){
	$sqlData = $this->db->select('id,user_id')
	                    ->from('creates_itinerary')
						->where('id',$id)
						->get();
				return $sqlData->result();
	
}

public function updateItineraryStatus($itineraryId,$status){
	
	 $data = array('admin_status'=>$status);
	 $this->db->where('id',$itineraryId);
	 $this->db->update('creates_itinerary',$data);	 
	 return 'success';
}

public function fetchAllItinerary($hostId){   
		
	$sqldata = $this->db->select('*')
	                    ->from('creates_itinerary')
						->where('user_id',$hostId)
						//->where($conditions)
						->get();
						
			return $sqldata->result();			
}


//========== search itineraries function start on 09-02-19 =========//
public function fetchSearch_AllItinerary($hostId,$serviceId,$themesid){
	 
	 $conditions = "user_id='$hostId' AND service_id='$serviceId'";
	 if(isset($themesid) && $themesid!=''){
		 $conditions .= " AND FIND_IN_SET('$themesid',itinerary_theme)";
		 }
	$sqldata = $this->db->select('*')
	                    ->from('creates_itinerary')
						->where($conditions)						
						->get();
						
			return $sqldata->result();			
}

//========== load search itineraries function start on 09-02-19 =========//
public function loadSearch_AllItinerary($userId,$page,$serviceId){
	 $offset = 4*$page;
     $limit = 4;
	 $conditions = "user_id ='$userId' and service_id ='$serviceId' limit $offset ,$limit";
	 $sqldata = $this->db->select('*')
	                    ->from('creates_itinerary')
						->where($conditions)						
						->get();
						
			return $sqldata->result();			
}


//========= host selected services unction =================//
public function getUserServices($hostId){
	$dataSql = $this->db->select('id,services_offered')
	                    ->from('users_profile')
						->where('user_id',$hostId)
						->get();
						
			return $dataSql->result();
	
}

public function getServices(){
	  $data = $this->db->select('*')
	                   ->from('main_category')
					   ->get();
				return $data->result();	   
	 }

public function insertItineraryHistory($insertitinerary){
	$this->db->insert('itinerary_reason_history',$insertitinerary);
}

public function fetchHostRows(){
	
	$datasql = $this->db->select('*')
	                ->from('users')
					->where('notify_status',0)
					->where('admin_status!=',5)
					//->where('host_password!=','')
					->get();
			return $datasql->num_rows();		
}

public function updateNotiyStatus(){
	$data = array('notify_status'=>1);
	$this->db->where('notify_status',0);
	$this->db->update('users',$data);	
	return 'success';
}

public function fetchItineraryRows(){
	
	$datasql = $this->db->select('*')
	                ->from('creates_itinerary')
					->where('itinerary_notify_status',0)
					->where('admin_status',1)					
					->get();
			return $datasql->num_rows();		
}

public function updateitinerary_NotiyStatus(){
	$data = array('itinerary_notify_status'=>1);
	$this->db->where('itinerary_notify_status',0);
	$this->db->update('creates_itinerary',$data);	
	return 'success';
}



public function updateMailStatus($itinerary_id,$chkval){
	$data = array('mail_for_admin'=>$chkval);
	$this->db->where('id',$itinerary_id);
	$this->db->update('creates_itinerary',$data);	
	return 'success';
}
	
public function saveRatingValue($itineraryId,$rating){
	$data = array('rating'=>$rating);
	$this->db->where('id',$itineraryId);
	$this->db->update('creates_itinerary',$data);	
	return 'success';
}

public function updatetranslator_type($transvalue,$itinerary_id,$serviceid){	
	$data = array('translator_type'=>$transvalue);	
	$this->db->where('id',$itinerary_id);
	$this->db->update('creates_itinerary',$data);	
	return 'success';
}

public function fetchReasonHistory($itineraryId){
	
	$sqlData = $this->db->select('*')
	                    ->from('itinerary_reason_history')
						->where('itinerary_id',$itineraryId)
						->order_by('id','desc')
						->get();
				return $sqlData->result();		
}

public function fetchHostType(){
	$queryData = $this->db->select('*')
	                      ->from('host_type')
						  ->get();
		return $queryData->result();		  
	
}

//========== translator data function ============//

public function fetchTranslatorItineries($param){	     
		$sqlset = $this->db->select('creates_itinerary.*,users_profile.user_id,users_profile.services_offered')
	                  ->from('creates_itinerary')
					  ->join('users_profile','users_profile.user_id = creates_itinerary.user_id')
					 //->where('creates_itinerary.admin_status', 5)					
					 //->or_where('creates_itinerary.admin_status', 6)
					  ->where($param)
					 ->get();
		  return $sqlset->result();
		}
		

//======= Translator update itinerary =========//
public function translatorUpdateItinerary($itineraryUpdateArr,$otherlang,$itinerary_id){
	
	$data = array('other_category_type'=>$itineraryUpdateArr['other_category_type'],
	               'origin_other_city'=>$itineraryUpdateArr['origin_other_city'],'itinerary_other_title'=>$itineraryUpdateArr['itinerary_other_title'],'itinerary_other_tagline'=>$itineraryUpdateArr['itinerary_other_tagline'],'other_itinerary_description'=>$itineraryUpdateArr['other_itinerary_description'],'translator_confirm'=>$itineraryUpdateArr['translator_confirm']);				   
				   $this->db->where('id',$itinerary_id);
				   $this->db->update('creates_itinerary',$data);
			}

//=========== Translator all Itinerary Func. ===============//
    public function fetchTranslatorAllItineries($param){
        $sqlset = $this->db->select('creates_itinerary.*,users_profile.user_id,users_profile.services_offered')
            ->from('creates_itinerary')
            ->join('users_profile','users_profile.user_id = creates_itinerary.user_id')            
            ->where($param)
            ->get();
        return $sqlset->result();
    }
	
public function fetchMailerData(){
	$data = $this->db->select('*')
	                ->from('iwl_mailer')
					->get();
		return $data->result();			
}

public function gethostLanguages($hostId){	   
		$sqlquery = $this->db->select('id,user_id,category_type,preferred_languages,known_languages')
		                     ->from('users_profile')
							 ->where('user_id',$hostId)
							 ->get();
							 
					return $sqlquery->result();		 
	  }
	  
	  
//========== Get User Data function ============//

public function getUserData($itinerary_id){
	$data = $this->db->select('users.id,users.host_first_name,users.host_last_name,users.host_email')
	                 ->from('users')
					 ->join('creates_itinerary','creates_itinerary.user_id = users.id')
					 ->where('creates_itinerary.id',$itinerary_id)
					 ->get();
		return $data->result();				 
}

public function getField($table,$field,$con)
        {
           $data = $this->db
                        ->select($field)
                        ->from($table)
                        ->where($con)
                        ->get();
            $result = $data->row();
            return ($data->num_rows() >0)?$result->$field:FALSE;
        }

}	




