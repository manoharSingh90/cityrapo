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
    <div class="profilePage-links">
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
		 <?php }?>
		  
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
               <label class="col-form-sublabel text-capitalize">Type Category (<?php echo $selectOtherLang;?>)</label>
               <input type="text" class="form-control" id="type_category" name="type_category" 
			    value="<?php if(isset($draftData->other_category_type))echo $draftData->other_category_type;?>" required data-rule-required="true"/>
			  <div id="typecateError" class="error errorOwn"></div>
               </li>
			<?php }	?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Select My City</label>
              <select id="originCity" class="form-control" name="originCity" data-rule-required="true" required>
               <option value="">Select</option>
                <?php 
				  foreach($userCity as $city):
				   $cityArr = explode(',',$city->preferred_cities);
				   foreach($cityArr as $value):
				   if($value==$draftData->origin_city){
					    $selected = 'selected';
					   }
					else{
						$selected = '';
						}   
				  ?>              
				<option value="<?php echo $value;?>" <?php echo $selected;?> > <?php echo $value;?> </option>
                <?php endforeach;endforeach;?>
              </select>
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
			<label class="col-form-sublabel text-capitalize">Type My City (<?php echo $selectOtherLang;?>)</label>             
              <input id="origin_otherCity" type="text" class="form-control" name="origin_otherCity" value="<?php if(isset($draftData->origin_other_city)) echo $draftData->origin_other_city;?>" data-rule-required="true" required/>
            </li>
			<?php } ?>			
          
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Session Title</label>
              <input id="itinerary_title" type="text" class="form-control" name="itinerary_title" placeholder="Itinerary Title" data-rule-required="true" value="<?php if(isset($draftData->itinerary_title))echo $draftData->itinerary_title;?>"  required/>
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel text-capitalize">Session Title (<?php echo $selectOtherLang;?>)</label>
              <input id="itinerary_other_title" type="text" class="form-control" name="itinerary_other_title" value="<?php if(isset($draftData->itinerary_other_title))echo $draftData->itinerary_other_title;?>" data-rule-required="true" required/>
            </li>
			<?php } ?>			
			
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel">Tag Line</label>
              <input id="itinerary_tagline" type="text" class="form-control" name="itinerary_tagline" placeholder="Tag Line" data-rule-required="true" value="<?php if(isset($draftData->itinerary_tagline))echo $draftData->itinerary_tagline;?>" required/>
            </li>
			<?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 col-md-6 placeVaild">
              <label class="col-form-sublabel text-capitalize">Type Tag Line (<?php echo $selectOtherLang;?>)</label>
              <input id="other_tag_line" type="text" class="form-control" name="other_tag_line"  value="<?php if(isset($draftData->itinerary_other_tagline))echo $draftData->itinerary_other_tagline;?>" data-rule-required="true" required/>
            </li>
			<?php } ?>   
			
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label text-light">What to Expect</label>
              <textarea id="itinerary_description" class="form-control" name="itinerary_description" placeholder="Give details of your service (max 5000 characters)" data-rule-required="true" data-rule-maxlength="5000" required><?php if(isset($draftData->itinerary_description))echo $draftData->itinerary_description;?></textarea>
            </li>
           <?php if($selectOtherLang!='English' && $selectOtherLang!=='ENGLISH' && $selectOtherLang!='english'){ ?>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label text-light text-capitalize">What to Expect (<?php echo $selectOtherLang;?>)</label>
              <textarea id="other_lang_desc" class="form-control" name="other_itinerary_description" placeholder="Give details of your service (max 5000 characters)" data-rule-required="true" data-rule-maxlength="5000" required><?php if(isset($draftData->other_itinerary_description))echo $draftData->other_itinerary_description;?></textarea>
            </li>
			<?php } ?>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label d-block text-light">Type</label>
              <ul class="tagList">
			   <?php 
				  if(!empty($draftData->meetup_type)){
				  $indoorclass = '';
				  $outdoorclass ='';
					  $meetupType1 = explode(',',$draftData->meetup_type);
					  $meetupType2 = explode(',',$draftData->meetup_type);
					  $meetupMerge = array_combine($meetupType1,$meetupType2);
					 
					  if(!empty($meetupMerge['Indoor'])){
						  $indoorclass = 'active';
						  }
					else{
					      $indoorclass = '';
						 } 	  
					if(!empty($meetupMerge['Outdoor'])){
						  $outdoorclass = 'active';
						  }
						 else{
							 $outdoorclass = '';
							 } 
					  }
				  ?>
                <li>
                  <label class="tagBox <?php echo @$indoorclass;?> typeChoose">
                    <input type="checkbox" class="ignore" name="meetup_itinerary_type[]" value="Indoor" <?php if(isset($meetupMerge['Indoor'])=='Indoor') echo 'checked="checked"'; ?> data-rule-required="true"/>
                    Indoor</label>
                </li>
                <li>
                  <label class="tagBox <?php echo @$outdoorclass;?> typeChoose">
                    <input type="checkbox" name="meetup_itinerary_type[]" value="Outdoor" <?php if(isset($meetupMerge['Outdoor'])=='Outdoor') echo 'checked="checked"'; ?> />
                    Outdoor</label>
                </li>
              </ul>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-label d-block text-light">Theme</label>
              <label class="col-form-sublabel">Select themes <small>(separate using commas)</small></label>
              <select id="typeThemes" name="itinerary_theme[]" class="form-control ignore" placeholder="Select themes" multiple data-rule-required="true">
                  <?php
					foreach($allthemes as $themes):
					$themesIds = explode(',',$draftData->itinerary_theme);
				   if(in_array($themes->id,$themesIds)){
					   $selected = 'selected';
					   }
					  else{
						   $selected = '';
						  } 
					?>
				<option value="<?php echo $themes->id;?>" <?php echo $selected;?>><?php echo $themes->theme_name;?></option>
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
			      if(!empty($draftData->type_highlights)){
				  $highlights = explode(',',$draftData->type_highlights);				  
				  if(in_array($highlight->interest_name,$highlights)){
					   $selected = 'selected';
					   }
					  else{
						   $selected = '';
						  }
				 }
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
				   if(!empty($draftData->type_features)){				  
				   $featurArr = explode(',',$draftData->type_features);				  
				   if(in_array($featureVal->id,$featurArr)){
					   $selected = 'selected';
					   }
					  else{
						   $selected = '';
						  }					 
					 } 
				  ?>
                <option value="<?php echo $featureVal->id;?>" <?php echo $selected;?>><?php echo $featureVal->feature_name;?></option>
               <?php endforeach;?>
              </select>
            </li>
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Search Tags <small>(separate using commas)</small></label>
              <select id="typeSearchTags" name="itinerary_searchtags[]" class="form-control ignore" placeholder="Search Tags" multiple data-rule-required="true">
                <?php 
				   if(!empty($draftData->itinerary_searchtags)){
				   $searchTagsArr = explode(',',$draftData->itinerary_searchtags);
				   foreach($searchTagsArr as $key=>$value):
				   if(in_array($value,$searchTagsArr)){
					   $selected = 'selected';
					   }
					  else{
						   $selected = '';
						  } 
				   ?>
                <option value="<?php echo $value;?>" <?php echo $selected;?>><?php echo $value;?></option>
				 <?php endforeach;} ?>
              </select>
            </li>
            <li class="form-group col-12 placeVaild deliveryType">
              <label class="col-form-sublabel d-block">Delivery Type <small>(max. select 2)</small></label>
              <div class="form-row">
			  <?php 
					 if(isset($draftData->itinerary_delivery)){
						  $delivery = explode(',',$draftData->itinerary_delivery);
						  $delivery1 = explode(',',$draftData->itinerary_delivery);
                          $deliverydata = array_combine($delivery, $delivery1);
						 }
					?>
  
				
		 <div class="col-6 col-sm-auto">
           <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                                    <label>
 
				   <input type="checkbox" id="deliveryType-online" name="itinerary_delivery[]" value="online" class="custom-control-input limitSelect ignore"  data-rule-required="true" <?php if(isset($deliverydata['online'])){echo "checked";} ?>/>
                    <span class="control-icon"> 
					<svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 42.9 33" style="enable-background:new 0 0 42.9 33;" xml:space="preserve">
					<path d="M27.5,28.8c-2.2,1.2-4.5,1.6-7.2,1.6c-6.6,0-12.2-4.8-12.2-12.6c0-8.3,5.8-15.5,14.7-15.5c7,0,11.7,4.9,11.7,11.6
						c0,6-3.4,9.6-7.2,9.6c-1.6,0-3.1-1.1-3-3.5h-0.2c-1.4,2.4-3.3,3.5-5.7,3.5c-2.3,0-4.4-1.9-4.4-5.1c0-5,3.9-9.6,9.6-9.6
						c1.7,0,3.3,0.4,4.3,0.8l-1.4,7.3c-0.6,3.1-0.1,4.5,1.2,4.5c2.1,0,4.4-2.7,4.4-7.4c0-5.8-3.5-10-9.8-10c-6.6,0-12.1,5.2-12.1,13.4
						c0,6.7,4.4,10.9,10.4,10.9c2.3,0,4.4-0.5,6.1-1.4L27.5,28.8z M25.3,11.4c-0.4-0.1-1.1-0.3-2-0.3c-3.5,0-6.4,3.3-6.4,7.3
						c0,1.8,0.9,3.1,2.7,3.1c2.3,0,4.5-3,4.9-5.5L25.3,11.4z"/>
					</svg>
					 </span>
                    <label class="custom-control-label" for="deliveryType-online">Offline</label>
                   </label>					
				  </div>
                </div>
				
			 <div class="col-6 col-sm-auto">
                  <div class="custom-control custom-checkbox custom-control-inline p-0 ml-0 mt-1 mb-1 valign">
                    <input type="checkbox" id="deliveryType-virtual" name="itinerary_delivery[]" value="virtual" class="custom-control-input limitSelect" <?php if(isset($deliverydata['virtual'])){echo "checked";} ?>>
                    <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 42.9 33" style="enable-background:new 0 0 42.9 33;" xml:space="preserve"><g>
						<path d="M38,7H4.6c-0.6,0-1,0.4-1,1v15.7c0,0.6,0.4,1,1,1h11.8c0.4,0,0.7-0.2,0.9-0.6l2.3-4.5c0.4-0.7,1-1.1,1.8-1.1
							c0.8,0,1.5,0.4,1.8,1.1l2.3,4.5c0.2,0.3,0.5,0.6,0.9,0.6H38c0.6,0,1-0.4,1-1V8C39,7.5,38.6,7,38,7z M37,22.7H26.8l-2-3.9
							c-0.7-1.4-2.1-2.2-3.5-2.2s-2.9,0.9-3.5,2.2l-2,3.9H5.6V9H37V22.7z"/>
						<path d="M12.4,20.8c2.8,0,4.9-2.2,4.9-4.9s-2.2-4.9-4.9-4.9s-4.9,2.2-4.9,4.9S9.7,20.8,12.4,20.8z M12.4,12.9c1.7,0,3,1.3,3,3
							s-1.3,3-3,3s-3-1.3-3-3S10.8,12.9,12.4,12.9z"/>
						<path d="M30.1,20.8c2.8,0,4.9-2.2,4.9-4.9s-2.2-4.9-4.9-4.9s-4.9,2.2-4.9,4.9S27.4,20.8,30.1,20.8z M30.1,12.9c1.7,0,3,1.3,3,3s-1.3,3-3,3c-1.7,0-3-1.3-3-3S28.5,12.9,30.1,12.9z"/></g></svg> </span>
                    <label class="custom-control-label" for="deliveryType-virtual">Virtual</label>
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
				  if(isset($draftData->prefer_languages)){
				   $itinerraylang = explode(',',$draftData->prefer_languages);
					  if(in_array($langData,$itinerraylang)){
						$selected = 'selected';
						}else{
						$selected = '';
						}
					  }
				  ?>
                <option value="<?php echo $langData;?>" <?php echo $selected;?>><?php echo $langData;?></option>
               <?php endforeach;endforeach;?>
              </select>
            </li>
          </ul>
               <h3 id="fillSponsor" class="col-form-label mt-2">Speaker Details</h3>
          <ul class="peopleBox girdView">
             <?php 
			  if(!empty($speakersData)){
				  foreach($speakersData as $speaker):?>
				  <li> <span><img src="<?php echo $speaker->speaker_image_path;?>" alt="Profile"><input type="hidden" value="<?php if(isset($speaker->speaker_image_name))echo $speaker->speaker_image_name;?>" name="speakerImg[]"/></span> <p><?php echo $speaker->speaker_name;?></p><input type="hidden" value="<?php if(isset($speaker->speaker_name))echo $speaker->speaker_name;?>" name="speakerName[]"/><p class="mt-0 text-default font-weight-normal"><?php if(isset($speaker->speaker_details))echo $speaker->speaker_details;?></p><input type="hidden" name="speakerDesc[]" value="<?php echo $speaker->speaker_details;?>" /> <a href="#" data-toggle="modal" data-target="#addSpeakerModal" class="text-primary font-weight-semibold">Edit</a> | <a href="#" class="text-danger font-weight-semibold removeSpeaker">Remove</a></li>
				  <?php endforeach;}
			  ?>       
          </ul>
          <ul class="form-row no-gutters">
            <li class="form-group col-12"> <a href="#" class="text-uppercase font-weight-bold text-primary" data-toggle="modal" data-target="#addSpeakerModal">+ Add More</a> </li>
          </ul>
          <h3 id="fillInclusions" class="col-form-label">Inclusions & exclusions</h3>
          <ul class="form-row no-gutters">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Inclusions</label>
              <textarea id="itinerary_inclusions" class="form-control ignore" name="itinerary_inclusions" placeholder="Type down the inclusions (max 1000 characters)" data-rule-maxlength="1000" data-rule-required="true"> <?php if(isset($draftData->itinerary_inclusions))echo $draftData->itinerary_inclusions;?></textarea>
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
         <h3 id="fillRoute" class="col-form-label mt-2">Venue & Timings</h3>
          <ul class="form-row">
		   <?php 
		      if(!empty($drafRouteTimeData)){
			   foreach($drafRouteTimeData as $routdata){
			       $draftRoutData = $routdata;
				   }
				 }
			  ?>
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 placeVaild">
                  <label class="col-form-sublabel">Venue</label>
                  <input id="pickup_point" type="text" name="itinerary_route_slot01_pickup[]" class="form-control ignore" data-toggle="modal" data-target="#getMapModal" placeholder="click to open map and select location" value="<?php echo @$draftRoutData->pickup_point;?>" data-rule-required="true" autocomplete="off"/>
                </div>
                <input type="hidden" name="pickup_coordinates[]" id="pickup_coordinates" value="<?php echo @$draftRoutData->pickup_lat_lng;?>"/>
              </div>
            </li>			
            <li class="form-group col-12 col-md-12">            
              <div class="form-row">
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Start Time</label>
                  <input id="pickup_time" type="text" name="itinerary_route_slot01_pickup_time[]" class="form-control timepicker ignore" 
				  value="<?php echo (@$draftRoutData->start_pickup_time?$draftRoutData->start_pickup_time:'12:00 AM');?>" placeholder="Time" data-rule-required="true" autocomplete="off"/>
                </div>
                <div class="col-12 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">End Time</label>
                  <input id="dropend_time" type="text" name="itinerary_route_slot01_dropoff_time[]" class="form-control timepicker ignore" 
				  value="<?php echo (@$draftRoutData->end_dropoff_time?$draftRoutData->end_dropoff_time:'12:00 AM');?>" placeholder="Time" data-rule-required="true" autocomplete="off"/>
                </div>
              </div>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel">Total Duration(Hours)</label>
              <input id="route_slot01_duration" type="text" name="itinerary_route_slot01_duration[]" class="form-control hourpicker ignore" placeholder="Total Duration" value="<?php if(!empty(@$draftRoutData->total_durations))echo @$draftRoutData->total_durations;else{echo '0:00';}?>" data-rule-required="true" autocomplete="off"/>
            </li>
            <li class="form-group col-6 placeVaild">
              <label class="col-form-sublabel">Cut-off Time(Hours)</label>
              <input id="route_slot01_cutofftime" type="text" name="itinerary_route_slot01_cutofftime[]" class="form-control cutoffpicker ignore" placeholder="Cut-off Time" value="<?php if(!empty(@$draftRoutData->cutt_off_time))echo @$draftRoutData->cutt_off_time;else{echo '0:00';}?>" data-rule-required="true" autocomplete="off"/>
            </li>
			
          </ul>
      <!-- <ul class="form-row">
            <li class="form-group col-12">
              <label class="col-form-sublabel text-dark font-weight-semibold d-block">Default Stop</label>
              <div class="form-row">
                <div class="col-12 col-sm-7 placeVaild">
                  <label class="col-form-sublabel">Type a location</label>
                  <input id="route_slot01_stop01_location" type="text" name="itinerary_route_slot01_stop01_location[]" class="form-control ignore" placeholder="Type a location" data-rule-required="true"/>
                </div>
                <div class="col-12 col-sm-4 offset-sm-1 placeVaild">
                  <label class="col-form-sublabel">Time</label>
                  <input id="route_slot01_stop01_time" type="text" name="itinerary_route_slot01_stop01_time[]" class="form-control timepicker ignore" value="12:00AM" placeholder="Time" data-rule-required="true"/>
                </div>
                <div class="col-12 pt-4 placeVaild">
                  <textarea id="route_slot01_stop01_description" class="form-control ignore" name="itinerary_route_slot01_stop01_description[]" placeholder="Add a description" data-rule-required="true"></textarea>
                </div>
              </div>
            </li>
            <li class="form-group col-12"> <a href="#" class="text-uppercase font-weight-bold" id="addStopLink" data-toggle="modal" data-target="#addStopModal" >+ Add Another Stop</a></li>
          </ul>
          <ul class="form-row no-gutters">
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
			  <!--<input type="text" id="connectivity_railway" class="form-control ignore" name="itinerary_connectivity_railway" 
			   value="<?php //if(isset($draftData->nearest_railway_station))echo $draftData->nearest_railway_station;?>" data-rule-required="true"/>-->           
            </li>
            
          </ul>
          <h3 id="fillTraveller" class="col-form-label mt-2">Traveller Specifications</h3>
          <div class="placeVaild">
            <ul class="form-row">
              <li class="form-group col-12 col-md-12 pt-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4">
                    <div class="custom-control custom-checkbox custom-control-inline pt-3 pb-1">
                      <input type="checkbox" id="travellerType-private" name="itinerary_traveller_private" class="custom-control-input ignore" value="1" <?php if(isset($draftData->private_traveller)==1)echo 'checked';?> data-rule-required="true" />
                      <label class="custom-control-label font-weight-semibold" for="travellerType-private">Private</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Travellers</label>
                    <input id="private_min_no_travllers" type="number" name="itinerary_traveller_private_minnumber" class="form-control ignore" placeholder="0" min="1" value="<?php if(isset($draftData->private_min_no_travellers))
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
                      <input type="checkbox" id="travellerType-group" name="itinerary_traveller_group" class="custom-control-input ignore" value="1" <?php if(isset($draftData->group_traveller)==1)echo 'checked';?>>
                      <label class="custom-control-label font-weight-semibold" for="travellerType-group">Group</label>
                    </div>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Travellers</label>
                    <input type="number" class="form-control ignore" name="itinerary_traveller_group_minnumber" placeholder="0" min="1" id="group_min_no_travllers" value="<?php if(isset($draftData->group_min_no_travellers))
					  echo $draftData->group_min_no_travellers;else{echo 1;}?>" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Travellers</label>
                    <input type="number" class="form-control ignore" name="itinerary_traveller_group_maxnumber" placeholder="0" id="group_max_no_travllers" value="<?php if(isset($draftData->group_max_no_travellers))
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
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
                      <input id="travellerType-kids-below10" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore keepCheck" value="10" <?php echo isset($ageTenKey) ? "checked" : ""; ?> data-rule-required="true" disabled />
                      <label class="custom-control-label" for="travellerType-kids-below10">Below 10</label>
                    </div>
                   </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input id="family_kids_min_no" type="number" class="form-control ignore disabledPaa defaultActive" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="<?php echo isset($ageTenKey) ? $drafFamilyData[$ageTenKey]["min_no_kides"] : "1"; ?>" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input id="family_kids_max_no" type="number" class="form-control ignore disabledPaa defaultActive" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" value="<?php echo isset($ageTenKey) ? $drafFamilyData[$ageTenKey]["max_no_kides"] : ""; ?>" data-rule-required="true" disabled/>
                  </div>
                </div>
              </li>
              <li class="form-group col-12 col-sm-6 pt-2 offset-0 offset-sm-6" data-id="kids-2">
                <div class="form-row">
                  <div class="col-12 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Kids (Age)</label>
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
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
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
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
                    <div class="custom-control custom-checkbox custom-control-inline pt-4 pb-1">
                      <input id="travellerType-kids-below10" type="checkbox" name="itinerary-traveller-family-kids01-age[]" class="custom-control-input ignore keepCheck" value="10" data-rule-required="true" checked disabled />
                      <label class="custom-control-label" for="travellerType-kids-below10">Below 10</label>
                    </div>
                   </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Min. No. Kids</label>
                    <input id="family_kids_min_no" type="number" class="form-control ignore disabledPaa defaultActive" name="itinerary_traveller_family_kids01_minnumber[]" placeholder="0" min="1" value="1" data-rule-required="true" disabled/>
                  </div>
                  <div class="col-6 col-sm-4 placeVaild">
                    <label class="col-form-sublabel">Max. No. Kids</label>
                    <input id="family_kids_max_no" type="number" class="form-control ignore disabledPaa defaultActive" name="itinerary-traveller-family-kids01-maxnumber[]" placeholder="0" data-rule-required="true" disabled/>
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
				if(!empty($drafFamilyData)){
				//foreach($drafFamilyData as $key=>$priceData): ?>
            <li  data-rel="familyCheck"  class="form-group col-12 col-md-6 hidden ">
              <div class="form-row">
                <?php //if($key==0):?>
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel font-weight-semibold pt-3">Family</label>
                </div>
                <?php //endif;?>
                <?php //if(!empty($priceData->adults_price)){?>
                <div class="col-6 col-sm-6 placeVaild">
                  <label class="col-form-sublabel">Price (Adults)</label>
                  <input type="number" class="form-control ignore" name="itinerary_traveller_family_adult_price[]" placeholder="0" id="itinerary_family_adult_price" value="<?php echo $drafFamilyData[0]["adults_price"]; ?>" data-rule-required="true"/>
                </div>
                <?php //}?>
              </div>
            </li>
           <!-- <li  id="addMoreKidsPrice"   data-rel="familyCheck"  class="form-group col-12 col-md-6 hidden ">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input type="number" class="form-control ignore getAge" placeholder="0"  name="itinerary_traveller_family_kids01_age[]" id="itinerary_family_kids_age" value="<?php echo $priceData->kides_age;?>" data-rule-required="true" />
                </div>
                <div class="col-6 placeVaild" >
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore" placeholder="0" name="itinerary_traveller_family_kids01_price[]" id="itinerary_family_kids_price" value="<?php echo $priceData->kides_price;?>" data-rule-required="true"/>
                </div>
              </div>
            </li>
            -->
             <li data-rel="familyCheck" data-id="familyKidCheck-01" class="form-group col-12 col-md-6 hidden">
              <div class="form-row">
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Age (Kids)</label>
                  <input id="itinerary_family_kids_age" type="text" class="form-control ignore" value="Below 10"   name="itinerary_traveller_family_kids01_age[]"  data-rule-required="true"  readonly/>
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
                  <input type="text" class="form-control ignore" value="Below 7"   name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
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
                  <input  type="text" class="form-control ignore priceKid" value="Below 5"   name="itinerary_traveller_family_kids01_age[]" data-rule-required="true"  readonly/>
                </div>
                <div class="col-6 placeVaild">
                  <label class="col-form-sublabel">Price (Kids)</label>
                  <input type="number" class="form-control ignore priceKid"  placeholder="0" name="itinerary_traveller_family_kids01_price[]" value="<?php echo isset($ageFiveKey) ? $drafFamilyData[$ageFiveKey]["kides_price"] : ""; ?>" disabled data-rule-required="true"/>
                </div>
              </div>
            </li>            
            <?php //endforeach;
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
		  <input type="text" class="form-control ignore" name="itinerary_additionalcost_description[]" placeholder="Item description" id="additionalcost_desc" value="<?php echo $value["itinerary_additionalcost_description"]; ?>"/>
		</div>
		<div class="form-group col-12 col-sm-6 placeVaild">
		  <label class="col-form-sublabel">Price</label>
		  <input type="number" class="form-control ignore" name="itinerary_additionalcost_amt[]" placeholder="Price" id="additionalcost_amt" value="<?php echo $value["additional_price"]; ?>"/>
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
			   echo $draftData->additional_cost_description;?>" />
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
                <input type="radio" id="cancelByHostInput-other-yes" name="itinerary-cancellations-agree" value="1" class="custom-control-input ignore" <?php echo @$draftData->itinerary_cancelbyhost_agree==1?'checked="checked"':'';?> data-rule-required="true" />
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
                <input type="radio" id="cancelBytravellerInput-other-yes" name="itinerary-donetraveller-agree" value="1" class="custom-control-input ignore"<?php echo @$draftData->itinerary_cancelbytraveller_agree==1?'checked="checked"':'';?> data-rule-required="true"/>
                <label class="custom-control-label" for="cancelBytravellerInput-other-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelBytravellerInput-other-no" name="itinerary-donetraveller-agree" value="0" class="custom-control-input"
				<?php echo @$draftData->itinerary_cancelbytraveller_agree==''?'':(@$draftData->itinerary_cancelbytraveller_agree==0?'checked="checked"':'');?>/>
                <label class="custom-control-label" for="cancelBytravellerInput-other-no"> I Don't Agree</label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild cancelRadio-03">
              <label class="col-form-sublabel">Refund</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_refund) > 500 ? substr($legalData[0]->preview_cancel_refund,0,500)."..." : $legalData[0]->preview_cancel_refund;?> <a href="javascript:void(0);"  data-ref="done_refund" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="refundCheckInput-other-yes" name="itinerary-refund-agree" value="1" class="custom-control-input ignore" 
				<?php echo @$draftData->itinerary_refund_agree==1?'checked="checked"':'';?> data-rule-required="true"/>
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
          <h3 id="fillSponsor" class="col-form-label mt-2">Sponsor</h3>
                    		  <small class="text-muted">*Required min. dimension 640 X 100px, size less than 10mb and format .jpg,.jpeg only</small>

          <ul class="form-row">
		  <?php $sponsorArr = '';
			 if(!empty($draftData->sponsors_img)){
				   $sponsorArr = explode(',',$draftData->sponsors_img);
				
			  foreach($sponsorArr as $key=>$images):	   
				  
			  ?>
            <li class="form-group col-12 placeVaild">
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_sponsor_image_cover[]" accept="image/jpg, image/jpeg" data-height="100" data-width="640" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="add_sponsor_check" type="text" class="form-control lowKey ignore" name="itinerary_sponsor_hide_image_cover[]" value="<?php if(@$images!='')echo $images;?>" data-rule-required="false"/>
              <div class="dragImageBox-info" <?php if(@$images!='' && @$images!=null) echo 'style="display:none"'; ?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Sponsor Image</p>
                <span>Click here to upload image</span> </div>
              <div class="infoShow" <?php if(@$images!='' && @$images!=null) echo 'style="display:block"'; ?>>
                <p class="text-primary"><?php if(@$images!='')echo $images;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
			  <?php if($key>0){echo '<a href="#" class="text-light text-uppercase clearSponsor">Remove</a>';}?>
            </li>
			  <?php endforeach;}else{?>
			 <li class="form-group col-12 placeVaild">
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_sponsor_image_cover[]" id="add_sponsor"  accept="image/jpg, image/jpeg" data-height="100" data-width="640" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="add_sponsor_check" type="text" class="form-control lowKey ignore" name="itinerary_sponsor_hide_image_cover[]" data-rule-required="false"/>
              <div class="dragImageBox-info">
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Sponsor Image</p>
                <span>Click here to upload image</span> </div>
              <div class="infoShow">
                <p class="text-primary">File Name</p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li> 
			
			 <?php } ?>
			 <?php			   
			   if(count($sponsorArr)<2){
				   echo '<li class="form-group col-12 text-right"><a href="javascript:void(0)" class="text-uppercase font-weight-bold" id="addSponsor">+ Add More</a> </li>';
					 }
					 /*else{
				 echo '<li class="form-group col-12 text-right"><a href="#" class="text-light text-uppercase clearSponsor">Remove</a></li>';  
					 }*/
				 ?> 
          </ul>
        </fieldset>
        <fieldset>
          <h3 id="fillVideo" class="col-form-label mt-2">Video</h3>
          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="col-form-sublabel">Add a video <small>(*Required size less than 10mb and format .mp4 only)</small> </label>
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore vidInput" name="itinerary_gallery_video" id="add_video" accept="video/mp4" data-size="10240" data-msg-extension="Please upload file in video(.mp4) format only" />
              <input id="add_video_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_hide_video" value="<?php if(@$draftData->video!='')echo $draftData->video;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->video!='' && @$draftData->video!=null) echo 'style="display:none"'; ?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Video</p>
                <span>Click here to upload video</span> </div>
              <div class="infoShow" <?php if(@$draftData->video!='' && @$draftData->video!=null) echo 'style="display:block"'; ?>>
                <p class="text-primary"><?php if(@$draftData->video!='')echo $draftData->video;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
          </ul>
          <h3 id="fillImage" class="col-form-label mt-2">Image Gallery</h3>
                    		  <small class="text-muted">*Required min. dimension 1440 X 563px, size less than 10mb and format .jpg,.jpeg only</small>

          <ul class="form-row">
            <li class="form-group col-12 placeVaild">
              <label class="dragImageBox">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_cover" id="image_gallery"  accept="image/jpg, image/jpeg" data-height="563" data-width="1440" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="image_gallery_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_hide_image_cover" value="<?php if(@$draftData->feature_img!='')echo $draftData->feature_img;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->feature_img!='' && @$draftData->feature_img!=null)echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Click here to upload image</span> </div>
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
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_01" id="additional_image_1" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="additional_image_1_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_image_hide_01" value="<?php if(@$draftData->additional_img_1!='')echo $draftData->additional_img_1;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->additional_img_1!='' && @$draftData->additional_img_1!=null) echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Click here to upload image</span> </div>
              <div class="infoShow" <?php if(@$draftData->additional_img_1!='' && @$draftData->additional_img_1!=null) echo 'style="display:block"';?>>
                <p class="text-primary"><?php if(@$draftData->additional_img_1!='')echo $draftData->additional_img_1;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_02" id="additional_image_2" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="additional_image_2_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_image_hide_02" value="<?php if(@$draftData->additional_img_2!='')echo $draftData->additional_img_2;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->additional_img_2!='' && @$draftData->additional_img_2!=null) echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Click here to upload image</span> </div>
              <div class="infoShow" <?php if(@$draftData->additional_img_2!='' && @$draftData->additional_img_2!=null) echo 'style="display:block"';?>>
                <p class="text-primary"><?php if(@$draftData->additional_img_2!='')echo $draftData->additional_img_2;?></p>
                <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
              </label>
            </li>
            <li class="form-group col-12 col-md-4 placeVaild">
              <label class="dragImageBox text-center">
              <input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_gallery_image_03" id="additional_image_3" accept="image/jpg, image/jpeg" data-height="158" data-width="250" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" />
              <input id="additional_image_3_check" type="text" class="form-control lowKey ignore" name="itinerary_gallery_image_hide_03" value="<?php if(@$draftData->additional_img_3!='')echo $draftData->additional_img_3;?>" data-rule-required="true"/>
              <div class="dragImageBox-info" <?php if(@$draftData->additional_img_3!='' && @$draftData->additional_img_3!=null) echo 'style="display:none"';?>>
                <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
                <p>Add a Feature Image</p>
                <span>Click here to upload image</span> </div>
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
                <input type="radio" id="disclaimerCheckInput-yes" name="itinerary-disclaimer-agree" value="1" class="custom-control-input ignore" <?php echo @$draftData->itinerary_liabilitie_disclaimer==1?'checked="checked"':'';?> data-rule-required="true"/>
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
                <input type="radio" id="privacyCheckInput-yes"  name="itinerary-privacy-agree" value="1" class="custom-control-input ignore" <?php echo @$draftData->itinerary_privacy_policy==1?'checked="checked"':'';?> data-rule-required="true"/>
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
                <input type="radio" id="termsCheckInput-yes" name="itinerary-terms-agree" value="1" class="custom-control-input ignore"
				<?php echo @$draftData->itinerary_terms_condition==1?'checked="checked"':'';?> data-rule-required="true"/>
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
                <input type="radio" id="cancelByHostInput-yes1" name="itinerary-cancelbyHost-agree-copy" value="1" class="custom-control-input ignore" <?php echo @$draftData->last_doneby_host==1?'checked="checked"':''?> data-rule-required="true"/>
                <label class="custom-control-label" for="cancelByHostInput-yes1"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="cancelByHostInput-no1" name="itinerary-cancelbyHost-agree-copy" value="0" class="custom-control-input"
				<?php echo @$draftData->last_doneby_host==''?'':(@$draftData->last_doneby_host==0?'checked="checked"':'');?>/>
                <label class="custom-control-label" for="cancelByHostInput-no1"> I Don't Agree </label>
              </div>
            </li>
            <li class="form-group col-12 placeVaild cancelRadio-02">
              <label class="col-form-sublabel">Done By traveller</label>
              <p class="pt-1 pb-2"><?php echo strlen($legalData[0]->preview_cancel_donebytraveller) > 500 ? substr($legalData[0]->preview_cancel_donebytraveller,0,500)."..." : $legalData[0]->preview_cancel_donebytraveller;?> <a href="javascript:void(0);"  data-ref="done_traveller" class="text-primary read_popup">View More</a></p>
			  
              <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="cancelBytravellerInput-yes1" name="itinerary-cancelbytraveller-agree-copy" value="1" class="custom-control-input ignore" <?php echo @$draftData->last_doneby_traveller==1?'checked="checked"':''?> data-rule-required="true"/>
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
                <input type="radio" id="refundCheckInput-yes1" name="itinerary-refund-agree-copy" value="1" class="custom-control-input ignore" <?php echo @$draftData->last_refund==1?'checked="checked"':''?> data-rule-required="true"/>
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
                <input type="radio" id="copyrightCheckInput-yes"  name="itinerary-copyright-agree" value="1" class="custom-control-input ignore" <?php echo @$draftData->media_infringement==1?'checked="checked"':'';?> data-rule-required="true"/>
                <label class="custom-control-label" for="copyrightCheckInput-yes"> I Agree</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" id="copyrightCheckInput-no" name="itinerary-copyright-agree" value="0" class="custom-control-input" 
				<?php echo @$draftData->media_infringement==''?'':(@$draftData->media_infringement==0?'checked="checked"':'');?>/>
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

