<form class="hidden" name="redirect" action="<?php echo base_url();?>Booking/merchant_do" method="post" accept-charset="ISO-8859-1">

        <center> Merchant Test Page (for DCC)</center>

        <!-- get user input -->
        <table width="80%" align="center" border="0" cellpadding='0' cellspacing='0'>

            <tr>
                <td colspan="2">&nbsp;<hr width="75%">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2" height="25"><p><strong>&nbsp;Merchant Data </strong></p></td>
            </tr>
 
<tr>
       
        <td align="right"><strong><em>Command Type: </em></strong></td>
        <td><input type="text" name="vpc_Command" value="pay" size="20" maxlength="16"/></td>
    </tr>
            <tr >
                <td align="right"><strong><em>Merchant Transaction Reference: </em></strong></td>
                <td><input name="vpc_MerchTxnRef" value="<?php echo $booking_id;?>" size="20" maxlength="40"/></td>
            </tr>
            <tr>
                <td align="right"><strong><em>Transaction OrderInfo: </em></strong></td>
                <td><input name="vpc_OrderInfo" value="<?php echo $infoData;?>" size="20" maxlength="34"/></td>
            </tr>
            <tr>
                <td align="right"><strong><em>Purchase Amount: </em></strong></td>
                <td><input name="vpc_Amount" value="<?php echo $amountData;?>" maxlength="10"/></td>
            </tr>
	    <tr>
		<td colspan=2><hr></td>
	    </tr>
         <tr> <td colspan="2">&nbsp;</td></tr>
          <tr><td colspan="2">&nbsp;<hr width="75%">&nbsp;</td></tr>
		 <tr>
          <td>&nbsp;</td>
          <td> <input type="submit" id="inprocess" name="inprocess" value="Submit" class="button"/>
           </td>
           </tr>
        </table>

    </form>
<script language='javascript'>document.redirect.submit();</script>