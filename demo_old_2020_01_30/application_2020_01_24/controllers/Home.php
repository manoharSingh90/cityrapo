<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	 function __construct()
	{
		parent::__construct();
		$this->load->model('Itinerarie_model'); 
		$this->load->model('Admin_model');
		$this->load->model('User_model');
	}
	public function index(){	
	     $logedin  = $this->session->userdata('id');		 
		 $cityData = $this->Itinerarie_model->getcities();
		 $themesData = $this->Itinerarie_model->selectThemes();	
		 $hostimage = $this->Itinerarie_model->getProfileimage($logedin);
		 $allowItinerary = $this->Itinerarie_model->allowHost($logedin);
		 $hostTypeData = $this->Admin_model->fetchHostType();
		 //$hostProfileData = $this->Admin_model->getHostProfile($logedin); // function on 29 April 2019
		 $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
		 //echo '<pre>';print_r($itineraryLang);die;		
		 $this->load->view('home/home',compact('cityData','themesData','hostimage','allowItinerary','hostTypeData','itineraryLang'));   
		 			 
	}
	
/*public function fetchItinerary(){
	$logedin  = $this->session->userdata('id');
    $page =  @$_GET['page'];
	$serviceId =  @$_GET['serviceId'];	
  
    $itineraryData = $this->Itinerarie_model->homeItineraries($page,$serviceId);   
	if(!empty($itineraryData)){
	  $data['iterator'] = $itineraryData;
	}else{
	  $data['iterator'] = '';
	}		
	 //echo '<pre>';print_r($data);die;	
	 $this->load->helper('getallthemes');
	 $this->load->helper('getcategory');
	 $this->load->helper('hostname');
	 $this->load->helper('getfamilydata');
	 $this->load->helper('getallpickpoints');
	if($this->input->is_ajax_request())
		{	if(!empty($data['iterator'])){       
			 $data['view']=$this->load->view('home/fetch_itinerary',compact('data','serviceId'),true);			
			echo json_encode($data);die;
		  }else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
		}
				
}*/

public function servicetab_search(){
	$serviceId = $this->input->post('serviceId');
	$privateType = $this->input->post('privateType');
	$groupType = $this->input->post('groupType');
	$cityid = $this->input->post('cityid');
	$date = $this->input->post('date');
	$themesid = $this->input->post('themesid');
	$familyType = $this->input->post('familyType');
    $hostType = $this->input->post('hostType');
	$itineraryLang =  $this->input->post('itineraryLang');
	$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType,$itineraryLang);
	if(!empty($itineraryData)){
	   $data['iterator'] = $itineraryData;
	}else{
	  $data['iterator'] = '';
	}
	//$data['iterator'] = $itinerary_data;
	//echo '<pre>';print_r($data);die;	
	 $this->load->helper('getallthemes');
	 $this->load->helper('getcategory');
	 $this->load->helper('hostname');
	 $this->load->helper('getfamilydata');
	 $this->load->helper('getallpickpoints');
	 $this->load->helper('getfamilymultidata');
	 $this->load->helper('gethostname');
	if($this->input->is_ajax_request())
		{
	 //$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType);
	 //echo $this->db->last_query();die;
	if(!empty($data['iterator'])){
			 $data['view']=$this->load->view('home/search_itineraries',compact('data','serviceId'),true);			
			 echo json_encode($data);die;
			}else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
			
		}	
}

//============== New code added for home page selected services ============//
public function walk(){
	 $logedin  = $this->session->userdata('id');
	 $cityData = $this->Itinerarie_model->getcities();
	 $themesData = $this->Itinerarie_model->selectThemes();	
	 $hostimage = $this->Itinerarie_model->getProfileimage($logedin);
	 $allowItinerary = $this->Itinerarie_model->allowHost($logedin);
	 $hostTypeData = $this->Admin_model->fetchHostType();
	 $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
	 
	$serviceId = $this->input->post('serviceId');
	$privateType = $this->input->post('privateType');
	$groupType = $this->input->post('groupType');
	$cityid = $this->input->post('cityid');
	$date = $this->input->post('date');
	$themesid = $this->input->post('themesid');
	$familyType = $this->input->post('familyType');
    $hostType = $this->input->post('hostType'); 
   	$itinerary_Lang =  $this->input->post('itineraryLang');
	$page =  $this->input->post('page');	
	
	$itineraryData = $this->Itinerarie_model->loadSearchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType,$itinerary_Lang,$page);
	
	if(!empty($itineraryData)){
	   $data['iterator'] = $itineraryData;
	}else{
	  $data['iterator'] = '';
	}		
	 $this->load->helper('getallthemes');
	 $this->load->helper('getcategory');
	 $this->load->helper('hostname');
	 $this->load->helper('getfamilydata');
	 $this->load->helper('getallpickpoints');
	 $this->load->helper('getfamilymultidata');
	 $this->load->helper('gethostname');
	if($this->input->is_ajax_request())
		{	 
	      if(!empty($data['iterator'])){	
			 $data['view']=$this->load->view('home/search_itineraries',compact('data','serviceId','cityData','themesData','hostimage','allowItinerary','hostTypeData','itineraryLang'),true);			
			 echo json_encode($data);die;
			}else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
			
		}else{
		 $this->load->view('home/home',compact('data','serviceId','cityData','themesData','hostimage','allowItinerary','hostTypeData',       'itineraryLang'));
		}	
}

