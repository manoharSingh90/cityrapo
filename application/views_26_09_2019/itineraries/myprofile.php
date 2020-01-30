<?php include('head.php');?>
<?php include('header.php');?>
    
<main>
  <div class="container">
    <div class="myprofilePage clearfix">
      <div class="profileLeft">
        <h2 class="normalTitle mb-2">My Profile</h2>
        <div class="profileImage"><img src="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $profile_data->profile_picture;?>" alt="<?php echo $profile_data->host_first_name;  ?>" /> </div>
        <h3 class="normalTitle mb-1"><?php echo $profile_data->host_first_name.' '.$profile_data->host_last_name;  ?></h3>
        <h4 class="smallTitle"><?php $city = $profile_data->i_am=='individual' ? getHostCity($profile_data->city) : getHostCity($profile_data->company_city);  echo  $city['city_name']; ?></h4>
        <?php 
		 if($profile_data->verified_by=='Video'){
		    $verifyimg = 'video.svg';
		  }
	    if($profile_data->verified_by=='Call'){
		    $verifyimg = 'call_yellow.svg';
		   }	 	
		 ?>	


    <?php /* $hostDatas = getHostDetail($hostData['host_verification_type']);
                if (!empty($hostDatas)) { $hostIcon = preg_replace('/\s/', '', strtolower($hostDatas['host_name'])); ?>
			  <small class="hostInfo-type"><b><img src="<?php echo base_url(); ?>assets/img/icon/badge/<?php echo $hostIcon . '_badge.svg' ?>" alt="<?php echo $hostIcon; ?>"></b><?php echo $hostDatas['host_name']; ?></small>
			  <?php } */?>
                
			  <?php if(isset($hostData["guide_badges"]) && $hostData["guide_badges"]==1) { ?>
				<small class="hostInfo-crtguide"><b><img src="<?php echo base_url(); ?>assets/img/icon/tourguide.svg" alt="crtguide"> </b></small>
			  <?php } ?>
				
				<small class="hostInfo-verified"><b><img src="<?php echo base_url(); ?>assets/img/icon/<?php echo $verifyimg; ?>" alt="verified" /></b>Verified</small>

				 
        <div class="pt-3">
		<?php 
			if($profile_data->gender=='M'){
				 $img = 'assets/img/icon/male_red.svg';
				}
		    if($profile_data->gender=='F'){
				 $img = 'assets/img/icon/female_red.svg';
				}				
			
			?>
          <p class="textLine"><b><img src="<?php echo base_url();?><?php echo $img;?>" alt="gender" /></b><span class="smallTitle d-block">D.O.B</span><?php echo date('d/m/Y',strtotime($profile_data->date_of_birth));?></p>
		  	
        </div>
        <div class="pt-3">
          <p class="mb-1 textLine iconSmall"><b><img src="<?php echo base_url();?>assets/img/icon/mail_red.svg" alt="mail" /></b><?php echo $profile_data->host_email; ?></p>
          <p class="mb-0 textLine iconSmall"><b><img src="<?php echo base_url();?>assets/img/icon/call_red.svg" alt="call" /></b>+91-<?php echo $profile_data->host_mob_no; ?></p>
        </div>
        <div class="pt-5">
          <ul class="profileAction">
            <li><a href="<?php echo base_url();?>profile" class="btn btn-primary pr-4 pl-4">Edit</a></li>
            <li><a href="#" class="text-secondary text-uppercase font-weight-semibold"  data-toggle="modal" data-target="#changePasswordModal">Change Password</a></li>
            <li><a href="<?php echo base_url();?>log_out" class="text-uppercase text-default font-weight-semibold">Logout</a></li>
          </ul>
        </div>
      </div>
      <div class="profileRight">
        <div class="profileData">
          <div id="alerts-msg">
  
          </div>
          <h2 class="normalTitle mb-2">Personal Details</h2>
          <div class="row">
            <div class="col-12 pt-2">
              <p class="smallTitle">My Interests</p>
              <ul class="clearfix mb-3 pt-2">
                <?php  $interest = explode(',',$profile_data->interest); 
               foreach ($interest as $value) { ?>
                 <li class="roundedBox d-inline-block m-1"><?php echo $value;?></li>
              <?php  } ?>
                
                
              </ul>
            </div>
            <div class="col-12 col-sm-6 pt-2">
              <p class="smallTitle">Nationality</p>
              <p><?php echo $profile_data->nationality; ?></p>
            </div>
            <div class="col-12 col-sm-6 pt-2">
              <p class="smallTitle">Known Languages</p>
              <p><?php echo $profile_data->known_languages = str_replace(',', ',&nbsp;', $profile_data->known_languages); ?></p>
            </div>
            <div class="col-12 pt-2">
              <p class="smallTitle">Preferred Cities</p>
              <p><?php echo $profile_data->preferred_cities = str_replace(',', ',&nbsp;', $profile_data->preferred_cities); ?></p>
            </div>
            <div class="col-12 pt-2">
              <p class="smallTitle">About Me</p>
              <p><?php echo $profile_data->description; ?></p>
            </div>
            <div class="col-12 pt-2">
              <p class="smallTitle">Services</p>
              <ul class="profileServices">
			  <?php 
			  $services = explode(',',$profile_data->services_offered);
			 
			  foreach($services as $val):
			  if($val=='Walk'){
				   $img = 'walks_fill_red.svg';
				  }
			  
			 if($val=='Session'){
				   $img = 'sessions_fill_red.svg';
				  }
			 if($val=='Experience'){
				   $img = 'experiences_fill_red.svg';
				  }
			if($val=='Meet-Up'){
				   $img = 'meetup_fill_red.svg';
				  }		  
			  ?>
                <li><span><img src="<?php echo base_url();?>assets/img/icon/<?php echo $img;?>" alt="filejpg" /></span><?php echo $val; ?></li>
               <?php endforeach;?>
              </ul>
            </div>
            <?php if($profile_data->i_am=='individual'): ?>
            <div class="col-12  pt-2">
              <hr/>
            </div>

            <div class="col-12 pt-2">
              <h2 class="normalTitle mb-2">Location</h2>
              <p class="smallTitle">Permanent Residence</p>
              <p class="mb-0"><?php echo $profile_data->permanent_address_1 ; ?>,<br>
              <p class="mb-0"><?php echo $profile_data->permanent_address_2 ; ?>,<br>
			  <p class="mb-0"><?php if(!empty($profile_data->permanent_address_3))echo $profile_data->permanent_address_3.',<br>'; ?>
			 
               <?php
				    $hostState = getState($profile_data->state);					
					$hostCity = getHostCity($profile_data->city);
					echo $hostCity['city_name'].',<br>';					
				    echo $hostState['state_name'].' - '.$profile_data->pin_code ;?></p>
            </div>
            <div class="col-12 pt-2">
              <hr/>
            </div>
			
			 <div class="col-12 pt-2">
              <h2 class="normalTitle mb-2">TEMPORARY ADDRESS</h2>
              <?php if(!empty($profile_data->tmp_address_1) && $profile_data->tmp_address_1!=''){				
	          $tmpState = getState($profile_data->tmp_state);				 
			  $tmpCity =  getHostCity($profile_data->tmp_city);			
			 ?>
              <p><?php if(!empty($profile_data->tmp_address_1)){echo $profile_data->tmp_address_1.',';} ?><br>
               <?php if(!empty($profile_data->tmp_address_2)){echo $profile_data->tmp_address_2.',';} ?><br>
			   <?php if(!empty($profile_data->tmp_address_3)){echo $profile_data->tmp_address_3.',<br>';} ?>
			   <?php if(!empty($tmpCity)) echo $tmpCity['city_name'],',';?><br>
			  <?php echo $tmpState['state_name'];?>-<?php if(!empty($profile_data->tmp_pin_code))echo $profile_data->tmp_pin_code;?>
               </p>
			  <?php
			  }else{?>
				 <div class="custom-control custom-checkbox custom-control-inline titleCheck">
                <input type="checkbox" id="sameAbove" class="custom-control-input" checked="" disabled>
                <label class="custom-control-label" for="sameAbove">Same as above</label>
              </div>
			<?php } ?> 
            </div>
			<?php endif;?>
			
			<div class="col-12 pt-2">
              <hr/>
            </div>
			
			<?php 
			if($profile_data->i_am=='company'):
				?>
            <div class="col-12 pt-2">
              <h2 class="normalTitle mb-2">Company</h2>
              <p class="smallTitle">Associated Company</p>
              <p><?php echo $profile_data->associated_companies ; ?>,</p>
              <p class="smallTitle">Company Details</p>
              <p><?php echo $profile_data->company_address_1 ; ?>,<br>
                
               <?php
				    $companyState = getState($profile_data->company_state);
					
					echo $companyState['state_name'].',<br>';
					
					$companyCity = getHostCity($profile_data->company_city);
					
				    echo $companyCity['city_name'].' - '.$profile_data->company_pin_code; ?></p>
            </div>
			<?php endif;?>
			
			
			<div class="col-12 pt-2">
              <?php if(!empty($profile_data->training) && $profile_data->training==1){?>				
	           <div class="custom-control custom-checkbox custom-control-inline ml-0">
                <input type="checkbox" class="custom-control-input" checked disabled>
                <label class="custom-control-label text-uppercase text-dark font-weight-bold">Training Complete</label> <a href="#" data-toggle="modal" data-target="#trainingtModal" class="text-italic ml-2 mt-1 small">Click here to view training module again</a>
              </div>
			  <?php
			   }
			  ?> 
            </div>			
          </div>
        </div>
        <div class="profileDox">
          <h2 class="normalTitle mb-2">Documents</h2>
		  <?php 
			  if(!empty($profile_data->adhaar_number_doc)){
			  ?>
          <div class="pt-2">
            <p class="smallTitle">Adhaar Card</p>
            <p class="mb-0"><?php echo $profile_data->adhaar_number ; ?></p>
            <div class="downloadCard">
              <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
              <div class="dcInfo">
                <p><?php echo $profile_data->adhaar_number_doc ; ?></p>
                <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $profile_data->adhaar_number_doc;?>" download>Download</a> </div>
            </div>
          </div>
			<?php }
			if(!empty($profile_data->pan_number_doc)){
			  ?>
          <div class="pt-2">
            <p class="smallTitle">PAN Card</p>
            <p class="mb-0"><?php echo $profile_data->pan_number ; ?></p>
            <div class="downloadCard">
              <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
              <div class="dcInfo">
                <p><?php echo $profile_data->pan_number_doc ; ?></p>
                <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $profile_data->pan_number_doc;?>" download>Download</a> </div>
            </div>
          </div>
			<?php } ?>
          <?php if(!empty($profile_data->passport_number)){?>
		  <div class="pt-2">
            <p class="smallTitle">Passport</p>
            <p class="mb-0"><?php echo $profile_data->passport_number ; ?></p>
            <div class="downloadCard">
              <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
              <div class="dcInfo">
                <p><?php echo $profile_data->passport_number_doc ; ?></p>
                <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $profile_data->passport_number_doc;?>" download>Download</a> </div>
            </div>
          </div>
		  <?php }
		   if(!empty($profile_data->license_guide_number)){
		  ?>
          <div class="pt-2">
            <p class="smallTitle">Guide License</p>
            <p class="mb-0"><?php echo $profile_data->license_guide_number ; ?></p>
            <div class="downloadCard">
              <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
              <div class="dcInfo">
                <p><?php echo $profile_data->license_guide_number_doc ; ?></p>
                <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $profile_data->license_guide_number_doc;?>" download>Download</a> </div>
            </div>
          </div>
		   <?php } 
		   if(!empty($profile_data->gst_pin)){
		   ?>
          <div class="pt-2">
            <p class="smallTitle">GSTN</p>
            <p class="mb-0"><?php echo $profile_data->gst_pin; ?></p>
            <div class="downloadCard">
              <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
              <div class="dcInfo">
                <p><?php echo $gst_pin_doc  = $profile_data->gst_pin_doc ; ?></p>
                <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $profile_data->gst_pin_doc;?>" download>Download</a> </div>
            </div>
          </div>
		   <?php } ?>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include('footer.php');?>
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div id="alert-msg">
  
     </div>
      <form id="resetForm">
		  <div class="modal-body">
          <div id='loadingmessage' class="loaderBox">
        <span><img src="<?= base_url('assets/img/loader.svg')?>"/></span>  
      </div>
        <ul class="pl-2 pr-2">
          <li class="form-group col-12">
            <label class="col-form-sublabel">Old password</label>
            <input type="password" class="form-control" placeholder="Old Password" id="old_password" name="old_pass" required/>
           
          </li>
          <li class="form-group col-12">
            <label class="col-form-sublabel">New password</label>
            <input type="password" class="form-control" placeholder="New Password" id="new_password" name="new_pass" required data-rule-minlength="6" data-rule-maxlength="15"/>
           
          </li>
          <li class="form-group col-12">
            <label class="col-form-sublabel">Confirm New password</label>
            <input type="password" class="form-control" placeholder="Confirm New Password" id="conf_new_password" name="confirm_pass"  required data-rule-equalto="#new_password" />
            
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Cancel</button>
        <!--<button type="button" id="addQuestion" class="btn btn-primary" onclick="changePassword()">Change</button>-->
		 <button type="submit" class="btn btn-primary">Change</button>
      </div>
      </form>
      
    </div>
  </div>
