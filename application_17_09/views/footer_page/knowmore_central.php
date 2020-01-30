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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/central/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>Central India</h2>
      <p>With us you can safely discover India of the Now, view the past in forts and monuments and yet at the same time relax!</p>
    </div>
  </div>
  <div class="knowmoreData">
    <div class="lightBg">
      <div class="container">
        <div class="headingStatic">
          <h3>Allow us to <span>paint your holiday</span><br>
            painting with colours of India</h3>
          <p>India is a vast as you soulscape is, a land of colour, pomp and gaiety. Where you come face to face with new cuisines, aromas fabrics, landscape, architecture, language and what not! With every passing kilometre</p>
        </div>
        <div class="row areaIntro pt-5 pb-5 border-top align-items-center">
          <div class="col-12 col-sm-6">
            <div class="areaIntro-img"><img src="<?= base_url('assets/img/knowmore/central/fullimage_01.jpg')?>" alt="fullimage_01"/></div>
          </div>
          <div class="col-12 col-sm-6">
            <h3>States</h3>
            <p>Madhya Pradesh, Chhattisgarh, Southern Uttar Pradesh</p>
            <h4>Major Cities</h4>
            <p>Bhopal, Indore, Jabalpur</p>
            <h4>Major Languages</h4>
            <p>Hindi</p>
            <h4>Famous for</h4>
            <ul>
              <li>Tiger Reserves</li>
              <li>Khajuraho Temples</li>
              <li>Diamond mines and other mineral reserves</li>
              <li>Producing a large amount of electricity</li>
              <li>Forests</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="columnCount">
        <p>The Central part of India consists of states like Madhya Pradesh, Jharkhand, Chattisgarh. A journey through the heart of India is a full spectrum itself, from the earliest Buddhist caves of Ajanta and Ellora to the splendors of elaborate temple architecture, to dense wildlife sanctuaries which to all nature, wildlife enthusiasts gives the exact adrenaline rush, to a tete-e-tete with the tribals. Get on board and enjoy the authentic flavors of each place with lots of history, heritage, cultures yet to be explored.</p>
        <p>The region has a blend of modernity trapped into the traditions which are rooted in time. To go back in history, the Deccan-Peninsular Plateau has a history which can be traced back to the times when Gondwana land broke into fragments, which moved northward with time. One of the oldest landmass of India, it can further be divided into Central Highlands, north of the river Narmada, which forms most of the Malwa Plateau and Deccan Plateau, a triangular landmass which falls below the river Narmada. There are five major river systems which flow through them: Narmada and Tapti in Madhya Pradesh, and Godavari, Bhima and Krishna in Maharashtra, whose sources lie in the western ghats which further run eastwards. It becomes easy to trap all the monsoon rains blowing off the Arabian Sea, as the mountains form a divide between the lush, densely populated coastal lowlands and the more arid lands of the Deccan Plateau.</p>
        <p>The major part of the region is held largely by Madhya Pradesh. They hold enough ancient monuments, wildlife reserves, sacred pilgrimage towns, the thick densely forested remote forests which has a charm of its own. </p>
        <p>Forays into the Central Indian Sal forests which offer a glimpse of wild tigers, and a rendezvous with the tribals will let you experience the region which has a lot of offer in term of culture. Visit the region, and explore the central part of a diverse subcontinent, rooted in its traditional ways of life, yet outward looking. </p>
        <p>The region offers you tales right from the pre-modern cave hunter gatherers society to up town, forward looking modern cities, which have their cultures intact in them. To trace the spiritual descent of India, the region is pretty equipped as the beautiful temple architecture in Khajuraho lets you peek into the temple architecture, or a visit to Ujjain will give you the spiritual cleansing and the environs to help you understand the spiritual culture of India. Visit Bhimbetka Cave’s which offer a glimpse of our hunter-gatherer ancestors. The Stupa’s at Sanchi, one of the World Heritage Site, has been attracting a lot of people. Visit the Stupas, and understand Buddhism as part of the evolving religions in India. The city of Lakes can never be a miss for anyone. How can anyone miss out on a city which has been ever evolving as yet so culturally accumulative? </p>
        <h4>Honouring the Heritage<sup class="text-dark small">&reg;</sup></h4>
      </div>
      <ul class="blockList clearfix">
        <li> <a> <img src="<?= base_url('assets/img/knowmore/central/thumbimage_01.jpg" alt="thumbimage_01')?>"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/central/thumbimage_03.jpg" alt="thumbimage_03')?>"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/central/thumbimage_02.jpg" alt="thumbimage_02')?>"/> </a> </li>
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
<!-- SCRIPT --> 
<?php include('foot.php');?>
</body>
</html>
