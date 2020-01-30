<?php
	function getTotalDuration($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('id,user_id,total_durations')->from('txn_routes_timings')->where('create_itinerary_id',$id)->get();
		  
		  return $query->result();
		  
		//$data = json_decode(json_encode($query->result()),true);		  
		 /*foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;*/
		}
		
	
?>		