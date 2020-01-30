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
  <div class="bookPage">
    <div class="coverBox">
     <?php 
	if(!empty($itineraryData->feature_img)){
		$img3 = 'assets/itinerary_files/gallery/'.$itineraryData->feature_img;
	  }else{
	   $img3 = 'assets/img/set/sample.jpg';
	  }
	  
	if($serviceId==1){
		 $back = 'walk';
		}
    elseif($serviceId==2){
		$back = 'session';
		}
	elseif($serviceId==3){
		$back = 'experience';
		}
	elseif($serviceId==4){
		$back = 'meetup';
		}
	else{
		$back = '';
		}	
	?>
      <div class="blurImage" style="background-image:url(<?php echo base_url();?><?php echo $img3;?>);"></div>
      <div class="container">
        <div class="bookingIntro"> <a href="<?php echo base_url();?>home/<?php echo $back;?>" class="text-uppercase">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
            <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8	c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"/>
          </svg>
          Back</a>
          <p>You are booking</p>
          <h2><?php echo $itineraryData->itinerary_title;?></h2>
          <h3>
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19.2 19" style="enable-background:new 0 0 19.2 19;" xml:space="preserve">
              <path d="M15.9,7.3c0,4-3.6,8.4-5.4,10.3c-0.5,0.5-1.3,0.5-1.8,0c-1.8-1.9-5.5-6.3-5.5-10.3C3.1,3.8,6,1,9.5,1S15.9,3.8,15.9,7.3z	 M9.5,4.3c-1.6,0-3,1.3-3,3s1.3,3,3,3s3-1.3,3-3S11.1,4.3,9.5,4.3z"/>
            </svg>
            <?php echo $itineraryData->origin_city;?></h3>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="fillIntro">
        <form class="clearfix" id="bookingFormData">
          <fieldset class="clearfix">
           <input type="hidden" name="itinerary_id" value="<?php echo $itineraryId;?>" />
           <input type="hidden" name="service_id" value="<?php echo $serviceId;?>" />
           <input type="hidden" name="origin_city" value="<?php echo $itineraryData->origin_city;?>" />
           <input type="hidden" name="userType" value="<?php echo $userType;?>"/>
           <input type="hidden" name="userLang" value="<?php echo $userLang;?>"/>
           <input type="hidden" name="itinerary_title" value="<?php echo $itineraryData->itinerary_title;?>"/>
           <h3 class="col-form-label">Availablitiy & Time</h3>
           <div class="placeVaild">
           	
            <label class="col-form-sublabel mb-2">Available Dates</label>
            <ul class="owl-carousel owl-theme dateSlider mb-2">
			<?php 
				/* date_default_timezone_set('Asia/Kolkata');                
				$create_date = date('d/m/Y'); */
				//$create_chktime = date('h:i A');
			    //echo 'hello'.$create_date;
			?>		    
				
			<?php 			    
			//$slotsTimesData = getAll_pickupspoints($itineraryData->id);
			//echo '<pre>';print_r($slotsTimesData);
			
			/*  $period = new DatePeriod(
			 new DateTime($itineraryData->start_date_from_host),
			 new DateInterval('P1D'),
			 new DateTime($itineraryData->end_date_to_host)
			);
			
			//======== code for test on 10-05-19 by robin=======//			 
			 $start_date = $itineraryData->start_date_from_host;
			 $end_date =  $itineraryData->end_date_to_host;
             $alldateSlots = array();
			 $alldateFormatSlots = array();
			 $offdaysArr = array();
			 $diffDatesArr = array();
				
			while (strtotime($start_date) <= strtotime($end_date)) {
				  //echo "$start_date";
				  array_push($alldateSlots,$start_date);
				  $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));				 
			}
			
			foreach($alldateSlots as $dates){
				 array_push($alldateFormatSlots,date('d/m/Y',strtotime($dates)));
				}
			
			 if(!empty($itineraryData->frequency_off_days)){
				 $offDays = explode(',',$itineraryData->frequency_off_days);
				 }else{
				 $offDays = array();
				 }
			foreach($offDays as $days){
				 array_push($offdaysArr,date('d/m/Y',strtotime($days)));
				}			
			
			foreach ($period as $key => $val) {
			 if(!in_array(date('d/m/Y',strtotime($val->format('Y-m-d'))),$diffDatesArr)){
				 array_push($diffDatesArr,date('d/m/Y',strtotime($val->format('Y-m-d'))));				
				}
			}
			//$bookingdates = array_diff($diffDatesArr,$offdaysArr);
			$bookingdates = array_diff($alldateFormatSlots,$offdaysArr);
			//echo '<pre>';print_r($bookingdates);
			$counter =1;
			foreach($bookingdates as $key=>$dateSlots):
			if($dateSlots<$create_date){
				   $disabled = 'disabled';
				  }else{
				   $disabled = '';
				  }	 */	
			?>
			<!--<li class="item">
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" id="bookingDate-<?php echo $counter;?>" name="booking-date" class="custom-control-input chk_box"  value="<?php echo $dateSlots;?>" <?php echo $disabled;?> required />
			  <label class="custom-control-label" for="bookingDate-<?php echo $counter;?>"><?php echo $dateSlots;?></label>
			</div>
		  </li>-->
		  <?php //$counter++; endforeach;
		  
		  //====end by robin====//
		  
			/*$counter =1;
			$flag = 1;
			foreach ($period as $key => $value) {			
			$flag++;			
			
			if(date('d/m/Y',strtotime($value->format('Y-m-d')))<$create_date){
				   $disabled = 'disabled';
				  }else{
				   $disabled = '';
				  }			  
		  ?>
		  
		 <li class="item">
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" id="bookingDate-<?php echo $counter;?>" name="booking-date" class="custom-control-input chk_box"  value="<?php echo date('d/m/Y',strtotime($value->format('Y-m-d')));?>" <?php echo $disabled;?> required />
			  <label class="custom-control-label" for="bookingDate-<?php echo $counter;?>"><?php echo date('d/m/Y',strtotime($value->format('Y-m-d')));?></label>
			</div>
		  </li>
		  <?php $counter++;}
		  
		  if(date('d/m/Y',strtotime($itineraryData->end_date_to_host))<$create_date){
				   $lastdisabled = 'disabled';
				  }else{
				   $lastdisabled = '';
				  }	*/
		  ?>
		  <!--<li class="item">
			<div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" id="bookingDate-<?php echo $flag;?>" name="booking-date" value="<?php echo date('d/m/Y',strtotime($itineraryData->end_date_to_host));?>" class="custom-control-input chk_box" <?php echo $lastdisabled;?> required />
			  <label class="custom-control-label" for="bookingDate-<?php echo $flag;?>"><?php echo date('d/m/Y',strtotime($itineraryData->end_date_to_host));?></label>
			</div>
		  </li>-->
		  
			
			<!-- ADDED BY SAHIL -->
			<?php /*
			$startDate = $itineraryData->start_date_from_host;
			$endDate = $itineraryData->end_date_to_host;
			$offDate = !empty($itineraryData->frequency_off_days) ? explode(",",$itineraryData->frequency_off_days) : array();
			$offDate = array_map('trim',$offDate);
			
			date_default_timezone_set('Asia/Kolkata');
			$startTime = strtotime($itineraryData->aviaiable_time_form_host);
			$currentTime = strtotime("now");
			
			function getDatesFromRange($start, $end, $format = 'd-m-Y')
			{  
				$array = array();
				$interval = new DateInterval('P1D');
				$realEnd = new DateTime($end); 
				$realEnd->add($interval);
				$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
				
				foreach($period as $date)
				{                  
					$array[] = $date->format($format);  
				} 
			  
				return $array; 
			}
			
			$allDates = getDatesFromRange($startDate, $endDate);
			$finalDates = array_diff($allDates,$offDate);
			
			if(($currentTime>$startTime) && isset($finalDates[0]) && (date("d-m-Y")==$finalDates[0]))
			{
				unset($finalDates[0]);
			}
			
			if(!empty($finalDates)) {
			foreach(array_values($finalDates) as $key => $value) { ?>
			<li class="item">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="bookingDate-<?php echo $key+1;?>" name="booking-date" class="custom-control-input chk_box"  value="<?php echo date('d/m/Y',strtotime($value));?>" required />
					<label class="custom-control-label" for="bookingDate-<?php echo $key+1?>"><?php echo date('d/m/Y',strtotime($value));?></label>
				</div>
			</li>
			<?php } } */?>
		  <!-- ADDED BY SAHIL -->


		  <?php
			//$startItineraryDate = $itineraryData->start_date_from_host;
			date_default_timezone_set('Asia/Kolkata');
			//$startDate = $itineraryData->start_date_from_host;
			$startDate = date('Y-m-d h:i A');
			//echo $startDate;
			$endDate = $itineraryData->end_date_to_host;
			$avilableEndTime = date('Y-m-d h:i A',strtotime($itineraryData->aviaiable_time_to_host));			
			$currentEndTime = date('Y-m-d h:i A',strtotime('now'));			
			//$currentEndTime = new DateTime('Y-m-d h:i:s',strtotime($avilableEndTime)); 			
				/*if($avilableEndTime < $currentEndTime){
				    $startDate = date('Y-m-d h:i A',strtotime("now") );
				}*/
			
			
			$offDate = !empty($itineraryData->frequency_off_days) ? explode(",",$itineraryData->frequency_off_days) : array();
			$offDate = array_map('trim',$offDate);
			//echo"<pre>";print_r($itineraryData->aviaiable_time_form_host);die;			
			//$startTime = strtotime($itineraryData->aviaiable_time_to_host);			
			//$currentTime = strtotime("now");
			$startTime = date('h:i A',strtotime($itineraryData->aviaiable_time_to_host));
			$currentTime = date('h:i A',strtotime('now'));
			
			function getDatesFromRange($start, $end, $format = 'd-m-Y')
			{  
				$array = array();
				$interval = new DateInterval('P1D');				
				$realEnd = new DateTime($end); 
				$realEnd->add($interval);

				$period = new DatePeriod(new DateTime($start), $interval, $realEnd);
				//echo'<pre>';print_r($period);die;
				foreach($period as $date)
				{                  
					$array[] = $date->format($format);  
				} 
			  	//echo'<pre>';print_r($array);die;
				return $array; 
			}
			//echo $startDate;
			$allDates = getDatesFromRange($startDate, $endDate);			
			$finalDates = array_diff($allDates,$offDate);

			
			if(($currentTime>$startTime) && isset($finalDates[0]) && (date("d-m-Y")==$finalDates[0]))
			{
				unset($finalDates[0]);
			}			
			if(!empty($finalDates)) {
			foreach(array_values($finalDates) as $key => $value) { ?>
			<li class="item">
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="bookingDate-<?php echo $key+1;?>" name="booking-date" class="custom-control-input chk_box"  value="<?php echo date('d/m/Y',strtotime($value));?>" required />
					<label class="custom-control-label" for="bookingDate-<?php echo $key+1?>"><?php echo date('d/m/Y',strtotime($value));?></label>
				</div>
			</li>
			<?php } } ?>
		  
          </ul>
         </div>
            <div class="placeVaild">
            <label class="col-form-sublabel mb-2 pt-4">Available Slots</label>
		
					<ul class="owl-carousel owl-theme timeSlider mb-2 appendSots">
			<?php 
				date_default_timezone_set('Asia/Kolkata'); 
                $create_time = date('h:i A');
				$create_date = date('d/m/Y');
			    //echo $create_time;
				?>
			<?php

			$slotsTimesData = getAll_pickupspoints($itineraryData->id);
			//echo '<pre>';print_r($itineraryData);
			//$current_date_slot=str_replace('/','-',$itineraryData->current_date_slot);
			//echo date('Y-m-d',strtotime($current_date_slot));
			//echo '<pre>';print_r($slotsTimesData);
			$idFlag =1;
			foreach($slotsTimesData as $key=>$slotVal):
			$starttime = $slotVal->start_pickup_time;  // your start time
			$endtime =   $slotVal->end_dropoff_time;  // End time
			
			$start_time    = strtotime ($starttime); //change to strtotime
			$end_time      = strtotime ($endtime); //change to strtotime
			
			//if($itineraryData->current_date_slot>=$create_date){
			//if(strtotime(str_replace('/','-',$itineraryData->current_date_slot)) >= strtotime($create_date)){
			  //if($start_time>=strtotime($create_time)){?>
				<li class="item">
				 <div class="custom-control custom-radio custom-control-inline">
				  <input type="radio" id="bookingTime-0<?php echo $idFlag;?>" name="booking-time" class="custom-control-input time_slots"  value="<?php echo $slotVal->id?>" required />
				  <label class="custom-control-label labelval time_label" for="bookingTime-0<?php echo $idFlag;?>"><?php echo $starttime.' - '.$endtime;?></label>
				 </div>
				</li>				
			  <?php
		//	}			
			$idFlag++;
			endforeach;
			
			/*$array_of_time = array ();
			$duration =  $itineraryData->time_interval;  // split by 60 mins
			$start_time    = strtotime ($starttime); //change to strtotime
			$end_time      = strtotime ($endtime); //change to strtotime			
			$add_mins  =  $duration * 60;
			
			while ($start_time <= $end_time) // loop between time
			{
			  
			  $trs = date ("h:i A", $start_time);
			  if($itineraryData->current_date_slot==$create_date){
			  if(strtotime($trs)>=strtotime($create_time)){
				  $array_of_time[] = date ("h:i A", $start_time);
				  }
			  }else{
			      $array_of_time[] = date ("h:i A", $start_time);
			  }
			   //$array_of_time[] = date ("h:i A", $start_time);
			   
			   $start_time += $add_mins; // to check endtime	
			  
			}*/
			
            //echo '<pre>';print_r($array_of_time);
			/*$idFlag =1;
			$i=1;
			$endkey = end($array_of_time);
			$endkey = key($array_of_time);
			foreach($array_of_time as $key => $timeSlots) {			 
			  if($key<$endkey){			 
			  
				?>
			 <li class="item">
			 <div class="custom-control custom-radio custom-control-inline">
			  <input type="radio" id="bookingTime-0<?php echo $idFlag;?>" name="booking-time" class="custom-control-input"  value="<?php echo $array_of_time[$key].' - '.$array_of_time[$i];?>" required />
			  <label class="custom-control-label" for="bookingTime-0<?php echo $idFlag;?>"><?php echo $array_of_time[$key].' - '.$array_of_time[$i];?></label>
			 </div>
		    </li>
		   <?php 
		     $idFlag++;						 
			 $i++;
			   }
			  
			}*/
			
			?>				
			
					 </ul>
					 <div class="text-right pr-3">
					 <a href="#" class="checkNow small">Check Availablitiy</a>
					 </div>

         </div>
          </fieldset>
          <hr class="mb-4 pt-2">
          <fieldset class="infoFill">
            <h3 class="col-form-label">Traveller Type</h3>
            <label class="col-form-sublabel mb-3">Select Traveller Type</label>
            <div class="placeVaild">
            <ul class="form-row">
			<?php 
				if(!empty($itineraryData->private_traveller) && $itineraryData->private_traveller==1){
				?>
              <li class="form-group col-6 col-sm-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTraveller-01" name="traveller-type" value="privateType" class="custom-control-input" required />
                  <label class="custom-control-label text-dark" for="bookingTraveller-01">Private <span class="amt">
					 <?php if(!empty($itineraryData->private_price)) echo '&#8377;'.' '.$itineraryData->private_price;?>
				  </span></label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus" id="private_minus">-</button>
                    <input type="number" name="private_number" class="text-center calcBox" value="<?php echo $itineraryData->private_min_no_travellers;?>" min="<?php echo $itineraryData->private_min_no_travellers;?>" max="<?php echo $itineraryData->private_max_no_travellers;?>" id="private_number"/>
                    <button type="button" class="plus" id="private_plus">+</button>
                  </div>
                </div>
              </li>
			 <?php } ?>
			 <?php 
				if(!empty($itineraryData->group_traveller) && $itineraryData->group_traveller==1){
				?>
              <li class="form-group col-6 col-sm-4">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTraveller-02" name="traveller-type" value="groupType" class="custom-control-input" required />
                  <label class="custom-control-label text-dark" for="bookingTraveller-02">Group <span class="amt">
					  <?php if(!empty($itineraryData->group_price)) echo '&#8377;'.' '.$itineraryData->group_price;?>
					  </span></label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus" id="group_minus">-</button>
                    <input type="number" name="group_number" class="text-center calcBox" value="<?php echo $itineraryData->group_min_no_travellers;?>" min="<?php echo $itineraryData->group_min_no_travellers;?>" max="<?php echo $itineraryData->group_max_no_travellers;?>" id="group_number"/>
                    <button type="button" class="plus" id="group_plus">+</button>
                  </div>
                </div>
              </li>
			  <?php } ?>
              <li class="col-12"> </li>
			  <?php 
			       $familyMinValue = '';
				   $familyMaxValue = '';
				  if(!empty($itineraryData)){
					    $familyPrice = getFamilyData($itineraryData->id);
						//echo '<pre>';print_r($familyPrice);
						}
				if(!empty($familyPrice)){		
				  if($familyPrice->family_traveller!=null && $familyPrice->family_traveller==1){
				  $familyMinValue = $familyPrice->family_adult_min_no;
				  $familyMaxValue = $familyPrice->family_adult_max_no;
				  ?>
              <li class="form-group col">
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" id="bookingTraveller-03" name="traveller-type" value="familyType" class="custom-control-input" required />
                  <label class="custom-control-label text-dark" for="bookingTraveller-03">Family</label>
                </div>
              </li>
              <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-adult" class="custom-control-input familyCheckbox"  disabled />
                  <label class="custom-control-label" for="familyTraveller-adult"><small class="text-light d-block">Adults</small> <span class="amt">
				  <?php if(!empty($familyPrice->adults_price)) echo '&#8377;'.' '.$familyPrice->adults_price;?></span></label>
                </div>
                <div id="familyTraveller-no" class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus" id="family_minus">-</button>
                    <input type="number" name="family_number" class="text-center calcBox" value="<?php echo $familyPrice->family_adult_min_no;?>" min="<?php echo $familyPrice->family_adult_min_no;?>" max="<?php echo $familyPrice->family_adult_max_no;?>" id="family_number"/>
                    <button type="button" class="plus" id="family_plus">+</button>
                  </div>
                </div>
              </li>
				<?php }} ?>
			  <?php 
			  if(!empty($itineraryData)){
					    $familyKidesdata = getFamilyMultiData($itineraryData->id);
						//echo '<pre>';print_r($familyKidesdata);
						
				foreach($familyKidesdata as $data):					
					if($data->family_kides_below_age==10){ 		
				  ?>
              <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-kids-01" name="family_kides" value="10" class="custom-control-input familyCheckbox">
                  <label class="custom-control-label" for="familyTraveller-kids-01"><small class="text-light d-block">Kids (Below 10)</small> <span class="amt"><?php echo '&#8377;'.' '.$data->kides_price;?></span>
				 <input type="hidden" value="<?php echo $data->kides_price;?>" id="kids_amt_10"/>
				 <input type="hidden" name="kids_age_10" id="kids_age_10">
				</label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus" id="kides10_minus">-</button>
                    <input type="number" name="number_10" class="text-center calcBox" value="<?php echo $data->min_no_kides;?>" min="<?php echo $data->min_no_kides;?>" max="<?php echo $data->max_no_kides;?>" id="number_10"/>
                    <button type="button" class="plus" id="kides10_plus">+</button>
                  </div>
				  <input type="hidden" value="<?php if(isset($data->min_no_kides)) echo $data->min_no_kides;else{echo 1;}?>" id="kids10Min"/>
				  <input type="hidden" value="<?php if(isset($data->max_no_kides)) echo $data->max_no_kides;else{echo 1;}?>" id="kids10Max"/>
                </div>
              </li>
			<?php }
			if($data->family_kides_below_age==7){
			?>
              <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-kids-02" name="family_kides" value="7" class="custom-control-input familyCheckbox">
                  <label class="custom-control-label" for="familyTraveller-kids-02"><small class="text-light d-block">Kids (Below 7)</small> <span class="amt"><?php echo '&#8377;'.' '.$data->kides_price;?></span>
				 <input type="hidden" value="<?php echo $data->kides_price;?>" id="kids_amt_7"/>
				 <input type="hidden" name="kids_age_7" id="kids_age_7">
				</label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus" id="kides7_minus">-</button>
                    <input type="number" name="number_7" class="text-center calcBox" value="<?php echo $data->min_no_kides;?>" min="<?php echo $data->min_no_kides;?>" max="<?php echo $data->max_no_kides;?>" id="number_7"/>
                    <button type="button" class="plus" id="kides7_plus">+</button>
                  </div>
				  <input type="hidden" value="<?php if(isset($data->min_no_kides)) echo $data->min_no_kides;else{echo 1;}?>" id="kids7Min"/>
				  <input type="hidden" value="<?php if(isset($data->max_no_kides)) echo $data->max_no_kides;else{echo 1;}?>" id="kids7Max"/>
                </div>
              </li>
			<?php } 
			 if($data->family_kides_below_age==5){
			?>
			 <li class="form-group col relateFamily">
                <div class="custom-control custom-checkbox custom-control-inline">
                  <input type="checkbox" id="familyTraveller-kids-03" name="family_kides" value="5" class="custom-control-input familyCheckbox">
                  <label class="custom-control-label" for="familyTraveller-kids-03"><small class="text-light d-block">Kids (Below 5)</small> <span class="amt"><?php echo '&#8377;'.' '.$data->kides_price;?></span>
				<input type="hidden" value="<?php echo $data->kides_price;?>" id="kids_amt_5"/>
				<input type="hidden" name="kids_age_5" id="kids_age_5">
				</label>
                </div>
                <div class="countBox">
                  <label class="col-form-sublabel text-light mt-1">No. of Travellers</label>
                  <div class="plusMinus">
                    <button type="button" class="minus" id="kides5_minus">-</button>
                    <input type="number" name="number_5" class="text-center calcBox" value="<?php echo $data->min_no_kides;?>" min="<?php echo $data->min_no_kides;?>" max="<?php echo $data->max_no_kides;?>" id="number_5"/>
                    <button type="button" class="plus" id="kides5_plus">+</button>
                  </div>
				  <input type="hidden" value="<?php if(isset($data->min_no_kides)) echo $data->min_no_kides;else{echo 1;}?>" id="kids5Min"/>
				  <input type="hidden" value="<?php if(isset($data->max_no_kides)) echo $data->max_no_kides;else{echo 1;}?>" id="kids5Max"/>
                </div>
              </li>
			 <?php } 
				  endforeach; }
			 ?>
            </ul>
            </div>
            <div class="text-right pt-2 pb-2"> <a href="javascript:void(0)" class="btn btn-secondary" id="calculate">CALCULATE PRICE</a> </div>
            <label class="col-form-sublabel">Traveller Details</label>
            <h3 class="col-form-label text-secondary" id="traveller_type"></h3>
            <ul class="form-row">
              <li class="form-group col-12 m-0">
                <label class="col-form-sublabel text-light">Adult 1</label>
              </li>
              <li class="form-group col-12 col-sm-6 placeVaild">
                <label class="col-form-sublabel">Full Name</label>
                <input type="text" name="default_full_name" class="form-control" placeholder="Full Name" id="adult_fullname" required />
				<div class="name_error"></div>
              </li>
              <li class="form-group col-12 col-sm-6 placeVaild">
                <label class="col-form-sublabel">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" id="email" required />
				<div class="email_error"></div>
              </li>
              <li class="form-group col-12 col-sm-6 ">
                <label class="col-form-sublabel">International Phone No.</label>
				<!--<span class="mobileCheck">+91-</span>-->
                <input type="number" name="international_phone" class="form-control" id="international_phone" placeholder="Phone No." />				
              </li>
              <li class="form-group col-12 col-sm-6 placeVaild">
                <label class="col-form-sublabel">Phone No.</label>
				<span class="mobileCheck">+91-</span>
                <input type="number" name="phone_no" class="form-control" id="phone_no" placeholder="Phone No."  data-rule-required="true" maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter vaild mobile number" />
				<div class="phone_error"></div>
              </li>			 
            </ul>
			<div id="apend_private"></div>
			<div id="apend_group"></div>
			<div id="apend_family"></div>
			 <!--<ul class="form-row" id="kides_rows" style="display:none;">
              <li class="form-group col-12 m-0">
                <label class="col-form-sublabel text-light" id="kides_below"></label>
              </li>
              <li class="form-group col-12 col-sm-6 placeVaild">
                <label class="col-form-sublabel">Full Name</label>
                <input type="text" name="kids_full_name[]" class="form-control" placeholder="Full Name" required />
              </li>
            </ul>-->
            <div id="apend_kides"></div>
			<div id="apend_kides_7"></div>
			<div id="apend_kides_5"></div><br>
			<br>
			<div class="placeVaild">
			    <label class="col-form-sublabel">Special Mention</label>
                <textarea name="special_mention" class="form-control" placeholder="Special Mention" ></textarea>
             </div>
          </fieldset>
		  
          <fieldset class="infoShow mt-2">
            <h3 class="infoTitle">Booking Summary</h3>
            <h4 class="infoSubtitle"><?php echo $itineraryData->itinerary_title;?></h4>
            <p class="infoState"><img src="<?php echo base_url();?>assets/img/icon/loc.svg" alt="new delhi" /> <?php echo $itineraryData->origin_city;?></p>
            <p class="infoTime"><img src="<?php echo base_url();?>assets/img/icon/date.svg" alt="date" />
				<span id="booking_date"></span>  | <span id="booking_timeSlot"></span> <?php //echo $itineraryData->aviaiable_time_form_host .' - '.$itineraryData->aviaiable_time_to_host;?>
			
			<input type="hidden" name="itineraryTitle" value="<?php echo $itineraryData->itinerary_title;?>">
			<input type="hidden" name="itineraryDate"  id="itineraryDate">
			<input type="hidden" name="timeFromHost" id="timeFromHost">
			<input type="hidden" name="timeToHost"  id="timeToHost">
			<input type="hidden" name="traveller_price"  id="traveller_price">
			<input type="hidden" name="traveller_kids_10_price"  id="traveller_kids_10_price">
			<input type="hidden" name="traveller_kids_7_price"  id="traveller_kids_7_price">
			<input type="hidden" name="traveller_kids_5_price"  id="traveller_kids_5_price">
				</p>
				<div class="hidden bookingData">
				
            <p class="infoType text-secondary font-weight-bold"></p>
            <ul class="infoType-list">
              <li id="adult_prices"></li>
              <li id="kids_prices" style="display:none;"></li>
			  <li id="kids_prices_7" style="display:none;"></li>
			  <li id="kids_prices_5" style="display:none;"></li>
			  
            </ul>
			
			<div class="additionalCostDiv">
            <p class="infoCost">Additional Cost</p>
            <ul class="infoCost-list">
			<?php
			$additionalPrice = 0;
			$additional_editDataSet = json_decode(json_encode($itineraryData), true);
			if(isset($additional_editDataSet["additional_cost_description"]) && !empty($additional_editDataSet["additional_cost_description"])) {
			$costData = json_decode($additional_editDataSet["additional_cost_description"],true);
			$countCostData = count($costData);
			foreach($costData as $key => $value) {
				$additionalPrice = $additionalPrice+$value["additional_price"];
				?>
			<li><span class="item-name" id="item-name_<?php echo $key; ?>" data-price="<?php echo $value["additional_price"];?>"><?php echo $value["itinerary_additionalcost_description"];?></span><span  class="item-cost TotalTravellerPrice_<?php echo $key; ?>" id="TotalTravellerPrice"></span><small><?php echo '&#8377;'.' '.$value["additional_price"];?> <b id="muliti_no_of_travellers" class="muliti_no_of_travellers_<?php echo $key; ?>"></b></small>
			  <input type="hidden" name="additional_cost_desc" value="<?php echo $value["itinerary_additionalcost_description"];?>"/>
			  <input type="hidden" name="additional_cost_price"  id="additional_cost_price" value="<?php //echo $value["additional_price"];?>"/>
			  </li>
			<?php	  
			}
			}			
			/*if(!empty($itineraryData->additional_cost_description)){
				?>
              <li><span><?php echo $itineraryData->additional_cost_description;?></span><?php echo '&#8377;'.' '.$itineraryData->additional_price;?>
				  <input type="hidden" name="additional_cost_desc" value="<?php echo $itineraryData->additional_cost_description;?>"/>
				  <input type="hidden" name="additional_cost_price" value="<?php echo $itineraryData->additional_price;?>"/>
				  </li>
				<?php }*/ ?> 
		  <!--<input type="hidden" name="additional_total_price" id="additional_total_price" value="<?php //echo $additionalPrice;?>"/>-->		
           </ul>
		   </div>
		  <!--<p class="infoCost">Additional Total Cost</p>
            <ul class="infoCost-list">
			<li><span class="infoCost" id="no_of_travellersX"></span><span id="TotalTravellerPrice"></span>			  
		  </li>		  
		  <input type="hidden" name="additional_total_price" id="additional_total_price" value="<?php //echo $additionalPrice;?>"/>		
          </ul>-->
			
            <small class="infoTax-note">These prices have been multiplied by <span id="no_of_travellers"></span> on account of the number of travellers.</small>
            <p class="infoTax">Taxes</p>
            <ul class="infoTax-list">
            <?php if($itineraryData->origin_city =='New Delhi') { ?> <!-- For Delhi -->

              <li><span>SGST <b id="sgst_percent"></b> + CGST <b id="cgst_percent"></b></span> Rs. <b id="sgst_price">0</b><input type="hidden" name="sgst_price_value" id="sgst_price_value"/></li>

            <!--  <li><span>CGST <b id="cgst_percent"></b></span> Rs. <b id="cgst_price">0</b><input type="hidden" name="cgst_price_value" id="cgst_price_value"/></li>-->
            <?php }else { ?>

              <li><span>IGST <b id="igst_percent"></b></span> Rs. <b id="igst_price">0</b><input type="hidden" name="igst_price_value" id="igst_price_value"/></li>
          <?php } ?>
            
            </ul>
            <h3 class="infoTax-total">TOTAL &nbsp;&nbsp;&nbsp;&nbsp; Rs. <span id="total_price">0</span></h3>
			</div>
			<input type="hidden" id="total_net_price" name="total_net_price">
			<div id="total_price_error"></div>
            <div class="text-center infoTerms placeVaild mt-3">
              <div class="custom-control custom-checkbox custom-control-inline ">
                <input type="checkbox" name="term_condition" id="terms-agree" value="1" class="custom-control-input" required /> 
                <label class="custom-control-label text-left" for="terms-agree">I agree to the <a href="#" target="_blank"  data-toggle="modal" data-target="#tcModal">Terms & Conditions</a> and <a href="#" target="_blank" data-toggle="modal" data-target="#guModal">Guidelines</a></label>
              </div>
            </div>
            <div class="text-center mt-3 mb-2">
           <button class="btn btn-primary hidden" type="button" id="proceedBooking">Axis Payment</button>
             <button class="btn btn-primary tempClick" type="submit">Book</button>			
		  </div>
          </fieldset>
        </form>
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
<!-- PAYMENT MODAL -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Choose payment gateway</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center p-2">
          <div class="col-12 col-sm-6">
            <label class="m-0 paymentMark">
              <input type="radio" name="paymentGate" value="axisbank" />
              <img class="p-2" src="assets/img/payment/axisbank.jpg" alt="axisbank"/></label>
          </div>
          <div class="col-12 col-sm-6">
            <label class="m-0 paymentMark">
              <input type="radio" name="paymentGate" value="ccavenue" checked/>
              <img class="p-2" src="assets/img/payment/ccavenue.jpg" alt="ccavenue"/></label>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-dark" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary choose_paymentType">Proceed</button>
      </div>
    </div>
  </div>
