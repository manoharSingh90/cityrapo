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
  <div class="staticBanner" style="background-image:url(assets/img/banners/knowmore/central/banner.jpg);">
    <h2>Central India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>Culture</h3>
        <div class="knowmoreMap"> <img src="assets/img/banners/knowmore/central/culture.jpg" alt="#"/> </div>
        <p>The central region of India is widely known for its historic past, pilgrim centers, wildlife and tribal existence, and that is the reason why it is considered to be one of the best places to visit in the country. Here are of some of the best tours you can take to Central India to experience its authentic charm and beauty.  The ,most important tribe in all of Central India are the Gonds. Gonds live all over central India, and in the states of Maharashtra and Orissa. As "hill people," they traditionally have been associated with hills and uplands in the Deccan Peninsula. Many Gonds live around the Satpura Hills, Maikala Range and Son-Deogarh uplands, and on the Bastar plateau. Many Gond tribes also live in the Garhjat Hills of northern Orissa. The region is drained by the head-waters of many of India's major rivers (such as the Narmada, Tapti, Son, Mahanadi, and Godavari).</p>
        <p>Forest cover is dense in places, and communications are generally difficult. The summer brings the monsoon rains, with precipitation amounts varying from 47 inches (120 centimeters) to over 63 inches (160 centimeters) in the more southeasterly locations. Late September marks the return of the cool, dry weather of winter. Hereditary bards and professional storytellers called Pardhans tell stories about Gond legends and myths. This makes for a rich oral tradition. In these stories, it is said that when Gond gods were born, their mother abandoned them. The goddess Parvati rescued them, but her consort Sri Shambhu Mahadeo (Shiva) kept them captive in a cave. Pahandi Kapar Lingal, a Gond hero, who received help from the goddess Jangu Bai, rescued them from the cave. They came out of the cave in four groups, thus laying the foundations of the basic fourfold division of Gond society. Lingal also is responsible for creating a Gond kinship system and establishing a group of great Gond gods.</p>
        <p>Gond men typically wear thedhoti,or loincloth. The dhoti is a long piece of white cotton cloth wrapped around the waist and then drawn between the legs and tucked into the waist. Women wear a cottonsari(a length of fabric wrapped around the waist, with one end thrown over the right shoulder) and choli(tight-fitting, cropped blouse). Both men and women enjoy wearing heavy silver ornaments. Women also like to wear colored glass bangles and marriage necklaces made of small black beads. They often tattoo their bodies.</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="central_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="central_indian_food" class="activityBox">
          <h4>Food</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/food.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="central_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/heritage.jpg')?>" alt="#"/> </a> </li>
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
