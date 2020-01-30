<?php
if (!empty($data['iterator']))
{
    foreach ($data['iterator'] as $val):
        $categoryName = getCategoryName($val->itinerary_category);
        $hostData = getHostData($val->user_id);

        date_default_timezone_set('Asia/Kolkata');
        $create_date = date('Y-m-d');
?>      
         <li>
		 <?php
        if ($val->feature_img != '')
        {
            $img3 = 'assets/itinerary_files/gallery/' . $val->feature_img;
        }
        else
        {
            $img3 = 'assets/img/set/sample.jpg';
        }
?>
		<?php if ($serviceId == 1)
        {
            $sponsorImg = explode(',', $val->sponsors_img);

?>
          <div class="itinerariesBox">		 
            <div class="itinerariesBox-img">
			<?php if (!empty(array_filter($sponsorImg)))
            { ?>
				<span class="sponsorMark">Sponsored </span>
			<?php
            } ?>
			<img src="<?php echo base_url(); ?><?php echo $img3; ?>" alt=" <?php echo $val->origin_city; ?>" />
			<?php if (!empty(array_filter($sponsorImg))): ?>
			<div class="sponsoredImg">
			<?php foreach ($sponsorImg as $key => $sponsor_imgs): ?>
			<img  src="<?php echo base_url(); ?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs; ?>" alt="spr_img" />
			<?php
                endforeach; ?>
			</div>
	        <?php
            endif; ?>	
			</div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $val->itinerary_title; ?></h2>
              <ul class="itinerariesBox-other">
                <li>
                  <input type="textbox" class="ff-rating iwlRating" value="3" />
                </li>
              </ul>
			  <?php
            if (!empty($hostData))
            {
                if ($hostData['verified_by'] == 'Video')
                {
                    $verifyimg = 'video.svg';
                }
                if ($hostData['verified_by'] == 'Call')
                {
                    $verifyimg = 'call_yellow.svg';
                }
            }

            if ($val->feature_img == '')
            {
                $img = 'img/Itineraries/feature/feature_placeholder.jpg';
            }
            else
            {
                $img = 'itinerary_files/gallery/' . $val->feature_img;
            }
            $themesArr = array();
            $themesIds = explode(',', $val->itinerary_theme);
            //echo '<pre>'; print_r($themesIds);
            if (!empty($val->itinerary_theme))
            {
                foreach ($themesIds as $id)
                {
                    $themes = getHostThemes($id);
                    array_push($themesArr, $themes['theme_name']);
                }
            }
            else
            {
                $allThemes = '';
            }
            $allThemes = implode(', ', $themesArr);
?> 
			<?php if (!empty($hostData))
            { ?>		
              <p class="itinerariesBox-user pt-1 mb-2"> <span class="itinerariesBox-userimg"><img src="<?php echo base_url(); ?>assets/upload/profile_pic/<?php echo $hostData['profile_picture']; ?>" alt="user" /></span> 
			  <?php if (isset($hostData['display_name'])) echo $hostData['display_name']; ?>
			  <?php $hostDatas = getHostDetail($hostData['host_verification_type']);
                if (!empty($hostDatas)) { $hostIcon = preg_replace('/\s/', '', strtolower($hostDatas['host_name'])); ?>
			  <small class="hostInfo-type"><b><img src="<?php echo base_url(); ?>assets/img/icon/badge/<?php echo $hostIcon . '_badge.svg' ?>" alt="<?php echo $hostIcon; ?>"></b><?php echo $hostDatas['host_name']; ?></small>
			  <?php } ?>
			  
			  <?php if(isset($hostData["guide_badges"]) && $hostData["guide_badges"]==1) { ?>
				<small class="hostInfo-crtguide"><b><img src="<?php echo base_url(); ?>assets/img/icon/tourguide.svg" alt="crtguide"> </b></small>
			  <?php } ?>
				
				<small class="hostInfo-verified"><b><img src="<?php echo base_url(); ?>assets/img/icon/<?php echo $verifyimg; ?>" alt="verified" /></b>Verified</small>
			</p>
			<?php } ?>
              <p class="itinerariesBox-state text-secondary font-weight-bold mb-1"><img src="<?php echo base_url(); ?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
				  <?php echo $val->origin_city; ?></p>
              <p class="itinerariesBox-area font-weight-bold small pl-1"><?php echo $val->location_covered; ?></p>
              <p class="itinerariesBox-theme pl-0 font-weight-semibold mb-0">
			  <?php
            if (!empty($allThemes))
            {
?>
				  <span class="d-inline-block text-dark">Themes:</span> <?php echo $allThemes;
            } ?> </p>
              <p class="itinerariesBox-theme pl-0 font-weight-semibold mb-1"><span class="d-inline-block text-dark">Category:</span>
				  <?php echo $categoryName['category_name']; ?> </p>
              <p class="itinerariesBox-text"><?php echo strlen($val->itinerary_description) > 90 ? substr($val->itinerary_description, 0, 90) . "..." : $val->itinerary_description; ?> <a href="javascript:void(0);"  data-toggle="modal" data-target="#guestReadMoreModal" class="text-primary small">View More</a></p>
              <p class="itinerariesBox-tag">
				 <?php
            $view = '';
            //$seprator = '';
            if ($val->private_traveller == 1)
            {
                $seprator = ' | ';
            }
            elseif ($val->group_traveller == 1)
            {
                $seprator = ' | ';
            }
            else
            {
                $seprator = '';
            }

            if ($val->private_traveller == 1)
            {
                $view .= 'Private' . $seprator;
            }
            if ($val->group_traveller == 1)
            {
                $view .= 'Group' . $seprator;
            }
            /*if(!empty($itineraryfamilydata) && $itineraryfamilydata[0]->family_traveller==1){
            $view .= '| Family';
            }*/
            if (!empty($val))
            {
                $familyPrice = getFamilyData($val->id);
                if (@$familyPrice->family_traveller == 1)
                {
                    $view .= 'Family';
                }
            }
            echo rtrim($view, ' | ');
?>
				  
				  </p>
              <ul class="itinerariesBox-other text-dark">
                <li>
				<?php
            if ($val->private_traveller == 1)
            {
                $privatePrice = $val->private_price;
            }
            if ($val->group_traveller == 1)
            {
                $groupPrice = $val->group_price;
            }
            if (!empty($val))
            {
                $familyPrice = getFamilyData($val->id);
                //echo '<pre>';print_r($familyPrice);
                
            }

            if ($val->private_traveller == null)
            {
                $privatePrice = null;
            }
            if ($val->group_traveller == null)
            {
                $groupPrice = null;
            }
            if (empty($familyPrice) || $familyPrice == '')
            {
                @$adultPrice = null;
            }
            else
            {
                @$adultPrice = $familyPrice->adults_price;
            }
?>
				   <?php

            if (!empty($val))
            {
                $kidsPrice_10 = '';
                $kidsPrice_7 = '';
                $kidsPrice_5 = '';

                $familyKidesdata = getFamilyMultiData($val->id);
                //echo '<pre>';print_r($familyKidesdata);
                foreach ($familyKidesdata as $data):
                    if ($data->family_kides_below_age == 10)
                    {
                        $kidsPrice_10 = $data->kides_price;
                    }
                    if ($data->family_kides_below_age == 7)
                    {
                        $kidsPrice_7 = $data->kides_price;
                    }
                    if ($data->family_kides_below_age == 5)
                    {
                        $kidsPrice_5 = $data->kides_price;
                    }
                endforeach;
            }

            //echo $kidsPrice_5;
            /*if(@$kidsPrice!=null){
            //@$adultPrice = @$adultPrice+@$kidsPrice;
            }*/

?>		
				<?php

            if (@$privatePrice !== null && @$groupPrice !== null && @$adultPrice !== null)
            {
				if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{					
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				}
				else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7))
				{					
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7);
				}
				else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_5))
				{
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_5);
				}
				else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{					
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_7, @$kidsPrice_5);
				}
				else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{					
                    $minPrice = min(@$privatePrice, @$groupPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				}
				else if(!empty(@$privatePrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{					
                    $minPrice = min(@$privatePrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				}
				else if(!empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{					
                    $minPrice = min(@$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				}
                else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_10))
                {                   
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_10);
                }
                else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_7))
                {                   
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_7);
                }
                else if(!empty(@$privatePrice) && !empty(@$groupPrice) && !empty(@$adultPrice) && !empty(@$kidsPrice_5))
                {                   
                    $minPrice = min(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_5);
                }

                $maxPrice = max(@$privatePrice, @$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);

                if ($minPrice !== null && $maxPrice !== '')
                {
					if($minPrice==$maxPrice)
					{
						echo '&#8377; ' . $minPrice;
					}
					else
					{
						echo '&#8377; ' . $minPrice . ' - ' . '&#8377; ' . $maxPrice;
					}
                }
            }
            elseif (@$privatePrice == null && @$groupPrice == null && @$adultPrice == null)
            {
                echo '';
            }
            elseif (@$privatePrice != null && @$groupPrice == null && @$adultPrice == null)
            {
                echo '&#8377; ' . @$privatePrice;
            }
            elseif (@$privatePrice == null && @$groupPrice !== null && @$adultPrice == null)
            {
                echo '&#8377; ' . @$groupPrice;
            }
            elseif (@$privatePrice == null && @$groupPrice == null && @$adultPrice !== null)
            {
                if(!empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{
					$minPrice = min(@$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				}
				else if(!empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_7))
				{
					$minPrice = min(@$adultPrice, @$kidsPrice_10, @$kidsPrice_7);
				}
				else if(!empty(@$adultPrice) && !empty(@$kidsPrice_10) && !empty(@$kidsPrice_5))
				{
					$minPrice = min(@$adultPrice, @$kidsPrice_10, @$kidsPrice_5);
				}
				else if(!empty(@$adultPrice) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{
					$minPrice = min(@$adultPrice, @$kidsPrice_7, @$kidsPrice_5);
				}
				else if(!empty(@$kidsPrice_10) && !empty(@$kidsPrice_7) && !empty(@$kidsPrice_5))
				{
					$minPrice = min(@$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				}
				
                $maxPrice = max(@$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
                if ($minPrice !== null && $maxPrice !== '')
                {
					if($minPrice==$maxPrice)
					{
						echo '&#8377; ' . $minPrice;
					}
					else
					{
						echo '&#8377; ' . $minPrice . ' - ' . '&#8377; ' . $maxPrice;
					}
				}
            }
            elseif (@$privatePrice == @$groupPrice && @$groupPrice == @$adultPrice)
            {
                echo '&#8377; ' . @$privatePrice;
            }
            elseif (@$privatePrice !== null && @$groupPrice !== null && @$adultPrice == null)
            {
                $minPrice = min(@$privatePrice, @$groupPrice);
                $maxPrice = max(@$privatePrice, @$groupPrice);
				
				if($minPrice==$maxPrice)
				{
					echo '&#8377; ' . $minPrice;
				}
				else
				{
					echo '&#8377; ' . $minPrice . ' - ' . '&#8377; ' . $maxPrice;
				}
            }
            /*elseif(@$privatePrice!==null && @$groupPrice==null && @$adultPrice==null){
            $minPrice = min(@$privatePrice,@$familyPrice->adults_price);
            $maxPrice = max(@$privatePrice,@$familyPrice->adults_price);
            echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
            }*/
            elseif (@$privatePrice == null && @$groupPrice !== null && @$adultPrice !== null)
            {
                $minPrice = min(@$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
                $maxPrice = max(@$groupPrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				
				if($minPrice==$maxPrice)
				{
					echo '&#8377; ' . $minPrice;
				}
				else
				{
					echo '&#8377; ' . $minPrice . ' - ' . '&#8377; ' . $maxPrice;
				}
			}
            elseif (@$privatePrice !== null && @$groupPrice == null && @$adultPrice !== null)
            {
                $minPrice = min(@$privatePrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
                $maxPrice = max(@$privatePrice, @$adultPrice, @$kidsPrice_10, @$kidsPrice_7, @$kidsPrice_5);
				
				if($minPrice==$maxPrice)
				{
					echo '&#8377; ' . $minPrice;
				}
				else
				{
					echo '&#8377; ' . $minPrice . ' - ' . '&#8377; ' . $maxPrice;
				}
			}

?>
					</li>
              </ul>
            </div>          
            <div class="itinerariesBox-links">
              <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang text-capitalize">
                  <option value="<?php echo $val->itinerary_language; ?>"><?php echo $val->itinerary_language; ?></option>
				  <?php
            if ($val->itinerary_language !== 'English')
            {
?>
				     <option value="English">English</option>
					 <?php
            } ?>
                </select>
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id) ?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id; ?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo preg_replace('/\s+/', '', str_replace("'", '', $val->itinerary_title)); ?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city); ?>"/>
              </div>
              <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail">View Details</a>
			  <?php
            if ($val->end_date_to_host >= $create_date)
            {
?>
			  <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
			  <?php
            } ?>	  
			 </div>
            </div>
          </div>
		  <?php
        }
        if ($serviceId == 2)
        {
            $sponsorImg = explode(',', $val->sponsors_img);
            if (!empty($hostData))
            {
                if ($hostData['verified_by'] == 'Video')
                {
                    $verifyimg = 'video.svg';
                }
                if ($hostData['verified_by'] == 'Call')
                {
                    $verifyimg = 'call_yellow.svg';
                }
            }
?>
		    <div class="itinerariesBox">
            <div class="itinerariesBox-img"> 
			<?php if (!empty(array_filter($sponsorImg)))
            { ?>
				<span class="sponsorMark">Sponsored </span>
			<?php
            } ?>
			<img src="<?php echo base_url(); ?><?php echo $img3; ?>" alt="feature" />
			<?php if (!empty(array_filter($sponsorImg))): ?>
			<div class="sponsoredImg">
			<?php foreach ($sponsorImg as $key => $sponsor_imgs): ?>
			<img  src="<?php echo base_url(); ?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs; ?>" alt="sponsor_img" />
			<?php
                endforeach; ?>
			</div>
	        <?php
            endif; ?>
			</div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase mb-2"><?php echo $val->itinerary_title; ?></h2>
              <div class="row">
                <div class="col-12 col-sm-5">
                  <p class="itinerariesBox-date"><img src="<?php echo base_url(); ?>assets/img/icon/date.svg" alt="Date" />
					<?php echo date('d M Y', strtotime($val->start_date_from_host)); ?> - <?php echo date('d M Y', strtotime($val->end_date_to_host)); ?></p>
				   <?php
            if (!empty($val))
            {
                $allpickups = getAll_pickupspoints($val->id);
            }
            foreach ($allpickups as $key => $pointsData):
                //======= indian time to US time zone ========//
                date_default_timezone_set("Asia/Kolkata");
                $STime = strtotime($pointsData->start_pickup_time);
                $ETime = strtotime($pointsData->end_dropoff_time);
                date_default_timezone_set("UTC");
                $Sgmtime = date('H:i A', $STime);
                $Egmtime = date('H:i A', $ETime);
?>	 	
                 <p class="itinerariesBox-date"><img src="<?php echo base_url(); ?>assets/img/icon/date.svg" alt="Date" />
				<?php echo $pointsData->start_pickup_time . ' (' . $Sgmtime . ' UTC)'; ?>&nbsp; - &nbsp;<?php echo $pointsData->end_dropoff_time . ' (' . $Egmtime . ' UTC)'; ?></p>
				<?php
            endforeach; ?>
					
 
                </div>
                <div class="col-12 col-sm-7">
                  <p class="itinerariesBox-cmy flyCenter"> <span class="itinerariesBox-cmyimg"><img src="<?php echo base_url(); ?>assets/upload/profile_pic/<?php echo $hostData['profile_picture']; ?>" alt="cmy" /></span> <?php if (isset($hostData['display_name'])) echo $hostData['display_name']; ?>
				
				<?php
            $hostDatas = getHostDetail($hostData['host_verification_type']);
            if (!empty($hostDatas))
            {
                $hostIcon = preg_replace('/\s/', '', strtolower($hostDatas['host_name']));
?>
			    <small class="hostInfo-type"><b><img src="<?php echo base_url(); ?>assets/img/icon/badge/<?php echo $hostIcon . '_badge.svg' ?>" alt="<?php echo $hostIcon; ?>"></b>
			   <?php
                echo $hostDatas['host_name'];
?></small>
			   <?php
            } ?>
			
			<?php if(isset($hostData["guide_badges"]) && $hostData["guide_badges"]==1) { ?>
				<small class="hostInfo-crtguide"><b> <img src="<?php echo base_url(); ?>assets/img/icon/tourguide.svg" alt="crtguide"> </b></small>
			<?php } ?>	
				
				<small class="hostInfo-verified mt-1"><b> <img src="<?php echo base_url(); ?>assets/img/icon/<?php echo $verifyimg; ?>" alt="verified" /> </b>Verified</small>
				 </p>
                </div>
                <div class="col-12">
                <p class="itinerariesBox-state"><img src="<?php echo base_url(); ?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
					 <?php
            $pickupPoints = getAll_pickupspoints($val->id);
            //echo '<pre>';print_r($pickupPoints);
            foreach ($pickupPoints as $key => $pointsData)
            {
                echo $pointsData->pickup_point . ', ' . $val->origin_city;
            }
?>	
					  </p>
            </div>

              </div>
            </div>
         <div class="itinerariesBox-links">
             <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang text-capitalize">
                  <option value="<?php echo $val->itinerary_language; ?>"><?php echo $val->itinerary_language; ?></option> 
				  <?php
            if ($val->itinerary_language !== 'English')
            {
?>
				     <option value="English">English</option>
					 <?php
            } ?> 
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id) ?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id; ?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo preg_replace('/\s+/', '', str_replace("'", '', $val->itinerary_title)); ?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city); ?>"/>
              </div>
              <div class="itinerariesInterested p-1 text-center">
                <p class="m-0 text-dark font-weight-bold">Interested? <a href="#"  data-toggle="modal" data-target="#rsvpModal" data-id="<?php echo $val->id; ?>" class="text-uppercase text-primary ml-1 rsvpModalData">Yes</a></p>
              </div>
             <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>
			 <?php
            if ($val->end_date_to_host >= $create_date)
            {
?>
			  <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
			  <?php
            } ?>
			 </div>
            <input type="hidden"  class="service_ids" value="<?php echo $val->service_id; ?>"/>
			</div>	     
          </div>
		  <?php
        }
        if ($serviceId == 3)
        { ?>
			<div class="itinerariesBox expBox">
            <div class="itinerariesBox-img"><img src="<?php echo base_url(); ?><?php echo $img3; ?>" alt="feature_78" /></div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase mb-2"><?php echo $val->itinerary_title; ?></h2>
              <p class="itinerariesBox-state mb-3"><img src="<?php echo base_url(); ?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
				   <?php
            $pickupPoints = getAll_pickupspoints($val->id);
            foreach ($pickupPoints as $key => $pointsData)
            {
                echo $pointsData->pickup_point . ', ' . $val->origin_city;
            }
?>	
				  </p>
              <div class="itinerariesBox-links">
                <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang text-capitalize" >
                  <option value="<?php echo $val->itinerary_language; ?>"><?php echo $val->itinerary_language; ?></option> 
				  <?php
            if ($val->itinerary_language !== 'English')
            {
?>
				     <option value="English">English</option>
					 <?php
            } ?> 
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id) ?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id; ?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo preg_replace('/\s+/', '', str_replace("'", '', $val->itinerary_title)); ?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city); ?>"/>
              </div>
               <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>				  
				<?php
            if ($val->end_date_to_host >= $create_date)
            {
?>
			    <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
			   <?php
            } ?>
			   </div>
              </div>
            </div>
          </div>
		  <?php
        }
        if ($serviceId == 4)
        {
            $sponsorImg = explode(',', $val->sponsors_img);
?>
			<div class="itinerariesBox">
            <div class="itinerariesBox-img">
			<?php if (!empty(array_filter($sponsorImg)))
            { ?>
				<span class="sponsorMark">Sponsored </span>
			<?php
            } ?>
			<img src="<?php echo base_url(); ?><?php echo $img3; ?>" alt="Feature" />
			<?php if (!empty(array_filter($sponsorImg))): ?>
			<div class="sponsoredImg">
			<?php foreach ($sponsorImg as $key => $sponsor_imgs): ?>
			 <img  src="<?php echo base_url(); ?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs; ?>" alt="sponsor_img" />
			<?php
                endforeach; ?>
			</div>
	        <?php
            endif; ?>
				</div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $val->itinerary_title; ?></h2>
              <h3 class="itinerariesBox-subtitle font-weight-bold"><?php echo $val->itinerary_tagline; ?></h3>
              <p class="itinerariesBox-date"><img src="<?php echo base_url(); ?>assets/img/icon/date.svg" alt="Date" />
				<?php echo date('d M Y', strtotime($val->start_date_from_host)); ?> - <?php echo date('d M Y', strtotime($val->end_date_to_host)); ?></p>
              <p class="itinerariesBox-state"><img src="<?php echo base_url(); ?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
				  <?php
            $pickupPoints = getAll_pickupspoints($val->id);
            foreach ($pickupPoints as $key => $pointsData)
            {
                echo $pointsData->pickup_point . ', ' . $val->origin_city;
            }
            if ($hostData['verified_by'] == 'Video')
            {
                $verifyimg = 'video.svg';
            }
            if ($hostData['verified_by'] == 'Call')
            {
                $verifyimg = 'call_yellow.svg';
            }
?>
			 </p>
             <p class="itinerariesBox-user pt-1 mb-2"> <span class="itinerariesBox-userimg"><img src="<?php echo base_url(); ?>assets/upload/profile_pic/<?php echo $hostData['profile_picture']; ?>" alt="Profile" /></span> <?php if (isset($hostData['display_name'])) echo $hostData['display_name']; ?>
			 
			 <?php
            $hostDatas = getHostDetail($hostData['host_verification_type']);
            if (!empty($hostDatas))
            {
                $hostIcon = preg_replace('/\s/', '', strtolower($hostDatas['host_name']));
?>
			  <small class="hostInfo-type"><b><img src="<?php echo base_url(); ?>assets/img/icon/badge/<?php echo $hostIcon . '_badge.svg' ?>" alt="<?php echo $hostIcon; ?>"></b>
			 <?php
                echo $hostDatas['host_name'];
?></small>
			  <?php
            } ?>
				
			<?php if(isset($hostData["guide_badges"]) && $hostData["guide_badges"]==1) { ?>
				<small class="hostInfo-crtguide"><b> <img src="<?php echo base_url(); ?>assets/img/icon/tourguide.svg" alt="crtguide"> </b></small>
			<?php } ?>
				
				<small class="hostInfo-verified"><b> <img src="<?php echo base_url(); ?>assets/img/icon/<?php echo $verifyimg; ?>" alt="verified" /> </b>Verified</small>
			</p>
            </div>
            <div class="itinerariesBox-links">
              <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang text-capitalize" >
                  <option value="<?php echo $val->itinerary_language; ?>"><?php echo $val->itinerary_language; ?></option> 
				  <?php
            if ($val->itinerary_language !== 'English')
            {
?>
				     <option value="English">English</option>
					 <?php
            } ?> 
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id) ?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id; ?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo preg_replace('/\s+/', '', str_replace("'", '', $val->itinerary_title)); ?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city); ?>"/>
              </div>
              <div class="itinerariesInterested p-1 text-center">
                <p class="m-0 text-dark font-weight-bold">Interested? <a href="#"  data-toggle="modal" data-target="#rsvpModal" data-id="<?php echo $val->id; ?>" class="text-uppercase text-primary ml-1 rsvpModalData">Yes</a></p>
              </div>
              <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>
				<?php
            if ($val->end_date_to_host >= $create_date)
            {
?>
			      <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
			     <?php
            } ?>
				  </div>
            </div>
          </div>
		  <?php
        }
