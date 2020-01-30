<?php include('head.php');?>
<?php include('header.php');?>
<main>
  <div class="simpleBanner" style="background-image:url(<?= base_url('assets/img/banners/static/feedback/banner.jpg')?>);">
    <div class="container">
      <div class="simpleBanner-text text-dark">
        <h2>Feedback</h2>
      </div>
    </div>
  </div>
  <div class="staticPage lightBg ">
    <div class="container">
      <div class="headingStatic pb-4">
        <h3>We’re committed to providing a high-quality service to all our customers & actively solicit feedback - whether good or bad </h3>
      </div>
      <p class="pt-4 text-dbl">At <span class="text-dark font-weight-semibold">CITY EXPLORERS</span> it’s our policy to treat all our customers with respect and to act with integrity, so we want to know when something goes wrong so we can improve our standards.</p>
      <p class="pt-2 text-dbl">Kindly give us feedback regarding your experience.</p>
    </div>
  </div>
  <div class="pt-4 pb-5 lightBg">
    <div class="container">
      <form id="feedbackForm">
        <fieldset>
          <legend>Personal Information</legend>
          <small class="noteText">Mandatory fields are marked with(*)</small>
          <div class="form-row">
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-name" class="m-0">Name*:</label>
              <input type="text" class="form-control" id="fd-name" name="name" required autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-dob" class="m-0">Gender*:</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline1" name="gender" value="Female" class="custom-control-input" required>
                <label class="custom-control-label pt-1" for="customRadioInline1">Female</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="customRadioInline2" name="gender" value="Male" class="custom-control-input" required>
                <label class="custom-control-label pt-1" for="customRadioInline2">Male</label>
              </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-dob" class="m-0">Date of Birth*:</label>
              <input type="date" class="form-control" id="fd-dob" name="dob" required>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-nationality" class="m-0">Nationality*:</label>
              <input type="text" class="form-control" id="fd-nationality" name="nationality" required autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-state" class="m-0">State/Region:</label>
              <input type="text" class="form-control" id="fd-state" name="state" autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-address" class="m-0">Address:</label>
              <input type="text" class="form-control" id="fd-address" name="address" autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-pincode" class="m-0">Pin code:</label>
              <input type="text" class="form-control" id="fd-pincode" name="pincode" autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-marital" class="m-0">Marital Status:</label>
              <input type="text" class="form-control" id="fd-marital" name="marital_status" autocomplete="off">
            </div>
          </div>
        </fieldset>
        <fieldset class="mt-5">
          <legend>Details of Service Taken</legend>
          <div class="form-row">
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-experience" class="m-0">Name of the Experience*:</label>
              <input type="text" class="form-control" id="fd-experience" name="experience" required autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-city" class="m-0">Name of the City*:</label>
              <input type="text" class="form-control" id="fd-city" name="city" required autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-host" class="m-0">Host Name*:</label>
              <input type="text" class="form-control" id="fd-host" name="hostname" required autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-dexperience" class="m-0">Date of the Experience*:</label>
              <input type="date" class="form-control" id="fd-dexperience" name="date_of_experience" required autocomplete="off">
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-likemost" class="m-0">What did you enjoy/like the most?*:</label>
              <textarea class="form-control" id="fd-likemost" name="enjoy_most" required></textarea>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-likenot" class="m-0">Any dislikes/Reasons for not enjoying?*:</label>
              <textarea class="form-control" id="fd-likenot" name="enjoy_reason" required></textarea>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-suggestion" class="m-0">Your Suggestion(if any):</label>
              <textarea class="form-control" id="fd-suggestion" name="suggestion"></textarea>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-testimonial" class="m-0">Your Testimonial for Other Travelers to read*:</label>
              <textarea class="form-control" id="fd-testimonial" name="testimonial" required></textarea>
            </div>
          </div>
        </fieldset>
        <fieldset class="mt-5">
          <legend>Rate Your Experience <small>Please rate from (Excellent, Good, Satisfactory, Poor, Unacceptable)</small></legend>
          <div class="form-row">
            <div class="col-12">
              <div class=" mt-3 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Name of the Experience:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio1" name="experience_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="customRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio2" name="experience_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="customRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio3" name="experience_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="customRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio4" name="experience_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="customRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="customRadio5" name="experience_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="customRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Information provided on the website:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="informationRadio1" name="information_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="informationRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="informationRadio2" name="information_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="informationRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="informationRadio3" name="information_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="informationRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="informationRadio4" name="information_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="informationRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="informationRadio5" name="information_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label  pt-1" for="informationRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Range of Offerings in experiences:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="offeringRadio1" name="offering_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="offeringRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="offeringRadio2" name="offering_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="offeringRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="offeringRadio3" name="offering_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="offeringRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="offeringRadio4" name="offering_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="offeringRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="offeringRadio5" name="offering_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="offeringRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Booking Process & Experience Coordination:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="coordinationRadio1" name="coordination_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="coordinationRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="coordinationRadio2" name="coordination_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="coordinationRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="coordinationRadio3" name="coordination_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="coordinationRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="coordinationRadio4" name="coordination_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="coordinationRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="coordinationRadio5" name="coordination_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="coordinationRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Information Shared about the Experience:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="infoRadio1" name="info_exp_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="infoRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="infoRadio2" name="info_exp_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="infoRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="infoRadio3" name="info_exp_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="infoRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="infoRadio4" name="info_exp_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="infoRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="infoRadio5" name="info_exp_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="infoRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Host's Communication, Attitude & Customization:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="hostRadio1" name="host_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="hostRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="hostRadio2" name="host_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="hostRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="hostRadio3" name="host_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="hostRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="hostRadio4" name="host_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="hostRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="hostRadio5" name="host_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="hostRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">Value for money:</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="moneyRadio1" name="money_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="moneyRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="moneyRadio2" name="money_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="moneyRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="moneyRadio3" name="money_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="moneyRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="moneyRadio4" name="money_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="moneyRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="moneyRadio5" name="money_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="moneyRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">How would you rate our impact on Local Culture & People?</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="rateRadio1" name="rate_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="rateRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="rateRadio2" name="rate_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="rateRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="rateRadio3" name="rate_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="rateRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="rateRadio4" name="rate_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="rateRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="rateRadio5" name="rate_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="rateRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12">
              <div class="border-top mt-4 pb-4 w-100"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-12 col-md-3">
              <label class="m-0">How do you see our contribution to Responsible Tourism & Eco-friendliness?</label>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="responsibleRadio1" name="responsible_radio" value="Excellent" class="custom-control-input">
                <label class="custom-control-label pt-1" for="responsibleRadio1">Excellent</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="responsibleRadio2" name="responsible_radio" value="Good" class="custom-control-input">
                <label class="custom-control-label pt-1" for="responsibleRadio2">Good</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="responsibleRadio3" name="responsible_radio" value="Satisfactory" class="custom-control-input">
                <label class="custom-control-label pt-1" for="responsibleRadio3">Satisfactory</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="responsibleRadio4" name="responsible_radio" value="Poor" class="custom-control-input">
                <label class="custom-control-label pt-1" for="responsibleRadio4">Poor</label>
              </div>
            </div>
            <div class="col-12 col-md-auto">
              <div class="custom-control custom-radio">
                <input type="radio" id="responsibleRadio5" name="responsible_radio" value="Unacceptable" class="custom-control-input">
                <label class="custom-control-label pt-1" for="responsibleRadio5">Unacceptable</label>
              </div>
            </div>
          </div>
        </fieldset>
        <div class="staticPage">
          <h3 class="pt-5 pb-3 text-center text-normal font-weight-normal">Thank you for choosing <strong>City Explorers Private Limited</strong></h3>
          <div class="form-row pt-3">
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-hear" class="m-0">Where did you hear about us?</label>
              <textarea class="form-control bg-white" id="fd-hear" name="hear_about_us"></textarea>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-services" class="m-0">Where would like us to extend our services?</label>
              <textarea class="form-control bg-white" id="fd-services" name="extend_services"></textarea>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-dob" class="m-0">Would you recommend us?</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="recommendYes" name="recommend_radio" value="Yes" class="custom-control-input">
                <label class="custom-control-label pt-1" for="recommendYes">Yes</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="recommendNo" name="recommend_radio" value="No" class="custom-control-input">
                <label class="custom-control-label pt-1" for="recommendNo">No</label>
              </div>
            </div>
            <div class="col-12 col-md-6 mb-4">
              <label for="fd-dob" class="m-0">Subscribe to our newsletter?</label>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="newsletterYes" name="newsletter_radio" value="Yes" class="custom-control-input" >
                <label class="custom-control-label pt-1" for="newsletterYes">Yes</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="newsletterNo" name="newsletter_radio" value="No" class="custom-control-input">
                <label class="custom-control-label pt-1" for="newsletterNo">No</label>
              </div>
            </div>
          </div>
        </div>
        <div class="pt-4 pb-4 text-center">
          <button type="submit" class="btn btn-lg btn-primary sendQuery">Submit</button>
        </div>
      </form>
    </div>
  </div>
