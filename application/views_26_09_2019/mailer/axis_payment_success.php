<?php
/* echo '<pre>';print_r($adults);
echo '<pre>';print_r($hostdetail);
echo '<pre>';print_r($slotdata);
echo '<pre>';print_r($kidsData);die; */
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>CityExplorers</title>
</head>

<body style="background: #f9f9f9;">
<table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
<tr>
  <td><table cellpadding="0" cellspacing="0" style="width: 720px; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
      <tr>
        <td width="25"></td>
        <td width="670"></td>
        <td width="25"></td>
      </tr>
      <tr>
        <td colspan="3"  bgcolor="#3c8aca"><img src="<?php echo base_url();?>assets/mailer_img/mailerheader.png" alt="CityExplorers" style="display: block; border: none; max-width: 100%;"/></td>
      </tr>
      <tr valign="top" bgcolor="#f9f9f9">
        <td width="25"><img src="<?php echo base_url();?>assets/mailer_img/mailerheader_left.png" alt="left" style="display: none; border: none; max-width: 100%;"/></td>
        <td width="670"><table cellpadding="0" cellspacing="0" width="670" style="width: 100%; background: #fff; margin: 0 auto; border: none; border-collapse: collapse; color: #888; box-shadow:0 0 10px rgba(0,0,0,0.2); font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
            <tr>
              <td colspan="3" height="20"></td>
            </tr>
            <tr>
              <td width="25"></td>
              <td width="620"><img src="<?php echo base_url();?>assets/mailer_img/logo_org.png" width="267" height="48" alt="CityExplorers" style="display: block; border: none; max-width: 100%;"/></td>
              <td width="25"></td>
            </tr>
            <tr>
              <td colspan="3" height="30"></td>
            </tr>
            <tr>
              <td width="25"></td>
              <td width="620" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif;">Dear <?php echo $full_name;?>,</td>
              <td width="25"></td>
            </tr>
            <tr>
              <td colspan="3" height="20"></td>
            </tr>
            <tr>
              <td width="25"></td>
              <td width="620" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;">Your Booking has been confirmed. Please find the complete details below - </td>
              <td width="25"></td>
            </tr>
            <tr>
              <td colspan="3" height="5"></td>
            </tr>
            <tr>
              <td width="25"></td>
              <td width="620" style="color: #888; font-size: 14px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;">Booking ID: <span style="color:#3c8aca;"><?php echo $booking_id;?></span></td>
              <td width="25"></td>
            </tr>
            <tr>
              <td colspan="3" height="30"></td>
            </tr>
            <tr bgcolor="#fcfcfc">
              <td colspan="3" height="15"></td>
            </tr>
            <tr bgcolor="#fcfcfc" valign="middle">
              <td width="25"></td>
              <td width="620" style="color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;"><table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; color: #888888; font-size: 12px; font-family:Arial, Helvetica, sans-serif;">
                  <tr>
                    <td width="380"><div style="display: inline-block; vertical-align: middle; color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;"><span style="display: inline-block; vertical-align: middle; width: 35px; height: 35px; border-radius: 50%; overflow: hidden; background: #ccc; margin-right:10px;"><img src="<?php echo base_url();?>assets/mailer_img/placeholder.jpg" style="display: block; border: none; max-width: 100%; " alt="#"/></span> with <?php echo $finalHost->host_first_name.' '.$finalHost->host_last_name;?> </div></td>
                    <td width="240"><strong style="font-weight:normal; font-size:12px; color:#555; line-height:1.75;">Want to connect?</strong><br>
                      <a href="mailto:travelswithnalina@gmail.com" target="_blank" style="color: #3c8aca; text-decoration: none;  line-height:1.75;"><img src="<?php echo base_url();?>assets/mailer_img/icon-mail-blue.png" style="display: inline-block; vertical-align: middle; border: none; margin-top:-2px;" alt="#"/> <?php echo $finalHost->host_email;?></a><br>
                      <a href="#" target="_blank" style="color: #3c8aca; text-decoration: none;  line-height:1.75;"><img src="<?php echo base_url();?>assets/mailer_img/icon-call-blue.png" style="display: inline-block; vertical-align: middle; margin-top:-2px; border: none; " alt="#"/> +91 <?php echo $finalHost->host_mob_no;?></a></td>
                  </tr>
                </table></td>
              <td width="25"></td>
            </tr>
            <tr bgcolor="#fcfcfc">
              <td colspan="3" height="15"></td>
            </tr>
            <tr>
              <td width="25"></td>
              <td width="620"><table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; color: #888888; font-size: 12px; font-family:Arial, Helvetica, sans-serif;">
                  <tr>
                    <td colspan="3" height="25"></td>
                  </tr>
                  <tr>
                    <td width="35"></td>
                    <td width="600" style="color: #555; font-size: 14px; font-family:Arial, Helvetica, sans-serif; line-height:1.75; text-transform:uppercase;"><strong>Your Itinerary</strong></td>
                    <td width="35"></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="10"></td>
                  </tr>
                  <tr>
                    <td width="35"></td>
                    <td width="600"><table cellpadding="0" cellspacing="0"  bgcolor="#fdfdfd" style="width:100%; margin: 0 auto; background: #fdfdfd; border:1px solid #f7f7f7; color: #888888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;">
                        <tr>
                          <td colspan="3" height="25"></td>
                        </tr>
                        <tr>
                          <td width="25"></td>
                          <td width="530" style="color:#888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;"><img src="<?php echo base_url();?>assets/mailer_img/icon-location.png" style="display: inline-block; vertical-align: middle; border: none; margin-top:-3px;" alt="#"/> New Delhi</td>
                          <td width="25"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="8"></td>
                        </tr>
                        <tr>
                          <td width="25"></td>
						  <?php 
						//======= indian time to UTC time zone ========//
						  date_default_timezone_set("Asia/Kolkata");
						  //$stime = strtotime($time_from_host);
						  //$etime = strtotime($time_from_host);
						  $stime = strtotime($slotdata->start_pickup_time);
						  $etime = strtotime($slotdata->end_dropoff_time);
						  date_default_timezone_set("UTC");
						  //$Smtime = date('H:i A', $stime);
						  //$Emtime = date('H:i A', $etime);
						  $Smtime = date('H:i A', $stime);
						  $Emtime = date('H:i A', $etime);
						?>
                          <!--<td width="530" style="color:#888; font-size: 12px; font-family:Arial, Helvetica, sans-serif;"><img src="<?php echo base_url();?>assets/mailer_img/icon-date.png" style="display: inline-block; vertical-align: middle; border: none; margin-top:-3px;" alt="#"/> <?php echo $itinerary_date;?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $time_from_host.' ('.$Smtime.' UTC )';?> - <?php echo $time_to_host.' ('.$Emtime.' UTC )';?>&nbsp;&nbsp;|&nbsp;&nbsp;Cut-Off Time: <?php echo $slotdata->cutt_off_time;?></td>-->
                          <td width="530" style="color:#888; font-size: 12px; font-family:Arial, Helvetica, sans-serif;"><img src="<?php echo base_url();?>assets/mailer_img/icon-date.png" style="display: inline-block; vertical-align: middle; border: none; margin-top:-3px;" alt="#"/> <?php echo $selectedDate;?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo $slotdata->start_pickup_time.' ('.$Smtime.' UTC )';?> - <?php echo $slotdata->end_dropoff_time.' ('.$Emtime.' UTC )';?>&nbsp;&nbsp;|&nbsp;&nbsp;Cut-Off Time: <?php echo $slotdata->cutt_off_time;?></td>
                          <td width="25"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="20"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="140">						<img  width="600" height="300" src="https://maps.googleapis.com/maps/api/staticmap?autoscale=1&size=600x300&maptype=roadmap&key=AIzaSyC32_hwlF6rX6bIbwISUVS1GJ89dcjsLz4&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7C<?php echo $slotdata->pickup_point?>&markers=size:mid%7Ccolor:0xff0000%7Clabel:2%7C<?php echo $slotdata->drop_off_point?>"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="20"></td>
                        </tr>
                        <tr>
                          <td width="25"></td>
                          <td width="530">
						  <?php 
						//======= indian time to UTC time zone ========//
						  date_default_timezone_set("Asia/Kolkata");
						  $sptime = strtotime($slotdata->start_pickup_time);
						  $edtime = strtotime($slotdata->end_dropoff_time);
						  date_default_timezone_set("UTC");
						  $SPtime = date('H:i A', $sptime);
						  $EDtime = date('H:i A', $edtime);
						?>
						
						 <table cellpadding="0" cellspacing="0" bgcolor="#fdfdfd" style="width:100%; margin: 0 auto;  border: none; color: #999999; font-size: 12px; font-family:Arial, Helvetica, sans-serif;">
                              <tr>
                                <td><img src="<?php echo base_url();?>assets/mailer_img/icon-timeline.png" style="display: block; margin: 0 auto;  border: none;" alt="#"/></td>
                                <td style="font-size: 12px; font-family:Arial, Helvetica, sans-serif; vertical-align: top;"><strong style="color:#888;">Pick up from <?php echo $slotdata->pickup_point;?></strong> &nbsp;<strong style="color: #888; float: right;"><?php echo $slotdata->start_pickup_time.' ('.$SPtime.' UTC )';?></strong><br>
                                  <?php echo $slotdata->description;?>.</td>
                              </tr>
                             <?php if(!empty($slotdata->drop_off_point)){?>
                              <tr>
                                <td><img src="<?php echo base_url();?>assets/mailer_img/icon-timelinelast.png" style="display: block; margin: 0 auto;  border: none;" alt="#"/></td>
                                <td style="font-size: 12px; font-family:Arial, Helvetica, sans-serif; vertical-align: top;"><strong style="color:#888;">Drop Off at <?php echo $slotdata->drop_off_point;?></strong> &nbsp;<strong style="color: #888; float: right;"><?php echo $slotdata->end_dropoff_time.' ('.$EDtime.' UTC )';?></strong><br>
                                  <?php echo $slotdata->description;?>.</td>
                              </tr>
							  <?php }?>
                            </table>
						
							</td>
                          <td width="25"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="20"></td>
                        </tr>
                      </table></td>
                    <td width="35"></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="25"></td>
                  </tr>
                  <tr>
                    <td width="35"></td>
                    <td width="600" style="color: #555; font-size: 14px; font-family:Arial, Helvetica, sans-serif; line-height:1.75; text-transform:uppercase;"><strong>Traveller Details</strong></td>
                    <td width="35"></td>
                  </tr>
                  <tr>
                    <td width="35"></td>
                    <td width="600" style="color: #555; font-size: 13px; font-family:Arial, Helvetica, sans-serif; line-height:1.75; font-weight:bold;">Category: <strong style="color: #ef4447;">
					<?php 
					if($traveller_type=='privateType'){
						echo 'Private';
						}
					if($traveller_type=='groupType'){
						echo 'Group';
						}
				    if($traveller_type=='familyType'){
						echo 'Family';
						}		
					?></strong></td>
                    <td width="35"></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="15"></td>
                  </tr>
                  <tr>
                    <td width="35"></td>
                    <td width="600"><table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto;  border: none; color: #888888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;">
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="10"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td width="25"></td>
                          <td width="530" style="font-size: 13px; color: #3c8aca; line-height: 1.5; font-family:Arial, Helvetica, sans-serif;"><strong style="color:#555">Booked by</strong><br>
                            <p style="margin: 0; padding: 0;"><strong><?php echo $full_name;?></strong><br>
                              <strong style="font-weight: normal;"><img src="<?php echo base_url();?>assets/mailer_img/icon-mail-blue.png" style="display: inline-block; vertical-align: middle; border: none; margin-top:-2px; " alt="#"/> <?php echo $email;?></strong> &nbsp;&nbsp;&nbsp;&nbsp; <strong style="font-weight: normal;"><img src="<?php echo base_url();?>assets/mailer_img/icon-call-blue.png" style="display: inline-block;  margin-top:-2px; vertical-align: middle; border: none; " alt="#"/> +91 <?php echo $phone_no;?></strong></p></td>
                          <td width="25"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="10"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="15"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="5"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td width="25"></td>
                          <td width="530" style="font-size: 13px; color: #3c8aca; line-height: 1.5; font-family:Arial, Helvetica, sans-serif;"><strong style="color:#555">Traveller </strong><br>
                            <p style="margin: 0; padding: 0;"><strong><?php echo isset($adults[0]->adults_counts) ? $adults[0]->adults_counts : 1;?> Tickets <!--@--><?php //echo $traveller_price;?></strong>&nbsp;<strong style="float:right; font-weight:normal;">Rs <?php echo $traveller_price;?></strong></p>
							<?php if(!empty($kidsData)){
							      if(!empty($kidsData[0]->kids_10)){
									  $kids10Data = json_decode($kidsData[0]->kids_10,true);
									  //echo '<pre>';print_r($kids10Data);
									  }else{
									   $kids10Data = array();
									  }
								 if(!empty($kidsData[0]->kids_7)){
									   $kids7Data = json_decode($kidsData[0]->kids_7,true);
									  }
									  else{
									   $kids7Data = array();
									  }
								if(!empty($kidsData[0]->kids_5)){
									   $kids5Data = json_decode($kidsData[0]->kids_5,true);
									  }
									 else{
									   $kids5Data = array();
									  } 
								 
								}?>
							
							<?php
							$kids10DataTotal = 0;
							$kids7DataTotal = 0;
							$kids5DataTotal = 0;
							?>
							
							<?php if(!empty($kids10Data)){?>	
                            <p style="margin: 0; padding: 0;"><strong><?php echo $kids10Data[0]['kids_counts'];?> Tickets (Kids below 10) <!--@--><?php //echo $kids10Data[0]['kids10_price'];?></strong>&nbsp;<strong style="float:right; font-weight:normal;">Rs <?php echo $kids10Data[0]['kids10_price'];?></strong></p>
							<?php $kids10DataTotal = $kids10Data[0]['kids_counts']; }
							 if(!empty($kids7Data)){
							?>
                            <p style="margin: 0; padding: 0;"><strong><?php echo $kids7Data[0]['kids_counts'];?> Tickets (Kids below 7) <!--@--><?php //echo $kids7Data[0]['kids7_price'];?></strong>&nbsp;<strong style="float:right; font-weight:normal;">Rs <?php echo $kids7Data[0]['kids7_price'];?></strong></p>
							 <?php $kids7DataTotal = $kids7Data[0]['kids_counts']; } 
							  if(!empty($kids5Data)){
							 ?>
						   <p style="margin: 0; padding: 0;"><strong><?php echo $kids5Data[0]['kids_counts'];?> Tickets (Kids below 5) <!--@--><?php //echo $kids5Data[0]['kids5_price'];?></strong>&nbsp;<strong style="float:right; font-weight:normal;">Rs <?php echo $kids5Data[0]['kids5_price'];?></strong></p>
							<?php $kids5DataTotal = $kids5Data[0]['kids_counts']; } ?>
							</td>
                          <td width="25"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="5"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="15"></td>
                        </tr>
						
						
						<?php
						if(isset($additional_cost_description) && !empty($additional_cost_description)) {
						$costData = json_decode($additional_cost_description,true);
						}
						?>
                        <tr style="display:<?php isset($costData[0]["additional_price"]) && !empty($costData[0]["additional_price"]) ? "block" : "none"; ?>" >
                          <td width="25"></td>
                          <td width="530" style="color: #555; font-size: 13px; font-family:Arial, Helvetica, sans-serif; line-height:1.75;"><strong>Additional Costs</strong> <em style="font-size:11px;">(for each person)</em></td>
                          <td width="25"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="5"></td>
                        </tr>
						<tr bgcolor="#f9f9f9" style="display:<?php isset($costData[0]["additional_price"]) && !empty($costData[0]["additional_price"]) ? "block" : "none"; ?>" >
							<td width="25"></td>
							<td width="530">
							<table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto;  border: none; border-collapse: collapse; color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;">
							<?php
							$additional_total_cost = 0;
							foreach($costData as $key => $value) {
							$additional_total_cost = $additional_total_cost + ($value["additional_price"]*( (isset($adults[0]->adults_counts) ? $adults[0]->adults_counts : 1) + $kids10DataTotal + $kids7DataTotal + $kids5DataTotal));
							?>
							<tr>
                                <td align="left" style="line-height:1.5;"><?php echo $value["itinerary_additionalcost_description"]." X ".( (isset($adults[0]->adults_counts) ? $adults[0]->adults_counts : 1) + $kids10DataTotal + $kids7DataTotal + $kids5DataTotal)." Traveller"; ?></td>
                                <td align="right" style="line-height:1.5;">Rs. <?php echo $value["additional_price"]*( (isset($adults[0]->adults_counts) ? $adults[0]->adults_counts : 1) + $kids10DataTotal + $kids7DataTotal + $kids5DataTotal) ;?></td>
							</tr>
							<?php } ?>
                            </table>
							</td>
							<td width="25"></td>
                        </tr>
						
                        <tr bgcolor="#f9f9f9" style="display:none;">
                          <td width="25"></td>
                          <td width="530"><table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto;  border: none; border-collapse: collapse; color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;">
                           <?php				  
							 /*if(!empty($hostdetail)){  
						      $additionalData = json_decode($hostdetail->additional_cost_description,true);							 
							  foreach($additionalData as $key => $value) {?>
								 <tr>
								  <td align="left" style="line-height:1.5;"><?php echo $value['itinerary_additionalcost_description']; ?></td>
								  <td align="left" style="line-height:1.5;">Rs.<?php echo $value['additional_price']; ?></td>
								</tr>
								<?php								 
								  }							   
						      }*/
					       ?> 
						   <td align="left" style="line-height:1.5;">Additional Cost</td>
						   <td align="left" style="line-height:1.5;">Rs.<?php echo $additional_cost; ?></td>
                          </table></td>
                          <td width="25"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="10"></td>
                        </tr>
                        <tr>
                          <td colspan="3" align="right"><em style="font-size:12px; color:#aaa;">These prices have been multiplied by (<?php echo (isset($adults[0]->adults_counts) ? $adults[0]->adults_counts : 1) + $kids10DataTotal + $kids7DataTotal + $kids5DataTotal;?>) on account of the number of travellers.</em></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="15"></td>
                        </tr>
                        <tr>
                          <td width="25"></td>
                          <td width="530" style="color: #555; font-size: 13px; font-family:Arial, Helvetica, sans-serif; line-height:1.75; "><strong>Taxes</strong></td>
                          <td width="25"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="5"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="10"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td width="25"></td>
                          <td width="530"><table cellpadding="0" cellspacing="0"  style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;">
                              <tr>
                                <td align="left" style="line-height:1.5;">SGST</td>
                                <td align="right" style="line-height:1.5;"><?php echo 'Rs. '.$sgst;?></td>
                              </tr>
                              <tr>
                                <td align="left" style="line-height:1.5;">CGST</td>
                                <td align="right" style="line-height:1.5;"><?php echo 'Rs. '.$cgst;?></td>
                              </tr>
                              <tr>
                                <td align="left" style="line-height:1.5;">LGST</td>
                                <td align="right" style="line-height:1.5;"><?php echo 'Rs. '.$igst;?></td>
                              </tr>
                            </table></td>
                          <td width="25"></td>
                        </tr>
                        <tr bgcolor="#f9f9f9">
                          <td colspan="3" height="10"></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="25"></td>
                        </tr>
                        <tr>
                          <td width="25"></td>
                          <td width="530"><table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto; border: none; border-collapse: collapse; color: #555; font-size: 15px; font-family:Arial, Helvetica, sans-serif;">
                              <tr>
                                <td align="left" style="font-weight: bold; text-transform: uppercase; color: #555;">Total </td>
                                <td align="right" style=" font-weight: bold;  color: #ef4447;">
								<?php
					               //$overallmount = $additional_cost+$traveller_price+$sgst+$cgst+$igst;
					               $overallmount = $additional_total_cost + $traveller_price + $sgst+$cgst + $igst + (isset($kids10Data[0]['kids10_price']) ? $kids10Data[0]['kids10_price'] : 0) + (isset($kids7Data[0]['kids7_price']) ? $kids7Data[0]['kids7_price'] : 0) + (isset($kids5Data[0]['kids5_price']) ? $kids5Data[0]['kids5_price'] : 0);
							       echo 'Rs '.$overallmount;?>
								 </td>
                              </tr>
                            </table></td>
                          <td width="25"></td>
                        </tr>
                        <tr>
                          <td colspan="3"><hr style="border-color:#fff; border-collapse:collapse; border-width:1px;" /></td>
                        </tr>
                        <tr>
                          <td colspan="3" height="15"></td>
                        </tr>
                      </table></td>
                    <td width="35"></td>
                  </tr>
                  <tr>
                    <td width="35"></td>
                    <td width="600"><table cellpadding="0" cellspacing="0" style="width:100%; margin: 0 auto;  border: none; color: #888888; font-size: 13px; font-family:Arial, Helvetica, sans-serif;">
                        <tr>
                          <td style="font-size: 14px; line-height:1.75; color:#555; text-transform:uppercase; display:<?php echo !empty($special_mention) ? "block" : "none"; ?>"><strong>Special Mention</strong></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td><?php echo $special_mention;?></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td><hr style="border-color:#fff; border-collapse:collapse; border-width:1px;" /></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td style="font-size: 14px; line-height:1.75; color:#555; text-transform:uppercase;"><strong>Additional Contact Details</strong></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
						<?php 
						//======= indian time to UTC time zone ========//
						  date_default_timezone_set("Asia/Kolkata");
						  $sftime = strtotime($hostdetail->aviaiable_time_form_host);
						  $eatime = strtotime($hostdetail->aviaiable_time_to_host);
						  date_default_timezone_set("UTC");
						  $SPtime = date('H:i A', $sftime);
						  $EDtime = date('H:i A', $eatime);
						?>
                        <tr>
                          <td><strong><?php echo $finalHost->host_first_name.' '.$finalHost->host_last_name;?></strong></td>
                        </tr>
                        <tr>
                          <td><strong>Call Between</strong></td>
                        </tr>
                        <tr>
                          <td style="line-height:1.5;">Time: <?php echo $hostdetail->aviaiable_time_form_host.' ('.$SPtime.' UTC )'.' To '.$hostdetail->aviaiable_time_to_host.' ('.$EDtime.' UTC )';?></td>
                        </tr>
                        <tr>
                          <td style="color:#3c8aca; line-height:1.5;"><img src="<?php echo base_url();?>assets/mailer_img/icon-mail-blue.png" style="display: inline-block; vertical-align: middle; border: none; margin-top:-2px; " alt="#"/> <?php echo $finalHost->host_email;?>&nbsp;&nbsp;&nbsp;&nbsp; <img src="<?php echo base_url();?>assets/mailer_img/icon-call-blue.png" style="display: inline-block; margin-top:-2px; vertical-align: middle; border: none; " alt="#"/><?php echo '+91 '.$finalHost->host_mob_no;?></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td><strong>Emergency Number</strong></td>
                        </tr>
                        <tr>
                          <td style="color:#3c8aca; line-height:1.5;"><img src="<?php echo base_url();?>assets/mailer_img/icon-call-blue.png" style="display: inline-block; vertical-align: middle; border: none; " alt="#"/> <?php echo '+91 '.$hostdetail->host_emergency_contact_num;?></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td><hr style="border-color:#fff; border-collapse:collapse; border-width:1px;" /></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td>Have queries related to cancellations or rescheduling?</td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                        <tr>
                          <td><a href="<?php echo base_url();?>contact" style="padding: 10px 15px; display: inline-block; text-decoration: none; text-align: center; color: #fff; background: #3c8aca; text-transform: uppercase; font-size: 12px; font-weight: bold;">Click Here to contact us</a></td>
                        </tr>
                        <tr>
                          <td height="15"></td>
                        </tr>
                      </table></td>
                    <td width="35"></td>
                  </tr>
                  <tr>
                    <td colspan="3" height="15"></td>
                  </tr>
                </table></td>
              <td width="25"></td>
            </tr>
          </table></td>
        <td width="25"><img src="<?php echo base_url();?>assets/mailer_img/mailerheader_right.png" alt="right" style="display: none; border: none; max-width: 100%;"/></td>
      </tr>
      <tr>
        <td colspan="3" height="5"></td>
      </tr>
      <tr>
        <td colspan="3"><table cellpadding="0" cellspacing="0" background="#f9f9f9" width="720" style=" width:720px; margin: 0 auto; border: none; border-collapse: collapse; color: #888; background:#f9f9f9; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
            <tr>
              <td colspan="3" height="20"></td>
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
        <td colspan="3"><table cellpadding="0" cellspacing="0" width="720"  style=" width:720px; margin: 0 auto; border: none; border-collapse: collapse; color: #888; font-size: 16px; font-family:Arial, Helvetica, sans-serif;">
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
