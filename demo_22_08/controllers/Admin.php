<?php
defined('BASEPATH') OR exit('No direct script access allowed');	
class Admin extends CI_Controller{		
	function __construct()
	    {
		parent::__construct();
		 $this->load->model('Admin_model'); 
		 $this->load->model('Itinerarie_model');
		 $this->load->model('User_model');
		 $ses = $this->session->userdata('adminSes');	
		 date_default_timezone_set('Asia/Kolkata');
		 $this->load->helper('sendsms');
		 $this->load->helper('gethostname');
	   }
	
	 public function login(){ 
		   $ses = $this->session->userdata('adminSes');			   
	  if(!empty($ses)){ 	      
		   //redirect("admin/itineraries");
		    redirect("host");
		  }	 
		else{ 
			 $this->load->view('admin/login');
			 }	 
		 }
		 
	public function index(){
	  $ses = $this->session->userdata('adminSes');
	  if(!empty($ses)){ 
		   $this->load->view("admin/host");
		   
		  }	 
	else{
		  redirect('admin/login');
		 }	  
	  }
		 
	public function logout(){
		  $this->session->sess_destroy();
          redirect('admin/login');
		}
		

	public function dashboard(){	     
	     $data = $this->input->post();
		 //echo '';print_r($data);die;
	     $adminData = $this->Admin_model->fetchAdminData($data['email'],$data['password']);
		 $sesData = json_decode(json_encode($adminData),true);
		 $adminSesArr = array();
		foreach($sesData as $value){
			  $adminSesArr = $value;
			}
			
						
		if(!empty($adminData)){
			$this->session->set_userdata('adminSes',$adminSesArr);			
			if($adminSesArr['admin_type']==1){
				echo 'super_admin';die;
				}
			elseif($adminSesArr['admin_type']==2){
				echo 'sub_admin_one';die;
				}
			elseif($adminSesArr['admin_type']==3){
				echo 'sub_admin_two';die;
				}
		//==== add code by robin on 18-03-19 =====//		
		elseif($adminSesArr['admin_type']==4){
				echo 'translator_1';die;
				}
		elseif($adminSesArr['admin_type']==5){
				echo 'translator_2';die;
				}
		//==== Editor Login condition =====//		
		elseif($adminSesArr['admin_type']==6){
				echo 'editor_login';die;
				}		
		//==== Admin Login condition =====//		
		elseif($adminSesArr['admin_type']==7){
				echo 'admin_login';die;
				}	
			}
		else{
			  echo 'error';die;
			}	     
		
		}
		
	public function itineraries(){
	    $ses = $this->session->userdata('adminSes');
		
	  if($ses['admin_type']!=2){
		$city = $this->input->post('city');	
		$serviceType = $this->input->post('serviceType');
		$searchVal = $this->input->post('itinerarySearch');	
		$hostType = $this->input->post('hostType');
		
		$param = "creates_itinerary.admin_status IN(5,6)";
		if(isset($searchVal) && $searchVal!='')
			$param .= " AND creates_itinerary.itinerary_title LIKE '%".$searchVal."%'";
						
		if(isset($city) && $city!='')
			$param .= " AND creates_itinerary.origin_city='".$city."'";
						
		if(isset($serviceType) && $serviceType!='')
			//$param .= " AND FIND_IN_SET('$serviceType',users_profile.services_offered)";
		 $param .= " AND creates_itinerary.service_id='".$serviceType."'";
		 
		if(isset($hostType) && $hostType!='')			
		 $param .= " AND users_profile.host_verification_type='".$hostType."'";
		  
	     $this->load->helper('hostservices');
		 $this->load->helper('gethostname');
		 $notifyData = $this->Admin_model->fetchHostRows();
		 $cityData = $this->Admin_model->fetchAllCities();
	     $itineraryData = $this->Admin_model->fetchApprovedItineries($param);
		 $hostTypeData = $this->Admin_model->fetchHostType();
		 
		if(!empty($itineraryData)){
		  $data['iterator'] = $itineraryData;
		}else{
		 $data['iterator'] = '';
		}
			
	   if($this->input->is_ajax_request())
		{	
	     if(!empty($data['iterator'])){       
			$data['view']=$this->load->view('admin/itineraries_element',compact('data','notifyData','cityData','hostTypeData'),true);			
			echo json_encode($data);die;
		 }else{
			 $datas['view'] = 'Empty data';			
			 echo json_encode($datas);die;
			}    
		}else{		 
		   $this->load->view('admin/itineraries',compact('data','notifyData','cityData','hostTypeData'));	
		}
		
	}	
	else{ 
			redirect('host');
			}
}
		
public function itineraries_request(){
	   $ses = $this->session->userdata('adminSes');		
	  if($ses['admin_type']!=2){
	    $status = $this->input->post('status');	
		$city = $this->input->post('city');	
		$serviceType = $this->input->post('serviceType');
		$searchVal = $this->input->post('searchVal');
		$hostType = $this->input->post('hostType');
		
		$param = "creates_itinerary.admin_status IN('1', '2','3','4')";
		if(isset($searchVal) && $searchVal!='')
			$param .= " AND creates_itinerary.itinerary_title LIKE '%".$searchVal."%'";
		
		if(isset($status) && $status!='')
			$param .= " AND creates_itinerary.admin_status='".$status."'";
								
		if(isset($city) && $city!='')
			$param .= " AND creates_itinerary.origin_city='".$city."'";
						
		if(isset($serviceType) && $serviceType!='')
			//$param .= " AND FIND_IN_SET('$serviceType',users_profile.services_offered)";
		    $param .= " AND creates_itinerary.service_id = '".$serviceType."'";
		
		if(isset($hostType) && $hostType!='')
			$param .= " AND users_profile.host_verification_type='".$hostType."'";
									
	     $this->load->helper('hostservices');
		 $this->load->helper('gethostname');
	     $itineraryData = $this->Admin_model->fetchUserItineries($param);
		 $notifyData = $this->Admin_model->fetchItineraryRows();
		 $cityData = $this->Admin_model->fetchAllCities();
		 $hostTypeData = $this->Admin_model->fetchHostType();
		
		 if(!empty($itineraryData)){
		   $data['iterator'] = $itineraryData;
		}else{
		  $data['iterator'] = '';
		}
				
	   if($this->input->is_ajax_request())
		{
	   // $itineraryData = $this->Admin_model->fetchUserItineries($param);
		//echo $this->db->last_query();die;
	     if(!empty($data['iterator'])){       
			$data['view']=$this->load->view('admin/itinerary_request_element',compact('data','notifyData','cityData','hostTypeData'),true);			
			echo json_encode($data);die;
		 }else{
			 $datas['view'] = 'Empty data';			
			 echo json_encode($datas);die;
			}    
		}else{		 
		   $this->load->view('admin/itineraries_request',compact('data','notifyData','cityData','hostTypeData'));		
		}
		
	  }else{
	     redirect('host');
	  }	
		
}
	

  public function host(){
      $ses = $this->session->userdata('adminSes');		
	  if($ses['admin_type']!=3){
        $hostType = $this->input->post('hostType');	
		$city = $this->input->post('city');	
		$serviceType = $this->input->post('serviceType');
		$searchVal = $this->input->post('searchVal');	
		$param = "users.admin_status='5'";
		if(isset($searchVal) && $searchVal!='')
			//$param .= " AND users.host_first_name LIKE '%".$searchVal."%'";
		    $param .= " AND (users.host_first_name LIKE '%".$searchVal."%' || users.host_last_name LIKE '%".$searchVal."%'
		                     || users.host_email LIKE '%".$searchVal."%' || users.host_mob_no LIKE '%".$searchVal."%')";
							 
		if(isset($hostType) && $hostType!='')
			$param .= " AND users_profile.host_verification_type='".$hostType."'";
								
		if(isset($city) && $city!='')
			$param .= " AND users_profile.city='".$city."'";
						
		if(isset($serviceType) && $serviceType!='')
			$param .= " AND FIND_IN_SET('$serviceType',services_offered)";
		
		//$param .= ' order by users_profile.id desc';
		
	   $hostDataVal = $this->Admin_model->fetchAllHost($param);
	    
	   $this->load->helper('gethostcity');
	   $this->load->helper('gethostname');
	   $cityData = $this->Admin_model->fetchAllCities();
	   $notifyData = $this->Admin_model->fetchHostRows();
	   $hostTypeData = $this->Admin_model->fetchHostType();
	   
	   /*if(!empty($hostDataVal)){
		foreach($hostDataVal as $key=>$value){
		   // echo '<pre>';print_r($value);
			 $hostDataVal[] = $value;
			}
		}else{
		 $hostDataVal[] = '';
		}*/
		if(!empty($hostDataVal)){
			$dataVal['iterator'] = $hostDataVal;
			}
		else{
		 $dataVal['iterator'] = '';
		}		
	   
	 if($this->input->is_ajax_request())
		{	
	     
	     if(!empty($dataVal['iterator'])){       
			$dataVal['view']=$this->load->view('admin/host_element',compact('dataVal','cityData','notifyData','hostTypeData'),true);			
			echo json_encode($dataVal);die;
		 }else{
			 $datas['view'] = 'Empty data';			
			 echo json_encode($datas);die;
			}    
		}else{		 
		   $this->load->view('admin/host',compact('dataVal','cityData','notifyData','hostTypeData'));		
		}
	  }else{
	   redirect('all_itineraries');
	  }
	   
}
	
  public function request(){
      $ses = $this->session->userdata('adminSes');		
	  if($ses['admin_type']!=3){
        $status = $this->input->post('status');	
		$city = $this->input->post('city');	
		$serviceType = $this->input->post('serviceType');
		$searchVal = $this->input->post('searchVal');	
		$param = "users.admin_status!='5'";
		if(isset($searchVal) && $searchVal!='')
			$param .= " AND (users.host_first_name LIKE '%".$searchVal."%' || users.host_last_name LIKE '%".$searchVal."%'
		                     || users.host_email LIKE '%".$searchVal."%' || users.host_mob_no LIKE '%".$searchVal."%')";
		if(isset($status) && $status!='')
			$param .= " AND users.admin_status='".$status."'";
								
		if(isset($city) && $city!='')
			$param .= " AND users_profile.city='".$city."'";
						
		if(isset($serviceType) && $serviceType!='')
			$param .= " AND FIND_IN_SET('$serviceType',services_offered)";		
						
		
		//$hostData = $this->Admin_model->fetchRequest($param);		
		$itineraryData = $this->Admin_model->fetchRequest($param);
	   
	    $this->load->helper('gethostcity');
		$cityData = $this->Admin_model->fetchAllCities();
		$notifyData = $this->Admin_model->fetchHostRows();		
	   //$this->load->view('admin/request',compact('hostData','cityData','notifyData'));
	   
	   if(!empty($itineraryData)){
		  $hostData['iterator'] = $itineraryData;
		}else{
		 $hostData['iterator'] = '';
		}
					
	   if($this->input->is_ajax_request())
		{	
	     if(!empty($hostData['iterator'])){       
			$hostData['view']=$this->load->view('admin/request_element',compact('hostData','cityData','notifyData'),true);			
			echo json_encode($hostData);die;
		 }else{
			 $datas['view'] = 'Empty data';			
			 echo json_encode($datas);die;
			}    
		}else{		 
		  $this->load->view('admin/request',compact('hostData','cityData','notifyData'));		
		}
	 }else{
	    redirect('all_itineraries');
	 }
		
}
	
 //========== Host Link send Function Start:: 16-11-18 ===========//
  public function sendHostLink(){
	   $hostId = $this->input->post('id');
       $hostSendUrl = $this->input->post('url');
	   $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	   $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));

	    $config = $this->smtpCredential();
	   		 		
		$hostProfile = $this->Admin_model->fetchHostEmail($hostId);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
			  $hostArr['hostPass'] = $hostdata->host_password;
			//  $hostArr['link'] = 'signin?hostemail='.base64_encode($hostArr['hostEmail']).'&hostpass='.base64_encode($hostArr['hostPass']);	
			  $hostArr['link'] = 'loginMailHost?hostemail='.base64_encode($hostArr['hostEmail']).'&hostpass='.base64_encode($hostArr['hostPass']);	
              $hostArr['hostSendUrl'] = $hostSendUrl;
			}
		   //print_r($hostArr);die;
        $this->load->library('email',$config);
        $body = $this->load->view('mailer/sendhost_link_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);		
		$this->email->subject('City Explorers - Complete Your Profile');
		$this->email->message($body);
	    $this->email->send();		
	   //======= update host status after send link mail =======//
		$msg = $this->Admin_model->updateHostStatus($hostId,$status=1);
		if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}	
		 
	  }
 //========== Host link Function END:: 16-11-18 ===========//
 
 public function rejectHostMail(){
	 $id = $this->input->post('id');
	 $reason = $this->input->post('rejectReason');
     $hostSendUrl = $this->input->post('url');
	 //$reasonData = $this->Admin_model->rejectionHostMail($id,$reason);
	 $hostProfile = $this->Admin_model->fetchHostEmail($id);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
			  $hostArr['hostPass'] = $hostdata->host_password;
			  $hostArr['reason'] = $reason;
              $hostArr['hostSendUrl'] = $hostSendUrl;
			}
		
		$config = $this->smtpCredential();								
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/sendhost_rejected_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);		
		$this->email->subject('Registration Rejected');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//
		$msg = $this->Admin_model->updateHostStatus($id,$status=3);
		if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}		
	  
	 }
	 
	public function resendHostLink(){
		$hostId = $this->input->post('id');
        $hostSendUrl = $this->input->post('url');

        $hostProfile = $this->Admin_model->fetchHostEmail($hostId);
		foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
			  $hostArr['hostPass'] = $hostdata->host_password;
			  $hostArr['link'] = 'loginMailHost?hostemail='.base64_encode($hostArr['hostEmail']).'&hostpass='.base64_encode($hostArr['hostPass']);
             $hostArr['hostSendUrl'] = $hostSendUrl;
			}
			
		$config = $this->smtpCredential();	
						
        $this->load->library('email',$config);
        $body = $this->load->view('mailer/resend_host_link_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);		
		$this->email->subject('Complete Your Profile');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//
		$msg = $this->Admin_model->updateHostStatus($hostId,$status=1);
		 if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}
		}
		
    
	public function host_request_detail(){
	      $hostId = base64_decode($_GET['hostid']);		 
	      $hostHistory = $this->Admin_model->hostHistory($hostId);
		  $hostProfileData = $this->Admin_model->getHostProfile($hostId);
		  $hostType = $this->Admin_model->fetchHostType();
		  
		  foreach($hostProfileData as $profile){
			   $profiles = json_decode(json_encode($profile),true);
			  }
		  	$this->load->helper('gethoststate');
			$this->load->helper('gethostcity');
		    //echo '<pre>'; print_r($profiles);die;
		    $this->load->view('admin/host_request_detail',compact('hostHistory','profiles','hostType'));
		}
		
		
	//============ Profile Rejected Function START:: on 18-11-18 ============//
	public function profileRejected(){		
		$id = $this->input->post('id');
		$reason = $this->input->post('reason');
		$reasonData = $this->Admin_model->rejectionHostMail($id,$reason);
	    $hostProfile = $this->Admin_model->fetchHostEmail($id);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
			  $hostArr['hostPass'] = $hostdata->host_password;
			  $hostArr['reason'] = $reason;
			}
			
		$config = $this->smtpCredential();			
								
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/profile_rejected_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);		
		$this->email->subject('City Explorers - Profile Rejected');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//
		$msg = $this->Admin_model->updateHostStatus($id,$status=3);		
		//$msgHistory = $this->Admin_model->updateHostHistory($id,$reason_status=0);
		 if($msg=='success'){		    
		     echo "success"; die;			
			}
		else{
			 echo 'error';die;
			}
		}
//============ END:: Profile Rejected Function =====================//

