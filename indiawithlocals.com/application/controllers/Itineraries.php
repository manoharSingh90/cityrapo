<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Itineraries extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		 
	}
	public function index()
	{
		//echo "Itineraries";
		if($this->session->userdata('id'))
		$this->load->view("itineraries/itineraries");
	}

	public function create_itineraries()
	{
		$this->load->view("itineraries/create_itineraries");
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
        //echo $user_msg ;die();

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
                $leave['user_name']  = $user_name;
                $leave['user_email'] = $user_email;
                $leave['user_phone'] = $user_phone;
                $leave['user_msg']   = $user_msg;

                $body = $this->load->view('mailer/leave_mailer',$leave, true);
                        $this->load->library('email',$config);
                        $this->email->set_newline("\r\n");
                        $this->email->from('ask@iwl.help', 'India With Locals');
                        $this->email->to('sb@indiawithlocals.com');
                        $this->email->cc('ops1@indiawithlocals.com');
                        $this->email->bcc('ops@indiawithlocals.com,nidhi@indiacitywalks.com,info@indiacitywalks.com,bookings@indiacitywalks.com,sales@indiacitywalks.com');
                        $this->email->subject('Leave Message');
                        $this->email->message($body);
                       $this->email->send();


         echo "Msg Successfully sent"; die();
		//return redirect('home');	
	}
}
?>