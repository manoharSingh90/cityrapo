<?php 
	require_once('header.php');
	$uri = $this->uri->segment(2);
	$ses = $this->session->userdata('adminSes');
	?>

<div class="profilePage">
  <div class="profilePage-head clearfix">
    <h1 class="cmyLogo float-left"><img src="<?php echo base_url();?>assets/img/iwl_hr_white_logo.svg" alt="India with locals" /></h1>
    <div class="float-right floatBtn"> <a href="#" class="btn btn-link mr-3 text-default" data-toggle="modal" data-target="#rejectModal">cancel</a>
      <!--<input type="button" class="btn btn-secondary" value="Draft" id="formSave"/>-->
       <a id="callDone" href="#" class="btn btn-secondary">Done</a> </div>
  </div>
  <div class="profilePage-body clearfix">
    <div class="profilePage-links" >
      <h3><span><img src="<?php echo base_url();?>assets/img/icon/details.svg" alt="details" /></span>Basic</h3>
      <ul>
        <li class="active"><a href="#fillDetails">Details</a></li>
        <li><a href="#fillHighlight">Highlight &amp; Features</a></li>
        <li><a href="#fillInclusions">Inclusions &amp; Exclusions</a></li>
        <li><a href="#fillFaq">FAQ's</a></li>
        <li><a href="#fillhost">Host & Emergency Details</a></li>
      </ul>
      <h3><span><img src="<?php echo base_url();?>assets/img/icon/plan.svg" alt="plan" /></span>Location &amp; Plan</h3>
      <ul>
        <li><a href="#fillAvailability">Host Availability</a></li>
        <li><a href="#fillRoute">Route & timing</a></li>
        <li><a href="#fillConnectivity">Connectivity & Locations</a></li>
        <li><a href="#fillTraveller">Traveller Sepecifications </a></li>
      </ul>
      <h3><span><img src="<?php echo base_url();?>assets/img/icon/rupee.svg" alt="rupee" /></span>Pricing</h3>
      <ul>
        <li><a href="#fillPrice">Price Chart</a></li>
        <!-- <li><a href="#fillConfirmation">Confirmation & Review</a></li> -->
        <li><a href="#fillCancellations">Cancellations</a></li>
      </ul>
      <h3><span><img src="<?php echo base_url();?>assets/img/icon/media.svg" alt="media" /></span>Media</h3>
      <ul>
        <li><a href="#fillVideo">Video</a></li>
        <li><a href="#fillImage">Image Gallery</a></li>
      </ul>
      <h3><span><img src="<?php echo base_url();?>assets/img/icon/legal.svg" alt="legal" /></span>Legal</h3>
      <ul>
        <li><a href="#fillLegalLiabilities">Liabilities &amp; disclaimers</a></li>
        <li><a href="#fillLegalPrivacy">Privacy policy & T &amp; C</a></li>
        <li><a href="#fillLegalCancellations">Cancellations & More</a></li>
      </ul>
    </div>
    <div class="profilePage-info">
      <form id="formItinerary" method="post" enctype="multipart/form-data" >
        <button class="hidden" type="submit" id="saveForm"></button>
        <button id="doneForm" type="submit" class="btn btn-primary hidden">Submit</button>
        <fieldset id="filldetail">          
          <input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id;?>"/>
          <input type="hidden" name="selLang" id="select_lang" value="<?php echo $selectOtherLang;?>"/>
		  <input type="hidden" name="hostId" id="host_id" value="<?php echo $hostId;?>"/>
         <?php if($selectOtherLang!='English' && $selectOtherLang!='ENGLISH' && $selectOtherLang!='english'){ ?>
		  <div class="alert alert-light text-center sendTo">
          <p class="font-weight-bold pl-3 pr-3 pt-2 pb-2">Would you like to share this itinerary to translator
          <select class="form-control d-inline-block font-weight-bold" name="send_to_translator" data-rule-required="true">
           <option value="0">No, I will do it myself</option>	
           <option value="1">Yes, Send for translation</option>
           </select>
            </p>
          </div>
		 <?php } ?>
          
          <h3 id="fillDetails" class="col-form-label">Details</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select Category</label>
              <select class="form-control" name="category" id="categoryName" required data-rule-required="true">
                <option value="">Select</option>
                <?php foreach($allCategory as $cateList): ?>
                <option value="<?php echo $cateList->id;?>"><?php echo $cateList->category_name;?></option>
                <?php endforeach;?>
              </select>
            </li>
            <?php if($selectOtherLang!='English' && $selectOtherLang!='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Type Category (<?php echo $selectOtherLang;?>)</label>
              <input type="text" class="form-control" id="type_category" name="type_category" required data-rule-required="true"/>
            </li>
            <?php }	?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select My City</label>
              <select class="form-control" name="originCity" id="originCity" required data-rule-required="true">
                <option value="">Select</option>
                <?php  foreach($userCity as $city):
				   $cityArr = explode(',',$city->preferred_cities);
				   foreach($cityArr as $value): ?>                
                <option value="<?php echo $value;?>"> <?php echo $value;?> </option>
                <?php endforeach;endforeach;?>
              </select>
            </li>
            <?php if($selectOtherLang!='English' && $selectOtherLang!='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select My City (<?php echo $selectOtherLang;?>)</label>
              <input type="text" class="form-control" name="origin_otherCity"  id="origin_otherCity" required data-rule-required="true"/>
            </li>
            <?php } ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Itinerary Title</label>
              <input type="text" class="form-control" name="itinerary_title" placeholder="Itinerary Title" id="itinerary_title" required data-rule-required="true"/>
            </li>
            <?php if($selectOtherLang!='English' && $selectOtherLang!='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Itinerary Title (<?php echo $selectOtherLang;?>)</label>
              <input type="text" class="form-control" name="itinerary_other_title"  id="itinerary_other_title" 
			     required data-rule-required="true"/>
            </li>
            <?php } ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Tag Line</label>
              <input type="text" class="form-control" name="itinerary_tagline" placeholder="Tag Line" id="itinerary_tagline"  
			    required data-rule-required="true"/>
            </li>
            <?php if($selectOtherLang!='English' && $selectOtherLang!='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Tag Line (<?php echo $selectOtherLang;?>)</label>
              <input type="text" class="form-control" name="other_tag_line"  id="other_tag_line" required data-rule-required="true"/>
            </li>
            <?php } ?>
            <li class="form-group col-12 col-md-12 placeVaild">
              <label class="col-form-label text-light">Description</label>
              <textarea class="form-control" name="itinerary_description" placeholder="Give details of your service (max 5000 characters)" id="itinerary_description" required data-rule-required="true" data-rule-maxlength="5000"></textarea>
            </li>
            <?php if($selectOtherLang!='English' && $selectOtherLang!='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-12 placeVaild">
              <label class="col-form-label text-light">Description (<?php echo $selectOtherLang;?>)</label>
              <textarea class="form-control" name="other_itinerary_description" placeholder="Give details of your service (max 5000 characters)"  id="other_lang_desc" required data-rule-required="true" data-rule-maxlength="5000"></textarea>
            </li>
            <?php } ?>
            <li class="form-group col-12 col-md-12 placeVaild">
              <label class="col-form-label d-block text-light">Theme</label>
              <label class="col-form-sublabel">Select themes <small>(separate using commas)</small></label>             
			   <select id="typeThemes" name="itinerary_theme[]" class="form-control ignore" placeholder="Select themes" multiple data-rule-required="true">
                  <?php
					foreach($allthemes as $themes):									   
					?>
				<option value="<?php echo $themes->id;?>"><?php echo $themes->theme_name;?></option>
               <?php endforeach;?>
              </select>
            </li>
          </ul>
          <h3 id="fillHighlight" class="col-form-label">Highlights & features</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Highlights <small class="text-default font-italic">(e.g. educational, pet friendly)</small></label>
               <select id="typeHighlights" name="itinerary_highlights[]" class="form-control ignore" placeholder="Type a highlight (separate using commas)" data-rule-required="true" multiple >
                <?php 
					foreach($myInterestData as $key=>$highlight):?>
                <option value="<?php echo $highlight->interest_name;?>"><?php echo $highlight->interest_name;?></option>
				<?php endforeach;?>
              </select>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel d-block mb-3">Features <small class="text-default font-italic">(Select all that apply)</small></label>              
			  <select id="typeFeatures" name="itinerary_features[]" class="form-control ignore" placeholder="Type a highlight (separate using commas)" data-rule-required="true" multiple >
                <?php 
				  foreach($features as $featureVal):				   
				  ?>
                <option value="<?php echo $featureVal->id;?>"><?php echo $featureVal->feature_name;?></option>
               <?php endforeach;?>
              </select>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Search Tags <small>(separate using commas)</small></label>
              <select id="typeSearchTags" type="text" name="itinerary_searchtags[]" class="form-control ignore" placeholder="Search Tags" multiple data-rule-required="true">                
                <option value=""></option>                
              </select>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel d-block">Delivery Type <small>(max. select 2)</small></label>
              <div class="form-row">
                <div class="col-6 col-sm-auto">                  
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <label>
                    <input type="checkbox" id="deliveryType-bus" name="itinerary_delivery[]" value="bus" class="custom-control-input limitSelect ignore" data-rule-required="true"/>
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 31.1 33" style="enable-background:new 0 0 31.1 33;" xml:space="preserve">
                    <path d="M22.6,26.3c-4.8,0-9.6,0.2-14.3,0c-3.5-0.2-2.9-4-2.9-6.4c0-3.4,0-6.7,0-10.1c0-1.9-0.6-5.3,0.9-6.8c0.9-1,2.2-0.9,3.4-0.9
	c1.5,0,2.9,0,4.4,0c2.8,0,5.6-0.1,8.4,0c3.3,0.1,3.1,2.9,3.1,5.3c0,3.7,0,7.4,0,11.1C25.5,21.1,26.4,26.1,22.6,26.3
	c-0.9,0-0.9,1.4,0,1.3c2.4-0.1,4.2-1.9,4.3-4.3c0-0.7,0-1.5,0-2.2c0-3.7,0-7.3,0-11c0-2.2,0.6-5.7-0.8-7.6c-1.8-2.5-5.6-1.8-8.2-1.8
	c-3.1,0-6.3-0.1-9.4,0c-1.8,0-3.4,1-4.1,2.7c-0.5,1-0.4,2-0.4,3c0,3.5,0,7,0,10.5c0,1.6,0,3.2,0,4.8c0,0.8-0.1,1.7,0.1,2.6
	c0.9,4.1,5.6,3.4,8.7,3.4c3.3,0,6.5,0,9.8,0C23.5,27.6,23.5,26.3,22.6,26.3z M4.7,7.1c7.2,0,14.4,0,21.5,0c0.9,0,0.9-1.3,0-1.3
	c-7.2,0-14.4,0-21.5,0C3.8,5.7,3.8,7.1,4.7,7.1L4.7,7.1z M4.8,21.4c7.2,0,14.4,0,21.5,0c0.9,0,0.9-1.3,0-1.3c-7.2,0-14.4,0-21.5,0
	C3.9,20,3.9,21.4,4.8,21.4L4.8,21.4z M13.2,4.6c1.5,0,3.1,0,4.6,0c0.9,0,0.9-1.3,0-1.3c-1.5,0-3.1,0-4.6,0
	C12.4,3.2,12.4,4.6,13.2,4.6L13.2,4.6z M14.8,6.4c0,4.8,0,9.6,0,14.3c0,0.9,1.3,0.9,1.3,0c0-4.8,0-9.6,0-14.3
	C16.1,5.5,14.8,5.5,14.8,6.4L14.8,6.4z M8.2,24.4c0.8,0,1.6,0,2.4,0c0.9,0,0.9-1.3,0-1.3c-0.8,0-1.6,0-2.4,0
	C7.4,23.1,7.4,24.4,8.2,24.4L8.2,24.4z M20.1,24.4c0.8,0,1.6,0,2.4,0c0.9,0,0.9-1.3,0-1.3c-0.8,0-1.6,0-2.4,0
	C19.2,23.1,19.2,24.4,20.1,24.4L20.1,24.4z M4.1,11.4c-0.4,0-1.3,0.2-1.6,0c0.1,0,0,0.2,0.1-0.1c0-0.3,0-0.6,0-0.8
	c0-0.7,0-1.4,0-2.1c0-0.2,0-1.2-0.1-1.2C2.4,7.3,3.1,7.3,3.2,7.3c0.2,0,0.7-0.1,0.9,0C4,7.3,4.1,7.1,4,7.5C4,7.7,4,8,4,8.2
	c0,0.7,0,1.4,0,2.1c0,0.3,0,0.6,0,0.9C4,11.3,4,11.4,4.1,11.4C3.9,11.7,4.1,11.5,4.1,11.4c-0.9,0.3-0.6,1.6,0.3,1.4s1-0.9,1-1.8
	c0-1,0-2,0-2.9c0-0.7,0.1-1.5-0.6-1.9C4.2,5.8,3,5.8,2.3,5.9C1.4,6.1,1.2,6.8,1.2,7.6c0,1,0,1.9,0,2.9c0,0.7-0.1,1.5,0.5,2
	c0.6,0.4,1.7,0.2,2.4,0.2C5,12.8,5,11.4,4.1,11.4z M28.4,11.1c-0.4,0-1.3,0.2-1.6,0c0.1,0,0,0.2,0.1-0.1c0-0.3,0-0.6,0-0.8
	c0-0.7,0-1.4,0-2.1c0-0.2,0-1.2-0.1-1.2C26.6,7,27.3,7,27.4,7c0.2,0,0.7-0.1,0.9,0c-0.1,0,0-0.2-0.1,0.2c0,0.2,0,0.5,0,0.8
	c0,0.7,0,1.4,0,2.1c0,0.3,0,0.6,0,0.9c0,0.1,0,0.2,0,0.3c-0.1,0.2,0.1,0,0,0c-0.8,0.2-0.5,1.5,0.4,1.3s1-0.9,1-1.8c0-1,0-2,0-2.9
	c0-0.7,0.1-1.5-0.6-1.9c-0.6-0.3-1.8-0.3-2.4-0.2c-0.9,0.1-1.1,0.9-1.1,1.7c0,1,0,1.9,0,2.9c0,0.7-0.1,1.5,0.5,2
	c0.6,0.4,1.7,0.2,2.4,0.2C29.3,12.5,29.3,11.1,28.4,11.1z M11.5,30.9c-0.5,0-1-0.1-1.5,0c-0.1,0-0.2,0-0.2,0s0.1,0.2,0.1,0.1
	c0-0.2,0-0.4,0-0.6c0-0.6,0-1.2,0-1.8c0-0.3,0-0.5,0-0.8c0-0.1,0.1-0.4-0.1-0.3c-0.1,0.1,0.4,0.1,0.5,0.1c0.3,0,0.6,0.1,0.9,0
	c0.1,0,0.2,0,0.2,0c-0.1,0-0.1-0.2-0.1,0s0,0.4,0,0.6c0,0.6,0,1.2,0,1.8c0,0.3,0,0.5,0,0.8c0,0.1,0,0.2,0,0.2c-0.1,0.2,0.1,0,0,0
	c-0.9,0.2-0.5,1.5,0.4,1.3c0.9-0.2,1-0.9,1-1.7c0-0.8,0-1.7,0-2.5s-0.1-1.6-1-1.7c-0.6-0.1-1.4-0.1-2,0c-0.9,0.1-1.1,0.8-1.1,1.6
	c0,0.9,0,1.7,0,2.6c0,0.7,0,1.5,0.8,1.7c0.6,0.2,1.5,0.1,2.1,0.1C12.3,32.3,12.3,30.9,11.5,30.9z M21.6,30.9c-0.5,0-1-0.1-1.5,0
	c-0.1,0-0.2,0-0.2,0S20,31.1,20,31c0-0.2,0-0.4,0-0.6c0-0.6,0-1.2,0-1.8c0-0.3,0-0.5,0-0.8c0-0.1,0.1-0.4-0.1-0.3
	c-0.1,0.1,0.4,0.1,0.5,0.1c0.3,0,0.6,0.1,0.9,0c0.1,0,0.2,0,0.2,0c-0.1,0-0.1-0.2-0.1,0s0,0.4,0,0.6c0,0.6,0,1.2,0,1.8
	c0,0.3,0,0.5,0,0.8c0,0.1,0,0.2,0,0.2c-0.1,0.2,0.1,0,0,0c-0.9,0.2-0.5,1.5,0.4,1.3c0.9-0.2,1-0.9,1-1.7c0-0.8,0-1.7,0-2.5
	s-0.1-1.6-1-1.7c-0.6-0.1-1.4-0.1-2,0c-0.9,0.1-1.1,0.8-1.1,1.6c0,0.9,0,1.7,0,2.6c0,0.7,0,1.5,0.8,1.7c0.6,0.2,1.5,0.1,2.1,0.1
	C22.4,32.3,22.4,30.9,21.6,30.9z M9.2,8.1c-1,0.9-1.9,1.8-2.8,2.7c-0.6,0.6,0.3,1.6,1,1c0.9-0.9,1.9-1.8,2.8-2.7
	C10.8,8.4,9.8,7.5,9.2,8.1L9.2,8.1z M10.1,9.4c-0.9,0.9-1.9,1.8-2.8,2.7c-0.6,0.6,0.3,1.6,1,1c0.9-0.9,1.9-1.8,2.8-2.7
	C11.7,9.8,10.8,8.8,10.1,9.4L10.1,9.4z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-bus">Bus/Coach</label>
                    </label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <label>
                    <input type="checkbox" id="deliveryType-auto" name="itinerary_delivery[]" value="auto" class="custom-control-input limitSelect" >
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 42.9 33" style="enable-background:new 0 0 42.9 33;" xml:space="preserve">
                    <path d="M8,2.2c6,0,12.1,0,18.1,0c2.8,0,5.8-0.3,8.4,0.8s4.8,3.4,4.6,6.4C39,10.5,39,11.6,39,12.8c0,1.9,0,3.9,0,5.8
	c0,1.1,0.3,2.6,0,3.7c-0.3,1.3-3.6,0.9-4.6,0.8c-2.1-0.1-1.9-1.6-1.9-3.1c0-3.3-0.1-6.6,0-9.9c0-0.2,0-0.3,0,0c0-0.1,0.1-0.3,0-0.4
	c0-0.6-0.1-1.1-0.4-1.7c-0.9-1.5-2.8-2.1-4.4-2.2c-3.4-0.2-6.9,0-10.3,0c-1.6,0-3.3,0-4.9,0c-0.7,0-1.4,0-2.1-0.2
	C9.4,5.4,8.5,5,7.7,4.3C6.9,3.5,6.3,2.3,8,2.2c1-0.1,1-1.6,0-1.5C5.5,0.9,4.6,3.2,6.4,5c1.6,1.6,3.8,2.1,6,2.1c3.8,0,7.5,0,11.3,0
	c2.2,0,7.4-0.8,7.5,2.5c0,0.4,0,2.1,0,2.9c0,2.2,0,4.3,0,6.5c0,1.2-0.3,2.8,0.4,3.9c1.1,1.9,3.6,1.5,5.4,1.5c1.7,0,3.6-0.2,3.7-2.3
	c0.1-1.5,0-3,0-4.5c0-2,0-4,0-6.1c0-1.5,0.2-3.1-0.2-4.6C39.1,2.5,34.3,0.7,30,0.7c-7.3,0-14.6,0-21.9,0C7.1,0.7,7.1,2.2,8,2.2z
	 M10.1,6.1c-1.8,1.3-3.1,3.3-4,5.3c-2.3,5.4-1.3,11.5,0.7,16.8c0.1,0.3,0.4,0.5,0.7,0.5c8,0,16,0,24.1,0c1,0,1-1.5,0-1.5
	c-8,0-16,0-24.1,0c0.2,0.2,0.5,0.4,0.7,0.5c-1.9-5-2.9-10.8-0.7-15.9C8,10.7,8.8,9.5,9.7,8.5c0.3-0.3,0.6-0.6,0.9-0.9
	c0.2-0.2,0.3-0.3,0.3-0.2C11.6,6.8,10.8,5.5,10.1,6.1L10.1,6.1z M2.9,17.4c-0.4,0.1,0.3,0,0.4,0c0.3,0,0.7,0,1,0.2s0.4,0.4,0.5,0.7
	c0.2,0.5,0-0.2,0,0.1c0,0.1,0,0.1,0,0.2c0,1.3-0.3,2.4-1.9,2.1C3,20.8,3.2,20.9,3.3,21c-0.7-1.2-0.6-2.7,0-3.9
	c0.4-0.9-0.9-1.6-1.3-0.7c-0.6,1.2-0.8,2.4-0.6,3.7c0.1,0.5,0.3,1.4,0.7,1.9c0.6,0.5,1.9,0.3,2.6,0c0.6-0.3,1.1-0.9,1.3-1.6
	c0.4-1,0.5-2.4,0-3.3c-0.7-1.2-2.2-1.3-3.4-1.2C1.6,16.1,2,17.5,2.9,17.4z M13.1,6.9c0,7,0,14.1,0,21.1c0,1,1.5,1,1.5,0
	c0-7,0-14.1,0-21.1C14.6,6,13.1,6,13.1,6.9L13.1,6.9z M5.5,18.9c2.8,0,5.5,0,8.3,0c1,0,1-1.5,0-1.5c-2.8,0-5.5,0-8.3,0
	C4.6,17.5,4.6,18.9,5.5,18.9L5.5,18.9z M6.3,23.1c-1-0.2-2-0.1-2.9,0.3c-1.9,0.8-2.6,2.7-2.7,4.6c0,0.4,0.4,0.7,0.7,0.7
	c2,0,4.1,0,6.1,0c1,0,1-1.5,0-1.5c-2,0-4.1,0-6.1,0c0.2,0.2,0.5,0.5,0.7,0.7c0.1-1.5,0.6-2.9,2.1-3.3c0.4-0.1,0.8-0.1,1.2-0.1
	c0.2,0,0.5,0,0.5,0C6.8,24.7,7.2,23.3,6.3,23.1L6.3,23.1z M2,28c-0.1,2,1.5,4.3,3.7,4.3c2.5,0.1,4.4-1.8,4.2-4.3
	c-0.1-0.9-1.6-0.9-1.5,0c0.2,1.7-0.9,2.9-2.7,2.8c-1.4-0.1-2.2-1.6-2.2-2.8C3.5,27,2,27,2,28L2,28z M35.6,23.1c-1-0.2-2-0.1-2.9,0.3
	c-1.9,0.8-2.6,2.7-2.7,4.6c0,0.4,0.4,0.7,0.7,0.7c2,0,4.1,0,6.1,0c1,0,1-1.5,0-1.5c-2,0-4.1,0-6.1,0c0.2,0.2,0.5,0.5,0.7,0.7
	c0.1-1.5,0.6-2.9,2.1-3.3c0.4-0.1,0.8-0.1,1.2-0.1c0.2,0,0.5,0,0.5,0C36.2,24.7,36.6,23.3,35.6,23.1L35.6,23.1z M36.6,24.6
	c0,0,0.2,0,0.4,0c0.4,0,0.8,0,1.2,0.1c1.5,0.4,2,1.9,2.1,3.3c0.2-0.2,0.5-0.5,0.7-0.7c-2,0-4.1,0-6.1,0c-1,0-1,1.5,0,1.5
	c2,0,4.1,0,6.1,0c0.4,0,0.8-0.3,0.7-0.7c-0.1-1.9-0.8-3.8-2.7-4.6c-0.9-0.4-2-0.5-2.9-0.3C35.3,23.3,35.7,24.7,36.6,24.6L36.6,24.6z
	 M32.4,28c-0.1,2,1.5,4.3,3.7,4.3c2.5,0.1,4.4-1.8,4.2-4.3c-0.1-0.9-1.6-0.9-1.5,0c0.2,1.7-0.9,2.9-2.7,2.8
	c-1.4-0.1-2.2-1.6-2.2-2.8C33.9,27.1,32.4,27.1,32.4,28L32.4,28z M23.5,6.7c0,7.1,0,14.2,0,21.3c0,1,1.5,1,1.5,0
	c0-7.1,0-14.2,0-21.3C25,5.8,23.5,5.8,23.5,6.7L23.5,6.7z M22.9,21.8c-0.9,0-1.7,0-2.6,0c-0.5,0-1,0-1.5,0c-0.7,0-1.9-0.5-0.7-1.2
	c0.6-0.4,2.1-0.1,2.8-0.1c0.5,0,1,0,1.5,0c0.1,0,0.3,0,0.4,0c1,0.2,0.9,1.2-0.1,1.4c-0.9,0.1-0.5,1.6,0.4,1.4c2.7-0.4,2.4-4-0.2-4.3
	c-1.5-0.1-3.2-0.2-4.7,0c-2.7,0.3-2.7,4,0,4.3c1.5,0.2,3.2,0,4.7,0C23.8,23.3,23.8,21.8,22.9,21.8z M22.9,27.3c-1.4,0-2.9,0.1-4.3,0
	c-1-0.1-1-0.7-1-1.6c0-0.7-0.3-2.2,0.4-2.6c0.5-0.3,1.4-0.1,2-0.1c0.8,0,1.7-0.1,2.5,0c1.1,0.1,1,0.8,1,1.7c0,0.9,0.3,2.4-0.9,2.6
	c-0.9,0.1-0.5,1.6,0.4,1.4c1.6-0.2,2-1.5,2-2.9c0-1,0.2-2.5-0.4-3.4c-0.8-1.1-2-0.9-3.2-0.9c-1.1,0-2.2-0.1-3.2,0
	c-1.5,0.2-2,1.3-2.1,2.6c0,1-0.3,2.6,0.4,3.5c0.7,1.1,1.9,1,3,1s2.3,0,3.4,0C23.8,28.7,23.8,27.3,22.9,27.3z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-auto">Auto</label>
                    </label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <label>
                    <input type="checkbox" id="deliveryType-car" name="itinerary_delivery[]" value="car" class="custom-control-input limitSelect" >
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 58.2 33" style="enable-background:new 0 0 58.2 33;" xml:space="preserve">
                    <path d="M17.2,2.4c3.7,0,7.4,0,11.1,0c3.9,0,7.9-0.3,11.8,0c1.7,0.1,2.7,1.8,3.8,3c1.7,2,3.4,4,5.1,5.9c1.4,1.6,2.8,3.2,4.1,4.8
	C54.4,17.8,54,20,54,22s-0.8,3.5-3,3.6c-1.2,0-2.4,0-3.6,0c-4.7,0-9.4,0-14.1,0c-8.4,0-16.8,0.4-25.2,0c-3-0.1-3-3.2-2.8-5.6
	C5.5,18.1,7,16.4,8,14.8c1.6-2.6,3.2-5.1,4.8-7.7C13.8,5.5,15,2.6,17.2,2.4c1.2-0.1,1.2-1.9,0-1.8c-2.5,0.2-3.5,1.8-4.7,3.6
	C11,6.6,9.5,9,8,11.3c-1.2,1.9-2.5,3.8-3.6,5.8c-1.1,1.8-1,3.8-0.9,5.9c0.2,4.7,4.7,4.4,8.1,4.4c5.2,0,10.5,0,15.7,0
	c5.7,0,11.4,0,17.1,0c1.8,0,3.7,0,5.5,0c1.1,0,2.3,0.1,3.4-0.4c2.9-1.3,2.5-4.5,2.5-7.2c0-1.3,0.1-2.6-0.6-3.7
	c-0.3-0.5-0.8-1-1.2-1.5c-3.3-3.9-6.6-7.8-10-11.7c-1.1-1.3-2.3-2.2-4.2-2.2s-3.8,0-5.6,0c-5.3,0-10.7,0-16,0c-0.4,0-0.7,0-1.1,0
	C16,0.6,16,2.4,17.2,2.4z M35.9,21.9c-2.6,0-5.2,0-7.8,0c-1.4,0-2.7,0.1-4.1,0c-0.6,0-1.1,0-1.6-0.4c-1.7-1.2-0.7-3.5,1.1-3.7
	c2.5-0.3,5.3,0,7.8,0c1.4,0,2.7-0.1,4.1,0c0.5,0,0.8-0.1,1.4,0.2C38.7,19,37.9,21.8,35.9,21.9c-1.2,0.1-1.2,1.9,0,1.8
	c4.9-0.4,5-7.4,0-7.7c-2.9-0.2-5.8,0-8.7,0c-2.8,0-6.7-0.5-7.5,3.1c-0.4,2,0.9,4,2.8,4.5c1,0.3,2.2,0.1,3.2,0.1c3.4,0,6.7,0,10.1,0
	C37,23.8,37,21.9,35.9,21.9z M44.2,21.1c-0.6-0.9-0.6-1.8,0.3-2.4c0.9-0.6,3.9-1.5,4.7-0.1c0.8,1.3-0.5,2.1-1.4,2.4
	C47,21.3,44.9,22,44.2,21.1c-0.7-1-2.2-0.1-1.6,0.9c1.3,2,4.1,1.4,6,0.7c2-0.7,3.4-3,2.2-5c-1.4-2.4-5.2-1.8-7.2-0.6
	c-1.8,1-2.1,3.2-1,4.9C43.3,23,44.9,22,44.2,21.1z M17,22.3c1.1-1.6,0.9-3.7-0.8-4.8c-2-1.3-5.9-1.9-7.4,0.5
	C6.2,22.4,14.7,25.8,17,22.3c0.7-1-0.9-1.9-1.6-0.9c-0.7,1-2.7,0.2-3.6-0.1c-0.3-0.1-0.6-0.2-0.9-0.3c0.3,0.1,0.2,0.1-0.3-0.3
	c-0.2-0.2-0.3-0.5-0.4-0.7c-0.1-0.4-0.1-0.8,0.1-1.1c0.8-1.4,3.8-0.5,4.7,0.1s0.9,1.5,0.3,2.4C14.8,22.4,16.3,23.3,17,22.3z
	 M19.9,31c-1.4,0-2.7,0-4.1,0c-0.8,0-1.4,0.2-1.8-0.9c-0.3-0.8,0-2.2,0.9-2.5c1-0.4,2.8,0,3.8,0c0.8,0,1.7-0.2,2.1,0.9
	C21,29.1,20.8,30.8,19.9,31c-1.2,0.1-1.2,2,0,1.8c1.6-0.2,2.6-1.2,2.7-2.8c0.1-1.3,0.1-2.8-1.1-3.7c-0.9-0.7-2-0.5-3.1-0.5
	c-1.2,0-2.4-0.1-3.5,0C12,26,11,30.3,13.1,32.1c0.9,0.8,2.1,0.7,3.3,0.7c1.2,0,2.3,0,3.5,0C21,32.8,21,31,19.9,31z M45.4,31
	c-1.4,0-2.7,0-4.1,0c-0.8,0-1.4,0.2-1.8-0.9c-0.3-0.8,0-2.2,0.9-2.5c1-0.4,2.8,0,3.8,0c0.8,0,1.7-0.2,2.1,0.9
	C46.5,29.1,46.3,30.8,45.4,31c-1.2,0.1-1.2,2,0,1.8c1.6-0.2,2.6-1.2,2.7-2.8c0.1-1.3,0.1-2.8-1.1-3.7c-0.9-0.7-2-0.5-3.1-0.5
	c-1.2,0-2.4-0.1-3.5,0c-2.8,0.3-3.8,4.5-1.8,6.3c0.9,0.8,2.1,0.7,3.3,0.7s2.3,0,3.5,0C46.6,32.8,46.6,31,45.4,31z M17.5,5.5
	c4.5,0,8.9,0,13.4,0c2.5,0,5.1,0,7.6,0c0.3,0,0.7,0,1,0c0.3-0.1,0.5,0.2,0.1-0.1c-0.6-0.4,0,0.2,0.1,0.3C40,6.2,40.5,6.6,40.9,7
	c1.8,2,3.5,4,5.3,6c0.2-0.5,0.4-1,0.6-1.6c-9.9,0-19.9,0-29.8,0c-1.4,0-2.8,0-4.2,0c0.3,0.5,0.5,0.9,0.8,1.4
	c1.6-2.6,3.2-5.2,4.8-7.8c0.6-1-1-1.9-1.6-0.9c-1.6,2.6-3.2,5.2-4.8,7.8c-0.4,0.6,0.1,1.4,0.8,1.4c9.9,0,19.9,0,29.8,0
	c1.4,0,2.8,0,4.2,0c0.8,0,1.2-1,0.6-1.6c-1.6-1.8-3.2-3.6-4.7-5.4c-0.9-1.1-1.8-2.6-3.3-2.7c-5.4-0.2-10.8,0-16.1,0
	c-1.9,0-3.8,0-5.7,0C16.3,3.7,16.3,5.5,17.5,5.5z M20.2,20.6c0.7,0.5,2.2,0.2,2.9,0.2c2.1,0,4.1,0,6.2,0c3.1,0,6.2-0.1,9.3-0.1
	c1.2,0,1.2-1.8,0-1.8c-2.9,0-5.7,0.1-8.6,0.1c-2,0-4,0-6,0c-0.7,0-1.5,0-2.2,0c-0.2,0-0.5,0-0.7,0c-0.3,0-0.3-0.1,0,0.1
	C20.2,18.3,19.3,19.9,20.2,20.6L20.2,20.6z M50,10.7c0.5-0.9,1-1.8,1.5-2.6c0.7-1,2.5-1.6,3.7-1c2.1,1-1.1,2.6-2.1,3
	c-0.9,0.4-1.9,0.8-2.8,1.3c-1.1,0.5-0.1,2,0.9,1.6c1.4-0.6,2.8-1.1,4.1-1.8c1.9-1,3.4-3.6,1.4-5.3C55.4,4.7,52.4,5,51.1,6
	c-1.2,0.9-1.9,2.6-2.7,3.9C47.8,10.8,49.4,11.7,50,10.7L50,10.7z M10.1,9.8c-0.7-1.3-1.4-3-2.7-3.9C6,4.9,3.1,4.7,1.8,5.8
	c-2,1.7-0.5,4.3,1.4,5.3c1.3,0.7,2.7,1.2,4.1,1.8c1.1,0.5,2-1.1,0.9-1.6c-0.9-0.4-1.9-0.8-2.8-1.3c-1-0.4-4.1-2-2.1-3
	C4.5,6.4,6.4,7,7,8c0.6,0.8,1,1.8,1.5,2.6C9.1,11.7,10.7,10.8,10.1,9.8L10.1,9.8z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-car">Car</label>
                    </label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <label>
                    <input type="checkbox" id="deliveryType-cycle" name="itinerary_delivery[]" value="cycle" class="custom-control-input limitSelect">
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 41.8 33" style="enable-background:new 0 0 41.8 33;" xml:space="preserve">
                    <path d="M13.9,24.9c-0.1,3.2-2.6,5.9-5.9,5.9c-3.2,0-5.9-2.7-5.9-5.9c0-3.1,2.6-5.8,5.7-5.9C11.1,18.9,13.7,21.6,13.9,24.9
	c0,1.1,1.7,1.1,1.7,0c-0.1-4.1-3.3-7.6-7.6-7.6c-4.1,0-7.6,3.4-7.6,7.6c0,4.1,3.4,7.6,7.6,7.6s7.4-3.4,7.6-7.6
	C15.5,23.8,13.9,23.8,13.9,24.9z M39.4,24.9c-0.1,3.2-2.6,5.9-5.9,5.9c-3.2,0-5.9-2.7-5.9-5.9c0-3.1,2.6-5.8,5.7-5.9
	C36.7,18.9,39.3,21.6,39.4,24.9c0,1.1,1.7,1.1,1.7,0c-0.1-4.1-3.3-7.6-7.6-7.6c-4.1,0-7.6,3.4-7.6,7.6c0,4.1,3.4,7.6,7.6,7.6
	s7.4-3.4,7.6-7.6C41.1,23.8,39.4,23.8,39.4,24.9z M14.1,8.1c-1.1,0-2.3,0-3.4,0c-0.6,0-1.2,0.1-1.8,0C8,7.9,6.7,6.8,8.6,6.3
	c0.9-0.3,2.2,0,3.1,0c0.6,0,1.3-0.1,1.9,0C14.5,6.3,16.2,7.8,14.1,8.1c-1,0.1-1.1,1.8,0,1.7c3.3-0.4,3.3-4.8,0-5.1
	c-1.8-0.2-3.8-0.2-5.6,0C5.5,5,5,9.2,8.1,9.8c1.9,0.3,4.1,0,6,0C15.2,9.7,15.2,8.1,14.1,8.1z M10.5,8.9c0,1.7,0,3.3,0,5
	c0,1.1,1.7,1.1,1.7,0c0-1.7,0-3.3,0-5C12.2,7.8,10.5,7.8,10.5,8.9L10.5,8.9z M27.2,2.3c1.5,0,2.9,0,4.4,0C31.3,2,31,1.7,30.8,1.5
	c0.6,7.8,1.3,15.6,1.9,23.4c0.1,1.1,1.7,1.1,1.7,0c-0.6-7.8-1.3-15.6-1.9-23.4c0-0.4-0.3-0.8-0.8-0.8c-1.5,0-2.9,0-4.4,0
	C26.1,0.6,26.1,2.3,27.2,2.3L27.2,2.3z M10.8,14.5c3.3,2.8,6.6,5.6,9.9,8.4c0.1-0.5,0.2-0.9,0.4-1.4c-4.4,0.9-8.9,1.7-13.3,2.6
	c0.3,0.3,0.7,0.7,1,1c1.1-3.7,2.3-7.4,3.4-11c-0.3,0.2-0.5,0.4-0.8,0.6c7-0.4,13.9-0.8,20.9-1.2c1.1-0.1,1.1-1.7,0-1.7
	c-7,0.4-13.9,0.8-20.9,1.2c-0.4,0-0.7,0.2-0.8,0.6c-1.1,3.7-2.3,7.4-3.4,11c-0.2,0.6,0.4,1.1,1,1c4.4-0.9,8.9-1.7,13.3-2.6
	c0.6-0.1,0.8-1,0.4-1.4c-3.3-2.8-6.6-5.6-9.9-8.4C11.1,12.6,10,13.8,10.8,14.5L10.8,14.5z M22.6,19.2c1.1,0,2.3,0,3.4,0
	c-0.3-0.3-0.5-0.7-0.8-1c-0.2,0.6-0.3,1.2-0.5,1.8c0.3-0.2,0.5-0.4,0.8-0.6c-1.1,0-2.3,0-3.4,0c0.3,0.3,0.5,0.7,0.8,1
	c0.2-0.6,0.3-1.2,0.5-1.8c0.3-1-1.3-1.5-1.6-0.4c-0.2,0.6-0.3,1.2-0.5,1.8c-0.1,0.5,0.3,1,0.8,1c1.1,0,2.3,0,3.4,0
	c0.4,0,0.7-0.3,0.8-0.6c0.2-0.6,0.3-1.2,0.5-1.8c0.1-0.5-0.3-1-0.8-1c-1.1,0-2.3,0-3.4,0C21.6,17.6,21.6,19.2,22.6,19.2z M21.4,20
	c-0.4,1.4-0.8,2.8-1.3,4.2c-0.3,1,1.3,1.5,1.6,0.4c0.4-1.4,0.8-2.8,1.3-4.2C23.3,19.4,21.7,19,21.4,20L21.4,20z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-cycle">Cycle</label>
					</label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                                       <label>
										   
				   <input type="checkbox" id="deliveryType-foot" name="itinerary_delivery[]" value="foot" class="custom-control-input limitSelect" >
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 18.6 36.1" style="enable-background:new 0 0 18.6 36.1;" xml:space="preserve">
                    <path d="M9.8,4.8c0,1.3-0.8,2.9-2.3,2.9S5.1,6.1,5.1,4.8s0.9-3,2.4-3S9.8,3.4,9.8,4.8c0,0.9,1.5,0.9,1.4,0c-0.1-2.1-1.4-4.4-3.8-4.4
	c-2.3,0-3.8,2.2-3.8,4.4C3.6,6.9,5,9,7.2,9.2c2.4,0.1,3.9-2.2,4-4.4C11.3,3.9,9.9,3.9,9.8,4.8z M4.9,7.2c-1.4,0.4-2.3,1.8-2.6,3
	C2,11.3,2,12.5,2.1,13.6c0.1,1.5,0.2,3.1,0.8,4.5s3.1,4.6,4.9,2.7c0.7-0.8,0.4-2.3,0-3.2c-0.3-0.8-0.6-1.3-0.6-2.2
	c0-1,0.1-1.9,0.1-2.9c0.1-0.9-1.4-0.9-1.4,0c-0.1,1.2-0.2,2.4-0.1,3.5c0.1,1,0.6,1.6,0.8,2.5c0.1,0.5,0.3,1.2-0.2,1.4
	c-0.4,0.2-1.1-0.5-1.3-0.8c-0.6-0.7-1-1.5-1.2-2.3C3.4,15,2.6,9.3,5.3,8.6C6.1,8.3,5.8,7,4.9,7.2L4.9,7.2z M9.1,8.6
	c-0.1,0,0,0,0.2,0.1c0.3,0.2,0.6,0.8,0.8,1.3c1.4,3.4,1.2,7.6,1.1,11.2c0.2-0.2,0.5-0.5,0.7-0.7c-3.1,0-6.1,0-9.2,0
	c0.2,0.2,0.5,0.5,0.7,0.7c0-2.5,0-5.1,0-7.6c0-0.9-1.4-0.9-1.4,0c0,2.5,0,5.1,0,7.6C2,21.6,2.3,22,2.7,22c3.1,0,6.1,0,9.2,0
	c0.4,0,0.7-0.3,0.7-0.7c0.1-3.9,0.4-8.6-1.4-12.2c-0.4-0.8-1.1-1.9-2.1-1.9C8.2,7.2,8.2,8.6,9.1,8.6L9.1,8.6z M10.7,12
	c0.4,1.1,0.9,2.1,1.5,3.1c0.3,0.5,1.2,1.3,1.4,1.8c0.3,0.8-0.6,0.9-1.2,0.9c0.2,0.1,0.4,0.2,0.6,0.4c-0.1-0.2-0.3-0.4-0.4-0.6
	c-0.5-0.8-1.7,0-1.2,0.7c0.6,0.9,1.1,1.2,2.2,0.9c0.9-0.2,1.5-1,1.5-2c0-1.1-1-1.8-1.5-2.7c-0.6-0.9-1.1-1.9-1.4-2.9
	C11.7,10.7,10.3,11.1,10.7,12L10.7,12z M3.1,21.4c0.2,1.7,1.1,3.5,2.5,4.5s2.6,1.6,3.4,3.2c0.6,1.2,0.8,2.1,0.8,3.4
	c0,0.4,0.3,0.7,0.7,0.7c1.6,0,3.1,0,4.7,0c0.4,0,0.8-0.3,0.7-0.7c-0.2-1.5-0.6-3-1.1-4.4c-0.4-1.1-1-2.1-1.7-3.1
	c-0.7-0.9-3.2-2.3-2.9-3.6c0.2-0.9-1.1-1.3-1.4-0.4c-0.3,1.2,0.5,2.5,1.4,3.3c1.1,1,2.1,1.8,2.8,3.2c0.8,1.5,1.3,3.4,1.5,4.9
	c0.2-0.2,0.5-0.5,0.7-0.7c-1.6,0-3.1,0-4.7,0c0.2,0.2,0.5,0.5,0.7,0.7c0-2.4-1-4.9-2.9-6.4c-1.2-1-2.5-1.4-3.2-2.8
	c-0.3-0.7-0.6-1.4-0.7-2.2C4.4,20.1,3,20.5,3.1,21.4L3.1,21.4z M10.3,21.2c0,0.9,0,1.9,0,2.8s1.4,0.9,1.4,0s0-1.9,0-2.8
	C11.7,20.3,10.3,20.3,10.3,21.2L10.3,21.2z M4.9,25.1c0,2.5,0,5,0,7.4c0,0.4,0.3,0.7,0.7,0.7c1.6,0,3.3,0,4.9,0c0.9,0,0.9-1.4,0-1.4
	c-1.6,0-3.3,0-4.9,0c0.2,0.2,0.5,0.5,0.7,0.7c0-2.5,0-5,0-7.4C6.4,24.2,4.9,24.2,4.9,25.1L4.9,25.1z M10.7,32.3
	c-0.3,0.9-0.3,2.2,0.6,2.8c0.9,0.6,2.5,0.4,3.6,0.4c0.9,0,1.9,0.2,2.5-0.6c1-1.4-0.6-2.5-1.7-3c-0.8-0.4-1.6,0.9-0.7,1.2
	c0.6,0.2,0.9,0.6,1.3,0.9c0,0,0,0.1-0.1,0.1l-0.1,0.1c-0.2,0.1,0,0.1,0.4-0.2c-0.1-0.2-1.9,0-2.1,0c-0.6,0-1.4,0.2-2,0
	s-0.5-0.8-0.3-1.3C12.3,31.8,11,31.5,10.7,32.3L10.7,32.3z M5.1,32.3c-0.3,0.9-0.3,2.1,0.6,2.8c0.9,0.6,2.5,0.4,3.6,0.4
	c0.9,0,1.9,0.2,2.4-0.6c1-1.4-0.6-2.5-1.7-3c-0.8-0.4-1.6,0.9-0.7,1.2c0.6,0.2,0.9,0.6,1.3,0.9c0,0,0,0.1-0.1,0.1l-0.1,0.1
	c-0.2,0.1,0,0.1,0.4-0.2c-0.1-0.2-1.9,0-2.1,0c-0.6,0-1.4,0.2-2,0s-0.5-0.8-0.3-1.3C6.8,31.8,5.4,31.5,5.1,32.3L5.1,32.3z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-foot">On Foot</label>
                    </label>
                  </div>
                </div>
              </div>
            </li>
          </ul>
          <h3 class="col-form-label">Language Preferences</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Select My Languages</label>              
			   <select id="typeLanguages" name="preferences_languages[]" class="form-control ignore" placeholder="Select my languages"  data-rule-required="true" multiple>
               <?php
				 foreach($languages as $langVal):
				  $langArr = explode(',',$langVal->known_languages);
				  foreach($langArr as $langData):				  
				  ?>
                <option value="<?php echo $langData;?>"><?php echo $langData;?></option>
               <?php endforeach;endforeach;?>
              </select>
            </li>
          </ul>
          <h3 id="fillInclusions" class="col-form-label">Inclusions & exclusions</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Inclusions</label>
              <textarea class="form-control ignore" name="itinerary_inclusions" placeholder="Type down the inclusions (max 1000 characters)" id="itinerary_inclusions" data-rule-required="true" data-rule-maxlength="1000"></textarea>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Exclusions</label>
              <textarea class="form-control ignore" name="itinerary_exclusions" placeholder="Type down the exclusions (max 1000 characters)" id="itinerary_exclusions" data-rule-required="true" data-rule-maxlength="1000"></textarea>
            </li>
          </ul>
          <h3 class="col-form-label">Additional Details</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Special Mention</label>
              <textarea class="form-control ignore" name="itinerary_splmention" placeholder="Type any special mentions (max 1500 characters)" id="itinerary_splmention" data-rule-required="true" data-rule-maxlength="1500"></textarea>
            </li>
          </ul>
          
		  <!--<h3 class="col-form-label">Social Media Links</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12">
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="socialShare-facebook" name="itinerary_allowshare_facebook" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="socialShare-facebook">Share on facebook</label>
              </div>
            </li>
            <li class="form-group col-12 ">
              <div class="custom-control custom-checkbox custom-control-inline">
               <input type="checkbox" id="socialShare-instagram" name="itinerary_allowshare_instagram" class="custom-control-input" value="1"/>
                <label class="custom-control-label" for="socialShare-instagram">Share on Instagram</label>
              </div>
            </li>
          </ul>-->
		  
          <h3 id="fillFaq" class="col-form-label">FAQs</h3>
          <ul class="form-row no-gutters mb-4">            
            <li class="form-group col-12">
              <label class="col-form-sublabel">Questions</label>
              <div class="placeVaild">
                <input type="text" name="itinerary_faq_question_01[]" class="form-control ignore" placeholder="Questions" id="faq_question_01" data-rule-required="true"/>
              </div>
              <div class="placeVaild">
                <textarea name="itinerary_faq_answer_01[]" class="form-control mt-4 ignore" placeholder="Answer (max 1000 characters)" id="faq_answer_01" data-rule-required="true" data-rule-maxlength="1000"></textarea>
              </div>
            </li>            
            <li class="col-12 col-md-12"> <a href="#" id="addQuestionLink" data-toggle="modal" data-target="#addQuestionModal" class="text-uppercase font-weight-bold">+ Add Another Question</a> </li>
          </ul>
          <h3 id="fillhost" class="col-form-label">ADDITIONAL CONTACT DETAILS</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">First Name</label>
              <input type="text" name="itinerary_host_firstname" class="form-control ignore" placeholder="First Name" id="host_firstname"  data-rule-required="true" value="<?php echo $hostProfile[0]->host_first_name;?>"/>
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Last Name</label>
              <input type="text" name="itinerary_host_lastname" class="form-control ignore" placeholder="Last Name" id="host_lastname"  data-rule-required="true" value="<?php echo $hostProfile[0]->host_last_name;?>"/>
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Mobile</label>
			  <span class="mobileCheck">+91-</span>
              <input type="text" name="itinerary_host_mobile" class="form-control ignore " placeholder="Mobile Number" id="host_mobile" 
			  value="<?php echo $hostProfile[0]->host_mob_no;?>" data-rule-required="true" maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter vaild mobile number"/>
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Email ID</label>
              <input type="email" name="itinerary_host_email" class="form-control ignore" placeholder="Email ID" id="host_email" 
			      value="<?php echo $hostProfile[0]->host_email;?>" data-rule-required="true"/>
            </li>
          </ul>

          <h3 class="col-form-label mt-4">Emergency Contact</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Emergency Number</label>
			  <span class="mobileCheck">+91-</span>
              <input type="text" name="itinerary_host_emergency" class="form-control ignore" placeholder="Mobile Number" id="host_emergency_no"
			    data-rule-required="true" maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter vaild mobile number"/>
            </li>
          </ul>
        </fieldset>
  
         <fieldset>
	  <h3 class="col-form-label">Service frequency
	  </h3>
	  <ul class="form-row">
		<li class="form-group col-12 col-md-12">
      <div class="form-row">
        <div class="col-12 col-sm-6 placeVaild">
          <label class="col-form-sublabel">Start Date
          </label>
          <input id="startDateInput" name="itinerary_aviaiable_start_date" onkeydown="return false" type="text" class="form-control ignore" placeholder="DD-MM-YYYY" 
                 value="<?php if(isset($draftData->start_date_from_host) && $draftData->start_date_from_host!='1970-01-01')
                        echo date('d-m-Y',strtotime($draftData->start_date_from_host));?>" data-rule-required="true" autocomplete="off"/>
        </div>
        <div class="col-12 col-sm-6 placeVaild">
          <label class="col-form-sublabel">End Date
          </label>
          <input id="endDateInput" name="itinerary_aviaiable_end_date" onkeydown="return false" type="text" class="form-control ignore" placeholder="DD-MM-YYYY" 
                 value="<?php if(isset($draftData->end_date_to_host) && $draftData->end_date_to_host!='1970-01-01')
                        echo date('d-m-Y',strtotime($draftData->end_date_to_host));?>" data-rule-required="true" autocomplete="off"/>
        </div>
        </li>
    <li class="form-group col-12 col-md-12">
      <div class="form-row">
        <div class="col-12 col-sm-6 placeVaild">
          <label class="col-form-sublabel">Frequency
          </label>          
          <select id="selectOffDates" class="form-control ignore" name="itinerary_set_frequency" data-rule-required="true">
            <option value="regular" <?php echo @$draftData->frequency_type=='regular'?'selected="selected"':'';?>>Regular
            </option>
          <option value="nonregular" <?php echo @$draftData->frequency_type=='nonregular'?'selected="selected"':'';?>>Non-Regular
          </option>
        </select>
    </div>
  <div class="col-12 col-sm-6 placeVaild offDates">
    <label class="col-form-sublabel">Block Dates
    </label>
    <input id="selectDateInput" name="itinerary_aviaiable_all_date" type="text" class="form-control ignore" 
           value="<?php if(!empty(@$draftData->frequency_off_days)){echo $draftData->frequency_off_days;}?>" 
           placeholder="Block Date" data-rule-required="true" autocomplete="off" onkeydown="return false" />
  </div> 
  </div>
