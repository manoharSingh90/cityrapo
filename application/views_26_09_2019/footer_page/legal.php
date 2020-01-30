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
  <div class="legalPage">
    <div class="container">
      <h2 class="pageTilte">Legal</h2>
    </div>
    <div>
      <div class="container-fluid">
        <ul class="nav justify-content-center nav-tabs iwlTab" role="tablist">
          <li class="nav-item"> <a class="nav-link text-uppercase" href="policies" >Privacy Policy</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" href="cancellation" >Cancellation Policy</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" href="terms_and_conditions" >Terms & Conditions</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase active" href="legal" >Legal</a> </li>
        </ul>
      </div>
      <div class="container">
        <div class="tab-content iwlTab-content">
          <div class="tab-pane fade show active">
            <?php include('legal/legal.php');?>
          </div>
        </div>
      </div>
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
