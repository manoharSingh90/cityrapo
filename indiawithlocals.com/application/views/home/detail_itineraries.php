<?php include('head.php');?>
<!-- header start-->
<?php include('header.php');?>
<!-- header end-->
<main>
  <div class="detailPage">
    <?php $cover_img = $itineraries_detail->cover_img;?>
    <div class="coverBox" style="background-image:url(<?= base_url("assets/img/Itineraries/cover/$cover_img")?>);"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="mainIntro boxStyle">
            <div class="mainIntro-top"> 
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8
  c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"></path>
              </svg>&nbsp<?=  anchor('home', 'Back',['class'=>'text-uppercase']) ?>



             </div>
            <div class="mainIntro-head">
              <h2 class="introTitle"><?php echo $itineraries_detail->itinerary_title;?></h2>
              <!-- <div class="introRating">
                <input type="textbox" class="ff-rating iwlRating" value="3" />
              </div> -->
              <?php $profile_img = $itineraries_detail->profile_img;?>
              <p class="introUser"> <span class="introUser-img"><img src="<?= base_url("assets/img/profile/$profile_img")?>" alt="Profile"></span> with <?php echo $itineraries_detail->host_first_name;?>  </p>
            </div>
            <div class="mainIntro-body clearfix">
              <h3 class="introSubtitle"><?php echo $itineraries_detail->itinerary_tagline;?></h3>
              <p><?php echo  $itineraries_detail->itinerary_description?></p>
              <p class="intro-theme"><span>Themes&nbsp:&nbsp</span><?php echo $itineraries_detail->itinerary_theme;?></p>
              <small class="intro-duration">Total Duration&nbsp:&nbsp<?php echo $itineraries_detail->total_duration?></small> </div>
          </div>
          <div class="bookIntro boxStyle">
            <h3 class="normalTitle float-left">Make a Booking</h3>
            <p class="bookIntro-date"> <span class="smallTitle">Travel Dates</span>
              <?php
              $start_date = date('d/m/Y',strtotime($itineraries_detail->start_date_from_host));
              $end_date = date('d/m/Y',strtotime($itineraries_detail->end_date_to_host));
              
             
             echo $start_date ?>&nbsp&nbsp<?php echo $end_date ?></p>
            <div class="bookIntro-cost">
              <ul>
                <li> <span>Private</span> Rs.<?php echo $itineraries_detail->private_price?></li>
                <!-- <li> <span>Group</span> Rs. <?php echo $itineraries_detail->group_price?></li>
                <li> <span>Family</span><small>Adults</small> Rs.<?php echo $itineraries_detail->family_price_adults?></li>
                <li> <small class="kids">kids (Below 10)</small> Rs. <?php echo $itineraries_detail->family_price_kids?></li>
                <li> <small class="kids">kids (Below 6)</small> Rs. <?php echo $itineraries_detail->family_price_kids?></li>
                <li> <small class="kids">kids (Below 4)</small> Rs. 0 </li> -->
              </ul>
            </div>
            <div class="bookIntro-addcost">
             <!--  <p class="smallTitle">Additional Costs</p> -->
              <ul>
                <!-- <li> <span>Caps</span> Rs. <?php echo $itineraries_detail->additional_price?></li>
                <li> <span>Slippers</span> Rs. <?php echo $itineraries_detail->additional_price?></li>
                <li> <span>Water Bottle </span> Rs. <?php echo $itineraries_detail->additional_price?></li>
                <li> <span>Carry Bag </span> Rs. <?php echo $itineraries_detail->additional_price?></li> -->
              </ul>
            </div>
            <?php $id = $itineraries_detail->id ?>
            <?=  anchor("bookitineraries/{$id}", 'Book',['class'=>'btn btn-primary btn-lg bookLink']) ?>
             </div>
        </div>
        <div class="col-12 col-lg-4">
          <div class="stateIntro boxStyle">
            <h3 class="stateName"><img src="<?= base_url('assets/img/icon/loc_fill_red.svg'); ?>" alt="Loc"> <?php echo $itineraries_detail->origin_city;?></h3>
            <p class="stateCovered smallTitle">Locations Covered</p>
            <p class="stateArea"><?php echo $itineraries_detail->location_covered; ?></p>
          </div>
