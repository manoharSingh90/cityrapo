<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Itinerarie_model extends CI_Model
{
	 function __construct(){ 
        parent::__construct(); 
        $this->load->database(); 
    }

    public function home_itineraries(){

    $query   =  $this->db->select('*')
                         ->from('users_walk_itinerary')
                         ->where('status','1')
    	                 ->get();
    	    return $query->result();
            //return $query->row();
			
    }
    public function details_itineraries($id){
        $query   =  $this->db->select('*')
                             ->where('id',$id)
                         ->from('users_walk_itinerary')
                         ->get();
            //return $query->result();
            return $query->row();

    }
    public function hoster_search($searchKeys,$searchDates){
         $query = $this->db->from('users_walk_itinerary')
                           ->where('status','1')
                      //->like('origin_city',$searchKeys)
                      //->where('start_date_from_host <= ',$searchDates)
                      //->where('end_date_to_host >= ',$searchDates)
                      ->like('start_date_from_host',$searchDates)
                      
                      ->get();
         return $query->result();


    }
    public function hoster_search_both($searchKeys,$searchDates){
         $query = $this->db->from('users_walk_itinerary')
                           ->where('status','1')
                           ->like('origin_city',$searchKeys)
                      //->where('start_date_from_host <= ',$searchDates)
                      //->where('end_date_to_host >= ',$searchDates)
                          ->like('start_date_from_host',$searchDates)
                      
                          ->get();
         return $query->result();


    }
    public function hoster_search_city($searchKeys){
        $query = $this->db->from('users_walk_itinerary')
                          ->where('status','1')
                      ->like('origin_city',$searchKeys) 
                      ->get();
         return $query->result();

    }

	public function findUser_city($userId){
		 $cityData = $this->db->from('users_profile')
		                      ->where('user_id',$userId)
							  ->join('city AS city1','users_profile.city = city1.id OR users_profile.company_city = city1.id')
							  ->get();

			//	echo"<pre>";print_r($cityData);die;
				return $cityData->result();			  
		}
		
	public function selectFeatures(){
		  $featureData = $this->db->select('id,feature_name')->from('features')->get();
		  return $featureData->result();
		}
	public function findFeatureTags($id = null){
		 $tagData = $this->db->select('id,tags_name')
		                 ->from('feature_tags')
						 ->where('feature_id',$id)
						 ->get();
				return $tagData->result();		 
		}
		
	public function selectLanguages($userId){
		$langData = $this->db->select('id,user_id,preferred_languages,known_languages')
		                      ->from('users_profile')
							  ->where('user_id',$userId)
							  ->get();
				return $langData->result();			  
		}
		
  public function gethostLanguages(){
	    $loginHostId = $this->session->userdata('id');
		$sqlquery = $this->db->select('id,user_id,category_type,preferred_languages,known_languages')
		                     ->from('users_profile')
							 ->where('user_id',$loginHostId)
							 ->get();
							 
					return $sqlquery->result();		 
	  }
	
  public function getProfileLang($id){
	    $data = $this->db->select('id,user_id,known_languages')->from('users_profile')
		                 ->where('user_id',$id)
						 ->get();
				return $data->result();		 
	  }
	  
  public function updateProfileLang($id,$lang){
	   $data = array('known_languages'=>$lang);
	   $this->db->where('user_id',$id);
	   $this->db->update('users_profile',$data);
	   return 'success';
	  }
	  
 public function selectCategory($service_id){
	   $query = $this->db->select('*')
	                 ->from('mst_categories')
					 ->where('cate_id',$service_id)					 
					 ->get();
			return $query->result();		 
	 }
	 
 public function getServices(){
	  $data = $this->db->select('*')
	                   ->from('main_category')
					   ->get();
				return $data->result();	   
	 }
	 
 public function selectThemes(){
	  $themedata = $this->db->select('*')
	                        ->from('themes')
							->get();
				return $themedata->result();			
	 }
	 
 public function fetchSaveItinerary($hostid){
	  $query =  $this->db->select('*')
	           ->from('creates_itinerary')
			   ->where('user_id',$hostid)
			   ->where('status',0)
			   ->where('login_status',1) //add by robin on 28-11-18
			   ->get();
		return $query->result();	   
	 }
	 
 public function getInsertRow($userId){
	  $data = $this->db->select('id,user_id,status,itinerary_category')
	                   ->from('creates_itinerary')
					   ->where('user_id',$userId)
					   ->where('login_status',0) //add by robin on 28-11-18
					   ->get();
			return $data->num_rows();		   
	 }

 public function getItineraryStatus($hostId){
         $data =  $this->db->select('id,status,admin_status,login_status')
			         ->from('creates_itinerary')
					 ->where('user_id',$hostId)
					 ->get();
				return $data->result();	 
		 }
		 
 public function insertitinerary($data){
	  $this->db->insert('creates_itinerary',$data);
	  return $this->db->insert_id();
	 }
	 
 public function updateDraftData($userId,$itinerarySaveArr){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],'experience_type'=>$itinerarySaveArr['experience_type'],
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],'location_covered'=>$itinerarySaveArr['location_covered'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],
	  'sponsors_img'=>$itinerarySaveArr['sponsors_img'],'video'=>$itinerarySaveArr['video'],
	  'translator'=>$itinerarySaveArr['translator'],'term_condition'=>$itinerarySaveArr['term_condition'],'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('login_status',1);
	   $this->db->update('creates_itinerary',$data);
	 }

	 
