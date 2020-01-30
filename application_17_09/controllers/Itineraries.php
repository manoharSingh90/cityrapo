<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Itineraries extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		 $this->load->model('Itinerarie_model'); 
		 $this->load->model('Admin_model');
		 $this->load->model('User_model');
		 date_default_timezone_set('Asia/Kolkata'); 
	}
public function index()
	{   $page =  @$_GET['page'];
	    $serviceId =  @$_GET['serviceId'];	
		$hostLang = $this->Itinerarie_model->gethostLanguages();
		$services = $this->Itinerarie_model->getServices();
		$airPortData = $this->Itinerarie_model->getAirports();
		
		if($this->session->userdata('id')){
		 if($serviceId==''){
		      $loginHostid = $this->session->userdata('id');
			  $this->load->helper('getallthemes');
			  $this->load->helper('getcategory');
			  $this->load->helper('hostname');
			  $this->load->helper('getfamilydata');
			  $this->load->helper('getallpickpoints');
			  $this->load->helper('getfamilymultidata');
			  $this->load->helper('gethostname');
			  $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);			  
			  $userServices  = $this->Itinerarie_model->getUserServices($loginHostid);			 
			  $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
			  $itineraryfamilydata = $this->Itinerarie_model->getItineraryfamilyData($loginHostid);
			  $itineraryServicesData = $this->Itinerarie_model->getUserItinerary_value($loginHostid);
			  $themesData = $this->Itinerarie_model->selectThemes();
			  $itineraryResult = $this->Itinerarie_model->getAllUserItinerary($loginHostid,$page,$serviceId);
			  $hostTypeData = $this->Admin_model->fetchHostType();
			  $trainingStatus = $this->Itinerarie_model->getTrainingStatus($loginHostid);
			  
			  if(!empty($itineraryResult)){
				$itineraryData['iterator'] = $itineraryResult;
				}else{
				 $itineraryData['iterator'] = '';
				}
		     
			 if($this->input->is_ajax_request())
				{
			  //$itineraryResult = $this->Itinerarie_model->getAllUserItinerary($loginHostid,$page,$serviceId);			  	
			  //echo '<pre>';print_r($itineraryResult);die;
			  if(!empty($itineraryData['iterator'])){       
					$itineraryData['view']= $this->load->view('itineraries/host_itineraries_element',compact('hostLang','services','itineraryData','hostTypeData','allowItinerary','userServices','hostimage','itineraryfamilydata','itineraryServicesData','themesData','serviceId','airPortData','trainingStatus'),true);			
					echo json_encode($itineraryData);die;
				  }else{
					 $itineraryData['view'] = 'Empty data';			
					 echo json_encode($itineraryData);die;
					}    
				}
			else{	
			  $this->load->view("itineraries/itineraries",compact('hostLang','services','itineraryData','serviceId','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata','itineraryServicesData','themesData','airPortData','trainingStatus'));
			}
		 }elseif($serviceId==1){
		   redirect('walk');
		 }
		 elseif($serviceId==2){
		   redirect('session');
		 }
		 elseif($serviceId==3){
		   redirect('experience');
		 }
		 elseif($serviceId==4){
		   redirect('meetup');
		 }
		 
		}else{
		  redirect('home');
		}
		
	}

//============== function for tab click start on 6-02-19 =================//
public function walk()
	{  
	    $serviceId = $this->input->post('serviceId');
	    $themesid = $this->input->post('themesid');
        $hostType = $this->input->post('hostType');
		$hostLang = $this->Itinerarie_model->gethostLanguages();
		$services = $this->Itinerarie_model->getServices();
		
		if($this->session->userdata('id')){
		      $loginHostid = $this->session->userdata('id');
			  $this->load->helper('getallthemes');
			  $this->load->helper('getcategory');
			  $this->load->helper('hostname');
			  $this->load->helper('getfamilydata');
			  $this->load->helper('getfamilymultidata');
			  $this->load->helper('gethostname');
			  $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);			  
			  $userServices  = $this->Itinerarie_model->getUserServices($loginHostid);
			  $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
			  $itineraryfamilydata = $this->Itinerarie_model->getItineraryfamilyData($loginHostid);
			  $itineraryServicesData = $this->Itinerarie_model->getUserItinerary_value($loginHostid);
			  $themesData = $this->Itinerarie_model->selectThemes();			 
			  $itineraryResult = $this->Itinerarie_model->getAllSearchItinerary($loginHostid,$serviceId,$themesid,$hostType);
			  $hostTypeData = $this->Admin_model->fetchHostType();	 
			  $trainingStatus = $this->Itinerarie_model->getTrainingStatus($loginHostid);
			  
			  if(!empty($itineraryResult)){
				  $itineraryData['iterator'] = $itineraryResult;
				}else{
				 $itineraryData['iterator'] = '';
				}
		     
			
			 if($this->input->is_ajax_request())
				{
                //$itineraryResult = $this->Itinerarie_model->getAllSearchItinerary($loginHostid,$serviceId,$themesid,$hostType);
                  //echo $this->db->last_query();die;
                    if(!empty($itineraryData['iterator'])){
					$itineraryData['view']=$this->load->view('itineraries/host_itineraries_element',compact('hostLang','services',           'itineraryData','hostTypeData','allowItinerary','userServices','hostimage','itineraryfamilydata',
					    'itineraryServicesData','themesData','serviceId','trainingStatus'),true);			
					echo json_encode($itineraryData);die;
				  }else{
					 $itineraryData['view'] = 'Empty data';			
					 echo json_encode($itineraryData);die;
					}    
				}
			else{	
			 $this->load->view("itineraries/itineraries",compact('hostLang','services','itineraryData','serviceId','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata',
							  'itineraryServicesData','themesData','trainingStatus'));
			}	
			
		}else{
		  redirect('home');
		}
		
}

public function session(){
	    $serviceId = $this->input->post('serviceId');
		$themesid = $this->input->post('themesid');
        $hostType = $this->input->post('hostType');
		$hostLang = $this->Itinerarie_model->gethostLanguages();
		$services = $this->Itinerarie_model->getServices();
		
		if($this->session->userdata('id')){
		      $loginHostid = $this->session->userdata('id');
			  $this->load->helper('getallthemes');
			  $this->load->helper('getcategory');
			  $this->load->helper('hostname');
			  $this->load->helper('getfamilydata');
			  $this->load->helper('getallpickpoints');
			  $this->load->helper('getfamilymultidata');
			  $this->load->helper('gethostname');
			  $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);			  
			  $userServices  = $this->Itinerarie_model->getUserServices($loginHostid);
			  $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
			  $itineraryfamilydata = $this->Itinerarie_model->getItineraryfamilyData($loginHostid);
			  $itineraryServicesData = $this->Itinerarie_model->getUserItinerary_value($loginHostid);
			  $themesData = $this->Itinerarie_model->selectThemes();
			  $itineraryResult = $this->Itinerarie_model->getAllSearchItinerary($loginHostid,$serviceId,$themesid,$hostType);
			  $hostTypeData = $this->Admin_model->fetchHostType();
			  $trainingStatus = $this->Itinerarie_model->getTrainingStatus($loginHostid);
			  
			  if(!empty($itineraryResult)){
				  $itineraryData['iterator'] = $itineraryResult;
				 }else{
				 $itineraryData['iterator'] = '';
				}
		     
			 if($this->input->is_ajax_request())
				{	if(!empty($itineraryData['iterator'])){       
					$itineraryData['view']=$this->load->view('itineraries/host_itineraries_element',compact('hostLang','services','itineraryData','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata','itineraryServicesData','themesData','serviceId','trainingStatus'),true);			
					echo json_encode($itineraryData);die;
				  }else{
					 $itineraryData['view'] = 'Empty data';			
					 echo json_encode($itineraryData);die;
					}    
				}
			else{	
			 $this->load->view("itineraries/itineraries",compact('hostLang','services','itineraryData','serviceId','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata',
							   'itineraryServicesData','themesData','trainingStatus'));
			}	
			
		}else{
		  redirect('home');
		}
		
}

