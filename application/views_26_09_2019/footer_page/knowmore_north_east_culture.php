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
  <div class="staticBanner" style="background-image:url(<?= base_url()?>assets/img/banners/knowmore/north_east/banner.jpg);">
    <h2>North East India</h2>
  </div>
  <div class="clearfix">
    <div class="container clearfix">
      <div class="knowmoreData">
        <h3>Culture</h3>
        <div class="knowmoreMap"> <img src="<?= base_url('assets/img/banners/knowmore/north_east/culture.jpg')?>" alt="#"/> </div>
        <p>It is a land of undulating hills and plains with luxuriant green cover and a wide variety or rare and exotic flora and fauna. Each of this state is more beautiful than the other, each with its own cultural and beliefs, each having its own charm. Because of the regions inaccessibility from the rest of world, it has been lucky enough to maintain most of its natural diversity and have been untouched from the modernization.</p>
        <p>There are many cultural distinct traditions which are prevalent but yet to be explored. The vibrancy of the cultures is such that each reflect the distinct characteristics. Mask Dance from Meghalaya, Pung Cholom & Basanta Ras Leela from Manipur, Satriya nritya from Assam, Naga Dance from Nagaland and Bamboo Dance from Mizoram was part of the show.</p>
        <p>Mask Dance (Meghalaya), are the part of religious and cultural traditions.The main purpose of this dance is to propitiate the deity, kill the evil king and protect the people from the wrath of natural calamities, diseases and epidemics and ensure health, happiness and prosperity for the people of the area.</p>
        <p>The soul of Manipur is Sankirtana music and Classical dance. In this style, the dancers play the pung (a form of hand beaten drum) while they dance and they need to be graceful and acrobatic at the same time.They use these acrobatic efforts without breaking the rhythm or flow of music.</p>
        <p>The Manipuri dance drama is, for most part, marked by a performance that is graceful, fluid, sinuous with greater emphasis on hand and upper body gestures. In this dance Rasa Leela is depicted within Manipuri classical way. The dance is performed holding dandi (sticks) and is often accompanied with folk songs and devotional music. The women characters are dressed like a Manipuri bride, in traditional Potloi costumes, of which the most notable is the Kumil. A Kumil is an elaborately decorated barrel shaped long skirt stiffened at the bottom and close to the top.</p>
        <p>Satriya Nritya (Assam), Sattriya Nritya, is a major indian classical dance. It is a dance-drama performance art with origins in the krishna-centered Vaishnavism monasteries of Assam. Naga Dance (Nagaland), Naga folk songs are both romantic and historical, with songs narrating entire stories of famous ancestors and incidents. This dance is a mix of martial arts and is athletic in style.</p>
        <p>Bamboo Dance (Mizoram), consisting of four people holding two crossed pairs of bamboo staves. It is one of the most famous dances in Mizoram, and a center of attraction during festive occasions.</p>
      </div>
      <ul class="activityList clearfix">
        <li> <a href="north_east_india" class=" activityBack">
          <h4 class="text-secondary">Go Back</h4>
          </a> </li>
        <li> <a  href="north_east_indian_food" class="activityBox">
          <h4>Food</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north_east/food.jpg')?>" alt="#"/> </a> </li>
        <li> <a href="north_east_indian_heritage"  class="activityBox">
          <h4>Heritage</h4>
          <img src="<?= base_url('assets/img/banners/knowmore/north_east/heritage.jpg')?>" alt="#"/> </a> </li>
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
