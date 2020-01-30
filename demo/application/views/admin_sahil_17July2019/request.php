<?php
	require_once('header.php');
	require_once('main_header.php');
	
	$ses = $this->session->userdata('adminSes');
	if(!isset($ses)){
		 redirect('admin/login');
		}
$hostUri = $this->uri->segment(1);
$baseUrl = base_url();
$hostSendUrl = $baseUrl.$hostUri;
?>

<div class="loadingWrap"><div class="loadingText">Loading...</div></div>

<main>
  <div class="container-fluid">
    <div class="pageFormat">
	<!--<form method="post" action="request">-->
      <div class="row filterCover">
        <div class="col-12 col-sm-4 pl-0">
          <input type="text" class="form-control mt-3" placeholder="Search for a host" id="hostSearch"/>
        </div>
        <div class="col-12 col-sm-8">
          <div class="row">
            <div class="col">
              <label class="m-0 font-weight-semibold pt-3">Filter:</label>
            </div>
            <div class="col"><small class="text-muted d-block">Status:</small>
              <select class="form-control" id="status" name="status">
                <option value="">All</option>
				<option value="0">New</option>
				<option value="1">Link Sent</option>
				<option value="2">Re-Submitted</option>
				<option value="3">Rejected</option>
				<option value="4">Profile Submitted</option>
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">City:</small>
              <select class="form-control" id="cities" name="city">
                <option value="">All</option>
				<?php 
					foreach($cityData as $cityval):
					echo '<option value="'.$cityval->id.'">'.$cityval->city_name.'</option>';
					endforeach;
					?>
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">Services Type:</small>
              <select class="form-control" id="serviceType" name="serviceType">
                <option value="">All</option>
				<option value="Walk">Walk</option>
				<option value="Session">Session</option>
				<option value="Experience">Experience</option>
				<option value="Meet-Up">Meet-Up</option>
              </select>
            </div>
            <div class="col text-center">
              <button class="btn btn-link text-secondary mt-3" id="aplyFilter">Apply Filters</button>
            </div>
          </div>
        </div>
      </div>
	  <!--</form>-->
      <div class="boxCover">
        <div class="cform-box">
          <ul class="nav nav-tabs cform-tab" role="tablist">
            <li class="nav-item"> <a class="nav-link" href="<?php echo base_url();?>host">All host</a> </li>
            <li class="nav-item"> <a class="nav-link active" href="<?php echo base_url();?>request" id="notify">Requests 
			<?php if($notifyData>0){?>
			<b class="badge">
				<?php echo $notifyData;?></b>
			<?php } ?>
			</a> </li>
          </ul>		 
          <div class="flyRight"> <button class="btn btn-link text-primary text-uppercase btn-sm">Download</button>
		   <a class="btn btn-primary text-uppercase btn-sm"  data-toggle="modal" data-target="#createhostModal">Create New Host</a>           
          </div>
        </div>
        <table id="tableStyle" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Host Name</th>
              <th>Contact Details</th>
              <th>Cities</th>
              <th>Services</th>
              <th>Status</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody id="append_data">		          
           <?php $this->load->view('admin/request_element');?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

<?php require_once('main_footer.php');?>

<!-- START::SEND ALERT MODAL -->
<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Please click "Send" to send the profile link and password.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary callVerify" data-dismiss="modal" id="sendMail">Send</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalMsg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center" id="hostMailMsg"></p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal" id="closeModal">Close</button>       
      </div>
    </div>
  </div>
</div>
<!--END :: SEND ALERT MODAL -->

<!-- START::REJECT ALERT MODAL -->
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
            <textarea class="form-control d-block" placeholder="Add Note" name="rejectReason" id="rejectReason"></textarea>
			<span id="hostRejectedErr"></span>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="rejectBtn">Reject</button>
      </div>
    </div>
  </div>
</div>
<!-- END::REJECT ALERT MODAL -->

<!-- START::Re-SEND ALERT MODAL -->
<div class="modal fade" id="resendModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Re-Send Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
           <p class="text-center">Please click "Re-Send" to send the profile link and password again.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary callVerify" data-dismiss="modal" id="reSendBtn">Re-Send</button>
      </div>
    </div>
  </div>
</div>

<!--END :: Re-SEND ALERT MODAL -->

<!-- START::Rejected Re-SEND ALERT MODAL -->
<div class="modal fade" id="rejected_resendModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Re-Send Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center">Please click "Re-Send" to re-send the link.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary callVerify" data-dismiss="modal" id="rejeted_reSendBtn">Re-Send</button>
      </div>
    </div>
  </div>
