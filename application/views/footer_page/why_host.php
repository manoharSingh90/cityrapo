<?php include('head.php'); ?>
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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/becomehost/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text text-center">
        <h2>Become a Host<span>how it works</span></h2>
        <p>Travel, Tours, Activities for Urban, Rural Environments and Storytelling of Cultural Heritage. Paying attention to the simple things & increasing business opportunities for hosts and operators.</p>
        <a class="playClick" href="#"><img src="<?= base_url('assets/img/knowmore/play_button.png" alt="play"></a> </div>
    </div>
  </div>
  <div class="staticPage lightBg ">
    <div class="container">
      <div class="headingStatic pb-4">
        <h3>WE DELIVER <span>EXPERIENCES</span><sup class="small">&trade;</sup></h3>
        <p>and shall facilitate and innately care for your needs</p>
      </div>
      <p class="text-center text-dark text-dbl pt-4">Local communities at the heart of India’s showcase</p>
      <p class="text-center">Our strength has been in the ability to work with national and local authorities, communities and experts simultaneously, providing flexible methodologies to adopt and adapt to local circumstances and benefitting our host communities & customers. </p>
      <ul class="pt-4 pb-5 comList">
        <li><img src="<?= base_url('assets/img/knowmore/com_01.png')?>" alt="com_01"> List </li>
        <li class="divideLine"><img src="<?= base_url('assets/img/knowmore/com_divider.png')?>" alt="forward"></li>
        <li><img src="<?= base_url('assets/img/knowmore/com_02.png')?>" alt="com_02"> Deliver</li>
        <li class="divideLine"><img src="<?= base_url('assets/img/knowmore/com_divider.png')?>" alt="forward"></li>
        <li><img src="<?= base_url('assets/img/knowmore/com_03.png')?>" alt="com_03"> Get Paid</li>
      </ul>
      <p class="text-center mb-1">If you love your neighborhood, city, region and like to get involved in telling stories to people who choose you from our platform then <a href="#" class="text-secondary">contact us</a>.</p>
      <p class="text-center mb-5">It is important to note that there will be learning curves and active engagement will be required which will have varied timelines based on your competencies and skills. </p>
    </div>
  </div>
  <div class="pt-5 pb-5 opportunitiesWrap" style="background-image:url(<?= base_url('assets/img/knowmore/opportunities_bg.png')?>);">
    <div class="container">
      <h3>Beside listing full time opportunities are available</h3>
      <ul>
        <li>We also provide skill support to aspiring individuals.</li>
        <li>Partnership and community-based collaboration</li>
        <li>Financial support and performance measures</li>
      </ul>
      <a href="#" class="btn btn-lg btn-primary">Contact Us</a> </div>
  </div>
  <div class="pt-1 pb-4">
    <div class="container">
      <div class="headingStatic border-0">
        <h3>Why <span>Work</span> with us</h3>
        <p class="text-uppercase text-dark pb-3 text-dbl">InspiraTIONal ELEMENTS</p>
        <p>We understand travellers when compared to their generic tourist counterparts making their potential economic impact even greater for the host + destination they choose to visit.</p>
      </div>
      <div class="row workText">
        <div class="col-12 col-sm-6 text-center"> <img class="pb-1" src="<?= base_url('assets/img/knowmore/work_img_01.png')?>" alt="work_img_01"/><span>Independence</span>
          <p>We offer you open models to list the activities, itineraries on the City ExplorersTM platform based on your convenience.  We also have possibilities to offer based on interest shown by the operator & host community to use one or more product lines associated with our company brand in independent manner.</p>
        </div>
        <div class="col-12 col-sm-6 text-center"> <img class="pb-1" src="<?= base_url('assets/img/knowmore/work_img_02.png')?>" alt="work_img_02"/><span>Skills</span>
          <p>Tourism is undergoing a transformation in how it is developed, marketed and managed, driven by rapidly changing visitor expectations.  We will support you in skilling and guide the necessary transition for you to become Walk Leaders®, Storywallah® or an activity expert. We create human infrastructure at local and national levels. </p>
        </div>
        <div class="col-12 col-sm-6 text-center"> <img class="pb-1" src="<?= base_url('assets/img/knowmore/work_img_03.png')?>" alt="work_img_03"/><span>Growth</span>
          <p>We help you developing interpersonal relationships and open new avenue for your to earn money. We like you to be honest in your dealing with us and our customers. By joining hands with us you will gain recognition and reliance in your social circuit. You will get good reputation and stable social status, with which you can possess authority in your neighbourhood. </p>
        </div>
        <div class="col-12 col-sm-6 text-center"> <img class="pb-1" src="<?= base_url('assets/img/knowmore/work_img_04.png')?>" alt="work_img_04"/><span>Experience</span>
          <p>There is an increasing emphasis being placed on ‘experiences’ by consumers and to deliver an experience you have to be ready to  interact with people, engaging the senses, and learning the history and stories of the place.  We will increase business opportunities for our City ExplorersTM, Walk Leaders® and Storywallah®  by offering them space to list their activities, itineraries on the City Explorers&trade; platform. </p>
        </div>
      </div>
      <div class="row workText pt-5 border-top mt-3">
        <div class="col-12 col-sm-6">
          <div class="row align-items-center pb-3">
            <div class="col-12 col-sm-6"> <span class="font-weight-semibold text-secondary">Business-oriented attitude</span></div>
            <div class="col-12 col-sm-6"> <img src="<?= base_url('assets/img/knowmore/icons_02.png')?>" alt="icons_02"></div>
          </div>
          <p>The host community and City ExplorersTM, Walk Leaders® and Storywallah® will earn money when their experiences offer visitors the opportunity to connect with their exploring India desire. The visitors immerse themselves when their senses are engaged – it triggers emotions and creates lasting memories. does your listing engage the senses from the start of the visitor journey i.e. pre-visit? </p>
        </div>
        <div class="col-12 col-sm-6">
          <div class="row align-items-center pb-3">
            <div class="col-12 col-sm-6"> <span class="font-weight-semibold text-secondary">Market economy</span></div>
            <div class="col-12 col-sm-6"> <img src="<?= base_url('assets/img/knowmore/icons_02.png')?>" alt="icons_02"></div>
          </div>
          <p>The collaborative nature of experience development ensures that the economic benefits that accrue, not only benefit the individual businesses involved but also a much wider community. Our role is to help you in understanding the customers requirements and while individually story or service can create a memorable tourism experience in it’s own right, more often, it is the combination of a number of parts that combine to make it a truly memorable experience.</p>
        </div>
        <div class="col-12 text-center">
          <h4 class="pt-5 pb-3">Our collaborative synergies are the best avenues to success and we develop strong relationships between growers, chefs, tour guides, historians, accommodation providers, distributors, government and industry organizations.</h4>
        </div>
      </div>
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
</main>
<?php include('footer.php')?>