//============ Profile Approve Function START:: on 18-11-18 ============//
	public function approveProfile(){		
		$id = $this->input->post('id');	
		$verifiedValue = $this->input->post('verifiedValue');	
		$verified_type = $this->input->post('verified_type');
		$guide_badge = $this->input->post('guideBadge');
		
	    $hostProfile = $this->Admin_model->fetchHostEmail($id);	
		$hostTypeData = getHostDetail($verified_type);
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;			  			  
			}
			
		$config = $this->smtpCredential();			
								
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/sendhost_approve_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);		
		$this->email->subject('City Explorers - Profile Approved');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//
		$msg = $this->Admin_model->updateHostStatus($id,$status=5);
		$this->Admin_model->updateHostHistory($id,$reason_status=1);
		$this->Admin_model->updateHostProfile($id,$verified_type,$verifiedValue,$guide_badge,$hostTypeData['host_type']);
		 if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}	
		}
	//============ END:: Profile Approve Function =====================//
	
  public function host_detail(){
	   $host_id = $_GET['hostid'];
	   $hostDetails = $this->Admin_model->fetchHostProfiles($host_id);
	   foreach($hostDetails as $data){
		    $details = $data;
		   }		   
	    //echo '<pre>'; print_r($details);die;
	   $this->load->helper('gethostcity');
	   $this->load->helper('gethoststate');	   
	   $this->load->helper('gethostname');
	   $this->load->view('admin/host_detail',compact('details'));
	  }
	  
 //=========== START:: Host detailed Doc. Function =============// 
 public function host_detail_doc(){
        $host_id = $_GET['hostid'];
        $hostDetails = $this->Admin_model->fetchHostProfiles($host_id);
	   foreach($hostDetails as $data){
		    $details = $data;
		   }
	    //echo '<pre>'; print_r($details);die;
	    $this->load->helper('gethostcity');
		$this->load->helper('gethostname');
	    $this->load->view('admin/host_detail_doc',compact('details'));
	 }
 //===========END:: Host detailed Doc. Function ===============//

 //=========== START:: Host detailed Itineraries. Function =============// 
 public function host_detail_itineraries(){
        $host_id = $_GET['hostid']; 
		
        $hostDetails = $this->Admin_model->fetchHostProfiles($host_id);
		$userServices  = $this->Admin_model->getUserServices($host_id);
        $serviceData = $this->Admin_model->getServices();
		$themesData = $this->Itinerarie_model->selectThemes();
        $hostItineraryData = $this->Admin_model->fetchAllItinerary($host_id);
		$hostLang = $this->Admin_model->gethostLanguages($host_id);
		$this->load->helper('gethostcity');
		$this->load->helper('getallthemes');
		$this->load->helper('getfamilydata');
        $this->load->helper('getallpickpoints');
		$this->load->helper('gethostname');
		foreach($hostDetails as $data){
		    $details = $data;
		   }
		
		if(!empty($hostItineraryData)){
				$hostItinerary['iterator'] = $hostItineraryData;
				}else{
				 $hostItinerary['iterator'] = '';
				}
		 //echo '<pre>'; print_r($hostItinerary);die;
		  $this->load->view('admin/host_detail_itineraries',compact('details','hostItinerary','userServices','serviceData','host_id','themesData','hostLang'));
	 }
	 
 //========== Host Request Searching START:: on 19-11-18 =============//
  /*public function searchResult(){
	  $hostName = $this->input->post();
	  
	  }*/
 //==========Host Request Searching END:: on 19-11-18 ==============//
 
 
 //============= START::Walk Itinerary Detailed function ================// 
 public function detail_itineraries(){
      $ses = $this->session->userdata('adminSes');	  
      $itineraryId = $this->input->get('itinerary_id');
	  $itinerary_id = base64_decode($itineraryId);
	  //echo $itinerary_id;die;
	  $flag = $this->input->get('flag');
	  $userLang = $this->input->get('lang');
	  $transflag = $this->input->get('transflag');
	  $serviceId = $this->input->get('service_id');
	  $this->load->helper('hostname');
	  $this->load->helper('getallthemes');
	  $this->load->helper('gettotalduration');
	  $this->load->helper('getfaqdata');
	  $this->load->helper('getfamilydata');
	  $this->load->helper('getfeatures');
	  $this->load->helper('getfamilymultidata');
	  $this->load->helper('getallpickpoints');
	  //$this->load->helper('getallstops');
	  $this->load->helper('fetchallstops');
	  $this->load->helper('gethostname');
	  $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	  $itineraryDisabled = $this->Admin_model->fetchDisabledItinerary($itinerary_id);
	  $reasonHistoryData = $this->Admin_model->fetchReasonHistory($itinerary_id);
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
	  //echo '<pre>';print_r($itineraryData);die;
	  $this->load->view('admin/detail_itineraries',compact('itineraryData','flag','itinerary_id','itineraryDisabled',
	                    'userLang','reasonHistoryData','transflag','serviceId','itineraryId'));
	  	  
	 }
 //=============END:: Walk Itinerary detailed function =================//

 //============= START::Session Itinerary Detailed function ================// 
 public function admin_detail_itineraries_sessions(){ 
      $itineraryId = $this->input->get('itinerary_id');
	  $itinerary_id = base64_decode($itineraryId);
	  $serviceId = $this->input->get('service_id');
	  $userLang = $this->input->get('lang');
	  $flag = $this->input->get('flag');
	  $transflag = $this->input->get('transflag');	
	  $this->load->helper('hostname');
	  $this->load->helper('getallthemes');
	  $this->load->helper('gettotalduration');
	  $this->load->helper('getfaqdata');
	  $this->load->helper('getfamilydata');
	  $this->load->helper('getfeatures');
	  $this->load->helper('getfamilymultidata');
	  $this->load->helper('getallpickpoints');
	  $this->load->helper('getallstops');
	  $this->load->helper('getinteresteddata');
	  $this->load->helper('gethostname');
	  $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	  $itineraryDisabled = $this->Admin_model->fetchDisabledItinerary($itinerary_id);
	  $allSpeakers = $this->Itinerarie_model->fetchSpeakers($itinerary_id);
	  $attendeesData = $this->Itinerarie_model->fetchAttendees($itinerary_id,$serviceId);
	  $reasonHistoryData = $this->Admin_model->fetchReasonHistory($itinerary_id);
		
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
	  //echo '<pre>';print_r($itineraryData);die;
	  $this->load->view('admin/admin_detail_itineraries_sessions',compact('itineraryData','flag','itinerary_id','itineraryDisabled',
	                                                                      'serviceId','userLang','allSpeakers','attendeesData','reasonHistoryData','transflag','itineraryId'));
	 }
 //=============END:: Session Itinerary detailed function =================//
 
 //============= START::Session Itinerary Detailed function ================// 
 public function admin_detail_itineraries_experience(){ 
      $itineraryId = $this->input->get('itinerary_id');
	  $itinerary_id = base64_decode($itineraryId);
	  $serviceId = $this->input->get('service_id');
	  $userLang = $this->input->get('lang');
	  $flag = $this->input->get('flag');
	  $transflag = $this->input->get('transflag');	  
	  $this->load->helper('hostname');
	  $this->load->helper('getallthemes');
	  $this->load->helper('gettotalduration');
	  $this->load->helper('getfaqdata');
	  $this->load->helper('getfamilydata');
	  $this->load->helper('getfeatures');
	  $this->load->helper('getfamilymultidata');
	  $this->load->helper('getallpickpoints');
	  $this->load->helper('getallstops');
	  $this->load->helper('getinteresteddata');
	  $this->load->helper('gethostname');
	  $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	  $itineraryDisabled = $this->Admin_model->fetchDisabledItinerary($itinerary_id);
	  $reasonHistoryData = $this->Admin_model->fetchReasonHistory($itinerary_id);
	 
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
	  //echo '<pre>';print_r($itineraryData);die;
	  $this->load->view('admin/admin_detail_itineraries_experiences',compact('itineraryData','flag','itinerary_id','itineraryDisabled',
	                                                                 'serviceId','userLang','reasonHistoryData','transflag','itineraryId'));
	 }
 //=============END:: Session Itinerary detailed function =================//
 

  //============= START::Meetups Itinerary Detailed function ================// 
 public function admin_detail_itineraries_meetup(){ 
      $itineraryId = $this->input->get('itinerary_id');
	  $itinerary_id = base64_decode($itineraryId);
	  $serviceId = $this->input->get('service_id');
	  $userLang = $this->input->get('lang');
	  $flag = $this->input->get('flag');
	  $transflag = $this->input->get('transflag');	  
	  $this->load->helper('hostname');
	  $this->load->helper('getallthemes');
	  $this->load->helper('gettotalduration');
	  $this->load->helper('getfaqdata');
	  $this->load->helper('getfamilydata');
	  $this->load->helper('getfeatures');
	  $this->load->helper('getfamilymultidata');
	  $this->load->helper('getallpickpoints');
	  $this->load->helper('getallstops');
	  $this->load->helper('getinteresteddata');
	  $this->load->helper('gethostname');
	  $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	  $itineraryDisabled = $this->Admin_model->fetchDisabledItinerary($itinerary_id);
	  $reasonHistoryData = $this->Admin_model->fetchReasonHistory($itinerary_id);
	 
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
	  //echo '<pre>';print_r($itineraryData);die;
	  $this->load->view('admin/admin_detail_itineraries_meetup',compact('itineraryData','flag','itinerary_id','itineraryDisabled',
	                                                           'serviceId','userLang','reasonHistoryData','transflag','itineraryId'));
	 }
 //=============END:: Meetups Itinerary detailed function =================//
 
 
 //============ itinerary approved func. ========================//
 
 public function approveItinerary(){
	  $itineraryId = $this->input->post('itineraryid');
	  $flag = $this->input->post('flag');
      $itineraryUrl = $this->input->post('itinerary_url');

	  $ses = $this->session->userdata('adminSes');
	  $hostData = $this->Admin_model->gethostId($itineraryId);	 
	  $hostProfile = $this->Admin_model->fetchHostEmail($hostData[0]->user_id);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
			  $hostArr['itineraryUrl'] = $itineraryUrl;
			}
			
		$config = $this->smtpCredential();			
		  						
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/itinerary_approve_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);
		$this->email->subject('City Explorers - Itinerary Approved');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//
		$msg = $this->Admin_model->updateItineraryStatus($itineraryId,$status=5);		
		 if($msg=='success'){
		     //sendSMS($hostArr['hostPhone'], 'your itinerary has been approved');//call send sms function
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}		
	 
	 }
	

 public function rejectItinerary(){
	  $itineraryId = $this->input->post('itineraryid');
	  $flag = $this->input->post('flag');
	  $rejectReason = $this->input->post('reject_reason');
      $itinerary_url = $this->input->post('itinerary_url');

     $ses = $this->session->userdata('adminSes');
	  $hostData = $this->Admin_model->gethostId($itineraryId);	 
	  $hostProfile = $this->Admin_model->fetchHostEmail($hostData[0]->user_id);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
			  $hostArr['reason'] = $rejectReason;
              $hostArr['itinerary_url'] = $itinerary_url;
			}
			
		$config = $this->smtpCredential();
								
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/itinerary_rejected_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);
		$this->email->subject('City Explorers - Itinerary Rejected');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//
	     date_default_timezone_set('Asia/Calcutta'); 
		$date = date("Y-m-d h:i:s a"); 
	    $insertitinerary['itinerary_id'] = $itineraryId;
		$insertitinerary['reason'] = $rejectReason;
		$insertitinerary['created_at'] = $date;
	    $this->Admin_model->insertItineraryHistory($insertitinerary);
		$msg = $this->Admin_model->updateItineraryStatus($itineraryId,$status=2);		
		 if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}		
	 
	 }
	 
public function disabledItinerary(){
	  $itineraryId = $this->input->post('itineraryid');
	  $flag = $this->input->post('flag');	 
	  $ses = $this->session->userdata('adminSes');
      $itinerary_url = $this->input->post('itinerary_url');
	  $hostData = $this->Admin_model->gethostId($itineraryId);	 
	  $hostProfile = $this->Admin_model->fetchHostEmail($hostData[0]->user_id);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
             $hostArr['itinerary_url'] = $itinerary_url;
        }
			
		$config = $this->smtpCredential();	
		
		/*$config = Array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'ariseunikove@gmail.com',
						'smtp_pass' => 'ariseunikove@123',
						'mailtype'  => 'html', 
						'charset'   => 'iso-8859-1'
						);*/
						
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/itinerary_disabled_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);
		$this->email->subject('City Explorers - Itinerary Disabled');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//	   
		$msg = $this->Admin_model->updateItineraryStatus($itineraryId,$status=6);		
		 if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}		
	 
	 }	 
	
public function enabledItinerary(){
	  $itineraryId = $this->input->post('itineraryid');
	  $flag = $this->input->post('flag');	 
	  $ses = $this->session->userdata('adminSes');
      $itinerary_url = $this->input->post('itinerary_url');
	  $hostData = $this->Admin_model->gethostId($itineraryId);	 
	  $hostProfile = $this->Admin_model->fetchHostEmail($hostData[0]->user_id);	
		
        foreach($hostProfile as $hostdata){
			  $hostArr['hostEmail'] = $hostdata->host_email;
			  $hostArr['hostName'] =  $hostdata->host_first_name.' '.$hostdata->host_last_name;
			  $hostArr['hostPhone'] = $hostdata->host_mob_no;
              $hostArr['itinerary_url'] = $itinerary_url;
			}
			
		$config = $this->smtpCredential();			
		   						
		$this->load->library('email',$config);
        $body = $this->load->view('mailer/itinerary_enabled_mail',$hostArr, true);                       
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($hostArr['hostEmail']);
		$this->email->subject('City Explorers - Itinerary Enabled');
		$this->email->message($body);
	    $this->email->send();       
	   //======= update host status after send link mail =======//	   
		$msg = $this->Admin_model->updateItineraryStatus($itineraryId,$status=5);		
		 if($msg=='success'){
		     echo "success"; die;
			}
		else{
			 echo 'error';die;
			}		
	 
	 }
	 
public function notification(){
	
	$msg = $this->Admin_model->updateNotiyStatus();
	if($msg=='success'){
		 echo 'shownotify';die;
		}
	else{
		echo 'notshow';die;
		}
}	 

public function itinerary_notification(){
	
	$msg = $this->Admin_model->updateitinerary_NotiyStatus();
	if($msg=='success'){
		 echo 'shownotify';die;
		}
	else{
		echo 'notshow';die;
		}
}	 

	
public function update_mail_status(){
	$chkval = $this->input->post('mailVal');
	$itinerary_id = $this->input->post('itineraryId');
	$msg = $this->Admin_model->updateMailStatus($itinerary_id,$chkval);
	echo $msg;die;
	if($msg=='success'){
		 echo 'mail_success';die;
		}
	else{
		echo 'mail_error';die;
		}
}

public function update_priority(){
	$chkval = $this->input->post('mailVal');
	$itinerary_id = $this->input->post('itineraryId');
	
	$data = array('priority'=>$chkval);
	$this->db->where('id',$itinerary_id);
	$this->db->update('creates_itinerary',$data);
}

//=========== START: Function for Itinerary Rating =============//
public function itinerary_ratings(){
	$itineraryId = $this->input->post('itinerary_id');
	$rating = $this->input->post('rating');	
	$msgData = $this->Admin_model->saveRatingValue($itineraryId,$rating);
	try{
		if($msgData=='success'){
		echo 'rating_success';die;
		}
	else{
		 echo 'rating_error';die;
		}
	}catch(Exception $e){
	  echo 'Caught exception';die;
	}		
}

//=========== host itineraries search function on 09-02-19 ==========//
public function adminHostSearch(){
	    $serviceId = $this->input->post('serviceId');
	    $hostId = $this->input->post('hostid');
		$themesid = $this->input->post('themesid');
		
		$hostDetails = $this->Admin_model->fetchHostProfiles($hostId);
		$hostItineraryData = $this->Admin_model->fetchSearch_AllItinerary($hostId,$serviceId,$themesid);
		$userServices  = $this->Admin_model->getUserServices($hostId);
        $serviceData = $this->Admin_model->getServices();
		$this->load->helper('gethostcity');
		$this->load->helper('getallthemes');
		$this->load->helper('getfamilydata');
        $this->load->helper('getcategory');
        $this->load->helper('hostname');
        $this->load->helper('getallpickpoints');
		$this->load->helper('getfamilymultidata');
		 
		foreach($hostDetails as $data){
		    $details = $data;
		   }
		
		if(!empty($hostItineraryData)){
				$hostItinerary['iterator'] = $hostItineraryData;
				}else{
				 $hostItinerary['iterator'] = '';
				}
		if($this->input->is_ajax_request())
		{	
	//$sd =  $this->Admin_model->fetchSearch_AllItinerary($hostId,$serviceId,$themesid);
	//echo '<pre>';print_r($sd);
	//echo $this->db->last_query();die;
	     if(!empty($hostItinerary['iterator'])){       
			$hostItinerary['view']= $this->load->view('admin/host_itineraries_element',compact('details','hostItinerary','userServices',
                                                     'serviceData','host_id','serviceId'),true);
			echo json_encode($hostItinerary);die;
		  }else{
			 $hostItinerary['view'] = 'Empty data';			
			 echo json_encode($hostItinerary);die;
			}    
		}		
		
	}
	
	
public function loadsearch_Itineraries(){	    
		$page =  @$_GET['page'];
	    $serviceId =  @$_GET['serviceId'];
		$userId =  @$_GET['userId'];
		
		$hostDetails = $this->Admin_model->fetchHostProfiles($userId);
		$hostItineraryData = $this->Admin_model->loadSearch_AllItinerary($userId,$page,$serviceId);
		$userServices  = $this->Admin_model->getUserServices($userId);
        $serviceData = $this->Admin_model->getServices();
		$this->load->helper('gethostcity');
		$this->load->helper('getallthemes');
		$this->load->helper('getfamilydata');
        $this->load->helper('getcategory');
        $this->load->helper('hostname');
        $this->load->helper('getallpickpoints');
		$this->load->helper('getfamilymultidata');
		foreach($hostDetails as $data){
		    $details = $data;
		   }
		
		if(!empty($hostItineraryData)){
				$hostItinerary['iterator'] = $hostItineraryData;
				}else{
				 $hostItinerary['iterator'] = '';
				}
		if($this->input->is_ajax_request())
		{
	  //$hostItineraryData = $this->Admin_model->loadSearch_AllItinerary($userId,$page,$serviceId);
	  //echo $this->db->last_query();die;
	     if(!empty($hostItinerary['iterator'])){       
			$hostItinerary['view']= $this->load->view('admin/host_itineraries_element',compact('details','hostItinerary','userServices',
                                                      'serviceData','host_id','serviceId'),true);
			echo json_encode($hostItinerary);die;
		  }else{
			 $hostItinerary['view'] = 'Empty data';			
			 echo json_encode($hostItinerary);die;
			}    
		}		
		
	}

	
