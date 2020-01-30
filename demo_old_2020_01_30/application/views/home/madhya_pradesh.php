<!--head end-->
<?php include('head.php');?>
<!--head end-->
<!-- header start-->
<?php include('header.php');?>
<!-- header end-->
<?php 
	$currentUrl = $_SERVER['REQUEST_URI'];
	//$parts = explode("/", $currentUrl);
    //$currentParam = end($parts);
	?>	
<main>
	
<link href="https://fonts.googleapis.com/css?family=Alex+Brush&display=swap" rel="stylesheet">


  <div class="heroBanner splBanner"> 
     <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
			<div class="carousel-item bannerLayer active" style="background-image: url(<?php echo base_url();?>assets/img/banners/home/banner_mp.jpg)"><img src="<?php echo base_url();?>assets/img/banners/home/banner_mp.jpg" alt="mp"/></div>
			</div>
	</div>
 </div>
  <div id="mainContent" class="container-fluid">
    <div class="pageSearch clearfix">
      <div class="itinerariesHead clearfix">
        <div class="itinerariesHead-left">
          <h3 class="col-form-label pt-0 pb-0 text-capitalize text-dark">Find Your Tour</h3>
          <ul class="form-row">
            <!--
            <li class="form-group col-12 col-md-4 pt-4">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="checkbox" id="individualFilter" name="searchPrivate" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="individualFilter">Private</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="checkbox" id="groupFilter" name="searchGroup" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="groupFilter">Group</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="checkbox" id="familyFilter" name="searchFamily" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="familyFilter">Family</label>
              </div>
            </li>-->
            <li class="form-group col-12 col-md-4">
              <label class="col-form-sublabel">Select city</label>
              <select class="form-control" id="cityid">
                <option value="">Select</option>
				<?php 
					foreach($cityData as $data):
					?>
                <option value="<?php echo $data->city_name;?>"><?php echo $data->city_name;?></option>
				<?php endforeach;?>
              </select>
            </li>
            <li class="form-group col-12 col-md-4">
              <label class="col-form-sublabel">Select date</label>
              <input id="dobDateInput" type="text" class="form-control dateIcon rightSide" placeholder="DD-MM-YYYY" autocomplete="off" onkeydown="return false" />
              </li>
			  
			  <!--
            <li class="form-group col-12 col-md-4">
         <label class="col-form-sublabel">Theme</label>
         <select class="form-control" id="themesid">
            <option value="">All</option>
			<?php 
				foreach($themesData as $data):
				?>
            <option value="<?php echo $data->id;?>"><?php echo $data->theme_name;?></option>
			<?php endforeach;?>
          </select>
      </li>

        -->
            <li class="form-group col-12 col-md-4">
                  <label class="col-form-sublabel">Host Type:</label>
                  <select class="form-control" id="hostType">
                      <option value="">All</option>
					  <?php 
						  if(!empty($hostTypeData)){
							  foreach($hostTypeData as $dataval):?>
							  <option value="<?php echo $dataval->id;?>"><?php echo $dataval->host_name;?></option>
							  <?php
							  endforeach;
							  }
						  ?>                      
                  </select>
          </li>
		   <!--
            <li class="form-group col-12 col-md-4">
				
				<label class="col-form-sublabel">Language:</label>
                  <select class="form-control" id="itineraryLang">
                      <option value="">All</option>
					  <?php 
						  if(!empty($itineraryLang)){
							  foreach($itineraryLang as $lang):?>
							  <option value="<?php echo $lang->itinerary_language;?>"><?php echo $lang->itinerary_language;?></option>
							  <?php
							  endforeach;
							  }
						  ?>                      
                  </select>
          </li>
              -->
			
			  
          </ul>
        </div>
        <div class="itinerariesHead-right"> <a href="javascript:void(0);" class="btn btn-primary pr-3 pl-3" id="searchData">Search</a> </div>
      </div>
	   <a href="javascript:void(0);" id="clearDate" class="clearText">clear</a>
    </div>

