<?php
	function getAll_pickupspoints($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('id,user_id,create_itinerary_id,pickup_point,start_pickup_time,drop_off_point,end_dropoff_time,
		                          cutt_off_time,pickup_lat_lng,drop_off_lat_lng')
							->from('txn_routes_timings')
							->where('create_itinerary_id',$id)->get();
		  
		  return $query->result();	  
		
		}
		
	
?>		