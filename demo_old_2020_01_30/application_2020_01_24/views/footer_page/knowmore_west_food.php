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
        <h3>Food</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/west/food.jpg')?>" alt="#"/> </div>
        <p>Western part of India includes states like Rajasthan, Gujarat, Maharashtra, and Goa. Amongst these Rajasthan and Gujarat have hot and dry climate hence less variety of vegetables are produced and the once which grow are preserved in the form of pickles and sauce which are locally called chutneys. Culturally these states are largely Hindu predominant areas hence they are vegetarian areas. Maharashtra being rich in Black soil produces high amount of cotton and rice. Extremely versatile cuisine. Presence of multifarious communities in the state has helped Maharashtra to be innovating in recipes and rich in variety. Vast coastline ensures that there is no dearth of sea food in the state.</p>
        <p>Predominantly rice eating population inhabits Maharashtra being a coastal but partly arid region the food varies in the region accordingly. Things like coconut, rice, and peanuts are important part of diet as these are available all around the year been growing in the same area, making it practical and more economical to use these. Local delicacies like Vindaloo that is a spicy curry flavored with many locally available flavours and spices is a must try when in Goa along with sea food and locally produced alcohol.</p>
        <p>Rajasthani food is spicy, predominantly vegetarian cooked with more amount of oil and ample use of gram flour as the region faces lack of vegetables due to the dessert belt in the state. The cuisine tells the tale of the struggle of its inhabitants who had to combat the harsh climate of the region. Facing the scarcity of water and almost nil agriculture, it is praiseworthy to note that people have devised recipes which fulfill the needs of the people of high energy food, takes care of the geographical compulsions and are still appreciated by gourmets of repute. Gujarati cuisine is known for its vegetarian cuisine what makes the cuisine of Gujarat stand out as compared to that of Rajasthan is a slight sweet touch which is added to the cuisine. Preferring a thaali that is a large plate with multiple varieties of vegetables cooked with different textures and flavoures. Be it Thepla, Khakra of Farsan Gujaratis love their gram flour based snacks with every kind of pickle and chutney. The recipes are known for the subtle use of spices and rich texture.</p>
        <p>Malvani cuisine from Maharashtrian curry which are hot and sour served with seafood basically fish. While the interiors of Maharashtra relish Vidharba cuisine where more of dried coconut is used in the cooking process. </p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="west_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="west_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/west/culture.jpg')?>" alt="#"/> </a> </li>
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
