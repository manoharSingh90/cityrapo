<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_model'); 
		$this->load->model('Itinerarie_model'); 
		$this->load->model('Admin_model');
		$this->load->model('User_model');
		include APPPATH . 'third_party/Utility.php'; // include third party plugin and call it in CI 
		$this->load->helper('sendsms');		
	}

	 function encrypt($plainText,$key)
                    {
                      error_reporting(0);
                      
                      $secretKey = $this->hextobin(md5($key));
                      $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
                        $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
                        $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
                      $plainPad = $this->pkcs5_pad($plainText, $blockSize);
                        if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
                      {
                            $encryptedText = mcrypt_generic($openMode, $plainPad);
                                  mcrypt_generic_deinit($openMode);
                                  
                      } 
                      return bin2hex($encryptedText);
                    }

            function decrypt($encryptedText,$key)
            {
              $secretKey = $this->hextobin(md5($key));
              $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
              $encryptedText=$this->hextobin($encryptedText);
                $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
              mcrypt_generic_init($openMode, $secretKey, $initVector);
              $decryptedText = mdecrypt_generic($openMode, $encryptedText);
              $decryptedText = rtrim($decryptedText, "\0");
              mcrypt_generic_deinit($openMode);
              return $decryptedText;
              
            }
  //*********** Padding Function *********************

           function pkcs5_pad ($plainText, $blockSize)
          {
              $pad = $blockSize - (strlen($plainText) % $blockSize);
              return $plainText . str_repeat(chr($pad), $pad);
          }

  //********** Hexadecimal to Binary function for php 4.0 version ********

            function hextobin($hexString) 
               { 
                    $length = strlen($hexString); 
                    $binString="";   
                    $count=0; 
                    while($count<$length) 
                    {       
                        $subString =substr($hexString,$count,2);           
                        $packedString = pack("H*",$subString); 
                        if ($count==0)
                  {
                  $binString=$packedString;
                  } 
                        
                  else 
                  {
                  $binString.=$packedString;
                  } 
                        
                  $count+=2; 
                    } 
                      return $binString; 
                  }

    public function book_itenerary(){
    	//echo"<pre>";print_r($this->input->post());die;
	      	$loggedInId = $this->session->userdata('id');   
	        $itineraray_id = $this->input->post('itinerary_id');    
		    $service_id = $this->input->post('service_id');
		    $userType = $this->input->post('userType');
		    $userLanguage = $this->input->post('userLang');
		    $default_full_name = $this->input->post('default_full_name');
		    $email = $this->input->post('email');
		    $itineraryTitle = $this->input->post('itinerary_title');
		    $international_phone = $this->input->post('international_phone');
		    $phone_no = $this->input->post('phone_no');
		    $origin_city = $this->input->post('origin_city');
		    date_default_timezone_set('Asia/Kolkata'); 
		    $booking_date   = date('Y-m-d h:i:s A');
		    $dateSlot = $this->input->post('booking-date');
		    $timeSlot = $this->input->post('booking-time');
		    $travellerType = $this->input->post('traveller-type');
		    $total_price = $this->input->post('total_net_price');
		    date_default_timezone_set('Asia/Kolkata'); 
		    $create_date = date('Y-m-d h:i:s A');   
		    $fullNameCount = count($this->input->post('full_name'));
		    $family_kides = $this->input->post('family_kides');
		    $kidsCount = count($this->input->post('kids_full_name'));
		    $additional_cost_desc = $this->input->post('additional_cost_desc');
		    $additional_cost_price = $this->input->post('additional_cost_price');
		    
		    $sgst_price_value = $this->input->post('sgst_price_value');
		    $cgst_price_value = $this->input->post('cgst_price_value');
		    $igst_price_value = $this->input->post('igst_price_value');
		    
		    $itineraryTitle = $this->input->post('itineraryTitle');
		    $timeFromHost = $this->input->post('timeFromHost');
		    $timeToHost = $this->input->post('timeToHost');
		    $itineraryDate = $this->input->post('booking-date');
		    $term_condition = $this->input->post('term_condition');
		    $special_mention = $this->input->post('special_mention');
		    $traveller_price = $this->input->post('traveller_price');
	    
	    	//echo $term_condition;die;
	        //$country_code = 'CXP';
	    	$country_code = 'CE';
	        $numbers = mt_rand(00000, 99999);         
	        $booking_id   = $country_code.'-'.$numbers;	        
	        if($loggedInId==''){
	      		$hostType = $userType;
	      	}else{
	       		$hostType = 'User';
	      	}
		        $booking_data = array(
		            'booking_id' => $booking_id,
		           'host_id' => $loggedInId,
		           'host_type' => $hostType,
		           'itinerary_id' => $itineraray_id,
		           'route_slot_id' => $timeSlot,
		           'service_id' => $service_id,
		           'itinerary_title' => $itineraryTitle,
		           'itinerary_date' => $itineraryDate,
		           'time_from_host' => $timeFromHost,
		           'time_to_host' => $timeToHost,
		           'booking_date' => $booking_date,
		           'available_date_slots' => $dateSlot,
		           'available_time_slots' => null,
		           'traveller_type' => $travellerType,
		           'full_name' => $default_full_name,
		           'email' => $email,
		           'international_phone_no' => $international_phone,
		           'phone_no' => $phone_no,
		           'sgst' => $sgst_price_value,
		           'cgst' => $cgst_price_value,
		           'igst' => $igst_price_value,
		           'total_amount' => $total_price,
		           'additional_cost'=>$additional_cost_price,
		           'term_condition' => $term_condition,
		           'special_mention'=> $special_mention,
		           'traveller_price'=> $traveller_price,
		           'created_at' => $create_date
		    	);

		    	//echo "<pre>";print_r($booking_data);die;
		    	$lastTranId = $this->Booking_model->saveBookingData($booking_data);
		    	//print_r($lastTranId);die;
		    	if($fullNameCount>=$kidsCount){
		    		$loopCount = $fullNameCount+$kidsCount;
		    	}
			  	if($fullNameCount<=$kidsCount){
			      $loopCount = $fullNameCount+$kidsCount;
			    }

			if(!empty($lastTranId)) {
				if(!empty($this->input->post('full_name'))){
					foreach($this->input->post('full_name') as $key=>$value){
						$othersdata['transaction_id'] = $lastTranId;
						$othersdata['host_id'] = $loggedInId;
						$othersdata['traveller_type'] = $travellerType;
						$othersdata['adults_name'] = $this->input->post('full_name')[$key];
						if($travellerType=='privateType'){
							$othersdata['adults_counts'] = $this->input->post('private_number');
						}
						if($travellerType=='groupType'){
							$othersdata['adults_counts'] = $this->input->post('group_number');
						}
						if($travellerType=='familyType'){
							$othersdata['adults_counts'] = $this->input->post('family_number');
						}
						$othersdata['created_at'] = $create_date;
						//$this->Booking_model->saveothersTransaction($othersdata);
						$this->db->insert('txn_transaction_details', $othersdata);
					}
				}
				if(!empty($this->input->post('kids_full_name_10')) && $this->input->post('kids_full_name_10')!=''){
				        foreach($this->input->post('kids_full_name_10') as $key=>$dataval){
				        	$otherskidsdata['transaction_id'] = $lastTranId;
				        	$otherskidsdata['host_id'] = $loggedInId;
				        	$otherskidsdata['traveller_type'] = $travellerType; 
				        	$kids10_Data[] = array('kids_name'=>$dataval,'kids_counts'=>count($this->input->post('kids_full_name_10')),
			                               'kids10_price'=>$this->input->post('traveller_kids_10_price'));
				        }
				    $otherskidsdata['kids_10'] = isset($kids10_Data)?json_encode($kids10_Data):'';			         
			    }
			    if(!empty($this->input->post('kids_full_name_7')) && $this->input->post('kids_full_name_7')!=''){
			    	foreach($this->input->post('kids_full_name_7') as $key=>$dataval){
			    		$otherskidsdata['transaction_id'] = $lastTranId;
			    		$otherskidsdata['host_id'] = $loggedInId;
			    		$otherskidsdata['traveller_type'] = $travellerType;
			    		$kids7_Data[] = array('kids_name'=>$dataval,'kids_counts'=>count($this->input->post('kids_full_name_7')),
			                              'kids7_price'=>$this->input->post('traveller_kids_7_price'));
			       	}
			        $otherskidsdata['kids_7'] = isset($kids7_Data)?json_encode($kids7_Data):'';			         
			    }
			    if(!empty($this->input->post('kids_full_name_5')) && $this->input->post('kids_full_name_5')!=''){
			    	foreach($this->input->post('kids_full_name_5') as $key=>$dataval){
			    		$otherskidsdata['transaction_id'] = $lastTranId;
			    		$otherskidsdata['host_id'] = $loggedInId;
			    		$otherskidsdata['traveller_type'] = $travellerType;
			    		$kids5_Data[] = array('kids_name'=>$dataval,'kids_counts'=>count($this->input->post('kids_full_name_5')),
			                              'kids5_price'=>$this->input->post('traveller_kids_5_price'));
			       	}
			        $otherskidsdata['kids_5'] = isset($kids5_Data)?json_encode($kids5_Data):'';			         
			    }
			    if(!empty($this->input->post('kids_full_name_10')) || $this->input->post('kids_full_name_7')!='' || $this->input->post('kids_full_name_5')!=''){
				       $otherskidsdata['created_at'] = $create_date;        
				       $this->db->insert('txn_transaction_kids', $otherskidsdata);
			        }



			    if(isset($total_price)){			    	
			    	$cityexplorers_id = "155164";
			    	//$working_key="C5248E8CFE27B2923FFF01A4290B237F";
			    	$working_key="019F1584515E89C80D465EAFDBAFE2F9";
			    	//$access_code="AVFX80FH04CE59XFEC";
			    	$access_code="AVFP82GA94BL69PFLB";
			    	//$merchant_data='155164';
		            //$working_key='C5248E8CFE27B2923FFF01A4290B237F';//Shared by		            
		            //$access_code='AVFX80FH04CE59XFEC';//Shared by CCAVENUES		            
		            $ccavdelts['currency']		="INR";
		            $ccavdelts['merchant_id']    = $cityexplorers_id;
		            $ccavdelts['amount']         = $total_price;
		            $ccavdelts['tid']            = time();
		            $ccavdelts['booking_type']   = $travellerType;
		            $ccavdelts['order_id']       = $booking_id;
		            $ccavdelts['traveller_name'] = $default_full_name;
		            $ccavdelts['traveller_email']= $email;
		            $ccavdelts['traveller_phone']= $phone_no;
		            
		            //$ccavdelts['merchant_id']    = $cityexplorers_id;
		            $ccavdelts['redirect_url']   = SITEURL."thanks/$booking_id";
		            
		            //$ccavdelts['cancel_url']     = SITEURL.'footer/thanks';
		            $ccavdelts['cancel_url']     = SITEURL."fail/$booking_id"; 
		            $ccavdelts['language']       = "EN";
		            //$ccavdelts['currency']       = 'INR';
		            //echo"<pre>";print_r($ccavdelts);die;
		              foreach($ccavdelts as $key => $value){
		              	  $merchant_data.=$key.'='.$value.'&';
		              }
		            //  $merchant_data = $merchant_data.'merchant_id=155164&';
		              $ccarr = explode('&', $merchant_data);
		            //  echo "<pre>";print_r($ccarr);die;
		            //	echo"<pre>";print_r($merchant_data);die;
		              $encrypted_data=$this->encrypt($merchant_data,$working_key);

		              $dy = $this->decrypt($encrypted_data);

		              if($encrypted_data){
		                  $this->session->set_userdata('encrypted_data',$encrypted_data);
		                  $this->session->set_userdata('access_code',$access_code);
		                  //return redirect('payment');
		              }
			    	$this->session->set_userdata('total_amount',$total_price);
			    	$this->session->set_userdata('itineraryTitle',$itineraryTitle);
		          	$this->session->set_userdata('origin_city',$origin_city);
		          	$this->session->set_userdata('booking_id',$booking_id);
		          	$this->session->set_userdata('itinerarayLang',$userLanguage);
		          	$this->session->set_userdata('itinerarayId',$itineraray_id);
		        }
		        echo 'success';die;
		    }else{
			    echo 'error';die;
			}
		    
      	}


      public function book_allItenerary(){

        $loggedInId = $this->session->userdata('id');		
        $itineraray_id = $this->input->post('itinerary_id');		
		$service_id = $this->input->post('service_id');
		$userType = $this->input->post('userType');
		$userLanguage = $this->input->post('userLang');
        $default_full_name = $this->input->post('default_full_name');
        $email = $this->input->post('email');
		$itineraryTitle = $this->input->post('itinerary_title');
        $international_phone = $this->input->post('international_phone');
        $phone_no = $this->input->post('phone_no');
        $origin_city = $this->input->post('origin_city');
        date_default_timezone_set('Asia/Kolkata'); 
        $booking_date   = date('Y-m-d h:i:s A');
        $dateSlot = $this->input->post('booking-date');
        $timeSlot = $this->input->post('booking-time');
		$travellerType = $this->input->post('traveller-type');
		$total_price = $this->input->post('total_net_price');
		date_default_timezone_set('Asia/Kolkata'); 
        $create_date = date('Y-m-d h:i:s A');		
		$fullNameCount = count($this->input->post('full_name'));
		$family_kides = $this->input->post('family_kides');
		$kidsCount = count($this->input->post('kids_full_name'));
		$additional_cost_desc = $this->input->post('additional_cost_desc');
		$additional_cost_price = $this->input->post('additional_cost_price');
		
		$sgst_price_value = $this->input->post('sgst_price_value');
		$cgst_price_value = $this->input->post('cgst_price_value');
		$igst_price_value = $this->input->post('igst_price_value');
		
		$itineraryTitle = $this->input->post('itineraryTitle');
		$timeFromHost = $this->input->post('timeFromHost');
		$timeToHost = $this->input->post('timeToHost');
		$itineraryDate = $this->input->post('itineraryDate');
		$term_condition = $this->input->post('term_condition');
		$special_mention = $this->input->post('special_mention');
		$traveller_price = $this->input->post('traveller_price');
		
		//echo $term_condition;die;
        $country_code = 'CXP';       
        $numbers = mt_rand(00000, 99999);         
        $booking_id   = $country_code.'-'.$numbers;
        if($loggedInId==''){
			$hostType = $userType;
			}
        else{
			 $hostType = 'User';
			}    
       $booking_data = array(
	               'booking_id' => $booking_id,
				   'host_id' => $loggedInId,
				   'host_type' => $hostType,
				   'itinerary_id' => $itineraray_id,
				   'route_slot_id' => $timeSlot,
				   'service_id' => $service_id,
				   'itinerary_title' => $itineraryTitle,
				   'itinerary_date' => $itineraryDate,
				   'time_from_host' => $timeFromHost,
				   'time_to_host' => $timeToHost,
				   'booking_date' => $booking_date,
				   'available_date_slots' => $dateSlot,
				   'available_time_slots' => null,
				   'traveller_type' => $travellerType,
				   'full_name' => $default_full_name,
				   'email' => $email,
				   'international_phone_no' => $international_phone,
				   'phone_no' => $phone_no,
				   'sgst' => $sgst_price_value,
				   'cgst' => $cgst_price_value,
				   'igst' => $igst_price_value,
				   'total_amount' => $total_price,
				   'additional_cost'=>$additional_cost_price,
				   'term_condition' => $term_condition,
				   'special_mention'=> $special_mention,
				   'traveller_price'=> $traveller_price,
				   'created_at' => $create_date
	   );
	
      $lastTranId = $this->Booking_model->saveBookingData($booking_data);
	 
	  if($fullNameCount>=$kidsCount){
		  $loopCount = $fullNameCount+$kidsCount;
		  }
	if($fullNameCount<=$kidsCount){
		  $loopCount = $fullNameCount+$kidsCount;
		  }
		 
	  if(!empty($lastTranId)){	 
	     if(!empty($this->input->post('full_name'))){
		   foreach($this->input->post('full_name') as $key=>$value){
			    $othersdata['transaction_id'] = $lastTranId;
				$othersdata['host_id'] = $loggedInId;
				$othersdata['traveller_type'] = $travellerType;
				$othersdata['adults_name'] = $this->input->post('full_name')[$key];
				if($travellerType=='privateType'){
					$othersdata['adults_counts'] = $this->input->post('private_number');
					}
				if($travellerType=='groupType'){
					$othersdata['adults_counts'] = $this->input->post('group_number');
					}
				if($travellerType=='familyType'){
					$othersdata['adults_counts'] = $this->input->post('family_number');
					}				
				 $othersdata['created_at'] = $create_date;	
				 //$this->Booking_model->saveothersTransaction($othersdata);
				 $this->db->insert('txn_transaction_details', $othersdata);
			   }			
		 }
		 if(!empty($this->input->post('kids_full_name_10')) && $this->input->post('kids_full_name_10')!=''){		 
		    
			 foreach($this->input->post('kids_full_name_10') as $key=>$dataval){
			    $otherskidsdata['transaction_id'] = $lastTranId;
				$otherskidsdata['host_id'] = $loggedInId;
				$otherskidsdata['traveller_type'] = $travellerType;	
				
				$kids10_Data[] = array('kids_name'=>$dataval,'kids_counts'=>count($this->input->post('kids_full_name_10')),
				                       'kids10_price'=>$this->input->post('traveller_kids_10_price'));				
			 }
			  $otherskidsdata['kids_10'] = isset($kids10_Data)?json_encode($kids10_Data):'';
				/*if($family_kides==10){
					$otherskidsdata['kids_10'] = $this->input->post('kids_full_name')[$key];
					$otherskidsdata['kids_counts'] = $this->input->post('number_10');
					$otherskidsdata['kids_10_price'] = $this->input->post('traveller_kids_10_price');
					}
				if($family_kides==7){
					$otherskidsdata['kids_7'] = $this->input->post('kids_full_name')[$key];
					$otherskidsdata['kids_counts'] = $this->input->post('number_7');
					$otherskidsdata['kids_7_price'] = $this->input->post('traveller_kids_7_price');
					}
			    if($family_kides==5){
					$otherskidsdata['kids_5'] = $this->input->post('kids_full_name')[$key];
					$otherskidsdata['kids_counts'] = $this->input->post('number_5');
					$otherskidsdata['kids_5_price'] = $this->input->post('traveller_kids_5_price');
					}*/
				 //$otherskidsdata['created_at'] = $create_date;				
				 //$this->db->insert('txn_transaction_kids', $otherskidsdata);
			   
			   
			 }
			 
			if(!empty($this->input->post('kids_full_name_7')) && $this->input->post('kids_full_name_7')!=''){		    
			 foreach($this->input->post('kids_full_name_7') as $key=>$dataval){
			    $otherskidsdata['transaction_id'] = $lastTranId;
				$otherskidsdata['host_id'] = $loggedInId;
				$otherskidsdata['traveller_type'] = $travellerType;	
				
				$kids7_Data[] = array('kids_name'=>$dataval,'kids_counts'=>count($this->input->post('kids_full_name_7')),
				                      'kids7_price'=>$this->input->post('traveller_kids_7_price'));				
			 }
			   $otherskidsdata['kids_7'] = isset($kids7_Data)?json_encode($kids7_Data):'';				
			  // $otherskidsdata['created_at'] = $create_date;				
			  // $this->db->insert('txn_transaction_kids', $otherskidsdata);			   
			   
			 }
			 
		if(!empty($this->input->post('kids_full_name_5')) && $this->input->post('kids_full_name_5')!=''){		    
			 foreach($this->input->post('kids_full_name_5') as $key=>$dataval){
			    $otherskidsdata['transaction_id'] = $lastTranId;
				$otherskidsdata['host_id'] = $loggedInId;
				$otherskidsdata['traveller_type'] = $travellerType;	
				
				$kids5_Data[] = array('kids_name'=>$dataval,'kids_counts'=>count($this->input->post('kids_full_name_5')),
				                      'kids5_price'=>$this->input->post('traveller_kids_5_price'));				
			 }
			   $otherskidsdata['kids_5'] = isset($kids5_Data)?json_encode($kids5_Data):'';			   
			   
		 }
		 
		 if(!empty($this->input->post('kids_full_name_10')) || $this->input->post('kids_full_name_7')!='' || $this->input->post('kids_full_name_5')!=''){
			 $otherskidsdata['created_at'] = $create_date;				
			 $this->db->insert('txn_transaction_kids', $otherskidsdata);
			 }
					
			
			if(isset($total_price)){
			      $sesArrdata = array();
				  
				  $this->session->set_userdata('total_amount',$total_price);
				  $this->session->set_userdata('itineraryTitle',$itineraryTitle);
				  $this->session->set_userdata('origin_city',$origin_city);
				  $this->session->set_userdata('booking_id',$booking_id);
				  $this->session->set_userdata('itinerarayLang',$userLanguage);
				  $this->session->set_userdata('itinerarayId',$itineraray_id);
			  }
			  
			  //========== New Mail fun. on 27-06-19 =======//
			   $this->manualBookingMail($booking_id);
			  //======== END Fun.=========== on 27-06-19 // 
			echo 'success';die;
		  }else{
		    echo 'error';die;
		  }     
   }
   
   //============ Axis Bank Payment function Start by robin on 18-01-19 ================//
  public function axisbank_payment(){
   $amountVal = $this->session->userdata('total_amount');
   $amountData = $amountVal*100; // amount multiply by 100 for currency in INR   
   $itineraryTitle = $this->session->userdata('itineraryTitle');
   $origin_city = $this->session->userdata('origin_city');
   $booking_id = $this->session->userdata('booking_id');
   $lang = $this->session->userdata('itinerarayLang');
   $itinerary_id = $this->session->userdata('itinerarayId');   
   //$infoData = $itineraryTitle.' ,'.$lang.' ,'.$origin_city;
   $infoData = $itineraryTitle;
   $this->load->view('footer_page/axisbank_payment',compact('amountData','infoData','booking_id','itinerary_id'));
}

