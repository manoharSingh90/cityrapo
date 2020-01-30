 <?php
	  if(!empty($hostItinerary['iterator'])){	   
		 foreach($hostItinerary['iterator'] as $k=>$data):
		   $lang= $data->itinerary_language;
		   $itineraryID =  $data->id;
             if($data->status==0 && $data->admin_status==0){
                 $status = 'Draft';
                 $class = 'draftStatus';
                 $action = 'Edit';
             }
             if($data->status==1 && $data->admin_status==1){
                 $status = 'Pending';
                 $class = 'pendingStatus';
                 $action = 'View';
             }
             if($data->status==1 && $data->admin_status==2){
                 $status = 'Rejected';
                 $class = 'rejectedStatus';
                 $action = 'Edit';
             }
             if($data->status==1 && $data->admin_status==3){
                 $status = 'Pending';
                 $class = 'doneStatus';
                 $action = 'View';
             }
             if($data->status==1 && $data->admin_status==5){
                 $status = 'Published';
                 $class = 'doneStatus';
                 $action = 'View detail';
             }
             if($data->feature_img==''){
                 $img = 'img/Itineraries/feature/feature_placeholder.jpg';
             }else{
                 $img = 'itinerary_files/gallery/'.$data->feature_img;
             }
             $categoryName = getCategoryName($data->itinerary_category);
             $hostData = getHostData($data->user_id);
             if($hostData['verified_by']=='Video'){
                 $verifyimg = 'video.svg';
             }
             if($hostData['verified_by']=='Call'){
                 $verifyimg = 'call_yellow.svg';
             }
             ?>
             <?php if($serviceId==1){
				 $sponsorImg = explode(',',$data->sponsors_img);
				 ?>
             <li>
                 <div class="itinerariesBox">
                     <div class="itinerariesBox-img">
					 <?php if(!empty(array_filter($sponsorImg))){?>
						 <span class="sponsorMark">Sponsored </span>
					<?php } ?>
					 <img src="<?php echo base_url();?>assets/<?php echo $img;?>" alt="image" />
					<?php if(!empty($sponsorImg)):?>
					 <div class="sponsoredImg">
						<?php foreach($sponsorImg as $key=>$sponsor_imgs):?>
						<img  src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs;?>" alt="sponsor_img" />
						<?php endforeach;?>
						</div>
					 <?php endif;?>	 
					 </div>
                     <div class="itinerariesBox-info">
                         <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $data->itinerary_title;?></h2>
                         <ul class="itinerariesBox-other">
                             <li>
                                 <input type="textbox" class="ff-rating iwlRating" value="3" />
                             </li>
                         </ul>
                         <p class="itinerariesBox-user pt-1 mb-2"> <span class="itinerariesBox-userimg"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $hostData['profile_picture'];?>" alt="Profile" /></span> <?php if(isset($hostData['display_name']))echo $hostData['display_name'];?> <small class="itinerariesBox-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="<?php echo $hostData['verified_by'];?>" /> </b>Verified</small> </p>
                         <p class="itinerariesBox-theme pl-0 font-weight-semibold mb-0">
                             <?php
                             if(!empty($allThemes)){
                                 ?>
                                 <span class="d-inline-block text-dark">Themes:</span> <?php echo $allThemes;}?></p>
                         <p class="itinerariesBox-theme pl-0 font-weight-semibold mb-1">
                             <span class="d-inline-block text-dark">Category:</span> <?php echo $categoryName['category_name'];?></p>
                         <p class="itinerariesBox-text font-weight-semibold"><?php echo strlen($data->itinerary_description) > 90 ? substr($data->itinerary_description,0,90)."..." : $data->itinerary_description;?>
                             <!--<a href="#" class="text-primary">View More</a></p>-->
                         <p class="itinerariesBox-tag">
                             <?php 
							 $view = '';
							 if($data->private_traveller==1){
								  $seprator = ' | ';
								  }
							 elseif($data->group_traveller==1){
								   $seprator = ' | ';
								  }					  
							 else{
								   $seprator = '';
								  }
								  
                             if($data->private_traveller==1){
                                 $view .= 'Private'.$seprator;
                             }
                             if($data->group_traveller==1){
                                 $view .= 'Group'.$seprator;
                             }
                             /*if(!empty($itineraryfamilydata) && $itineraryfamilydata[0]->family_traveller==1){
                                 $view .= '| Family';
                                 }*/
                             if(!empty($data)){
                                 $familyPrice = getFamilyData($data->id);
                                 if(@$familyPrice->family_traveller==1){
                                     $view .= 'Family';
                                 }
                             }
                             echo rtrim($view,' | ');
                             ?>
                         </p>
                         <ul class="itinerariesBox-other text-dark">
                             <li><?php
                                 if($data->private_traveller==1){
                                     $privatePrice = $data->private_price;
                                 }
                                 if($data->group_traveller==1){
                                     $groupPrice = $data->group_price;
                                 }
                                 if(!empty($data)){
                                     $familyPrice = getFamilyData($data->id);
                                 }

                                 if($data->private_traveller==null){
                                     $privatePrice = null;
                                 }
                                 if($data->group_traveller==null){
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
					
							 if(!empty($data)){
								 $kidsPrice_10 = '';
								 $kidsPrice_7 = '';
								 $kidsPrice_5 = '';
								 
								 $familyKidesdata = getFamilyMultiData($data->id);
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
                     <p class="itinerariesBox-status <?php echo $class;?>"><?php echo $status;?></p>
                     <div class="itinerariesBox-links">
                         <div class="itinerarieslanguage">						 
                         <select class="form-control itinerary_selected_lang">				
						  <option value="<?php echo $lang;?>"><?php echo $lang;?></option> 
						   <?php 
							if($lang!=='English' && $lang!=='english'){
							  ?>
							<option value="English">English</option>
							<?php } ?>
						</select>
						<input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryID)?>"/>
						<input type='hidden' name="serviceid" class="serviceid" value="<?php echo $data->service_id;?>"/>
                         </div>
                         <div class="itinerariesAnchor">
                           <a href="#" class="btn btn-secondary mr-1 ml-1 pr-3 pl-3 admin_itinerary_view" target="_blank">View</a>
                         </div>
                     </div>
                 </div>
             </li>
		  <?php }
             if($serviceId==2){
                 $sponsorImg = explode(',',$data->sponsors_img);
                 /*if($sponsorImg[0]==''){
                     $sponsor_img = base_url().'assets/img/Itineraries/sponsored/sponsor_01.jpg';
                 }
                 else{
                     $sponsor_img = base_url().'assets/itinerary_files/sponsor_file/'.$sponsorImg[0];
                 }*/
                 ?>
                 <li>
                     <div class="itinerariesBox">
                      <div class="itinerariesBox-img">
					  <?php if(!empty(array_filter($sponsorImg))){?>
						 <span class="sponsorMark">Sponsored</span>
					<?php } ?>
					  <img src="<?php echo base_url();?>assets/<?php echo $img;?>" alt="feature_77" />
					 <?php if(!empty($sponsorImg)):?>
					 <div class="sponsoredImg">
						<?php foreach($sponsorImg as $key=>$sponsor_imgs):?>
						<img  src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs;?>" alt="sponsor_img" />
						<?php endforeach;?>
						</div>
					 <?php endif;?>	
						<!--<img class="sponsoredImg" src="<?php //echo $sponsor_img;?>" alt="sponsor_img" />-->
							 
						 </div>
                         <div class="itinerariesBox-info">
                             <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $data->itinerary_title;?></h2>
                             <div class="row">
                                 <div class="col-12 col-sm-6">
                                     <p class="itinerariesBox-date"><img src="<?php echo base_url();?>assets/img/icon/date.svg" alt="Date" />
                                         <?php echo date('d M Y',strtotime($data->start_date_from_host));?> - <?php echo date('d M Y',strtotime($data->end_date_to_host));?>
                                     </p>
                                     <p class="itinerariesBox-date"><img src="<?php echo base_url();?>assets/img/icon/date.svg" alt="Date" />
                                    <?php if(!empty($data->aviaiable_time_form_host))echo $data->aviaiable_time_form_host;?> - <?php if(!empty($data->aviaiable_time_to_host))echo $data->aviaiable_time_to_host;?></p>
                                     <p class="itinerariesBox-state"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
                                         <?php
                                         $pickupPoints = getAll_pickupspoints($data->id);
                                         foreach($pickupPoints as $key=>$pointsData){
                                             echo $pointsData->pickup_point;
                                         }
                                         ?>

                                     </p>
                                 </div>
                                 <div class="col-12 col-sm-6">
                                     <p class="itinerariesBox-cmy flyCenter"> <span class="itinerariesBox-cmyimg"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $hostData['profile_picture'];?>" alt="cmy" /></span><?php if(isset($hostData['display_name']))echo $hostData['display_name'];?></p>
                                 </div>
                             </div>
                             <p class="itinerariesBox-status <?php echo $class;?>"><?php echo $status;?></p>
                         </div>
                         <div class="itinerariesBox-links">
                             <div class="itinerarieslanguage">
                             <select class="form-control itinerary_selected_lang">				
						     <option value="<?php echo $lang;?>"><?php echo $lang;?></option> 
						    <?php 
							if($lang!=='English' && $lang!=='english'){
							  ?>
							<option value="English">English</option>
							<?php } ?>
						   </select>
						  <input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryID)?>"/>
						  <input type='hidden' name="serviceid" class="serviceid" value="<?php echo $data->service_id;?>"/>
                          </div>
                         <div class="itinerariesAnchor"> <a href="#" class="btn btn-secondary mr-1 ml-1 pr-3 pl-3 admin_itinerary_view" target="_blank">View</a> </div>
                                                        
                         </div>
                     </div>
                 </li>
             <?php }
             if($serviceId==3){?>
                 <li>
                     <div class="itinerariesBox expBox">
                         <div class="itinerariesBox-img"><img src="<?php echo base_url();?>assets/<?php echo $img;?>" alt="feature_78" /></div>
                         <div class="itinerariesBox-info">
                             <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $data->itinerary_title;?></h2>
                             <p class="itinerariesBox-state mb-3"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
                                 <?php
                                 $pickupPoints = getAll_pickupspoints($data->id);
                                 foreach($pickupPoints as $key=>$pointsData){
                                     echo $pointsData->pickup_point;
                                 }
                                 ?>
                             </p>
                             <p class="itinerariesBox-status <?php echo $class;?>"><?php echo $status;?></p>
                             <div class="itinerariesBox-links">
							 <div class="itinerarieslanguage">
							  <select class="form-control itinerary_selected_lang">				
								 <option value="<?php echo $lang;?>"><?php echo $lang;?></option> 
								<?php 
								if($lang!=='English' && $lang!=='english'){
								  ?>
								<option value="English">English</option>
								<?php } ?>
							   </select>
							  <input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryID)?>"/>
							  <input type='hidden' name="serviceid" class="serviceid" value="<?php echo $data->service_id;?>"/>
							  </div>
                              <div class="itinerariesAnchor"> <a href="#" class="btn btn-secondary mr-1 ml-1 pr-3 pl-3 admin_itinerary_view" target="_blank">View</a> </div>
                                     
                                
                             </div>
                         </div>
                     </div>
                 </li>
             <?php }
             if($serviceId==4){
                 $sponsorImg = explode(',',$data->sponsors_img);
                 /*if($sponsorImg[0]==''){
                     $sponsor_img = base_url().'assets/img/Itineraries/sponsored/sponsor_01.jpg';
                 }
                 else{
                     $sponsor_img = base_url().'assets/itinerary_files/sponsor_file/'.$sponsorImg[0];
                 }*/
                 ?>
                 <li>
                     <div class="itinerariesBox">
					 <div class="itinerariesBox-img">
					 <?php if(!empty(array_filter($sponsorImg))){?>
					 <span class="sponsorMark">Sponsored</span>
					<?php }?>
						 <img src="<?php echo base_url();?>assets/<?php echo $img;?>" alt="feature_76" />
					<?php if(!empty($sponsorImg)):?>
					 <div class="sponsoredImg">
						<?php foreach($sponsorImg as $key=>$sponsor_imgs):?>
						<img  src="<?php echo base_url();?>assets/itinerary_files/sponsor_thumbnail_images/<?php echo $sponsor_imgs;?>" alt="sponsor_img" />
						<?php endforeach;?>
						</div>
					 <?php endif;?>
					 
						<!--<img class="sponsoredImg" src="<?php //echo $sponsor_img;?>" alt="sponsor_01" />-->
							 
						 </div>
                         <div class="itinerariesBox-info">
                             <h2 class="itinerariesBox-title font-weight-bold text-uppercase"><?php echo $data->itinerary_title;?></h2>
                             <h3 class="itinerariesBox-subtitle font-weight-bold"><?php echo $data->itinerary_tagline;?></h3>
                             <p class="itinerariesBox-date"><img src="<?php echo base_url();?>assets/img/icon/date.svg" alt="Date" />
                                 <?php echo date('d M Y',strtotime($data->start_date_from_host));?> - <?php echo date('d M Y',strtotime($data->end_date_to_host));?>
                             </p>
                             <p class="itinerariesBox-state"><img src="<?php echo base_url();?>assets/img/icon/loc_fill_red.svg" alt="Loc" />
                                 <?php
                                 $pickupPoints = getAll_pickupspoints($data->id);
                                 foreach($pickupPoints as $key=>$pointsData){
                                     echo $pointsData->pickup_point;
                                 }
                                 ?>
                             </p>
                             <p class="itinerariesBox-user pt-1 mb-0"> <span class="itinerariesBox-userimg"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $hostData['profile_picture'];?>" alt="Profile" /></span> <?php if(isset($hostData['display_name']))echo $hostData['display_name'];?> <small class="itinerariesBox-verify"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="Call_Verified" /> </b>Verified</small> </p>                             
                         </div>
						 <p class="itinerariesBox-status <?php echo $class;?>"><?php echo $status;?></p>
                         <div class="itinerariesBox-links">
                            <div class="itinerarieslanguage">
                                <select class="form-control itinerary_selected_lang">				
								 <option value="<?php echo $lang;?>"><?php echo $lang;?></option> 
								<?php 
								if($lang!=='English' && $lang!=='english'){
								  ?>
								<option value="English">English</option>
								<?php } ?>
							   </select>
							  <input type='hidden' name="itinerary_id" class="itinerary_id" value="<?php echo base64_encode($itineraryID)?>"/>
							  <input type='hidden' name="serviceid" class="serviceid" value="<?php echo $data->service_id;?>"/>
                           </div>                            
                            <div class="itinerariesAnchor"> <a href="#" class="btn btn-secondary mr-1 ml-1 pr-3 pl-3 admin_itinerary_view" target="_blank">View</a> </div>
                                 
                         </div>
                     </div>
                 </li>
             <?php }
		  endforeach;}else{
			   echo 'Oops! No Data exist in table.';
			  }?> 
			  
