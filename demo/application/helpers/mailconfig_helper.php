<?php 

function sendMail($to,$subject,$message,$cc='')
{
	//echo "hdfgsdhdgjh";die;
	$CI =& get_instance();
	$CI->load->library('email');
	$CI->email->initialize(array(
		 /*'protocol' => 'smtp',
		 'smtp_host' => 'smtp.sendgrid.net',
		 'smtp_user' => 'vimlesh@',
		 'smtp_pass' => 'vimlesh@123',
		 'smtp_port' => 587,
		 'crlf' => "\r\n",
		 'newline' => "\r\n"*/
		 'protocol' => 'smtp',							
		 'smtp_host' => 'ssl://smtp.gmail.com',
		 'smtp_port' => 465,							
		 'smtp_user' =>'donotreply@wealthveda.com',							
		 'smtp_pass' => 'rijkdom@125',
		 'mailtype'  => 'html', 
		 'charset'   => 'iso-8859-1'
	   ));
			   
	$CI->email->from(FROMMAIL,COMPANYNAME);
	$CI->email->to($to);
	if($cc)
		$CI->email->cc($cc);
	$CI->email->set_mailtype("html");
	$CI->email->subject($subject);
	$CI->email->message($message);
    if($CI->email->send()) 
		return true;
	else
		return false;
	//echo $CI->email->print_debugger();
}