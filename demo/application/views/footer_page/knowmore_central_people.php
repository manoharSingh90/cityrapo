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
    <h2>Central India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>People</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/central/people.jpg')?>" alt="#"/> </div>
        <p>The tribes of Madhya Pradesh are the Scheduled tribes as per the prerequisite of the Constitution of India. The tribes of Madhya Pradesh have ranked in the top in terms of the tribal population. In addition, these tribes of Madhya Pradesh are subgroups in to numbers of castes, which too have got high proportion. The tribes of Madhya Pradesh’s population constitute over 20% of the state population & are mainly concentrated in southern part of the state. The life style, culture & customs of this community mostly resemble the Hindu religion though they still strongly believe in orthodox traditions. The social customs prevalent among different types & castes vary more due to variation in their habitat & surroundings geographical conditions. For earnings they depend upon agriculture & forest produce & local craft. With improved communication & growth in the economy, the tribal’s way of living has changed from their original hunting & gathering existence to one near the mainstreams.</p>
        <p>There are many tribes, of them, Gond, Bhil, Baiga, Saharia, Abujhmar, Baharia Tribe, and Santia’s. Gond is the best known tribe & forms the largest group in Madhya Pradesh. Gonds in Bastar linger perhaps the least in contact with the world outside due to the isolation and roughness of the terrain. The institution of Ghotul at Abujmarh- a dormitory for the unmarried teenagers to live together, select their mate and gain valuable experience to set up their own household-has attracted significant scholarly attention & Madai is their traditional dance to enjoy the happiness. The mainly inhabit areas on both sides of the Narmada in Mandla, Chhindwara, Betul & Seoni regions & the hilly terrains of the Vindhya & the Satpura region. Agaria, Pradan, Ojhan, Solahas are the descendants tribal groups originating from Gonds, with two subcastes – Rajgond & Datoliya.Bhils, the second largest tribe are largely concentrated in the area around Jhabua, Khargone, Dhar & Ratlam. Regarded as warriors with fine inheritant guerilla tactis, their archery skills find mention in the hindi epics Mahabharata & Ramayana. They claim their descent from Lord Shiva. Locally brewed wine plays a significant role in their social & religious ceremonies. They have an interesting custom of marriage through the elopement. The Bhagoriya festival at the time of Holi, the festival of colours, in the Jhabua region cannot be compared with any other festivity. Bhil youths indulge in colourful frolic excited by the projection of meeting their future spouse. If some maiden strikes the prospective groom’s fancy, all he has to do is to offer a betel leaf to the girl. If she accepts, the two abscond in the time honored tradition to set up their house together.</p>
		  <p>Baigas believe themselves to be descendants of Dravid & As the name advocates, these are that society of the Gonds who fall in the priest class. It entails that they indulge into magical activities and boast about being knower about the evil spirits. Chiefly in the Mandla, there is a special settlement in the small tract of Baiga Chak. Besides practicing agriculture they are passionate woodsman and hunter. Some of the other small sects that too fall in this category are the Pradhans, Korkus and Kols. This backward tribe of Baigas is found in Mandla, balaghat, Shahdol & Sidhi District.</p>
		  <p>These aboriginals inhabit North West area mainly in the districts of Gwalior, Shivpuri, Bhind, Morena, Vidisha & Raisen. Most Saharia’s are cultivators & are worshippers of Goddess Durga. Saharia is an important tribe. Etymological point of view expresses that the word ‘Sahria’ is the combination of two independent words like “Sa’ (companion) and ‘Haria’ (tiger) which mean companion of tiger (Tiwari, 1984). Saharia are the members who belong to traditional society. Most of the Saharia are depended on ecology which plays an important role in forming their economic structure (Mandal, 1998). The post economic history implies that they traditionally practised shifting cultivation, hunting, gathering, pastoralism, etc. and sometimes also adopted nomadic life. They are very much addicted to drink local wine. Saharia are dominated by nuclear families.They generally practise negotiation and monogamy form of marriage at very early age.</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="central_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="central_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/culture.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="central_indian_food"  class="activityBox">
          <h4>Food</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/food.jpg')?>" alt="#"/> </a> </li>
		  <li> <a href="central_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/heritage.jpg')?>" alt="#"/> </a> </li>

      </ul>
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
