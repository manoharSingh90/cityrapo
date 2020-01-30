<?php
	function getHostCity($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('id,city_name,state_id')->from('city')->where('id',$id)->get();
		 $data = json_decode(json_encode($query->result()),true);
		 foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;
		}
		
	
?>		