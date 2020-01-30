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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/copyright/banner.jpg')?>);">
    <div class="container">
      <!--<div class="simpleBanner-text">
        <h2>Copyright</h2>
      </div>-->
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>Constantly creating and innovating products by monitoring social impacts, introducing initiatives which remains viable over an indefinite period for residents and travellers</h3>
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