//========== Axis Bank Payment Return URL Function add new code on 25-04-19==========//
public function merchant_do(){
	$utility = new Utility();
	$config = $utility->config;

	$enckey = $config['ENC_KEY'];
	$SECURE_SECRET = $config['SECURE_SECRET'];
	$gateWayURL = $config['GATEWAY_URL'];
	$debug = $config['DEBUG_FLAG'];

	// get inputs
	$data = $_POST;

	$data['vpc_Version'] = $config['VERSION'];
	$data['vpc_AccessCode'] = $config['MERCHANT_ACCESS_CODE'];
	$data['vpc_MerchantId'] = $config['MERCHANT_ID'];
	$data['vpc_ReturnURL'] = $config['RETURN_URL'];

	//Remove inprocess (submit button)
	unset($data["inprocess"]);

	//------- sort on keys
	ksort($data);

	$str = $SECURE_SECRET;
	$dataToPostToPG = "";
	foreach($data as $key => $val)
	{
		$str = $str . $val;
		$dataToPostToPG .= $key."=".$val."::";
	}
	//Remove lat ::
	$pos = strrpos($dataToPostToPG, "::");
	if($pos !== false)
	{
		$dataToPostToPG = substr_replace($dataToPostToPG, "", $pos, strlen("::"));	
	}

	$SecureHash = hash('sha256', utf8_encode($str));
	$dataToPostToPG="vpc_SecureHash=".$SecureHash."::".$dataToPostToPG;

	$ciphertext_base64=$utility->encrypt($dataToPostToPG, $enckey);

	if($debug)
	{
		echo "<pre>"; //------- readable format output
		echo "<br>......... String to calculate Secure Hash ..........<br>";
		print_r($str);

		echo "<br>......... Secure Hash ..........<br>";
		print_r($SecureHash);

		echo "<br>......... Data To Post to PG ..........<br>";
		print_r($dataToPostToPG);

		echo "<br>......... Encrypted data to Post to PG ..........<br>";
		print_r($ciphertext_base64);
		
	}	
	$this->load->view('footer_page/merchant_do',compact('gateWayURL','ciphertext_base64','data'));

}
//==========End code ==============//

