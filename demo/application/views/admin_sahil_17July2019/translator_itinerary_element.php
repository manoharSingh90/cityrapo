 <?php
 if(!empty($data['iterator'])){
	 foreach($data['iterator'] as $value):
			  ?>
            <tr>
              <td><?php echo $value->itinerary_title;?><br>
                <small>Added on <?php echo date('d M, Y',strtotime($value->created_at));?></small></td>
              <td><?php
			      if($value->host_first_name!='' && $value->host_first_name!=null){
					  echo $value->host_first_name.' '.$value->host_last_name;				  
					  }
				else{
					echo '--';
					}	  
				  ?>
				  <br>
                <a href="#"><?php echo $value->host_email;?></a><br>
                <a href="#"><?php echo $value->host_mob_num;?></a></td>
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
					  if($value->translator_confirm==0){
						 echo '<span class="newStatus">';
				         echo 'New';
					     echo '</span>';
						 $flag = 1;
						 
						  }
					  if($value->translator_confirm==1){						 
						  echo '<span class="rejectStatus">';
				          echo 'Pending';
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
					<a href="<?php echo base_url();?>Admin/translator_edit_walk?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }
				 if($value->service_id==2){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_session?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }
				if($value->service_id==3){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_experience?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }
				if($value->service_id==4){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_meetup?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>				  
				    <?php }	
				}
						
				elseif($value->admin_status==2){
				   if($value->service_id==1){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_walk?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php }
				   if($value->service_id==2){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_session?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php }
				   
				    if($value->service_id==3){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_experience?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php }
				   if($value->service_id==4){
					?>
					<a href="<?php echo base_url();?>Admin/translator_edit_meetup?itineraryid=<?php echo base64_encode($value->id);?>&userid=<?php echo base64_encode($value->user_id);?>&flag=<?php echo $flag;?>&serviceid=<?php echo $value->service_id;?>&otherlang=<?php echo $value->itinerary_language;?>" class="text-uppercase text-secondary">View Details</a>
				   <?php } 
				
				 }
					?>
				  
				  </td>
            </tr>
 <?php endforeach;}?>