</div>

<!-- CREATE HOST FORM MODAL -->
<div class="modal fade" id="createhostModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form id="signupHost">
      <div class="modal-header">
        <h5 class="modal-title">Create Host</h5>
      </div>
      <div class="modal-body">
	  <div class="row justify-content-md-center">
	  <div class="col-10">
	  
	  <div id="alertMsg"></div>
        <div class="form-group">
          <label class="col-form-label">Name</label>
		  <div class="placeVaild pb-2">
          <input type="text" id="fname" name="fname" class="form-control charText" placeholder="First Name" required />
          </div>
		  <div class="placeVaild pb-2">
		  <input type="text" id="lname" name="lname" class="form-control charText" placeholder="Last Name" required />
        </div>
		 </div>
        <div class="form-group">
          <label class="col-form-label">Contact</label>
		 <div class="placeVaild pb-2 signupMobile">
		  <span class="mobileCheck">+91-</span>
          <input type="number" id="mnumber" name="mnumber" class="form-control" placeholder="Mobile Number" required maxlength="10" minlength="10" data-rule-digits="true" data-msg-minlength="Please enter vaild mobile number" data-msg-maxlength="Please enter vaild mobile number" data-msg-digits="Please enter valid mobile number"/>
         </div>
		  <div class="placeVaild  pb-2">
		  <input type="email" id="mailid" name="mailid" class="form-control ignore" placeholder="Email ID" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" required />
		  </div>
        </div>
        <div class="form-group placeVaild  pb-2">
          <label class="col-form-sublabel align-middle mr-2 ml-1">I am</label>
          <div class="custom-control custom-radio custom-control-inline align-middle ml-2 mr-0 font-normal">
            <input type="radio" id="iamIndividual" name="iam" class="custom-control-input" value="individual" >
            <label class="custom-control-label" for="iamIndividual"> An Individual</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline align-middle ml-3 mr-0 font-normal">
            <input type="radio" id="iamCompany" name="iam" class="custom-control-input"  value="company" checked>
            <label class="custom-control-label" for="iamCompany"> A Company</label>
          </div>
        </div>
      </div></div>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" type="submit">Continue</button>
      </div>
     
    </form> </div>
  </div>
</div>


<!--  FORM MODAL -->
<div class="modal fade" id="verifytModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    <form id="signupProfile">
      <div class="modal-header">
        <h5 class="modal-title">Thank you</h5>
      </div>
      <div class="modal-body">
      <div class="thanksBox clearfix">
        <p>We have recieved your registration request. Please check your email for verification:</p>
        <ul>
          <li><span><img src="assets/img/icon/verify.svg" alt="verify" /></span>
            <p><strong class="d-block text-uppercase">VERIFY YOUR ACCOUNT</strong>Click on the link shared on your email along with your new password.</p>
          </li>
          <li><span><img src="assets/img/icon/setup.svg" alt="setup" /></span>
            <p><strong class="d-block text-uppercase">SETUP YOUR PROFILE</strong>Create your profile with the link shared on your email so we can process it.</p>
          </li>
          <li><span><img src="assets/img/icon/complete.svg" alt="complete" /></span>
            <p><strong class="d-block text-uppercase">REGISTRATION COMPLETE</strong>Once your details have been approved, your registration will be complete. You will recieve a confirmation email.</p>
          </li>
        </ul>
        <a class="btn btn-primary btn-lg float-right" href="#">Back to Home</a> </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Cancel</button>
        <button class="btn btn-primary" id="goHostProfile" type="button">Create Profile</button>
      </div>
     <input type="hidden" name="email" id="host_email"/>
	 <input type="hidden" name="pass" id="host_pass"/>
    </form>
	</div>
  </div>
</div>

<?php require_once('adminscript.php');?>

<script type="text/javascript">
(function($) {

	$('#tableStyle').DataTable({
		"paging":   false,
        "ordering": false,
        "info":     false,
		"searching": false
	});

	var hostid='';
$(document).on('click','.sendLink',function(){
 	var id = $(this).attr('id');
	hostid = id;
	$('.loadingWrap').hide();
	$('#sendModal').modal('show');
});

$(document).on('click','#sendMail',function(){
 var proceed = true;
 var url = '<?php echo $hostSendUrl?>';
//alert(url);
 $('.loadingWrap').show();
 $('#sendMail').html('Loading...');	
 if(proceed){
	   $.ajax({
		     type:'post',
			 url:'<?php echo base_url()?>admin/sendHostLink',
			 data:{id:hostid,url:url},
			 success:function(html){
					$('.loadingWrap').hide();
			       $('#sendModal').modal('hide');
			       $('#sendMail').html('Send');	
			      if($.trim(html)==='success'){
				       $('#hostMailMsg').html('Profile link and password emailer has been send successfully.');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
						   $('#ModalMsg').modal('hide');
						    location.reload();
						   });					  
					  }
				else{					
					   $('#hostMailMsg').html('Oops! Something went wrong, Please try again');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
						   $('#ModalMsg').modal('hide');						   
						   });
					}	  
				  
				 }
		   });
	 }
});

