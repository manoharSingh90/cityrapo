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
    <h2>South India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>People</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/south/people.jpg')?>" alt="#"/> </div>
        <p>Each south Indian state has its own unique cultural traditions making it a lifestyle of certain people residing in that area. India is indeed a country with the most diverse form and variety of people coexisting at the same time along with mixture of races. People speak hundreds of Languages, follow different lifestyles, eating habits, dressing style, cultural diversity etc. South Indian region is indeed an epitome of how cultural diversity co exists with utmost happiness and self contentment. Low on expectations and a simple lifestyle is what generalizes the people of South India on a whole. South India accommodates Kerala with the highest amount of Literacy level in the country.  The entire South Indian region of India if dotted with colossal temples built over the period of time in bygone eras making it a point that cast hierarchy is mandatory followed in the region. The Brahmins consume vegetarian dishes saying No to Non vegetarian dishes. On the other hand there is a distinction in the Brahmin sect as well in Tamil Nadu state one sees the emergence of a small community in the 19th and 20th Century called Chettinad Brahmins, these were a social caste of mercantile bankers were the word ‘Chetti’ traces its roots from a Sanskrit word ‘Shreshthi’which translates for wealth, the community is the one who despite of being Brahmins consume sea food considering these to be fruits of the sea.</p>
        <p>The chettinad cuisine consists of lentils; ghee for flavoring rice which is an essential component of cuisine apart from the cuisine the community is also famous for its architecture. These mansions have huge spacious courtyards and rooms finished with marble stone and adorned with teak furniture. Marble generally brought from Italy and the furniture was exported from Europe or East Asian countries, Chandeliers from Burma as well as crystal and wall to wall mirrors from Europe and Burma respectively. These colossal mansions owned by the chettinad community were made using a form of limestone if we believe a popular saying which says that the walls of these colossal mansions were polished using egg whites. In a country as dissimilar as India it is not surprising to note that people living today as some part of the other depict the rich glories of the past. The culture, values, rituals, habits, food, traditions as per the geographic locations are the components which makes one region or state standout from the other.</p>
        <p>The naturalized lands of South India are a home to a variety of people probably from all walks of life these include the farming section which are a majority as the Southern region is surrounded with huge water bodies like Arabian sea, Bay of Bengal and Indian ocean on three different sides. With a ix combination of Red and Yellow soil along with Laterite soil found in small pockets of the region making it fertile enough to grow crops like cardamom, cinnamon, black pepper, coffee, etc. The zamindards who occupy lands and give them out for cultivation are the wealthiest of all classes who owns huge tracts of land built big houses to them and reside there. Agricultural sector is one of the chief sectors in Andhra Pradesh making it an agriculture based area in southern region. Karnataka state these attracts one third of India’s information technology exports. 80% of the population here is employed in agriculture thanks to the rich soil present in the region also a home to the software development sector of India having Indian Space Research Organization (ISRO) often referred to as the silicon valley of India today is a hub for technology students and workers in the country. Kerala again has a large agricultural land with majority of people working in the farm lands or in wildlife economy</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="south_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="south_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/south/culture.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="south_indian_food"  class="activityBox">
          <h4>Food</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/south/food.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="south_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/south/heritage.jpg')?>" alt="#"/> </a> </li>
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
