<?php include('head.php');?>

<?php include('header.php');?>

<main>
  <div class="bookPage">
    <div class="coverBox">
      <div class="blurImage"  style="background-image:url(<?= base_url('assets/img/set/sample.jpg') ?>);"></div>
      <div class="container">
        <div class="bookingIntro"> 
          <?php $id = $booking_data->id ?>
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
            <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8
  c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"></path>
          </svg>&nbsp<?= anchor("viewitineraries/{$id}",'Back',['class'=>'text-uppercase'])?>
          


          <p>You are booking</p>
          <h2><?php echo $booking_data->itinerary_title;?></h2>
          <h3><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.2 19" style="enable-background:new 0 0 19.2 19;" xml:space="preserve">
              <path d="M15.9,7.3c0,4-3.6,8.4-5.4,10.3c-0.5,0.5-1.3,0.5-1.8,0c-1.8-1.9-5.5-6.3-5.5-10.3C3.1,3.8,6,1,9.5,1S15.9,3.8,15.9,7.3z
   M9.5,4.3c-1.6,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S11.1,4.3,9.5,4.3z"></path>
            </svg> <?php echo $booking_data->origin_city;?></h3>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="fillIntro">
        <form class="clearfix">
          <fieldset class="clearfix">
            <h3 class="col-form-label">Availablitiy & Time</h3>
            <input type="hidden" name="itineraray_id" id="itineraray_id" value="<?php echo $booking_data->id ?>">
            <input type="hidden" name="host_id" id="host_id" value="<?php echo $booking_data->user_id ?>">
            <label class="col-form-sublabel mb-2">Available Dates</label>
            <ul class="owl-carousel owl-theme dateSlider mb-4" id="booking_date">
               <?php
                   $start_date = date('d-m-Y',strtotime($booking_data->start_date_from_host)); 
                   $end_date   = date('d-m-Y',strtotime($booking_data->end_date_to_host)); 
                   ?>
                  
                      <li class="item">
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" id="bookingDate" name="booking-date" class="custom-control-input" checked value="<?php echo $start_date  ?>">
                          <label class="custom-control-label" for="bookingDate"><?php echo $start_date  ?></label>
                        </div>
                      </li>      
                
                
              
            </ul>
            <label class="col-form-sublabel mb-2">Available Slots</label>
            <ul class="owl-carousel owl-theme timeSlider mb-4" id="booking_time">
              <?php
                  $start_time = date('h:i A',strtotime($booking_data->default_start_time)) ;
                  $end_time   = date('h:i A',strtotime($booking_data->default_end_time));     
               ?>
              <li class="item">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTime-01" name="booking-time" class="custom-control-input" checked value="<?php echo $start_time.'-'.$end_time; ?>">
                  <label class="custom-control-label" for="bookingTime-01"><?php echo $start_time.'&nbsp-&nbsp  '.$end_time; ?></label>
                </div>
              </li>
              
            </ul>
          </fieldset>
          <hr class="mb-4">
          <fieldset class="infoFill">
            <h3 class="col-form-label">Traveller Type</h3>
            <label class="col-form-sublabel mb-3">Select Traveller Type</label>
            <ul class="form-row" id="traveller_type">
              <li class="form-group col-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTraveller-01" checked name="traveller-type" value="Private" class="custom-control-input">
                  <label class="custom-control-label text-dark" for="bookingTraveller-01">Private <span class="amt">Rs. <?php echo $booking_data->private_price?></span></label>
                  <input type="hidden" id="privateAmt" value="<?php echo $booking_data->private_price?>">
                </div>
                <div class="countBox" style="display: block;">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus" >
                    <button type="button" class="minus">-</button>
                    <input type="number" class="text-center calcBox"  id="privateTraveller" value="1" min="1" max="4" />
                    <button type="button" class="plus">+</button>
                  </div>
                  <div id="alert-msg">
  
                  </div>
                </div>
              </li>
              <!-- <li class="form-group col-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTraveller-02" name="traveller-type" value="Group" class="custom-control-input">
                  <label class="custom-control-label text-dark" for="bookingTraveller-02">Group <span class="amt">Rs. <?php echo $booking_data->group_price?></span></label>
                  <input type="hidden" id="groupAmt" value="<?php echo $booking_data->group_price?>">
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus">-</button>
                    <input type="number" class="text-center calcBox" id="groupTraveller" value="1" min="1" />
                    <button type="button" class="plus">+</button>
                  </div>
                </div>
              </li> -->
              <li class="col-12"> </li>
              <!-- <li class="form-group col">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTraveller-03" name="traveller-type" value="Family" class="custom-control-input">
                  <label class="custom-control-label text-dark" for="bookingTraveller-03">Family</label>
                </div>
              </li> -->
              
              
              <!-- <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-adult" class="custom-control-input familyCheckbox" name="family" value="Adults">
                  <label class="custom-control-label" for="familyTraveller-adult"><small class="text-light d-block">Adults</small> <span class="amt" id="familtAdultAmt">Rs. <?php echo $booking_data->family_price_adults?></span></label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus">-</button>
                    <input type="number" class="text-center calcBox" id="familyAdultTraveller" value="1" min="1" />
                    <button type="button" class="plus">+</button>
                  </div>
                </div>
              </li> -->
              
              <!-- <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-kids-01" class="custom-control-input familyCheckbox" name="family" value="Kids(Below 10)">
                  <label class="custom-control-label" for="familyTraveller-kids-01"><small class="text-light d-block">Kids (Below 10)</small> <span class="amt" id="familyKids_10Amt">Rs. <?php echo $booking_data->family_price_kids?></span></label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus">-</button>
                    <input type="number" class="text-center calcBox" id="familyKids10Traveller" value="0" min="0"  />
                    <button type="button" class="plus">+</button>
                  </div>
                </div>
              </li> -->
              
              <!-- <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-kids-02" class="custom-control-input familyCheckbox" name="family" value="Kids(Below 6)">
                  <label class="custom-control-label" for="familyTraveller-kids-02"><small class="text-light d-block">Kids (Below 6)</small> <span class="amt" id="familyKids_6Amt">Rs. <?php echo $booking_data->family_price_kids?></span></label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus">-</button>
                    <input type="number" class="text-center calcBox" id="familyKids6Traveller" value="0" min="0" />
                    <button type="button" class="plus">+</button>
                  </div>
                </div>
              </li> -->
              
              
              
              
            </ul>
            <div class="text-left pt-2 pb-2"> <a href="javascript:void(0)" class="btn btn-secondary" id="calculate_price">CALCULATE PRICE</a> </div>
            
            <label class="col-form-sublabel" id="traveller_details" style="display: none">Traveller Details</label>
            <h3 class="col-form-label text-secondary" id="traveller_types" style="display: none"></h3>
            <ul class="form-row" style="display: none" id="first_adult">
              <li class="form-group col-12 m-0">
                <label class="col-form-sublabel text-light">Adult 1</label>
              </li>
              <li class="form-group col-12 col-sm-6">
                <label class="col-form-sublabel">Full Name</label>
                <input type="text" class="form-control" placeholder="Full Name" id="main_traveller_name" />
                <span id="error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">This field required</span>
              </li>
              <li class="form-group col-12 col-sm-6">
                <label class="col-form-sublabel">Email</label>
                <input type="email" class="form-control" placeholder="Email" id="main_traveller_email" />
                <span id="email_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">This field required </span>
              </li>
              <li class="form-group col-12 col-sm-6">
                <label class="col-form-sublabel">International Phone No.</label>
                <input type="number" class="form-control" placeholder="Phone No." id="main_traveller_int_phone" />
              </li>
              <li class="form-group col-12 col-sm-6">
                <label class="col-form-sublabel">Phone No.</label>
                <input type="number" class="form-control" placeholder="Phone No."  id="main_traveller_phone" />
                <span id="mob_num_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">Contact Number should be minimum  10 digit</span>
              </li>
            </ul>
            <ul class="form-row" id="adult" >  
            </ul>
            <!-- <ul class="form-row" id="kids10"> 
            </ul>
            <ul class="form-row" id="kids6"> 
            </ul> -->
          </fieldset>
          <fieldset class="infoShow mt-2">
            <h3 class="infoTitle">Booking Summary</h3>
            <h4 class="infoSubtitle"><?php echo $booking_data->itinerary_tagline;?></h4>
            <p class="infoState"><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="<?php echo $booking_data->origin_city;?>"><span id="origin_citys"><?php echo $booking_data->origin_city;?></span></p>
            <p class="infoTime" style="display: none;" id="travellerTimeDate"><img src="<?= base_url('assets/img/icon/date.svg')?>" alt="date"><span></span> </p>
            <p class="infoType text-secondary font-weight-bold" style="display:none;" id="travType"></p>
            <ul class="infoType-list" id="book_list_info">
              
              <!-- <li style="display: none;" id="kidscost10"><span>Kid<small>(Below 10)</small></span> Rs. 2400</li>
              <li style="display: none" id="kidscost6"><span>Kid<small>(Below 6)</small></span> Rs. 350</li> -->
            </ul>
            <!-- <p class="infoCost">Additional Cost</p>
            <ul class="infoCost-list">
              <li><span>Caps</span> Rs. 250</li>
              <li><span>Water Bottle</span> Rs. 25</li>
              <li><span>Carry Bag</span> Rs. 25</li>
            </ul> -->
            <!-- <small class="infoTax-note">These prices have been multiplied by (3) on account of the number of travellers.</small> -->
            <!-- <p class="infoTax">Taxes</p>
            <ul class="infoTax-list">
              <li><span>SGST</span> Rs. 250</li>
              <li><span>CGST</span> Rs. 176</li>
              <li><span>IGST</span> Rs. 150</li>
            </ul> -->
            <h3 class="infoTax-total">TOTAL &nbsp;&nbsp;&nbsp;&nbsp; Rs.<span id="total_cost">0</span></h3>
            <div class="text-center infoTerms">
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="terms-agree" class="custom-control-input" required="required">
                <label class="custom-control-label text-left" for="terms-agree">I agree to the <a href="#" target="_blank"  data-toggle="modal" data-target="#tcModal">Terms & Conditions</a> and <a href="#" target="_blank" data-toggle="modal" data-target="#guModal">Guidelines</a></label>
        
              <!-- <label class="custom-control-label text-left" for="terms-agree">I agree to the <a href="<?= base_url('policie')?>" target="_blank">Terms &amp; Conditions</a>, <a href="<?= base_url('policie')?>"" target="_blank">Disclaimer</a> &amp; <a href="<?= base_url('policie')?>"" target="_blank">Guidelines</a></label> -->
              <input type="hidden" name="book_date" id="book_date" value="">
              <input type="hidden" name="book_time_slot" id="book_time_slot">
              </div>
                      <small id="terms_error" style="font-size: 11px; color: #f00; display: none;" >Please agree to the terms and conditions</small>
            </div>
            <!-- CC AVENU FORM-->


            


            
            <div class="text-center mt-3 mb-2">
              <!--<button class="btn btn-primary btn-lg" id="bookItineraries">Book</button>-->
              <input type="button" class="btn btn-primary btn-l" id="book_itinerary" disabled="disabled" value="Book">
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</main>
<div class="modal fade" id="guModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Guidelines</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
        <ul class="list-bullet">
          <li>Please do not carry valuables.</li>
          <li>Please wear a comfortable pair of walking shoes or flip-flops.</li>
          <li>Carry enough water. Keep yourself hydrated.</li>
          <li>Please wear conservative clothes. Revealing clothes may seem disrespectful and hurt people's sentiments.</li>
          <li>Do not forget to carry cash on Food Walks to pay for the Food.</li>
          <li>Carry a pair of sunglasses, a hat and sunscreen to protect yourself from the heat.</li>
          <li>Carry a scarf to cover up your head. (For Visit to Spiritual Places)</li>
          <li>Please wear weather appropriate clothing.</li>
          <li>Keeping in mind the weather, carry an umbrella/ Raincoat.</li>
          <li>Please do not carry bags or eatables inside the monument.</li>
          <li>Cost of Entry Tickets wherever applicable has to paid by the participants directly.</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- TERMS MODAL -->
