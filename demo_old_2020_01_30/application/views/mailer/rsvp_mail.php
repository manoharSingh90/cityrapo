<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>City Explorers</title>
</head>

<body style="background: #fff;">
<table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
  <tr>
    <td><table cellpadding="0" cellspacing="0" style="width: 720px; background: #fff; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
        <tr>
          <td width="30"></td>
          <td width="660"></td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="20"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660"><img src="<?php echo base_url();?>assets/mailer_img/logo_org.png" width="267" height="48" alt="CityExplorers" style="display: block; border: none; max-width: 100%;"/></td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="20"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">Dear <?php if($status==0){echo $name;}if($status==1){echo 'Admin';}?>,</td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;">Someone has shown interest in the your itinerary. Please find the details below - </td>
          <td width="30"></td>
        </tr>
		<tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
        <td width="30"></td>
          <td width="660" style="color: #000; font-size: 14px; line-height: 1.75; font-family:Arial, Helvetica, sans-serif; margin: 0; padding: 0;">User Name :
            <strong style="text-transform: uppercase;">
              <?php echo $name;?>    
            </strong><br>
            User Email Id :
            <strong style="text-transform: lowercase;">
              <?php echo $email;?>    
            </strong><br>
            User Contact Number :
            <strong style="text-transform: uppercase;">
              <?php echo $phone_no;?>    
            </strong><br>
            Itinerary Url :
            <strong>
              <?php echo $currentUrl;?>    
            </strong><br>
			Itinerary Title -
			<strong>
              <?php echo $itineraryData[0]->itinerary_title;?>    
            </strong><br>
			Date-
			<strong>
              <?php echo $itineraryData[0]->start_date_from_host;?>    
            </strong><br>
			Time-
			<strong>
              <?php echo $itineraryData[0]->aviaiable_time_form_host;?>    
            </strong><br>
			
          </td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">Best Regards,<br>
            Team City Explorers</td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="20"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellpadding="0" cellspacing="0" background="#f9f9f9" style=" width:720px; margin: 0 auto; border: none; border-collapse: collapse; color: #888; background:#f9f9f9; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
        <tr>
          <td width="30" height="20"></td>
          <td width="660" height="20"></td>
          <td width="30" height="20"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;">Didn't request this email?<br>
            Please reach us as <a href="mailto:help@cityexplorers.in" target="_blank" style="color: #3c8aca; text-decoration: none;">help@cityexplorers.in</a> and we will rectify this error.</td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="20"></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><table cellpadding="0" cellspacing="0" style=" width:720px; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
        <tr bgcolor="#ee464c" valign="middle">
          <td colspan="3" height="15"></td>
        </tr>
        <tr bgcolor="#ee464c" valign="middle">
        <td colspan="3" style="font-family:Arial, Helvetica, sans-serif; padding:5px; color:#fff;" align="center">MOST AWARDED CITY SIGHTSEEING COMPANY IN INDIA</td>
   </tr>
        <tr bgcolor="#ee464c" valign="middle">
          <td colspan="3" height="15"></td>
        </tr>
        <tr bgcolor="#e0e0e0">
          <td colspan="3" style="color: #888; font-size: 12px; font-family:Arial, Helvetica, sans-serif; text-align:center; padding:10px;">This email is sent to Hosts and Admins of the City Explorers Portal</td>
        </tr>
        <tr>
          <td colspan="3" height="20"></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
