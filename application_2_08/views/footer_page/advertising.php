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
  <div class="simpleBanner mb-5" style="background-image:url(<?= base_url('assets/img/banners/static/advertise/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>Advertise <span>with Us</span></h2>
      </div>
    </div>
  </div>
  <div class="staticPage">
    <div class="container">
      <h3>We bring social and economic impacts on local community aND theiR perception towards the tourism development in the neighbourhood</h3>
      <p>No matter what industry or what size your organisation, we can develop engagement for your business - by creating your primary and secondary elements and portraying them across the range of products. Contact us and give us the opportunity to demonstrate our level of service, expertise and awareness solutions for whatever requirements you may have. For enquiries, please send us an e-mail on <a href="mailto:share@cityexplorers.in" target="_blank" class="text-dark">share@cityexplorers.in</a></p>
      <p>Advertise your products on www.cityexplorers.in and get in front of a targeted, web savvy audience, purchasing discounted airfare products and low hotel rates. </p>
      <p>We have availability throughout our main site and in our micros-sites. We will be launching customized travel landing pages and also offer exclusive space within our newsletter that goes out to our rapidly growing database on monthly basis.</p>
      <p>All of our advertising products have been developed to help your offering stand out from the crowd; we do this by increasing your visibility to a highly targeted and receptive user-base.</p>
    </div>
    <div class="lightBg pt-5 pb-5 mt-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-sm-8">
            <h4>Our advertising options:</h4>
            <ul class="pb-4">
              <li>Feature a business</li>
              <li>Feature offers</li>
              <li>Banner Advertising</li>
              <li>Customised advertising packages for all budgets</li>
              <li>Site wide banner placement</li>
              <li>Newsletter placement</li>
              <li>Tools Listing</li>
              <li>Dedicated Email Blast</li>
              <li>Youtube Sponsorship</li>
              <li>Email co-registration</li>
              <li>Ebook Sponsorship</li>
              <li>Live Project Sponsorship</li>
              <li>Mobile App Sponsorship</li>
            </ul>
            <h4>TERMS:</h4>
            <ul class="pb-4">
              <li>Two-month minimum on all ads. </li>
              <li>All advertisements must be paid in advance. </li>
              <li>All ad rates are offered on per month basis with discounts for bookings of six months or more paid in advance.</li>
            </ul>
          </div>
          <div class="col-12 col-sm-4">
            <div class="mailMsg mt-3">
              <div id="alert"></div>
              <form id="advertiseForm" novalidate>
                <ul>
                  <li>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required autocomplete="off">
                  </li>
                  <li>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required autocomplete="off">
                  </li>
                  <li>
                    <input type="number" class="form-control" id="mobile" name="mobile" placeholder="Your Phone" required autocomplete="off">
                  </li>
                  <li>
                    <textarea class="form-control" id="message" name="message" placeholder="Write your message" required></textarea>
                  </li>
                  <li class="pt-3 text-right">
                    <button class="btn btn-primary sendQuery" type="submit">Submit</button>
                  </li>
                </ul>
              </form>
            </div>
          </div>
        </div>
        <p>To discuss your advertising needs at India With Locals&trade; please contact <a href="mailto:share@cityexplorers.in" target="_blank" class="text-secondary">share@cityexplorers.in</a></p>

      </div>
    </div>
  </div>
</main>
<?php include('footer.php');?>
<?php include('leave_msg.php');?>
<?php include('foot.php')?>

<script type="text/javascript">

$(document).ready(function(){

function advertiseQueryForm(){
var formData = $('#advertiseForm').serialize();
	var proceed = true;
	$('.sendQuery').html('Sending');
	if(proceed){
		$.ajax({
			type:'post',
			url:'<?php echo base_url()?>Footer/sendAdvertiseForm',
			data:formData,
			success:function(html){
					console.log(html);
					$('.sendQuery').html('Submit Message')
					if(html=='success'){
								$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#advertiseForm')[0].reset();
						}
					else{
						$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#advertiseForm')[0].reset();
						/* $('#alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>Somthing is wrong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>'); */
						}	   
				}
		});
	}
}

$("#advertiseForm").validate({
errorElement: 'small',
	submitHandler: function() {		 
	advertiseQueryForm();
	}
});

})(jQuery);
</script>

</body>
</html>
