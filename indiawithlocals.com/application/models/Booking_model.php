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
    public function booking_detail($booking_id){
    	$query =  $this->db->select('*')
   	                    ->from('booking')
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
                        ->update('booking');
                       
    }
}
?>