//============= file upload function start on 20-02-19============//
 function file_upload($path,$fileName,$fileType,$tumbPath,$fileInputName,$maxSize,$resizewidth,$resizeHeight){
   
	$fileArr = explode('.',$fileName);				 
	$fileNewName = $fileArr[0].'_'.time().'.'.$fileArr[1];
	
    $config = array(
    'allowed_types'     => $fileType, //only accept these file types
    'max_size'          => $maxSize, //2MB max
    'upload_path'       => $path, //upload directory
	'maintain_ratio'    => true,
	//'min_height' => "1440",
	//'min_width' => "810",
	'file_name'        =>$fileNewName
  );
 
    // $this->load->library('upload', $config);
	$this->load->library('upload');
	$this->upload->initialize($config); 
	
	if (!$this->upload->do_upload($fileInputName))
		{	  
		  $error = array('error' => $this->upload->display_errors());
		  echo'<pre>';print_r($error);die;
		}
	else
		{    
     $image_data = $this->upload->data(); //upload the image
     //your desired config for the resize() function
     $config = array(
     'source_image'      => $image_data['full_path'], //path to the uploaded image
     'new_image'         => $tumbPath, //path to
     'maintain_ratio'    => FALSE,     
	 'create_thumb'      =>TRUE,
	 'thumb_marker'      =>FALSE,
	 'width'             => $resizewidth, //640,
     'height'            => $resizeHeight, //360,
	 'quality'           =>'60%'
     );
 
  
    //this is the magic line that enables you generate multiple thumbnails
    //you have to call the initialize() function each time you call the resize()
    //otherwise it will not work and only generate one thumbnail
	$this->load->library('image_lib');
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
   if($image_data){
	   return $image_data['file_name']; 
	   }
  }	
 }	

 //===========START::Sponsor multiple images uploaded ===========//
 
 public function uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight){
 
	   $config['upload_path']   = $path;
	   $config['allowed_types'] = $allowType;  
              
       $this->load->library('upload'); 
	   $mum_files = count($files['itinerary_sponsor_image_cover']);		
		$dataInfo = array();		
	   if(!empty(array_filter($files['itinerary_sponsor_image_cover']['name']))){
		  for($i=0; $i<$mum_files; $i++)
		  {                   
			if (isset($files['itinerary_sponsor_image_cover']['name'][$i])) {
				$uniueId = uniqid();
				$config['file_name'] = !empty($files['itinerary_sponsor_image_cover']['name'][$i]) ? $uniueId.'_'.$files['itinerary_sponsor_image_cover']['name'][$i] : $hide_Sponsor[$i] ;
				//$this->load->library('upload', $config);
				$this->upload->initialize($config);
				$_FILES['itinerary_sponsor_image_cover']['name']= $files['itinerary_sponsor_image_cover']['name'][$i];
				$_FILES['itinerary_sponsor_image_cover']['type']= $files['itinerary_sponsor_image_cover']['type'][$i];
				$_FILES['itinerary_sponsor_image_cover']['tmp_name']= $files['itinerary_sponsor_image_cover']['tmp_name'][$i];
				$_FILES['itinerary_sponsor_image_cover']['error']= $files['itinerary_sponsor_image_cover']['error'][$i];
				$_FILES['itinerary_sponsor_image_cover']['size']= $files['itinerary_sponsor_image_cover']['size'][$i];    
				
				$filename = $uniueId.'_'.$_FILES['itinerary_sponsor_image_cover']['name'];

				if (!$this->upload->do_upload('itinerary_sponsor_image_cover'))
				{
					$error_message = $this->upload->display_errors();
					//$this->session->set_flashdata('status', 'error');
					//$this->session->set_flashdata('message', $error_message);					
		            echo'<pre>';print_r($error_message);die;
				}
				else
				{                         
					$this->session->set_flashdata('status', 'success');
					$this->session->set_flashdata('message', "Files upload is success");
				}

				$dataInfo[] = $this->upload->data(); //all the info about the uploaded files are stored in this array
								   
			   }
			}
			  $all_imgs = '';
			  if ( count($dataInfo) > 0) {                   
				foreach ($dataInfo as $info) {
				  //========= image resize code on 23-04-19===============//
				$config = array(
				 'source_image'      => $info['full_path'], //path to the uploaded image
				 'new_image'         => $thumbPath, //path to
				 'maintain_ratio'    => FALSE,     
				 'create_thumb'      =>TRUE,
				 'thumb_marker'      =>FALSE,
				 'width'             => $resizewidth, //640,
				 'height'            => $resizeHeight, //360,
				 'quality'           =>'60%'
				 ); 
  
				//this is the magic line that enables you generate multiple thumbnails
				//you have to call the initialize() function each time you call the resize()
				//otherwise it will not work and only generate one thumbnail
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				//=========END:: image resize code =============//
				
					$all_imgs .= $info['file_name'];
					$all_imgs .= ',';
				}
			}
			return $itinerarySaveArr['sponsors_img'] = rtrim($all_imgs,','); 
		}

		else{				   
			  $sponsorImages = implode(',',$hide_Sponsor);				      
			 return $itinerarySaveArr['sponsors_img'] = $sponsorImages;					  
		   }
 }
//===========END::Sponsor multiple images uploaded ===========//

//================ Edit walk itinerary by admin on 25-02-19==============//
public function admin_walk_itinerary_edit(){
	     $user_Id =    $this->input->get('userid',true);
		 $userId = base64_decode($user_Id);
		 $itinerary_Id = $this->input->get('itineraryid',true);
		 $itineraryId = base64_decode($itinerary_Id);		 
		 $serviceId = $this->input->get('serviceid',true);		 
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		 $flag = $this->input->get('flag',true);
		 
		 $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);	
		 $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
		 $userCity = $this->Itinerarie_model->findUser_city($userId);
		 $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
		 $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
		 $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
		 $drafStopData = $this->Itinerarie_model->getEditStopsData($userId,$itineraryId);
		 $allthemes = $this->Itinerarie_model->selectThemes();
		 $features = $this->Itinerarie_model->selectFeatures();
		 $languages = $this->Itinerarie_model->selectLanguages($userId);
		 $hostimage = $this->Itinerarie_model->getProfileimage($userId);
		 $allowItinerary = $this->Itinerarie_model->allowHost($userId);
		 $legalData = $this->Itinerarie_model->getLegalData($serviceId); // fetch iwl legal data from database 
		 $airPortData = $this->Itinerarie_model->getAirports();
	     $railwayData = $this->Itinerarie_model->getRailways();
	
		 $this->load->helper('fetchallstops');
		 foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($editDataSet);die;
		 
	    $this->load->view('admin/admin_walk_itinerary_edit',compact('editDataSet','serviceId','otherlang','allCategory','userCity',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','flag',
						 'languages','itineraryId','adminStatus','hostimage',
						  'allowItinerary','drafStopData','legalData','airPortData','railwayData'));
}

 
//============= EDIT Done Button click =====================//
 public function admin_editItinerary(){
	   $loginHostid = $this->input->post('user_id');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');
	   $returnUrl = $this->input->post('returnUrl');
	   $itineraryUrl = $this->input->post('itineraryUrl');
	   
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator_confirm'] = 0;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');	  
	  
	   if($this->input->post('send_to_translator')==0){
		   $itinerarySaveArr['translator_type'] = 0;	   
		   }
	   else{
		   $itinerarySaveArr['translator_type'] = $this->input->post('translator_val');
		   }
		
	    $hostProfile = $this->Itinerarie_model->getHostProfile($loginHostid); //get Host information
	      
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';
	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }	 
	   
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));
	   $stoplocation_count = count($this->input->post('itinerary_route_slot01_stop01_location'));
	   $stoplocation_timecount = count($this->input->post('itinerary_route_slot01_stop01_time'));
	   $stopdesc_count = count($this->input->post('itinerary_route_slot01_stop01_description'));
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway'); 
       $itinerarySaveArr['location_covered'] = $this->input->post('itinerary_location_covered');
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');
	   
	   if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			$costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = '';       	 
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	   
	       // echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;
		   //========= START:: Call Sponsor Images upload Function ============//		      
		      $path = './assets/itinerary_files/sponsor_file/';
		      $allowType = "gif|jpg|png|jpeg";
			  $files = $_FILES;
			  $thumbPath = './assets/itinerary_files/sponsor_thumbnail_images/';
			  $resizewidth = 400;
			  $resizeHeight = 127;
			  $hide_Sponsor = $this->input->post('itinerary_sponsor_hide_image_cover');
			  $sponsorData = $this->uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight);
			 
		 //========= END:: Call Sponsor Images upload Function ============//
		 		
		if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {  
		          $fileName = $_FILES['itinerary_gallery_image_cover']['name'];
		         				 
				  $path = "./assets/itinerary_files/gallery/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_cover';
				  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
			      $itineraryfeatrue_image = $this->file_upload($path,$fileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);			 
				
                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('hide_feature_img');					  
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              { 		     
		          $additionalFile_01 = $_FILES['itinerary_gallery_image_01']['name'];
		          
				  $path = "./assets/itinerary_files/additional_images/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_01';
				  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
			      $additional_image1 = $this->file_upload($path,$additionalFile_01,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);			 
				
                }
                else{                        
                       $additional_image1 = $this->input->post('hide_additional_img1');
                     }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {   	
		          $additionalFile_02 = $_FILES['itinerary_gallery_image_02']['name'];
		          
				  $path = "./assets/itinerary_files/additional_images/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_02';
				  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
			      $additional_image2 = $this->file_upload($path,$additionalFile_02,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                           $resizewidth,$resizeHeight);			 
				
                }
                else{                        
                       $additional_image2 = $this->input->post('hide_additional_img2');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {   
		          $additionalFile_03 = $_FILES['itinerary_gallery_image_03']['name'];
		          
				  $path = "./assets/itinerary_files/additional_images/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_03';
				  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
			      $additional_image3 = $this->file_upload($path,$additionalFile_03,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);			 
                }
                else{                        
                       $additional_image3 = $this->input->post('hide_additional_img3');
                      }					  
					  
	   	   
		   // =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              {   
		   
		            $videoName = $_FILES['itinerary_gallery_video']['name'];		          
					$config_video = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|avi|mp4",					
					'file_name' => $videoName,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					//'min_height' => "1440",
					//'min_width' => "810",
					//'maintain_ratio'=>TRUE
					);
					
					$this->upload->initialize($config_video);                    					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data             = $this->upload->data();						
                        $config_video['image_library'] ='gd2';
                        $config_video['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_video['create_thumb']  = FALSE;
                        $config_video['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $itinerary_video = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $itinerary_video = $this->input->post('hide_video');
                     }	
					  
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $itinerary_video;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
	        $itinerarySaveArr['sponsors_img'] = $sponsorData;
	     
		      $itinerarySaveArr['login_status'] = null;
		      $updateData = $this->Itinerarie_model->editUpdateDoneData($loginHostid,$itinerarySaveArr,$itinerary_id);
			 // $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$itinerary_id);			 
			  $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$itinerary_id);
			  $getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$itinerary_id);			 

			  $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$itinerary_id);
			 
			 //print_r($getRouteids);die;
			 if(!empty($itinerary_id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$itinerary_id);
				 }
			if(!empty($getStopids)){
				  $deleteStops = $this->Itinerarie_model->deleteStopsdata($loginHostid,$itinerary_id);
				 }		 
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['login_status'] = null;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $itinerary_id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			if(!empty(array_filter($this->input->post('itinerary_route_slot01_pickup')))){			
			  for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $itinerary_id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   $this->input->post('dropoff_coordinates')[$i];
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);
						
						$routeInsertId = $this->db->insert_id();
						
					//========= New Stops for route =================//
					if(!empty($routeInsertId)){					   	   
						   if(!empty($this->input->post("route")))
							{
							foreach($this->input->post("route") as $key => $value)
							{
							 if($key===$i){
								foreach($value["itinerary_route_slot01_stop01_location"] as $k => $v)
								{
									$newStopData['user_id'] = $loginHostid;	
									$newStopData['route_id'] = $routeInsertId;
									$newStopData['service_id'] = $this->input->post('service_id');
									$newStopData['create_itinerary_id'] = $itinerary_id;
									$newStopData['category_id'] = $this->input->post('category');
									$newStopData['stop_location_type'] = $v;
									$newStopData['stop_location_time'] = $value["itinerary_route_slot01_stop01_time"][$k];					
									$newStopData['stop_location_desc'] = $value["itinerary_route_slot01_stop01_description"][$k];			   
									$newStopData['created_at'] =   date('Y-m-d h:i:s');
									$newStopData['login_status'] = null;
									$this->db->insert('txn_routes_stops', $newStopData);
								}
							  }
							}
						}
				      }
 				  }
			 }  
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $itinerary_id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);
					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";	      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }					  
				 	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 //$this->session->set_flashdata('success','doneUpdate');
			 //====== START:: Admin Edit Itinerary Mailer Fun. on 26-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
			 
			 if($returnUrl==1){
			     return redirect('itineraries_request');
				 }else{
				 return redirect('all_itineraries');
				 }
		     
           
	 }
	 
	 
//========= ********* Session itinerary edit function start on 25-02-19 **********===================//	
	public function admin_session_itinerary_edit(){
	     $userId  =    base64_decode($this->input->get('userid',true));		 
		 $serviceId = $this->input->get('serviceid',true);
		 $itineraryId = base64_decode($this->input->get('itineraryid',true));
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		 $flag = $this->input->get('flag',true);
		  
		 $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);	
		 $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
		 $userCity = $this->Itinerarie_model->findUser_city($userId);
		 $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
		 $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
		 $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
		 $drafSpeakerData = $this->Itinerarie_model->getEditSpeakerData($userId,$itineraryId);
		 $allthemes = $this->Itinerarie_model->selectThemes();
		 $features = $this->Itinerarie_model->selectFeatures();
		 $languages = $this->Itinerarie_model->selectLanguages($userId);
		 $hostimage = $this->Itinerarie_model->getProfileimage($userId);
		 $allowItinerary = $this->Itinerarie_model->allowHost($userId);
		 $legalData = $this->Itinerarie_model->getLegalData($serviceId); // fetch iwl legal data from database 
		 $airPortData = $this->Itinerarie_model->getAirports();
	     $railwayData = $this->Itinerarie_model->getRailways();
	
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		  //echo '<pre>';print_r($editDataSet);die;
		
		$this->load->view('admin/admin_session_itinerary_edit',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity','flag',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','legalData',
						 'languages','itineraryId','adminStatus','hostimage',
						 'allowItinerary','drafSpeakerData','airPortData','railwayData'));
		}
		
		
//============== edit Session done button click function start ======================//
public function admin_sessionitineraryEdit(){ 
        
      $loginHostid = $this->input->post('user_id');	  
	  $service_id = $this->input->post('service_id');
	  $otherlang = $this->input->post('selLang');
	  $itinerary_id = $this->input->post('itinerary_id');
	  $returnUrl = $this->input->post('returnUrl');
	  $itineraryUrl = $this->input->post('itineraryUrl');
	  
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');	  
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator_confirm'] = 0;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	  
	   if($this->input->post('send_to_translator')==0){
		   $itinerarySaveArr['translator_type'] = 0;	   
		   }
	   else{
		   $itinerarySaveArr['translator_type'] = $this->input->post('translator_val');
		   }
		   
	    $hostProfile = $this->Itinerarie_model->getHostProfile($loginHostid); //get Host information
	      	   
	  
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';
	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   $meetupType = '';
	    
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }
	if(!empty($this->input->post('meetup_itinerary_type'))){
		$meetupType = implode(',',$this->input->post('meetup_itinerary_type'));
		}
		  
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   $itinerarySaveArr['meetup_type'] = $meetupType;
	  
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));
	   $speakerNameCount = count($this->input->post('speakerName'));	   
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway');       
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');
	   
	   if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			   $costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = "";
	   
	   //$itinerarySaveArr['additional_cost_description'] = $this->input->post('itinerary_additionalcost_description');
	   //$itinerarySaveArr['additional_price'] = $this->input->post('itinerary_additionalcost_amt');		  
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	  
	       //echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;
		   //========= START:: Call Sponsor Images upload Function ============//		      
		      $path = './assets/itinerary_files/sponsor_file/';
		      $allowType = "gif|jpg|png|jpeg";
			  $files = $_FILES;
			  $thumbPath = './assets/itinerary_files/sponsor_thumbnail_images/';
			  $resizewidth = 400;
			  $resizeHeight = 127;
			  $hide_Sponsor = $this->input->post('itinerary_sponsor_hide_image_cover');
			  $sponsorData = $this->uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight);
			 
		 //========= END:: Call Sponsor Images upload Function ============//
		 		
         if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $sessionEditFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$sessionEditFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);
                  
                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
					   //echo $itineraryfeatrue_image;die;
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $sessionEditFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$sessionEditFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                     }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $sessionEditFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$sessionEditFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                 
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $sessionEditFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$sessionEditFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image3 = $this->input->post('itinerary_gallery_image_hide_03');
                      }					  
					  
	   	   
		   // =============== Video upload start================//
		    $allowedExts = array("mp3", "mp4", "wma","flv");
            $extension = pathinfo($_FILES['itinerary_gallery_video']['name'], PATHINFO_EXTENSION);
			if($extension!=''){
			if($extension=='mp4' || $extension=='mp3' || $extension=='flv' || $extension=='wma'){
			
				  $videopath = './assets/itinerary_files/videos/';
				  $fileName = basename($_FILES['itinerary_gallery_video']['name']);				 
				  $targetFile = $videopath.$fileName;
				  move_uploaded_file($_FILES["itinerary_gallery_video"]["tmp_name"],$targetFile);
				}else{
				  echo "video Format Not Supported";die;
				}
			}else{
			  $fileName = $this->input->post('itinerary_gallery_hide_video');			 
			}
			
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $fileName;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
			$itinerarySaveArr['sponsors_img'] = $sponsorData;
	   
	       // echo '<pre>';print_r($itinerarySaveArr);die;
		     $itinerarySaveArr['login_status'] = null;
		     $updateData = $this->Itinerarie_model->editUpdateMeetupDoneData($loginHostid,$itinerarySaveArr,$itinerary_id);
			 //$getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$itinerary_id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$itinerary_id);
			 $getSpeakerids = $this->Itinerarie_model->getSaveSpeakerids($loginHostid,$itinerary_id);
			 $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$itinerary_id);
			 
			 //print_r($getsaveItineraryId);die;
			 if(!empty($itinerary_id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$itinerary_id);
				 }			
			if(!empty($getSpeakerids)){
				  $deleteFamily = $this->Itinerarie_model->deleteSpeakerdata($loginHostid,$itinerary_id);
				 }
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $itinerary_id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = null;
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $itinerary_id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $itinerary_id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);  
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";		      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
					  
				if(!empty($this->input->post('speakerName'))){				      
					$targetDir = "./assets/itinerary_files/meetup_speaker/";						
					$data = $this->input->post('speakerImg');
					foreach($data as $key=>$valueimg){												
						$image_parts = explode(";base64,", $data[$key]);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = @$image_type_aux[1];
						@$image_base64 = base64_decode($image_parts[1]);					
						$explodImage = explode(';base64,',$data[$key]);
						$uniueId = uniqid();
						$file = $targetDir . $uniueId . '.'.$image_type;
						 if(isset($explodImage[1]) && $explodImage[1]!=''){
								$fileName = $uniueId . '.'.$image_type;
								$path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;						
								file_put_contents($file, $image_base64);
								 }
							 else{
								 $fileName = $data[$key];
								 $path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;
								 }	
																 
					    $sponsorArrData['user_id'] = $loginHostid;
				        $sponsorArrData['create_itinerary_id'] = $itinerary_id;
						$sponsorArrData['service_id'] = $this->input->post('service_id');
					    $sponsorArrData['category_id'] = $this->input->post('category');
					    $sponsorArrData['speaker_name'] = $this->input->post('speakerName')[$key];
					    $sponsorArrData['speaker_details'] = $this->input->post('speakerDesc')[$key];					
					    $sponsorArrData['speaker_image_path'] = $path;
					    $sponsorArrData['speaker_image_name'] = $fileName;					   
						$sponsorArrData['login_status'] = null;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
					   }
					}	  	    
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 //====== START:: Admin Edit Itinerary Mailer Fun. on 26-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
			 
			 if($returnUrl==1){
			     return redirect('itineraries_request');
				 }else{
				 return redirect('all_itineraries');
				 }		  
	   }		