<!--
    <ul class="nav justify-content-center nav-tabs homeTab mt-4 mb-1" role="tablist">
      <li class="nav-item"> <a class="nav-link active" href="javascript:void(0)" id="walk_data" data-val="1" data-active="<?php echo base_url();?>assets/img/icon/walk/walks_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/walk/walks_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/walk/walks_outline_red.svg" alt="walk" /> Walks</a> </li>
	   <li class="nav-item"> <a class="nav-link" href="javascript:void(0)" id="session_data" data-val="2" data-active="<?php echo base_url();?>assets/img/icon/sessions/sessions_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/sessions/sessions_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/sessions/sessions_outline_blue.svg" alt="sessions" /> Sessions</a> </li>
      <li class="nav-item"> <a class="nav-link" href="javascript:void(0)" id="experience_data" data-val="3" data-active="<?php echo base_url();?>assets/img/icon/experiences/experiences_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/experiences/experiences_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/experiences/experiences_outline_blue.svg" alt="experiences" /> Experiences</a> </li>
      <li class="nav-item"> <a class="nav-link" href="javascript:void(0)" id="meetup_data" data-val="4" data-active="<?php echo base_url();?>assets/img/icon/meetup/meetup_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/meetup/meetup_outline_blue.svg"><img src="<?php echo base_url();?>assets/img/icon/meetup/meetup_outline_blue.svg" alt="meetup" /> Meet-Ups</a> </li>
	  
	  <li class="nav-item last-child" data-toggle="modal" data-target="#soonModal"> <a class="nav-link" href="javascript:void(0)" data-active="<?php echo base_url();?>assets/img/icon/monument/monument_outline_red.svg" data-default="<?php echo base_url();?>assets/img/icon/monument/monument_outline_blue.svg" ><img src="<?php echo base_url();?>assets/img/icon/monument/monument_outline_blue.svg" alt="Monuments"><span>Monuments <small>Buy Tickets</small></span></a> </li>
     
    </ul>-->
    <div class="itinerariesFilter clearfix pt-3 pb-4">
      <!-- <h4 class="font-weight-semibold"><span id="itinerary_count"></span> <span id="itinerary_name"></span></h4> --></div>
    <div class="itinerariesGrid">
      <ul id="ajax_table"></ul>
	  <p class="text-center b-block text-uppercase text-light m-0 pt-3 pb-3" id="empty_data"></p>
      <div class="text-center p-2 pt-3 pb-3"> <a href="#" class="btn btn-link text-default" id="load_more" data-val="0">Load More</a> </div>
    </div>
  </div>
  <div class="bgSpacer splBanner"> <a class="d-block" href="https://docs.google.com/forms/d/e/1FAIpQLSf80xDaLTH8-g-wUDWmo3KTVPYqavMelVBfySGAQlWrzxinBQ/viewform?usp=send_form" target="_blank"><img src="<?php echo base_url();?>assets/img/banners/home/bottom_hire_02_banner.jpg" alt="cityexplorers"/></a></div>
 <!-- <div class="partnerSection">
    <div class="container-fluid">
		<h2 class="text-uppercase">Diverse presence of brand portfolio across media platforms increasing customer satisfaction</h2>

      <div class="partnerSlider">
        <ul class="partnerRoller">
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/tie.jpg" alt="tie" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/bs.jpg" alt="bs" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/ht.jpg" alt="ht" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/taa.jpg" alt="taa" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tc.jpg" alt="tc" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/et.png" alt="et" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tnyt.png" alt="tnyt" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/et.jpg" alt="et" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/toi.jpg" alt="toi" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/it.jpg" alt="it" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/cg.jpg" alt="cg" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/fe.jpg" alt="fe" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tst.jpg" alt="tst" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/ts.png" alt="ts" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/outtrv.png" alt="outtrv" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/thetribune.jpg" alt="thetribune" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tm.png" alt="tm" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/dut.png" alt="dut" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tbn.jpg" alt="tbn" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/hmv.jpg" alt="hmv" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/dj.jpg" alt="dj" /></li>
        </ul>
      </div>
    </div>
  </div>-->
  <div class="moreusSection">
    <div class="container-fluid">
      <h2 class="text-uppercase">More From Us</h2>
	  <ul class="pb-2">
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="heritage heroes&trade;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_01.jpg" alt="heritageheroes" /></a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="gandhi walks&trade;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_02.jpg" alt="gandhiwalks" /></a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="swachh walks&reg;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_03.jpg" alt="swachhwalks" /> </a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="photo walking&reg;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_04.jpg" alt="photowalking" /></a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="gully gyan&reg;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_05.jpg" alt="gullygyan" /></a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="india heritage walks&trade;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_06.jpg" alt="indiaheritagewalks" /></a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="incredible india stories&trade;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_07.jpg" alt="incredibleindiastories" /></a>
                    </li>
                    <li>
                        <a href="#" class="knownMorebox" data-toggle="modal" data-target="#moreusModal" data-rel="party crawl&reg;"><img src="<?php echo base_url();?>assets/img/moreus/moreus_08.jpg" alt="partycrawl" /></a>
                    </li>
                </ul>
    </div>
  </div>
  <div class="newsletterSection" style="background-image: url(<?php echo base_url();?>assets/img/banners/subscribe/banner.jpg)">
    <div class="container-fluid">
      <div class="row align-items-center justify-content-center">
        <div class="col-12 col-sm-12 col-md-6 col-lg-5">
          <div class="form-group">
		  <form id="newsForm">
            <div class="form-row">
			<div class="col-12 pb-2" id="alertMsg"></div>
              <div class="col-12 pb-2">
                <label class="col-form-sublabel text-white">Sign up to our newsletter and get updates</label>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <input type="email" class="form-control" placeholder="Email" id="newsEmail" required autocomplete="off" />				
              </div>
              <div class="col-12 col-md-12 col-lg-4">
                <button class="btn btn-secondary" type="submit" id="newsLetter">Subscribe Now</button>
              </div>
            </div>
			</form>
          </div>
		   <div class="contactText"><span>You can reach us at</span> <span>+91 729 197 2715</span> <span>help@cityexplorers.in</span></div>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-lg-5">
			      <div class="homeContact">
            <div id="alert"></div>

            <form id="contactForm">
              <ul>
                <li>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required autocomplete="off"/>
                </li>
                <li>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required autocomplete="off"/>
                </li>
                <li>
                  <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Your Phone" required autocomplete="off"/>
                </li>
                <li>
                  <textarea class="form-control" id="message"  name="message" placeholder="Write your message" required></textarea>
                </li>
                <li class="text-right">
                  <button class="btn btn-link text-white sendQuery" type="submit">Submit Message</button>
                </li>
              </ul>
            </form>
          </div>
			
			</div>
      </div>
    </div>
  </div>
