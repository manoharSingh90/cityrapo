<?php
	function getInterestedData($itineraryid,$serviceid){	
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $stateArr = '';
		 $condition = array('create_itinerary_id'=>$itineraryid,'service_id'=>$serviceid); 
		 $query = $ci->db->select('*')->from('txn_interested')->where($condition)->get();
		  $data = $query->result();
		  return $data;		 
		}		
	
?>		