public function experience(){
	    $serviceId = $this->input->post('serviceId');
		$themesid = $this->input->post('themesid');
        $hostType = $this->input->post('hostType');
		$hostLang = $this->Itinerarie_model->gethostLanguages();
		$services = $this->Itinerarie_model->getServices();
		
		if($this->session->userdata('id')){
		      $loginHostid = $this->session->userdata('id');
			  $this->load->helper('getallthemes');
			  $this->load->helper('getcategory');
			  $this->load->helper('hostname');
			  $this->load->helper('getfamilydata');
			  $this->load->helper('getallpickpoints');
			  $this->load->helper('getfamilymultidata');
			  $this->load->helper('gethostname');
			  $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);			  
			  $userServices  = $this->Itinerarie_model->getUserServices($loginHostid);
			  $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
			  $itineraryfamilydata = $this->Itinerarie_model->getItineraryfamilyData($loginHostid);
			  $itineraryServicesData = $this->Itinerarie_model->getUserItinerary_value($loginHostid);
			  $themesData = $this->Itinerarie_model->selectThemes();
			  $itineraryResult = $this->Itinerarie_model->getAllSearchItinerary($loginHostid,$serviceId,$themesid,$hostType);
			  $hostTypeData = $this->Admin_model->fetchHostType();
			  $trainingStatus = $this->Itinerarie_model->getTrainingStatus($loginHostid);
			  
			  if(!empty($itineraryResult)){
				  $itineraryData['iterator'] = $itineraryResult;
				}else{
				 $itineraryData['iterator'] = '';
				}
		     
			 if($this->input->is_ajax_request())
				{			
			if(!empty($itineraryData['iterator'])){       
					$itineraryData['view']=$this->load->view('itineraries/host_itineraries_element',compact('hostLang','services','itineraryData','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata','itineraryServicesData','themesData','serviceId','trainingStatus'),true);			
					echo json_encode($itineraryData);die;
				  }else{
					 $itineraryData['view'] = 'Empty data';			
					 echo json_encode($itineraryData);die;
					}    
				}
			else{	
			 $this->load->view("itineraries/itineraries",compact('hostLang','services','itineraryData','serviceId','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata',
							  'itineraryServicesData','themesData','trainingStatus'));
			}	
			
		}else{
		  redirect('home');
		}
		
}

public function meetup(){
	    $serviceId = $this->input->post('serviceId');		
		$themesid = $this->input->post('themesid');
        $hostType = $this->input->post('hostType');
		$hostLang = $this->Itinerarie_model->gethostLanguages();
		$services = $this->Itinerarie_model->getServices();
		
		if($this->session->userdata('id')){
		      $loginHostid = $this->session->userdata('id');
			  $this->load->helper('getallthemes');
			  $this->load->helper('getcategory');
			  $this->load->helper('hostname');
			  $this->load->helper('getfamilydata');
			  $this->load->helper('getallpickpoints');
			  $this->load->helper('getfamilymultidata');
			  $this->load->helper('gethostname');
			  $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);			  
			  $userServices  = $this->Itinerarie_model->getUserServices($loginHostid);
			  $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
			  $itineraryfamilydata = $this->Itinerarie_model->getItineraryfamilyData($loginHostid);
			  $itineraryServicesData = $this->Itinerarie_model->getUserItinerary_value($loginHostid);
			  $themesData = $this->Itinerarie_model->selectThemes();
			  $itineraryResult = $this->Itinerarie_model->getAllSearchItinerary($loginHostid,$serviceId,$themesid,$hostType);
			  $hostTypeData = $this->Admin_model->fetchHostType();
			  $trainingStatus = $this->Itinerarie_model->getTrainingStatus($loginHostid);
			  
			  if(!empty($itineraryResult)){
				   $itineraryData['iterator'] = $itineraryResult;
				}else{
				 $itineraryData['iterator'] = '';
				}
		     
			 if($this->input->is_ajax_request())
				{			    
			   if(!empty($itineraryData['iterator'])){       
					$itineraryData['view']=$this->load->view('itineraries/host_itineraries_element',compact('hostLang','services','itineraryData','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata','itineraryServicesData','themesData','serviceId','trainingStatus'),true);			
					echo json_encode($itineraryData);die;
				  }else{
					 $itineraryData['view'] = 'Empty data';			
					 echo json_encode($itineraryData);die;
					}    
				}
			else{	
			 $this->load->view("itineraries/itineraries",compact('hostLang','services','itineraryData','serviceId','hostTypeData',
			                  'allowItinerary','userServices','hostimage','itineraryfamilydata',
							  'itineraryServicesData','themesData','trainingStatus'));
			}	
			
		}else{
		  redirect('home');
		}
		
}

//============= browse all itineraries function start on 08-02-19 =============//
 public function browse_itineraries(){
       $logedin  = $this->session->userdata('id');		
	   $cityData = $this->Itinerarie_model->getcities();
	   $themesData = $this->Itinerarie_model->selectThemes();
	   $allowItinerary = $this->Itinerarie_model->allowHost($logedin);			 
	   $hostimage = $this->Itinerarie_model->getProfileimage($logedin);
	   $hostTypeData = $this->Admin_model->fetchHostType();
	   $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
	  
	   $this->load->view('itineraries/browse_itineraries',compact('cityData','themesData','allowItinerary',
	                               'hostimage','hostTypeData','itineraryLang'));
	 }
	 
public function fetchBrowse_Itinerary(){
	$logedin  = $this->session->userdata('id');
    $page =  @$_GET['page'];
	$serviceId =  @$_GET['serviceId'];	
    $itineraryData = $this->Itinerarie_model->homeItineraries($page,$serviceId);
	$itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
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
	 $this->load->helper('gethostname');
	 $this->load->helper('getfamilymultidata');
	if($this->input->is_ajax_request())
	{
	 //$itineraryData = $this->Itinerarie_model->homeItineraries($page,$serviceId);
	// echo $this->db->last_query();die;
	if(!empty($data['iterator'])){       
			$data['view']=$this->load->view('itineraries/fetch_browse_itineraries',compact('data','serviceId','itineraryLang'),true);			
			echo json_encode($data);die;
		  }else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
		}
			
}

public function servicetab_browse_search(){
	
	$serviceId = $this->input->post('serviceId');
	$privateType = $this->input->post('privateType');
	$groupType = $this->input->post('groupType');
	$cityid = $this->input->post('cityid');
	$date = $this->input->post('date');
	$themesid = $this->input->post('themesid');
	$familyType = $this->input->post('familyType');
	$hostType = $this->input->post('hostType');
	$itineraryLang =  $this->input->post('itineraryLang');
	$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,
	                                                            $familyType,$hostType,$itineraryLang); 	
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
	 $this->load->helper('gethostname');
	 $this->load->helper('getfamilymultidata');
	 $itineraryLang = $this->Itinerarie_model->fetchItineraryLanguages();
	if($this->input->is_ajax_request())
		{
	 //$itineraryData = $this->Itinerarie_model->searchItineraries($serviceId,$privateType,$groupType,$cityid,$date,$themesid,$familyType,$hostType); 
	 //echo $this->db->last_query();die;
	if(!empty($data['iterator'])){
			 $data['view']=$this->load->view('itineraries/servicetab_browse_search',compact('data','serviceId','itineraryLang'),true);			
			 echo json_encode($data);die;
			}else{
			 $data['view'] = 'Empty data';			
			 echo json_encode($data);die;
			}    
			
		}	
}
//============= browse all itineraries end ===================//	 
	 
