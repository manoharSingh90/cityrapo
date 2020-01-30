<?php
	function hostServices($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('id,user_id,services_offered')
		                ->from('users_profile')						
						->where('user_id',$id)
						->get();
		 $data = json_decode(json_encode($query->result()),true);
		 foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;
		}
	
?>		