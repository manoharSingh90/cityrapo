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
			$hostCity = getHostCity($details->city);
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
			  if($val=='Meet-Up'){
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
            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>admin/host_detail_doc?hostid=<?php echo $details->user_id;?>">Documents</a> </li>
            <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>admin/host_detail_itineraries?hostid=<?php echo $details->user_id;?>">Itineraries</a> </li>			
          </ul>
		  <div class="flyRight">           
			<a id="createNew" href="#" class="btn btn-danger text-uppercase btn-sm">Create New Itinerary</a>
			</div>
        </div>		
		<ul class="nav justify-content-center nav-tabs homeTab mt-4 mb-1" role="tablist">
	   <?php 
		   $hostServiceArr = end($userServices);		  
		   $servData = explode(',',$hostServiceArr->services_offered);	
		   // print_r($serviceData);
			$img  ='';
			$class = '';
			$serviceidArr = array();
	        $servicenameArr = array();
          foreach($serviceData as $service){
		      foreach($servData as $data){
			   if($service->category_name==strtoupper($data)){
			      if(!in_array($service->category_name,$servicenameArr)){
					   array_push($servicenameArr,$service->category_name);
					  }
				 if(!in_array($service->id,$serviceidArr)){
					   array_push($serviceidArr,$service->id);
					  }			 			 
				}
		   }
	  }
	   $dashboardServices = array_combine($serviceidArr,$servicenameArr);	 
		foreach($dashboardServices as $key=>$service):
			if($service=='SESSION'){
				 $img = 'sessions/sessions_outline_blue.svg';
				 $imgActive = 'sessions/sessions_outline_red.svg';
				 $id = 'session_data';
				}
			if($service=='WALK'){
				 $img = 'walk/walks_outline_blue.svg';
				 $imgActive = 'walk/walks_outline_red.svg';
				 $id = 'walk_data';
				}
			if($service=='EXPERIENCE'){
				 $img = 'experiences/experiences_outline_blue.svg';
				 $imgActive = 'experiences/experiences_outline_red.svg';
				  $id = 'experience_data';
				}
			if($service=='MEET-UP'){
				 $img = 'meetup/meetup_outline_blue.svg';
				 $imgActive = 'meetup/meetup_outline_red.svg';
				 $id = 'meetup_data';
				}
			
		   ?>
      <li class="nav-item"> <a class="nav-link tabClick" href="javascript:void(0);" id="<?php echo $id;?>" data-val="<?php echo $key;?>"
	  data-active="<?php echo base_url();?>assets/img/icon/<?php echo $imgActive;?>" data-default="<?php echo base_url();?>assets/img/icon/<?php echo $img;?>"> <img src="<?php echo base_url();?>assets/img/icon/<?php echo $img;?>" alt="img" /> <?php echo $service?></a> </li>
	  <?php endforeach;?>     
    </ul>
	<div class="itinerariesFilter clearfix ml-4 mr-4">
          <h4 class="font-weight-semibold"><span id="itinerary_count"></span> <span id="itinerary_name"></h4>
          <div class="d-inline-block align-middle">
            <div class="form-group m-0 form-row ">
              <label class="col-form-sublabel col-3 pt-2">Theme</label>
             <select class="form-control col-9" id="themesid">
            <option value="">All</option>
			<?php 
				foreach($themesData as $data):
				?>
            <option value="<?php echo $data->id;?>"><?php echo $data->theme_name;?></option>
			<?php endforeach;?>
          </select>
            </div>
          </div>
        </div>
		
      <div class="itinerariesGrid ml-4 mr-4">	  
       <ul id="admin_host_itinerary">
	   <?php //$this->load->view('admin/host_itineraries_element');?>
        </ul>
		<p class="text-center b-block text-uppercase text-light m-0 pt-3 pb-3" id="empty_data"></p>
        <div class="text-center p-2 pt-3 pb-3"> <a href="#" class="btn btn-link text-default" id="load_more" data-val = "0">Load More</a> </div>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" value="<?php echo $host_id;?>" id="hostId">
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

  <!-- CREATE NEW -->
<div class="createItineraries profilePage">
  <div class="profilePage-head clearfix">
    <h1 class="cmyLogo float-left"><img src="<?= base_url('assets/img/iwl_hr_white_logo.svg')?>" alt="India with locals" /></h1>
    <div class="float-right"> <a href="javascript:void(0);" class="btn btn-link mr-3 text-default closeCreate">cancel</a> </div>
  </div>
  <div class="profilePage-body clearfix">
    <div class="chooseService">
      <h2>What would you like to create?</h2>
      <ul>
	  <?php	 
	  $hostServiceArr = end($userServices);	 
	  $hostService = explode(',',$hostServiceArr->services_offered);
	  $img = '';	 
	  $idsArr = array();
	  $serviceArr = array();
	 
	 foreach($serviceData as $service){
		   foreach($hostService as $data){
			   if($service->category_name==strtoupper($data)){
			      if(!in_array($service->category_name,$serviceArr)){
					   array_push($serviceArr,$service->category_name);
					  }
				 if(!in_array($service->id,$idsArr)){
					   array_push($idsArr,$service->id);
					  }			 			 
				}
		   }
	  }
	  $userServices = array_combine($idsArr,$serviceArr);      
	  ?>
	  <?php foreach($userServices as $key=>$value):
	       if($value=='WALK'){
			   $img = 'walk/walks_outline_red.svg';
			   }
		  if($value=='SESSION'){
			   $img = 'sessions/sessions_outline_red.svg';
			   }
		  if($value=='EXPERIENCE'){
			   $img = 'experiences/experiences_outline_red.svg';
			   }
		  if($value=='MEET-UP'){
			   $img = 'meetup/meetup_outline_red.svg';
			   }	   
		  ?>		 		
         <li>
          <div class="chooseService-box">
			<span><img src="<?php echo base_url();?>/assets/img/icon/<?PHP echo $img;?>" alt="img" /></span>
            <h3><?php echo $value;?></h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In eu elit metus. Integer elementum maximus dolor, rutrum facilisis eros sodales nec. </p>
            <a href="javascript:void(0);" class="btn btn-outline-primary cate_type" id="<?php echo $key;?>" rel="<?php echo $value;?>">Create</a> </div>
         </li> <?php		   
		  endforeach;
		  ?>       
      </ul>
    </div>
  </div>
</div>

<!-- Language MODAL -->
<div class="modal fade" id="languageModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create in different languages</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <p class="mb-2">Please create itinerary in other language, Default language is english</p>
          <div class="form-group">
          <label class="col-form-sublabel">Select other Language</label>		  
          <select class="form-control" id="languageChange">		 
		  <?php 
			  foreach($hostLang as $data):
			  if(!empty($data->known_languages)){
				  $langData = explode(',',$data->known_languages);
				  }
			   else{
				    $langData = array('English'=>'English','english'=>'english');
				   }	  
			  foreach($langData as $lang):			  
			  ?>
            <option value="<?php echo $lang;?>"><?php echo $lang;?></option>            
			<?php									
				endforeach;endforeach;?>
			<option value="addMoreValue">Add More</option>
          </select>
        </div>
        <div id="addMoreBox" class="form-group hidden">
          <label class="col-form-sublabel">Add New Language</label>
          <input type="text" class="form-control"  placeholder="Type New Language Here" id="new_lang"/>
		  <div id="new_lang_error"></div>
        </div>
		<input type="hidden" id="cate_id" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="langCreate">Create</button>
      </div>
    </div>
  </div>
</div>

<?php require_once('adminscript.php');?>
<?php require_once('footer.php');?>

<script>
activeUrl = '<?php echo $this->uri->segment(2);?>'; 
	
$(document).ready(function(){	
console.log(activeUrl);
$(".homeTab li:first-child a").addClass('active');
/*if (activeUrl == 'walk') {
    $('#' + activeUrl + '_data')[0].click();
} else if (activeUrl == 'session') {
    $('#' + activeUrl + '_data')[0].click();
} else if (activeUrl == 'experience') {
    $('#' + activeUrl + '_data')[0].click();
} else if (activeUrl == 'meetup') {
    $('#' + activeUrl + '_data')[0].click();
} else {
    $(".homeTab li:first-child a")[0].click();
}*/

     var itinerary_name = '';
	 var serviceId = $('.homeTab').find('.active').data('val'); 
	 var serviceTabId = $('.homeTab').find('.active').attr('id'); 
	 var hostid = $('#hostId').val();
	 	//alert(serviceId);
	
	if(serviceId==1){		 
		  $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_red.svg');
		  }
	  if(serviceId==2){		  
		  $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_red.svg');
		  }
	 if(serviceId==3){	   
	   $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_red.svg');
	  }
	 if(serviceId==4){	  
	  $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_red.svg');
	  }
	    getItinerary(0,serviceId,hostid);
		
        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');			
			var serviceId = $('.homeTab').find('.active').data('val');			
            getItinerary(page,serviceId,hostid);
        });  
	  //history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/'+itinerary_name);    
    });

	//======== onload itinerary data show js =======//