//========= Experience itinerary edit view function start ===================//	
public function admin_experience_itinerary_edit(){
	     $userId =  base64_decode($this->input->get('userid',true));		
		 $itineraryId = base64_decode($this->input->get('itineraryid',true));
		 $serviceId = $this->input->get('serviceid',true);
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		 $flag = $this->input->get('flag',true);
		 
		 $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);	
		 $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
		 $userCity = $this->Itinerarie_model->findUser_city($userId);
		 $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
		 $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
		 $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
		 $drafStopData = $this->Itinerarie_model->getEditStopsData($userId,$itineraryId);
		 $allthemes = $this->Itinerarie_model->selectThemes();
		 $features = $this->Itinerarie_model->selectFeatures();
		 $languages = $this->Itinerarie_model->selectLanguages($userId);
		 $hostimage = $this->Itinerarie_model->getProfileimage($userId);
		 $allowItinerary = $this->Itinerarie_model->allowHost($userId);
		 $legalData = $this->Itinerarie_model->getLegalData($serviceId); // fetch iwl legal data from database 
		 $airPortData = $this->Itinerarie_model->getAirports();
	     $railwayData = $this->Itinerarie_model->getRailways();
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($editDataSet);die;
		
		$this->load->view('admin/admin_experience_itinerary_edit',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity','legalData',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','flag',
						 'languages','itineraryId','adminStatus','hostimage',
						 'allowItinerary','userId','airPortData','railwayData'));
		}
		
//============= ADMIN EDIT Experience Done Button click =====================//
 public function admin_editexperience_itinerary(){
	   $loginHostid = $this->input->post('user_id');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');
	   $returnUrl = $this->input->post('returnUrl');
	   $itineraryUrl = $this->input->post('itineraryUrl');
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator_confirm'] = 0;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	  
	   if($this->input->post('send_to_translator')==0){
		   $itinerarySaveArr['translator_type'] = 0;	   
		   }
	   else{
		   $itinerarySaveArr['translator_type'] = $this->input->post('translator_val');
		   }	
	   
	    $hostProfile = $this->Itinerarie_model->getHostProfile($loginHostid); //get Host information
	      
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';
	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   $experienceType = '';
	   
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }	 
	 if(!empty($this->input->post('experience_itinerary_type'))){
		 $experienceType = implode(',',$this->input->post('experience_itinerary_type'));
		 }
		 
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   $itinerarySaveArr['experience_type'] = $experienceType;
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));
	   $stoplocation_count = count($this->input->post('itinerary_route_slot01_stop01_location'));
	   $stoplocation_timecount = count($this->input->post('itinerary_route_slot01_stop01_time'));
	   $stopdesc_count = count($this->input->post('itinerary_route_slot01_stop01_description'));
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway'); 
       $itinerarySaveArr['location_covered'] = $this->input->post('itinerary_location_covered');
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');
	   
	   if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			$costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = ''; 	   
	        	 
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:s');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	   
	        //echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;
	       //FILES UPLOADS CREATE ITINERARY START           		
            if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $expEditFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$expEditFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);
                
                }
                else{                        
                       $itineraryfeatrue_image = $this->input->post('hide_feature_img');
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $expEditFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$expEditFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image1 = $this->input->post('hide_additional_img1');
                      }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $expEditFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$expEditFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image2 = $this->input->post('hide_additional_img2');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $expEditFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$expEditFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image3 = $this->input->post('hide_additional_img3');
                      }					  
					  
	   	   
		  // =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              { 
		   
		            $done_videoName = $_FILES['itinerary_gallery_video']['name'];
		           
					$config_donevideo = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|mp3|avi|mp4",					
					'file_name' => $done_videoName,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					//'min_height' => "1440",
					//'min_width' => "810",
					//'maintain_ratio'=>TRUE
					);
					
					$this->upload->initialize($config_donevideo);                    					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data             = $this->upload->data();						
                        $config_donevideo['image_library'] ='gd2';
                        $config_donevideo['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_donevideo['create_thumb']  = FALSE;
                        $config_donevideo['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $itinerary_video = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $itinerary_video = $this->input->post('hide_video');
                      }	
					  
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $itinerary_video;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
	   
	      //echo '<pre>';print_r($itinerarySaveArr);die;
		      $itinerarySaveArr['login_status'] = null;
		      $updateData = $this->Itinerarie_model->editUpdateDoneData($loginHostid,$itinerarySaveArr,$itinerary_id);
			 // $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$itinerary_id);			 
			  $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$itinerary_id);
			  //$getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$itinerary_id);			 

			  $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$itinerary_id);
			 
			 //print_r($getRouteids);die;
			 if(!empty($itinerary_id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$itinerary_id);
				 }
			/*if(!empty($getStopids)){
				  $deleteStops = $this->Itinerarie_model->deleteStopsdata($loginHostid,$itinerary_id);
				 }*/		 
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['login_status'] = null;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $itinerary_id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $itinerary_id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   $this->input->post('dropoff_coordinates')[$i];
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $itinerary_id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);  
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";		      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }  
					  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 //====== START:: Admin Edit Itinerary Mailer Fun. on 26-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
			 
			 if($returnUrl==1){
			     return redirect('itineraries_request');
				 }else{
				 return redirect('all_itineraries');
				 }	
	
	}
	
	
//========= ********* Admin Meetup itinerary edit function start on 26-02-19 **********===================//	
	public function admin_meetup_itinerary_edit(){
	     $userId =  base64_decode($this->input->get('userid',true));		 
		 $itineraryId = base64_decode($this->input->get('itineraryid',true));
		 $serviceId = $this->input->get('serviceid',true);
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		 $flag = $this->input->get('flag',true);
		 
		 $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);	
		 $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
		 $userCity = $this->Itinerarie_model->findUser_city($userId);
		 $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
		 $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
		 $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
		 $drafSpeakerData = $this->Itinerarie_model->getEditSpeakerData($userId,$itineraryId);
		 $allthemes = $this->Itinerarie_model->selectThemes();
		 $features = $this->Itinerarie_model->selectFeatures();
		 $languages = $this->Itinerarie_model->selectLanguages($userId);
		 $hostimage = $this->Itinerarie_model->getProfileimage($userId);
		 $allowItinerary = $this->Itinerarie_model->allowHost($userId);
		 $highLightResult = $this->Itinerarie_model->getHighLightData();
		 $legalData = $this->Itinerarie_model->getLegalData($serviceId); // fetch iwl legal data from database 
		 $airPortData = $this->Itinerarie_model->getAirports();
	     $railwayData = $this->Itinerarie_model->getRailways();
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($drafSpeakerData);die;
		
		$this->load->view('admin/admin_meetup_itinerary_edit',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity','flag','highLightResult',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','legalData',
						 'languages','itineraryId','adminStatus','hostimage',
						 'allowItinerary','drafSpeakerData','airPortData','railwayData'));
		}
		

//============== Admin Edit Meetup Done button click function start on 26-02-19 ======================//
public function admin_editmeetup_itinerary(){ 
      $loginHostid = $this->input->post('user_id');	  
	  $service_id = $this->input->post('service_id');
	  $otherlang = $this->input->post('selLang');
	  $itinerary_id = $this->input->post('itinerary_id');
	  $returnUrl = $this->input->post('returnUrl');
	  $itineraryUrl = $this->input->post('itineraryUrl');
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');	  
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator_confirm'] = 0;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	  
	   if($this->input->post('send_to_translator')==0){
		   $itinerarySaveArr['translator_type'] = 0;	   
		   }
	   else{
		   $itinerarySaveArr['translator_type'] = $this->input->post('translator_val');
		   }
	  
	   $hostProfile = $this->Itinerarie_model->getHostProfile($loginHostid); //get Host information
	      
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';
	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   $meetupType = '';
	    
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }
	if(!empty($this->input->post('meetup_itinerary_type'))){
		$meetupType = implode(',',$this->input->post('meetup_itinerary_type'));
		}
		  
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   $itinerarySaveArr['meetup_type'] = $meetupType;
	  
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));
	   $speakerNameCount = count($this->input->post('speakerName'));	   
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway');       
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');
	   
	   
	   if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			$costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = ''; 		  
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	  
	       //echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;
		   //========= START:: Call Sponsor Images upload Function ============//		      
		      $path = './assets/itinerary_files/sponsor_file/';
		      $allowType = "gif|jpg|png|jpeg";
			  $files = $_FILES;
			  $thumbPath = './assets/itinerary_files/sponsor_thumbnail_images/';
			  $resizewidth = 400;
			  $resizeHeight = 127;
			  $hide_Sponsor = $this->input->post('itinerary_sponsor_hide_image_cover');
			  $sponsorData = $this->uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight);
			 
		 //========= END:: Call Sponsor Images upload Function ============//
		 		
         if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $meetEditFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$meetEditFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);
                 
                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
					   //echo $itineraryfeatrue_image;die;
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
				 
                  $meetEditFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$meetEditFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);

                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                     }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $meetEditFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$meetEditFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                 
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $meetEditFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$meetEditFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                  
                }
                else{                        
                       $additional_image3 = $this->input->post('itinerary_gallery_image_hide_03');
                      }					  
					  
	   	   
		   // =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              { 
		   
		            $done_videoName = $_FILES['itinerary_gallery_video']['name'];
		           
					$config_donevideo = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|mp3|avi|mp4",					
					'file_name' => $done_videoName,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					//'min_height' => "1440",
					//'min_width' => "810",
					//'maintain_ratio'=>TRUE
					);
					
					$this->upload->initialize($config_donevideo);                    					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data             = $this->upload->data();						
                        $config_donevideo['image_library'] ='gd2';
                        $config_donevideo['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_donevideo['create_thumb']  = FALSE;
                        $config_donevideo['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $fileName = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $fileName = $this->input->post('itinerary_gallery_hide_video');
                      }						  
					  
		   			
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $fileName;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
			$itinerarySaveArr['sponsors_img'] = $sponsorData;
	   
	        //echo '<pre>';print_r($itinerarySaveArr);die;
		     $itinerarySaveArr['login_status'] = null;
		     $updateData = $this->Itinerarie_model->editUpdateMeetupDoneData($loginHostid,$itinerarySaveArr,$itinerary_id);
			 //$getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$itinerary_id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$itinerary_id);
			 $getSpeakerids = $this->Itinerarie_model->getSaveSpeakerids($loginHostid,$itinerary_id);
			 $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$itinerary_id);
			 
			 //print_r($getsaveItineraryId);die;
			 if(!empty($itinerary_id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$itinerary_id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$itinerary_id);
				 }			
			if(!empty($getSpeakerids)){
				  $deleteFamily = $this->Itinerarie_model->deleteSpeakerdata($loginHostid,$itinerary_id);
				 }
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $itinerary_id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = null;
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $itinerary_id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] = null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $itinerary_id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]); 
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
					  
				if(!empty($this->input->post('speakerName'))){				      
					$targetDir = "./assets/itinerary_files/meetup_speaker/";						
					$data = $this->input->post('speakerImg');
					foreach($data as $key=>$valueimg){												
						$image_parts = explode(";base64,", $data[$key]);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = @$image_type_aux[1];
						@$image_base64 = base64_decode($image_parts[1]);					
						$explodImage = explode(';base64,',$data[$key]);
						$uniueId = uniqid();
						$file = $targetDir . $uniueId . '.'.$image_type;
						 if(isset($explodImage[1]) && $explodImage[1]!=''){
								$fileName = $uniueId . '.'.$image_type;
								$path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;						
								file_put_contents($file, $image_base64);
								 }
							 else{
								 $fileName = $data[$key];
								 $path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;
								 }	
																 
					    $sponsorArrData['user_id'] = $loginHostid;
				        $sponsorArrData['create_itinerary_id'] = $itinerary_id;
						$sponsorArrData['service_id'] = $this->input->post('service_id');
					    $sponsorArrData['category_id'] = $this->input->post('category');
					    $sponsorArrData['speaker_name'] = $this->input->post('speakerName')[$key];
					    $sponsorArrData['speaker_details'] = $this->input->post('speakerDesc')[$key];					
					    $sponsorArrData['speaker_image_path'] = $path;
					    $sponsorArrData['speaker_image_name'] = $fileName;					   
						$sponsorArrData['login_status'] = null;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
					   }
					}	  	    
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 			
			 //====== START:: Admin Edit Itinerary Mailer Fun. on 26-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
			 
             if($returnUrl==1){
			      return redirect('itineraries_request');
				 }else{
				  return redirect('all_itineraries');
				 }				  
	   }
		
//========= send To Translator from Admin function date 07-03-19 ===========//	 

public function sendToTranslator(){
	
	$transvalue = trim($this->input->post('transvalue'));
	$itinerary_id = base64_decode($this->input->post('itinerary_id'));
	$serviceid = $this->input->post('serviceid');	
	$userData = $this->Admin_model->getUserData($itinerary_id);	
	if(!empty($userData)){
		$this->mailForTranslator($userData);
	}
	
	$msg = $this->Admin_model->updatetranslator_type($transvalue,$itinerary_id,$serviceid);	
	echo $msg;die;
}


//=========== Translator Function Start =============//
public function translator_reqitineraries(){
	    $ses = $this->session->userdata('adminSes');
		
		if($ses['admin_type']==4){
			 $translator = 1;
			}
	   if($ses['admin_type']==5){
			 $translator = 2;
			}		
		
	  if($ses['admin_type']!=2){
		$city = $this->input->post('city');	
		$serviceType = $this->input->post('serviceType');
		$searchVal = $this->input->post('itinerarySearch');	
		
		$param = "creates_itinerary.admin_status IN('1', '2','3','4') and translator_type='$translator'";
		if(isset($searchVal) && $searchVal!='')
			$param .= " AND creates_itinerary.itinerary_title LIKE '%".$searchVal."%'";
		if(isset($status) && $status!='')
			$param .= " AND creates_itinerary.admin_status='".$status."'";
								
		if(isset($city) && $city!='')
			$param .= " AND creates_itinerary.origin_city='".$city."'";
						
		if(isset($serviceType) && $serviceType!='')
			//$param .= " AND FIND_IN_SET('$serviceType',users_profile.services_offered)";
		    $param .= " AND creates_itinerary.service_id = '".$serviceType."'";

				
	     $this->load->helper('hostservices');
		 $notifyData = $this->Admin_model->fetchItineraryRows();
		 $cityData = $this->Admin_model->fetchAllCities();
	     $itineraryData = $this->Admin_model->fetchTranslatorItineries($param);		 	   	
		 
		 //echo '<pre>';print_r($itineraryData);die;
		if(!empty($itineraryData)){
		  $data['iterator'] = $itineraryData;
		}else{
		 $data['iterator'] = '';
		}
			
	   if($this->input->is_ajax_request())
		{	
	     if(!empty($data['iterator'])){       
			$data['view']=$this->load->view('admin/translator_itinerary_element',compact('data','notifyData','cityData'),true);			
			echo json_encode($data);die;
		 }else{
			 $datas['view'] = 'Empty data';			
			 echo json_encode($datas);die;
			}    
		}else{		 
		   $this->load->view('admin/translator_itinerary_request',compact('data','notifyData','cityData'));	
		}
		
	}	
	else{ 
		  redirect('host');
		}
}


//========= Translator All Itineraries function start: on 18-03-19 =========//

public function translator_all_itineraries(){
	    $ses = $this->session->userdata('adminSes');
		
		if($ses['admin_type']==4){
			$translatorType = 1;
			}
	    if($ses['admin_type']==5){
			$translatorType = 2;
			}		
		
	  if($ses['admin_type']!=2){
		$city = $this->input->post('city');	
		$serviceType = $this->input->post('serviceType');
		$searchVal = $this->input->post('itinerarySearch');	
		$param = "creates_itinerary.admin_status='5' and translator_type='$translatorType'";
		if(isset($searchVal) && $searchVal!='')
			$param .= " AND creates_itinerary.itinerary_title LIKE '%".$searchVal."%'";
						
		if(isset($city) && $city!='')
			$param .= " AND creates_itinerary.origin_city='".$city."'";
						
		if(isset($serviceType) && $serviceType!='')
			//$param .= " AND FIND_IN_SET('$serviceType',users_profile.services_offered)";
		 $param .= " AND creates_itinerary.service_id='".$serviceType."'";
		 
	     $this->load->helper('hostservices');
		 $notifyData = $this->Admin_model->fetchHostRows();
		 $cityData = $this->Admin_model->fetchAllCities();
	     $itineraryData = $this->Admin_model->fetchTranslatorAllItineries($param);
		 
		if(!empty($itineraryData)){
		  $data['iterator'] = $itineraryData;
		}else{
		 $data['iterator'] = '';
		}
			
	   if($this->input->is_ajax_request())
		{	
	     if(!empty($data['iterator'])){       
			$data['view']=$this->load->view('admin/translator_allitinerary_element',compact('data','notifyData','cityData'),true);			
			echo json_encode($data);die;
		 }else{
			 $data['view'] = 'Empty data';
			 echo json_encode($data);die;
			}    
		}else{		 
		   $this->load->view('admin/translator_all_itineraries',compact('data','notifyData','cityData'));	
		}
		
	}	
	else{ 
			redirect('host');
		}
}


//================ Edit walk itinerary by translator on 18-03-19==============//
public function translator_edit_walk(){
	     $user_Id =    $this->input->get('userid',true);
		 $userId = base64_decode($user_Id);
		 $itinerary_Id = $this->input->get('itineraryid',true);
		 $itineraryId = base64_decode($itinerary_Id);		 
		 $serviceId = $this->input->get('serviceid',true);		 
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		 $flag = $this->input->get('flag',true);		
		 $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);	
		 $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
		 $userCity = $this->Itinerarie_model->findUser_city($userId);
		 $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
		 $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
		 $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
		 $drafStopData = $this->Itinerarie_model->getEditStopsData($userId,$itineraryId);
		 $allthemes = $this->Itinerarie_model->selectThemes();
		 $features = $this->Itinerarie_model->selectFeatures();
		 $languages = $this->Itinerarie_model->selectLanguages($userId);
		 $hostimage = $this->Itinerarie_model->getProfileimage($userId);
		 $allowItinerary = $this->Itinerarie_model->allowHost($userId);
		 $this->load->helper('fetchallstops');
		 foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($editDataSet);die;
		 
	    $this->load->view('admin/translator_edit_walk',compact('editDataSet','serviceId','otherlang','allCategory','userCity',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','flag',
						 'languages','itineraryId','adminStatus','hostimage','allowItinerary','drafStopData'));
}



