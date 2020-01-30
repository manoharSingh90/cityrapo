<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

include 'Utility.php';
$utility = new Utility();
$config = $utility->config;

$enckey = $config['ENC_KEY'];
$SECURE_SECRET = $config['SECURE_SECRET'];
$gateWayURL = $config['GATEWAY_URL'];
$debug = $config['DEBUG_FLAG'];

$received_data = $_POST;

if(!$received_data || $received_data['EncDataResp'] == "")
{
	print "No response from PG";
	exit;
}	

if($debug)
{
	echo "<pre>"; //------- readable format output
	echo "<br/>......... Received Data..........<br/>";
	print_r($received_data);
}

$ciphertext_dec = "";
	
	$ciphertext_base64 = $received_data['EncDataResp'];
	
	$ciphertext_dec = $utility->decrypt($ciphertext_base64, $enckey);
	
	// remove last occurrence of ::
	$pos = strrpos($ciphertext_dec, "::");
    if($pos !== false){
        $ciphertext_dec = substr_replace($ciphertext_dec, "", $pos, strlen("::"));
    }


$array_data_string = "";
$array_data_string = explode("::", $ciphertext_dec);


$origial_array = array();
if($array_data_string){
	foreach($array_data_string as  $value){
		$temp_array = explode("||", $value);
		$origial_array[ $temp_array[0] ] = $temp_array[1];
	}
}

//echo '<pre>';print_r($origial_array);die;

if($debug)
{
	echo "<br/>----------- Original Data Array -----------<br>";
	print_r($origial_array);
}


// Get the hash sent by PG 
$received_hash= $origial_array["vpc_SecureHash"];
unset($origial_array["vpc_SecureHash"]);