</div>

<!-- SUBMIT FORM MODAL -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> <span class="modal-titleIcon"><img src="<?php echo base_url();?>assets/img/icon/walk_review.svg" alt="done" /></span>Under Review</h5>
        <h6 class="font-weight-bold text-center">BOOKING ID: 000565-4455</h6>
        <p class="font-weight-semibold text-center pl-2 pr-2">Your booking is under review. You will be notified via email once the host has accepted your booking and you can proceed to payment.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Confirm</button>
      </div>
    </div>
  </div>
</div>

<!-- GUDIELINES MODAL -->
<div class="modal fade" id="guModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Guidelines</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
	  <?php echo $termConditionData[0]->booking_guidline;?>
	  
        <!--<ul class="list-bullet">
          <li>Please do not carry valuables.</li>
          <li>Please wear a comfortable pair of walking shoes or flip-flops.</li>
          <li>Carry enough water. Keep yourself hydrated.</li>
          <li>Please wear conservative clothes. Revealing clothes may seem disrespectful and hurt people's sentiments.</li>
          <li>Do not forget to carry cash on Food Walks to pay for the Food.</li>
          <li>Carry a pair of sunglasses, a hat and sunscreen to protect yourself from the heat.</li>
          <li>Carry a scarf to cover up your head. (For Visit to Spiritual Places)</li>
          <li>Please wear weather appropriate clothing.</li>
          <li>Keeping in mind the weather, carry an umbrella/ Raincoat.</li>
          <li>Please do not carry bags or eatables inside the monument.</li>
          <li>Cost of Entry Tickets wherever applicable has to paid by the participants directly.</li>
        </ul>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- TERMS MODAL -->
