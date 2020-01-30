<?php
	function getCategoryName($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('id,category_name')->from('mst_categories')->where('id',$id)->get();
		 $data = json_decode(json_encode($query->result()),true);
		 foreach($data as $value){
			  $valArr = $value;
			 }
			 return $valArr;
		}
		
	
?>		