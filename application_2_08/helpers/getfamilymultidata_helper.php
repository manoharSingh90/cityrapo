<?php
	function getFamilyMultiData($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 //$valArr = '';
		 $query = $ci->db->select('*')->from('txn_itinerary_family')
		                   ->where('category_id',$id)
		                   ->where('family_traveller',1)						  					  
						   ->get();		 
		  return $data = $query->result();
		 
		}
		
	
?>		