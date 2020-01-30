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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/howitworks/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text text-center">
        <h2>How it works</h2>
        <p>Diverse purposes and multiple context are offered that has the power to change people’s motivation and behaviour, develop skills and drive innovation when they travel with us.</p>
        <a class="playClick" href="#"><img src="<?= base_url('assets/img/knowmore/play_button.png')?>" alt="play"></a> </div>
    </div>
  </div>
  <div class="staticPage lightBg ">
    <div class="container">
      <div class="headingStatic">
        <h3>EXPLORE <span>INDIA</span> IN MEANINGFUL WAY</h3>
        <p>Let us help transform ordinary trips into customized, extraordinary experiences</p>
      </div>
      <div class="row areaIntro pt-5 pb-5 border-top align-items-center">
        <div class="col-12 col-sm-5">
          <div class="areaIntro-img"><img src="<?= base_url('assets/img/knowmore/fullimage_04.jpg')?>" alt="fullimage_04"></div>
        </div>
        <div class="col-12 col-sm-7 font-regular">
          <p class="mb-2"><strong class="text-secondary">With us you can safely discover the India of now!</strong>&trade;</p>
          <p>City ExplorersTM is a travel discovery platform to get authentic India experience. We encompasses every conceivable aspect of tourism within <strong>India’s immense diversity</strong>, and across the individualistic regions- all of which allows the explorer in you the opportunity of engaging interactions with local cultures and the people who make these locations substantially more interesting than many of the customized go-see-return-and forget excursions. </p>
          <p class="mb-2"><strong class="text-secondary">Non stop fun whichever way you look at!</strong>&trade;</p>
          <p>Under the nurturing umbrella of of our flagship brands fellow seekers of the perfect India experience will find the specialized segments of opportunities with perfect customer service along with many excellent travel excursions and activity choices around culture, transportation, shopping, and dining. </p>
          <p class="mb-2"><strong class="text-secondary">A story to tell, a legacy to share...</strong>&trade;</p>
          <p> Our delivery partners, operators and employees will always instil a sense of pride in natives associated with their heritage and culture.  We emphasis on the cultural impacts related to traditional values, norms, and identities arising from appreciation and awareness. We have introduced multiple initiatives across states in India especially in the area of tourism and citizen engagement </p>
        </div>
      </div>
    </div>
  </div>
  <div class="pt-5 pb-5 reasonWrap" style="background-image:url(<?= base_url('assets/img/knowmore/reason_bg.png')?>);">
    <div class="container">
      <h3 class="text-uppercase font-weight-bold mb-2">some good reasons</h3>
      <p>Local characters tell the history of the place and give background information.<br>
        Location-based activities create playful interactions between the visitor and the tourist destination.</p>
      <ul class="pt-4 pb-2">
        <li><img src="<?= base_url('assets/img/knowmore/reason_img_01.png')?>" alt="reason_img_01"> Search &  finalize activity </li>
        <li class="divideLine"><img src="<?= base_url('assets/img/knowmore/reason_divide.png')?>" alt="forward"></li>
        <li><img src="<?= base_url('assets/img/knowmore/reason_img_02.png')?>" alt="reason_img_02"> Pay for it</li>
        <li class="divideLine"><img src="<?= base_url('assets/img/knowmore/reason_divide.png')?>" alt="forward"></li>
        <li><img src="<?= base_url('assets/img/knowmore/reason_img_03.png')?>" alt="reason_img_03"> Meet host & enjoy activity</li>
      </ul>
    </div>
  </div>
  <div class="pt-5 pb-5">
    <div class="container">
      <div class="headingStatic border-0 pt-0">
        <h3>WHAT <span>HOSTS</span> SAYS</h3>
        <p>Our experiences showcase a wide range of interdisciplinary creative energy.</p>
      </div>
      <ul class="saylist pt-0 pb-2">
        <li>
          <div class="sayBox"> <strong>Sanya Acharya</strong>
            <p>Felt overwhelmed with kind of support and guidance that team CEPL has provided, there can be no better way to involve the youth into tourism sector of the country.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Anurag Shukla</strong>
            <p>As a tour guide, it was very positively different for me to get out of the fixed schedules & itinerary, providing an opportunity to curate & deliver on the subjects which are my area of research. </p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Sharvaani </strong>
            <p>It is empowering for people from smaller cities since the platform gives the freedom to curate experiences with add flavors and helps connect with right audience.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Manohar</strong>
            <p>I have curated experiences in many parts of India but have never felt so relaxed about it ever before, as I had to promote each one separately. With City Explorers, it save so much time & effort by making it easy to curate, upload & promote.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="pt-5 pb-5 lightBg">
    <div class="container">
      <div class="headingStatic border-0 pt-0">
        <h3>What <span>Customers</span> Says</h3>
        <p>We offered authenticity by creating shared experience </p>
      </div>
      <ul class="saylist pt-0 pb-2">
        <li>
          <div class="sayBox"> <strong>Priyanka Aiyer</strong>
            <p>Great way to explore & learn the past and present of the cities. Also helps to connect with like minded people.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Ashok V.S.</strong>
            <p>Enriching Experience! Great way to bridge the gaps in the field of heritage experience and also helping to save monuments in smaller cities from becoming a victim of neglect.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Ajanya Sharma</strong>
            <p>Felt like going into a time machine! Very well curated and presented tour with beautiful locations.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Raj David</strong>
            <p>Perfect way to explore the cultural heritage is indeed with the local people, lots of information and insights made the experience complete.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="5" />
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="pt-1 pb-4 lightBg workText">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-6"> <span>Creating transformation</span>
          <p>Backed by a committed team of professionals helps us to import & export dreams with tenders. The host community focus on tourism related services and support local development to drive socio-economic growth.</p>
        </div>
        <div class="col-12 col-sm-6"> <span>Finding characters</span>
          <p>We will have drawn on every last bit of knowledge and experience at our disposal to ensure not only that everything goes without a hitch, but that you will have been left with a feeling that they’ve had a memorable (and otherwise unachievable) travel experience.</p>
        </div>
        <div class="col-12 col-sm-6"> <span>Carry on Learning</span>
          <p>We offer a full range of services that let you indulge in India. From multi-lingual tour guides, lunch and dinner options, including themed banquets, entertainment and sporting and cultural activities.  The experiences are delivered by locals who are listed as hosts and
            provide high standard of service.</p>
        </div>
        <div class="col-12 col-sm-6"> <span>Positive effect</span>
          <p>The City Explorers platform creates social contacts between tourists and local people that may result in mutual appreciation, understanding, tolerance, awareness, learning, family bonding respect, and liking.</p>
        </div>
        <div class="col-12 col-sm-6 text-center"><img src="<?= base_url('assets/img/knowmore/hiw_image_01.png')?>" alt="hiw_image_01"></div>
        <div class="col-12 col-sm-6 text-center"><img src="<?= base_url('assets/img/knowmore/hiw_image_02.png')?>" alt="hiw_image_02"></div>
        <div class="col-12 text-center">
          <h4 class="pt-4 pb-3">We bring social and economic impacts on local community and their perception towards the tourism development in the neighbourhood </h4>
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