//========== home page session function Start============//
public function session(){
	 $logedin  = $this->session->userdata('id');
	 $cityData = $this->Itinerarie_model->getcities();
	 $themesData = $this->Itinerarie_model->selectThemes();	
	 $hostimage = $this->Itinerarie_model->getProfileimage($logedin);
	 $allowItinerary = $this->Itinerarie_model->allowHost($logedin);
	 $hostTypeData = $this->Admin_model->fetchHostType();
	 $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
	 
	$serviceId = $this->input->post('serviceId');
	$privateType = $this->input->post('privateType');
	$groupType = $this->input->post('groupType');
	$cityid = $this->input->post('cityid');
	$date = $this->input->post('date');
	$themesid = $this->input->post('themesid');
	$familyType = $this->input->post('familyType');
    $hostType = $this->input->post('hostType');
	$itinerary_Lang =  $this->input->post('itineraryLang');
	//$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType);
	$page =  $this->input->post('page');	
	$itineraryData = $this->Itinerarie_model->loadSearchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType,$itinerary_Lang,$page);
	
	if(!empty($itineraryData)){
	   $data['iterator'] = $itineraryData;
	}else{
	  $data['iterator'] = '';
	}		
	 $this->load->helper('getallthemes');
	 $this->load->helper('getcategory');
	 $this->load->helper('hostname');
	 $this->load->helper('getfamilydata');
	 $this->load->helper('getallpickpoints');
	 $this->load->helper('getfamilymultidata');
	 $this->load->helper('gethostname');
	if($this->input->is_ajax_request())
		{	
	if(!empty($data['iterator'])){
			 $data['view']=$this->load->view('home/search_itineraries',compact('data','serviceId','cityData','themesData','hostimage','allowItinerary','hostTypeData','itineraryLang'),true);			
			 echo json_encode($data);die;
			}else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
			
		}else{
		 $this->load->view('home/home',compact('data','serviceId','cityData','themesData','hostimage',
		                                       'allowItinerary','hostTypeData','itineraryLang'));
		}	
}

//========== home page experience function Start============//
public function experience(){
	 $logedin  = $this->session->userdata('id');
	 $cityData = $this->Itinerarie_model->getcities();
	 $themesData = $this->Itinerarie_model->selectThemes();	
	 $hostimage = $this->Itinerarie_model->getProfileimage($logedin);
	 $allowItinerary = $this->Itinerarie_model->allowHost($logedin);
	 $hostTypeData = $this->Admin_model->fetchHostType();
	 $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
	 
	$serviceId = $this->input->post('serviceId');
	$privateType = $this->input->post('privateType');
	$groupType = $this->input->post('groupType');
	$cityid = $this->input->post('cityid');
	$date = $this->input->post('date');
	$themesid = $this->input->post('themesid');
	$familyType = $this->input->post('familyType');
    $hostType = $this->input->post('hostType');
	$itinerary_Lang =  $this->input->post('itineraryLang');
	//$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType);
	$page =  $this->input->post('page');	
	$itineraryData = $this->Itinerarie_model->loadSearchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType,$itinerary_Lang,$page);
	
	if(!empty($itineraryData)){
	   $data['iterator'] = $itineraryData;
	}else{
	  $data['iterator'] = '';
	}		
	 $this->load->helper('getallthemes');
	 $this->load->helper('getcategory');
	 $this->load->helper('hostname');
	 $this->load->helper('getfamilydata');
	 $this->load->helper('getallpickpoints');
	 $this->load->helper('getfamilymultidata');
	 $this->load->helper('gethostname');
	if($this->input->is_ajax_request())
		{	 
	if(!empty($data['iterator'])){
			 $data['view']=$this->load->view('home/search_itineraries',compact('data','serviceId','cityData','themesData','hostimage','allowItinerary','hostTypeData','itineraryLang'),true);			
			 echo json_encode($data);die;
			}else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
			
		}else{
		 $this->load->view('home/home',compact('data','serviceId','cityData','themesData','hostimage',
		                                       'allowItinerary','hostTypeData','itineraryLang'));
		}	
}


