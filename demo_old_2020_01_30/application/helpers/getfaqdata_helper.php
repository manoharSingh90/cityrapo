<?php
	function getFaqsData($id){
		  //get main CodeIgniter object
          $ci =& get_instance();
		  //load databse library
         $ci->load->database();
		 $valArr = '';
		 $query = $ci->db->select('itinerary_faq_question,itinerary_faq_answer')->from('txn_faqs')->where('create_itinerary_id',$id)->get();
		 return $query->result();		 
		}
		
	
?>		