<!-- LEAVE MESSAGE -->
<div class="leaveMessage"> <a href="#" class="msgLink">Leave a message</a>
  <div class="messageForm">
    <form>
      <h2 class="text-secondary">Leave a message</h2>
      <ul class="form-row">
        <li class="form-group col-12">
          <label class="col-form-sublabel">Full Name</label>
          <input type="text" class="form-control" placeholder="Full Name" required />
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Email</label>
          <input type="email" class="form-control" placeholder="Email" required/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Phone</label>
          <input type="number" class="form-control" placeholder="Phone" required/>
        </li>
        <li class="form-group col-12">
          <textarea class="form-control" placeholder="Write your message (max. 400 chartacters)" maxlength="400" required></textarea>
        </li>
        <li class="form-group col-12 text-right">
          <button class="btn btn-primary">Send</button>
        </li>
      </ul>
    </form>
  </div>
</div>

<!-- LEAVE MESSAGE -->
<div class="leaveMessage"> <a href="#" class="msgLink">Leave a message</a>
  <div class="messageForm">
    <form>
      <h2 class="text-secondary">Leave a message</h2>
      <ul class="form-row">
        <li class="form-group col-12">
          <label class="col-form-sublabel">Full Name</label>
          <input type="text" class="form-control" placeholder="Full Name" required />
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Email</label>
          <input type="email" class="form-control" placeholder="Email" required/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Phone</label>
          <input type="number" class="form-control" placeholder="Phone" required/>
        </li>
        <li class="form-group col-12">
          <textarea class="form-control" placeholder="Write your message (max. 400 chartacters)" maxlength="400" required></textarea>
        </li>
        <li class="form-group col-12 text-right">
          <button class="btn btn-primary">Send</button>
        </li>
      </ul>
    </form>
  </div>
</div>

<!-- SCRIPT --> 
<?php include('foot.php');?>
</body>
</html>