var getItinerary = function(page,serviceId,hostid){ 	 
        $.ajax({
            url:"<?php echo base_url()?>Admin/loadsearch_Itineraries",			
            type:'GET',
			dataType: "json",
            data: {page:page,serviceId:serviceId,userId:hostid}
        }).done(function(response){
		 console.log(response);			
		 if(response.view!=='Empty data'){
		    $("#empty_data").html('');
		    //$("#admin_host_itinerary li").remove();
            $("#admin_host_itinerary").append(response.view);           
            $('#load_more').data('val', ($('#load_more').data('val')+1));			
            $('#load_more').show();				
		 }
		 if(response.view=='Empty data'){
		  $("#empty_data").html('No Data Available.');
		  $('#load_more').hide();
		
		 }
        });
    };
	
$('.homeTab .nav-link').on('click',function(){
	$(this).addClass('active');
	$(this).parent('li').siblings().find('a').removeClass('active');
	
  });
  
 $('.tabClick').on('click',function(){
    serviceId = $(this).data('val');
    var hostid = $('#hostId').val();
	var themesid = $('#themesid option:selected').val();
	var proceed = true;
	if(serviceId==1){
		$('#walk_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_red.svg');
		$('#session_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_blue.svg');
		$('#experience_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_blue.svg');
		$('#meetup_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_blue.svg');

		}
	else if(serviceId==2){
		$('#session_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_red.svg');
		$('#walk_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_blue.svg');
		$('#experience_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_blue.svg');
		$('#meetup_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_blue.svg');

		}
	else if(serviceId==3){
		$('#experience_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_red.svg');
		$('#walk_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_blue.svg');
		$('#session_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_blue.svg');
		$('#meetup_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_blue.svg');

		}
   else if(serviceId==4){
		$('#meetup_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_red.svg');
		$('#walk_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_blue.svg');
		$('#session_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_blue.svg');
		$('#experience_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_blue.svg');

		}		
		
	if(proceed){
		  search_itineraries(serviceId,hostid,themesid);
		 } 
  });

  //============== themes selection searching js ================//
