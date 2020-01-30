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

<div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/pledge/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text text-center">
        <h2>Take a Pledge</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg">
    <div class="container">
      <p class=" text-dark font-regular pb-4  pt-4">Prime Minister Shri Narendra Modi exhorted people to fulfill Mahatma Gandhi's vision of Clean India. The 'Swachh Bharat Abhiyan' is a massive mass movement that seeks to create a Clean India. Cleanliness was very close to Mahatma Gandhi's heart. A clean India is the best tribute we can pay to Bapu when we celebrate his 150th birth anniversary in 2019. Mahatma Gandhi devoted his life so that India attains 'Swarajya'. Now the time has come to devote ourselves towards 'Swachchhata' (cleanliness) of our motherland.</p>
      <div class="pt-2 pb-5">
        <div class="pledgeBar">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>Swachh Pledge (English)</h2>
          </div>
          <div class="pledgeBar-body">
            <ul>
              <li>Mahatma Gandhi dreamt of an India which was not only free but also clean and developed.</li>
              <li>Mahatma Gandhi secured freedom for Mother India.</li>
              <li>Now it is our duty to serve Mother India by keeping the country neat and clean.</li>
              <li>I take this pledge that I will remain committed towards cleanliness and devote time for this.</li>
              <li>I will devote 100 hours per year, that is two hours per week, to voluntarily work for cleanliness.</li>
              <li>I will neither litter not let others litter.</li>
              <li>I will initiate the quest for cleanliness with myself, my family, my locality, my village and my work place.</li>
              <li>I believe that the countries of the world that appear clean are so because their citizens don't indulge in littering nor do they allow it to happen.</li>
              <li>With this firm belief, I will propagate the message of Swachh Bharat Mission in villages and towns.</li>
              <li>I will encourage 100 other persons to take this pledge which I am taking today.</li>
              <li>I will endeavour to make them devote their 100 hours for cleanliness.</li>
              <li>I am confident that every step I take towards cleanliness will help in making my country clean.</li>
            </ul>
          </div>
        </div>
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>स्वच्छ प्रतिज्ञा (हिंदी) </h2>
          </div>
          <div class="pledgeBar-body text-center">
           <img src="assets/img/pledge/swachh_inhindi.jpg" alt="pledge"/>
          </div>
        </div>
        
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>Safe & Honourable Tourism & Sustainable Tourism Pledge (English)</h2>
          </div>
          <div class="pledgeBar-body text-center">
           <img src="assets/img/pledge/tourism_inenglish.jpg" alt="pledge"/>
          </div>
        </div>
        
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>सुरक्षित और माननीय पर्यटन और स्थायी पर्यटन प्रतिज्ञा (हिंदी)</h2>
          </div>
          <div class="pledgeBar-body text-center">
           <img src="assets/img/pledge/tourism_inhindi.jpg" alt="pledge"/>
          </div>
        </div>
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>Pledge to Segregate </h2>
          </div>
          <div class="pledgeBar-body">
           <p>I pledge to segregate my (household, shop, establishment) waste in two dustbins, wet waste in Green and dry waste in Blue, as my contribution to the Swachh Bharat Mission.</p>
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
