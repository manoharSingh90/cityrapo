<?php 
	require_once('header.php');
	$loginSes = $this->session->userdata('adminSes');
	?>

<div class="loadingWrap"><div class="loadingText">Loading...</div></div>

<div class="profilePage">
  <div class="profilePage-head clearfix">
    <h1 class="cmyLogo float-left"><img src="<?php echo base_url()?>adminassets/assets/img/iwl_hr_white_logo.svg" alt="India with locals" /></h1>
    <div class="float-right floatBtn mt-0"><a href="<?php echo base_url()?>request" class="btn btn-link mr-3 text-primary"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
            <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8
	c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"></path>
            </svg> Back</a>
			<?php if($loginSes['admin_type']!=6){ // editor login condition number 6 is editor admin?>
			<?php if($loginSes['admin_type']!=7){ // admin login condition number 7 is admin?>
			<a href="#" class="btn btn-link mr-3 text-default" data-toggle="modal" data-target="#rejectModal">Reject</a>
			<?php } ?>
			<a id="submitVerify" href="#" class="btn btn-secondary">Approve</a>
			<?php } ?>
			</div>
  </div>
  <div class="profilePage-body clearfix">
    <div class="profilePage-links" >
      <h3><span><img src="<?php echo base_url()?>adminassets/assets/img/icon/details.svg" alt="details"></span>Personal Info</h3>
      <ul>
        <li class="active"><a href="#filldetail">Details</a></li>
        <li><a href="#fillresidence">Location</a></li>
        <li><a href="#fillcompany">Company</a></li>
        <li><a href="#fillpreferences">Preferences</a></li>
      </ul>
      <h3><span><img src="<?php echo base_url()?>adminassets/assets/img/icon/details.svg" alt="details"></span>Documents</h3>
      <ul>
        <li>Identification</li>
        <li>Passport</li>
        <li>Others</li>
      </ul>
    </div>
    <div class="profilePage-info">
	<?php 
		if(!empty($hostHistory)){ ?>
      <div class="reasonBox">
        <div class="alert alert-dark" role="alert">		
          <h3>Reasons for rejections</h3>
          <ul>
		  <?php foreach($hostHistory as $history): ?>
            <li>
              <p><?php echo $history->reason;?> </p>
              <small><?php echo date('d M, Y h:i',strtotime($history->created_at));?></small>
			</li>
           <?php endforeach;?>   
          </ul>
        </div>			
      </div>
	  <?php }?>
      <form id="createBox" method="post">
        <fieldset id="filldetail">
          <h3 class="col-form-label">Details</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">First Name</label>
              <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo $profiles['host_first_name'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">Last Name</label>
              <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo $profiles['host_last_name'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">Mobile</label>
              <input type="number" class="form-control" name="mobile" placeholder="Mobile" value="<?php echo $profiles['host_mob_no'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-6">
            <label class="col-form-sublabel">Email ID</label>
              <input type="email" class="form-control" name="email" placeholder="Email ID" value="<?php echo $profiles['host_email'];?>" disabled />
            </li>
          </ul>
          <ul class="form-row pt-3">
            <li class="form-group col-12 col-md-6">
              <label class="col-form-label">GENDER</label>
              <div class="custom-control custom-radio custom-control-inline valign">
                <input type="radio" name="gender" id="maleRadioInput" class="custom-control-input" checked disabled>
                <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                </svg> </span>
                <label class="custom-control-label" for="maleRadioInput"><?php if($profiles['gender']=='M'){echo 'Male';}else{echo 'Female';}?></label>
              </div>
            </li>
          </ul>
          <ul class="form-row">
            <li class="form-group col-12 col-md-6">
              <label class="col-form-label">NATIONALITY</label>
              <select class="form-control" disabled >
                <option selected><?php echo $profiles['nationality'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-label">DATE OF BIRTH</label>
              <input type="text" id="dobDateInput" class="form-control" placeholder="DD/MM/YYYY" value="<?php echo date('d/m/Y',strtotime($profiles['date_of_birth']));?>" disabled />
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-label">DESCRIPTION</label>
              <p class="form-control"><?php echo $profiles['description'];?></p>
            </li>
          </ul>
        </fieldset>
        <fieldset id="fillresidence">
          <h3 class="col-form-label">Permanent Residence</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Address Line 1</label>
              <input type="text" class="form-control" placeholder="Address Line 1" value="<?php echo $profiles['permanent_address_1'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Address Line 2</label>
              <input type="text" class="form-control" placeholder="Address Line 2" value="<?php echo $profiles['permanent_address_2'];?>" disabled />
            </li>
		  <?php if(!empty($profiles['permanent_address_3'])){?>
			<li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Address Line 3</label>
              <input type="text" class="form-control" placeholder="Address Line 3" value="<?php echo $profiles['permanent_address_3'];?>" disabled />
            </li>
			<?php } ?>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">State</label>
                <?php 
	             $hostState = getState($profiles['state']);				 
				  ?>
			  <select class="form-control" disabled>			  
                <option value="<?php echo $profiles['state'];?>" selected><?php echo $hostState['state_name'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">City</label>
			 <?php $hostCity = getHostCity($profiles['city']);?>
              <select class="form-control" disabled >
                <option value="<?php echo $profiles['city'];?>" selected><?php echo $hostCity['city_name'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">Pin Code</label>
              <input type="number" class="form-control" placeholder="Pin Code" value="<?php echo $profiles['pin_code'];?>" disabled />
            </li>
          </ul>
        </fieldset>		
		
        <fieldset id="fillcompany">
          <h3 class="col-form-label">TEMPORARY ADDRESS</h3>
		  <?php if(!empty($profiles['tmp_address_1'])){?>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Address Line 1</label>
              <input type="text" class="form-control" placeholder="Address Line 1" value="<?php echo $profiles['tmp_address_1'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Address Line 2</label>
              <input type="text" class="form-control" placeholder="Address Line 2"value="<?php echo $profiles['tmp_address_2'];?>" disabled />
            </li>
			<?php if(!empty($profiles['tmp_address_3'])){?>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Address Line 3</label>
              <input type="text" class="form-control" placeholder="Address Line 3" value="<?php echo $profiles['tmp_address_3'];?>" disabled />
            </li>
			<?php }?>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">State</label>
			  <?php 
	             $tmpState = getState($profiles['tmp_state']);				 
				  ?>
              <select class="form-control" disabled>
                <option value="<?php echo $profiles['company_state'];?>" selected><?php echo $tmpState['state_name'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">City</label>
              <select class="form-control" disabled >
			  <?php $tmpCity = getHostCity($profiles['tmp_city']);?>
                <option value="<?php echo $profiles['company_city'];?>" selected><?php echo $tmpCity['city_name'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">Pin Code</label>
              <input type="text" class="form-control" placeholder="Pin Code" value="<?php if($profiles['tmp_pin_code']!='' && $profiles['tmp_pin_code']!=0){echo $profiles['tmp_pin_code'];}else{echo 'N/A';}?>" disabled />
            </li>
          </ul>
		  <?php }else{?>
				 <div class="custom-control custom-checkbox custom-control-inline titleCheck">
                <input type="checkbox" id="sameAbove" class="custom-control-input" checked="" disabled>
                <label class="custom-control-label" for="sameAbove">Same as above</label>
              </div>
			<?php } ?>
        </fieldset>
		
		
		<?php if($profiles['i_am']=='company'){?>
        <fieldset id="fillcompany">
          <h3 class="col-form-label">Company Details</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Associated Companies</label>
              <input type="text" class="form-control" placeholder="Associated Companies" value="<?php echo $profiles['associated_companies'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Company Name</label>
              <input type="text" class="form-control" placeholder="Company Name"value="<?php echo $profiles['company_name'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Company Address Line 1</label>
              <input type="text" class="form-control" placeholder="Company Address Line 1" value="<?php echo $profiles['company_address_1'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">Company Address Line 2</label>
              <input type="text" class="form-control" placeholder="Company Address Line 2" value="<?php echo $profiles['company_address_2'];?>" disabled />
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">State</label>
			  <?php 
	             $companyState = getState($profiles['company_state']);				 
				  ?>
              <select class="form-control" disabled>
                <option value="<?php echo $profiles['company_state'];?>" selected><?php echo $companyState['state_name'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">City</label>
              <select class="form-control" disabled >
			  <?php $hostCity = getHostCity($profiles['company_city']);?>
                <option value="<?php echo $profiles['company_city'];?>" selected><?php echo $hostCity['city_name'];?></option>
              </select>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">Pin Code</label>
              <input type="text" class="form-control" placeholder="Pin Code" value="<?php if($profiles['company_pin_code']!='' && $profiles['company_pin_code']!=0){echo $profiles['company_pin_code'];}else{echo 'N/A';}?>" disabled />
            </li>
          </ul>
        </fieldset>
		<?php } ?>		
		
        <fieldset id="fillpreferences">
          <h3 class="col-form-label">Preferences</h3>
          <ul class="form-row">		  
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel">My Interest </label>			  
              <ul class="tagList">
			  <?php 
			  if(!empty($profiles['interest'])){
			  $interestdata = explode(',',$profiles['interest']);
			  foreach($interestdata as $data):
			  ?>
                <li>
                  <label class="tagBox active text-center">
                    <input type="checkbox" checked="checked" class="lowKey">
                    <?php echo $data;?></label>
                </li> 
			  <?php endforeach;}else{echo 'N/A';} ?>
              </ul>
            </li>
            <li class="form-group col-12 col-md-12">			
              <label class="col-form-sublabel d-block mb-3">Services Offered</label>
			  <?php $serviceArr = explode(',',$profiles['services_offered']);
				    $serviceArr1 = explode(',',$profiles['services_offered']);
				    $service = array_combine($serviceArr, $serviceArr1);
					$walkshow = '';
					$Sessionshow='';
					$Experienceshow='';
					$meetshow='';
					if(isset($service['Walk'])!='Walk'){
						$walkshow = 'display:none';
						}
				   if(isset($service['Session'])!='Session'){
						$Sessionshow = 'display:none';
						}
				if(isset($service['Experience'])!='Experience'){
						$Experienceshow = 'display:none';
						}
				if(isset($service['Meet-Up'])!='Meet-Up'){
						$meetshow = 'display:none';
						}	
				  ?>
              <div class="custom-control custom-checkbox custom-control-inline valign pl-0" style="<?php echo $walkshow;?>">
                <input type="checkbox" id="walksRadioInput" class="custom-control-input"  disabled  <?php if(isset($service['Walk'])){echo "checked";} ?> />
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
                </svg> </span>
                <label class="custom-control-label" for="walksRadioInput">Walk</label>
              </div>
              <div class="custom-control custom-checkbox custom-control-inline valign" style="<?php echo $Sessionshow;?>">
                <input type="checkbox" id="sessionsRadioInput" class="custom-control-input"  disabled <?php if(isset($service['Session'])){echo "checked";} ?> />
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
                </svg> </span>
                <label class="custom-control-label" for="sessionsRadioInput">Sessions</label>
              </div>
              <div class="custom-control custom-checkbox custom-control-inline valign" style="<?php echo $Experienceshow;?>">
                <input type="checkbox" id="experiencesRadioInput" class="custom-control-input"  disabled <?php if(isset($service['Experience'])){echo "checked";} ?> />
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
                </svg> </span>
                <label class="custom-control-label" for="experiencesRadioInput">Experiences</label>
              </div>
              <div class="custom-control custom-checkbox custom-control-inline valign" style="<?php echo $meetshow;?>">
                <input type="checkbox" id="meetRadioInput" class="custom-control-input"  disabled <?php if(isset($service['Meet-Up'])){echo "checked";} ?> />
                <span class="control-icon"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
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
                </svg> </span>
                <label class="custom-control-label" for="meetRadioInput">Meet-Ups</label>
              </div>
            </li>
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel d-block mb-3">Preferred Cities</label>
              <ul class="tagList">
			  <?php 
			      if(!empty($profiles['preferred_cities'])){
				   $preferedcity = explode(',',$profiles['preferred_cities']);
				   foreach($preferedcity as $precity):
				  ?>
                <li>
                  <label class="tagBox active text-center">
                    <input type="checkbox" checked="checked" class="lowKey">
                    <?php echo $precity;?></label>
                </li>
				  <?php endforeach;}else{echo 'N/A';} ?>
              </ul>
            </li>
            <li class="form-group col-12 col-md-12 mt-3">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel text-dbl">Have you hosted before?</label>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="yesCheckInput" value="Yes" name="hostBefore" class="custom-control-input" disabled 
					<?php if($profiles['host_before']=='Yes'){echo 'checked="checked"';}?>/>
                    <?php if($profiles['host_before']=='Yes'){?><label class="custom-control-label" for="yesCheckInput">Yes</label><?php } ?>
					<input type="radio" id="yesCheckInput" value="No" name="hostBefore" class="custom-control-input" disabled 
					<?php if($profiles['host_before']=='No'){echo 'checked="checked"';?> <?php } ?>/>
					<?php if($profiles['host_before']=='No'){?><label class="custom-control-label" for="noCheckInput">No</label><?php } ?>
                  </div>
                  <div class="clearfix"></div>
				  <div class="form-group placeVaild host_before_text hidden">
					<label class="col-form-label">Note</label>
					<textarea class="form-control" placeholder="Write here (max 2000 characters)" data-rule-maxlength="2000" name="host_before_desc" required="" id="host_before_desc" disabled><?php if(isset($profiles['host_before_note'])) echo $profiles['host_before_note'];?></textarea>               
                  </div>
				  
                </div>
              </div>
            </li>
          </ul>
          <h3 class="col-form-label mt-2">Languages</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel">Preferred Languages <em>(To communicate with City Explorers)</em></label>
                </div>
                <div class="col-12 col-sm-6">
                  <select class="form-control" disabled>
                    <option value="<?php echo $profiles['preferred_languages'];?>" selected><?php echo $profiles['preferred_languages'];?></option>
                  </select>
                </div>
              </div>
            </li>
            <li class="form-group col-12 col-md-12">
              <label class="col-form-sublabel d-block">Known Languages</label>
              <ul class="tagList">
			  <?php
			  if(!empty($profiles['known_languages'])){
				  $knownLang = explode(',',$profiles['known_languages']);
				  foreach($knownLang as $language):
				  ?>
                <li>
                  <label class="tagBox active">
                    <input type="checkbox" class="lowKey" checked/>
                    <?php echo $language;?></label>
                </li>
			  <?php endforeach;}?>
              </ul>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <h3 class="col-form-label">PLEDGE</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-6">
              <p class="font-weight-semibold text-light d-inline-block mb-0">Swachh Bharat</p>
              <div class="custom-control custom-checkbox custom-control-inline align-bottom ml-3">
               <input type="checkbox" id="yesToClean" class="custom-control-input" checked disabled />
                <label class="custom-control-label" for="yesToClean">I agree</label>
              </div>
            </li>
            <li class="form-group col-12 col-md-6">
              <p class="font-weight-semibold text-light d-inline-block mb-0">Tourism</p>
              <div class="custom-control custom-checkbox custom-control-inline align-bottom ml-3">
                <input type="checkbox" id="yesToTravel" class="custom-control-input" checked disabled/>
                <label class="custom-control-label" for="yesToTravel">I agree</label>
              </div>
            </li>
          </ul>
        </fieldset>
        <fieldset>
          <h3 class="col-form-label">Documents</h3>
		  <?php if(!empty($profiles['adhaar_number_doc'])){?>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel">Adhaar</label>
                  <input id="adhaarNumberInput" type="text" class="form-control" placeholder="Adhaar Number" value="<?php echo $profiles['adhaar_number'];?>" disabled />
                </div>
                <div class="col-12 col-sm-6">
                  <label class="dragBox" for="fileInput-gst">
                  <div class="dragBox-icon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="file" /></div>
                  <div class="dragBox-info">
                    <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $profiles['adhaar_number_doc'];?></p>
                      <small class="text-muted">1858 kb</small><a href="<?php echo base_url()?>assets/upload/profile_pic/<?php echo $profiles['adhaar_number_doc'];?>" class="text-uppercase text-primary" download>Download</a></div>
                  </div>
                  </label>
                </div>
              </div>
            </li>
          </ul>
		  <?php }
		  if(!empty($profiles['pan_number_doc'])){
		  ?>
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel">PAN</label>
                  <input id="accountNumberInput" type="text" class="form-control" placeholder="Personal Account Number" value="<?php echo $profiles['pan_number'];?>" disabled />
                </div>
                <div class="col-12 col-sm-6">
                  <label class="dragBox" for="fileInput-gst">
                  <div class="dragBox-icon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="file" /></div>
                  <div class="dragBox-info">
                    <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $profiles['pan_number_doc'];?></p>
                      <small class="text-muted">1858 kb</small><a href="<?php echo base_url()?>assets/upload/profile_pic/<?php echo $profiles['pan_number_doc'];?>" class="text-uppercase text-primary" download>Download</a></div>
                  </div>
                  </label>
                </div>
              </div>
            </li>
          </ul>
		  <?php } ?>
        </fieldset>
		<?php if(!empty($profiles['passport_number_doc'])){?>
        <fieldset>		
          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel">Passport</label>
                  <input id="passportNumberInput" type="text" class="form-control" placeholder="Passport Number" value="<?php echo $profiles['passport_number'];?>" disabled />
                </div>
                <div class="col-12 col-sm-6">
                  <label class="dragBox" for="fileInput-gst">
                  <div class="dragBox-icon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="file" /></div>
                  <div class="dragBox-info">
                    <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $profiles['passport_number_doc'];?></p>
                      <small class="text-muted">1858 kb</small><a href="<?php echo base_url()?>assets/upload/profile_pic/<?php echo $profiles['passport_number_doc'];?>" class="text-uppercase text-primary" download>Download</a></div>
                  </div>
                  </label>
                </div>
              </div>
            </li>
          </ul>		
        </fieldset>
		<?php } ?>
    <?php if(!empty($profiles['license_guide_number_doc'])){?> 
      <fieldset>

          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel">Guide License</label>
                  <input id="guideNumberInput" type="text" class="form-control" placeholder="License Guide Number" value="<?php echo $profiles['license_guide_number'];?>" disabled />
                </div>
                <div class="col-12 col-sm-6">
                  <label class="dragBox" for="fileInput-gst">
                  <div class="dragBox-icon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="file" /></div>
                  <div class="dragBox-info">
                    <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $profiles['license_guide_number_doc'];?></p>
                      <small class="text-muted">1858 kb</small><a href="<?php echo base_url()?>assets/upload/profile_pic/<?php echo $profiles['license_guide_number_doc'];?>" class="text-uppercase text-primary" download>Download</a></div>
                  </div>
                  </label>
                </div>
              </div>
            </li>
          </ul>          </fieldset>

          <?php } ?>
    
          <?php  if(!empty($profiles['gst_pin_doc'])){		?>
            <fieldset>

          <ul class="form-row">
            <li class="form-group col-12 col-md-12">
              <div class="form-row">
                <div class="col-12 col-sm-6">
                  <label class="col-form-sublabel">GST PIN</label>
                  <input id="gstNumberInput" type="text" class="form-control" placeholder="GST PIN" value="<?php echo $profiles['gst_pin'];?>" disabled />
                </div>
                <div class="col-12 col-sm-6">
                  <label class="dragBox" for="fileInput-gst">
                  <div class="dragBox-icon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="file" /></div>
                  <div class="dragBox-info">
                    <div class="infoShow" style="display: block;">
                      <p class="text-primary"><?php echo $profiles['gst_pin_doc'];?></p>
                      <small class="text-muted">1858 kb</small><a href="<?php echo base_url()?>assets/upload/profile_pic/<?php echo $profiles['gst_pin_doc'];?>" class="text-uppercase text-primary" download>Download</a></div>
                  </div>
                  </label>
                </div>
              </div>
            </li>
          </ul>
          </fieldset>

          <?php } ?>
       <fieldset id="otherpreferences">
          <h3 class="col-form-label">Host Verification</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-6">
              <label class="col-form-sublabel">Host Type</label>
              <select class="form-control" required id="verified_type">
                <option value="">Select</option>
				<?php 
					if(!empty($hostType)){						
						foreach($hostType as $hostVal):
						if($hostVal->id == $profiles['host_verification_type']){
							$selected = 'selected';
							}							
						else{
							$selected = '';
							}
						?>
						<option value="<?php echo $hostVal->id;?>" <?php echo $selected;?>><?php echo $hostVal->host_name;?></option>
					   <?php endforeach; } ?>
               
              </select></li>
            <li id="verifiedFirst" class="form-group col-12 col-md-6">
              <label class="col-form-sublabel d-block mb-3">Verified By</label>
              <div class="custom-control custom-checkbox custom-control-inline valign pl-0">
                <input type="radio" id="callverifiedInput" name="verifiedBy" value="Call" class="custom-control-input" required <?php if($profiles['verified_by']=='Call'){echo 'checked';} ?> />
                <label class="control-icon" for="callverifiedInput">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                    <g id="call">
                      <g>
                        <path class="st0" d="M10,5.4c1.1-0.9,2.2-1.8,3.3-2.7c-0.2,0-0.4,0-0.6,0c0.9,0.8,1.6,2.1,1.6,3.3s-0.9,2-1.7,2.7
				C11,10.1,9.4,11.6,7.8,13C6,14.5,3,14,1.6,12.3c0,0.2,0,0.4,0,0.6c1-0.9,2.1-1.9,3.1-2.8c-0.2,0-0.3,0-0.5,0.1
				c0.8,0.6,2,0.9,2.9,0.5c0.7-0.3,1.2-0.9,1.8-1.4c0.5-0.5,1.2-0.9,1.5-1.6c0.5-1,0.3-2.1-0.5-2.9C9.6,4.5,9,5,9.4,5.4
				C10.8,6.7,9.2,8,8.2,8.8c-0.3,0.3-0.6,0.6-1,0.9C6.4,10.2,5.4,10,4.6,9.4c-0.1-0.1-0.4,0-0.5,0.1c-1,0.9-2.1,1.9-3.1,2.8
				c-0.2,0.2-0.1,0.4,0,0.6c1.3,1.6,4.2,2.5,6.2,1.5c1-0.4,1.8-1.3,2.6-2.1c1.1-1,2.2-2,3.3-3c0.9-0.8,1.9-1.6,2.1-3
				c0.2-1.6-0.7-3.2-1.8-4.3c-0.2-0.2-0.4-0.1-0.6,0c-1.2,1-2.3,1.9-3.4,2.8C9,5.2,9.6,5.7,10,5.4z"/>
                      </g>
                      <g>
                        <path class="st0" d="M2.3,13.6c1.1-1,2.3-2,3.4-3.1c0.4-0.3-0.2-0.9-0.6-0.6c-1.1,1-2.3,2-3.4,3.1C1.4,13.4,2,14,2.3,13.6
				L2.3,13.6z"/>
                      </g>
                      <g>
                        <path class="st0" d="M10.7,6.3c1.1-1,2.2-1.9,3.2-2.9c0.4-0.3-0.2-0.9-0.6-0.6c-1.1,1-2.2,1.9-3.2,2.9C9.7,6,10.3,6.6,10.7,6.3
				L10.7,6.3z"/>
                      </g>
                      <g>
                        <path class="st0" d="M3.9,13.4c0.8,0.5,2,0.3,2.9,0c0.5-0.1,0.3-0.9-0.2-0.8c-0.7,0.2-1.7,0.4-2.2,0C3.9,12.4,3.5,13.1,3.9,13.4
				L3.9,13.4z"/>
                      </g>
                    </g>
                  </svg>
                </label>
                <label class="custom-control-label" for="callverifiedInput">Call</label>
              </div>
              <div class="custom-control custom-checkbox custom-control-inline valign">
                <input type="radio" id="videoverifiedInput" name="verifiedBy" value="Video"  class="custom-control-input" <?php if($profiles['verified_by']=='Video'){echo 'checked';} ?> />
                <label class="control-icon" for="videoverifiedInput">
                  <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
                    <g id="play">
                      <g>
                        <g>
                          <path class="st0" d="M12.9,12.7c-2.6,0-5.2,0-7.8,0c-1,0-2.7,0.3-3.2-0.8c-0.2-0.4-0.1-1-0.1-1.5c0-0.8,0-1.5,0-2.3s0-1.5,0-2.3
				c0-0.6-0.1-1.2,0.4-1.6c0.7-0.7,2.3-0.4,3.2-0.4c1.7,0,3.3,0,5,0c0.6,0,1.3,0,1.9,0c0.4,0,0.8,0,1.1,0.1c0.9,0.3,0.9,1.2,0.9,2
				c0,0.9,0,1.7,0,2.6c0,0.8,0,1.6,0,2.4C14.2,11.7,14,12.6,12.9,12.7c-0.5,0-0.5,0.8,0,0.7c1.1-0.1,2-0.8,2.1-1.9
				c0.1-0.5,0-1,0-1.6c0-1.6,0-3.2,0-4.7c0-0.9-0.5-1.7-1.3-2C13.2,3,12.8,3,12.3,3c-1.7,0-3.3,0-5,0C5.9,3,4.5,3,3.2,3
				c-0.8,0-1.6,0.4-2,1.2C1,4.8,1,5.3,1,5.9c0,1.7,0,3.3,0,5c0,1.5,0.8,2.5,2.4,2.5c3.2,0,6.3,0,9.5,0
				C13.3,13.4,13.3,12.7,12.9,12.7z"/>
                        </g>
                        <path class="st0" d="M6.3,6.4V10c0,0.2,0.2,0.3,0.4,0.2l2.8-2c0.2-0.1,0.1-0.3,0-0.4L6.7,6.2C6.5,6.1,6.3,6.2,6.3,6.4z"/>
                      </g>
                    </g>
                  </svg>
                </label>
                <label class="custom-control-label" for="videoverifiedInput">Video</label>
              </div>			 
			  </li>
          </ul>
        </fieldset>
		<fieldset>
          <h3 class="col-form-label">Certified Guide</h3>
          <ul class="form-row">
            <li class="form-group col-12 col-md-6">
              <p class="font-weight-semibold text-light d-inline-block mb-0">Certified tour guide license</p>
              <div class="custom-control custom-checkbox custom-control-inline align-bottom ml-3">
               <input type="checkbox" name="guideBadge" id="guide_badge" class="custom-control-input" value="1" <?php echo ($profiles['guide_badges']==1?'checked="checked"':'');?>  />
                <label class="custom-control-label" for="guide_badge">Yes, He is certified guide</label>
              </div>
            </li>           
          </ul>
        </fieldset>
		<button id="submitHide" class="hidden" type="submit">Submit</button>
      </form>
    </div>
  </div>
</div>
<?php require_once('main_footer.php');?>

<!-- REJECT ALERT MODAL -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p>Are you sure that you want to reject this request?</p>
          <div class="form-group m-0">
            <label class="col-form-sublabel">Reason for rejection?</label>
            <textarea class="form-control d-block" placeholder="Add Note" id="reject_reason"></textarea>
			<span id="error"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="profileReject">Reject</button>
      </div>
    </div>
  </div>
</div>


<!-- APPROVE ALERT MODAL -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Please verify host type and verified by before proceed.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary callVerify" data-dismiss="modal" id="approve_modal">Verify</button>
      </div>
    </div>
  </div>
</div>

<!-- APPROVE ALERT MODAL -->
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Host profile has been aprroved.</p>
        </div>
      </div>
      <div class="modal-footer">
        <a class="btn btn-link text-primary" href="<?php echo base_url()?>host" >Done</a>
      </div>
    </div>
  </div>
</div>    
<?php require_once('adminscript.php');?>

<script type="text/javascript">
(function($) {
	
 //LEFT MENU
    $('.profilePage-links a[href*="#"]').on('click', function(e) {
        e.preventDefault();
        $(this).closest('.profilePage-links').find('.active').removeClass('active');
        $(this).closest('li').addClass('active');
        var $id = $(this).attr('href');
        var offset = $($id).offset();
        var $top = offset.top
        $('html, body').animate({
            scrollTop: $top - $('.profilePage-head').outerHeight() - 15
        }, 500);

    });

    $('.callVerify').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: $('#verifiedFirst').offset().top
        }, 'slow');
    });


// FORM SUMBIT

   $('#submitVerify').on('click', function(e) {
        e.preventDefault();
		$('.loadingWrap').show();
		$('#submitHide').trigger('click');
    });


//=========== Rejected Profile js START:: ============//
$('#profileReject').on('click',function(){
	var reason = $('#reject_reason').val();	
	var proceed = true;
	if(reason==''){
	     $('#error').html('enter reason for rejection').css({'color':'red','font-size':'12px'});
		 proceed = false;
		 return false;
		}
    $('#rejectModal').modal('hide');
	$('.loadingWrap').show();
	
	$('#profileReject').html('Loading...');	
	if(proceed){
		  $.ajax({
			   type:'post',
			   url:'<?php echo base_url()?>admin/profileRejected',
			   data:{id:<?php echo $profiles['user_id']?>,reason:reason},
			   success:function(html){
			       $('#profileReject').html('Reject');
				   	$('.loadingWrap').hide();
				   if($.trim(html)=='success'){
						 window.location.href = '<?php echo base_url()?>request';						
					   }
				   
				   }
			  });
		}	
});
//=========== END:: Rejected Profile Js =============//

$("#reject_reason").keypress(function(){
    var reasonText = $('#reject_reason').val();
	if(reasonText!=''){
		 $('#error').html('');
		}else{
		 $('#error').html('enter reason for rejection').css({'color':'red','font-size':'12px'});
		}
  });
  

$("#createBox").validate({
        errorElement: 'small',
        errorPlacement: function(error, element) {
            error.appendTo(element.closest(".form-group"));
        },
        invalidHandler: function(form, validator) {
	$('.loadingWrap').hide();
              $('#approveModal').modal('show');
          },
        submitHandler: function() {
            //alert();
			//========= START:: Profile APPROVE JS ===========//
 //$('#approve_modal').on('click',function(){
 var proceed = true; 
 var verifiedValue = $("input[name='verifiedBy']:checked").val();
 var verified_type = $('#verified_type option:selected').val();
 //var guideBadge = $('#guide_badge').val();
 var guideBadge = $('#guide_badge').is(':checked') ? 1 : 0;
 
 if(proceed){
	 $.ajax({
		  type:'post',
		  url:'<?php echo base_url()?>admin/approveProfile',
		  data:{id:<?php echo $profiles['user_id']?>,verifiedValue:verifiedValue,verified_type:verified_type,guideBadge:guideBadge},
		  success:function(html){		 
		      $('.loadingWrap').hide();
			  if($.trim(html)=='success'){			  	
				$('#successModal').modal('show');
				  }
			  }
		 });
	 }
//}); 
//=========END:: Profile Approve JS ============//
     
        }
    });

$('input[name="hostBefore"]').bind('change', function() {
	 if ($('input[value="Yes"]').is(':checked') == true) {
	 		$('.host_before_text').show();
    } else {
		    $('.host_before_text').hide();	

          }
}).trigger('change');	
	
})(jQuery);
	</script>

<?php require_once('footer.php');?>
