<?php
	function getHostDetail($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
          $ci->load->database();
		  $valArr = '';
		  $condition = array('id'=>$id,'host_icon'=>1);
		  
		  $query = $ci->db->select('*')->from('host_type')->where($condition)->get();
		 $data = json_decode(json_encode($query->result()),true);
		 foreach($data as $value){
			  $valArr = $value;
			 }
		  return $valArr;
		}
		
	
?>		