$('#themesid').on('change',function(){    
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
	var hostid = $('#hostId').val();
	var proceed = true;	
	
	if(serviceId==1){
		serviceName = 'walk';
		}
	if(serviceId==2){
		serviceName = 'session';
		}
	if(serviceId==3){
		serviceName = 'experience';
		}
	if(serviceId==4){
		serviceName = 'meetup';
		}
			
	if(proceed){
	    search_itineraries(serviceId,hostid,themesid);		
		}
});

 function search_itineraries(serviceId,hostid,themesid){	
	$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>Admin/adminHostSearch',
			 data:{serviceId:serviceId,hostid:hostid,themesid:themesid},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			    if(html.view!=='Empty data'){
			    $("#admin_host_itinerary li").remove();
				$("#empty_data").html('');
			    $("#admin_host_itinerary").append(html.view);				
				 }
			else{
			    //$("#empty_data").remove();
			    $("#admin_host_itinerary li").remove();				
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();				
			   }			
			}
			});
		
}

//============ Create Itinerary JS ==========//
// CREATE NEW
  $(document).on('click','#createNew', function(e){
    e.preventDefault();
    $('.createItineraries').show();
  });
 
 $(document).on('click','.closeCreate', function(e){
    e.preventDefault();
    $('.createItineraries').hide();
  });
  
 var getid = '';
 $('.cate_type').on('click',function(){
	 getid = $(this).attr('id');
	 $('#cate_id').val(getid);
	 $('#languageModal').modal('show');
	});
	
