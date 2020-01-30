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
	$min_date = date('Y-m-d');
	?>
<main>

<div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/pledge/banner.jpg')?>);">

  </div>
  
  <div class="staticPage lightBg">
    <div class="container">    	
    <div class="headingStatic border-0 pb-4">
    	<div id="alert"></div>
        <h3>Take a Pledge</h3>
        <p class="font-weight-semibold pt-3">Choose the language to take pledge / प्रतिज्ञा लेने के लिए भाषा चुनें</p>
        <div class="pt-4 text-center">
          <div class="custom-control custom-radio d-inline-block mr-2">
            <input type="radio" class="custom-control-input languageSelect" checked="checked" id="englishRadio" name="language" value="english">
            <label class="custom-control-label pt-1" for="englishRadio">English</label>
          </div>
          <div class="custom-control custom-radio d-inline-block ml-2">
            <input type="radio" class="custom-control-input languageSelect" id="hindiRadio"  name="language" value="hindi">
            <label class="custom-control-label pt-1" for="hindiRadio">Hindi</label>
          </div>          
        </div>
      </div>
    <p class="text-dark font-regular pb-1 pt-4">Prime Minister Shri Narendra Modi exhorted people to fulfill Mahatma Gandhi's vision of Clean India. The 'Swachh Bharat Abhiyan' is a massive mass movement that seeks to create a Clean India. Cleanliness was very close to Mahatma Gandhi's heart. A clean India is the best tribute we can pay to Bapu when we celebrate his 150th birth anniversary in 2019. Mahatma Gandhi devoted his life so that India attains 'Swarajya'. Now the time has come to devote ourselves towards 'Swachchhata' (cleanliness) of our motherland.</p>
      <p class="text-dark font-regular pb-4 pt-1">प्रधानमंत्री श्री नरेंद्र मोदी ने महात्मा गांधी के स्वच्छ भारत के सपने को पूरा करने के लिए लोगों को प्रेरित किया। 'स्वच्छ भारत अभियान' एक व्यापक जन आंदोलन है जो स्वच्छ भारत बनाने का प्रयास करता है। स्वच्छता महात्मा गांधी के दिल के बहुत करीब थी। एक स्वच्छ भारत सबसे अच्छी श्रद्धांजलि है जिसे हम बापू को 2019 में उनकी 150 वीं जयंती के रूप में मना सकते हैं। महात्मा गांधी ने अपना जीवन समर्पित किया ताकि भारत को 'स्वराज्य' प्राप्त हो। अब समय आ गया है कि हम अपनी मातृभूमि की स्वच्छता के प्रति समर्पित हों। </p>
        <div class="pt-2 pb-5">
        <div class="pledgeBar">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>Swachh Pledge (English)</h2>
          </div>
          <div class="pledgeBar-body bg-white">
            <ul>
              <li>Mahatma Gandhi dreamt of an India which was not only free but also clean and developed.</li>
              <li>Mahatma Gandhi secured freedom for Mother India.</li>
              <li>Now it is our duty to serve Mother India by keeping the country neat and clean.</li>
              <li>I take this pledge that I will remain committed towards cleanliness and devote time for this.</li>
              <li>I will devote 100 hours per year, that is two hours per week, to voluntarily work for cleanliness.</li>
              <li>I will neither litter not let others litter.</li>
              <li>I will initiate the quest for cleanliness with myself, my family, my locality, my village and my work place.</li>
              <li>I believe that the countries of the world that appear clean are so because their citizens don't indulge in littering nor do they allow it to happen.</li>
              <li>With this firm belief, I will propagate the message of Swachh Bharat Mission in villages and towns.</li>
              <li>I will encourage 100 other persons to take this pledge which I am taking today.</li>
              <li>I will endeavour to make them devote their 100 hours for cleanliness.</li>
              <li>I am confident that every step I take towards cleanliness will help in making my country clean.</li>
            </ul>
          </div>
        </div>
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>स्वच्छ प्रतिज्ञा (हिंदी) </h2>
          </div>
          <div class="pledgeBar-body text-center bg-white">
           <img src="assets/img/pledge/swachh_inhindi.jpg" alt="pledge"/>
          </div>
        </div>
        
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>Safe & Honourable Tourism & Sustainable Tourism Pledge (English)</h2>
          </div>
          <div class="pledgeBar-body text-center bg-white">
           <img src="assets/img/pledge/tourism_inenglish.jpg" alt="pledge"/>
          </div>
        </div>
        
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_icon.png')?>" alt="pledge_icon"/>
            <h2>सुरक्षित और माननीय पर्यटन और स्थायी पर्यटन प्रतिज्ञा (हिंदी)</h2>
          </div>
          <div class="pledgeBar-body text-center bg-white">
           <img src="assets/img/pledge/tourism_inhindi.jpg" alt="pledge"/>
          </div>
        </div>
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_01_icon.png')?>" alt="pledge_icon"/>
            <h2>Pledge to Segregate </h2>
          </div>
          <div class="pledgeBar-body bg-white">
           <p>I pledge to segregate my (household, shop, establishment) waste in two dustbins, wet waste in Green and dry waste in Blue, as my contribution to the Swachh Bharat Mission.</p>
          </div>
        </div>
 
        
        <div class="pledgeBar mt-4">
          <div class="pledgeBar-head"><img src="<?= base_url('assets/img/icon/pledge_01_icon.png')?>" alt="pledge_icon"/>
          <h2>अलग करने की प्रतिज्ञा (हिंदी)</h2>
          </div>
          <div class="pledgeBar-body bg-white">
          <p>मैं स्वच्छ भारत मिशन में अपने योगदान के रूप में, दो डस्टबिन में अपशिष्ट, ग्रीन में गीला कचरा और ब्लू में सूखे कचरे को अलग करने की प्रतिज्ञा करता हूं।</p>
          </div>
        </div>

      </div>

      <div class="p-5 pt-4 bg-white mb-4">
        <form id="pledgeForm" >
          <h3 class="text-uppercase font-weight-semibold mb-4">Please fill your details / कृपया अपना विवरण भरें</h3>
          <div class="row pt-2">
            <div class="col-12 col-sm-6">
              <div class="form-group mb-4">
                <label>Name / नाम</label>
                <input type="text" class="form-control" name="pledge_name" placeholder="Name / नाम" required/>
                <small id="pledge_name-error" class="error"></small>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group mb-4">
                <label>Phone Number / फ़ोन नंबर</label>
                <input type="number" class="form-control" name="pledge_phone" placeholder="Phone Number / फ़ोन नंबर" required />
                <small id="pledge_phone-error" class="error"></small>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group mb-4">
                <label>Email Address / ईमेल</label>
                <input type="email" class="form-control" name="pledge_email" placeholder="Email Address / ईमेल" required />
                <small id="pledge_email-error" class="error"></small>
              </div>
            </div>
            <div class="col-12 col-sm-6">
              <div class="form-group mb-4">
                <label>Date / दिनांक</label>
                <input type="date" class="form-control" name="pledge_date" id="dateId" min="<?= $min_date ?>" placeholder="Date / दिनांक" required />
                <small id="pledge_date-error" class="error"></small>
              </div>
            </div>
            <div class="col-12 pt-3">
              <button type="submit" class="btn btn-secondary btn-lg pledgeSubmit">Submit / सबमिट करे</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>
