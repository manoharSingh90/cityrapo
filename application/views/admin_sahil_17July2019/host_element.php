<?php 
if(!empty($dataVal['iterator'])){
	foreach($dataVal['iterator'] as $data):
			  ?>
            <tr>
              <td><?php echo $data->host_first_name.' '.$data->host_last_name;?><br>
                <small>Added on <?php echo date('d M, Y',strtotime($data->created_at));?></small></td>
              <td>
				  <?php
				    $hostData = getHostDetail($data->host_verification_type);			       
					if(!empty($hostData)){
						echo $hostData['host_name'];
						}else{
						 echo '-';
						}	
					  ?>				  				  
				  </td>
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
              <td><?php echo $data->services_offered = str_replace(',', ',&nbsp;', $data->services_offered);?></td>
              <td class="text-center"><a href="<?php echo base_url();?>admin/host_detail?hostid=<?php echo $data->user_id;?>" class="text-uppercase text-secondary">View Details</a></td>
            </tr>
<?php endforeach; }?>  