//========== START::Rejected Mail js on 16-11-18 =============//
var rejectid ='';
$(document).on('click','.rejected',function(){
	rejectid = $(this).attr('id');
	$('.loadingWrap').hide();
	$('#rejectModal').modal('show');	
});

$(document).on('click','#rejectBtn',function(){
	var rejectReason = $('#rejectReason').val();
    var url = '<?php echo $hostSendUrl?>';
	var proceed = true;
	
	if(rejectReason=='' || rejectReason==null){
	     $('#hostRejectedErr').html('Enter reason for rejection').css({'color':'red','font-size':'12px'});
		 proceed = false;
		 return false;
		}
		$('.loadingWrap').show();

	$('#rejectBtn').html('Loading...');	
	if(proceed){
		 $.ajax({
			  type:'post',
			  url:'<?php echo base_url()?>admin/rejectHostMail',
			  data:{rejectReason:rejectReason,id:rejectid,url:url},
			  success:function(html){	
			      $('#rejectModal').modal('hide');
				  $('.loadingWrap').hide();
				  $('#rejectBtn').html('Reject');	
				   if($.trim(html)==='success'){					  
					   $('#hostMailMsg').html('Rejected emailer has been send successfully.');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
					   $('#ModalMsg').modal('hide');
						    location.reload();
						   });						  
					  }
				else{
					   $('#hostMailMsg').html('Oops! Something went wrong, Please try again');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
					   $('#ModalMsg').modal('hide');						   
						   });
					}	  
				  }
			 });
		}	
});
//==========END:: Rejected Mail js on 16-11-18 =============//

//========== host rejected reason keydown js ===========//
$("#rejectReason").keypress(function(){
    var reasonText = $('#rejectReason').val();
	if(reasonText!=''){
		 $('#hostRejectedErr').html('');
		}else{
		 $('#hostRejectedErr').html('Enter reason for rejection').css({'color':'red','font-size':'12px'});
		}
  });
  

//==============START:: Resend Link Js ==============//
var resendId = '';
$(document).on('click','.resendLink',function(){
	$('#resendModal').modal('show');
	resendId = $(this).attr('id');	
});

$(document).on('click','#reSendBtn',function(){
	var proceed = true;
    var url = '<?php echo $hostSendUrl?>';
 	$('.loadingWrap').show();

   $('#reSendBtn').html('Loading...');	
    if(proceed){
	     $.ajax({
		     type:'post',
			 url:'<?php echo base_url()?>admin/resendHostLink',
			 data:{id:resendId,url:url},
			 success:function(html){
			 		$('.loadingWrap').hide();
			       $('#resendModal').modal('hide');
			       $('#reSendBtn').html('Re-Send');	
			      if($.trim(html)=='success'){
				       $('#hostMailMsg').html('Resendlink mail has been successfully send.');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
						   $('#ModalMsg').modal('hide');
						    location.reload();
						   });					  
					  }
				else{					
					   $('#hostMailMsg').html('Oops! Something went wrong, Please try again');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
						   $('#ModalMsg').modal('hide');						   
						   });
					}	  
				  
				 }
		   });
	 }
});
//=============END:: Resend Link Js ===============//

//============ Profile Submited js START ===========//
 var rejectedId = '';
$(document).on('click','.rejectResendLink',function(){
	rejectedId = $(this).attr('id');
	$('#rejected_resendModal').modal('show');

});

$(document).on('click','#rejeted_reSendBtn',function(){
	var proceed = true;
 	$('.loadingWrap').show();
    var url = '<?php echo $hostSendUrl?>';
   $('#rejeted_reSendBtn').html('Loading...');	
    if(proceed){
	     $.ajax({
		     type:'post',
			 url:'<?php echo base_url()?>admin/resendHostLink',
			 data:{id:rejectedId,url:url},
			 success:function(html){
			  		$('.loadingWrap').hide();
			       $('#rejected_resendModal').modal('hide');
			       $('#rejeted_reSendBtn').html('Re-Send');	
			      if($.trim(html)=='success'){
				       $('#hostMailMsg').html('Resendlink mail has been successfully send.');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
						   $('#ModalMsg').modal('hide');
						    location.reload();
						   });					  
					  }
				else{					
					   $('#hostMailMsg').html('Oops! Something went wrong, Please try again');
					   $('#ModalMsg').modal('show');					   
					   $('#closeModal').on('click',function(){
						   $('#ModalMsg').modal('hide');						   
						   });
					}	  
				  
				 }
		   });
	 }
});
//============ END:: Profile Submited Js =========//


