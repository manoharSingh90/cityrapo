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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/west/banner.jpg')?>);">
    <h2>West India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>Culture</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/west/culture.jpg')?>" alt="#"/> </div>
        <p>Western part of India can be loosely defined as a border region consisting of states like Rajasthan, Gujarat, Maharashtra, Goa, Diu and Dadra and Nagar Haveli. A distinct set of cities placed on the western zone of the Indian subcontinent differ hugely on the basis of culture, food weather, attire and what not. Every kilometer one travels in Western region one observes change not only in language but also in lifestyle, recipes, dressing etc. Maharashtra, Goa and Gujarat are culturally varied from what is followed in Rajasthan, as the name itself suggest Rajasthan was the land of rulers who ruled over the state even after India gained independence in the year 1947C.E. later adding on to be a part of Indian sovereign country. </p>
		  <p>Thus, the influence came to the people residing in the land of rulers. Rajasthan is a place where one can see two aspects of a single state on the one hand the rich sophisticated royalty can even be seen today living in their lush bunglows well guarded with bodyguards, travelling in luxury cars on the other hand are the normal people of the city, daily waged laborers, service men or business holders by profession, can only afford to have a two wheeler to drive them from one part of the city to the other. </p>
		  <p>The unique cultural landscape of Rajasthan is shaped thanks to the centuries of rule by the different dynasties and the alliances these dynasties had with other Empires and rulers formally shaping the history and geography of the state. The city is a land of various temples and simplistic living, the state accommodates one of the oldest and the only temple of Lord Brahma and the world famous fair of Pushkar where people from all over the world would come to enjoy the pushkar fair with traditional Folk dance, bon fire and hot air balloons is a place to be. Maharashtra is a land of black soil deriving its culture from the ancient Vedic culture, Marathi literature including poems and dramas are soul stirring paving way for plays and theaters to come up with local Marathi plays and dramas.</p>
		  <p>Marathi marriages are a true epitome of Marathi culture where unlike North India women are not supposed to cover their head during the marriage ceremony. They wear their typical nose ring and do have their customs and traditions according to what has been existing since past ages. An ardent believes in monogamy and residing and serving parents during old age etc. Goa on the other hand is a small state full of contrasting culture and traditions to what the popular perception of India is heavily influenced by Portuguese culture and tradition who ruled over the state as a colony very decades, the influence can be seen on traditions, cuisine and lifestyle of people from Goa. Gujarat is the largest port line in the entire country; every auspicious occasion usually begins by venerating lord Ganesha. Dandiya, garba, are some of the traditional folk dances very graceful in appearance usually performed in couples and by females respectively. Surprisingly, where the entire India connects television and film industry to Maharashtra today it is interesting to know that long before the arrival of talkies it was in Gujarat that several silent films were produced. Even today probably twenty film companies and studios are owned by Gujaratis</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="west_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="west_indian_food" class="activityBox">
          <h4>Food</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/west/food.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="west_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/west/heritage.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="west_indian_people"  class="activityBox">
          <h4>People</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/west/people.jpg')?>" alt="#"/> </a> </li>
      </ul>
    </div>
  </div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>
</body>
</html>