?>
        </li>
	<?php
    endforeach;
} ?>

	<!-- RSVP FORM MODAL -->
<div class="modal fade" id="rsvpModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
   <form class="pt-3 rsvpForm-Modal" id="rsvpFormData">
   <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3">RSVP</h5>
        <p class="font-weight-semibold text-center pl-2 pr-2">Please give us your details so we can add you to our waitlist.<br>
          If you wish to recieve immediate confirmation,<br>
          please make a booking.</p>
         <ul class="form-row justify-content-center">
            <li class="form-group col-8">
              <label class="col-form-sublabel">Full Name</label>
              <input type="text" class="form-control" placeholder="Full Name" name="full_name" id="full_name" required />
            </li>
            <li class="form-group col-8">
              <label class="col-form-sublabel">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Email" id="email" required/>
            </li>
            <li class="form-group col-8">
            <label class="col-form-sublabel">Phone</label>
            <input type="number" class="form-control" name="phone_no" placeholder="Phone" id="phone_no" required/>
            </li>
          </ul>	
		  <input type="hidden" name="itinerary_id" class="itinerary_ids"/>
		  <input type="hidden" name="service_id" class="service_ids"/>
		  <input type="hidden" name="service_url" class="service_url"/>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary saveRsvp_val">Done</button>
      </div>
	  </form>

    </div>
  </div>