//========== Translator Edit walk itinerary =========//
public function translator_walkeditItinerary(){
       $loginHostid = $this->input->post('user_id');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');
	   $returnUrl = $this->input->post('returnUrl');
           
	   $itineraryUpdateArr['other_category_type'] = $this->input->post('type_category');	   
	   $itineraryUpdateArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itineraryUpdateArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itineraryUpdateArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itineraryUpdateArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');	   
	   $itineraryUpdateArr['translator_confirm'] = 1;
	   //echo '<pre>';print_r($itineraryUpdateArr);die;
	    $this->Admin_model->translatorUpdateItinerary($itineraryUpdateArr,$otherlang,$itinerary_id);
		return redirect('translator_reqitineraries');
}	


//================ Edit walk itinerary by translator on 18-03-19==============//
public function translator_edit_experience(){
        $user_Id =    $this->input->get('userid',true);
        $userId = base64_decode($user_Id);
        $itinerary_Id = $this->input->get('itineraryid',true);
        $itineraryId = base64_decode($itinerary_Id);
        $serviceId = $this->input->get('serviceid',true);
        $otherlang = $this->input->get('otherlang',true);
        $adminStatus = $this->input->get('adminStatus',true);
        $flag = $this->input->get('flag',true);
        $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);
        $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
        $userCity = $this->Itinerarie_model->findUser_city($userId);
        $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
        $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
        $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
        $drafStopData = $this->Itinerarie_model->getEditStopsData($userId,$itineraryId);
        $allthemes = $this->Itinerarie_model->selectThemes();
        $features = $this->Itinerarie_model->selectFeatures();
        $languages = $this->Itinerarie_model->selectLanguages($userId);
        $hostimage = $this->Itinerarie_model->getProfileimage($userId);
        $allowItinerary = $this->Itinerarie_model->allowHost($userId);
        $this->load->helper('fetchallstops');
        foreach($dataSet as $value){
            $editDataSet = $value;
        }
        //echo '<pre>';print_r($editDataSet);die;

        $this->load->view('admin/translator_edit_experience',compact('editDataSet','serviceId','otherlang','allCategory','userCity',
            'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','flag',
            'languages','itineraryId','adminStatus','hostimage','allowItinerary','drafStopData'));
    }

//========== Translator Edit Experience itinerary =========//
    public function translator_editexperience_itinerary(){
        $loginHostid = $this->input->post('user_id');
        $service_id = $this->input->post('service_id');
        $otherlang = $this->input->post('selLang');
        $itinerary_id = $this->input->post('itinerary_id');
        $returnUrl = $this->input->post('returnUrl');

        $itineraryUpdateArr['other_category_type'] = $this->input->post('type_category');
        $itineraryUpdateArr['origin_other_city'] = $this->input->post('origin_otherCity');
        $itineraryUpdateArr['itinerary_other_title'] = $this->input->post('itinerary_other_title');
        $itineraryUpdateArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
        $itineraryUpdateArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
        $itineraryUpdateArr['translator_confirm'] = 1;
        //echo '<pre>';print_r($itineraryUpdateArr);die;
        $this->Admin_model->translatorUpdateItinerary($itineraryUpdateArr,$otherlang,$itinerary_id);
        return redirect('translator_reqitineraries');
    }
	
//================ Edit Session itinerary by translator on 19-03-19==============//
public function translator_edit_session(){
        $user_Id =    $this->input->get('userid',true);
        $userId = base64_decode($user_Id);
        $itinerary_Id = $this->input->get('itineraryid',true);
        $itineraryId = base64_decode($itinerary_Id);
        $serviceId = $this->input->get('serviceid',true);
        $otherlang = $this->input->get('otherlang',true);
        $adminStatus = $this->input->get('adminStatus',true);
        $flag = $this->input->get('flag',true);
        $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);
        $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
        $userCity = $this->Itinerarie_model->findUser_city($userId);
        $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
        $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
        $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
        $drafStopData = $this->Itinerarie_model->getEditStopsData($userId,$itineraryId);
        $allthemes = $this->Itinerarie_model->selectThemes();
        $features = $this->Itinerarie_model->selectFeatures();
        $languages = $this->Itinerarie_model->selectLanguages($userId);
        $hostimage = $this->Itinerarie_model->getProfileimage($userId);
        $allowItinerary = $this->Itinerarie_model->allowHost($userId);
        $this->load->helper('fetchallstops');
        foreach($dataSet as $value){
            $editDataSet = $value;
        }
        //echo '<pre>';print_r($editDataSet);die;

        $this->load->view('admin/translator_edit_session',compact('editDataSet','serviceId','otherlang','allCategory','userCity',
            'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','flag',
            'languages','itineraryId','adminStatus','hostimage','allowItinerary','drafStopData'));
    }
	
	
//========== Translator Edit Session itinerary on done button click =========//
    public function translator_sessionitinerary(){
        $loginHostid = $this->input->post('user_id');
        $service_id = $this->input->post('service_id');
        $otherlang = $this->input->post('selLang');
        $itinerary_id = $this->input->post('itinerary_id');
        $returnUrl = $this->input->post('returnUrl');

        $itineraryUpdateArr['other_category_type'] = $this->input->post('type_category');
        $itineraryUpdateArr['origin_other_city'] = $this->input->post('origin_otherCity');
        $itineraryUpdateArr['itinerary_other_title'] = $this->input->post('itinerary_other_title');
        $itineraryUpdateArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
        $itineraryUpdateArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
        $itineraryUpdateArr['translator_confirm'] = 1;        
        $this->Admin_model->translatorUpdateItinerary($itineraryUpdateArr,$otherlang,$itinerary_id);
        return redirect('translator_reqitineraries');
    }	
	

//================ Edit Meetup itinerary by translator on 19-03-19==============//
public function translator_edit_meetup(){
        $user_Id =    $this->input->get('userid',true);
        $userId = base64_decode($user_Id);
        $itinerary_Id = $this->input->get('itineraryid',true);
        $itineraryId = base64_decode($itinerary_Id);
        $serviceId = $this->input->get('serviceid',true);
        $otherlang = $this->input->get('otherlang',true);
        $adminStatus = $this->input->get('adminStatus',true);
        $flag = $this->input->get('flag',true);
        $dataSet = $this->Itinerarie_model->createItineraryView($userId,$itineraryId);
        $allCategory = $this->Itinerarie_model->selectCategory($serviceId);
        $userCity = $this->Itinerarie_model->findUser_city($userId);
        $draFaqData = $this->Itinerarie_model->getEditFaqData($userId,$itineraryId);
        $drafRouteTimeData = $this->Itinerarie_model->getEditRouteData($userId,$itineraryId);
        $drafFamilyData = $this->Itinerarie_model->getEditFamilyeData($userId,$itineraryId);
        $drafStopData = $this->Itinerarie_model->getEditStopsData($userId,$itineraryId);
        $allthemes = $this->Itinerarie_model->selectThemes();
        $features = $this->Itinerarie_model->selectFeatures();
        $languages = $this->Itinerarie_model->selectLanguages($userId);
        $hostimage = $this->Itinerarie_model->getProfileimage($userId);
        $allowItinerary = $this->Itinerarie_model->allowHost($userId);
        $this->load->helper('fetchallstops');
        foreach($dataSet as $value){
            $editDataSet = $value;
        }
        //echo '<pre>';print_r($editDataSet);die;

        $this->load->view('admin/translator_edit_meetup',compact('editDataSet','serviceId','otherlang','allCategory','userCity',
            'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','userId','flag',
            'languages','itineraryId','adminStatus','hostimage','allowItinerary','drafStopData'));
    }

//========== Translator Edit Meetup itinerary on done button click ==========//
    public function translator_meetupItinerary(){
        $loginHostid = $this->input->post('user_id');
        $service_id = $this->input->post('service_id');
        $otherlang = $this->input->post('selLang');
        $itinerary_id = $this->input->post('itinerary_id');
        $returnUrl = $this->input->post('returnUrl');

        $itineraryUpdateArr['other_category_type'] = $this->input->post('type_category');
        $itineraryUpdateArr['origin_other_city'] = $this->input->post('origin_otherCity');
        $itineraryUpdateArr['itinerary_other_title'] = $this->input->post('itinerary_other_title');
        $itineraryUpdateArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
        $itineraryUpdateArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
        $itineraryUpdateArr['translator_confirm'] = 1;        
        $this->Admin_model->translatorUpdateItinerary($itineraryUpdateArr,$otherlang,$itinerary_id);
        return redirect('translator_reqitineraries');
    }
	
	
