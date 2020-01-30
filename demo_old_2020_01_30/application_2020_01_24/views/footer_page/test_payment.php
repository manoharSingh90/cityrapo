<html>
<head>
<title>CCAvenue Payment</title>
</head>
<body>
	
<center>

<!-- <form method="post" name="redirect" action="https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction"> -->
<form method="post" id="CCAvenueX" name="redirect" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
	
<?php
echo "<input type=hidden name=encRequest value=$encrypted_data>";
echo "<input type=hidden name=access_code value=$access_code>"; ?>
                
</form>
</center>


<!-- <form id="ccavenue" method="post" action="https://test.ccavenue.com/transaction/transaction.do?command=initiateTransaction">
<input type=hidden name="Merchant_Id" value="155164">
<input type="hidden" name="Amount" value="100">
<input type="hidden" name="Order_Id" value="IWL-1515">
<input type="hidden" name="Redirect_Url" value="<?php SITEURL."thanks/$booking_id" ?>">
<input type="hidden" name="TxnType" value="A">
<input type="hidden" name="ActionID" value="TXN">
<input type="hidden" name="Checksum" value="<?php echo $Checksum; ?>">
<input type="hidden" name="billing_cust_name" value="name of user">
<input type="hidden" name="billing_cust_address" value="address of user">
<input type="hidden" name="billing_cust_country" value="user country">
<input type="hidden" name="billing_cust_state" value="state of user">
<input type="hidden" name="billing_cust_city" value="city">
<input type="hidden" name="billing_zip" value="zip/pin code">
<input type="hidden" name="billing_cust_tel" value="telphone no">
<input type="hidden" name="billing_cust_email" value="emailid">
<input type="hidden" name="delivery_cust_name" value="user name">
<input type="hidden" name="delivery_cust_address" value="delivering address">
<input type="hidden" name="delivery_cust_country" value="delivering country">
<input type="hidden" name="delivery_cust_state" value="delivering state">
<input type="hidden" name="delivery_cust_tel" value="telphone no">
<input type="hidden" name="delivery_cust_notes" value="this is a test">
<input type="hidden" name="Merchant_Param" value="">
<input type="hidden" name="billing_zip_code" value="zip/pin">
<input type="hidden" name="delivery_cust_city" value="city">
<input type="submit" value="Buy Now" />
</form> -->
<script language='javascript'>document.redirect.submit();</script>
</body>
</html>