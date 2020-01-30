
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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/media/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Press & Media</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>introduction of new tourism & educational experience positively affect to the social & economic development of the country once information is disseminated through media partners.</h3>
      <p>We offer great experiences to media on behalf of an organization, in the cities we operate with our own teams.</p>
      <p>These are offered on request basis and can be either a group or an individual Media FAM trip. We feel great offering this to press as our teasm and the organization have an opportunity to interact with people who disseminate information in public & what’s better than that they write a story about an organization when they fully understand and have experienced the offerings.</p>
      <p>Our  media and familiarization trips are promoted to invite travel, lifestyle, and food journalists, foreign tour operators, foreign retail travel agents, travel writers, travel photographers and bloggers from around the world to experience first-hand and write about India local experiences. Most of the travel features will be centered on places to explore, where to eat and what to do whilst discovering investment or branding opportunities. Our services range from supporting media visits, organizing group press trips, providing editorial content, contacts and images. Our press team also supports journalists in planning itineraries and provide assistance in collaboration with partners while the media are visiting India.</p>
      <p>For enquiries, please send us an e-mail on <a href="mailto:share@cityexplorers.in" target="_blank" class="text-secondary">share@cityexplorers.in</a></p>
    </div>
  </div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>
<!-- SCRIPT --> 

<!-- SCRIPT --> 
<?php include('foot.php');?>
</body>
</html>