</main>
<!-- LEAVE MESSAGE -->
<!--
<div class="leaveMessage"> <a href="#" class="msgLink"><b><img src="<?php echo base_url();?>assets/img/icon/mail.svg" alt="mail"></b><span>Leave a message</span></a>
  <div class="messageForm">
    <form id="leaveMessage">
      <h2 class="text-secondary">Leave a message</h2>
      <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a> <strong>Success!</strong> This alert box indicates a successful or positive action. </div>
      <ul class="form-row">
        <li class="form-group col-12">
          <label class="col-form-sublabel">Full Name</label>
          <input type="text" class="form-control" name="fname" placeholder="Full Name" required autocomplete="off" />
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off"/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Phone</label>
          <input type="number" class="form-control" name="phone_no" placeholder="Phone" required autocomplete="off"/>
        </li>
        <li class="form-group col-12">
          <textarea class="form-control" name="desc" placeholder="Write your message (max. 400 chartacters)" maxlength="400" required></textarea>
        </li>
		<input type="hidden" name="currentUrl" value="<?php echo base_url().$currentUrl;?>" autocomplete="off" />
        <li class="form-group col-12 text-right">
          <button class="btn btn-primary" id="sendLeave" type="submit">Send</button>
        </li>
      </ul>
    </form>
  </div>
