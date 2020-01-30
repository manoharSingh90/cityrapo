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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/about/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text text-center">
        <h2>An affair with India leaves one craving for more</h2>
        <p>We create experiential India engagement and enhance interpretation of a destination</p>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg">
    <div class="container">
      <div class="headingStatic border-0 pb-4">
        <h3>some <span>good</span> reasons To Buy From US</h3>
        <p>We assure you of a safe and comfortable India experience!</p>
      </div>
      <p class="text-center text-dark font-regular pb-4">We are a professional team backed by community of hosts and operators who love incredible India.<br>
        Our interdependencies and alliances provide opportunities for innovation and increased customer satisfaction.<br>
        The expertise offered on City ExplorersTM platform open up new opportunities to transfer education and culture through tourism and thus enhancing the visitor experience. The  region discovery allows travellers to time travel, and gives them autonomy to create their individual experience in the form of dialogues with the hosts, observe rituals and engage in daily life to get pure culture immersion. </p>
      <ul class="processList pb-5">
        <li>
          <div class="processBox"> <img class="pb-3" src="<?= base_url('assets/img/knowmore/process_01.png')?>" alt="process_01"/>
            <h5>We are visitor inspired</h5>
            <p>Sustainable development and quality of life </p>
          </div>
        </li>
        <li>
          <div class="processBox"> <img class="pb-3" src="<?= base_url('assets/img/knowmore/process_02.png')?>" alt="process_02"/>
            <h5>We are authentically local </h5>
            <p>Adopt and adapt to local circumstances </p>
          </div>
        </li>
        <li>
          <div class="processBox"> <img class="pb-3" src="<?= base_url('assets/img/knowmore/process_03.png')?>" alt="process_03"/>
            <h5>We are globally unique</h5>
            <p>Regeneration of the urban and social fabric</p>
          </div>
        </li>
        <li>
          <div class="processBox"> <img class="pb-3" src="<?= base_url('assets/img/knowmore/process_04.png')?>" alt="process_04"/>
            <h5>We have greater national recognition </h5>
            <p>Most awarded city sightseeing company in India with flagship identities</p>
          </div>
        </li>
        <li>
          <div class="processBox"> <img class="pb-3" src="<?= base_url('assets/img/knowmore/process_05.png')?>" alt="process_05"/>
            <h5>We pay attention to the simple things</h5>
            <p>Offer best possible local quality in terms of food, entertainment, travel and craftsmanship</p>
          </div>
        </li>
        <li>
          <div class="processBox"> <img class="pb-3" src="<?= base_url('assets/img/knowmore/process_06.png')?>" alt="process_06"/>
            <h5>We cater for specific needs, interests & time</h5>
            <p>We are enablers and can create any type of experience desired by you to know India your way.</p>
          </div>
        </li>
      </ul>
      <p class="text-center text-dark font-regular pb-2">We create <strong>uniqueness</strong> in scale that enables the visitor to connect with many offerings within a short timeframe. 
        Our host tell stories to enhance regional exploration, showcase living heritage through the design and delivery of tourism experiences. 
        By combining local food and drink with travel, our experiences offers both locals and tourists alike an authentic taste of place while
        contributing to a sustainable Indian economy. </p>
      <p class="text-center font-regular text-secondary pb-2"> Our operators create & deliver India moments for all kinds of travellers alongside appreciating regional cultures, history and traditions. </p>
      <p class="text-center font-regular text-secondary pb-4"> Our stories weaves information about social cohesion, rootedness & identity leading to local immersion in India’s diversity. </p>
    </div>
  </div>
  <div class="pt-5 pb-5 text-center cmyPromise" style="background-image:url(<?= base_url('assets/img/knowmore/cmypromise_bg.png')?>);">
    <div class="container">
      <h3>"Our experience-based tourism initiatives are interactive"</h3>
      <p> We create moments to enliven senses of our clients and make their visit truly memorable.<br>
        Our host led activities and authentic local experiences provide exceptional added value. </p>
    </div>
  </div>
  <div class="pt-5 pb-5 bg-white">
    <div class="container">
      <div class="headingStatic border-0 pt-0">
        <h3>Memberships & Recognitions</h3>
        <p>Creating fruitful relationships in communities </p>
      </div>
      <div class="text-center"> <img src="<?= base_url('assets/img/associates/allinone.png')?>" alt="allinone"/>
        <p class="text-dbl pt-3"><strong class="text-secondary">Recognised by Ministry of Tourism - Govt. of India</strong></p>
      </div>
    </div>
  </div>
  <div class="pt-5 pb-5 lightBg">
    <div class="container">
      <div class="headingStatic border-0 pt-0">
        <h3>Our <span>Awards</span></h3>
        <p>We share aspirations for more connected societies and a better quality of life. </p>
      </div>
      <div class="text-center"> <img class="pt-1"  src="<?= base_url('assets/img/awards/best-startup-19.png')?>" alt="best-startup-19"/><img class="pt-1" src="<?= base_url('assets/img/awards/cnp_2019.png')?>" alt="cnp_2019"/> </div>
    </div>
  </div>
  <div class="initiativeWrap bg-white">
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
<div class="partnerSection">
    <div class="container-fluid">
		<h2 class="text-uppercase">Diverse presence of brand portfolio across media platforms increasing customer satisfaction</h2>

      <div class="partnerSlider">
        <ul class="partnerRoller">
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/tie.jpg" alt="tie" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/bs.jpg" alt="bs" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/ht.jpg" alt="ht" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/taa.jpg" alt="taa" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tc.jpg" alt="tc" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/et.png" alt="et" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tnyt.png" alt="tnyt" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/et.jpg" alt="et" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/toi.jpg" alt="toi" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/it.jpg" alt="it" /></li>
          <li class="item"><img src="<?php echo base_url();?>assets/img/partner/cg.jpg" alt="cg" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/fe.jpg" alt="fe" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tst.jpg" alt="tst" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/ts.png" alt="ts" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/outtrv.png" alt="outtrv" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/thetribune.jpg" alt="thetribune" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tm.png" alt="tm" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/dut.png" alt="dut" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/tbn.jpg" alt="tbn" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/hmv.jpg" alt="hmv" /></li>
					<li class="item"><img src="<?php echo base_url();?>assets/img/partner/dj.jpg" alt="dj" /></li>
        </ul>
      </div>
    </div>
  </div>
