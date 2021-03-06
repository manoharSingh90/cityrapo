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
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/faq/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text">
        <h2>FAQ’s</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg pt-5 pb-5">
    <div class="container">
      <h3>recognizing issues and taking steps to address them and work with the locals to operate in a sustainable manner</h3>
      <hr class="mt-5 mb-5">
      <div class="row faqData">
        <div class="col-12 col-sm-12 col-md-6">
          <h3>For Host</h3>
          <h4 class="text-normal pl-1"><strong>Know about CEPL</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>What is www.cityexplorers.in?</h4>
                </div>
                <div class="expandBox-body">
                  <p>A travel discovery platform operated by City Explorers Private Limited, to know more please visit <a href="#" class="text-secondary">About Us</a></p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Who are the host?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Our hosts are local ethusiasts who are passionate & knowledgable and know how to make people have a good time in their city.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>What do the host do?</h4>
                </div>
                <div class="expandBox-body">
                  <p>The hosts create and deliver expereinces for other locals and travelers. </p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Become a Host</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Who can be a host?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Anyone who is passionate and loves to make strangers fall in love with their city.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to sign up?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can register using your email and phone number by visiting <a href="#" class="text-secondary">Become a host</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to complete my profile?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Once your registration is accepted, you receive a link & password to complete your profile by providing necessary information.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How do I get approved as a host?</h4>
                </div>
                <div class="expandBox-body">
                  <p>All host approvals are done by CEPL team after carefully reviewing the profile details and the host are contacted for verification.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Create & Manage Itinerary</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>What is an itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>An itinerary is a short description & carrier of necessary details which helps traveler in choosing and booking.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to create an itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can create an itinerary by <a href="#" class="text-secondary">logging</a> into your host profile. Learn more about itineary creation <a href="#" class="text-secondary">here</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>what type of itinerary can I create?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can create Heritage Walks, Travel Experiences, MeetUps & Sessions. To know more please write to us: help@cityexplorers.in</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to publish & edit my itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>After submitting or editing an itinerary, it is approved by CEPL team before getting published on the website.<br>
                    You can edit your itinerary by logging into your host profile and going to My Itineraries section.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>who can help me create an itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Please visit <a href="#" class="text-secondary">How to Create</a> link on your host profile. For any further help, write to us at : help@cityexplorers.in</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How will my itinerary get translated in vernacular languages?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Upon creating an itinerary, you can choose to send your itinerary for translation by CEPL team or simply do it yourself.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Client & Delivery</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Who will book my itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Anyone who is interested in your itinerary can book it. Your clients choose by factors such as theme, places covered, delivery language,etc.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to Deliver?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can learn how to deliver and get help to improve your delivery by visiting <a href="#">How to Deliver</a>.  You can also contact us at: help@cityexplorers.in</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to manage my availability?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can choose your availability dates while completing an itinerary creation. Any booking can only be made on your availabilty date & given time slots.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Bookings & Payment</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How will I get to know about any bookings?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You will be notified via email and phone when a new booking is made on your itinerary.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to contact my clients?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You will receive the complete contact details of your clients prior to delivery date.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How will I get paid?</h4>
                </div>
                <div class="expandBox-body">
                  <p>All payments are processed directly in your bank accounts after delivery of an experience, for any assistance contact us at: <a href="#">help@cityexplorers.in</a></p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Can I cancel a booked itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>We suggest to not cancel any bookings closer to delivery date, in case you must cancel please contact us at: help@cityexplorers.in | +91 729 197 2715 Know more <a href="#">here</a></p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Get more bookings</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to promote my itinerary?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Anyone can share the link of your itinerary to promote & recommend it.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to get a client feedback?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can request the clients to leave a feedback <a href="#">here</a>.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Stay Connected!</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to report an issue?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Contact Us at: help@cityexplorers.in | +91 729 197 2715</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to know about rules & policies?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Click <a href="#">here</a></p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>What happens in case of an emergency?</h4>
                </div>
                <div class="expandBox-body">
                  <p>In case of any emergency, CEPL contacts your emergency contact person. You can contact CEPL on: +91 729 197 2715 (Phone & WhatsApp)</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
          <h3>For Clients</h3>
          <h4 class="text-normal pl-1"><strong>Know about CEPL</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>What is www.cityexplorers.in?</h4>
                </div>
                <div class="expandBox-body">
                  <p>A travel discovery platform operated by City Explorers Private Limited, to know more please visit <a href="#" class="text-secondary">About Us</a></p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Why use www.cityexplorers.in?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can search for tours, activities & things to do in various cities of India, and experience India passionate locals. </p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Choose a product</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>what types of products are offered?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can choose from Heritage Walks, Travel Experiences, MeetUps & Sessions. To know more please write to us: help@cityexplorers.in</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to find products?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can use the filters such as city, date, traveler types to find the best products or simply type what you're looking for <a href="#">here</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to know if a product is for me?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Go to View Details page of the particular itinerary to get full information, check inclusions & exclusions and read the FAQs for that itinerary.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to select between similar options?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can select between similar by choosing the type of host you need. We have hosts of various levels expertise. <a href="#">Learn more here</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to check availability of a product?</h4>
                </div>
                <div class="expandBox-body">
                  <p>All non-available products are automatically removed so you will see available options, for any other query please contact us at help@cityexplorers.in</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Can I book accomodation & transportation?</h4>
                </div>
                <div class="expandBox-body">
                  <p>City Explorers does not provide any facility of booking your stay or transportation, but we never shy away from helping you to choose the right options. Feel free to <a href="#">contact us</a> for any help you need.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Your Host</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Who are the hosts?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Our hosts are local ethusiasts who are passionate & knowledgable and know how to make people have a good time in their city.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Social Medial development</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can choose an itinerary but not a host.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>what to expect from my host?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Your host is a trained professional who will lead the experience for you, make you understand the place and culture well and help you to make best use of your time and money.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How to contact my host?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You will receive the contact details with the booking confirmation email or closed to the date of travel.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Book on CEPL</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Who can book on www.cityexplorers.in?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Anyone who is interested in your itinerary can book it. Your clients choose by factors such as theme, places covered, delivery language,etc.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I pay for my booking?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can choose from various <a href="#">payment options</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I request for a special arrangement?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can write your request in the Special Mention box.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I find any offers or discounts?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Subscribe to your <a href="#">Newsletter</a> & Follow us on <a href="#" target="_blank">Facebook</a>, <a href="#" target="_blank">Twitter</a>, <a href="#" target="_blank">YouTube</a>, <a href="#" target="_blank">Instagram</a> to find great offers. </p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Cancellation & Refund</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>When can I cancel my booking?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Please refer to <a href="#">Cancellation Policy</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I cancel my booking?</h4>
                </div>
                <div class="expandBox-body">
                  <p>We suggest to not cancel any bookings closer to delivery date, in case you must cancel please contact us at: help@cityexplorers.in | +91 729 197 2715 Know more <a href="#">here</a></p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Can I choose a different date & time?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can contact us at help@cityexplorers.in to check availability of a different date and slot for your booked itinerary.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How will I get a refund?</h4>
                </div>
                <div class="expandBox-body">
                  <p>When you cancel, your refund balance is transferred directly into your bank account.</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Rate & Review</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Where can I rate my experience?</h4>
                </div>
                <div class="expandBox-body">
                  <p>You can leave a feedback <a href="#">here</a>.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>Where can I file a complaint?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Contact Us at: help@cityexplorers.in | +91 729 197 2715</p>
                </div>
              </div>
            </li>
          </ul>
          <h4 class="text-normal mt-5 pl-1"><strong>Spread the Word!</strong></h4>
          <ul class="mt-4">
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I share something from this website with my friends & family?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Anyone can share the link of an itinerary to promote & recommend it.</p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I receive regular updates?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Subscribe to your <a href="#">Newsletter</a> & Follow us on <a href="#" target="_blank">Facebook</a>, <a href="#" target="_blank">Twitter</a>, <a href="#" target="_blank">YouTube</a>, <a href="#" target="_blank">Instagram</a> to find great offers. </p>
                </div>
              </div>
            </li>
            <li>
              <div class="expandBox">
                <div class="expandBox-head">
                  <h4>How can I get help on something not covered here?</h4>
                </div>
                <div class="expandBox-body">
                  <p>Contact Us at: help@cityexplorers.in | +91 729 197 2715</p>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
      <hr class="mt-4 mb-4">
      <div class="pt-2 pb-5 row justify-content-center">
      <div class="col-12 col-md-8">
        <h3 class="text-center text-normal mb-1">Send Your Question!</h3>
        <p class="text-center small">Aenean eu leo quam pellentesque ornare sem lacinia </p>
        <div id="alert"></div>
        <form id="faqForm">
          <div class="row pt-3 justify-content-center">
            <div class="col-12 col-sm-6 pb-4">
              <input type="text" class="form-control" id="name" name="name"  placeholder="Your Name" required autocomplete="off"/>
            </div>
            <div class="col-12 col-sm-6 pb-4">
              <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required autocomplete="off"/>
            </div>
            <div class="col-12 pb-4">
              <textarea class="form-control" id="message" name="message" placeholder="Write your question here" required></textarea>
            </div>
            <div class="col-12 pt-2 text-center">
              <button class="btn btn-secondary sendQuery" type="submit">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div></div>
  </div>
</main>
<?php include('footer.php');?>
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<?php include('foot.php');?>

<script type="text/javascript">

$(document).ready(function(){

function faqQueryForm(){
var formData = $('#faqForm').serialize();
	var proceed = true;
	$('.sendQuery').html('Sending');
	if(proceed){
		$.ajax({
			type:'post',
			url:'<?php echo base_url()?>Footer/sendFaqForm',
			data:formData,
			success:function(html){
					console.log(html);
					$('.sendQuery').html('Submit Message')
					if(html=='success'){
								$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#faqForm')[0].reset();
						}
					else{
						$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#faqForm')[0].reset();
						/* $('#alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>Somthing is wrong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>'); */
						}	   
				}
		});
	}
}

$("#faqForm").validate({
    errorElement: 'small',
      submitHandler: function() {		 
      faqQueryForm();
      }
});

// TOGGLE
$(document).on('click', '.expandBox-head', function(e) {
    e.preventDefault();
			var $toggleBox = $(this).closest('.expandBox');
			var $toggleBody = $toggleBox.find('.expandBox-body');
			$(this).toggleClass('active');
			$toggleBody.slideToggle();
});


});
</script>

</body>
</html>