public function create_itineraries()
	{ 
	    $userId = $this->session->userdata('id');		
		$service_id = $this->input->get('serviceid',true); // service id from query string url
		$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
		$userCity = $this->Itinerarie_model->findUser_city($userId);
		$features = $this->Itinerarie_model->selectFeatures();
		$languages = $this->Itinerarie_model->selectLanguages($userId);
		$allCategory = $this->Itinerarie_model->selectCategory($service_id);
		$allthemes = $this->Itinerarie_model->selectThemes();		
		$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		$draFaqData = $this->Itinerarie_model->getSaveTqsData($userId);
		$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($userId);
		$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($userId);		
		$stopsNewData = $this->Itinerarie_model->getSaveStopsData($userId);
		$hostimage = $this->Itinerarie_model->getProfileimage($userId);
		$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database 
		$hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		$airPortData = $this->Itinerarie_model->getAirports();
		$railwayData = $this->Itinerarie_model->getRailways();
		$highLightResult = $this->Itinerarie_model->getHighLightData();
		//print_r($userCity);die;
		$this->load->helper('fetchallstops');
	    if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}	
			
		
		//echo '<pre>';print_r($allthemes);die;
		
		$temp = array();
		$ids = array();
		$themeArr = array();
		$themIdArr = array();
		foreach($features as $value){
			 if(!in_array($value->feature_name,$temp)){
				  array_push($temp,$value->feature_name);
				 }
			 if(!in_array($value->id,$ids)){
				 array_push($ids,$value->id);
				 }	 
			}			
		$combineArr = array_combine($ids,$temp);		
		$result = '';
		
		foreach($combineArr as $key=>$value){
			  $data['id'] = $key;
			  $data['name'] = $value;
			  if($key!=count($combineArr)){
				  $result .= json_encode($data).',';
				  }
			  else{
				  $result .= json_encode($data);
				  }	 
			  	
			}
					
		foreach($languages as $lang){			 
			   $datalang = explode(',',$lang->known_languages);
			}
			
		/*foreach($languages as $lang){			 
			   $datalang = $lang->preferred_languages;
			}*/	
				
		foreach($allthemes as $data){
			 if(!in_array($data->theme_name,$themeArr)){
				  array_push($themeArr,$data->theme_name);
				 }
			 if(!in_array($data->id,$themIdArr)){
				 array_push($themIdArr,$data->id);
				 }	 
			}
		$themescombine = array_combine($themIdArr,$themeArr);		
		$themesResult = '';
		foreach($themescombine as $key=>$value){
			  $datas['id'] = $key;
			  $datas['name'] = $value;
			  if($key!=count($themescombine)){
				  $themesResult .= json_encode($datas).',';
				  }
			  else{
				  $themesResult .= json_encode($datas);
				  }	 
			  	
			}
			
		 //========== selected themes show function ========//
		 $themesSelected = '';
		 foreach($hostSaveData as $value){
		      if(!empty($value->itinerary_theme)){
				  $sepThemesArr = explode(',',$value->itinerary_theme);
			      foreach($sepThemesArr as $key=>$val){
					  //$themdata['id'] = $val;
					  $themesData = $this->Itinerarie_model->findSelectedThemes($val);					 
					  foreach($themesData as $selectVal){
					      $themdata['id'] = $selectVal->id;
						  $themdata['name'] = $selectVal->theme_name;
						  
					  if($key!=count($sepThemesArr)){
					      if(count($sepThemesArr)!=1){
							   $themesSelected .= json_encode($themdata).',';
							  }
						  else{
							    $themesSelected .= json_encode($themdata);
							  } 
						  }
					  else{
						  $themesSelected .= json_encode($themdata);
						  }
					   }
					 }
				  }		       
			   }
		 //========== selected themes show function END =======//		 
				 
		//$temp = json_encode($combineArr);
		// $temp = json_encode($temp);
		$langArr = json_encode($datalang);
		$themsData = json_encode($themeArr);
	    //echo '<pre>';print_r($langArr);die;
		$this->load->view("itineraries/create_itineraries",compact('userCity','temp','result','allthemes',
		                   'langArr','allCategory','selectOtherLang','service_id','draftData','highLightResult',
						   'themesResult','prefrencelang','themesSelected','features',
						   'draFaqData','drafRouteTimeData','drafFamilyData','hostimage','languages',
						   'stopsNewData','legalData','hostProfile','airPortData','railwayData'));
		
		
	}
	
	
	
	
	public function getFeatureTags(){
		$id = $this->input->post('id');
		$tags = $this->Itinerarie_model->findFeatureTags($id);
		
		$tagIdsArr = array();
		$tagValArr = array();
		foreach($tags as $tag){
			 if(!in_array($tag->id,$tagIdsArr)){
				 array_push($tagIdsArr,$tag->id);
				 }
			if(!in_array($tag->tags_name,$tagValArr)){
				 array_push($tagValArr,$tag->tags_name);
				 }	 
			}
		  $tagsConbineArr = array_combine($tagIdsArr,$tagValArr);		
		  $result = '';
		 
		 print_r($tagsConbineArr);die;
		 
			
		}
	

	public function leave_msg()
	{
		//$actual_link = "$_SERVER[REQUEST_URI]"; 
		//$actual_link = $_SERVER['SCRIPT_NAME'];
		//echo $actual_link; die();
		$user_name = $this->input->post('user_name');
        $user_email = $this->input->post('user_email');
        $user_phone = $this->input->post('user_phone');
		$user_msg = $this->input->post('user_msg');
		
		$admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
		$super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));

		        $config = $this->smtpCredential();
		
                $leave['user_name']  = $user_name;
                $leave['user_email'] = $user_email;
                $leave['user_phone'] = $user_phone;
                $leave['user_msg']   = $user_msg;

                $body = $this->load->view('mailer/leave_mailer',$leave, true);
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('help@cityexplorers.in', 'City Explorers');
						$this->email->to($admin_email);
						$this->email->cc($super_admin_email);
                        $this->email->subject('Leave Message');
                        $this->email->message($body);
                       $this->email->send();


         echo "Msg Successfully sent"; die();
		//return redirect('home');	
	}
	
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
     'new_image'         => $tumbPath, //path to resize image
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
		
  public function saveItinerary(){ 
       
       $loginHostid = $this->session->userdata('id');	  
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
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
	   $itinerarySaveArr['additional_price'] = "";
	   
	   //$itinerarySaveArr['additional_cost_description'] = $this->input->post('itinerary_additionalcost_description');
	   //$itinerarySaveArr['additional_price'] = $this->input->post('itinerary_additionalcost_amt');	  
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
				 $itineraryfeatrue_image =  $this->file_upload($path,$fileName,$allowType,$thumbPath,$fileInputName,$maxSize,
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
		         $videoInfo = new SplFileInfo($videoName);
				 $video_ext = $videoInfo->getExtension();
				 $walk_videoName = time().'.'.$video_ext;			        
			     
					$config_video = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|mp3|avi|mp4",					
					'file_name' => $walk_videoName,					
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
					  print_r($this->upload->display_errors());die;
                    }
                    else
                    { 				 
				      //echo "frofile img"; die();
                        $upload_data = $this->upload->data();						
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
                       $fileName = $this->input->post('hide_video');
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
		    $status = isset($lastdata->status);
		   }
		   else{
			    $status = 0;
			   }
		if(!empty($statusArr)){
		    $loginStatus = isset($lastdata->login_status);
		   }else{
		    $loginStatus ='';
		   }   
		//echo '<pre>';print_r($itinerarySaveArr);die;	
		
	   if($loginStatus=='' || $loginStatus==null){
	        $itinerarySaveArr['login_status'] = 1;
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);
			//echo $lastInsert_id = $this->db->insert_id();die();
			if(!empty($lastId)){
			   if(!empty(array_filter($this->input->post('itinerary_faq_question_01')))){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['login_status'] = 1;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $this->db->insert('txn_faqs', $faqArrData);
					 }
			   }
				
			if(!empty(array_filter($this->input->post('itinerary_route_slot01_pickup')))){
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
						$routeArrData['login_status'] = 1;
					    $this->db->insert('txn_routes_timings', $routeArrData);	
						$lastInsert_id = $this->db->insert_id();
						
					//===== route slots insert value start ============//
					if(!empty($lastInsert_id)){
					  $slotEmptyChk = $this->input->post('itinerary_route_slot01_stop01_location');	
					  

				   if(!empty($this->input->post("route")))
						{
						foreach($this->input->post("route") as $key => $value)
						{
							if($key==$i){
							foreach($value["itinerary_route_slot01_stop01_location"] as $k => $v)
							{
								$newStopData['user_id'] = $loginHostid;	
								$newStopData['route_id'] = $lastInsert_id;
								$newStopData['service_id'] = $this->input->post('service_id');
								$newStopData['create_itinerary_id'] = $lastId;
								$newStopData['category_id'] = $this->input->post('category');
								$newStopData['stop_location_type'] = $v;
								$newStopData['stop_location_time'] = $value["itinerary_route_slot01_stop01_time"][$k];					
								$newStopData['stop_location_desc'] = $value["itinerary_route_slot01_stop01_description"][$k];			   
								$newStopData['created_at'] =   date('Y-m-d h:i:s');
								$newStopData['login_status'] = 1;
								$this->db->insert('txn_routes_stops', $newStopData);
								}
							  }
							}
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 
					   $familyData['login_status'] = 1;   
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				  
				}
				
			   $this->session->set_flashdata('success','draft');	
			
		   }else{
		    //echo $routpickup_pointcount;die;
		     $updateData = $this->Itinerarie_model->updateDraftData($loginHostid,$itinerarySaveArr);
			 $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);	
			 $getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$getsaveItineraryId[0]->id);			 

			 $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			 
			//echo '<pre>'; print_r($getStopids);die;
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
				  $deleteStops = $this->Itinerarie_model->deleteStopsdata($loginHostid,$getsaveItineraryId[0]->id);
				 }	 
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = 1;
				 // $this->Itinerarie_model->faqUpdateData($loginHostid, $faqArrData,$itineraryId); //update faq table data
				  $this->db->insert('txn_faqs', $faqArrData);
				 }
				//echo "<pre>"; print_r($this->input->post("route"));die; 
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
						$routeArrData['login_status'] = 1;
					    $this->db->insert('txn_routes_timings', $routeArrData);
						$routeInsertId = $this->db->insert_id();
						
					//========= New Stops for route =================//
					if(!empty($routeInsertId)){
					   $slotEmptyChk = $this->input->post('itinerary_route_slot01_stop01_location');	   
						   if(!empty($this->input->post("route")))
							{
							foreach($this->input->post("route") as $key => $value)
							{
								if($key==$i){
								foreach($value["itinerary_route_slot01_stop01_location"] as $k => $v)
								{
									$newStopData['user_id'] = $loginHostid;	
									$newStopData['route_id'] = $routeInsertId;
									$newStopData['service_id'] = $this->input->post('service_id');
									$newStopData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
									$newStopData['category_id'] = $this->input->post('category');
									$newStopData['stop_location_type'] = $v;
									$newStopData['stop_location_time'] = $value["itinerary_route_slot01_stop01_time"][$k];					
									$newStopData['stop_location_desc'] = $value["itinerary_route_slot01_stop01_description"][$k];			   
									$newStopData['created_at'] =   date('Y-m-d h:i:s');
									$newStopData['login_status'] = 1;
									$this->db->insert('txn_routes_stops', $newStopData);
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  
			 }
			 
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');	
		  }	
            return redirect('create_itineraries?serviceid='.$service_id.'&otherlang='.$otherlang);			  
	   }

 //============= Done Button click =====================//
 public function doneItinerary(){
	   $loginHostid = $this->session->userdata('id');	  
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
					//'min_height' => "1440",
					//'min_width' => "810",
					//'maintain_ratio'=>TRUE
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
					  
					   if(!empty($this->input->post("route")))
						{
						foreach($this->input->post("route") as $key => $value)
						{
							if($key==$i){
							foreach($value["itinerary_route_slot01_stop01_location"] as $k => $v)
							{
								$newStopData['user_id'] = $loginHostid;	
								$newStopData['route_id'] = $routeInsertId;
								$newStopData['service_id'] = $this->input->post('service_id');
								$newStopData['create_itinerary_id'] = $lastId;
								$newStopData['category_id'] = $this->input->post('category');
								$newStopData['stop_location_type'] = $v;
								$newStopData['stop_location_time'] = $value["itinerary_route_slot01_stop01_time"][$k];					
								$newStopData['stop_location_desc'] = $value["itinerary_route_slot01_stop01_description"][$k];			   
								$newStopData['created_at'] =   date('Y-m-d h:i:s');								
								$this->db->insert('txn_routes_stops', $newStopData);
								}
							  }
							}
						}
					  /*if(!empty($slotEmptyChk)){ 
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
						 }*/
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 					      
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
					   
					   if(!empty($this->input->post("route")))
						{
						foreach($this->input->post("route") as $key => $value)
						{
							if($key==$i){
							foreach($value["itinerary_route_slot01_stop01_location"] as $k => $v)
							{
								$newStopData['user_id'] = $loginHostid;	
								$newStopData['route_id'] = $routeInsertId;
								$newStopData['service_id'] = $this->input->post('service_id');
								$newStopData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
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
						
						
					  /* if(!empty($slotEmptyChk)){ 
						 for($j=0;$j<$stoplocation_count;$j++){
								$newStopData['user_id'] = $loginHostid;
								$newStopData['route_id'] = $routeInsertId;
								$newStopData['service_id'] = $this->input->post('service_id');
								$newStopData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
								$newStopData['category_id'] = $this->input->post('category');
								$newStopData['stop_location_type'] = $this->input->post('itinerary_route_slot01_stop01_location')[$i];
								$newStopData['stop_location_time'] = $this->input->post('itinerary_route_slot01_stop01_time')[$i];			
								$newStopData['stop_location_desc'] = $this->input->post('itinerary_route_slot01_stop01_description')[$i];	
								$routeArrData['login_status'] = null;
								$newStopData['created_at'] =  date('Y-m-d h:i:s');						
								$this->db->insert('txn_routes_stops', $newStopData);
							 } 
						 }*/
						 
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				 	  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','doneUpdate');	
		  }	
            //return redirect('create_itineraries?serviceid='.$service_id.'&otherlang='.$otherlang);
		  return redirect('itineraries');
	 }
	 
	
	//========= itinerary edit view function start ===================//
	
	public function itinerary_edit_view(){
	     $userId = $this->session->userdata('id');
		 $serviceId = $this->input->get('serviceid',true);
		 $itineraryId = $this->input->get('itineraryid',true);
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		  
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
		 $highLightResult = $this->Itinerarie_model->getHighLightData();
		 $legalData = $this->Itinerarie_model->getLegalData($serviceId); // fetch iwl legal data from database 
		 $hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		 $airPortData = $this->Itinerarie_model->getAirports();
		 $railwayData = $this->Itinerarie_model->getRailways();
		 $this->load->helper('fetchallstops');
		 //$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($editDataSet);die;
		
		
		$this->load->view('itineraries/itinerary_edit_view',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity','legalData',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','highLightResult',
						 'languages','itineraryId','adminStatus','hostimage','allowItinerary','drafStopData',
						 'hostProfile','airPortData','railwayData'));
		}
	//=========END:: itinerary edit view ==========================//
	
//============ cancel popup click then user will creat new itinerary only ===========//

public function changeLoginStatus(){
	
	$userid = $this->input->post('userid');	
	$cancelLoginStatus = $this->Itinerarie_model->changeLoginStatus_cancel($userid);
	$cancelTqaStatus = $this->Itinerarie_model->changeTqaStatus_cancel($userid);
	$cancelFamilyStatus = $this->Itinerarie_model->changeFamilyStatus_cancel($userid);
	$cancelRouteStatus = $this->Itinerarie_model->changeRouteStatus_cancel($userid);
	$cancelStopsStatus = $this->Itinerarie_model->changeStopStatus_cancel($userid);
    $speakersData = $this->Itinerarie_model->changeSpeakerStatus_cancel($userid);
	 echo 'success';die;
}
//===============  function cancel popup end ================================//


//============== edit save button click function start ======================//
public function editSaveItinerary(){
       
       $loginHostid = $this->session->userdata('id');
	   $hostProfile = $this->Itinerarie_model->getHostProfile($loginHostid); //get Host information	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   $itinerarySaveArr['experience_type'] = null;
	  
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
	   //$itinerarySaveArr['additional_cost_description'] = $this->input->post('itinerary_additionalcost_description');	         	 
      
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
	   $itinerarySaveArr['created_at'] = date('y-m-d h:s');
	   $itinerarySaveArr['login_status'] = 1;
	  
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
				  
	     //FILES UPLOADS CREATE ITINERARY START 		    
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
				   $videoInfo = new SplFileInfo($videoName);
				   $video_ext = $videoInfo->getExtension();
				   //$videoBaseName = basename($videoName,$video_ext);
				   //$output = rtrim($videoBaseName, '.');
				   $walkVideoName = time().'.'.$video_ext;
				   //echo $walkVideoName;die;
					$config_editvideo = array(
					'upload_path' => "./assets/itinerary_files/videos/",
					'allowed_types' => "mov|mpeg|avi|mp4",					
					'file_name' => $walkVideoName,					
					'max_size' => "10240", // Can be set to particular file size , here it is 10 MB(10240 Kb)					
					//'min_height' => "1440",
					//'min_width' => "810",
					//'maintain_ratio'=>TRUE
					);
					
					 $this->load->library('upload');
					 $this->upload->initialize($config_editvideo); 					
					
                    if (!$this->upload->do_upload('itinerary_gallery_video'))
                    { 
                      $this->session->set_flashdata('error',$this->upload->display_errors());					
                      $this->session->set_flashdata('feedback_class','alert-danger');
					  print_r($this->upload->display_errors());die;
                    }
                    else
                    {				      
                        $upload_data  = $this->upload->data();						
                        $config_editvideo['image_library'] ='gd2';
                        //$config_editvideo['source_image']  ='./assets/itinerary_files/videos/'.$upload_data['file_name'];
                        $config_editvideo['create_thumb']  = FALSE;
                        $config_editvideo['maintain_ratio']= FALSE;
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
                       $fileName = $this->input->post('hide_video');
                    }	
					
			
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $fileName;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
			$itinerarySaveArr['sponsors_img'] =  $sponsorData;
	        
		     $updateData = $this->Itinerarie_model->editUpdateDraftData($loginHostid,$itinerarySaveArr,$itinerary_id);
			 //$getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$itinerary_id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$itinerary_id);
			 $getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$itinerary_id);			 

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
			
			if(!empty($getStopids)){
				  $deleteStops = $this->Itinerarie_model->deleteStopsdata($loginHostid,$itinerary_id);
				 }	
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $itinerary_id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['login_status'] = 1;
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
									$newStopData['login_status'] = 1;
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
					  
					  $familyData['min_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i] : $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i]);
					   
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['max_no_kides'] = ($this->input->post('itinerary-traveller-family-kids01-age')[$i]==10) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : (($this->input->post('itinerary-traveller-family-kids01-age')[$i]==7) ? $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i] : $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]);
					  //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];					 
					  // $familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
					  				
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
		  	
            return redirect('Itineraries/itinerary_edit_view?serviceid='.$service_id.'&otherlang='.$otherlang.'&itineraryid='.$itinerary_id);			  
	   }
//=========== end edit save function =======================//


//============= EDIT Done Button click =====================//
 public function editDoneItinerary(){
	   $loginHostid = $this->session->userdata('id');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   $itinerarySaveArr['translator_type'] = 0;
	   $itinerarySaveArr['translator_confirm'] = 0;
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
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:s');
	   
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
                       $itinerary_video = $this->input->post('hide_video');
                     }	
					  
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $itinerary_video;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
	        $itinerarySaveArr['sponsors_img'] =  $sponsorData;
	     
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
				  $faqArrData['created_at'] =   date('Y-m-d h:S');
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
					    $routeArrData['created_at'] =   date('Y-m-d h:S');
						$routeArrData['login_status'] = null;
					    $this->db->insert('txn_routes_timings', $routeArrData);	
						$routeInsertId = $this->db->insert_id();
						
					//========= New Stops for route =================//
					if(!empty($routeInsertId)){
					   $slotEmptyChk = $this->input->post('itinerary_route_slot01_stop01_location');	   
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','doneUpdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
		  	return redirect('itineraries');
           //return redirect('Itineraries/itinerary_edit_view?serviceid='.$service_id.'&otherlang='.$otherlang.'&itineraryid='.$itinerary_id);
	 }
	 
 public function itinerary_view_detail(){      
        $loginHostid = $this->session->userdata('id');
        $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
		$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$userLang = $this->input->get('lang');
	   //$flag = $this->input->get('flag');
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getallstops');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('gethostname');
	   $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	   $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
		//echo '<pre>';print_r($itineraryData);die;  
	   $this->load->view('itineraries/itinerary_view_detail',compact('hostimage','itineraryData','itinerary_id','allowItinerary','userLang'));
	 }	 

public function myprofile(){        
            $id = $this->session->userdata( 'id' );
            $states = $this->User_model->get_state();
            $allowItinerary = $this->Itinerarie_model->allowHost($id);
		   $hostimage = $this->Itinerarie_model->getProfileimage($id);
           $user_data  = $this->User_model->find_profile( $id );		   
		   $this->load->helper('gethostcity');		  
	       $this->load->helper('gethoststate');
	       //echo '<pre>';print_r($user_data);die;
		   
        if(!$this->session->userdata( 'id' ))
            return redirect('home');
       $this->load->view('itineraries/myprofile' , [ 'profile_data' => $user_data ,'states'=> $states,'allowItinerary'=>$allowItinerary,
	                     'hostimage'=>$hostimage]);
        }
		
public function create_itineraries_experiences()
	{ 
	    $userId = $this->session->userdata('id');		
		$service_id = $this->input->get('serviceid',true); // service id from query string url
		$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
		$userCity = $this->Itinerarie_model->findUser_city($userId);
		$features = $this->Itinerarie_model->selectFeatures();
		$languages = $this->Itinerarie_model->selectLanguages($userId);
		$allCategory = $this->Itinerarie_model->selectCategory($service_id);
		$allthemes = $this->Itinerarie_model->selectThemes($userId);		
		$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		$draFaqData = $this->Itinerarie_model->getSaveTqsData($userId);
		$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($userId);
		$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($userId);
		$stopsNewData = $this->Itinerarie_model->getSaveStopsData($userId);
		$hostimage = $this->Itinerarie_model->getProfileimage($userId);
		$highLightResult = $this->Itinerarie_model->getHighLightData();
		$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database 
		$hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		$airPortData = $this->Itinerarie_model->getAirports();
		$railwayData = $this->Itinerarie_model->getRailways();
		
	    if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}	
		
		// echo '<pre>';print_r($draftData);die;
		
		$this->load->view('itineraries/create_itineraries_experiences',compact('hostimage','service_id','selectOtherLang',
		                        'allCategory','selectOtherLang','draftData','userCity','allthemes','features','languages',
								'draFaqData','drafRouteTimeData','drafFamilyData','highLightResult',
								'legalData','hostProfile','airPortData','railwayData'));
		
	}
	
	
//================= save Experience itinerary func. ==================//

 public function saveExperienceItinerary(){ 
        
       $loginHostid = $this->session->userdata('id');	  
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
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
	       //FILES UPLOADS CREATE ITINERARY START           		
            if($_FILES['itinerary_gallery_image_cover']['name']!="")
              {
                  $experienceFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$experienceFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);

                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
					   //echo $itineraryfeatrue_image;die;
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $expAddFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$expAddFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,$resizewidth,                                        $resizeHeight);

                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                      }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $expAddFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$expAddFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                 
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $expAddFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$expAddFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
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
	   
	     $checkCountRows = $this->Itinerarie_model->getInsertRow($loginHostid);
	     
	     $statusArr = $this->Itinerarie_model->getItineraryStatus($loginHostid);
		 $lastdata = end($statusArr); // get last data of an array
		//echo '<pre>';print_r($lastdata);die;
	    if(!empty($statusArr)){		    
		    $status = isset($lastdata->status);
		   }
		   else{
			    $status = 0;
			   }
		if(!empty($statusArr)){
		    $loginStatus = isset($lastdata->login_status);
		   }else{
		    $loginStatus ='';
		   }   
		//echo '<pre>';print_r($itinerarySaveArr);die;	
		
	   if($loginStatus=='' || $loginStatus==null){
	        $itinerarySaveArr['login_status'] = 1;
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);
			//echo $lastInsert_id = $this->db->insert_id();die();
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['login_status'] = 1;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:S');
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
						$routeArrData['login_status'] = 1;
					    $this->db->insert('txn_routes_timings', $routeArrData);				  
 				  }
				  
				/* for($i=0;$i<$stoplocation_count;$i++){
					    $newStopData['user_id'] = $loginHostid;				        
						$newStopData['service_id'] = $this->input->post('service_id');
						$newStopData['create_itinerary_id'] = $lastId;
					    $newStopData['category_id'] = $this->input->post('category');
					    $newStopData['stop_location_type'] = $this->input->post('itinerary_route_slot01_stop01_location')[$i];
					    $newStopData['stop_location_time'] = $this->input->post('itinerary_route_slot01_stop01_time')[$i];					
					    $newStopData['stop_location_desc'] = $this->input->post('itinerary_route_slot01_stop01_description')[$i];			   
					    $newStopData['created_at'] =   date('Y-m-d H:s');
						$newStopData['login_status'] = 1;
					    $this->db->insert('txn_routes_stops', $newStopData);
					 }*/ 
				  
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
					   
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 
					   $familyData['login_status'] = 1;   
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				  
				}
				
			   $this->session->set_flashdata('success','experience_draft');	
			
		   }else{
		     $updateData = $this->Itinerarie_model->updateDraftData($loginHostid,$itinerarySaveArr);
			 $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);	
			 //$getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$getsaveItineraryId[0]->id);			 

			 $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			 
			 //print_r($getsaveItineraryId);die;
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
				 
			/*if(!empty($getStopids)){
				  $deleteStops = $this->Itinerarie_model->deleteStopsdata($loginHostid,$getsaveItineraryId[0]->id);
				 }*/	 
				 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['login_status'] = 1;
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }					  
			
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');	
		  }	
            return redirect('create_itineraries_experiences?serviceid='.$service_id.'&otherlang='.$otherlang);			  
	   }
	   
	   
	//============= Done Button click =====================//
 public function doneExperienceItinerary(){
	   $loginHostid = $this->session->userdata('id');	  
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
	   
	  // $itinerarySaveArr['additional_cost_description'] = $this->input->post('itinerary_additionalcost_description');
	  // $itinerarySaveArr['additional_price'] = $this->input->post('itinerary_additionalcost_amt');      	 
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }									  
				  
				}
				
			   $this->session->set_flashdata('success','doneInsert');	
			    return redirect('itineraries');
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
			
			/*if(!empty($getStopids)){
				  $deleteFamily = $this->Itinerarie_model->deleteStopsdata($loginHostid,$getsaveItineraryId[0]->id);
				 }*/
				 
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }					  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','doneUpdate');	
		  }	
            //return redirect('create_itineraries?serviceid='.$service_id.'&otherlang='.$otherlang);
		  return redirect('itineraries');
	 }
	 
