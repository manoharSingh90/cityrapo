<?php
	function getHostData($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('users.id,users.host_first_name,users.host_last_name,users.host_mob_no,users.host_email,
		                         users_profile.id,users_profile.user_id,users_profile.display_name, 
		                         users_profile.profile_picture,users_profile.gender,users_profile.nationality,users_profile.date_of_birth,
								 users_profile.host_verification_type,users_profile.verified_by,users_profile.guide_badges')
		                ->from('users_profile')
						->join('users','users.id = users_profile.user_id')
						->where('users.id',$id)
						->get();
		 $data = json_decode(json_encode($query->result()),true);
		 foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;
		}
	
?>		