<div class="modal fade" id="tcModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
        <p>The following document is applicable to all the participants and Walk Leaders for the City Walk Festival, Madhya Pradesh:</p>
        <h2>1. Participation:</h2>
        <p><strong>Walk Leaders:</strong> All Walk Leaders must be registered with India With Locals™ by submitting a walk entry form and completed the required formalities to lead a walk.</p>
        <p><strong>Participants:</strong> All participants should confirm their participation towards a walk by registering themselves in the website of India with Locals.</p>
        <p>Each walk has a cap of 20 participants. Upon filling of which, each participant will be scheduled under a waitlist. In order to ensure participation, it is advised to book for the walk at the earliest. </p>
        <h2>2. Fee:</h2>
        <p><strong>Participants:</strong> The participants of each walk will have to pay a nominal fee of Rs.50 by transfer of cash.</p>
        <h2>3. Cancellation Policy:</h2>
        <p><strong>Walk Leaders:</strong> A walk leader is not liable to cancel any of their participation according to the particulars of the disclaimers signed beforehand. However, in cases of emergency or pressured circumstances, the Walk leader has to inform a week prior to his/her walk according to the Walk festival Calendar.</p>
        <p>Strict measures ensues upon cancellation of the Walk Leaders and their entries from the Calendar.</p>
        <p>Any substitution of a Walk Leader is not applicable. The Walk leader has to be present himself/herself for the day of the walk.</p>
        <p>Participants: A participant has to inform India With Locals™ and Madhya Pradesh Tourism Board upon their cancellation 24 hours prior to the schedule of the walk. However, a refund of the same will not be possible. </p>
        <h2>4. Out of Control Situations:</h2>
        <p>India With Locals™ and Madhya Pradesh Tourism Board do not take responsibility of any mishaps, accidents on a walk. The participants are liable to take care of their own selves on a walk.</p>
        <p>Any untoward behavior on the walk will highly be unacceptable by the Walk Leader or India With Locals™ and Madhya Pradesh Tourism Board. The participant may be asked to leave the walk in the middle.</p>
        <p>On a food walk, India With Locals™ and Madhya Pradesh Tourism Board do not take any responsibility of health issues. The participant needs to be aware of their bodily shortcomings and let the walk leader know of it, in order to prevent health accidents during the walk.</p>
        <h2>5. Risk and Liability:</h2>
        <p><strong>Walk Leaders:</strong> The walk leaders have to be alert and active during the walk, to ensure the safety of their participants.</p>
        <p>A Walk Leader before starting the walk should let their participants know about the risk to their valuables. It would be advised not to carry any valuables during the walk.</p>
        <p><strong>Participants:</strong> It would be highly advised to the participants not to carry any valuables or wear some during the walk. Failure to adhere to it, the loss of any valuables shall not be borne by India With Locals™ or Madhya Pradesh Tourism Board.</p>
        <img class="pt-3 pb-3" src="assets/img/advt/ad_v1.jpg" alt="#"/> <small>City Walks Festival - Madhya Pradesh | Curated by India City Walks™  and India with Locals™ for Madhya Pradesh Tourism Board</small> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<!-- footer start-->