public function editUpdateDraftData($userId,$itinerarySaveArr,$itinerary_id){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],
	  'experience_type'=>$itinerarySaveArr['experience_type'],
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],'location_covered'=>$itinerarySaveArr['location_covered'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],'sponsors_img'=>$itinerarySaveArr['sponsors_img'],'video'=>$itinerarySaveArr['video'],'login_status'=>$itinerarySaveArr['login_status'],
	  'translator'=>$itinerarySaveArr['translator'],'term_condition'=>isset($itinerarySaveArr['term_condition']) ? $itinerarySaveArr['term_condition'] : "",'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('id',$itinerary_id);
	   $this->db->update('creates_itinerary',$data);
	 }	 
/* public function faqUpdateData($userId,$faqArrData,$itinerary_id){
	  $data = array('category_id'=>$faqArrData['category_id'],'itinerary_faq_question'=>$faqArrData['itinerary_faq_question'],
	                'itinerary_faq_answer'=>$faqArrData['itinerary_faq_answer'],'created_at'=>date('y-m-d h:s'));
		$this->db->where('create_itinerary_id',$itinerary_id);
		$this->db->where('user_id',$userId);
	    $this->db->update('txn_faqs',$data);			
	 }*/
	 
 public function findSelectedThemes($themeId){
	  $sql = $this->db->select('id,theme_name')
	                  ->from('themes')
					  ->where('id',$themeId)
					  ->get();
			return $sql->result();		  
	 }
	 
 public function findSelectedFeature($featureId){
	  $sql = $this->db->select('id,feature_name')
	                  ->from('features')
					  ->where('id',$featureId)
					  ->get();
			return $sql->result();
	 }
	 
 public function getSaveTqsData($userId){
	  $draftFaqQuery =  $this->db->select('*')
	           ->from('txn_faqs')
			   ->where('user_id',$userId)
			   ->where('login_status',1)
			   ->get();
		return $draftFaqQuery->result();
	 }
	 
 public function getSaveRouteData($userId){
	 $draftRouteQuery = $this->db->select('*')
	           ->from('txn_routes_timings')
			   ->where('user_id',$userId)
			   ->where('login_status',1)
			   ->get();
		return $draftRouteQuery->result();
	   
	 }
	 
 public function getSaveFamilyeData($userId){
	 $draFamilyQuery = $this->db->select('*')
	           ->from('txn_itinerary_family')
			   ->where('user_id',$userId)
			   ->where('login_status',1)
			   ->get();
		return $draFamilyQuery->result();
	 
	 }
	 
public function getSaveStopsData($userId){
	 $stopsQuery = $this->db->select('*')
	           ->from('txn_routes_stops')
			   ->where('user_id',$userId)
			   ->where('login_status',1)
			   ->get();
		return $stopsQuery->result();
	 
	 }	 
	 
 public function getSaveItineraryId($userId){
	   $itineraryId = $this->db->select('id,user_id,itinerary_category')
	                           ->from('creates_itinerary')
							   ->where('user_id',$userId)
							   ->where('login_status',1)
							   ->get();
					return $itineraryId->result();		   
	 }
	 
 public function getSaveFaqids($userId,$itineraryid){
	   $faqids = $this->db->select('id,user_id,create_itinerary_id')
	                           ->from('txn_faqs')
							   ->where('user_id',$userId)
							   ->where('create_itinerary_id',$itineraryid)
							   ->get();
					return $faqids->result();
	 }
	 
 public function deleteFaqdata($userId,$itineraryid){
	  $data = array('user_id'=>$userId,'create_itinerary_id'=>$itineraryid);
	  $query = $this->db->where($data);
       return $this->db->delete('txn_faqs');
	 }
	 
 public function getSaveRoutesids($userId,$itineraryid){	 
	  $routeIds = $this->db->select('id,user_id,create_itinerary_id')
	                           ->from('txn_routes_timings')
							   ->where('user_id',$userId)
							   ->where('create_itinerary_id',$itineraryid)
							   ->get();
					return $routeIds->result();
	 }
	 
 public function deleteRoutesdata($userId,$itineraryid){
	  $data = array('user_id'=>$userId,'create_itinerary_id'=>$itineraryid);
	  $query = $this->db->where($data);
       return $this->db->delete('txn_routes_timings');
	 }
	 
 public function getSaveFamilyids($userId,$itineraryid){
	  $familyIds = $this->db->select('id,user_id,category_id')
	                           ->from('txn_itinerary_family')
							   ->where('user_id',$userId)
							   ->where('category_id',$itineraryid)
							   ->get();
					return $familyIds->result();
	 }	 
	 
 public function deleteFamilydata($userId,$itineraryid){
	  $data = array('user_id'=>$userId,'category_id'=>$itineraryid);
	  $query = $this->db->where($data);
       return $this->db->delete('txn_itinerary_family');
	 }

 public function getSaveStopids($userId,$itineraryid){
	  $stopsIds = $this->db->select('id,user_id,create_itinerary_id')
	                           ->from('txn_routes_stops')
							   ->where('user_id',$userId)
							   ->where('create_itinerary_id',$itineraryid)
							   ->get();
					return $stopsIds->result();
	 }
	 
