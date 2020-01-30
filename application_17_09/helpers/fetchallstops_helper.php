<?php
	function fetchAll_stops($itineraryid,$routeid){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $conditions = array('create_itinerary_id'=>$itineraryid,'route_id'=>$routeid);
		 $query = $ci->db->select('*')->from('txn_routes_stops')->where($conditions)->get();		  
		  return $query->result();	
		}
?>		