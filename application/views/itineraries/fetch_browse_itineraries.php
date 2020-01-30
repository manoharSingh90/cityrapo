  <?php 
   //print_r($data);
	  foreach($data['iterator'] as $val):
	   $categoryName = getCategoryName($val->itinerary_category);		
	   $hostData = getHostData($val->user_id);
	   date_default_timezone_set('Asia/Kolkata');                
       $create_date = date('Y-m-d');
	  ?>      
         <li>
		  <?php 
	      if($val->feature_img!=''){
						  $img3 = 'assets/itinerary_files/gallery/'.$val->feature_img;
						  }
					else{
					   $img3 = 'assets/img/set/sample.jpg';
					 }		
	  ?>
	  <?php if($serviceId==1){
		  $sponsorImg = explode(',',$val->sponsors_img);
		  ?>
          <div class="itinerariesBox">		  
            <div class="itinerariesBox-img">
			<?php if(!empty(array_filter($sponsorImg))){?>
				<span class="sponsorMark">Sponsored </span>
			<?php } ?>
			<img src="<?php echo base_url();?><?php echo $img3;?>" alt="feature_75" />
			<?php if(!empty(array_filter($sponsorImg))):?>
			<div class="sponsoredImg">
			<?php foreach($sponsorImg as $key=>$sponsor_imgs):?>
			<img  src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs;?>" alt="sponsor_img" />
			<?php endforeach;?>
			</div>
	        <?php endif;?>	
			</div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $val->itinerary_title;?></h2>
              <ul class="itinerariesBox-other">
                <li>
                  <input type="textbox" class="ff-rating iwlRating" value="3" />
                </li>
              </ul>
			  <?php 
			   if($hostData['verified_by']=='Video'){
					  $verifyimg = 'video.svg';
					  }
				 if($hostData['verified_by']=='Call'){
					  $verifyimg = 'call_yellow.svg';
					  }
				if($val->feature_img==''){
				  $img = 'img/Itineraries/feature/feature_placeholder.jpg';
				}else{
				  $img = 'itinerary_files/gallery/'.$val->feature_img;
				 }
				  $themesArr = array();
				  $themesIds = explode(',',$val->itinerary_theme);
				 // echo '<pre>'; print_r($themesIds);
				  if(!empty($val->itinerary_theme)){
				  foreach($themesIds as $id){
					  $themes = getHostThemes($id);			  
					  array_push($themesArr,$themes['theme_name']);				 
					 }
				  }else{
				   $allThemes = '';
				  }		  
		       $allThemes = implode(', ',$themesArr);
			  
				?>  
              <p class="itinerariesBox-user pt-1 mb-2"> <span class="itinerariesBox-userimg"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $hostData['profile_picture'];?>" alt="Profile" /></span> <?php if(isset($hostData['display_name']))echo $hostData['display_name'];?> 
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
			<small class="itinerariesBox-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="Call_Verified" /> </b>Verified</small>	
				  
			  </p>
              <p class="itinerariesBox-state text-secondary font-weight-bold mb-1"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc" /> <?php echo $val->origin_city;?></p>
              <p class="itinerariesBox-area font-weight-bold small pl-1"><?php echo $val->location_covered;?></p>
              <p class="itinerariesBox-theme pl-0 font-weight-semibold mb-0">
			  <?php 
				  if(!empty($allThemes)){
				  ?>
				  <span class="d-inline-block text-dark">Themes:</span> <?php echo $allThemes;}?> </p>
              <p class="itinerariesBox-theme pl-0 font-weight-semibold mb-1"><span class="d-inline-block text-dark">Category:</span>
				  <?php echo $categoryName['category_name'];?> </p>
              <p class="itinerariesBox-text font-weight-semibold"><?php echo strlen($val->itinerary_description) > 90 ? substr($val->itinerary_description,0,90)."..." : $val->itinerary_description;?> <a href="#" class="text-primary">View More</a></p>
              <p class="itinerariesBox-tag">
				 <?php $view = '';
				       if($val->private_traveller==1){
						  $seprator = ' | ';
						  }
					 elseif($val->group_traveller==1){
						   $seprator = ' | ';
						  }					  
					 else{
						   $seprator = '';
						  }
						  
					  if($val->private_traveller==1){
						  $view .= 'Private'.$seprator;
						  }
					if($val->group_traveller==1){					      
						  $view .= 'Group'.$seprator;
						  }
					/*if(!empty($itineraryfamilydata) && $itineraryfamilydata[0]->family_traveller==1){
						$view .= '| Family';
						}*/
					if(!empty($val)){
					    $familyPrice = getFamilyData($val->id);
						if(@$familyPrice->family_traveller==1){
							$view .= 'Family';
							}						
						}	
						 echo rtrim($view,' | '); 
					  ?>
				  
				  </p>
              <ul class="itinerariesBox-other text-dark">
                <li>
				<?php
					if($val->private_traveller==1){
						  $privatePrice = $val->private_price;
						  }
					if($val->group_traveller==1){
						  $groupPrice = $val->group_price;
						  }
					if(!empty($val)){
					    $familyPrice = getFamilyData($val->id);
						//echo '<pre>';print_r($familyPrice);
						}
						
				    if($val->private_traveller==null){
						  $privatePrice = null;
						  }
					if($val->group_traveller==null){
						  $groupPrice = null;
						  }
					if(empty($familyPrice) || $familyPrice==''){
						  @$adultPrice = null;
						  }
					 else{
						  @$adultPrice = $familyPrice->adults_price;
						 }	 	  
						?>
				<?php 
					
					if(!empty($val)){
					 $kidsPrice_10 = '';
					 $kidsPrice_7 = '';
					 $kidsPrice_5 = '';
					 
				     $familyKidesdata = getFamilyMultiData($val->id);
					 //echo '<pre>';print_r($familyKidesdata);
					 foreach($familyKidesdata as $data):				
						if($data->family_kides_below_age==10){
							$kidsPrice_10 = $data->kides_price;
							}
						if($data->family_kides_below_age==7){
							$kidsPrice_7 = $data->kides_price;
							}
					   if($data->family_kides_below_age==5){
							$kidsPrice_5 = $data->kides_price;
							}
						endforeach;	
						 }
						 
					if($kidsPrice_10!='' && $kidsPrice_7!='' && $kidsPrice_5!=''){
							 $kidsMin = min($kidsPrice_10,$kidsPrice_7,$kidsPrice_5);
							 $kidsMax = max($kidsPrice_10,$kidsPrice_7,$kidsPrice_5);
							}
					   elseif($kidsPrice_10!='' && $kidsPrice_7!='' && $kidsPrice_5==''){
							 $kidsMin = min($kidsPrice_10,$kidsPrice_7);
							 $kidsMax = max($kidsPrice_10,$kidsPrice_7);
							}
					  elseif($kidsPrice_10!='' && $kidsPrice_7=='' && $kidsPrice_5!=''){
							 $kidsMin = min($kidsPrice_10,$kidsPrice_5);
							 $kidsMax = max($kidsPrice_10,$kidsPrice_5);
							}
					  elseif($kidsPrice_10=='' && $kidsPrice_7!='' && $kidsPrice_5!=''){
							 $kidsMin = min($kidsPrice_7,$kidsPrice_5);
							 $kidsMax = max($kidsPrice_7,$kidsPrice_5);
							}
					 elseif($kidsPrice_10!='' && $kidsPrice_7=='' && $kidsPrice_5==''){
							 $kidsMin = $kidsPrice_10;
							 $kidsMax = $kidsPrice_10;
							}
					elseif($kidsPrice_10=='' && $kidsPrice_7!='' && $kidsPrice_5==''){
							 $kidsMin = $kidsPrice_7;
							 $kidsMax = $kidsPrice_7;
							}
					elseif($kidsPrice_10=='' && $kidsPrice_7=='' && $kidsPrice_5!=''){
							 $kidsMin = $kidsPrice_5;
							 $kidsMax = $kidsPrice_5;
							}	
							
							
				  //echo 	$kidsPrice;	
				  /*if(@$kidsPrice!=null){
					  @$adultPrice = @$adultPrice+@$kidsPrice;
					  }*/
				?>				
						
				<?php			
				  if(@$privatePrice!==null && @$groupPrice!==null && @$adultPrice!==null){	
				    $minPrice = min(@$privatePrice,@$groupPrice,@$adultPrice,@$kidsMin);
					$maxPrice = max(@$privatePrice,@$groupPrice,@$adultPrice,@$kidsMax);
					if($minPrice!==null && $maxPrice!==''){
						echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
						}						
					}
				elseif(@$privatePrice==null && @$groupPrice==null && @$adultPrice==null)	{
					  echo '';
					 }		
				elseif(@$privatePrice!=null && @$groupPrice==null && @$adultPrice==null)	{
					  echo '&#8377; '.@$privatePrice;
					 }
				elseif(@$privatePrice==null && @$groupPrice!==null && @$adultPrice==null)	{
					  echo '&#8377; '.@$groupPrice;
					 }
				elseif(@$privatePrice==null && @$groupPrice==null && @$adultPrice!==null)	{
					  //echo '&#8377; '.@$adultPrice;
					$minPrice = min(@$adultPrice,@$kidsMin);
					$maxPrice = max(@$adultPrice,@$kidsMax);
					if($minPrice!==null && $maxPrice!==''){
						echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
						}
					 }
				elseif(@$privatePrice==@$groupPrice && @$groupPrice== @$adultPrice)	{
					  echo '&#8377; '.@$privatePrice;
					 }
				elseif(@$privatePrice!==null && @$groupPrice!==null && @$adultPrice==null){
				     $minPrice = min(@$privatePrice,@$groupPrice);
					 $maxPrice = max(@$privatePrice,@$groupPrice);
					 echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
					 }
			   /*elseif(@$privatePrice!==null && @$groupPrice==null && @$adultPrice==null){
				     $minPrice = min(@$privatePrice,@$familyPrice->adults_price);
					 $maxPrice = max(@$privatePrice,@$familyPrice->adults_price);
					 echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
					 }*/		 
			   elseif(@$privatePrice==null && @$groupPrice!==null && @$adultPrice!==null){
				     $minPrice = min(@$groupPrice,@$adultPrice,@$kidsMin);
					 $maxPrice = max(@$groupPrice,@$adultPrice,@$kidsMax);
					 echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
					 }
			   elseif(@$privatePrice!==null && @$groupPrice==null && @$adultPrice!==null){
				     $minPrice = min(@$privatePrice,@$adultPrice,@$kidsMin);
					 $maxPrice = max(@$privatePrice,@$adultPrice,@$kidsMax);
					 echo '&#8377; '.$minPrice.' - '.'&#8377; '.$maxPrice;
					 }				 
			   	 
					 ?>
					</li>
              </ul>
            </div>          
            <div class="itinerariesBox-links">
              <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang" >
                  <option value="<?php echo $val->itinerary_language;?>"><?php echo $val->itinerary_language;?></option> 
				  <?php 
					if($val->itinerary_language!=='English' && $val->itinerary_language!=='english'){
					  ?>
				     <option value="English">English</option>
					 <?php } ?>
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id)?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id;?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo $val->itinerary_title;?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city);?>"/>				
              </div>
              <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>
			  <?php 
				  if($val->end_date_to_host>=$create_date){
				?>
			  <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a> 
			  <?php } ?>
			  </div>			  
            </div>
          </div>
	  <?php }
	   if($serviceId==2){
		  $sponsorImg = explode(',',$val->sponsors_img);
		  if(!empty($hostData)){			   
			   if($hostData['verified_by']=='Video'){
					  $verifyimg = 'video.svg';
					  }
				 if($hostData['verified_by']=='Call'){
					  $verifyimg = 'call_yellow.svg';
					  }
			   } 
		   ?>
		    <div class="itinerariesBox">
            <div class="itinerariesBox-img"> <img src="<?php echo base_url();?><?php echo $img3;?>" alt="feature_77" />
			<?php if(!empty(array_filter($sponsorImg))){?>
				<span class="sponsorMark">Sponsored </span>
			<?php } ?>	
			<?php if(!empty(array_filter($sponsorImg))):?>
			<div class="sponsoredImg">
			<?php foreach($sponsorImg as $key=>$sponsor_imgs):?>
			<img  src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs;?>" alt="sponsor_img" />
			<?php endforeach;?>
			</div>
	        <?php endif;?>
				
			</div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $val->itinerary_title;?></h2>
              <div class="row">
                <div class="col-12 col-sm-6">
                  <p class="itinerariesBox-date"><img src="assets/img/icon/date.svg" alt="Date" />
					<?php echo date('d M Y',strtotime($val->start_date_from_host));?> - <?php echo date('d M Y',strtotime($val->end_date_to_host));?></p>
                  <p class="itinerariesBox-date"><img src="assets/img/icon/date.svg" alt="Date" />
					<?php echo date('h:i',strtotime($val->aviaiable_time_form_host));?> - <?php echo date('h:i',strtotime($val->aviaiable_time_to_host));?></p>
                  <p class="itinerariesBox-state"><img src="assets/img/icon/loc_fill_red.svg" alt="Loc" /> 					
					 <?php
					 $pickupPoints = getAll_pickupspoints($val->id);
	                 //echo '<pre>';print_r($pickupPoints);
					 foreach($pickupPoints as $key=>$pointsData){
						   echo $pointsData->pickup_point;
						 }						 
						 ?>					  
					  </p>
                </div>
                <div class="col-12 col-sm-6">
                  <p class="itinerariesBox-cmy flyCenter"> <span class="itinerariesBox-cmyimg"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $hostData['profile_picture'];?>" alt="cmy" /></span> <?php if(isset($hostData['display_name']))echo $hostData['display_name'];?> 
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
			 <small class="itinerariesBox-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="Call_Verified" /> </b>Verified</small> 
			 
			</p>
              </div>
              </div>
            </div>
         <div class="itinerariesBox-links">
             <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang" >
                  <option value="<?php echo $val->itinerary_language;?>"><?php echo $val->itinerary_language;?></option> 
				  <?php 
					  if($val->itinerary_language!=='English' && $val->itinerary_language!=='english'){
					  ?>
				     <option value="English">English</option>
					 <?php } ?> 
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id)?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id;?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo $val->itinerary_title;?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city);?>"/>
              </div>
             <!-- <div class="itinerariesInterested p-1 text-center">
                <p class="m-0 text-dark font-weight-bold">Interested? <a href="#"  data-toggle="modal" data-target="#rsvpModal" class="text-uppercase text-primary ml-1">Yes</a></p>
              </div>-->
             <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>
				<?php 
				  if($val->end_date_to_host>=$create_date){
				 ?>
				<a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
				  <?php } ?> 
				</div>
            </div>
            </div>
		  <?php }
		  if($serviceId==3){?>
			<div class="itinerariesBox expBox">
            <div class="itinerariesBox-img"><img src="<?php echo base_url();?><?php echo $img3;?>" alt="feature_78" /></div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $val->itinerary_title;?></h2>
              <p class="itinerariesBox-state mb-3"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
				   <?php
					 $pickupPoints = getAll_pickupspoints($val->id);	                
					 foreach($pickupPoints as $key=>$pointsData){
						   echo $pointsData->pickup_point;
						 }						 
						 ?>	
				  </p>
              <div class="itinerariesBox-links">
                <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang" >
                  <option value="<?php echo $val->itinerary_language;?>"><?php echo $val->itinerary_language;?></option> 
				  <?php 
					  if($val->itinerary_language!=='English' && $val->itinerary_language!=='english'){
					  ?>
				     <option value="English">English</option>
				 <?php } ?> 
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id)?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id;?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo $val->itinerary_title;?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city);?>"/>
              </div>
               <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>
				<?php 
				   if($val->end_date_to_host>=$create_date){
				 ?>
				 <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
				<?php } ?>   
				</div>
              </div>
            </div>
          </div>
		  <?php  }
		  if($serviceId==4){
			  $sponsorImg = explode(',',$val->sponsors_img);
			 ?>
			<div class="itinerariesBox">
            <div class="itinerariesBox-img">
			<?php if(!empty(array_filter($sponsorImg))){?>
				<span class="sponsorMark">Sponsored </span>
			<?php } ?>			
			<img src="<?php echo base_url();?><?php echo $img3;?>" alt="feature_76" />
			<?php if(!empty(array_filter($sponsorImg))):?>
			<div class="sponsoredImg">
			<?php foreach($sponsorImg as $key=>$sponsor_imgs):?>
			 <img  src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs;?>" alt="sponsor_img" />
			<?php endforeach;?>
			</div>
	        <?php endif;?>
			
			</div>
            <div class="itinerariesBox-info">
              <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $val->itinerary_title;?></h2>
              <h3 class="itinerariesBox-subtitle font-weight-bold"><?php echo $val->itinerary_tagline;?></h3>
              <p class="itinerariesBox-date"><img src="<?php echo base_url();?>assets/img/icon/date.svg" alt="Date" />
				<?php echo date('d M Y',strtotime($val->start_date_from_host));?> - <?php echo date('d M Y',strtotime($val->end_date_to_host));?></p>
              <p class="itinerariesBox-state"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
				  <?php
					 $pickupPoints = getAll_pickupspoints($val->id);	                
					 foreach($pickupPoints as $key=>$pointsData){
						   echo $pointsData->pickup_point;
						 }
				   if($hostData['verified_by']=='Video'){
					  $verifyimg = 'video.svg';
					  }
				  if($hostData['verified_by']=='Call'){
					  $verifyimg = 'call_yellow.svg';
					  }		 
				 ?>
			</p>
               <p class="itinerariesBox-user pt-1 mb-2"> <span class="itinerariesBox-userimg"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $hostData['profile_picture'];?>" alt="Profile" /></span> <?php if(isset($hostData['display_name']))echo $hostData['display_name'];?>
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
			   <small class="internal-verify"><b> <img src="<?php echo base_url();?>assets/img/icon/tourguide.svg" alt="tourguide"> </b></small>
			   <small class="itinerariesBox-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="Call_Verified" /> </b>Verified</small> </p>
            </div>
            <div class="itinerariesBox-links">
              <div class="itinerarieslanguage">
                <select class="form-control itinerary_selected_lang" >
                  <option value="<?php echo $val->itinerary_language;?>"><?php echo $val->itinerary_language;?></option> 
				  <?php 
					  if($val->itinerary_language!=='English' && $val->itinerary_language!=='english'){
					  ?>
				     <option value="English">English</option>
					 <?php } ?> 
                </select>				
				<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($val->id)?>"/>
				<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $val->service_id;?>"/>
				<input type='hidden' name="itinerary_title" class="itinerary_title" value="<?php echo $val->itinerary_title;?>"/>
				<input type='hidden' name="itinerary_city" class="itinerary_city" value="<?php echo preg_replace('/\s+/', '', $val->origin_city);?>"/>
              </div>
              
			  <!--<div class="itinerariesInterested p-1 text-center">
				  <p class="m-0 text-dark font-weight-bold">Interested? <a href="#"  data-toggle="modal" data-target="#rsvpModal" class="text-uppercase text-primary ml-1">Yes</a></p>
              </div>-->
			  
              <div class="itinerariesAnchor"> <a href="#" class="btn btn-link btn-sm text-secondary mr-1 pl-0 pr-0 guest_itinerary_viewdetail" >View Details</a>
				 <?php 
					 if($val->end_date_to_host>=$create_date){
				  ?>
				 <a href="#" class="btn btn-link btn-sm text-primary ml-1 pl-0 pr-0 book_guest_itinerary">Book</a>
				 <?php } ?>
				</div>
            </div>
          </div>
		  <?php } ?>
        </li>
		<?php endforeach;?>
		