<div class="modal fade" id="tcModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Terms and Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
	  <?php echo $termConditionData[0]->booking_terms_condition;?>
         </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- booking FORM MODAL -->
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> <span class="modal-titleIcon"><img src="<?php echo base_url();?>assets/img/icon/namaste.svg" alt="Success" /></span>Booking Success</h5>        
        <p class="font-weight-semibold text-center pl-2 pr-2">Your booking is under review. You will be notified via email once the host has accepted your booking and you can proceed to payment.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="backHome">OK</button>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php');?>
<?php include('foot.php');?>
<script type="text/javascript">	
(function($) {
var additional_TravellerPrice = '<?php echo $additionalPrice?>';
 //======= Remove All disabled date and past date also 10-05-2019========//
 $(window).load(function(){
	 $('input[type=radio]:disabled').closest("div").parent('li').parent('div').remove();
	 $('.chk_box').first().attr('checked',true);
	 $('.time_slots').first().attr('checked',true);
	 
	 //====== get checked value =======//
	 var dateSlot = $('.chk_box').first().val();
	 var timeSlot = $('.time_label').first().text();
	 $('#booking_date').text(dateSlot);
	 $('#booking_timeSlot').text(timeSlot);
	 
	 //========= number of traveller ========//
	 $('#no_of_travellers').text('number of travellers');
	 //$('#TotalTravellerPrice').text('<?php echo $additionalPrice?>');
	 //$('#additional_cost_price').val($('#TotalTravellerPrice').text());
	 //$('#muliti_no_of_travellers').text(1);	
	 
	 //========= onload show date slot selected ===========//
	 $(".chk_box:checked").each(function() {		
		var loadchkVal = $(this).val();		
		var itinerary_Id = '<?php echo $itineraryId?>';
	    var service_Id = '<?php echo $serviceId?>';
	    $('.time_slots').first().attr('checked',true);
	    var time_Slot = $('.time_label').first().text();	  
	    $('#booking_timeSlot').text(time_Slot);
		
	    showDateSlot(loadchkVal,itinerary_Id,service_Id);
	 
	});
	
	 
 });
 
 //====== code END ==========//
 
    // RADIO TRAVELLER TYPE
    $(document).on('change', 'input[name="traveller-type"]', function() {
		
		$(".bookingData").css("display","none");
		
        var $parent = $(this).parent().parent();
        var $uncle = $parent.siblings();
        var $othercount = $uncle.find('.countBox');
        var $count = $(this).parent().next('.countBox');		
        if ($(this).prop('checked') == true) {
            $count.show();
            $othercount.hide();
            $('.relateFamily').hide();
            if ($(this).val() == 'familyType') {
			    var countTraveller = $('#family_number').val();
			   $('#no_of_travellers').text('');
		       $('#no_of_travellers').text('number of travellers ('+countTraveller+')');
			   $('#TotalTravellerPrice').text('');
				
				
				if(additional_TravellerPrice==0)
				{
					$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(countTraveller));
					$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(countTraveller));
					$('#additional_cost_price').val($('#TotalTravellerPrice').text());
					
					$(".additionalCostDiv").css("display","none");
				}
				else
				{
					totalAdditionalCost = 0;
					$(".item-name").each(function(key)
					{
						$('.muliti_no_of_travellers_'+key).text("X "+countTraveller+" Traveller");
						$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(countTraveller));
						
						totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
					});
					
					$('#additional_cost_price').val(totalAdditionalCost);
					$(".additionalCostDiv").css("display","block");
				}
				
				
                $('.relateFamily').show();
                $('.relateFamily').find('.custom-control-input').prop('checked', false);
				$('#familyTraveller-adult').prop('checked', true);
				$('#familyTraveller-no').show();
                $('#traveller_type').html('Family');// added by robin on 3-1-19
				$('#apend_group ul').remove();
			    $('#apend_private ul').remove();
			    $('#private_number').val('<?php echo $itineraryData->private_min_no_travellers?>');
     			$('#group_number').val('<?php echo $itineraryData->group_min_no_travellers?>');
				$('#number_10').val($('#kids10Min').val());
				//======== code added on 10-06-19 ========//				
			   if(countTraveller>1){
			   for(var i=2;i<=countTraveller;i++){
			   var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Adult '+i+'</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="full_name[]" id="adult_'+i+'"/></li></ul>');
		       $("#apend_family").append(data);
			   }
			   }
			   //======== code ended on 10-06-19 ========//
				counter=2;
				kidesFlag= $('#kids10Min').val();
			}
		  //======= this code added by robin to show traveller-type =============//
		  if($(this).val() == 'privateType'){
		       var countTraveller = $('#private_number').val();
			   $('#no_of_travellers').text('');
		       $('#no_of_travellers').text('number of travellers ('+countTraveller+')');
			   $('#TotalTravellerPrice').text('');
			   
				
				if(additional_TravellerPrice==0)
				{
					$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(countTraveller));
					$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(countTraveller));
					$('#additional_cost_price').val($('#TotalTravellerPrice').text());
					
					$(".additionalCostDiv").css("display","none");
				}
				else
				{
					totalAdditionalCost = 0;
					$(".item-name").each(function(key)
					{
						$('.muliti_no_of_travellers_'+key).text("X "+countTraveller+" Traveller");
						$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(countTraveller));
						
						totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
					});
					
					$('#additional_cost_price').val(totalAdditionalCost);
					$(".additionalCostDiv").css("display","block");
				}
			   
			   
			   $('#traveller_type').html('Private');
			   $("#apend_kides ul").remove();
			   $('#kides_rows').hide();
			   $('#apend_family ul').remove();
			   $('#apend_group ul').remove();
			   $('#group_number').val('<?php echo $itineraryData->group_min_no_travellers?>');
			   $('#family_number').val('<?php echo $familyMinValue?>');
			   $('#number_10').val($('#kids10Min').val());
			   $('#apend_kides_7 ul').remove();
			   $('#apend_kides_5 ul').remove();
			   //======== code added on 10-06-19 ========//	
			   if(countTraveller>1){
			   for(var i=2;i<=countTraveller;i++){
			   var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Adult '+i+'</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="full_name[]" id="adult_'+i+'"/></li></ul>');
		       $("#apend_private").append(data);
			   }
			   }
			   //======== code ended on 10-06-19 ========//
			   counter=2;
			   kidesFlag=$('#kids10Min').val();
			  }
		if($(this).val() == 'groupType'){
		       var countTraveller = $('#group_number').val();
			   $('#no_of_travellers').text('');
		       $('#no_of_travellers').text('number of travellers ('+countTraveller+')');
			   $('#TotalTravellerPrice').text('');
			   
				
				if(additional_TravellerPrice==0)
				{
					$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(countTraveller));
					$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(countTraveller));
					$('#additional_cost_price').val($('#TotalTravellerPrice').text());
					
					$(".additionalCostDiv").css("display","none");
				}
				else
				{
					totalAdditionalCost = 0;
					$(".item-name").each(function(key)
					{
						$('.muliti_no_of_travellers_'+key).text("X "+countTraveller+" Traveller");
						$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(countTraveller));
						
						totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
					});
					
					$('#additional_cost_price').val(totalAdditionalCost);
					$(".additionalCostDiv").css("display","block");
				}
				
			   
			   $('#traveller_type').html('Group');
			   $("#apend_kides ul").remove();
			   $('#kides_rows').hide();
			   $('#apend_family ul').remove();
			   $('#apend_private ul').remove();
			   $('#private_number').val('<?php echo $itineraryData->private_min_no_travellers?>');
     		   $('#family_number').val('<?php echo $familyMinValue?>');
			   $('#number_10').val($('#kids10Min').val());
			   $('#apend_kides_7 ul').remove();
			   $('#apend_kides_5 ul').remove();
			   //======== code added on 10-06-19 ========//	
			   if(countTraveller>1){
			   for(var i=2;i<=countTraveller;i++){
			   var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Adult '+i+'</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="full_name[]" id="adult_'+i+'"/></li></ul>');
		       $("#apend_group").append(data);
			   }
			   }
			   //======== code ended on 10-06-19 ========//
			   gcounter='<?php echo $itineraryData->group_min_no_travellers?>';
			   kidesFlag=$('#kids10Min').val();
			  }	  
        }
    });

    $(document).on('change', '.familyCheckbox', function() {
	     		 
        var $count = $(this).parent().next('.countBox');
        if ($(this).prop('checked') == true) {
		  //====== add by robin on 14-06-19==//
		  var childVal = $(this).val();
		    if(childVal==10){
				$('#kids_age_10').val(10);
				}
			if(childVal==7){
				$('#kids_age_7').val(7);
				}
			if(childVal==5){
				$('#kids_age_5').val(5);
				}
			//====== end by robin on 14-06-19==//	
            $count.show();
        } else {
            $count.hide();
			//====== add by robin on 14-06-19==//
			$('#kids_age_5').val('');
			$('#kids_age_7').val('');
			$('#kids_age_10').val('');
			//====== end by robin on 14-06-19===//
        }
    });

	// PLUS & MINUS
    $(document).on('click', '.plus', function(e) {
        e.preventDefault();
			var maxCount = parseInt($(this).prev('input').attr('max'));
        if ($(this).prev().val() < maxCount) {
            $(this).prev().val(+$(this).prev().val() + 1);
        }
    });

    $(document).on('click', '.minus', function(e) {
        e.preventDefault();
 	var minCount =  parseInt($(this).next('input').attr('min'));

        if ($(this).next().val() > minCount) {
            if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
        }
    });

    $(document).on('keypress', '.calcBox', function(e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $(document).on('change', '.calcBox', function(e) {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max) {
            $(this).val(max);
        } else if ($(this).val() < min) {
            $(this).val(min);
        }
    });


    // DATE & TIME SILDER 	
    var dateOwl = $('.dateSlider');
    dateOwl.owlCarousel({
        margin: 10,
        nav: true,
        items: 6,
        dots: false,
        mouseDrag: false,
        responsive: {
            0: {
                items: 2,
            },
            480: {
                items: 3,
            },
            768: {
                items: 4,
            },
            1024: {
                items: 5,
            }
        }
    });

    var timeOwl = $('.timeSlider');
    timeOwl.owlCarousel({
        margin: 10,
        nav: true,
        items: 1,
        dots: false,
        mouseDrag: false,
        responsive: {
            0: {
                items: 1,
            },
            480: {
                items: 1,
            },
            768: {
                items: 1,
            },
            1024: {
                items: 1,
            }
        }
    });
    // STICK BOX
    $(".infoShow").stick_in_parent({
        offset_top: $('header').outerHeight()
    });

//============= private plus click js ============//
 counter='<?php echo $itineraryData->private_min_no_travellers?>';
 i = counter;
$('#private_plus').on('click',function(){	
	var privateCount = $('#private_number').val();
	var privateMaxCount = '<?php echo $itineraryData->private_max_no_travellers?>';
	$('#no_of_travellers').text('');
	$('#no_of_travellers').text('number of travellers ('+privateCount+')');	
	$('#TotalTravellerPrice').text('');
	
	
	if(additional_TravellerPrice==0)
	{
		$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(privateCount));
		$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(privateCount));
		$('#additional_cost_price').val($('#TotalTravellerPrice').text());
		
		$(".additionalCostDiv").css("display","none");
	}
	else
	{
		totalAdditionalCost = 0;
		$(".item-name").each(function(key)
		{
			$('.muliti_no_of_travellers_'+key).text("X "+privateCount+" Traveller");
			$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(privateCount));
			
			totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
		});
		
		$('#additional_cost_price').val(totalAdditionalCost);
		$(".additionalCostDiv").css("display","block");
	}
	
	
	//var countFlag = counter+1;		   
	var countFlag = counter;		   
	 if(i<privateMaxCount){ 
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Adult '+countFlag+'</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="full_name[]" id="adult_'+countFlag+'"/></li></ul>');
		 $("#apend_private").append(data);		
		 counter++;
	  i++;
	 }
		
});
//============= Private Minus click js ============//
$('#private_minus').on('click',function(e){	
	 e.preventDefault();
	 var privateCount = $('#private_number').val();
	 $('#no_of_travellers').text('');
	 $('#no_of_travellers').text('number of travellers ('+privateCount+')');
	 $('#TotalTravellerPrice').text('');
	 
	
	if(additional_TravellerPrice==0)
	{
		$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(privateCount));
		$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(privateCount));
		$('#additional_cost_price').val($('#TotalTravellerPrice').text());
		
		$(".additionalCostDiv").css("display","none");
	}
	else
	{
		totalAdditionalCost = 0;
		$(".item-name").each(function(key)
		{
			$('.muliti_no_of_travellers_'+key).text("X "+privateCount+" Traveller");
			$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(privateCount));
			
			totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
		});
		
		$('#additional_cost_price').val(totalAdditionalCost);
		$(".additionalCostDiv").css("display","block");
	}
	 
	 
	 if(counter!='<?php echo $itineraryData->private_min_no_travellers?>'){
		 $("#apend_private ul:last-child").remove();
		 counter--;
		 }	 
     if(i!=counter)
	 i--;
});

