<!-- header top start -->
<?php include('header.php');?>
<!-- header top end-->
<div class="loadingWrap"><div class="loadingText">Loading...</div></div>

<div class="profilePage">
    <div class="profilePage-head clearfix">
      <h1 class="cmyLogo float-left"><img src="<?= base_url('assets/img/iwl_hr_white_logo.svg')?>" alt="India with locals" /></h1>
      <div class="float-right floatBtn">
       <a href="<?= base_url('itineraries');?>" class="btn btn-link text-default mr-2">Skip</a>
       <button class="btn btn-link mr-3" id="save" type="button" name="save">Save</button>
       <button class="btn btn-primary" id="done" type="button"  name="done">Done</button>
     </div>
    </div>
    <div class="profilePage-body clearfix">
      <div class="profilePage-links" >
        <h3><span><img src="<?php echo base_url();?>assets/img/icon/details.svg" alt="Personal"></span>Personal Info</h3>
        <ul>
          <li class="active"><a href="#filldetail">Details</a></li>
          <li><a href="#fillresidence">Location</a></li>
          <li><a href="#fillcompany">Company</a></li>
          <li><a href="#fillpreferences">Preferences</a></li>
        </ul>
        <h3><span><img src="<?php echo base_url();?>assets/img/icon/details.svg" alt="Documents"></span>Documents</h3>
        <ul>
          <li>Identification</li>
          <li>Passport</li>
          <li>Others</li>
        </ul>
      </div>

      <div class="profilePage-info">
        <!-- Flash MSG-->     
      <?php if($error = $this->session->flashdata('error')):
      $feedback_class = $this->session->flashdata('feedback_class'); ?>
        <!--<div class="row">
          <div class="col-lg-12" align="center">
            <div class="alert alert-dismissible <?= $feedback_class ?>">
              <?= $error; ?>
              
            </div>
          </div>
        </div>-->
      <?php endif;?>
	  
      <div id="alert-msg"></div>
<!-- Flash MSG--> 

          <?= form_open_multipart('',['id' =>'profile_form']); ?>
          
          <fieldset id="filldetail">
		  <input type="hidden" name="user_id" value="<?php echo $user_data->user_id;?>" />
		  <h3 class="col-form-label">DISPLAY NAME</h3>
		  <ul class="form-row">
             <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Display Name</label>
                <input type="text" class="form-control" id="display_name" name="display_name" placeholder="Display Name" maxlength="10" value="<?php if(isset($user_data->display_name)){echo $user_data->display_name;}?>" autocomplete="off" required />
              </li>      
            </ul>
			
            <h3 class="col-form-label">NAME</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php if($user_data->host_first_name == ''){}else{echo $user_data->host_first_name;}?>" autocomplete="off" required readonly/>
              </li>
              
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Last Name</label>
                <input type="text" class="form-control" id="last_name"  name="last_name" placeholder="Last Name" value="<?php if($user_data->host_last_name == ''){}else{echo $user_data->host_last_name;}?>" autocomplete="off" required readonly/>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Mobile</label>
				<span class="mobileCheck">+91-</span>
                <input type="number" class="form-control" id="mobile_number" autocomplete="off"  name="mobile_number" placeholder="Mobile"  value="<?php if($user_data->host_mob_no == ''){}else{echo $user_data->host_mob_no;}?>"  minlength ='10' maxlength ='14' required readonly maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter vaild mobile number" />
                <span id="mob_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">Contact Number should be minimum  10 digit</span>
              </li>

              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Email ID</label>
                <input type="email" class="form-control" id="email_id" name="email_id" placeholder="Email ID"  value="<?php if($user_data->host_email == ''){}else{echo $user_data->host_email;}?>" autocomplete="off" readonly/>
              </li>
            </ul>
            <ul class="form-row pt-3">
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-label">PROFILE PICTURE</label>
                <div class="custom-control custom-control-inline valign userImage">
                  <label class="control-icon userImagelabel" for="userimageInput">
                    <img id="userProfileImage" class="userImageCenter" src="<?php if($user_data->profile_picture == ''){echo base_url("assets/img/placeholder.jpg");}else{
                      echo base_url("assets/upload/profile_pic/$user_data->profile_picture");
                    } ?>" alt="user image" /></label>
                  <a href="" id="remove_pic" onclick="removePic()" class="text-uppercase userImageClear">Remove</a>
                </div>    
                <small class="text-muted d-block">*Required dimension 300 X 300px, size less than 5mb and format .jpg,.jpeg only</small>
        <input type="file" id="userimageInput" accept="image/x-png,image/gif,image/jpeg,image/jpg" name="profile_pic" class="form-control fileInput" />
        <input type="hidden" class="checkValue" name="profile_img" value="<?php if($user_data->profile_picture == ''){}else{echo $user_data->profile_picture;}?>" id="removeProfilepic" />
         <input type="checkbox" name="profileImg" class="vaildValue hideInput" required='required' >
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-label">GENDER</label>
                <div class="custom-control custom-radio custom-control-inline valign">
                <label>
                  <input type="radio" name="gender" id="femaleRadioInput" class="custom-control-input" value="F" <?php if($user_data->gender == ''){}else{echo set_radio('gender', 'F', $user_data->gender == 'F');}?> required/>
                  <span class="control-icon"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 31 40" style="enable-background:new 0 0 31 40;" xml:space="preserve">
                  <path d="M7.2,14.8C11,14.5,15,13,17.3,9.8c-0.7-0.1-1.3-0.2-2-0.3c0.2,0.9,0,2-0.9,2.3c-1,0.4-1.1,2.3,0.3,2.2
  c2.6-0.2,7.4-0.3,8.8-2.9c-0.7-0.2-1.4-0.4-2-0.6c-0.5,4.1-0.5,8.8-3.9,11.8c-1.6,1.4-2.9,1.9-4.7,0.7c-1.4-0.9-2.5-2.3-3.2-3.8
  c-0.8-1.7-1.3-3.6-1.3-5.5c0-1.4-2.2-1.4-2.2,0c0,2.5,0.7,5.2,2,7.4c1.7,2.9,5.2,6,8.7,4.3c5.9-2.8,6.2-9.3,6.9-14.9
  c0.1-1.1-1.6-1.5-2-0.6c-0.9,1.6-5.2,1.7-6.9,1.8c0.1,0.7,0.2,1.4,0.3,2.2c2.1-0.9,2.9-2.8,2.4-5c-0.2-1-1.5-1-2-0.3
  c-1.8,2.5-5.2,3.7-8.2,4C5.8,12.7,5.8,14.9,7.2,14.8z"/>
                  <path d="M3.7,33.1c0-3.5,0-6.9,0-10.4c0-3.6-0.4-7.5,0.3-11c0.6-3,2.1-6.2,4.9-7.9c3.2-1.9,6.3-0.5,9.7-0.3c2.7,0.2,4.6,1.4,5.9,3.9
  c1.6,3.4,1.2,7,1.3,10.7c0,4.2,0,8.4-0.2,12.6c-0.1,1.4,2.1,1.4,2.2,0c0.2-4.2,0.2-8.4,0.2-12.6c0-3.5,0.2-7-1-10.4
  c-1.3-3.7-4.1-6.1-8-6.4c-2.4-0.2-4.7-1-7.2-0.7C8.5,1,5.8,2.8,4.1,5.5c-2.7,4-2.7,8.6-2.6,13.2c0,4.8,0,9.6,0.1,14.5
  C1.5,34.5,3.7,34.5,3.7,33.1L3.7,33.1z"/>
                  <path d="M10.9,24.2c0.2,0.8,0.2,1.7,0.4,2.5c-0.2,0.5-0.2,0.7,0.1,0.5c0.2-0.1,0.3-0.1,0.1,0c-0.1,0.1-0.5,0.2-0.7,0.2
  c-1.5,0.5-3,0.9-4.5,1.4c-4.2,1.4-5.7,4.9-5.7,9c0,0.6,0.5,1.1,1.1,1.1c9.1,0,18.2,0,27.2,0c0.6,0,1.1-0.5,1.1-1.1
  c0-4.2-1.3-7.7-5.7-9c-1.6-0.5-3.2-0.8-4.8-1.2c-0.3-0.1-0.6-0.2-0.9-0.2c-0.9-0.1,0.1-0.4,0.1,0.3c0-0.2-0.2-0.6-0.3-0.9
  c-0.2-1.1,0-2.1,0.4-3.1c0.5-1.3-1.6-1.9-2.1-0.6c-0.6,1.5-1.1,4.3,0.1,5.7c0.7,0.9,2.6,1,3.6,1.3c1.5,0.4,3.4,0.6,4.8,1.5
  c2.3,1.4,2.5,3.8,2.5,6.2c0.4-0.4,0.7-0.7,1.1-1.1c-9.1,0-18.2,0-27.2,0c0.4,0.4,0.7,0.7,1.1,1.1c0-2.5,0.4-4.8,2.7-6.2
  c1.4-0.9,3.2-1.2,4.7-1.7c1.1-0.3,2.5-0.5,3.1-1.6c0.7-1.4,0.2-3.3-0.1-4.7C12.7,22.3,10.5,22.9,10.9,24.2L10.9,24.2z"/>
                  <path d="M8.9,30.1c3.6,4.2,8.9,3.7,12.5-0.2c1-1-0.6-2.6-1.6-1.6c-1.9,2.1-4.3,3.4-7,2c-0.9-0.4-1.7-1.1-2.4-1.8
  C9.6,27.5,8,29,8.9,30.1L8.9,30.1z"/>
                  </svg> </span>
                  <label class="custom-control-label" for="femaleRadioInput">Female</label>
                  </label>
                </div>
                <div class="custom-control custom-radio custom-control-inline valign">
                               <label>

                  <input type="radio" name="gender" id="maleRadioInput" class="custom-control-input" value="M" <?php if($user_data->gender == ''){}else{ echo set_radio('gender', 'M', $user_data->gender == 'M');}?> required>
                  <span class="control-icon"> <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 29 40" style="enable-background:new 0 0 29 40;" xml:space="preserve">
                  <path d="M22,13c-3.2-0.3-6.9-1.6-8.8-4.3c-0.5-0.7-1.8-0.7-2,0.3c-0.5,2.3,0.3,4.4,2.6,5.3c0.1-0.7,0.2-1.4,0.3-2.2
  c-1.8-0.1-6.4-0.2-7.4-2c-0.5-0.9-2.2-0.6-2,0.6c0.7,6,1.1,12.9,7.4,15.9c3.8,1.8,7.6-1.8,9.2-5c1.2-2.2,1.9-4.9,1.9-7.5
  c0-1.4-2.2-1.4-2.2,0c0,1.9-0.5,3.9-1.2,5.6c-0.7,1.7-1.8,3.2-3.3,4.2c-2,1.4-3.4,1.1-5.2-0.4c-3.9-3.1-3.9-8.3-4.4-12.8
  c-0.7,0.2-1.4,0.4-2,0.6c1.5,2.7,6.6,2.9,9.3,3.1c1.3,0.1,1.3-1.7,0.3-2.2c-1-0.4-1.2-1.6-1-2.6c-0.7,0.1-1.3,0.2-2,0.3
  c2.4,3.4,6.6,5,10.7,5.4C23.4,15.3,23.4,13.1,22,13z"/>
                  <path d="M10.2,25.2c-0.4,1.1-0.8,2.8-1.7,3.6c-0.9,0.7-2.3,1.1-3.4,1.6c-3.3,1.6-4.4,4.6-4.4,8.1c0,0.6,0.5,1.1,1.1,1.1
  c8.4,0,16.8,0,25.1,0c0.6,0,1.1-0.5,1.1-1.1c0-3.7-1.1-7-4.9-8.3c-1.1-0.4-2.4-0.8-3.6-0.9c-0.2,0-0.5-0.2-0.7-0.2
  c0.5,0,0.7,0.9,0.3,0c-0.6-1.3-1.3-2.4-1.4-3.9c-0.1-1.4-2.3-1.4-2.2,0c0.1,1.8,0.7,3.8,1.9,5.3c0.7,0.8,1.4,0.9,2.4,1.2
  c1.4,0.4,3,0.6,4.1,1.5c1.8,1.4,1.8,3.3,1.8,5.4c0.4-0.4,0.7-0.7,1.1-1.1c-8.4,0-16.8,0-25.1,0c0.4,0.4,0.7,0.7,1.1,1.1
  c0-1.8,0.1-3.5,1.5-4.9c1-1.1,2.6-1.6,4-2.2c1-0.5,1.8-0.8,2.4-1.7c0.7-1.1,1.2-2.5,1.7-3.8C12.8,24.5,10.7,23.9,10.2,25.2
  L10.2,25.2z"/>
                  <path d="M8.6,21.6c-1.9-1.9-3.4-4.3-4.2-6.9C2.7,9.9,5.2,4.1,10.7,3.3c1.5-0.2,3.1-0.1,4.5,0.5c1,0.4,1.7,1.4,2.8,1.4
  c0.4,0,0.9-0.2,1.3-0.3C22.9,4.5,24,8,24,11.1c0,1.5-0.1,2.6-0.7,4.4c-0.9,2.8-2.5,5.3-4.9,7c-1.2,0.8-0.1,2.7,1.1,1.9
  c5.2-3.5,8.1-11.1,6.2-17.2C24.5,3.6,21,1.7,17.4,3c0.4,0.1,0.7,0.2,1.1,0.3C12.3-1.7,3,2,1.7,9.7C0.9,14.6,3.6,19.8,7,23.2
  C8,24.2,9.6,22.6,8.6,21.6L8.6,21.6z"/>
                  <path d="M9.3,31.2c3.1,0,6.2,0,9.2,0c1.4,0,1.4-2.2,0-2.2c-3.1,0-6.2,0-9.2,0C7.9,29,7.9,31.2,9.3,31.2L9.3,31.2z"/>
                  </svg></span>
                  <label class="custom-control-label" for="maleRadioInput">Male</label>
