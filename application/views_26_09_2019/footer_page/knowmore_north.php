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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/north/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>North India</h2>
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
            <div class="areaIntro-img"><img src="<?= base_url('assets/img/knowmore/fullimage_02.jpg')?>" alt="fullimage_02"/></div>
          </div>
          <div class="col-12 col-sm-6">
            <h3>States</h3>
            <p>Haryana, Himachal Pradesh, Jammu & Kashmir, Punjab, Rajasthan (southern part might be considered West), Uttar Pradesh (southern part might be considered Central), Uttarakhand</p>
            <h4>Major Cities</h4>
            <p>Delhi, Chandigarh, Jaipur, Lucknow, Kanpur</p>
            <h4>Major Languages</h4>
            <p>Hindi, Punjabi, Haryanvi, Urdu</p>
            <h4>Famous for</h4>
            <ul>
              <li>Pilgrimage sites like Varanasi, Ayodhya, or the Sikh Golden Temple</li>
              <li>Mughal historical sites like the Taj Mahal</li>
              <li>Punjabi Food</li>
              <li>Kashmir</li>
              <li>The Himalayas and many hill stations like Leh</li>
              <li>Historical places in Delhi like Red Fort</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="columnCount">
        <p>North India is the home of a rich amalgamation of traditions, cultures, cuisines, music and dance forms which are the legacy of the changing rules of the Mauryas, Guptas, Mughal, Maratha, and the Sikhs before being taken over by the British regime. The region is rich in heritage that is a testimony to the ethnic diversity of India. There is the marvel of the Taj Mahal and that of the Golden Temple. The Indo-Aryan influence is easily visible in the strands of the history of this region, and the remnants of the Indo-Muslim can be discerned from the architectural features of monuments such as the Taj Mahal, Red Fort, Qutub Minar etc.</p>
        <p>The Northern region is comprised of the states of Haryana, Himachal Pradesh, Punjab, Delhi, Rajasthan, Uttar Pradesh, Uttarakhand and Jammu & Kashmir. These states offer their unique cultures and traditions to the repertoire of the North. Punjab is famous for its landscapes, rich cuisine, and earthy traditions. </p>
        <p>The people of this region are known as the Punjabis. The ethnic wear of the women consists of salwar-kameez and those of the men consists of kurta-payjama and turbans. Punjab is well-known for its sarson-da-saag and the lavish cuisine. It consists of cities containing cultural heritage, historical context, such as Amritsar, Ludhiana, Patiala and Punjab. The Golden temple in Amritsar attracts a great number of tourists. </p>
        <p>Rajasthan houses many tribes, and has a rich set of Rajputana heritage, besides the fascinating tapestry of folk traditions. The Rajputs have had the major influence on the terrain and their forts and palaces line the regions of Jaipur, Jodhpur, Jaisalmer, Udaipur, Pushkar etc. It also contains the sprawling thar desert of Rajasthan, and is home to some of the most marvelous Rajputana forts such as Jaisalmer Fort, Amber For, Chattisgarh Fort etc. The Rajasthani cuisine is famed for its daal-baati churma and the spiciness. </p>
        <p>Uttar Pradesh is famous for its pilgrimage centres and its proximity to river Ganges. Varanasi is one of the oldest inhabited cities and contains the feel of the ancient times in its every inch. The ghats of Varanasi provide beautiful views of the whole city, combined with mesmerizing aartis and cremations. It also contains one of the wonders of the world, Taj Mahal, recognized by UNESCO as a world heritage sites. Vrindavan and Mathura the lands famous for their spiritual bond with Krishna are a part of this region. </p>
        <p>Uttrakhand, known as the land of the Gods, houses a great number of holy places of the Hindus. The city has a mountainous terrain which is tempting for trekkers, mountaineers, campers and the ones with adventure in their hearts. Mussorie, Lansdowne, Kedarnath are some of the hill stations that it has to offer</p>
        <p>Himachal Pradesh is a beautiful landscape, with a captivating culture and some of the best hill station across India. Containing places such as Manali, Mandi, Kasol, Kulu, Himachal is also known as the Dev Bhoomi. Completely covered by beautiful, lush trees, its mountains are breathtaking. The Himachalis are a rowdy group of people who are fun-lovers and inclusive of tourists. The place offers scenic vistas in the heart of nature, at the choicest of Hotels. </p>
        <p>Jammu and Kashmir region is at the northernmost edge of India and is rightfully known as the Paradise on Earth. It is situated at the norther flank of the Himalyan range and offers a culturally rich and adventurous terrain to be explored. The region of Jammu and Kashmir is comprised of the three states of Jammu, Kashmir and Ladakh. Jammu & Kashmir situated in the far North has a beautiful set of cities situated amidst the northern flank of the Himalayan range. </p>
        <p>Haryanvi culture is defined by its vibrancy, verve, hookahs on charpoys and the reputation as one of the richest states of India. Rich in folklore, this space offers a beautiful break to travelers. Indulge in Kingdom of Dreams, Surajkund, and Damdama Lake. </p>
        <h4>Honouring the Heritage<sup class="text-dark small">&reg;</sup></h4>
      </div>
      <ul class="blockList clearfix">
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_04.jpg')?>" alt="thumbimage_04"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_05.jpg')?>" alt="thumbimage_05"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_06.jpg')?>" alt="thumbimage_06"/> </a> </li>
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