//========== add new code on 25-04-19==========//
public function merchant_dr(){	
	//echo '<pre>';print_r($_POST);die;
	$utility = new Utility();
	$config = $utility->config;

	$enckey = $config['ENC_KEY'];
	$SECURE_SECRET = $config['SECURE_SECRET'];
	$gateWayURL = $config['GATEWAY_URL'];
	$debug = $config['DEBUG_FLAG'];

	$received_data = $_POST;

	if(!$received_data || $received_data['EncDataResp'] == "")
	{
		print "No response from PG";
		exit;
	}	

	$ciphertext_dec = "";
	
	$ciphertext_base64 = $received_data['EncDataResp'];
	
	$ciphertext_dec = $utility->decrypt($ciphertext_base64, $enckey);
	
	// remove last occurrence of ::
	$pos = strrpos($ciphertext_dec, "::");
    if($pos !== false){
        $ciphertext_dec = substr_replace($ciphertext_dec, "", $pos, strlen("::"));
    }

	$array_data_string = "";
	$array_data_string = explode("::", $ciphertext_dec);

	$origial_array = array();
	if($array_data_string){
		foreach($array_data_string as  $value){
			$temp_array = explode("||", $value);
			$origial_array[ $temp_array[0] ] = $temp_array[1];
		}
	}
	//echo '<pre>';print_r($origial_array);die;
	
	//========== axisbank response array and mail function =========//
    $this->axisbankResponse($origial_array);
	//==========END mail function ============//
	//$this->load->view('footer_page/merchant_dr');
}
//==========End code ==============//

