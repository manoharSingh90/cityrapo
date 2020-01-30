<?php include('head.php');?>
<?php include('header.php');?>

<main>
  <div class="legalPage">
    <div class="container">
      <h2 class="pageTilte">Terms and Conditions</h2>
    </div>
    <div class="clearfix">
      <div class="container-fluid">
        <ul class="nav justify-content-center nav-tabs iwlTab" role="tablist">
          <li class="nav-item"> <a class="nav-link text-uppercase" href="policies" >Privacy Policy</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" href="cancellation" >Cancellation Policy</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase active" href="terms_and_conditions" >Terms & Conditions</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" href="legal" >Legal</a> </li>
        </ul>
      </div>
      <div class="container">
        <div class="tab-content iwlTab-content">
          <div class="tab-pane fade show active">
            <?php include('terms&conditions/terms&condition.php');?>
			  <img class="pt-3 pb-3" src="assets/img/advt/ad_v1.jpg" alt="#"/>
            <small>City Walks Festival - Madhya Pradesh | Curated by India City Walks™  and India with Locals™ for Madhya Pradesh Tourism Board</small> </div>
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
