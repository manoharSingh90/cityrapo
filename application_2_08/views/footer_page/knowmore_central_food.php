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
        <h3>Food</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/central/food.jpg')?>" alt="#"/> </div>
        <p>The capital of Madhya Pradesh, Bhopal is famous for its modern metropolitan development, historic culture, exquisiteness and above all availability of large variety in lip smacking food and cuisines. The food varieties in Bhopal are differentiated from culinary ethnicity of Hindu and Muslim and Bhopal famous food is recognized for its delicious meat dishes. Curries and kebabs are the most acknowledged and preferred recipes from the city’s cuisine.</p>
        <p>Bhopal is the fourteenth largest city in India and is also famously known as the city of lakes. It is not only rich in its history and culture but the food offered here in Bhopal is a real delight for those who call themselves foodie. Due to a large number of Muslims and Hindus living here, the cuisine of Bhopal is greatly influenced by both Muslim and Hindu culture. The cuisine of Bhopal includes some of the very delicious vegetarian dishes along with exotic and rich non-vegetarian dishes too. Some of the most well-liked dishes you can enjoy in Bhopal are given here. The food culture of the region has had immense influence from various rulers. The vegetarian influences mostly comes from the Maratha rule. Trust crispy jalebi’s, Poha and kachori’s to kickstart your day perfect. Or some Achari Gosht, Biryani Pilaf, Roghan Josh, Bhopali Naan, which has been conquering our hearts ever since it got the touch of the Mughlai cuisine. </p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="central_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="central_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/central/culture.jpg')?>" alt="#"/> </a> </li>
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