</li>
<li class="form-group col-12 col-md-12">
  <div class="form-row">
    <div class="col-12">
      <label id="fillAvailability" class="col-form-sublabel">Available time of host
      </label>
    </div>
    <div class="col-6 placeVaild">
      <label class="col-form-sublabel">From
      </label>
      <input type="text" name="itinerary_aviaiable_time_from" class="form-control timepicker ignore" placeholder="Time" id="time_from" 
             value="<?php if(isset($draftData->aviaiable_time_form_host))echo $draftData->aviaiable_time_form_host;else{echo '12:00 AM';}?>" data-rule-required="true" autocomplete="off"/>
    </div>
    <div class="col-6 placeVaild">
      <label class="col-form-sublabel">To
      </label>
      <input type="text" name="itinerary_aviaiable_time_to" class="form-control timepicker ignore" placeholder="Time"  id="time_to" 
             value="<?php if(isset($draftData->aviaiable_time_to_host))echo $draftData->aviaiable_time_to_host;else{echo '12:00 AM';}?>" data-rule-required="true" autocomplete="off"/>
    </div>
  </div>
</li>
</ul>
</fieldset> 
  <fieldset> 
          <h3 id="fillRoute" class="col-form-label mt-2">Route & Timings</h3>
          <label class="col-form-sublabel text-dark font-weight-semibold d-block">Default Slot</label>         
          <ul class="form-row">
			  <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Pick-Up Point</label>
                  <input type="text" name="itinerary_route_slot01_pickup[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="Pick-up Point" id="pickup_point" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Start Time</label>
                  <input type="text" name="itinerary_route_slot01_pickup_time[]" class="form-control timepicker ignore" value="12:00 AM" placeholder="Time" id="pickup_time" data-rule-required="true" autocomplete="off"/>
                </div>
				<input type="hidden" name="pickup_coordinates[]" id="pickup_coordinates" />
              </div>
            </li>
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Drop-Off Point</label>
                  <input type="text" name="itinerary_route_slot01_dropoff[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="Drop-Off Point" id="dropoff_point"  autocomplete="off"  data-rule-required="true"/>
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">End Time</label>
                  <input type="text" name="itinerary_route_slot01_dropoff_time[]" class="form-control timepicker ignore" value="12:00 AM"  placeholder="Time" id="dropend_time" data-rule-required="true" autocomplete="off"/>
                </div>
				<input type="hidden" name="dropoff_coordinates[]" id="dropoff_coordinates" />
              </div>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel ">Total Duration(Hours)</label>
              <input type="text" name="itinerary_route_slot01_duration[]" class="form-control hourpicker ignore"  value="0:00" placeholder="Total Duration" id="route_slot01_duration" data-rule-required="true" autocomplete="off"/>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel ">Cut-off Time(Hours)</label>
              <input type="text" name="itinerary_route_slot01_cutofftime[]" class="form-control cutoffpicker ignore" value="0:00" placeholder="Cut-off Time" id="route_slot01_cutofftime" data-rule-required="true" autocomplete="off"/>
            </li>
          </ul>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel text-dark font-weight-semibold d-block">Stop 1</label>
              <div class="form-row slotClass">
                <div class="col-12 col-sm-7 placeVaild">
                  <label class="col-form-sublabel">Type a location</label>
                  <input type="text" name="route[0][itinerary_route_slot01_stop01_location][0]" class="form-control ignore" placeholder="Type a location" id="route_slot01_stop01_location" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-4 offset-sm-1 placeVaild">
                  <label class="col-form-sublabel">Time</label>
                  <input type="text" name="route[0][itinerary_route_slot01_stop01_time][0]" class="form-control timepicker ignore"  value="12:00 AM" placeholder="Time" id="route_slot01_stop01_time" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-7 pt-4 placeVaild">
                  <textarea class="form-control ignore" name="route[0][itinerary_route_slot01_stop01_description][0]" placeholder="Add a description" id="route_slot01_stop01_description" data-rule-required="true"></textarea>
                </div>
              </div>
			  </li>
			  
            <li class="form-group col-12">
              <a href="#" class="text-uppercase font-weight-bold" id="addStopLink" data-toggle="modal" data-target="#addStopModal" >+ Add Another Stop</a> </li>
          </ul>
          <!--<ul class="form-row no-gutters">
            <li class="form-group col-12"> <a href="#" class="text-uppercase font-weight-bold text-secondary" id="addSlotLink" data-toggle="modal" data-target="#addSlotModal" >+ Add/Repeat New Slot</a> </li>
          </ul>-->
          <h3 id="fillConnectivity" class="col-form-label mt-2">Connectivity</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Nearest Airport</label>
              <select id="connectivity_airport" class="form-control ignore" name="itinerary_connectivity_airport" data-rule-required="true">
                <option value="">Select</option>
                 <?php foreach($airPortData as $airports):					
				 ?>
				 <option value="<?php echo $airports->airport_name;?>"><?php echo $airports->airport_name;?></option>
				 <?php endforeach;?>
			 </select>
			 
              <!--<input type="text" class="form-control ignore" name="itinerary_connectivity_airport" id="connectivity_airport" 
			   data-rule-required="true"/>-->
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Nearest Railway Station</label>             
              <select id="connectivity_railway" class="form-control ignore" name="itinerary_connectivity_railway" data-rule-required="true">
				 <option value="">Select</option>
                <?php foreach($railwayData as $railways):					
				?>				
			 <option value="<?php echo $railways->railway_name;?>"><?php echo $railways->railway_name;?></option>
			 <?php endforeach;?>
			  </select>
			  <!--<input type="text" class="form-control ignore" name="itinerary_connectivity_railway" id="connectivity_railway" 
				  data-rule-required="true"/>-->
            </li>
            <li class="form-group col-12 col-md-12 placeVaild">
              <label class="col-form-sublabel">Location Covered</label>
              <input type="text" class="form-control ignore" name="itinerary_location_covered" placeholder="Location Covered" id="location_covered" data-rule-required="true"/>
            </li>
          </ul>
          <h3 id="fillTraveller" class="col-form-label mt-2">Traveller Specifications</h3>
          <div class="placeVaild">
            <ul class="form-row">
              <li class="form-group col-12 col-md-12 pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-private" name="itinerary_traveller_private" class="custom-control-input ignore" value="1" data-rule-required="true">
                      <label class="custom-control-label font-weight-semibold" for="travellerType-private">Private</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Travellers</label>
                    <input type="number" name="itinerary_traveller_private_minnumber" class="form-control ignore" placeholder="0" min="1" id="private_min_no_travllers" value="1" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Travellers</label>
                    <input type="number" name="itinerary_traveller_private_maxnumber" class="form-control ignore" placeholder="0" id="private_max_no_travllers" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
              <li class="form-group col-12 col-md-12 pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-group" name="itinerary_traveller_group" class="custom-control-input ignore" value="1">
                      <label class="custom-control-label font-weight-semibold" for="travellerType-group">Group</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Travellers</label>
                    <input type="number" class="form-control ignore" name="itinerary_traveller_group_minnumber" placeholder="0" min="1" id="group_min_no_travllers" value="1" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Travellers</label>
                    <input type="number" class="form-control ignore" name="itinerary_traveller_group_maxnumber" placeholder="0" id="group_max_no_travllers" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>                         
             <li class="form-group col-12 col-sm-6 mb-1 pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-family" name="itinerary-traveller-family" class="custom-control-input ignore" value="1"  >
                      <label class="custom-control-label font-weight-semibold" for="travellerType-family">Family</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Adult - Min. No.</label>
                    <input type="number" class="form-control ignore disabledDad" name="itinerary_traveller_family_adult_minnumber" placeholder="0" min="1" id="adult_min_no" data-rule-required="true" value="1" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Adult - Max. No.</label>
                    <input type="number" class="form-control ignore disabledDad" name="itinerary_traveller_family_adult_maxnumber" placeholder="0" id="adult_max_no" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
             <li class="form-group col-12 col-sm-6 pt-2" data-id="kids-1">
                <div class="form-row">
                  <div class="col-12 col-sm-4  placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
                      <input id="travellerType-kids-below10" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore disabledDad keepCheck" value="10" data-rule-required="true" checked disabled />
                      <label class="custom-control-label" for="travellerType-kids-below10">Below 10</label>
                    </div>
                   </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input id="family_kids_min_no" type="number" class="form-control ignore defaultActive disabledPaa" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="1" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input id="family_kids_max_no" type="number" class="form-control ignore defaultActive disabledPaa" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
             <li class="form-group col-12 col-sm-6 pt-2 offset-0 offset-sm-6" data-id="kids-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
                      <input id="travellerType-kids-below7" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore disabledDad keepCheck" value="7" data-rule-required="true" disabled />
                      <label class="custom-control-label" for="travellerType-kids-below7">Below 7</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input type="number" class="form-control append_min_val disabledPaa" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="1" data-rule-required="true" disabled>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input type="number" class="form-control append_max_val disabledPaa" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" data-rule-required="true" disabled>
                  </div>
                </div>
              </li>
             <li class="form-group col-12 col-sm-6 pt-2 offset-0 offset-sm-6" data-id="kids-3">
                <div class="form-row">
                  <div class="col-12 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
                      <input id="travellerType-kids-below5" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore disabledDad keepCheck" value="5" data-rule-required="true" disabled />
                      <label class="custom-control-label" for="travellerType-kids-below5">Below 5</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input type="number" class="form-control append_min_val disabledPaa" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="1" data-rule-required="true" disabled>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input type="number" class="form-control append_max_val disabledPaa" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" data-rule-required="true" disabled >
                  </div>
                </div>
              </li>                  
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <h3 id="fillPrice" class="col-form-label mt-2">Price Chart</h3>
          <label class="col-form-sublabel mb-3">Enter pricing details <small>(Prices will be added per participant - All prices are in INR)</small></label>
          <ul class="form-row">
            <li  data-rel="privateCheck"  class="form-group col-12 col-md-12 hidden ">
              <div class="form-row">
                <div class="col-12 col-sm-3">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Private</label>
                </div>
                <div class="col-12 col-sm-4 placeVaild">
                  <label class="col-form-sublabel">Price</label>
                  <input type="number" class="form-control ignore"  name="itinerary_traveller_private_price"  placeholder="0" id="itinerary_private_price" data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li  data-rel="groupCheck"  class="form-group col-12 col-md-12 hidden ">
              <div class="form-row">
                <div class="col-12 col-sm-3">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Group</label>
                </div>
                <div class="col-12 col-sm-4 placeVaild">
                  <label class="col-form-sublabel">Price</label>
                  <input type="number" class="form-control ignore" name="itinerary_traveller_group_price" placeholder="0" id="itinerary_group_price" data-rule-required="true"/>
                </div>
              </div>
            </li>            
            <li  data-rel="familyCheck"  class="form-group col-12 col-md-6 hidden ">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Family</label>
                </div>
                <div class="col-6 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Price (Adults)</label>
                  <input type="number" class="form-control ignore" name="itinerary_traveller_family_adult_price[]" placeholder="0" id="itinerary_family_adult_price" data-rule-required="true" />
                </div>
              </div>
            </li>            
            <li data-rel="familyCheck" data-id="familyKidCheck-01" class="form-group col-12 col-md-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input id="itinerary_family_kids_age" type="text" class="form-control ignore" value="Below 10"   name="itinerary_traveller_family_kids01_age[]"  data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid" placeholder="0" name="itinerary_traveller_family_kids01_price[]"   data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="familyCheck" data-id="familyKidCheck-02" class="form-group col-12 col-md-6 offset-0 offset-sm-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input type="text" class="form-control ignore" value="Below 7"   name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid"  placeholder="0" name="itinerary_traveller_family_kids01_price[]"  disabled data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="familyCheck" data-id="familyKidCheck-03" class="form-group col-12 col-md-6 offset-0 offset-sm-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input  type="text" class="form-control ignore priceKid" value="Below 5"   name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid"  placeholder="0" name="itinerary_traveller_family_kids01_price[]"   disabled data-rule-required="true"/>
                </div>
              </div>
            </li>                        
          </ul>
		  
		<h3 class="col-form-label mt-2">Additional Costs</h3>		
		<ul>
		<li class="form-row">
		<div class="form-group col-12 col-sm-6 placeVaild">
		  <label class="col-form-sublabel">Item</label>
		  <input type="text" class="form-control ignore" name="itinerary_additionalcost_description[]" placeholder="Item description" id="additionalcost_desc" />
		</div>
		<div class="form-group col-12 col-sm-6 placeVaild">
		  <label class="col-form-sublabel">Price</label>
		  <input type="number" class="form-control ignore" name="itinerary_additionalcost_amt[]" placeholder="Price" id="additionalcost_amt" />
		</div>
		</li>
		<li class="text-right"> <a href="#" id="addItemLink" data-toggle="modal" data-target="#addItemsModal" class="text-uppercase font-weight-bold mb-2 pt-0">+ Add More</a> </li>
		</ul>		
        
		<!--<h3 id="fillConfirmation" class="col-form-label mt-2 mb-3">Confirmation & Review </h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Confirmation type</label>
              <div class="custom-control custom-radio custom-control-inline ml-3">
                <input type="radio" id="confirmationType-instant" name="itinerary-confirmationtype" value="instant" class="custom-control-input ignore" data-rule-required="true">
                <label class="custom-control-label" for="confirmationType-instant">Instant</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline ml-3">
                <input type="radio" id="confirmationType-review" name="itinerary-confirmationtype" value="review" class="custom-control-input" >
                <label class="custom-control-label" for="confirmationType-review">Review</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Instant Confirmation Message</label>
              <textarea class="form-control ignore" placeholder="Type the message" name="itinerary_confirmationtype_msg" id="instant_conf_msg" data-rule-required="true"></textarea>
            </li>
          </ul>-->
		  
          <h3 id="fillCancellations" class="col-form-label mt-2">Cancellations</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Done By You(Host)</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebyhost) > 500 ? substr($legalData[0]->preview_cancel_donebyhost,0,500)."..." : $legalData[0]->preview_cancel_donebyhost;?> <a href="javascript:void(0);"  data-ref="done_host" class="text-primary read_popup">View More</a></p>
			 
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelByHostInput-yes" name="itinerary-cancellations-agree" value="1" class="custom-control-input ignore" data-rule-required="true"/>
                <label class="custom-control-label" for="cancelByHostInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelByHostInput-no" name="itinerary-cancellations-agree" value="0" class="custom-control-input">
                <label class="custom-control-label" for="cancelByHostInput-no"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Done By traveller</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebytraveller) > 500 ? substr($legalData[0]->preview_cancel_donebytraveller,0,500)."..." : $legalData[0]->preview_cancel_donebytraveller;?> <a href="javascript:void(0);"  data-ref="done_traveller" class="text-primary read_popup">View More</a></p>
			 
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelBytravellerInput-yes" name="itinerary-donetraveller-agree" value="1" class="custom-control-input ignore" />
                <label class="custom-control-label" for="cancelBytravellerInput-yes" data-rule-required="true"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelBytravellerInput-no" name="itinerary-donetraveller-agree" value="0" class="custom-control-input">
                <label class="custom-control-label" for="cancelBytravellerInput-no"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Refund</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_refund) > 500 ? substr($legalData[0]->preview_cancel_refund,0,500)."..." : $legalData[0]->preview_cancel_refund;?> <a href="javascript:void(0);"  data-ref="done_refund" class="text-primary read_popup">View More</a></p>
			 
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="refundCheckInput-yes" name="itinerary-refund-agree" value="1" class="custom-control-input ignore"  data-rule-required="true"/>
                <label class="custom-control-label" for="refundCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="refundCheckInput-no" name="itinerary-refund-agree" value="0" class="custom-control-input">
                <label class="custom-control-label" for="refundCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <h3 id="fillSponsor" class="col-form-label mt-2">Sponsor</h3>
          <small class="text-muted">*Required dimension 400 X 127px, size less than 10mb and format .jpg,.jpeg only</small>
          <ul class="form-row">           
            <li class="form-group col-12 placeVaild">
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_sponsor_image_cover[]" id="add_sponsor" accept="image/jpg, image/jpeg" data-height="127" data-width="400" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input type="text" class="form-control lowKey ignore" name="itinerary_sponsor_hide_image_cover[]"  data-rule-required="false"/>
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Sponsor Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow">
                <p class="text-primary">File Name</p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>           
            <li class="form-group col-12 text-right"><a href="javascript:void(0);" class="text-uppercase font-weight-bold" id="addSponsor">+ Add More</a> </li>					
          </ul>
        </fieldset>
        <fieldset>
          <h3 id="fillVideo" class="col-form-label mt-2">Video</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Add a video <small>(*Required size less than 10mb and format .mp4 only)</small> </label>
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore vidInput" name="itinerary_gallery_video" id="add_video" accept="video/mp4" data-size="10240" data-msg-extension="Please upload file in video(.mp4) format only" />
              <input type="text" class="form-control lowKey ignore" name="hide_video"  data-rule-required="true">
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="video file" /></div>
                <p>Add a Video</p>
                <span>Drag file here or click to upload</span></div>
              <div class="infoShow">
                <p class="text-primary">                 
                </p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
          </ul>
          <h3 id="fillImage" class="col-form-label mt-2">Image Gallery</h3>
          <small class="text-muted">*Required dimension 1440 X 810px, size less than 10mb and format .jpg,.jpeg only</small>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_cover" id="image_gallery" accept="image/jpg, image/jpeg" data-height="810" data-width="1440" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input type="text" class="form-control lowKey ignore" name="hide_feature_img" data-rule-required="true" >
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon"> <img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow">
                <p class="text-primary">                  
                </p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
          </ul>
          <h3 class="col-form-sublabel mt-2">Additional Images</h3>
          <small class="text-muted">*Required dimension 250 X 158px, size less than 10mb and format .jpg,.jpeg only</small>
          <ul class="form-row">
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_01" id="additional_image_1" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input type="text" class="form-control lowKey ignore" name="hide_additional_img1"  data-rule-required="true" >
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon" > <img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow">
                <p class="text-primary">                 
                </p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_02" id="additional_image_2" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input type="text" class="form-control lowKey ignore" name="hide_additional_img2" data-rule-required="true">
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon"> <img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow">
                <p class="text-primary">                 
                </p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_03" id="additional_image_3" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input type="text" class="form-control lowKey ignore" name="hide_additional_img3" data-rule-required="true" >
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow">
                <p class="text-primary">                 
                </p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <h3 id="fillLegalLiabilities" class="col-form-label mt-2">Liabilities & Disclaimers</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_liability_diclaimer) > 500 ? substr($legalData[0]->preview_liability_diclaimer,0,500)."..." : $legalData[0]->preview_liability_diclaimer;?> <a href="javascript:void(0);"  data-ref="liability_diclaimer" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="disclaimerCheckInput-yes" name="itinerary-disclaimer-agree" value="1" class="custom-control-input ignore" data-rule-required="true"/>
                <label class="custom-control-label" for="disclaimerCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="disclaimerCheckInput-no" name="itinerary-disclaimer-agree" value="0" class="custom-control-input">
                <label class="custom-control-label" for="disclaimerCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalPrivacy" class="col-form-label mt-2">Privacy Policy</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_privacy_policy) > 500 ? substr($legalData[0]->preview_privacy_policy,0,500)."..." : $legalData[0]->preview_privacy_policy;?> <a href="javascript:void(0);" data-ref="privacy_policy" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="privacyCheckInput-yes"  name="itinerary-privacy-agree" value="1" class="custom-control-input ignore" 
				 data-rule-required="true"/>
                <label class="custom-control-label" for="privacyCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="privacyCheckInput-no" name="itinerary-privacy-agree" value="0" class="custom-control-input" />
                <label class="custom-control-label" for="privacyCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalTerms" class="col-form-label mt-2">Terms & Conditions</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_terms_condition) > 500 ? substr($legalData[0]->preview_terms_condition,0,500)."..." : $legalData[0]->preview_terms_condition;?> <a href="javascript:void(0);"  data-ref="term_condition" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="termsCheckInput-yes" name="itinerary-terms-agree" value="1" class="custom-control-input ignore" 
				 data-rule-required="true"/>
                <label class="custom-control-label" for="termsCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="termsCheckInput-no" name="itinerary-terms-agree" value="0" class="custom-control-input">
                <label class="custom-control-label" for="termsCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalCancellations" class="col-form-label mt-2">Cancellations</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Done By You(Host)</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebyhost) > 500 ? substr($legalData[0]->preview_cancel_donebyhost,0,500)."..." : $legalData[0]->preview_cancel_donebyhost;?> <a href="javascript:void(0);" data-ref="done_host" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelByHostInput-yes1" name="itinerary-cancelbyHost-agree-copy" value="1" class="custom-control-input ignore" data-rule-required="true"/>
                <label class="custom-control-label" for="cancelByHostInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelByHostInput-no1" name="itinerary-cancelbyHost-agree-copy" value="0"  
				class="custom-control-input">
                <label class="custom-control-label" for="cancelByHostInput-no1"> I Don't Agree </label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Done By traveller</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebytraveller) > 500 ? substr($legalData[0]->preview_cancel_donebytraveller,0,500)."..." : $legalData[0]->preview_cancel_donebytraveller;?> <a href="javascript:void(0);"  data-ref="done_traveller" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelBytravellerInput-yes1" name="itinerary-cancelbytraveller-agree-copy" value="1" class="custom-control-input ignore" data-rule-required="true"/>
                <label class="custom-control-label" for="cancelBytravellerInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelBytravellerInput-no1" name="itinerary-cancelbytraveller-agree-copy" value="0" class="custom-control-input" />
                <label class="custom-control-label" for="cancelBytravellerInput-no1"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Refund</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_refund) > 500 ? substr($legalData[0]->preview_cancel_refund,0,500)."..." : $legalData[0]->preview_cancel_refund;?> <a href="javascript:void(0);"  data-ref="done_refund" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="refundCheckInput-yes1" name="itinerary-refund-agree-copy" value="1" class="custom-control-input ignore" data-rule-required="true"/>
                <label class="custom-control-label" for="refundCheckInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="refundCheckInput-no1" name="itinerary-refund-agree-copy" value="0"  
				 class="custom-control-input">
                <label class="custom-control-label" for="refundCheckInput-no1"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalCopyright" class="col-form-label mt-2">Media Infringement</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">				
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_media_infringement) > 200 ? substr($legalData[0]->preview_media_infringement,0,200)."..." : $legalData[0]->preview_media_infringement;?> <a href="javascript:void(0);" data-ref="media_infri" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="copyrightCheckInput-yes"  name="itinerary-copyright-agree" value="1" 
				class="custom-control-input ignore" data-rule-required="true"/>
                <label class="custom-control-label" for="copyrightCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="copyrightCheckInput-no" name="itinerary-copyright-agree" value="0" 
				class="custom-control-input">
                <label class="custom-control-label" for="copyrightCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
		  
		 <h3 id="fillLegalCopyright" class="col-form-label mt-2">Terms &amp; Conditions</h3>		 
		<ul class="form-row">
            <li class="form-group col-12 placeVaild">              
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="term_policy"  name="term_condition" value="1" class="custom-control-input ignore" data-rule-required="true" data-msg-required="If you need any clarification or have a question, please email us at help@iwl.com."/>
                <label class="custom-control-label" for="term_policy"> I agree to the <a href="#" target="_blank" data-toggle="modal" data-target="#tcModal">Terms &amp; Conditions</a></label>
              </div>             
            </li>
          </ul>
		  
        </fieldset>
      </form>
    </div>
  </div>
