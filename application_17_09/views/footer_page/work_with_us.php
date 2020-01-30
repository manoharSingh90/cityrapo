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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/work/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Work<span>With Us</span></h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>We generate substantial economic benefits for hosts, guests & for a region to promote itself as a tourism destination leading to economic improvement</h3>
      <hr class="mt-5 mb-5">
      <p>We are a dynamic organization with expertise in making History and Heritage come alive. Our nature of work brings in the flavour of the season and region to the best of its offerings. It is a unique venture which has evolved over a period with the right mix of passion and profession. </p>
      <p><strong>Our mission is to design experiences that improve peoples’ lives.</strong> </p>
      <p>We’re in a period of growth and have dozens of exciting job opportunities available right now at our New Delhi-NCR headquarters as well as in all major cities of India. Through our work we are building a diverse and sustainable community
        and hiring talented individuals from all walks of life and non-tech / tech backgrounds. </p>
      <p>With the Indian Tourism Market growing every year we provide opportunities for the right people to get involved in this exciting industry.  Tourism industry is an <strong>important growth driver</strong> for a country, its economy and also for its social progress and monitoring. <strong>Tourism</strong> brings tremendous <strong>economic value for a country</strong> contributing to employment generation and foreign exchange earnings for a country. It touches and impacts several industries directly and many more indirectly through tourism spend. </p>
      <p>We also take on strategic pro bono projects, giving teams the ability to use their skills as a force for good. We believe in creating an eco-system to preserve our inheritance in monuments, culture, traditions & heritage for the generations to come. </p>
      <hr class="mt-4 mb-4">
      <p><strong>Who we are looking for</strong> </p>
      <p>This is a platform for all those who possess: the ‘gift of gab’ in either English or any vernacular languages, understand their region, know their subject and wish to experience something new every day. </p>
      <p>Join us if you share the same passion to share and exchange cultural highlights of your region and our nation. For us, every region of India is a potential place to showcase. Constantly expanding through geographical terrains, we are in the look-out of individuals who are innovative, enthusiastic, talented in their subjects and genre of expertise. </p>
      <p>An ideal opportunity to take a step forward in bringing history and heritage as a professional career. </p>
      <hr class="mt-4 mb-4">
      <p><strong>Applying</strong></p>
      <p class="mb-1">Please send us the following information:</p>
      <ul class="mb-4">
        <li>Your resume in English</li>
        <li>When you are available to start work</li>
        <li>A statement of purpose mentioning your competencies and your future visions</li>
      </ul>
      <p>For enquiries, please send us an e-mail on <a href="mailto:share@cityexplorers.in" target="_blank" class="text-secondary">share@cityexplorers.in</a></p>
    </div>
  </div>
</main>

<?php include('footer.php');?>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>
</body>
</html>
