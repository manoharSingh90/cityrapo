
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
        <h2>Contact Us</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>Contact Us</h3>
      <p>We at CityExplorers &trade; would be delighted to be of your assistance in planning and executing all your city sightseeing experiences in India.</p>
      <p>We are passionate about travel and would love to discuss it with you!</p>
      <p>Please contact us via email or call with your India specific requirements and let our team help transform ordinary trips into extraordinary experiences;</p>
      <p><strong>Phone number: </strong> +91 729 197 2715 / +91 989 969 2790 / +91 729 197 2713</p>
      <p class="mb-5">For enquiries, please send us an e-mail on <a href="mailto:share@cityexplorers.in" target="_blank" class="text-secondary">share@cityexplorers.in</a></p>
    
          <p><strong>Your Feedback</strong> </p>
          <p>We would love to hear your thoughts on our new website.Contact us <a href="mailto:help@cityexplorers.in" target="_blank" class="text-secondary">help@cityexplorers.in</a> with feedback you'd care to share. </p>

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