public function deleteStopsdata($userId,$itineraryid){
	  $data = array('user_id'=>$userId,'create_itinerary_id'=>$itineraryid);
	  $query = $this->db->where($data);
       return $this->db->delete('txn_routes_stops');
	 }	 
	 
 public function getItineraryLastStatus($lastId){
         $data =  $this->db->select('id,status')
			         ->from('creates_itinerary')
					 ->where('id',$lastId)
					 ->get();
				return $data->result();	 
		 }
		 
  public function updateDoneData($userId,$itinerarySaveArr){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],'experience_type'=>$itinerarySaveArr['experience_type'],
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],'location_covered'=>$itinerarySaveArr['location_covered'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],
	  'video'=>$itinerarySaveArr['video'],'status'=>$itinerarySaveArr['status'],'login_status'=>$itinerarySaveArr['login_status'],
	  'admin_status'=>$itinerarySaveArr['admin_status'],'translator'=>$itinerarySaveArr['translator'],
	  'term_condition'=>$itinerarySaveArr['term_condition'],'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('login_status',1);
	   $this->db->update('creates_itinerary',$data);
	 }

	 
public function editUpdateDoneData($userId,$itinerarySaveArr,$itinerary_id){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],'experience_type'=>isset($itinerarySaveArr['experience_type']) ? $itinerarySaveArr['experience_type'] : "",
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],'location_covered'=>$itinerarySaveArr['location_covered'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],
	  'video'=>$itinerarySaveArr['video'],'status'=>$itinerarySaveArr['status'],'login_status'=>$itinerarySaveArr['login_status'],
	  'admin_status'=>$itinerarySaveArr['admin_status'],'sponsors_img'=>isset($itinerarySaveArr['sponsors_img']) ? $itinerarySaveArr['sponsors_img'] : "",'translator'=>$itinerarySaveArr['translator'],'translator_type'=>$itinerarySaveArr['translator_type'],'translator_confirm'=>$itinerarySaveArr['translator_confirm'],
	  'term_condition'=>$itinerarySaveArr['term_condition'],'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('id',$itinerary_id);
	   $this->db->update('creates_itinerary',$data);
	 }
	 
 public function updateloginStatus($loginid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:s'));
	  $this->db->where('user_id',$loginid);
	  $this->db->where('status',0);
	  $this->db->where('login_status',1);
	   $this->db->update('creates_itinerary',$data);
	 }
	 
//============= TQA login status update ==============//
 public function updateTqa_loginStatus($loginid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:s'));
	  $this->db->where('user_id',$loginid);	  
	  $this->db->where('login_status',1);
	  $this->db->update('txn_faqs',$data);
	 } 

 //============= Family login status update ==============//
 public function updateFamily_loginStatus($loginid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:s'));
	  $this->db->where('user_id',$loginid);	  
	  $this->db->where('login_status',1);
	  $this->db->update('txn_itinerary_family',$data);
	 } 

//============= Family login status update ==============//
 public function updateRoute_loginStatus($loginid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:s'));
	  $this->db->where('user_id',$loginid);	  
	  $this->db->where('login_status',1);
	  $this->db->update('txn_routes_timings',$data);
	 } 
	 
 //============ fetch all created itinerary for login user =================//
 public function getAllUserItinerary($loginId,$page,$serviceId){
        $offset = 4*$page;
        $limit = 4;
	    $sqldata = $this->db->select('*')
	                      ->from('creates_itinerary')
						 // ->where('user_id',$loginId)
						  ->where("(admin_status!=6 OR admin_status IS NULL) AND user_id='$loginId' and service_id = '$serviceId' limit $offset ,$limit")	
						  ->get();						
				return $sqldata->result();		  
	 }

//============ fetch all itineraries services for login user =================//
 public function getUserItinerary_value($loginId){       
	    $sqldata = $this->db->select('*')
	                      ->from('creates_itinerary')
						 // ->where('user_id',$loginId)
						  ->where("(admin_status!=6 OR admin_status IS NULL) AND user_id='$loginId'")	
						  ->get();						
				return $sqldata->result();		  
	 }

