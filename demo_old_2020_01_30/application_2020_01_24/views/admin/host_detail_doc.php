<?php 
	require_once('header.php');
	$uri = $this->uri->segment(2);
	$ses = $this->session->userdata('adminSes');
?>
<header class="clearfix">
  <h1 class="cmyLogo"><img src="<?php echo base_url();?>assets/img/iwl_hr_white_logo.svg" alt="India with locals" /></h1>
  <nav class="navbar navbar-expand-lg">
    <div id="navbarContent" class="collapse navbar-collapse">
     <ul class="menuLinks">
	  <?php 
		  if($ses['admin_type']==1 || $ses['admin_type']==3){
		  ?>
        <li class="nav-item"> <a class="nav-link" href="<?php echo base_url(); ?>all_itineraries">Itineraries</a> </li>
		<?php } 
		if($ses['admin_type']==1 || $ses['admin_type']==2){ 
		  ?>
        <li class="nav-item active"> <a class="nav-link" href="<?php echo base_url(); ?>host">Host</a> </li>
		<?php } ?>
      </ul>
      <div class="startLinks"> <a href="<?php echo base_url();?>admin/logout">Logout</a> </div>
    </div>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarContent"> <img src="assets/img/icon/menu.svg" alt="menu"></button>
  </nav>