</div>


<!-- ADD MORE STOP MODAL -->
<div class="modal fade" id="addStopModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
    <form id="newStopForm">
      <div class="modal-header">
        <h5 class="modal-title">Add Another stop</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <ul class="pl-2 pr-2">
          <li class="form-group col-12 col-md-12">
            <label class="col-form-sublabel text-dark font-weight-semibold d-block">New Stop</label>
            <div class="form-row">
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Type a location</label>
                <input type="text" name="route[0][itinerary_route_slot01_stop01_location][0]" class="form-control" placeholder="Type a location" id="add_stopLocation" required />
              </div>
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Time</label>
                <input type="text" name="route[0][itinerary_route_slot01_stop01_time][0]" class="form-control timepicker"  value="12:00 AM" placeholder="Time" id="add_stopTime" required/>
              </div>
              <div class="col-12 pt-4">
                <textarea name="route[0][itinerary_route_slot01_stop01_description][0]" class="form-control" placeholder="Add a description" id="add_stopDesc" required ></textarea>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="addOtherStop">Add</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- ADD MORE SLOT MODAL -->
<div class="modal fade" id="addSlotModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
	<form id="newSlotForm">
      <div class="modal-header">
        <h5 class="modal-title">Add New Slot</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <label class="col-form-sublabel text-dark font-weight-semibold d-block">Default Slot</label>
        <ul class="form-row">
          <li class="form-group col-12 col-md-12">
            <div class="form-row routeClass">
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Pick-Up Point</label>
                <input type="text" class="form-control ignore" name="itinerary_route_slot01_pickup[]" placeholder="Pick-up Point" id="add_new_pickpoint" data-toggle="modal" data-target="#getMapModal" required autocomplete="off" />
              </div>
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Start Time</label>
                <input type="text" class="form-control timepicker ignore" name="itinerary_route_slot01_pickup_time[]"  value="12:00 AM"   placeholder="Time" id="add_new_starttime" required autocomplete="off"/>
              </div>
			  <input type="hidden" name="pickup_coordinates[]" id="new_pickup_coordinates"/>
            </div>
          </li>
          <li class="form-group col-12 col-md-12">
            <div class="form-row">
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Drop-Off Point</label>
                <input type="text" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" 
				 name="itinerary_route_slot01_dropoff[]" placeholder="Pick-up Point" id="add_new_dropoint" required autocomplete="off"/>
              </div>
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">End Time</label>
                <input type="text" class="form-control timepicker ignore" name="itinerary_route_slot01_dropoff_time[]" value="12:00 AM"  placeholder="Time" id="add_new_endtime" required autocomplete="off"/>
              </div>
			  <input type="hidden" name="dropoff_coordinates[]" id="new_dropoff_coordinates"/>
            </div>
          </li>
          <li class="form-group col-12 col-md-12">
            <div class="form-row">
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Total Duration (hours)</label>
                <input type="text" class="form-control ignore hourpicker" name="itinerary_route_slot01_duration[]" value="0:00" placeholder="Total Duration" id="add_new_totalduration" required autocomplete="off"/>
              </div>
			  <div class="col-12 col-sm-6">
                <label class="col-form-sublabel ">Cut-off Time (hours)</label>
              <input type="text" class="form-control ignore cutoffpicker" name="itinerary_route_slot01_cutofftime[]"  value="0:00" placeholder="Cut-off Time" id="add_new_cutofftime" required autocomplete="off" />
              </div>
            </div>
          </li>		 
        </ul>
        <ul class="form-row">
          <li class="form-group col-12 col-md-12">
            <label class="col-form-sublabel text-dark font-weight-semibold d-block">Stop 1</label>
            <div class="form-row">
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Type a location</label>
                <input type="text" class="form-control ignore" name="route[0][itinerary_route_slot01_stop01_location][0]" placeholder="Type a location" id="add_new_typelocation" required autocomplete="off" />
              </div>
              <div class="col-12 col-sm-6">
                <label class="col-form-sublabel">Time</label>
                <input type="text" class="form-control timepicker ignore" name="route[0][itinerary_route_slot01_stop01_time][0]" placeholder="Time"  id="add_new_locationtime"	required autocomplete="off"/>
              </div>
              <div class="col-12 pt-4">
                <textarea class="form-control ignore" name="route[0][itinerary_route_slot01_stop01_description][0]" placeholder="Add a description" id="add_new_locdesc" required ></textarea>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="addNewSlot">Add</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<!-- MAP MODAL -->