public function getAllSearchItinerary($loginId,$serviceId,$themesid,$hostType){
	    $condition = "(creates_itinerary.admin_status!=6 OR creates_itinerary.admin_status IS NULL) AND creates_itinerary.user_id='$loginId' AND creates_itinerary.service_id= '$serviceId'";
	    if(isset($themesid) && $themesid!=''){
			 $condition .= " AND FIND_IN_SET('$themesid',creates_itinerary.itinerary_theme)";
			}
    if(isset($hostType) && $hostType!=''){
        $condition .= " AND users_profile.host_verification_type='$hostType'";
    }
		
	$sqldata = $this->db->select('creates_itinerary.*,users_profile.user_id,users_profile.services_offered,users_profile.host_verification_type')
	                      ->from('creates_itinerary')
						  ->join('users_profile','users_profile.user_id = creates_itinerary.user_id')
						 // ->where("(admin_status!=6 OR admin_status IS NULL) AND user_id='$loginId' and service_id = '$serviceId'")
						  ->where($condition)
						  ->get();						
				return $sqldata->result();
}	 
//============ fetch all itinerary family for login user =================//
 public function getItineraryfamilyData($loginId){
	 
	  $sqldata = $this->db->select('*')
	                      ->from('txn_itinerary_family')
						  ->where('user_id',$loginId)
						  //->where('login_status',1)
						  ->get();
				return $sqldata->result();		  
	 }
	 
//============== host allowed function =========================//
 public function allowHost($hostId){
	$dataSql = $this->db->select('id,admin_status')
	                    ->from('users')
						->where('id',$hostId)
						->get();
						
			return $dataSql->result();			
 }
 
//========= host selected services unction =================//
public function getUserServices($hostId){
	$dataSql = $this->db->select('id,services_offered')
	                    ->from('users_profile')
						->where('user_id',$hostId)
						->get();
						
			return $dataSql->result();
	
}
	 
//============START:: create itinerary view detailed function ==================//
 public function createItineraryView($userId,$itineraryId){
	  $sqlData = $this->db->select('*')
	                      ->from('creates_itinerary')
						  ->where('id',$itineraryId)
						  ->where('user_id',$userId)
						  ->get();
				return $sqlData->result();		  
	 }
//===========END:: create itinerary view detailed function==============//


//=============START:: change login status function on date 4-12-18 ===================//
 public function changeLoginStatus_cancel($userid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:i:s'));
	  
	   $this->db->where('user_id',$userid);
	   $this->db->where('status',0);
	   $this->db->where('login_status',1);
	   $this->db->update('creates_itinerary',$data);	 }
//=============END:: change login status function ====================//


//=============START:: change login status function for TQA for cancel popup ===================//
 public function changeTqaStatus_cancel($userid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:i:s'));	  
	   $this->db->where('user_id',$userid);	  
	   $this->db->where('login_status',1);
	   $this->db->update('txn_faqs',$data);
	   }
//=============END:: change login status function for TQA for cancel popup ====================//

//=============START:: change login status function for TQA for cancel popup ===================//
 public function changeFamilyStatus_cancel($userid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:i:s'));	  
	   $this->db->where('user_id',$userid);	  
	   $this->db->where('login_status',1);
	   $this->db->update('txn_itinerary_family',$data);
	   }
//=============END:: change login status function for TQA for cancel popup ====================//

//=============START:: change login status function for TQA for cancel popup ===================//
 public function changeRouteStatus_cancel($userid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:i:s'));	  
	   $this->db->where('user_id',$userid);	  
	   $this->db->where('login_status',1);
	   $this->db->update('txn_routes_timings',$data);
	}
//=============END:: change login status function for TQA for cancel popup ====================//

//=============START:: change login status function for New Stops for cancel popup ===================//
 public function changeStopStatus_cancel($userid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:i:s'));	  
	   $this->db->where('user_id',$userid);	  
	   $this->db->where('login_status',1);
	   $this->db->update('txn_routes_stops',$data);
	
  }
//=============END:: change login status function for New Stops for cancel popup ====================//

//=============START:: change login status function for Speakers Details for cancel popup ===================//
 public function changeSpeakerStatus_cancel($userid){
	  $data = array('login_status'=>null,'created_at'=>date('y-m-d h:i:s'));	  
	   $this->db->where('user_id',$userid);	  
	   $this->db->where('login_status',1);
	   $this->db->update('txn_speakers_details',$data);
	
  }