//Calculate hash of parameters received from PG
ksort($origial_array);
if($origial_array){
	$str = $SECURE_SECRET;
	foreach($origial_array as $key => $val){
		$str = $str . $val;
	}
}

	$Cal_hash = hash('sha256', utf8_encode($str));

	$vpc_Version = $utility->null2unknown("vpc_Version",$origial_array);
	$vpc_Command = $utility->null2unknown("vpc_Command",$origial_array);
    $vpc_MerchTxnRef = $utility->null2unknown("vpc_MerchTxnRef",$origial_array);
    $vpc_Merchant = $utility->null2unknown("vpc_Merchant",$origial_array);
	$vpc_TxnResponseCode = $utility->null2unknown("vpc_TxnResponseCode",$origial_array);
    $vpc_AcqResponseCode = $utility->null2unknown("vpc_AcqResponseCode",$origial_array);
    $vpc_Message = $utility->null2unknown("vpc_Message",$origial_array);
    $vpc_Locale = $utility->null2unknown("vpc_Locale",$origial_array);
    $vpc_Amount = $utility->null2unknown("vpc_Amount",$origial_array);
    $vpc_OrderInfo = $utility->null2unknown("vpc_OrderInfo",$origial_array);
    $vpc_ReceiptNo = $utility->null2unknown("vpc_ReceiptNo",$origial_array);
    $vpc_Card = $utility->null2unknown("vpc_Card",$origial_array);
    $vpc_TransactionNo = $utility->null2unknown("vpc_TransactionNo",$origial_array);
    $vpc_BatchNo = $utility->null2unknown("vpc_BatchNo",$origial_array);
    $vpc_AuthorizeId = $utility->null2unknown("vpc_AuthorizeId",$origial_array);
    $vpc_VerSecurityLevel = $utility->null2unknown("vpc_VerSecurityLevel",$origial_array);
    $vpc_3DSXID = $utility->null2unknown("vpc_3DSXID",$origial_array);
    $vpc_3DSECI = $utility->null2unknown("vpc_3DSECI",$origial_array);
	$vpc_VerToken =$utility->null2unknown("vpc_VerToken",$origial_array);
	$vpc_3DSenrolled= $utility->null2unknown("vpc_3DSenrolled",$origial_array);
	$vpc_3DSstatus= $utility->null2unknown("vpc_3DSstatus",$origial_array);
	$vpc_VerStatus= $utility->null2unknown("vpc_VerStatus",$origial_array);
	$vpc_VerType= $utility->null2unknown("vpc_VerType",$origial_array);
	$vpc_Currency= $utility->null2unknown("vpc_Currency",$origial_array);
	$vpc_AcqCSCRespCode= $utility->null2unknown("vpc_AcqCSCRespCode",$origial_array);
	$vpc_CSCResultCode= $utility->null2unknown("vpc_CSCResultCode",$origial_array);
	$vpc_TxnResponseCode_desc ="0";
	$vpc_CSCResultCode_desc= $utility->displayCSCResponse($vpc_CSCResultCode);
	$vpc_CSCRequestCode= $utility->null2unknown("vpc_CSCRequestCode",$origial_array);
	$vpc_VerStatus_desc=$utility->getStatusDescription($vpc_VerStatus, $vpc_CSCResultCode);
	
	
	$hashValidated=$utility->validate_hash($Cal_hash,$received_hash);
	
	switch ($vpc_TxnResponseCode){
	case "Aborted":
		$vpc_TxnResponseCode_desc = "Transaction Aborted";
		break;
	case "0":
		$vpc_TxnResponseCode_desc= "No Value Returned";
		break;
	}
	
   ?>
   
   <!-- Start Branding Table -->
    <table width='100%' border='2' cellpadding='2' bgcolor='#C1C1C1'><tr><td bgcolor='#E1E1E1' width='90%'><h2 class='co'>&nbsp;Merchant Response</h2></td><td bgcolor='#C1C1C1' align='center'><h3 class='co'>Merchant Response</h3></td></tr></table>
    <!-- End Branding Table -->

    <TABLE width="85%" align='center' cellpadding='5' border='0'>

        <tr bgcolor="#C1C1C1">
            <td colspan="2" height="25"><p><strong>&nbsp;Standard Transaction Fields</strong></p></td>
        </tr>
        <tr>
            <td align='right' width='50%'><strong><i>VPC API Version: </i></strong></td>
            <td width='50%'><?php echo $vpc_Version?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Command: </i></strong></td>
            <td><?php echo $vpc_Command?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Merchant Transaction Reference: </i></strong></td>
            <td><?php echo $vpc_MerchTxnRef?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Merchant ID: </i></strong></td>
            <td><?php echo $vpc_Merchant?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Order Information: </i></strong></td>
            <td><?php echo $vpc_OrderInfo ?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Transaction Amount: </i></strong></td>
            <td><?php echo $vpc_Amount?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Locale: </i></strong></td>
            <td><?php echo $vpc_Locale?></td>
        </tr>
		<tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Currency: </i></strong></td>
            <td><?php echo $vpc_Currency?></td>
        </tr>

        <tr>
            <td colspan='2' align='center'><font color='#C1C1C1'>Fields above are the request values returned.<br></font><HR>
            </td>
        </tr>

        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>VPC Transaction Response Code: </i></strong></td>
            <td><?php echo $vpc_TxnResponseCode?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Transaction Response Code Description: </i></strong></td>
            <td><?php echo $vpc_TxnResponseCode_desc ?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Message: </i></strong></td>
            <td><?php echo $vpc_Message?></td>
        </tr>

        <tr>
            <td align='right'><strong><i>Receipt Number: </i></strong></td>
            <td><?php echo $vpc_ReceiptNo?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Transaction Number: </i></strong></td>
            <td><?php echo $vpc_TransactionNo?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Acquirer Response Code: </i></strong></td>
            <td><?php echo $vpc_AcqResponseCode ?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Bank Authorization ID: </i></strong></td>
            <td><?php echo $vpc_AuthorizeId?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Batch Number: </i></strong></td>
            <td><?php echo $vpc_BatchNo?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Card Type: </i></strong></td>
            <td><?php echo $vpc_Card?></td>
        </tr>

        <tr>
            <td colspan='2' align='center'><font color='#C1C1C1'>Fields above are for a standard transaction.<br><HR>
                Fields below are additional fields for extra functionality.</font><br></td>
        </tr>

        <tr bgcolor="#C1C1C1">
            <td colspan="2" height="25"><p><strong>&nbsp;Card Security Code Fields</strong></p></td>
        </tr>
        <tr>
            <td align='right'><strong><i>CSC Request Code: </i></strong></td>
            <td><?php echo $vpc_CSCRequestCode?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>CSC Acquirer Response Code: </i></strong></td>
            <td><?php echo $vpc_AcqCSCRespCode?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>CSC QSI Result Code: </i></strong></td>
            <td><?php echo $vpc_CSCResultCode?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>CSC Result Description: </i></strong></td>
            <td><?php echo $vpc_CSCResultCode_desc?></td>
        </tr>

        <tr><td colspan = '2'><HR></td></tr>

        <tr bgcolor="#C1C1C1">
            <td colspan="2" height="25"><p><strong>&nbsp;3-D Secure Authentication Fields</strong></p></td>
        </tr>
        <tr>
            <td align='right'><i><strong>Authentication Version</strong><br>(3DS - Visa or MasterCard, SPA - MasterCard Only): </i></td>
            <td class='red'><?php echo $vpc_VerType?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Authentication Status: </i></strong></td>
            <td class='red'><?php echo $vpc_VerStatus?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Authentication Token: </i></strong></td>
            <td class='red'><?php echo $vpc_VerToken?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Authentication XID: </i></strong></td>
            <td class='red'><?php echo $vpc_3DSXID?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Authentication ECI: </i></strong></td>
            <td class='red'><?php echo $vpc_3DSECI?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Authentication Enrolled: </i></strong></td>
            <td class='red'><?php echo $vpc_3DSenrolled?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Authentication 3DS Status: </i></strong></td>
            <td class='red'><?php echo $vpc_3DSstatus?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><strong><i>Authentication Security Level: </i></strong></td>
            <td class='red'><?php echo $vpc_VerSecurityLevel?></td>
        </tr>
        <tr>
            <td align='right'><strong><i>Payment Server 3DS Authentication Status Code: </i></strong></td>
            <td class='green'><?php echo $vpc_VerStatus?></td>
        </tr>
        <tr bgcolor='#E1E1E1'>
            <td align='right'><i><strong>3DS Authentication Status Code Description: </strong></i></td>
            <td class='green'><?php echo $vpc_VerStatus_desc?></td>
        </tr>
        <tr>
            <td colspan='2' align='center'><font color='#FF0066'><br>The 3-D Secure values shown in red are those values that are important values to store in case of future transaction repudiation.</font></td>
        </tr>
        <tr>
            <td colspan='2' align='center'><font color='#00AA00'>The 3-D Secure values shown in green are for informartion only and are not required to be stored.</font></td>
        </tr>

        <tr>
            <td colspan = '2'><HR></td>
        </tr>

        <tr bgcolor="#C1C1C1">
            <td colspan="2" height="25"><p><strong>&nbsp;Hash Validation</strong></p></td>
        </tr>
        <tr>
            <td align="right"><strong><i>Hash Validated Correctly: </i></strong></td>
            <td><?php echo $hashValidated?></td>
        </tr>

</TABLE><br>

   
