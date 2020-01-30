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
        <h3>Heritage</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/central/heritage.jpg')?>" alt="#"/> </div>
        <p>The rich historical and cultural past of India, can be seen in Central India. A paradise for history buffs, archaeologists, art and heritage enthusiasts, people from different parts of the globe come here to understand the historical evolution. The region is replete with opulent palaces, majestic forts and magnificent temples, this central region of the country is one place where medieval history carved its way out. The region was ruled by several dynasties right from Marathas, to Bundela’s, Mughals and finally the British, you will be amazed to hear the tales of romance, brutalities, the bards and stories in small nooks and corners that seem to be oozing out from the architecture and spectacular art standing tall from past centuries. If you are a history buff and deep curiosity to know about places, explore more about some unknown, spaces, you should pay a visit once in your lifetime.</p>
        <p>Central India, covered by Malwa Plateau and Vindhya ranges have been sites rooted in history. From pre-historic to ancient, medieval and modern times, the history of the place has been ever evolving. One of the reasons is the strategic location which has helped garner a lot of attention. Follow the path of our ancestors and explore the caves of the hunter gatherers in Bhimbetka caves. An archaeological site which is the earliest known settlement of Homo Sapiens on the Indian subcontinent. Take a stroll around the capital of the biggest state, the land of lakes, which has an unparalleled charm and austerity. One of the major parts of the city’s history owes a great deal to the Begum’s of Bhopal, who shaped, restructured how Bhopal is in present times. Cities like Vidisha were important places for King Ashoka as it would be the connecting area for trading. Explore the city’s heritage, which owes a great deal to Buddhism. Explore the stupa’s and listen to their stories, and indulge in the tales of Buddha, and how Buddhism became an institutional religion. The ancient city of Maheshwar offers a splendid tour around spirituality. If you want to explore the spiritual nature of the region, explore Maheshwar as the temples date as far back as 8th century. The huge Gwalior fort is an architectural marvel in itself. It has been a home for later rulers of Gwalior, but the immensely fortified city wall is as grand as you can think of. A peak into the fort will let you know the architectural and dynastic evolution.  There are end number of instances, scattered in various parts of the region which give us an idea that medieval rulers wanted to conquer and they did! Burhanpur, Mandu, Orchha have historical specimens which prove the point. Explore around these cities, to get a glimpse of the how the history evolved.</p>
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
		  <li> <a href="central_indian_people"  class="activityBox">
          <h4>People</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/people.jpg')?>" alt="#"/> </a> </li>

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
