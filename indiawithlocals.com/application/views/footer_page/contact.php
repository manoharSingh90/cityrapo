<?php include('head.php');?>
  <!-- HEADER START-->
<?php include('header.php');?>
<!--  HEADER END -->
<main>
  <div class="staticPage lightRed">
    <div class="container">
      <div class="row no-gutters justify-content-center"><span class="titleImg float-left"> <img src="assets/img/staticpages/01.jpg" alt="Contact Us" /></span>
        <div class="col-12 col-sm-11 col-md-9">
          <h2 class="float-left">Contact Us</h2>
          <div class="clearfix"></div>
          <p  class="mt-3">We at India With Local&trade; would be delighted to be of your assistance in planning and executing all your city sightseeing experiences in India.</p>
          <p>We are passionate about travel and would love to discuss it with you!</p>
          <p>Please contact us via email or call with your India specific requirements and let our team help transform ordinary trips into extraordinary experiences;</p>
          <p class="mb-0"><strong class="pr-2">Phone number: </strong> +91 729 197 2715 / +91 989 969 2790 / +91 729 197 2713</p>
          <p><strong class="pr-2">Email:</strong> <a href="mailto:ask@iwl.help">ask@iwl.help</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- FOOTER START-->
<?php include('footer.php');?>
<!-- FOOTER END-->
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>
<!-- SCRIPT --> 
<!-- foot start-->
<?php include('foot.php');?>
<!-- foot end -->
<script type="text/javascript">
var center = new google.maps.LatLng(28.5681057, 77.2340717);

function initialize() {
	
    var mapOption = {
        center: center,
        zoom: 16,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapVar = new google.maps.Map(document.getElementById("officeMap"), mapOption);

	var markerPointer = new google.maps.Marker({
		position: center,
    });

	markerPointer.setMap(mapVar);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script>
</body>
</html>
