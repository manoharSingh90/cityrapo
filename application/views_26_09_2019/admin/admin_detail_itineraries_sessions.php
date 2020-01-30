<?php require_once('header.php');
	 require_once('main_header.php');
	 $loginSes = $this->session->userdata('adminSes');
	?>
	
<main>
  <div class="detailPage">
  <div class="editBar">
      <div class="container">
        <div class="row">
		<?php 
			if($flag==1){
				$action = 'itineraries_request';
				}
		    if($flag==2){
				if(empty($transflag)){
				  $action = 'all_itineraries';
				  }else{
				    $action = 'translator_all_itineraries';
				  }
				}		
			?>
          <div class="col-12 col-sm-8"> <a href="<?php echo base_url();?><?php echo $action;?>" class="text-uppercase backLink"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
            <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8
	c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"/>
            </svg> Back</a>
            <h2 class="introTitle"><?php 
			      if(!empty($userLang!='English') && $userLang!='english'){
				  echo $itineraryData->itinerary_other_title;
				  }else{
				  echo $itineraryData->itinerary_title;
				  }
				  ?></h2>
          </div>
 <!--          <div class="col-12 col-sm-4 text-right"> <a href="#" class="btn btn-link text-default btn-sm"  data-toggle="modal" data-target="#disableModal">Disable</a> <a href="create_itineraries.html" class="btn btn-primary  btn-sm">Edit</a> </div>