//========== home page meetup function Start============//
public function meetup(){
	 $logedin  = $this->session->userdata('id');
	 $cityData = $this->Itinerarie_model->getcities();
	 $themesData = $this->Itinerarie_model->selectThemes();	
	 $hostimage = $this->Itinerarie_model->getProfileimage($logedin);
	 $allowItinerary = $this->Itinerarie_model->allowHost($logedin);
	 $hostTypeData = $this->Admin_model->fetchHostType();
	 $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
	 
	$serviceId = $this->input->post('serviceId');
	$privateType = $this->input->post('privateType');
	$groupType = $this->input->post('groupType');
	$cityid = $this->input->post('cityid');
	$date = $this->input->post('date');
	$themesid = $this->input->post('themesid');
	$familyType = $this->input->post('familyType');
    $hostType = $this->input->post('hostType');
	$itinerary_Lang =  $this->input->post('itineraryLang');
	//$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType);
	$page =  $this->input->post('page');	
	$itineraryData = $this->Itinerarie_model->loadSearchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType,$itinerary_Lang,$page);
	
	if(!empty($itineraryData)){
	   $data['iterator'] = $itineraryData;
	}else{
	  $data['iterator'] = '';
	}		
	 $this->load->helper('getallthemes');
	 $this->load->helper('getcategory');
	 $this->load->helper('hostname');
	 $this->load->helper('getfamilydata');
	 $this->load->helper('getallpickpoints');
	 $this->load->helper('getfamilymultidata');
	 $this->load->helper('gethostname');
	if($this->input->is_ajax_request())
		{	 
	if(!empty($data['iterator'])){
			 $data['view']=$this->load->view('home/search_itineraries',compact('data','serviceId','cityData','themesData','hostimage','allowItinerary','hostTypeData','itineraryLang'),true);			
			 echo json_encode($data);die;
			}else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
			
		}else{
		 $this->load->view('home/home',compact('data','serviceId','cityData','themesData','hostimage',
		                                       'allowItinerary','hostTypeData','itineraryLang'));
		}	
}


//=========== Leave Message function Start on 08-02-19 =========//
public function leaveMessage(){
	 $fullName = $this->input->post('fname');
	 $email = $this->input->post('email');
	 $phoneNo = $this->input->post('phone_no');
	 $message = $this->input->post('desc');
	 $url = $this->input->post('currentUrl');
	 $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	 $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));


	 //print_r($url);die;

	 $config = $this->smtpCredential();	 
							
		$data['name'] = $fullName;
		$data['email'] = $email;
		$data['phone_no'] = $phoneNo;
		$data['desc'] = $message;
		$data['currentUrl'] = $url;
		
	   $body = $this->load->view('mailer/leave_message', $data, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from('help@cityexplorers.in', 'City Explorers');
				$this->email->to($admin_email);
        $this->email->cc($super_admin_email);
				$this->email->subject('Message from cityexplorer website');
				$this->email->message($body);
				$this->email->send();
		echo 'success';die;		
}

public function detail_itineraries()
	{
	  $itineraryId = $this->uri->segment(2);
	  $serviceId = $this->uri->segment(3);
	  $userLang = $this->uri->segment(4);
	  $backStatus = $this->uri->segment(7); // it's used to back browse itinerary if value is true
	 
	  $itinerary_id = base64_decode($itineraryId);
	  //echo $serviceId;die;
        /*$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$serviceId = $this->input->get('serviceid');
		$userType = $this->input->get('user_type');
		$userLang = $this->input->get('lang');*/		
		$itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
		foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }		  
		//echo '<pre>';print_r($itineraryData);die;
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getallstops');
	   $this->load->helper('gethostname');
	   $this->load->helper('fetchallstops');
	   $this->load->view('home/detail_itineraries',compact('itineraryData','itinerary_id','serviceId',
	                                                        'userType','userLang','backStatus'));
	}
	