<div class="modal fade " id="getMapModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Add Location on map </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="maplocationinfo">
          <div class="controls">
            <input id="coordinatesval" class="gfield" type="text" placeholder="Current coordinates" >
            <input id="searchTextField" class="gfield" type="text" placeholder="Enter a location" >
          </div>
          <div id="googleMap" class="mapBox"></div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary addBtn" id="addMap_value">Add</button>
      </div>
    </div>
  </div>
</div>

<!-- ADD MORE QUESTION MODAL -->
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="newQuestionForm">
        <div class="modal-header">
          <h5 class="modal-title">Add Another Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body">
          <ul class="pl-2 pr-2">
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Questions</label>
              <input type="text" class="form-control" placeholder="Questions" name="itinerary_faq_question_01[]" id="add_newQues" required/>
              <textarea class="form-control mt-4" placeholder="Answer (max 1000 characters)" name="itinerary_faq_answer_01[]" id="add_newAns"required data-rule-maxlength="1000"></textarea>
            </li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- SUBMIT FORM MODAL -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> <span class="modal-titleIcon"><img src="assets/img/icon/done.svg" alt="done" /></span> Thank You!</h5>
        <p class="font-weight-semibold text-center">Your registration is complete. Someone from our team will<br/>
          get in touch with you shortly.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- SAVE ALERT MODAL -->