public function getEditFaqData($userId,$itineraryId){
	  $draftFaqQuery =  $this->db->select('*')
	           ->from('txn_faqs')
			   ->where('user_id',$userId)
			   ->where('create_itinerary_id',$itineraryId)
			   //->where('login_status',null)
			   ->get();
		return $draftFaqQuery->result();
	 }

 public function getEditRouteData($userId,$itineraryId){
	 $draftRouteQuery = $this->db->select('*')
	           ->from('txn_routes_timings')
			   ->where('user_id',$userId)
			   ->where('create_itinerary_id',$itineraryId)
			   //->where('login_status',null)
			   ->get();
		return $draftRouteQuery->result();
	   
	 }
	 
 public function getEditFamilyeData($userId,$itineraryId){
	 $draFamilyQuery = $this->db->select('*')
	           ->from('txn_itinerary_family')
			   ->where('user_id',$userId)
			   ->where('category_id',$itineraryId)
			   //->where('login_status',null)
			   ->get();
		return $draFamilyQuery->result();
	 
	 }	 
	 
public function getEditStopsData($userId,$itineraryId){
	 $draStopsQuery = $this->db->select('*')
	           ->from('txn_routes_stops')
			   ->where('user_id',$userId)
			   ->where('create_itinerary_id',$itineraryId)
			   //->where('login_status',null)
			   ->get();
		return $draStopsQuery->result();
	 
	 }	
public function getEditSpeakerData($userId,$itineraryId){
	 $draftSpeakerQuery = $this->db->select('*')
	           ->from('txn_speakers_details')
			   ->where('user_id',$userId)
			   ->where('create_itinerary_id',$itineraryId)
			   //->where('login_status',null)
			   ->get();
		return $draftSpeakerQuery->result();
	   
	 }
	 	 
public function getProfileimage($id){
	
	$data = $this->db->select('id,user_id,profile_picture,gender')
	            ->from('users_profile')
				->where('user_id',$id)
				->get();
				
		return $data->result();		
}	 

public function getHostProfile($id){
	
	$data = $this->db->select('*')
	            ->from('users')
				->where('id',$id)
				->get();
				
		return $data->result();		
}	 

//============== update meetup save data ===============//
public function updateMeetupDraftData($userId,$itinerarySaveArr){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],'meetup_type'=>$itinerarySaveArr['meetup_type'],
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],'sponsors_img'=>$itinerarySaveArr['sponsors_img'],'status'=>$itinerarySaveArr['status'],'admin_status'=>$itinerarySaveArr['admin_status'],
	  'login_status'=>$itinerarySaveArr['login_status'],'video'=>$itinerarySaveArr['video'],
	  'translator'=>$itinerarySaveArr['translator'],'term_condition'=>$itinerarySaveArr['term_condition'],'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('login_status',1);
	   $this->db->update('creates_itinerary',$data);
	 }
	 
public function getSaveSpeakerData($userId){
	$draftSpeakers =  $this->db->select('*')
	           ->from('txn_speakers_details')
			   ->where('user_id',$userId)			  
			   ->where('login_status',1)
			   ->get();
		return $draftSpeakers->result();
}	 
	
 public function getSaveSpeakerids($userId,$itineraryid){	 
	  $speakersIds = $this->db->select('id,user_id,create_itinerary_id')
	                           ->from('txn_speakers_details')
							   ->where('user_id',$userId)
							   ->where('create_itinerary_id',$itineraryid)
							   ->get();
					return $speakersIds->result();
	 }	
public function deleteSpeakerdata($userId,$itineraryid){
	  $data = array('user_id'=>$userId,'create_itinerary_id'=>$itineraryid);
	  $query = $this->db->where($data);
       return $this->db->delete('txn_speakers_details');
	 }	

//============== update meetup edit save data ===============//
public function editUpdateMeetupDraftData($userId,$itinerarySaveArr,$itinerary_id){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],'meetup_type'=>$itinerarySaveArr['meetup_type'],
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],'sponsors_img'=>$itinerarySaveArr['sponsors_img'],'video'=>$itinerarySaveArr['video'],
	  'translator'=>$itinerarySaveArr['translator'],'term_condition'=>$itinerarySaveArr['term_condition'],'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('id',$itinerary_id);
	   $this->db->update('creates_itinerary',$data);
	 }
	 