<!-- ADD MORE SPEAKER -->
<div class="modal fade" id="addSpeakerModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered" role="document">
    <div class="modal-content">
    <form id="newSpeakerForm">
      <div class="modal-header">
        <h5 class="modal-title">Add New Speaker</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <ul class="form-row">
          <li class="form-group col-12 col-md-5 placeVaild">
            <label class="col-form-sublabel">Image</label>
            <label class="dragImageBox text-center">
            <input id="newSpeakerImg" type="file" class="form-control uploadDoc imgInput" name="speakerImages[]" accept="image/jpg, image/jpeg" data-height="300" data-width="300" data-size="10240" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only"/>
			<input id="newSpeakerImg_check" type="text" class="form-control lowKey" name="speakerImages_hide[]"  required/>
            <div class="dragImageBox-info">
              <div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div>
              <p>Add a Speaker Image</p>
              <span>Drag file here or click to upload</span> </div>
            <div class="infoShow">
              <p class="text-primary">File Name</p>
              <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
            </label>
					  <small class="text-muted">*Required dimension 300px X 300px, size less than 10mb and format .jpg,.jpeg only</small>

          </li>
          <li class="form-group col-12 col-md-7">
            <div class="form-row">
              <div class="col-12 placeVaild">
                <label class="col-form-sublabel">Name</label>
                <input id="newSpeakerName" type="text" name="spekaerName[]" class="form-control" placeholder="Full Name" required />
              </div>
              <div class="col-12 pt-2 placeVaild">
                <label class="col-form-sublabel">Detail</label>
                <textarea id="newSpeakerDes" name="speakerDesc[]" class="form-control" placeholder="Add a description" required ></textarea>
              </div>
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
                <textarea id="add_newAns" class="form-control mt-4" name="new-answer" placeholder="Answer (max 1000 characters)" required data-rule-maxlength="1000"></textarea>
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- SUBMIT FORM MODAL -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> <span class="modal-titleIcon"><img src="<?php echo base_url();?>assets/img/icon/done.svg" alt="done" /></span> Thank You!</h5>
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
var draftInsertMsg = '<?php if($this->session->flashdata('success')=='session_draft') echo 'draftupdate';?>';
var draftUpdateMsg = '<?php if($this->session->flashdata('success')=='draftupdate') echo 'draft';?>';
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