//============= Group plus click js ============//
 gcounter='<?php if(isset($itineraryData->group_min_no_travellers))echo $itineraryData->group_min_no_travellers; else{echo 1;}?>';
 groupMaxCount = '<?php if(isset($itineraryData->group_max_no_travellers))echo $itineraryData->group_max_no_travellers;else{echo 1;}?>';
 j=gcounter;
$('#group_plus').on('click',function(){		
	var groupCount = $('#group_number').val();	
	var groupMaxCountVal = parseInt(groupMaxCount);
	
	$('#no_of_travellers').text('');
	$('#no_of_travellers').text('number of travellers ('+groupCount+')');	
	$('#TotalTravellerPrice').text('');
	
	
	if(additional_TravellerPrice==0)
	{
		$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(groupCount));
		$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(groupCount));
		$('#additional_cost_price').val($('#TotalTravellerPrice').text());
		
		$(".additionalCostDiv").css("display","none");
	}
	else
	{
		totalAdditionalCost = 0;
		$(".item-name").each(function(key)
		{
			$('.muliti_no_of_travellers_'+key).text("X "+groupCount+" Traveller");
			$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(groupCount));
			
			totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
		});
		
		$('#additional_cost_price').val(totalAdditionalCost);
		$(".additionalCostDiv").css("display","block");
	}
	
	
	var gcountFlag = parseInt(gcounter)+parseInt(1);	
	if(j<groupMaxCountVal){	
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Adult '+gcountFlag+'</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="full_name[]" id="adult_'+gcountFlag+'"/></li></ul>');
		 $("#apend_group").append(data);
		 gcounter++;
		 j++;
	}
		
});
//============= Group Minus click js ============//
$('#group_minus').on('click',function(e){
	 e.preventDefault();
	 var groupCount = $('#group_number').val();
	$('#no_of_travellers').text('');
	$('#no_of_travellers').text('number of travellers ('+groupCount+')');	
	$('#TotalTravellerPrice').text('');
	
	
	if(additional_TravellerPrice==0)
	{
		$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(groupCount));
		$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(groupCount));
		$('#additional_cost_price').val($('#TotalTravellerPrice').text());
		
		$(".additionalCostDiv").css("display","none");
	}
	else
	{
		totalAdditionalCost = 0;
		$(".item-name").each(function(key)
		{
			$('.muliti_no_of_travellers_'+key).text("X "+groupCount+" Traveller");
			$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(groupCount));
			
			totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
		});
		
		$('#additional_cost_price').val(totalAdditionalCost);
		$(".additionalCostDiv").css("display","block");
	}
	
	
	if(gcounter!='<?php if(isset($itineraryData->group_min_no_travellers))echo $itineraryData->group_min_no_travellers;else{echo 1;}?>'){
		 $("#apend_group ul:last-child").remove();
		 gcounter--;	
		}	 
    if(j!=gcounter)
	 j--;	
});

