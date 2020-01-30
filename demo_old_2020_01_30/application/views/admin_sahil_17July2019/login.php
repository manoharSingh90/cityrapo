<?php require_once('header.php');?>

<div class="credentialPage">
  <h1 class="credentialLogo"><img src="<?php echo base_url();?>adminassets/assets/img/logo.png" alt="India with locals" /></h1>
  <div class="credentialForm">
    <div class="cform-box clearfix">
      <div class="loaderBox"> <span><img src="<?php echo base_url();?>adminassets/assets/img/loader.svg" alt="loader" /></span> </div>
      <div class="tab-content cform-content">
        <div class="tab-pane fade active show">
          <form id="loginBox" >		  
            <div class="form-group">
              <label class="col-form-label d-block text-center pt-0 pb-4">Admin Login Details</label>
			  <div id="msgAlert"></div>
              <input type="email" class="form-control" placeholder="Email ID" required name="email" id="email" autocomplete="off"/>
              <input type="password" class="form-control" placeholder="Password" required name="password" id="password" autocomplete="off"/>
            </div>
            <div class="form-group text-right pt-3 clearfix">
              <button class="btn btn-link float-left" id="callForgot" type="button">Forgot Password</button>
              <button class="btn btn-primary float-right" id="loginBtn">Login</button>
            </div>
          </form>
          <form id="forgotBox" class="hidden">
            <div class="form-group">
              <label class="col-form-label">Forgot Password</label>
              <p class="col-form-sublabel">Please enter your registered Email ID</p>
              <input type="text" class="form-control" placeholder="Email ID" required/>
            </div>
            <div class="form-group text-right pt-4">
              <button class="btn btn-link text-default" id="callCancel" type="button">Cancel</button>
              <button class="btn btn-primary">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="credentialSlider">
    <div class="carousel slide carousel-fade" >
      <ol class="carousel-indicators">
        <li data-slide-to="0" class="active"></li>
        <li data-slide-to="1"></li>
        <li data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active" style="background-image:url(<?php echo base_url();?>adminassets/assets/img/banners/register/banner_01.jpg);"> <img src="<?php echo base_url();?>adminassets/assets/img/banners/register/banner_01.jpg" alt="banner_01" />
          <div class="carousel-caption">
            <p><img src="<?php echo base_url();?>adminassets/assets/img/icon/loc.svg" alt="Loc" /> Chhatarpur, Madhya Pradesh</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(<?php echo base_url();?>adminassets/assets/img/banners/register/banner_02.jpg);"> <img src="<?php echo base_url();?>adminassets/assets/img/banners/register/banner_02.jpg" alt="banner_02" />
          <div class="carousel-caption">
            <p><img src="<?php echo base_url();?>adminassets/assets/img/icon/loc.svg" alt="Loc" /> Taj ul Masajid, Madhya Pradesh</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(<?php echo base_url();?>adminassets/assets/img/banners/register/banner_03.jpg);"> <img src="<?php echo base_url();?>adminassets/assets/img/banners/register/banner_03.jpg" alt="banner_03" />
          <div class="carousel-caption">
            <p><img src="<?php echo base_url();?>adminassets/assets/img/icon/loc.svg" alt="Loc" /> Tomb of  Mohammad Ghaus,  Madhya Pradesh</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once('adminscript.php');?>

<script>
	
(function($) {

//IMAGE SLIDER
$('.carousel').carousel({
    interval: 3000
});


// FORGOT PASSWORD
$('#callForgot').on('click', function() {
    $('#forgotBox').show();
    $('#loginBox').hide();
});

// GO BACK TO SIGNIN
$('#callCancel').on('click', function() {
    $('#forgotBox').hide();
    $('#loginBox').show();
   	$('#signinForm form').trigger('reset');
});


// FORM SUMBIT

$("#loginBox").validate({
	errorElement: 'small',
	submitHandler: function () {	
	    adminLogin();
		// window.location.href = "itineraries.html";
	}
});
	
function adminLogin(){
	var formData = $('#loginBox').serialize();	
	var proceed = true;
	$('#loginBtn').html('Loading...');
	if(proceed){
		 $.ajax({
			   type:'post',
			   url: '<?php echo base_url();?>Admin/dashboard',
			   data: formData,
			   success:function(html){
			       console.log(html);
			       $('#loginBtn').html('Login');
				   if($.trim(html)==='super_admin'){
					     window.location.href = '<?php echo base_url()?>host';
					   }
				  if($.trim(html)==='sub_admin_one'){
					     window.location.href = '<?php echo base_url()?>host';
					   }
				  if($.trim(html)==='sub_admin_two'){
					     window.location.href = '<?php echo base_url()?>all_itineraries';
					   } 
				if($.trim(html)==='translator_1'){
					     window.location.href = '<?php echo base_url()?>translator_reqitineraries';
					   } 
				if($.trim(html)==='translator_2'){
					     window.location.href = '<?php echo base_url()?>all_itineraries';
					   } 
				if($.trim(html)==='editor_login'){
					     window.location.href = '<?php echo base_url()?>host';
					   }
				if($.trim(html)==='admin_login'){
					     window.location.href = '<?php echo base_url()?>host';
					   }	   
			  if($.trim(html)==='error'){	
				         console.log('error');
						 $('#msgAlert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Enter valid email and password.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
						 return false;
						}  
				   
				   }
			 });
		}
}

})(jQuery);
</script>
<!-- START::footer include -->
<?php require_once('footer.php');?>
<!-- END::footer include -->