//========= Experience itinerary edit view function start ===================//	
	public function itinerary_experience_edit_view(){
	     $userId = $this->session->userdata('id');
		 $serviceId = $this->input->get('serviceid',true);
		 $itineraryId = $this->input->get('itineraryid',true);
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		  
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
		 $highLightResult = $this->Itinerarie_model->getHighLightData();
		 $legalData = $this->Itinerarie_model->getLegalData($serviceId); // fetch iwl legal data from database 
		 $hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		 $airPortData = $this->Itinerarie_model->getAirports();
		 $railwayData = $this->Itinerarie_model->getRailways();
		
		 //$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($features);die;
		
		$this->load->view('itineraries/itinerary_experience_edit_view',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','legalData',
						 'languages','itineraryId','adminStatus','hostimage','allowItinerary',
						 'highLightResult','hostProfile','airPortData','railwayData'));
		}

//===================== Experience ITINERARY View Detailed =====================//
public function itineraries_experiences_detail(){
        $loginHostid = $this->session->userdata('id');
        $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
		$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$userLang = $this->input->get('lang');
	   //$flag = $this->input->get('flag');
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('gethostname');
	   $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	   $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
		//echo '<pre>';print_r($itineraryData);die;  
	   $this->load->view('itineraries/itineraries_experiences_detail',compact('hostimage','itineraryData',
	                                                                        'itinerary_id','allowItinerary','userLang'));
	 }
	 