//========== Host Creation by Admin function Start on 05-04-19===========//
public function hostCreation(){
	    $hostFname = $this->input->post('fname');
        $hostLname = $this->input->post('lname');
        $mobileNo = $this->input->post('mnumber');
        $mailid = $this->input->post('mailid');
        $iam = $this->input->post('iam');
		$OTP = mt_rand(100000, 999999);
		$status = 1;
		$adminStatus = 1;
		$chars  = "abcdefghijklmnpqrstuvwxyzABCDEFGIHJKLMNPQRSTUVWXYZ123456789-_";
        $pass   = substr(str_shuffle($chars), 0, 12);
		
		$result = $this->User_model->register_valid($mailid);
        $mobNum = $this->User_model->uniqueNumber($mobileNo);
		$responseArr = array();
		
		if(!empty($mobNum)){
				  $responseArr['status'] = 'unique_num_err';				 
				  $responseArr['email'] = '';
				  $responseArr['pass'] = '';
				  echo json_encode($responseArr);die;
				}
		else{
			if($result){			 
			 $responseArr['status'] = 'emailerror';
			 $responseArr['email'] = '';
			 $responseArr['pass'] = '';
			 echo json_encode($responseArr);die;
			 }else{
			 
			  $data = array(
			        'host_first_name'  =>  $hostFname,
			        'host_last_name'   =>  $hostLname,
			        'host_mob_no'      =>  $mobileNo,
			        'host_email'       =>  $mailid,
                    'i_am'             =>  $iam,
					'host_password'    =>  $pass,
			        'otp'              =>  $OTP,
			        'status'           =>  $status,
					'admin_status'     =>  $adminStatus,
					'created_at'       => date('Y-m-d h:i:s')
		        );
                 $registerData = $this->User_model->register( $data );				 
				 
				 if($registerData){
				 
				        $config = $this->smtpCredential();				     						
						$hostData['hostName'] = $hostFname.' '.$hostLname;
						$hostData['hostPass'] = $pass;						
						$hostData['link'] = 'loginMailHost?hostemail='.base64_encode($mailid).'&hostpass='.base64_encode($pass);
						
						$body = $this->load->view('mailer/host_creation_mail', $hostData, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('help@cityexplorers.in', 'City Explorers');
                        $this->email->to($mailid);
                        $this->email->subject('City Explorers - Welcome to City Explorers');
                        $this->email->message($body);
                        $this->email->send();
						
						$id = $this->User_model->get_id($pass);
                                $data = array (
                                       'user_id'=> $id
                                    );
                                
                        $resullt = $this->User_model->profile_id_create($data); 						
						$responseArr['status'] = 'success';
						$responseArr['email'] = $mailid;
				        $responseArr['pass'] = $pass;
						echo json_encode($responseArr);die;
					 }else{					   
					   $responseArr['status'] = 'create_err';
					   $responseArr['email'] = '';
				       $responseArr['pass'] = '';
					   echo json_encode($responseArr);die;
					 }
					 
			 }
		}
}


//========= Admin go to host profile to fill form ==========//
public function hostProfile(){
	$hostEmail = $this->input->post('email');
	$hostPass = $this->input->post('pass');
	if($hostEmail!=='' && $hostPass!==''){
		 $user_id = $this->User_model->login_valid($hostEmail,$hostPass);
		 if($user_id){			    
			    $loginStatus = $this->Admin_model->getLoginStatus($user_id);
				$loginArr = json_decode(json_encode($loginStatus),true); 				
				$this->session->set_userdata('id',$user_id);
				if(!empty($loginArr)){
					 if($loginArr[0]['admin_status']!=5){
						 echo "login_success";die;
						 }
					 else{
						  echo 'my_itinerary';die;
						 }	 
					}                
					      
			}else{
                 
                echo "emptydb_err";
				      
			}
	}
}


//========== create Host Profile function ==========//
public function createhostprofile(){
	$id = $this->session->userdata('id');
    $state = $this->User_model->get_state();
	$user_data  = $this->User_model->find_profile( $id );
	$myInterestData = $this->User_model->fetchInterestData();//added by robin on 01-02-19
	$allCity = $this->User_model->fetchAllCities();
	$iwlLanguage = $this->User_model->fetchIwlLanguage();
	$termConditionData = $this->User_model->fetchTermsConditions(); // it's function call terms and condition
	
		$cityNameArr = array();
		$cityIdArr = array();
		foreach($allCity as $value){
			 if(!in_array($value->city_name,$cityNameArr)){
				  array_push($cityNameArr,$value->city_name);
				 }
			 if(!in_array($value->id,$cityIdArr)){
				 array_push($cityIdArr,$value->id);
				 }	 
			}
		$citycombine = array_combine($cityIdArr,$cityNameArr);	
		$cityresult = '';
		foreach($citycombine as $key=>$value){
			  $data['id'] = $value;
			  $data['name'] = $value;
			  if($key!=count($citycombine)){
				  $cityresult .= json_encode($data).',';
				  }
			  else{
				  $cityresult .= json_encode($data);
				  }	 
			  	
			}
		$hostId = $id;	

	$this->load->view('admin/host_profile',compact('state','user_data','myInterestData',
	                  'cityresult','iwlLanguage','termConditionData','hostId'));
}

//DONE PROFILE
public function host_profile_done()
        {
           
         if($this->form_validation->run('user_profile_rule')){
		  
		  if(!empty($this->input->post('swachh_bharat'))){
				 $swachhBharat = $this->input->post('swachh_bharat');
				}
			else{
				 $swachhBharat = 0;
				}
			if(!empty($this->input->post('tourism'))){
				 $tourismData = $this->input->post('tourism');
				}
			else{
				 $tourismData = 0;
				}
			
			
			if(!empty($this->input->post('term_condition'))){
				 $termcondition = $this->input->post('term_condition');
				}else{
				 $termcondition = 0;
				}
							
		  if($this->input->post('date_of_birth')!==null && $this->input->post('date_of_birth')!==''){			
			$dob = date('Y-m-d',strtotime($this->input->post('date_of_birth')));			
			 }
			 
		if(!empty($this->input->post('noc_certificate'))){
				 $NOC_certificate = $this->input->post('noc_certificate');
				}
		   else{
			    $NOC_certificate = 0;			    
			   }		
            
            $user_id              = $this->session->userdata('id');
            $first_name           = $this->input->post('first_name');
            $last_name            = $this->input->post('last_name'); 
            $mobile_number        = $this->input->post('mobile_number');
            $email_id             = $this->input->post('email_id'); 
            $gender               = $this->input->post('gender');
            $nationality          = $this->input->post('nationality');
            //$date_of_birth        = $this->input->post('date_of_birth');
            $date_of_birth        = $dob; //date('Y/m/d',strtotime($this->input->post('date_of_birth')));
            $description          = $this->input->post('description');
            $per_address_1        = $this->input->post('per_address_1');
            $per_address_2        = $this->input->post('per_address_2');
            $per_address_3        = $this->input->post('per_address_3');
            $state                = $this->input->post('state');
            $city                 = $this->input->post('city');
            $pin_code             = $this->input->post('pin_code');
       //TEMPORARY ADDRESS 
           $tmp_address_1         = $this->input->post('tmp_address_1');
           $tmp_address_2         = $this->input->post('tmp_address_2');
           $tmp_address_3         = $this->input->post('tmp_address_3');
           $tmp_state             = $this->input->post('tmp_state');
           $tmp_city              = $this->input->post('tmp_city');
           $tmp_pin_code          = $this->input->post('tmp_pin_code');
        //COMPANY DETAILS
            $associated_companies = $this->input->post('associated_companies');
            $company_name         = $this->input->post('company_name');
            $company_address_1    = $this->input->post('company_address_1');
            $company_address_2    = $this->input->post('company_address_2');
            $company_state        = $this->input->post('company_state');
            $company_city         = $this->input->post('company_city');
            $company_pin_code     = $this->input->post('company_pin_code');
            $swachh_bharat       =  $swachhBharat;
			$tourism             =  $tourismData;
			$term_condition      =  $termcondition;
			$host_before_desc   = $this->input->post('host_before_desc');
            //FILES UPLOADS PROFILE PIC START
            if($_FILES['profile_pic']['name']!="")
              {
               
                $config['upload_path'] = './assets/upload/profile_pic/';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    //$config['max_size'] = '2048';
                    //$config['max_width']     = '1024';
                    //$config['max_height']    = '768';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('profile_pic'))
                    {
                      
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                        $upload_data = $this->upload->data();
                        $config['image_library']='gd2';
                        $config['source_image']='./assets/upload/profile_pic/'.$upload_data['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        /*$config['quality']= '60%';
                        $config['width']= 600;
                        $config['height']= 400;*/
                        $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        //$this->image_lib->resize();
                        
                        $profile_image = $upload_data['file_name'];
                    }
                }
                else{
                      
                           $profile_image = $this->input->post('profile_img');
                        }

//FILES UPLOADS PROFILE PIC END
//FILES ADHAAR NUMBER START
            if($_FILES['adhaar_num_doc']['name']!="")
              {
                $config['upload_path'] = './assets/upload/profile_pic/';
                 //$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('adhaar_num_doc'))
                    {
                      
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                       
                        $upload_data = $this->upload->data();
                        $config['image_library']='gd2';
                        $config['source_image']='./assets/upload/profile_pic/'.$upload_data['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['quality']= '60%';
                        $config['width']= 600;
                        $config['height']= 400;
                        $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $adhaar_number_doc = $upload_data['file_name'];
                    }
                }
                else{
                      
                        $adhaar_number_doc=$this->input->post('adhaar_doc');
                    }
//FILES UPLOADS PAN NUMBER END
//FILES UPLOADS PAN NUMBER START
            if($_FILES['pan_num_doc']['name']!="")
              {
                $config['upload_path'] = './assets/upload/profile_pic/';
                 //$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('pan_num_doc'))
                    {
                      
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                       
                        $upload_data=$this->upload->data();
                        $config['image_library']='gd2';
                        $config['source_image']='./assets/upload/profile_pic/'.$upload_data['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['quality']= '60%';
                        $config['width']= 600;
                        $config['height']= 400;
                        $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $pan_number_doc=$upload_data['file_name'];
                    }
                }
                else{
                      
                      $pan_number_doc=$this->input->post('pan_doc');
                    }
//FILES UPLOADS PAN NUMBER END

//FILES UPLOADS PASSPORT NUMBER START
            if($_FILES['passport_num_doc']['name']!="")
              {
                $config['upload_path'] = './assets/upload/profile_pic/';
                 //$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('passport_num_doc'))
                    {
                      
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                       
                        $upload_data=$this->upload->data();
                        $config['image_library']='gd2';
                        $config['source_image']='./assets/upload/profile_pic/'.$upload_data['file_name'];
                        $config['create_thumb']= FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['quality']= '60%';
                        $config['width']= 600;
                        $config['height']= 400;
                        $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        $passport_number_doc=$upload_data['file_name'];
                    }
                }
                else{
                      
                            $passport_number_doc=$this->input->post('passport_doc');
                        }
//FILES UPLOADS PASSPORT NUMBER END
//FILES UPLOADS LICENSE GUIDE NUMBER START
            if($_FILES['license_guide_num_doc']['name']!="")
              {
                $config['upload_path'] = './assets/upload/profile_pic/';
                 //$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('license_guide_num_doc'))
                    {
                      
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                       
                      $upload_data=$this->upload->data();
                      $config['image_library']='gd2';
                      $config['source_image']='./assets/upload/profile_pic/'.$upload_data['file_name'];
                      $config['create_thumb']= FALSE;
                      $config['maintain_ratio']= FALSE;
                      $config['quality']= '60%';
                      $config['width']= 600;
                      $config['height']= 400;
                      $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                      $this->load->library('image_lib', $config);
                      $this->image_lib->resize();
                      $license_guide_number_doc=$upload_data['file_name'];
                    }
                }
                else{
                      
                            $license_guide_number_doc=$this->input->post('license_guide_doc');
                        }
//FILES UPLOADS LICENSE GUIDE NUMBER END   
//FILES UPLOADS LICENSE GUIDE NUMBER START
            if($_FILES['gst_pin_doc']['name']!="")
              {
                $config['upload_path'] = './assets/upload/profile_pic/';
                 //$config['allowed_types'] =     'gif|jpg|png|jpeg|jpe|pdf|doc|docx|rtf|text|txt';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('gst_pin_doc'))
                    {
                      
                        $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                       
                      $upload_data=$this->upload->data();
                      $config['image_library']='gd2';
                      $config['source_image']='./assets/upload/profile_pic/'.$upload_data['file_name'];
                      $config['create_thumb']= FALSE;
                      $config['maintain_ratio']= FALSE;
                      $config['quality']= '60%';
                      $config['width']= 600;
                      $config['height']= 400;
                      $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                      $this->load->library('image_lib', $config);
                      $this->image_lib->resize();
                      $gst_pin_doc=$upload_data['file_name'];
                    }
                }
                else{
                      
                            $gst_pin_doc=$this->input->post('gst_doc');
                        }
//FILES UPLOADS LICENSE GUIDE NUMBER END
            if($this->input->post('interest') ==''){

            }else{
              $interst     = $this->input->post('interest');
              $interested    = implode(',', $interst ); 

            }
            if($this->input->post('services_offered') ==''){

            }else{
              $service_offered     = $this->input->post('services_offered');
              $services_offered    = implode(',', $service_offered );

            }
            if($this->input->post('preferred_cities') ==''){

            }else{
             $preferred_city     = $this->input->post('preferred_cities');
             $pref_city          = implode(',', $preferred_city );

            }
            if($this->input->post('know_languages') ==''){

            }else{
              $known_lang         = $this->input->post('know_languages');
              $know_lan        = implode(',', $known_lang );
            }

            $preferred_languag    = $this->input->post('preferred_languages');
            $host_before          = $this->input->post('host_before');
            $adhaar_number        = $this->input->post('adhaar_number'); 
            $pan_number           = $this->input->post('pan_number');
            $passport_number      = $this->input->post('passport_number');
            $license_guide_number = $this->input->post('license_guide_number');
            $gst_pin              = $this->input->post('gst_pin');
            $status               = '1';
			$hostTypeArr = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17); // Host type Array for admin create host
			$hostType = array_rand($hostTypeArr);

            $data_user_profile_done = array(
              'user_id'             => $user_id,
              'profile_picture'     =>  $profile_image,
              'gender'              =>  $gender,
              'nationality'         =>  $nationality,
              'date_of_birth'       =>  $date_of_birth,
              'description'         =>  $description,
              'permanent_address_1' =>  $per_address_1,
              'permanent_address_2' =>  $per_address_2,
              'permanent_address_3' =>  $per_address_3,
              'state'               =>  $state,
              'city'                =>  $city,
              'pin_code'            =>  $pin_code,
              'tmp_address_1'       =>  $tmp_address_1,
              'tmp_address_2'       =>  $tmp_address_2,
              'tmp_address_3'       =>  $tmp_address_3,
              'tmp_state'           =>  $tmp_state,
              'tmp_city'            =>  $tmp_city,
              'tmp_pin_code'        =>  $tmp_pin_code,
              'associated_companies'=>  $associated_companies,
              'company_name'        =>  $company_name,
              'company_address_1'   =>  $company_address_1,
              'company_address_2'   =>  $company_address_2,
              'company_state'       =>  $company_state,
              'company_city'        =>  $company_city,
              'company_pin_code'    =>  $company_pin_code,
              'interest'            =>  $interested,
             'services_offered'     =>  $services_offered,
             'preferred_cities'     =>  $pref_city,
             'host_before'          =>  $host_before,
			 'host_before_note'     =>  $host_before_desc,
             'preferred_languages'  =>  $preferred_languag,
             'known_languages'      =>  $know_lan,
             'adhaar_number'        =>  $adhaar_number,
             'adhaar_number_doc'    =>  $adhaar_number_doc,
             'pan_number'           =>  $pan_number,
             'pan_number_doc'       =>  $pan_number_doc,
             'passport_number'      =>  $passport_number,
             'passport_number_doc'  =>  $passport_number_doc,
             'license_guide_number' =>  $license_guide_number,
             'license_guide_number_doc'=>  $license_guide_number_doc,
             'gst_pin'             =>  $gst_pin,
             'gst_pin_doc'         =>  $gst_pin_doc,
             'status'              =>  $status,
			 'swachh_bharat'       =>  $swachh_bharat,
			 'tourism'            =>  $tourism,
			 'term_condition'   => $term_condition,
			 'noc_certificate_policy' =>$NOC_certificate,
			 'host_verification_type' =>$hostType,
			 'verified_by'      =>'Call',
			 'host_type_status' =>'0',
            );
            $data_done_user = array(
                  'host_first_name' =>  $first_name,
                  'host_last_name'  =>  $last_name,
                  'host_mob_no'     =>  $mobile_number,
				  'admin_status'    => '5'
            );
		    //echo '<pre>';print_r($data_done_user);die;    
             $this->User_model->user_update( $user_id, $data_done_user );            
            $profile_id = $this->User_model->check_user_id($user_id);
           
		   //========== update users host_status function start on 17-11-18 by robin =================//
		   $this->User_model->updateUser_hostStatus($user_id);
		   //========== update users host_status function END on 17-11-18 by robin =================//
		   
        if($profile_id){
            
            $result = $this->User_model->user_profile_update($profile_id,$data_user_profile_done);
            $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
          
                if($result){
                   $this->session->set_flashdata('error','donemsg');                   
                    $this->session->set_userdata('user_status',$status,'60' );                   
                   return redirect('host');
                }else{
                  $this->session->set_flashdata('error','done_error');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('host_profile');

                }

        }else{
             
               $result = $this->User_model->user_profile_insert($data_user_profile_done);

                if($result){

                  $this->session->set_flashdata('error','doneprofile_insert');
                   $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('host_profile');

                }else{

                   $this->session->set_flashdata('error','doneprofile_insert_err');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('host_profile');

                }
          }

          }else{
             
            $this->session->set_flashdata('error',validation_errors());
            //$this->session->set_flashdata('error','Please Fill All The Fields For Complete The Profile');
             $this->session->set_flashdata('feedback_class','alert-danger');
             //$this->load->view('account/user_profile');
            return redirect('host_profile');
           
          }
 } 
 
 //=========== Update Host Profile by Admin on 08-04-19 ==========//
 public function updateHostProfileLang(){
		  $data = $this->input->post();
		  if($this->input->is_ajax_request()){
			   if(!empty($data['hostId']) && !empty($data['new_lang'])){
			   
			      $langdata = $this->Itinerarie_model->getProfileLang($data['hostId']);
				  
				  foreach($langdata as $value){
				        if(!empty($value->known_languages)){
							 $langval = $value->known_languages;
							}else{
							 $langval = '';
							}
					    
					  }
					 if($langval!==''){
						 $addNewlang =  $langval.','.$data['new_lang']; // here we add database language and add new language
						 }
						else{
							 $addNewlang = $data['new_lang'];
							} 
					
					$updatelang = $this->Itinerarie_model->updateProfileLang($data['hostId'],$addNewlang);
					echo $updatelang;die;
				   }
			  }
		  else{
			   exit('No direct script access allowed');die;
			  }	  
		}

		
//==========START:: Admin create Walk Itinerary func. on 09-04-19 ===========//
public function admin_create_walk_itinerary(){
	$service_id = $this->input->get('serviceid',true); // service id from query string url
	$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
	$hostId = base64_decode($this->input->get('hostid',true)); // host id from query string url
	$userCity = $this->Itinerarie_model->findUser_city($hostId);
	$features = $this->Itinerarie_model->selectFeatures();
	$languages = $this->Itinerarie_model->selectLanguages($hostId);
	$allCategory = $this->Itinerarie_model->selectCategory($service_id);
	$allthemes = $this->Itinerarie_model->selectThemes($hostId);
	$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database
	$myInterestData = $this->User_model->fetchInterestData();//added by robin on 01-02-19
	$hostProfile = $this->Itinerarie_model->getHostProfile($hostId); //get Host information
	$airPortData = $this->Itinerarie_model->getAirports();
	$railwayData = $this->Itinerarie_model->getRailways();	
	//echo '<pre>';print_r($myInterestData);die;
	$this->load->view('admin/admin_create_walk_itinerary',compact('service_id','selectOtherLang','hostId','userCity',
	                  'features','languages','allCategory','allthemes',
					  'legalData','myInterestData','hostProfile','airPortData','railwayData'));
}

 //============= Admin Walk Itinerary Done Button click =====================//
 public function adminDoneWalkItinerary(){
	   $loginHostid = $this->input->post('hostId');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator_confirm'] = 0;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	  
	   
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';
	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }	 
	   
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));
	   $stoplocation_count = count($this->input->post('itinerary_route_slot01_stop01_location'));
	   $stoplocation_timecount = count($this->input->post('itinerary_route_slot01_stop01_time'));
	   $stopdesc_count = count($this->input->post('itinerary_route_slot01_stop01_description'));
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway'); 
       $itinerarySaveArr['location_covered'] = $this->input->post('itinerary_location_covered');
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');
	   
	   if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			$costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   
	   //$itinerarySaveArr['additional_cost_description'] = $this->input->post('itinerary_additionalcost_description');
	   $itinerarySaveArr['additional_price'] = "";      	 
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	   
	        //echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;	       
		   //========= START:: Call Sponsor Images upload Function ============//		      
		      $path = './assets/itinerary_files/sponsor_file/';
		      $allowType = "gif|jpg|png|jpeg";
			  $files = $_FILES;
			  $thumbPath = './assets/itinerary_files/sponsor_thumbnail_images/';
			  $resizewidth = 400;
			  $resizeHeight = 127;
			  $hide_Sponsor = $this->input->post('itinerary_sponsor_hide_image_cover');
			  $sponsorData = $this->uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight);
			 
		 //========= END:: Call Sponsor Images upload Function ============//	
		    
		
           if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {  
		          $done_fileName = $_FILES['itinerary_gallery_image_cover']['name'];
		        
				  $path = "./assets/itinerary_files/gallery/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_cover';
				  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
				  $itineraryfeatrue_image = $this->file_upload($path,$done_fileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);
				 
                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('hide_feature_img');					  
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              { 		     
		          $done_addFile_01 = $_FILES['itinerary_gallery_image_01']['name'];
		         
				  $path = "./assets/itinerary_files/additional_images/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_01';
				  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
				  $additional_image1 = $this->file_upload($path,$done_addFile_01,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
				 				
                }
                else{                        
                       $additional_image1 = $this->input->post('hide_additional_img1');
                     }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {   	
		          $done_addFile_02 = $_FILES['itinerary_gallery_image_02']['name'];
		          
				  $path = "./assets/itinerary_files/additional_images/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_02';
				  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
				  $additional_image2 = $this->file_upload($path,$done_addFile_02,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
				 				 
                }
                else{                        
                       $additional_image2 = $this->input->post('hide_additional_img2');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {   
		          $done_addFile_03 = $_FILES['itinerary_gallery_image_03']['name'];
		           
				  $path = "./assets/itinerary_files/additional_images/";
				  $allowType = "gif|jpg|png|jpeg";
				  $thumbPath = './assets/itinerary_files/thumbnail_images/';
				  $fileInputName = 'itinerary_gallery_image_03';
				  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
				  $additional_image3 = $this->file_upload($path,$done_addFile_03,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
				
                }
                else{                        
                       $additional_image3 = $this->input->post('hide_additional_img3');
                      }					  
					  
	   	   
		   // =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              {		   
		            $done_videoName = $_FILES['itinerary_gallery_video']['name'];
		            $videoInfo = new SplFileInfo($done_videoName);
				    $video_ext = $videoInfo->getExtension();
				    $walk_videoName = time().'.'.$video_ext;
			        
					$config_donevideo = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|mp3|avi|mp4",					
					'file_name' => $walk_videoName,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					);
					
					$this->load->library('upload');
					$this->upload->initialize($config_donevideo);
					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data             = $this->upload->data();						
                        $config_donevideo['image_library'] ='gd2';
                        //$config_donevideo['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_donevideo['create_thumb']  = FALSE;
                        $config_donevideo['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $itinerary_video = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $itinerary_video = $this->input->post('hide_video');
                      }	
			
					  
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $itinerary_video;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
			$itinerarySaveArr['sponsors_img'] = $sponsorData;
	   
	     $checkCountRows = $this->Itinerarie_model->getInsertRow($loginHostid);	    
	     $statusArr = $this->Itinerarie_model->getItineraryStatus($loginHostid);
		 $lastdata = end($statusArr); // get last data of an array
		// echo '<pre>';print_r($lastdata);die;
	    if(!empty($statusArr)){
		    $status = @$lastdata->status;
		   }else{
		    $status =1;
		   }
		
	   if($status==1){		    
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);
			//echo $lastInsert_id = $this->db->insert_id();die();
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_faqs', $faqArrData);
					 }
				
                  for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $lastId;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   $this->input->post('dropoff_coordinates')[$i];
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_routes_timings', $routeArrData);	
						$routeInsertId = $this->db->insert_id();
						
					//========= New Stops for route =================//
					if(!empty($routeInsertId)){
					   $slotEmptyChk = $this->input->post('itinerary_route_slot01_stop01_location');	   
					   if(!empty($slotEmptyChk)){ 
						 for($j=0;$j<$stoplocation_count;$j++){
								$newStopData['user_id'] = $loginHostid;	
								$newStopData['route_id'] = $routeInsertId;	
								$newStopData['service_id'] = $this->input->post('service_id');
								$newStopData['create_itinerary_id'] = $lastId;
								$newStopData['category_id'] = $this->input->post('category');
								$newStopData['stop_location_type'] = $this->input->post('itinerary_route_slot01_stop01_location')[$i];
								$newStopData['stop_location_time'] = $this->input->post('itinerary_route_slot01_stop01_time')[$i];			
								$newStopData['stop_location_desc'] = $this->input->post('itinerary_route_slot01_stop01_description')[$i];   
								$newStopData['created_at'] =  date('Y-m-d h:i:s');						
								$this->db->insert('txn_routes_stops', $newStopData);
							 } 
						 }
					}
					
 				  }
				  
				  //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $lastId;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);
					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]); 
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				
				  
				}
				
			   $this->session->set_flashdata('success','doneInsert');	
			
		   }

		   else{
		      $itinerarySaveArr['login_status'] = null;		     
			  $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  $updateData = $this->Itinerarie_model->updateDoneData($loginHostid,$itinerarySaveArr);
			  //print_r($getsaveItineraryId);die;
			  $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			  $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);
			  $getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$getsaveItineraryId[0]->id);			 

			  $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			 
			 //print_r($getRouteids);die;
			 if(!empty($getsaveItineraryId[0]->id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			
			if(!empty($getStopids)){
				  $deleteFamily = $this->Itinerarie_model->deleteStopsdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['login_status'] = null;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   $this->input->post('dropoff_coordinates')[$i];
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);
						$routeInsertId = $this->db->insert_id();
						
					//========= New Stops for route =================//
					if(!empty($routeInsertId)){
					   $slotEmptyChk = $this->input->post('itinerary_route_slot01_stop01_location');	   
					   if(!empty($slotEmptyChk)){ 
						 for($j=0;$j<$stoplocation_count;$j++){
								$newStopData['user_id'] = $loginHostid;
								$newStopData['route_id'] = $routeInsertId;
								$newStopData['service_id'] = $this->input->post('service_id');
								$newStopData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
								$newStopData['category_id'] = $this->input->post('category');
								$newStopData['stop_location_type'] = $this->input->post('itinerary_route_slot01_stop01_location')[$i];
								$newStopData['stop_location_time'] = $this->input->post('itinerary_route_slot01_stop01_time')[$i];			
								$newStopData['stop_location_desc'] = $this->input->post('itinerary_route_slot01_stop01_description')[$i];	$newStopData['created_at'] =  date('Y-m-d h:i:s');						
								$this->db->insert('txn_routes_stops', $newStopData);
							 } 
						 }
					}
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $getsaveItineraryId[0]->id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);
					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";			      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";			      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				 	  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','doneUpdate');	
		  }            
		  return redirect('itineraries_request');
	 }
	 

