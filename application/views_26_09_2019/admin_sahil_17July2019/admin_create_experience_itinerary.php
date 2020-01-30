<?php 
	require_once('header.php');
	$uri = $this->uri->segment(2);
	$ses = $this->session->userdata('adminSes');	
?>
<div class="profilePage">
  <div class="profilePage-head clearfix">
    <h1 class="cmyLogo float-left"><img src="<?php echo base_url();?>assets/img/iwl_hr_white_logo.svg" alt="India with locals" /></h1>
    <div class="float-right floatBtn"> <a href="my_itineraries.html" class="btn btn-link mr-3 text-default" data-toggle="modal" data-target="#rejectModal">cancel</a> 
	    <!--<a id="saveCall" href="#" class="btn btn-secondary mr-3">Draft</a>-->
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
        <li><a href="#fillConfirmation">Confirmation & Review</a></li>
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
      <form id="formItinerary" method="post" enctype="multipart/form-data">
       <input type="hidden" name="service_id" id="service_id" value="<?php echo $service_id;?>"/>
		<input type="hidden" name="selLang" id="select_lang" value="<?php echo $selectOtherLang;?>"/>
		<input type="hidden" name="hostId" id="host_id" value="<?php echo $hostId;?>"/>
        <fieldset id="filldetail">
		<?php if($selectOtherLang!=='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
		<div class="alert alert-light text-center sendTo">
            <p class="font-weight-bold pl-3 pr-3 pt-2 pb-2">Would you like to share this with a translator?
       	  <select class="form-control d-inline-block font-weight-bold" name="send_to_translator" data-rule-required="true">
           <option value="0" <?php echo(@$draftData->translator==0)?'selected="selected"':'';?>>No, I will do it myself</option>	
           <option value="1" <?php echo(@$draftData->translator==1)?'selected="selected"':'';?>>Yes, Send for translation</option>
           </select>
            </p>
          </div>
		<?php } ?>
		  
          <h3 id="fillDetails" class="col-form-label">Details</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select Category</label>
              <select id="categoryName" class="form-control" name="category" data-rule-required="true" required>
                <option value="">Select</option>
				<?php 
					foreach($allCategory as $cateList):
					?>
                <option value="<?php echo $cateList->id;?>" <?php echo @$draftData->itinerary_category==$cateList->id?'selected="selected"':'';?>><?php echo $cateList->category_name;?></option>
               <?php endforeach;?>
              </select>
            </li>
            <?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
			     <li class="form-group col-12 col-md-6 placeVaild">
               <label class="col-form-sublabel">Type Category (<?php echo $selectOtherLang;?>)</label>
               <input type="text" class="form-control" id="type_category" name="type_category" 
			    value="<?php if(isset($draftData->other_category_type))echo $draftData->other_category_type;?>" required data-rule-required="true"/>
			  <div id="typecateError" class="error errorOwn"></div>
               </li>
				<?php }	?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select My City</label>
              <select id="originCity" class="form-control" name="originCity" data-rule-required="true" required>
                <?php 
				  foreach($userCity as $city):
				   $cityArr = explode(',',$city->preferred_cities);
				   foreach($cityArr as $value):				   
				  ?>              
				<option value="<?php echo $value;?>" <?php echo (@$draftData->origin_city==$value?'selected="selected"':'');?> > <?php echo $value;?> </option>
                <?php endforeach;endforeach;?>
              </select>
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select My City (<?php echo $selectOtherLang;?>)</label>
              <input id="origin_otherCity" type="text" class="form-control" name="origin_otherCity" value="<?php if(isset($draftData->origin_other_city)) echo $draftData->origin_other_city;?>" data-rule-required="true" required/>
            </li>
			<?php } ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Experience Title</label>
              <input id="itinerary_title" type="text" class="form-control" name="itinerary_title" placeholder="Itinerary Title" data-rule-required="true" value="<?php if(isset($draftData->itinerary_title))echo $draftData->itinerary_title;?>" required />
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Experience Title (<?php echo $selectOtherLang;?>)</label>
              <input id="itinerary_other_title" type="text" class="form-control" name="itinerary_other_title" value="<?php if(isset($draftData->itinerary_other_title))echo $draftData->itinerary_other_title;?>" data-rule-required="true" required/>
            </li>
			<?php } ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Tag Line</label>
              <input id="itinerary_tagline" type="text" class="form-control" name="itinerary_tagline" placeholder="Tag Line" 
			  value="<?php if(isset($draftData->itinerary_tagline))echo $draftData->itinerary_tagline;?>" data-rule-required="true" required/>
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Tag Line (<?php echo $selectOtherLang;?>)</label>
              <input id="other_tag_line" type="text" class="form-control" name="other_tag_line"  value="<?php if(isset($draftData->itinerary_other_tagline))echo $draftData->itinerary_other_tagline;?>" data-rule-required="true" required/>
            </li>
			<?php } ?>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label text-light">What to Expect</label>
              <textarea id="itinerary_description" class="form-control" name="itinerary_description" placeholder="Give details of your service (max 5000 characters)" data-rule-required="true" data-rule-maxlength="5000" required><?php if(isset($draftData->itinerary_description))echo $draftData->itinerary_description;?></textarea>
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label text-light">What to Expect (<?php echo $selectOtherLang;?>)</label>
              <textarea id="other_lang_desc" class="form-control" name="other_itinerary_description" placeholder="Give details of your service (max 5000 characters)" data-rule-required="true" data-rule-maxlength="5000" required><?php if(isset($draftData->other_itinerary_description))echo $draftData->other_itinerary_description;?></textarea>
            </li>
			<?php } ?>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label d-block text-light">Type</label>
              <ul class="tagList">
			  <?php 
				  if(!empty($draftData->experience_type)){
				  $indoorclass = '';
				  $outdoorclass ='';
					  $expType1 = explode(',',$draftData->experience_type);
					  $expType2 = explode(',',$draftData->experience_type);
					  $expType = array_combine($expType1,$expType2);					  
					  
					  if(!empty($expType['Indoor'])){
						  $indoorclass = 'active';
						  }
					else{
					      $indoorclass = '';
						 } 	  
					if(!empty($expType['Outdoor'])){
						  $outdoorclass = 'active';
						  }
						 else{
							 $outdoorclass = '';
							 } 
					  }
				  ?>
                <li>
                  <label class="tagBox <?php echo @$indoorclass;?>">
                    <input type="checkbox" class="ignore" name="experience_itinerary_type[]" data-rule-required="false" value="Indoor" <?php if(isset($expType['Indoor'])=='Indoor') echo 'checked="checked"'; ?>/>
                    Indoor</label>
                </li>
                <li>
                  <label class="tagBox <?php echo @$outdoorclass;?>">
                    <input type="checkbox" name="experience_itinerary_type[]" value="Outdoor" <?php if(isset($expType['Outdoor'])=='Outdoor') echo 'checked="checked"'; ?>/>
                    Outdoor</label>
                </li>
              </ul>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label d-block text-light">Theme</label>
              <label class="col-form-sublabel">Select themes <small>(separate using commas)</small></label>
              <select id="typeThemes" name="itinerary_theme[]" class="form-control ignore" placeholder="Select themes" multiple data-rule-required="true">
                <?php
					foreach($allthemes as $themes):?>
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
				 foreach($myInterestData as $highlight):			     
				 ?>
                <option value="<?php echo $highlight->interest_name;?>"><?php echo $highlight->interest_name;?></option>
               <?php endforeach;?> 
              </select>			 
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Features <small class="text-default font-italic">(Select all that apply)</small></label>
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
              <select id="typeSearchTags" name="itinerary_searchtags[]" class="form-control ignore" placeholder="Search Tags" multiple data-rule-required="true">              
                <option value="" ></option>				  
              </select>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel d-block">Delivery Type <small>(max. select 2)</small></label>
              <div class="form-row">
                <div class="col-6 col-sm-auto">
				<?php 
					 if(isset($draftData->itinerary_delivery)){
						  $delivery = explode(',',$draftData->itinerary_delivery);
						  $delivery1 = explode(',',$draftData->itinerary_delivery);
                          $deliverydata = array_combine($delivery, $delivery1);
						 }
					?>
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                   <label> <input type="checkbox" id="deliveryType-bus" name="itinerary_delivery[]" value="bus" class="custom-control-input limitSelect ignore"  <?php if(isset($deliverydata['bus'])){echo "checked";} ?> data-rule-required="true"/>
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 31.1 33" style="enable-background:new 0 0 31.1 33;" xml:space="preserve">
                    <path d="M22.6,26.3c-4.8,0-9.6,0.2-14.3,0c-3.5-0.2-2.9-4-2.9-6.4c0-3.4,0-6.7,0-10.1c0-1.9-0.6-5.3,0.9-6.8c0.9-1,2.2-0.9,3.4-0.9
	c1.5,0,2.9,0,4.4,0c2.8,0,5.6-0.1,8.4,0c3.3,0.1,3.1,2.9,3.1,5.3c0,3.7,0,7.4,0,11.1C25.5,21.1,26.4,26.1,22.6,26.3
	c-0.9,0-0.9,1.4,0,1.3c2.4-0.1,4.2-1.9,4.3-4.3c0-0.7,0-1.5,0-2.2c0-3.7,0-7.3,0-11c0-2.2,0.6-5.7-0.8-7.6c-1.8-2.5-5.6-1.8-8.2-1.8
	c-3.1,0-6.3-0.1-9.4,0c-1.8,0-3.4,1-4.1,2.7C3.9,4.4,4,5.4,4,6.4c0,3.5,0,7,0,10.5c0,1.6,0,3.2,0,4.8c0,0.8-0.1,1.7,0.1,2.6
	c0.9,4.1,5.6,3.4,8.7,3.4c3.3,0,6.5,0,9.8,0C23.5,27.6,23.5,26.3,22.6,26.3z"/>
                    <path d="M4.7,7.1c7.2,0,14.4,0,21.5,0c0.9,0,0.9-1.3,0-1.3c-7.2,0-14.4,0-21.5,0C3.8,5.7,3.8,7.1,4.7,7.1L4.7,7.1z"/>
                    <path d="M4.8,21.4c7.2,0,14.4,0,21.5,0c0.9,0,0.9-1.3,0-1.3c-7.2,0-14.4,0-21.5,0C3.9,20,3.9,21.4,4.8,21.4L4.8,21.4z"/>
                    <path d="M13.2,4.6c1.5,0,3.1,0,4.6,0c0.9,0,0.9-1.3,0-1.3c-1.5,0-3.1,0-4.6,0C12.4,3.2,12.4,4.6,13.2,4.6L13.2,4.6z"/>
                    <path d="M14.8,6.4c0,4.8,0,9.6,0,14.3c0,0.9,1.3,0.9,1.3,0c0-4.8,0-9.6,0-14.3C16.1,5.5,14.8,5.5,14.8,6.4L14.8,6.4z"/>
                    <path d="M8.2,24.4c0.8,0,1.6,0,2.4,0c0.9,0,0.9-1.3,0-1.3c-0.8,0-1.6,0-2.4,0C7.4,23.1,7.4,24.4,8.2,24.4L8.2,24.4z"/>
                    <path d="M20.1,24.4c0.8,0,1.6,0,2.4,0c0.9,0,0.9-1.3,0-1.3c-0.8,0-1.6,0-2.4,0C19.2,23.1,19.2,24.4,20.1,24.4L20.1,24.4z"/>
                    <path d="M4.1,11.4c-0.4,0-1.3,0.2-1.6,0c0.1,0,0,0.2,0.1-0.1c0-0.3,0-0.6,0-0.8c0-0.7,0-1.4,0-2.1c0-0.2,0-1.2-0.1-1.2
	C2.4,7.3,3.1,7.3,3.2,7.3c0.2,0,0.7-0.1,0.9,0c-0.1,0,0-0.2-0.1,0.2C4,7.7,4,8,4,8.2c0,0.7,0,1.4,0,2.1c0,0.3,0,0.6,0,0.9
	c0,0.1,0,0.2,0,0.3c-0.1,0.2,0.1,0,0,0c-0.8,0.2-0.5,1.5,0.4,1.3c0.9-0.2,1-0.9,1-1.8c0-1,0-2,0-2.9c0-0.7,0.1-1.5-0.6-1.9
	C4.2,5.8,3,5.8,2.3,5.9C1.4,6.1,1.2,6.8,1.2,7.6c0,1,0,1.9,0,2.9c0,0.7-0.1,1.5,0.5,2c0.6,0.4,1.7,0.2,2.4,0.2
	C5,12.8,5,11.4,4.1,11.4z"/>
                    <path d="M28.4,11.1c-0.4,0-1.3,0.2-1.6,0c0.1,0,0,0.2,0.1-0.1c0-0.3,0-0.6,0-0.8c0-0.7,0-1.4,0-2.1c0-0.2,0-1.2-0.1-1.2
	C26.6,7,27.3,7,27.4,7c0.2,0,0.7-0.1,0.9,0c-0.1,0,0-0.2-0.1,0.2c0,0.2,0,0.5,0,0.8c0,0.7,0,1.4,0,2.1c0,0.3,0,0.6,0,0.9
	c0,0.1,0,0.2,0,0.3c-0.1,0.2,0.1,0,0,0c-0.8,0.2-0.5,1.5,0.4,1.3c0.9-0.2,1-0.9,1-1.8c0-1,0-2,0-2.9c0-0.7,0.1-1.5-0.6-1.9
	c-0.6-0.3-1.8-0.3-2.4-0.2c-0.9,0.1-1.1,0.9-1.1,1.7c0,1,0,1.9,0,2.9c0,0.7-0.1,1.5,0.5,2c0.6,0.4,1.7,0.2,2.4,0.2
	C29.3,12.5,29.3,11.1,28.4,11.1z"/>
                    <path d="M11.5,30.9c-0.5,0-1-0.1-1.5,0c-0.1,0-0.2,0-0.2,0c0,0,0.1,0.2,0.1,0.1c0-0.2,0-0.4,0-0.6c0-0.6,0-1.2,0-1.8
	c0-0.3,0-0.5,0-0.8c0-0.1,0.1-0.4-0.1-0.3c-0.1,0.1,0.4,0.1,0.5,0.1c0.3,0,0.6,0.1,0.9,0c0.1,0,0.2,0,0.2,0c-0.1,0-0.1-0.2-0.1,0
	c0,0.2,0,0.4,0,0.6c0,0.6,0,1.2,0,1.8c0,0.3,0,0.5,0,0.8c0,0.1,0,0.2,0,0.2c-0.1,0.2,0.1,0,0,0c-0.9,0.2-0.5,1.5,0.4,1.3
	c0.9-0.2,1-0.9,1-1.7c0-0.8,0-1.7,0-2.5c0-0.8-0.1-1.6-1-1.7c-0.6-0.1-1.4-0.1-2,0c-0.9,0.1-1.1,0.8-1.1,1.6c0,0.9,0,1.7,0,2.6
	c0,0.7,0,1.5,0.8,1.7c0.6,0.2,1.5,0.1,2.1,0.1C12.3,32.3,12.3,30.9,11.5,30.9z"/>
                    <path d="M21.6,30.9c-0.5,0-1-0.1-1.5,0c-0.1,0-0.2,0-0.2,0c0,0,0.1,0.2,0.1,0.1c0-0.2,0-0.4,0-0.6c0-0.6,0-1.2,0-1.8
	c0-0.3,0-0.5,0-0.8c0-0.1,0.1-0.4-0.1-0.3c-0.1,0.1,0.4,0.1,0.5,0.1c0.3,0,0.6,0.1,0.9,0c0.1,0,0.2,0,0.2,0c-0.1,0-0.1-0.2-0.1,0
	c0,0.2,0,0.4,0,0.6c0,0.6,0,1.2,0,1.8c0,0.3,0,0.5,0,0.8c0,0.1,0,0.2,0,0.2c-0.1,0.2,0.1,0,0,0c-0.9,0.2-0.5,1.5,0.4,1.3
	c0.9-0.2,1-0.9,1-1.7c0-0.8,0-1.7,0-2.5c0-0.8-0.1-1.6-1-1.7c-0.6-0.1-1.4-0.1-2,0c-0.9,0.1-1.1,0.8-1.1,1.6c0,0.9,0,1.7,0,2.6
	c0,0.7,0,1.5,0.8,1.7c0.6,0.2,1.5,0.1,2.1,0.1C22.4,32.3,22.4,30.9,21.6,30.9z"/>
                    <path d="M9.2,8.1C8.2,9,7.3,9.9,6.4,10.8c-0.6,0.6,0.3,1.6,1,1c0.9-0.9,1.9-1.8,2.8-2.7C10.8,8.4,9.8,7.5,9.2,8.1L9.2,8.1z"/>
                    <path d="M10.1,9.4c-0.9,0.9-1.9,1.8-2.8,2.7c-0.6,0.6,0.3,1.6,1,1c0.9-0.9,1.9-1.8,2.8-2.7C11.7,9.8,10.8,8.8,10.1,9.4L10.1,9.4z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-bus">Bus/Coach</label></label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                  <label>  <input type="checkbox" id="deliveryType-auto" name="itinerary_delivery[]" value="auto" <?php if(isset($deliverydata['auto'])){echo "checked";} ?> class="custom-control-input limitSelect">
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 42.9 33" style="enable-background:new 0 0 42.9 33;" xml:space="preserve">
                    <path d="M8,2.2c6,0,12.1,0,18.1,0c2.8,0,5.8-0.3,8.4,0.8s4.8,3.4,4.6,6.4C39,10.5,39,11.6,39,12.8c0,1.9,0,3.9,0,5.8
	c0,1.1,0.3,2.6,0,3.7c-0.3,1.3-3.6,0.9-4.6,0.8c-2.1-0.1-1.9-1.6-1.9-3.1c0-3.3-0.1-6.6,0-9.9c0-0.2,0-0.3,0,0c0-0.1,0.1-0.3,0-0.4
	c0-0.6-0.1-1.1-0.4-1.7c-0.9-1.5-2.8-2.1-4.4-2.2c-3.4-0.2-6.9,0-10.3,0c-1.6,0-3.3,0-4.9,0c-0.7,0-1.4,0-2.1-0.2
	C9.4,5.4,8.5,5,7.7,4.3C6.9,3.5,6.3,2.3,8,2.2c1-0.1,1-1.6,0-1.5C5.5,0.9,4.6,3.2,6.4,5c1.6,1.6,3.8,2.1,6,2.1c3.8,0,7.5,0,11.3,0
	c2.2,0,7.4-0.8,7.5,2.5c0,0.4,0,2.1,0,2.9c0,2.2,0,4.3,0,6.5c0,1.2-0.3,2.8,0.4,3.9c1.1,1.9,3.6,1.5,5.4,1.5c1.7,0,3.6-0.2,3.7-2.3
	c0.1-1.5,0-3,0-4.5c0-2,0-4,0-6.1c0-1.5,0.2-3.1-0.2-4.6C39.1,2.5,34.3,0.7,30,0.7c-7.3,0-14.6,0-21.9,0C7.1,0.7,7.1,2.2,8,2.2z"/>
                    <path d="M10.1,6.1c-1.8,1.3-3.1,3.3-4,5.3c-2.3,5.4-1.3,11.5,0.7,16.8c0.1,0.3,0.4,0.5,0.7,0.5c8,0,16,0,24.1,0c1,0,1-1.5,0-1.5
	c-8,0-16,0-24.1,0c0.2,0.2,0.5,0.4,0.7,0.5c-1.9-5-2.9-10.8-0.7-15.9C8,10.7,8.8,9.5,9.7,8.5c0.3-0.3,0.6-0.6,0.9-0.9
	c0.2-0.2,0.3-0.3,0.3-0.2C11.6,6.8,10.8,5.5,10.1,6.1L10.1,6.1z"/>
                    <path d="M2.9,17.4c-0.4,0.1,0.3,0,0.4,0c0.3,0,0.7,0,1,0.2s0.4,0.4,0.5,0.7c0.2,0.5,0-0.2,0,0.1c0,0.1,0,0.1,0,0.2
	c0,1.3-0.3,2.4-1.9,2.1C3,20.8,3.2,20.9,3.3,21c-0.7-1.2-0.6-2.7,0-3.9c0.4-0.9-0.9-1.6-1.3-0.7c-0.6,1.2-0.8,2.4-0.6,3.7
	c0.1,0.5,0.3,1.4,0.7,1.9c0.6,0.5,1.9,0.3,2.6,0c0.6-0.3,1.1-0.9,1.3-1.6c0.4-1,0.5-2.4,0-3.3c-0.7-1.2-2.2-1.3-3.4-1.2
	C1.6,16.1,2,17.5,2.9,17.4z"/>
                    <path d="M13.1,6.9c0,7,0,14.1,0,21.1c0,1,1.5,1,1.5,0c0-7,0-14.1,0-21.1C14.6,6,13.1,6,13.1,6.9L13.1,6.9z"/>
                    <path d="M5.5,18.9c2.8,0,5.5,0,8.3,0c1,0,1-1.5,0-1.5c-2.8,0-5.5,0-8.3,0C4.6,17.5,4.6,18.9,5.5,18.9L5.5,18.9z"/>
                    <path d="M6.3,23.1c-1-0.2-2-0.1-2.9,0.3c-1.9,0.8-2.6,2.7-2.7,4.6c0,0.4,0.4,0.7,0.7,0.7c2,0,4.1,0,6.1,0c1,0,1-1.5,0-1.5
	c-2,0-4.1,0-6.1,0c0.2,0.2,0.5,0.5,0.7,0.7c0.1-1.5,0.6-2.9,2.1-3.3c0.4-0.1,0.8-0.1,1.2-0.1c0.2,0,0.5,0,0.5,0
	C6.8,24.7,7.2,23.3,6.3,23.1L6.3,23.1z"/>
                    <path d="M2,28c-0.1,2,1.5,4.3,3.7,4.3c2.5,0.1,4.4-1.8,4.2-4.3c-0.1-0.9-1.6-0.9-1.5,0c0.2,1.7-0.9,2.9-2.7,2.8
	c-1.4-0.1-2.2-1.6-2.2-2.8C3.5,27,2,27,2,28L2,28z"/>
                    <path d="M35.6,23.1c-1-0.2-2-0.1-2.9,0.3c-1.9,0.8-2.6,2.7-2.7,4.6c0,0.4,0.4,0.7,0.7,0.7c2,0,4.1,0,6.1,0c1,0,1-1.5,0-1.5
	c-2,0-4.1,0-6.1,0c0.2,0.2,0.5,0.5,0.7,0.7c0.1-1.5,0.6-2.9,2.1-3.3c0.4-0.1,0.8-0.1,1.2-0.1c0.2,0,0.5,0,0.5,0
	C36.2,24.7,36.6,23.3,35.6,23.1L35.6,23.1z"/>
                    <path d="M36.6,24.6c0,0,0.2,0,0.4,0c0.4,0,0.8,0,1.2,0.1c1.5,0.4,2,1.9,2.1,3.3c0.2-0.2,0.5-0.5,0.7-0.7c-2,0-4.1,0-6.1,0
	c-1,0-1,1.5,0,1.5c2,0,4.1,0,6.1,0c0.4,0,0.8-0.3,0.7-0.7c-0.1-1.9-0.8-3.8-2.7-4.6c-0.9-0.4-2-0.5-2.9-0.3
	C35.3,23.3,35.7,24.7,36.6,24.6L36.6,24.6z"/>
                    <path d="M32.4,28c-0.1,2,1.5,4.3,3.7,4.3c2.5,0.1,4.4-1.8,4.2-4.3c-0.1-0.9-1.6-0.9-1.5,0c0.2,1.7-0.9,2.9-2.7,2.8
	c-1.4-0.1-2.2-1.6-2.2-2.8C33.9,27.1,32.4,27.1,32.4,28L32.4,28z"/>
                    <path d="M23.5,6.7c0,7.1,0,14.2,0,21.3c0,1,1.5,1,1.5,0c0-7.1,0-14.2,0-21.3C25,5.8,23.5,5.8,23.5,6.7L23.5,6.7z"/>
                    <path d="M22.9,21.8c-0.9,0-1.7,0-2.6,0c-0.5,0-1,0-1.5,0c-0.7,0-1.9-0.5-0.7-1.2c0.6-0.4,2.1-0.1,2.8-0.1c0.5,0,1,0,1.5,0
	c0.1,0,0.3,0,0.4,0c1,0.2,0.9,1.2-0.1,1.4c-0.9,0.1-0.5,1.6,0.4,1.4c2.7-0.4,2.4-4-0.2-4.3c-1.5-0.1-3.2-0.2-4.7,0
	c-2.7,0.3-2.7,4,0,4.3c1.5,0.2,3.2,0,4.7,0C23.8,23.3,23.8,21.8,22.9,21.8z"/>
                    <path d="M22.9,27.3c-1.4,0-2.9,0.1-4.3,0c-1-0.1-1-0.7-1-1.6c0-0.7-0.3-2.2,0.4-2.6c0.5-0.3,1.4-0.1,2-0.1c0.8,0,1.7-0.1,2.5,0
	c1.1,0.1,1,0.8,1,1.7c0,0.9,0.3,2.4-0.9,2.6c-0.9,0.1-0.5,1.6,0.4,1.4c1.6-0.2,2-1.5,2-2.9c0-1,0.2-2.5-0.4-3.4
	c-0.8-1.1-2-0.9-3.2-0.9c-1.1,0-2.2-0.1-3.2,0c-1.5,0.2-2,1.3-2.1,2.6c0,1-0.3,2.6,0.4,3.5c0.7,1.1,1.9,1,3,1s2.3,0,3.4,0
	C23.8,28.7,23.8,27.3,22.9,27.3z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-auto">Auto</label></label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                   <label> <input type="checkbox" id="deliveryType-car" name="itinerary_delivery[]" value="car" <?php if(isset($deliverydata['car'])){echo "checked";} ?> class="custom-control-input limitSelect">
                    <span class="control-icon"> <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 58.2 33" style="enable-background:new 0 0 58.2 33;" xml:space="preserve">
                    <path d="M30.6,17.4c-0.5,0-1.1,0-1.5,0c-0.4,0-0.3-0.4-0.3-0.7c0-0.4,0-0.7,0-1.1c0-0.2-0.1-0.6,0.1-0.7c0.1-0.1,0.3-0.1,0.4-0.1
	c0.1,0,0.3,0,0.5,0c0.3,0,0.6,0,0.9,0c0.4,0,0.3,0.3,0.3,0.6c0,0.4,0,0.8,0,1.2C30.9,16.9,31,17.4,30.6,17.4c-0.1,0-0.1,0.1,0,0.1
	c0.3,0,0.4-0.2,0.5-0.5c0-0.1,0-0.1,0-0.3c0-0.4,0-0.8,0-1.2c0-0.3,0.1-0.6-0.1-0.8c-0.2-0.3-0.6-0.2-0.9-0.2c-0.3,0-0.7,0-1,0
	c-0.2,0-0.4,0.1-0.4,0.3c0,0.1,0,0.2,0,0.3c0,0.4,0,0.8,0,1.1c0,0.2,0,0.4,0,0.5c0,0.1,0,0.2,0,0.3c0.1,0.4,0.6,0.4,0.9,0.4
	c0.4,0,0.7,0,1.1,0C30.7,17.6,30.7,17.4,30.6,17.4z"/>
                    <path d="M28.7,15.4c0.8,0,1.6,0,2.3,0c0.1,0,0.1-0.1,0-0.1c-0.8,0-1.6,0-2.3,0C28.6,15.2,28.6,15.4,28.7,15.4L28.7,15.4z"/>
                    <path d="M28.7,16.9c0.8,0,1.6,0,2.3,0c0.1,0,0.1-0.1,0-0.1c-0.8,0-1.6,0-2.3,0C28.6,16.7,28.6,16.9,28.7,16.9L28.7,16.9z"/>
                    <path d="M29.6,15.1c0.1,0,0.3,0,0.5,0c0.1,0,0.1-0.1,0-0.1c-0.1,0-0.3,0-0.5,0C29.5,14.9,29.5,15.1,29.6,15.1L29.6,15.1z"/>
                    <path d="M29.8,15.3c0,0.5,0,1.1,0,1.5c0,0.1,0.1,0.1,0.1,0c0-0.5,0-1.1,0-1.5C29.9,15.2,29.8,15.2,29.8,15.3L29.8,15.3z"/>
                    <path d="M29,17.2c0.1,0,0.2,0,0.3,0c0.1,0,0.1-0.1,0-0.1c-0.1,0-0.2,0-0.3,0S29,17.2,29,17.2L29,17.2z"/>
                    <path d="M30.4,17.2c0.1,0,0.2,0,0.3,0c0.1,0,0.1-0.1,0-0.1c-0.1,0-0.2,0-0.3,0C30.3,17.1,30.3,17.2,30.4,17.2L30.4,17.2z"/>
                    <path d="M28.6,15.8c0,0-0.1,0-0.2,0c0,0,0,0,0,0s0-0.1,0-0.1c0-0.1,0-0.1,0-0.2c0,0,0-0.1,0-0.1h0.1c0,0,0.1,0,0.1,0c0,0,0,0,0,0
	c0,0,0,0,0,0.1c0,0.1,0,0.1,0,0.2C28.6,15.7,28.6,15.8,28.6,15.8C28.6,15.8,28.6,15.8,28.6,15.8C28.6,15.9,28.6,15.8,28.6,15.8
	c-0.1,0-0.1,0.2,0,0.1c0.1,0,0.1-0.1,0.1-0.2c0-0.1,0-0.2,0-0.3c0-0.1,0-0.1-0.1-0.2c-0.1,0-0.2,0-0.3,0c-0.1,0-0.1,0.1-0.1,0.2
	c0,0.1,0,0.2,0,0.3c0,0.1,0,0.1,0,0.2c0.1,0,0.2,0,0.3,0C28.7,16,28.7,15.8,28.6,15.8z"/>
                    <path d="M31.2,15.8c0,0-0.1,0-0.2,0c0,0,0,0,0,0s0-0.1,0-0.1c0-0.1,0-0.1,0-0.2c0,0,0-0.1,0-0.1c0,0,0,0,0.1,0c0,0,0.1,0,0.1,0
	c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0.1,0,0.1,0,0.2C31.2,15.7,31.2,15.8,31.2,15.8L31.2,15.8C31.2,15.8,31.2,15.8,31.2,15.8
	c-0.1,0-0.1,0.2,0,0.1c0.1,0,0.1-0.1,0.1-0.2c0-0.1,0-0.2,0-0.3c0-0.1,0-0.1-0.1-0.2c-0.1,0-0.2,0-0.3,0c-0.1,0-0.1,0.1-0.1,0.2
	c0,0.1,0,0.2,0,0.3c0,0.1,0,0.1,0,0.2c0.1,0,0.2,0,0.3,0C31.3,15.9,31.3,15.8,31.2,15.8z"/>
                    <path d="M29.4,17.9c0,0-0.1,0-0.1,0h0c0,0,0,0,0,0c0,0,0,0,0-0.1c0-0.1,0-0.1,0-0.2c0,0,0,0,0-0.1v0h0c0,0,0.1,0,0.1,0h0
	c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0.1,0,0.1,0,0.2C29.4,17.9,29.4,17.9,29.4,17.9L29.4,17.9C29.4,17.9,29.4,17.9,29.4,17.9
	c-0.1,0-0.1,0.2,0,0.1c0.1,0,0.1-0.1,0.1-0.2s0-0.2,0-0.3s0-0.2-0.1-0.2c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0.1-0.1,0.2s0,0.2,0,0.3
	c0,0.1,0,0.1,0.1,0.2c0.1,0,0.1,0,0.2,0C29.5,18.1,29.5,17.9,29.4,17.9z"/>
                    <path d="M30.5,17.9c0,0-0.1,0-0.1,0h0c0,0,0,0,0,0c0,0,0,0,0-0.1c0-0.1,0-0.1,0-0.2c0,0,0,0,0-0.1v0h0c0,0,0.1,0,0.1,0h0
	c0,0,0,0,0,0c0,0,0,0,0,0.1c0,0.1,0,0.1,0,0.2C30.5,17.9,30.5,17.9,30.5,17.9L30.5,17.9C30.5,17.9,30.5,17.9,30.5,17.9
	c-0.1,0-0.1,0.2,0,0.1c0.1,0,0.1-0.1,0.1-0.2s0-0.2,0-0.3s0-0.2-0.1-0.2c-0.1,0-0.1,0-0.2,0c-0.1,0-0.1,0.1-0.1,0.2s0,0.2,0,0.3
	c0,0.1,0,0.1,0.1,0.2c0.1,0,0.1,0,0.2,0C30.6,18.1,30.6,17.9,30.5,17.9z"/>
                    <path d="M29.2,15.5c-0.1,0.1-0.2,0.2-0.3,0.3c-0.1,0.1,0,0.2,0.1,0.1c0.1-0.1,0.2-0.2,0.3-0.3C29.3,15.5,29.2,15.4,29.2,15.5
	L29.2,15.5z"/>
                    <path d="M29.3,15.6c-0.1,0.1-0.2,0.2-0.3,0.3c-0.1,0.1,0,0.2,0.1,0.1c0.1-0.1,0.2-0.2,0.3-0.3C29.4,15.6,29.3,15.5,29.3,15.6
	L29.3,15.6z"/>
                    <path d="M25,11.3c2.2,0,4.4,0,6.6,0c1,0,2.1-0.1,3.1,0.3c0.9,0.4,1.8,1.2,1.7,2.3c0,0.4,0,0.8,0,1.2c0,0.7,0,1.4,0,2.1
	c0,0.4,0.1,0.9,0,1.4c-0.1,0.5-1.3,0.3-1.7,0.3c-0.8,0-0.7-0.6-0.7-1.1c0-1.2,0-2.4,0-3.6c0-0.1,0-0.1,0,0c0,0,0-0.1,0-0.1
	c0-0.2,0-0.4-0.1-0.6c-0.3-0.5-1-0.8-1.6-0.8c-1.2-0.1-2.5,0-3.8,0c-0.6,0-1.2,0-1.8,0c-0.3,0-0.5,0-0.8-0.1c-0.4-0.1-0.7-0.2-1-0.5
	C24.6,11.7,24.4,11.3,25,11.3c0.4,0,0.4-0.6,0-0.5c-0.9,0.1-1.2,0.9-0.6,1.6c0.6,0.6,1.4,0.8,2.2,0.8c1.4,0,2.7,0,4.1,0
	c0.8,0,2.7-0.3,2.7,0.9c0,0.1,0,0.8,0,1.1c0,0.8,0,1.6,0,2.4c0,0.4-0.1,1,0.1,1.4c0.4,0.7,1.3,0.5,2,0.5c0.6,0,1.3-0.1,1.4-0.8
	c0-0.5,0-1.1,0-1.6c0-0.7,0-1.5,0-2.2c0-0.5,0.1-1.1-0.1-1.7c-0.5-1.6-2.3-2.3-3.8-2.3c-2.7,0-5.3,0-8,0
	C24.7,10.7,24.7,11.3,25,11.3z"/>
                    <path d="M25.8,12.7c-0.7,0.5-1.1,1.2-1.5,1.9c-0.8,2-0.5,4.2,0.3,6.1c0,0.1,0.1,0.2,0.3,0.2c2.9,0,5.8,0,8.8,0c0.4,0,0.4-0.5,0-0.5
	c-2.9,0-5.8,0-8.8,0c0.1,0.1,0.2,0.1,0.3,0.2c-0.7-1.8-1.1-3.9-0.3-5.8c0.2-0.4,0.5-0.8,0.8-1.2c0.1-0.1,0.2-0.2,0.3-0.3
	c0.1-0.1,0.1-0.1,0.1-0.1C26.3,12.9,26.1,12.5,25.8,12.7L25.8,12.7z"/>
                    <path d="M23.2,16.8c-0.1,0,0.1,0,0.1,0c0.1,0,0.3,0,0.4,0.1s0.1,0.1,0.2,0.3c0.1,0.2,0-0.1,0,0c0,0,0,0,0,0.1c0,0.5-0.1,0.9-0.7,0.8
	c0,0,0.1,0.1,0.1,0.1c-0.3-0.4-0.2-1,0-1.4c0.1-0.3-0.3-0.6-0.5-0.3c-0.2,0.4-0.3,0.9-0.2,1.4c0,0.2,0.1,0.5,0.3,0.7
	c0.2,0.2,0.7,0.1,0.9,0c0.2-0.1,0.4-0.3,0.5-0.6c0.1-0.4,0.2-0.9,0-1.2c-0.3-0.4-0.8-0.5-1.2-0.4C22.7,16.3,22.8,16.9,23.2,16.8z"/>
                    <path d="M26.9,13c0,2.6,0,5.1,0,7.7c0,0.4,0.5,0.4,0.5,0c0-2.6,0-5.1,0-7.7C27.4,12.7,26.9,12.7,26.9,13L26.9,13z"/>
                    <path d="M24.1,17.4c1,0,2,0,3,0c0.4,0,0.4-0.5,0-0.5c-1,0-2,0-3,0C23.8,16.9,23.8,17.4,24.1,17.4L24.1,17.4z"/>
                    <path d="M24.4,18.9c-0.4-0.1-0.7,0-1.1,0.1c-0.7,0.3-0.9,1-1,1.7c0,0.1,0.1,0.3,0.3,0.3c0.7,0,1.5,0,2.2,0c0.4,0,0.4-0.5,0-0.5
	c-0.7,0-1.5,0-2.2,0c0.1,0.1,0.2,0.2,0.3,0.3c0-0.5,0.2-1.1,0.8-1.2c0.1,0,0.3,0,0.4,0c0.1,0,0.2,0,0.2,0
	C24.6,19.5,24.7,19,24.4,18.9L24.4,18.9z"/>
                    <path d="M22.8,20.7c0,0.7,0.5,1.6,1.4,1.6c0.9,0,1.6-0.7,1.5-1.6c0-0.3-0.6-0.3-0.5,0c0.1,0.6-0.3,1.1-1,1c-0.5,0-0.8-0.6-0.8-1
	C23.4,20.3,22.8,20.3,22.8,20.7L22.8,20.7z"/>
                    <path d="M35.1,18.9c-0.4-0.1-0.7,0-1.1,0.1c-0.7,0.3-0.9,1-1,1.7c0,0.1,0.1,0.3,0.3,0.3c0.7,0,1.5,0,2.2,0c0.4,0,0.4-0.5,0-0.5
	c-0.7,0-1.5,0-2.2,0c0.1,0.1,0.2,0.2,0.3,0.3c0-0.5,0.2-1.1,0.8-1.2c0.1,0,0.3,0,0.4,0c0.1,0,0.2,0,0.2,0
	C35.3,19.5,35.5,19,35.1,18.9L35.1,18.9z"/>
                    <path d="M35.5,19.4c0,0,0.1,0,0.1,0c0.1,0,0.3,0,0.4,0c0.5,0.1,0.7,0.7,0.8,1.2c0.1-0.1,0.2-0.2,0.3-0.3c-0.7,0-1.5,0-2.2,0
	c-0.4,0-0.4,0.5,0,0.5c0.7,0,1.5,0,2.2,0c0.1,0,0.3-0.1,0.3-0.3c0-0.7-0.3-1.4-1-1.7c-0.3-0.1-0.7-0.2-1.1-0.1
	C35,19,35.1,19.5,35.5,19.4L35.5,19.4z"/>
                    <path d="M33.9,20.7c0,0.7,0.5,1.6,1.4,1.6c0.9,0,1.6-0.7,1.5-1.6c0-0.3-0.6-0.3-0.5,0c0.1,0.6-0.3,1.1-1,1c-0.5,0-0.8-0.6-0.8-1
	C34.5,20.4,33.9,20.4,33.9,20.7L33.9,20.7z"/>
                    <path d="M30.7,12.9c0,2.6,0,5.2,0,7.8c0,0.4,0.5,0.4,0.5,0c0-2.6,0-5.2,0-7.8C31.2,12.6,30.7,12.6,30.7,12.9L30.7,12.9z"/>
                    <path d="M30.5,18.4c-0.3,0-0.6,0-0.9,0c-0.2,0-0.4,0-0.5,0c-0.3,0-0.7-0.2-0.3-0.4c0.2-0.1,0.8,0,1,0c0.2,0,0.4,0,0.5,0
	c0,0,0.1,0,0.1,0C30.8,18,30.8,18.4,30.5,18.4c-0.4,0.1-0.3,0.6,0.1,0.5c1-0.1,0.9-1.5-0.1-1.6c-0.5,0-1.2-0.1-1.7,0
	c-1,0.1-1,1.5,0,1.6c0.5,0.1,1.2,0,1.7,0C30.8,19,30.8,18.4,30.5,18.4z"/>
                    <path d="M30.5,20.4c-0.5,0-1.1,0-1.6,0c-0.4,0-0.4-0.3-0.4-0.6c0-0.3-0.1-0.8,0.1-0.9c0.2-0.1,0.5,0,0.7,0c0.3,0,0.6,0,0.9,0
	c0.4,0,0.4,0.3,0.4,0.6s0.1,0.9-0.3,0.9c-0.3,0-0.2,0.6,0.1,0.5c0.6-0.1,0.7-0.5,0.7-1.1c0-0.4,0.1-0.9-0.1-1.2
	c-0.3-0.4-0.7-0.3-1.2-0.3c-0.4,0-0.8,0-1.2,0c-0.5,0.1-0.7,0.5-0.8,0.9c0,0.4-0.1,0.9,0.1,1.3c0.3,0.4,0.7,0.4,1.1,0.4s0.8,0,1.2,0
	C30.8,20.9,30.8,20.4,30.5,20.4z"/>
                    <path d="M17.2,2.4c3.7,0,7.4,0,11.1,0c3.9,0,7.9-0.3,11.8,0c1.7,0.1,2.7,1.8,3.8,3c1.7,2,3.4,4,5.1,5.9c1.4,1.6,2.8,3.2,4.1,4.8
	C54.4,17.8,54,20,54,22c0,2-0.8,3.5-3,3.6c-1.2,0-2.4,0-3.6,0c-4.7,0-9.4,0-14.1,0c-8.4,0-16.8,0.4-25.2,0c-3-0.1-3-3.2-2.8-5.6
	C5.5,18.1,7,16.4,8,14.8c1.6-2.6,3.2-5.1,4.8-7.7C13.8,5.5,15,2.6,17.2,2.4c1.2-0.1,1.2-1.9,0-1.8c-2.5,0.2-3.5,1.8-4.7,3.6
	C11,6.6,9.5,9,8,11.3c-1.2,1.9-2.5,3.8-3.6,5.8c-1.1,1.8-1,3.8-0.9,5.9c0.2,4.7,4.7,4.4,8.1,4.4c5.2,0,10.5,0,15.7,0
	c5.7,0,11.4,0,17.1,0c1.8,0,3.7,0,5.5,0c1.1,0,2.3,0.1,3.4-0.4c2.9-1.3,2.5-4.5,2.5-7.2c0-1.3,0.1-2.6-0.6-3.7
	c-0.3-0.5-0.8-1-1.2-1.5c-3.3-3.9-6.6-7.8-10-11.7c-1.1-1.3-2.3-2.2-4.2-2.2c-1.9,0-3.8,0-5.6,0c-5.3,0-10.7,0-16,0
	c-0.4,0-0.7,0-1.1,0C16,0.6,16,2.4,17.2,2.4z"/>
                    <path d="M35.9,21.9c-2.6,0-5.2,0-7.8,0c-1.4,0-2.7,0.1-4.1,0c-0.6,0-1.1,0-1.6-0.4c-1.7-1.2-0.7-3.5,1.1-3.7c2.5-0.3,5.3,0,7.8,0
	c1.4,0,2.7-0.1,4.1,0c0.5,0,0.8-0.1,1.4,0.2C38.7,19,37.9,21.8,35.9,21.9c-1.2,0.1-1.2,1.9,0,1.8c4.9-0.4,5-7.4,0-7.7
	c-2.9-0.2-5.8,0-8.7,0c-2.8,0-6.7-0.5-7.5,3.1c-0.4,2,0.9,4,2.8,4.5c1,0.3,2.2,0.1,3.2,0.1c3.4,0,6.7,0,10.1,0
	C37,23.8,37,21.9,35.9,21.9z"/>
                    <path d="M44.2,21.1c-0.6-0.9-0.6-1.8,0.3-2.4c0.9-0.6,3.9-1.5,4.7-0.1c0.8,1.3-0.5,2.1-1.4,2.4C47,21.3,44.9,22,44.2,21.1
	c-0.7-1-2.2-0.1-1.6,0.9c1.3,2,4.1,1.4,6,0.7c2-0.7,3.4-3,2.2-5c-1.4-2.4-5.2-1.8-7.2-0.6c-1.8,1-2.1,3.2-1,4.9
	C43.3,23,44.9,22,44.2,21.1z"/>
                    <path d="M17,22.3c1.1-1.6,0.9-3.7-0.8-4.8c-2-1.3-5.9-1.9-7.4,0.5C6.2,22.4,14.7,25.8,17,22.3c0.7-1-0.9-1.9-1.6-0.9
	c-0.7,1-2.7,0.2-3.6-0.1c-0.3-0.1-0.6-0.2-0.9-0.3c0.3,0.1,0.2,0.1-0.3-0.3c-0.2-0.2-0.3-0.5-0.4-0.7c-0.1-0.4-0.1-0.8,0.1-1.1
	c0.8-1.4,3.8-0.5,4.7,0.1c0.9,0.6,0.9,1.5,0.3,2.4C14.8,22.4,16.3,23.3,17,22.3z"/>
                    <path d="M19.9,31c-1.4,0-2.7,0-4.1,0c-0.8,0-1.4,0.2-1.8-0.9c-0.3-0.8,0-2.2,0.9-2.5c1-0.4,2.8,0,3.8,0c0.8,0,1.7-0.2,2.1,0.9
	C21,29.1,20.8,30.8,19.9,31c-1.2,0.1-1.2,2,0,1.8c1.6-0.2,2.6-1.2,2.7-2.8c0.1-1.3,0.1-2.8-1.1-3.7c-0.9-0.7-2-0.5-3.1-0.5
	c-1.2,0-2.4-0.1-3.5,0C12,26,11,30.3,13.1,32.1c0.9,0.8,2.1,0.7,3.3,0.7c1.2,0,2.3,0,3.5,0C21,32.8,21,31,19.9,31z"/>
                    <path d="M45.4,31c-1.4,0-2.7,0-4.1,0c-0.8,0-1.4,0.2-1.8-0.9c-0.3-0.8,0-2.2,0.9-2.5c1-0.4,2.8,0,3.8,0c0.8,0,1.7-0.2,2.1,0.9
	C46.5,29.1,46.3,30.8,45.4,31c-1.2,0.1-1.2,2,0,1.8c1.6-0.2,2.6-1.2,2.7-2.8c0.1-1.3,0.1-2.8-1.1-3.7c-0.9-0.7-2-0.5-3.1-0.5
	c-1.2,0-2.4-0.1-3.5,0c-2.8,0.3-3.8,4.5-1.8,6.3c0.9,0.8,2.1,0.7,3.3,0.7c1.2,0,2.3,0,3.5,0C46.6,32.8,46.6,31,45.4,31z"/>
                    <path d="M17.5,5.5c4.5,0,8.9,0,13.4,0c2.5,0,5.1,0,7.6,0c0.3,0,0.7,0,1,0c0.3-0.1,0.5,0.2,0.1-0.1c-0.6-0.4,0,0.2,0.1,0.3
	c0.3,0.5,0.8,0.9,1.2,1.3c1.8,2,3.5,4,5.3,6c0.2-0.5,0.4-1,0.6-1.6c-9.9,0-19.9,0-29.8,0c-1.4,0-2.8,0-4.2,0
	c0.3,0.5,0.5,0.9,0.8,1.4c1.6-2.6,3.2-5.2,4.8-7.8c0.6-1-1-1.9-1.6-0.9c-1.6,2.6-3.2,5.2-4.8,7.8c-0.4,0.6,0.1,1.4,0.8,1.4
	c9.9,0,19.9,0,29.8,0c1.4,0,2.8,0,4.2,0c0.8,0,1.2-1,0.6-1.6c-1.6-1.8-3.2-3.6-4.7-5.4c-0.9-1.1-1.8-2.6-3.3-2.7
	c-5.4-0.2-10.8,0-16.1,0c-1.9,0-3.8,0-5.7,0C16.3,3.7,16.3,5.5,17.5,5.5z"/>
                    <path d="M20.2,20.6c0.7,0.5,2.2,0.2,2.9,0.2c2.1,0,4.1,0,6.2,0c3.1,0,6.2-0.1,9.3-0.1c1.2,0,1.2-1.8,0-1.8c-2.9,0-5.7,0.1-8.6,0.1
	c-2,0-4,0-6,0c-0.7,0-1.5,0-2.2,0c-0.2,0-0.5,0-0.7,0c-0.3,0-0.3-0.1,0,0.1C20.2,18.3,19.3,19.9,20.2,20.6L20.2,20.6z"/>
                    <path d="M50,10.7c0.5-0.9,1-1.8,1.5-2.6c0.7-1,2.5-1.6,3.7-1c2.1,1-1.1,2.6-2.1,3c-0.9,0.4-1.9,0.8-2.8,1.3c-1.1,0.5-0.1,2,0.9,1.6
	c1.4-0.6,2.8-1.1,4.1-1.8c1.9-1,3.4-3.6,1.4-5.3c-1.3-1.2-4.3-0.9-5.6,0.1c-1.2,0.9-1.9,2.6-2.7,3.9C47.8,10.8,49.4,11.7,50,10.7
	L50,10.7z"/>
                    <path d="M10.1,9.8c-0.7-1.3-1.4-3-2.7-3.9c-1.4-1-4.3-1.2-5.6-0.1c-2,1.7-0.5,4.3,1.4,5.3c1.3,0.7,2.7,1.2,4.1,1.8
	c1.1,0.5,2-1.1,0.9-1.6c-0.9-0.4-1.9-0.8-2.8-1.3c-1-0.4-4.1-2-2.1-3c1.2-0.6,3.1,0,3.7,1c0.6,0.8,1,1.8,1.5,2.6
	C9.1,11.7,10.7,10.8,10.1,9.8L10.1,9.8z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-car">Car</label></label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <label><input type="checkbox" id="deliveryType-cycle" name="itinerary_delivery[]" value="cycle" <?php if(isset($deliverydata['cycle'])){echo "checked";} ?> class="custom-control-input limitSelect">
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 41.8 33" style="enable-background:new 0 0 41.8 33;" xml:space="preserve">
                    <g>
                      <path d="M13.9,24.9c-0.1,3.2-2.6,5.9-5.9,5.9c-3.2,0-5.9-2.7-5.9-5.9c0-3.1,2.6-5.8,5.7-5.9C11.1,18.9,13.7,21.6,13.9,24.9
		c0,1.1,1.7,1.1,1.7,0c-0.1-4.1-3.3-7.6-7.6-7.6c-4.1,0-7.6,3.4-7.6,7.6c0,4.1,3.4,7.6,7.6,7.6c4.2,0,7.4-3.4,7.6-7.6
		C15.5,23.8,13.9,23.8,13.9,24.9z"/>
                    </g>
                    <g>
                      <path d="M39.4,24.9c-0.1,3.2-2.6,5.9-5.9,5.9c-3.2,0-5.9-2.7-5.9-5.9c0-3.1,2.6-5.8,5.7-5.9C36.7,18.9,39.3,21.6,39.4,24.9
		c0,1.1,1.7,1.1,1.7,0c-0.1-4.1-3.3-7.6-7.6-7.6c-4.1,0-7.6,3.4-7.6,7.6c0,4.1,3.4,7.6,7.6,7.6c4.2,0,7.4-3.4,7.6-7.6
		C41.1,23.8,39.4,23.8,39.4,24.9z"/>
                    </g>
                    <g>
                      <path d="M14.1,8.1c-1.1,0-2.3,0-3.4,0c-0.6,0-1.2,0.1-1.8,0C8,7.9,6.7,6.8,8.6,6.3c0.9-0.3,2.2,0,3.1,0c0.6,0,1.3-0.1,1.9,0
		C14.5,6.3,16.2,7.8,14.1,8.1c-1,0.1-1.1,1.8,0,1.7c3.3-0.4,3.3-4.8,0-5.1c-1.8-0.2-3.8-0.2-5.6,0c-3,0.3-3.5,4.5-0.4,5.1
		c1.9,0.3,4.1,0,6,0C15.2,9.7,15.2,8.1,14.1,8.1z"/>
                    </g>
                    <g>
                      <path d="M10.5,8.9c0,1.7,0,3.3,0,5c0,1.1,1.7,1.1,1.7,0c0-1.7,0-3.3,0-5C12.2,7.8,10.5,7.8,10.5,8.9L10.5,8.9z"/>
                    </g>
                    <g>
                      <path d="M27.2,2.3c1.5,0,2.9,0,4.4,0C31.3,2,31,1.7,30.8,1.5c0.6,7.8,1.3,15.6,1.9,23.4c0.1,1.1,1.7,1.1,1.7,0
		c-0.6-7.8-1.3-15.6-1.9-23.4c0-0.4-0.3-0.8-0.8-0.8c-1.5,0-2.9,0-4.4,0C26.1,0.6,26.1,2.3,27.2,2.3L27.2,2.3z"/>
                    </g>
                    <g>
                      <path d="M10.8,14.5c3.3,2.8,6.6,5.6,9.9,8.4c0.1-0.5,0.2-0.9,0.4-1.4c-4.4,0.9-8.9,1.7-13.3,2.6c0.3,0.3,0.7,0.7,1,1
		c1.1-3.7,2.3-7.4,3.4-11c-0.3,0.2-0.5,0.4-0.8,0.6c7-0.4,13.9-0.8,20.9-1.2c1.1-0.1,1.1-1.7,0-1.7c-7,0.4-13.9,0.8-20.9,1.2
		c-0.4,0-0.7,0.2-0.8,0.6c-1.1,3.7-2.3,7.4-3.4,11c-0.2,0.6,0.4,1.1,1,1c4.4-0.9,8.9-1.7,13.3-2.6c0.6-0.1,0.8-1,0.4-1.4
		c-3.3-2.8-6.6-5.6-9.9-8.4C11.1,12.6,10,13.8,10.8,14.5L10.8,14.5z"/>
                    </g>
                    <g>
                      <path d="M22.6,19.2c1.1,0,2.3,0,3.4,0c-0.3-0.3-0.5-0.7-0.8-1c-0.2,0.6-0.3,1.2-0.5,1.8c0.3-0.2,0.5-0.4,0.8-0.6
		c-1.1,0-2.3,0-3.4,0c0.3,0.3,0.5,0.7,0.8,1c0.2-0.6,0.3-1.2,0.5-1.8c0.3-1-1.3-1.5-1.6-0.4c-0.2,0.6-0.3,1.2-0.5,1.8
		c-0.1,0.5,0.3,1,0.8,1c1.1,0,2.3,0,3.4,0c0.4,0,0.7-0.3,0.8-0.6c0.2-0.6,0.3-1.2,0.5-1.8c0.1-0.5-0.3-1-0.8-1c-1.1,0-2.3,0-3.4,0
		C21.6,17.6,21.6,19.2,22.6,19.2z"/>
                    </g>
                    <g>
                      <path d="M21.4,20c-0.4,1.4-0.8,2.8-1.3,4.2c-0.3,1,1.3,1.5,1.6,0.4c0.4-1.4,0.8-2.8,1.3-4.2C23.3,19.4,21.7,19,21.4,20L21.4,20z"/>
                    </g>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-cycle">Cycle</label></label>
                  </div>
                </div>
                <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <label><input type="checkbox" id="deliveryType-foot" name="itinerary_delivery[]" value="foot" <?php if(isset($deliverydata['foot'])){echo "checked";} ?> class="custom-control-input limitSelect">
                    <span class="control-icon"> <svg version="1.1"   xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 18.6 36.1" style="enable-background:new 0 0 18.6 36.1;" xml:space="preserve">
                    <path d="M9.8,4.8C9.8,6.1,9,7.7,7.5,7.7C6,7.7,5.1,6.1,5.1,4.8S6,1.8,7.5,1.8C9,1.8,9.8,3.4,9.8,4.8c0,0.9,1.5,0.9,1.4,0
	c-0.1-2.1-1.4-4.4-3.8-4.4c-2.3,0-3.8,2.2-3.8,4.4c0,2.1,1.4,4.2,3.6,4.4c2.4,0.1,3.9-2.2,4-4.4C11.3,3.9,9.9,3.9,9.8,4.8z"/>
                    <path d="M4.9,7.2c-1.4,0.4-2.3,1.8-2.6,3c-0.3,1.1-0.3,2.3-0.2,3.4c0.1,1.5,0.2,3.1,0.8,4.5c0.6,1.4,3.1,4.6,4.9,2.7
	c0.7-0.8,0.4-2.3,0-3.2c-0.3-0.8-0.6-1.3-0.6-2.2c0-1,0.1-1.9,0.1-2.9c0.1-0.9-1.4-0.9-1.4,0c-0.1,1.2-0.2,2.4-0.1,3.5
	c0.1,1,0.6,1.6,0.8,2.5c0.1,0.5,0.3,1.2-0.2,1.4c-0.4,0.2-1.1-0.5-1.3-0.8c-0.6-0.7-1-1.5-1.2-2.3c-0.5-1.8-1.3-7.5,1.4-8.2
	C6.1,8.3,5.8,7,4.9,7.2L4.9,7.2z"/>
                    <path d="M9.1,8.6c-0.1,0,0,0,0.2,0.1c0.3,0.2,0.6,0.8,0.8,1.3c1.4,3.4,1.2,7.6,1.1,11.2c0.2-0.2,0.5-0.5,0.7-0.7c-3.1,0-6.1,0-9.2,0
	c0.2,0.2,0.5,0.5,0.7,0.7c0-2.5,0-5.1,0-7.6c0-0.9-1.4-0.9-1.4,0c0,2.5,0,5.1,0,7.6C2,21.6,2.3,22,2.7,22c3.1,0,6.1,0,9.2,0
	c0.4,0,0.7-0.3,0.7-0.7c0.1-3.9,0.4-8.6-1.4-12.2c-0.4-0.8-1.1-1.9-2.1-1.9C8.2,7.2,8.2,8.6,9.1,8.6L9.1,8.6z"/>
                    <path d="M10.7,12c0.4,1.1,0.9,2.1,1.5,3.1c0.3,0.5,1.2,1.3,1.4,1.8c0.3,0.8-0.6,0.9-1.2,0.9c0.2,0.1,0.4,0.2,0.6,0.4
	c-0.1-0.2-0.3-0.4-0.4-0.6c-0.5-0.8-1.7,0-1.2,0.7c0.6,0.9,1.1,1.2,2.2,0.9c0.9-0.2,1.5-1,1.5-2c0-1.1-1-1.8-1.5-2.7
	c-0.6-0.9-1.1-1.9-1.4-2.9C11.7,10.7,10.3,11.1,10.7,12L10.7,12z"/>
                    <path d="M3.1,21.4c0.2,1.7,1.1,3.5,2.5,4.5c1.4,1,2.6,1.6,3.4,3.2c0.6,1.2,0.8,2.1,0.8,3.4c0,0.4,0.3,0.7,0.7,0.7c1.6,0,3.1,0,4.7,0
	c0.4,0,0.8-0.3,0.7-0.7c-0.2-1.5-0.6-3-1.1-4.4c-0.4-1.1-1-2.1-1.7-3.1c-0.7-0.9-3.2-2.3-2.9-3.6c0.2-0.9-1.1-1.3-1.4-0.4
	c-0.3,1.2,0.5,2.5,1.4,3.3c1.1,1,2.1,1.8,2.8,3.2c0.8,1.5,1.3,3.4,1.5,4.9c0.2-0.2,0.5-0.5,0.7-0.7c-1.6,0-3.1,0-4.7,0
	c0.2,0.2,0.5,0.5,0.7,0.7c0-2.4-1-4.9-2.9-6.4c-1.2-1-2.5-1.4-3.2-2.8c-0.3-0.7-0.6-1.4-0.7-2.2C4.4,20.1,3,20.5,3.1,21.4L3.1,21.4z
	"/>
                    <path d="M10.3,21.2c0,0.9,0,1.9,0,2.8c0,0.9,1.4,0.9,1.4,0c0-0.9,0-1.9,0-2.8C11.7,20.3,10.3,20.3,10.3,21.2L10.3,21.2z"/>
                    <path d="M4.9,25.1c0,2.5,0,5,0,7.4c0,0.4,0.3,0.7,0.7,0.7c1.6,0,3.3,0,4.9,0c0.9,0,0.9-1.4,0-1.4c-1.6,0-3.3,0-4.9,0
	c0.2,0.2,0.5,0.5,0.7,0.7c0-2.5,0-5,0-7.4C6.4,24.2,4.9,24.2,4.9,25.1L4.9,25.1z"/>
                    <path d="M10.7,32.3c-0.3,0.9-0.3,2.2,0.6,2.8c0.9,0.6,2.5,0.4,3.6,0.4c0.9,0,1.9,0.2,2.5-0.6c1-1.4-0.6-2.5-1.7-3
	c-0.8-0.4-1.6,0.9-0.7,1.2c0.6,0.2,0.9,0.6,1.3,0.9c0,0,0,0.1-0.1,0.1c0,0-0.1,0.1-0.1,0.1c-0.2,0.1,0,0.1,0.4-0.2
	c-0.1-0.2-1.9,0-2.1,0c-0.6,0-1.4,0.2-2,0c-0.6-0.2-0.5-0.8-0.3-1.3C12.3,31.8,11,31.5,10.7,32.3L10.7,32.3z"/>
                    <path d="M5.1,32.3c-0.3,0.9-0.3,2.1,0.6,2.8c0.9,0.6,2.5,0.4,3.6,0.4c0.9,0,1.9,0.2,2.4-0.6c1-1.4-0.6-2.5-1.7-3
	c-0.8-0.4-1.6,0.9-0.7,1.2c0.6,0.2,0.9,0.6,1.3,0.9c0,0,0,0.1-0.1,0.1c0,0-0.1,0.1-0.1,0.1c-0.2,0.1,0,0.1,0.4-0.2
	c-0.1-0.2-1.9,0-2.1,0c-0.6,0-1.4,0.2-2,0c-0.6-0.2-0.5-0.8-0.3-1.3C6.8,31.8,5.4,31.5,5.1,32.3L5.1,32.3z"/>
                    </svg> </span>
                    <label class="custom-control-label" for="deliveryType-foot">On Foot</label></label>
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
              <textarea id="itinerary_inclusions" class="form-control ignore" name="itinerary_inclusions" placeholder="Type down the inclusions (max 1000 characters)" data-rule-maxlength="1000" data-rule-required="true"><?php if(isset($draftData->itinerary_inclusions))echo $draftData->itinerary_inclusions;?></textarea>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Exclusions</label>
              <textarea id="itinerary_exclusions" class="form-control ignore" name="itinerary_exclusions" placeholder="Type down the exclusions (max 1000 characters)" data-rule-maxlength="1000" data-rule-required="true"><?php if(isset($draftData->itinerary_exclusions))echo $draftData->itinerary_exclusions;?></textarea>
            </li>
          </ul>
          <h3 class="col-form-label">Additional Details</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Special Mention</label>
              <textarea id="itinerary_splmention" class="form-control ignore" name="itinerary_splmention" placeholder="Type any special mentions (max 1500 characters)" data-rule-maxlength="1500" data-rule-required="true"><?php if(isset($draftData->itinerary_spl_mention))echo $draftData->itinerary_spl_mention;?></textarea>
            </li>
          </ul>
          
		  <!--<h3 class="col-form-label">Social Media Links</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-12">
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="socialShare-facebook" name="itinerary_allowshare_facebook" class="custom-control-input" value="1" <?php //if(isset($draftData->itinerary_allowshare_facebook)==1)echo 'checked';?> />
                <label class="custom-control-label" for="socialShare-facebook">Share on facebook</label>
              </div>
            </li>
            <li class="form-group col-12 col-md-12">
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="socialShare-instagram" name="itinerary_allowshare_instagram" class="custom-control-input" value="1" <?php //if(isset($draftData->itinerary_allowshare_instagram)==1)echo 'checked';?> />
                <label class="custom-control-label" for="socialShare-instagram">Share on Instagram</label>
              </div>
            </li>
          </ul>-->
		  
          <h3 id="fillFaq" class="col-form-label">FAQs</h3>
          <ul class="form-row no-gutters mb-4">
		   <?php
		     if(!empty($draFaqData)){
			  foreach($draFaqData as $key=>$faqs):
			  ?>
            <li class="form-group col-12 placeVaild">
              <div class="placeVaild">
                <label class="col-form-sublabel">Questions</label>
                <input type="text" name="itinerary_faq_question_01[]" class="form-control ignore" placeholder="Questions" id="faq_question_01" value="<?php echo $faqs->itinerary_faq_question;?>" data-rule-required="true"/>
              </div>
              <div class="placeVaild">
                <textarea name="itinerary_faq_answer_01[]" class="form-control mt-4 ignore" placeholder="Answer (max 1000 characters)" data-rule-maxlength="1000" id="faq_answer_01" data-rule-required="true"><?php echo $faqs->itinerary_faq_answer;?></textarea>
				<?php if($key>0)echo '<a href="#" class="btn btn-link removeQuestion">Remove</a>';?>
              </div>
            </li>
			<?php endforeach;}else{ ?>
			 <li class="form-group col-12">
              <label class="col-form-sublabel">Questions</label>
			  <div class="placeVaild">
              <input type="text" name="itinerary_faq_question_01[]" class="form-control ignore" placeholder="Questions" id="faq_question_01" 
			  data-rule-required="true"/>
			  </div>
			  <div class="placeVaild">
              <textarea name="itinerary_faq_answer_01[]" class="form-control mt-4 ignore" placeholder="Answer (max 1000 characters)" id="faq_answer_01" data-rule-required="true" data-rule-maxlength="1000"></textarea>
             </div>
			 </li>
				<?php } ?>
				
            <li class="col-12 col-md-12"> <a href="#" id="addQuestionLink" data-toggle="modal" data-target="#addQuestionModal" class="text-uppercase font-weight-bold">+ Add Another Question</a> </li>
          </ul>
          <h3 id="fillhost" class="col-form-label">ADDITIONAL CONTACT DETAILS</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">First Name</label>
              <input id="host_firstname" type="text" name="itinerary_host_firstname" class="form-control ignore" placeholder="First Name" 
			  value="<?php if(isset($draftData->host_first_name))echo $draftData->host_first_name;else{echo $hostProfile[0]->host_first_name;}?>" data-rule-required="true"/>
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Last Name</label>
              <input id="host_lastname" type="text" name="itinerary_host_lastname" class="form-control ignore" placeholder="Last Name"
			  value="<?php if(isset($draftData->host_last_name))echo $draftData->host_last_name;else{echo $hostProfile[0]->host_last_name;}?>" data-rule-required="true"/>
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Mobile</label>
			  <span class="mobileCheck">+91-</span>
              <input id="host_mobile" type="number" name="itinerary_host_mobile" class="form-control ignore" placeholder="Mobile Number" 
			  value="<?php if(isset($draftData->host_mob_num))echo $draftData->host_mob_num;else{echo $hostProfile[0]->host_mob_no;}?>" data-rule-required="true" maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter vaild mobile number"/>
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Email ID</label>
              <input id="host_email" type="email" name="itinerary_host_email" class="form-control ignore" placeholder="Email ID"  
			  value="<?php if(isset($draftData->host_email))echo $draftData->host_email;else{echo $hostProfile[0]->host_email;}?>" data-rule-required="true"/>
            </li>
          </ul>
          <h3 class="col-form-label">Emergency Contact</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Emergency Number</label>
			  <span class="mobileCheck">+91-</span>
              <input id="host_emergency_no" type="number" name="itinerary_host_emergency" class="form-control ignore" placeholder="Mobile Number" value="<?php if(isset($draftData->host_emergency_contact_num))echo $draftData->host_emergency_contact_num;?>" data-rule-required="true" maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter vaild mobile number"/>
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
    <input id="selectDateInput" name="itinerary_aviaiable_all_date" type="text" class="form-control" 
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
          <?php 
		      if(!empty($drafRouteTimeData)){
			   foreach($drafRouteTimeData as $routdata):
			  ?>
		  <ul class="form-row">		  
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Pick-Up Point</label>
                  <input id="pickup_point" type="text" name="itinerary_route_slot01_pickup[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="Pick-up Point" value="<?php echo $routdata->pickup_point;?>" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Start Time</label>
                  <input id="pickup_time" type="text" name="itinerary_route_slot01_pickup_time[]" class="form-control timepicker ignore"  placeholder="Time" value="<?php if(!empty($routdata->start_pickup_time))echo $routdata->start_pickup_time;else{echo '12:00 AM';}?>" data-rule-required="true" autocomplete="off"/>
                </div>
				<input type="hidden" name="pickup_coordinates[]" id="pickup_coordinates" value="<?php echo $routdata->pickup_lat_lng;?>"/>
              </div>
            </li>
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Drop-Off Point</label>
                  <input id="dropoff_point" type="text" name="itinerary_route_slot01_dropoff[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="Pick-up Point" value="<?php echo $routdata->drop_off_point;?>" data-rule-required="true" autocomplete="off" />
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">End Time</label>
                  <input id="dropend_time" type="text" name="itinerary_route_slot01_dropoff_time[]" class="form-control timepicker ignore" placeholder="Time" value="<?php if(!empty($routdata->end_dropoff_time))echo $routdata->end_dropoff_time;else{echo '12:00 AM';}?>" data-rule-required="true" autocomplete="off"/>
                </div>
				<input type="hidden" name="dropoff_coordinates[]" id="dropoff_coordinates" value="<?php echo $routdata->drop_off_lat_lng;?>"/>
              </div>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel">Total Duration(Hours)</label>
              <input id="route_slot01_duration" type="text" name="itinerary_route_slot01_duration[]" class="form-control hourpicker ignore" placeholder="Total Duration" value="<?php if(!empty($routdata->total_durations))echo $routdata->total_durations;else{echo '0:00';}?>" data-rule-required="true" autocomplete="off"/>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel">Cut-off Time(Hours) </label>
              <input id="route_slot01_cutofftime" type="text" name="itinerary_route_slot01_cutofftime[]" class="form-control cutoffpicker ignore" placeholder="Cut-off Time" value="<?php if(!empty($routdata->cutt_off_time))echo $routdata->cutt_off_time;else{echo '0:00';}?>" data-rule-required="true" autocomplete="off"/>
            </li>
          </ul>
          <ul class="form-row">
            <li class="form-group col-12">
              <label class="col-form-sublabel text-dark font-weight-semibold d-block">Default Stop</label>
              <div class="form-row">
                <div class="col-12 col-sm-7 placeVaild">
                  <label class="col-form-sublabel">Type a location</label>
                  <input id="route_slot01_stop01_location" type="text" name="itinerary_route_slot01_stop01_location[]" class="form-control ignore" placeholder="Type a location" value="<?php echo $routdata->stop_location;?>" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-4 offset-sm-1 placeVaild">
                  <label class="col-form-sublabel">Time</label>
                  <input id="route_slot01_stop01_time" type="text" name="itinerary_route_slot01_stop01_time[]" class="form-control timepicker ignore" placeholder="Time" value="<?php if(!empty($routdata->stop_time)){echo $routdata->stop_time;}else{echo '12:00 AM';}?>" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 pt-4 placeVaild">
                  <textarea id="route_slot01_stop01_description" class="form-control ignore" name="itinerary_route_slot01_stop01_description[]" placeholder="Add a description" data-rule-required="true"><?php echo $routdata->description;?></textarea>
                </div>
              </div>
            </li>
            <!--<li class="form-group col-12"> <a href="#" class="text-uppercase font-weight-bold" id="addStopLink" data-toggle="modal" data-target="#addStopModal" >+ Add Another Stop</a></li>-->
          </ul>
		  <?php endforeach;}else{ ?>
		   <ul class="form-row">		  
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Pick-Up Point</label>
                  <input id="pickup_point" type="text" name="itinerary_route_slot01_pickup[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="Pick-up Point" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Start Time</label>
                  <input id="pickup_time" type="text" name="itinerary_route_slot01_pickup_time[]" class="form-control timepicker ignore" value="12:00AM" placeholder="Time" data-rule-required="true" autocomplete="off"/>
                </div>
				<input type="hidden" name="pickup_coordinates[]" id="pickup_coordinates"/>
              </div>
            </li>
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Drop-Off Point</label>
                  <input id="dropoff_point" type="text" name="itinerary_route_slot01_dropoff[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="Pick-up Point" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">End Time</label>
                  <input id="dropend_time" type="text" name="itinerary_route_slot01_dropoff_time[]" class="form-control timepicker ignore" value="12:00AM" placeholder="Time" data-rule-required="true" autocomplete="off"/>
                </div>
				<input type="hidden" name="dropoff_coordinates[]" id="dropoff_coordinates"/>
              </div>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel">Total Duration(Hours)</label>
              <input id="route_slot01_duration" type="text" name="itinerary_route_slot01_duration[]" value="0:00" class="form-control hourpicker ignore" placeholder="Total Duration" data-rule-required="true" autocomplete="off"/>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel">Cut-off Time(Hours)</label>
              <input id="route_slot01_cutofftime" type="text" name="itinerary_route_slot01_cutofftime[]" class="form-control cutoffpicker ignore" value="0:00" placeholder="Cut-off Time" data-rule-required="true" autocomplete="off"/>
            </li>
          </ul>
          <ul class="form-row">
            <li class="form-group col-12">
              <label class="col-form-sublabel text-dark font-weight-semibold d-block">Default Stop</label>
              <div class="form-row">
                <div class="col-12 col-sm-7 placeVaild">
                  <label class="col-form-sublabel">Type a location</label>
                  <input id="route_slot01_stop01_location" type="text" name="itinerary_route_slot01_stop01_location[]" class="form-control ignore" placeholder="Type a location" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-4 offset-sm-1 placeVaild">
                  <label class="col-form-sublabel">Time</label>
                  <input id="route_slot01_stop01_time" type="text" name="itinerary_route_slot01_stop01_time[]" class="form-control timepicker ignore" value="12:00AM" placeholder="Time" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 pt-4 placeVaild">
                  <textarea id="route_slot01_stop01_description" class="form-control ignore" name="itinerary_route_slot01_stop01_description[]" placeholder="Add a description" data-rule-required="true"></textarea>
                </div>
              </div>
            </li>
            <!--<li class="form-group col-12"> <a href="#" class="text-uppercase font-weight-bold" id="addStopLink" data-toggle="modal" data-target="#addStopModal" >+ Add Another Stop</a></li>-->
          </ul>
		 <?php } ?>
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
					if(@$draftData->nearest_airport==$airports->airport_name){
						 $selected = 'selected';
						}else{
						 $selected = '';
						}
				 ?>
				 <option value="<?php echo $airports->airport_name;?>" <?php echo $selected;?> ><?php echo $airports->airport_name;?></option>
				 <?php endforeach;?>
			  </select>
			  
			  <!--<input type="text" id="connectivity_airport" class="form-control ignore" name="itinerary_connectivity_airport" 
			   value="<?php //if(isset($draftData->nearest_airport))echo $draftData->nearest_airport;?>" data-rule-required="true"/>-->
               
            </li>
            <li class="form-group col-12 col-md-6 placeVaild">
            <label class="col-form-sublabel">Nearest Railway Station</label>
             <select id="connectivity_railway" class="form-control ignore" name="itinerary_connectivity_railway" data-rule-required="true">
                <option value="">Select</option>
                <?php foreach($railwayData as $railways):
					if(@$draftData->nearest_railway_station==$railways->railway_name){
						 $selected = 'selected';
						}else{
						 $selected = '';
						}
				 ?>
				 <option value="<?php echo $railways->railway_name;?>" <?php echo $selected;?> ><?php echo $railways->railway_name;?></option>
				 <?php endforeach;?>              
			  </select>
			<!-- <input type="text" id="connectivity_railway" class="form-control ignore" name="itinerary_connectivity_railway"  
			   value="<?php //if(isset($draftData->nearest_railway_station))echo $draftData->nearest_railway_station;?>" data-rule-required="true"/>-->             
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Location Covered</label>
              <input id="location_covered"  type="text" class="form-control ignore" name="itinerary_location_covered" placeholder="Location Covered" value="<?php if(isset($draftData->location_covered))echo $draftData->location_covered;?>" data-rule-required="true"/>
            </li>
          </ul>
          <h3 id="fillTraveller" class="col-form-label mt-2">Traveller Specifications</h3>
          <div class="placeVaild">
            <ul class="form-row">
              <li class="form-group col-12 col-md-12 pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-private" name="itinerary_traveller_private" class="custom-control-input ignore" value="1"  <?php if(isset($draftData->private_traveller)==1)echo 'checked';?> data-rule-required="true" />
                      <label class="custom-control-label font-weight-semibold" for="travellerType-private">Private</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Travellers</label>
                    <input id="private_min_no_travllers" type="number" name="itinerary_traveller_private_minnumber" class="form-control ignore" placeholder="0" min="1"  value="<?php if(isset($draftData->private_min_no_travellers))
					  echo $draftData->private_min_no_travellers;else{echo '1';}?>" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Travellers</label>
                    <input type="number" name="itinerary_traveller_private_maxnumber" class="form-control ignore" placeholder="0" min="1" id="private_max_no_travllers" value="<?php if(isset($draftData->private_max_no_travellers))
					  echo $draftData->private_max_no_travellers;?>" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
              <li class="form-group col-12 col-md-12 pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-group" name="itinerary_traveller_group" class="custom-control-input ignore" value="1"
					  <?php if(isset($draftData->group_traveller)==1)echo 'checked';?> />
                      <label class="custom-control-label font-weight-semibold" for="travellerType-group">Group</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Travellers</label>
                    <input id="group_min_no_travllers"  type="number" class="form-control ignore" name="itinerary_traveller_group_minnumber" placeholder="0" min="1" value="<?php if(isset($draftData->group_min_no_travellers))
					  echo $draftData->group_min_no_travellers;else{echo '1';}?>" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Travellers</label>
                    <input id="group_max_no_travllers" type="number"  class="form-control ignore" name="itinerary_traveller_group_maxnumber" placeholder="0" min="1" value="<?php if(isset($draftData->group_max_no_travellers))
					  echo $draftData->group_max_no_travellers;?>" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
			   <?php
			  $drafFamilyData = json_decode(json_encode($drafFamilyData), true);
			  if(!empty($drafFamilyData))
			  {
				  foreach($drafFamilyData as $key => $value)
				  {
					  if($value["family_kides_below_age"]==10)
					  {
						  $ageTenKey = $key;
					  }
					  if($value["family_kides_below_age"]==7)
					  {
						  $ageSevenKey = $key;
					  }
					  if($value["family_kides_below_age"]==5)
					  {
						  $ageFiveKey = $key;
					  }
				  }
			  }
			  
			if(!empty($drafFamilyData)){			
			?>
              <li class="form-group col-12 col-sm-6 mb-1  pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-family" name="itinerary-traveller-family" class="custom-control-input ignore" value="1" <?php echo isset($drafFamilyData[0]["family_traveller"]) && $drafFamilyData[0]["family_traveller"]==1 ? "checked" : ""; ?> >
                      <label class="custom-control-label font-weight-semibold" for="travellerType-family">Family</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Adult - Min. No.</label>
                    <input type="number" class="form-control ignore disabledDad " name="itinerary_traveller_family_adult_minnumber" placeholder="0" min="1" id="adult_min_no" value="<?php echo isset($drafFamilyData[0]["family_adult_min_no"]) ? $drafFamilyData[0]["family_adult_min_no"] : ""; ?>" data-rule-required="true" disabled />
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Adult - Max. No.</label>
                    <input type="number" class="form-control ignore disabledDad " name="itinerary_traveller_family_adult_maxnumber" placeholder="0" id="adult_max_no" value="<?php echo isset($drafFamilyData[0]["family_adult_max_no"]) ? $drafFamilyData[0]["family_adult_max_no"] : ""; ?>" data-rule-required="true" disabled />
                  </div>
                </div>
              </li>              
              <li class="form-group col-12 col-sm-6 pt-2" data-id="kids-1">
                <div class="form-row">
                  <div class="col-12 col-sm-4  placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-2 pb-1">
                      <input id="travellerType-kids-below10" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore disabledDad keepCheck" value="10" <?php echo isset($ageTenKey) ? "checked" : ""; ?> data-rule-required="true"  disabled />
                      <label class="custom-control-label" for="travellerType-kids-below10">Below 10</label>
                    </div>
                   </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input id="family_kids_min_no" type="number" class="form-control ignore disabledPaa" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="<?php echo isset($ageTenKey) ? $drafFamilyData[$ageTenKey]["min_no_kides"] : "1"; ?>" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input id="family_kids_max_no" type="number" class="form-control ignore disabledPaa" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" value="<?php echo isset($ageTenKey) ? $drafFamilyData[$ageTenKey]["max_no_kides"] : ""; ?>" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
              <li class="form-group col-12 col-sm-6 pt-2 offset-0 offset-sm-6" data-id="kids-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-2 pb-1">
                      <input id="travellerType-kids-below7" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore disabledDad keepCheck" value="7" <?php echo isset($ageSevenKey) ? "checked" : ""; ?> data-rule-required="true" disabled />
                      <label class="custom-control-label" for="travellerType-kids-below7">Below 7</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input type="number" class="form-control append_min_val disabledPaa" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="<?php echo isset($ageSevenKey) ? $drafFamilyData[$ageSevenKey]["min_no_kides"] : "1"; ?>" data-rule-required="true" disabled>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input type="number" class="form-control append_max_val disabledPaa" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" data-rule-required="true" value="<?php echo isset($ageSevenKey) ? $drafFamilyData[$ageSevenKey]["max_no_kides"] : ""; ?>" disabled>
                  </div>
                </div>
              </li>
              <li class="form-group col-12 col-sm-6 pt-2 offset-0 offset-sm-6" data-id="kids-3">
                <div class="form-row">
                  <div class="col-12 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-2 pb-1">
                      <input id="travellerType-kids-below5" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore disabledDad keepCheck" value="5" <?php echo isset($ageFiveKey) ? "checked" : ""; ?> data-rule-required="true" disabled />
                      <label class="custom-control-label" for="travellerType-kids-below5">Below 5</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input type="number" class="form-control append_min_val disabledPaa" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="<?php echo isset($ageFiveKey) ? $drafFamilyData[$ageFiveKey]["min_no_kides"] : "1"; ?>" data-rule-required="true" disabled>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input type="number" class="form-control append_max_val disabledPaa" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" data-rule-required="true" value="<?php echo isset($ageFiveKey) ? $drafFamilyData[$ageFiveKey]["max_no_kides"] : ""; ?>" disabled >
                  </div>
                </div>
              </li>
              <?php 
			  } else { ?>
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
                    <input type="number" class="form-control ignore disabledDad " name="itinerary_traveller_family_adult_minnumber" placeholder="0" min="1" id="adult_min_no" data-rule-required="true" value="1" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Adult - Max. No.</label>
                    <input type="number" class="form-control ignore disabledDad " name="itinerary_traveller_family_adult_maxnumber" placeholder="0" id="adult_max_no" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
             <li class="form-group col-12 col-sm-6 pt-2" data-id="kids-1">
                <div class="form-row">
                  <div class="col-12 col-sm-4  placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-2 pb-1">
                      <input id="travellerType-kids-below10" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore keepCheck" value="10" data-rule-required="true" checked disabled />
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
                    <div class="custom-control custom-checkbox custom-control-inline pt-2 pb-1">
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
                    <div class="custom-control custom-checkbox custom-control-inline pt-2 pb-1">
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
              <?php } ?>
            </ul>
          </div>
        </fieldset>
        <fieldset>
          <h3 id="fillPrice" class="col-form-label mt-2">Price Chart</h3>
          <label class="col-form-sublabel mb-3">Enter pricing details <small>(Prices will be added per participant - All prices are in INR)</small></label>
          <ul class="form-row">
            <li data-rel="privateCheck" class="form-group col-12 col-md-12 hidden">
              <div class="form-row">
                <div class="col-12 col-sm-3">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Private</label>
                </div>
                <div class="col-12 col-sm-4 placeVaild">
                  <label class="col-form-sublabel">Price</label>
                  <input id="itinerary_private_price" type="number" class="form-control ignore" name="itinerary_traveller_private_price"  placeholder="0" value="<?php if(isset($draftData->private_price))echo $draftData->private_price;?>" data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="groupCheck" class="form-group col-12 col-md-12 hidden">
              <div class="form-row">
                <div class="col-12 col-sm-3">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Group</label>
                </div>
                <div class="col-12 col-sm-4 placeVaild">
                  <label class="col-form-sublabel">Price</label>
                  <input id="itinerary_group_price" type="number" class="form-control ignore" name="itinerary_traveller_group_price" placeholder="0" value="<?php if(isset($draftData->group_price))echo $draftData->group_price;?>" data-rule-required="true"/>
                </div>
              </div>
            </li>
            <?php
				if(!empty($drafFamilyData)){?>
				
            <li  data-rel="familyCheck"  class="form-group col-12 col-md-6 hidden ">
              <div class="form-row">               
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Family</label>
                </div>
                <div class="col-6 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Price (Adults)</label>
                  <input type="number" class="form-control ignore" name="itinerary_traveller_family_adult_price[]" placeholder="0" id="itinerary_family_adult_price" value="<?php echo $drafFamilyData[0]["adults_price"]; ?>" data-rule-required="true"/>
                </div>                
              </div>
            </li>          
             <li data-rel="familyCheck" data-id="familyKidCheck-01" class="form-group col-12 col-md-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input id="itinerary_family_kids_age" type="text" class="form-control ignore" value="Below 10" name="itinerary_traveller_family_kids01_age[]"  data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid" placeholder="0" name="itinerary_traveller_family_kids01_price[]" value="<?php echo isset($ageTenKey) ? $drafFamilyData[$ageTenKey]["kides_price"] : ""; ?>" data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="familyCheck" data-id="familyKidCheck-02" class="form-group col-12 col-md-6 offset-0 offset-sm-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input type="text" class="form-control ignore" value="Below 7" name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid"  placeholder="0" name="itinerary_traveller_family_kids01_price[]" value="<?php echo isset($ageSevenKey) ? $drafFamilyData[$ageSevenKey]["kides_price"] : ""; ?>" disabled data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="familyCheck" data-id="familyKidCheck-03" class="form-group col-12 col-md-6 offset-0 offset-sm-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input  type="text" class="form-control ignore priceKid" value="Below 5" name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid"  placeholder="0" name="itinerary_traveller_family_kids01_price[]" value="<?php echo isset($ageFiveKey) ? $drafFamilyData[$ageFiveKey]["kides_price"] : ""; ?>" disabled data-rule-required="true"/>
                </div>
              </div>
            </li>            
            <?php 
			} else{ ?>
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
                  <input id="itinerary_family_kids_age" type="text" class="form-control ignore" value="Below 10" name="itinerary_traveller_family_kids01_age[]"  data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid" placeholder="0" name="itinerary_traveller_family_kids01_price[]"  data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="familyCheck" data-id="familyKidCheck-02" class="form-group col-12 col-md-6 offset-0 offset-sm-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input type="text" class="form-control ignore" value="Below 7" name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid" placeholder="0" name="itinerary_traveller_family_kids01_price[]"  disabled data-rule-required="true"/>
                </div>
              </div>
            </li>
            <li data-rel="familyCheck" data-id="familyKidCheck-03" class="form-group col-12 col-md-6 offset-0 offset-sm-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input  type="text" class="form-control ignore priceKid" value="Below 5" name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid"  placeholder="0" name="itinerary_traveller_family_kids01_price[]"   disabled data-rule-required="true"/>
                </div>
              </div>
            </li>            
            <?php } ?>
          </ul>
          <h3 class="col-form-label mt-2">Additional Costs</h3>
          <?php
		$additional_draftData = json_decode(json_encode($draftData), true);
		if(isset($additional_draftData["additional_cost_description"]) && !empty($additional_draftData["additional_cost_description"])) {
		$costData = json_decode($additional_draftData["additional_cost_description"],true);
		$countCostData = count($costData);
		foreach($costData as $key => $value) {
		?>
		<ul>
		<li class="form-row">
		<div class="form-group col-12 col-sm-6 placeVaild">
		  <label class="col-form-sublabel">Item</label>
		  <input type="text" class="form-control ignore" name="itinerary_additionalcost_description[]" placeholder="Item description" id="additionalcost_desc" value="<?php echo $value["itinerary_additionalcost_description"]; ?>" />
		</div>
		<div class="form-group col-12 col-sm-6 placeVaild">
		  <label class="col-form-sublabel">Price</label>
		  <input type="number" class="form-control ignore" name="itinerary_additionalcost_amt[]" placeholder="Price" id="additionalcost_amt" value="<?php echo $value["additional_price"]; ?>" />
		</div>
		
		<?php if($key!=0) { ?>
			<div class="form-group col-12 "><a href="#" class="btn btn-link removeItems pt-0">Remove</a></div>
		<?php } ?>
		
		</li>
		
		<?php if($key+1==$countCostData) { ?>
		<li class=" text-right"> <a href="#" id="addItemLink" data-toggle="modal" data-target="#addItemsModal" class="text-uppercase font-weight-bold mb-2 pt-0">+ Add More</a> </li>
		<?php } ?>
		
		</ul>
		<?php } }
		else { ?>
		<ul>
		 <li class="form-row">
		<div class="form-group col-12 col-sm-6 placeVaild">
		<label class="col-form-sublabel">Item</label>
		<input type="text" class="form-control ignore" name="itinerary_additionalcost_description[]" placeholder="Item description" id="additionalcost_desc" value="<?php if(isset($draftData->additional_cost_description))
		   echo $draftData->additional_cost_description;?>"/>
		</div>
		<div class="form-group col-12 col-sm-6 placeVaild">
		  <label class="col-form-sublabel">Price</label>
		  <input type="number" class="form-control ignore" name="itinerary_additionalcost_amt[]" placeholder="Price" id="additionalcost_amt" value="<?php if(isset($draftData->additional_price))echo $draftData->additional_price;?>" />
		</div>
		</li>
		<li class="text-right"> <a href="#" id="addItemLink" data-toggle="modal" data-target="#addItemsModal" class="text-uppercase font-weight-bold mb-2 pt-0">+ Add More</a> </li>
		</ul>
		<?php } ?>
          
		  <!--<h3 id="fillConfirmation" class="col-form-label mt-2 mb-3">Confirmation & Review </h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Confirmation type</label>
              <div class="custom-control custom-radio custom-control-inline ml-3">
                <input type="radio" id="confirmationType-instant" name="itinerary-confirmationtype" value="instant" class="custom-control-input ignore" data-rule-required="true" <?php //echo @$draftData->confirmation_type=='instant'?'checked="checked"':'';?> />
                <label class="custom-control-label" for="confirmationType-instant">Instant</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline ml-3">
                <input type="radio" id="confirmationType-review" name="itinerary-confirmationtype" value="review" class="custom-control-input" 
				<?php //echo @$draftData->confirmation_type=='review'?'checked="checked"':'';?> />
                <label class="custom-control-label" for="confirmationType-review">Review</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Instant Confirmation Message</label>
              <textarea id="instant_conf_msg" class="form-control ignore" placeholder="Type the message" name="itinerary_confirmationtype_msg"  data-rule-required="true"><?php //if(isset($draftData->Instant_confirmation_message))echo $draftData->Instant_confirmation_message;?></textarea>
            </li>
          </ul>-->
		  
          <h3 id="fillCancellations" class="col-form-label mt-2">Cancellations</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild cancelRadio-01">
              <label class="col-form-sublabel">Done By You(Host)</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebyhost) > 500 ? substr($legalData[0]->preview_cancel_donebyhost,0,500)."..." : $legalData[0]->preview_cancel_donebyhost;?> <a href="javascript:void(0);"  data-ref="done_host" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelByHostInput-other-yes" name="itinerary-cancellations-agree" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->itinerary_cancelbyhost_agree==1?'checked="checked"':'';?> />
                <label class="custom-control-label" for="cancelByHostInput-other-yes">I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelByHostInput-other-no" name="itinerary-cancellations-agree" value="0" class="custom-control-input" 
				<?php echo @$draftData->itinerary_cancelbyhost_agree==''?'':(@$draftData->itinerary_cancelbyhost_agree==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="cancelByHostInput-other-no"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild cancelRadio-02">
              <label class="col-form-sublabel">Done By traveller</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebytraveller) > 500 ? substr($legalData[0]->preview_cancel_donebytraveller,0,500)."..." : $legalData[0]->preview_cancel_donebytraveller;?> <a href="javascript:void(0);"  data-ref="done_traveller" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelBytravellerInput-other-yes" name="itinerary-donetraveller-agree" value="1" class="custom-control-input ignore" <?php echo @$draftData->itinerary_cancelbytraveller_agree==1?'checked="checked"':'';?> data-rule-required="true"/>
                <label class="custom-control-label" for="cancelBytravellerInput-other-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelBytravellerInput-other-no" name="itinerary-donetraveller-agree" value="0" class="custom-control-input"
				<?php echo @$draftData->itinerary_cancelbytraveller_agree==''?'':(@$draftData->itinerary_cancelbytraveller_agree==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="cancelBytravellerInput-other-no"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild cancelRadio-03">
              <label class="col-form-sublabel">Refund</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_refund) > 500 ? substr($legalData[0]->preview_cancel_refund,0,500)."..." : $legalData[0]->preview_cancel_refund;?> <a href="javascript:void(0);"  data-ref="done_refund" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="refundCheckInput-other-yes" name="itinerary-refund-agree" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->itinerary_refund_agree==1?'checked="checked"':'';?>/>
                <label class="custom-control-label" for="refundCheckInput-other-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="refundCheckInput-other-no" name="itinerary-refund-agree" value="0" class="custom-control-input"
				<?php echo @$draftData->itinerary_refund_agree==''?'':(@$draftData->itinerary_refund_agree==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="refundCheckInput-other-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <h3 id="fillVideo" class="col-form-label mt-2">Video</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Add a video <small>(*Required size less than 10mb and format .mp4 only)</small> </label>
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore vidInput" name="itinerary_gallery_video" id="add_video" accept="video/mp4" data-size="10240" data-msg-extension="Please upload file in video(.mp4) format only" />
              <input id="add_video_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_hide_video"  value="<?php if(@$draftData->video!='')echo $draftData->video;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->video!='' && @$draftData->video!=null) echo 'style="display:none"'; ?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Video</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow" <?php if(@$draftData->video!='' && @$draftData->video!=null) echo 'style="display:block"'; ?>>
                <p class="text-primary"><?php if(@$draftData->video!='')echo $draftData->video;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
          </ul>
          <h3 id="fillImage" class="col-form-label mt-2">Image Gallery</h3>
       		  <small class="text-muted">*Required dimension 1440 X 1053px, size less than 10mb and format .jpg,.jpeg only</small>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="dragImageBox">
              <input id="image_gallery" type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_cover"  accept="image/jpg, image/jpeg" data-height="1053" data-width="1440" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only"  />
              <input id="image_gallery_check" type="text" class="form-control lowKey ignore"  name="itinerary_gallery_hide_image_cover" value="<?php if(@$draftData->feature_img!='')echo $draftData->feature_img;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->feature_img!='' && @$draftData->feature_img!=null)echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow" <?php if(@$draftData->feature_img!='' && @$draftData->feature_img!=null)echo 'style="display:block"';?>>
                <p class="text-primary"><?php if(@$draftData->feature_img!='')echo $draftData->feature_img;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
          </ul>
          <h3 class="col-form-sublabel mt-2">Additional Images</h3>
      		  <small class="text-muted">*Required dimension 250 X 158px, size less than 10mb and format .jpg,.jpeg only</small>
          <ul class="form-row">
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input id="additional_image_1" type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_01" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only"  />
              <input id="additional_image_1_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_image_hide_01" value="<?php if(@$draftData->additional_img_1!='')echo $draftData->additional_img_1;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->additional_img_1!='' && @$draftData->additional_img_1!=null) echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow" <?php if(@$draftData->additional_img_1!='' && @$draftData->additional_img_1!=null) echo 'style="display:block"';?>>
                <p class="text-primary"><?php if(@$draftData->additional_img_1!='')echo $draftData->additional_img_1;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input id="additional_image_2" type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_02" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only"  />
              <input id="additional_image_2_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_image_hide_02" value="<?php if(@$draftData->additional_img_2!='')echo $draftData->additional_img_2;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->additional_img_2!='' && @$draftData->additional_img_2!=null) echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow" <?php if(@$draftData->additional_img_2!='' && @$draftData->additional_img_2!=null) echo 'style="display:block"';?>>
                <p class="text-primary"><?php if(@$draftData->additional_img_2!='')echo $draftData->additional_img_2;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input id="additional_image_3" type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_03" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="additional_image_3_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_image_hide_03" value="<?php if(@$draftData->additional_img_3!='')echo $draftData->additional_img_3;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->additional_img_3!='' && @$draftData->additional_img_3!=null) echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Drag file here or click to upload</span> </div>
              <div class="infoShow" <?php if(@$draftData->additional_img_3!='' && @$draftData->additional_img_3!=null) echo 'style="display:block"';?>>
                <p class="text-primary"><?php if(@$draftData->additional_img_3!='')echo $draftData->additional_img_3;?></p>
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
                <input type="radio" id="disclaimerCheckInput-yes" name="itinerary-disclaimer-agree" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->itinerary_liabilitie_disclaimer==1?'checked="checked"':'';?> />
                <label class="custom-control-label" for="disclaimerCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="disclaimerCheckInput-no" name="itinerary-disclaimer-agree" value="0" class="custom-control-input" 
				<?php echo @$draftData->itinerary_liabilitie_disclaimer==''?'':(@$draftData->itinerary_liabilitie_disclaimer==0?'checked="checked"':'');?>/>
                <label class="custom-control-label" for="disclaimerCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalPrivacy" class="col-form-label mt-2">Privacy Policy</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_privacy_policy) > 500 ? substr($legalData[0]->preview_privacy_policy,0,500)."..." : $legalData[0]->preview_privacy_policy;?> <a href="javascript:void(0);" data-ref="privacy_policy" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="privacyCheckInput-yes"  name="itinerary-privacy-agree" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->itinerary_privacy_policy==1?'checked="checked"':'';?>/>
                <label class="custom-control-label" for="privacyCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="privacyCheckInput-no" name="itinerary-privacy-agree" value="0" class="custom-control-input"
				<?php echo @$draftData->itinerary_privacy_policy==''?'':(@$draftData->itinerary_privacy_policy==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="privacyCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalTerms" class="col-form-label mt-2">Terms & Conditions</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_terms_condition) > 500 ? substr($legalData[0]->preview_terms_condition,0,500)."..." : $legalData[0]->preview_terms_condition;?> <a href="javascript:void(0);"  data-ref="term_condition" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="termsCheckInput-yes" name="itinerary-terms-agree" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->itinerary_terms_condition==1?'checked="checked"':'';?> />
                <label class="custom-control-label" for="termsCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="termsCheckInput-no" name="itinerary-terms-agree" value="0" class="custom-control-input"
				<?php echo @$draftData->itinerary_terms_condition==''?'':(@$draftData->itinerary_terms_condition==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="termsCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalCancellations" class="col-form-label mt-2">Cancellations</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild cancelRadio-01">
              <label class="col-form-sublabel">Done By You(Host)</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebyhost) > 500 ? substr($legalData[0]->preview_cancel_donebyhost,0,500)."..." : $legalData[0]->preview_cancel_donebyhost;?> <a href="javascript:void(0);" data-ref="done_host" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelByHostInput-yes1" name="itinerary-cancelbyHost-agree-copy" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->last_doneby_host==1?'checked="checked"':''?> />
                <label class="custom-control-label" for="cancelByHostInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelByHostInput-no1" name="itinerary-cancelbyHost-agree-copy" value="0" class="custom-control-input" 
				<?php echo @$draftData->last_doneby_host==''?'':(@$draftData->last_doneby_host==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="cancelByHostInput-no1"> I Don't Agree </label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild cancelRadio-02">
              <label class="col-form-sublabel">Done By traveller</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebytraveller) > 500 ? substr($legalData[0]->preview_cancel_donebytraveller,0,500)."..." : $legalData[0]->preview_cancel_donebytraveller;?> <a href="javascript:void(0);"  data-ref="done_traveller" class="text-primary read_popup">View More</a></p> 
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelBytravellerInput-yes1" name="itinerary-cancelbytraveller-agree-copy" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->last_doneby_traveller==1?'checked="checked"':''?>/>
                <label class="custom-control-label" for="cancelBytravellerInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelBytravellerInput-no1" name="itinerary-cancelbytraveller-agree-copy" value="0" class="custom-control-input"
				<?php echo @$draftData->last_doneby_traveller==''?'':(@$draftData->last_doneby_traveller==0?'checked="checked"':'')?> />
                <label class="custom-control-label" for="cancelBytravellerInput-no1"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild cancelRadio-03">
              <label class="col-form-sublabel">Refund</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_refund) > 500 ? substr($legalData[0]->preview_cancel_refund,0,500)."..." : $legalData[0]->preview_cancel_refund;?> <a href="javascript:void(0);"  data-ref="done_refund" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="refundCheckInput-yes1" name="itinerary-refund-agree-copy" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->last_refund==1?'checked="checked"':''?> />
                <label class="custom-control-label" for="refundCheckInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="refundCheckInput-no1" name="itinerary-refund-agree-copy" value="0" class="custom-control-input"
				<?php echo @$draftData->last_refund==''?'':(@$draftData->last_refund==0?'checked="checked"':'')?> />
                <label class="custom-control-label" for="refundCheckInput-no1"> I Don't Agree</label>
              </div>
            </li>
          </ul>
          <h3 id="fillLegalCopyright" class="col-form-label mt-2">Media Infringement</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <p class="pt-2 pb-2"><?php echo strlen($legalData[0]->preview_media_infringement) > 200 ? substr($legalData[0]->preview_media_infringement,0,200)."..." : $legalData[0]->preview_media_infringement;?> <a href="javascript:void(0);" data-ref="media_infri" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="copyrightCheckInput-yes"  name="itinerary-copyright-agree" value="1" class="custom-control-input ignore" data-rule-required="true" <?php echo @$draftData->media_infringement==1?'checked="checked"':'';?> />
                <label class="custom-control-label" for="copyrightCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="copyrightCheckInput-no" name="itinerary-copyright-agree" value="0" class="custom-control-input"
				<?php echo @$draftData->media_infringement==''?'':(@$draftData->media_infringement==0?'checked="checked"':'');?> />
                <label class="custom-control-label" for="copyrightCheckInput-no"> I Don't Agree</label>
              </div>
            </li>
          </ul>
		 <h3 id="fillLegalCopyright" class="col-form-label mt-2">Terms &amp; Conditions</h3>		 
		 <ul class="form-row">
            <li class="form-group col-12 placeVaild">              
              <div class="custom-control custom-checkbox custom-control-inline">
                <input type="checkbox" id="term_policy"  name="term_condition" value="1" <?php echo @$draftData->term_condition==1?'checked="checked"':'';?> class="custom-control-input ignore" data-rule-required="true" data-msg-required="If you need any clarification or have a question, please email us at help@iwl.com."/>
                <label class="custom-control-label" for="term_policy"> I agree to the <a href="#" target="_blank" data-toggle="modal" data-target="#tcModal">Terms &amp; Conditions</a></label>
              </div>             
            </li>
         </ul>
        </fieldset>
        <button id="saveForm" type="submit" class="btn btn-primary hidden">Draft</button>
        <button id="doneForm" type="submit" class="btn btn-primary hidden">Submit</button>
      </form>
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
              <div class="placeVaild">
                <input id="add_newQues" type="text" name="new-question" class="form-control" placeholder="Questions" required/>
              </div>
              <div class="placeVaild">
                <textarea id="add_newAns" class="form-control mt-4" name="new-answer" placeholder="Answer (max 1000 characters)" required data-rule-maxlength="1000" ></textarea>
              </div>
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button> </div>
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
        <h5 class="modal-title" >Guidelines</h5>
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
			var shortAddress  = fullAddress.split(',').slice(0,-3).join(',');
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
    var autocomplete = new google.maps.places.Autocomplete(input,{
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
var draftUpdateMsg = '<?php if($this->session->flashdata('success')=='experience_draft' || $this->session->flashdata('success')==       'draftupdate') echo 'draftupdate';?>';
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
		  $(document).on('focus', 'input[type=number]', function(e) {
		      $(this).on('mousewheel.disableScroll', function(e) {
		          e.preventDefault()
		      })
		  });

		  $(document).on('blur', 'input[type=number]', function(e) {
		      $(this).off('mousewheel.disableScroll')
		  });

		  // VALIDATE FORM ON LOAD 
		  var validator = $("#formItinerary").validate({
		      errorElement: 'small',
		      errorPlacement: function(error, element) {
		          error.appendTo(element.closest(".placeVaild"));
		      }
		  });

		  // CHECK RADIO
		  $('.cancelRadio-01').each(function() {
		      var $this = $(this);
		      var input = $this.find('input');
		      input.change(function() {
		          if ($(this).val() == '1') {
		              $('.cancelRadio-01').find('input[value="' + $(this).val() + '"]').prop('checked', true);
		          } else {
		              $('.cancelRadio-01').find('input[value="' + $(this).val() + '"]').prop('checked', true);
		          }
		      });
		  });

		  $('.cancelRadio-02').each(function() {
		      var $this = $(this);
		      var input = $this.find('input');
		      input.change(function() {
		          if ($(this).val() == '1') {
		              $('.cancelRadio-02').find('input[value="' + $(this).val() + '"]').prop('checked', true);
		          } else {
		              $('.cancelRadio-02').find('input[value="' + $(this).val() + '"]').prop('checked', true);
		          }
		      });
		  });

		  $('.cancelRadio-03').each(function() {
		      var $this = $(this);
		      var input = $this.find('input');
		      input.change(function() {
		          if ($(this).val() == '1') {
		              $('.cancelRadio-03').find('input[value="' + $(this).val() + '"]').prop('checked', true);
		          } else {
		              $('.cancelRadio-03').find('input[value="' + $(this).val() + '"]').prop('checked', true);
		          }
		      });
		  });

		  // ADD & REMOVE FAQ QUESTIONS
		  $("#newQuestionForm").validate({
		      errorElement: 'small',
		      submitHandler: function() {
		          var addnewQues = $('#add_newQues').val();
		          var addnewAns = $('#add_newAns').val();
		          var data = $('<li class="form-group col-12"><div class="placeVaild"><label class="col-form-sublabel">Questions</label><input type="text" name="itinerary_faq_question_01[]" class="form-control ignore" placeholder="Questions" data-rule-required="true" value="' + addnewQues + '"/></div><div class="placeVaild"><textarea class="form-control mt-4 ignore" name="itinerary_faq_answer_01[]" placeholder="Answer (max 200 characters)" data-rule-required="true">' + addnewAns + '</textarea></div><a href="#" class="btn btn-link removeQuestion">Remove</a></li>');
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


		  $('#addQuestionModal').on('hidden.bs.modal', function() {
		      $('#add_newQues, #add_newAns').val('');
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
		  $("#typeThemes").select2({
		      placeholder: 'Select themes',
		      tokenSeparators: [',', ' ']
		  });

		  // HIGHLIGHT AUTOCOMPLETE
		  $("#typeHighlights").select2({
		      placeholder: 'Select highlight',
		      tags: true,
		      tokenSeparators: [',', ' ']
		  });

		  // FEATURE AUTOCOMPLETE
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
		  $("#typeLanguages").select2({
		      placeholder: 'Select language',
		      //tags: true,
		      tokenSeparators: [',', ' ']
		  });

		  // LIMITED SELECT
		  var selectlimit = 2;
		  $(document).on('change', '.limitSelect', function(e) {
		      if ($(this).parent().parent().parent().siblings().find(':checked').length >= selectlimit) {
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
		      $('#getMapModal').modal('hide');
		  });

		  $(document).on('click', '[data-id="add_new_dropoint"]', function() {
		      var searchTextField = $('#searchTextField').val();
		      $('#add_new_dropoint').val(searchTextField);
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
		  $('.dayBox input').each(function() {
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
		  $('#cancleItinerary').on('click', function() {
		      var userid = '<?php echo $hostId?>';
		      var proceed = true;

		      if (userid == '') {
		          proceed = false;
		          return false;
		      }
		      if (proceed) {
		          $.ajax({
		              type: 'post',
		              url: '<?php echo base_url()?>Itineraries/changeLoginStatus',
		              data: {
		                  userid: userid
		              },
		              success: function(html) {
		                  if (html == 'success')
		                      window.location.href = '<?php echo base_url();?>host';
		              }
		          });
		      }

		  });

		  // SAVE AS DRAFT FORM FUNCTION
		  $(document).on('click', '#saveCall', function(e) {
		      e.preventDefault();
		      validator.destroy();
		      $('#formItinerary').attr('action', 'saveExperienceItinerary');
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
		         // $("#itinerary_traveller_private-error").css("display", "none");
		      } else {
		          $("#travellerType-private").data("rule-required", true);
		          //$("#itinerary_traveller_private-error").css("display", "block");
		      }
			  
		  
		      validator.destroy();
		      $('#formItinerary').attr('action', 'adminDoneExperienceItinerary');
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
		              $("#formItinerary").submit();
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