<script>
	$(document).ready(function(){	 
	//=============== Change Itinerary language js start on 18-02-19 =================//
$('.itinerary_selected_lang').each(function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	 var itinerary_title = $(this).closest('.itinerariesBox-links').find('.itinerary_title').val();
	 var itinerary_city = $(this).closest('.itinerariesBox-links').find('.itinerary_city').val();
	 
	 /*var detailURL = '<?php echo base_url()?>home/detail_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
	 var detailURL = '<?php echo base_url()?>walk/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title+'/true';
	
	 $(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	
	 //==== book url ====//
	 var bookURL = '<?php echo base_url()?>book_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;	
	$(this).closest('.itinerariesBox-links').find('.book_guest_itinerary').attr('href', bookURL)
	

});

$('.itinerary_selected_lang').on('change',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();	
	 var itinerary_title = $(this).closest('.itinerariesBox-links').find('.itinerary_title').val();
	 var itinerary_city = $(this).closest('.itinerariesBox-links').find('.itinerary_city').val();
	 
	 /*var detailURL = '<?php echo base_url()?>home/detail_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
	 var detailURL = '<?php echo base_url()?>walk/'+itinerary_id+'/'+serviceid+'/'+itinerary_lang+'/'+itinerary_city+'/'+itinerary_title+'/true';
	
	$(this).closest('.itinerariesBox-links').find('.guest_itinerary_viewdetail').attr('href', detailURL)
	 //==== book url ====//
	 var bookURL = '<?php echo base_url()?>book_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;
	$(this).closest('.itinerariesBox-links').find('.book_guest_itinerary').attr('href', bookURL) 

});

/*$('.itinerary_selected_lang').on('change',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 $(this).closest('.itinerariesBox-links').find('.put_language').val(itinerary_lang);	
	});*/

	/*$('.guest_itinerary_viewdetail').on('click',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	 
	window.location.href = '<?php echo base_url()?>home/detail_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;
	});*/
	
	//======== Book Button Clik =======//
	/*$('.book_guest_itinerary').on('click',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	 
	/*window.location.href = '<?php echo base_url()?>home/detail_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;*/
	/*window.location.href = '<?php echo base_url()?>book_itineraries?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&user_type=Guest&lang='+itinerary_lang;
	});*/
	
	});
	</script>		
	
	
	