//============= Family plus click js ============//
 counter='<?php if(isset($familyMinValue))echo $familyMinValue;else{echo 1;}?>';
 k=counter;
$('#family_plus').on('click',function(){	
	var familyCount = $('#family_number').val();	
	var familyMaxCount = '<?php if(isset($familyMaxValue)) echo $familyMaxValue;else{echo 1;}?>';	
	$('#no_of_travellers').text('');
	$('#no_of_travellers').text('number of travellers ('+familyCount+')');	
	$('#TotalTravellerPrice').text('');
	
	
	if(additional_TravellerPrice==0)
	{
		$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(familyCount));
		$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(familyCount));
		$('#additional_cost_price').val($('#TotalTravellerPrice').text());
		
		$(".additionalCostDiv").css("display","none");
	}
	else
	{
		totalAdditionalCost = 0;
		$(".item-name").each(function(key)
		{
			$('.muliti_no_of_travellers_'+key).text("X "+familyCount+" Traveller");
			$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(familyCount));
			
			totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
		});
		
		$('#additional_cost_price').val(totalAdditionalCost);
		$(".additionalCostDiv").css("display","block");
	}
	
	
	//var countFlag = counter+1;		 
	var countFlag = counter;		 
	if(k<familyMaxCount){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Adult '+countFlag+'</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="full_name[]" id="adult_'+countFlag+'"/></li></ul>');
		 $("#apend_family").append(data);
		 counter++;
		k++;
	}	
		
});
//============= Family Minus click js ============//
$('#family_minus').on('click',function(e){
	 e.preventDefault();
	 var familyCount = $('#family_number').val();
	$('#no_of_travellers').text('');
	$('#no_of_travellers').text('number of travellers ('+familyCount+')');	
	$('#TotalTravellerPrice').text('');
	
	
	if(additional_TravellerPrice==0)
	{
		$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(familyCount));
		$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(familyCount));
		$('#additional_cost_price').val($('#TotalTravellerPrice').text());
		
		$(".additionalCostDiv").css("display","none");
	}
	else
	{
		totalAdditionalCost = 0;
		$(".item-name").each(function(key)
		{
			$('.muliti_no_of_travellers_'+key).text("X "+familyCount+" Traveller");
			$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(familyCount));
			
			totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
		});
		
		$('#additional_cost_price').val(totalAdditionalCost);
		$(".additionalCostDiv").css("display","block");
	}
	
	
	if(counter!='<?php if(isset($familyMinValue)) echo $familyMinValue;else{echo 1;}?>'){
		$("#apend_family ul:last-child").remove();
		 counter--;
		 }			
    if(k!=counter)
	k--;	
});