//============== edit Experience save button click function start ======================//
public function editExperienceSaveItinerary(){ 
        
       $loginHostid = $this->session->userdata('id');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
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
	   $experienceType ='';
	   
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
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:i:s');
	   $itinerarySaveArr['login_status'] = 1;
	   
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
                        $fileName = $upload_data['file_name']; 						
                    }
                }
                else{                        
                       $fileName = $this->input->post('hide_video');
                     }	
							   
			
		    $itinerarySaveArr['feature_img'] = $itineraryfeatrue_image;
			$itinerarySaveArr['video'] = $fileName;
			$itinerarySaveArr['additional_img_1'] = $additional_image1;
			$itinerarySaveArr['additional_img_2'] = $additional_image2;
			$itinerarySaveArr['additional_img_3'] = $additional_image3;
	   
	      //echo '<pre>';print_r($itinerarySaveArr);die;
		    $updateData = $this->Itinerarie_model->editUpdateDraftData($loginHostid,$itinerarySaveArr,$itinerary_id);
			 //$getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$itinerary_id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$itinerary_id);
			//$getStopids = $this->Itinerarie_model->getSaveStopids($loginHostid,$itinerary_id);			 

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
			
			/*if(!empty($getStopids)){
				  $deleteStops = $this->Itinerarie_model->deleteStopsdata($loginHostid,$getsaveItineraryId[0]->id);
				 }	
			*/	 
			 for($i=0;$i<$faqcount;$i++){
			      $faqArrData['user_id'] = $loginHostid;
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $itinerary_id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['login_status'] = 1;
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
					  
					  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
		  	
            return redirect('Itineraries/itinerary_experience_edit_view?serviceid='.$service_id.'&otherlang='.$otherlang.'&itineraryid='.$itinerary_id);			  
	   }
