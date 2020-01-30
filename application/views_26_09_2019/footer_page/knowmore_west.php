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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/west/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>West India</h2>
      <p>With us you can safely discover India of Now, view the past in forts and monuments and yet at the same time relax!</p>
    </div>
  </div>
  <div class="knowmoreData">
    <div class="lightBg">
      <div class="container">
        <div class="headingStatic">
          <h3>Allow us to <span>paint your holiday</span><br>
            painting with colours of India</h3>
            <p>India is as vast as your soulscape is, a land of colour, pomp and gaiety. Where you come face to face with new cuisines, aromas fabrics, landscape, architecture, language and what not! With every passing kilometre</p>
        </div>
        <div class="row areaIntro pt-5 pb-5 border-top align-items-center">
          <div class="col-12 col-sm-6">
            <div class="areaIntro-img"><img src="<?= base_url('assets/img/knowmore/fullimage_03.jpg')?>" alt="fullimage_01"/></div>
          </div>
          <div class="col-12 col-sm-6">
            <h3>States</h3>
            <p>Goa, Gujarat, Maharasthra, Southern Rajasthan, some parts of Madhya Pradesh</p>
            <h4>Major Cities</h4>
            <p>Mumbai, Ahmedebad, Pune, Goa, Surat, Nagpur, Aurangabad</p>
            <h4>Major Languages</h4>
            <p>Marathi, Gujarati, Hindi, Konkani</p>
            <h4>Famous for</h4>
            <ul>
              <li>Bollywood</li>
              <li>Cricketers</li>
              <li>Chaat street food (originally north Indian, but extremely popular in this region)</li>
              <li>Generating 24% of the GDP (with 10% of the population)</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="columnCount">
        <p>Indian Mainland has been divided in such a manner, which includes every possible physical features. A land where you can travel from a winter zone to a humid coastal zone swiftly. Every 10 kms, the regions landscape, culture, as well as stories changes. Have you experienced any other mainland which is as diverse as ours?</p>
        <p>The western most part of India consists predominantly Rajasthan and Gujarat and Maharashtra, Goa, Daman and Diu and Dadra and Nagar Haveli which has very different cultures, stories yet to be explored. One of the highly industrialized areas with a largest urban population recorded, most of the western part of India was under Maratha rule until they were made British colony. Bordered by the Thar Desert, and Vindhya Range in the North, the physical features of the region is largely Deccan Plateau with arid climatic conditions. States in West India differ in language and culture, the levels of economic development, including some regions which are tourist magnets. </p>
        <p>There are many cultures, stories to be explored, and understand the nuances of historical development in the region. From many heritage places, the region also covers a distinct spiritual culture which is different from other regions. While you relish a Dandiya Dance during Navratri, do not forget, it originated from Gujarat. The famous Elephanta caves or the Ajanta-Ellora caves, lets you dig deeper in history and listen to the stories which date back to the ancient period. For a more cosmopolitan experience, do not forget to visit Mumbai, which offers a glimpse into the colonial history of the British, as well as how the cultures of the sea farers just mixed with the rest of the native populations in Mumbai. </p>
        <p>The only place, which now has the reminisces of Parsi culture, the Bollywood capital, Bombay should be a must visit for any traveller wanting to get a hang of the cosmopolitan culture and heart beat.</p>
        <p>Rajasthan undoubtedly is one of the colourful lands which attracts tourists every year. The land of warrior, deserts, striking colourful textiles and humungous forts, where spirituality is at the heart of each one as seen from Rajput Temples, Haveli’s beautifully decorated with murals, paintings as well as a unique sense of aesthetic sense, Rajasthan is sure to leave you awestruck. Walk through the forts, to know the legacy and history of the Rajputs, learn about the smooth amalgamation of Jain cultures and Rajasthani cultures in the region, adorn some famous, colourful textiles striking and vibrant, or just gorge in some cuisines which will be as welcoming as the state. PadharoMhare Des, can literally be experienced only in Rajasthan. </p>
        <p>Goa, Dadra and Nagar Haveli, and Daman and Diu are all coastal destinations, which are very popular. Goa, flaunting miles of coastline having some of the most beautiful beaches, it is more than just the beaches. Once a Portuguese colony, a lot of the history and heritage of the place owes a great deal to its past. Daman and Diu owes a great deal to its Portuguese influence, because of its proximity to Goa.  Squeezed between Maharashtra and Gujarat, Dadra and Nagar Haveli a union territory is famous for its tribal museums and its gardens. </p>
        <h4>Honouring the Heritage<sup class="text-dark small">&reg;</sup></h4>
      </div>
      <ul class="blockList clearfix">
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_07.jpg')?>" alt="thumbimage_07"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_08.jpg')?>" alt="thumbimage_08"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_09.jpg')?>" alt="thumbimage_09"/> </a> </li>
      </ul>
    </div>
  </div>
  <div class="initiativeWrap">
    <div class="container">
      <h3>Our <span>initiatives</span></h3>
      <p>We are one of the leading delivery organisation putting efforts in research, education and product development to promote the growth of the tourism industry in India.</p>
      <div class="row pt-5">
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/discovery.png')?>" alt="discovery"/></span>
            <h4>City Discovery</h4>
            <p>interesting & informative experiences and attractions in urban and rural areas</p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/sightseeing.png')?>" alt="sightseeing"/></span>
            <h4>Sightseeing</h4>
            <p>we intend to highlight the small wonders that make famous or interesting sights of a place truly unique </p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/heritage.png')?>" alt="heritage"/></span>
            <h4>Heritage & Culture</h4>
            <p>gain an understanding  of the nature of the place being visited & appreciate human past</p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/innovative.png')?>" alt="innovative"/></span>
            <h4>Innovative  Adventure</h4>
            <p>revitalising and energising experiences and activities in the spectacular outdoors </p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/food.png')?>" alt="food"/></span>
            <h4>Food Tourism</h4>
            <p>Food tours and cooking sessions based on our in-depth, local knowledge of India</p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/iwl.png')?>" alt="iwl"/></span>
            <h4>India with Locals</h4>
            <p>Generating local pride and sense in the perspective of building more just communities, respecting human rights & dignity</p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/sustainable.png')?>" alt="sustainable"/></span>
            <h4>Sustainable Tourism</h4>
            <p>We generate greater economic benefits for local people and enhance the well-being of host communities</p>
          </div>
        </div>
        <div class="col-12 col-sm-4 col-md-3">
          <div class="initiativeBox"> <span><img src="<?= base_url('assets/img/initiatives/eco.png')?>" alt="eco"/></span>
            <h4>Eco Tourism</h4>
            <p>to minimise negative environmental and social impacts, while maximising positive benefits</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include('footer.php');?>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>
</body>
</html>