//=========  family kides age 10 js START =================//
 kidesFlag = $('#kids10Min').val();
 l=kidesFlag;
 $('#kides10_plus').on('click',function(){
 var plusVal = $('input[name="family_kides"]:checked').val();
 var kid_10Count = $('#number_10').val(); 
 var kids10Maxval = $('#kids10Max').val();
 
 var kidsCounts = parseInt(kid_10Count)+1;
      /* if(plusVal==10){
		if(l<kids10Maxval){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+kidsCounts+' (Below '+plusVal+')</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_10[]" id="kides_'+kidsCounts+'"/></li></ul>');
		 $("#apend_kides").append(data);
		 kidesFlag++;
		 l++;
		}
	 } */	

	$("input:checkbox[name=family_kides]:checked").each(function(){
		if($(this).val()==10){
		if(l<kids10Maxval){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+kidsCounts+' (Below 10)</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_10[]" id="kides_'+kidsCounts+'"/></li></ul>');
		 $("#apend_kides").append(data);
		 kidesFlag++;
		 l++;
		}
	 }
	});
	 
});
		  
$('#kides10_minus').on('click',function(e){
	var minusVal = $('input[name="family_kides"]:checked').val();
	var kidsCount = $('#kids10Min').val();
	
    /* if(minusVal==10){	
		 e.preventDefault();		 
		 if(kidesFlag!=kidsCount){
		 $("#apend_kides ul:last-child").remove();	 
		 kidesFlag--;
		 }
	   if(l!=kidesFlag)
		l--;	
	} */
	
	$("input:checkbox[name=family_kides]:checked").each(function(){
		if($(this).val()==10){	
		 e.preventDefault();		 
		 if(kidesFlag!=kidsCount){
		 $("#apend_kides ul:last-child").remove();	 
		 kidesFlag--;
		 }
	   if(l!=kidesFlag)
		l--;	
	}
	});
});

 //=========  family kides age 7 js START =================//
 kidesFlag7 = $('#kids7Min').val();
 m=kidesFlag7;
$('#kides7_plus').on('click',function(){
 var plusVal = $('input[name="family_kides"]:checked').val();
 var kid_7Count = $('#number_7').val();
 var kids7Maxval = $('#kids7Max').val();
 
 var kidsCounts = parseInt(kid_7Count)+1;
     /* if(plusVal==7){
		if(m<kids7Maxval){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+kidsCounts+' (Below '+plusVal+')</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_7[]" id="kides_'+kidsCounts+'"/></li></ul>');
		 $("#apend_kides_7").append(data);
		 kidesFlag7++;
		 m++;
		}
	  } */	

	$("input:checkbox[name=family_kides]:checked").each(function(){
		if($(this).val()==7){
		if(m<kids7Maxval){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+kidsCounts+' (Below 7)</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_7[]" id="kides_'+kidsCounts+'"/></li></ul>');
		 $("#apend_kides_7").append(data);
		 kidesFlag7++;
		 m++;
		}
	  }
	});
 });
		  
$('#kides7_minus').on('click',function(e){
	var minusVal = $('input[name="family_kides"]:checked').val();
	var kidsCount = $('#kids7Min').val();
    /* if(minusVal==7){	
		 e.preventDefault();		 
		if(kidesFlag7!=kidsCount){
		  $("#apend_kides_7 ul:last-child").remove();
		  kidesFlag7--;
		 }
	    if(m!=kidesFlag7)
		m--;	
	} */
	
	$("input:checkbox[name=family_kides]:checked").each(function(){
		if($(this).val()==7){	
		 e.preventDefault();		 
		if(kidesFlag7!=kidsCount){
		  $("#apend_kides_7 ul:last-child").remove();
		  kidesFlag7--;
		 }
	    if(m!=kidesFlag7)
		m--;	
	}
	});
});

//=========  family kides age 5 js START =================//
kidesFlag5 = $('#kids5Min').val();
 n=kidesFlag5;
$('#kides5_plus').on('click',function(){
 var plusVal = $('input[name="family_kides"]:checked').val();
 var kid_5Count = $('#number_5').val(); 
 var kids5Maxval = $('#kids5Max').val();

 var kidsCounts = parseInt(kid_5Count)+1;
     /* if(plusVal==5){
	  if(n<kids5Maxval){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+kidsCounts+' (Below '+plusVal+')</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_5[]" id="kides_'+kidsCounts+'"/></li></ul>');
		 $("#apend_kides_5").append(data);
		 kidesFlag5++;
		 n++;
		}
	  } */

	$("input:checkbox[name=family_kides]:checked").each(function(){
		if($(this).val()==5){
	  if(n<kids5Maxval){
		 var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+kidsCounts+' (Below 5)</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_5[]" id="kides_'+kidsCounts+'"/></li></ul>');
		 $("#apend_kides_5").append(data);
		 kidesFlag5++;
		 n++;
		}
	  }
	});
	
 });
		  
$('#kides5_minus').on('click',function(e){
	var minusVal = $('input[name="family_kides"]:checked').val();
	var kidsCount = $('#kids5Min').val();
    /* if(minusVal==5){	
		 e.preventDefault();
		 if(kidesFlag5!=kidsCount){
		  $("#apend_kides_5 ul:last-child").remove();
		  kidesFlag5--;
		 }
	    if(n!=kidesFlag5)
		n--;	
	} */
	
	$("input:checkbox[name=family_kides]:checked").each(function(){
		if($(this).val()==5){	
		 e.preventDefault();
		 if(kidesFlag5!=kidsCount){
		  $("#apend_kides_5 ul:last-child").remove();
		  kidesFlag5--;
		 }
	    if(n!=kidesFlag5)
		n--;	
	}
	});
	
});


 $('input[name="family_kides"]').click(function(){
			 var Value = $(this).val();
			 var kid10 = $('#number_10').val();
			 var kid7 = $('#number_7').val();
			 var kid5 = $('#number_5').val();			 
			 //alert(kid10);
            if($(this).prop("checked") == true){
			
			  if(Value==10){
				  //$('#kides_below').html('Kid 1 (Below '+Value+')');
				  //$('#kides_rows').show();
				  for(var i=1;i<=kid10;i++){
				       var count = i;
					   var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+count+' (Below '+Value+')</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_10[]" id="kides_'+count+'"/></li></ul>');
		              $("#apend_kides").append(data);
					  }
                  				  
				  }
				  
			if(Value==7){				  
				  for(var i=1;i<=kid7;i++){				       
					   var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+i+' (Below '+Value+')</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_7[]" id="kides_'+i+'"/></li></ul>');
		              $("#apend_kides_7").append(data);
					  }
                  				  
				  }	
			if(Value==5){				 
				  for(var i=1;i<=kid5;i++){				       
					   var data = $('<ul class="form-row"><li class="form-group col-12 m-0"><label class="col-form-sublabel text-light">Kid '+i+' (Below '+Value+')</label></li><li class="form-group col-12 col-sm-6"><label class="col-form-sublabel">Full Name</label><input type="text" class="form-control" placeholder="Full Name" name="kids_full_name_5[]" id="kides_'+i+'"/></li></ul>');
		              $("#apend_kides_5").append(data);
					  }
                  				  
				  }	  	  
			    			
            }
        else if($(this).prop("checked") == false){
                //$('#kides_rows').hide();
				if(Value==10){
					 $("#apend_kides ul").remove();
					 $('#number_10').val($('#kids10Min').val());
				     kidesFlag = $('#kids10Min').val();
					}
				if(Value==7){
					 $("#apend_kides_7 ul").remove();
					}
			    if(Value==5){
					 $("#apend_kides_5 ul").remove();
					}		
								
            }
});
	
