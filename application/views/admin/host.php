<?php 
	require_once('header.php');
	require_once('main_header.php');
	$uri = $this->uri->segment(1);
	$ses = $this->session->userdata('adminSes');	
	?>
<div class="loadingWrap"><div class="loadingText">Loading...</div></div>	
<main>	
  <div class="container-fluid">
    <div class="pageFormat">
      <div class="row filterCover">
        <div class="col-12 col-sm-4 pl-0">
          <input type="text" class="form-control mt-3" id="hostSearch" placeholder="Search for a host"/>
        </div>
        <div class="col-12 col-sm-8">
          <div class="row">
            <div class="col">
              <label class="m-0 font-weight-semibold pt-3">Filter:</label>
            </div>
            <div class="col"><small class="text-muted d-block">Host Type:</small>
              <select class="form-control" id="hostType">
                <option value="">All</option>
				<?php
					if(!empty($hostTypeData)){
						foreach($hostTypeData as $dataval):?>
						<option value="<?php echo $dataval->id;?>"><?php echo $dataval->host_name;?></option>
					<?php
						endforeach;
						}
					?>
				<!--<option value="1">City Explorer</option>
				<option value="2">City Maverick</option>
				<option value="3">SME</option>
				<option value="4">Food Theorist</option>
				<option value="5">Expat</option>
				<option value="6">Internal Host</option>-->
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">City:</small>
              <select class="form-control" id="city">
                <option value="">All</option>
				<?php 
					foreach($cityData as $cityval):
					echo '<option value="'.$cityval->id.'">'.$cityval->city_name.'</option>';
					endforeach;
					?>
              </select>
            </div>
            <div class="col"><small class="text-muted d-block">Services Type:</small>
              <select class="form-control" id="serviceType">
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
      <div class="boxCover">
        <div class="cform-box">
          <ul class="nav nav-tabs cform-tab" role="tablist">
            <li class="nav-item"> <a class="nav-link <?php if($uri=='host')echo 'active';?>" href="<?php echo base_url();?>host">All Hosts</a> </li>
            <li class="nav-item"> <a class="nav-link <?php if($uri=='request')echo 'active';?>" href="<?php echo base_url();?>request">Requests 
			<?php if($notifyData>0){?>
			<b class="badge">
				<?php echo $notifyData;?></b>
			<?php } ?>
				</a>
				</li>
			</ul>
          <div class="flyRight"> <button class="btn btn-link text-primary text-uppercase btn-sm">Download</button>

		  <a class="btn btn-primary text-uppercase btn-sm"  data-toggle="modal" data-target="#createhostModal">Create New Host</a>
          </div>
        </div>
        <table id="tableStyle" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Host Id</th>
              <th>Host Name</th>
              <th>Host Type</th>
              <th>Cities</th>
              <th>Services</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody id="host_append_data">
		  <?php $this->load->view('admin/host_element');?>        
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

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
          <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name" required />
          </div>
		  <div class="placeVaild pb-2">
		  <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name" required />
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
        </div>
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

<?php require_once('main_footer.php');?>
<?php require_once('adminscript.php');?>

<script type="text/javascript">
(function($) {

	$('#tableStyle').DataTable({
		"paging":   false,
        "ordering": false,
        "info":     false,
		"searching": false
	});

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

//=========== host searching js Start on 5-02-2019 ===========//
$('#aplyFilter').on('click',function(){	
	reloadSearch();
});

function reloadSearch(){
	  var searchVal = $('#hostSearch').val();
	  var hostType =   $('#hostType').val();
	  var cities = $('#city option:selected').val();
	  var serviceType = $('#serviceType option:selected').val();
	  var proceed =true;	  
	   if(proceed){
		    $.ajax({
				  type:'post',
				  url:'<?php echo base_url()?>admin/host',
				  data:{hostType:hostType,city:cities,serviceType:serviceType,searchVal:searchVal},
				  dataType : 'json',
				  success :function(response){
					        console.log(response);
							if(response.view!=='Empty data'){
							    $("#host_append_data tr").remove();
								$('#host_append_data').append(response.view);
								}
							else{
								$("#host_append_data tr").remove();
								$('#host_append_data').append('<tr><td>No Data Available.</td></tr>');
								}	
							}
				});
		   }
}	


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
				   $('#alertMsg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, this number already exists.</div>');
				   }
		    else if(response.status==='emailerror')	{
			   $('.loadingWrap').hide();
			   $('#alertMsg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, this email already exists.</div>');
			   }
		   else if(response.status==='create_err')	{
		       $('.loadingWrap').hide();
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

})(jQuery);
</script>
<?php require_once('footer.php');?>