</main>
<?php include('footer.php');?>


<!-- SCRIPT --> 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script> 
<script type="text/javascript" src="assets/dependencies/popper/popper.min.js"></script> 
<script type="text/javascript" src="assets/dependencies/bootstrap-4.1.2/dist/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/dependencies/jquery-validation-master/dist/jquery.validate.min.js"></script> 

<script type="text/javascript" src="assets/js/global_function.js"></script>


<script type="text/javascript">

$(document).ready(function(){

function feedbackQueryForm(){
var formData = $('#feedbackForm').serialize();
	var proceed = true;
	$('.sendQuery').html('Sending');
	if(proceed){
		$.ajax({
			type:'post',
			url:'<?php echo base_url()?>Footer/sendFeedbackForm',
			data:formData,
			success:function(html){
					console.log(html);
					$('.sendQuery').html('Submit Message')
					if(html=='success'){
								$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#feedbackForm')[0].reset();
						}
					else{
						$('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong>Your message has been send successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
						$('#feedbackForm')[0].reset();
						/* $('#alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong>Somthing is wrong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>'); */
						}	   
				}
		});
	}
}

$("#feedbackForm").validate({
errorElement: 'small',
errorPlacement: function(error, element) {
                error.appendTo(element.closest(".col-12"));
            },
	submitHandler: function() {		 
	feedbackQueryForm();
	}
});

});
</script>

</body>
</html>