</header>
<main>
  <div class="container-fluid">
    <div class="myprofilePage clearfix"> <a href="<?php echo base_url(); ?>host" class="text-uppercase backLink mt-3 ml-3"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
		viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve">
      <path d="M12.5,14.4c-2.5-2.2-5-4.3-7.5-6.5c0,0.3,0,0.6,0,0.8c2.5-2.2,5-4.3,7.5-6.5c0.6-0.5-0.3-1.3-0.8-0.8
	c-2.5,2.2-5,4.3-7.5,6.5C4,8.1,4,8.5,4.2,8.7c2.5,2.2,5,4.3,7.5,6.5C12.2,15.8,13,14.9,12.5,14.4L12.5,14.4z"/>
      </svg> Back</a>
      <div class="profileLeft">
	  <?php 
		  if($details->profile_picture!=''){
			  $userPic = 'assets/upload/profile_pic/'.$details->profile_picture;
			  }
		else{
			 $userPic = 'assets/img/placeholder.jpg';
			}
		if($details->verified_by=='Video'){
			  $verifyimg = 'video.svg';
			  }
	  if($details->verified_by=='Call'){
		   $verifyimg = 'call_yellow.svg';
		  }	 		
		  ?>
        <div class="profileImage"><img src="<?php echo base_url();?><?php echo $userPic;?>" alt="user" /> </div>
        <h3 class="normalTitle"><?php echo $details->host_first_name.' '.$details->host_last_name;?></h3>
        <h4 class="smallTitle"><?php 
			$hostCity = $details->i_am == 'individual'?getHostCity($details->city):getHostCity($details->company_city);
			echo $hostCity['city_name'];
			?></h4>
		<small class="hostVerify mt-1"><b class="callVerify"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $verifyimg;?>" alt="<?php    echo $details->verified_by;?>" /> </b>Verified</small>	
        
		 <?php
			$hostData = getHostDetail($details->host_verification_type);
			if(!empty($hostData)){
			    $hostIcon = preg_replace('/\s/', '', strtolower($hostData['host_name']));			   
				?>
		  <small class="hostVerify mt-1"><b class="callVerify"><img src="<?php echo base_url();?>assets/img/icon/badge/<?php echo $hostIcon.'_badge.svg'?>" alt="<?php echo $hostIcon;?>"> </b>
			<?php			
			 echo $hostData['host_name'];			
			?></small>
		  <?php } ?>
        <div class="pt-3">
		 <?php 
			 $img ='';
			if($details->gender=='M'){
				  $img = 'male_red.svg';
				}else{
				  $img = 'female_red.svg';
				}?>
          <p class="textLine"><b><img src="<?php echo base_url();?>adminassets/assets/img/icon/<?php echo $img;?>" alt="gender icon" /></b><span class="smallTitle d-block">D.O.B</span> <?php echo date('d/m/Y',strtotime($details->date_of_birth));?></p>
        </div>
        <div class="pt-3">
          <p class="mb-1 textLine iconSmall"><b><img src="<?php echo base_url();?>adminassets/assets/img/icon/mail_red.svg" alt="mail" /></b>
			  <?php echo $details->host_email;?></p>
          <p class="mb-0 textLine iconSmall"><b><img src="<?php echo base_url();?>adminassets/assets/img/icon/call_red.svg" alt="call" /></b>
			  <?php echo $details->host_mob_no;?></p>
        </div>
        <div class="pt-3">
          <p class="smallTitle">Nationality</p>
          <p><?php echo $details->nationality;?></p>
        </div>
        <div class="pt-3">
          <p class="smallTitle">Known Languages</p>
          <p><?php echo $details->known_languages = str_replace(',', ',&nbsp;', $details->known_languages);?>
			  </p>
        </div>
        <div class="pt-3">
          <p class="smallTitle">Preferred Cities</p>
          <p><?php 		     
			  echo $details->preferred_cities = str_replace(',', ',&nbsp;', $details->preferred_cities);
			  ?></p>
        </div>
        <div class="pt-3">
          <p class="smallTitle">Services</p>
          <ul class="profileServices">
		  <?php 
			  $services = explode(',',$details->services_offered);
			  $img = '';
			  foreach($services as $val):
			  if($val=='Walk'){
				   $img = 'adminassets/assets/img/icon/walks_fill_red.svg';
				  }
			  if($val=='Meet-up'){
				   $img = 'adminassets/assets/img/icon/meetup_fill_red.svg';
				  }	
			 if($val=='Session'){
				   $img = 'adminassets/assets/img/icon/sessions_fill_red.svg';
				  }
			 if($val=='Experience'){
				   $img = 'adminassets/assets/img/icon/experiences_fill_red.svg';
				  }	  
			  ?>
            <li><span><img src="<?php echo base_url();?><?php echo $img;?>" alt="filejpg" /></span> <?php echo $val; ?></li>
			<?php endforeach;?>
            
          </ul>
        </div>
      </div>
      <div class="profileRight">
        <div class="cform-box ml-4 mb-4 mr-4">
          <ul class="nav nav-tabs cform-tab" role="tablist">
            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/host_detail?hostid=<?php echo $details->user_id;?>">Personal</a> </li>
            <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>admin/host_detail_doc?hostid=<?php echo $details->user_id;?>">Documents</a> </li>
            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/host_detail_itineraries?hostid=<?php echo $details->user_id;?>">Itineraries</a> </li>
          </ul>
          <div class="flyRight">
            <!--<a href="host_request_detail.html" class="btn btn-primary text-uppercase btn-sm">Edit</a>-->
          </div>
        </div>
        <div class="profileData docList">
          <h2 class="normalTitle mb-2">All Documents</h2>
          <div class="pt-3 pb-3 row">
            <div class="col-4">
              <p class="smallTitle">Adhaar Card</p>
              <p class="mb-0"><?php echo $details->adhaar_number;?></p>
            </div>
            <div class="col-4">
              <div class="downloadCard">
                <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
                <div class="dcInfo">
                  <p><?php echo $details->adhaar_number_doc;?></p>
                  <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $details->adhaar_number_doc;?>" download >Download</a> </div>
              </div>
            </div>
          </div>
          <div class="pt-3 pb-3 row">
            <div class="col-4">
              <p class="smallTitle">PAN Card</p>
              <p class="mb-0"><?php echo $details->pan_number;?></p>
            </div>
            <div class="col-4">
              <div class="downloadCard">
                <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
                <div class="dcInfo">
                  <p><?php echo $details->pan_number_doc;?></p>
                  <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $details->pan_number_doc;?>" download>Download</a> </div>
              </div>
            </div>
          </div>
		  <?php if(!empty($details->passport_number)){?>
          <div class="pt-3 pb-3 row">
            <div class="col-4">
              <p class="smallTitle">Passport</p>
              <p class="mb-0"><?php echo $details->passport_number;?></p>
            </div>
            <div class="col-4">
              <div class="downloadCard">
                <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
                <div class="dcInfo">
                  <p><?php echo $details->passport_number_doc;?></p>
                  <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $details->passport_number_doc;?>" download>Download</a> </div>
              </div>
            </div>
          </div>
		  <?php }
		  if(!empty($details->license_guide_number)){
		  ?>
          <div class="pt-3 pb-3 row">
            <div class="col-4">
              <p class="smallTitle">Guide License</p>
              <p class="mb-0"><?php echo $details->license_guide_number;?></p>
            </div>
            <div class="col-4">
              <div class="downloadCard">
                <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
                <div class="dcInfo">
                  <p><?php echo $details->license_guide_number_doc;?></p>
                  <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $details->license_guide_number_doc;?>" download>Download</a> </div>
              </div>
            </div>
          </div>
		  <?php } 
		  if(!empty($details->gst_pin)){
		  ?>
          <div class="pt-3 pb-3 row">
            <div class="col-4">
              <p class="smallTitle">GSTN</p>
              <p class="mb-0"><?php echo $details->gst_pin;?></p>
            </div>
			<?php if($details->gst_pin_doc!=''){?>
            <div class="col-4">
              <div class="downloadCard">
                <div class="dcIcon"><img src="<?php echo base_url();?>assets/img/icon/filejpg.svg" alt="filejpg" /></div>
                <div class="dcInfo">
                  <p><?php echo $details->gst_pin_doc;?></p>
                  <a href="<?php echo base_url();?>assets/upload/profile_pic/<?php echo $details->gst_pin_doc;?>" download>Download</a> </div>
              </div>
            </div>
			<?php } ?>
          </div>
		  <?php } ?>
        </div>        
      </div>
    </div>
  </div>
</main>
<?php require_once('main_footer.php');?>

<!-- CHANGE PASSPWORD -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <ul class="pl-2 pr-2">
          <li class="form-group col-12">
            <label class="col-form-sublabel">Old password</label>
            <input type="password" class="form-control" placeholder="Old Password" />
          </li>
          <li class="form-group col-12">
            <label class="col-form-sublabel">New password</label>
            <input type="password" class="form-control" placeholder="New Password" />
          </li>
          <li class="form-group col-12">
            <label class="col-form-sublabel">Confirm New password</label>
            <input type="password" class="form-control" placeholder="Confirm New Password" />
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="addQuestion" class="btn btn-primary">Change</button>
      </div>
    </div>
  </div>
</div>
<?php require_once('adminscript.php');?>
<?php require_once('footer.php');?>