</div>
<!-- SUBMIT FORM MODAL -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> Success</h5>
        <p class="font-weight-semibold text-center">Your password is successfully changed,<br> Please check your inbox.<br/>
          </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" id="msgDone">Done</button>
      </div>
    </div>
  </div>
</div>

<!-- TRAINING ALERT MODAL -->
<div class="modal fade" id="trainingtModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
	 <form id="trainingForm">
      <div class="modal-header">
        <h5 class="modal-title">Training</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">	 
        <div class="confirmationText">

        <p>Dear Host,</p>
<p>Congratulations! You are now part of the City Explorers team.<br>
  You have joined our mission to transform ordinary trips into customized, extraordinary experiences.</p>
<p>Our common passion to share and exchange highlights of our country to travellers and fellow citizens shall bring great results ahead for society and help in preserving the true spirit of the diverse nation. </p>
<p>We have many ideas to share with you. We begin with some training documents which give you complete clarity about processes. </p>
<p>How to <a href="#">Create Products Guidelines</a> / <a href="#">Do’s & Don’ts</a></p>


        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
	  </form>
    </div>
  </div>
</div>


<!-- SCRIPT --> 
<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.min.js')?>"></script> 
<script type="text/javascript" src="<?= base_url('assets/js/jquery-migrate-1.4.1.min.js')?>"></script> 
<script type="text/javascript" src="<?= base_url('assets/dependencies/popper/popper.min.js')?>"></script> 
<script type="text/javascript" src="<?= base_url('assets/dependencies/bootstrap-4.1.2/dist/js/bootstrap.min.js')?>"></script> 
<script type="text/javascript" src="<?php echo base_url();?>assets/dependencies/jquery-validation-master/dist/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/js/global_function.js')?>"></script>
<script type="text/javascript">

 $( "#resetForm" ).validate({
		errorElement: 'small',
				submitHandler: function() {
				changePassword();				
				$('#changePasswordModal').modal('show');
				$('#resetForm')[0].reset();
				}
				});	