//==========START:: Admin create Experience Itinerary func. on 09-04-19 ===========//
public function admin_create_experience_itinerary(){
	$service_id = $this->input->get('serviceid',true); // service id from query string url
	$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
	$hostId = base64_decode($this->input->get('hostid',true)); // host id from query string url
	$userCity = $this->Itinerarie_model->findUser_city($hostId);
	$features = $this->Itinerarie_model->selectFeatures();
	$languages = $this->Itinerarie_model->selectLanguages($hostId);
	$allCategory = $this->Itinerarie_model->selectCategory($service_id);
	$allthemes = $this->Itinerarie_model->selectThemes($hostId);
	$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database
	$myInterestData = $this->User_model->fetchInterestData();//added by robin on 01-02-19
	$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($hostId);
	$draFaqData = $this->Itinerarie_model->getSaveTqsData($hostId);
	$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($hostId);
	$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($hostId);
	$stopsNewData = $this->Itinerarie_model->getSaveStopsData($hostId);
	$hostProfile = $this->Itinerarie_model->getHostProfile($hostId); //get Host information
	$airPortData = $this->Itinerarie_model->getAirports();
	$railwayData = $this->Itinerarie_model->getRailways();		
	//echo '<pre>';print_r($hostSaveData);die;
	if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}
	$this->load->view('admin/admin_create_experience_itinerary',compact('service_id','selectOtherLang','hostId','userCity',
	                  'features','languages','allCategory','allthemes','legalData','myInterestData','draftData',
					   'draFaqData','drafRouteTimeData','drafFamilyData',
					   'stopsNewData','hostProfile','airPortData','railwayData'));
}


	//============= Admin Create Experience Itinerary Done Button click =====================//
 public function adminDoneExperienceItinerary(){
	   $loginHostid = $this->input->post('hostId');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   
	   
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   $experienceType = '';
	   
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }	 
	 if(!empty($this->input->post('experience_itinerary_type'))){
		$experienceType = implode(',',$this->input->post('experience_itinerary_type'));
		}	
		
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   $itinerarySaveArr['experience_type'] = $experienceType;
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));
	   $stoplocation_count = count($this->input->post('itinerary_route_slot01_stop01_location'));
	   $stoplocation_timecount = count($this->input->post('itinerary_route_slot01_stop01_time'));
	   $stopdesc_count = count($this->input->post('itinerary_route_slot01_stop01_description'));
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway'); 
       $itinerarySaveArr['location_covered'] = $this->input->post('itinerary_location_covered');
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');
	   if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			$costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = ''; 	   
	       	 
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	  
	   
	        //echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;
	       //FILES UPLOADS CREATE ITINERARY START           		
            if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $expdoneAddFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$expdoneAddFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);

                }
                else{                        
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $expdoneAddFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$expdoneAddFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);

                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                      }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $expdoneAddFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$expdoneAddFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);

                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $expdoneAddFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$expdoneAddFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);

                }
                else{                        
                       $additional_image3 = $this->input->post('itinerary_gallery_image_hide_03');
                      }					  
					  
	   	  	// =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              {   
		   
		            $videoName = $_FILES['itinerary_gallery_video']['name'];
					$videoInfo = new SplFileInfo($videoName);
				    $video_ext = $videoInfo->getExtension();
				    $video_name = time().'.'.$video_ext;
					$config_video = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|mp3|avi|mp4",					
					'file_name' => $video_name,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					//'min_height' => "1440",
					//'min_width' => "810",
					//'maintain_ratio'=>TRUE
					);
					
					$this->load->library('upload');
					$this->upload->initialize($config_video); 
					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data  = $this->upload->data();						
                        $config_video['image_library'] ='gd2';
                        //$config_video['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_video['create_thumb']  = FALSE;
                        $config_video['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $itinerary_video = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $itinerary_video = $this->input->post('itinerary_gallery_hide_video');
                     }	
			
					  
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $itinerary_video;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
	   
	     $checkCountRows = $this->Itinerarie_model->getInsertRow($loginHostid);	    
	     $statusArr = $this->Itinerarie_model->getItineraryStatus($loginHostid);
		 $lastdata = end($statusArr); // get last data of an array
		// echo '<pre>';print_r($lastdata);die;
	    if(!empty($statusArr)){
		    $status = @$lastdata->status;
		   }else{
		    $status =1;
		   }
		//echo '<pre>';print_r($itinerarySaveArr);die;
	   if($status==1){		    
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);
			//echo $lastInsert_id = $this->db->insert_id();die();
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_faqs', $faqArrData);
					 }
				
                  for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $lastId;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   $this->input->post('dropoff_coordinates')[$i];
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
				  
				  //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $lastId;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					    //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);  
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";			      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }									  
				  
				}
				
			   $this->session->set_flashdata('success','doneInsert');	
			    return redirect('itineraries_request');
		   }
		   else{
		      $itinerarySaveArr['login_status'] = null;		     
			  $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  $updateData = $this->Itinerarie_model->updateDoneData($loginHostid,$itinerarySaveArr);
			  //print_r($getsaveItineraryId);die;
			  $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			  $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);
			  //$getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$getsaveItineraryId[0]->id);			 

			  $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			 
			 //print_r($getRouteids);die;
			 if(!empty($getsaveItineraryId[0]->id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$getsaveItineraryId[0]->id);
				 }	
			
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['login_status'] = null;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] =   $this->input->post('dropoff_coordinates')[$i];
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $getsaveItineraryId[0]->id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					    //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);  
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";			      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }					  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','doneUpdate');	
		  }           
		  return redirect('itineraries_request');
	 }
	 
	 
//==========START:: Admin create Meetup Itinerary func. on 10-04-19 ===========//
public function admin_create_meetup_itinerary(){
	$service_id = $this->input->get('serviceid',true); // service id from query string url
	$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
	$hostId = base64_decode($this->input->get('hostid',true)); // host id from query string url
	$userCity = $this->Itinerarie_model->findUser_city($hostId);
	$features = $this->Itinerarie_model->selectFeatures();
	$languages = $this->Itinerarie_model->selectLanguages($hostId);
	$allCategory = $this->Itinerarie_model->selectCategory($service_id);
	$allthemes = $this->Itinerarie_model->selectThemes($hostId);
	$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database
	$myInterestData = $this->User_model->fetchInterestData();//added by robin on 10-04-19
	$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($hostId);
	$draFaqData = $this->Itinerarie_model->getSaveTqsData($hostId);
	$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($hostId);
	$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($hostId);
	$stopsNewData = $this->Itinerarie_model->getSaveStopsData($hostId);
	$hostProfile = $this->Itinerarie_model->getHostProfile($hostId); //get Host information
	$airPortData = $this->Itinerarie_model->getAirports();
	$railwayData = $this->Itinerarie_model->getRailways();
	//echo '<pre>';print_r($hostSaveData);die;
	if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}
	$this->load->view('admin/admin_create_meetup_itinerary',compact('service_id','selectOtherLang','hostId','userCity',
	                  'features','languages','allCategory','allthemes','legalData','myInterestData','draftData',
					   'draFaqData','drafRouteTimeData','drafFamilyData',
					   'stopsNewData','hostProfile','airPortData','railwayData'));
}


//================ ********* START:: Admin Done meetup itinerary function start ************=====================//
public function adminDoneMeetupItinerary(){
	
	   $loginHostid = $this->input->post('hostId');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
       $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   $meetupType = '';
	   //$sponsorImages = '';	  
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }
	if(!empty($this->input->post('meetup_itinerary_type'))){
		$meetupType = implode(',',$this->input->post('meetup_itinerary_type'));
		}
	/*if(!empty($this->input->post('itinerary_sponsor_hide_image_cover'))){
		$sponsorImages = implode(',',$this->input->post('itinerary_sponsor_hide_image_cover'));
		}*/	
		
	  
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   $itinerarySaveArr['meetup_type'] = $meetupType;
	   //$itinerarySaveArr['sponsors_img'] = $sponsorImages;
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));	  
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway');       
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');	   
	   
	  if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			$costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = ''; 	   
	   		  
       $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	   
	       // echo '<pre>';print_r($_POST);die;
	       //echo '<pre>';print_r($_FILES);die;
		   //========= START:: Call Sponsor Images upload Function ============//		      
		      $path = './assets/itinerary_files/sponsor_file/';
		      $allowType = "gif|jpg|png|jpeg";
			  $files = $_FILES;
			  $thumbPath = './assets/itinerary_files/sponsor_thumbnail_images/';
			  $resizewidth = 400;
			  $resizeHeight = 127;
			  $hide_Sponsor = $this->input->post('itinerary_sponsor_hide_image_cover');
			  $sponsorData = $this->uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight);
			 
		  //========= END:: Call Sponsor Images upload Function ============//		     
					
          if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $meetdoneFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$meetdoneFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);

                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
					   //echo $itineraryfeatrue_image;die;
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $meetdoneFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$meetdoneFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);

                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                      }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $meetdoneFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$meetdoneFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $meetdoneFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$meetdoneFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);

                }
                else{                        
                       $additional_image3 = $this->input->post('itinerary_gallery_image_hide_03');
                      }					  
					  
	   			// =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              {   		   
		            $videoName = $_FILES['itinerary_gallery_video']['name'];
					$videoInfo = new SplFileInfo($videoName);
				    $video_ext = $videoInfo->getExtension();
				    $video_name = time().'.'.$video_ext;
					$config_video = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|avi|mp4",					
					'file_name' => $video_name,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					);
					
					$this->load->library('upload');
					$this->upload->initialize($config_video); 
					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data  = $this->upload->data();						
                        $config_video['image_library'] ='gd2';
                        //$config_video['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_video['create_thumb']  = FALSE;
                        $config_video['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $fileName = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $fileName = $this->input->post('itinerary_gallery_hide_video');
                     }		
					 		   
			
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $fileName;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
			$itinerarySaveArr['sponsors_img'] = $sponsorData;
	   
	     $checkCountRows = $this->Itinerarie_model->getInsertRow($loginHostid);
	     
	     $statusArr = $this->Itinerarie_model->getItineraryStatus($loginHostid);
		 $lastdata = end($statusArr); // get last data of an array
		//echo '<pre>';print_r($lastdata);die;
	    if(!empty($statusArr)){		    
		    $status = @$lastdata->status;
		   }
		   else{
			    $status = 1;
			   }
				
	   if($status==1){		    
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);			
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_faqs', $faqArrData);
					 }
				
                  for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $lastId;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] = null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
				  
				  //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $lastId;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]); 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];					 
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";			      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				
				 if(!empty($this->input->post('speakerName'))){				      
					for($i=0;$i<$speakerNameCount;$i++){
					    // File upload configuration
						$targetDir = "./assets/itinerary_files/meetup_speaker/";						
						//$allowTypes = array('jpg','png','jpeg','gif');
						$data = $this->input->post('speakerImg')[$i];	 
						$image_parts = explode(";base64,", $data);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = $image_type_aux[1];
						$image_base64 = base64_decode($image_parts[1]);
						$file = $targetDir . uniqid() . '.'.$image_type;
						$fileName = uniqid() . '.'.$image_type;
						$path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;
						file_put_contents($file, $image_base64);						
					    $sponsorArrData['user_id'] = $loginHostid;
				        $sponsorArrData['create_itinerary_id'] = $lastId;
						$sponsorArrData['service_id'] = $this->input->post('service_id');
					    $sponsorArrData['category_id'] = $this->input->post('category');
					    $sponsorArrData['speaker_name'] = $this->input->post('speakerName')[$i];
					    $sponsorArrData['speaker_details'] = $this->input->post('speakerDesc')[$i];					
					    $sponsorArrData['speaker_image_path'] = $path;
					    $sponsorArrData['speaker_image_name'] = $fileName;					   
						$sponsorArrData['login_status'] = 1;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:S');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
						}
					}	  	  
				}
				
			   $this->session->set_flashdata('success','doneInsert');	
			    return redirect('itineraries_request');
		   }
		   else{
		      $itinerarySaveArr['login_status'] = null;		     
			  $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  $updateData = $this->Itinerarie_model->updateMeetupDraftData($loginHostid,$itinerarySaveArr);
			  //print_r($getsaveItineraryId);die;
			  $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			  $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);			 
			  $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			  $getSpeakerids = $this->Itinerarie_model->getSaveSpeakerids($loginHostid,$getsaveItineraryId[0]->id);
			 //print_r($getRouteids);die;
			 if(!empty($getsaveItineraryId[0]->id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			if(!empty($getSpeakerids)){
				  $deleteFamily = $this->Itinerarie_model->deleteSpeakerdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['login_status'] = null;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] = null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $getsaveItineraryId[0]->id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);  
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";				      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				if(!empty($this->input->post('speakerName'))){				      
					    $targetDir = "./assets/itinerary_files/meetup_speaker/";						
						$data = $this->input->post('speakerImg');
					foreach($data as $key=>$valueimg){												
						$image_parts = explode(";base64,", $data[$key]);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = @$image_type_aux[1];
						$image_base64 = base64_decode($image_parts[1]);					
						$explodImage = explode(';base64,',$data[$key]);
						$uniueId = uniqid();
						$file = $targetDir . $uniueId . '.'.$image_type;
						if(isset($explodImage[1]) && $explodImage[1]!=''){
								$fileName = $uniueId . '.'.$image_type;
								$path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;						
								file_put_contents($file, $image_base64);
							 }
						 else{
							 $fileName = $data[$key];
							 $path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;
							 }	 
						
					    $sponsorArrData['user_id'] = $loginHostid;
				        $sponsorArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
						$sponsorArrData['service_id'] = $this->input->post('service_id');
					    $sponsorArrData['category_id'] = $this->input->post('category');
					    $sponsorArrData['speaker_name'] = $this->input->post('speakerName')[$key];
					    $sponsorArrData['speaker_details'] = $this->input->post('speakerDesc')[$key];					
					    $sponsorArrData['speaker_image_path'] = $path;
					    $sponsorArrData['speaker_image_name'] = $fileName;					   
						$sponsorArrData['login_status'] = null;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:S');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
						}
					}	  	  
								  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			  $this->session->set_flashdata('success','doneUpdate');
			  return redirect('itineraries_request');
		 }	
 }
 
 
 //==========START:: Admin create Session Itinerary func. on 10-04-19 ===========//
public function admin_create_session_itinerary(){
	$service_id = $this->input->get('serviceid',true); // service id from query string url
	$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
	$hostId = base64_decode($this->input->get('hostid',true)); // host id from query string url
	$userCity = $this->Itinerarie_model->findUser_city($hostId);
	$features = $this->Itinerarie_model->selectFeatures();
	$languages = $this->Itinerarie_model->selectLanguages($hostId);
	$allCategory = $this->Itinerarie_model->selectCategory($service_id);
	$allthemes = $this->Itinerarie_model->selectThemes($hostId);
	$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database
	$myInterestData = $this->User_model->fetchInterestData();//added by robin on 10-04-19
	$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($hostId);
	$draFaqData = $this->Itinerarie_model->getSaveTqsData($hostId);
	$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($hostId);
	$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($hostId);
	$stopsNewData = $this->Itinerarie_model->getSaveStopsData($hostId);
	$hostProfile = $this->Itinerarie_model->getHostProfile($hostId); //get Host information
	$airPortData = $this->Itinerarie_model->getAirports();
	$railwayData = $this->Itinerarie_model->getRailways();		
	//echo '<pre>';print_r($hostSaveData);die;
	if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}
	$this->load->view('admin/admin_create_session_itinerary',compact('service_id','selectOtherLang','hostId','userCity',
	                  'features','languages','allCategory','allthemes','legalData','myInterestData','draftData',
					   'draFaqData','drafRouteTimeData','drafFamilyData',
					   'stopsNewData','hostProfile','airPortData','railwayData'));
}


