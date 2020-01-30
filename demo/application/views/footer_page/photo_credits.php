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
<div class="staticPage lightBlue">
<div class="container">
  <div class="row no-gutters justify-content-center">
    <div class="col-12 col-sm-11 col-md-9"> <span class="titleImg float-left"> <img src="assets/img/staticpages/05.jpg" alt="Photo Credit" /></span>
        <h2 class="float-left">Photo Credits</h2>
        <div class="clearfix"></div>
        <p class="mt-3">Our sincerest gratitude to the photographers who provided images for this website - We Thank You All!</p>
        <p>It is our policy to credit all photographers who request to be credited with a caption directly above or below the image whenever possible.</p>
        <p>Whenever page design considerations make it impractical to credit the photo source above or below the photo, we can give a link on request that will reads “Artistic Photo Credits” at the bottom of the page.</p>
        <p>Images that do not have a caption or are not credited at the bottom of the page may be either from Tourism Boards, Tour Operators, Public Domain, my /our personal images, of unknown origin, or from a photographer who does not wish to be credited.</p>
        <h3>Changes to the Photo Credit Policy</h3>
        <p>This Photo Credit Policy is subject to change at any time, without notice. For the latest version write email on <a href="mailto:ask@iwl.help" target="_blank">ask@iwl.help</a></p>
      </div>
    </div>
  </div>
</div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>
<!-- SCRIPT --> 

<!-- SCRIPT --> 
<<?php include('foot.php');?>

</body>
</html>
