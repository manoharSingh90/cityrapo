<?php 
	require_once('head.php');
	require_once('header.php');
			if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
			    $currentUrl = "https"; 
			else
			    $currentUrl = "http"; 
			$currentUrl .= "://"; 
			$currentUrl .= $_SERVER['HTTP_HOST']; 
			$currentUrl .= $_SERVER['REQUEST_URI']; 
			//echo $currentUrl; 
?>
<main>
  <div class="detailPage">
   <?php 
	if($itineraryData->feature_img!=''){
		$img3 = 'assets/itinerary_files/gallery/'.$itineraryData->feature_img;
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
            <div class="mainIntro-top"> <a href="<?php echo base_url();?>itineraries/meetup" class="text-uppercase"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
              <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8
	c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"/>
              </svg> Back</a><div class="itinerarieslanguage">
                <select class="form-control changeLang">
                <option value="<?php echo $itineraryData->itinerary_language;?>" <?php if($userLang==$itineraryData->itinerary_language) echo 'selected';?>><?php echo  $itineraryData->itinerary_language;?></option> 
                <option value="English" <?php if($userLang=='English') echo 'selected';?>>English</option>
                </select>
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryData->id)?>"/>
                <input type='hidden' name="serviceid" class="serviceid" value="<?php echo $itineraryData->service_id;?>"/>
              </div> </div>
            <div class="mainIntro-head">
              <h2 class="introTitle mb-2">
				  <?php 
			      if(!empty($userLang!='English') && $userLang!='english'){
				  echo $itineraryData->itinerary_other_title;
				  }else{
				  echo $itineraryData->itinerary_title;
				  }
				  ?>
				  </h2>
              <div class="introRating">
                <input type="textbox" class="ff-rating iwlRating" value="<?php if(isset($itineraryData->rating)) echo $itineraryData->rating;?>" />
              </div>
            </div>
            <div class="mainIntro-body clearfix">
              <h3 class="introSubtitle">
				  <?php if(!empty($userLang!='English') && $userLang!='english'){
					 echo $itineraryData->itinerary_other_tagline;
						}else{
						 echo $itineraryData->itinerary_tagline;
						}
				  ?>
				  </h3>
               <p>
				 <?php if(!empty($userLang!='English') && $userLang!='english'){
					     echo $itineraryData->other_itinerary_description;
						}else{
						 echo $itineraryData->itinerary_description;
						}
					 
				  ?></p>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <p class="intro-theme d-block float-none"><span>Themes:</span> 
				 <?php $themesArr = array();				      
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
                </div>
                <!--<div class="col-12 col-sm-6 text-right">
                  <p class="intro-theme d-block float-none"><span>Type:</span> 
					   <?php 					       
						  /*if(!empty($itineraryData->meetup_type)){							  						   
							   echo str_replace(',', ',&nbsp;', $itineraryData->meetup_type);					   							   
							  }*/
						  ?>
					  </p>
                </div>-->
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
              <!--<div class="col-12 col-sm-6">
                <div class="sponsoredCube"><img src="assets/img/sponsor/banner_02.jpg" alt="sponsor" /> </div>
              </div>-->
            </div>
          </div>
		  <?php } ?>
          <div class="row mt-4">           
            <div class="col-12">
              <div class="bookIntro boxStyle">
                <h3 class="normalTitle float-left">Book Now</h3>
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
					   $familyKidesdata = getFamilyMultiData($itineraryData->id);
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
        </div>
        <div class="col-12 col-lg-4">
          <div class="otherIntro boxStyle moveUp">
            <h3 class="normalTitle text-center"><img src="<?php echo base_url();?>assets/img/icon/star.svg" alt="star"> Highlights & Features</h3>
            <div class="highList">
              <p class="smallTitle">Highlights</p>
              <ul class="clearfix">
                <?php 
				   if(!empty($itineraryData->type_highlights)){
					    $highLights = explode(',',$itineraryData->type_highlights);
						$count = count($highLights);						
					   }					
					foreach($highLights as $key=>$value):
					if($key<=4){
				  ?>
                <li class="roundedBox"><?php echo $value;?></li>
				<?php } endforeach; ?> 
              </ul>
             <?php if($count>5){?>
              <a href="#" class="mt-4 mb-4" data-toggle="modal" data-target="#moreHighlightModal">View More</a>
			  <?php } ?>
			  </div>
            <div class="featList">
              <p class="smallTitle">Features</p>
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
				     $i=0;
					 foreach($featurData as $key=>$value):
					 if($i==3){break;}
					 if($value!=''){
						  $img = $value;
						 }
					 ?> 
				 <li><span><img src="<?php echo base_url();?>assets/img/icon/feature/<?php echo $img;?>" alt="<?php echo $key;?>" /></span> <?php echo $key;?></li>
				<?php $i++; endforeach;?>  	 
              </ul>
             <?php 
			  if(count($tempArr)>4){
					echo '<a href="#" class="mt-4" data-toggle="modal" data-target="#moreFeatureModal">View More</a></div>';
				  }					
				  ?>
			 </div>
          </div>
          <div class="createrIntro boxStyle ">
            <h3 class="normalTitle mb-0">Host Details</h3>
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
			<small class="internal-verify"><b> <img src="<?php echo base_url();?>assets/img/icon/badge/<?php echo $hostIcon.'_badge.svg'?>"  alt="<?php echo $hostIcon;?>"> </b>
			 <?php
				 echo $hostDatas['host_name'];					 		  			 
			  	?></small>
			 <?php } ?>		  
				
			<small class="internal-verify"><b> <img src="<?php echo base_url();?>assets/img/icon/tourguide.svg" alt="tourguide"> </b> </small>	
			<small class="internal-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="<?php echo $hostData['verified_by'];?>" /> </b>&nbsp; Verified</small>
			</p>
            <p class="introBox-text mb-3 font-weight-semibold"><img src="<?php echo base_url();?>assets/img/icon/call_red.svg" alt="Call"><?php echo $hostData['host_mob_no'];?></p>
            <p class="introBox-text mb-3 font-weight-semibold"><img src="<?php echo base_url();?>assets/img/icon/mail_red.svg" alt="Mail"> <?php echo $hostData['host_email'];?></p>
          </div>
        </div>
        <div class="col-12">
          <div class="peopleboxStyle">
            <ul class="nav nav-tabs normalTab" role="tablist">
              <li class="nav-item"> <a class="nav-link text-uppercase active" id="attendees-tab" data-toggle="tab" href="#attendeesData" role="tab" aria-controls="attendeesData" aria-selected="true">Attendees</a> </li>
              <li class="nav-item"> <a class="nav-link text-uppercase" id="interested-tab" data-toggle="tab" href="#interestedData" role="tab" aria-controls="interestedData" aria-selected="true">Interested</a> </li>
            </ul>
            <div class="tab-content normalTab-content">
              <div class="tab-pane fade show active interestCover" id="attendeesData" role="tabpanel" aria-labelledby="attendees-tab">
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
              <div class="tab-pane fade interestCover" id="interestedData" role="tabpanel" aria-labelledby="interested-tab">			 
                <div class="row">
                  <div class="col-12 col-sm-9">                    
					<?php 
					     if(!empty($itineraryData->id) and !empty($itineraryData->service_id)){
							  $interestedList = getInterestedData($itineraryData->id,$itineraryData->service_id);							 
						 $count = count($interestedList);
						 if(!empty($interestedList)){
						 ?>
						 <ul class="peopleBox interestedList">
						<?php foreach($interestedList as $dataVal):	 						
						 ?>
                      <li>
					  <!--<span><img src="<?php //echo base_url();?>assets/img/profile/placeholder.jpg" alt="Profile"></span>-->
                        <p><?php echo $dataVal->full_name;?></p>
                      </li>
						<?php endforeach;?>
						</ul>
						<?php
						 }else{
						   echo '<p class="text-center text-light p-4">No data available.</p>';
						    }
						 }?>                      
                    
                  </div>
				  <?php 
					  if($count>8){
					  ?>
                  <div class="col-12 col-sm-3 text-center flex-center"> <a href="#" class="text-primary small"  data-toggle="modal" data-target="#moreInterestedModal">View More</a> </div>
					  <?php } ?>
                </div>			 				
				
              </div>
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
						   }
						 $img = '';  
						foreach($modeData as $mode):
						if($mode=='bus'){
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
							}	
					   if($mode=='foot'){
							 $img = 'foot_red.svg';
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
<!-- LEAVE MESSAGE -->
<div class="leaveMessage"> <a href="#" id="leftMsg"  class="msgLink"><b><img src="<?php echo base_url();?>assets/img/icon/mail.svg" alt="mail"></b><span>Leave a message</span></a>
  <div class="messageForm">
    <form id="leaveMessage">
      <h2 class="text-secondary">Leave a message</h2>
      <div class="alert alert-success fade in alert-dismissible" style="margin-top:18px;"> <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">�</a> <strong>Success!</strong> This alert box indicates a successful or positive action. </div>
      <ul class="form-row">
        <li class="form-group col-12">
          <label class="col-form-sublabel">Full Name</label>
          <input type="text" class="form-control" name="fname" placeholder="Full Name" required autocomplete="off" />
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off"/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Phone</label>
          <input type="number" class="form-control" name="phone_no" placeholder="Phone" required autocomplete="off"/>
        </li>
        <li class="form-group col-12">
          <textarea class="form-control" name="desc" placeholder="Write your message (max. 400 chartacters)" maxlength="400" required></textarea>
        </li>
		<input type="hidden" name="currentUrl" value="<?php echo $currentUrl;?>" autocomplete="off" />
        <li class="form-group col-12 text-right">
          <button class="btn btn-primary" id="sendLeave" type="submit">Send</button>
        </li>
      </ul>
    </form>
  </div>
</div>
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
			 if(!empty($itineraryData->user_id) and !empty($itineraryData->id) and !empty($itineraryData->service_id)){
				 $interestedList = getInterestedData($itineraryData->user_id,$itineraryData->id,$itineraryData->service_id);				 
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
            <li> <span><img src="<?php echo base_url();?>assets/img/profile/sample.jpg" alt="Profile"></span>
              <p>Javed Kiran</p>
              Visual Designer & Enterpreneur </li>
            <li> <span><img src="<?php echo base_url();?>assets/img/profile/sample.jpg" alt="Profile"></span>
              <p>Javed Kiran</p>
              Visual Designer & Enterpreneur </li>
            <li> <span><img src="<?php echo base_url();?>assets/img/profile/sample.jpg" alt="Profile"></span>
              <p>Javed Kiran</p>
              Visual Designer & Enterpreneur </li>
            <li> <span><img src="<?php echo base_url();?>assets/img/profile/sample.jpg" alt="Profile"></span>
              <p>Javed Kiran</p>
              Visual Designer & Enterpreneur </li>
          </ul>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

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
<?php include('footer.php');?>
<?php include('foot.php');?>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC32_hwlF6rX6bIbwISUVS1GJ89dcjsLz4&libraries=places"></script>
<?php
	$latLngArr = explode(',',$pickupCoordinate);	
 ?>
 
<script type="text/javascript">
var pickupLat =  '<?php echo $latLngArr[0]?>';
var pickupLng =  '<?php echo $latLngArr[1]?>';
		
var center = new google.maps.LatLng(pickupLat, pickupLng);

function initialize() {
	
    var mapOption = {
        center: center,
        zoom: 13,
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
(function($) {
// RATING 
 $('.iwlRating').ffrating({
	 isStar:true,
	 readonly:true,
	 showSelectedRating:true,
	 min:1,
	 max:5
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


//=========== Change Language Data js Start on 18-02-19 =========//
$('.changeLang').on('change',function(){
	 var itinerary_lang = $(this).closest('.itinerarieslanguage').find('.changeLang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerarieslanguage').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerarieslanguage').find('.serviceid').val();
	
	var detailURL = '<?php echo base_url()?>itineraries/itineraries_meetup_detail?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&lang='+itinerary_lang;		
	window.location.replace(detailURL);
	
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
</body>
</html>