//=========== end edit experience save function =======================//

//============= EDIT Experience Done Button click =====================//
 public function editExperienceDoneItinerary(){
	   $loginHostid = $this->session->userdata('id');	  
	   $service_id = $this->input->post('service_id');
	   $otherlang = $this->input->post('selLang');
	   $itinerary_id = $this->input->post('itinerary_id');	
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
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   $itinerarySaveArr['translator_type'] = 0;
	   $itinerarySaveArr['translator_confirm'] = 0;
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
	   
	   //========== Add new frequency code on 14-05-19 by robin=========//
	   $itinerarySaveArr['frequency_type'] = $this->input->post('itinerary_set_frequency');
	   $itinerarySaveArr['frequency_off_days'] = $this->input->post('itinerary_aviaiable_all_date');
	   //==========END new frequency code on 14-05-19 by robin=========//
	   
	   date_default_timezone_set('Asia/Kolkata');
	   $itinerarySaveArr['created_at'] = date('y-m-d h:s');
	   
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = null;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
				  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','doneUpdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
		  	return redirect('itineraries');
           //return redirect('Itineraries/itinerary_edit_view?serviceid='.$service_id.'&otherlang='.$otherlang.'&itineraryid='.$itinerary_id);
	 }
	 
//================ Itinerary Meet-up Created function ======================//

public function create_itineraries_meetup(){	
	    $userId = $this->session->userdata('id');		
		$service_id = $this->input->get('serviceid',true); // service id from query string url
		$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
		$userCity = $this->Itinerarie_model->findUser_city($userId);
		$features = $this->Itinerarie_model->selectFeatures();
		$languages = $this->Itinerarie_model->selectLanguages($userId);
		$allCategory = $this->Itinerarie_model->selectCategory($service_id);
		$allthemes = $this->Itinerarie_model->selectThemes($userId);		
		$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		$draFaqData = $this->Itinerarie_model->getSaveTqsData($userId);
		$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($userId);
		$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($userId);
		$speakersData = $this->Itinerarie_model->getSaveSpeakerData($userId);
		$hostimage = $this->Itinerarie_model->getProfileimage($userId);
		$highLightResult = $this->Itinerarie_model->getHighLightData();
		$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database 
		$hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		$airPortData = $this->Itinerarie_model->getAirports();
		$railwayData = $this->Itinerarie_model->getRailways();
		
	    if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}	
		
		 //echo '<pre>';print_r($userCity);die;
		
	$this->load->view('itineraries/create_itineraries_meetup',compact('hostimage','selectOtherLang','allCategory',
	                                                          'service_id','allthemes','draftData','userCity','features',
															  'languages','drafRouteTimeData','drafFamilyData','draFaqData',
															  'drafRouteTimeData','speakersData','highLightResult',
															  'legalData','hostProfile','airPortData','railwayData'));
}

//================ save meetup itinerary function start =====================//
public function saveMeetupItinerary(){
	
	   $loginHostid = $this->session->userdata('id');	  
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;       
	   $itinerarySaveArr['status'] = 0;
	   $itinerarySaveArr['admin_status'] = null;
	   $itinerarySaveArr['login_status'] = 1;
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
	   //$stoplocation_timecount = count($this->input->post('itinerary_route_slot01_stop01_time'));
	   //$stopdesc_count = count($this->input->post('itinerary_route_slot01_stop01_description'));
	   $familyTravellerCount = count($this->input->post('itinerary-traveller-family-kids01-age'));
	   
  	   $itinerarySaveArr['nearest_airport'] = $this->input->post('itinerary_connectivity_airport');
 	   $itinerarySaveArr['nearest_railway_station'] = $this->input->post('itinerary_connectivity_railway'); 
       //$itinerarySaveArr['location_covered'] = $this->input->post('itinerary_location_covered');
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
                  $meetFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$meetFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);

                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $meetFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$meetFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                 
                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                     }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $meetFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$meetFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                  
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $meetFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$meetFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
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
		    $status = isset($lastdata->status);
		   }
		   else{
			    $status = 0;
			   }
		if(!empty($statusArr)){
		    $loginStatus = isset($lastdata->login_status);
		   }else{
		    $loginStatus ='';
		   }   
		//echo '<pre>';print_r($itinerarySaveArr);die;	
		
	   if($loginStatus=='' || $loginStatus==null){
	        $itinerarySaveArr['login_status'] = 1;
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);
			//echo $lastInsert_id = $this->db->insert_id();die();
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['login_status'] = 1;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:S');
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
						$routeArrData['drop_off_lat_lng'] =   null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:S');
						$routeArrData['login_status'] = 1;
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 
					   $familyData['login_status'] = 1;   
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
						$uniueId = uniqid();
						$file = $targetDir . $uniueId . '.'.$image_type;
						$fileName = $uniueId . '.'.$image_type;
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
				
			   $this->session->set_flashdata('success','draft');	
			
		   }else{		   
						
		      //echo '<pre>';print_r($itinerarySaveArr);die;
		     $updateData = $this->Itinerarie_model->updateMeetupDraftData($loginHostid,$itinerarySaveArr);
			 $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);			 
			 $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			 $getSpeakerids = $this->Itinerarie_model->getSaveSpeakerids($loginHostid,$getsaveItineraryId[0]->id);
			 //print_r($getFamilyids);die;
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
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:s');
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['drop_off_lat_lng'] =   null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:s');
						$routeArrData['login_status'] = 1;
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
					  
				if(!empty($this->input->post('speakerName'))){					
					    // File upload configuration
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
						$sponsorArrData['login_status'] = 1;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);							
					   }
					}	  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');	
		  }	
            return redirect('create_itineraries_meetup?serviceid='.$service_id.'&otherlang='.$otherlang);	
}

//================ ********* Done meetup itinerary function start ************=====================//
public function doneMeetupItinerary(){
	
	   $loginHostid = $this->session->userdata('id');	  
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
                  $itineraryfeatrue_image = $this->file_upload($path,$meetdoneFileName,$allowType,$thumbPath,$fileInputName,$maxSize,                                             $resizewidth,$resizeHeight);

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
						$routeArrData['drop_off_lat_lng'] =   null;
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 					      
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
			    return redirect('itineraries');
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
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
			  return redirect('itineraries');
		 }	
 }
 
 //========= ********* Meetup itinerary edit view function start **********===================//	
	public function itinerary_meetup_edit_view(){
	     $userId = $this->session->userdata('id');
		 $serviceId = $this->input->get('serviceid',true);
		 $itineraryId = $this->input->get('itineraryid',true);
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		  
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
		 $hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		 $airPortData = $this->Itinerarie_model->getAirports();
		 $railwayData = $this->Itinerarie_model->getRailways();
		 //$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($drafFamilyData);die;
		
		$this->load->view('itineraries/itinerary_meetup_edit_view',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','legalData',
						 'languages','itineraryId','adminStatus','hostimage','allowItinerary',
						 'drafSpeakerData','highLightResult','hostProfile','airPortData','railwayData'));
		}
		
//============== edit Meetup save button click function start ======================//
public function editMeetupSaveItinerary(){ 
        
      $loginHostid = $this->session->userdata('id');	  
	  $service_id = $this->input->post('service_id');
	  $otherlang = $this->input->post('selLang');
	  $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   //$itinerarySaveArr['translator_type'] = 0;
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
	   
	      // echo '<pre>';print_r($itinerarySaveArr);die;
		    $updateData = $this->Itinerarie_model->editUpdateMeetupDraftData($loginHostid,$itinerarySaveArr,$itinerary_id);
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
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['login_status'] = 1;
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
					   
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
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
						$sponsorArrData['login_status'] = 1;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:S');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
						}
					}	  	    
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
		  	
            return redirect('Itineraries/itinerary_meetup_edit_view?serviceid='.$service_id.'&otherlang='.$otherlang.'&itineraryid='.$itinerary_id);			  
	   }		