public function axisbankResponse($origial_array){	
	$bookingId = $origial_array['vpc_MerchTxnRef'];
	$responseData = $this->Booking_model->fetchTransactionData($bookingId);
	//echo '<pre>';print_r($responseData[0]);die; 
	$transactionDetail = $this->Booking_model->fetchTransaction_Detail($responseData[0]->id);
	$adminMaiStatusData = $this->Booking_model->getAdminStatus($responseData[0]->itinerary_id);
	$itineraryHostData = $this->Booking_model->getHostDetails($responseData[0]->itinerary_id);
	$itineraryUserData = $this->Booking_model->getUsersData($itineraryHostData[0]->user_id);
	$routeslotData = $this->Booking_model->getRouteSlotData($responseData[0]->itinerary_id,$responseData[0]->route_slot_id);
	$transactionKidsData = $this->Booking_model->getTransactionKidsData($responseData[0]->id);
	$admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	$super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
	
	//echo "<pre>";print_r($itineraryHostData);die;
	if(isset($bookingId)){
	   if($origial_array['vpc_TxnResponseCode']=='B'){		
	       if(!empty($responseData)){
		      
			    $config = $this->smtpCredential();			  
			  						
						foreach($responseData as $value){
							$data = $value;							
							}
						if(!empty($transactionDetail)){							 
							 $data->adults = $transactionDetail;
							}
						else{
							 $data->adults = '';
							}
						if(!empty($itineraryHostData)){
							$data->hostdetail = $itineraryHostData[0];
							}
						else{
							 $data->hostdetail = '';
							}
						if(!empty($itineraryUserData)){
							$data->userdetail = $itineraryUserData[0];
							}
						else{
							 $data->userdetail = '';
							}
						if(!empty($routeslotData)){
							 $data->slotdata = $routeslotData[0];
							}
						else{
							$data->slotdata = '';
							}
						if(!empty($transactionKidsData)){
							$data->kidsData = $transactionKidsData;
							}else{
							  $data->kidsData = '';
							}	
						//$data->img =  base_url().'assets/itinerary_files/gallery/banner_img_01_1558009483.jpg';					   
						//echo '<pre>';print_r($data);//die;		                       
                        $body = $this->load->view('mailer/axis_payment_success', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        $this->email->to($responseData[0]->email,	$admin_email);
						
                        $this->email->subject('Booking Success');
                        $this->email->message($body);
                        $this->email->send();
						
						//======== Itinerarie Booking SMS on mobile no.========//
						//sendSMS($responseData[0]->phone_no, 'your itinerary has been booked');
				 
			 }
			 //============ Mail For IWL Host ===========//
			if(!empty($adminMaiStatusData)){
			   if($adminMaiStatusData[0]->mail_for_admin==1){
			     
				   $config = $this->smtpCredential();				 
			     						
						foreach($responseData as $value){
							$data = $value;							
							}
						if(!empty($transactionDetail)){							 
							 $data->adults = $transactionDetail;
							}
						else{
							 $data->adults = '';
							}
						 
						$body = $this->load->view('mailer/axis_payment_success', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        $this->email->to($itineraryHostData[0]->host_email);
                        $this->email->subject('City Explorers - Booking Confirmation');
                        $this->email->message($body);
                        $this->email->send();
						
						//======== Itinerarie Booking SMS on mobile no.========//
						//sendSMS($itineraryHostData[0]->host_mob_num, 'Guest Itinerary has been booked');
						  
					  }
			   }
			  $this->load->view('footer_page/thanks',compact('bookingId')); 
			  //https://cityexplorers.in/demo/thanks/555
				
			    
		  }
	  else if($origial_array['vpc_TxnResponseCode']=='F'){
	     	 
			 $config = $this->smtpCredential();		  								
						
			$data['ststua'] = 'Fail';	                       
			$body = $this->load->view('mailer/axis_payment_fail', $data, true );
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from(SERVER_MAIL, 'City Explorers');
			$this->email->to($responseData[0]->email,$admin_email);
			$this->email->subject('City Explorers - Booking Failed');
			$this->email->message($body);
			$this->email->send();						
				 
			 
		 $this->load->view('footer_page/fail',compact('bookingId'));

		}
     else if($origial_array['vpc_TxnResponseCode']=='Aborted'){
	     		
				$config = $this->smtpCredential();
				
				$data['ststua'] = 'Fail';	                       
				$body = $this->load->view('mailer/axis_payment_fail', $data, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from(SERVER_MAIL, 'City Explorers');
				$this->email->to($responseData[0]->email,$admin_email);
				$this->email->subject('City Explorers - Booking Failed');
				$this->email->message($body);
				$this->email->send();
		 $this->load->view('footer_page/fail',compact('bookingId'));
		}		
	}
	   
}


/*public function axisbank_3party_order_dr(){
	//echo '<pre>';print_r($_GET);die;
	$bookingId = $_GET['vpc_MerchTxnRef'];
	//$_GET['vpc_CSCResultCode']
	if($_GET['vpc_TxnResponseCode']==0){	    
		 $responseData = $this->Booking_model->fetchTransactionData($bookingId);
		//echo '<pre>';print_r($responseData[0]);die; 
		$transactionDetail = $this->Booking_model->fetchTransaction_Detail($responseData[0]->id);
		$adminMaiStatusData = $this->Booking_model->getAdminStatus($responseData[0]->itinerary_id);
		$itineraryHostData = $this->Booking_model->getHostDetails($responseData[0]->itinerary_id);
		$routeslotData = $this->Booking_model->getRouteSlotData($responseData[0]->itinerary_id,$responseData[0]->route_slot_id);
		
		//echo '<pre>';print_r($itineraryHostData);die;
	 if(!empty($responseData)){			 
			  $config = Array(
							'protocol' => 'smtp',							
							'smtp_host' => 'ssl://smtp.gmail.com',
							'smtp_port' => 465,							
							//'smtp_user' =>'donotreply@wealthveda.com',							
							//'smtp_pass' => 'rijkdom@125',
							'smtp_user' =>'ops@indiawithlocals.com',							
					        'smtp_pass' => 'oldlap12=',
							'mailtype'  => 'html', 
							'charset'   => 'iso-8859-1'
						);	
						
						foreach($responseData as $value){
							$data = $value;							
							}
						if(!empty($transactionDetail)){							 
							 $data->adults = $transactionDetail;
							}
						else{
							 $data->adults = '';
							}
						if(!empty($itineraryHostData)){
							$data->hostdetail = $itineraryHostData[0];
							}
						else{
							 $data->hostdetail = '';
							}
						if(!empty($routeslotData)){
							 $data->slotdata = $routeslotData[0];
							}
						else{
							$data->slotdata = '';
							}	
						
						//echo '<pre>';print_r($data);die;		                       
                        $body = $this->load->view('mailer/axis_payment_success', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('ops@indiawithlocals.com', 'City Explorers');
                        $this->email->to($responseData[0]->email,'ops1@indiawithlocals.com');
                        //$this->email->cc('robin@unikove.com'); 
                        $this->email->subject('Booking Success');
                        $this->email->message($body);
                        $this->email->send();						
				 
			 }
			 //============ Mail For IWL Admin ===========//
			if(!empty($adminMaiStatusData)){
			   if($adminMaiStatusData[0]->mail_for_admin==1){
			     $config = Array(
							'protocol' => 'smtp',
							'smtp_host' => 'ssl://smtp.googlemail.com',
							'smtp_port' => 465,
							'smtp_user' =>'ops@indiawithlocals.com',							
					        'smtp_pass' => 'oldlap12=',
							'mailtype'  => 'html', 
							'charset'   => 'iso-8859-1'
						);
						
						foreach($responseData as $value){
							$data = $value;							
							}
						if(!empty($transactionDetail)){							 
							 $data->adults = $transactionDetail;
							}
						else{
							 $data->adults = '';
							}		
					  
						$body = $this->load->view('mailer/axis_payment_success', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('ops@indiawithlocals.com', 'City Explorers');
                        $this->email->to($itineraryHostData[0]->host_email);
                        //$this->email->cc('robin@unikove.com'); 
                        $this->email->subject('Booking Success');
                        $this->email->message($body);
                        $this->email->send();
						  
					  }
			   } 
			    
		  }
	  else{
	     			 
			  $config = Array(
							'protocol' => 'smtp',							
							'smtp_host' => 'ssl://smtp.gmail.com',
							'smtp_port' => 465,							
							'smtp_user' =>'ops@indiawithlocals.com',							
					        'smtp_pass' => 'oldlap12=',
							'mailtype'  => 'html', 
							'charset'   => 'iso-8859-1'
						);											
						
						$data['ststua'] = 'Fail';	                       
                        $body = $this->load->view('mailer/axis_payment_fail', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('ops@indiawithlocals.com', 'City Explorers');
                        $this->email->to($responseData[0]->email,'ops1@indiawithlocals.com');
                        //$this->email->cc('robin@unikove.com'); 
                        $this->email->subject('Payment Fail');
                        $this->email->message($body);
                        $this->email->send();						
				 
			 
		 $this->load->view('footer_page/fail',compact('bookingId'));
		}	
	//$this->load->view('footer_page/PHP_VPC_3Party_Order_DR');
	$this->load->view('footer_page/thanks',compact('bookingId'));
}
*/
//============ function Axis bank Payment functions End =====================//
   
          public function payment(){         
          	$encrypted_data = $this->session->userdata('encrypted_data');			 
			$access_code = $this->session->userdata('access_code');	

          	$this->load->view('footer_page/payment',['encrypted_data'=>$encrypted_data,'access_code'=>$access_code]);

          }
          public function thanks($booking_id){

            $responseData = $this->Booking_model->fetchTransactionData($booking_id);
			
			$transactionDetail = $this->Booking_model->fetchTransaction_Detail($responseData[0]->id);
			$adminMaiStatusData = $this->Booking_model->getAdminStatus($responseData[0]->itinerary_id);
			$itineraryHostData = $this->Booking_model->getHostDetails($responseData[0]->itinerary_id);
			$itineraryUserData = $this->Booking_model->getUsersData($itineraryHostData[0]->user_id);
			$routeslotData = $this->Booking_model->getRouteSlotData($responseData[0]->itinerary_id,$responseData[0]->route_slot_id);
			$transactionKidsData = $this->Booking_model->getTransactionKidsData($responseData[0]->id);
			$admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
			$super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
			//echo '<pre>';print_r($itineraryUserData);die; 
			//echo "<pre>";print_r($itineraryHostData);die;
			if(isset($booking_id)){
			    if(!empty($responseData)){
				    $config = $this->smtpCredential();			  
					foreach($responseData as $value){
						$data = $value;							
					}
					if(!empty($transactionDetail)){							 
						$data->adults = $transactionDetail;
					}
					else{
						 $data->adults = '';
						}
					if(!empty($itineraryHostData)){
						$data->hostdetail = $itineraryHostData[0];
						}
					else{
						 $data->hostdetail = '';
						}
					if(!empty($itineraryUserData)){
						$data->userdetail = $itineraryUserData[0];
						}
					else{
						 $data->userdetail = '';
						}
					if(!empty($routeslotData)){
						 $data->slotdata = $routeslotData[0];
						}
					else{
						$data->slotdata = '';
						}
					if(!empty($transactionKidsData)){
						$data->kidsData = $transactionKidsData;
						}else{
						  $data->kidsData = '';
						}	
					//$data->img =  base_url().'assets/itinerary_files/gallery/banner_img_01_1558009483.jpg';					   
					//echo '<pre>';print_r($data);//die;		                       
                    $body = $this->load->view('mailer/axis_payment_success', $data, true );
                    $this->load->library('email',$config);
                    $this->email->set_newline("\r\n");
                    $this->email->from(SERVER_MAIL, 'City Explorers');
                    $this->email->to($responseData[0]->email,	$admin_email);
                    $this->email->cc('share@cityexplorers.in',	"CEPL");
					$this->email->subject('Booking Success');
                    $this->email->message($body);
                    $this->email->send();
					
					//======== Itinerarie Booking SMS on mobile no.========//
					//sendSMS($responseData[0]->phone_no, 'your itinerary has been booked');
						 
					}
					$this->Booking_model->update_payment_status($booking_id);  
	              $this->load->view('footer_page/thanks',compact('bookingId'));
	              $this->session->unset_userdata('encrypted_data');
	             $this->session->unset_userdata('access_code');
				}
			}

            /*
            $booking_details = $this->Booking_model->booking_detail($booking_id);
            // echo'<pre>';print_r($booking_details);   die;
            //$host_id = $booking_details[0]->host_id;
            //$main_traveller_name = $booking_details[0]->main_traveller_name;
            $booking_id =  $booking_details[0]->booking_id;
            $booking_date =  $booking_details[0]->booking_date; 
            //$book_time_slotes =  $booking_details[0]->book_time_slots;
            //$itinerary_type =  $booking_details[0]->itinerary_type; 
            $traveller_email =  $booking_details[0]->traveller_email;
            $traveller_phone_no =  $booking_details[0]->traveller_phone_no; 
            $other_traveller_name =  $booking_details[0]->other_traveller_name;
            $total_amount =  $booking_details[0]->total_amount;

            $hoster_data = $this->Booking_model->get_host_info($host_id);
            $host_email = $hoster_data[0]->host_email;
            $price_per = $hoster_data[0]->private_price;

            $itinerary_title = $hoster_data[0]->itinerary_title;
            $host_mob_num = $hoster_data[0]->host_mob_num;
             $host_first_name = $hoster_data[0]->host_first_name;
             $host_last_name = $hoster_data[0]->host_last_name;
             $origin_citys = $hoster_data[0]->origin_city;
             //$other_traveller_name = $hoster_data[0]->other_traveller_name;
						 $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
						 $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));

						 $config = $this->smtpCredential();
						
			   $hoster_name = $host_first_name.' '.$host_last_name;
				$book['name1']          = $main_traveller_name;
				$book['booking_id']      =  $booking_id;
				$book['itinerary_title'] =  $itinerary_title;
				$book['hoster_name']     = $hoster_name;
				$book['hoster_email']    =  $host_email;
				$book['host_mob_num']    = $host_mob_num;
				$book['origin_citys']    = $origin_citys;
				$book['booking_date']    = $booking_date;
				$book['book_time_slotes'] = $book_time_slotes;
				$book['itinerary_type'] = $itinerary_type;
				$book['main_traveller_name'] = $main_traveller_name;
				$book['traveller_email'] = $traveller_email;  
				$book['traveller_phone_no'] = $traveller_phone_no;
				$book['other_traveller_name'] = $other_traveller_name;
				$book['total_amount'] = $total_amount;
				$book['price'] = $price_per;
				
				
				$body = $this->load->view('mailer/booking_mailer', $book, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from(SERVER_MAIL, 'City Explorers');
				$this->email->to($traveller_email);
				$this->email->cc($super_admin_email);
				$this->email->bcc($admin_email);

				$this->email->subject('Booking');
				$this->email->message($body);

			   $this->email->send();

             
              $this->Booking_model->update_payment_status($booking_id);  
              $this->load->view('footer_page/thanks',['booking_id'=> $booking_id]);
              $this->session->unset_userdata('encrypted_data');
             $this->session->unset_userdata('access_code');
         }*/


            public function bookingfail($booking_id){

            $booking_details = $this->Booking_model->booking_detail($booking_id);
             //print_r($booking_details);   
             $host_id = $booking_details[0]->host_id;
             $main_traveller_name = $booking_details[0]->main_traveller_name;
            $booking_id =  $booking_details[0]->booking_id;
            $booking_date =  $booking_details[0]->booking_date; 
             $book_time_slotes =  $booking_details[0]->book_time_slots;
            $itinerary_type =  $booking_details[0]->itinerary_type; 
            $traveller_email =  $booking_details[0]->traveller_email;
            $traveller_phone_no =  $booking_details[0]->traveller_phone_no; 
            $other_traveller_name =  $booking_details[0]->other_traveller_name;
            $total_amount =  $booking_details[0]->total_amount;

            $hoster_data = $this->Booking_model->get_host_info($host_id);
             $host_email = $hoster_data[0]->host_email;
             $itinerary_title = $hoster_data[0]->itinerary_title;
            $host_mob_num = $hoster_data[0]->host_mob_num;
             $host_first_name = $hoster_data[0]->host_first_name;
             $host_last_name = $hoster_data[0]->host_last_name;
             $origin_citys = $hoster_data[0]->origin_city;
             //$other_traveller_name = $hoster_data[0]->other_traveller_name;
						 $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
						 $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
                $config = $this->smtpCredential();
						
				$hoster_name = $host_first_name.' '.$host_last_name;
				$book['name1']          = $main_traveller_name;
				$book['booking_id']      =  $booking_id;
				
				
				
				$body = $this->load->view('mailer/fail_mailer', $book, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from(SERVER_MAIL, 'City Explorers');
				$this->email->to($traveller_email);				
				$this->email->cc(array($admin_email,$super_admin_email,'share@cityexplorers.in'));
				$this->email->subject('Booking Failed');
				$this->email->message($body);
			   $this->email->send();

             

              $this->load->view('footer_page/fail',['booking_id'=> $booking_id]);
              $this->session->unset_userdata('encrypted_data');
             $this->session->unset_userdata('access_code');
            }
            // public function leave_mailer($id){

            //   //echo  "cancle page";
            //   $this->load->view('booking_mailer');
            // }
   
  public function book_itineraries(){
       $loginHostid = $this->session->userdata('id');	  
	   $itinerary_id = $this->input->get('itinerary_id',true);
	   $serviceId = $this->input->get('serviceid',true);
	   $itineraryId = base64_decode($itinerary_id);	
	   $userType = $this->input->get('user_type',true);	
	   $userLang = $this->input->get('lang',true);	  
	   $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
	   $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);
	   $itineraryValue =  $this->Booking_model->fetchItineraryData($itineraryId,$serviceId);
	   $termConditionData = $this->Booking_model->fetchTermsConditions(); // it's function call terms and condition
		
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('getallpickpoints');
	   
	   foreach($itineraryValue as $itinerary){
		    $itineraryData = $itinerary;
		   }
		//echo '<pre>';print_r($itineraryData);die;   
	   $this->load->view('itineraries/book_itineraries',compact('hostimage','allowItinerary','itineraryData',
	                                                            'itineraryId','serviceId','userType','userLang','termConditionData'));
	  }
  public function book_itineraries_demo(){
       $loginHostid = $this->session->userdata('id');	  
	   $itinerary_id = $this->input->get('itinerary_id',true);
	   $serviceId = $this->input->get('serviceid',true);
	   $itineraryId = base64_decode($itinerary_id);	
	   $userType = $this->input->get('user_type',true);	
	   $userLang = $this->input->get('lang',true);	  
	   $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
	   $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);
	   $itineraryValue =  $this->Booking_model->fetchItineraryData($itineraryId,$serviceId);
	   $termConditionData = $this->Booking_model->fetchTermsConditions(); // it's function call terms and condition
		
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('getallpickpoints');
	   
	   foreach($itineraryValue as $itinerary){
		    $itineraryData = $itinerary;
		   }
		//echo '<pre>';print_r($itineraryData);die;   
	   $this->load->view('itineraries/book_itineraries_demo',compact('hostimage','allowItinerary','itineraryData',
	                                                            'itineraryId','serviceId','userType','userLang','termConditionData'));
	  }
	  
//=========== function for update date slots on 05-03-19 by Robin Rajput ===========//
public function dateSlots(){
	$chkbox = $this->input->post('chkbox');
	$itineraryId = $this->input->post('itineraryId');
	$serviceId = $this->input->post('serviceId');	
	$msg = $this->Booking_model->updateDateSlot($chkbox,$itineraryId);
	$itineraryValue =  $this->Booking_model->fetchItineraryData($itineraryId,$serviceId);
	
	$routeSlotData =  $this->Booking_model->fetchRouteSlotData($itineraryId,$serviceId);
	
	//echo '<pre>';print_r($itineraryValue);die;
	
	/*date_default_timezone_set('Asia/Kolkata'); 
	$create_time = date('h:i A');
	$create_date = date('d/m/Y');
	$starttime = $itineraryValue[0]->aviaiable_time_form_host;  // your start time
	$endtime =  $itineraryValue[0]->aviaiable_time_to_host;  // End time
	$duration = '60';  // split by 60 mins
	
	$array_of_time = array ();
	$start_time    = strtotime ($starttime); //change to strtotime
	$end_time      = strtotime ($endtime); //change to strtotime			
	$add_mins  =  $duration * 60;
	
	while ($start_time <= $end_time) // loop between time
	{
	  
	  $trs = date ("h:i A", $start_time);
	  if($itineraryValue[0]->current_date_slot==$create_date){
	  if(strtotime($trs)>=strtotime($create_time)){
		  $array_of_time[] = date ("h:i A", $start_time);
		  }
	  }else{
		  $array_of_time[] = date ("h:i A", $start_time);
	  }
	   //$array_of_time[] = date ("h:i A", $start_time);
	   
	   $start_time += $add_mins; // to check endtie=me	
	  
	}
	$html = '';
	      $idFlag =1;
			$i=1;
			$endkey = end($array_of_time);
			$endkey = key($array_of_time);
			foreach($array_of_time as $key => $timeSlots) {			 
			  if($key<$endkey){			  
				
			$html .= '<li class="item">
			 <div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" id="bookingTime-0'.$idFlag.'" name="booking-time" class="custom-control-input"  value="'.$array_of_time[$key].' - '.$array_of_time[$i].'" required />
			  <label class="custom-control-label" for="bookingTime-0'.$idFlag.'">'.$array_of_time[$key].' - '.$array_of_time[$i].'</label>
			 </div>
		    </li>';		   
		     $idFlag++;						 
			 $i++;
			   }
			  
			}*/
			
   date_default_timezone_set('Asia/Kolkata'); 
   $create_time = date('h:i A');
   $create_date = date('d/m/Y');
     $html = '';
	 $idFlag =1;
		foreach($routeSlotData as $key=>$slotVal):
		$starttime = $slotVal->start_pickup_time;  // your start time
		$endtime =   $slotVal->end_dropoff_time;  // End time
		
		$start_time    = strtotime ($starttime); //change to strtotime
		$end_time      = strtotime ($endtime); //change to strtotime
		
		if(strtotime($itineraryValue[0]->current_date_slot) >= strtotime($create_date)){
		  //if($start_time>=strtotime($create_time)){
			$html .= '<li class="item">
			 <div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" id="bookingTime-0'.$idFlag.'" name="booking-time" class="custom-control-input time_slots" 
			    value="'.$slotVal->id.'" required />
			  <label class="custom-control-label" for="bookingTime-0'.$idFlag.'">'.$starttime.' - '.$endtime.'</label>
			 </div>
			</li>';		
			//}
		}			
		$idFlag++;
		endforeach;
				
	 echo $html;die;
   }
   
//============= SMTP credential function ===========//
public function smtpCredential(){
	
	      $config = Array(
						'protocol' => 'smtp',							
						'smtp_host' => 'ssl://smtp.gmail.com',
						'smtp_port' => 465,							
						'smtp_user' =>'help@cityexplorers.in',							
						'smtp_pass' =>'1cesb241',						
						'mailtype'  => 'html', 
						'charset'   => 'iso-8859-1'
						);	
		return $config;				
	
}


//========== Manual booking Mail Function on 27-06-19 by robin ===========//

public function manualBookingMail($bookingId){
  
    $responseData = $this->Booking_model->fetchTransactionData($bookingId);
	//echo '<pre>';print_r($responseData[0]);die; 
	$transactionDetail = $this->Booking_model->fetchTransaction_Detail($responseData[0]->id);
	$adminMaiStatusData = $this->Booking_model->getAdminStatus($responseData[0]->itinerary_id);
	$itineraryHostData = $this->Booking_model->getHostDetails($responseData[0]->itinerary_id);
	$routeslotData = $this->Booking_model->getRouteSlotData($responseData[0]->itinerary_id,$responseData[0]->route_slot_id);
	$transactionKidsData = $this->Booking_model->getTransactionKidsData($responseData[0]->id);
	$admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	$super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
	
	$usersData = $this->Booking_model->getUsersData($adminMaiStatusData[0]->user_id);
	//echo '<pre>';print_r($usersData);die; 
   if(!empty($responseData)){
		      
			    $config = $this->smtpCredential();			  
			  						
						foreach($responseData as $value){
							$data = $value;							
							}
						if(!empty($transactionDetail)){							 
							 $data->adults = $transactionDetail;
							}
						else{
							 $data->adults = '';
							}
						if(!empty($itineraryHostData)){
							$data->hostdetail = $itineraryHostData[0];
							}
						else{
							 $data->hostdetail = '';
							}
						if(!empty($routeslotData)){
							 $data->slotdata = $routeslotData[0];
							}
						else{
							$data->slotdata = '';
							}
						if(!empty($transactionKidsData)){
							$data->kidsData = $transactionKidsData;
							}else{
							  $data->kidsData = '';
							}

						if(!empty($adminMaiStatusData))
						{
							$data->additional_cost_description = $adminMaiStatusData[0]->additional_cost_description;
						}
						else
						{
							$data->additional_cost_description = '';
						}
						
						if(!empty($usersData))
						{
							$data->finalHost = $usersData[0];
						}
						else
						{
							$data->finalHost = '';
						}
						
						$data->selectedDate = $data->available_date_slots;
											   
						//echo '<pre>';print_r($data);die;		                       
                        $body = $this->load->view('mailer/axis_payment_success', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
												$this->email->to($responseData[0]->email,	$admin_email);
												

                       
                        $this->email->subject('Booking Success');
                        $this->email->message($body);
                        $this->email->send();
						
						//======== Itinerarie Booking SMS on mobile no.========//
						//sendSMS($responseData[0]->phone_no, 'your itinerary has been booked');
				 
			 }
			 //============ Mail For IWL Host ===========//
			if(!empty($adminMaiStatusData)){
			   if($adminMaiStatusData[0]->mail_for_admin==1){
			     
				   $config = $this->smtpCredential();				 
			     						
						foreach($responseData as $value){
							$data = $value;							
							}
						if(!empty($transactionDetail)){							 
							 $data->adults = $transactionDetail;
							}
						else{
							 $data->adults = '';
							}
						 
						$body = $this->load->view('mailer/axis_payment_success', $data, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        //$this->email->to($itineraryHostData[0]->host_email);                        
                        $this->email->to($usersData[0]->host_email);                        
                        $this->email->subject('City Explorers - Booking('.$bookingId.') Confirmation');
                        $this->email->message($body);
                        $this->email->send();
						
						//======== Itinerarie Booking SMS on mobile no.========//
						//sendSMS($itineraryHostData[0]->host_mob_num, 'Guest Itinerary has been booked');
						  
					  }
			   }
}


}


?>