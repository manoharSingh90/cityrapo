<?php
	function getHostThemes($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('id,theme_name')->from('themes')->where('id',$id)->get();
		 $data = json_decode(json_encode($query->result()),true);
		
		 foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;
		}
		
	
?>		