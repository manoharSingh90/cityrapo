<?php include('head.php');?>
<?php 
	$basedir = realpath(__DIR__);
	 $link_array = explode('/',$basedir);
     $page = end($link_array);
	if($page=='footer_page'){
		$path = str_replace('/footer_page','/itineraries',$basedir);
		}
	if(isset($loggedInUser)){
		include ($path.'/header.php');
		}
	else{
		include ('header.php');
		}
	
	?>
<main>
<div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/hosttype/banner.jpg')?>);"></div>
<div class="staticPage lightBg">
  <div class="container">
    <div class="headingStatic border-0 pb-4">
      <h3>Creating Socio-Cultural Exchange and Impact between Hosts & Guests</h3>
      <p class="pt-3">The cultural values of our nation are to be showcased to the global citizen and shine across the world map. This is a platform to bridge the gap of the narrator and listener, bring about a real sense of pride. Citizens, communities, culture and their heritage connections are to preserved for the generations to come, relay to the World the essence of India’s glorious history and the opportunities of the future. </p>
      <ul class="hostImpact pb-4">
        <li>
          <h4 class="text-uppercase">Impact</h4>
          <p>Encompassing all social strata, the impact through the narratives of heritage & history is to bring pride in social and cultural identity, shaping the future of tomorrow. Socio-economic impact is for all.</p>
        </li>
        <li>
          <h4 class="text-uppercase">Experiences</h4>
          <p>In the times of multiplicity, the travellers now seek ‘beyond the horizon’ experiences. With deeper understanding, sensory extravaganza & cultural know-how, the experiences are for all to immerse.</p>
        </li>
        <li>
          <h4 class="text-uppercase">Opportunity</h4>
          <p>Growth for the generation of present and future remains in empowerment and entitlement. Providing an opportunity to the entrepreneurs, it is an attempt to safeguarding local economy for them to thrive. </p>
        </li>
      </ul>
    </div>
  </div>
  <div class="pt-3 pb-3 bg-white">
    <div class="container">
      <div class="headingStatic border-0 pb-4">
        <h3 class="text-primary">CHOOSE YOUR HOST OPTION</h3>
        <p class="pt-3">Engaging and interacting with the cultural nuances and heritage segments of the locals, the hosts create a rewarding and introspective journey for you with their expertise. </p>
        <ul class="hostType">
          <li><img src="<?= base_url('assets/img/host_type/ht_01.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_02.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_03.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_04.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_05.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_06.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_07.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_08.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_09.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_10.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_11.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_12.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_13.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_14.jpg')?>" alt="ht_01"/></li>
          <li><img src="<?= base_url('assets/img/host_type/ht_15.jpg')?>" alt="ht_01"/></li>
        </ul>
        <div class="pt-3 pb-3 text-center">
          <div class="text-center chifImage"><img src="<?= base_url('assets/img/host_type/chief_explorer.jpg')?>" alt="chief_explorer"/> <strong class="d-block">CHIEF EXPLORER&trade;</strong></div>
          <h5 class="text-uppercase text-primary mt-3">WITH US YOU CAN SAFELY DISCOVER THE INDIA OF NOW!&trade;</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="careerWrap">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12 col-md-8">
          <div class="careerText"> <small>Maximize opportunities in emerging geographies</small>
            <h5>Full time positions available</h5>
            <p>Join our platform & strive an equilibrium between spontaneity & structure freedom and self expression organised & optimum</p>
          </div>
        </div>
        <div class="col-12 col-md-4">
          <div class="careerContact">
            <p>Mail us your resume</p>
            <p><a href="mailto:help@cityexplorers.in">help@cityexplorers.in</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<!-- SCRIPT --> 
<?php include('foot.php');?>
<script type="text/javascript">
(function($) {
 
// TOGGLE
$(document).on('click', '.pledgeBar-head', function(e) {
    e.preventDefault();
			var $toggleBox = $(this).closest('.pledgeBar');
			var $toggleBody = $toggleBox.find('.pledgeBar-body');
			$(this).toggleClass('active');
			$toggleBody.slideToggle();
});

   

})(jQuery);
</script>
</body>
</html>
