<!--head end-->
<?php include('head.php');?>
<!--head end-->

<!-- header start-->
<?php include('header.php');?>
<!-- header end-->

<main>
  <div class="heroBanner">
    <div class="bannerLayer" style="background-image: url(<?= base_url('assets/img/banners/home/banner.jpg')?>)"></div>
    <!--    <div class="bannerText">
      <p>Gwalior Fort is a hill fort near Gwalior, Madhya Pradesh, central India. The fort has existed at least since the 10th century, and the inscriptions and monuments found within what is now the fort campus</p>
    </div>-->
  </div>


  <div class="container-fluid">
    <div class="pageSearch clearfix">
      <div class="itinerariesHead clearfix">
        <form action="<?= base_url('hosters')?>" method="post">
          <div class="itinerariesHead-left">
            <h3 class="col-form-label pt-0 text-capitalize text-dark">Find Your Tour</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-6">
                <label class="col-form-sublabel"></label>
                <select class="form-control" name="searchCity" id="searchCity">
                  <option value="All">All</option>
                  <option value="Bhopal"<?php if( $city == ''){}elseif($city == "Bhopal"){ echo 'selected="selected"'; } ?>>Bhopal</option>
                  <option value="Gwalior"<?php if( $city == ''){}elseif($city == "Gwalior"){ echo 'selected="selected"'; } ?>>Gwalior</option>
                  <option value="Indore"<?php if( $city == ''){}elseif($city == "Indore"){ echo 'selected="selected"'; } ?>>Indore</option>
                  <option value="Khajuraho"<?php if( $city == ''){}elseif($city == "Khajuraho"){ echo 'selected="selected"'; } ?>>Khajuraho </option>
                  <option value="Orchha"<?php if( $city == ''){}elseif($city == "Orchha"){ echo 'selected="selected"'; } ?>>Orchha</option>
                </select>
              </li>
              <li class="form-group col-12 col-md-6">
                <label class="col-form-sublabel">Select a dates</label>
                <input type="text" id="searchDateInput" class="form-control dateIcon rightSide" name="searchDate" placeholder="Select a dates" value="" autocomplete="off"/><a href="#" id="clearDate" class="clearText">clear</a>
              </li>
              <!-- <li class="form-group col-12 col-md-6 pt-4">
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="individualFilter" name="searchCat" class="custom-control-input" />
                <label class="custom-control-label" for="individualFilter">Private</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="groupFilter" name="searchCat" class="custom-control-input" />
                <label class="custom-control-label" for="groupFilter">Group</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="familyFilter" name="searchCat" class="custom-control-input" />
                <label class="custom-control-label" for="familyFilter">Family</label>
              </div>
            </li> -->
            </ul>
          </div>
          <div class="itinerariesHead-right">
            <input type="submit" name="search" class="btn btn-primary pr-3 pl-3">
          </div>
        </form>
      </div>
    </div>

    <!--    <div class="itinerariesFilter clearfix">
      <div class="advtSpace"> <img src="<?= base_url('assets/img/advt/ad_v1.jpg')?>" alt="advtSpace"/> </div>
      <h4 class="col-form-label text-capitalize text-primary float-left font-weight-semibold">I am looking for:</h4>
      <ul class="row float-left">
        <li class="form-group m-0 mt-2 mb-2 col">
          <label class="col-form-sublabel">Service Type</label>
          <select class="form-control">
            <option>Select</option>
            <option>Theme 01</option>
          </select>
        </li>
        <li class="form-group m-0 mt-2 mb-2 col">
          <label class="col-form-sublabel">Theme</label>
          <select class="form-control">
            <option>Select</option>
            <option>Theme 01</option>
          </select>
        </li>
      </ul>
    </div>-->
    <div class="text-center mr-5 ml-5" style="background: #ef464d"> <img src="assets/img/advt/ad_v1.jpg" alt="advtSpace"/> </div>


    <div class="itinerariesGrid pt-2">
      <ul>
        <?php foreach($data as $key=>$values):?>
        <li>
          <div class="itinerariesBox">
            <div class="itinerariesBox-img">
              <p><img src="<?= base_url('assets/img/icon/walks_fill_red.svg')?>" alt="walk"/> Walk</p>
                <?php $feature_img = $data[$key]->feature_img;?>
              <img src="<?= base_url("assets/img/Itineraries/feature/$feature_img")?>" alt="banner_01"/> </div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title">
                <?php echo $data[$key]->itinerary_title;?>
                <?php $profile_img = $data[$key]->profile_img;?>
              </h2>
              <p class="itinerariesBox-user"> <span class="itinerariesBox-userimg"><img src="<?= base_url("assets/img/profile/$profile_img")?>" alt="Profile" /></span> with
                <?php echo $data[$key]->host_first_name;?><small class="itinerariesBox-verify"><!-- <b class="callVerify"> <img src="<?= base_url('assets/img/icon/internal.svg')?>" alt="iwl_Verified" /> </b> --></small> </p>
              <h2 class="itinerariesBox-state"><img src="<?= base_url('assets/img/icon/loc_fill_red.svg')?>" alt="Loc" /><?php echo $data[$key]->origin_city;?></h2>
              <p class="itinerariesBox-area">
                <?php $location_covered =  $data[$key]->location_covered; 
                            strlen($location_covered);
                       echo $locat_cove= substr($location_covered, 0, 20);?>
              </p>
              <p class="itinerariesBox-theme"><span class="d-block">Date & Time:</span>
                <?php $start_date = date('d/m/Y',strtotime($data[$key]->start_date_from_host)); $start_time = date('h:i A',strtotime($data[$key]->default_start_time));  echo $start_date.' | '.$start_time ?>
              </p>
              <p class="itinerariesBox-theme"><span class="d-block">Themes:</span>
                <?php echo $data[$key]->itinerary_theme;?>
              </p>
              <p class="itinerariesBox-text">
                <?php     $desc = $data[$key]->itinerary_description;
                        strlen( $desc);
                       echo $small = substr($desc, 0, 80).'...';

                ?>
              </p>
              <p class="itinerariesBox-tag">Private </p>
               <!-- <p class="itinerariesBox-tag">Private | Group | Family</p> -->

              <ul class="itinerariesBox-other">
                <li><span>Price:</span> ₹
                  <?php echo $data[$key]->private_price?>
                </li>
                <!-- <li><span>Average Rating:</span>
                  <input type="textbox" class="ff-rating iwlRating" value="4" />
                </li> -->
              </ul>
              <div class="itinerariesBox-links">
                <!-- <a href="#" class="btn btn-primary btn-lg">View</a> -->
                <?php $id = $data[$key]->id ?>
                <?=  anchor("viewitineraries/{$id}", 'View',['class'=>'btn btn-secondary mr-1 ml-1 pr-3 pl-3']) ?>
                <?=  anchor("bookitineraries/{$id}", 'Book',['class'=>'btn btn-primary mr-1 ml-1 pr-3 pl-3']) ?>
              </div>
            </div>
          </div>

        </li>
        <?php endforeach; ?>
      </ul>
      <div class="text-center p-2 pt-3 pb-3"> <a href="#" class="btn btn-link">Load More</a> </div>
    </div>
  </div>
  <div class="text-center mt-2" style="background: #ef464d"> <img src="assets/img/advt/ad_v1.jpg" alt="advtSpace"/> </div>

  <!--  <div class="partnerSection">
    <div class="container-fluid">
      <h2>Our Travel Partners</h2>
      <div class="partnerSlider">
        <ul class="partnerRoller owl-carousel owl-theme">
          <li class="item"><img src="<?= base_url('assets/img/partner/airbnb.jpg')?>" alt="airbnb"/>
          </li>
          <li class="item"><img src="<?= base_url('assets/img/partner/indigo.jpg')?>" alt="indigo"/>
          </li>
          <li class="item"><img src="<?= base_url('assets/img/partner/mmt.jpg')?>" alt="mmt"/>
          </li>
          <li class="item"><img src="<?= base_url('assets/img/partner/oyo.jpg')?>" alt="oyo"/>
          </li>
          <li class="item"><img src="<?= base_url('assets/img/partner/tripadvisor.jpg')?>" alt="tripadvisor"/>
          </li>
          <li class="item"><img src="<?= base_url('assets/img/partner/trivago.jpg')?>" alt="trivago"/>
          </li>
        </ul>
      </div>
    </div>
  </div>-->

  <div class="newsletterSection" style="background-image: url(assets/img/banners/home/banner.jpg)">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-12 col-lg-1"></div>
        <div class="col-12 col-sm-12 col-lg-5">
          <div class="form-group">
            <div class="form-row">
              <div class="col-12 col-lg-8">
                <label class="col-form-sublabel text-white">Sign up to our newsletter and get updates</label>
                <input type="email" class="form-control" placeholder="Email">
              </div>
              <div class="col-12 col-lg-4">
                <button class="btn btn-secondary">Subscribe Now</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-lg-6 contactText"><span>You can reach us at</span> <span>+91 729 197 2715</span> <span>ask@iwl.help</span>
        </div>
      </div>
    </div>
  </div>