//============== edit Meetup save button click function start ======================//
public function editMeetupDoneItinerary(){ 
        
      $loginHostid = $this->session->userdata('id');	  
	  $service_id = $this->input->post('service_id');
	  $otherlang = $this->input->post('selLang');
	  $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   $itinerarySaveArr['translator_type'] = 0;
	   $itinerarySaveArr['translator_confirm'] = 0;
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
	   
	   //$itinerarySaveArr['additional_cost_description'] = $this->input->post('itinerary_additionalcost_description');
	  // $itinerarySaveArr['additional_price'] = $this->input->post('itinerary_additionalcost_amt');		  
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
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
			 
			 $this->session->set_flashdata('success','draftupdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
             return redirect('itineraries');			  
	   }

//===================== MEETUP ITINERARY View Detailed =====================//
public function itineraries_meetup_detail(){
        $loginHostid = $this->session->userdata('id');
        $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
		$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$userLang = $this->input->get('lang');
		$serviceId = $this->input->get('serviceid');
	   //$flag = $this->input->get('flag');
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getinteresteddata');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('gethostname');
	   $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	   $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);
	   $attendeesData = $this->Itinerarie_model->fetchAttendees($itinerary_id,$serviceId);
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
		//echo '<pre>';print_r($itineraryData);die;  
	   $this->load->view('itineraries/itineraries_meetup_detail',compact('hostimage','itineraryData','itinerary_id',
	                                                                     'allowItinerary','userLang','attendeesData'));
	 }
	 	   
/*public function interested(){
	$interestedData['user_id'] = $this->input->post('user_id');
	$interestedData['create_itinerary_id'] = $this->input->post('itinerary_id');
	$interestedData['service_id'] = $this->input->post('service_id');
	$interestedData['full_name'] = $this->input->post('full_name');
	$interestedData['email'] = $this->input->post('email');
	$interestedData['phone_no'] = $this->input->post('phone_no');
	$interestedData['created_at'] = date('Y-m-d h:i:s');	
	$rsvpData = $this->Itinerarie_model->insertedData($interestedData);
	if($rsvpData=='success'){
		echo 'success';die;
		}else{
		 echo 'error';die;
		}
}*/

//================ Itinerary Session Created function ======================//
public function create_itineraries_session(){	
	    $userId = $this->session->userdata('id');		
		$service_id = $this->input->get('serviceid',true); // service id from query string url
		$selectOtherLang = $this->input->get('otherlang',true); // selected language from query string url
		$userCity = $this->Itinerarie_model->findUser_city($userId);
		$features = $this->Itinerarie_model->selectFeatures();
		$languages = $this->Itinerarie_model->selectLanguages($userId);
		$allCategory = $this->Itinerarie_model->selectCategory($service_id);
		$allthemes = $this->Itinerarie_model->selectThemes($userId);		
		$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		$draFaqData = $this->Itinerarie_model->getSaveTqsData($userId);
		$drafRouteTimeData = $this->Itinerarie_model->getSaveRouteData($userId);
		$drafFamilyData = $this->Itinerarie_model->getSaveFamilyeData($userId);
		$speakersData = $this->Itinerarie_model->getSaveSpeakerData($userId,$service_id);
		$hostimage = $this->Itinerarie_model->getProfileimage($userId);
		$highLightResult = $this->Itinerarie_model->getHighLightData();
		$legalData = $this->Itinerarie_model->getLegalData($service_id); // fetch iwl legal data from database 
		$hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		$airPortData = $this->Itinerarie_model->getAirports();
		$railwayData = $this->Itinerarie_model->getRailways();
		 
	    if(!empty($hostSaveData)){
		  foreach($hostSaveData as $value){
			  	 $draftData = $value;				
			  }
			}
		else{
			 $draftData = array();
			}	
		
		 //echo '<pre>';print_r($draftData);die;		
	$this->load->view('itineraries/create_itineraries_session',compact('hostimage','selectOtherLang','allCategory',
	                                                          'service_id','allthemes','draftData','userCity','features',
															  'languages','drafRouteTimeData','drafFamilyData','draFaqData',
															  'drafRouteTimeData','speakersData','highLightResult',
															  'legalData','hostProfile','airPortData','railwayData'));
}

//================ save meetup itinerary function start =====================//
public function saveSessionItinerary(){
	
	   $loginHostid = $this->session->userdata('id');	  
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
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
                  $sessionFileName = $_FILES['itinerary_gallery_image_cover']['name'];
                  $path = "./assets/itinerary_files/gallery/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_cover';
                  $maxSize = 10240;
				  $resizewidth = 1440;
				  $resizeHeight = 810;
                  $itineraryfeatrue_image = $this->file_upload($path,$sessionFileName,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                               $resizewidth,$resizeHeight);
                }
                else{				       
                       $itineraryfeatrue_image = $this->input->post('itinerary_gallery_hide_image_cover');
					   //echo $itineraryfeatrue_image;die;
                      }
					  
							  
		 // =============== Additional images 1 upload start================//			  
		 if($_FILES['itinerary_gallery_image_01']['name'] !="")
              {
                  $sessionFileName1 = $_FILES['itinerary_gallery_image_01']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_01';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image1 = $this->file_upload($path,$sessionFileName1,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image1 = $this->input->post('itinerary_gallery_image_hide_01');
                     }
		
		// =============== Additional images 2 upload start================//
		 if($_FILES['itinerary_gallery_image_02']['name'] !="")
              {
                  $sessionFileName2 = $_FILES['itinerary_gallery_image_02']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_02';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image2 = $this->file_upload($path,$sessionFileName2,$allowType,$thumbPath,$fileInputName,$maxSize,
				                                          $resizewidth,$resizeHeight);
                }
                else{                        
                       $additional_image2 = $this->input->post('itinerary_gallery_image_hide_02');
                      }					  
			
			// =============== Additional images 3 upload start================//
		 if($_FILES['itinerary_gallery_image_03']['name'] !="")
              {
                  $sessionFileName3 = $_FILES['itinerary_gallery_image_03']['name'];
                  $path = "./assets/itinerary_files/additional_images/";
                  $allowType = "gif|jpg|png|jpeg";
                  $thumbPath = './assets/itinerary_files/thumbnail_images/';
                  $fileInputName = 'itinerary_gallery_image_03';
                  $maxSize = 10240;
				  $resizewidth = 250;
				  $resizeHeight = 158;
                  $additional_image3 = $this->file_upload($path,$sessionFileName3,$allowType,$thumbPath,$fileInputName,$maxSize,
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
		    $status = isset($lastdata->status);
		   }
		   else{
			    $status = 0;
			   }
		if(!empty($statusArr)){
		    $loginStatus = isset($lastdata->login_status);
		   }else{
		    $loginStatus ='';
		   }   
		//echo '<pre>';print_r($itinerarySaveArr);die;	
		
	   if($loginStatus=='' || $loginStatus==null){
	        $itinerarySaveArr['login_status'] = 1;
			$lastId = $this->Itinerarie_model->insertitinerary($itinerarySaveArr);
			//echo $lastInsert_id = $this->db->insert_id();die();
			if(!empty($lastId)){
				 for($i=0;$i<$faqcount;$i++){
				       $faqArrData['user_id'] = $loginHostid;
					   $faqArrData['login_status'] = 1;
					   $faqArrData['service_id'] = $this->input->post('service_id');
				       $faqArrData['create_itinerary_id'] = $lastId;
					   $faqArrData['category_id'] = $this->input->post('category');
					   $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
					   $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
					   $faqArrData['created_at'] =   date('Y-m-d h:i:S');
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
						$routeArrData['drop_off_lat_lng'] =   null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:S');
						$routeArrData['login_status'] = 1;
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
					  
					  $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 
					   $familyData['login_status'] = 1;   
					   $familyData['created_at'] =   date('Y-m-d h:i:S');
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
						$uniueId = uniqid();
						$file = $targetDir . $uniueId . '.'.$image_type;
						$fileName = $uniueId . '.'.$image_type;
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
				
			   $this->session->set_flashdata('success','session_draft');	
			
		   }else{		   
		      //echo '<pre>';print_r($itinerarySaveArr);die;
			 $itinerarySaveArr['status'] = 0;
			 $itinerarySaveArr['admin_status'] = null;
			 $itinerarySaveArr['login_status'] = 1;
			 
		     $updateData = $this->Itinerarie_model->updateMeetupDraftData($loginHostid,$itinerarySaveArr);
			 $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			 $getFaqids = $this->Itinerarie_model->getSaveFaqids($loginHostid,$getsaveItineraryId[0]->id);			 
			 $getRouteids = $this->Itinerarie_model->getSaveRoutesids($loginHostid,$getsaveItineraryId[0]->id);			 
			 $getFamilyids = $this->Itinerarie_model->getSaveFamilyids($loginHostid,$getsaveItineraryId[0]->id);
			 $getSpeakerids = $this->Itinerarie_model->getSaveSpeakerids($loginHostid,$getsaveItineraryId[0]->id);
			 //print_r($getsaveItineraryId);die;
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
				  $faqArrData['service_id'] = $this->input->post('service_id');
				  $faqArrData['create_itinerary_id'] = $getsaveItineraryId[0]->id;
				  $faqArrData['category_id'] = $this->input->post('category');
				  $faqArrData['itinerary_faq_question'] = $this->input->post('itinerary_faq_question_01')[$i];
  				  $faqArrData['itinerary_faq_answer'] = $this->input->post('itinerary_faq_answer_01')[$i];
				  $faqArrData['created_at'] =   date('Y-m-d h:i:S');
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['drop_off_lat_lng'] =   null;
					    $routeArrData['created_at'] =   date('Y-m-d h:i:S');
						$routeArrData['login_status'] = 1;
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
					   
					   //$familyData['min_no_kides'] = $this->input->post('itinerary_traveller_family_kids01_minnumber')[$i];					 
					   //$familyData['max_no_kides'] = $this->input->post('itinerary-traveller-family-kids01-maxnumber')[$i]; 
					  
					  $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:S');
					   $familyData['login_status'] = 1;
					   $this->db->insert('txn_itinerary_family', $familyData);
					  }
					  
				if(!empty($this->input->post('speakerName'))){					
					    // File upload configuration
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
						$sponsorArrData['login_status'] = 1;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);							
					   }
					}	  	  
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');	
		  }	
            return redirect('create_itineraries_session?serviceid='.$service_id.'&otherlang='.$otherlang);	
}