<div class="otherIntro p-0">
            <div class="advtSpace"> <img src="<?= base_url('assets/img/advt/banner.jpg'); ?>" alt="advtSpace"> </div>
          </div>

        <!--   <div class="otherIntro boxStyle">
            <h3 class="normalTitle text-center">Languages</h3>

                           <div class="highList pb-4">
              <ul class="clearfix">
           
                     <li class="roundedBox">English</li>
                           <li class="roundedBox">Hindi</li>



                  
              </ul>
             </div>


            <h3 class="normalTitle text-center">Highlights & Features</h3>
            <div class="highList">
              <p class="smallTitle">Highlights</p>
              <ul class="clearfix">
                <?php  
                    $type_highlig = explode(',',$itineraries_detail->type_highlights);
                    $highlig_count   = count($type_highlig);
                    for ($i=0; $i < 6 ; $i++) { ?>
                     <li class="roundedBox"><?php echo $type_highlig[$i] ?></li>
                  <?php  } ?>


                  
              </ul>
              <a href="#" class="mt-3 mb-3" data-toggle="modal" data-target="#moreHighlightModal">View More</a></div>
            <div class="featList">
              <p class="smallTitle">Features</p>
              <ul class="clearfix">
                <?php  
                    $type_featur = explode(',',$itineraries_detail->type_features);
                    $featurt_count   = count($type_featur);
                    for ($i=0; $i < 3 ; $i++) { ?>
                      <li><span><img src="<?= base_url('assets/img/icon/bus.svg')?>" alt="#"></span><?php echo $type_featur[$i] ?></li>
                  <?php  } ?>
                
                
              </ul>
              <a href="#" class="mt-3" data-toggle="modal" data-target="#moreFeatureModal">View More</a></div>
          </div> -->
        </div>
      </div>
      <div class="extraIntro">
        <ul class="nav justify-content-center nav-tabs iwlTab" role="tablist">
       <!--    <li class="nav-item"> <a class="nav-link text-uppercase active" id="overview-tab" data-toggle="tab" href="#overviewData" role="tab" aria-controls="overviewData" aria-selected="true">Walk Overview</a> </li> -->
          <li class="nav-item"> <a class="nav-link text-uppercase active" id="addinfo-tab" data-toggle="tab" href="#addinfoData" role="tab" aria-controls="addinfoData" aria-selected="true">Additional Info</a> </li>
          <li class="nav-item"> <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faqData" role="tab" aria-controls="faqData" aria-selected="false">FAQ’s</a> </li>
        </ul>
        <div class="tab-content iwlTab-content">
          <!-- <div class="tab-pane fade show " id="overviewData" role="tabpanel" aria-labelledby="overview-tab">
            <div class="overviewBox">
              <div class="row">
                <div class="col-12 col-lg-6">
                  <div id="map" class="mapBox"></div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="modeBox">
                    <h4>Mode</h4>
                    <ul>
                      <li><span><img src="<?= base_url('assets/img/icon/auto.svg')?>" alt="#"></span>Auto</li>
                      <li><span><img src="<?= base_url('assets/img/icon/auto.svg')?>" alt="#"></span>On Foot</li>
                    </ul>
                  </div>
                </div>
              </div>
              <ul class="tlTour">
                <li>
                  <h5>Pick up from HKV Metro Stations Gate 1</h5>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas 
                    molestias sint occaecati cupiditate non provident, similique. </p>
                </li>
                <li>
                  <h5>Hauz Khas VIllage</h5>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et. </p>
                </li>
                <li>
                  <h5>Hauz Khas Lake</h5>
                  <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique.</p>
                </li>
              </ul>
              <h4 class="mt-3">Connectivity</h4>
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="connectBox">
                    <h5>Nearest Airport</h5>
                    <p><?php echo $itineraries_detail->nearest_airport ?></p>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="connectBox">
                    <h5>Nearest Railway</h5>
                    <p><?php echo $itineraries_detail->nearest_railway_station ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
          <div class="tab-pane fade active show" id="addinfoData" role="tabpanel" aria-labelledby="addinfo-tab">
            <div class="adinfoBox">
     <!--          <h3>Gallery</h3>
              <div class="row">
                <div class="col-12 col-lg-9">
                  <div class="videoPlay">
                    <video controls>
                      <source src="<?php echo base_url("assets/img/set/$itineraries_detail->video")?>" type="video/mp4">
                      Your browser does not support HTML5 video. </video>
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="imageList">
                  <div class="imagePlayer"><img src=" <?= base_url("assets/img/set/$itineraries_detail->additional_img_1")?>" alt="image"></div>
                  <div class="imagePlayer"><img src="<?= base_url("assets/img/set/$itineraries_detail->additional_img_2")?>" alt="image"></div>
                        <div class="imagePlayer"><img src="<?= base_url("assets/img/set/$itineraries_detail->additional_img_3")?>" alt="image"></div></div>
                </div>
              </div> -->
              <h3>More Information</h3>
              <ul>
                <li> <span>Languages Offered:</span><?php echo $itineraries_detail->prefer_languages ?></li>
                <li> <span>Inclusions:</span><?php echo $itineraries_detail->itinerary_inclusions?></li>
                <li> <span>Exclusions:</span><?php echo $itineraries_detail->itinerary_exclusions?> </li>
                <li> <span>Special Mentions:</span><?php echo $itineraries_detail->itinerary_spl_mention?></li>
              </ul>
            </div>
          </div>
          <div class="tab-pane fade" id="faqData" role="tabpanel" aria-labelledby="faq-tab">
            <div class="faqBox">
              <h3>Frequently asked questions</h3>
              <ul>
                <li>
                  <h4 class="faqQuestion">What is City Walks Festival Madhya Pradesh?</h4>
                  <div class="faqAnswer">
                    <p>City Walks Festival Madhya Pradesh is organized by India With Locals™ and supported by Madhya Pradesh Tourism Board to involve locals in heritage awareness through cultural walks in their cities.</p>
                  </div>
                </li>
                <li>
                  <h4 class="faqQuestion">Can anyone attend a Walk Without Registering for it on India With Locals™ website?</h4>
                  <div class="faqAnswer">
                    <p>To take part in any walks in any of the cities, one must have registered himself / herself on India With Locals™ website and booked a ticket for the preferred walk.</p>
                  </div>
                </li>
                <li>
                  <h4 class="faqQuestion">Can anyone join on spot or can I bring another person with me?</h4>
                  <div class="faqAnswer">
                    <p> All walk participants must be pre-registered for the Walk they want to attend and No on spot participation will be entertained. Only those who have valid ticket will be allowed to attend the walk, if you wish to bring any extra person, kindly book ticket separate tickets for all those who wish to attend the walks.</p>
                  </div>
                </li>
                <li>
                  <h4 class="faqQuestion">Will the cost of Food & Entry Tickets be included in the Ticket Price?</h4>
                  <div class="faqAnswer">
                    <p>The registration for a walk and booked ticket only allows the participant to attend the Walk. All other costs such as Cost of food consumed on the Food Walks, Cost of Entry Tickets (If Any), etc. are to be paid by the participants directly.</p>
                  </div>
                </li>
                <li>
                  <h4 class="faqQuestion">Emergency Contacts – </h4>
                  <div class="faqAnswer">
                    <p>Please call on any of the below number in case of any emergency or queries.
