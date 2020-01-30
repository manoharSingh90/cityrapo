<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>City Explorers</title>
<link rel="shortcut icon" type="image/png" href="assets/img/favicon.png" />
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
<link rel="stylesheet" href="assets/css/iwl_global.css">
</head>

<body>
<div class="resetPage">
  <h1 class="resetLogo"><img src="assets/img/iwl_hr_org_logo.svg" alt="City Explorers" /></h1>
  <div class="resetForm">
    <h2>Reset Password</h2>
    <div id="alertMsg"></div>
    <div class="cform-box clearfix">
      <form id="resetPassForm">
     <!--   <div class="form-group">
          <label class="col-form-label">Old Password</label>
          <input type="password" class="form-control" id="old_pass" placeholder="Enter Old Password" name="old_pass" required />
        </div> -->
        <div class="form-group">
          <label class="col-form-label">New Password</label>
          <input type="password" class="form-control" id="new_pass" placeholder="Enter New Password" name="new_pass" required />
        </div>
        <div class="form-group">
          <label class="col-form-label">Confirm New Password</label>
          <input type="password" class="form-control" id="confirm_pass" data-rule-equalTo="#new_pass" placeholder="Enter Confirm password" name="confirm_pass" required />
        </div>
        <div class="form-group text-center pt-3 clearfix">
          <input type="hidden" name="userId" value="<?php echo $user_id;?>" id="userId"/>
          <input type="hidden" name="userEmail" value="<?php echo preg_replace('/\s/',' ',$user_email);?>" id="userEmail"/>
          <button type="button" class="btn btn-primary hidden" id="submit">Send</button>
          <button type="submit" class="btn btn-primary" id="resetBtn">Reset</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--  ALERT MODAL -->
<div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Success</h5></div>
      <div class="modal-body">
        <div class="confirmationText">
          <p class="text-center" id="setMsg"></p>
        </div>
      </div>
      <div class="modal-footer">
        <a href="<?php echo base_url();?>signin" class="btn btn-primary">Go to Login</a>
      </div>
    </div>
  </div>
</div>


<!-- SCRIPT --> 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script> 
<script type="text/javascript" src="assets/dependencies/bootstrap-4.1.2/dist/js/bootstrap.min.js"></script> 
<script type="text/javascript" src="assets/dependencies/jquery-validation-master/dist/jquery.validate.min.js"></script> 
<script type="text/javascript">
(function($) {

// FORM SUMBIT
$("#resetPassForm").validate({
	errorElement: 'small',
	submitHandler: function () {
	  	$('#submit').trigger('click');
	}
});

	$('#submit').on('click',function(){
	var formData = $('#resetPassForm').serialize();
	var proceed = true;
	$('#resetBtn').html('Loading...');
	if(proceed){
		 $.ajax({
			   type:'post',
			   url:'<?php echo base_url();?>account/changeResetPass',
			   data:formData,
			   success:function(response){
				   console.log(response);
				   $('#resetBtn').html('Reset');
				   if($.trim(response)=='success'){
					$('#setMsg').html('Your Password has been changed successfully, Please click "Go to login" button to login.');
			   		$('#resetPassForm')[0].reset();
					$('#msgModal').modal({
					backdrop: 'static',
					keyboard: false});
					   }
				  else if($.trim(response)=='pass_db_error'){
					   $('#alertMsg').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Your password did not changed.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
					   }					   
				else if($.trim(response)=='confirm_pass_err'){
					   $('#alertMsg').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Oops!</strong> Confirm Password does not match.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
					  }
				else if($.trim(response)=='old_pass_err'){
					   $('#alertMsg').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Oops!</strong>  Old Password does not match.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
					  }
				else if($.trim(response)=='new_pass_empty'){
					   $('#alertMsg').html('<div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Oops!</strong>New Password can not be empty.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button></div>');
					  }	 	  
				}
			 });
		}
  });
	
})(jQuery);
</script>
</body>
</html>