function changePassword(){
      var old_pass = $('#old_password').val();
      var new_pass = $('#new_password').val();
      var conf_new_pass = $('#conf_new_password').val();
      var proceed = true;   
     
	  if(proceed){
         $.ajax({
              type:'POST',
              data:{old_pass:old_pass,new_pass:new_pass,conf_new_pass:conf_new_pass},
              url:"<?= base_url('account/changePass')?>",
               beforeSend:function(){
              $("#loadingmessage").css('display','block');
              },
              success:function(result){
               console.log(result);
               if($.trim(result) == 'success'){                            
                $('#changePasswordModal').modal('toggle');               
                $('#doneModal').modal();
                //window.location.href = "<?= base_url('account/log_out?status=logout');?>";                 
                $("#loadingmessage").css('display','none'); 
               }else{
                    var msg =  'You Filled Wrong Current Password';
                    $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-2 text-center" role="alert" id="demo" >'+msg+'</div>');
                    $('#old_password').focus();
                    $("#loadingmessage").css('display','none'); 
               }
               
              }

            });
	  } 
       
  }
</script>

<script type="text/javascript">
(function($) {
 $('#msgDone').on('click',function(){
	  window.location.href = "<?= base_url('account/log_out?status=logout');?>"; 
	 });	

})(jQuery);
</script>
</body>
</html>