</label>
                </div>
              </li>
            </ul>
            <ul class="form-row">
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-label">NATIONALITY</label>
                <select class="form-control" name="nationality" id="nationality" required>
                 <?php 
					  if($user_data->nationality==''){
					  echo '<option value="">Select</option>';
					  }
					  ?>
                  <option value="Indian" <?php if($user_data->nationality == "Indian"){ echo 'selected="selected"'; } ?>>Indian</option>
                 
                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-label">DATE OF BIRTH</label>
                <input type="text" class="form-control"  name="date_of_birth" required id="date_of_birth" 
				value="<?php if(!empty($user_data->date_of_birth)){echo date('d/m/Y',strtotime($user_data->date_of_birth));}?>" placeholder="DD/MM/YYYY"  readonly />
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-label">DESCRIPTION</label>
                <textarea class="form-control" placeholder="Describe yourself (max 2000 characters)" data-rule-maxlength="2000" name="description" required id="description" ><?php if(isset($user_data->description)){echo $user_data->description;}?></textarea>
               
              </li>
            </ul>
          </fieldset><?php 
        if($user_data->i_am=='individual'){
        ?>
          <fieldset id="fillresidence">
            <h3 class="col-form-label">Permanent Residence</h3>
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Address Line 1</label>
                <input type="text" class="form-control" placeholder="Address Line 1" name="per_address_1"  value="<?php if($user_data->permanent_address_1 == ''){}else{echo $user_data->permanent_address_1 ;}?>" required autocomplete="off"/>
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Address Line 2</label>
                <input type="text" class="form-control" placeholder="Address Line 2"  name="per_address_2" value="<?php if($user_data->permanent_address_2 == ''){}else{echo $user_data->permanent_address_2 ;}?>" required autocomplete="off"/>
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Address Line 3</label>
                <input type="text" class="form-control" placeholder="Address Line 3"  name="per_address_3" value="<?php if($user_data->permanent_address_3 == ''){}else{echo $user_data->permanent_address_3 ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">State</label>
                <select class="form-control" name="state" id="state" required >
                  <option value="">Select</option>
                  <?php foreach($state as $states){?>
                  <option value="<?php echo $states->id ;?>"<?php if(isset($user_data->state) && $user_data->state == $states->id){echo 'selected="selected"';}?>><?php echo $states->state_name ;?></option>
                  <?php } ?>

                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">City</label>
                <select class="form-control" name="city" id="city" placeholder="select State" required>
                  <option value="">Select</option>                 
                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Pin Code</label>
                <input type="text" class="form-control pin_codes" placeholder="Pin Code" name="pin_code" id="pin_code"  required  minlength ='6' maxlength='6'  value="<?php if($user_data->pin_code == '' || $user_data->pin_code == 0){}else{echo $user_data->pin_code ;}?>" autocomplete="off"/>
                <span id="pin_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">Contact Number should be minimum  10 digit</span>
              </li>
            </ul>
            
            
            <h3 class="col-form-label">Temporary Address
              <div class="custom-control custom-checkbox custom-control-inline titleCheck">
                <input type="checkbox" id="sameAbove" class="custom-control-input" checked/>
                <label class="custom-control-label" for="sameAbove">Same as above</label>
              </div>
            </h3>
            <div id="temporaryAddress" class="hidden">
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Address Line 1</label>
                <input type="text" class="form-control" placeholder="Address Line 1" name="tmp_address_1" id="tmp_address_1" value="<?php if($user_data->tmp_address_1 == ''){}else{echo $user_data->tmp_address_1 ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Address Line 2</label>
                <input type="text" class="form-control" placeholder="Address Line 2" name="tmp_address_2" id="tmp_address_2"  value="<?php if($user_data->tmp_address_2 == ''){}else{echo $user_data->tmp_address_2 ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Address Line 3</label>
                <input type="text" class="form-control"  placeholder="Address Line 3" name="tmp_address_3" id="tmp_address_3"  value="<?php if($user_data->tmp_address_3 == ''){}else{echo $user_data->tmp_address_3 ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">State</label>
             
                <select class="form-control" name="tmp_state" id="tmp_state">
                     <option value="">Select</option>
                  <?php foreach($state as $states){?>
                  <option value="<?php echo $states->id ;?>"<?php if($user_data->tmp_state == ''){}elseif($user_data->tmp_state == $states->id){ echo 'selected="selected"'; } ?>><?php echo $states->state_name ;?></option>
                  <?php } ?>
                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">City</label>
                <select class="form-control" name="tmp_city" id="tmp_city">
                  <option value="">Select</option>                 
                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Pin Code</label>
                <input type="text" class="form-control pin_codes" placeholder="Pin Code" name="tmp_pin_code" id="tmp_pin_code"  value="<?php if($user_data->tmp_pin_code == '' || $user_data->tmp_pin_code == 0){}else{echo $user_data->tmp_pin_code ;}?>"  autocomplete="off" minlength ='6' maxlength='6' />
                
              </li>
            </ul>
            </div>
          </fieldset>
        <?php } ?>		  
		  <?php 
			  if($user_data->i_am=='company'){
			  ?>
          <fieldset id="fillcompany">
            <h3 class="col-form-label">Company Details</h3>
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Associated Companies</label>
                <input type="text" class="form-control" placeholder="Associated Companies" required   name="associated_companies" id="associated_companies" value="<?php if($user_data->associated_companies == ''){}else{echo $user_data->associated_companies ;}?>" autocomplete="off" />
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Company Name</label>
                <input type="text" class="form-control" placeholder="Company Name" required  name="company_name" id="company_name" value="<?php if($user_data->company_name == ''){}else{echo $user_data->company_name ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Company Address Line 1</label>
                <input type="text" class="form-control" placeholder="Company Address Line 1" required  name="company_address_1" id="company_address_1" value="<?php if($user_data->company_address_1 == ''){}else{echo $user_data->company_address_1 ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">Company Address Line 2</label>
                <input type="text" class="form-control" placeholder="Company Address Line 2" required  name="company_address_2" id="company_address_2" value="<?php if($user_data->company_address_2 == ''){}else{echo $user_data->company_address_2 ;}?>" autocomplete="off"/>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">State</label>
               
                <select class="form-control" name="company_state" id="company_state" required>
                   <option value="">Select</option>
                  <?php foreach($state as $states){?>
                  <option value="<?php echo $states->id ;?>"<?php if($user_data->company_state == ''){}elseif($user_data->company_state == $states->id){ echo 'selected="selected"'; } ?>><?php echo $states->state_name ;?></option>
                  <?php } ?>
                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">City</label>
                
                <select class="form-control" name="company_city" id="company_city" required>
                  <option value="">Select</option>                
                </select>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <label class="col-form-sublabel">Pin Code</label>
                <!-- <input type="number" class="form-control" placeholder="Pin Code" name="company_pin_code" id="company_pin_code" value="<?php if($user_data->company_pin_code == '' || $user_data->company_pin_code ==0){}else{echo $user_data->company_pin_code ;}?>" /> -->
                <input type="text" class="form-control pin_codes" required  placeholder="Pin Code" autocomplete="off" name="company_pin_code" id="company_pin_code" value="<?php if($user_data->company_pin_code=='' || $user_data->company_pin_code==0){}else{echo $user_data->company_pin_code;} ?>" minlength ='6' maxlength='6' />
                <span id="comp_pin_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">Contact Number should be minimum  10 digit</span>
              </li>
            </ul>
          </fieldset>
		  <?php } ?>
		  
          <fieldset id="fillpreferences">
            <h3 class="col-form-label">Preferences interest</h3>
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel">My Interset <small class="text-default font-italic">(e.g. racing, climbing)</small></label>
                <input name="interest[]" required  id="interset" type="text" class="form-control" placeholder="Type an interest"   />
                  <input id="intersetCheckbox" type="checkbox" name="interset-checkbox" class="lowKey" required />   
              <!-- <select id="interset" name="interest[]" class="form-control ignore" placeholder="Select themes" multiple data-rule-required="true">
                  <?php
					foreach($myInterestData as $interest):
					$themesIds = explode(',',$draftData->itinerary_theme);
				   if(in_array($themes->id,$themesIds)){
					   $selected = 'selected';
					   }
					  else{
						   $selected = '';
						  } 
					?>
				<option value="<?php echo $interest->id;?>" <?php echo $selected;?>><?php echo $interest->interest_name;?></option>
               <?php endforeach;?>
              </select>--> 
   
              </li>
              <?php 
              if($user_data->services_offered == ''){

              }else{
                  $services = explode(',',$user_data->services_offered);
                  $services1 = explode(',',$user_data->services_offered);
                  $service = array_combine($services, $services1);
				  
              }
              ?>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel d-block mb-3">Services Offered</label>
                <div class="custom-control custom-checkbox custom-control-inline valign">
                                  <label>

                  <input type="checkbox"  name="services_offered[]" required id="walksRadioInput" class="custom-control-input" value="Walk"<?php if(isset($service['Walk'])){echo "checked";} ?> />
                  <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 40 37" style="enable-background:new 0 0 40 37;" xml:space="preserve">
                  <path class="st0" d="M9,8c2.4-0.4,6.1,0,6.8,2.8c0.6,2.5-1.3,4.9-1.6,7.3c-0.2,1.9,0.2,3.6,0.7,5.4c0.3,0.9,0.4,2-0.5,2.7
  c-0.8,0.6-2.2,0.7-3.2,0.5c-2.2-0.4-2.1-2.6-2.3-4.4c-0.3-2.7-1.7-4.8-2.4-7.4C5.6,12.3,5.7,8.8,9,8c1-0.2,0.6-1.8-0.4-1.5
  C3,7.9,4.2,14.1,6,18c0.7,1.5,1.2,3,1.4,4.7C7.5,23.8,7.5,25,8,26c0.6,1.2,1.7,2.1,3,2.3c2.3,0.5,5.3-0.4,5.8-3
  c0.1-0.8,0-1.6-0.3-2.4c-0.3-1.2-0.7-2.5-0.7-3.8c0-1.8,0.8-3.2,1.3-4.9c0.7-2.2,0.5-4.7-1.3-6.4C14,6.3,10.9,6.1,8.6,6.5
  C7.6,6.7,8,8.2,9,8z"/>
                  <path class="st0" d="M5.8,5.1c0.1,0.3,0.1,0.6-0.2,0.8C5.3,6.1,5,5.8,4.9,5.5C4.6,4.8,5.5,4.4,5.8,5.1c0.2,0.4,0.5,0.7,1,0.6
  c0.4-0.1,0.7-0.6,0.6-1c-0.5-1-1.5-1.8-2.7-1.5C3.5,3.6,3.1,4.9,3.4,6C3.7,7,4.9,7.8,6,7.5c1.2-0.3,1.7-1.6,1.3-2.8
  C7,3.7,5.5,4.2,5.8,5.1z"/>
                  <path class="st0" d="M10.2,3.4c0,0.5-0.1,1.1-0.6,1.2c-0.5,0.1-0.9-0.4-1-0.9c0-0.5,0.2-1,0.7-1.1c0.6-0.1,0.9,0.5,0.9,1
  c0.2,1,1.7,0.6,1.5-0.4C11.6,1.9,10.4,0.8,9,1C7.7,1.2,6.9,2.6,7,3.8c0.2,1.3,1.2,2.4,2.6,2.3s2.3-1.4,2.2-2.8
  C11.8,2.4,10.2,2.4,10.2,3.4z"/>
                  <path class="st0" d="M15,3.6c0,0.5-0.1,1-0.6,1.1s-0.9-0.4-1-0.9c0-0.5,0.2-1,0.7-1c0.6-0.1,0.9,0.5,0.9,1c0.2,1,1.7,0.6,1.5-0.4
  c-0.2-1.3-1.4-2.4-2.8-2.1c-1.3,0.2-2.1,1.5-2,2.8c0.2,1.3,1.2,2.4,2.6,2.3s2.3-1.4,2.2-2.7C16.5,2.6,14.9,2.6,15,3.6z"/>
                  <path class="st0" d="M19.5,6.4c-0.2,0.4-0.7,1.2-1.3,1c-0.6-0.2-0.4-1.2-0.2-1.6c0.2-0.4,0.7-1.1,1.2-1C19.9,4.9,19.7,6,19.5,6.4
  c-0.4,0.9,1,1.7,1.4,0.8c0.6-1.3,0.6-3.1-0.9-3.8c-1.4-0.6-2.8,0.4-3.4,1.6S16,8.1,17.4,8.8s2.9-0.4,3.5-1.6
  C21.4,6.3,20,5.5,19.5,6.4z"/>
                  <path class="st0" d="M3.2,8.4c0.1,0.2,0.2,0.6,0,0.8S2.7,9.1,2.6,8.9c-0.1-0.2-0.2-0.6,0-0.7C2.9,8,3.2,8.4,3.3,8.6
  c0.5,0.9,1.8,0.1,1.4-0.8C4.1,6.9,3,6.2,1.9,6.8c-1,0.5-1.2,1.8-0.8,2.7c0.4,1,1.5,1.6,2.6,1.2C4.8,10.3,5.1,9,4.7,8
  c-0.2-0.4-0.5-0.7-1-0.6C3.4,7.6,3,8,3.2,8.4z"/>
                  <path class="st0" d="M31.4,14.2c-4.2-0.9-9.4,0.6-9.1,5.7c0.1,1.3,0.6,2.4,1,3.7c0.5,1.6,0.4,3.2,0.1,4.8c-0.3,1.1-0.9,2.2-1,3.4
  c-0.2,2.9,2.4,4.1,4.9,4.1c1.2,0,2.3-0.4,3.1-1.3c1.7-1.8,1.3-4.6,2-6.8c1-2.9,2.9-5.3,2.9-8.5C35.4,16.8,33.7,14.9,31.4,14.2
  c-1-0.3-1.4,1.2-0.4,1.5c3.2,0.9,3.1,4.2,2.3,6.9c-0.9,2.6-2.4,4.8-2.9,7.6c-0.3,1.7-0.4,3.8-2.5,4.2c-1,0.2-2.4,0.1-3.3-0.7
  C23.8,33,24,32,24.3,31c0.1-0.2,0.5-1.3,0.6-1.8c0.3-1.1,0.4-2.2,0.4-3.3c-0.1-2.5-1.9-4.9-1.2-7.4c0.7-3,4.5-3.1,7-2.6
  C32,15.9,32.4,14.4,31.4,14.2z"/>
                  <path class="st0" d="M32.8,12.5c-0.4,1.1,0.1,2.4,1.2,2.8c1.1,0.4,2.2-0.3,2.6-1.3c0.4-1,0.1-2.3-1-2.8s-2.3,0.1-2.8,1.1
  c-0.4,0.9,0.9,1.7,1.4,0.8c0.1-0.3,0.3-0.6,0.7-0.5c0.3,0.1,0.4,0.5,0.3,0.8c-0.1,0.3-0.4,0.5-0.7,0.4c-0.4-0.1-0.3-0.6-0.2-0.9
  C34.7,11.9,33.1,11.5,32.8,12.5z"/>
                  <path class="st0" d="M28.4,10.9c-0.2,1.3,0.7,2.7,2.1,2.8c1.3,0.1,2.5-0.9,2.7-2.2s-0.5-2.6-1.9-2.9c-1.4-0.3-2.6,0.8-2.9,2.1
  c-0.2,1,1.3,1.4,1.5,0.4c0.1-0.5,0.4-1,0.9-0.9c0.6,0,0.8,0.7,0.7,1.2c-0.1,0.5-0.5,0.9-1,0.8c-0.6-0.1-0.7-0.8-0.6-1.2
  C30.1,9.9,28.5,9.9,28.4,10.9z"/>
                  <path class="st0" d="M23.6,10.9c-0.2,1.3,0.7,2.6,2.1,2.8c1.3,0.1,2.5-0.9,2.7-2.2s-0.6-2.6-1.9-2.9c-1.4-0.3-2.6,0.7-2.9,2
  c-0.2,1,1.3,1.4,1.5,0.4c0.1-0.5,0.4-1,0.9-0.9s0.8,0.7,0.7,1.1c-0.1,0.5-0.5,0.9-1,0.8c-0.6-0.1-0.7-0.7-0.6-1.2
  C25.3,9.9,23.7,9.9,23.6,10.9z"/>
                  <path class="st0" d="M19.2,14.3c0.6,1.2,1.8,2.3,3.2,1.8c1.5-0.5,1.7-2.5,1.1-3.7c-0.5-1.2-1.8-2.3-3.2-1.9
  c-1.5,0.5-1.7,2.4-1.3,3.7c0.4,0.9,1.9,0.5,1.5-0.4c-0.2-0.4-0.4-1.5,0.2-1.7c0.6-0.3,1.1,0.6,1.3,1c0.2,0.4,0.4,1.5-0.3,1.6
  c-0.6,0.1-1.1-0.7-1.3-1.1C20.1,12.6,18.7,13.4,19.2,14.3z"/>
                  <path class="st0" d="M35.3,15.7c-0.5,1-0.4,2.3,0.7,2.9c1,0.5,2.2-0.1,2.7-1s0.4-2.3-0.7-2.8C37,14.2,35.9,14.8,35.3,15.7
  c-0.5,0.9,0.9,1.7,1.4,0.8c0.1-0.2,0.3-0.5,0.6-0.4s0.2,0.5,0.1,0.7c-0.1,0.2-0.3,0.5-0.6,0.4s-0.2-0.5-0.1-0.7
  c0.2-0.4,0.1-0.9-0.3-1.1C36.1,15.2,35.5,15.3,35.3,15.7z"/>
                  </svg></span>
                  <label class="custom-control-label" for="walksRadioInput">Walks</label>
                  </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline valign">
                                <label>

                  <input type="checkbox" name="services_offered[]" id="sessionsRadioInput" class="custom-control-input" value="Session"<?php if(isset($service['Session'])){echo "checked";} ?>>
                  <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 40 33" style="enable-background:new 0 0 40 33;" xml:space="preserve">
                  <path class="st0" d="M8.1,2.6c2.2,0.3,4.5,0.5,6.7,0.8c2.2,0.3,5.6,0.1,7.4,1.8c2.1,2,1.7,5,1.7,7.7c0,3,0,6,0,9.1
  c0,2.8,0.2,6.1-2.6,7.7c-2,1.1-5.3,0-7.4-0.4c-2.3-0.4-4.6-0.6-6.9-1.1c-3.6-0.8-4-4.3-4-7.4c0-3.3,0-6.7,0-10
  C3.1,7.3,3.4,2.3,8.1,2.6c1.2,0.1,1.2-1.8,0-1.9c-8.6-0.6-6.9,11.7-6.9,17c0,2.7-0.4,5.9,0.8,8.5c1.6,3.4,4.6,3.7,7.9,4.3
  c2.9,0.5,5.7,1,8.6,1.4c4.4,0.6,7.3-3.3,7.4-7.4c0.1-2.7,0-5.4,0-8.2c0-2.6,0.3-5.5-0.1-8.1c-0.4-2.4-1.8-4.7-4.1-5.7
  c-1.1-0.5-2.5-0.5-3.7-0.7c-3.3-0.4-6.5-0.8-9.8-1.2C6.9,0.6,6.9,2.5,8.1,2.6z"/>
                  <path class="st0" d="M18.6,16.4c-0.1,2.8-1.5,6.9-5,6.9c-3.4,0-5-4-5-6.9s1.6-6.9,5-6.9C17,9.5,18.5,13.5,18.6,16.4
  c0,1.2,1.9,1.2,1.9,0c-0.1-3.9-2.3-8.7-6.9-8.8c-4.5,0-6.9,4.9-6.9,8.8c0,3.9,2.4,8.8,6.9,8.8c4.5,0,6.8-4.9,6.9-8.8
  C20.5,15.2,18.6,15.2,18.6,16.4z"/>
                  <ellipse class="st0" cx="13.6" cy="16.4" rx="2.8" ry="3.7"/>
                  <path class="st0" d="M13.1,3.2c3.8,2.9,7.6,5.7,11.4,8.6c1,0.7,1.9-0.9,1-1.6C21.6,7.3,17.8,4.4,14,1.5C13.1,0.8,12.1,2.4,13.1,3.2
  L13.1,3.2z"/>
                  <path class="st0" d="M21.8,31.5c2-0.3,4.1-0.6,6.1-0.9c2-0.3,4.2-0.3,6.1-1.1c5.6-2.2,4.7-8.7,4.7-13.5c0-5,0.9-11.6-4.7-14.2
  c-1.5-0.7-3.1-0.7-4.7-0.7c-2.4-0.1-4.7-0.1-7.1-0.2c-4.7-0.1-9.4-0.2-14.2-0.3c-1.2,0-1.2,1.9,0,1.9c7.6,0.2,15.1,0.2,22.7,0.5
  c3,0.1,5.3,2.1,5.9,5.1c0.3,1.7,0.1,3.6,0.1,5.3c0,2.4,0,4.8,0,7.2c0,2.6-0.3,5.2-2.7,6.7c-1.8,1.1-4.7,1.1-6.7,1.4
  c-2,0.3-4.1,0.6-6.1,0.9C20.1,29.9,20.6,31.7,21.8,31.5L21.8,31.5z"/>
                  <path class="st0" d="M24.9,10.6c4.3,0,8.6-0.1,12.9-0.1c1.2,0,1.2-1.9,0-1.9c-4.3,0-8.6,0.1-12.9,0.1C23.7,8.7,23.7,10.6,24.9,10.6
  L24.9,10.6z"/>
                  <path class="st1" d="M24.9,24.6"/>
                  <path class="st0" d="M24.9,22.5c4.3-0.4,8.6-0.7,12.9-1.1c1.2-0.1,1.2-2,0-1.9c-4.3,0.4-8.6,0.7-12.9,1.1
  C23.7,20.7,23.7,22.6,24.9,22.5L24.9,22.5z"/>
                  <path class="st0" d="M28.7,9.6c0,3.8,0,7.7,0,11.5c0,0.5,0.4,1,0.9,0.9c1.4-0.1,2.8-0.2,4.3-0.4c0.5,0,0.9-0.4,0.9-0.9
  c0-3.8,0-7.5,0-11.3c0-0.5-0.4-1-0.9-0.9c-1.4,0-2.8,0.1-4.3,0.1c-1.2,0-1.2,1.9,0,1.9c1.4,0,2.8-0.1,4.3-0.1
  c-0.3-0.3-0.6-0.6-0.9-0.9c0,3.8,0,7.5,0,11.3c0.3-0.3,0.6-0.6,0.9-0.9c-1.4,0.1-2.8,0.2-4.3,0.4c0.3,0.3,0.6,0.6,0.9,0.9
  c0-3.8,0-7.7,0-11.5C30.6,8.4,28.7,8.4,28.7,9.6z"/>
                  </svg></span>
                  <label class="custom-control-label" for="sessionsRadioInput">Sessions</label></label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline valign">
                               <label>

                  <input type="checkbox" name="services_offered[]" id="experiencesRadioInput" class="custom-control-input" value="Experience"<?php if(isset($service['Experience'])){echo "checked";} ?>>
                  <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 36 40" style="enable-background:new 0 0 36 40;" xml:space="preserve">
                  <path d="M19.9,15.9c2.9,0,5.7,0,8.6,0c1.4,0,3-0.2,4.1,0.7c1.2,1,0.7,1.7,0.5,2.9c-0.8,3.3-1.5,6.7-2.3,10c-0.5,2.2-0.6,6.5-3.2,7.4
  c-0.9,0.3-2,0.2-2.9,0.2c-1.6,0-3.2,0-4.8,0c-3.3,0-6.5,0-9.8,0c-1.4,0-2.9-0.1-3.4-1.6c-0.3-0.8-0.4-1.7-0.6-2.5
  c-0.8-3.5-1.5-7-2.3-10.4c-0.3-1.4-0.8-2.8-0.9-4.2c-0.2-1.8,1.7-2.4,3.3-2.5c3.1-0.1,6.3,0,9.4,0c1.2,0,1.2-1.8,0-1.8
  c-3.2,0-6.3-0.1-9.5,0c-2,0-4.1,0.7-4.9,2.7c-0.4,1.1-0.1,1.9,0.1,2.9c0.8,3.8,1.7,7.6,2.5,11.4c0.6,2.8,0.7,6.8,4,7.7
  c1,0.3,2.2,0.2,3.3,0.2c1.9,0,3.8,0,5.7,0c3.1,0,6.3,0.1,9.4,0c2.2-0.1,4.4-1.1,5-3.4c0.3-0.9,0.4-1.9,0.6-2.8
  c0.9-3.9,1.8-7.8,2.6-11.6c0.2-1,0.7-2.2,0.7-3.3c-0.1-2.5-2.8-3.7-4.9-3.8c-3.4-0.1-6.9,0-10.4,0C18.7,14.1,18.7,15.9,19.9,15.9
  L19.9,15.9z"/>
                  <path d="M18.1,18.3c-1.6,0-0.9-6.4-0.9-7.3c0-1.6,0-3.1,0-4.7c0-0.5,0-1,0-1.5c0-0.7-0.1-1.2,0.9-1.2c1,0,0.8,0.4,0.9,1.1
  c0,0.5,0,1,0,1.5c0,1.5,0,3.1,0,4.6s0,3.1,0,4.6c0,1.1,0.4,2.7-1.1,2.9c-1.2,0.2-0.7,1.9,0.5,1.8c3.2-0.4,2.5-4.4,2.5-6.7
  c0-3,0.1-6.1,0-9.1c-0.2-3.6-5.2-3.8-5.4-0.1c-0.2,2.8,0,5.7,0,8.5c0,2.3-0.9,7.4,2.7,7.4C19.2,20.1,19.2,18.3,18.1,18.3z"/>
                  <path d="M2.4,21.3c9.1,0,18.2,0,27.4,0c1.3,0,2.7,0,4,0c1.2,0,1.2-1.8,0-1.8c-9.1,0-18.2,0-27.4,0c-1.3,0-2.7,0-4,0
  C1.2,19.5,1.2,21.3,2.4,21.3L2.4,21.3z"/>
                  <path d="M3.5,26.3c9.5,0,18.9,0,28.4,0c1.2,0,1.2-1.8,0-1.8c-9.5,0-18.9,0-28.4,0C2.3,24.4,2.3,26.3,3.5,26.3L3.5,26.3z"/>
                  <path d="M4.6,31.2c9,0,17.9,0,26.9,0c1.2,0,1.2-1.8,0-1.8c-9,0-17.9,0-26.9,0C3.4,29.4,3.4,31.2,4.6,31.2L4.6,31.2z"/>
                  <path d="M5.6,35.9c8.3,0,16.5,0,24.8,0c1.2,0,1.2-1.8,0-1.8c-8.3,0-16.5,0-24.8,0C4.4,34.1,4.4,35.9,5.6,35.9L5.6,35.9z"/>
                  <circle cx="18.1" cy="19.2" r="3.5"/>
                  <path d="M5.8,14.7c-0.3-1.9,0.3-3.9,2.1-4.7c0.3-0.1,0.5-0.5,0.5-0.8c0-1.5,0-3,0-4.5C8,5,7.7,5.3,7.4,5.6c1.4,0,2.7,0,4.1,0
  c-0.3-0.3-0.6-0.6-0.9-0.9c0,1.6,0,3.1,0,4.7c0,0.5,0.4,0.9,0.9,0.9c1.7,0.1,1.8,3.2,1.6,4.6c-0.1,1.2,1.7,1.2,1.8,0
  c0.3-2.5-0.2-6.3-3.4-6.5c0.3,0.3,0.6,0.6,0.9,0.9c0-1.6,0-3.1,0-4.7c0-0.5-0.4-0.9-0.9-0.9c-1.4,0-2.7,0-4.1,0
  c-0.5,0-0.9,0.4-0.9,0.9c0,1.5,0,3,0,4.5C6.6,9,6.8,8.7,6.9,8.4C4.4,9.6,3.6,12.6,4,15.2C4.2,16.4,6,15.9,5.8,14.7L5.8,14.7z"/>
                  <path d="M11.5,3.8c-0.9,0-1.9,0-2.8,0c-0.3,0-1.2,0.2-1.5,0C7.1,3.7,6.9,3.1,7.1,2.9c0.1-0.1,0.7,0,0.9,0c0.6,0,1.3,0,1.9,0
  c0.3,0,1.2-0.2,1.5,0c0.2,0.1,0.3,0.8-0.1,0.9c-1.2,0.2-0.7,1.9,0.5,1.8c2.3-0.4,2.1-4.3-0.2-4.5C10.1,1,8.4,0.9,7,1.1
  C4.7,1.4,4.7,5.3,7,5.6c1.5,0.2,3.1,0,4.6,0C12.7,5.6,12.7,3.8,11.5,3.8z"/>
                  <path d="M7.4,8.3c1.4,0,2.7,0,4.1,0c1.2,0,1.2-1.8,0-1.8c-1.4,0-2.7,0-4.1,0C6.2,6.4,6.2,8.3,7.4,8.3L7.4,8.3z"/>
                  <path d="M22.9,14.7c-0.3-1.9,0.3-3.9,2.1-4.7c0.3-0.1,0.5-0.5,0.5-0.8c0-1.5,0-3,0-4.5c-0.3,0.3-0.6,0.6-0.9,0.9c1.4,0,2.7,0,4.1,0
  c-0.3-0.3-0.6-0.6-0.9-0.9c0,1.6,0,3.1,0,4.7c0,0.5,0.4,0.9,0.9,0.9c1.7,0.1,1.8,3.2,1.6,4.6c-0.1,1.2,1.7,1.2,1.8,0
  c0.3-2.5-0.2-6.3-3.4-6.5c0.3,0.3,0.6,0.6,0.9,0.9c0-1.6,0-3.1,0-4.7c0-0.5-0.4-0.9-0.9-0.9c-1.4,0-2.7,0-4.1,0
  c-0.5,0-0.9,0.4-0.9,0.9c0,1.5,0,3,0,4.5C23.7,9,23.9,8.7,24,8.4c-2.6,1.2-3.4,4.1-2.9,6.8C21.3,16.4,23.1,15.9,22.9,14.7L22.9,14.7
  z"/>
                  <path d="M28.6,3.8c-0.9,0-1.9,0-2.8,0c-0.3,0-1.2,0.2-1.5,0c-0.1-0.1-0.3-0.7-0.1-0.9c0.1-0.1,0.7,0,0.9,0c0.6,0,1.3,0,1.9,0
  c0.3,0,1.2-0.2,1.5,0c0.2,0.1,0.3,0.8-0.1,0.9c-1.2,0.2-0.7,1.9,0.5,1.8c2.3-0.4,2.1-4.3-0.2-4.5c-1.4-0.1-3.1-0.2-4.6,0
  c-2.3,0.3-2.3,4.2,0,4.5c1.5,0.2,3.1,0,4.6,0C29.8,5.6,29.8,3.8,28.6,3.8z"/>
                  <path d="M24.5,8.3c1.4,0,2.7,0,4.1,0c1.2,0,1.2-1.8,0-1.8c-1.4,0-2.7,0-4.1,0C23.3,6.4,23.3,8.3,24.5,8.3L24.5,8.3z"/>
                  </svg></span>
                  <label class="custom-control-label" for="experiencesRadioInput">Experiences</label>
                  </label>
                </div>
                <div class="custom-control custom-checkbox custom-control-inline valign">
                               <label>

                  <input type="checkbox" name="services_offered[]" id="meetRadioInput" class="custom-control-input" value="Meet-Up"<?php if(isset($service['Meet-Up'])){echo "checked";} ?>>
                  <span class="control-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 34 40" style="enable-background:new 0 0 34 40;" xml:space="preserve">
                  <path d="M7.1,14.9c-0.2,3-4.7,3.1-4.7,0C2.3,11.9,6.9,11.9,7.1,14.9c0.1,1,1.6,1,1.5,0C8.5,12.8,6.9,11,4.7,11
  c-2.1,0-3.9,1.8-3.9,3.9c0,2.1,1.7,3.8,3.7,3.9c2.3,0.1,4-1.7,4.1-3.9C8.7,14,7.1,14,7.1,14.9z"/>
                  <path d="M4.3,21.1c1.3-1,1.3,1.1,1.3,1.7c0,1,0,1.9,0,2.9c0,1.3-0.3,2.8,0.8,3.8c1.1,0.9,3,0.6,4.4,0.6c0.5,0,1.3-0.1,1.8,0
  c1.1,0.3,0.9,1,0.9,1.7c0,1.4,0.2,3.1,0,4.5c-0.3,1.6-2.1,1.2-2.3-0.2c-0.1-0.7,0.1-1.5,0-2.2c-0.3-1.7-1.8-2-3.3-2
  c-1.2,0-3.5,0.5-4-1c-0.2-0.5,0-1.4,0-1.9c0-1,0-2.1,0-3.1C3.9,24.7,3.4,22,4.3,21.1C5,20.4,3.9,19.3,3.2,20
  c-1.2,1.2-0.9,3.2-0.9,4.8c0,1.9-0.1,3.9,0,5.8c0.1,2,1.4,2.6,3.2,2.6c0.9,0,2-0.1,2.9,0c1.4,0.2,1.2,1.3,1.2,2.3
  c0,1,0.1,1.8,0.9,2.5c0.8,0.7,2,1,3,0.5c1.8-0.9,1.5-3.2,1.5-4.9c0-1.6,0.5-4.2-1.4-5c-1.7-0.8-3.8,0.2-5.5-0.2
  c-1.3-0.3-1.1-1.3-1.1-2.2c0-1.2,0-2.4,0-3.7c0-0.9-0.1-1.7-0.7-2.4c-0.9-0.9-2.2-0.9-3.2-0.1C2.4,20.6,3.5,21.7,4.3,21.1z"/>
                  <path d="M25.2,15c0.1,2.1,1.7,3.9,3.9,3.9c2.1,0,3.9-1.8,3.9-3.9c0-2.1-1.7-3.8-3.7-3.9C27,11,25.3,12.8,25.2,15c-0.1,1,1.5,1,1.5,0
  c0.2-3,4.7-3.1,4.7,0c0,3.1-4.6,3-4.7,0C26.7,14,25.1,14,25.2,15z"/>
                  <path d="M30.6,20c-1.9-1.5-3.9,0.1-4,2.2c0,0.9,0,1.9,0,2.9c0,0.8,0.2,1.8,0,2.5c-0.3,1.2-1.6,0.9-2.4,0.9c-1,0-2-0.1-3,0
  c-2.1,0.1-2.5,1.8-2.5,3.5c0,1.6-0.5,4.1,0.4,5.6c1.2,1.9,4.3,1.6,4.9-0.7c0.2-0.8-0.1-1.8,0.1-2.6c0.3-1.4,1.6-1,2.6-1
  c1.8,0,4.3,0.3,4.7-2c0.3-1.8,0-3.9,0-5.8C31.4,23.8,31.9,21.3,30.6,20c-0.7-0.7-1.8,0.4-1.1,1.1c0.8,0.8,0.4,3,0.4,4
  c0,1.6,0,3.3,0,4.9c0,0.7,0.2,1.3-0.8,1.6c-0.5,0.2-1.4,0-1.9,0c-1.3,0-3.1-0.3-4,0.8c-1.1,1.2,0.2,3.9-1.4,4.6
  c-2,0.9-1.5-3.2-1.5-4.1c0-1.4-0.4-3.1,1.5-3.1c1.4,0,3,0.2,4.4,0c2-0.4,2-2.1,2-3.7c0-1,0-2,0-2.9c0-0.5-0.2-3.3,1.3-2.2
  C30.3,21.7,31.4,20.7,30.6,20z"/>
                  <path d="M22.2,25.3c-2.1,0-4.1,0-6.2,0c-1.2,0-2.5,0-3.7,0c-0.2,0-0.5,0-0.7,0c-1.4-0.2-1.5-2,0-2.3c0.6-0.1,1.3,0,1.9,0
  c1.4,0,2.9,0,4.3,0c1.2,0,2.3,0,3.5,0c0.3,0,0.5,0,0.8,0C23.5,23.2,23.8,25.1,22.2,25.3c-1,0.1-1,1.6,0,1.5c3.4-0.3,3.4-5.2,0-5.4
  c-2.5-0.1-5.1,0-7.6,0c-2.1,0-5.4-0.4-5.5,2.6c-0.1,3,3,2.8,5,2.8c2.7,0,5.4,0,8.2,0C23.2,26.8,23.2,25.3,22.2,25.3z"/>
                  <path d="M16.9,38.4L16.9,38.4c-0.3,0-0.5-0.2-0.5-0.5V26.6c0-0.3,0.2-0.5,0.5-0.5h0c0.3,0,0.5,0.2,0.5,0.5v11.3
  C17.4,38.1,17.2,38.4,16.9,38.4z"/>
                  <path d="M9.6,9.6c1.9,0.4,4.2,0.2,6.1,0.1c3-0.1,3.2-2.8,3.1-5.2c0-1.3-0.5-2.4-1.7-3.1c-0.9-0.4-1.9-0.3-2.8-0.3
  c-2.1,0-5.2-0.6-6.5,1.5C7.2,3.7,7.3,5.2,7.4,6.4c0,0.5,0.2,0.9,0.1,1.4C7.4,8.3,7.1,8.9,7,9.4c-0.2,0.5,0.4,1.2,0.9,0.9
  c0.7-0.3,1.4-0.5,2.1-0.8c0.9-0.4,0.5-1.8-0.4-1.5C8.9,8.3,8.2,8.6,7.5,8.9c0.3,0.3,0.6,0.6,0.9,0.9C8.7,9,9.2,8.2,9.1,7.4
  c-0.1-1-0.3-2.1-0.2-3.1c0.2-1.7,1.5-1.6,2.7-1.6c1.2,0,2.4-0.1,3.6,0c0.4,0,0.9,0,1.3,0.2c0.8,0.5,0.8,1.2,0.8,2
  c0,1.3,0.3,3.1-1.5,3.3c-1,0.1-2,0-2.9,0c-0.9,0-1.9,0.1-2.8-0.1C9,7.8,8.6,9.3,9.6,9.6z"/>
                  <path d="M10.9,5.1c1.6,0,3.1,0,4.7,0c1,0,1-1.5,0-1.5c-1.6,0-3.1,0-4.7,0C9.9,3.6,9.9,5.1,10.9,5.1L10.9,5.1z"/>
                  <path d="M10.9,7.1c1,0,2.1,0,3.1,0c1,0,1-1.5,0-1.5c-1,0-2.1,0-3.1,0C9.9,5.5,9.9,7.1,10.9,7.1L10.9,7.1z"/>
                  <path d="M23.2,18.6c1,0,1-1.5,0-1.5C22.2,17,22.2,18.6,23.2,18.6L23.2,18.6z"/>
                  <path d="M21.6,18.6c-0.9,0.2-1.8,0.1-2.7,0.1c-1.2,0-2.4,0-3.5,0c-1.6-0.1-2.3-0.9-2.3-2.4c0-1.2-0.3-3,0.8-3.8
  c0.8-0.6,2-0.4,2.9-0.4c1.2,0,2.4,0,3.6,0c1.5,0,2.4,0.6,2.5,2.2c0.1,1.1,0.2,2.4-0.2,3.4c-0.1,0.3,0,0.5,0.2,0.8
  c0.4,0.5,0.9,1.1,1.3,1.6c0.2-0.4,0.4-0.9,0.5-1.3c-1-0.1-2-0.1-2.9-0.2c-1-0.1-1,1.5,0,1.5c1,0.1,2,0.1,2.9,0.2
  c0.7,0.1,0.9-0.8,0.5-1.3c-0.4-0.5-0.9-1.1-1.3-1.6c0.1,0.3,0.1,0.5,0.2,0.8c0.4-1.1,0.3-2.4,0.3-3.6c0-1.3-0.3-2.6-1.5-3.4
  c-1.7-1.2-4.9-0.6-6.9-0.6c-1,0-2-0.1-3,0.5c-1.2,0.7-1.6,2-1.6,3.4c0,1.1-0.2,2.5,0.2,3.5c0.5,1.4,1.8,2.2,3.3,2.3
  c1.2,0.1,2.4,0,3.6,0c1.1,0,2.3,0.1,3.4-0.1C22.9,19.9,22.5,18.4,21.6,18.6z"/>
                  <path d="M20.9,13.4c-1.8,0-3.6,0-5.4,0c-1,0-1,1.5,0,1.5c1.8,0,3.6,0,5.4,0C21.9,14.9,21.9,13.4,20.9,13.4L20.9,13.4z"/>
                  <path d="M20.9,15.6c-1.2,0-2.4,0-3.6,0c-1,0-1,1.5,0,1.5c1.2,0,2.4,0,3.6,0C21.9,17.2,21.9,15.6,20.9,15.6L20.9,15.6z"/>
                  </svg></span>
                  <label class="custom-control-label" for="meetRadioInput">Meet-Ups</label>
                  </label>
                </div>
              </li>
              <li class="form-group col-12 col-md-6 pt-2 placeVaild">
                <label class="col-form-sublabel d-block mb-3">Preferred Cities</label>
                <small class="text-muted  d-block">Select Cities <em>(Max 3)</em></small>
                  <input id="preferred_cities" name="preferred_cities[]" type="text" class="form-control" placeholder="Select" required  />
                   <input id="preferred_citiesCheckbox" type="checkbox" name="preferred_cities-checkbox" class="lowKey" required />    
           </li>
              <li class="form-group col-12 placeVaild">
                <div class="form-row">
                  <div class="col-12 col-sm-6">
                    <label class="col-form-sublabel text-dbl">Have you hosted before?</label>
                  </div>
                  <div class="col-12 col-sm-6">
                    <div class="custom-control custom-radio custom-control-inline">
                      <input type="radio" value="Yes" id="yesCheckInput" name="host_before" required class="custom-control-input" <?php if( $user_data->host_before == ''){}else{echo set_radio('host_before', 'Yes', $user_data->host_before == 'Yes');}?>/>
                      <label class="custom-control-label" for="yesCheckInput">Yes</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline valign">
                      <input type="radio" id="noCheckInput" name="host_before" class="custom-control-input" value="No" <?php if( $user_data->host_before == ''){}else{echo set_radio('host_before', 'No', $user_data->host_before == 'No');}?>>
                      <label class="custom-control-label" for="noCheckInput">No</label>
                    </div>					
					
				<div class="form-group placeVaild host_before_text hidden">
                <label class="col-form-label">Note</label>
                <textarea class="form-control" placeholder="Write here (max 2000 characters)" data-rule-maxlength="2000" name="host_before_desc" required="" id="host_before_desc"><?php if(isset($user_data->host_before_note))echo $user_data->host_before_note;?></textarea>               
                  </div>	
                  </div>
                </div>
              </li>
			  
			  		  
            </ul>
            <h3 class="col-form-label">Languages</h3>
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                <div class="form-row">
                  <div class="col-12 col-sm-6">
                    <label class="col-form-sublabel">Preferred Languages <em>(To communicate with City Explorers)</em></label>
                  </div>
                  
                  <div class="col-12 col-sm-6">
                    <select class="form-control" name="preferred_languages" id="preferred_languages" required >
                      <option value="">Select</option>
					  <?php 
						  if(!empty($iwlLanguage)){							  
							  foreach($iwlLanguage as $value):
							  if($value->language_name==$user_data->preferred_languages){
								   $selected = 'selected';
								  }
							 else{
								 $selected = '';
								}	  
							  ?>
							  <option value="<?php echo $value->language_name;?>" <?php echo $selected;?> ><?php echo $value->language_name;?></option>
							  <?php
							 endforeach;
							}
						  ?>
                      <!--<option value="English"<?php //if( $user_data->preferred_languages == ''){}elseif($user_data->preferred_languages == "English"){ echo 'selected="selected"'; } ?>>English</option>
                      <option value="Hindi"<?php //if( $user_data->preferred_languages == ''){}elseif($user_data->preferred_languages == "Hindi"){ echo 'selected="selected"'; } ?>>Hindi</option>
                      <option value="Urdu"<?php //if( $user_data->preferred_languages == ''){}elseif($user_data->preferred_languages == "Urdu"){ echo 'selected="selected"'; } ?>>Urdu</option>-->
                    </select>
                  </div>
                </div>
              </li>
              <?php 
              if($user_data->known_languages == ''){

              }else{
                  $known_lang = explode(',',$user_data->known_languages);
                  $known_lang1 = explode(',',$user_data->known_languages);
                  $known_langs = array_combine($known_lang, $known_lang1);
                  $lang = array('English','Hindi','Urdu');
                 
                  $result = array_diff($known_lang , $lang);
              }
              ?>
              <li class="form-group col-12 placeVaild">
                <label class="col-form-sublabel d-block">Known Languages</label>
                <ul class="tagList">
				<?php 
				if(!empty($known_langs)){
					foreach($known_langs as $lang):	
						?>
					<li class="selected">
                      <label class="tagBox active">
                      <input type="checkbox" name="know_languages[]" value="<?php echo $lang;?>" checked />
                      <?php echo $lang;?></label>
                  </li>
					<?php endforeach;								
					}else{
					?>
                  <li class="selected">
                    <label class="tagBox active">
                      <input type="checkbox" name="know_languages[]" value="English" checked readonly />
                      English</label>
                  </li>
					<?php } ?>

                  <?php 
                 /*if(empty($result)){}else{
                  foreach($result as $res){ ?>
                    <li>
                    <label class="tagBox active">
                      <input type="checkbox" name="know_languages[]" value="<?php echo $res?>"<?php if(isset($res)){echo "checked";} ?> required />
                      <?php echo $res ;?></label>
                  </li>
                  <?php } }*/ ?>

                 
                  

                  <li id="knownLangTags"> <a href="#" class="text-uppercase " data-toggle="modal" data-target="#knownLanguagesModal">+Add More</a></li>
                </ul>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <h3 class="col-form-label">PLEDGE</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-6 placeVaild">
                <p class="font-weight-semibold text-light d-inline-block mb-0">Swachh Bharat <a href="<?php echo base_url('take_a_pledge');?>" target="_blank" class="d-block text-primary small">Please click here to take the pledge</a></p>
                <div class="custom-control custom-checkbox custom-control-inline align-bottom ml-3">
                  <input type="checkbox" id="yesToClean" class="custom-control-input" <?php if($user_data->swachh_bharat==1){echo 'checked="checked"';}?> name="swachh_bharat" value="1" required/>
                  <label class="custom-control-label" for="yesToClean">I agree</label>
              </div>
              </li>
              <li class="form-group col-12 col-md-6 placeVaild">
                <p class="font-weight-semibold text-light d-inline-block mb-0">Tourism <a href="<?php echo base_url('take_a_pledge');?>" target="_blank"  class="d-block text-primary small">Please click here to take the pledge</a></p>
                <div class="custom-control custom-checkbox custom-control-inline align-bottom ml-3">
                  <input type="checkbox" id="yesToTravel" class="custom-control-input" <?php if($user_data->tourism==1){echo 'checked="checked"';}?> name="tourism" value="1" required />
                  <label class="custom-control-label" for="yesToTravel">I agree</label>
                </div>
              </li>
            </ul>

    
          </fieldset>
          <fieldset>
            <h3 class="col-form-label">Adhaar Card</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-12">
                <div class="form-row">
                  <div class="col-12 col-sm-6 placeVaild">
                    <label class="col-form-sublabel">Adhaar Number</label>
                    <input type="text" class="form-control" placeholder="Adhaar Number" autocomplete="off" name="adhaar_number" id="adhaar_number" value="<?php if($user_data->adhaar_number == ''){}else{echo $user_data->adhaar_number ;}?>" required />
                  </div>
                  <div class="col-12 col-sm-6 text-right placeVaild">
                  <label class="dragBox text-left" for="fileInput-adhaar">
                  <div class="dragBox-icon"><img src="<?php if($user_data->adhaar_number_doc == ''){echo base_url("assets/img/icon/file.svg");}else{
                      echo base_url("assets/img/icon/filejpg.svg");
                    } ?>" alt="file" /></div>
                  <div class="dragBox-info">  <?php  if($user_data->adhaar_number_doc == ''){ ?>
                    <span>Click here to upload image</span>
                     <div class="infoShow">
                      <p class="text-primary">File Name</p>
                      <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
                   <?php }else{ ?>
                                                  <span style="display: none;">Drag file here or click to upload</span>

                           <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $user_data->adhaar_number_doc ?></p>
                      <!-- <small class="text-muted">000 KB</small> --><a href="" class="text-light text-uppercase clearDargbox" id="removeAdhaar">Remove</a></div>
                  <?php } ?>
                  </div>
                  </label>
                 <input type="file" id="fileInput-adhaar" class="form-control uploadDoc fileInput" name="adhaar_num_doc"  />
    <input type="hidden" class="checkValue" name="adhaar_doc" value="<?php if($user_data->adhaar_number_doc == ''){}else{echo $user_data->adhaar_number_doc ;}?>" id="removeAdhar"/>
	<input type="checkbox" name="adhaarImg" class="vaildValue hideInput" required >
                </div>
                </div>
              </li>
            </ul>
            <h3 class="col-form-label">PAN Card</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-12">
                <div class="form-row">
                  <div class="col-12 col-sm-6 placeVaild">
                    <label class="col-form-sublabel">Permanent Account Number</label>
                    <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="Permanent Account Number" name="pan_number" id="pan_number" required  value="<?php if( $user_data->pan_number == ''){}else{echo $user_data->pan_number ;}?>" />
                  </div>
                  <div class="col-12 col-sm-6 text-right placeVaild">
                 <label class="dragBox text-left" for="fileInput-pan">

                    <div class="dragBox-icon">
                      <img src="<?php if($user_data->pan_number_doc == ''){echo base_url("assets/img/icon/file.svg");}else{
                      echo base_url("assets/img/icon/filejpg.svg");
                    } ?>" alt="file" />
                  </div>
                    <div class="dragBox-info ">
                    
                   <?php  if($user_data->pan_number_doc == ''){ ?>
                    <span>Click here to upload image</span>
                     <div class="infoShow">
                      <p class="text-primary">File Name</p>
                      <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox" onclick="panRemove()">Remove</a></div>
                   <?php }else{ ?>
                              <span style="display: none;">Click here to upload image</span>
                           <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $user_data->pan_number_doc ?></p>
                      <!-- <small class="text-muted">000 KB</small> --><a href="#" class="text-light text-uppercase clearDargbox" onclick="panRemove()">Remove</a></div>
                  <?php } ?>
                    </div>
                    </label>

              
                <input type="file" id="fileInput-pan" class="form-control uploadDoc fileInput" name="pan_num_doc" value="<?php if($user_data->pan_number_doc == ''){}else{echo $user_data->pan_number_doc ;}?>"  />
      <input type="hidden" class="checkValue" name="pan_doc" value="<?php if($user_data->pan_number_doc == ''){}else{echo $user_data->pan_number_doc ;}?>" id="removepancard"/>

                                   <input type="checkbox" name="panImg" class="vaildValue hideInput" required='required' >
                  </div>
                </div>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <h3 class="col-form-label">Passport</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-12">
                <div class="form-row">
                  <div class="col-12 col-sm-6 placeVaild">
                    <label class="col-form-sublabel">Passport Number</label>
                    <input type="text" class="form-control text-uppercase" autocomplete="off" placeholder="Passport Number" name="passport_number" id="passport_number" value="<?php if( $user_data->passport_number == ''){}else{echo $user_data->passport_number ;}?>"  />
                  </div>
                  <div class="col-12 col-sm-6 text-right placeVaild">
                   <label class="dragBox text-left" for="fileInput-passport">
               
                    <div class="dragBox-icon">
                      <img src="<?php if($user_data->passport_number_doc == ''){echo base_url("assets/img/icon/file.svg");}else{
                      echo base_url("assets/img/icon/filejpg.svg");
                    } ?>" alt="file" />
                    </div>
                    <div class="dragBox-info">
                    <?php  if($user_data->passport_number_doc == ''){ ?>
                    <span>Click here to upload image</span>
                     <div class="infoShow">
                      <p class="text-primary">File Name</p>
                      <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
                   <?php }else{ ?>
                   <span style="display: none;">Click here to upload image</span>
                    <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $user_data->passport_number_doc ?></p>
                      <!-- <small class="text-muted">000 KB</small> --><a href="#" class="text-light text-uppercase clearDargbox" >Remove</a></div>
                  <?php } ?></div>
                    </label>
           
                <input id="fileInput-passport" type="file" class="form-control uploadDoc fileInput" value="<?php if($user_data->passport_number_doc == ''){}else{echo $user_data->passport_number_doc ;}?>" name="passport_num_doc" />
              <input type="hidden" class="checkValue" name="passport_doc" value="<?php if($user_data->passport_number_doc == ''){}else{echo $user_data->passport_number_doc ;}?>"/>
              <input type="checkbox" name="passportImg" class="vaildValue hideInput"  >

                  </div>
                </div>
              </li>
            </ul>
          </fieldset>
          <fieldset>
            <h3 class="col-form-label">Guide License</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-12">
                <div class="form-row">
                  <div class="col-12 col-sm-6 placeVaild">
                    <label class="col-form-sublabel">License Guide Number</label>
                    <input type="text" autocomplete="off" class="form-control" placeholder="License Guide Number" name="license_guide_number" id="license_guide_number" value="<?php if( $user_data->license_guide_number == ''){}else{echo $user_data->license_guide_number ;}?>"   />
                  </div>
                  <div class="col-12 col-sm-6 text-right placeVaild">
                  <label class="dragBox text-left" for="fileInput-license">
                   
                    <div class="dragBox-icon">
                      <img src="<?php if($user_data->license_guide_number_doc == ''){echo base_url("assets/img/icon/file.svg");}else{
                      echo base_url("assets/img/icon/filejpg.svg");
                    } ?>" alt="file" />
                    </div>
                    <div class="dragBox-info">
                    <?php  if($user_data->license_guide_number_doc == ''){ ?>
                    <span>Click here to upload image</span>
                     <div class="infoShow">
                      <p class="text-primary">File Name</p>
                      <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
                   <?php }else{ ?>
                     <span style="display: none;">Click here to upload image</span>
                           <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $user_data->license_guide_number_doc ?></p>
                      <!-- <small class="text-muted">000 KB</small> --><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
                  <?php } ?></div>
                    </label>
               <input type="file" id="fileInput-license" class="form-control uploadDoc fileInput" name="license_guide_num_doc" value="<?php if($user_data->license_guide_number_doc == ''){}else{echo $user_data->license_guide_number_doc ;}?>" />
               <input type="hidden" class="checkValue" name="license_guide_doc" value="<?php if($user_data->license_guide_number_doc == ''){}else{echo $user_data->license_guide_number_doc ;}?>" />
                   <input type="checkbox" name="licenseImg" class="vaildValue hideInput" >
                  </div>
                </div>
              </li>
            </ul>
            <h3 class="col-form-label">GST</h3>
            <ul class="form-row">
              <li class="form-group col-12 col-md-12">
                <div class="form-row">
                  <div class="col-12 col-sm-6 placeVaild">
                    <label class="col-form-sublabel">GST Pin</label>
					<?php 
						if($user_data->i_am=='company'){
							 $mandatoryClass ='required';
							}else{
							 $mandatoryClass ='';
							}
						?>
					
                    <input type="text" autocomplete="off" class="form-control text-uppercase" placeholder="GST Pin" name="gst_pin" id="gst_pin" value="<?php if( $user_data->gst_pin  == ''){}else{echo $user_data->gst_pin ;}?>" <?php echo $mandatoryClass;?> />
                  </div>
                  <div class="col-12 col-sm-6 text-right placeVaild">
                 <label class="dragBox text-left" for="fileInput-gst">
              
                    <div class="dragBox-icon">
                      <img src="<?php if($user_data->gst_pin_doc == ''){echo base_url("assets/img/icon/file.svg");}else{
                      echo base_url("assets/img/icon/filejpg.svg");
                    } ?>" alt="file" />
                    </div>
                    <div class="dragBox-info">
                     <?php  if($user_data->gst_pin_doc == ''){ ?>
                    <span>Click here to upload image</span>
                     <div class="infoShow">
                      <p class="text-primary">File Name</p>
                      <small class="text-muted">000 KB</small><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
                   <?php }else{ ?>
                      <span style="display: none;">Click here to upload image</span>

                           <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $user_data->gst_pin_doc ?></p>
                      <!-- <small class="text-muted">000 KB</small> --><a href="#" class="text-light text-uppercase clearDargbox">Remove</a></div>
                  <?php } ?></div>
                    </label>
                       
           
                       <input type="file" id="fileInput-gst" class="form-control uploadDoc fileInput" name="gst_pin_doc" value="<?php if($user_data->gst_pin_doc ==''){}else{echo $user_data->gst_pin_doc ;}?>"  />
         <input type="hidden" class="checkValue" name="gst_doc" value="<?php if($user_data->gst_pin_doc ==''){}else{echo $user_data->gst_pin_doc ;}?>" />

              <input type="checkbox" name="gstImg" class="vaildValue hideInput" <?php echo $mandatoryClass;?> >
               </div>
               </div>			  
             </li>
			 
           </ul>
          </fieldset>
         <?php if($user_data->i_am!=='company'){?>
		  <fieldset>
			  <h3 class="col-form-label">Terms &amp; Conditions</h3>
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                  <div class="custom-control custom-checkbox custom-control-inline titleCheck">
                <input type="checkbox" name="term_condition" value="1" id="term_policy" class="custom-control-input" <?php if($user_data->term_condition==1)echo 'checked';?> required />
               <label class="custom-control-label text-left" for="term_policy">I agree to the <a href="#" target="_blank" data-toggle="modal" data-target="#tcModal">Terms &amp; Conditions</a> </label>

              </div>
              </li>             
            </ul>
          </fieldset>
		 <?php }else{ ?>
			 
			    <fieldset>
			  <h3 class="col-form-label">NOC Certificate &amp; Privacy-Policy</h3>
            <ul class="form-row">
              <li class="form-group col-12 placeVaild">
                  <div class="custom-control custom-checkbox custom-control-inline ml-0">
                <input type="checkbox" name="noc_certificate" value="1" id="noc_certificate" class="custom-control-input" <?php if($user_data->noc_certificate_policy==1)echo 'checked';?> required />
               <label class="custom-control-label text-left" for="noc_certificate">I agree to the <a href="#" target="_blank" data-toggle="modal" data-target="#nocModal">NOC Certificate &amp; Privacy-Policy</a> </label>

              </div>
              </li>             
            </ul>
          </fieldset>
			<?php }?>
         <button class="hidden" formnovalidate type="submit" id="saveForm">Save</button>
         <button class="hidden" type="submit" id="doneForm">Done</button>

        </form>
      </div>
    </div>
  </div>