<?php include('footer.php');?>

<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>

<!-- SCRIPT --> 
<?php include('foot.php');?>
<script type="text/javascript">
(function($) {
 
// TOGGLE
$(document).on('click', '.pledgeBar-head', function(e) {
    e.preventDefault();
			var $toggleBox = $(this).closest('.pledgeBar');
			var $toggleBody = $toggleBox.find('.pledgeBar-body');
			$(this).toggleClass('active');
			$toggleBody.slideToggle();
});


$('#pledgeForm').validate({
        errorElement: 'small',
        submitHandler: function() {       
          var formData = $('#pledgeForm').serialize();
          var lang = $('.languageSelect:checked').val();	
          var selectLang={language:lang};
          var proceed = true;
          if(proceed){
            $.ajax({
               type:'post',
               url:'<?php echo base_url()?>Footer/pledgeFormSubmit',               
               data:formData+'&'+$.param(selectLang),
               success:function(html){
	               	console.log(html);				
					if(html=='success'){
						$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#pledgeForm')[0].reset();
						}
					else{
						$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#pledgeForm')[0].reset();
	               }
               		$("html, body").animate({ scrollTop: 20 }, "slow");            
        		}
  			});
          }
        }
    })

/*
$(document).on('click','.pledgeSubmit',function(){
	//alert('tttttttt');
	$('.error').text('');
	var lang = $('.languageSelect:checked').val();	

	//alert(lang);
	if(lang=='undefined') {
		$('#pledge_language-error').text('Select language');
		$("html, body").animate({ scrollTop: 20 }, "slow");
  		return false;
	}
	if($('input[name="pledge_name"]').val()=='') {
		$('#pledge_name-error').text('This field is required.');
		$(this).focus();
		return false;
	}
	if($('input[name="pledge_phone"]').val()=='') {
		$('#pledge_phone-error').text('This field is required.');
		$(this).focus();
		return false;
	}
	if($('input[name="pledge_phone"]').val()!='') {
		var mk_phone=$('input[name="pledge_phone"]').val();
		var mk_paten=/^\d{10}$/;
			if(mk_paten.test(mk_phone)==false) {				
				$('#pledge_phone-error').text('Invalid mobile number');
				$(this).focus();
				return false;
			}		
	}
	if($('input[name="pledge_email"]').val()=='') {
		$('#pledge_email-error').text('This field is required.');
		$(this).focus();
		return false;
	}
	if($('input[name="pledge_email"]').val()!='') {
		var mk_email = $('input[name="pledge_email"]').val();		
		var mk_email_exp=/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
		if(mk_email_exp.test(mk_email)==false) {
			$('#pledge_email-error').text('Invalid Email.');
			$(this).focus();
			return false;
		}	
	}
	if($('input[name="pledge_date"]').val()=='') 
	{
		$('#pledge_date-error').text('This field is required.');
		$(this).focus();
		return false;

	}
})*/
   

})(jQuery);
</script>
</body>
</html>
