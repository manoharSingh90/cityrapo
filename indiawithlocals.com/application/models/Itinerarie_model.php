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
}

?>