</div>
-->

<!-- Modal -->
<div class="modal fade" id="soonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
  
      <div class="modal-body"><button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img src="<?php echo base_url();?>assets/img/Monument_Ticket_v2.jpg" alt="#">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



 <!-- MORE FROM US MODAL -->
 <div class="modal fade" id="moreusModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div id="mfu_modal" class="modal-content moreusContent">
                <div class="modal-body">
                    <a class="close" data-dismiss="modal">x</a>
                    <h5 class="modal-title pb-4 pt-2 pl-0"><img id="mfu_logo" src="assets/img/moreus/gandhiwalks_logo.png" alt="gandhiwalks"></h5>
                    <p>We would be delighted to help you explore India in a meaningful way. We are passionate about travel and would love to talk about it with you! </p>
                    <p class="text-uppercase pb-2 pt-2">Please fill in the form below and we will respond to your enquiry promptly</p>
                    <form id="morefrom" class="pt-2">
                        <span class="titleLegend mb-3" id="mfu_legend">ENQUIRY FORM FOR GANDHI WALKS&trade;</span>
                        <input id="mfu_title" type="text" class="hidden" value="GANDHI WALKS" name="mfu_title" required />
                        <ul class="form-row justify-content-center">
                            <li class="form-group col-12 col-sm-6">
                                <!-- <label class="col-form-sublabel">First Name</label> -->
                                <input type="text" class="form-control input-group-sm" name="mfu_first_name" placeholder="First Name" required />
                            </li>
                            <li class="form-group col-12 col-sm-6">
                                <!-- <label class="col-form-sublabel">Last Name</label> -->
                                <input type="text" class="form-control input-group-sm" name="mfu_last_name" placeholder="Last Name" required />
                            </li>
                            <li class="form-group col-12 col-sm-6">
                                <!--  <label class="col-form-sublabel">Email</label> -->
                                <input type="email" class="form-control input-group-sm" name="mfu_email" placeholder="Email" required />
                            </li>
                            <li class="form-group col-12 col-sm-6">
                                <!-- <label class="col-form-sublabel">Phone</label> -->
                                <input type="number" class="form-control input-group-sm" name="mfu_phone" placeholder="Phone" required />
                            </li>
                            <li class="form-group col-12">
                                <label class="col-form-sublabel">Please mention your expectations and any special interest in the theme of the itinerary?</label>
                                <textarea class="form-control" placeholder="The special interest itineraries can include specialized visits, meals, events, meetings and other activities" name="mfu_interest" required></textarea>
                            </li>
                            <li class="form-group col-12">
                                <label class="col-form-sublabel">Would you like to provide more details on your upcoming travel plan? </label>
                                <textarea class="form-control" placeholder="Please use only up to 500 characters" data-rule-maxlength="500" name="mfu_travel_plan" required></textarea>
                            </li>
                            <li class="form-group col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="agreeCheck" name="mfu_agree" value="yes" />
                                    <label class="custom-control-label" for="agreeCheck"> Yes, send me news, updates, and special offers about other City Explorers&trade; products and services</label>
                                </div>
                            </li>
                            <li class="form-group col-12 pt-3 mb-0">
                                <button class="btn btn-secondary pl-4 pr-4" type="submit">Submit</button>
                            </li>
                        </ul>
                    </form>
                    <div class="pt-1">
                        <div class="text-right logoBottom"><img src="<?php echo base_url();?>assets/img/iwl_hr_white_logo.svg" alt="cityexplorers"></div> <small class="d-block pt-2 text-right">Subscribing to City Explorers&trade; newsletters indicates your consent to our Terms and Conditions and Privacy Policy</small>                        </div>
                </div>

            </div>
        </div>
    </div>




