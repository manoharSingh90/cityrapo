<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>City Explorers</title>
</head>

<body style="background: #fff;">
<table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
  <tr>
    <td>
      <table cellpadding="0" cellspacing="0" style="width: 720px; background: #fff; margin: 0 auto; border: none; border-collapse: collapse; color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; background-image: url(mailer_img/bg.png); background-repeat: no-repeat; background-position: right top;">
        <tr>
          <td style="width: 10px;"></td>
          <td style="width: 290px;"></td>
          <td style="width: 290px;"></td>
          <td style="width: 10px;"></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?= base_url('assets/mailer_img/header.png');?>" alt="City Explorers" style="display: block; border: none; max-width: 100%;"/></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="4">
            <p style="color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Hi <?php echo $name?>,</p>
            <br>
            <p style="color: #000; font-size: 22px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Welcome to City Explorers</p>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 14px; line-height: 1.5; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Your new OTP is:<br/>
            <strong style="color: #ee474c; text-transform: uppercase; font-size:18px;"><?php echo $value ;?></strong></td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="font-style: italic; color: #999; font-size: 80%;">(This OTP will expire in the next 24 hours. Once expired, you will have to enter registration details again)</td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 20px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 16px; line-height: 1.5; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Regards,<br>
            City Explorers </td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 20px;"></td>
        </tr>
      </table>
    </td>
  </tr>
  <tr style="background: #f4f4f4;">
    <td>
      <table cellpadding="0" cellspacing="0" style=" width:720px; margin: 0 auto; background: #f4f4f4; margin: 0 auto; border: none; border-collapse: collapse; color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="3" style="color: #666; font-size: 12px; line-height: 1.5; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Didn’t request this email?<br>
            Please reach us as <a href="mailto:help@iwl.com" target="_blank" style="color: #3c8aca; text-decoration: none;">help@iwl.com</a> and we will rectify this error.</td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td colspan="4">
            <hr style="height: 1px; border: 0; border-top: 1px solid #ddd; display: block; ">
          </td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td colspan="4"  style="color: #666; font-size: 12px; line-height: 1.5; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0; text-align: center;">This email is sent to Hosts and Admins of the City Explorers Portal<br>
            <a href="#" target="_blank" style="color: #3c8aca; text-decoration: none;">City Explorers</a> •  <a href="#" target="_blank" style="color: #3c8aca; text-decoration: none;">About Us</a><br>
            <a href="mailto:info@iwl.com" target="_blank" style="color: #3c8aca; text-decoration: none;">info@iwl.com</a>  •  <a href="mailto:info@iwl.com" target="_blank" style="color: #3c8aca; text-decoration: none;">1800 626 7070</a></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
