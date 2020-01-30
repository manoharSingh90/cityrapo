<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends CI_Controller {

	 function __construct()
	{
		parent::__construct();
		$this->load->model('Itinerarie_model'); 
		$this->load->model('User_model'); 
		date_default_timezone_set("Asia/Kolkata");
		
		$this->load->model('Admin_model');
	}

	public function trademark_caution_notice(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/trademarkcautionnotice',compact('loggedInUser','hostimage','allowItinerary'));
	}

	public function contact(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/contact',compact('loggedInUser','hostimage','allowItinerary'));
	}
	
	public function policies(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/policies',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function cancellation(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/cancellation',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function terms_and_conditions(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/terms&conditions',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function legal(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/legal',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function about(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/about',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function advertisement(){
	     $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/advertising',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function copyright(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/copyright',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function photo_credites(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/photo_credits',compact('loggedInUser','hostimage','allowItinerary'));
	}
	
	public function soon(){
	     $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/soon',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function media(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/media',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function why_host(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/why_host',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function all_host(){
		$loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/host_type',compact('loggedInUser','hostimage','allowItinerary'));
	}

	public function take_pledge(){
		$loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/take_a_pledge',compact('loggedInUser','hostimage','allowItinerary'));
	}


	public function knowmore_india(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_india',compact('loggedInUser','hostimage','allowItinerary'));
	}
// NORTH INDIA	
	public function knowmore_north(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_culture(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_culture',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_food(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_food',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_heritage(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_heritage',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_people(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_people',compact('loggedInUser','hostimage','allowItinerary'));
	}
//NORTH EAST INDIA	
	public function knowmore_north_east(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_east',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_east_culture(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_east_culture',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_east_food(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_east_food',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_east_heritage(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_east_heritage',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_north_east_people(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_north_east_people',compact('loggedInUser','hostimage','allowItinerary'));
	}
//EAST INDIA	
	public function knowmore_east(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_east',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_east_culture(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_east_culture',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_east_food(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_east_food',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_east_heritage(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_east_heritage',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_east_people(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_east_people',compact('loggedInUser','hostimage','allowItinerary'));
	}
//WEST INDIA	
	public function knowmore_west(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_west',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_west_culture(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_west_culture',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_west_food(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_west_food',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_west_heritage(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_west_heritage',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_west_people(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_west_people',compact('loggedInUser','hostimage','allowItinerary'));
	}
//SOUTH INDIA	
	public function knowmore_south(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_south',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_south_culture(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_south_culture',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_south_food(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_south_food',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_south_heritage(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_south_heritage',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_south_people(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_south_people',compact('loggedInUser','hostimage','allowItinerary'));
	}
//CENTRAL INDIA	
	public function knowmore_central(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_central',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_central_culture(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_central_culture',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_central_food(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_central_food',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_central_heritage(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_central_heritage',compact('loggedInUser','hostimage','allowItinerary'));
	}
	public function knowmore_central_people(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/knowmore_central_people',compact('loggedInUser','hostimage','allowItinerary'));
	}
	// public function knowmore_south(){
	// 	$this->load->view('footer_page/knowmore_south');
	// }
	
public function how_it_works(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/how_it_works',compact('loggedInUser','hostimage','allowItinerary'));
	}	

public function feedback(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/feedback',compact('loggedInUser','hostimage','allowItinerary'));
	}
	
public function cookies(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/cookies',compact('loggedInUser','hostimage','allowItinerary'));
	}
	
public function privacy(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/privacy',compact('loggedInUser','hostimage','allowItinerary'));
	}

public function faq(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/faq',compact('loggedInUser','hostimage','allowItinerary'));
	}

public function work_with_us(){
	    $loggedInUser = $this->session->userdata('id');
		$hostimage = $this->Itinerarie_model->getProfileimage($loggedInUser);
		$allowItinerary = $this->Itinerarie_model->allowHost($loggedInUser);
		$this->load->view('footer_page/work_with_us',compact('loggedInUser','hostimage','allowItinerary'));
	}
	
	
 public function contactform(){
      $this->load->view('footer_page/contact_form');
	 }	

 public function sendContactForm(){
      $dataForm = $this->input->post();
	  
	  $data = array(
	       'name'=>$dataForm['name'],
		   'email'=>$dataForm['email'],
		   'mobile_no'=>$dataForm['mobile'],
		   'message'=>$dataForm['message'],
		   'created_at'=>date('Y-m-d h:i:s A')
	  );
	  $msg = $this->User_model->insertContactData($data);
	  
	  $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	  $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
	  	 
	  if($msg==1){
	  
	       //$this->sendSMS();//call sms function		   
		   $config = Array(
					'protocol' => 'smtp',							
					'smtp_host' => 'ssl://smtp.gmail.com',
					'smtp_port' => 465,							
					'smtp_user' =>'help@cityexplorers.in',							
					'smtp_pass' =>'1cesb241',
					'mailtype'  => 'html', 
					'charset'   => 'iso-8859-1'
				);	
				$maildata['userName'] = $dataForm['name'];
				$maildata['userEmail'] = $dataForm['email'];
				$maildata['userMobile'] = $dataForm['mobile'];
				$maildata['userMessage'] = $dataForm['message'];
				//echo '<pre>';print_r($data);die;
				$body = $this->load->view('mailer/contact_query_mail', $maildata, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from($dataForm['email']);
				$this->email->to($admin_email, 'City Explorers');				
				$this->email->subject('Contact Query Mail');
				$this->email->message($body);
				$this->email->send();
				echo 'success';die;
		  }
	   
	 }
	 
	 
public function sendFaqForm(){
  $dataForm = $this->input->post();
  
  $data = array(
	   'name'=>$dataForm['name'],
	   'email'=>$dataForm['email'],
	   'message'=>$dataForm['message'],
	   'created_at'=>date('Y-m-d h:i:s A')
  );
  $msg = $this->User_model->insertContactData($data);
  
  $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
  $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
 
  if($msg==1){
  
	   //$this->sendSMS();//call sms function		   
	   $config = Array(
				'protocol' => 'smtp',							
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,							
				'smtp_user' =>'help@cityexplorers.in',							
				'smtp_pass' =>'1cesb241',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);	
			$maildata['userName'] = $dataForm['name'];
			$maildata['userEmail'] = $dataForm['email'];
			$maildata['userMessage'] = $dataForm['message'];
			//echo '<pre>';print_r($data);die;
			$body = $this->load->view('mailer/faq_query_mail', $maildata, true );
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from($dataForm['email']);
			$this->email->to($admin_email, 'City Explorers');				
			$this->email->subject('Faq Query Mail');
			$this->email->message($body);
			$this->email->send();
			echo 'success';die;
	  }
   
 }
 
 
public function sendAdvertiseForm(){
  $dataForm = $this->input->post();
  
  $data = array(
	   'name'=>$dataForm['name'],
	   'email'=>$dataForm['email'],
	   'mobile_no'=>$dataForm['mobile'],
	   'message'=>$dataForm['message'],
	   'created_at'=>date('Y-m-d h:i:s A')
  );
  $msg = $this->User_model->insertContactData($data);
  
  $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
  $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
 
  if($msg==1){
  
	   //$this->sendSMS();//call sms function		   
	   $config = Array(
				'protocol' => 'smtp',							
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,							
				'smtp_user' =>'help@cityexplorers.in',							
				'smtp_pass' =>'1cesb241',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);	
			$maildata['userName'] = $dataForm['name'];
			$maildata['userEmail'] = $dataForm['email'];
			$maildata['userMobile'] = $dataForm['mobile'];
			$maildata['userMessage'] = $dataForm['message'];
			//echo '<pre>';print_r($data);die;
			$body = $this->load->view('mailer/advertise_query_mail', $maildata, true );
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from($dataForm['email']);
			$this->email->to($admin_email, 'City Explorers');				
			$this->email->subject('Advertise Query Mail');
			$this->email->message($body);
			$this->email->send();
			echo 'success';die;
	  }
   
 }
 
 
 public function sendFeedbackForm(){
  $dataForm = $this->input->post();
  
  $data = array(
	   'name'=>$dataForm['name'],
	   'gender'=>$dataForm['gender'],
	   'dob'=>$dataForm['dob'],
	   'nationality'=>$dataForm['nationality'],
	   'state'=>$dataForm['state'],
	   'address'=>$dataForm['address'],
	   'pincode'=>$dataForm['pincode'],
	   'marital_status'=>$dataForm['marital_status'],
	   'experience'=>$dataForm['experience'],
	   'city'=>$dataForm['city'],
	   'hostname'=>$dataForm['hostname'],
	   'date_of_experience'=>$dataForm['date_of_experience'],
	   'enjoy_most'=>$dataForm['enjoy_most'],
	   'enjoy_reason'=>$dataForm['enjoy_reason'],
	   'suggestion'=>$dataForm['suggestion'],
	   'testimonial'=>$dataForm['testimonial'],
	   'experience_radio'=>$dataForm['experience_radio'],
	   'information_radio'=>$dataForm['information_radio'],
	   'offering_radio'=>$dataForm['offering_radio'],
	   'coordination_radio'=>$dataForm['coordination_radio'],
	   'info_exp_radio'=>$dataForm['info_exp_radio'],
	   'host_radio'=>$dataForm['host_radio'],
	   'money_radio'=>$dataForm['money_radio'],
	   'rate_radio'=>$dataForm['rate_radio'],
	   'responsible_radio'=>$dataForm['responsible_radio'],
	   'hear_about_us'=>$dataForm['hear_about_us'],
	   'extend_services'=>$dataForm['extend_services'],
	   'recommend_radio'=>$dataForm['recommend_radio'],
	   'newsletter_radio'=>$dataForm['newsletter_radio']
  );
  //$msg = $this->User_model->insertContactData($data);
  
  $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
  $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
 
  //if($msg==1){
  
	   //$this->sendSMS();//call sms function		   
	   $config = Array(
				'protocol' => 'smtp',							
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,							
				'smtp_user' =>'help@cityexplorers.in',							
				'smtp_pass' =>'1cesb241',
				'mailtype'  => 'html', 
				'charset'   => 'iso-8859-1'
			);
			$maildata['name'] = $dataForm['name'];
			$maildata['gender'] = $dataForm['gender'];
			$maildata['dob'] = $dataForm['dob'];
			$maildata['nationality'] = $dataForm['nationality'];
			$maildata['state'] = $dataForm['state'];
			$maildata['address'] = $dataForm['address'];
			$maildata['pincode'] = $dataForm['pincode'];
			$maildata['marital_status'] = $dataForm['marital_status'];
			$maildata['experience'] = $dataForm['experience'];
			$maildata['city'] = $dataForm['city'];
			$maildata['hostname'] = $dataForm['hostname'];
			$maildata['date_of_experience'] = $dataForm['date_of_experience'];
			$maildata['enjoy_most'] = $dataForm['enjoy_most'];
			$maildata['enjoy_reason'] = $dataForm['enjoy_reason'];
			$maildata['suggestion'] = $dataForm['suggestion'];
			$maildata['testimonial'] = $dataForm['testimonial'];
			$maildata['experience_radio'] = $dataForm['experience_radio'];
			$maildata['information_radio'] = $dataForm['information_radio'];
			$maildata['offering_radio'] = $dataForm['offering_radio'];
			$maildata['coordination_radio'] = $dataForm['coordination_radio'];
			$maildata['info_exp_radio'] = $dataForm['info_exp_radio'];
			$maildata['host_radio'] = $dataForm['host_radio'];
			$maildata['money_radio'] = $dataForm['money_radio'];
			$maildata['rate_radio'] = $dataForm['rate_radio'];
			$maildata['responsible_radio'] = $dataForm['responsible_radio'];
			$maildata['hear_about_us'] = $dataForm['hear_about_us'];
			$maildata['extend_services'] = $dataForm['extend_services'];
			$maildata['recommend_radio'] = $dataForm['recommend_radio'];
			$maildata['newsletter_radio'] = $dataForm['newsletter_radio'];
			//echo '<pre>';print_r($data);die;
			$body = $this->load->view('mailer/feedback_query_mail', $maildata, true );
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from("help@cityexplorers.in", 'City Explorers');	
			$this->email->to($admin_email);
			$this->email->subject('Feedback Query Mail');
			$this->email->message($body);
			$this->email->send();
			echo 'success';die;
	 // }
   
 }
	 
	 
//====== Send SMS for user mobile number function =========//
public function sendSMS(){
	// Account details
	$apiKey = urlencode('wYrBr1dWl4I-X2v4i3HqIwFPRrxuKMZ61G6HeoQLOc');
	
	// Message details
	$numbers = array(7982142067, 9720118113);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode('Hi, Testing.....');
 	$numbers = implode(',', $numbers);
 	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;
}
	 
}