<?php include('footer.php'); ?>
<!-- footer end-->
<!-- SUBMIT FORM MODAL -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> <span class="modal-titleIcon"><img src="assets/img/icon/done.svg" alt="done" /></span>Under Review</h5>
        <h6 class="font-weight-bold text-center">BOOKING ID: 000565-4455</h6>
        <p class="font-weight-semibold text-center pl-2 pr-2">Your booking is under review. You will be notified via email once the host has accepted your booking and you can proceed to payment.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Confirm</button>
      </div>
    </div>
  </div>
</div>
<!-- SCRIPT --> 
<?php include('foot.php');?>
<script type="text/javascript" src="<?= base_url('assets/dependencies/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')?>"></script>

<script type="text/javascript">
  
(function($) {

//calculation click
  $('#calculate_price').on('click',function(){
     var book_date      = $('input[name=booking-date]:checked', '#booking_date').val(); 
     var book_time      = $('input[name=booking-time]:checked', '#booking_time').val(); 
     var traveller_type = $('input[name=traveller-type]:checked', '#traveller_type').val();
      

          $("#travellerTimeDate span").text(book_date+'  |  '+book_time);
          $('#book_date').val(book_date);
          $('#book_time_slot').val(book_time);
          $("#travellerTimeDate").show();

          $('#travType').html(traveller_type);
          $('#travType').show();

          $('#traveller_details').show();
          $('#traveller_types').html(traveller_type);
          $('#traveller_types').show();
          $('#first_adult').show();
          
          
    //private type
    if(traveller_type == 'Private'){
      $('#book_list_info').find('li').remove();
      var travellerCount = $('#privateTraveller').val();
      var trevellAmt = $('#privateAmt').val();
      var adulttotal = travellerCount*trevellAmt;
     $("#book_list_info").append("<li><span>Adult "+travellerCount+"</span>Rs."+adulttotal+"<input type='hidden'  id='total_adult' value="+travellerCount+" /><input type='hidden'  id='total_price' value="+adulttotal+" /></li>"); 
     $('#total_cost').text(adulttotal);
     $( "#adult").find('li').remove();
     //$( "#kids10").find('li').remove();
     //$( "#kids6").find('li').remove();
       for(i=1;i<=travellerCount;i++){
         if(i!= 1){
          $('#adult').append("<li class='form-group col-12 m-0'><label class='col-form-sublabel text-light'>Adult&nbsp"+i+"</label></li><li class='form-group col-12 col-sm-6'><label class='col-form-sublabel'>Full Name</label><input type='text' class='form-control' placeholder='Full Name' id='adult_"+i+"' /></li>");
         } 
         $('#book_itinerary').removeAttr('disabled');  
       }     
    }
    //group type
    // if(traveller_type == 'Group'){
    //   $('#book_list_info').find('li').remove();
    //   var travellerCount = $('#groupTraveller').val();
    //   var trevellAmt = $('#groupAmt').val();
    //   var adulttotal = travellerCount*trevellAmt;
    //   $("#book_list_info").append("<li><span>Adult"+travellerCount+"</span>Rs."+adulttotal+"</li>"); 
    //   $( "#adult").find('li').remove();
    //   $( "#kids10").find('li').remove();
    //   $( "#kids6").find('li').remove();
    //  for(i=1;i<=travellerCount;i++){
    //  if(i!= 1){
    //   $('#adult').append("<li class='form-group col-12 m-0'><label class='col-form-sublabel text-light'>Adult" +i+"</label></li><li class='form-group col-12 col-sm-6'><label class='col-form-sublabel'>Full Name</label><input type='text' class='form-control' placeholder='Full Name' id='adult_"+i+"' /></li>");
    //  }     
    //  }    
    // }

   //family type
      // if(traveller_type == 'Family'){
      //    var travellerFamily = [];
      //       $.each($("input[name='family']:checked"), function(){            
      //           travellerFamily.push($(this).val());
      //       });
      //        travellerFamily.join(", ");
          
      //       //FAMILY ADULT
      //       if(jQuery.inArray("Adults", travellerFamily) !== -1){
      //         $('#book_list_info').find('li').remove();
      //         var trevellAmt = $('#familtAdultAmt').text();

      //         var travellerCount = $('#familyAdultTraveller').val();
      //          var adulttotal = trevellAmt;
      //          alert(adulttotal);
      //         $("#book_list_info").append("<li><span>Adult"+travellerCount+"</span>Rs."+adulttotal+"</li>");
      //         $( "#adult").find('li').remove();
      //          for(i=1;i<=travellerCount;i++){
      //          if(i!= 1){
      //           $('#adult').append("<li class='form-group col-12 m-0' ><label class='col-form-sublabel text-light'>Adult" +i+"</label></li><li class='form-group col-12 col-sm-6'><label class='col-form-sublabel'>Full Name</label><input type='text' class='form-control' placeholder='Full Name' id='adult_"+i+"'></li>");
      //          }     
      //        }    
      //       }
      //       //FAMILY KIDS-10
      //       if(jQuery.inArray("Kids(Below 10)", travellerFamily) !== -1){
      //        var travellerCount = $('#familyKids10Traveller').val();
            
      //       $( "#kids10").find('li').remove();
      //          for(i=0;i<=travellerCount;i++){
      //          if(i!= 0){
      //           $('#kids10').append("<li class='form-group col-12 m-0' id='kids10_'"+i+"><label class='col-form-sublabel text-light'>Kid" +i+"(Below 10)</label></li><li class='form-group col-12 col-sm-6'><label class='col-form-sublabel'>Full Name</label><input type='text' class='form-control' placeholder='Full Name' id='adult_"+i+"'/></li>");
      //          }   
      //        }
      //      }
      //      //FAMILY KIDS -6
      //      if(jQuery.inArray("Kids(Below 6)", travellerFamily) !== -1){
      //        var travellerCount = $('#familyKids10Traveller').val();
            
      //       $( "#kids6").find('li').remove();
      //          for(i=0;i<=travellerCount;i++){
      //          if(i!= 0){
      //           $('#kids6').append("<li class='form-group col-12 m-0' id='kids6_'"+i+"><label class='col-form-sublabel text-light'>Kid" +i+"(Below 6)</label></li><li class='form-group col-12 col-sm-6'><label class='col-form-sublabel'>Full Name</label><input type='text' class='form-control' placeholder='Full Name' id='adult_"+i+"'/></li>");
      //          }   
      //        }
      //      }
      //    }
       
  });

//BOOKING ITINEARARY

$('#book_itinerary').click(function(){
  
  var itineraray_id = $('#itineraray_id').val();
  var host_id       = $('#host_id').val();
 var main_trav_name = $('#main_traveller_name').val();
 var main_trav_email = $('#main_traveller_email').val();
 var main_trav_int_phone = $('#main_traveller_int_phone').val();
 var main_trav_phone = $('#main_traveller_phone').val();
 var origin_citys = $('#origin_citys').text();
 //var book_date = $('#book_date').val();
 var book_date = $('#bookingDate').val();
 var created_date = new Date();

 
 var book_time_slot = $('#book_time_slot').val();
 var adult_count = $('#total_adult').val();
 var total_price = $('#total_price').val();
 var traveller_type = 'Private';
// alert(main_trav_name+','+main_trav_email+','+main_trav_int_phone+','+main_trav_phone+','+origin_citys+','+book_date+','+book_time_slot+','+adult_count+','+total_price+''+traveller_type);
  
//alert(adult_count);return false;
var other_adult_name = [];
for(i=2; i<=(adult_count);i++){

   other_adult_name.push($('#adult_'+i).val());
}

 
if($.trim(main_trav_name).length == 0){
     $('#error').show();
}else{
   $('#error').hide();
}

if($('#terms-agree').prop("checked") == false){
          $('#terms_error').show();
            }else{
   $('#terms_error').hide();
}


if ($.trim(main_trav_email).length == 0) {
        $('#email_error').show();
    }else{
          $('#email_error').hide();  
    }

if ($.trim(main_trav_phone).length == 0) {
            $('#mob_num_error').show();
        }

  if($.trim(main_trav_phone).length<10){
      $('#mob_num_error').show();
       //return false;
    }
    if($.trim(main_trav_phone).length>14){
      $('#mob_num_error').show();
       //return false;
    }
    if($.trim(main_trav_phone).length>=10){
      $('#mob_num_error').hide();
       //return true;
    }

        
    if($.trim(main_trav_name).length != 0 && $.trim(main_trav_email).length != 0 && $.trim(main_trav_phone).length>=10 && $('#terms-agree').prop("checked") == true){
      $.ajax({
  type:'post',
  url:url+'booking/book_itenerary',
  data:{itineraray_id:itineraray_id,host_id:host_id,main_trav_name:main_trav_name,main_trav_email:main_trav_email,main_trav_int_phone:main_trav_int_phone,main_trav_phone:main_trav_phone,origin_citys:origin_citys,book_date:book_date,book_time_slot:book_time_slot,adult_count:adult_count,total_price:total_price,traveller_type:traveller_type,other_adult_name:other_adult_name,created_date:created_date},
    success:function(data){
    //alert(data);
    if(data == 'success'){
      location.href = url+'payment';
    }else{
      //alert(adult_count);
      var total_book = data-adult_count;
       var left_booking = 20-total_book;
       if(left_booking == 0){
        var msg =  'Sorry, we are not accepting any more bookings for this walk';
       $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+msg+'</div>');
       }else{
         var left_book = 'Sorry there are only '+ left_booking +' bookings left for this walk';
       $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+left_book+'</div>');
       }
       
      }  
    }
 });
}   

});


    // RADIO TRAVELLER TYPE
    $(document).on('change', 'input[name="traveller-type"]', function() {
        var $parent = $(this).parent().parent();
        var $uncle = $parent.siblings();
        var $othercount = $uncle.find('.countBox');
        var $count = $(this).parent().next('.countBox');
        if ($(this).prop('checked') == true) {
            $count.show();
            $othercount.hide();
            $('.relateFamily').hide();
            if ($(this).val() == 'Family') {
                $('.relateFamily').show();
                $('.relateFamily').find('.custom-control-input').prop('checked', false);
            }

        }

    });

    $(document).on('change', '.familyCheckbox', function() {
        var $count = $(this).parent().next('.countBox');
        if ($(this).prop('checked') == true) {
            $count.show();
        } else {
            $count.hide();
        }

    });


    // PLUS & MINUS
    $(document).on('click', '.plus', function(e) {
        e.preventDefault();
        if ($(this).prev().val() < 4) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });

    $(document).on('click', '.minus', function(e) {
        e.preventDefault();
        if ($(this).next().val() > 1) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

    $(document).on('keypress', '.calcBox', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $(document).on('change', '.calcBox', function(e) {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max) {
            $(this).val(max);
        } else if ($(this).val() < min) {
            $(this).val(min);
        }
    });

    // DATE & TIME SILDER 	
    var dateOwl = $('.dateSlider');
    dateOwl.owlCarousel({
        margin: 10,
        nav: true,
        items: 6,
        dots: false,
        mouseDrag: false,
        responsive: {
            0: {
                items: 2,
            },
            480: {
                items: 3,
            },
            768: {
                items: 4,
            }
        }
    });

    var timeOwl = $('.timeSlider');
    timeOwl.owlCarousel({
        margin: 10,
        nav: true,
        items: 5,
        dots: false,
        mouseDrag: false,
		responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 2,
            },
            768: {
                items: 3,
            }
        }
    });

})(jQuery);
</script>
</body>
</html>