<!--
  <div class="pt-5 pb-5 lightBg">
    <div class="container">
      <div class="headingStatic border-0 pt-0">
        <h3>What <span>Customers</span> Says</h3>
        <p>Our promise is customer delight and we believe discovery is a medium for growth, and inspires change. </p>
      </div>
      <ul class="saylist pt-0 pb-2">
        <li>
          <div class="sayBox"> <strong>Harshika Singh</strong>
            <p>Enriching Experience! Great way to bridge the gaps in the field of heritage experience and also helping to save monuments in smaller cities from becoming a victim of neglect.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="4" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Aman Oberoi</strong>
            <p>Wow! This is a great way to meet some very interesting, knowledgeable and passionate people. Very helpful to choose between things you want to experience family or friends.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="4" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Shraddha Sinha</strong>
            <p>Found the walk I took very well researched, and helped in understanding each aspect very well. Very eager to do this more often.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="4" />
            </div>
          </div>
        </li>
        <li>
          <div class="sayBox"> <strong>Preeti Kashiwal</strong>
            <p>As tourist, you don’t expect a lot when visiting lesser known places, but I found my experience was great for learning a lot about the place & it’s history. Excellent Experience.</p>
            <div class="introRating">
              <input type="textbox" class="ff-rating iwlRating" value="4" />
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>-->
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>
<!-- SCRIPT --> 
<?php include('foot.php');?>

</body>
</html>
	