<!-- footer start-->
<?php include('footer.php'); ?>
<!-- footer end-->


<!-- foot start-->
<?php include('foot.php');?>
<!-- foot end-->

<script type="text/javascript">
activeUrl = '<?php echo $this->uri->segment(2);?>';
//alert(activeUrl);
$(document).ready(function() {
  var itineraryCount=0;
  var countLoad = 0;
  $('#load_more').data('val',$(this).data('val')+1);
  //var page = $('#load_more').data('val');     
  var page = $('#load_more').attr('data-val');       
  //var serviceId = $('.homeTab').find('.active').data('val');
  var serviceId = '1';
  var privateType = $('input[name="searchPrivate"]:checked').val();
  var groupType = $('input[name="searchGroup"]:checked').val();
  var familyType = $('input[name="searchFamily"]:checked').val();
  var cityid = $('#cityid option:selected').val();
  var date = $('#dobDateInput').val();  
  var themesid = $('#themesid option:selected').val();
  var hostType = $('#hostType option:selected').val();
  var itineraryLang = $('#itineraryLang option:selected').val();
  var serviceName = 'madhya_pradesh';
  var girdClass = 'walkGrid';
  //$('#load_more').trigger('click');
  getMpItineary(page,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass)
  //  countLoad++;  
    // getLoadItinerary(page,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass);

/*	if (activeUrl == 'walk') {
		$('#' + activeUrl + '_data')[0].click();
	} else if (activeUrl == 'session') {
		$('#' + activeUrl + '_data')[0].click();
	} else if (activeUrl == 'experience') {
		$('#' + activeUrl + '_data')[0].click();
	} else if (activeUrl == 'meetup') {
		$('#' + activeUrl + '_data')[0].click();
	} else {
		$(".homeTab li:first-child a")[0].click();
	}
	var itinerary_name = '';
	var serviceId = $('.homeTab').find('.active').data('val');

	if (activeUrl == '') {
		itinerary_name = 'index';
	} else {
		if (serviceId == 1) {
			itinerary_name = 'walk';
			$('#itinerary_name').html('Walks');
			$('#ajax_table').removeAttr('class');
			$('#ajax_table').addClass('walkGrid');
		}
		if (serviceId == 2) {
			itinerary_name = 'session';
			$('#itinerary_name').html('Sessions');
			$('#ajax_table').removeAttr('class');
			$('#ajax_table').addClass('sessionsGrid');
		}
		if (serviceId == 3) {
			itinerary_name = 'experience';
			$('#itinerary_name').html('Experiences');
			$('#ajax_table').removeAttr('class');
			$('#ajax_table').addClass('experienceGrid');
		}
		if (serviceId == 4) {
			itinerary_name = 'meetup';
			$('#itinerary_name').html('Meet-Ups');
			$('#ajax_table').removeAttr('class');
			$('#ajax_table').addClass('meetupGrid');
		}
	}*/

  function getMpItineary(page,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass) {
    $.ajax({
            url:"<?php echo base_url() ?>Home/madhya_pradesh",
            type:'post',
            dataType: "json",
            data: {page:page,serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang}
         }).done(function(html){
          var length = html.iterator.length;
          console.log(html.iterate);
          itineraryCount = parseInt(itineraryCount)+parseInt(length);
      
      if(html.view!=='Empty data'){
           if(countLoad == 0){
           $("#ajax_table > li").remove();         
         var reset = $('#load_more').data('val');
         if(reset>0){
           $('#load_more').data('val',0);
           }
         if(length>=4){
           $("#load_more").show();
           }
          else{
            $("#load_more").hide();
            }  
         }          
        $("#empty_data").html('');
          $("#ajax_table").append(html.view);
        $('#itinerary_count').html(itineraryCount);
       }
      else{           
         if(countLoad == 0){
           $("#ajax_table li").remove();
         }        
          $("#empty_data").html('No Data Available.');        
          $("#load_more").hide();
        $('#itinerary_count').html();
         }      
         $('#ajax_table').removeAttr('class');      
           $('#ajax_table').addClass(girdClass);
     
        });
  }

});

