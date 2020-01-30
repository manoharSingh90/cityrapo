<?php
	function getState($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $stateArr = '';
		 $query = $ci->db->select('id,state_name,country_id')->from('state')->where('id',$id)->get();
		 $data = json_decode(json_encode($query->result()),true);
		 foreach($data as $value){
			  $stateArr = $value;
			 }			 
			 return $stateArr;
		}
		
	
?>		