<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Your itinerary has been saved successfully!</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- CANCEL ALERT MODAL -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Are you sure you would like to cancel creating this itinerary?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="cancleItinerary">Yes</button>
      </div>
    </div>
  </div>
</div>

<!-- ADD MORE ITEMS MODAL -->
<div class="modal fade" id="addItemsModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="addItemsForm">
        <div class="modal-header">
          <h5 class="modal-title">Add More Items</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body">
          <ul class="form-row pl-2 pr-2">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Item</label>
              <input id="newItemname" type="text" class="form-control" name="itinerary-additionalcost-description" placeholder="Item description" required>
            </li>
            <li class="form-group col-12  placeVaild">
              <label class="col-form-sublabel">Price</label>
              <input id="newItemprice"type="number" class="form-control" name="itinerary-additionalcost-amt" placeholder="Price" required>
            </li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- GUDIELINES MODAL -->
<div class="modal fade" id="tcModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Terms & Conditions </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
        <ul class="list-bullet">
		<?php 
			echo $legalData[0]->term_condition_itinerary;
			?>          
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- LEGAL MODAL -->
<div class="modal fade" id="readMoreModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleText"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">  
		<div class="legalText readMoreData pl-4 pr-4"></div>

      </div>	  
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- LOADER -->
<div class="loadingWrap">
  <div class="loadingText">Loading...</div>