(function($) {

// RATING 
$('.iwlRating').ffrating({
    isStar: true,
    readonly: true,
    showSelectedRating: true,
    min: 1,
    max: 5
});

// DATE PICKER
$('#dobDateInput').dateRangePicker({
    format: 'DD-MM-YYYY',
    autoClose: true,
    singleDate: true,
    showTopbar: false,
    singleMonth: true,
    selectForward: true,
    startDate: new Date()
});

$(document).on('click', '#clearDate', function(e) {
    e.stopPropagation();
    $('#dobDateInput').data('dateRangePicker').clear();
});

//IMAGE SLIDER
$('#heroCarousel').carousel({
	interval: 7000,
	pause: false
});

$('.homeTab .nav-link').on('click',function(){
	$(this).addClass('active');
	$(this).parent('li').siblings().find('a').removeClass('active');
});

// SERVICE CLICK
var itineraryCount=0;
var countLoad = 0;
$("#load_more").click(function(e){
	e.preventDefault();
	$('#load_more').data('val',$(this).data('val')+1);	
	var page = $(this).attr('data-val');
	page = parseInt(page) + 1;
	$('#load_more').attr('data-val',page);	
	//alert(page);
	//var serviceId = $('.homeTab').find('.active').data('val');
  	var serviceId = '1';
	var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();	
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	if(serviceId==1){
		// var serviceName = 'walk';
     var serviceName = 'madhya_pradesh';
		 var girdClass = 'walkGrid';
		}
	/*if(serviceId==2){
		 var serviceName = 'session';
		 var girdClass = 'sessionsGrid';
		}
    if(serviceId==3){
		 var serviceName = 'experience';
		 var girdClass = 'experienceGrid';
		}
	if(serviceId==4){
		 var serviceName = 'meetup';
		 var girdClass = 'meetupGrid';
		}*/
	 countLoad++;	  
     getLoadItinerary(page,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass);
});

//==================== Walk Services js ===============//
$('#walk_data').on('click',function(){
	var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;	
    if(serviceId==1){
		var serviceName = 'mp_walk';
		$('#itinerary_name').html('Walks');		
		} 
	 history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'home/madhya_pradesh');	
	countLoad = 0;
	itineraryCount =0;	
	var girdClass = 'walkGrid';
	getLoadItinerary(0,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass);
});


//==================== Session Services js ===============//
$('#session_data').on('click',function(){
	var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;
    if(serviceId==2){
		var serviceName = 'session';
		$('#itinerary_name').html('Sessions');
	}
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'home/session');
	countLoad = 0;
	itineraryCount =0;
	var girdClass = 'sessionsGrid';
	getLoadItinerary(0,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass);
});
//================= experience data js ================//
$('#experience_data').on('click',function(){
	var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;
    if(serviceId==3){
		var serviceName = 'experience';
		$('#itinerary_name').html('Experiences');
		}  
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'home/experience');	
	countLoad = 0;
	itineraryCount =0;
	var girdClass = 'experienceGrid';
	getLoadItinerary(0,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass);
	
	   
});
//================= Meet-Up data js ================//
$('#meetup_data').on('click',function(){
	var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var proceed = true;
	
    if(serviceId==4){
		var serviceName = 'meetup';
		$('#itinerary_name').html('Meet-Ups');
		}
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'home/meetup');	
	countLoad = 0;
	itineraryCount =0;
	var girdClass = 'meetupGrid';
	getLoadItinerary(0,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass);
	
});