//============== update meetup edit done data ===============//
public function editUpdateMeetupDoneData($userId,$itinerarySaveArr,$itinerary_id){
      $data = array('itinerary_category'=>$itinerarySaveArr['itinerary_category'],'other_category_type'=> $itinerarySaveArr['other_category_type'],'origin_city'=>$itinerarySaveArr['origin_city'],'origin_other_city'=>$itinerarySaveArr['origin_other_city'],
	  'itinerary_title'=>$itinerarySaveArr['itinerary_title'],'itinerary_other_title'=> $itinerarySaveArr['itinerary_other_title'],
	  'itinerary_tagline'=>$itinerarySaveArr['itinerary_tagline'],'itinerary_other_tagline'=>$itinerarySaveArr['itinerary_other_tagline'],
	  'itinerary_description'=> $itinerarySaveArr['itinerary_description'],'other_itinerary_description'=>$itinerarySaveArr['other_itinerary_description'],'itinerary_theme'=>$itinerarySaveArr['itinerary_theme'],'meetup_type'=>$itinerarySaveArr['meetup_type'],
	  'itinerary_searchtags'=>$itinerarySaveArr['itinerary_searchtags'],'type_highlights'=>$itinerarySaveArr['type_highlights'],
	  'type_features'=>$itinerarySaveArr['type_features'],'itinerary_delivery'=>$itinerarySaveArr['itinerary_delivery'],
	  'prefer_languages'=>$itinerarySaveArr['prefer_languages'],'itinerary_inclusions'=>$itinerarySaveArr['itinerary_inclusions'],
	  'itinerary_exclusions'=>$itinerarySaveArr['itinerary_exclusions'],'itinerary_spl_mention'=>$itinerarySaveArr['itinerary_spl_mention'],
	  'itinerary_allowshare_facebook'=>$itinerarySaveArr['itinerary_allowshare_facebook'],'itinerary_allowshare_instagram'=>$itinerarySaveArr['itinerary_allowshare_instagram'],'host_first_name'=>$itinerarySaveArr['host_first_name'],'host_last_name'=>$itinerarySaveArr['host_last_name'],'host_mob_num'=>$itinerarySaveArr['host_mob_num'],'host_email'=>$itinerarySaveArr['host_email'],
	  'host_emergency_contact_num'=>$itinerarySaveArr['host_emergency_contact_num'],'aviaiable_time_form_host'=>$itinerarySaveArr['aviaiable_time_form_host'],'aviaiable_time_to_host'=>$itinerarySaveArr['aviaiable_time_to_host'],'start_date_from_host'=>$itinerarySaveArr['start_date_from_host'],'end_date_to_host'=>$itinerarySaveArr['end_date_to_host'],'service_frequency'=>$itinerarySaveArr['service_frequency'],'service_id'=>$itinerarySaveArr['service_id'],'itinerary_language'=>$itinerarySaveArr['itinerary_language'],
	  'days'=>$itinerarySaveArr['days'],'nearest_airport'=>$itinerarySaveArr['nearest_airport'],'nearest_railway_station'=>$itinerarySaveArr['nearest_railway_station'],
	  'private_traveller'=>$itinerarySaveArr['private_traveller'],'private_min_no_travellers'=>$itinerarySaveArr['private_min_no_travellers'],
	  'private_max_no_travellers'=>$itinerarySaveArr['private_max_no_travellers'],'group_traveller'=>$itinerarySaveArr['group_traveller'],
	  'group_min_no_travellers'=>$itinerarySaveArr['group_min_no_travellers'],'group_max_no_travellers'=>$itinerarySaveArr['group_max_no_travellers'],'private_price'=>$itinerarySaveArr['private_price'],
	  'group_price'=>$itinerarySaveArr['group_price'],'additional_cost_description'=>$itinerarySaveArr['additional_cost_description'],
	  'additional_price'=>$itinerarySaveArr['additional_price'],'confirmation_type'=>$itinerarySaveArr['confirmation_type'],
	  'Instant_confirmation_message'=>$itinerarySaveArr['Instant_confirmation_message'],'itinerary_cancelbyhost_agree'=>$itinerarySaveArr['itinerary_cancelbyhost_agree'],'itinerary_cancelbytraveller_agree'=>$itinerarySaveArr['itinerary_cancelbytraveller_agree'],
	  'itinerary_refund_agree'=>$itinerarySaveArr['itinerary_refund_agree'],'itinerary_liabilitie_disclaimer'=>$itinerarySaveArr['itinerary_liabilitie_disclaimer'],'itinerary_privacy_policy'=>$itinerarySaveArr['itinerary_privacy_policy'],
	  'itinerary_terms_condition'=>$itinerarySaveArr['itinerary_terms_condition'],'last_doneby_host'=>$itinerarySaveArr['last_doneby_host'],
	  'last_doneby_traveller'=>$itinerarySaveArr['last_doneby_traveller'],'last_refund'=>$itinerarySaveArr['last_refund'],
	  'media_infringement'=>$itinerarySaveArr['media_infringement'],'created_at'=>$itinerarySaveArr['created_at'],'week1_days'=>$itinerarySaveArr['week1_days'],'week2_days'=>$itinerarySaveArr['week2_days'],'week3_days'=>$itinerarySaveArr['week3_days'],
	  'week4_days'=>$itinerarySaveArr['week4_days'],'week5_days'=>$itinerarySaveArr['week5_days'],
	  'additional_img_1'=>$itinerarySaveArr['additional_img_1'],'additional_img_2'=>$itinerarySaveArr['additional_img_2'],
	  'additional_img_3'=>$itinerarySaveArr['additional_img_3'],'feature_img'=>$itinerarySaveArr['feature_img'],'sponsors_img'=>$itinerarySaveArr['sponsors_img'],'video'=>$itinerarySaveArr['video'],'status'=>$itinerarySaveArr['status'],'login_status'=>$itinerarySaveArr['login_status'],'admin_status'=>$itinerarySaveArr['admin_status'],
	  'translator'=>$itinerarySaveArr['translator'],'translator_type'=>$itinerarySaveArr['translator_type'],'translator_confirm'=>$itinerarySaveArr['translator_confirm'],'term_condition'=>$itinerarySaveArr['term_condition'],'frequency_type'=>$itinerarySaveArr['frequency_type'],'frequency_off_days'=>$itinerarySaveArr['frequency_off_days']);
	  
	   $this->db->where('user_id',$userId);
	   $this->db->where('id',$itinerary_id);
	   $this->db->update('creates_itinerary',$data);
	 }
	 