</div>

<!-- SCRIPT -->
<?php require_once('main_footer.php');?>
<?php include('adminscript.php');?>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.js"></script> 
<script type="text/javascript">
// GOOGLE MAP 
var geocoder = new google.maps.Geocoder();

function geocodePosition(pos) {
    geocoder.geocode({
        latLng: pos
    }, function(responses) {
        if (responses && responses.length > 0) {
            var fullAddress = responses[0].formatted_address;
            var shortAddress = fullAddress.split(',').slice(0, -3).join(',');
            console.log(shortAddress);
            updateMarkerAddress(shortAddress);
        } else {
            updateMarkerAddress('Cannot determine address at this location.');
        }
    });
}

function updateMarkerPosition(latLng) {
    document.getElementById('coordinatesval').value = [
        latLng.lat(),
        latLng.lng()
    ].join(', ');
    console.log(latLng.lat(), latLng.lng());
}

function updateMarkerAddress(str) {
    document.getElementById('searchTextField').value = str;
}

function initialize() {

    var latLng = new google.maps.LatLng(28.612903658948674, 77.23139198046874);
    var map = new google.maps.Map(document.getElementById('googleMap'), {
        zoom: 12,
        center: latLng,
        disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: true,
        title: "You want a maker at this point"
    });

    var input = document.getElementById('searchTextField');
    var autocomplete = new google.maps.places.Autocomplete(input, {
        componentRestrictions: {
            country: 'in'
        }
    });

    autocomplete.bindTo('bounds', map);

    // Update current position info.
    updateMarkerPosition(latLng);

    // Add dragging event listeners.
    google.maps.event.addListener(marker, 'dragstart', function() {
        updateMarkerAddress('Dragging...');
    });

    google.maps.event.addListener(marker, 'drag', function() {
        updateMarkerPosition(marker.getPosition());
    });

    google.maps.event.addListener(marker, 'dragend', function() {
        map.setZoom(14);
        map.setCenter(marker.getPosition());
        geocodePosition(marker.getPosition());
    });

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        input.className = '';
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // Inform the user that the place was not found and return.
            input.className = 'notfound';
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(12);
        }
        marker.setPosition(place.geometry.location);
        updateMarkerPosition(marker.getPosition());

    });
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script> 
<script type="text/javascript">	
(function($) {
'use strict';

// ROBIN FUNCTION 
var draftUpdateMsg = '<?php if($this->session->flashdata('success')=='draftupdate') echo 'draftupdate';?>';
var draftInsertMsg = '<?php if($this->session->flashdata('success')=='draft') echo 'draft';?>';
var doneUpdate = '<?php if($this->session->flashdata('success')=='doneUpdate') echo 'doneUpdate';?>';
var doneInsert = '<?php if($this->session->flashdata('success')=='doneInsert') echo 'doneInsert';?>';

if (draftUpdateMsg !== '' && draftUpdateMsg != null) {
    $('#saveModal').modal('show');
} else if (draftInsertMsg !== '' && draftInsertMsg != null) {
    $('#saveModal').modal('show');
}

if (doneUpdate !== '' && doneUpdate != null) {
    $('#doneModal').modal('show');
} else if (doneInsert !== '' && doneInsert != null) {
    $('#doneModal').modal('show');
}

//LEFT MENU
$('.profilePage-links a[href*="#"]').on('click', function(e) {
    e.preventDefault();
    $(this).closest('.profilePage-links').find('.active').removeClass('active');
    $(this).closest('li').addClass('active');
    var $id = $(this).attr('href');
    var offset = $($id).offset();
    var $top = offset.top
    $('html, body').animate({
        scrollTop: $top - $('.profilePage-head').outerHeight() - 15
    }, 500);

});

// DISABLE NUMBER MOUSE WHEEL
 $(document).on('focus', 'input[type=number]', function (e) {
						$(this).on('mousewheel.disableScroll', function (e) {
								e.preventDefault()
						})
				});

 $(document).on('blur', 'input[type=number]', function (e) {
				$(this).off('mousewheel.disableScroll')
		});

// VALIDATE FORM ON LOAD 
var validator = $("#formItinerary").validate({
    errorElement: 'small',
    errorPlacement: function(error, element) {
        error.appendTo(element.closest(".placeVaild"));
    },
    submitHandler: function() {
        $('#formItinerary').attr('action', 'adminDoneWalkItinerary');
        $('#formItinerary').submit();
    }
});
	
	
// ADD & REMOVE FAQ QUESTIONS
		$("#newQuestionForm").validate({
						errorElement: 'small',
						submitHandler: function() {
										var addnewQues = $('#add_newQues').val();
										var addnewAns = $('#add_newAns').val();
										var data = $('<li class="form-group col-12"><div class="placeVaild"><label class="col-form-sublabel">Questions</label><input type="text" name="itinerary_faq_question_01[]" class="form-control ignore" placeholder="Questions" data-rule-required="true" value="' + addnewQues + '"/></div><div class="placeVaild"><textarea class="form-control mt-4 ignore" name="itinerary_faq_answer_01[]" placeholder="Answer (max 1000 characters)" data-rule-required="true" data-rule-maxlength="1000">' + addnewAns + '</textarea></div><a href="#" class="btn btn-link removeQuestion">Remove</a></li>');
										$("#addQuestionLink").parent().before(data);
										$('#addQuestionModal').modal('hide');
										$("#newQuestionForm")[0].reset();
						}
		});

$(document).on('click', '.removeQuestion', function(e) {
    e.preventDefault();
    $(this).closest('li').remove();
});

$(document).on('click', '.removeFaqli', function(e) {
    e.preventDefault();
    $(this).parent('li').remove();
});


$('#addQuestionModal').on('hidden.bs.modal', function(){
	$('#add_newQues, #add_newAns').val('');
});


// ADD & REMOVE STOP 
$("#newStopForm").validate({
		errorElement: 'small',
		submitHandler: function() {
		var add_stopLocation = $('#add_stopLocation').val();
		var add_stopTime = $('#add_stopTime').val();
		var add_stopDesc = $('#add_stopDesc').val();
		var slotLength = $('.slotClass').length;
		var data = $('<li class="form-group col-12 col-md-12"><label class="col-form-sublabel text-dark font-weight-semibold d-block">New Stop</label><div class="form-row slotClass"><div class="col-12 col-sm-6"><label class="col-form-sublabel">Type a location</label><input type="text" name="route[0][itinerary_route_slot01_stop01_location]['+slotLength+']" class="form-control" placeholder="Type a location" value="'+add_stopLocation+'"/></div><div class="col-12 col-sm-6"><label class="col-form-sublabel">Time</label><input type="text" name="route[0][itinerary_route_slot01_stop01_time]['+slotLength+']" class="form-control timepicker" placeholder="Time" value="'+add_stopTime+'"/></div><div class="col-12 pt-4"><textarea name="route[0][itinerary_route_slot01_stop01_description]['+slotLength+']" class="form-control" placeholder="Add a description" >'+add_stopDesc+'</textarea></div></div><a href="#" class="btn btn-link removeStop">Remove</a></li>');
			$("#addStopLink").parent().before(data);
			$('#addStopModal').modal('hide');
			$('.timepicker').timeEntry({
							ampmPrefix: ' '
			});
			$("#newStopForm")[0].reset();
		
			}
});
				
$(document).on('click', '.removeStop', function(e) {
   e.preventDefault();
	$(this).parent('li').remove();
});	

$('#addStopModal').on('hidden.bs.modal', function(){
   $('#add_stopLocation, #add_stopTime, #add_stopDesc').val('');

});

// ADD & REMOVE SLOT
$("#newSlotForm").validate({
		errorElement: 'small',
		submitHandler: function() {
			var add_new_pickpoint = $('#add_new_pickpoint').val();
			var add_new_starttime = $('#add_new_starttime').val();
			var add_new_dropoint = $('#add_new_dropoint').val();
			var add_new_endtime = $('#add_new_endtime').val();
			var add_new_totalduration = $('#add_new_totalduration').val();
			var add_new_typelocation = $('#add_new_typelocation').val();
			var add_new_locationtime = $('#add_new_locationtime').val();
			var add_new_locdesc = $('#add_new_locdesc').val();
			var add_new_cutoffTime = $('#add_new_cutofftime').val();
			var new_pickup_coordinates = $('#new_pickup_coordinates').val();
			var new_dropoff_coordinates = $('#new_dropoff_coordinates').val();
			var routeLength = $('.routeClass').length;
			var data = $('<label class="col-form-sublabel text-dark font-weight-semibold d-block">Next Slot</label><li class="form-group removelist col-12 col-md-12"><div class="form-row routeClass"><div class="col-12 col-sm-6"><label class="col-form-sublabel">Pick-Up Point</label><input type="text" name="itinerary_route_slot01_pickup[]" class="form-control" data-toggle="modal" data-target="#getMapModal" placeholder="Pick-up Point" id="pickup_point" autocomplete="off" value="'+add_new_pickpoint+'"required /></div><div class="col-12 col-sm-6"><label class="col-form-sublabel">Start Time</label><input type="text" name="itinerary_route_slot01_pickup_time[]" class="form-control timepicker" placeholder="Time" id="pickup_time" value="'+add_new_starttime+'"required /></div><input type="hidden" name="pickup_coordinates[]" value="'+new_pickup_coordinates+'"/></div></li><li class="form-group removelist col-12 col-md-12"><div class="form-row"><div class="col-12 col-sm-6"><label class="col-form-sublabel">Drop-Off Point</label><input type="text" name="itinerary_route_slot01_dropoff[]" class="form-control" data-toggle="modal" data-target="#getMapModal" placeholder="Drop-Off Point" id="dropoff_point" autocomplete="off" value="'+add_new_dropoint+'"required /></div><div class="col-12 col-sm-6">  <label class="col-form-sublabel">End Time</label><input type="text" name="itinerary_route_slot01_dropoff_time[]" class="form-control timepicker" placeholder="Time" id="dropend_time" value="'+add_new_endtime+'"required /></div><input type="hidden" name="dropoff_coordinates[]" value="'+new_dropoff_coordinates+'"/></div></li><li class="form-group removelist col-12 col-md-12"><div class="form-row"><div class="col-12 col-sm-6"><label class="col-form-sublabel">Total Duration</label><input type="text" name="itinerary_route_slot01_duration[]" class="form-control hourpicker" placeholder="Total Duration" id="route_slot01_duration" value="'+add_new_totalduration+'" required /></div><div class="col-12 col-sm-6"><label class="col-form-sublabel">Cut-off Time</label><input type="text" name="itinerary_route_slot01_cutofftime[]" class="form-control cutoffpicker" placeholder="Cut-off Time" id="route_slot01_cutofftime" value="'+add_new_cutoffTime+'" required /></div></div></li> <li class="form-group removelist col-12 col-md-12"><label class="col-form-sublabel text-dark font-weight-semibold d-block">Stop 1</label><div class="form-row"><div class="col-12 col-sm-6"> <label class="col-form-sublabel">Type a location</label><input type="text" name="route['+routeLength+'][itinerary_route_slot01_stop01_location][0]" class="form-control" placeholder="Type a location" id="route_slot01_stop01_location"  value="'+add_new_typelocation+'" required /></div><div class="col-12 col-sm-6"><label class="col-form-sublabel">Time</label><input type="text" name="route['+routeLength+'][itinerary_route_slot01_stop01_time][0]" class="form-control timepicker" placeholder="Time" id="route_slot01_stop01_time" value="'+add_new_locationtime+'" required /></div><div class="col-12 pt-4"><textarea class="form-control" name="route['+routeLength+'][itinerary_route_slot01_stop01_description][0]" placeholder="Add a description" id="route_slot01_stop01_description" required >'+add_new_locdesc+'</textarea></div></div><a href="#" class="btn btn-link removeSlot">Remove</a></li>');
			$("#addSlotLink").parent().before(data);
			$('#addSlotModal').modal('hide');
			$('.timepicker').timeEntry({
					ampmPrefix: ' '
			});
		$("#newSlotForm")[0].reset();

		}
});

$(document).on('click', '.removeSlot', function(e) {
   e.preventDefault();
			$('.removelist').remove();
});	

$('#addSlotModal').on('hidden.bs.modal', function(){
  $('#add_new_pickpoint').val('');
  $('#add_new_starttime').val('');
  $('#add_new_dropoint').val('');
  $('#add_new_endtime').val('');
  $('#add_new_totalduration').val('');
  $('#add_new_typelocation').val('');
  $('#add_new_locationtime').val('');
  $('#add_new_locdesc').val('');
});

				  // UPLOAD FILES FUNCTION
		  var _URL = window.URL || window.webkitURL;
		  $(document).on('change', '.uploadDoc', function(e) {
		      var $this = $(this);
		      var $box = $this.parent();
		      var $boxicon = $box.find('.dragImageBox-icon');
		      var $boxinfo = $box.find('.dragImageBox-info');
		      var $fileinfo = $box.find('.infoShow');
			  var $nextInput = $this.next('.lowKey');
			  var $nextInputID = $nextInput.attr('id');

			  
		      var $nameText = $fileinfo.find('p');
		      var $sizeText = $fileinfo.find('small');
		      var $spanText = $boxinfo.find('span');
		      var $thisID = $(this).attr('id');
		      var $width = $this.attr('data-width');
		      var $height = $this.attr('data-height');
		      var $size = $this.attr('data-size');

		      var file, img;

		      if ((file = this.files[0])) {
		          var $imgName = this.files[0].name
		          var $imgSize = this.files[0].size
		          if ($(this).hasClass('imgInput')) {
		              var $imgError = $nextInput.attr('data-msg-required', 'Upload image dimensions ' + $width + ' x ' + $height + 'pixels & size of file should be below 5mb');
		              $imgError
		              var img = new Image();
		              var $imgKB = Math.round($imgSize / 1024)
		              img.onload = function() {
		                  console.log('------- FILE ----------')
		                  console.log('SIZE: ' + $imgKB)
		                  console.log('Width: ' + this.width)
		                  console.log('Height: ' + this.width)
		                  console.log('-----------------')

		                  if (this.width < $width || this.height < $height || $imgKB > $size) {
		                      $this.val('');
		                      $boxinfo.show();
		                      $fileinfo.hide();
							  $nextInput.val('');
		                      console.log('FILE AND SIZE ERROR')
		                      validator.element('#' + $nextInputID);
		                  } else {
		                      $nameText.html($imgName);
		                      $sizeText.html(+$imgKB + ' kb');
		                      $box.addClass('active');
		                      $boxinfo.hide();
		                      $fileinfo.show();
							  $nextInput.val($imgName);
		                      validator.element('#' + $nextInputID);
		                  }
		              };
		              var fileExtension = ['jpeg', 'jpg'];
		              if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		                  console.log('FILE TYPE ERROR: ' + file.type)
		                  $this.val('');
		                  $boxinfo.show();
		                  $fileinfo.hide();
						  $nextInput.val('');
		                  validator.element('#' + $nextInputID);
		                  return false;
		              }
		              img.src = _URL.createObjectURL(file);
		          };

		          if ($(this).hasClass('vidInput')) {
		              var fileExtension = ['mp4'];
					  var $imgKB = Math.round($imgSize / 1024);

		              if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
		                  var $vidError = $nextInput.attr('data-msg-required', 'Please upload file in video(.mp4) format only');
		                  $vidError
		                  console.log('FILE(VIDEO) TYPE ERROR: ' + file.type)
		                  $this.val('');
		                  $boxinfo.show();
		                  $fileinfo.hide();
			  		      $nextInput.val('');
		                  validator.element('#' + $nextInputID);
		              } else {
		                   var $vidError = $nextInput.attr('data-msg-required', 'Upload video size of file should be below 10mb');
		                  $vidError
		                  if ($imgKB > $size) {
		                      console.log('SIZE ERROR: ' + file.type)
		                      $this.val('');
		                      $boxinfo.show();
		                      $fileinfo.hide();
							  $nextInput.val('');
		                      validator.element('#' + $nextInputID);
		                  } else {
		                      $nameText.html($imgName);
		                      $sizeText.html(+$imgKB + ' kb');
		                      $box.addClass('active');
		                      $boxinfo.hide();
		                      $fileinfo.show();
							  $nextInput.val($imgName);
		                      validator.element('#' + $nextInputID);
		                  }
		              }
		              file.src = _URL.createObjectURL(file);
		          };
		      }
		  });

		  // CLEAR FILES FUNCTION
		  $(document).on('click', '.clearDargbox', function(e) {
		      e.preventDefault();
		      var $this = $(this);
		      var $box = $this.parents('.dragImageBox');
		      var $fileinfo = $box.find('.infoShow');
		      var $boxinfo = $box.find('.dragImageBox-info');
		      var $nextInput = $box.find('.lowKey');
		      $fileinfo.hide();
		      $boxinfo.show();
		      $box.removeClass('active');
		      $box.find('.uploadDoc').val('');
		      $nextInput.val('');
		  });

		  // TIME & HOUR PICKER
		  $('.timepicker').timeEntry({
		      ampmPrefix: ' ',
			  useMouseWheel: false,
			  spinnerImage: ''
		  });

		  $('.hourpicker').timeEntry({
			show24Hours: true,
			spinnerImage: '',
			minTime: '00:00',
			timeSteps: [1, 15, 0]

			});
	
		$('.cutoffpicker').timeEntry({
			show24Hours: true,
			spinnerImage: '',
			minTime: '00:00',
			maxTime: '03:00',
			timeSteps: [1, 30, 0]
			});


