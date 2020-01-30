 <?php
 if(!empty($data['iterator'])){
	 foreach($data['iterator'] as $value):
			  ?>
            <tr>
              <td><?php echo $value->itinerary_title;?><br>
                <small>Added on <?php echo date('d M, Y',strtotime($value->created_at));?></small></td>
				<td>
				  <?php
				    $hostData = getHostDetail($value->host_verification_type);			       
					if(!empty($hostData)){
						echo $hostData['host_name'];
						}else{
						 echo '-';
						}										
					  ?>				  				  
				  </td>
              <td><?php
			      if($value->host_first_name!='' && $value->host_first_name!=null){
					  echo isset($value->HOST_F_NAME) ? $value->HOST_F_NAME.' '.$value->HOST_L_NAME : $value->host_first_name.' '.$value->host_last_name;				  
					  }
				else{
					echo '--';
					}	  
				  ?>
				  <br>
                <?php echo isset($value->HOST_EMAIL) ? $value->HOST_EMAIL : $value->host_email; ?><br>
                <?php echo isset($value->HOST_MOBILE) ? $value->HOST_MOBILE : $value->host_mob_num; ?></td>				
              <td><?php echo $value->origin_city = str_replace(',', ',&nbsp;', $value->origin_city);?></td>
              <td>
				  <?php 
					  //$services = hostServices($value->user_id);
					  //echo $services['services_offered'] = str_replace(',', ',&nbsp;', $services['services_offered']);
					 if(!empty($value->service_id)){
					  if($value->service_id==1){
						  echo 'Walk';
						  }
					  elseif($value->service_id==2){
						  echo 'Session';
						  }
					 elseif($value->service_id==3){
						  echo 'Experience';
						  }
					elseif($value->service_id==4){
						  echo 'Meet-Up';
				  }
			  }else{
			    echo '-';
			  } 
					 ?>				 			
			 </td>
              <td>
				  <?php
					  if($value->admin_status==1){
						 echo '<span class="newStatus">';
				         echo 'New';
					     echo '</span>';
						 $flag = 1;
						 
						  }
					  if($value->admin_status==2){						 
						  echo '<span class="rejectStatus">';
				          echo 'Rejected';
					      echo '</span>';
						  $flag = 1;						 
						  }	  
					  ?>
				  </td>
              <td class="text-center">
			    <?php  // flag maintain itinerary request url 				   
				if($value->admin_status==1){
					if($value->service_id==1){
					?>
					<a href="<?php echo base_url();?>Admin/detail_itineraries?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }
				 if($value->service_id==2){
					?>
					<a href="<?php echo base_url();?>Admin/admin_detail_itineraries_sessions?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }
				if($value->service_id==3){
					?>
					<a href="<?php echo base_url();?>Admin/admin_detail_itineraries_experience?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }
				if($value->service_id==4){
					?>
					<a href="<?php echo base_url();?>Admin/admin_detail_itineraries_meetup?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }	
				}
						
				elseif($value->admin_status==2){
				   if($value->service_id==1){
					?>
					<a href="<?php echo base_url();?>Admin/detail_itineraries?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php }
				   if($value->service_id==2){
					?>
					<a href="<?php echo base_url();?>Admin/admin_detail_itineraries_sessions?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php }
				   
				    if($value->service_id==3){
					?>
					<a href="<?php echo base_url();?>Admin/admin_detail_itineraries_experience?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php }
				   if($value->service_id==4){
					?>
					<a href="<?php echo base_url();?>Admin/admin_detail_itineraries_meetup?itinerary_id=<?php echo base64_encode($value->id);?>&flag=<?php echo $flag;?>&service_id=<?php echo $value->service_id;?>&lang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php } 
				
				}
					?>
				  
				  </td>
            </tr>
 <?php endforeach;}?>