public function detail_itineraries_sessions(){
	
	    $itineraryId = $this->uri->segment(2);
	    $serviceId = $this->uri->segment(3);
	    $userLang = $this->uri->segment(4);
		$backStatus = $this->uri->segment(7); // it's used to back browse itinerary if value is true
	 
	    $itinerary_id = base64_decode($itineraryId);
	    /*$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$serviceId = $this->input->get('serviceid');
		$userType = $this->input->get('user_type');
		$userLang = $this->input->get('lang');*/		
		$itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
		$allSpeakers = $this->Itinerarie_model->fetchSpeakers($itinerary_id);
		$attendeesData = $this->Itinerarie_model->fetchAttendees($itinerary_id,$serviceId);
		
		foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }		  
		//echo '<pre>';print_r($itineraryData);die;
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getallstops');
	   $this->load->helper('gethostname');
	   $this->load->helper('getinteresteddata');
	   
	   $this->load->view('home/detail_itineraries_sessions',compact('itineraryData','itinerary_id','serviceId',
	                                   'userType','userLang','allSpeakers','attendeesData','backStatus'));
}	
	
public function detail_itineraries_experiences(){
	
	    $itineraryId = $this->uri->segment(2);
	    $serviceId = $this->uri->segment(3);
	    $userLang = $this->uri->segment(4);
		$backStatus = $this->uri->segment(7); // it's used to back browse itinerary if value is true
	 
	    $itinerary_id = base64_decode($itineraryId);
		
	    /*$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$serviceId = $this->input->get('serviceid');
		$userType = $this->input->get('user_type');
		$userLang = $this->input->get('lang');*/		
		$itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
		$allSpeakers = $this->Itinerarie_model->fetchSpeakers($itinerary_id);
		foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }		  
		//echo '<pre>';print_r($itineraryData);die;
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getallstops');
	   $this->load->helper('gethostname');
	   $this->load->helper('getinteresteddata');
	   
	   $this->load->view('home/detail_itineraries_experiences',compact('itineraryData','itinerary_id','serviceId',
	                                                                  'userType','userLang','allSpeakers','backStatus'));
}	

public function detail_itineraries_meetup(){
	
	    $itineraryId = $this->uri->segment(2);
	    $serviceId = $this->uri->segment(3);
	    $userLang = $this->uri->segment(4);
		$backStatus = $this->uri->segment(7); // it's used to back browse itinerary if value is true
	 
	    $itinerary_id = base64_decode($itineraryId);
	    /*$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$serviceId = $this->input->get('serviceid');
		$userType = $this->input->get('user_type');
		$userLang = $this->input->get('lang');*/		
		$itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
		$allSpeakers = $this->Itinerarie_model->fetchSpeakers($itinerary_id);
		$attendeesData = $this->Itinerarie_model->fetchAttendees($itinerary_id,$serviceId);
		
		foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }		  
		//echo '<pre>';print_r($itineraryData);die;
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getallstops');
	   $this->load->helper('gethostname');
	   $this->load->helper('getinteresteddata');
	   
	   $this->load->view('home/detail_itineraries_meetup',compact('itineraryData','itinerary_id','serviceId','userType',
	                                                              'userLang','allSpeakers','attendeesData','backStatus'));
}	

	public function book_itinerarie($id)
	{
		$details = $this->Itinerarie_model->details_itineraries($id);

		$this->load->view('home/book_itineraries',['booking_data'=>$details]);
	}

	public function search_host(){

		$searchKeys =  $this->input->post('searchCity');
		$searchDates   = date('Y-m-d',strtotime($this->input->post('searchDate')));
		//echo $searchDates; die();

		if($searchKeys == 'All' && $searchDates=='1970-01-01'){
			return redirect('home');
		}elseif($searchKeys !='All' && $searchDates =='1970-01-01' ){	

		     $hoster = $this->Itinerarie_model->hoster_search_city($searchKeys);
		     //print_r($hoster); die();
		     $this->load->view('home/searchhost',['data'=>$hoster,'city'=>$searchKeys ,'dates'=>$searchDates]);
			
		}elseif($searchKeys !='All' && $searchDates !=''){
			$hoster = $this->Itinerarie_model->hoster_search_both($searchKeys,$searchDates);
			//print_r($hoster); die();
		    $this->load->view('home/searchhost',['data'=>$hoster,'city'=>$searchKeys ,'dates'=>$searchDates]);
		}elseif($searchKeys =='All' && !empty($searchDates)){
			$hoster = $this->Itinerarie_model->hoster_search($searchKeys,$searchDates);
			//print_r($hoster); die();
		    $this->load->view('home/searchhost',['data'=>$hoster,'city'=>$searchKeys ,'dates'=>$searchDates]);
		}
		
		 
	}
	public function visitor_login(){
		 $email_id = $this->input->post('visitor_email');
	     $pass = $this->input->post('visitor_pass');
	     if(($email_id == 'user1@iwl.com' || $email_id == 'user2@iwl.com') && 
	     	($pass == '1@#$&123@iwl' || $pass == '1@#156$&@iwl')){
	     	$this->session->set_userdata('status','success');

	            return redirect('home');
	     	
	     }else{
	     	return redirect('home');
	     }
	     
	}
	