-->      <?php 
       if($flag==1){?>
        <div class="col-12 col-sm-4 text-right">
		<?php if($loginSes['admin_type']!=6){ // login condition number 6 is editor admin ?>
			<a href="#" class="btn btn-link mr-2 text-default">		  
	   <?php if(isset($reasonHistoryData) && !empty($reasonHistoryData)) { ?>
	  <b class="infoIcon" data-toggle="modal" data-target="#rejectionModal"><img src="<?php echo base_url();?>adminassets/assets/img/icon/info.svg" alt="info"></b>
	  <?php } ?>		  
	  <span data-toggle="modal" data-target="#rejectModal">Reject</span></a>
		  <?php if($itineraryData->translator==0){
			    $targetId = '#approveModal';
				}
				else{
				   if($itineraryData->translator_confirm==0 && $itineraryData->translator_type!=0){
					   $targetId = '#approveModal_translator';
					   }else{
						 $targetId = '#approveModal';
					   }
			  }?>
		<a href="#" data-toggle="modal" data-target="<?php echo $targetId;?>" class="btn btn-secondary">Approve</a>
		<?php } ?>
		  <a href="<?php echo base_url();?>admin/admin_session_itinerary_edit?serviceid=<?php echo $itineraryData->service_id;?>&otherlang=<?php echo $itineraryData->itinerary_language;?>&itineraryid=<?php echo base64_encode($itineraryData->id);?>&userid=<?php echo base64_encode($itineraryData->user_id);?>&flag=<?php echo $flag;?>" class="btn btn-secondary">Edit</a>
		  </div>
	   <?php }
	   if($transflag=='' && empty($transflag)){ // translator detatil condition
	     if($flag==2){		   
		   ?>
	   <div class="col-12 col-sm-4 text-right">
		   <?php 
			   if(!empty($itineraryDisabled)){
			   ?>
		   <a href="#" class="btn btn-link mr-3 text-default" data-toggle="modal" data-target="#enableModal">Enabled</a>
			   <?php }else{?>
		  <a href="#" class="btn btn-link mr-3 text-default" data-toggle="modal" data-target="#disableModal">Disabled</a>	   
				 <?php } ?>
		   <!--<a href="#" data-toggle="modal" data-target="#approveModal" class="btn btn-secondary">Edit</a>-->
		   <a href="<?php echo base_url();?>admin/admin_session_itinerary_edit?serviceid=<?php echo $itineraryData->service_id;?>&otherlang=<?php echo $itineraryData->itinerary_language;?>&itineraryid=<?php echo base64_encode($itineraryData->id);?>&userid=<?php echo base64_encode($itineraryData->user_id);?>&flag=<?php echo $flag;?>" class="btn btn-secondary">Edit</a>
		   </div>
	   <?php }} ?>
        </div>
      </div>
    </div>
   <?php 
	if($itineraryData->feature_img!=''){
		$img3 = 'assets/itinerary_files/thumbnail_images/'.$itineraryData->feature_img;
	  }
	else{
	  $img3 = 'assets/img/Itineraries/cover/cover_77.jpg';
	 }		
	?>
    <div class="coverBox" style="background-image:url(<?php echo base_url();?><?php echo $img3;?>);"></div>
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-8">
          <div class="mainIntro boxStyle">
		  <?php 
			if(!empty($transflag)){
				 $transDisabled = 'disabled';
				}else{
				  $transDisabled = '';
				}
				?>
          <div class="mainIntro-top">
           <div class="itinerarieslanguage">
            <select class="form-control changeLang" <?php echo $transDisabled;?>>
              <option value="<?php echo $itineraryData->itinerary_language;?>" <?php if($userLang==$itineraryData->itinerary_language) echo 'selected';?>><?php echo  $itineraryData->itinerary_language;?></option>
			  <?php if(!empty($itineraryData->itinerary_language!=='English')){?>
              <option value="English" <?php if($userLang=='English') echo 'selected';?>>English</option>
			  <?php } ?>
            </select>
            <input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryData->id)?>"/>
            <input type='hidden' name="serviceid" class="serviceid" value="<?php echo $itineraryData->service_id;?>"/>
          </div>
          <div class="itinerariesSetting">
            <div class="mailTo">
			       <?php 
				if($itineraryData->mail_for_admin==1){
					$check = 'checked';					
					}else{
					$check = '';					
					}
				?>
              <label><input type="checkbox" name="chkMail" id="mailForAdmin" <?php echo $check;?> <?php echo $transDisabled;?>>Mail to host</label>
            </div>
            <?php if($itineraryData->translator==1){
				     if($itineraryData->translator_confirm==1){
					   $disable = 'disabled';
					  }else{
						$disable = '';
					  }
				?>
            <div class="sentTo sendToTranslator">
              <select class="form-control" id="send_translator" <?php echo $disable;?> <?php echo $transDisabled;?>>
                <option value="">Select Translator</option>
                <option value="1" <?php if($itineraryData->translator_type==1)echo 'selected';?>>Translator-1</option>
                <option value="2" <?php if($itineraryData->translator_type==2)echo 'selected';?>>Translator-2</option>
              </select>
              <input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryData->id)?>"/>
              <input type='hidden' name="serviceid" class="serviceid" value="<?php echo $itineraryData->service_id;?>"/>
            </div>
            <?php }?>
          </div>
        </div>
            <div class="mainIntro-head">
              <h2 class="introTitle mb-2"><?php 
			      if(!empty($userLang!='English') && $userLang!='english'){
				  echo $itineraryData->itinerary_other_title;
				  }else{
				  echo $itineraryData->itinerary_title;
				  }
				  ?></h2>
			<?php if($loginSes['admin_type']!=6){ // login condition number 6 is editor admin?>	  
              <div class="introRating">
                <input type="textbox" class="ff-rating iwlRating" value="<?php if(isset($itineraryData->rating)) echo $itineraryData->rating;?>" />
              </div>
			  <div class="introFlag">
            <label>
              <input type="checkbox" name="priority" id="changePriority" <?php echo $itineraryData->priority==1 ? "checked" : ""; ?> <?php echo $transDisabled;?>/>
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
              <path d="M14.6,5.7l-1.7,0.5L13,6.5c0.8,2.7-0.7,5.6-3.5,6.5s-5.6-0.7-6.5-3.5S3.8,3.8,6.5,3c1.2-0.4,2.5-0.3,3.7,0.3l0.3,0.1
				l0.7-1.6L11,1.7C7.5,0.1,3.3,1.6,1.7,5.1s-0.1,7.6,3.4,9.2s7.6,0.1,9.2-3.4c0.7-1.5,0.8-3.3,0.3-4.9L14.6,5.7z M5.4,5.4L4.2,6.7
				l3.7,3.4l6.5-6.5l-1.3-1.3L7.9,7.7L5.4,5.4z"/></svg> </label>
          </div>
			<?php } ?>
			  
            </div>
            <div class="mainIntro-body clearfix">
              <h3 class="introSubtitle"><?php if(!empty($userLang!='English') && $userLang!='english'){
					     echo $itineraryData->itinerary_other_tagline;
						}else{
						 echo $itineraryData->itinerary_tagline;
						}
					  ?></h3>
              <p><?php if(!empty($userLang!='English') && $userLang!='english'){
					     echo $itineraryData->other_itinerary_description;
						}else{
						 echo $itineraryData->itinerary_description;
						}
					 
				  ?> </p>
             <div class="row">
                <div class="col-12 col-sm-6">
                  <p class="intro-theme d-block float-none mb-4"><span>Themes:</span> 
					<?php 
					  $themesArr = array();				       
					 if(!empty($itineraryData)){
					   $themesIds = explode(',',$itineraryData->itinerary_theme);
					   
					   if(!empty($themesIds)){
					   foreach($themesIds as $id){					        
						    $hostThemes = getHostThemes($id);
						    if(!in_array($hostThemes['theme_name'],$themesArr)){
						    array_push($themesArr,$hostThemes['theme_name']);
						    }	
						  }
					   }else{
					      $allThemes = '';
					      }							   
					  }					  
					   $allThemes = implode(', ',$themesArr);
					   echo $allThemes;
					 ?>		 
					  </p>
				   <?php 					       
					  if(!empty($itineraryData->meetup_type)){?>	  
                   <p class="intro-theme d-block float-none mb-3"><span>Type:</span> 
					 <?php 					       
					  if(!empty($itineraryData->meetup_type)){							  						   
							   echo str_replace(',', ',&nbsp;', $itineraryData->meetup_type);					   							   
						  }
					  ?>
					</p>
					<?php } ?>	
                </div>
                <div class="col-12 col-sm-6">
                  <div class="featList sessionFeature">
                    <ul class="clearfix">
					 <?php 
					  $tempArr = array();
					  $imgArr = array();
					  if($itineraryData->type_features){
					  $featuresArr = explode(',',$itineraryData->type_features);
					  foreach($featuresArr as $featurId){
						   $featuresData  = getFeaturesData($featurId);
						  // print_r($featuresData);
						   if(!in_array($featuresData['feature_name'],$tempArr)){
							   array_push($tempArr,$featuresData['feature_name']);
							   }
						   if(!in_array($featuresData['feature_image'],$imgArr)){
							   array_push($imgArr,$featuresData['feature_image']);
							   } 	   
						  }
					   $featurData = array_combine($tempArr,$imgArr);
					   //echo '<pre>';print_r($featurData);
					  }					  
					   
				  ?>
				 <?php 
				     $i=0;
					 foreach($featurData as $key=>$value):
					 if($i==2){
						  break;
						 }
					 if($value!=''){
						  $img = $value;
						 }
					 ?> 
                      <li><span><img src="<?php echo base_url();?>assets/img/icon/feature/<?php echo $img;?>" alt="<?php echo $key;?>" /></span> <?php echo $key;?></li>
					 <?php  $i++;endforeach;?>                      
                    </ul>
					<?php if(count($featurData)>2){?>
					  <a href="#" class="mt-4 mb-4" data-toggle="modal" data-target="#moreFeatureModal">View More</a>
					  <?php } ?>
                  </div>
                </div>
                <div class="col-12">
                  <div class="highList text-left sessionHighlight">
                    <p class="smallTitle">Highlights:</p>
                    <ul class="clearfix p-0 m-0 d-inline-block align-middle">
                      <?php 
				   if(!empty($itineraryData->type_highlights)){
					    $highLights = explode(',',$itineraryData->type_highlights);
						$count = count($highLights);						
					   }
					
					foreach($highLights as $key=>$value):
					if($key<=3){
				  ?>
                 <li class="roundedBox"><?php echo $value;?></li>
					<?php } endforeach; ?> 
                    </ul>
					<?php if($count>4){?>
					  <a href="#" class="mt-4 mb-4" data-toggle="modal" data-target="#moreHighlightModal">View More</a>
					  <?php } ?>					
                  </div>
                </div>
              </div>
            </div>
          </div>
		  <?php 
			if(!empty($itineraryData->sponsors_img)){?>
          <h3 class="normalTitle mb-2">Sponsored By</h3>
          <div class="sponsoredStyle clearfix">
            <div class="row">
			 <?php 
			  if(!empty($itineraryData->sponsors_img)){
				   $sponsorImages = explode(',',$itineraryData->sponsors_img);				   
				   foreach($sponsorImages as $sponsorby):
				   			  
			  ?>
              <div class="col-12 col-sm-6">			 
                <div class="sponsoredCube"><img src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsorby;?>" alt="sponsor img" /> </div>
              </div>
			  <?php endforeach;} ?>             
            </div>
          </div>
		  <?php }?>
           <div class="peopleboxStyle">
            <ul class="nav nav-tabs normalTab" role="tablist">
              <li class="nav-item"> <a class="nav-link text-uppercase active" id="attendees-tab" data-toggle="tab" href="#attendeesData" role="tab" aria-controls="attendeesData" aria-selected="true">Attendees</a> </li>
              <li class="nav-item"> <a class="nav-link text-uppercase" id="interested-tab" data-toggle="tab" href="#interestedData" role="tab" aria-controls="interestedData" aria-selected="true">Interested</a> </li>
            </ul>
            <div class="tab-content normalTab-content">
              <div class="tab-pane fade show active" id="attendeesData" role="tabpanel" aria-labelledby="attendees-tab">
			 <div class="row">
              <div class="col-12 col-sm-9">
				   <?php 
					if(!empty($attendeesData)){?>
                    <ul class="peopleBox interestedList">
					 <?php
						 $attendCount = count($attendeesData);						
						 foreach($attendeesData as $key=>$attendees):
						 if($key<=5):
						?>
                      <li> <span><img src="<?php echo base_url();?>assets/img/profile/placeholder.jpg" alt="Profile"></span>
                        <p><?php echo $attendees->full_name;?></p>
                      </li>                                          
					 <?php endif;endforeach;?>
                    </ul>
					<?php }
					else{
					     $attendCount = 0;
						 echo '<p class="text-center text-light p-4">No data available.</p>';
						 }?>
                  </div>
				  <?php if($attendCount>=6):?>
                  <div class="col-12 col-sm-3 text-center flex-center"> <a href="#" class="text-primary small"  data-toggle="modal" data-target="#moreAttendeesModal">View More</a> </div>
				 <?php endif;?>
                </div>
				
              </div>
              <div class="tab-pane fade" id="interestedData" role="tabpanel" aria-labelledby="interested-tab">              
				<div class="row">
                  <div class="col-12 col-sm-9">                   
                     <?php 
					     if(!empty($itineraryData->id) and !empty($itineraryData->service_id)){						     
							  $interestedList = getInterestedData($itineraryData->id,$itineraryData->service_id);
							 
						 $count = count($interestedList);
						 if(!empty($interestedList)){?>
						 <ul class="peopleBox interestedList">
						 <?php 
						  foreach($interestedList as $key=>$dataVal):
						  if($key<=5){
						?>
                      <li>
					  <!--<span><img src="<?php //echo base_url();?>assets/img/profile/placeholder.jpg" alt="Profile"></span>-->
                        <p><?php echo $dataVal->full_name;?></p>
                      </li>
						  <?php } endforeach;?>						  
							 </ul>
							 <?php
							   }
							   else{
							   echo '<p class="text-center text-light p-4">No data available.</p>';
						     }
						 }?>                      
                    
                  </div>
				  <?php 
					  if($count>6){
					  ?>
                  <div class="col-12 col-sm-3 text-center flex-center"> <a href="#" class="text-primary small"  data-toggle="modal" data-target="#moreInterestedModal">View More</a> </div>
					  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
		<div class="col-12 col-lg-4">
          <div class="stateIntro boxStyle moveUp">
            <h3 class="normalTitle pb-3">Location & Timings</h3>			
            <?php
			  if(!empty($itineraryData)){
				  $allpickups = getAll_pickupspoints($itineraryData->id);				  
			  }
			  foreach($allpickups as $key=>$pointsData):
			          date_default_timezone_set("Asia/Kolkata");
					  $sTime = strtotime($pointsData->start_pickup_time);
					  $eTime = strtotime($pointsData->end_dropoff_time);
					  date_default_timezone_set("UTC");
					  $sgmtime = date('H:i A', $sTime);
					  $egmtime = date('H:i A', $eTime);
			  ?>
              <p class="introBox-text mb-3 text-secondary font-weight-semibold"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc"> <?php echo $pointsData->pickup_point.', '.$itineraryData->origin_city;?></p>
              <p class="introBox-text mb-3"><img src="<?php echo base_url();?>assets/img/icon/clock_red.svg" alt="clock"> <?php echo $pointsData->start_pickup_time.' ('.$sgmtime.' UTC)';?>&nbsp; - &nbsp;<?php echo $pointsData->end_dropoff_time.' ('.$egmtime.' UTC)';?></p>
              <p class="introBox-text mb-0"><img src="<?php echo base_url();?>assets/img/icon/date_red.svg" alt="Date">
				<?php echo date('d M Y',strtotime($itineraryData->start_date_from_host));?> - <?php echo date('d M Y',strtotime($itineraryData->end_date_to_host));?></p>
			 <?php endforeach;?>
          </div>
          <div class="createrIntro boxStyle ">
            <h3 class="normalTitle mb-0">Organiser Details</h3>
			 <?php 
				  if(!empty($itineraryData)){
					   $hostData = getHostData($itineraryData->user_id);					  
					   if(!empty($hostData)){
						  $profileImg =  'assets/upload/profile_pic/'.$hostData['profile_picture'];
						   }
						else{
							$profileImg = 'assets/img/profile/placeholder.jpg';
							}   
					  }
				if($hostData['verified_by']=='Video'){
				  $verifyimg = 'video.svg';
				  }
			   if($hostData['verified_by']=='Call'){
				   $verifyimg = 'call_yellow.svg';
				  }	 	  
				  ?>
            <p class="introUser"> <span class="introUser-img"><img src="<?php echo base_url();?><?php echo $profileImg;?>" alt="Profile"></span><?php if(isset($hostData['display_name']))echo $hostData['display_name'];?>
			<?php
			  $hostDatas = getHostDetail($hostData['host_verification_type']);			  
			  if(!empty($hostDatas)){
				  $hostIcon = preg_replace('/\s/', '', strtolower($hostDatas['host_name']));				  			  			 
				?>
			<small class="internal-verify"><b> <img src="<?php echo base_url();?>assets/img/icon/badge/<?php echo $hostIcon.'_badge.svg'?>" alt="<?php echo $hostIcon;?>"> </b>
			 <?php
			  echo $hostDatas['host_name'];	
			 ?></small>
			 <?php } ?>	
			 
			<small class="internal-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="<?php echo $hostData['verified_by'];?>" /> </b>&nbsp; Verified</small>	
			</p>
            <p class="introBox-text mb-3 font-weight-semibold"><img src="<?php echo base_url();?>assets/img/icon/call_red.svg" alt="Call"><?php echo $hostData['host_mob_no'];?></p>
            <p class="introBox-text mb-3 font-weight-semibold"><img src="<?php echo base_url();?>assets/img/icon/mail_red.svg" alt="Mail"> <?php echo $hostData['host_email'];?></p>
           <?php 
			 if(!empty($allSpeakers)){?>
			 <h3 class="normalTitle pt-3 mb-0 pb-2">Speakers</h3><?php }?>
            <ul class="peopleBox">
			<?php 
			if(!empty($allSpeakers)){			
					foreach($allSpeakers as $key=>$speaker):
					if($speaker->speaker_image_name!=''){
						$img = 'assets/itinerary_files/meetup_speaker/'.$speaker->speaker_image_name;
						}
					else{
						$img = 'assets/img/profile/sample.jpg';
						}	
				?>
			 <?php	
			 if($key<=3){		
				?>	
              <li> <span><img src="<?php echo base_url().$img;?>" alt="Profile"></span>
                <p><?php echo $speaker->speaker_name;?></p>
                <?php echo $speaker->speaker_details;?> </li>
			 <?php } endforeach;} ?>
            </ul>
			<?php 
				$count = count($allSpeakers);
				if($count>4){
				?>
            <div class="clearfix mt-4 mb-2 text-center"> <a href="#" data-toggle="modal" data-target="#moreSpeakerModal">View More</a></div>
				<?php } ?>
          </div>
        </div>
        </div>
		<div class="row">       
        <div class="col-12 col-lg-8">
          <div class="bookIntro boxStyle">
            <h3 class="normalTitle float-left">Make a Booking</h3>
            <p class="bookIntro-date"> <span class="smallTitle">Travel Dates</span><?php echo date('d/m/Y',strtotime($itineraryData->start_date_from_host));?> - <?php echo date('d/m/Y',strtotime($itineraryData->end_date_to_host));?> <img src="<?php echo base_url();?>assets/img/icon/date_blue.svg" alt="date"></p>
            <div class="clearfix"></div>
            <div class="row pt-4 clearfix">
              <div class="col-12 col-sm-9">
                <div class="bookIntro-cost p-0">
                  <ul>
                    <?php 
				  if(!empty($itineraryData->private_price)){?>					
                <li> <span>Private</span> Rs. <?php echo $itineraryData->private_price;?> </li>
				  <?php
					  }
				  if(!empty($itineraryData->group_price)){?>					
                 <li> <span>Group</span> Rs. <?php echo $itineraryData->group_price;?> </li>
				  <?php }
				   if(!empty($itineraryData)){
					   $familyData = getFamilyData($itineraryData->id);
					   $kidsdata =  getFamilyMultiData($itineraryData->id);
					   //echo '<pre>';print_r($familyData);
					  }
				 if(!empty($familyData)){
					 echo '<li> <span>Family</span><small>Adults</small> Rs. '.$familyData->adults_price.' </li>';
					 }
				if(!empty($kidsdata)){					 
					  foreach($kidsdata as $kidsval):
					  if($kidsval->family_kides_below_age==10){
						  echo '<li><small class="kids">kids (Below 10)</small> Rs. '.$kidsval->kides_price.' </li>';
						  }
					 if($kidsval->family_kides_below_age==7){
						  echo '<li> <small class="kids">kids (Below 7)</small> Rs. '.$kidsval->kides_price.' </li>';
						  }
					if($kidsval->family_kides_below_age==5){
						  echo '<li> <small class="kids">kids (Below 5)</small> Rs. '.$kidsval->kides_price.' </li>';
						  }		  
					  
					  endforeach;
					 }	 	 
				   ?>     
                  </ul>
                </div>
              </div>
             <!-- <div class="col-12 col-sm-3"> <a class="btn btn-primary btn-block mt-2" href="<?php echo base_url();?>book_itineraries?itinerary_id=<?php echo base64_encode($itineraryData->id);?>&serviceid=<?php echo $itineraryData->service_id;?>">Book</a> </div>-->
            </div>
          </div>
        </div>
      </div>
     
      <div class="extraIntro">
        <ul class="nav justify-content-center nav-tabs iwlTab" role="tablist">
          <li class="nav-item"> <a class="nav-link text-uppercase active" id="overview-tab" data-toggle="tab" href="#overviewData" role="tab" aria-controls="overviewData" aria-selected="true">Overview</a> </li>
          <li class="nav-item"> <a class="nav-link text-uppercase" id="addinfo-tab" data-toggle="tab" href="#addinfoData" role="tab" aria-controls="addinfoData" aria-selected="true">Additional Info</a> </li>
          <li class="nav-item"> <a class="nav-link" id="faq-tab" data-toggle="tab" href="#faqData" role="tab" aria-controls="faqData" aria-selected="false">FAQ's</a> </li>
        </ul>
        <div class="tab-content iwlTab-content">
          <div class="tab-pane fade show active" id="overviewData" role="tabpanel" aria-labelledby="overview-tab">
            <div class="overviewBox">
              <div class="row">
                <div class="col-12 col-lg-6">
                  <div id="map" class="mapBox"></div>
                </div>
                <div class="col-12 col-lg-6">
                  <div class="modeBox">
                    <h4>Mode</h4>
                    <ul>
					<?php
					   if(!empty($itineraryData->itinerary_delivery)){					      
						    $modeData = explode(',',$itineraryData->itinerary_delivery);
						   }else{
						    $modeData = array();
						   }
						 $img = '';  
						foreach($modeData as $mode):
						/*if($mode=='bus'){
							 $img = 'bus_red.svg';
							}
					    if($mode=='auto'){
							 $img = 'auto_red.svg';
							}
					    if($mode=='car'){
							 $img = 'car_red.svg';
							}
						if($mode=='cycle'){
							 $img = 'cycle_red.svg';
							}*/	
					   if($mode=='virtual'){
							 $img = 'virtual_red.svg';
							}
					   if($mode=='online'){
							 $img = 'offline_red.svg';
							}	 		
						?>
                     <li><span><img src="<?php echo base_url();?>assets/img/icon/mode/<?php echo $img;?>" alt="mode"></span><?php echo $mode;?></li>
                     <?php endforeach;?>
                    </ul>
                  </div>
                </div>
              </div>
              <h4 class="mt-4 mb-4">Location & Timings</h4>
			   <?php
			   $pickupCoordinate = '';
			  if(!empty($itineraryData)){
				  $allpickups = getAll_pickupspoints($itineraryData->id);
				  //echo '<pre>';print_r($allpickups);
			  }
			  foreach($allpickups as $key=>$pointsData):
			  $pickupCoordinate = $pointsData->pickup_lat_lng;
			  date_default_timezone_set("Asia/Kolkata");
			  $sTime = strtotime($pointsData->start_pickup_time);
			  $eTime = strtotime($pointsData->end_dropoff_time);
			  date_default_timezone_set("UTC");
			  $sgmtime = date('H:i A', $sTime);
			  $egmtime = date('H:i A', $eTime);
			  ?>
              <p class="introBox-text mb-3 text-secondary font-weight-semibold"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc"> <?php echo $pointsData->pickup_point.', '.$itineraryData->origin_city;?></p>
              <p class="introBox-text mb-3"><img src="<?php echo base_url();?>assets/img/icon/clock_red.svg" alt="clock"> <?php echo $pointsData->start_pickup_time.' ('.$sgmtime.' UTC)';?>&nbsp; - &nbsp;<?php echo $pointsData->end_dropoff_time.' ('.$egmtime.' UTC)';?></p>
              <p class="introBox-text mb-0"><img src="<?php echo base_url();?>assets/img/icon/date_red.svg" alt="Date">
				<?php echo date('d M Y',strtotime($itineraryData->start_date_from_host));?> - <?php echo date('d M Y',strtotime($itineraryData->end_date_to_host));?></p>
			  <?php endforeach;?>
              <strong></strong>
              <h4 class="mt-5">Connectivity</h4>
              <div class="row">
                <div class="col-12 col-md-6">
                  <div class="connectBox">
                    <h5><img src="<?php echo base_url();?>assets/img/icon/mode/plane.svg" alt="plane">Nearest Airport</h5>
                    <p><?php echo $itineraryData->nearest_airport;?></p>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="connectBox">
                    <h5><img src="<?php echo base_url();?>assets/img/icon/mode/train.svg" alt="train"> Nearest Railway</h5>
                    <p><?php echo $itineraryData->nearest_railway_station;?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="addinfoData" role="tabpanel" aria-labelledby="addinfo-tab">
            <div class="adinfoBox">
              <h3>Gallery</h3>
              <div class="row">
                <div class="col-12 col-lg-9">
                  <div class="videoPlay">
				   <?php 
					  if($itineraryData->video!=''){
						  $video = 'assets/itinerary_files/videos/'.$itineraryData->video;
						  }
						 else{
							  $video = 'assets/img/set/sample.mp4';
							 } 
					  ?>
                    <video controls>
                      <source src="<?php echo base_url();?><?php echo $video;?>" type="video/mp4">
                      Your browser does not support HTML5 video. </video>
                  </div>
                </div>
                <div class="col-12 col-lg-3">
                  <div class="imageList parent-container">
				   <?php 
					  if($itineraryData->additional_img_1!=''){
						  $img1 = 'assets/itinerary_files/thumbnail_images/'.$itineraryData->additional_img_1;
						  }
						 else{
							  $img1 = 'assets/img/set/01.jpg';
							 } 
							 
				   if($itineraryData->additional_img_2!=''){
						  $img2 = 'assets/itinerary_files/thumbnail_images/'.$itineraryData->additional_img_2;
						  }
					else{
					   $img2 = 'assets/img/set/02.jpg';
					 }
					 
				  if($itineraryData->additional_img_3!=''){
						  $img3 = 'assets/itinerary_files/thumbnail_images/'.$itineraryData->additional_img_3;
						  }
					else{
					   $img3 = 'assets/img/set/03.jpg';
					 }		 
					  ?>
                    <div class="imagePlayer" href="<?php echo base_url();?>assets/itinerary_files/additional_images/<?php echo $itineraryData->additional_img_1;?>"><img src="<?php echo base_url();?><?php echo $img1;?>" alt="image"></div>
                    <div class="imagePlayer" href="<?php echo base_url();?>assets/itinerary_files/additional_images/<?php echo $itineraryData->additional_img_2;?>"><img src="<?php echo base_url();?><?php echo $img2;?>" alt="image"></div>
                    <div class="imagePlayer" href="<?php echo base_url();?>assets/itinerary_files/additional_images/<?php echo $itineraryData->additional_img_3;?>"><img src="<?php echo base_url();?><?php echo $img3;?>" alt="image"></div>
                  </div>
                </div>
              </div>
              <h3 class="mt-4">More Information</h3>
              <ul>
                <li> <span>Languages Offered:</span><?php echo $itineraryData->prefer_languages;?> </li>
                <li> <span>Inclusions:</span><?php echo $itineraryData->itinerary_inclusions;?></li>
                <li> <span>Exclusions:</span><?php echo $itineraryData->itinerary_exclusions;?> </li>
                <li> <span>Special Mentions:</span><?php echo $itineraryData->itinerary_spl_mention;?> </li>
              </ul>
            </div>
          </div>
          <div class="tab-pane fade" id="faqData" role="tabpanel" aria-labelledby="faq-tab">
            <div class="faqBox">
              <h3>Frequently asked questions</h3>
              <ul>
			   <?php 
				   if(!empty($itineraryData)){
					    $faqdata = getFaqsData($itineraryData->id);					
					   }					  
				 foreach($faqdata as $data):				
				  ?>
                <li>
                  <h4 class="faqQuestion"><?php if($data->itinerary_faq_question!='')echo $data->itinerary_faq_question;?></h4>
                  <div class="faqAnswer">
                    <p><?php if($data->itinerary_faq_answer!='')echo $data->itinerary_faq_answer;?></p>
                  </div>
                </li>
				<?php endforeach; ?>                 
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- MORE PEOPLE MODAL -->
<div class="modal fade" id="moreInterestedModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Interested</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="modalList">
          <ul class="peopleBox">
		  <?php 
			 if(!empty($itineraryData->id) and !empty($itineraryData->service_id)){
				 $interestedList = getInterestedData($itineraryData->id,$itineraryData->service_id);				 
			 $count = count($interestedList);	  
			 foreach($interestedList as $dataVal):	 						
			?>
		  <li>
		  <!--<span><img src="<?php //echo base_url();?>assets/img/profile/sample.jpg" alt="Profile"></span>-->
			<p><?php echo $dataVal->full_name;?></p>
		  </li>
		 <?php endforeach;}?>            
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- MORE PEOPLE MODAL -->
<div class="modal fade" id="moreSpeakerModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Speakers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="modalList">
          <ul class="peopleBox">
           <?php 
			if(!empty($allSpeakers)){
					foreach($allSpeakers as $speaker):
					if($speaker->speaker_image_name!=''){
						$img = 'assets/itinerary_files/meetup_speaker/'.$speaker->speaker_image_name;
						}
					else{
						$img = 'assets/img/profile/sample.jpg';
						}	
				?>
              <li> <span><img src="<?php echo base_url().$img;?>" alt="Profile"></span>
                <p><?php echo $speaker->speaker_name;?></p>
                <?php echo $speaker->speaker_details;?> </li>
				<?php endforeach;} ?>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- RSVP FORM MODAL -->
<!--<div class="modal fade" id="rsvpModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
	<form class="pt-3" id="rsvpFormData">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3">RSVP</h5>
        <p class="font-weight-semibold text-center pl-2 pr-2">Please give us your details so we can add you to our waitlist.<br>
          If you wish to recieve immediate confirmation,<br>
          please make a booking.</p>        
          <ul class="form-row justify-content-center">
            <li class="form-group col-8">
              <label class="col-form-sublabel">Full Name</label>
              <input type="text" class="form-control" placeholder="Full Name" id="full_name" name="full_name" required />
            </li>
            <li class="form-group col-8">
              <label class="col-form-sublabel">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" required/>
            </li>
            <li class="form-group col-8">
            <label class="col-form-sublabel">Phone</label>
            <input type="number" class="form-control" name="phone_no" placeholder="Phone" required/>
            </li>
          </ul> 
		  <input type="hidden" name="itinerary_id" value="<?php echo $itineraryData->id;?>"/>		 
		  <input type="hidden" name="service_id" value="<?php echo $itineraryData->service_id;?>"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-default" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="rsvpDone">Done</button>
      </div>
	  </form>
    </div>
  </div>
</div>-->
<!-- MORE HIGHLIGHT MODAL -->
<div class="modal fade" id="moreHighlightModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Highlights</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="highList modalList">
          <ul class="clearfix">
		  <?php 
		  if(!empty($itineraryData->type_highlights)){
					    $highLights = explode(',',$itineraryData->type_highlights);						
					   }
			foreach($highLights as $val):		   
				 ?>
            <li class="roundedBox"><?php echo $val;?></li>
			<?php endforeach;?>            
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- MORE FEATURES MODAL -->
<div class="modal fade" id="moreFeatureModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Features</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="featList modalList">
          <ul class="clearfix">
                <?php 
			      $tempArr = array();
				  $imgArr = array();
				  if($itineraryData->type_features){
					  $featuresArr = explode(',',$itineraryData->type_features);
					  foreach($featuresArr as $featurId){
						   $featuresData  = getFeaturesData($featurId);
						  // print_r($featuresData);
						   if(!in_array($featuresData['feature_name'],$tempArr)){
							   array_push($tempArr,$featuresData['feature_name']);
							   }
						   if(!in_array($featuresData['feature_image'],$imgArr)){
							   array_push($imgArr,$featuresData['feature_image']);
							   } 	   
						  }
					   $featurData = array_combine($tempArr,$imgArr);
					  }
				  ?>
				 <?php 
					 foreach($featurData as $key=>$value):
					 if($value!=''){
						  $img = $value;
						 }
					 ?> 
               <li><span><img src="<?php echo base_url();?>assets/img/icon/feature/<?php echo $img;?>" alt="<?php echo $key;?>" /></span> <?php echo $key;?></li>
				<?php endforeach;?>               
              </ul>          
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- DISABLE ALERT MODAL -->
<div class="modal fade" id="disableModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Are you sure you want to disable this itinerary?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary callVerify" id="itinerary_disabled">Disable</button>
      </div>
    </div>
  </div>
</div>

<!-- ENABLE ALERT MODAL -->
<div class="modal fade" id="enableModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Are you sure you want to enable this itinerary?</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary callVerify" id="itinerary_enabled">Enable</button>
      </div>
    </div>
  </div>
</div>
<!-- REJECT ALERT MODAL -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p>Are you sure that you want to reject this itinerary?</p>
          <div class="form-group m-0">
            <label class="col-form-sublabel">Reason for rejection?</label>
            <textarea class="form-control d-block" placeholder="Add Note" id="reject_reason"></textarea>
			<span id="rejectedErr"></span>
          </div>
        </div>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="adminReject_itinerary">Reject</button>
      </div>
    </div>
  </div>
</div>

<!-- APPROVE ALERT MODAL -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Do you want to approve this itinerary?</p>
        </div>
		<input type="hidden" id="itineraryid" value="<?php echo $itinerary_id;?>">
		<input type="hidden" id="flag" value="<?php echo $flag;?>">
		<input type="hidden" id="serviceid" value="<?php echo $serviceId;?>">
		<input type="hidden" id="lang_val" value="<?php echo $userLang;?>">
		<input type="hidden" id="decod_itinerary_id" value="<?php echo $itineraryId;?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="itineraryApproved">Approve</button>
      </div>
    </div>
  </div>
</div>
<!-- Attendees MODAL -->
<div class="modal fade" id="moreAttendeesModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">All Attendees</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
     <div class="modal-body">
        <div class="modalList">
		 <?php if(!empty($attendeesData)){?>
          <ul class="peopleBox">
          <?php 							
			 foreach($attendeesData as $attendees):
			?>
			<li> <span><img src="<?php echo base_url();?>assets/img/profile/placeholder.jpg" alt="Profile"></span>
			<p><?php echo $attendees->full_name;?></p>
			 </li>                                          
		 <?php endforeach; ?>
          </ul>
		  <?php }else{
			    echo '<p class="text-center text-light p-4">No data available.</p>';
			 }?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Translator ALERT MODAL -->
<div class="modal fade" id="approveModal_translator" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">This Itinerary is Pending for Approvel from Translator?</p>
        </div>		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>       
      </div>
    </div>
  </div>
</div>

<!-- REJECTION ALERT MODAL -->
<div class="modal fade" id="rejectionModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Reasons for rejections</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="reasonBox">
		<ul>
		<?php
		if(isset($reasonHistoryData) && !empty($reasonHistoryData)) {
		$reasonHistoryData = json_decode(json_encode($reasonHistoryData),true);
		foreach($reasonHistoryData as $key => $value) { ?>
			<li>
				<p><?php echo $value["reason"]; ?></p>
				<small><?php echo $value["created_at"]; ?></small>
			</li>
		<?php } } ?>
		</ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>

<?php require_once('main_footer.php');?>
<?php include('adminscript.php');?>
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC32_hwlF6rX6bIbwISUVS1GJ89dcjsLz4&libraries=places"></script>-->
<?php
	$latLngArr = explode(',',$pickupCoordinate);	
	?>

<script type="text/javascript">
var pickupLat =  '<?php echo $latLngArr[0]?>';
var pickupLng =  '<?php echo $latLngArr[1]?>';

var center = new google.maps.LatLng(pickupLat,pickupLng);

function initialize() {
	
    var mapOption = {
        center: center,
        zoom: 15,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var mapVar = new google.maps.Map(document.getElementById("map"), mapOption);

	var markerPointer = new google.maps.Marker({
		position: center,
    });

	markerPointer.setMap(mapVar);
}

google.maps.event.addDomListener(window, 'load', initialize);

</script> 
<script type="text/javascript">
var itinerary_id = '<?php echo $itineraryData->id?>';
(function($) {
 // RATING 
    $('.iwlRating').ffrating({
        isStar: true,
        readonly: '<?php if(empty($transflag))echo false;else{echo true;}?>',
        showSelectedRating: true,
        min: 1,
        max: 5,		
		onSelect: function () {
		var rating = $(".ff-rating-current-rating").html();
		var proceed = true;
		if(rating=='' || rating==null){
			proceed = false;
			return false;
			}
		if(proceed){
			 $.ajax({
				   type:'post',
				   url:'<?php echo base_url()?>Admin/itinerary_ratings',
				   data:{itinerary_id:itinerary_id,rating:rating},
				   success:function(html){
					   console.log(html);
					   location.reload();
					   }
				 });
			}		
		},
    });


    
// FAQ
  $(document).on('click', '.faqQuestion', function() {
      var $this = $(this);
      var $parent = $this.closest('li');
      var $answer = $parent.find('.faqAnswer');
      var $otheranswer = $parent.siblings().find('.faqAnswer');
      var $otherquestion = $parent.siblings().find('.faqQuestion');
      $this.toggleClass('active');
      $answer.slideToggle();
      $otherquestion.removeClass('active');
      $otheranswer.slideUp();
});  

/*$('#rsvpDone').on('click',function(){
	var formData = $('#rsvpFormData').serialize();
	var full_name = $('#full_name').val();	
	var proceed = true;	
	if(full_name=='' || full_name==null){
	    proceed = false;
		return false;
		}
 $('#rsvpDone').html('Loading...');		
  if(proceed){
	   $.ajax({
		     type:'post',
			 url:'<?php echo base_url();?>itineraries/interested',
			 data:formData,
			 success:function(html){
			   $('#rsvpDone').html('Done');	
			   $('#rsvpModal').modal('hide');
			   if(html==='success'){
				   location.reload();
				   }
			   else{
				   alert('error');
				   }	   
				 
				 }
		   });
	  }		
});*/

//========== itinerary approve js START:: ===================//
$(document).on('click','#itineraryApproved',function(){
	
	var itineraryid = $('#itineraryid').val();
	var flag = $('#flag').val();
	var serviceId = $('#serviceid').val();
	var lang_val = $('#lang_val').val();
	var decod_itinerary_id = $('#decod_itinerary_id').val();
	var itineraryCity = '<?php echo $itineraryData->origin_city;?>';
	var itineraryTitle = "<?php echo $itineraryData->itinerary_title;?>";	
	
	var itinerary_url = '<?php echo base_url()?>session/'+decod_itinerary_id+'/'+serviceId+'/'+lang_val+'/'+itineraryCity+'/'+itineraryTitle;
		
    //var itinerary_url = window.location.href;
	var proceed = true;
	if(itineraryid==''){
		 proceed = false;
		 return false;
		}
	$('#itineraryApproved').html('Loading...');	
	if(proceed){
		 $.ajax({
			   type:'post',
			   url:'<?php echo base_url();?>Admin/approveItinerary',
			   data:{itineraryid:itineraryid,flag:flag,itinerary_url:itinerary_url},
			   success:function(html){
			      $('#itineraryApproved').html('approve');
				  $('#approveModal').hide();
				  if($.trim(html)=='success'){
					  window.location.href = '<?php echo base_url();?>admin/itineraries';
					  }
					else{
						 alert('oops! something is wrong.');
						}  
				   }			 
			 });
		}	
});
//========== itinerary approve js END:: ====================//

//============ itinerary rejected by admin ================//
$('#adminReject_itinerary').on('click',function(){
	var reject_reason = $('#reject_reason').val();
	var itineraryid = $('#itineraryid').val();
	var flag = $('#flag').val();
	var serviceId = $('#serviceid').val();
	var lang_val = $('#lang_val').val();
	var decod_itinerary_id = $('#decod_itinerary_id').val();
	var itineraryCity = '<?php echo $itineraryData->origin_city;?>';
	var itineraryTitle = "<?php echo $itineraryData->itinerary_title;?>";	
	
	var itinerary_url = '<?php echo base_url()?>session/'+decod_itinerary_id+'/'+serviceId+'/'+lang_val+'/'+itineraryCity+'/'+itineraryTitle;
		
 //var itinerary_url = window.location.href;
	var proceed = true;
	if(reject_reason=='' || reject_reason==null){
	  $('#rejectedErr').html('Enter reason for rejection').css({'color':'red','font-size':'12px'});	
	  proceed = false;	
	  return false;	
	}
	if(itineraryid=='' || itineraryid==null){
	  proceed = false;
	  return false;	
	}
	$('#adminReject_itinerary').html('Loading...');	
	if(proceed){
	    $.ajax({
		       type:'post',
			   url:'<?php echo base_url();?>Admin/rejectItinerary',
			   data:{itineraryid:itineraryid,flag:flag,reject_reason:reject_reason,itinerary_url:itinerary_url},
			   success:function(html){
			      $('#adminReject_itinerary').html('Reject');
				  $('#approveModal').hide();
				  if($.trim(html)=='success'){				      
					  window.location.href = '<?php echo base_url();?>admin/itineraries_request';					
					  }
					else{
						 alert('oops! something is wrong.');
						}  
				   }			 
			 });
	
}
});

//========== itinerary rejected reason keydown js ===========//
$("#reject_reason").keypress(function(){
    var reasonText = $('#reject_reason').val();
	if(reasonText!=''){
		 $('#rejectedErr').html('');
		}else{
		 $('#rejectedErr').html('Enter reason for rejection').css({'color':'red','font-size':'12px'});
		}
  });
  
//============ itinerary disabled by admin ================//
$('#itinerary_disabled').on('click',function(){
	var itineraryid = $('#itineraryid').val();
	var flag = $('#flag').val();
	var serviceId = $('#serviceid').val();
	var lang_val = $('#lang_val').val();
	var decod_itinerary_id = $('#decod_itinerary_id').val();
	var itineraryCity = '<?php echo $itineraryData->origin_city;?>';
	var itineraryTitle = "<?php echo $itineraryData->itinerary_title;?>";	
	
	var itinerary_url = '<?php echo base_url()?>session/'+decod_itinerary_id+'/'+serviceId+'/'+lang_val+'/'+itineraryCity+'/'+itineraryTitle;
		
//var itinerary_url = window.location.href;
var proceed = true;

if(itineraryid=='' || itineraryid==null){
  proceed = false;
  return false;	
}
$('#itinerary_disabled').html('Loading...');	
if(proceed){
	$.ajax({
		type:'post',
			   url:'<?php echo base_url();?>Admin/disabledItinerary',
			   data:{itineraryid:itineraryid,flag:flag,itinerary_url:itinerary_url},
			   success:function(html){
			      $('#itinerary_disabled').html('disabled');
				  $('#disableModal').hide();
				  if($.trim(html)=='success'){
					  window.location.href = '<?php echo base_url();?>admin/itineraries';
					  }
					else{
						 alert('oops! something is wrong.');
						}  
				   }			 
			 });
	
}
});

//============ itinerary enabled by admin ================//
$('#itinerary_enabled').on('click',function(){
	var itineraryid = $('#itineraryid').val();
	var flag = $('#flag').val();
	var serviceId = $('#serviceid').val();
	var lang_val = $('#lang_val').val();
	var decod_itinerary_id = $('#decod_itinerary_id').val();
	var itineraryCity = '<?php echo $itineraryData->origin_city;?>';
	var itineraryTitle = "<?php echo $itineraryData->itinerary_title;?>";	
	
	var itinerary_url = '<?php echo base_url()?>session/'+decod_itinerary_id+'/'+serviceId+'/'+lang_val+'/'+itineraryCity+'/'+itineraryTitle;
		
//var itinerary_url = window.location.href;
var proceed = true;

if(itineraryid=='' || itineraryid==null){
  proceed = false;
  return false;	
}
$('#itinerary_enabled').html('Loading...');	
if(proceed){
	$.ajax({
		type:'post',
			   url:'<?php echo base_url();?>Admin/enabledItinerary',
			   data:{itineraryid:itineraryid,flag:flag,itinerary_url:itinerary_url},
			   success:function(html){
			      $('#itinerary_enabled').html('Enabled');
				  $('#enableModal').hide();
				  if($.trim(html)=='success'){
					  window.location.href = '<?php echo base_url();?>admin/itineraries';
					  }
					else{
						 alert('oops! something is wrong.');
						}  
				   }			 
			 });
	
}
});

//========= checkbox for mail send or not ============//
$('#mailForAdmin').on('change',function(){
	var chk_val = $(this).is(":checked");
	var itineraryId = '<?php echo $itineraryData->id?>';
	var proceed = true;
	if(itineraryId==''){
		 proceed = false;
		 return false;
		}
	if(chk_val==true){
		var mailVal = 1;
		}
	else{
		var mailVal = 0;
		}
	
	if(proceed){
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url();?>admin/update_mail_status',
			 data:{mailVal:mailVal,itineraryId:itineraryId},
			 success:function(html){				  
				  location.reload();
				 }
			});
		}
});

//=========== Change host Language Data js Start on 19-02-19 =========//
$('.changeLang').on('change',function(){
	 var itinerary_lang = $(this).closest('.itinerarieslanguage').find('.changeLang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerarieslanguage').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerarieslanguage').find('.serviceid').val();
	
	var detailURL = '<?php echo base_url()?>admin/admin_detail_itineraries_sessions?itinerary_id='+itinerary_id+'&flag=<?php echo $flag?>'+'&service_id='+serviceid+'&lang='+itinerary_lang;		
	window.location.replace(detailURL);
	
});

//=========== Js for Translator start =============//
$(document).on('change','#send_translator',function(){
   var transvalue = $('#send_translator option:selected').val();
   var itinerary_id = $(this).closest('.sendToTranslator').find('.itinerary_id').val();
   var serviceid = $(this).closest('.sendToTranslator').find('.serviceid').val();
  var proceed = true;
  /*if(transvalue==''){
	  proceed = false;
	  return false;	  
	  }*/
 if(proceed){
	  $.ajax({
		    type:'post',
			url:'<?php echo base_url()?>Admin/sendToTranslator',
			data:{transvalue:transvalue,itinerary_id:itinerary_id,serviceid:serviceid},
			success:function(data){
				 console.log(data); //return false;
				 if($.trim(data)=='success'){
					 location.reload();
					 }
				}
	   });
	 }	  
  
});

$('#changePriority').on('change',function(){
	var chk_val = $(this).is(":checked");
	var itineraryId = '<?php echo $itineraryData->id?>';
	var proceed = true;
	if(itineraryId==''){
		 proceed = false;
		 return false;
		}
	if(chk_val==true){
		var mailVal = 1;
		}
	else{
		var mailVal = 0;
		}

	if(proceed){
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url();?>admin/update_priority',
			 data:{mailVal:mailVal,itineraryId:itineraryId},
			 success:function(html){
				 }
			});
		}
});

//========== image zoom js ==========//
$('.parent-container').magnificPopup({
								delegate: '.imagePlayer',
								type: 'image',
								 gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] 
          },
				});

})(jQuery);
</script>
<?php include('footer.php');?>
