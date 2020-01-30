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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/south/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>South India</h2>
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
            <p>Karnataka, Andhra Pradesh, Tamil Nadu, Kerala, Telangana</p>
            <h4>Major Cities</h4>
            <p>Chennai, Bangalore, Hyderabad, Trivandrum, Coimbatore, Kochi</p>
            <h4>Major Languages</h4>
            <p>Tamil, Kananda, Telugu, Malyalam</p>
            <h4>Famous for</h4>
            <ul>
              <li>South Indian Food: Dosais and idly, biriyani</li>
              <li>Spices like cardamom, cloves, cinnamon, tamarind</li>
              <li>Numerous Hindu Temples and pilgrimage sites</li>
              <li>Carnatic Music and Bharatanatyam Dance</li>
              <li>Mixing movie stars and politicians</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="columnCount">
        <p>Covering a history of over four thousand years South India, saw the rise and fall of numerous dynasties and empires ruling in different part of the region for decades and some even for centuries. A complete contrast to what one sees in North, South India is a humble land full of rich cultural history revolving around its gigantic temples dating back to 1st Century C.E. to the popular traditional cuisine known for its simplicity; taste and flavour are all witness to the evolution of South Indian regions to the present times. South India encompasses states of Andhra Pradesh, Tamil Nadu, Karnataka, Kerala and Telangana today which, on the whole occupies 19% of India’s area. An abode of rich heritage and culture, the southern part of India has witnessed everything from a civil war between the medieval dynasties of Golconda, Bijapur and Ahmadpur to huge dynastic powers like Cholas & Cheras ruling the region back in history, these dynastic powers did not only make huge alterations to the regional history leaving footprints on Indian history forever but also contributed by constructing monuments, temples, garden enclosures etc. Archaeological studies on Southern region of India, takes back the history of this region to circa 8000 BCE. Today, the region holds great importance thanks to its great cuisine, beautiful Kanjivaram sarees and monumental temples, veteran film stars turned into politicians, exporting some of the most fragrant cinnamon, cloves, cinnamon and tamarind to the entire world thanks to the rich fertile soil found in the region. It is not only the tangible culture of the region which makes it remarkably unique but also the intangible aspects of culture like the famous Carnatic music and Bharatmnatyam Dance form which elevates one sensory nerve as one witnesses it. Oweing to the fact that the region accommodates one of the most literate cities in the country the region forms the backbone of the software industry in the nation.</p>
        <p>The eight largest state of India Andhra Pradesh is also the tenth most populous state in the country with its capital as Hyderabad. Hyderabad is popularly known for the rich cuisine in India; Andhra Pradesh also has the second largest coastline in the country. The new river de facto capital Amravati one of the earliest Buddhist sites in the world and eminent remains of the earliest Stupa in India making it a historically important site for Buddhist pilgrims from all over the world. With popular state language as Telugu and a great variety of soil found in the region the cuisine of the state hugely varies making millets and rice predominantly staple foods to the state. Leading producer of Red chillies and rice unlike other states in South India Telugu cuisine uses liberal amount of spices making it stand apart from other state cuisines in the region. It is indeed a pleasant site to witness traditional Telugu families relishing upon the flavorful cuisine, visiting temples at regular intervals of the week clad in traditional attires where men were a wrap around dhoti & kurtas where as women are generally adorned with vivid colour sarees and heavy jewels on festive occasions.</p>
        <p>The eight most populous states in the country Karnataka has its capital as Bengaluru. Two main river systems Krishna and its tributaries in North and Kaveri and its tributaries on North make it one of the most fertile states in the region and the fifth largest state economy in the country. The state cuisine is one of the earliest surviving cuisines tracing its origin to as early as Iron age, the traditional attire of the state shows the harmony of modernity and culture followed in South Indian state. Women adorned in winsome kanchipuram or kanjeevaram hand woven silk sarees from Kanchipuram region in South India are the most famous, men in traditional white dhoti with a rich gold border is a common site to witness in any traditional prayer ceremony or even in weddings.</p>
        <p>An abode to Malayalam speaking gentry Kerala is also famously known as the land of god, the beautiful backwaters, rich Malabar Coast, flavorful cuisine and gigantic elephants to warm up one’s day is a great state to visit when in South India. Trivandrum in Kerala state of South India was the home town of one of the most veteran painters in Modern Indian history making it a rich habitat for the painting culture to flourish. One of the most literate state in the country, the state is located on the southernmost tip of the Indian subcontinent also making it a great point for spice trade further attracting Portuguese traders towards it. Oweing to the great temples in the state Kerala is a house to Sopana Sangeetham form of classical music tracing its origin from the temples of Kerala which were not only a pilgrimage site but also a great living sector for people.</p>
        <p>With its capital at Chennai Tamil Nadu holds a hoard of innumerable ancient Indian temples even pre dating the era when fully evolved Temples started coming into existence these are the earliest evidences of Temple for of worship made in the form of caves. A large number of vegetarians called Sadya Kerala, Muslim and Christian population is found here. Simple appetizing cuisine is a part of the regular paraphernalia of people from Kerala. Simple living, pilgrimage places and pure cooking to be offered to the deities are a regular part of life of people in Kerala South India history, rich heritage, culture has been an inevitable part of Indian history since bygone eras. The rich heritage seen in the form of temples, ancient most sculptures, food cooked on daily basis in regular household to the one offered to the deity are some of the most crucial aspect of the South Indian region in India. Simple living, coastal regions full of Flaura and fauna are indeed a great gift from the gods to the people on land.</p>
        <h4>Exploring the city’s soul<sup class="text-dark small">&reg;</sup></h4>
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
