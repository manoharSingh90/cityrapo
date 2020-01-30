<?php include('head.php');?>
<?php include('header.php');?>
<main>
  <div class="legalPage">
    <div class="container">
      <h2 class="pageTilte">Cancellations/no-shows and amendments to bookings</h2>
    </div>
    <div>
      <div class="container-fluid">
        <ul class="nav justify-content-center nav-tabs iwlTab" role="tablist">
          <li class="nav-item"> <a class="nav-link text-uppercase" href="policies" >Privacy Policy</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase active" href="cancellation" >Cancellation Policy</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" href="terms_and_conditions" >Terms & Conditions</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" href="legal" >Legal</a> </li>
        </ul>
      </div>
      <div class="container">
        <div class="tab-content iwlTab-content">
          <div class="tab-pane fade show active">
            <h2>Cancellations by the traveller</h2>
            <?php include('cancellation/cancellation.php');?>
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
