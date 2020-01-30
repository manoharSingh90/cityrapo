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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/east/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>East India</h2>
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
            <div class="areaIntro-img"><img src="<?= base_url('assets/img/knowmore/east/fullimage_01.jpg')?>" alt="fullimage_01"/></div>
          </div>
          <div class="col-12 col-sm-6">
            <h3>States</h3>
            <p>Bihar, West Bengal, Orissa, Jharkand</p>
            <h4>Major Cities</h4>
            <p>Kolkata, Patna, Jamshedpur, Dhanbad, Ranchi, Bhubaneswar</p>
            <h4>Major Languages</h4>
            <p>Bengali, Hindi, Bhojpuri, Oriya</p>
            <h4>Famous for</h4>
            <ul>
              <li>Nobel Laureates Rabindranath Tagore, Swami Vivekanada</li>
              <li>Strong Football and Cricket culture</li>
              <li>Fish dishes</li>
              <li>Historical places related to India’s Independence</li>
              <li>Bengali sweets made from milk, called rosgula and mishti doi</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="columnCount">
        <p>East India is a region situated near the Bay of Bengal. It consists of Odisha, Bihar, Jharkhand, West Bengal, and the union territory of Andaman and Nicobar Islands. Eastern Part of India consists of states like Bihar Jharkhand Orissa and West Bengal. It has a rich biodiversity and a huge stalk of minerals and rare earth materials. The West Bengal region was created after the partition from Pakistan in 1905. Compared to North India, the culture of this region differs drastically. West Bengal is heavily influenced by the Bengali culture. Odisha is majorly a proponent of the Odishi culture. The Buddhist influence is heavily present in the fabric of East India as Bihar is where Buddha preached his first sermon and preached his dharma. This amalgamation of islands, partitioned state, and the Buddhist a Bengali influences is what gives East India a unique flavor. Historically it can be traced to 3rd to 4th century back to Ashokan Empire. It also marks the first region where the British established their rule. We find world’s first university Nalanda here in the state of Bihar. </p>
        <p>Andaman Nicobar is a beautiful set of islands which are 600 in total. Of such a huge number of islands, only 36 are inhabited and 9 accessible to the tourists. The islands provide you with an opportunity to sun-bathe at the beaches, dip your feet in the fresh water, and let your lose in the cool atmosphere. Taste some of the bets seafood that Andaman has to offer and dig into the prawns, fish, lobsters and more!</p>
        <p>West Bengal has a heavy Bengali influence and carries forward the Bengali love for literature, music, cuisine and all the finer things of life. West Bengal is quite famous for its music and dance forms, especially the Baul tradition. The Bengali cinema is something should never be missed. Indulge yourself in the West Bengali cuisine which shares the craze of the Bengalis for fish and sweets. Taste their jhal-mura, rosogulla, and lip-smacking dishes. The land of Tagore, Vivekanda, Raja Ramohan Roy and Aurobindo. It’s the state between Himalayas and Bey bengal. A state known by for its Sundarban delta, its world famous Darjeeling tea and beautiful Kachenjunga peaks and its terracotta from the Birbhum region. It’s the state where the Mughals found solace from the politics of Agra and Delhi. It’[s the state which holds a treasure trove of the British architecture in India.</p>
        <p>It’s the gateway to North east and shares a deep relationship with India's neighbor Bangladesh. It’s often said Bengal has a great foresight and is considered a land of social awakening and India's first steps towards modernization. This region has also seen the beginning of the first war of Independence. </p>
        <p>Bihar is said to be the birthplace of Buddhism, as this is where Buddha gave his first sermon and began the spread of his dharma. Biharis are very well-known for their love for life and fun. A trip to Bihar is always incomplete without tasting the Litti Chokha, Chana Ghughni, Chandrakala, Naivedyam and the finer dishes. Home to several languages, dialects and culture, Bihar is a beautiful confluence of forces which find way in its architecture. Bordering Nepal Bihar has one of the most fertile regions of India with Ganga and it’s various tributaries following through Bihar.</p>
        <p>Orissa is the land of mysticism and religion. Bhubaneshwar the capital city is known as the city of temples with hundreds of temples from its ancient past. There is a perfect blend of religion history and heritage. This is also which holds its history dating back to 2nd century BC during the Mauryan empire under the emperor Ashoka. It’s has few of the natural wonders of India such as the Chilka Lake which is largest ground for migratory birds in the Indian subcontinent.</p>
        <h4>Exploring the city's soul<sup class="text-dark small">&reg;</sup></h4>
      </div>
      <ul class="blockList clearfix">
        <li> <a> <img src="<?= base_url('assets/img/knowmore/east/thumbimage_01.jpg')?>" alt="thumbimage_01"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/east/thumbimage_03.jpg')?>" alt="thumbimage_03"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/east/thumbimage_02.jpg')?>" alt="thumbimage_02"/> </a> </li>
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
