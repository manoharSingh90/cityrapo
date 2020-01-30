<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{
	 function __construct()
	{
		parent::__construct();
    $this->load->model('User_model'); 
    $this->load->helper('sendsms');


	}

public function index()
	{
		if($this->session->userdata('id'))
			return redirect('home');
		 $this->load->view("account/user_registers");
	}
    

	public function login()
	{     
		$this->form_validation->set_rules('email', 'Email ID', 'required|valid_email');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    if($this->form_validation->run())
	    {
          
        $email_id = $this->input->post('email');
			$password = $this->input->post('password');
 			$user_id = $this->User_model->login_valid($email_id,$password);
          
 			if($user_id){
			    $this->load->model('Admin_model'); 
			    $loginStatus = $this->Admin_model->getLoginStatus($user_id);
				$loginArr = json_decode(json_encode($loginStatus),true);				 
 				$this->session->unset_userdata('otp');
				$this->session->set_userdata('id',$user_id);
				if(!empty($loginArr)){
					 if($loginArr[0]['admin_status']!=5){
						 echo "Login Successfully";
						 }
					 else{
						  echo 'my_itinerary';
						 }	 
					}                
					      
			}else{
                 
                echo "Please enter valid username and password";
				      
			}
	    }else{
             
            echo "Please fill all field.";
	    	
	    }
	}
	
//=========== Facebook Login function Start:on 27-02-19 ============//
public function facebookLogin(){
	$providerType = $this->input->post('provider');
	$userMailId = $this->input->post('email');
	$providerId = $this->input->post('id');
	$userFirstName = $this->input->post('fname');
	$userLastName = $this->input->post('lname');
	
	//echo $userMailId;die;
	
	if(!empty($userMailId)){
		 $chkEmail = $this->User_model->checkUserEmail($userMailId);
		 //print_r($chkEmail);die;
		 if(!empty($chkEmail)){
		      if($chkEmail[0]->provider_type=='facebook'){
			      $this->session->set_userdata('id',$chkEmail[0]->id);
				  echo 'facebook_login';die;
				  }
			 else{
				 echo 'email_error';die;
				 } 
			  
			 }
		 else{
		      $inserData = array(
			      'host_first_name' => $userFirstName,
				  'host_last_name' => $userLastName,
				  'host_email' => $userMailId,
				  'provider_type' => $providerType,
				  'provider_id' => $providerId,
				  'otp' => mt_rand(100000, 999999),				  
				  'created_at' => date('Y-m-d h:i:s')
			  );
		      $facebookInsertData = $this->User_model->insertSocialData($inserData);
			  if(!empty($facebookInsertData) && $facebookInsertData>0){
				   $socialLogin = $this->User_model->fetchSocialData($providerType,$userMailId,$providerId);
				   
				   if(!empty($socialLogin)){
				       $data = array('user_id'=>$socialLogin[0]->id);
					   $this->User_model->profile_id_create($data);
					   $this->session->set_userdata('id',$chkEmail[0]->id);
					   if($socialLogin[0]->admin_status!=5){
						  echo "login_success";die;
						 }
					 else{
						  echo 'my_itinerary';die;
						 }					   
					  }
				  }
			  else{
				   echo 'reg_error';die;
				  }	  
			 }	 
		}
}


//=========== Google Login function Start:on 28-02-19 ============//
public function googleLogin(){
	$userFullName = $this->input->post('userFullName');
	$userId = $this->input->post('userId');
	$userEmail = $this->input->post('userEmail');
	$userProvider = $this->input->post('userProvider');
	$userNameArr = explode(' ',$userFullName);	
	$userFirstName = $userNameArr[0];
	$userLastName = $userNameArr[1];
	
	//echo $userId;die;
	if(!empty($userEmail)){
		 $chkEmail = $this->User_model->checkUserEmail($userEmail);
		// print_r($chkEmail);die;
		 if(!empty($chkEmail)){
		      if($chkEmail[0]->provider_type=='google'){
			      $this->session->set_userdata('id',$chkEmail[0]->id);
				  echo 'google_login';die;
				  }
			 else{
				 echo 'email_error';die;
				 } 
			  
			 }
		 else{
		      $inserData = array(
			      'host_first_name' => $userFirstName,
				  'host_last_name' => $userLastName,
				  'host_email' => $userEmail,
				  'provider_type' => $userProvider,
				  'provider_id' => $userId,
				  'otp' => mt_rand(100000, 999999),				  
				  'created_at' => date('Y-m-d h:i:s')
			  );
		      $googleInsertData = $this->User_model->insertSocialData($inserData);
			  
			  if($googleInsertData>0){
				   $socialLogin = $this->User_model->fetchSocialData($userProvider,$userEmail,$userId);				   
				   if(!empty($socialLogin)){
				       $data = array('user_id'=>$socialLogin[0]->id);
					   $this->User_model->profile_id_create($data);
					   $this->session->set_userdata('id',$chkEmail[0]->id);
					   if($socialLogin[0]->admin_status!=5){
						  echo "login_success";die;
						 }
					 else{
						  echo 'my_itinerary';die;
						 }					   
					  }
				  }
			  else{
				   echo 'reg_error';die;
				  }	  
			 }	 
		}
}

	public function send_otp()
	{   	    
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
	    $this->form_validation->set_rules('last_name', 'Last Name', 'required');
	    $this->form_validation->set_rules('mob_num', 'Mobile Number', 'required|numeric');
	    $this->form_validation->set_rules('email_Id', 'EmailId', 'required|valid_email');
        $this->form_validation->set_rules('i_am', 'I am', 'required');
	    $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");  
       
        //$mailerData = $this->Admin_model->fetchMailerData();
		//echo '<pre>';print_r($mailerData);die;		
			
	    if($this->form_validation->run())
	    {

			$first_name    = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$mob_num = $this->input->post('mob_num');
			$email_Id = $this->input->post('email_Id');
      $i_am = $this->input->post('i_am');
			$OTP = mt_rand(100000, 999999);
			// $OTP      = random_string('alnum',10);
			$status = "0";
 
			$result = $this->User_model->register_valid($email_Id);
      $mobNum = $this->User_model->uniqueNumber($mob_num);
					    
			if(!empty($mobNum)){
				 echo 'unique_num';die;				 
				}else{
				if($result){			   	
                echo "emailerror";die;
			   	//return redirect('Account');
		   	  
		         }
				else{

		    	$data = array(
			        'host_first_name'  =>  $first_name,
			        'host_last_name'   =>  $last_name,
			        'host_mob_no'      =>  $mob_num,
              'host_email'       =>  $email_Id,
              'i_am'             =>  $i_am,
			        'otp'              =>  $OTP,
			        'status'           =>  $status,
					'created_at'       => date('Y-m-d h:i:s')
		        );
                 $this->session->set_userdata('userData',$data); 
				 
					//Email send for OTP
					$config = $this->smtpCredential();
                        $name = $first_name.' '.$last_name;
                        $this->session->set_userdata('username',$name);
                        $otp['value'] = $OTP;
                        $otp['key'] = 'OTP Number';
                        $otp['name'] = $name;
                        $otp['desc'] = 'A OTP code has been sent to your email ID';
                        $otp['url'] = '.';
                        $body = $this->load->view('account/mailer', $otp, true );						
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        $this->email->to($email_Id);
                        $this->email->cc('');
                        $this->email->bcc('');
                        $this->email->subject('OTP');
                        $this->email->message($body);
						$this->email->send();						
						
						//===== sendSMS() function to Send OTP on Mobile no. ========//
						 /*$otpmessage = 'your OTP code is '.$OTP;
						 sendSMS($mob_num, $otpmessage);*/
						 echo "success";
				 
                         /* $res_register = $this->User_model->register( $data );
                          if($res_register)
                           {
                              $this->session->set_userdata('otp',$OTP);
                              $this->session->set_userdata('email',$email_Id);
                              echo "success";
                              
                            }
							else{
                              //echo $this->email->print_debugger();die();
                               echo "Error";
                       
                              }*/   
  
                          } 
			       }			
			   						
			   }else{
			       echo 'validation not run';
			   }	
        }
	

    public function check_otp()
    {   
	  $registerData =  $this->session->userdata('userData');
	  
	   // echo '<pre>';print_r($registerData);die;
	   $this->session->set_userdata('email',$registerData['host_email']);
	  
    	$this->form_validation->set_rules('otp', 'OTP', 'required');
    	$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
    	if($this->form_validation->run())
    	{
    		$otp     = $this->input->post('otp');			
			$res_register = $this->User_model->register( $registerData );				
			if($res_register)
			   {
				  $this->session->set_userdata('otp',$registerData['otp']);
				  $this->session->set_userdata('email',$registerData['host_email']);
				 
				}	
    	   $ses_otp = $this->session->userdata('otp');

    		if($otp == $ses_otp )
    		{
    			$status    = "1";
    			$user_otp  = $ses_otp;
    			$chars     = "abcdefghijklmnpqrstuvwxyzABCDEFGIHJKLMNPQRSTUVWXYZ123456789-_";
                $pass      = substr(str_shuffle($chars), 0, 12);
                $email_id = $this->session->userdata('email');
               
				$user_name = $this->session->userdata('username');
				 
				//$this->registrationPassword($pass,$user_name,$email_id);
				
				     $config = $this->smtpCredential();
										
                        $pas['name'] = $user_name;
						
                        $body = $this->load->view('account/new_mailer', $pas, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        $this->email->to($email_id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('Welcome to City Explorers');
                        $this->email->message($body);
                        $this->email->send();
						
                        //if($send_mail){
                            $res_final = $this->User_model->register_final( $status , $user_otp , $pass ); 

                            if($res_final ){
                                $id = $this->User_model->get_id( $pass );
                                $data = array (
                                       'user_id'=> $id
                                    );
                                
                                $resullt = $this->User_model->profile_id_create($data);
                                if($resullt){
                                     
                                    $this->session->unset_userdata('otp');
                                    //$this->session->set_userdata('id',$id);
                                     echo "Registration Successfull";
                                 }
                                
                            }else{

                            }

                        // }else{
                        //     echo "";

                        // }
    			     
    		}else{
                echo "Please enter valid OTP code";	
    		}
    	}else{
            echo validation_errors();
            //echo "Fill Right OTP";
    	}

    }

    // public function resent_otp()
    // {

    // 	if($this->session->userdata('email')){
    //        $email_id = $this->session->userdata('email');
    		
            
		    
			//         $result = $this->User_model->resent_otp($email_id);

    //         if($result){
    //         $this->session->unset_userdata('otp');
    //         $this->session->unset_userdata('email');

    //         	return redirect('Account');
    //         }
    // 	}
    	
    // }

    public function resend_otp()
    {

    	if($this->session->userdata('email')){

            $email_id  = $this->session->userdata('email');
    	    $OTPP      = mt_rand(100000, 999999);
            $this->session->set_userdata('otp',$OTPP);

			        $config = $this->smtpCredential();
									
                        $user_name = $this->session->userdata('username');
                        $otp['value'] = $OTPP;
                        $otp['key'] = 'OTP Number';
                        $otp['name'] = $user_name;
                        $otp['desc'] = 'A OTP code has been re-sent to your email ID';
                        $otp['url'] = '.';
                        $body = $this->load->view('account/mailer', $otp, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        $this->email->to($email_id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('City Explorers - One Time Password');
                        $this->email->message($body);

                        $this->email->send();

            $result = $this->User_model->resend_otp( $OTPP , $email_id);
            if($result){
                echo "A OTP code has been re-sent to your email ID";
            	//return redirect('verify_email');
            }else{
                echo "Please re-send OTP code";
            }
		    
		    //$this->load->view("Login/hoster_otp");
    	}
    	
    }

	   


	public function forgot_pass()
	{
		$this->session->set_userdata('forgot_key','show');
		return redirect('Account');
		//$this->load->view("Login_Register/forgot_password");
	}

	public function check_email()
	{
       
		$this->form_validation->set_rules('reg_email','Email Id','required|valid_email');
		
		if($this->form_validation->run())
		{
            
			$email_id =  $this->input->post('reg_email');			
			$get_pass = $this->User_model->forgot_pass($email_id);			
			$adminStatus = $this->User_model->fetch_status($email_id);
			
			if(!empty($adminStatus)){
				 $userStatus = $adminStatus[0]->admin_status;
				}
			else{
				 $userStatus = 0;
				}	
			
			if(isset($get_pass->host_password))
			{
		     if($userStatus!=0){
			 $randPass = $this->random_password();	
			 $timeVal = time();			 
			 $this->User_model->updateExpPassTime($timeVal,$email_id);
			 //$msg =  $this->User_model->updatePassWord($email_id,$randPass,$get_pass->id);			
			//if($msg=='pass_success'){
		     //Email send for PASSWORD
			     $config = $this->smtpCredential();
               
                        $user_name = $this->session->userdata('username');
                        $pass['value'] = $randPass;
                        $pass['key']  = 'Password';
                        $pass['name'] = $adminStatus[0]->host_first_name.' '.$adminStatus[0]->host_last_name;
                        $pass['desc'] = '.';
                        $pass['url'] = '.';
						$pass['data'] = $adminStatus;
						$pass['exp_pass_time'] = $timeVal;
						//echo '<pre>';print_r($pass);die;

                        $body = $this->load->view('account/forgot_password',$pass,true);
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from(SERVER_MAIL, 'City Explorers');
                        $this->email->to($email_id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('Forgotten Password Reset');
                        $this->email->message($body);
                        $send_mail= $this->email->send();						
                        echo "success";
			   /*}else{
			     echo 'update_pass_err';
			   }*/		
			 
			 }else{
			    echo 'adminpending';
			 }		

			}else{

                echo "Please enter registered email id";	
			}

		}else{

            echo "Please enter your registered email ID ";
		}
	}
	
public function random_password(){
	 $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#%&_-=+?";
    $password = substr( str_shuffle( $chars ), 0, 10 );
    return $password;
}	

    public function cancle()
	{
		$this->session->unset_userdata('forgot_key');
		return redirect('Account');
	}

	public function log_out()
	{
	    $loginUser = $this->session->userdata('id');
		$status = $this->input->get('status');
		
		if(!empty($loginUser)){
			  $this->load->model('Itinerarie_model');
			  $updateloginStatus = $this->Itinerarie_model->updateloginStatus($loginUser); 
			  $updateTqaloginStatus = $this->Itinerarie_model->updateTqa_loginStatus($loginUser); 
			  $updateFamilyStatus = $this->Itinerarie_model->updateFamily_loginStatus($loginUser);
			  $updateRouteStatus = $this->Itinerarie_model->updateRoute_loginStatus($loginUser);
			  // this function is use for update login_status when user logout after draft create itinerary
			}
		$this->session->sess_destroy('id');
        //$this->session->unset_userdata('id');
		if($status=='logout' && $status!==''){
			return redirect('signin');
			}
	    else{
			return redirect('home');
			}		
		
	}
       
	public function profile()
	{       
		$id = $this->session->userdata('id');
		//echo $id;die;
        $state_data = $this->User_model->get_state(); 		
	    $user_data  = $this->User_model->find_profile($id);
	    $myInterestData = $this->User_model->fetchInterestData();//added by robin on 01-02-19
	    $allCity = $this->User_model->fetchAllCities();
		$iwlLanguage = $this->User_model->fetchIwlLanguage();
		$termConditionData = $this->User_model->fetchTermsConditions(); // it's function call terms and condition
		//print_r($allCity);die;
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
		//echo '<pre>';print_r($user_data);die;	
		
		
        //if(!$this->session->userdata('id'))
            //return redirect('home');
      $this->load->view( 'account/user_profile' , [ 'user_data' => $user_data ,'state'=> $state_data,'myInterestData'=>$myInterestData,'cityresult'=>$cityresult,'hostId'=>$id,'iwlLanguage'=>$iwlLanguage,'termConditionData'=>$termConditionData]);
      
	}

     public function get_city(){
        
         $id = $this->session->userdata('id');
		 //echo $id;die;
         $user_data  = $this->User_model->find_profile( $id );
         $state_id =  $this->input->post('state_id');
         $city_data = $this->User_model->get_city($state_id);
         $cityData['cities'] = $city_data;
         $userData['user_data'] = $user_data;
      
        $city_user_data = array_merge($cityData,$userData);
        echo  json_encode($city_user_data);die();
        
     }
    
      
//SAVE PROFILE CONTROLLER
     public function user_profile_save()
     { 
	    //echo '<pre>';print_r($_POST);die;
	      if($this->input->post('date_of_birth')!==null && $this->input->post('date_of_birth')!==''){
			//$dob = $this->input->post('date_of_birth');
			$dob1 = strtr($this->input->post('date_of_birth'), '/', '-');
			$dob = date('Y-m-d',strtotime($dob1));
			//echo $dob;die;
			 }
			 
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
				}
		  if(!empty($this->input->post('noc_certificate'))){
				 $NOC_certificate = $this->input->post('noc_certificate');
				}		
			/*else{
				 $termcondition = 0;
				}*/	
				
            $user_id              = $this->session->userdata('id');
            $first_name           = $this->input->post('first_name');
            $last_name            = $this->input->post('last_name'); 
            $mobile_number        = $this->input->post('mobile_number');
            $email_id             = $this->input->post('email_id'); 
            $gender               = $this->input->post('gender');
            $nationality          = $this->input->post('nationality');
            $date_of_birth        = $dob;
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
            $swachh_bharat       = $swachhBharat;
			$tourism             = $tourismData;
			$term_condition   = $termcondition;
			$host_before_desc   = $this->input->post('host_before_desc');
			$display_name     =  $this->input->post('display_name');

//FILES UPLOADS PROFILE PIC START
            //echo "save"; die();			
            if($_FILES['profile_pic']['name'] !="")
              {     
		           //echo $_FILES['profile_pic']['name'];die();                   
					$config = array(
					'upload_path' => "./assets/upload/profile_pic/",
					'allowed_types' => "gif|jpg|png|jpeg",
					'overwrite' => TRUE,
					/*'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					'max_height' => "768",
					'max_width' => "1024"*/
					);
					
                    $this->load->library('upload', $config);
					
                    if (!$this->upload->do_upload('profile_pic'))
                    {
                        //echo "frofile img error"; die();

                      $this->session->set_flashdata('error',$this->upload->display_errors());
                      $this->session->set_flashdata('feedback_class','alert-danger');
                       // $error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {                       
                        $upload_data     = $this->upload->data();
						//print_r($upload_data);die;
                        $config['image_library'] ='gd2';
                        $config['source_image']  ='./assets/upload/profile_pic/'.$upload_data['file_name'];
                        $config['create_thumb']  = FALSE;
                        $config['maintain_ratio']= FALSE;
                       // $config['quality']       = '60%';
                       // $config['width']         = 600;
                       // $config['height']        = 400;
                        $config['new_image']     = './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        //$this->image_lib->resize();
                       // echo'<pre>'; print_r($config);die;
                        $profile_image = $upload_data['file_name']; 
						
                    }
                }
                else{                       
                       //echo $this->upload->display_errors();die();
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
                      
                       // $error = array('error' => $this->upload->display_errors());
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
                      
                        //$error = array('error' => $this->upload->display_errors());
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
                      
                        //$error = array('error' => $this->upload->display_errors());
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
                      
                        //$error = array('error' => $this->upload->display_errors());
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
                      
                        //$error = array('error' => $this->upload->display_errors());
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
            if($this->input->post('services_offered')==''){

            }else{
              $service_offered     = $this->input->post('services_offered');
              $services_offered    = implode(',', $service_offered );

            }
            if($this->input->post('preferred_cities')==''){
                 //echo 'null city';die;
            }else{
             $preferred_city     = $this->input->post('preferred_cities');
             $pref_city          = implode(',', $preferred_city );
			 
            }
            if($this->input->post('know_languages')==''){

            }else{
              $known_lang         = $this->input->post('know_languages');
              $know_langs        = implode(',', $known_lang );
			  
			  //echo '<pre>';print_r($know_langs);die;
            }
            $preferred_languag    = $this->input->post('preferred_languages');
            $host_before          = $this->input->post('host_before');
            $adhaar_number        = $this->input->post('adhaar_number'); 
            $pan_number           = $this->input->post('pan_number');
            $passport_number      = $this->input->post('passport_number');
            $license_guide_number = $this->input->post('license_guide_number');
            $gst_pin              = $this->input->post('gst_pin');
            $status               = '0'; 

            $data_user = array(
                  'host_first_name' =>  $first_name,
                  'host_last_name'  =>  $last_name,
                  'host_mob_no'     =>  $mobile_number

            );

           $data_user_profile = array(
              'user_id'             =>  $user_id,
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
             'known_languages'      =>  $know_langs,
              'adhaar_number'       =>  $adhaar_number,
              'adhaar_number_doc'   =>  $adhaar_number_doc,
              'pan_number'          =>  $pan_number,
              'pan_number_doc'      =>  $pan_number_doc,
              'passport_number'     =>  $passport_number,
              'passport_number_doc' =>  $passport_number_doc,
              'license_guide_number'=>  $license_guide_number,
          'license_guide_number_doc'=>  $license_guide_number_doc,
              'gst_pin'             =>  $gst_pin,
              'gst_pin_doc'         =>  $gst_pin_doc,
              'status'              =>  $status,
			  'swachh_bharat'       => $swachh_bharat,
			  'tourism'             => $tourism,
			  'term_condition'    =>  $term_condition,
			  'noc_certificate_policy' =>$NOC_certificate,
			  'display_name' => $display_name
            );			
           //echo '<pre>'; print_r($data_user_profile);die;

          $this->User_model->user_update($user_id, $data_user);

          $profile_id = $this->User_model->check_user_id($user_id);

          if($profile_id){             
            $this->session->set_userdata('id',$this->input->post('user_id')); 
            $result = $this->User_model->user_profile_update($profile_id, $data_user_profile );
            $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
                if($result){                  
                  $this->session->set_flashdata('error','success_save');                  
				  //========START:: Host Profile Mailer function =========//
				   $this->hostProfileMailer($data_user,$email_id);
				  //========END:: Host Profile Mailer function =========//
                  return redirect('profile');

                }else{

                  $this->session->set_flashdata('error','save_error');                 
                  return redirect('profile');

                }

          }else{
             
              $result = $this->User_model->user_profile_insert($data_user_profile);

                if($result){

                  $this->session->set_flashdata('error','Your profile has been saved successfully!');
                  $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('profile');

                }else{

                  $this->session->set_flashdata('error','Oops, something went wrong!, please try again');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }
          }

        }
//SAVE PROFILE CONTROLLER
//DONE PROFILE
public function user_profile_done()
        {
         //echo '<pre>';print_r($_POST);die;  
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
				}
			/*else{
				 $termcondition = 0;
				}*/				
		  if($this->input->post('date_of_birth')!==null && $this->input->post('date_of_birth')!==''){
		    $dob1 = strtr($this->input->post('date_of_birth'), '/', '-');
			$dob = date('Y-m-d',strtotime($dob1));			
			 }
			 
		if(!empty($this->input->post('noc_certificate'))){
				 $NOC_certificate = $this->input->post('noc_certificate');
				}	 
            
            $user_id              = $this->session->userdata('id');
            $first_name           = $this->input->post('first_name');
            $last_name            = $this->input->post('last_name'); 
            $mobile_number        = $this->input->post('mobile_number');
            $email_id             = $this->input->post('email_id'); 
            $gender               = $this->input->post('gender');
            $nationality          = $this->input->post('nationality');            
            $date_of_birth        = $dob;
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
			$display_name      =  $this->input->post('display_name');
			
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
             'host_before'         =>   $host_before,
			 'host_before_note'    =>    $host_before_desc,
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
			  'display_name'    => $display_name
			  
            );
			
            $data_done_user = array(
                  'host_first_name' =>  $first_name,
                  'host_last_name'  =>  $last_name,
                  'host_mob_no'     =>  $mobile_number,
                  'notify_status'   =>  0

            );
        
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
                   
				    //========START:: Host Profile Mailer function =========//
				   $this->hostProfileMailer($data_done_user,$email_id);
				  //========END:: Host Profile Mailer function =========//
                   return redirect('itineraries');


                }else{

                  $this->session->set_flashdata('error','done_error');
                  $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }

        }else{
             
              $result = $this->User_model->user_profile_insert($data_user_profile_done);

                if($result){

                  $this->session->set_flashdata('error','doneprofile_insert');
                   $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('profile');

                }else{

                  $this->session->set_flashdata('error','doneprofile_insert_err');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }
          }

          }else{
             
            $this->session->set_flashdata('error',validation_errors());            
             $this->session->set_flashdata('feedback_class','alert-danger');
             //$this->load->view('account/user_profile');
            return redirect('profile');
            //echo" plz fill all field";
          }
        } 


      public function itineraries(){

            $this->load->view('account/user_itineraries');
        } 

        public function remove_pic()
        {
            $user_id = $this->session->userdata('id');
            $get_img_name = $this->User_model->retrieveImg($user_id);
            
            $img = array(
                'profile_picture'=>''
            );
             //echo  $file_img =   base_url("assets/upload/profile_pic/$get_img_name");die();
            $result = $this->User_model->removeImg($user_id,$img);
           
            if($result){

               //$file_img =   base_url("assets/upload/profile_pic/$get_img_name");
               echo "success";
               // unlink($file_img);
            }
            
           

        }     

        public function remove_adhaar()
        {
            $user_id = $this->session->userdata('id');
            $get_adhaar_doc = $this->User_model->retrieveadhaar($user_id);
            
            $adhaar = array(
                'adhaar_number_doc'=>''
            );
             //echo  $file_img =   base_url("assets/upload/profile_pic/$get_img_name");die();
            $result = $this->User_model->removeadhaar($user_id,$adhaar);
           
            if($result){

               //$file_img =   base_url("assets/upload/profile_pic/$get_img_name");
               echo "success";
               // unlink($file_img);
            }
            
           

        }
		
	public function loginMailHost(){
		   $this->load->view('account/login');
		}
		
 //============= change password function ================//
 public function changePass(){
        $id            = $this->session->userdata( 'id' );		
        $old_pass      = $this->input->post( 'old_pass' );
        $new_pass      = $this->input->post( 'new_pass' );
        $conf_new_pass = $this->input->post( 'conf_new_pass' );
        $result = $this->User_model->check_pass( $id , $old_pass );
       		
        if($result){
            
     //MAIL FOR CHANGE PASSWORD  
               $config = $this->smtpCredential();			 
           						
                    $host_name = $result[0]->host_first_name.' '.$result[0]->host_last_name;
                    $host_email = $result[0]->host_email;
                    $change_pass['host_name']       = $host_name;
                    $change_pass['new_password']    =  $new_pass;
                    
                    $body = $this->load->view('mailer/change_password', $change_pass, true );
                    $this->load->library('email',$config);
                    $this->email->set_newline("\r\n");
                    $this->email->from(SERVER_MAIL, 'City Explorers');
                    $this->email->to($host_email);
                    $this->email->cc('');
                    $this->email->bcc('');
                    $this->email->subject('Password Changed Successfully');
                    $this->email->message($body);
                    $this->email->send();
                  
                    $this->User_model->update_pass( $id , $new_pass );
             echo "success";
        }else{
            echo "wrong";
        }
    
    }
	
//========== Social Login Profile Update Data fun. start on 1-03-19 ==========//

public function socialProfileUpdate(){
	 $mobileNo = $this->input->post('mobileFill');
	 $iam = $this->input->post('iam');
	 $host_id = $this->input->post('host_id');
	 $result = $this->User_model->social_login_update($mobileNo,$iam,$host_id);
	 echo $result;die;
}


//========= Host Profile Mailer Function==========//
public function hostProfileMailer($hostData,$hostEmail){
	   $email = $hostEmail;
	   
	   $config = $this->smtpCredential();
	  				
				$data['host_name'] = $hostData['host_first_name'].' '.$hostData['host_last_name'];
				$data['modify_by'] = 'Host';
				//echo '<pre>';print_r($data);die;
				$body = $this->load->view('mailer/host_profile_mail', $data, true );
				$this->load->library('email',$config);
				$this->email->set_newline("\r\n");
				$this->email->from(SERVER_MAIL, 'City Explorers');
				$this->email->to($email);				
				$this->email->subject('Profile Submitted');
				$this->email->message($body);
				$this->email->send();
}

//=========== Reset Password Function ==========//
public function resetPassword(){
	$user_id = base64_decode($this->input->get('userid'));
	$user_email = base64_decode($this->input->get('useremail'));
	$exp_time = base64_decode($this->input->get('exp_time'));
	//echo $exp_time;die;
	if($exp_time+86400<time()){
		$this->load->view('account/password_link_expire');
	 }else{
		  $this->load->view('account/reset_password',compact('user_id','user_email'));
		}
	
}

//============= change Reset password ============//
public function changeResetPass(){
	//$oldPass = $this->input->post('old_pass');
	$newPass = $this->input->post('new_pass');
	$confirmPass = $this->input->post('confirm_pass');
	$userId = $this->input->post('userId');
	$userEmail = $this->input->post('userEmail');
	
	if(!empty($newPass) && $newPass!=''){
		  $oldChk = $this->User_model->getOldPassword($userId,$userEmail);
		  //if($oldPass===$oldChk[0]->host_password){		  
		     if($newPass===$confirmPass){
				   $resetdata = $this->User_model->updateResetPass($userId,$userEmail,$newPass);
				   if(isset($resetdata)){
				        //===== mail function ====//
						$this->reset_pass_mail($oldChk);
					    echo 'success';die;
					   }else{
					    echo 'pass_db_error';die;
					   }				  
				 }else{
				   echo 'confirm_pass_err';die;
				 }			   
			  //}
		  /*else{
			    echo 'old_pass_err';die;
			  }*/		  
		}else{
		   echo 'new_pass_empty';die;
		}
	
}


//======== reset password change Mail function ==========//
public function reset_pass_mail($userData){
	
	           $config = $this->smtpCredential();
			   						
                    $host_name = $userData[0]->host_first_name.' '.$userData[0]->host_last_name;
                    $host_email = $userData[0]->host_email;
                    $reset_pass['host_name']       = $host_name;
                    
                    $body = $this->load->view('mailer/change_reset_password', $reset_pass, true );
                    $this->load->library('email',$config);
                    $this->email->set_newline("\r\n");
                    $this->email->from(SERVER_MAIL, 'City Explorers');
                    $this->email->to($host_email);
                    $this->email->cc('');
                    $this->email->bcc('');
                    $this->email->subject('Password Changed Successfully');
                    $this->email->message($body);
                    $this->email->send();
}


//===== Registration password send after check otp ============//
public function registrationPassword($pass,$user_name,$email_id){
	
	          $config = $this->smtpCredential();
	          
                    $reg_pass['name'] = $user_name;
					$reg_pass['pass'] = $pass;
                    
                    $body = $this->load->view('mailer/registration_password', $reg_pass, true );
                    $this->load->library('email',$config);
                    $this->email->set_newline("\r\n");
                    $this->email->from(SERVER_MAIL, 'City Explorers');
                    $this->email->to($email_id);
                    $this->email->cc('');
                    $this->email->bcc('');
                    $this->email->subject('Welcome to City Explorers');
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
						//'smtp_user' =>'donotreply@wealthveda.com',							
						//'smtp_pass' => 'rijkdom@125',
						'mailtype'  => 'html', 
						'charset'   => 'iso-8859-1'
						);	
		return $config;				
	
}
	
}
?>

