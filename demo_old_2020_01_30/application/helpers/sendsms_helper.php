<?php 
	//====== Send SMS for user mobile number function =========//
function sendSMS($mobileno, $messages){
	// Account details
	$apiKey = urlencode('wYrBr1dWl4I-X2v4i3HqIwFPRrxuKMZ61G6HeoQLOc');
	
	// Message details
	//$numbers = array(7982142067, 9720118113);
	$sender = urlencode('TXTLCL');
	$message = rawurlencode($messages);
 
	//$numbers = implode(',', $numbers);
 
	// Prepare data for POST request
	$data = array('apikey' => $apiKey, 'numbers' => $mobileno, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	//echo $response;
}
	?>