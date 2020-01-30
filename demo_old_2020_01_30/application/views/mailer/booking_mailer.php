<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>India with locals</title>
</head>

<body style="background: #fff;">
<table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
  <tr>
    <td>
      <table cellpadding="0" cellspacing="0" style="width: 720px; background: #fff; margin: 0 auto; border: none; border-collapse: collapse; color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; background-image: url("<?= 
        base_url('assets/mailer_img/bg.png')?>); background-repeat: no-repeat; background-position: right top;">
        <tr>
          <td style="width: 10px;"></td>
          <td style="width: 290px;"></td>
          <td style="width: 290px;"></td>
          <td style="width: 10px;"></td>
        </tr>
        <tr>
          <td colspan="4"><img src="<?= base_url('assets/mailer_img/header.png')?>" alt="india with locals" style="display: block; border: none; max-width: 100%;"/></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="4">
            <p style="color: #000; font-size: 16px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Hi <?php echo $name1 ?>,</p>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 14px; line-height: 1.5; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong style="text-transform: uppercase; font-size: 14px;"><img src="<?= base_url('assets/mailer_img/icon-confirmed.png') ?>" style="display: inline-block; vertical-align: middle; border: none; max-width: 100%;" alt="#"/> Booking Confirmed</strong></td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 4px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 13px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Your payment has been received and your booking has been confirmed.<br>
            Your booking ID is:<br>
            <strong style=" color: #ee474c;"><?php echo $booking_id?></strong> </td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong style="text-transform: uppercase; font-size: 12px;"><?php echo $itinerary_title ?></strong></td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 4px;"></td>
        </tr>
        <!-- <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">
            <div style="display: inline-block; vertical-align: middle;color: #999; font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">
              <span style="display: inline-block; vertical-align: middle; width: 40px; height: 40px; border-radius: 50%; overflow: hidden; background: #ccc;">
                <img src="<?= base_url('assets/mailer_img/placeholder.jpg')?>" style="display: block; border: none; max-width: 100%; " alt="#"/>
              </span>
               </div>
               
               <?php echo $hoster_name?>
               </div>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="mailto:travelswithnalina@gmail.com" target="_blank" style="color: #3c8aca; text-decoration: none;"><img src="<?= base_url('assets/mailer_img/icon-mail-blue.png')?>" style="display: inline-block; vertical-align: middle; border: none;" alt="#"/> <?php echo $hoster_email;?></a> &nbsp; &nbsp; &nbsp;&nbsp; <a href="#" target="_blank" style="color: #3c8aca; text-decoration: none;"><img src="<?= base_url('assets/mailer_img/icon-call-blue.png')?>" style="display: inline-block; vertical-align: middle; border: none; " alt="#"/> <?php echo $host_mob_num ?></a></td>
          <td style="width: 30px;"></td>
        </tr> -->
        <tr>
          <td colspan="4" style="padding: 10px;"></td>
        </tr>
        <tr>
          <td colspan="4">
            <table cellpadding="0" cellspacing="0" style=" width:650px; margin: 0 auto; background: #fff; margin: 0 auto; border: none;   border: 1px solid #f9f9f9; box-shadow: 0 0 8px rgba(0,0,0,.15);  color: #a2a1a1; font-size: 12px; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
              <tr>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
                <td style="padding: 10px;"></td>
              </tr>
              <tr>
                <td style="width: 15px"></td>
                <td colspan="2" style="color: #000; font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong>Your Itinerary</strong></td>
                <td style="width: 15px"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <td colspan="2" style="font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong><img src="<?= base_url('assets/mailer_img/icon-location.png')?>" style="display: inline-block; vertical-align: middle; border: none;" alt="#"/><?php echo $origin_citys;?></strong><br>
                  <p style="margin: 0; padding: 0;"><strong><img src="<?= base_url('assets/mailer_img/icon-date.png')?>" style="display: inline-block; vertical-align: middle; border: none;" alt="#"/><?php echo $booking_date?> &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $book_time_slotes;?></strong></p>
                </td>
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 10px;"></td>
              </tr>
              <!-- <tr>
                <td style="width: 30px"></td>
                <td><img src="<?= base_url('assets/mailer_img/icon-timeline.png')?>" style="display: block; margin: 0 auto;  border: none;" alt="#"/></td>
                <td style=" font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0; vertical-align: top;"><strong style="color: #000;">Pick up from HKV Metro Stations Gate 1</strong> &nbsp;&nbsp; <strong style="color: #ee474c; float: right;">4:00 PM</strong>
                  <p style="padding: 0; margin: 0;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.</p>
                </td>
                <td style="width: 30px"></td>
              </tr> -->
              <!-- <tr>
                <td style="width: 30px"></td>
                <td><img src="<?= base_url('assets/mailer_img/icon-timeline.png')?>" style="display: block;margin: 0 auto;  border: none;" alt="#"/></td>
                <td style=" font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0; vertical-align: top;"><strong style="color: #000;">Pick up from HKV Metro Stations Gate 1</strong> &nbsp;&nbsp; <strong style="color: #ee474c; float: right;">4:00 PM</strong>
                  <p style="padding: 0; margin: 0;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.</p>
                </td>
                <td style="width: 30px"></td>
              </tr> -->
              <!-- <tr>
                <td style="width: 30px"></td>
                <td><img src="<?= base_url('assets/mailer_img/icon-timeline.png')?>" style="display: block; margin: 0 auto; border: none;" alt="#"/></td>
                <td style=" font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0; vertical-align: top;"><strong style="color: #000;">Pick up from HKV Metro Stations Gate 1</strong> &nbsp;&nbsp; <strong style="color: #ee474c; float: right;">4:00 PM</strong>
                  <p style="padding: 0; margin: 0;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.</p>
                </td>
                <td style="width: 30px"></td>
              </tr> -->
              <!-- <tr>
                <td style="width: 30px"></td>
                <td><img src="<?= base_url('assets/mailer_img/icon-timelinelast.png')?>" style="display: block; margin: 0 auto;  border: none;" alt="#"/></td>
                <td style=" font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0; vertical-align: top;"><strong style="color: #000;">Drop Off at Green Park Market</strong> &nbsp;&nbsp; <strong style="color: #ee474c; float: right;">10:00 PM</strong>
                  <p style="padding: 0; margin: 0;">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas.</p>
                </td>
                <td style="width: 30px"></td>
              </tr> -->
              <tr>
                <td colspan="4" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td style="width: 15px;"></td>
                <td colspan="2" style="color: #000; font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong>Payment & Traveller Details</strong></td>
                <td style="width: 15px;"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <td colspan="2" style="font-size: 12px; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong style="color: #ef4447;"><?php echo $itinerary_type?></strong></td>
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <td colspan="2" style="font-size: 12px; color: #555; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong  style="font-weight: normal;">Traveller 1</strong><br>
                  <p style="margin: 0; padding: 0;"><strong style="font-weight: normal;"><?php echo $main_traveller_name?></strong>&nbsp;&nbsp;&nbsp;&nbsp; <strong style="font-weight: normal;"><img src="<?= base_url('assets/mailer_img/icon-mail.png')?>" style="display: inline-block; vertical-align: middle; border: none; " alt="#"/> <?php echo $traveller_email?></strong> &nbsp;&nbsp;&nbsp;&nbsp; <strong style="font-weight: normal;"><img src="<?= base_url('assets/mailer_img/icon-call.png')?>" style="display: inline-block; vertical-align: middle; border: none; " alt="#"/> +91 <?php echo $traveller_phone_no?></strong></p>
                  <strong style="font-size: 14px; color: #000;">Rs <?php echo $price;?></strong> </td>
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <td colspan="2" style="font-size: 12px;; color: #555; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;"><strong style="font-weight: normal;">
                  <?php if($other_traveller_name == ''){}else{
                    echo $other_traveller_name ;
                  }?></strong><br>
                  <p style="margin: 0; padding: 0;"><strong style="font-weight: normal;"></strong></p>
                  <strong style="font-size: 14px; color: #000;"></strong> </td>
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 5px;"></td>
              </tr>
              <!-- <tr>
                <td style="width: 30px"></td>
                <td colspan="2" style="font-size: 12px;; color: #c2c2c1; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Additional Costs</td>
                <td style="width: 30px"></td>
              </tr> -->
              <!-- <tr>
                <td style="width: 30px"></td>
                <td colspan="2">
                  <table cellpadding="0" cellspacing="0" style=" width:100%; margin: 0 auto;  margin: 0 auto; border: none; border-collapse: collapse;  color: #888; font-size: 12px; font-weight: bold; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
                    <tr>
                      <td style="text-align: left;">Caps</td>
                      <td style="text-align: right;">Rs.250</td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">Water Bottle</td>
                      <td style="text-align: right;">Rs.250</td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">Carry Bag</td>
                      <td style="text-align: right;">Rs.20</td>
                    </tr>
                  </table>
                </td>
                <td style="width: 30px"></td>
              </tr> -->
              <tr>
                <td colspan="4" style="padding: 5px;"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <!-- <td colspan="2" style="font-size: 12px;; color: #c2c2c1; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Taxes</td> -->
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <!-- <td colspan="2">
                  <table cellpadding="0" cellspacing="0" style=" width:100%; margin: 0 auto;  margin: 0 auto; border: none; border-collapse: collapse;  color: #888; font-size: 12px; font-weight: bold; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif';">
                    <tr>
                      <td style="text-align: left;">SGST</td>
                      <td style="text-align: right;">Rs.25</td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">CGST</td>
                      <td style="text-align: right;">Rs.20</td>
                    </tr>
                    <tr>
                      <td style="text-align: left;">LGST</td>
                      <td style="text-align: right;">Rs.20</td>
                    </tr>
                  </table>
                </td> -->
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 10px;"></td>
              </tr>
              <tr>
                <td style="width: 30px"></td>
                <td style="text-align: left; font-size: 14px; font-weight: bold; text-transform: uppercase; color: #000;">Total </td>
                <td style="text-align: right; font-size: 14px; font-weight: bold; text-transform: uppercase; color: #000;"> Rs.<?php echo $total_amount ?></td>
                <td style="width: 30px"></td>
              </tr>
              <tr>
                <td colspan="4" style="padding: 10px;"></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td colspan="4" style="padding: 20px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2" style="color: #000; font-size: 12px; font-weight: bold; line-height: 1.4; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0;">Have queries related to cancellations or rescheduling?</td>
          <td style="width: 30px;"></td>
        </tr>
        <tr>
          <td style="width: 30px;"></td>
          <td colspan="2"><br>
            <a href="#" style="padding: 5px 10px; display: inline-block; text-decoration: none; text-align: center; line-height: 24px; color: #fff; background: #3c8aca; text-transform: uppercase; font-size: 12px; font-weight: bold;">Click Here to contact us</a></td>
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
            Please reach us as <a href="mailto:help@iwl.com" target="_blank" style="color: #3c8aca; text-decoration: none;">ask@iwl.help</a> and we will rectify this error.</td>
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
          <td colspan="4"  style="color: #666; font-size: 12px; line-height: 1.5; font-family: Gotham, 'Helvetica Neue', Helvetica, Arial, 'sans-serif'; margin: 0; padding: 0; text-align: center;">This email is sent to Hosts and Admins of the IWL Portal<br>
            <a href="#" target="_blank" style="color: #3c8aca; text-decoration: none;">India With Locals</a> •  <a href="#" target="_blank" style="color: #3c8aca; text-decoration: none;">About Us</a><br>
            <a href="mailto:info@iwl.com" target="_blank" style="color: #3c8aca; text-decoration: none;">ask@iwl.help</a>  •  <a href="mailto:info@iwl.com" target="_blank" style="color: #3c8aca; text-decoration: none;">+91 72919 72715 / +91 98996 92790</a></td>
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
