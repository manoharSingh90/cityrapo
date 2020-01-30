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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/north_east/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>Northeast India</h2>
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
            <div class="areaIntro-img"><img src="<?= base_url('assets/img/knowmore/fullimage_01.jpg')?>" alt="fullimage_01"/></div>
          </div>
          <div class="col-12 col-sm-6">
            <h3>States</h3>
            <p>Arunachal Pradesh, Assam, Manipur, Meghalaya, Mizoram, Nagaland, Sikkim,  Tripura</p>
            <h4>Major Cities</h4>
            <p>Guwahati, Agartala, Dimapur, Shillong, Aizawl, Imphal</p>
            <h4>Major Languages</h4>
            <p>Assamese, Bengali, Bodo, Garo, Manipuri, Nagamese, Nepali, Sikkimese</p>
            <h4>Famous for</h4>
            <ul>
              <li>Meat dishes (beef, fish, and pork)</li>
              <li>Martial Arts</li>
              <li>Bamboo Handicrafts</li>
              <li>Scenic Beauty</li>
              <li>Darjeeling (actually in West Bengal, but more associated with the Northeast)</li>
              <li>Football</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="columnCount">
        <p>Welcome to the land of undulating hills and plains with luxuriant lush greenery with a variety of exotic flora and fauna. North eastern part of the India is often called as the land of eight sisters. The states which were earlier part of Greater Assam were given their autonomy not many years back. Around 75 major population groups which speak at least 400 hundred dialects, it is a land yet to be explored by many. </p>
        <p>The physical features of the region is such that it is at a height. Agriculture forming the main premise of work in all of the region, it still has many areas unexplored because of the proximity. Let yourself loose in the lap of nature. Listen to the stories which are as unique as the region. The physical features of the place can be categorized as Eastern Himalayas, with three main plain areas: Patkai, Brahmaputra and the Barak Valley. The region predominantly has a sub-tropical climate with hot and humid summers and severe monsoons and mild winters. A keeper of the last reminaing rain-forests, which has beautiful specimens of flora and fauna, it is a sight to watch it all. The main river systems in the region belongs to the Brahmaputra- Barak systems.  With over 220 ethnic groups and unaccountable dialects, the region is diverse beyond imagination. The most dominant group and their language in North East is the Bodo. The history and culture of the region is largely credited to the continuous flow of migrants from Tibet, Indo-Gangetic India, the Himalayas. All the eight states: Arunachal Pradesh, Assam, Manipur, Meghalaya, Mizoram, Nagaland, Tripura and Sikkim are the eight states which command special importance in India. </p>
        <p>The range of communities and geographical and ecological diversity make these states very different from other parts of the country. Surrounded by Hills in the Brahmaputra- Barak river systems, the hills and basins are a mixture of mountain ranges, plateaus, valleys and low-lying areas. As was seen even by the ancestors and colonialists, North eastern region provided as the gateway to South East Asia. The states have a very distinct culture and multiple ethnic groups which reflect unity in diversity.  The variety of ethnic groups, languages, religions reflect the multi-cultural character of the states. Housing around 200 tribal communities which speak variety of languages, some have their own native language in the interiors, it is a sight to behold as well as an experience which is unforgettable in North Eastern part of India.</p>
        <p>With its own historical heritage which has been preserved well, visit Assam, which has UNESCO World Heritage Sites, to understand the history. Experience the nature coming alive in nature trails around Kaziranga National Park. Manipur is famous for its chequered history of advanced kingdoms. Who were they? Find it out with us. One of the most well-guarded states Arunachal Pradesh has stories trapped in the bounty of nature. </p>
        <h4>A story to tell, a legacy to share...<sup class="text-dark small">&reg;</sup></h4>
      </div>
      <ul class="blockList clearfix">
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_01.jpg')?>" alt="thumbimage_01"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_03.jpg')?>" alt="thumbimage_03"/> </a> </li>
        <li> <a> <img src="<?= base_url('assets/img/knowmore/thumbimage_02.jpg')?>" alt="thumbimage_02"/> </a> </li>
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