public function insertedData($data){
	
	$this->db->insert('txn_interested',$data);
	return 'success';
}	 

public function fetchSpeakers($itineraryId){
	$Speakers = $this->db->select('*')
	           ->from('txn_speakers_details')
			   ->where('create_itinerary_id',$itineraryId)			   
			   ->get();
		return $Speakers->result();
}

//================ Home Itineraries Function =====================//

public function homeItineraries($page,$serviceId){
	    $offset = 4*$page;
        $limit = 4;
		$orderBy = "creates_itinerary.priority desc,users_profile.host_verification_type desc,
		             creates_itinerary.rating desc,creates_itinerary.id asc";
        //$sql = "select * from creates_itinerary where admin_status = 5  and service_id = '$serviceId' order by $orderBy limit $offset ,$limit";
       $sql = "select creates_itinerary.*,'users_profile.user_id,users_profile.host_verification_type' from creates_itinerary 
		           JOIN users_profile ON users_profile.user_id = creates_itinerary.user_id 
				    where creates_itinerary.admin_status = 5  and creates_itinerary.service_id = '$serviceId' order by $orderBy
					limit $offset ,$limit";
	   
	   $result = $this->db->query($sql)->result();
        return $result;
}

public function getcities(){
	$citydata = $this->db->select('*')
	                    ->from('city')
						->get();
				return $citydata->result();		
}

public function searchItineraries($serviceId,$privateType,$groupType,$cityName,$date,$themesid,$familyType,$hostType,$itineraryLang){
	   // $offset = 4*$page;
        //$limit = 4;
		$condition = "creates_itinerary.admin_status = 5  and creates_itinerary.service_id = '$serviceId'";
	  
	   if(isset($privateType) && $privateType!=''){
			 $condition .= " and creates_itinerary.private_traveller='$privateType' ";
			}
     if(isset($groupType) && $groupType!=''){
			 $condition .= " and creates_itinerary.group_traveller='$groupType'";
			}
		if(isset($cityName) && $cityName!=''){
			 $condition .= " and creates_itinerary.origin_city='$cityName'";
			}
		if(isset($date) && $date!=''){
		     $date1 = date('Y-m-d',strtotime($date));
			 $condition .= " and creates_itinerary.start_date_from_host<='$date1' and creates_itinerary.end_date_to_host>='$date1'";
			}
		if(isset($themesid) && $themesid!=''){		     
			 $condition .= " and FIND_IN_SET($themesid,creates_itinerary.itinerary_theme)";
			}
        if(isset($hostType) && $hostType!=''){
            $condition .= " and users_profile.host_verification_type='$hostType'";
        }

		if(isset($itineraryLang) && $itineraryLang!=''){
            $condition .= " and creates_itinerary.itinerary_language='$itineraryLang'";
        }
		
	/*if(isset($familyType) && $familyType!=''){
            $condition .= " and txn_itinerary_family.family_traveller='$familyType'";
        }*/
		
		$orderBy = "creates_itinerary.priority desc,users_profile.host_type_status desc,
		            creates_itinerary.rating desc,creates_itinerary.id asc";					
         
		/*$sql = "select creates_itinerary.*,txn_itinerary_family.*,'users_profile.user_id,users_profile.host_verification_type' from        creates_itinerary JOIN txn_itinerary_family ON txn_itinerary_family.service_id = creates_itinerary.service_id  AND txn_itinerary_family.category_id = creates_itinerary.id JOIN users_profile ON users_profile.user_id = creates_itinerary.user_id where $condition  order by $orderBy";*/
				   
    $sql = "select creates_itinerary.*,'users_profile.user_id,users_profile.host_verification_type' from creates_itinerary 
		           JOIN users_profile ON users_profile.user_id = creates_itinerary.user_id where $condition order by $orderBy ";

        $result = $this->db->query($sql)->result();
        return $result;
}

