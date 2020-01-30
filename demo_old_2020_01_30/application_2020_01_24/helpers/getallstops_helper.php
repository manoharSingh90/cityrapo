<?php
	function getAll_stops($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();		 
		 $query = $ci->db->select('*')->from('txn_routes_stops')->where('create_itinerary_id',$id)->get();		  
		  return $query->result();	
		}
?>		