//================ ********* Done meetup itinerary function start ************=====================//
public function doneSessionItinerary(){
	
	   $loginHostid = $this->session->userdata('id');	  
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
		//echo $status;die;
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
						$routeArrData['drop_off_lat_lng'] =   null;
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
					   
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i]; 					      
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
			    return redirect('itineraries');
		   }
		   else{
		      $itinerarySaveArr['login_status'] = null;		     
			  $getsaveItineraryId = $this->Itinerarie_model->getSaveItineraryId($loginHostid);
			  //echo '<pre>'; print_r($getsaveItineraryId);die;
			  $updateData = $this->Itinerarie_model->updateMeetupDraftData($loginHostid,$itinerarySaveArr);
			 
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
					   
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
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
			  return redirect('itineraries');
		 }	
 }
 
 //========= ********* Session itinerary edit view function start **********===================//	
	public function itinerary_session_edit_view(){
	     $userId = $this->session->userdata('id');
		 $serviceId = $this->input->get('serviceid',true);
		 $itineraryId = $this->input->get('itineraryid',true);
		 $otherlang = $this->input->get('otherlang',true);
		 $adminStatus = $this->input->get('adminStatus',true);
		  
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
		 $hostProfile = $this->Itinerarie_model->getHostProfile($userId); //get Host information
		 $airPortData = $this->Itinerarie_model->getAirports();
		 $railwayData = $this->Itinerarie_model->getRailways();
		 //$hostSaveData = $this->Itinerarie_model->fetchSaveItinerary($userId); // fetch all itinerary data after save click and show in view
		
		foreach($dataSet as $value){
			  $editDataSet = $value;
			 }
		 //echo '<pre>';print_r($editDataSet);die;
		
		$this->load->view('itineraries/itinerary_session_edit_view',
		                 compact('editDataSet','serviceId','otherlang','allCategory','userCity',
						 'draFaqData','drafRouteTimeData','drafFamilyData','allthemes','features','legalData',
						 'languages','itineraryId','adminStatus','hostimage','allowItinerary',
						 'drafSpeakerData','highLightResult','hostProfile','airPortData','railwayData'));
		}
		
//============== edit Session save button click function start ======================//
public function editSessionSaveItinerary(){ 
        
      $loginHostid = $this->session->userdata('id');	  
	  $service_id = $this->input->post('service_id');
	  $otherlang = $this->input->post('selLang');
	  $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['service_id'] = $service_id;
	   $itinerarySaveArr['itinerary_language'] = $otherlang;
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   //$itinerarySaveArr['translator_type'] = 0;
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
	   
	      // echo '<pre>';print_r($itinerarySaveArr);die;
		    $updateData = $this->Itinerarie_model->editUpdateMeetupDraftData($loginHostid,$itinerarySaveArr,$itinerary_id);
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
				  $faqArrData['login_status'] = 1;
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
						$routeArrData['login_status'] = 1;
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
					   
					  $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
					   $familyData['created_at'] =   date('Y-m-d h:i:s');
					   $familyData['login_status'] = 1;
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
						$sponsorArrData['login_status'] = 1;
						$sponsorArrData['created_at'] =   date('Y-m-d h:i:s');
					    $this->db->insert('txn_speakers_details', $sponsorArrData);	
						}
					}	  	    
				  
			 }else{
			 
			  echo ' ERROR:: itinerary id is empty.';die;
			 }
			 
			 $this->session->set_flashdata('success','draftupdate');	
		  	 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
            return redirect('Itineraries/itinerary_session_edit_view?serviceid='.$service_id.'&otherlang='.$otherlang.'&itineraryid='.$itinerary_id);			  
	   }
//============== edit Session done button click function start ======================//
public function editSessionDoneItinerary(){ 
        
      $loginHostid = $this->session->userdata('id');	  
	  $service_id = $this->input->post('service_id');
	  $otherlang = $this->input->post('selLang');
	  $itinerary_id = $this->input->post('itinerary_id');
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
	   $itinerarySaveArr['translator'] = $this->input->post('send_to_translator');
	   $itinerarySaveArr['translator_type'] = 0;
	   $itinerarySaveArr['translator_confirm'] = 0;
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
					   $familyData['adults_price'] = $this->input->post('itinerary_traveller_family_adult_price')[$i];					      
					   $familyData['kides_age'] =   $this->input->post('itinerary_traveller_family_kids01_age')[$i]; 
					   $familyData['kides_price'] = $this->input->post('itinerary_traveller_family_kids01_price')[$i];					      
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
			 
			 $this->session->set_flashdata('success','draftupdate');
			 //====== START:: Itinerary Mailer Fun. on 25-04-19 ===========//
			 $this->itineraryEditMailer($hostProfile,$itineraryUrl);
			 //======END:: Itinerary Mailer Func. ============//
             return redirect('itineraries');			  
	   }
	   
//===================== MEETUP ITINERARY View Detailed =====================//
public function itineraries_session_detail(){
        $loginHostid = $this->session->userdata('id');
        $hostimage = $this->Itinerarie_model->getProfileimage($loginHostid);
		$itineraryId = $this->input->get('itinerary_id');
	    $itinerary_id = base64_decode($itineraryId);
		$userLang = $this->input->get('lang');
		$serviceId = $this->input->get('serviceid');
	   //$flag = $this->input->get('flag');
	   $this->load->helper('hostname');
	   $this->load->helper('getallthemes');
	   $this->load->helper('gettotalduration');
	   $this->load->helper('getfaqdata');
	   $this->load->helper('getfamilydata');
	   $this->load->helper('getfeatures');
	   $this->load->helper('getinteresteddata');
	   $this->load->helper('getallpickpoints');
	   $this->load->helper('getfamilymultidata');
	   $this->load->helper('gethostname');
	   $itineraryVal = $this->Admin_model->fetchRequestItinerary($itinerary_id);
	   $allowItinerary = $this->Itinerarie_model->allowHost($loginHostid);
	   $allSpeakers = $this->Itinerarie_model->fetchSpeakers($itinerary_id);
	   $attendeesData = $this->Itinerarie_model->fetchAttendees($itinerary_id,$serviceId);
		
	  foreach($itineraryVal as $data){
		   $itineraryData = $data;
		  }
		//echo '<pre>';print_r($allSpeakers);die;  
	   $this->load->view('itineraries/itineraries_session_detail',compact('hostimage','itineraryData','itinerary_id',
	                                       'allowItinerary','allSpeakers','userLang','attendeesData'));
	 }
	 
	 
//========= Itinerary Edit Event Mailer Function==========//
public function itineraryEditMailer($hostData,$itineraryUrl){
	   $email = $hostData[0]->host_email;
	   $admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'7'));
	   $super_admin_email = $this->Admin_model->fetchAdminEmail('admin','email',array('id'=>'1'));
	    $config = $this->smtpCredential();
	  				
		$data['host_name'] = $hostData[0]->host_first_name.' '.$hostData[0]->host_last_name;
		$data['modify_by'] = 'Host';
		$data['itinerary_url'] = $itineraryUrl;
		//echo '<pre>';print_r($data);die;
		$body = $this->load->view('mailer/itinerary_edit_mail', $data, true );
		$this->load->library('email',$config);
		$this->email->set_newline("\r\n");
		$this->email->from('help@cityexplorers.in', 'City Explorers');
		$this->email->to($email);			
		$this->email->cc([$admin_email, $super_admin_email]);
	
		$this->email->subject('City Explorers - Itinerary Modified');
		$this->email->message($body);
		$this->email->send();
}

//============ Update Host Training Status function ===========//
public function updateHostTrainingStatus(){
	$autoId = $this->input->post('id');
	$userId = $this->input->post('userId');
	$trainingCheck = $this->input->post('trainingCheck');
	
	$msg = $this->Itinerarie_model->updateHostTraining($autoId,$userId,$trainingCheck);
	if(isset($msg)){
		 if($msg=='success'){
			 echo 'success';die;
			 }else{
			 
			  echo 'error';die;
			 }
		}else{
		   echo 'empty_data';die;
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
						'mailtype'  => 'html', 
						'charset'   => 'iso-8859-1'
						);	
		return $config;				
	
}

	   
}

?>