//============== calculate all booking data ==============//
$('#calculate').on('click',function(){
var chkbox = $('input[name="traveller-type"]').is(':checked');
if(chkbox==true){
	$(".bookingData").css("display","block");

	var valdata = $('input[name="traveller-type"]:checked').val();
	var kidsdata = $('input[name="family_kides"]:checked').val();
	var sgst = 5;
	var cgst = 5;
	var igst = 10;
	$('#sgst_percent').html('('+sgst+'%)');
	$('#cgst_percent').html('('+cgst+'%)');
	$('#igst_percent').html('('+igst+'%)');
	var mk_city = '<?= $itineraryData->origin_city;?>';
	
	//============ put the value into text field =============//
	
  if(valdata=='privateType'){
		 $('.infoType').html('Private');
		 $('#kids_prices').hide();
		 $('#kids_prices_7').hide();
		 $('#kids_prices_5').hide();
		 var privateVal = $('#private_number').val();
		 //====== add code on 10-06-19======//
		 $('#no_of_travellers').text('');
		$('#no_of_travellers').text('number of travellers ('+privateVal+')');	
		$('#TotalTravellerPrice').text('');
		
		
		if(additional_TravellerPrice==0)
		{
			$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(privateVal));
			$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(privateVal));
			$('#additional_cost_price').val($('#TotalTravellerPrice').text());
			
			$(".additionalCostDiv").css("display","none");
		}
		else
		{
			totalAdditionalCost = 0;
			$(".item-name").each(function(key)
			{
				$('.muliti_no_of_travellers_'+key).text("X "+privateVal+" Traveller");
				$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(privateVal));
				
				totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
			});
			
			$('#additional_cost_price').val(totalAdditionalCost);
			$(".additionalCostDiv").css("display","block");
		}
		
		
		 //======end code 10-06-19 =======//
		 var adultPrice = '<?php if(!empty($itineraryData->private_price))echo $itineraryData->private_price;else{echo 1;}?>' * parseInt(privateVal);
		 var aditionalCost = $('#additional_cost_price').val(); //'<?php echo $itineraryData->additional_price;?>';
		 //======= SGST Code ==========//
		 var SgstPercent = (parseInt(adultPrice))*parseInt(sgst)/100;
		 var CgstPercent = (parseInt(adultPrice))*parseInt(cgst)/100;
		 $('#sgst_price').html(SgstPercent + CgstPercent);
		 $('#sgst_price_value').val(SgstPercent + CgstPercent);
		 //======= CGST Code ==========//
		// $('#cgst_price').html(CgstPercent);
		// $('#cgst_price_value').val(CgstPercent);
		 //======= IGST Code ==========//
		 var IgstPercent = (parseInt(adultPrice))*parseInt(igst)/100;
		 $('#igst_price').html(IgstPercent);
		 $('#igst_price_value').val(IgstPercent);		 
		
		//alert(mk_city);
		if(mk_city=='New Delhi') {
			var gstPrice = parseFloat(SgstPercent)+parseFloat(CgstPercent);
		}else{
			var gstPrice = parseFloat(IgstPercent);
		}
		

		 var privateNetPrice = adultPrice+gstPrice+parseInt(aditionalCost);
		 $('#total_net_price').val(privateNetPrice);
		 if(privateVal<=1){
			 var data = '<span>Adult 1</span> Rs. '+adultPrice+'';
			 }
		 else{
			 var data = '<span>Adult '+privateVal+'</span> Rs. '+adultPrice+'';
			 }	 
		  $('#adult_prices').html(data);
		  $('#traveller_price').val(adultPrice);
		  $('#total_price').html(privateNetPrice);
		}
  if(valdata=='groupType'){
		 $('.infoType').html('Group');
		 $('#kids_prices').hide();
		 $('#kids_prices_7').hide();
		 $('#kids_prices_5').hide();
		 var groupVal = $('#group_number').val();
		 //====== add code on 10-06-19======//
		 $('#no_of_travellers').text('');
		 $('#no_of_travellers').text('number of travellers ('+groupVal+')');	
		 $('#TotalTravellerPrice').text('');
		 
		
		if(additional_TravellerPrice==0)
		{
			$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(groupVal));
			$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(groupVal));
			$('#additional_cost_price').val($('#TotalTravellerPrice').text());
			
			$(".additionalCostDiv").css("display","none");
		}
		else
		{
			totalAdditionalCost = 0;
			$(".item-name").each(function(key)
			{
				$('.muliti_no_of_travellers_'+key).text("X "+groupVal+" Traveller");
				$('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(groupVal));
				
				totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
			});
			
			$('#additional_cost_price').val(totalAdditionalCost);
			$(".additionalCostDiv").css("display","block");
		}
		 
		 
		 //======end code 10-06-19 =======//
		 var adultGroupPrice = '<?php if(!empty($itineraryData->group_price))echo $itineraryData->group_price;else{echo 1;}?>' * parseInt(groupVal);
		 var aditionalCost = $('#additional_cost_price').val(); //'<?php echo $itineraryData->additional_price;?>';
		//======= SGST Code ==========//
		 var SgstPercent = (parseInt(adultGroupPrice))*parseInt(sgst)/100;
		 var CgstPercent = (parseInt(adultGroupPrice))*parseInt(cgst)/100;

		 $('#sgst_price').html(SgstPercent + CgstPercent);
		 $('#sgst_price_value').val(SgstPercent + CgstPercent);
		 //======= CGST Code ==========//
		// $('#cgst_price').html(CgstPercent);
		// $('#cgst_price_value').val(CgstPercent);
		 //======= IGST Code ==========//
		 var IgstPercent = (parseInt(adultGroupPrice))*parseInt(igst)/100;
		 $('#igst_price').html(IgstPercent);
		 $('#igst_price_value').val(IgstPercent);
		 
		if(mk_city=='New Delhi') {
			var gstPrice = parseFloat(SgstPercent)+parseFloat(CgstPercent);
		}else{
			var gstPrice = parseFloat(IgstPercent);
		}
		
		 var groupNetPrice = adultGroupPrice+gstPrice+parseInt(aditionalCost);
		 $('#total_net_price').val(groupNetPrice);
		 if(groupVal<=1){
			 var data = '<span>Adult 1</span> Rs. '+adultGroupPrice+'';
			 }
		 else{
			 var data = '<span>Adult '+groupVal+'</span> Rs. '+adultGroupPrice+'';
			 }	 
		  $('#adult_prices').html(data);
		  $('#traveller_price').val(adultGroupPrice);
		  $('#total_price').html(groupNetPrice);
		}
  if(valdata=='familyType'){
		 $('.infoType').html('Family');
		 var familyVal = $('#family_number').val();
		 var number_10 = $('#number_10').val();	
		 var number_7 = $('#number_7').val();
		 var number_5 = $('#number_5').val();
		 var kids_10Check = $('#familyTraveller-kids-01').is(':checked');
		 var kids_7Check = $('#familyTraveller-kids-02').is(':checked');
		 var kids_5Check = $('#familyTraveller-kids-03').is(':checked');
		 
		 
		 var totalKids10 = 0;
		 var totalKids7 = 0;
		 var totalKids5 = 0;
		 if(kids_10Check==true)
		 {
			 var totalKids10 = $('#number_10').val();
		 }
		 if(kids_7Check==true)
		 {
			 var totalKids7 = $('#number_7').val();
		 }
		 if(kids_5Check==true)
		 {
			 var totalKids5 = $('#number_5').val();
		 }
		 var totalTravellers = parseInt(familyVal)+parseInt(totalKids10)+parseInt(totalKids7)+parseInt(totalKids5);
		 
		 
		 //====== add code on 10-06-19======//
		 $('#no_of_travellers').text('');
		 //$('#no_of_travellers').text('number of travellers ('+familyVal+')');	
		 $('#no_of_travellers').text('number of travellers ('+totalTravellers+')');	
		 $('#TotalTravellerPrice').text('');
		 
		 
		if(additional_TravellerPrice==0)
		{
			$('#TotalTravellerPrice').text(parseInt(additional_TravellerPrice)*parseInt(familyVal));
			$('#muliti_no_of_travellers').text(parseInt(additional_TravellerPrice)*parseInt(familyVal));
			$('#additional_cost_price').val($('#TotalTravellerPrice').text());
			
			$(".additionalCostDiv").css("display","none");
		}
		else
		{
			totalAdditionalCost = 0;
			$(".item-name").each(function(key)
			{
			 $('.muliti_no_of_travellers_'+key).text("X "+totalTravellers+" Traveller");
			 $('.TotalTravellerPrice_'+key).text(parseInt($("#item-name_"+key).attr("data-price"))*parseInt(totalTravellers));
			 
			 totalAdditionalCost = parseInt($('.TotalTravellerPrice_'+key).text()) + parseInt(totalAdditionalCost);
			});
			
			$('#additional_cost_price').val(totalAdditionalCost);
			$(".additionalCostDiv").css("display","block");
		}
		 
		 
		 //======end code 10-06-19 =======//		 
		 var adultFamilyPrice = '<?php if(!empty($familyPrice->adults_price))echo $familyPrice->adults_price;else{echo 1;}?>' * parseInt(familyVal);
		 //var familyKidsPrice = parseInt($('#kids_amt_10').val()) * parseInt(number_10);
		 //var familyKidsPrice_7 = parseInt($('#kids_amt_7').val()) * parseInt(number_7);
		 
		 if(kids_10Check==true){
			 var familyKidsPrice = parseInt($('#kids_amt_10').val()) * parseInt(number_10);		 
			 }else{
			  var familyKidsPrice =0;
			 }
			 
		 if(kids_7Check==true){
			 var familyKidsPrice_7 = parseInt($('#kids_amt_7').val()) * parseInt(number_7);		 
			 }else{
			  var familyKidsPrice_7 =0;
			 }
		 if(kids_5Check==true){
			 var familyKidsPrice_5 = parseInt($('#kids_amt_5').val()) * parseInt(number_5);		 
			 }else{
			  var familyKidsPrice_5 =0;
			 }
		 
		 var aditionalCost = $('#additional_cost_price').val(); 

		 //======= SGST Code ==========//		 
		 var SgstPercent = (parseInt(adultFamilyPrice))*parseInt(sgst)/100;
		 var CgstPercent = (parseInt(adultFamilyPrice))*parseInt(cgst)/100;
		 $('#sgst_price').html(SgstPercent + CgstPercent);
		 $('#sgst_price_value').val(SgstPercent + CgstPercent);		
		 //======= CGST Code ==========//
		 //$('#cgst_price').html(CgstPercent);
		 //$('#cgst_price_value').val(CgstPercent);
		 //======= IGST Code ==========//
		 var IgstPercent = (parseInt(adultFamilyPrice))*parseInt(igst)/100;
		 $('#igst_price').html(IgstPercent);
		 $('#igst_price_value').val(IgstPercent);
		 
		if(mk_city=='New Delhi') {
			var gstPrice = parseFloat(SgstPercent)+parseFloat(CgstPercent);
		}else{
			var gstPrice = parseFloat(IgstPercent);
		}
		
		 var familyNetPrice = adultFamilyPrice+gstPrice+parseInt(aditionalCost);
		 if(familyVal<=1){
			 var data = '<span>Adult 1</span> Rs. '+adultFamilyPrice+'';
			 }
		 else{
			 var data = '<span>Adult '+familyVal+'</span> Rs. '+adultFamilyPrice+'';
			 }	 
		  $('#adult_prices').html(data);
		  $('#traveller_price').val(adultFamilyPrice);
		  $('#total_price').html(familyNetPrice);
		  $('#total_net_price').val(familyNetPrice);

function calcTotal() {

    //======= SGST Code ==========//
    var SgstPercent = (parseInt(adultFamilyPrice) + parseInt(familyKidsPrice) + parseInt(familyKidsPrice_5) + parseInt(familyKidsPrice_7)) * parseInt(sgst) / 100;
   
    var CgstPercent = (parseInt(adultFamilyPrice) + parseInt(familyKidsPrice) + parseInt(familyKidsPrice_5) + parseInt(familyKidsPrice_7)) * parseInt(cgst) / 100;
    $('#sgst_price').html(SgstPercent + CgstPercent);
    $('#sgst_price_value').val(SgstPercent + CgstPercent);
    //======= CGST Code ==========//

    //$('#cgst_price').html(CgstPercent);
    //$('#cgst_price_value').val(CgstPercent);
    //======= IGST Code ==========//
    var IgstPercent = (parseInt(adultFamilyPrice) +  parseInt(familyKidsPrice) + parseInt(familyKidsPrice_5) + parseInt(familyKidsPrice_7)) * parseInt(igst) / 100;
    $('#igst_price').html(IgstPercent);
    $('#igst_price_value').val(IgstPercent);

    //var gstPrice = parseInt(SgstPercent) + parseInt(CgstPercent) + parseInt(IgstPercent);
 		if(mk_city=='New Delhi') {
			var gstPrice = parseFloat(SgstPercent)+parseFloat(CgstPercent);
		}else{
			var gstPrice = parseFloat(IgstPercent);
		}


    var familyNetPrice = adultFamilyPrice + gstPrice + parseInt(aditionalCost);
    var totalAmounts = parseFloat(familyNetPrice) + parseFloat(familyKidsPrice) + parseFloat(familyKidsPrice_5) + parseFloat(familyKidsPrice_7);
  

   $('#total_price').html(totalAmounts);
    $('#total_net_price').val(totalAmounts);
}


if (kids_5Check == true) {
    calcTotal();

    if (number_5 == 1) {
        var kidsText = '<span>Kid  1 <small>(Below 5) </small></span> Rs. ' + familyKidsPrice_5 + '';
    } else {
        var kidsText = '<span>Kid  ' + number_5 + ' <small>(Below 5) </small></span> Rs. ' + familyKidsPrice_5 + '';
    }

    $('#adult_prices').html(data);
    $('#kids_prices_5').html(kidsText);
    $('#kids_prices_5').show(); 
    $('#traveller_kids_5_price').val(familyKidsPrice_5);
	
} else {
    $('#kids_prices_5').hide();
    $('#traveller_kids_5_price').val('');
}



if (kids_7Check == true) {
     calcTotal();

    if (number_7 == 1) {
        var kidsText = '<span>Kid  1 <small>(Below 7) </small></span > Rs. ' + familyKidsPrice_7 + '';
    } else {
        var kidsText = '<span>Kid  ' + number_7 + ' <small>(Below 7) </small></span>Rs. ' + familyKidsPrice_7 + '';
    }

    $('#adult_prices').html(data);
    $('#kids_prices_7').html(kidsText);
    $('#kids_prices_7').show();
	$('#traveller_kids_7_price').val(familyKidsPrice_7);

} else {
    $('#kids_prices_7').hide(); 
	$('#traveller_kids_7_price').val('');
}



if (kids_10Check == true) {
    calcTotal();

    if (number_10 == 1) {
        var kidsText = '<span>Kid  1 <small>(Below 10) </small></span> Rs. ' + familyKidsPrice + '';
    } else {
        var kidsText = '<span>Kid  ' + number_10 + ' <small>(Below 10) </small></span > Rs. ' + familyKidsPrice + '';
    }

    $('#adult_prices').html(data);
    $('#kids_prices').html(kidsText);
    $('#kids_prices').show();
	$('#traveller_kids_10_price').val(familyKidsPrice);
	} else {
		$('#kids_prices').hide();
		$('#traveller_kids_10_price').val('');
	}
	
  
}
  		
} else {

	alert('One traveller type should be checked.');
	return false;

}

});

