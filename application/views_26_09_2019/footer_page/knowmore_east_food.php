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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/east/banner.jpg')?>);">
    <h2>East India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>Food</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/east/food.jpg')?>" alt="#"/> </div>
        <p>The Eastern Zone of India is a spicy hot mixture of lip-smacking vegetarian and non-vegetarian food. The unique and unsurpassable cuisine of this region becomes even more special due to its cultural and lingual multi-diversity coupled with its fascinating narrative, history and geography of the encompassing states that are integral to its formation.</p>
        <p>The habitants of West Bengal are in love with fish, rice and sweets. Their legendary fetish for them has made a significant contribution to the popular cuisine of not just the Eastern region but the whole of Nation. Some of the parts of Orissa also have a hand in this unimaginable love for fish and rice as the two states share the long coastline in the Bay of Bengal. The recipes including fish and rice are a work of art in West Bengal. Moreover, the Bengali cuisine is a unique assimilation of the best of the world gastronomy and diverse Indian cooking techniques. The fame of the Bengali cuisine has risen so much that small Bengali restaurants can easily be located anywhere in foreign cities.</p>
        <p>The people in Bihar and Jharkhand prefer their eating tables to be full with colours of rich seasonal vegetables which are present in great amounts and variety here. As Buddhism began in this very place, its influence has found way into the lifestyle of the majority as they practice vegetarianism. Later on the coming of the Mughals naturally introduced the famous non-vegetarian Mughal cuisine which overtime became a favorite amongst many.</p>
        <p>Orissa follows some of the same food traditions as the neighboring states because of which rice is one of the major staple foods which is often paired with vegetables. The religious nature of the Oriya people is one reason why most of them adhere to vegetarianism. Nevertheless, a number of Oriya population is keen on relishing a wide range of seafood such as fish, prawns, crabs and lobsters which abound at the vast coastline. Sweets are also a great love of the people along with curd and milk based products. The curd found in this region is especially rich and creamy which gives the succulent flesh an add-on of a flavor. Yams, brinjals and pumpkins are also used in. Pithas are also very popular food items here.</p>
		  <p>The various regions come together in a blend of flavor of the East Indian region and make it what it is. It is a coveted attraction for many who wish to travel and explore this region by the seaside. The flavor of the Bengalis, the Odissi, the Biharis and others comes together and gives the Eastern Indian region a unique flavor.
</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="east_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="east_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/east/culture.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="east_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/east/heritage.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="east_indian_people"  class="activityBox">
          <h4>People</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/east/people.jpg')?>" alt="#"/> </a> </li>
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
