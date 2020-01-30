<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>City Explorers</title>
</head>

<body style="background: #fff;">
<table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
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
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">Dear <?php echo $name?>,</td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;">We have received a request to reset the password for your City Explorers account. </td>
          <td width="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">If you have not made this request, please ignore this email. Else, please click on the button below to reset your password - </td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td  width="660"><a href="<?php echo base_url();?>reset_password?userid='<?php echo base64_encode($data[0]->id);?>'&useremail='<?php echo base64_encode($data[0]->host_email);?>'&exp_time='<?php echo base64_encode($exp_pass_time);?>'" style=" padding:10px 15px; text-align:center; border:1px solid #1a1a1a; color:#fff; font-size:12px; text-transform:uppercase; font-weight:bold; background:#3d8ac9; text-decoration:none;">Password Reset</a></td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">If you are not able to click on the above button then copy the link below & paste in your web browser - </td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="15"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif; color:#3d8ac9;"><a href="<?php echo base_url();?>reset_password?userid=<?php echo base64_encode($data[0]->id);?>&useremail=<?php echo base64_encode($data[0]->host_email);?>&exp_time=<?php echo base64_encode($exp_pass_time);?>"><?php echo base_url();?>reset_password?userid=<?php echo base64_encode($data[0]->id);?>&useremail=<?php echo base64_encode($data[0]->host_email);?>&exp_time=<?php echo base64_encode($exp_pass_time);?></td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="10"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #aaa; font-size: 12px; font-family:Arial, Helvetica, sans-serif;"><em>The link will expire in next 24 hours and can only be used once.</em></td>
          <td width="30"></td>
        </tr>
        <tr>
          <td colspan="3" height="30"></td>
        </tr>
        <tr>
          <td width="30"></td>
          <td width="660" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">Feel free to get in touch with us or reply to this email for any concerns.</td>
          <td width="30"></td>
        </tr>
                <tr>
          <td colspan="3" height="10"></td>
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
          <td width="240" style="font-family:Arial, Helvetica, sans-serif; padding:5px; border-right:1px solid #f77075;" align="center" ><a href="#" style="color:#fff; text-transform:uppercase; text-decoration:none; font-weight:bold; font-size:12px;">About Us</a></td>
          <td width="240" style="font-family:Arial, Helvetica, sans-serif;padding:5px;" align="center"><a href="#" style="color:#fff; text-transform:uppercase;  text-decoration:none;font-weight:bold; font-size:12px;">info@cityexplorers.in</a></td>
          <td width="240" style="font-family:Arial, Helvetica, sans-serif;padding:5px; border-left:1px solid #f77075;" align="center"><a href="#" style="color:#fff; text-transform:uppercase; text-decoration:none;  font-weight:bold; font-size:12px;">1800 2883 82876</a></td>
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
