<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Booking_model extends CI_Model
{
	 function __construct(){ 
        parent::__construct(); 
        $this->load->database(); 
    }

    public function booking_itinerrary(array $data){

    	//print_r($data);die();
    	  return $this->db->insert('booking',$data);  

    }
    public function find_last_id(){
      return $insert_id = $this->db->insert_id();
    }
    /*public function booking_detail($booking_id){
    	$query =  $this->db->select('*')
   	                    ->from('booking')
   	                    ->where('booking_id',$booking_id)
   	                    ->get();
   	       return $query->result();

    }*/
    public function booking_detail($booking_id){
    	$query =  $this->db->select('*')
   	                    ->from('mst_transaction')
   	                    ->where('booking_id',$booking_id)
   	                    ->get();
   	       return $query->result();

    }

    public function get_host_info($host_id){
    	$query =  $this->db->select('*')
   	                    ->from('users_walk_itinerary')
   	                    ->where('user_id',$host_id)
   	                    ->get();
   	       return $query->result();


    }
    public function total__book_in_itin($itineraray_id){

     $query =  $this->db->select("SUM(no_of_travellers) AS ticket")
                        ->from("booking")
                        ->where('itinerary_id', $itineraray_id)
                        ->where('payment_status','1')
                        ->get();
    return $query->result();
     
       
    }
    public function update_payment_status($booking_id){
      $query = $this->db->set('payment_status','1')
                        ->where('booking_id',$booking_id)
                        ->update('mst_transaction');
                       
    }
	
public function fetchItineraryData($itineraryId,$serviceId){
  $data = $this->db->select('*')
                   ->from('creates_itinerary')
				   ->where('id',$itineraryId)
				   ->where('service_id',$serviceId)
				   ->get();
				return $data->result();   
}

public function saveBookingData($data){
	 $sqldata = $this->db->insert('mst_transaction',$data);
	// print_r($this->db->last_query());die;
	 return $this->db->insert_id();
}

public function fetchTransactionData($booking_id){
	
	$sqldata = $this->db->select('*')	                
	                ->from('mst_transaction mst')
					//->join('txn_transaction_details ttb', 'ttb.transaction_id=mst.id', 'left')
					->where('booking_id',$booking_id)
					->get();
		return $sqldata->result();			
}

public function fetchTransaction_Detail($id){
	$querydata = $this->db->select('*')	                
	                ->from('txn_transaction_details')					
					->where('transaction_id',$id)
					->get();
		return $querydata->result();	
}

public function getAdminStatus($itineraryId){
	
	$sqlData = $this->db->select('id,user_id,service_id,mail_for_admin,additional_cost_description')
	                    ->from('creates_itinerary')
						->where('id',$itineraryId)
						->get();
			return $sqlData->result();			
}

public function getUsersData($userID)
{
	$sqlData = $this->db->select('host_first_name,host_last_name,host_mob_no,host_email')
	                    ->from('users')
						->where('id',$userID)
						->get();
	return $sqlData->result();
}

public function getHostDetails($itineraryId){
 
 $hostData = $this->db->select('id,user_id,service_id,host_first_name,host_last_name,host_mob_num,
                              host_email,host_emergency_contact_num,aviaiable_time_form_host,aviaiable_time_to_host,origin_city,
							  start_date_from_host,end_date_to_host,additional_cost_description,private_traveller,private_min_no_travellers,
							  private_max_no_travellers,group_traveller,group_min_no_travellers,private_max_no_travellers,private_price,
							  group_price')
                     ->from('creates_itinerary')
					 ->where('id',$itineraryId)
					 ->get();
		return 	$hostData->result();		 
}


public function updateDateSlot($chkbox,$itineraryId){
      $query = $this->db->set('current_date_slot',$chkbox)
                        ->where('id',$itineraryId)
                        ->update('creates_itinerary');
			return 'success';			
                       
    }
	

public function fetchRouteSlotData($itineraryId){
	$routeData = $this->db->select('id,user_id,pickup_point,start_pickup_time,drop_off_point,end_dropoff_time,cutt_off_time')
	                      ->from('txn_routes_timings')
						  ->where('create_itinerary_id',$itineraryId)
						  ->get();
			return $routeData->result();			  
}	

public function getRouteSlotData($itineraryId,$routeId){
	$conditions = array('create_itinerary_id'=>$itineraryId,'id'=>$routeId);
	
	$dataSet = $this->db->select('*')
	                     ->from('txn_routes_timings')
						 ->where($conditions)
						 ->get();
		return $dataSet->result();			 
}


public function fetchTermsConditions(){
	
	$dataSet = $this->db->select('*')
	                    ->from('terms_condition')
                        ->get();
                return $dataSet->result();						
}


public function getTransactionKidsData($transactionId){
	$conditions = array('transaction_id'=>$transactionId);
	
	$dataSet = $this->db->select('*')
	                     ->from('txn_transaction_kids')
						 ->where($conditions)
						 ->get();
		return $dataSet->result();			 
}

}
?>




