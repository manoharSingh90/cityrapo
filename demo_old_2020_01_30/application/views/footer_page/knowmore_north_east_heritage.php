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
  <div class="staticBanner" style="background-image:url(<?= base_url('assets/img/banners/knowmore/north_east/banner.jpg')?>);">
    <h2>North East India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>Heritage</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/north_east/heritage.jpg')?>" alt="#"/> </div>
        <p>One of the coolest regions, which is in nature’s lap, heritage of North Eastern India is relatively unchartered. With a variety of cultures to be experienced and amazing food to be tasted, there are many interesting places yet to be explored in North East. A place which has the only floating park in the world, the Keibul Lamjao National Park in Manipur is an integral part of Loktak Lake which has floating decomposed plant materials which are locally called as phumdis.</p>
        <p>The region alone is home to 14 national parks of India. Most of the national parks are located in Assam, but many others are scattered around in the region which can be really interesting to look at. The only region which has an abundance of natural beauty, it had a distinct history which helped them forming their states.</p>
        <p>Earlier a part of the Bengal province, many men, even the Mughals tried hard to establish their dominance over the region but had failed terribly. Two centuries, and no defeat. The brave kings of the region surely knew how to protect their territories. It is recorded that there were 17 bids of invasion by the Mughals, all of them were a fail. Later Ahom Kings dominated from 13th- 19th century before the British had occupied the territories.</p>
		  <p>Other than the natural beauty, one of the interesting facts about the province is a village in Meghalaya, east of Khasi Hills receives an annual average rainfall which is much more than any other province in India. The village which is named as Mawsynram holds a Guiness World Record for the same.</p>
		  <p>Umananda Island in the river Brahmaputra, is an isolated land area which has a temple by the same name.</p>
		  <p>Tea is what attracted the British towards North East, Assam is a small state which is the largest tea growing region in the world! Assam tea is so famous that tea lovers from every corner of the world would love to visit the tea plantations in Assam. Other than tea, Assam also produces fine quality Golden Muga, warm Eri silk and White Pat which is usually worn during wedding. It is one of the distict silks, which is not found anywhere else.</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="north_east_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="north_east_indian_culture"  class="activityBox">
          <h4>Culture</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north_east/culture.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="north_east_indian_food"  class="activityBox">
          <h4>Food</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north_east/food.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="north_east_indian_people"  class="activityBox">
          <h4>People</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north_east/people.jpg')?>" alt="#"/> </a> </li>
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