$('#addQuestionModal').on('hidden.bs.modal', function() {
    $('#add_newQues, #add_newAns').val('');
});




// ADD & REMOVE SPEAKER 
function readURL() {
    // $('#userProfileImage').attr('src', '').hide();
    if (this.files && this.files[0]) {
        var reader = new FileReader();
        $(reader).load(function(e) {
            $('#newSpeakerImg').attr('data-src', e.target.result);
        });
        reader.readAsDataURL(this.files[0]);
    }
}

$('#newSpeakerImg').change(readURL);
var stopNum = 0;
$("#newSpeakerForm").validate({
    errorElement: 'small',
    errorPlacement: function(error, element) {
        error.appendTo(element.closest(".placeVaild"));
    },
    submitHandler: function() {
        var newName = $('#newSpeakerName').val();
        var newDes = $('#newSpeakerDes').val();
        var newImg = $('#newSpeakerImg').attr('data-src');
        var newImgVal = $('#newSpeakerImg').val();
        stopNum++;
        var data = $('<li> <span><img src="' + newImg + '" alt="Profile"><input type="hidden" value="' + newImg + '" name="speakerImg[]"/></span> <p>' + newName + '</p><input type="hidden" value="' + newName + '" name="speakerName[]"/><p class="mt-0 text-default font-weight-normal">' + newDes + '</p><input type="hidden" name="speakerDesc[]" value="' + newDes + '" /> <a href="#" data-toggle="modal" data-target="#addSpeakerModal" class="text-primary font-weight-semibold">Edit</a> | <a href="#" class="text-danger font-weight-semibold removeSpeaker">Remove</a></li>');
        $(".peopleBox").append(data);
        $('#addSpeakerModal').modal('hide');
        $("#newSpeakerForm")[0].reset();
		$("#newSpeakerForm .clearDargbox").trigger("click");
    }
});

