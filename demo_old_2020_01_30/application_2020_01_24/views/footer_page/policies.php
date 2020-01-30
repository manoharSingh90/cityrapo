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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/policies/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Policies</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>The impacts arise when services offered brings about changes in value systems and behaviour and thereby threatens local identity and brand image. Our policies ae supportive force for peace and help avoid conflicts</h3>
    </div>
    
  </div>
</main>
<?php include('footer.php');?>

<?php include('leave_msg.php')?>
<!-- SCRIPT --> 
<?php include('foot.php');?>
<script type="text/javascript">
(function($) {

// TOGGLE DATA
$(document).on('click','.toggleText', function(e){
	e.preventDefault();
	$(this).toggleClass('active').next('.textFold').slideToggle();
});
	
})(jQuery);
</script>
</body>
</html>