// THEME AUTOCOMPLETE
/*var msTheme = $('#typeThemes').magicSuggest({
	placeholder: 'Select themes',
	useCommaKey: true,
	maxSelection: 5,
	allowFreeEntries: false,
	data:[<?php echo $themesResult;?>]
});

$(msTheme).on('selectionchange', function(e, cb, s) {
    var checkVal = msTheme.getValue()
    if (checkVal == "") {
        $('#typeThemesCheckbox').prop('checked', false);
    } else {
        $('#typeThemesCheckbox').prop('checked', true);
    }
});
			
msTheme.setValue([<?php if(isset($themesSelected))echo $themesSelected;?>]);*/

// THEME AUTOCOMPLETE
$("#typeThemes").select2({
    placeholder: 'Select themes',
    tokenSeparators: [',', ' ']
});

// HIGHLIGHT AUTOCOMPLETE
/*var msHighlights = $('#typeHighlights').magicSuggest({
	placeholder: 'Select Highlights',
	useCommaKey: true,
	allowFreeEntries: true,
	maxSelection: 15,
   data: ['Rafting ', 'Safari', 'Bungee Jumping', 'Kayaking', 'Biking', 'Skiing', 'Scuba diving', 'Surfing']  
});

$(msHighlights).on('selectionchange', function(e, cb, s) {
    var checkVal = msHighlights.getValue()
    if (checkVal == "") {
        $('#typeHighlightsCheckbox').prop('checked', false);

    } else {
        $('#typeHighlightsCheckbox').prop('checked', true);

    }
});

 msHighlights.setValue(<?php echo $highLightData;?>);*/
 
$("#typeHighlights").select2({
    placeholder: 'Select highlight',
    tags: true,
    tokenSeparators: [',', ' ']
});

// FEATURE AUTOCOMPLETE
/*var feature = $('#typeFeatures').magicSuggest({
	placeholder: 'Select Features',
	maxSelection: 10,
	data:[<?php echo $result;?>]
});

	$(feature).on('selectionchange', function(e, cb, s) {
		var checkVal = feature.getValue()
							if (checkVal == "") {
											$('#typeFeaturesCheckbox').prop('checked', false);
							} else {
											$('#typeFeaturesCheckbox').prop('checked', true);
							}
			});

 feature.setValue([<?php echo $featurestags;?>]);

$(feature).on('selectionchange', function(){
  var ArrData = JSON.parse(JSON.stringify(this.getValue()));
			for(var i = 0; i < ArrData.length; i++){  
				var id = ArrData[i];  
				$.ajax({
						type:'post',
						url:'<?php echo base_url()?>/Itineraries/getFeatureTags',
						data:{id:id},
						success:function(html){
							console.log(html);
							}
					});
		}
			
});*/

$("#typeFeatures").select2({
    placeholder: 'Select features',
    tokenSeparators: [',', ' ']
});

// SEARCH AUTOCOMPLETE
$("#typeSearchTags").select2({
    placeholder: 'Select search tags',
    tags: true,
    tokenSeparators: [',', ' ']
});

// LANGUAGE AUTOCOMPLETE
/*var lang = $('#typeLanguages').magicSuggest({
	placeholder: 'Search Tags',
	allowFreeEntries: false,
	data: <?php echo $langArr;?>
});

$(lang).on('selectionchange', function(e, cb, s) {
    var checkVal = lang.getValue()
    if (checkVal == "") {
        $('#typeLanguagesCheckbox').prop('checked', false);
    } else {
        $('#typeLanguagesCheckbox').prop('checked', true);
    }
});

lang.setValue(<?php echo $langdata;?>);*/

$("#typeLanguages").select2({
    placeholder: 'Select language',
    //tags: true,
    tokenSeparators: [',', ' ']
});

// LIMITED SERVICE SELECT
var selectlimit = 2;
$(document).on('change', '.limitSelect', function(e) {
   if($(this).parent().parent().parent().siblings().find(':checked').length >= selectlimit) {
       this.checked = false;
   }
});	

    $(document).on('change', '.tagBox input', function() {
        if ($(this).prop('checked') == true) {
            $(this).parent().addClass('active');
        } else {
            $(this).parent().removeClass('active');
        }
    });


// START & END DATE PICKER
var dateTime = new Date();
dateTime = moment(dateTime).format('DD-MM-YYYY');
$('#endDateInput').attr('data-date', dateTime);

$('#startDateInput').dateRangePicker({
   format: 'DD-MM-YYYY',
   autoClose: true,
   singleDate: true,
   showTopbar: false,
   singleMonth: true,
   selectForward: true,
   setValue: function(s) {
       if (!$(this).attr('readonly') && !$(this).is(':disabled') && s != $(this).val()) {
           $(this).val(s);
           $('#endDateInput').attr('data-date', s).val('');
       }
   },
   startDate: dateTime
}).bind('datepicker-change', function(evt, obj) {
   $('#selectDateInput').val('').datepicker("update");;
     $('#selectDateInput').datepicker('setStartDate', $('#startDateInput').val());

});


$(document).on('focus', '#endDateInput', function(e) {
   var defaultDate = $(this).val();
   var startDate = $(this).attr('data-date');
   if (startDate == '') {
       var startDate = $(this).attr('data-date', dateTime);
   } else {
       var startDate = $(this).attr('data-date');
   }
   $(this).dateRangePicker({
       format: 'DD-MM-YYYY',
       autoClose: true,
       singleDate: true,
       showTopbar: false,
       singleMonth: true,
       selectBackward: true,
       startDate: startDate,
   }).bind('datepicker-change', function(evt, obj) {
       $('#selectDateInput').val('').datepicker("update");
     $('#selectDateInput').datepicker('setEndDate', $('#endDateInput').val());

   });
});

$('#selectDateInput').datepicker({
   format: 'dd-mm-yyyy',
   multidate: true,
   multidateSeparator: ", ",
});

// PICK UP & DROP MAP VALUE
$('#pickup_point').on('click', function() {
    $('#getMapModal').find('.addBtn').attr('data-id', $(this).attr('id'));
});

$('#dropoff_point').on('focus', function() {
    $('#getMapModal').find('.addBtn').attr('data-id', $(this).attr('id'));
});

$('#add_new_pickpoint').on('focus', function() {
    $('#getMapModal').find('.addBtn').attr('data-id', $(this).attr('id'));
});

$('#add_new_dropoint').on('focus', function() {
    $('#getMapModal').find('.addBtn').attr('data-id', $(this).attr('id'));
});

