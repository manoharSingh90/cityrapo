<?php
	function getFamilyData($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('*')->from('txn_itinerary_family')->where('category_id',$id)
		                   ->where('family_traveller',1)
						   ->where('adults_price !=',null)
						   ->where('adults_price !=',0)
						   ->get();
		 //$data = json_decode(json_encode($query->result()),true);
		  $data = $query->result();
		 foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;
		}
		
	
?>		