<!-- ADD MORE LANGUAGES MODAL -->
<div class="modal fade" id="knownLanguagesModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Language</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <ul class="pl-2 pr-2">
          <li class="form-group">
            <label class="col-form-label">Add More Languages</label>
			              <input type="text" class="form-control text-capitalize" placeholder="Type here" id="moreLang">

          <!--  <div class="input-group">
              <input type="text" class="form-control" placeholder="Type here" id="moreLang">
              <div class="input-group-append">
                 <button class="btn btn btn-secondary" type="button">Remove</button> 
                <button class="btn btn-outline-secondary addmore" type="button">Add More</button>
              </div>
            </div>-->
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
     <button type="button" class="btn btn-primary addmore">Add</button> 
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="saveModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="profilesaveTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center" id="profileSaveMsg"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>  </div>
    </div>
  </div>
</div>

<!-- SUBMIT FORM MODAL -->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3" id="exampleModalLongTitle"> <span class="modal-titleIcon"><img src="<?= base_url('assets/img/icon/done.svg')?>" alt="done" /></span> </h5>
        <p class="font-weight-semibold text-center" id="profileDoneMsg"></p>
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
        <h5 class="modal-title" >Terms & Conditions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
      <?php echo $termConditionData[0]->host_terms_condition;?>      
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- NOC Certificate MODAL -->
<div class="modal fade" id="nocModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">NOC Certificate & Privacy-Policy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
      <?php echo $termConditionData[0]->host_noc_certificate;?>      
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Swachh Bharat MODAL -->
<div class="modal fade" id="swachh_bharat_Modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Swachh Bharat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
      <?php echo $termConditionData[0]->swachh_bharat;?>      
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Tourism MODAL -->
<div class="modal fade" id="tourism_Modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tourism</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body legalPopup">
      <?php echo $termConditionData[0]->tourism;?>      
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- MANDATORY MODAL -->
<div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <form id="profileMandatory">
        <div class="modal-header">
          <h5 class="modal-title">Please fill in all the required fields</h5>
        </div>
        <div class="modal-body">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-12 col-sm-9">
                <ul class="pl-2 pr-2">
                  <li class="form-group placeVaild">
                    <label class="col-form-label">Mobile</label>
                    <input type="number" class="form-control" name="mobileFill" placeholder="Mobile" maxlength="10" required />
                  </li>
                  <li class="form-group placeVaild">
                    <label class="col-form-label">I am</label>
                    <div class="pb-1">
                      <div class="custom-control custom-radio custom-control-inline align-middle ml-2 mr-0 font-normal">
                        <input type="radio" id="iamIndividual" name="iam" class="custom-control-input" value="individual" required />
                        <label class="custom-control-label" for="iamIndividual"> An Individual</label>
                      </div>
                      <div class="custom-control custom-radio custom-control-inline align-middle ml-3 mr-0 font-normal">
                        <input type="radio" id="iamCompany" name="iam" class="custom-control-input" value="company" required />
                        <label class="custom-control-label" for="iamCompany"> A Company</label>
                      </div>
                    </div>
                  </li>
				  <input type="hidden" name="host_id" value="<?php echo $hostId;?>"/>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link text-primary" id="goItinerary">Skip</button>
          <button type="submit" class="btn btn-primary">Proceed</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php include('script.php');?>