//========== Booking proceed js Start ================//

$("#bookingFormData").validate({
			errorElement: "small",
			errorPlacement: function(error, element) {
							error.appendTo(element.closest(".placeVaild"));
			},
			submitHandler: function() {
				$('#calculate').trigger('click');

					console.log($('#total_net_price').val());
					//$('.tempClick').html('Loading...');
					$('#paymentModal').modal('show');


					/*setTimeout(function(){				
			
						var formData = $('#bookingFormData').serialize();
						var availableDates = $('input[name="booking-date"]').is(':checked');
						var availableSlots = $('input[name="booking-time"]').is(':checked');
						var travellerType = $('input[name="traveller-type"]').is(':checked');
						var fullName = $('#adult_fullname').val();
						var email = $('#email').val();
						var phone_no = $('#phone_no').val();
						var total_net_price = $('#total_net_price').val();	
						//alert("1");
						

								$.ajax({
								type:'post',
								url:'<?php echo base_url();?>Booking/book_allItenerary',
								data:formData,
								success:function(response){
								console.log(response);			
								var msg = $.trim(response);	
								console.log(msg)	 ;
								if(msg === 'success'){		  
								//======= new code for manual booking Start on 27-06-19 ======//
								$('#bookModal').modal('show');
								//======= END New code on 27-06-19 ============//		   			
								//window.location.href = '<?php echo base_url();?>booking/axisbank_payment';
								}else {
										alert('Oops! Error.');
										}			   
							}
						});
					}, 10);*/
    }
 });

$(document).on('click','.choose_paymentType',function(){
	var selectPaymentMode = $('input:radio[name=paymentGate]:checked').val();
	if(selectPaymentMode == 'axisbank') {
		$('#proceedBooking').trigger('click');
	}else if(selectPaymentMode=='ccavenue'){
		ccavenuePaymment();
	}
	//alert(selectPaymentMode);
});

function ccavenuePaymment() {
	var formData = $('#bookingFormData').serialize();
	var availableDates = $('input[name="booking-date"]').is(':checked');
	var availableSlots = $('input[name="booking-time"]').is(':checked');
	var travellerType = $('input[name="traveller-type"]').is(':checked');
	var fullName = $('#adult_fullname').val();
	var email = $('#email').val();
	var phone_no = $('#phone_no').val();
	var total_net_price = $('#total_net_price').val();
	var proceed = true;
	if(proceed){
	 $.ajax({
		   type:'post',
		   url:'<?php echo base_url();?>Booking/book_itenerary',
		   //url:'<?php echo base_url();?>Booking/book_allItenerary',
		   data:formData,
		   success:function(response){
		   console.log(response);
		   var msg = $.trim(response);		   
				//	alert(msg)
		   if(msg === 'success'){		   
			    window.location.href = '<?php echo base_url();?>payment';
				//window.location.href = '<?php echo base_url();?>booking/axisbank_payment';
			   }else {
			   alert('Oops! Error.');
			   }			   
			 }
		 });
	 } 
}

$('#proceedBooking').on('click',function(){
	var formData = $('#bookingFormData').serialize();
	var availableDates = $('input[name="booking-date"]').is(':checked');
	var availableSlots = $('input[name="booking-time"]').is(':checked');
	var travellerType = $('input[name="traveller-type"]').is(':checked');
	var fullName = $('#adult_fullname').val();
	var email = $('#email').val();
	var phone_no = $('#phone_no').val();
	var total_net_price = $('#total_net_price').val();
	var proceed = true;
	/*var msg = '';
	if(availableDates!=true){
		 proceed = false;
		 msg = 'Please select any one available dates.';		
		}
   if(availableSlots!=true){
		 proceed = false;
		 msg = 'Please select any one available slots.';		
		}
  if(travellerType!=true){
		 proceed = false;
		 msg = 'Please select any one traveller type.';		
		}
 if(fullName=='' || fullName==null){
		 proceed = false;
		 msg = 'Please enter full name.';
		 $('.name_error').html(msg).css({'color':'red','font-size':'10pt'});
		}	
 if(email=='' || email==null){
		 proceed = false;
		 msg = 'Please enter email.';
		 $('.email_error').html(msg).css({'color':'red','font-size':'10pt'});
		}
 if(phone_no=='' || phone_no==null){
		 proceed = false;
		 msg = 'Please enter phone number.';
		 $('.phone_error').html(msg).css({'color':'red','font-size':'10pt'}); 
		}
 if(total_net_price=='' || total_net_price==null){
	 proceed = false;
	 msg = 'Total price can not be empty.';
	 $('#total_price_error').html(msg).css({'color':'red','font-size':'10pt'}); 
	 return false;
	 }*/		
 //$('#proceedBooking').html('Loading...');		
 if(proceed){
	 $.ajax({
		   type:'post',
		   url:'<?php echo base_url();?>Booking/book_allItenerary',
		   data:formData,
		   success:function(response){
		   console.log(response);
		   var msg = $.trim(response);		   
					//alert(msg)
		   if(msg === 'success'){		   
			   // window.location.href = '<?php echo base_url();?>payment';
				window.location.href = '<?php echo base_url();?>booking/axisbank_payment';
			   }else {
			   alert('Oops! Error.');
			   }			   
			 }
		 });
	 }  
	
});

//============= Leave Message Js Start on 08-02-19 =============//
$('#leaveMessage').validate({
				errorElement: 'small',
				submitHandler: function() {				
					var formData = $('#leaveMessage').serialize();
					var proceed = true;
					if(proceed){
						$.ajax({
							 type:'post',
							 url:'<?php echo base_url()?>home/leaveMessage',
							 data:formData,
							 success:function(html){
								  if(html=='success'){
									  $('.msgLink').trigger('click');
									  $("#leaveMessage")[0].reset();
									  }else{
										console.log('error message');
									  }												  
								 }
							});
						}
					
				}
	});
	
//============ Check current date ==========//
$('.chk_box').on('change',function(){
	var chkbox = $(this).val();
	var itineraryId = '<?php echo $itineraryId?>';
	var serviceId = '<?php echo $serviceId?>';
	$('#booking_date').text(chkbox);
	$('#itineraryDate').val(chkbox);
	showDateSlot(chkbox,itineraryId,serviceId);
});

function showDateSlot(chkbox,itineraryId,serviceId){
	 	$.ajax({
		   type:'post',
		   url:'<?php echo base_url()?>Booking/dateSlots',
		   data:{chkbox:chkbox,itineraryId:itineraryId,serviceId:serviceId},
		   success:function(data){
			   if($.trim(data)!==''){			     
					$('.timeSlider').owlCarousel('destroy');
				   //$('.appendSots').html("");
				   //$('.appendSots').html(data);
					 $('.timeSlider').owlCarousel();
					 $('.time_slots').first().attr('checked',true);
				   }else{
				    $('.timeSlider').owlCarousel('destroy');
				    //$('.appendSots').html("");				   
				   	$('.timeSlider').owlCarousel();
						
				   }
			   }
		});
}

//=========== Time Slots Js Start: ===========//
$(document).on('change','.time_slots',function(){
	var chkTimeSlot = $(this).val();
	if(chkTimeSlot){		 
		var timeval = $(this).parent().find('label').text();
		var hideTime = timeval.split('-');
		$('#booking_timeSlot').text(timeval);
		$('#timeFromHost').val(hideTime[0]);
		$('#timeToHost').val(hideTime[1]);
		}
	
});


//=========== booking popup ok button back home page js on 27-06-19 ==========//
$('#backHome').on('click',function(){
	window.location.href = '<?php echo base_url();?>home';
});




$(document).on('click', '.checkNow', function(e) {
	e.preventDefault();
	$('#leftMsg')[0].click();
});


})(jQuery);

// Function that validates email address through a regular expression.
function validateEmail(sEmail) {
var filter = /^[w-.+]+@[a-zA-Z0-9.-]+.[a-zA-z0-9]{2,4}$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}

</script>
</body>
</html>