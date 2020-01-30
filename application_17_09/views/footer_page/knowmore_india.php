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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/aboutindia/banner.jpg')?>);">
    <div class="staticBanner-text">
      <h2>Know India</h2>
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
        <div class="columnCount border-top">
          <p>India has always been there melting pot culture.  India, the delta of Asia is an amalgamation of Asia's culture, history, heritage and food. Known as the second most populated country of the world but that has never held it back from identifying itself as an example of multi-cultural, multi-lingual, secular state which has made its mark in the world map. With a past dating back to 2000 BC to a very sophisticated urbanized culture of Indus Valley civilization India has been self-sufficient throughout history, giving rise to (Sikhism, Buddhism and Jainism), refuge to (Judaism and Zoroastrianism) and adapting (Christianity and Islam) many religions while maintaining its strong roots in Hinduism. India’s vibrant history begins with the Vedic period in the ancient times, to incursions from the north and the north western region during the medieval period and its long past of colonization in the modern period. India’s diverse culture can be found in its every small nooks and corner which tells a story of its long past and its shinning future. All of its 29 states has it own history language heritage culture and food habits based on its geography flora and fauna.</p>
          <p>With Himalayas in the north, Thar Desert in the west, Deccan plateau in the south and the delta of Sundarbans in the east and three oceans giving it a long coastline, India has developed its unique flora and fauna which has continuously contributed to the enriching lifestyle of India. Each part of India has its own character which comes from its landscape with its own language, culture and food habits. The Northern part of India with Himalayas as its boundary is the birth place of the main rivers and gives protection from the cold Siberian winds. In spite of the Himalayas North has also been subjected to a large number of invasions from the Arabs, Turks and the Persians thus, the culture and history of this region is a perfect blend of various ethnic groups of central Asia and middle-east. </p>
          <p>Within India the Himalayas are divided into three longitudinal belts, called the Outer, Lesser, and Great Himalayas. At each extremity there is a great bend in the system’s alignment, from which a number of lower mountain ranges and hills spread out. The outer range of Himalayas, The Shivalik range which cover the area of West Bengal, Duars spreading to the north east is home to a diverse biodiversity which gives rise to a distinctive culture and history completely different from the rest of India. The fertile plains of the Northern basin of the river Ganga is called as the granary of the subcontinent. The Ganges basin covers the states of Uttar Pradesh Bihar along with its delta in west Bengal which is the delta basin for the river Brahmaputra, Ganga and Yamuna. The Great Indian, or Thar, Desert forms an important southern extension of the Indo-Gangetic Plain. It is mostly in northwestern India but also extends into eastern Pakistan and is mainly an area of gently undulating terrain, and within it are several areas dominated by shifting sand dunes  and numerous isolated hills. The Deccan plateau is the region between the oceans Bay of Bengal and Arabian Sea and is separated from the north with Vindhya Range. Being part of the Gondowana land this part of India is part of the oldest landmass of the world and is the most geologically stable part of India. The Deccan has developed a culture and heritage which has its traces in the Indus Valley civilization. It is so believed the genealogically there traces of people belonging to the Indus Valley Civilization. The Western Ghats rises abruptly on the western side of the Deccan plateau separating it from the Arabian Sea. This gives rise to an exceptional coastline and which is has been the entry point for many Europeans leading up to the colonization of India. The states which cover the Western Ghats are Maharashtra Kerala parts of Gujarat and Karnataka. The Eastern Ghats by the Bay of Bengal is home to the ancient most mountain range of the country covering parts of Andhra Pradesh and Orissa. It is also the place where we find range of ancient temples and numerous rivers. It is also the area of the great ruler Ashoka and the area of the Great War of Kalinga. </p>
          <p>The coastal region in the west starts from the salt valleys of Runn of Katch the union territories of Daman and Diu, the beaches of Goa and the back waters of the Kerala and the fertile delta region of the eastern coast. The life history, culture food and livelihood of these places depend highly on the ocean. Apart from the prominent Mughal history of the north the Deccan also has its contribution to the history of India which also included naval expeditions to the south east of Asia and spreading the culture and heritage of Indi. The major dynasties of indian Deccan history includes Pallavas, Chalukyas, Rashtrakuta, the Vijaynagar empire, the Marathas the Nizam’s of Hyderabad and the Muslim bahamani Sultunate of Deccan. </p>
          <p>Contemporary India’s increasing physical prosperity and cultural dynamism—despite continued domestic challenges and economic inequality—are seen in its well-developed infrastructure and a highly diversified industrial base, in its pool of scientific and engineering personnel (one of the largest in the world), in the pace of its agricultural expansion, and in its rich and vibrant cultural exports of music, literature, and cinema. Though the country’s population is largely rural, India has the most populated cosmopolitan cities of the world – Kolkata, Mumbai, Delhi and Bangalore. </p>
          <h4>Exploring the city’s soul<sup class="text-dark small">&reg;</sup></h4>
        </div>
      </div>
    </div>
    <div class="pt-4 pb-4">
      <div class="container">
        <ul class="blockList clearfix">
          <li> <a href="<?php echo base_url();?>central_india"> <img src="<?= base_url('assets/img/knowmore/thumbcentral.jpg')?>" alt="#"/>
            <h4><strong>Central</strong> India</h4>
            </a> </li>
          <li> <a href="<?php echo base_url();?>east_india"> <img src="<?= base_url('assets/img/knowmore/thumbeast.jpg')?>" alt="#"/>
            <h4><strong>East</strong> India</h4>
            </a> </li>
          <li> <a href="<?php echo base_url();?>north_india"> <img src="<?= base_url('assets/img/knowmore/thumbnorth.jpg')?>" alt="#"/>
            <h4><strong>North</strong> India</h4>
            </a> </li>
          <li> <a href="<?php echo base_url();?>north_east_india"> <img src="<?= base_url('assets/img/knowmore/thumbnortheast.jpg')?>" alt="#"/>
            <h4><strong>Northeast</strong> India</h4>
            </a> </li>
          <li> <a href="<?php echo base_url();?>south_india"> <img src="<?= base_url('assets/img/knowmore/thumbsouth.jpg')?>" alt="#"/>
            <h4><strong>South</strong> India</h4>
            </a> </li>
          <li> <a href="<?php echo base_url();?>west_india"> <img src="<?= base_url('assets/img/knowmore/thumbwest.jpg')?>" alt="#"/>
            <h4><strong>West</strong> India</h4>
            </a> </li>
        </ul>
      </div>
    </div>
    <div class="pt-5 pb-5 quoteWrap">
      <div class="container">
        <div class="pl-5 pr-5">
          <h3>INCREDBLE INDIA STORIES<sup class="small">&trade;</sup></h3>
          <small>Quotes from people</small>
          <div class="row align-items-center pt-4 pb-3 quoteMarks">
            <div class="col-12 col-sm-9">
              <p><em>"If the radiance of a thousand suns were to burst into the sky, that would be like the splendor of the Mighty One. . .<br>
                Now I am become death, the destroyer of worlds."</em></p>
              <p>Oppenheimer "the father of the atomic bomb" quoting from the Hindu scripture <strong>Bhagavad-Gita</strong> upon witnessing the mushroom cloud resulting from the detonation of the world’s first atomic bomb in New Mexico, U.S.A., on July 16, 1945.</p>
              <p>"Access to the Vedas is the greatest privilege this century may claim over all previous centuries."</p>
            </div>
            <div class="col-12 col-sm-3">
              <div class="quoteWrap-img">
                <div class="rounded-circle"> <img src="<?= base_url('assets/img/knowmore/quote_writer.jpg')?>" alt="#"/> </div>
                <h4>J. Robert Oppenheimer</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
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