<?php
$arrData = array();
if($user_data->interest == ''){}else{ 
  $arrData = explode(',', $user_data->interest);
};

if($user_data->preferred_cities == ''){}else{
  $prefCity = explode(',', $user_data->preferred_cities);
};

if(empty($arrData)){
    $arrData[] = '';
  }


  if(empty($prefCity)){
    $prefCity[] = '';
  }
  //print_r($arrData);
 ?>


<script type="text/javascript"> 
	var savemsg = '';
	var savemsg = '<?php if(isset($error)) echo $error?>';
  var url = '<?php echo base_url()?>';
  var providerType = '<?php echo $user_data->provider_type?>';
	var mobileNo = '<?php echo $user_data->host_mob_no?>';
	var iam = '<?php echo $user_data->i_am?>';

$(window).load(function(){
	//========= get onload city js START:: ==========//
   var state_id = $('#state option:selected').val();   
   var proceed = true;
  if(state_id=='' || state_id==null){
    proceed = false;	
  }
  $('#city').html('');
  if(proceed){
   $.ajax({
      type:'post',
      url:'<?php echo base_url()?>Account/get_city',
      data:{state_id:state_id},
      dataType:'json',
      success:function(Data){
      //console.log(Data);
      var len =  Data['cities'].length;
      var user_city = Data['user_data']['city'];
              for(i=0;i<len;i++){            
               $('#city').append("<option value="+Data['cities'][i]['id']+" "+(user_city==Data['cities'][i]['id']?'selected':"")+">"+Data['cities'][i]['city_name']+"</option>");
               }
            }
        }); 
      }
   //========= get onload city js END:: ==========//	  
});