//================ ********* START:: Admin Done Session itinerary function on 10-04-19 ************=====================//
public function adminDoneSessionItinerary(){
	
	   $loginHostid = $this->input->post('hostId');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
       $itinerarySaveArr['user_id'] = $loginHostid;
       $itinerarySaveArr['itinerary_category'] = $this->input->post('category');
	   $itinerarySaveArr['other_category_type'] = $this->input->post('type_category');
	   $itinerarySaveArr['origin_city'] = $this->input->post('originCity');
	   $itinerarySaveArr['origin_other_city'] = $this->input->post('origin_otherCity');
	   $itinerarySaveArr['itinerary_title'] = $this->input->post('itinerary_title'); 
	   $itinerarySaveArr['itinerary_other_title'] = $this->input->post('itinerary_other_title'); 
	   $itinerarySaveArr['itinerary_tagline'] = $this->input->post('itinerary_tagline');
	   $itinerarySaveArr['itinerary_other_tagline'] = $this->input->post('other_tag_line');
	   $itinerarySaveArr['itinerary_description'] = $this->input->post('itinerary_description');
	   $itinerarySaveArr['other_itinerary_description'] = $this->input->post('other_itinerary_description');
	   $itinerarySaveArr['status'] =1;
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['admin_status'] = 1;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   //$itinerarySaveArr['translator_type'] = 0;
	   
	   $themes = '';
	   $highLights = '';
	   $features = '';
	   $searchtags = '';
	   $deliverys ='';
	   $myLanguage ='';
	   $servicedays = '';	   
	   $week1_days = '';
	   $week2_days = '';
	   $week3_days = '';
	   $week4_days = '';
	   $week5_days = '';
	   $meetupType = '';
	  	  
	   if(!empty($this->input->post('itinerary_theme'))){
		   $themes = implode(',',$this->input->post('itinerary_theme'));
		   }
	   if(!empty($this->input->post('itinerary_highlights'))){
		   $highLights = implode(',',$this->input->post('itinerary_highlights'));
		   }
	   if(!empty($this->input->post('itinerary_features'))){
		   $features = implode(',',$this->input->post('itinerary_features'));
		   }	   
	   if(!empty($this->input->post('itinerary_searchtags'))){
		   $searchtags = implode(',',$this->input->post('itinerary_searchtags'));
		   }
	   if(!empty($this->input->post('itinerary_delivery'))){
		    $deliverys = implode(',',$this->input->post('itinerary_delivery'));
		   }
	   if(!empty($this->input->post('preferences_languages'))){
		    $myLanguage = implode(',',$this->input->post('preferences_languages'));
		   }
	  if(!empty($this->input->post('itinerary_service_days'))){
		    $servicedays = implode(',',$this->input->post('itinerary_service_days'));
		   }
	  if(!empty($this->input->post('weekly_1'))){
		 $week1_days = implode(',',$this->input->post('weekly_1'));
		 }
	  if(!empty($this->input->post('weekly_2'))){
		 $week2_days = implode(',',$this->input->post('weekly_2'));
		 }
	  if(!empty($this->input->post('weekly_3'))){
		 $week3_days = implode(',',$this->input->post('weekly_3'));
		 }
	 if(!empty($this->input->post('weekly_4'))){
		 $week4_days = implode(',',$this->input->post('weekly_4'));
		 }
	 if(!empty($this->input->post('weekly_5'))){
		 $week5_days = implode(',',$this->input->post('weekly_5'));
		 }
	if(!empty($this->input->post('meetup_itinerary_type'))){
		$meetupType = implode(',',$this->input->post('meetup_itinerary_type'));
		}
		  
	   $itinerarySaveArr['itinerary_theme'] = $themes;	   
		   
	   $itinerarySaveArr['itinerary_searchtags'] = $searchtags;
	   $itinerarySaveArr['type_highlights'] = $highLights;
	   $itinerarySaveArr['type_features'] = $features;
	   $itinerarySaveArr['itinerary_delivery'] = $deliverys;	 	   
	   $itinerarySaveArr['prefer_languages'] = $myLanguage;	   
	   $itinerarySaveArr['itinerary_inclusions'] = $this->input->post('itinerary_inclusions');
	   $itinerarySaveArr['itinerary_exclusions'] = $this->input->post('itinerary_exclusions');
	   $itinerarySaveArr['itinerary_spl_mention'] = $this->input->post('itinerary_splmention');	   
	   $itinerarySaveArr['itinerary_allowshare_facebook'] = $this->input->post('itinerary_allowshare_facebook');
	   $itinerarySaveArr['itinerary_allowshare_instagram'] = $this->input->post('itinerary_allowshare_instagram');     
	   $itinerarySaveArr['host_first_name'] = $this->input->post('itinerary_host_firstname');
	   $itinerarySaveArr['host_last_name'] = $this->input->post('itinerary_host_lastname');     
	   $itinerarySaveArr['host_mob_num'] = $this->input->post('itinerary_host_mobile');
	   $itinerarySaveArr['host_email'] = $this->input->post('itinerary_host_email');     
	   $itinerarySaveArr['host_emergency_contact_num'] = $this->input->post('itinerary_host_emergency');
	   $itinerarySaveArr['aviaiable_time_form_host'] = $this->input->post('itinerary_aviaiable_time_from');      
	   $itinerarySaveArr['aviaiable_time_to_host'] =  $this->input->post('itinerary_aviaiable_time_to');
	   $itinerarySaveArr['start_date_from_host'] = date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_start_date')));     
	   $itinerarySaveArr['end_date_to_host'] =   date('y-m-d h:s',strtotime($this->input->post('itinerary_aviaiable_end_date')));
	   $itinerarySaveArr['service_frequency'] = $this->input->post('itinerary_service_frequency');
       $itinerarySaveArr['days'] = $servicedays;	   
	   $itinerarySaveArr['week1_days'] = $week1_days;
	   $itinerarySaveArr['week2_days'] = $week2_days;
	   $itinerarySaveArr['week3_days'] = $week3_days;
	   $itinerarySaveArr['week4_days'] = $week4_days;
	   $itinerarySaveArr['week5_days'] = $week5_days;
	   $itinerarySaveArr['meetup_type'] = $meetupType;
	   //$itinerarySaveArr['sponsors_img'] = $sponsorImages;
	   	 
	   $faqcount = count($this->input->post('itinerary_faq_question_01'));	  
	   $faqAnswercount = count($this->input->post('itinerary_faq_answer_01'));	   
	   $routpickup_pointcount = count($this->input->post('itinerary_route_slot01_pickup'));
	   $routpickup_timecount = count($this->input->post('itinerary_route_slot01_pickup_time'));
	   $routdrop_pointcount = count($this->input->post('itinerary_route_slot01_dropoff'));
	   $routdrop_timecount = count($this->input->post('itinerary_route_slot01_dropoff_time'));
	   $routduration_count = count($this->input->post('itinerary_route_slot01_duration'));
	   $routcuttoff_timecount = count($this->input->post('itinerary_route_slot01_cutofftime'));	  
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway');       
 	   $itinerarySaveArr['private_traveller'] = $this->input->post('itinerary_traveller_private');      
	   $itinerarySaveArr['private_min_no_travellers'] = $this->input->post('itinerary_traveller_private_minnumber');
 	   $itinerarySaveArr['private_max_no_travellers'] = $this->input->post('itinerary_traveller_private_maxnumber');      
	   $itinerarySaveArr['group_traveller'] = $this->input->post('itinerary_traveller_group');
 	   $itinerarySaveArr['group_min_no_travellers'] = $this->input->post('itinerary_traveller_group_minnumber');
	   $itinerarySaveArr['group_max_no_travellers'] = $this->input->post('itinerary_traveller_group_maxnumber');
       $itinerarySaveArr['private_price'] = $this->input->post('itinerary_traveller_private_price');
       $itinerarySaveArr['group_price'] = $this->input->post('itinerary_traveller_group_price');	   
	  
	  if($this->input->post('itinerary_additionalcost_description') && !empty($this->input->post('itinerary_additionalcost_description')))
	   {
		   foreach($this->input->post('itinerary_additionalcost_description') as $key => $value)
		   {
			   $costData[] = array("itinerary_additionalcost_description"=>$value, "additional_price"=>$this->input->post('itinerary_additionalcost_amt')[$key]);
		   }
	   }
	   $itinerarySaveArr['additional_cost_description'] = isset($costData) ? json_encode($costData) : "";
	   $itinerarySaveArr['additional_price'] = "";	   
	   $itinerarySaveArr['confirmation_type'] = $this->input->post('itinerary-confirmationtype');
	   $itinerarySaveArr['Instant_confirmation_message'] = $this->input->post('itinerary_confirmationtype_msg');	  
	   $itinerarySaveArr['itinerary_cancelbyhost_agree'] = $this->input->post('itinerary-cancellations-agree');
	   $itinerarySaveArr['itinerary_cancelbytraveller_agree'] = $this->input->post('itinerary-donetraveller-agree');	 
	   $itinerarySaveArr['itinerary_refund_agree'] = $this->input->post('itinerary-refund-agree');	   
	   $itinerarySaveArr['itinerary_liabilitie_disclaimer'] = $this->input->post('itinerary-disclaimer-agree');
	   $itinerarySaveArr['itinerary_privacy_policy'] = $this->input->post('itinerary-privacy-agree');	  
	   $itinerarySaveArr['itinerary_terms_condition'] = $this->input->post('itinerary-terms-agree');	   
	   $itinerarySaveArr['last_doneby_host'] = $this->input->post('itinerary-cancelbyHost-agree-copy');	  
	   $itinerarySaveArr['last_doneby_traveller'] = $this->input->post('itinerary-cancelbytraveller-agree-copy');
	   $itinerarySaveArr['last_refund'] = $this->input->post('itinerary-refund-agree-copy');	  
	   $itinerarySaveArr['media_infringement'] = $this->input->post('itinerary-copyright-agree');
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   
	   if(!empty($this->input->post('term_condition'))){
				 $itinerarySaveArr['term_condition'] = $this->input->post('term_condition');
				}
	   
	        //echo '<pre>';print_r($_POST);die;
	      // echo '<pre>';print_r($_FILES);die;
		   //========= START:: Call Sponsor Images upload Function ============//		      
		      $path = './assets/itinerary_files/sponsor_file/';
		      $allowType = "gif|jpg|png|jpeg";
			  $files = $_FILES;
			  $thumbPath = './assets/itinerary_files/sponsor_thumbnail_images/';
			  $resizewidth = 400;
			  $resizeHeight = 127;
			  $hide_Sponsor = $this->input->post('itinerary_sponsor_hide_image_cover');
			  $sponsorData = $this->uploadSponsorImages($path,$allowType,$files,$hide_Sponsor,$thumbPath,$resizewidth,$resizeHeight);
			 
		  //========= END:: Call Sponsor Images upload Function ============//	
		  	     			
          if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $sessiondoneFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$sessiondoneFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);
                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
					   //echo $itineraryfeatrue_image;die;
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $sessiondoneFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$sessiondoneFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                      }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $sessiondoneFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$sessiondoneFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                           $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $sessiondoneFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$sessiondoneFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image3 = $this->input->post('itinerary_gallery_image_hide_03');
                      }					  
					  
	   	  		// =============== Video upload start================//
		   if($_FILES['itinerary_gallery_video']['name']!="")
              {   		   
		            $videoName = $_FILES['itinerary_gallery_video']['name'];
					$videoInfo = new SplFileInfo($videoName);
				    $video_ext = $videoInfo->getExtension();
				    $video_name = time().'.'.$video_ext;
					$config_video = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|avi|mp4",					
					'file_name' => $video_name,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					);
					
					$this->load->library('upload');
					$this->upload->initialize($config_video); 
					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					 // print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data  = $this->upload->data();						
                        $config_video['image_library'] ='gd2';
                        //$config_video['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_video['create_thumb']  = FALSE;
                        $config_video['maintain_ratio']= FALSE;
                       // $config_video['quality']       = '60%';
                       // $config_video['width']         = 250;
                       // $config_video['height']        = 158;
                       // $config_video['new_image']     = './assets/itinerary_files/thumbnail_images/'.$upload_data['file_name'];
                        //$this->load->library('image_lib', $config_3);
                        //$this->image_lib->resize();                       
                        $fileName = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $fileName = $this->input->post('itinerary_gallery_hide_video');
                     }		
			
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $fileName;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
			$itinerarySaveArr['sponsors_img'] = $sponsorData;
	   
	     $checkCountRows = $this->Itinerarie_model->getInsertRow($loginHostid);
	     
	     $statusArr = $this->Itinerarie_model->getItineraryStatus($loginHostid);
		 $lastdata = end($statusArr); // get last data of an array
		//echo '<pre>';print_r($lastdata);die;
	    if(!empty($statusArr)){		    
		    $status = @$lastdata->status;			
		   }
		elseif($lastdata->status==0){
			    $status = 0;				
			   }   
		   else{
			    $status = 1;				
			   }
		
		//echo '<pre>';print_r($itinerarySaveArr);die;	
		
	   if($status==1){		    
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);			
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_faqs', $faqArrData);
					 }
				
                  for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $lastId;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] = null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
				  
				  //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $lastId;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);
					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);
					   
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";				      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				
				 if(!empty($this->input->post('speakerName'))){				      
					for($i=0;$i<$speakerNameCount;$i++){
					    // File upload configuration
						$targetDir = "./assets/itinerary_files/meetup_speaker/";						
						//$allowTypes = array('jpg','png','jpeg','gif');
						$data = $this->input->post('speakerImg')[$i];	 
						$image_parts = explode(";base64,", $data);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = $image_type_aux[1];
						$image_base64 = base64_decode($image_parts[1]);
						$file = $targetDir . uniqid() . '.'.$image_type;
						$fileName = uniqid() . '.'.$image_type;
						$path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;
						file_put_contents($file, $image_base64);						
					    $sponsorArrData['user_id'] = $loginHostid;
				        $sponsorArrData['create_itinerary_id'] = $lastId;
						$sponsorArrData['service_id'] = $this->input->post('service_id');
					    $sponsorArrData['category_id'] = $this->input->post('category');
					    $sponsorArrData['speaker_name'] = $this->input->post('speakerName')[$i];
					    $sponsorArrData['speaker_details'] = $this->input->post('speakerDesc')[$i];					
					    $sponsorArrData['speaker_image_path'] = $path;
					    $sponsorArrData['speaker_image_name'] = $fileName;					   
						$sponsorArrData['login_status'] = 1;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
						}
					}	  	  
				}
				
			   $this->session->set_flashdata('success','doneInsert');	
			    return redirect('itineraries_request');
		   }
		   else{
		      $itinerarySaveArr['login_status'] = null;		     
			  $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  $updateData = $this->Itinerarie_model->updateMeetupDraftData($loginHostid,$itinerarySaveArr);
			  //print_r($getsaveItineraryId);die;
			  $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			  $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);			 
			  $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			  $getSpeakerids = $this->Itinerarie_model->getSaveSpeakerids($loginHostid,$getsaveItineraryId[0]->id);
			 //print_r($getRouteids);die;
			 if(!empty($getsaveItineraryId[0]->id)){
			 if(!empty($getFaqids)){
				  $deleteData = $this->Itinerarie_model->deleteFaqdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getRouteids)){
				  $deleteRoutes = $this->Itinerarie_model->deleteRoutesdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			 if(!empty($getFamilyids)){
				  $deleteFamily = $this->Itinerarie_model->deleteFamilydata($loginHostid,$getsaveItineraryId[0]->id);
				 }
			if(!empty($getSpeakerids)){
				  $deleteFamily = $this->Itinerarie_model->deleteSpeakerdata($loginHostid,$getsaveItineraryId[0]->id);
				 }
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['login_status'] = null;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				 
			 //========== routes and timing updated loop here =============//
			 for($i=0;$i<$routpickup_pointcount;$i++){
                      	$routeArrData['user_id'] = $loginHostid;
				        $routeArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
						$routeArrData['service_id'] = $this->input->post('service_id');
					    $routeArrData['category_id'] = $this->input->post('category');
					    $routeArrData['pickup_point'] = $this->input->post('itinerary_route_slot01_pickup')[$i];
					    $routeArrData['start_pickup_time'] = $this->input->post('itinerary_route_slot01_pickup_time')[$i];					
					    $routeArrData['drop_off_point'] = $this->input->post('itinerary_route_slot01_dropoff')[$i];
					    $routeArrData['end_dropoff_time'] = $this->input->post('itinerary_route_slot01_dropoff_time')[$i];					  
					    $routeArrData['total_durations'] = $this->input->post('itinerary_route_slot01_duration')[$i];
					    $routeArrData['cutt_off_time'] =   $this->input->post('itinerary_route_slot01_cutofftime')[$i];						
					    $routeArrData['stop_location'] =   $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $routeArrData['stop_time'] =   $this->input->post('itinerary_route_slot01_stop01_time')[$i];
					    $routeArrData['description'] =   $this->input->post('itinerary_route_slot01_stop01_description')[$i];
						$routeArrData['pickup_lat_lng'] =   $this->input->post('pickup_coordinates')[$i];
						$routeArrData['drop_off_lat_lng'] = null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
			 //=========== END :: routes and timing loop =================//
			 
			 //========== family traveller entry ===========//
				  for($i=0;$i<$familyTravellerCount;$i++){
					   $familyData['user_id'] = $loginHostid;
					   $familyData['service_id'] = $this->input->post('service_id');
					   $familyData['category_id'] = $getsaveItineraryId[0]->id;
					   $familyData['service_category_id'] = $this->input->post('category');
					   $familyData['family_traveller'] = $this->input->post('itinerary-traveller-family');
					   $familyData['family_adult_min_no'] = $this->input->post('itinerary_traveller_family_adult_minnumber');			 
					   $familyData['family_adult_max_no'] = $this->input->post('itinerary_traveller_family_adult_maxnumber'); 
					   $familyData['family_kides_below_age'] = $this->input->post('itinerary-traveller-family-kids01-age')[$i]; 
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];
					   $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);
					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);
					   
					   $familyData['adults_price'] = isset($this->input->post('itinerary_traveller_family_adult_price')[$i]) ? $this->input->post('itinerary_traveller_family_adult_price')[$i] : "";				      
					   $familyData['kides_age'] =   isset($this->input->post('itinerary_traveller_family_kids01_age')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_age')[$i] : "";
					   $familyData['kides_price'] = isset($this->input->post('itinerary_traveller_family_kids01_price')[$i]) ? $this->input->post('itinerary_traveller_family_kids01_price')[$i] : "";
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				if(!empty($this->input->post('speakerName'))){				      
					    $targetDir = "./assets/itinerary_files/meetup_speaker/";						
						$data = $this->input->post('speakerImg');
					foreach($data as $key=>$valueimg){												
						$image_parts = explode(";base64,", $data[$key]);
						$image_type_aux = explode("image/", $image_parts[0]);
						$image_type = @$image_type_aux[1];
						$image_base64 = base64_decode($image_parts[1]);					
						$explodImage = explode(';base64,',$data[$key]);
						$uniueId = uniqid();
						$file = $targetDir . $uniueId . '.'.$image_type;
						if(isset($explodImage[1]) && $explodImage[1]!=''){
								$fileName = $uniueId . '.'.$image_type;
								$path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;						
								file_put_contents($file, $image_base64);
							 }
						 else{
							 $fileName = $data[$key];
							 $path = base_url().'assets/itinerary_files/meetup_speaker/'.$fileName;
							 }	 
						
					    $sponsorArrData['user_id'] = $loginHostid;
				        $sponsorArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
						$sponsorArrData['service_id'] = $this->input->post('service_id');
					    $sponsorArrData['category_id'] = $this->input->post('category');
					    $sponsorArrData['speaker_name'] = $this->input->post('speakerName')[$key];
					    $sponsorArrData['speaker_details'] = $this->input->post('speakerDesc')[$key];					
					    $sponsorArrData['speaker_image_path'] = $path;
					    $sponsorArrData['speaker_image_name'] = $fileName;					   
						$sponsorArrData['login_status'] = null;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
						}
					}	  	  
								  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			  $this->session->set_flashdata('success','doneUpdate');
			  return redirect('itineraries_request');
		 }	
 }
	 

//========= Itinerary Edit Event Mailer Function==========//
public function itineraryEditMailer($hostData,$itineraryUrl){
	   $adminSes = $this->session->userdata('adminSes');
	   $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	   $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));

	   if($adminSes['admin_type']==1){
		   $data['modify_by'] = 'Super Admin';		   
		   }
	   elseif($adminSes['admin_type']==6){
		   $data['modify_by'] = 'Editor';		   
		   }
	   elseif($adminSes['admin_type']==7){
		   $data['modify_by'] = 'Admin';		   
		   }	   
		
	   $email = $hostData[0]->host_email;
	  
	            $config = $this->smtpCredential();
				
				$data['host_name'] = $hostData[0]->host_first_name.' '.$hostData[0]->host_last_name;
				$data['itinerary_url'] = $itineraryUrl;
				//echo '<pre>';print_r($data);die;
				$body = $this->load->view('mailer/itinerary_edit_mail', $data, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from('help@cityexplorers.in', 'City Explorers');
				$this->email->to($email);
				$this->email->cc([$admin_email,$super_admin_email]);
				$this->email->subject('City Explorers - Itinerary Modified');
				$this->email->message($body);
				$this->email->send();
}

//============ START::Translator Mail function ===============//
public function mailForTranslator($userData){
	
	           $config = $this->smtpCredential();
				
				$data['host_name'] = $userData[0]->host_first_name.' '.$userData[0]->host_last_name;
				
				//echo '<pre>';print_r($data);die;
				$body = $this->load->view('mailer/translator_mail', $data, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from('help@cityexplorers.in', 'City Explorers');
				$this->email->to($userData[0]->host_email);				
				$this->email->subject('City Explorers - Itinerary sent for Translation');
				$this->email->message($body);
				$this->email->send();
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


}