public function interested(){
	//$interestedData['user_id'] = $this->input->post('user_id');
	$interestedData['create_itinerary_id'] = $this->input->post('itinerary_id');
	$interestedData['service_id'] = $this->input->post('service_id');
	$interestedData['full_name'] = $this->input->post('full_name');
	$interestedData['email'] = $this->input->post('email');
	$interestedData['phone_no'] = $this->input->post('phone_no');
	$interestedData['created_at'] = date('Y-m-d h:i:s');
	$itineraryUrl = $this->input->post('service_url');
	$admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	$super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
	$rsvpData = $this->Itinerarie_model->insertedData($interestedData);
	
	$hostEmail = $this->Itinerarie_model->getHostEmail($this->input->post('itinerary_id'));
	
	$itineraryData = $this->Itinerarie_model->getitineraryData($this->input->post('itinerary_id'));
	//echo '<pre>';print_r($itineraryData);die;
	
	if($rsvpData=='success'){
	
	  //============= RSVP Mail for Host ==========//
	        $config = $this->smtpCredential();
	   						
			$data['name'] = $interestedData['full_name'];
			$data['email'] = $interestedData['email'];
			$data['phone_no'] = $interestedData['phone_no'];				
			$data['currentUrl'] = $itineraryUrl;
			$data['status'] = 0;
			$data['itineraryData'] = $itineraryData;
			//echo '<pre>';print_r($data);die;
	
			$body = $this->load->view('mailer/rsvp_mail', $data, true );
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from($interestedData['email'], 'City Explorers');
			$this->email->to($hostEmail[0]->host_email);
			$this->email->subject('City Explorers - RSVP Message');
			$this->email->message($body);
			$this->email->send();
			
		   //============= RSVP Mail for Admin ==========//
		    $config = $this->smtpCredential();
									
			$data['name'] = $interestedData['full_name'];
			$data['email'] = $interestedData['email'];
			$data['phone_no'] = $interestedData['phone_no'];				
			$data['currentUrl'] = $itineraryUrl;
			$data['status'] = 1;
			
			$body = $this->load->view('mailer/rsvp_mail', $data, true );
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			$this->email->from($interestedData['email'], 'City Explorers');
			$this->email->to($admin_email);
			$this->email->subject('RSVP Message');
			$this->email->message($body);
			$this->email->send();
			
		    echo 'success';die;
		}else{
		 echo 'error';die;
		}
 }
 
 //============ NEWS LETTER Function ==========//
 public function newsLetter(){
	  $email = $this->input->post('email');
	 
	  if(isset($email)){
		   $emailCount = $this->Itinerarie_model->checkNewsEmail($email);
		  
		   if($emailCount<1){
		        $insertArr['email'] = $email;
				$insertArr['status'] = 1;				
			    $insertData = $this->Itinerarie_model->insertNewsLetterEmail($insertArr);
				if(isset($insertData)){
					 echo 'success';die;
					}else{
					  echo 'db_error';die;
					}
			   }else{
			       echo 'email_error';die;
			   }
		  }
	 }
	 
//============= SMTP credential function ===========//
public function smtpCredential(){
	
	      $config = Array(
						'protocol' => 'smtp',							
						'smtp_host' => 'ssl://smtp.gmail.com',
						'smtp_port' => 465,							
						'smtp_user' =>'help@cityexplorers.in',							
						'smtp_pass' =>'1cesb241',
						//'smtp_user' =>'donotreply@wealthveda.com',							
						//'smtp_pass' => 'rijkdom@125',
						'mailtype'  => 'html', 
						'charset'   => 'iso-8859-1'
						);	
		return $config;				
	
}	 

}