<script>
	<?php echo base_url();?>admin/detail_itineraries?itinerary_id=<?php echo base64_encode($data->id);?>&flag=2
//=============== Change Admin Itinerary language js start on 19-02-19 =================//
$('.itinerary_selected_lang').each(function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	
	 if(serviceid==1 || serviceid==2 || serviceid==3 || serviceid==4){
	 var detailURL = '<?php echo base_url()?>Admin/detail_itineraries?itinerary_id='+itinerary_id+'&flag=2'+'&serviceid='+serviceid+'&lang='+itinerary_lang;
	 }
	 /*if(serviceid==2){
		 var detailURL = '<?php echo base_url()?>itineraries/itineraries_session_detail?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&lang='+itinerary_lang;
		 }
	if(serviceid==3){
		 var detailURL = '<?php echo base_url()?>itineraries/itineraries_experiences_detail?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&lang='+itinerary_lang;
		 }
    if(serviceid==4){
		 var detailURL = '<?php echo base_url()?>itineraries/itineraries_meetup_detail?itinerary_id='+itinerary_id+'&serviceid='+serviceid+'&lang='+itinerary_lang;
		 }*/		 
	$(this).closest('.itinerariesBox-links').find('.admin_itinerary_view').attr('href', detailURL)
	

});

$('.itinerary_selected_lang').on('change',function(){
	 var itinerary_lang = $(this).closest('.itinerariesBox-links').find('.itinerary_selected_lang option:selected').val();	 
	 var itinerary_id = $(this).closest('.itinerariesBox-links').find('.itinerary_id').val();
	 var serviceid = $(this).closest('.itinerariesBox-links').find('.serviceid').val();
	
	 if(serviceid==1 || serviceid==2 || serviceid==3 || serviceid==4){
	 var detailURL = '<?php echo base_url()?>Admin/detail_itineraries?itinerary_id='+itinerary_id+'&flag=2'+'&serviceid='+serviceid+'&lang='+itinerary_lang;
	 }		 
	$(this).closest('.itinerariesBox-links').find('.admin_itinerary_view').attr('href', detailURL)
	

});

</script>			  