//========= click load more function start==========//
var getLoadItinerary = function(page,serviceId,serviceName,privateType,groupType,cityid,date,themesid,familyType,hostType,itineraryLang,girdClass){
           $("#loader").show();	           
          // var serviceName = 'madhya_pradesh';
           $.ajax({
            url:"<?php echo base_url() ?>Home/"+serviceName,
            type:'post',
			dataType: "json",
            data: {page:page,serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang}
         }).done(function(html){
		  var length = html.iterator.length;
		  itineraryCount = parseInt(itineraryCount)+parseInt(length);
		  
		  if(html.view!=='Empty data'){
		       if(countLoad == 0){
			     $("#ajax_table > li").remove();				 
				 //var reset = $('#load_more').data('val');
				 var reset = $('#load_more').attr('data-val');
				 if(reset>0){
					// $('#load_more').data('val',0);
					 $('#load_more').attr('data-val',0);
					 }
				 if(length>=8){
					 $("#load_more").show();
					 }
				  else{
					  $("#load_more").hide();
					  }	 
			   }			    
				$("#empty_data").html('');
			    $("#ajax_table").append(html.view);
				$('#itinerary_count').html(itineraryCount);
			 }
		  else{ 		      
			   if(countLoad == 0){
			     $("#ajax_table li").remove();
			   }				
			    $("#empty_data").html('No Data Available.');				
			    $("#load_more").hide();
				$('#itinerary_count').html();
			   }			
			   $('#ajax_table').removeAttr('class');			
		       $('#ajax_table').addClass(girdClass);
		 
        });
    };


//============== Searching data js ==========================//
$('#searchData').on('click',function(){
	var searchType = '';
  var privateType = $('input[name="searchPrivate"]:checked').val();
	var groupType = $('input[name="searchGroup"]:checked').val();
	var familyType = $('input[name="searchFamily"]:checked').val();
	var cityid = $('#cityid option:selected').val();
	var date = $('#dobDateInput').val();
	var serviceId = '1';
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var itineraryLang = $('#itineraryLang option:selected').val();
	var serviceName = 'mp-walk';
	var proceed = true;	
	itineraryCount = 0;
	/*if(serviceId==1){
		var serviceName = 'mp-walk';
		}
    if(serviceId==2){
		var serviceName = 'mp-session';
		}
   if(serviceId==3){
		var serviceName = 'mp-experience';
		}
  if(serviceId==4){
		var serviceName = 'mp-meetup';
		}*/
	
	if(proceed){	
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>home/servicetab_search',
			 data:{searchType:searchType,serviceId:serviceId,privateType:privateType,groupType:groupType,cityid:cityid,date:date,themesid:themesid,familyType:familyType,hostType:hostType,itineraryLang:itineraryLang},
			 dataType:'json',
			 success:function(html){
			 var length = html.iterator.length;
		    itineraryCount = parseInt(itineraryCount)+parseInt(length);
		  
			  if(html.view!=='Empty data'){
			    $("#ajax_table li").remove();
				$("#empty_data").html('');
				$('#itinerary_count').html(itineraryCount);
			    $("#ajax_table").append(html.view);				
				 }
			else{
			    $("#ajax_table li").remove();
				//$("#empty_data").remove();
				$('#itinerary_count').html('');
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
			   }
		    }
			});
		}
});



//============= Leave Message Js Start on 08-02-19 =============//
$('#leaveMessage').validate({
				errorElement: 'small',
				submitHandler: function() {				
					var formData = $('#leaveMessage').serialize();
					var proceed = true;
					if(proceed){
						$.ajax({
							 type:'post',
							 url:'<?php echo base_url()?>home/leaveMessage',
							 data:formData,
							 success:function(html){
								  if(html=='success'){
									  $('.msgLink').trigger('click');
									  $("#leaveMessage")[0].reset();
									  }else{
										console.log('error');
									  }												  
								 }
							});
						}
					
				}
	});