$('#new_lang').on('keyup',function(){
	if($('#new_lang').val()==''){
		$('#new_lang_error').html('Enter new language.').css({'color':'#FF0000','font-size' : '12px','font-family':'verdana'});
		return false;
		}else{
		 $('#new_lang_error').html('');
		return true;
		}
});	

$('#languageChange').change(function(){
        if($(this).val() == 'addMoreValue') {
            $('#addMoreBox').show(); 
        } else {
            $('#addMoreBox').hide();
			$('#new_lang').val('');
        } 
    });


$('#langCreate').on('click',function(){
	var new_lang = $('#new_lang').val();
	var id = '<?php echo $host_id?>';
	//var catetype  = $('.cate_type').attr('rel');	
	var selectLang = $('#languageChange option:selected').val();	
	var proceed = true;
			
	if(selectLang=='addMoreValue' && new_lang==''){		
		 $('#new_lang_error').html('Enter new language.').css({'color':'#FF0000','font-size' : '12px','font-family':'verdana'});
		  proceed = false;
		  return false;
		}
	if(selectLang=='addMoreValue' && new_lang!=''){		
		  $('#new_lang_error').html('');
		  proceed = true;
		 }	
	if(new_lang=='' || new_lang==null){	
		 proceed = false;		
		}
	if(id=='' || id==null){
		proceed = false;		
		}
	if(selectLang!='' && new_lang==''){
	   var select_lang = selectLang;
	   $('#new_lang_error').html('');
	 }
	if(selectLang=='addMoreValue' && new_lang!=''){
		 var select_lang = new_lang;
		 $('#new_lang_error').html('');
		} 
	var hostid = '<?php echo base64_encode($host_id)?>';	
	$('#langCreate').html('Loading...');	
	if(proceed){
		 $.ajax({
			    type:'post',
				url:'<?php echo base_url();?>Itineraries/updateHostProfileLang',
				data:{hostId:id,new_lang:new_lang},
				success:function(html){
				  console.log(html);
				  $('#langCreate').html('Create');
				  if(html=='success'){
				    if(getid==1){
					  window.location.href = 'admin_create_walk_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
						}
					else if(getid==2){
						window.location.href = 'admin_create_session_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
						}		
				    else if(getid==3){
						window.location.href = 'admin_create_experience_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
						}
				    else if(getid==4){
						window.location.href = 'admin_create_meetup_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
						}			
					  }				 
					}
			 });
		}
	else{
	      $('#langCreate').html('Create');
		 if(getid==1){
		  window.location.href = 'admin_create_walk_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
		}
	  else if(getid==2){
		window.location.href = 'admin_create_session_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
		}	
	  else if(getid==3){
		window.location.href = 'admin_create_experience_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
		}
	 else if(getid==4){
		window.location.href = 'admin_create_meetup_itinerary?serviceid='+getid+'&otherlang='+select_lang+'&hostid='+hostid;
	   }	
	}	
});	
</script>