</div>

<!-- Guest Read More MODAL -->
<div class="modal fade" id="guestReadMoreModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Itinerary Description </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
        <ul class="list-bullet">
		<?php echo $val->itinerary_description; ?>          
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

		
<script>
	$(document).ready(function(){
		/*$('.itinerary_selected_lang').on('change',function(){
		 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
		 $(this).closest('.itinerariesBox-links').find('.put_language').val(itinerary_lang);	
	});*/

	$('.itinerary_selected_lang').each(function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	 var itinerary_title = $(this).closest('.itinerariesBox-links').find('.itinerary_title').val();
	 var itinerary_city = $(this).closest('.itinerariesBox-links').find('.itinerary_city').val();
	 if(serviceid==1){
		 var serviceName = 'Walk';
		 var detailURL = '<?php echo base_url() ?>walk/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
	    $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	   $(this).closest('.itinerariesBox-links').find('.rsvpModalData').attr('data-url', detailURL)
		 }
	else if(serviceid==2){
		 var serviceName = 'Session';
		 var detailURL = '<?php echo base_url() ?>session/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		 $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	     $(this).closest('.itinerariesBox-links').find('.rsvpModalData').attr('data-url', detailURL)
		
		 }
	else if(serviceid==3){
		 var serviceName = 'Experience';
		 var detailURL = '<?php echo base_url() ?>experience/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		 $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	     $(this).closest('.itinerariesBox-links').find('.rsvpModalData').attr('data-url', detailURL)
		
		 }
	else if(serviceid==4){
		 var serviceName = 'Meetup';
		 var detailURL = '<?php echo base_url() ?>meetup/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		$(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	    $(this).closest('.itinerariesBox-links').find('.rsvpModalData').attr('data-url', detailURL)
		 }	
	
	/*var detailURL = '<?php echo base_url() ?>home/detail_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
	
	var bookURL = '<?php echo base_url() ?>book_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;		
	$(this).closest('.itinerariesBox-links').find('.book_guest_itinerary').attr('href', bookURL)

});

	 $('.guest_itinerary_viewdetail').on('click',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	if(serviceid==1){
	 var serviceName = 'Walk';
	/* var detailURL = '<?php echo base_url() ?>home/detail_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
	var detailURL = '<?php echo base_url() ?>walk/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		
		
	 $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
		}
    if(serviceid==2){
		/*var detailURL = '<?php echo base_url() ?>home/detail_itineraries_sessions?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;	*/
		var detailURL = '<?php echo base_url() ?>session/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		
		 $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
		 $(this).closest('.itinerariesBox-links').find('.rsvpModalData').attr('data-url', detailURL)
		}
	if(serviceid==3){
		/*var detailURL = '<?php echo base_url() ?>home/detail_itineraries_experiences?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
		var detailURL = '<?php echo base_url() ?>experience/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		
		 $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
		}
	if(serviceid==4){
		/*var detailURL = '<?php echo base_url() ?>home/detail_itineraries_meetup?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
		var detailURL = '<?php echo base_url() ?>meetup/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		
		$(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
		$(this).closest('.itinerariesBox-links').find('.rsvpModalData').attr('data-url', detailURL)
		}	
	
	});

$('.itinerary_selected_lang').on('change',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 //$(this).closest('.itinerariesBox-links').find('.put_language').val(itinerary_lang);	
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	 var itinerary_title = $(this).closest('.itinerariesBox-links').find('.itinerary_title').val();
	 var itinerary_city = $(this).closest('.itinerariesBox-links').find('.itinerary_city').val();
	if(serviceid==1){
		 var serviceName = 'Walk';
		 var detailURL = '<?php echo base_url() ?>walk/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		
		 }
	if(serviceid==2){		
		var detailURL = '<?php echo base_url() ?>session/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
			
		}
   if(serviceid==3){		
		var detailURL = '<?php echo base_url() ?>experience/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
	 }
   if(serviceid==4){		
		var detailURL = '<?php echo base_url() ?>meetup/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title;
		}		
	var bookURL = '<?php echo base_url() ?>book_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;
		
	$(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	$(this).closest('.itinerariesBox-links').find('.book_guest_itinerary').attr('href', bookURL)
});

	//======== Book Button Clik =======//
	$('.book_guest_itinerary').on('click',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	 
	var bookURL = '<?php echo base_url() ?>book_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;
	$(this).closest('.itinerariesBox-links').find('.book_guest_itinerary').attr('href', bookURL)
	});
	

	$(".rsvpForm-Modal").validate({
			errorElement: 'small',
			//errorPlacement: function(error, element) {
			//	error.appendTo(element.closest(".placeVaild"));
			//		},
			submitHandler: function() {
				$('#rsvpModal').modal('hide');
				$('.rsvpForm-Modal')[0].reset();
				}
});
				

	
//============ rsvp modal js start ===============//
var itinerary_id ='';
$('.rsvpModalData').on('click',function(){
	var itinerary_id = $(this).data('id');
    var itinerary_url = $(this).data('url');
    var service_id = $(this).closest('.itinerariesBox-links').find('.serviceid').val(); 

	$('#rsvpFormData').attr('id','rsvp_formData_'+itinerary_id);	
	$('.service_ids').val(service_id);
	$('.itinerary_ids').val(itinerary_id);
	
	var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	var itineraryId = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val(); 
	
    if(serviceid==2){	   
	 var detailURL = '<?php echo base_url() ?>home/detail_itineraries_sessions?itinerary_id='+itineraryId+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;	 
	 $('.service_url').val(detailURL);
		}
        
   if(serviceid==4){	   
	  var detailURL = '<?php echo base_url() ?>home/detail_itineraries_meetup?itinerary_id='+itineraryId+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;
	 $('.service_url').val(detailURL);
	}		
	//$('.service_url').val(itinerary_url);	
	});

//============ rsvp form value save js start =============//
$('.saveRsvp_val').on('click',function(){
	var formId = $(this).closest('.modal-content').find("form").attr('id');	
	var formData = $('#'+formId).serialize();
	var full_name = $('#full_name').val();
	var email = $('#email').val();
	var phone_no = $('#phone_no').val();
	var proceed = true;	
	if(full_name==''){
		var proceed = false;		
		}
	if(email==''){
		var proceed = false;		
		}
	if(phone_no==''){
		var proceed = false;		
		}	
	
	//$('.saveRsvp_val').html('Loading...');
	if(proceed){
		$.ajax({
			 type:'post',
			 url:'<?php echo base_url(); ?>home/interested',
			 data:formData,
			 success:function(html){
				 console.log(html);				
				 //$('.saveRsvp_val').html('Done');
				 if($.trim(html)==='success'){
				  // location.reload();
				   }
			   else{
				   alert('error');
				   }
				 }
			});
		}
});
	
});
</script>