+91 72919 72715 / + 91 72919 72713 / +91 98996 92790</p>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<!-- footer start-->
<?php include('footer.php'); ?>
<!-- footer end-->

<!-- MORE HIGHLIGHT MODAL -->
<div class="modal fade" id="moreHighlightModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Highlights</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="highList modalList">
          <ul class="clearfix">
           <?php for ($i=0; $i < $highlig_count ; $i++) { ?>
                     <li class="roundedBox"><?php echo $type_highlig[$i] ?></li>
                  <?php  } ?>
            
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- MORE FEATURES MODAL -->
<div class="modal fade" id="moreFeatureModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="featList modalList">
          <ul class="clearfix">
            <?php  
                for($i=0; $i < $featurt_count ; $i++) { ?>
                      <li><span><img src="<?= base_url('assets/img/icon/bus.svg')?>" alt="#"></span><?php echo $type_featur[$i]; ?></li>
            <?php  } ?>
            
           
            
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- SCRIPT --> 
<?php include('foot.php');?>
<script type="text/javascript" src="<?= base_url('assets/dependencies/Net-Promoter-Score-Rating-Plugin-jQuery/scripts/ffrating.js')?>"></script> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="<?= base_url('assets/js/global_function.js')?>"></script>
<!-- <script type="text/javascript">
var center = new google.maps.LatLng(28.5681057, 77.2340717);

function initialize() {
  
    var mapOption = {
        center: center,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapVar = new google.maps.Map(document.getElementById("map"), mapOption);

  var markerPointer = new google.maps.Marker({
    position: center,
    });

  markerPointer.setMap(mapVar);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script> -->
 
<script type="text/javascript">
(function($) {
// RATING 
 $('.iwlRating').ffrating({
	 isStar:true,
	 readonly:true,
	 showSelectedRating:true,
	 min:1,
	 max:5
 });

    
// FAQ
  $(document).on('click', '.faqQuestion', function() {
      var $this = $(this);
      var $parent = $this.closest('li');
      var $answer = $parent.find('.faqAnswer');
      var $otheranswer = $parent.siblings().find('.faqAnswer');
      var $otherquestion = $parent.siblings().find('.faqQuestion');
      $this.toggleClass('active');
      $answer.slideToggle();
      $otherquestion.removeClass('active');
      $otheranswer.slideUp();
});  
    

})(jQuery);
</script>
</body>
</html>
