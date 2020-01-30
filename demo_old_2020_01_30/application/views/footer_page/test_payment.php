<html>
<head>
<title>CCAvenue Payment</title>
</head>
<body>
	
<center>

<!-- <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->
<!-- <form method="post" id="CCAvenueX" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->
	
<?php /*
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>"; 
                
</form>*/ ?>
</center>

<?php //echo $access_code;?>
<?php //echo "<pre>";print_r($encrypted_data);?>
<form method="post" name="customerData" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<table width="40%" height="100" border='1' align="center"><caption><font size="4" color="blue"><b>CCAVENUE PAYMENT GATEWAY</b></font></caption></table>
<table width="40%" height="100" border='1' align="center">
<tr>
<td>Parameter Name:</td><td>Parameter Value:</td>
</tr>
<tr>
<td colspan="2"> Compulsory information</td>
</tr>
<tr>
<td>Transaction ID :</td><td><input type="text" name="tid" id="tid" readonly /></td>
</tr>
<tr>
<td>Currency :</td><td><input type="text"  name="currency" value="INR"/></td>
</tr>
<tr>
<td>Language :</td><td><input type="text" name="language" value="EN"/></td>
 </tr>
<input type="hidden" name="billing_name" value="<?php echo 'Ankush';?>"/>
<input type="hidden" name="product_id" value="<?php echo 'ITI-888';?>"/></td>
<input type="hidden" name="billing_address" value='cityexplorers'/></td>
<input type="hidden" name="billing_city" value='Delhi'/></td>
<input type="hidden" name="billing_state" value='Delhi'/></td>
<input type="hidden" name="billing_zip" value='11096'/></td>
<input type="hidden" name="billing_country" value="India"/></td>
<input type="hidden" name="billing_tel" value="<?php echo '9874521310';?>"/></td>
<input type="hidden" name="billing_email" value="<?php echo 'manohar@unikove.com';?>"/></td>
<input type="hidden" name="delivery_name" value='ankush'/></td>
<input type="hidden" name="delivery_address" value='Delhi'/></td>
<input type="hidden" name="delivery_city" value='Delhi'/></td>
<input type="hidden" name="delivery_state" value='Delhi'/></td>
<input type="hidden" name="delivery_zip" value='110096'/></td>
<input type="hidden" name="delivery_country" value="India"/></td>
<input type="hidden" name="delivery_tel" value="<?php echo '9874521310';?>"/></td>

<input type="hidden" name="customer_identifier" value=""/></td>
<tr>
<td></td><td><input type="submit" value="CheckOut"></td>
</tr>
<input type="hidden"  name="integration_type" value="iframe_normal"/>
<input type="hidden" name="redirect_url" value="<?= $encrypted_data['redirect_url']?>"/>
<input type="hidden" name="cancel_url" value="<?= $encrypted_data['cancel_url']?>"/>
</table>
</form>



<script language='javascript'>document.redirect.submit();</script>
</body>
</html>