</main>

<!-- footer start-->
<?php include('footer.php'); ?>
<!-- footer end-->

<!-- foot start-->
<?php include('foot.php');?>
<!-- foot end-->
<script type="text/javascript" src="<?= base_url('assets/dependencies/Net-Promoter-Score-Rating-Plugin-jQuery/scripts/ffrating.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dependencies/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')?>"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/dependencies/jquery-date-range-picker-master/dist/jquery.daterangepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/global_function.js')?>"></script>
<script type="text/javascript">
(function($) {
// RATING 
 // $('.iwlRating').ffrating({
 //   isStar:true,
 //   readonly:true,
 //   showSelectedRating:true,
 //   min:1,
 //   max:5
 // });

 
  $('#searchDateInput').dateRangePicker({
  format: 'DD-MM-YYYY',
  autoClose: true,
  singleDate : true,
  showTopbar: false,
  singleMonth: true,
  selectBackward: true,
  startDate: new Date(),
}).bind('datepicker-change', function(evt, obj) {
  $('#clearDate').show();
}); 

  
if (!$('#searchDateInput').val() == ""){
  $('#clearDate').show();
  }

$(document).on('click','#clearDate', function(e){
  e.preventDefault();
  e.stopPropagation();
  $(this).hide();
  $('#searchDateInput').data('dateRangePicker').clear();
}); 

  
  // PARTNER SILDER   
    // var dateOwl = $('.partnerRoller');
    // dateOwl.owlCarousel({
    //     margin: 10,
    //     nav: false,
    //     dots: false,
    // loop:true,
    //     mouseDrag: false,
    // autoplay: true,
    // autoplayTimeout:2000,
    //     responsive: {
    //         0: {
    //             items: 1,
    //         },
    //         425: {
    //             items: 2,
    //         },
    //         768: {
    //             items: 4,
    //         },
    //   1024: {
    //             items: 5,
    //         },
    //   1200: {
    //             items: 6,
    //         }
    //     }
    // }); 
})(jQuery);
</script>
</body>
</html>