$(document).on('click', '.homeTab li a', function(e) {
    e.stopPropagation();
    $('.homeTab li a').each(function() {
					    var $defaultURL = $(this).attr('data-default');
        $(this).find('img').attr('src', $defaultURL);
    });
    var $this = $(this);
    var $thisImage = $this.find('img');
    var $activeURL = $this.attr('data-active');
    var $defaultURL = $this.attr('data-default');
    var $listItem = $(this).closest('li');
    var $listSiblings = $listItem.siblings();
    var $itemAnchor = $listSiblings.find('a');
    $thisImage.attr('src', $activeURL);
    $itemAnchor.removeClass('active');
    $(this).addClass('active');
});


	function contactQueryForm(){
		var formData = $('#contactForm').serialize();
				var proceed = true;
				$('.sendQuery').html('Sending');
				if(proceed){
						$.ajax({
								type:'post',
								url:'<?php echo base_url()?>Footer/sendContactForm',
								data:formData,
								success:function(html){
										$('.sendQuery').html('Submit Message')
										if(html=='success'){
													$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
											$('#contactForm')[0].reset();
											}
										else{
											$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
											$('#contactForm')[0].reset();
											/* $('#alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>Somthing is wrong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>'); */
											}	   
									}
							});
					}
			}
	$("#contactForm").validate({
			errorElement: 'small',
				submitHandler: function() {		 
				contactQueryForm();
				}
	});

//=========== News Letters JS function ===========//
$("#newsForm").validate({
			errorElement: 'small',
			submitHandler: function() {		 
			subscribeForm();
		}
	});
	
function subscribeForm(){
	var newsEmail = $('#newsEmail').val();
	proceed = true;
	
	if(newsEmail==''){
		 proceed = false;
		 return false;
		}
	if(proceed){
		 $.ajax({
			   type:'post',
			   url:'<?php echo base_url()?>Home/newsLetter',
			   data:{email:newsEmail},
			   success:function(html){
				    if($.trim(html)=='success'){
						 $('#alertMsg').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Your News Subscribe Email Insert Successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
						$('#newsForm')[0].reset();
						}
					else if($.trim(html)=='db_error'){
						 $('#alertMsg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>somthing is wrong with data base.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
						}
					else if($.trim(html)=='email_error'){
						  $('#alertMsg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>Your Email Already Exist.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
						}	
				   }
			 });
		}	
}


           // MORE FROM US
		   $(document).on('click', '.knownMorebox', function(e) {
                e.stopPropagation();
                var rel = $(this).attr('data-rel');
                var name = rel.substring(0, rel.length - 1);
                var logoSrc = '<?php echo base_url();?>assets/img/moreus/' + name.replace(/\s/g, '') + '_logo.png';
                $('#mfu_legend').text('ENQUIRY FORM FOR ' + rel)
                $('#mfu_title').val(name);
                $('#mfu_logo').attr('src', logoSrc).attr('alt', name);
                $('#mfu_modal').addClass(name.replace(/\s/g, '')).css('background-image', 'url("<?php echo base_url();?>assets/img/moreus/' + name.replace(/\s/g, '') + '_modal.jpg")');
            });

            var validMoreus = $("#morefrom").validate({
                errorElement: 'small',
                errorPlacement: function(error, element) {
                    error.appendTo(element.closest("li"));
                },
                submitHandler: function() {
                  //  alert($('form').serialize());
                  var formData = $('#morefrom').serialize();
                  $.ajax({
                    type:'post',
                    url:'<?php echo base_url()?>Home/moreAboutUsForm',
                    data:formData,
                    success:function(html){
                        if(html=='success'){
                          $('#alert_2').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                          $('form')[0].reset();
                          }
                        else{
                          $('#alert_2').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
                          $('form')[0].reset();
                               }
                              //  $("html, body").animate({ scrollTop: 20 }, "slow");            

                          }
                  })

                    $('#moreusModal').modal('hide');
                    alert('Success! Your message has been send successfully.');

                }
            });

            $('#moreusModal').on('hidden.bs.modal', function(e) {
                $("#morefrom").trigger("reset");
                validMoreus.resetForm();

            });

})(jQuery);
</script>
</body>
</html>