//========== host searching js start:: on 19-11-18 ==============//
$(document).on('keyup','#hostSearch',function(){       
	   //reloadSearch();
    });
	
$('#aplyFilter').on('click',function(){	
	reloadSearch();
});
	
function reloadSearch(){
	  var searchVal = $('#hostSearch').val();
	  var status =   $('#status').val();
	  var cities = $('#cities option:selected').val();
	  var serviceType = $('#serviceType option:selected').val();
	  var proceed =true;
	  /*if(status=='' && cities=='' && serviceType==''){
		  alert('select any one for filter data');
		  proceed = false;
		  return false;
		  }*/
	   if(proceed){
		    $.ajax({
				  type:'post',
				  url:'<?php echo base_url()?>admin/request',
				  data:{status:status,city:cities,serviceType:serviceType,searchVal:searchVal},
				  dataType : 'json',
				  success :function(response){
					        console.log(response);
							if(response.view!=='Empty data'){
							    $("#append_data tr").remove();
								$('#append_data').append(response.view);
								}
							else{
								$("#append_data tr").remove();
								$('#append_data').append('<tr><td>No Data Available.</td></tr>');
								}	
							}
				});
		   }
}	
//========== host searching js end :: on 19-11-18 =============//

//=========== notify alert js ===============//

$('a').on('click',function(){
$.ajax({
	type:'post',
	url:'<?php echo base_url();?>admin/notification',
	success:function(html){
		//alert(html);
		}
 });
});

//============ Create host by Admin js function on 05-04-19 =========//
$("#signupHost").validate({
				errorElement: 'small',
				errorPlacement: function(error, element) {
								error.appendTo(element.closest(".placeVaild"));
				},
				submitHandler: function() {	

							hostCreation();


				}
});

function hostCreation(){
	var formData = $('#signupHost').serialize();
	$('.loadingWrap').show();
	$.ajax({		
		  type:'post',
		  url:'<?php echo base_url()?>admin/hostCreation',
		  data:formData,
		  dataType:'json',
		  success:function(response){
			   console.log(response);
			if(response.status==='success'){
			    $('.loadingWrap').hide();
				$('#createhostModal').modal('hide');
				$('#verifytModal').modal('show');
				$('#host_email').val(response.email);
				$('#host_pass').val(response.pass);
              }
			 else if(response.status==='unique_num_err'){
			       $('.loadingWrap').hide();
			       $('#createhostModal').modal('show');
				   $('#alertMsg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, this number already exists.</div>');
				   }
		    else if(response.status==='emailerror')	{
			   $('.loadingWrap').hide();
			   $('#createhostModal').modal('show');
			   $('#alertMsg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, this email already exists.</div>');
			   }
		   else if(response.status==='create_err')	{
		       $('.loadingWrap').hide();
			   $('#createhostModal').modal('show');
			   $('#alertMsg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops,something is wrong.</div>');
			   }   
	   
			  }
		});
}


//======== admin Go for host profile js start on 05-04-19 =======//
$('#goHostProfile').on('click',function(){
	var formData = $('#signupProfile').serialize();
	
	$.ajax({
		  type:'post',
		  url:'<?php echo base_url()?>admin/hostProfile',
		  data:formData,
		  success:function(data){
			  if($.trim(data)==='login_success'){
				   window.location.href = '<?php echo base_url()?>admin/createhostprofile';
				   //window.open('<?php echo base_url()?>profile','_blank');
				  }
			  else if($.trim(data)==='my_itinerary'){
				   //window.location.href = '<?php echo base_url()?>itineraries';
				   window.open('<?php echo base_url()?>itineraries','_blank');
				  }
			  else if($.trim(data)==='emptydb_err'){
				   alert('database error');
				  }	  
			  }
		});
});


//========= js for only characters letters =========//
$('.charText').keypress(function(e) {
		var key = e.keyCode;
		if (key >= 48 && key <= 57) {
			e.preventDefault();
		}
	});
				
})(jQuery);
</script>

<?php require_once('footer.php');?>