$(document).on('click', '.removeSpeaker', function(e) {
    e.preventDefault();
    $(this).parent('li').remove();
});

$("#addSpeakerModal").on("hidden.bs.modal", function() {
    $("#newSpeakerForm")[0].reset();
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
		              var $imgError = $nextInput.attr('data-msg-required', 'Upload image min. dimension ' + $width + ' x ' + $height + 'pixels & size of file should be below 10mb');
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
    tags: true,
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
    tags: true,
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


// ADD & REMOVE SPONSOR IMAGE
$('#addSponsor').on('click', function() {
    var data = $('<li class="form-group col-12 placeVaild"><label class="dragImageBox"><input type="file" class="form-control uploadDoc ignore imgInput" name="itinerary_sponsor_image_cover[]" id="add_sponsor-02" accept="image/jpg, image/jpeg" data-height="100" data-width="640" data-size="5120" data-msg-extension="Please upload file in image(.jpg & .jpeg) format only" /><input type="text" id="add_sponsor-02_check"  class="form-control lowKey ignore" name="itinerary_sponsor_hide_image_cover[]" data-rule-required="false" /><div class="dragImageBox-info"><div class="dragImageBox-icon"><img src="<?php echo base_url();?>assets/img/icon/file.svg" alt="file" /></div><p>Add a Sponsor Image</p><span>Drag file here or click to upload</span> </div><div class="infoShow"><p class="text-primary">File Name</p><small class="text-muted">000 KB</small></div></label><a href="javascript:void(0);" class="text-light text-uppercase clearSponsor">Remove</a></li>');
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
    $('#formItinerary').attr('action', 'saveSessionItinerary');
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


          if ($('[name="send_to_translator"]').val() == 0) {
        $('[name="type_category"], [name="origin_otherCity"], [name="itinerary_other_title"], [name="other_tag_line"], [name="other_itinerary_description"]').removeClass('ignore').attr('required', 'required').data("rule-required", true);;
      } else {
        $('[name="type_category"], [name="origin_otherCity"], [name="itinerary_other_title"], [name="other_tag_line"], [name="other_itinerary_description"]').addClass('ignore').removeAttr('required').data("rule-required", false);
      }

    validator.destroy();
    $('#formItinerary').attr('action', 'adminDoneSessionItinerary');
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

	// CHECK TYPE
$('.typeChoose input').bind("change", function() {
    var indoorBox = $('[value="Indoor"]').is(':checked');
    var outdoorBox = $('[value="Outdoor"]').is(':checked');

    if (indoorBox == true) {
        $('.deliveryType').show();
    } else if (indoorBox == true && outdoorBox == true) {
        $('.deliveryType').show();
    } else if (indoorBox == false && outdoorBox == false) {
        $('.deliveryType').show();
    } else {
        $('.deliveryType').hide();
    }
}).trigger('change');	

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