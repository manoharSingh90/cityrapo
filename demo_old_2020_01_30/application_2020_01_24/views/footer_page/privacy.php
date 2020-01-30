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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/privacy/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Privacy</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>We rely on both quantitative & qualitative measures of impacts & help our hosts & clients to maintain the adequacy of services, transactions on the platform</h3>
    </div>
    
  </div>
</main>
<?php include('footer.php');?>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>
</body>
</html>
