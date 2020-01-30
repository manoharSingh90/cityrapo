<!--head end-->
<?php include('head.php');?>
<!--head end-->
<!--<script type="text/javascript">

// function searchHoster(){
//   alert("heelo");
//   var searchKey  = $('#searchCity').val();

//   if(searchKey=='' || searchKey=='Null'){
//    $('#search_error').show();
//    return false;
//   }

//   if(!empty(searchKey)){
//      $('#search_error').hide();
//       return  true;
//   }


// }
</script> -->
<!-- header start-->
<?php include('header.php');?>
<!-- header end-->

<main>
  <div class="heroBanner">

          <div class="carousel slide carousel-fade" >
<!--        <ol class="carousel-indicators">
          <li data-slide-to="0" class="active"></li>
          <li data-slide-to="1"></li>
          <li data-slide-to="2"></li>
        </ol>-->
        <div class="carousel-inner">
          <div class="carousel-item active" style="background-image:url(<?= base_url('assets/img/banners/home/banner_01.jpg')?>);"> <img src="<?= base_url('assets/img/banners/home/banner_01.jpg')?>" alt="banner_01" /> </div>
          <div class="carousel-item " style="background-image:url(<?= base_url('assets/img/banners/home/banner_02.jpg')?>);"> <img src="assets/img/banners/home/banner_02.jpg" alt="banner_02" /> </div>
          <div class="carousel-item " style="background-image:url(<?= base_url('assets/img/banners/home/banner_03.jpg')?>);"> <img src="<?= base_url('assets/img/banners/home/banner_03.jpg')?>" alt="banner_03" /> </div>
        </div>
      </div>
    <!-- <div class="bannerLayer" style="background-image: url(<?= base_url('assets/img/banners/home/banner.jpg')?>)"></div>
       <div class="bannerText">
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
                <label class="col-form-sublabel">Select a city</label>
                <select class="form-control" name="searchCity" id="searchCity">
                  <option value="All">All</option>
                  <option value="Bhopal">Bhopal</option>
                  <option value="Burhanpur">Burhanpur</option>
                  <option value="Chanderi">Chanderi</option>
                  <option value="Gwalior">Gwalior</option>
                  <option value="Indore">Indore</option>
                   <option value="Jabalpur">Jabalpur</option>
                  <option value="Khajuraho">Khajuraho </option>
                  <option value="Orchha">Orchha</option>
                  <option value="Panna">Panna </option>
                  <option value="Ujjain">Ujjain </option>
                  <option value="Vidisha">Vidisha </option>
                </select>
              </li>
              <li class="form-group col-12 col-md-6">
                <label class="col-form-sublabel">Select date</label>
                <select class="form-control" name="searchDate" id="searchDateInput">
                  <option value="">Select date</option>
                  <!-- <option value="08-09-2018">Saturday, 8 September 2018</option>
                  <option value="09-09-2018">Sunday, 9 September 2018</option>
                  <option value="15-09-2018">Saturday, 15 September 2018</option>
                  <option value="16-09-2018">Sunday, 16 September 2018</option>
                  <option value="22-09-2018">Saturday, 22 September 2018</option>
                  <option value="23-09-2018">Sunday, 23 September 2018 </option>
                  <option value="27-09-2018">Thursday, 27 September 2018</option>
                  <option value="29-09-2018">Saturday, 29 September 2018 </option>
                  <option value="30-09-2018">Sunday, 30 September 2018 </option>
                  <option value="06-10-2018">Saturday, 6 October 2018 </option>
                  <option value="07-10-2018">Sunday, 7 October 2018 </option>-->
                </select>
              </li>
             <!--  <li class="form-group col-12 col-md-6">
                <label class="col-form-sublabel">Select date</label>
                <input type="text" id="searchDateInput" class="form-control dateIcon rightSide" name="searchDate" placeholder="Select date" autocomplete="off" /><a href="#" id="clearDate" class="clearText">clear</a>
              </li> -->
              
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
            <input type="submit" name="search" value="Search" class="btn btn-primary pr-3 pl-3">
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
              <img src="<?= base_url("assets/img/Itineraries/feature/$feature_img")?>" alt="<?php echo $data[$key]->origin_city;?>"/> </div>
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
                           $loc_cov_len = strlen($location_covered);
                           $id = $data[$key]->id;
                           if($loc_cov_len > 32 ){}else{}
                       echo $locat_cove = substr($location_covered, 0, 32).'... '.anchor("viewitineraries/{$id}", 'more',['class'=>'text-secondary']); ;
                          // $loc = explode(',', $location_covered);
                          //   $l = count($loc);
                          // if($l > 2){
                          //   for($i=0;$i<=2;$i++){
                          //      echo $loc[$i];
                          //     }
                          //     $id = $data[$key]->id;

                          //     echo '... '.anchor("viewitineraries/{$id}", 'more',['class'=>'text-secondary']); 
                          // }else{
                          //   echo $location_covered;
                          // }                         
                       ?>
              </p>
              <p class="itinerariesBox-theme"><span class="d-block">Date & Time:</span>
                <?php $start_date = date('d/m/Y',strtotime($data[$key]->start_date_from_host)); $start_time = date('h:i A',strtotime($data[$key]->default_start_time));  echo $start_date.' | '.$start_time ?>
              </p>
              <p class="itinerariesBox-theme"><span class="d-block">Themes:</span>
                <?php echo $data[$key]->itinerary_theme;?>
              </p>
              <p class="itinerariesBox-text">
                <?php     $desc = $data[$key]->itinerary_description;
                         $desc_len = strlen( $desc);
                         if($desc_len > 80){
                           echo $small = substr($desc, 0, 80).'...';
                         }else{
                           echo $small = substr($desc, 0, 80);
                         }
                ?>
              </p>
             <!--  <p class="itinerariesBox-tag">Private | Group | Family</p> -->
              <p class="itinerariesBox-tag">Private </p>
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
      <!-- <div class="text-center p-2 pt-3 pb-3"> <a href="#" class="btn btn-link">Load More</a> </div> -->
    </div>
  </div>
  <div class="text-center mt-4" style="background: #ef464d"> <img src="assets/img/advt/ad_v1.jpg" alt="advtSpace"/> </div>

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
  <?php  $status = $this->session->userdata('status'); 
  if($status == 'success'){
    $display_status = 'none';
  }?>
   

    

      <div class="soonWrap" style="display:<?php echo isset($display_status)?$display_status:''; ?>" data-start="background-image:linear-gradient(135deg, hsla(212,100%,67%,0.85) 0%,hsla(136,98%,74%,0.85) 100%);" data-end="background-image:linear-gradient(360deg, hsla(0,92%,58%,0.85) 0%,hsla(295,80%,73%,0.85) 100%)">
      <style>
    .soonWrap { position: fixed; left: 0; top: 0; width: 100%; height: 100%; z-index: 999; background: -moz-linear-gradient(-45deg, hsla(212,100%,67%,0.85) 0%, hsla(136,98%,74%,0.85) 100%);
    background: -webkit-linear-gradient(-45deg, hsla(212,100%,67%,0.95) 0%,hsla(136,98%,74%,0.95) 100%);
    background: linear-gradient(135deg, hsla(212,100%,67%,0.95) 0%,hsla(136,98%,74%,0.95) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d958a7ff', endColorstr='#d97bfe9d',GradientType=1 );}
    .soonDiv { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); color: #fff; max-width: 720px; width:100%; margin: 0 auto; }
    .soonText { text-align: left; padding: 35px 40px; padding-bottom: 100px; border: 1px solid #fff; background: rgba(0,0,0,0.85) url(assets/img/watermark.png) no-repeat 96% top; background-size:contain; font-size: 15px; }
    .soonText h1 { max-width: 300px; }
    .soonText a { color:#fff; font-weight:bold;}
    .soonText a:hover  { color:#3d8ac9;}

    .soonForm { text-align: left; padding: 20px 0; font-size: 14px; background: #fff; margin: 0 35px; margin-top: -40px; position:relative; }
    .soonForm:before { content:""; position:absolute; left:0; top:-40px; width:100%; height:1px; background:#fff;}
    .soonForm form { border-bottom:1px solid #eee;  padding:0 30px; padding-bottom:2rem;}
    .soonForm .form-group { margin-bottom: 0;}
    .soonForm .form-row>.col,.soonForm .form-row>[class*=col-] {padding-right: 10px; padding-left: 10px;}
    .soonForm .form-control { font-size:12px;}
    .soonForm .col-form-sublabel { font-size:12px; color:#888;}
    </style>
  <div class="soonDiv">
    <div class="soonText">
      <h1 class="cmyLogo"><img src="assets/img/iwl_hr_white_logo.svg" alt="India with locals" /></h1>
      <p>INDIA WITH LOCALS is a travel discovery platform to get authentic india experience.<br>
        We just acheived a milestone and are now gearing up for super times.</p>
      <p>The website has limited access for now and queries can be sent on <a href="mailto:ask@iwl.help">ask@iwl.help</a></p>
    </div>
    <div class="soonForm">
      <!-- <form action="" method="post"> -->
      <?= form_open('home/visitor_login');?>
        <label class="col-form-sublabel pb-2">Please login with your credentials</label>
        <ul class="form-row">
          <li class="form-group col-sm-5 col-12">
            <input type="email" class="form-control" placeholder="Email" name="visitor_email" required/>
          </li>
          <li class="form-group col-sm-5 col-12">
            <input type="password" class="form-control" placeholder="Password" name="visitor_pass" required/>
          </li>
          <li class="col-sm-2 col-12 text-right">
            <!-- <button class="btn btn-primary" id="visitor_login">Login</button> -->
            <?= form_submit('mysubmit', 'Login',['class'=>'btn btn-primary']); ?>
          </li>
        </ul>
      </form>
      <p class="pt-4 pb-2 text-center text-light font-weight-semibold m-0 small">Host Registration is ongoing! 
        <a href="mailto:ask@iwl.help" target="_blank" class="text-uppercase ml-1">Become a Host</a> </p>
    </div>
  </div>
</div>
    


</main>

<!-- footer start-->
<?php include('footer.php'); ?>
<!-- footer end-->

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<!-- foot start-->
<?php include('foot.php');?>
<!-- foot end-->

<script type="text/javascript" src="<?= base_url('assets/dependencies/skrollr-master/dist/skrollr.min.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dependencies/Net-Promoter-Score-Rating-Plugin-jQuery/scripts/ffrating.js')?>"></script>
<script type="text/javascript" src="<?= base_url('assets/dependencies/OwlCarousel2-2.3.4/dist/owl.carousel.min.js')?>"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/dependencies/jquery-date-range-picker-master/dist/jquery.daterangepicker.min.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/js/global_function.js')?>"></script>
 
<script type="text/javascript">

  ( function ( $ ) {
     

    skrollr.init();
    //IMAGE SLIDER
$('.carousel').carousel({
    interval: 4000
});
$('#visitor_login').click(function(){
   var visitor_mail = $('#visitor_mail').val();
   var visitor_pass = $('#visitor_pass').val();
  alert("help"); 
  $('.soonWrap').hide();
})
    // RATING 
    // $( '.iwlRating' ).ffrating( {
    //   isStar: true,
    //   readonly: true,
    //   showSelectedRating: true,
    //   min: 1,
    //   max: 5
    // } );


//     $( '#searchDateInput' ).dateRangePicker( {
//       format: 'DD-MM-YYYY',
//       autoClose: true,
//       singleDate: true,
//       showTopbar: false,
//       singleMonth: true,
//       selectBackward: true,
//       startDate: new Date(),
//     }).bind('datepicker-change', function(evt, obj) {
//   $('#clearDate').show();
// }); 

  
// if (!$('#searchDateInput').val() == ""){
//   $('#clearDate').show();
//   }

// $(document).on('click','#clearDate', function(e){
//     e.preventDefault();

//   e.stopPropagation();
//   $(this).hide();
//   $('#searchDateInput').data('dateRangePicker').clear();
// });


    // PARTNER SILDER   
/*    var dateOwl = $( '.partnerRoller' );
    dateOwl.owlCarousel( {
      margin: 10,
      nav: false,
      dots: false,
      loop: true,
      mouseDrag: false,
      autoplay: true,
      autoplayTimeout: 2000,
      responsive: {
        0: {
          items: 1,
        },
        425: {
          items: 2,
        },
        768: {
          items: 4,
        },
        1024: {
          items: 5,
        },
        1200: {
          items: 6,
        }
      }
    } );*/
  } )( jQuery );
</script>
</body>
</html>