(function($) { 
	  
  var tempstate_ids = $('#tmp_state option:selected').val();   
  var proceed = true;
  if(tempstate_ids=='' || tempstate_ids==null){
    proceed = false;
  }
  $('#tmp_city').html('');
  if(proceed){
   $.ajax({
      type:'post',
      url:'<?php echo base_url()?>Account/get_city',
      data:{state_id:tempstate_ids},
      dataType:'json',
      success:function(Data){
      var len =  Data['cities'].length;
      var user_city = Data['user_data']['tmp_city'];
      console.log(Data);
              for(i=0;i<len;i++){            
               $('#tmp_city').append("<option value="+Data['cities'][i]['id']+" "+(user_city==Data['cities'][i]['id']?'selected':"")+">"+Data['cities'][i]['city_name']+"</option>");
               }
            }
        }); 
      }
   
//========== Company City ==========//
  var companystate_ids = $('#company_state option:selected').val(); 
  var proceed = true;
  if(companystate_ids=='' || companystate_ids==null){
    proceed = false;
  }
  $('#company_city').html('');
  if(proceed){
   $.ajax({
     type:'post',
      url:'<?php echo base_url()?>Account/get_city',
     data:{state_id:companystate_ids},
      dataType:'json',
      success:function(Data){
       //console.log(Data);
      var lens =  Data['cities'].length;
      var user_citys = Data['user_data']['company_city'];
	         if(lens!=0){
              for(i=0;i<lens;i++){            
               $('#company_city').append("<option value="+Data['cities'][i]['id']+" "+(user_citys==Data['cities'][i]['id']?'selected':"")+">"+Data['cities'][i]['city_name']+"</option>");
               } 
			 }else{
			    $('#company_city').children().remove();
			    $('#company_city').append("<option value=''>Select</option>");
			 }
      }
   });
  }

   
  var msInterest = $('#interset').magicSuggest({
   placeholder: 'Type an interest',
    useCommaKey: true,
   data: ['Rafting ', 'Safari', 'Bungee Jumping', 'Kayaking', 'Biking', 'Skiing', 'Scuba diving', 'Surfing']
});
    			$(msInterest).on('selectionchange', function(e, cb, s) {
							var checkVal = msInterest.getValue()
							if (checkVal == "") {
											$('#intersetCheckbox').prop('checked', false);
							} else {
											$('#intersetCheckbox').prop('checked', true);
							}
			});
				
				
 var arrayInterest =  <?php echo json_encode($arrData); ?>;
  if(arrayInterest != ''){
    for(i=0;i<arrayInterest.length;i++){
      msInterest.setValue([arrayInterest[i]]);
     }
  }


//====== my interest js added by robin on 01-02-2019 ========//
 /*$("#interset").select2({
        placeholder: 'Select themes',
        tokenSeparators: [',', ' ']
    });*/

//PREFERRED CITY
var msCites = $('#preferred_cities').magicSuggest({
   placeholder: 'Select',
      allowFreeEntries: false,
     allowFreeEntries: false,
      maxSelection: 3,
   data:[<?php echo $cityresult;?>]
});

    			$(msCites).on('selectionchange', function(e, cb, s) {
							var checkVal = msCites.getValue()
							if (checkVal == "") {
											$('#preferred_citiesCheckbox').prop('checked', false);
							} else {
											$('#preferred_citiesCheckbox').prop('checked', true);
							}
			});


 //msCites.setValue([<?php if(isset($cityresult))echo $cityresult;?>]);
 
var cityPrefer = <?php echo json_encode($prefCity); ?>;
if(cityPrefer != ''){
for(i=0;i<cityPrefer.length;i++){
  msCites.setValue([cityPrefer[i]]);
 };
};


  function removePic(){
  //alert('hello')	
    $.ajax({
            type: "POST",
            data: {},
            url: "<?= base_url('Account/remove_pic')?>",            
            success: function(data){             
              }
     });
  }

  function removeAdhaar(){  
    $.ajax({
            type: "POST",
            data: {},
            url: "<?= base_url('Account/remove_adhaar')?>",
            
            success: function(data){
             
              }
     });
  }

  function panRemove(){
	  $('#removepancard').val('');
  }
  
 
  //CITY CHANGE BY STATE
    $(document).on('change','#state',function(){
       var state_id = $('#state option:selected').val();
	   var proceed = true;
	   if(state_id==''){
		   proceed = false;
		   }
       $('#city').html('');
	   if(proceed){
       $.ajax({
             type:"POST",
             data:{state_id:state_id},
             dataType:'json',
             url:"<?= base_url('Account/get_city');?>",
            
             success: function(Data){              
               console.log(Data);
               var len =  Data['cities'].length;
               var user_city = Data['user_data']['city'];
               //console.log(user_city);
              if(len!=0){
			    $('#city').append("<option value=''>Select</option>");
				  for(i=0;i<len;i++){            
                  $('#city').append("<option value="+Data['cities'][i]['id']+" "+(user_city==Data['cities'][i]['id']?'selected':"")+">"+Data['cities'][i]['city_name']+"</option>");
                   }  
			  }else{
			   $('#city').children().remove();
			   $('#city').append("<option value=''>Select</option>");
			  }
                 
            }
            });
	   }
      
     });
	 
   $(document).on('change','#company_state',function(){
       var state_id = $('#company_state option:selected').val();      
       $('#company_city').html('');
       $.ajax({
             type:"POST",
             data:{state_id:state_id},
             dataType:'json',
             url:"<?= base_url('Account/get_city');?>",
            
             success: function(Data){              
               console.log(Data);
               var len =  Data['cities'].length;
               var user_city = Data['user_data']['company_city'];
               console.log(company_city);
              if(len!=0){
			  $('#company_city').append("<option value=''>Select</option>");
              for(i=0;i<len;i++){            
               $('#company_city').append("<option value="+Data['cities'][i]['id']+" "+(user_city==Data['cities'][i]['id']?'selected':"")+">"+Data['cities'][i]['city_name']+"</option>");
              }
			 }else{
			   $('#company_city').children().remove();
			   $('#company_city').append("<option value=''>Select</option>");
			 }
              // document.getElementById('city').innerHTML =  Data;
              
               }
            });
      
     });
	 
$(document).on('change','#tmp_state',function(){
       var state_id = $('#tmp_state option:selected').val();      
       $('#tmp_city').html('');
       $.ajax({
             type:"POST",
             data:{state_id:state_id},
             dataType:'json',
             url:"<?= base_url('Account/get_city');?>",
            
             success: function(Data){              
               console.log(Data);
               var len =  Data['cities'].length;
               var user_city = Data['user_data']['tmp_city'];
               console.log(tmp_city);
              if(len!=0){
			  $('#tmp_city').append("<option value=''>Select</option>");
              for(i=0;i<len;i++){            
               $('#tmp_city').append("<option value="+Data['cities'][i]['id']+" "+(user_city==Data['cities'][i]['id']?'selected':"")+">"+Data['cities'][i]['city_name']+"</option>");
              }
			 }else{
			   $('#tmp_city').children().remove();
			   $('#tmp_city').append("<option value=''>Select</option>");
			 }
              
               }  
            });
      
     });	 

if(providerType!=='' && mobileNo=='' && iam==''){ 
$("#profileModal").modal({	
            show: true,
            keyboard: false,
            backdrop: 'static'
        });
}

$("#profileMandatory").validate({
								errorElement: 'small',
								errorPlacement: function(error, element) {
										error.appendTo(element.closest(".placeVaild"));
						},
								submitHandler: function() {
										$('#profileModal').modal('hide');
										var formData = $('#profileMandatory').serialize();
										updateSocialData(formData);
										$("#profileMandatory")[0].reset();
								}
		});
		
//========== Skip button click to go itineraries dashboard ===========//
$('#goItinerary').on('click',function(){
	window.location.href = '<?php echo base_url();?>itineraries';
});

//=========== update social login profile value js ===========//

function updateSocialData(formData){
  $.ajax({
	 type:'post',
	 url:'<?php echo base_url();?>Account/socialProfileUpdate',
	 data:formData,
	 success:function(html){
		console.log(html);
		if(html=='update_success'){
			location.reload();
			}
		}
 });	
}

$(".pin_codes").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message        
               return false;
    }
   });

$('#moreLang').bind('keyup blur',function(){ 
    var node = $(this);
    node.val(node.val().replace(/[^a-zA-Z]/g,'') ); }
);
   
 
 $('input[name="host_before"]').bind('change', function() {
	 if ($('input[value="Yes"]').is(':checked') == true) {
	 		$('.host_before_text').show();
    } else {
		    $('.host_before_text').hide();	

          }
}).trigger('change');
 
   
})(jQuery);
</script>

<script type="text/javascript" src="<?=  base_url('assets/js/profile.js'); ?>"></script> 
<!-- footer-->
<?php include('footer.php');?>