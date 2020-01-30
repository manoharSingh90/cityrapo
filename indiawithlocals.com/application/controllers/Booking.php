<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Booking extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Booking_model'); 
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

        // echo $last_id = $this->Booking_model->find_last_id();die();

        $itineraray_id = $this->input->post('itineraray_id');
        $host_id = $this->input->post('host_id');
        $main_trav_name = $this->input->post('main_trav_name');
        $main_trav_email = $this->input->post('main_trav_email');
        $main_trav_int_phone = $this->input->post('main_trav_int_phone');
        $main_trav_phone = $this->input->post('main_trav_phone');
        $origin_citys = $this->input->post('origin_citys');

        $book_date   = date('Y/m/d',strtotime($this->input->post('book_date')));
        $book_time_slot = $this->input->post('book_time_slot');
        //echo $create_date  = date('Y/m/d',strtotime($this->input->post('created_date')));die();
        $create_date = date('Y-m-d');
        $adult_count = $this->input->post('adult_count');
        $total_price = $this->input->post('total_price');
        $traveller_type = $this->input->post('traveller_type');
        $country_code = 'IWL';
        // $numbers =  strtoupper(substr(str_shuffle(str_repeat("abcdefghijklmnopqrstuvwxyz", 5)), 0, 5));
        $numbers = mt_rand(00000, 99999);
         
         $booking_id   = $country_code.'-'.$numbers;
        //echo $abc = SITEURL."fail/$booking_id";
        //echo $ccavdelts= SITEURL."thanks/$booking_id" ;die();
        if($this->input->post('other_adult_name') ==''){
          $other_adult='null';
        }else{
          $other_adult_name   = $this->input->post('other_adult_name');
          $other_adult    = implode(',',  $other_adult_name ); 
        }
             
      $booking_data = array(
          'itinerary_id'                     => $itineraray_id,
          'host_id'                          => $host_id,
          'booking_id'                       => $booking_id,
          'created_data'                     => $create_date,
          'itinerary_type'                       => $traveller_type,
          'origin_city'                          => $origin_citys,
          'booking_date'                         => $book_date,
          'book_time_slots'                      => $book_time_slot,
          'no_of_travellers'                     => $adult_count,
          'main_traveller_name'                  => $main_trav_name,
          'traveller_email'                      => $main_trav_email,
          'traveller_international_phone_number' => $main_trav_int_phone,
          'traveller_phone_no'                   => $main_trav_phone,
          'other_traveller_name'                 => $other_adult,
          'total_amount'                         => $total_price
      );
      
       $total_book    = $this->Booking_model->total__book_in_itin($itineraray_id);
       //print_r($total_book);die();

     $total_book = $total_book[0]->ticket; 
       $total_booking  = $total_book+$adult_count;
      if($total_booking >20){
        echo $total_booking;die();

      }else{
      $result = $this->Booking_model->booking_itinerrary($booking_data);

      if($result){

          $merchant_data='155164';
          $working_key='C5248E8CFE27B2923FFF01A4290B237F';//Shared by 
          $access_code='AVFX80FH04CE59XFEC';//Shared by CCAVENUES
          $ccavdelts['booking_type']   = $traveller_type;
          $ccavdelts['order_id']       = $booking_id;
          $ccavdelts['traveller_name'] = $main_trav_name;
          $ccavdelts['traveller_email']= $main_trav_email;
          $ccavdelts['traveller_phone']= $main_trav_phone;
          $ccavdelts['amount']         = $total_price;
          $ccavdelts['tid']            = time();
          $ccavdelts['merchant_id']    = $merchant_data;
          $ccavdelts['currency']       = 'INR';
          $ccavdelts['redirect_url']   = SITEURL."thanks/$booking_id" ;
          //$ccavdelts['cancel_url']     = SITEURL.'footer/thanks';
          $ccavdelts['cancel_url']     = SITEURL."fail/$booking_id"; 
          $ccavdelts['language']       = 'EN';

          foreach($ccavdelts as $key => $value){
              $merchant_data.=$key.'='.$value.'&';
          }
              $encrypted_data=$this->encrypt($merchant_data,$working_key);

          if($encrypted_data){
              $this->session->set_userdata('encrypted_data',$encrypted_data);
              $this->session->set_userdata('access_code',$access_code);
              echo "success";die();
              //return redirect('payment');
          }
        }

      }
   }
          public function payment(){
          	

          	 $encrypted_data = $this->session->userdata('encrypted_data');
			       $access_code = $this->session->userdata('access_code');
			//if($encrypted_data =='' && $access_code==''){}
          	$this->load->view('footer_page/payment',['encrypted_data'=>$encrypted_data,'access_code'=>$access_code]);

          }
          public function thanks($booking_id){

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
             $price_per = $hoster_data[0]->private_price;

             $itinerary_title = $hoster_data[0]->itinerary_title;
            $host_mob_num = $hoster_data[0]->host_mob_num;
             $host_first_name = $hoster_data[0]->host_first_name;
             $host_last_name = $hoster_data[0]->host_last_name;
             $origin_citys = $hoster_data[0]->origin_city;
             //$other_traveller_name = $hoster_data[0]->other_traveller_name;
            
            


            $config = Array(
                        'protocol' => 'smtp',
                        //'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_host' => 'mail.unikove.com',
                        'smtp_port' => 25,
                        'smtp_user' => 'neeraj@unikove.com',
                        'smtp_pass' => 'neeraj@4321',
                        'mailtype'  => 'html', 
                        'charset'   => 'utf-8',
                        'wordwrap'  => TRUE
                        );
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
                        $this->email->from('ask@iwl.help', 'India With Locals');
                        $this->email->to($traveller_email);
                        $this->email->cc('sb@indiawithlocals.com');
                        $this->email->bcc('ops1@indiawithlocals.com,ops@indiawithlocals.com,nidhi@indiacitywalks.com,info@indiacitywalks.com,bookings@indiacitywalks.com,ales@indiacitywalks.com');

                        $this->email->subject('Booking');
                        $this->email->message($body);

                       $this->email->send();

             
              $this->Booking_model->update_payment_status($booking_id);  
              $this->load->view('footer_page/thanks',['booking_id'=> $booking_id]);
              $this->session->unset_userdata('encrypted_data');
             $this->session->unset_userdata('access_code');
            }


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
            
            


            $config = Array(
                        'protocol' => 'smtp',
                        //'smtp_host' => 'ssl://smtp.googlemail.com',
                        'smtp_host' => 'mail.unikove.com',
                        'smtp_port' => 25,
                        'smtp_user' => 'neeraj@unikove.com',
                        'smtp_pass' => 'neeraj@4321',
                        'mailtype'  => 'html', 
                        'charset'   => 'utf-8',
                        'wordwrap'  => TRUE
                        );
                       $hoster_name = $host_first_name.' '.$host_last_name;
                        $book['name1']          = $main_traveller_name;
                        $book['booking_id']      =  $booking_id;
                        
                        
                        
                        $body = $this->load->view('mailer/fail_mailer', $book, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('ask@iwl.help', 'India With Locals');
                        $this->email->to($traveller_email);
                        $this->email->cc('sb@indiawithlocals.com');
                        $this->email->bcc('ops1@indiawithlocals.com,ops@indiawithlocals.com,nidhi@indiacitywalks.com,info@indiacitywalks.com,bookings@indiacitywalks.com,sales@indiacitywalks.com');

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
          		
	}


?>