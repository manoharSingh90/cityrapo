<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller
{
	 function __construct()
	{
		parent::__construct();
		$this->load->model('User_model'); 
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
 				$this->session->unset_userdata('otp');
				$this->session->set_userdata('id',$user_id);
                echo "Login Successfully";
					      
			}else{
                 
                echo "Invalid UserName/Password";
				      
			}
	    }else{
             
            echo "Plz Fill All  Field Currectly";
	    	
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
 
			$result = $this->User_model->register_valid( $email_Id);
            
		    if($result){
               
			   	//$this->session->set_flashdata('error','This Email Is Already Exist .');
                echo "This email already exists.";
			   	//return redirect('Account');
		   	  
		    }else{

		    	$data = array(
			        'host_first_name'  =>  $first_name,
			        'host_last_name'   =>  $last_name,
			        'host_mob_no'      =>  $mob_num,
			        'host_email'       =>  $email_Id,
                    'i_am'             =>  $i_am,
			        'otp'              =>  $OTP,
			        'status'           =>  $status
		        );
             
                //Email send for OTP

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
                        $name = $first_name.' '.$last_name;
                        $this->session->set_userdata('username',$name);
                        $otp['value'] = $OTP;
                        $otp['key'] = 'OTP Number';
                        $otp['name'] = $name;
                        $otp['desc'] = 'Please fill OTP and verify your email';
                        $otp['url'] = '.';
                        $body = $this->load->view('account/mailer', $otp, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('info@unikove.com', 'India With Locals');
                        $this->email->to($email_Id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('OTP');
                        $this->email->message($body);

                       $this->email->send();


                        //if($this->email->send()){
                            $res_register = $this->User_model->register( $data );
                            if($res_register)
                           {
                              $this->session->set_userdata('otp',$OTP);
                              $this->session->set_userdata('email',$email_Id);
                              echo "Please check OTP On Your Email And Verify";
                              
                            }
  
                         // }else{
                         //     //echo $this->email->print_debugger();die();
                         //      echo "Plz Send Again Email";
                       
                         // }      						
			   }	
        }else{
            echo "Fill Currect Field";

        }    
	}

    public function check_otp()
    {   
    	$this->form_validation->set_rules('otp', 'OTP', 'required');
    	$this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
    	if($this->form_validation->run())
    	{
    		$otp     = $this->input->post('otp');
    		$ses_otp = $this->session->userdata('otp');

    		if($otp == $ses_otp )
    		{
    			$status    = "1";
    			$user_otp  = $ses_otp;
    			$chars     = "abcdefghijklmnpqrstuvwxyzABCDEFGIHJKLMNPQRSTUVWXYZ123456789-_";
                $pass      = substr(str_shuffle($chars), 0, 12);
                 $email_id = $this->session->userdata('email');

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
                        $user_name = $this->session->userdata('username');
                       
                        //$pas['key'] = 'Password ';
                        $pas['name'] = $user_name;
                        //$pas['desc'] = 'Please click and login.';
                        //$pas['url'] = 'http://52.220.197.0/indiawithlocals/signin';
                        $body = $this->load->view('account/new_mailer', $pas, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('info@unikove.com', 'India With Locals');
                        $this->email->to($email_id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('Welcome to India with locals');
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
                echo "Please Fill Right OTP";	
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
                        $user_name = $this->session->userdata('username');
                        $otp['value'] = $OTPP;
                        $otp['key'] = 'OTP Number';
                        $otp['name'] = $user_name;
                        $otp['desc'] = 'Please fill OTP and verify your email.';
                        $otp['url'] = '.';
                        $body = $this->load->view('account/mailer', $otp, true );
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('info@unikove.com', 'India With Locals');
                        $this->email->to($email_id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('OTP');
                        $this->email->message($body);

                        $this->email->send();

            $result = $this->User_model->resend_otp( $OTPP , $email_id);
            if($result){
                echo "Please Check Next OTP On Your Email And Verify";
            	//return redirect('verify_email');
            }else{
                echo "Please Resend OTP";
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

			if($get_pass)
			{
				//Email send for PASSWORD

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
                        $user_name = $this->session->userdata('username');
                        $pass['value'] = $get_pass;
                        $pass['key']  = 'Password';
                        $pass['name'] = $user_name;
                        $pass['desc'] = '.';
                        $pass['url'] = '.';

                        $body = $this->load->view('account/mailer',$pass,true);
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('robin@unikove.com', 'India With Locals');
                        $this->email->to($email_id);
                        $this->email->cc('');
                        $this->email->bcc('');

                        $this->email->subject('Forget Password');
                        $this->email->message($body);

                        $send_mail= $this->email->send();
                        echo "success";
				

			}else{

                echo "Please Fill Right Email ID";	
			}

		}else{

            echo "Please enter your registered Email ID ";
		}
	}

    public function cancle()
	{
		$this->session->unset_userdata('forgot_key');
		return redirect('Account');
	}

	public function log_out()
	{
		$this->session->unset_userdata('id');
        //$this->session->unset_userdata('id');
		return redirect('home');
	}
       
	public function profile()
	{
       //public $user_data;
		$id = $this->session->userdata( 'id' );

        $state_data = $this->User_model->get_state();
       
		  $user_data  = $this->User_model->find_profile( $id );
        if(!$this->session->userdata( 'id' ))
            return redirect('home');
      $this->load->view( 'account/user_profile' , [ 'user_data' => $user_data ,'state'=> $state_data] );
      
	}

    // public function get_city(){
        
    //     $id = $this->session->userdata( 'id' );
    //     $user_data  = $this->User_model->find_profile( $id );
    //     $state_id =  $this->input->post('state_id');
    //      $city_data = $this->User_model->get_city( $state_id );
    //   $cityData['cities'] = $city_data;
    //   $userData['user_data'] = $user_data;
      
    //   $city_user_data = array_merge($cityData,$userData);
    //   echo  json_encode($city_user_data);die();
        
    // }
    
    // 
    
//SAVE PROFILE CONTROLLER
     public function user_profile_save()
     {
             
            $user_id              = $this->session->userdata('id');
            $first_name           = $this->input->post('first_name');
            $last_name            = $this->input->post('last_name'); 
            $mobile_number        = $this->input->post('mobile_number');
            $email_id             = $this->input->post('email_id'); 
            $gender               = $this->input->post('gender');
            $nationality          = $this->input->post('nationality');
            $date_of_birth        = date('Y/m/d',strtotime($this->input->post('date_of_birth')));
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


//FILES UPLOADS PROFILE PIC START
            //echo "save"; die();

            if($_FILES['profile_pic']['name'] !="")
              {                    //echo $_FILES['profile_pic']['name'];die();
                    $config['upload_path']   = './assets/upload/profile_pic/';
                    $config['allowed_types'] =     'gif|jpg|png|jpeg';
                    //$config['max_size']      = '2048';
                    //$config['max_width']     = '1024';
                    //$config['max_height']    = '768';
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload("profile_pic"))
                    {
                        //echo "frofile img error"; die();

                      $this->session->set_flashdata('error',$this->upload->display_errors());
                      $this->session->set_flashdata('feedback_class','alert-danger');
                        //$error = array('error' => $this->upload->display_errors());
                    }
                    else
                    {
                        //echo "frofile img"; die();
                        $upload_data             = $this->upload->data();
                        $config['image_library'] ='gd2';
                        $config['source_image']  ='./assets/upload/profile_pic/'.$upload_data['file_name'];
                        $config['create_thumb']  = FALSE;
                        $config['maintain_ratio']= FALSE;
                        $config['quality']       = '60%';
                        $config['width']         = 600;
                        $config['height']        = 400;
                        $config['new_image']     = './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                         
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

            }else{
             $preferred_city     = $this->input->post('preferred_cities');
             $pref_city          = implode(',', $preferred_city );

            }
            if($this->input->post('know_languages')==''){

            }else{
              $known_lang         = $this->input->post('know_languages');
              $know_langs        = implode(',', $known_lang );
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
              'status'              =>  $status 

            );
            //print_r($data_user_profile);

          $this->User_model->user_update( $user_id, $data_user );

          $profile_id = $this->User_model->check_user_id( $user_id );

          if($profile_id){
             
            
            $result = $this->User_model->user_profile_update( $profile_id, $data_user_profile );
            $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");
                if($result){

                  $this->session->set_flashdata('error','Profile Successfully Update.');
                  $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('profile');

                }else{

                  $this->session->set_flashdata('error','Profile Data Failt Update.');
                  $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }

          }else{
             
              $result = $this->User_model->user_profile_insert($data_user_profile);

                if($result){

                  $this->session->set_flashdata('error','Profile Data Successfully Inserted.');
                  $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('profile');

                }else{

                  $this->session->set_flashdata('error','Profile Data Failt Insartion.');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }
          }

        }
//SAVE PROFILE CONTROLLER
//DONE PROFILE
public function user_profile_done()
        {
           
          if($this->form_validation->run('user_profile_rule')){
            
            $user_id              = $this->session->userdata('id');
            $first_name           = $this->input->post('first_name');
            $last_name            = $this->input->post('last_name'); 
            $mobile_number        = $this->input->post('mobile_number');
            $email_id             = $this->input->post('email_id'); 
            $gender               = $this->input->post('gender');
            $nationality          = $this->input->post('nationality');
            //$date_of_birth        = $this->input->post('date_of_birth');
            $date_of_birth        = date('Y/m/d',strtotime($this->input->post('date_of_birth')));
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
                        $config['quality']= '60%';
                        $config['width']= 600;
                        $config['height']= 400;
                        $config['new_image']= './assets/upload/profile_pic/'.$upload_data['file_name'];
                        $this->load->library('image_lib', $config);
                        $this->image_lib->resize();
                        
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
              'host_before'         =>  $host_before,
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
             'status'              =>  $status 
            );
            $data_done_user = array(
                  'host_first_name' =>  $first_name,
                  'host_last_name'  =>  $last_name,
                  'host_mob_no'     =>  $mobile_number

            );

          $this->User_model->user_update( $user_id, $data_done_user );
            //print_r($data_user_profile_done); die();
            $profile_id = $this->User_model->check_user_id($user_id);

        if($profile_id){
            
            $result = $this->User_model->user_profile_update($profile_id,$data_user_profile_done);
            $this->form_validation->set_error_delimiters("<p class='text-danger'>","</p>");

                if($result){

                  //$this->session->set_flashdata('error','Profile Successfully Done.');
                   //$this->session->set_flashdata('feedback_class','alert-success');
                    $this->session->set_userdata('user_status',$status,'60' );
                   //$this->session->unset_userdata('user_status');
                  return redirect('itineraries');


                }else{

                  $this->session->set_flashdata('error','Profile Data Failt Update.');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }

        }else{
             
              $result = $this->User_model->user_profile_insert($data_user_profile_done);

                if($result){

                  $this->session->set_flashdata('error','Profile Data Successfully Inserted.');
                   $this->session->set_flashdata('feedback_class','alert-success');
                  return redirect('profile');

                }else{

                  $this->session->set_flashdata('error','Profile Data Failt Insartion.');
                   $this->session->set_flashdata('feedback_class','alert-danger');
                  return redirect('profile');

                }
          }

          }else{
             
            $this->session->set_flashdata('error',validation_errors());
            //$this->session->set_flashdata('error','Please Fill All The Fields For Complete The Profile');
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
}
?>
