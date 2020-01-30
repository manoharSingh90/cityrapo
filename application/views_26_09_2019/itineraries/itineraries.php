<!-- Header start-->
<?php include('head.php'); ?>
<!-- Header end-->
<?php include('header.php');
	$hostSes  = $this->session->userdata('id');		
	?>
<main>
  
  <div class="pageFormat">

    <?php if($error = $this->session->flashdata('error')):
      $feedback_class = $this->session->flashdata('feedback_class'); ?>
        <!--<div class="row">
          <div class="col-lg-12" align="center">
            <div class="alert alert-dismissible <?= $feedback_class ?>">
              <?= $error; ?>
              
            </div>
          </div>
        </div>-->
      <?php endif; ?>	  
	  <?php 
	  $allowStatus = end($allowItinerary);	 
	  if(!empty($allowItinerary) && $allowStatus->admin_status==5){		 
		  
		  if(!empty($itineraryServicesData)){?>		  
       <ul class="nav justify-content-center nav-tabs homeTab mt-4 mb-1" role="tablist">
	   <?php 
		   $hostServiceArr = end($userServices);	 
		   $servData = explode(',',$hostServiceArr->services_offered);	
			$img  ='';
			$class = '';			
			$serviceidArr = array();
	       $servicenameArr = array();
          foreach($services as $service){
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
	   $activetabName = reset($dashboardServices); // get first value of an array
	   
		foreach($dashboardServices as $key=>$service):
			if($service=='SESSION'){
			    if($activetabName=='SESSION'){
					$class = 'active';					
					}
				 else{
					 $class = '';					 
					 }	
				 $img = 'sessions/sessions_outline_blue.svg';				 
				 $imgActive = 'sessions/sessions_outline_red.svg';				 
				 $url = 'itineraries/sessions';
				 $id = 'session_data';
				}
			if($service=='WALK'){
			    if($activetabName=='WALK'){
					$class = 'active';					
					}
				else{
					 $class = '';
					 }	
				 $img = 'walk/walks_outline_blue.svg';				
				 $imgActive = 'walk/walks_outline_red.svg';				
				 $url = 'itineraries/walk';
				 $id = 'walk_data';
				}
			if($service=='EXPERIENCE'){
			    if($activetabName=='EXPERIENCE'){
					$class = 'active';					
					}
				else{
					 $class = '';
					 }	
				 $img = 'experiences/experiences_outline_blue.svg';				 
				 $imgActive = 'experiences/experiences_outline_red.svg';				 
				 $url = 'itineraries/experiences';
				 $id = 'experience_data';
				}
			if($service=='MEET-UP'){
			     if($activetabName=='MEET-UP'){
					$class = 'active';					
					}
				else{
					 $class = '';					 
					 }	
				 $img = 'meetup/meetup_outline_blue.svg';				
				 $imgActive = 'meetup/meetup_outline_red.svg';				

				 $url = 'itineraries/meetups'; 
				 $id = 'meetup_data';				 
				}
			
		   ?>
      <li class="nav-item"> <a class="nav-link <?php //echo $class;?>" href="javascript:void(0)" id="<?php echo $id;?>" data-val="<?php echo $key;?>" data-active="<?php echo base_url();?>assets/img/icon/<?php echo $imgActive;?>" data-default="<?php echo base_url();?>assets/img/icon/<?php echo $img;?>"><img src="<?php echo base_url();?>assets/img/icon/<?php echo $img;?>" alt="img" /> <?php echo $service?></a> </li>
	  <?php endforeach;?>     
    </ul>
	<div class="itinerariesFilter clearfix">
      <h4 class="font-weight-semibold"><span id="itinerary_count"></span> <span id="itinerary_name"></span></h4>
      <div class="d-inline-block align-middle">
        <div class="form-group m-0 form-row ">
          <label class="col-form-sublabel col-12 col-sm-3 pt-2">Theme</label>
         <select class="form-control col-12 col-sm-9" id="themesid">
            <option value="">All</option>
			<?php 
				foreach($themesData as $data):
				?>
            <option value="<?php echo $data->id;?>"><?php echo $data->theme_name;?></option>
			<?php endforeach;?>
          </select>
        </div>
      </div>
	  <div class="d-inline-block align-middle pl-4">
		  <div class="form-group m-0 form-row">
			  <label class="col-form-sublabel col-12 col-sm-4 pt-2">Host Type:</label>
			  <select class="form-control col-12 col-sm-8" id="hostType">
				  <option value="">All</option>
				  <?php 
					  if(!empty($hostTypeData)){
						  foreach($hostTypeData as $dataval):?>
						  <option value="<?php echo $dataval->id;?>"><?php echo $dataval->host_name;?></option>
					  <?php
						  endforeach;
						 }
					  ?>				  
			  </select>
		  </div>
	  </div>
  </div>
    <br>
    <div class="itinerariesGrid">	
      <ul id="host_itinerary_data">	   
      </ul>
	  <p class="text-center b-block text-uppercase text-light m-0 pt-3 pb-3" id="empty_data"></p>
      <div class="text-center p-2 pt-3 pb-3"> <a href="#" class="btn btn-link text-default" id="load_more" data-val = "0">Load More</a> </div>
    </div>
	<div class="text-center emptyStart">	     
      <a id="createNew" href="#" class="btn btn-secondary btn-lg">Create New Itinerary</a> 
	  </div>
	  <?php }else{?>
		  <div class="text-center emptyStart"> <span><img src="<?= base_url('assets/img/icon/markmap.svg')?>" alt="Mark Map" /></span>
      <h2>Your list is empty!</h2>
      <p>You currently have no itineraries created. Please click on the button below to start creating an itinerary and add it to your list.</p>	  
      <a id="createNew" href="#" class="btn btn-secondary btn-lg">Create New Itinerary</a>	  
	  </div>
		 <?php }
	  
	  } else{?>
   
    <div class="text-center emptyStart"> <span><img src="<?= base_url('assets/img/icon/markmap.svg')?>" alt="Mark Map" /></span>
      <h2>Your list is empty!</h2>
      <p>You currently have no itineraries created. Please click on the button below to start creating an itinerary and add it to your list.</p>
	  <?php 
	   $allowStatus = end($allowItinerary);
	  if(!empty($allowItinerary) && $allowStatus->admin_status==5){		 
	  ?>
      <a id="createNew" href="#" class="btn btn-secondary btn-lg">Create New Itinerary</a> 
	  <?php }else{ ?>
	  <a id="createNew" href="#" class="btn btn-secondary btn-lg disabled">Create New Itinerary</a>    
		 <?php } ?>
	  </div>
   <?php } ?>
  </div>
</main>

 <style>
	 a.disabled {
    pointer-events: none;
    cursor: default;
}
	 </style>
  
  <!-- CREATE NEW -->
<div class="createItineraries profilePage">
  <div class="profilePage-head clearfix">
    <h1 class="cmyLogo float-left"><img src="<?= base_url('assets/img/iwl_hr_white_logo.svg')?>" alt="cityexplorers" /></h1>
    <div class="float-right"> <a href="#" class="btn btn-link mr-3 text-default closeCreate">cancel</a> </div>
  </div>
  <div class="profilePage-body clearfix">
    <div class="chooseService">
      <h2>What would you like to create?</h2>
      <ul>
	  <?php	 
	  $hostServiceArr = end($userServices);	 
	  $serviceData = explode(',',$hostServiceArr->services_offered);	 
	  $img = '';	 
	  $idsArr = array();
	  $serviceArr = array();
	    foreach($services as $service){
		   foreach($serviceData as $data){
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
            <a href="#" class="btn btn-outline-primary cate_type" id="<?php echo $key;?>" rel="<?php echo $value;?>">Create</a> </div>
         </li> <?php		   
		  endforeach;
		  ?>        
      </ul><br>	  
	  <a href="javascript:void(0);" class="btn btn-outline-primary" id="download_product">How to create itinerary?</a>
    </div>	
  </div>  
</div>

<!-- Registration Thank you popup modal-->
<div class="modal fade" id="doneModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3" id="exampleModalLongTitle"> <span class="modal-titleIcon"><img src="<?= base_url('assets/img/icon/done.svg')?>" alt="done" /></span> Thank You!</h5>
        <p class="font-weight-semibold text-center">Your registration is complete. Someone from our team will<br/>
          get in touch with you shortly.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
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
		<p class="mb-2">Please create itinerary in other language <small>Default language is english</small></p>
		
          <div class="form-group">
          <label class="col-form-sublabel">Select other Language</label>		  
          <select class="form-control text-capitalize" id="languageChange">		 
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
          <input type="text" class="form-control text-capitalize"placeholder="Type New Language Here" id="new_lang"/>
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
        <div class="confirmationText text-left">
		<p>Dear Host,</p>
<p>Congratulations! You are now part of the City Explorers team.<br>
  You have joined our mission to transform ordinary trips into customized, extraordinary experiences.</p>
<p>Our common passion to share and exchange highlights of our country to travellers and fellow citizens shall bring great results ahead for society and help in preserving the true spirit of the diverse nation. </p>
<p>We have many ideas to share with you. We begin with some training documents which give you complete clarity about processes. </p>
<p>How to <a href="#">Create Products Guidelines</a> / <a href="#">Do’s & Don’ts</a></p>


<hr>

<p>You will be able to create your first itinerary after you agree to have read the training documents.</p>
<div class="custom-control custom-checkbox custom-control-inline text-left">
  <input type="checkbox" id="trainingCheckInput"  name="itinerary-training-agree" value="1" class="custom-control-input" data-rule-required="true"/>
  <label class="custom-control-label" for="trainingCheckInput">I check here to agree to have read the training documents</label>
</div>
<br>
<small class="d-block pb-2">In case of any queries you may please write to us at <a href="mailto:training@cityexplorers.in">training@cityexplorers.in</a></small>
<p>Follow City Explorers to find great new ideas! </p>



        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Done</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<?php require('footer.php');?>
<?php include('foot.php'); ?> 
<!--<?php $done_profile_key  = $this->session->userdata('user_status');
if($done_profile_key){ ?>
  <script type="text/javascript">
    $('#doneModal').modal();
  </script>

<?php } ?> -->
<?php 
	 $trainingData = end($trainingStatus);
	 $approveStatus = end($allowItinerary);	
	?>

<script type="text/javascript">
 var training_status = '<?php echo $trainingData->training?>';
 var approve_status = '<?php echo $allowStatus->admin_status?>';
 activeUrl = '<?php echo $this->uri->segment(2);?>'; 
 //alert(approve_status);
$(document).ready(function(){
	
if(training_status!=1 && approve_status==5){
	$("#trainingtModal").modal();
}	
	
console.log(activeUrl);

if (activeUrl == 'walk') {
    $('#' + activeUrl + '_data')[0].click();
} else if (activeUrl == 'session') {
    $('#' + activeUrl + '_data')[0].click();
} else if (activeUrl == 'experience') {
    $('#' + activeUrl + '_data')[0].click();
} else if (activeUrl == 'meetup') {
    $('#' + activeUrl + '_data')[0].click();
} else {
    $(".homeTab li:first-child a")[0].click();
}

  var itinerary_name = '';
	 var serviceId = $('.homeTab').find('.active').data('val'); 
	 var serviceTabId = $('.homeTab').find('.active').attr('id'); 	
	    if(activeUrl==''){
			itinerary_name = 'index';
			}
		else{
			
	  if(serviceId==1){
		  $('#itinerary_name').html('Walks');
		  itinerary_name = 'walk';
		  $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_red.svg');
		  }
	  if(serviceId==2){
		  $('#itinerary_name').html('Sessions');
		  itinerary_name = 'session';
		  $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_red.svg');
		  }
	 if(serviceId==3){
	   $('#itinerary_name').html('Experiences');
	   itinerary_name = 'experience';
	   $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_red.svg');
	  }
	 if(serviceId==4){
	  $('#itinerary_name').html('Meet-Ups');
	  itinerary_name = 'meetup';
	  $('#'+serviceTabId).find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_red.svg');
	  }
		}
	    getItinerary(0,serviceId,itinerary_name);
        $("#load_more").click(function(e){
            e.preventDefault();
            var page = $(this).data('val');			
			var serviceId = $('.homeTab').find('.active').data('val');			
            getItinerary(page,serviceId,itinerary_name);
        });  
	  //history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/'+itinerary_name);    
    });
//======== onload itinerary data show js =======//
var getItinerary = function(page,serviceId,itinerary_name){ 
	 
        $.ajax({
            url:"<?php echo base_url()?>itineraries/"+itinerary_name,			
            type:'GET',
			dataType: "json",
            data: {page:page,serviceId:serviceId}
        }).done(function(response){
		 console.log(response);	
		 if(response.view!=='Empty data'){
		 var loadMoreCount = $('#load_more').data('val')+1;		 
		 var loadCount = response.iterator.length;		 
		 if(loadMoreCount==''){
			  load_count = loadCount;
			 }
		 else{
			  load_count = parseInt(loadCount);
			 }
		 $("#empty_data").html('');	 
		 } 
		 if(response.view!=='Empty data'){		    
            $("#host_itinerary_data").append(response.view);           
            $('#load_more').data('val', ($('#load_more').data('val')+1));
			$('#itinerary_count').html(load_count);
			$("#empty_data").html('');
            if('<?php count($itineraryServicesData)?>'<4){
				$('#load_more').hide();
				}
		   else{
				 $('#load_more').show();
				 }	
		 }
		 if(response.view=='Empty data'){
		  //$("#empty_data").html('No Data Available.');
		  $('#load_more').hide();
		  $('#itinerary_count').html();
		  }
        });
    };

	$('.homeTab .nav-link').on('click',function(){
	$(this).addClass('active');
	$(this).parent('li').siblings().find('a').removeClass('active');
	
  });

 $('#walk_data').on('click',function(){	
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var proceed = true;
	if(serviceId==1){
		var serviceName = 'walk';
		$('#host_itinerary_data').removeAttr('class');
		$('#host_itinerary_data').addClass('walkGrid');
		$('#itinerary_name').html('Walks');
		$('#walk_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/walk/walks_outline_red.svg');
		}			
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/walk');	
	if(proceed){
	searchTabs(serviceName,serviceId,themesid,hostType);
	/*$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/walk',
			 data:{serviceId:serviceId},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			    if(html.view!=='Empty data'){
			    $("#host_itinerary_data li").remove();
				$("#empty_data").remove();
			    $("#host_itinerary_data").append(html.view);
				$('#itinerary_count').html(html.iterator.length);
				 }
			else{
			    $("#host_itinerary_data li").remove();
				$("#empty_data").remove();
			    $("#empty_data").append('No Data Available.');	
			    $("#load_more").hide();
				$('#itinerary_count').html();
			   }			
			}
			});*/
	}	
});

 $('#session_data').on('click',function(){	
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var proceed = true;
	if(serviceId==2){
		var serviceName = 'session';
		$('#host_itinerary_data').removeAttr('class');
	    $('#host_itinerary_data').addClass('sessionsGrid');
		$('#itinerary_name').html('Sessions');
		$('#session_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/sessions/sessions_outline_red.svg');
		}			
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/session');	
	if(proceed){
	searchTabs(serviceName,serviceId,themesid,hostType);
	}	
});

$('#experience_data').on('click',function(){	
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var proceed = true;	
	if(serviceId==3){
		var serviceName = 'experience';
		$('#host_itinerary_data').removeAttr('class');
		$('#host_itinerary_data').addClass('experienceGrid');
		$('#itinerary_name').html('Experiences');
		$('#experience_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/experiences/experiences_outline_red.svg');
		}			
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/experience');	
	if(proceed){	
	searchTabs(serviceName,serviceId,themesid,hostType);
	}	
});

$('#meetup_data').on('click',function(){	
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();
	var proceed = true;	
	if(serviceId==4){
	var serviceName = 'meetup';
	$('#host_itinerary_data').removeAttr('class');
    $('#host_itinerary_data').addClass('meetupGrid');
	$('#itinerary_name').html('Meet-Ups');
		$('#meetup_data').find('img').attr('src','<?php echo base_url()?>assets/img/icon/meetup/meetup_outline_red.svg');
		}			
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/meetup');	
	if(proceed){
	 searchTabs(serviceName,serviceId,themesid,hostType);
	}	
});

//============== themes selection searching js ================//
$('#themesid').on('change',function(){    
	var serviceId = $('.homeTab').find('.active').data('val');
	var themesid = $('#themesid option:selected').val();
    var hostType = $('#hostType option:selected').val();

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
	history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/'+serviceName);		
	if(proceed){
	    searchTabs(serviceName,serviceId,themesid,hostType);
		}
});

 //============== Host Type selection searching js ================//
 $('#hostType').on('change',function(){
     var serviceId = $('.homeTab').find('.active').data('val');
     var themesid = $('#themesid option:selected').val();
     var hostType = $('#hostType option:selected').val();

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
     history.pushState({isMine:true},'home |User','<?php echo base_url();?>'+'itineraries/'+serviceName);
     if(proceed){
         searchTabs(serviceName,serviceId,themesid,hostType);
     }
 });

function searchTabs(serviceName,serviceId,themesid,hostType){
	$.ajax({
			 type:'post',
			 url:'<?php echo base_url()?>itineraries/'+serviceName,
			 data:{serviceId:serviceId,themesid:themesid,hostType:hostType},
			 dataType:'json',
			 success:function(html){
			 console.log(html);
			   if(html.view!=='Empty data'){
			    $("#host_itinerary_data li").remove();
				$("#empty_data").html('');
			    $("#host_itinerary_data").append(html.view);
				$('#itinerary_count').html(html.iterator.length);
				if('<?php count($itineraryServicesData)?>'<4){
					$('#load_more').hide();
					}
				 else{
					 $('#load_more').show();
					 }	
				 }
			 if(html.view=='Empty data'){			  
			    $("#host_itinerary_data li").remove();								
			    $("#empty_data").html('No Data Available.');	
			    $("#load_more").hide();
				$('#itinerary_count').html('');
			    }			
			  }
		 });
}
  //=========== tab services end js ============//
  
  var savemsg = '<?php echo $error;?>';  
  if(savemsg!=='' && savemsg=='donemsg'){	          
			 $('#profileDoneMsg').html('Your registration is complete. Someone from our team will get in touch with you shortly.');
			  $('#exampleModalLongTitle').html('Thank You!');
			  $('#doneModal').modal(); 
			}
 if(savemsg!=='' && savemsg=='done_error'){	          
			 $('#profileDoneMsg').html('Oops, something went wrong!, please try again');
			  $('#exampleModalLongTitle').html('Error');
			  $('#doneModal').modal(); 
			}
if(savemsg!=='' && savemsg=='doneprofile_insert'){	          
			 $('#profileDoneMsg').html('Profile inserted successfully.');
			  $('#exampleModalLongTitle').html('Thank You!');
			  $('#doneModal').modal(); 
			}
if(savemsg!=='' && savemsg=='doneprofile_insert_err'){	          
			 $('#profileDoneMsg').html('Profile inserted successfully.');
			  $('#exampleModalLongTitle').html('Thank You!');
			  $('#doneModal').modal(); 
			}			
			
(function($) {

'use strict';
  
  // CREATE NEW
  $(document).on('click','#createNew', function(e){
    e.preventDefault();
	if(approve_status==5 && training_status!=1){
		 $("#trainingtModal").modal();
		}else{
		   $('.createItineraries').show();
		}
    
  });

  $(document).on('click','.closeCreate', function(e){
    e.preventDefault();
    $('.createItineraries').hide();
  });
  
 // ON CHANGE
    
 $('#languageChange').change(function(){
        if($(this).val() == 'addMoreValue') {
            $('#addMoreBox').show(); 
        } else {
            $('#addMoreBox').hide();
			$('#new_lang').val('');
        } 
    });

	 var getid = '';
	 $('.cate_type').on('click',function(){
	     getid = $(this).attr('id');
		 $('#cate_id').val(getid);
		 $('#languageModal').modal('show');
		});
//=========== Create New Language for Host Profile and create itineraries ============//

$('#langCreate').on('click',function(){
	var new_lang = $('#new_lang').val();
	var id = '<?php echo $hostSes?>';
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
					  window.location.href = 'create_itineraries?serviceid='+getid+'&otherlang='+select_lang;
						}
					else if(getid==2){
						window.location.href = 'create_itineraries_session?serviceid='+getid+'&otherlang='+select_lang;
						}		
				    else if(getid==3){
						window.location.href = 'create_itineraries_experiences?serviceid='+getid+'&otherlang='+select_lang;
						}
				    else if(getid==4){
						window.location.href = 'create_itineraries_meetup?serviceid='+getid+'&otherlang='+select_lang;
						}			
					  }				 
					}
			 });
		}
	else{
	      $('#langCreate').html('Create');
		 if(getid==1){
		  window.location.href = 'create_itineraries?serviceid='+getid+'&otherlang='+select_lang;
		}
	  else if(getid==2){
		window.location.href = 'create_itineraries_session?serviceid='+getid+'&otherlang='+select_lang;
		}	
	  else if(getid==3){
		window.location.href = 'create_itineraries_experiences?serviceid='+getid+'&otherlang='+select_lang;
		}
	 else if(getid==4){
		window.location.href = 'create_itineraries_meetup?serviceid='+getid+'&otherlang='+select_lang;
	   }	
	}	
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

$(document).on('click', '.homeTab li a', function(e) {
    e.stopPropagation();
    $('.homeTab li a').each(function() {
					    var $defaultURL = $(this).attr('data-default');
        $(this).find('img').attr('src', $defaultURL);
        console.log($(this).attr('data-default'))
    });
    var $this = $(this);
    var $thisImage = $this.find('img');
    var $activeURL = $this.attr('data-active');
    var $defaultURL = $this.attr('data-default');
    var $listItem = $(this).closest('li');
    var $listSiblings = $listItem.siblings();
    var $itemAnchor = $listSiblings.find('a');
    $thisImage.attr('src', $activeURL);
    $itemAnchor.removeClass('active');
    $(this).addClass('active');
});


$("#trainingForm").validate({
		errorElement: 'small',
			errorPlacement: function(error, element) {
								error.appendTo(element.closest(".placeVaild"));
								},
		submitHandler: function() {
					hostTraining();
		}
});
				
//=========== Training PopUp JS Start::===========//
function hostTraining(){
	var id = '<?php echo $trainingData->id?>';
	var userId = '<?php echo $trainingData->user_id?>';
	var trainingCheck = $('#trainingCheckInput').val();
	
	var proceed = true;
	if(userId=='' || id==''){
		proceed = false;
		return false;
		}
	if(trainingCheck=='' || trainingCheck==null){
		proceed = false;
		return false;
		}	
	if(proceed){
		 $.ajax({
			   type:'post',
			   url:'<?php echo base_url()?>Itineraries/updateHostTrainingStatus',
			   data:{id:id,userId:userId,trainingCheck:trainingCheck},
			   success:function(html){
				   if(html==='success'){
					    $("#trainingtModal").modal('hide');
						location.reload();
					   }
				      
				   }
			 });
		}	
	
}

})(jQuery);
</script>
</body>
</html>
