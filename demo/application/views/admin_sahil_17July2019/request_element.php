<?php
$loginSes = $this->session->userdata('adminSes');

if(!empty($hostData['iterator'])){		
   foreach($hostData['iterator'] as $data):
			  ?>
            <tr>
              <td><?php echo $data->host_first_name.' '.$data->host_last_name;?><br>
			    <?php
				  if(!empty($data->created_at) && $data->created_at!=null){
				  ?>
                <small>Added on <?php if(!empty($data->created_at) && $data->created_at!=null) echo date('d M,Y',strtotime($data->created_at));else echo 'N/A';?></small>
				  <?php } ?>
				</td>
              <td><?php echo $data->host_email;?><br>
                 <?php echo $data->host_mob_no;?></td>
              <td>
			  <?php
				$hostCity = getHostCity($data->city);
				if(isset($hostCity['city_name'])){
					echo $hostCity['city_name'];
					}
				else{
					 echo '-';
					} 
				 ?> 
				 </td>
              <td>
			  <?php
			  if(isset($data->services_offered))
			   echo $data->services_offered = str_replace(',', ',&nbsp;', $data->services_offered);
			  else
				  echo '-';
			  ?>
		      </td>
              <td>
				  <?php
				  if($data->admin_status==0){
				       echo '<span class="newStatus">';
				       echo 'New';
					   echo '</span>';					  
					  }			      
			      elseif($data->admin_status==1){
				      echo '<span class="processStatus">';
					  echo 'Link Sent';
					  echo '</span>';
					  }
				 elseif($data->admin_status==2){
				       echo '<span class="retryStatus">';
					   echo 'Re-Submitted';
					   echo '</span>';
					  }
				elseif($data->admin_status==3){
				      echo '<span class="rejectStatus">';
					  echo 'Rejected';
					  echo '</span>';
					  }
				 elseif($data->admin_status==4){
				      echo '<span class="waitStatus">';
					  echo 'Profile Submitted';
					  echo '</span>';
					  }	  
				  ?>
				  </td>
              <td class="text-center tableLinks">
			  <?php
			  if($loginSes['admin_type']!=6){ // Editor Login Condition not Show Action
				if($data->admin_status==0)
			     echo '<a href="javascript:void(0);" class="text-uppercase text-secondary sendLink" id="'.$data->user_id.'"> Send Link</a> 
		              <a href="javascript:void(0);" class="text-uppercase text-default rejected" id="'.$data->user_id.'">Reject</a>';
			   elseif($data->admin_status==1){
					  echo '<a href="javascript:void(0);" class="text-uppercase text-secondary resendLink" id="'.$data->user_id.'"> RE-SEND LINK </a>';
					  }
				 elseif($data->admin_status==2){
					  echo '<a href="#" class="text-uppercase text-secondary"> View Details </a>';
					  }
				elseif($data->admin_status==3){
					  echo '<a href="javascript:void(0);" class="text-uppercase text-secondary rejectResendLink" id="'.$data->user_id.'"> RE-SEND LINK </a>';
					  }
				 elseif($data->admin_status==4){
					  echo '<a href="'.base_url().'admin/host_request_detail?hostid='.base64_encode($data->user_id).'" class="text-uppercase text-secondary" > View Details </a>';
					  }
			  } 
				  ?>
			  
				  </td>
            </tr>
<?php endforeach;} ?>    