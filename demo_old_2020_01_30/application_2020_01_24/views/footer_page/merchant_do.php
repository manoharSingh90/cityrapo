<?php

/*include 'Utility.php';
$utility = new Utility();
$config = $utility->config;

$enckey = $config['ENC_KEY'];
$SECURE_SECRET = $config['SECURE_SECRET'];
$gateWayURL = $config['GATEWAY_URL'];
$debug = $config['DEBUG_FLAG'];

// get inputs
$data = $_POST;

$data['vpc_Version'] = $config['VERSION'];
$data['vpc_AccessCode'] = $config['MERCHANT_ACCESS_CODE'];
$data['vpc_MerchantId'] = $config['MERCHANT_ID'];
$data['vpc_ReturnURL'] = $config['RETURN_URL'];

//Remove inprocess (submit button)
unset($data["inprocess"]);

//------- sort on keys
ksort($data);

$str = $SECURE_SECRET;
$dataToPostToPG = "";
foreach($data as $key => $val)
{
	$str = $str . $val;
	$dataToPostToPG .= $key."=".$val."::";
}
//Remove lat ::
$pos = strrpos($dataToPostToPG, "::");
if($pos !== false)
{
	$dataToPostToPG = substr_replace($dataToPostToPG, "", $pos, strlen("::"));	
}

$SecureHash = hash('sha256', utf8_encode($str));
$dataToPostToPG="vpc_SecureHash=".$SecureHash."::".$dataToPostToPG;

$ciphertext_base64=$utility->encrypt($dataToPostToPG, $enckey);

if($debug)
{
	echo "<pre>"; //------- readable format output
	echo "<br>......... String to calculate Secure Hash ..........<br>";
	print_r($str);

	echo "<br>......... Secure Hash ..........<br>";
	print_r($SecureHash);

	echo "<br>......... Data To Post to PG ..........<br>";
	print_r($dataToPostToPG);

	echo "<br>......... Encrypted data to Post to PG ..........<br>";
	print_r($ciphertext_base64);
	
}	
*/

?>

<!-- Send data to payment gateway-->
<form name="server_request" action="<?php echo $gateWayURL ?>" method="post" accept-charset="ISO-8859-1" align="center">
    
	<input type="hidden" name="vpc_MerchantId" id="vpc_MerchantId" value="<?php echo $data["vpc_MerchantId"] ; ?>" > 							
    <input type="hidden" name="EncData" id="EncData" value="<?php echo $ciphertext_base64; ?>" > 
	
</form>

<script type="text/javascript">
 document.server_request.submit(); 
</script>