$(document).on('click', '[data-id="pickup_point"]', function() {
    var searchTextField = $('#searchTextField').val();
    $('#pickup_point').val(searchTextField);
	var coordinatesval = $('#coordinatesval').val(); // get latitude and longitude value
	$('#pickup_coordinates').val(coordinatesval);
    $('#getMapModal').modal('hide');
});

$(document).on('click', '[data-id="dropoff_point"]', function() {
    var searchTextField = $('#searchTextField').val();
    $('#dropoff_point').val(searchTextField);
	var coordinatesval = $('#coordinatesval').val(); // get latitude and longitude value
	$('#dropoff_coordinates').val(coordinatesval);
    $('#getMapModal').modal('hide');
});

$(document).on('click', '[data-id="add_new_pickpoint"]', function() {
    var searchTextField = $('#searchTextField').val();
    $('#add_new_pickpoint').val(searchTextField);
	var coordinatesval = $('#coordinatesval').val(); // get latitude and longitude value	
	$('#new_pickup_coordinates').val(coordinatesval);
    $('#getMapModal').modal('hide');
});

$(document).on('click', '[data-id="add_new_dropoint"]', function() {
    var searchTextField = $('#searchTextField').val();
    $('#add_new_dropoint').val(searchTextField);
	var coordinatesval = $('#coordinatesval').val(); // get latitude and longitude value	
	$('#new_dropoff_coordinates').val(coordinatesval);
    $('#getMapModal').modal('hide');
});

$('#getMapModal').on('hide.bs.modal', function(e) {
    $('#coordinatesval, #searchTextField').val('')
});

// SELECT FREQUENCT 
$('#service_frequency').change(function() {
    if ($(this).val() == 'weekly') {
        $('#weeklyDays').show();
        $('#dailyDays').hide();
        $('#weeklyDays').find('input[type="checkbox"]').prop('checked', false);
        $('#weeklyDays').find('.dayBox').removeClass('active');
    } else {
        $('#weeklyDays').hide();
        $('#dailyDays').show();
        $('#dailyDays').find('input[type="checkbox"]').prop('checked', false);
        $('#dailyDays').find('.dayBox').removeClass('active');
    }
});

$('#service_frequency').each(function() {
    if ($(this).val() == 'weekly') {
        $('#weeklyDays').show();
        $('#dailyDays').hide();
    } else {
        $('#weeklyDays').hide();
        $('#dailyDays').show();
    }
});


// ACTIVE DAYS CHECKBOX
$('.dayBox input').each( function() {
    if ($(this).prop('checked') == true) {
        $(this).parent().addClass('active');
    } else {
        $(this).parent().removeClass('active');
    }
});

$(document).on('change', '.dayBox input', function() {
    if ($(this).prop('checked') == true) {
        $(this).parent().addClass('active');
    } else {
        $(this).parent().removeClass('active');
    }
});


// TRAVELLER TYPE
	$('#travellerType-private').bind("change", function() {
						if ($(this).is(":checked")) {
										$('[data-rel="privateCheck"]').show();
										$(this).closest('.form-row').find('input[type="number"]').removeAttr('disabled');
						} else {
										$('[data-rel="privateCheck"]').hide();
										$(this).closest('.form-row').find('input[type="number"]').attr('disabled', 'disabled');
						}
		}).trigger('change');
		
		
		$('#travellerType-group').bind("change", function() {
						if ($(this).is(":checked")) {
										$('[data-rel="groupCheck"]').show();
										$(this).closest('.form-row').find('input[type="number"]').removeAttr('disabled');
						} else {
										$('[data-rel="groupCheck"]').hide();
										$(this).closest('.form-row').find('input[type="number"]').attr('disabled', 'disabled');
						}
		}).trigger('change');
		
		
		$('#travellerType-family').bind("change", function() {
						var $this = $(this);
						var $row = $this.closest('.form-row');
						var $parent = $row.parent();
						var $parentNext = $parent.nextAll();
		
						if ($this.is(':checked')) {
										$('[data-rel="familyCheck"]').show();
										$row.find('.disabledDad').removeAttr('disabled');
										$parentNext.find('.disabledDad').removeAttr('disabled');
										$parentNext.find(':checked').removeAttr('disabled').attr('readonly', 'readonly');
										$parentNext.find('.defaultActive').removeAttr('disabled');
										$('[data-id="familyKidCheck-01"]').find(".priceKid").removeAttr("disabled");
						} else {
										$('[data-rel="familyCheck"]').hide();
										$row.find('.disabledDad').attr('disabled', 'disabled');
										$parentNext.find('.disabledDad').attr('disabled', 'disabled');
										$parentNext.find(':checked').removeAttr('readonly').attr('disabled', 'disabled');;
										$parentNext.find('.defaultActive').attr('disabled', 'disabled');
										$('[data-id="familyKidCheck-01"]').find(".priceKid").attr("disabled", "disabled");
						}
		}).trigger('change');
		
		
		$('#travellerType-kids-below10').bind("change", function() {
						if ($(this).is(':checked') && !$(this).is(':disabled')) {
										$('[data-id="familyKidCheck-01"]').find(".priceKid").removeAttr("disabled");
										$(this).closest('.form-row').find('.disabledPaa').removeAttr("disabled");
		
						} else {
										$('[data-id="familyKidCheck-01"]').find(".priceKid").attr("disabled", "disabled");
										$(this).closest('.form-row').find('.disabledPaa').attr('disabled', 'disabled');
						}
		
		}).trigger('change');
		
		
		$('#travellerType-kids-below7').bind("change", function() {
						if ($(this).is(':checked')) {
										$('[data-id="familyKidCheck-02"]').find(".priceKid").removeAttr("disabled");
										$(this).closest('.form-row').find('.disabledPaa').removeAttr("disabled");
						} else {
										$('[data-id="familyKidCheck-02"]').find(".priceKid").attr("disabled", "disabled");
										$(this).closest('.form-row').find('.disabledPaa').attr('disabled', 'disabled');
						}
		
		}).trigger('change');
		
		
		$('#travellerType-kids-below5').bind("change", function() {
						if ($(this).is(':checked')) {
										$('[data-id="familyKidCheck-03"]').find(".priceKid").removeAttr("disabled");
										$(this).closest('.form-row').find('.disabledPaa').removeAttr("disabled");
						} else {
										$('[data-id="familyKidCheck-03"]').find(".priceKid").attr("disabled", "disabled");
										$(this).closest('.form-row').find('.disabledPaa').attr('disabled', 'disabled');
						}
		
		}).trigger('change');
		
// KEEP CHECK KIDS 
$(document).on('change', '.keepCheck', function() {
    var numberOfChecked = $('.keepCheck:checkbox:checked').length;
    if (numberOfChecked <= 1) {
        $('.keepCheck:checked').attr('disabled', 'disabled');
    } else {
        $('.keepCheck:checked').removeAttr('disabled');
    }

});		
		

/** SAHIL **/
$('#travellerType-group').change(function() {
    if ($(this).is(':checked')) {
        $("#travellerType-private").data("rule-required", false);
        $("#itinerary_traveller_private-error").css("display", "none");
    } else {
        $("#travellerType-private").data("rule-required", true);
        $("#itinerary_traveller_private-error").css("display", "block");
    }
});

$('#travellerType-family').change(function() {
    if ($(this).is(':checked')) {
        $("#travellerType-private").data("rule-required", false);
        $("#itinerary_traveller_private-error").css("display", "none");
     } else {
        $("#travellerType-private").data("rule-required", true);
        $("#itinerary_traveller_private-error").css("display", "block");
     }
});



// ADD & REMOVE SPONSOR IMAGE
$('#addSponsor').on('click',function(){
 var data = $('<li class="form-group col-12 placeVaild"><label class="dragImageBox"><input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_sponsor_image_cover[]" id="add_sponsor-02" accept="image/jpg, image/jpeg" data-height="127" data-width="400" data-size="5120" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only"  /><input type="text" id="add_sponsor-02_check"  class="form-control lowKey ignore" name="itinerary_sponsor_hide_image_cover[]" data-rule-required="false"/><div class="dragImageBox-info"><div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div><p>Add a Sponsor Image</p><span>Drag file here or click to upload</span> </div><div class="infoShow"><p class="text-primary">File Name</p><small class="text-muted">000 KB</small></div></label><a href="javascript:void(0);" class="text-light text-uppercase clearSponsor">Remove</a></li>');	
 $("#addSponsor").parent().before(data);
 $("#addSponsor").parent().hide();
});

$(document).on('click', '.clearSponsor', function(e) {
    e.preventDefault();
    $(this).parent().remove();
    $('.clearSponsor').remove();
    $("#addSponsor").parent().show();
});


// ADD & REMOVE ITEM
				$("#addItemsForm").validate({
								errorElement: 'small',
								errorPlacement: function(error, element) {
												error.appendTo(element.closest(".placeVaild"));
								},
								submitHandler: function() {
												var newItname = $('#newItemname').val();
												var newItprice = $('#newItemprice').val();
												var data = $('<li class="form-row"> <div class="form-group col-12 col-md-6 placeVaild"> <label class="col-form-sublabel">Item</label> <input type="text" class="form-control" name="itinerary_additionalcost_description[]" placeholder="Item description"  value="' + newItname + '" data-rule-required="false"> </div> <div class="form-group col-12 col-md-6 placeVaild"> <label class="col-form-sublabel">Price</label> <input type="text" class="form-control" name="itinerary_additionalcost_amt[]" value="' + newItprice + '" placeholder="Price" data-rule-required="false"> </div> <div class="form-group col-12 "><a href="#" class="btn btn-link removeItems pt-0">Remove</a></div> </li>');
												$("#addItemLink").parent().before(data);
												$('#addItemsModal').modal('hide');
												$("#addItemsForm")[0].reset();
								}
				});
				
$(document).on('click', '.removeItems', function(e) {
    e.preventDefault();
    $(this).parent().parent('li').remove();    
});				


// CANCEL MODAL ITINERARY
$('#cancleItinerary').on('click',function(){
	var userid = '<?php echo $hostId?>';
	var proceed = true;
	
	if(userid==''){
		proceed = false;
		return false;
		}
	if(proceed){
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>Itineraries/changeLoginStatus',
			 data:{userid:userid},
			 success:function(html){
			  if(html=='success')
				 window.location.href = '<?php echo base_url();?>host';
				 }
			});
		}	
	
});

// SAVE AS DRAFT FORM FUNCTION
$(document).on('click', '#formSave', function(e) {
    var proceed = true;
    validator.destroy();
    $('#formItinerary').attr('action', 'saveItinerary');
    $('.loadingWrap').show();
    $("#formItinerary").validate({
        errorElement: 'small',
        errorPlacement: function(error, element) {
            error.appendTo(element.closest(".placeVaild"));
        },
        ignore: ".ignore",
        rules: {
            category: "required",
            type_category: "required",
            originCity: "required",
            origin_otherCity: "required",
            itinerary_title: "required",
            itinerary_other_title: "required",
            itinerary_tagline: "required",
            other_tag_line: "required",
            itinerary_description: "required",
            other_itinerary_description: "required"
        },
        invalidHandler: function() {
            $('.loadingWrap').hide();
        },
        submitHandler: function(e) {
            e.preventDefault();
            $("#formItinerary").submit();
        }
    });
    $("#saveForm").trigger("click");
});


// SUBMIT FORM FUNCTION
$(document).on('click', '#callDone', function(e) {
    e.preventDefault();
		if ($('#travellerType-private').is(':checked') || $('#travellerType-group').is(':checked') || $('#travellerType-family').is(':checked')) {
		   $("#travellerType-private").data("rule-required", false);		         
	} else {
	      $("#travellerType-private").data("rule-required", true);		          
	  }
				
    validator.destroy();
    $('#formItinerary').attr('action', 'adminDoneWalkItinerary');
    $('.loadingWrap').show();
    $("#formItinerary").validate({
        errorElement: 'small',
        errorPlacement: function(error, element) {
            error.appendTo(element.closest(".placeVaild"));
        },
        invalidHandler: function() {
            $('.loadingWrap').hide();
        },
        submitHandler: function(e) {
            e.preventDefault();
            $('#formItinerary').submit();
        }
    });
				
    $('#doneForm').trigger('click');
});


// CHANGE SEND TO TRANSLATOR
$('[name="send_to_translator"]').bind("change", function() {
    var $this = $(this);
    var $val = $this.val();
    if ($val == 0) {
        console.log("NO");
        $('[name="type_category"], [name="origin_otherCity"], [name="itinerary_other_title"], [name="other_tag_line"], [name="other_itinerary_description"]').removeClass('ignore').attr('required', 'required');
        validator.resetForm();
    } else {
        console.log("YES");
        $('[name="type_category"], [name="origin_otherCity"], [name="itinerary_other_title"], [name="other_tag_line"], [name="other_itinerary_description"]').addClass('ignore').removeAttr('required');
        validator.resetForm();
    }
 }).trigger('change');

 //============ Read More popup Js ==========//
$(document).on('click','.read_popup',function(){	
  var popupText = $(this).data('ref');  
  var cancelHostText = '<?php echo $legalData[0]->cancel_donebyhost?>';
  var cancelTravellerText = '<?php echo $legalData[0]->cancel_donebytraveller?>';
  var cancelRefundText = '<?php echo $legalData[0]->cancel_refund?>';
  var liabilityDiscText = '<?php echo $legalData[0]->liability_diclaimer?>';
  var privacyPolicyText = '<?php echo $legalData[0]->privacy_policy?>';
  var termConditionText = '<?php echo $legalData[0]->terms_condition?>';
  var mediaInfringText = '<?php echo $legalData[0]->media_infringement?>';
  
  if(popupText=='done_host'){
      $('#titleText').html('CANCELLATIONS');
	  $('.readMoreData').html(cancelHostText);
	  $('#readMoreModal').modal('show');
	  }
  if(popupText=='done_traveller'){
      $('#titleText').html('CANCELLATIONS');
	  $('.readMoreData').html(cancelTravellerText);
	  $('#readMoreModal').modal('show');
	  }
 if(popupText=='done_refund'){
      $('#titleText').html('CANCELLATIONS');
	  $('.readMoreData').html(cancelRefundText);
	  $('#readMoreModal').modal('show');
	  }
if(popupText=='liability_diclaimer'){
	  $('#titleText').html('LIABILITIES & DISCLAIMERS');
	  $('.readMoreData').html(liabilityDiscText);
	  $('#readMoreModal').modal('show');
	  }	  
if(popupText=='privacy_policy'){
	  $('#titleText').html('PRIVACY POLICY');
	  $('.readMoreData').html(privacyPolicyText);
	  $('#readMoreModal').modal('show');
	  }	  
if(popupText=='term_condition'){
	  $('#titleText').html('TERMS & CONDITIONS');
	  $('.readMoreData').html(termConditionText);
	  $('#readMoreModal').modal('show');
	  }	
if(popupText=='media_infri'){
	  $('#titleText').html('MEDIA INFRINGEMENT');
	  $('.readMoreData').html(mediaInfringText);
	  $('#readMoreModal').modal('show');
	  }	  
});

$('#selectOffDates').bind("change", function() {
      if ($(this).val() == 'regular') {
        $('.offDates').hide();
      }
      else {
        $('.offDates').show();
      }
    }
    ).trigger('change');
	
   	
})(jQuery);
</script> 
<?php require_once('footer.php');?>