//=========== Load more Itinerary data============//
public function loadSearchItineraries($serviceId,$privateType,$groupType,$cityName,$date,$themesid,$familyType,
	                                   $hostType,$itineraryLang,$page){
	    $offset = 4*$page;
        $limit = 4;
		$condition = "creates_itinerary.admin_status = 5  and creates_itinerary.service_id = '$serviceId'";
	  
	   if(isset($privateType) && $privateType!=''){
			 $condition .= " and creates_itinerary.private_traveller='$privateType' ";
			}
     if(isset($groupType) && $groupType!=''){
			 $condition .= " and creates_itinerary.group_traveller='$groupType'";
			}
		if(isset($cityName) && $cityName!=''){
			 $condition .= " and creates_itinerary.origin_city='$cityName'";
			}
		if(isset($date) && $date!=''){
		     $date1 = date('Y-m-d',strtotime($date));
			 $condition .= " and creates_itinerary.start_date_from_host<='$date1' and creates_itinerary.end_date_to_host>='$date1'";
			}
		if(isset($themesid) && $themesid!=''){		     
			 $condition .= " and FIND_IN_SET($themesid,creates_itinerary.itinerary_theme)";
			}
        if(isset($hostType) && $hostType!=''){
            $condition .= " and users_profile.host_verification_type='$hostType'";
        }

		if(isset($itineraryLang) && $itineraryLang!=''){
            $condition .= " and creates_itinerary.itinerary_language='$itineraryLang'";
        }
		
		$orderBy = "creates_itinerary.priority desc,users_profile.host_type_status desc,
		            creates_itinerary.rating desc,creates_itinerary.id asc";
					
        $sql = "select creates_itinerary.*,'users_profile.user_id,users_profile.host_verification_type' from creates_itinerary 
		           JOIN users_profile ON users_profile.user_id = creates_itinerary.user_id where $condition order by $orderBy limit $offset ,$limit";

        $result = $this->db->query($sql)->result();
        return $result;
}

//======== Attendees Function Start on 21-02-19 ==========//
public function fetchAttendees($itineraryId,$serviceId){
	$data = array('itinerary_id'=>$itineraryId,'service_id'=>$serviceId);
 	$sqlData = $this->db->select('*')
	                    ->from('mst_transaction')
						->where($data)
						->get();
			return $sqlData->result();			
}


//========== highlight fetch data function ==========//
public function getHighLightData(){

 $data = $this->db->select('*')
                  ->from('my_interest')
				  ->get();
		return $data->result();		  
}

//=========== Legal Text Data function ============//
public function getLegalData($serviceId){
	
	$dataSet = $this->db->select('*')
	                    ->from('iwl_legal')
						->where('service_id',$serviceId)
						->get();
			return $dataSet->result();			
}


//======= Host Email id function for RSVP =========//
public function getHostEmail($itineraryId){
	
	$dataSet = $this->db->select('users.*')
	                   ->from('users')
					   ->join('creates_itinerary', 'users.id = creates_itinerary.user_id')
					   ->where('creates_itinerary.id',$itineraryId)
					   ->get();
		return $dataSet->result();			   
}


//========== fetch all itinerray languages ==========//
public function fetchItineraryLanguages(){
	$data = $this->db->select('creates_itinerary.itinerary_language')
	                 ->from('creates_itinerary')
					 ->where('admin_status',5)
					 ->group_by('itinerary_language')
					 ->get();
		return $data->result();			 
}

//=========== Get All Airports Function ===========//
public function getAirports(){
	$data = $this->db->select('*')
	                 ->from('iwl_airports')					
					 ->get();
		return $data->result();	
}

public function getRailways(){
	$data = $this->db->select('*')
	                 ->from('iwl_railways')					
					 ->get();
		return $data->result();	
}

//============== host Training Status function =========================//
 public function getTrainingStatus($hostId){
	$dataSql = $this->db->select('id,user_id,training')
	                    ->from('users_profile')
						->where('user_id',$hostId)
						->get();
						
			return $dataSql->result();			
 }
 
//============= Host Update training data function ============//
 public function updateHostTraining($autoId,$userId,$trainingCheck){
	  $data = array('training'=>$trainingCheck);	  
	   $this->db->where('user_id',$userId);	  
	   $this->db->where('id',$autoId);
	   $this->db->update('users_profile',$data);
	   return 'success';
	
  }
  
  
 //======== get RSVP itinerary data functon ==========// 
 public function getitineraryData($itineraryId){
	 $sqlSet = $this->db->select('*')
	                    ->from('creates_itinerary')
						->where('id',$itineraryId)
						->get();
						
			return $sqlSet->result();	
	 }
	 
//=========== check news letter email function ===========//
public function checkNewsEmail($email){
	$data = $this->db->select('*')
	                 ->from('iwl_news_letter')
					 ->where('email',$email)
					 ->get();
			return $data->num_rows();		 
}

//========= insert email function ===========//
public function insertNewsLetterEmail($insertData){
	 $this->db->insert('iwl_news_letter',$insertData);
	 return true;
}

}

?>