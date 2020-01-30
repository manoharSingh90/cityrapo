<?php include('header.php'); 
 $actual_link = "$_SERVER[REQUEST_URI]"; 
 //$uri =  $this->uri->segment(1);
 // echo $actual_link;die;
 if($actual_link == '/demo/signin'){
  $loginact_class = "show active";
  $logTab = "active";
  $regact_class = "";
  $regTab = "";
} else{
  $loginact_class = '';
  $logTab = "";
  $regact_class = "show active";
  $regTab = "active";
}

?>

<script type="text/javascript">
  function registerHere(){ 
    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var mob_num = $('#mob_num').val();
    var email_Id = $('#email_Id').val();
    var i_am = $("input[name='iam']:checked").val();
    var len = mob_num.length;
    if(len=='' || len==null){
     $('#mob_num_error').show();
     return false;
    }
    if(len<10){
      $('#mob_num_error').show();
       return false;
    }
    if(len>14){
      $('#mob_num_error').show();
       return false;
    }
    if(len>=10){
      $('#mob_num_error').hide();
       //return true;
    }

  
    $.ajax({
            type: "POST",
            data: {first_name:first_name,last_name:last_name,mob_num:mob_num,email_Id:email_Id,i_am:i_am},
            url: "<?= base_url('account/send_otp')?>",
            beforeSend:function(){
              $("#loadingmessage").css('display','block');
            },

            success: function(data){ 
			console.log(data);
              if($.trim(data)== 'success'){
                $('#otpBox').show();
                $('#signupBox').hide();
                $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >A OTP code has been sent to your email ID</div>');
                $("#loadingmessage").css('display','none');
              }
			 else if($.trim(data)=='emailerror'){
				  $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, this email already exists.</div>');
                 $("#loadingmessage").css('display','none'); 
				 } 
			else if($.trim(data)=='unique_num'){
				  $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, this number already exists.</div>');
                 $("#loadingmessage").css('display','none'); 
				 } 	 
			 else if($.trim(data)=='error')
			  {
                $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >Oops, something went wrong!, please try again</div>');
                $("#loadingmessage").css('display','none'); 
              }
            }
        }); 
  };

 
  function otpCheck(){
    var otp = $('#otp').val();
	
    $.ajax({
            type: "POST",
            data: {otp:otp},
            url: "<?= base_url('account/check_otp')?>",
            beforeSend:function(){
              $("#loadingmessage").css('display','block');
            },
            success: function(otppData){
              console.log(otppData);
              if($.trim(otppData)== 'Registration Successfull'){
                $('.alert').remove();
                $('#otpBox').hide();
                $('#thanksBox').show();
                $("#loadingmessage").css('display','none');
              }else{
                 $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+otppData+'</div>');
                 $("#loadingmessage").css('display','none'); 
                 
               }
              }
           });
        }; 

    function resendOtp(){
              $.ajax({
            type: "POST",
            data: {},
            url: "<?= base_url('account/resend_otp')?>",
            beforeSend:function(){
              $("#loadingmessage").css('display','block');
            },
            success: function(otpData){
              //alert(otpData);
              if(otpData == 'A OTP code has been sent to your email ID'){
                $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+otpData+'</div>');
                $("#loadingmessage").css('display','none');
             
              }else{
                 //$("#demo").html(otpData);
                 $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+otpData+'</div>');
                 $("#loadingmessage").css('display','none'); 
              }
              }
           });
        }; 

function loginUser() { 
          var email = $('#email').val();
          var password = $('#password').val();
          
			$.ajax({
              type: "POST",
              data: {email:email,password:password},
              url: "<?= base_url('account/login')?>",
              beforeSend:function(){
              //$("#loadingmessage").css('display','block');
              },
              success: function(loginData){
			
              if($.trim(loginData) == 'Login Successfully'){  
                location.href = "<?= base_url('profile');?>";
                 //$("#loadingmessage").css('display','none'); 
              } else if($.trim(loginData)=='my_itinerary'){
				location.href = "<?= base_url('itineraries');?>";
														} else{
                $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+loginData+'</div>');
                //$("#demo").html(loginData).css('display','block').fadeIn('slow').delay(4000).fadeOut();
                //$("#demo").html(loginData).css('display','block');
                 //$("#loadingmessage").css('display','none'); 
              }
              
              }
           });
        };

        function forgotPass() {
          $('#forgotBox').show();
          $('#loginBox').hide();
		  $('.alert').remove();
          var forgot = 'Please enter your registered email ID';
          //$("#demo").html(forgot);
         // $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+forgot+'</div>');
         // $("#demo").html(forgot).css('display','block'); 
        };

        function getPass() {
          var reg_email = $('#reg_email').val();
          $.ajax({
              type: "POST",
              data: {reg_email:reg_email},
              url: "<?= base_url('account/check_email')?>",
              beforeSend:function(){
              $("#loadingmessage").css('display','block');
              },
              success: function(forgotData){
			   console.log(forgotData);
                  if(forgotData == 'success'){
                   var msg =  'Your password has been send successfully.';
                    $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+msg+'</div>');
				    $('#loginBox,#forgotBox').trigger('reset');
                    $('#loginBox').show();
                    $('#forgotBox').hide();
                    $("#loadingmessage").css('display','none'); 
                  }
				  else if(forgotData=='adminpending'){
				   var msg =  'Your request is under process of verification, please contact your admin';
					  $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+msg+'</div>');
                     $("#loadingmessage").css('display','none');
					  }
				else if(forgotData=='update_pass_err'){
				   var msg =  'Oops! something is wrong with database.';
					  $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+msg+'</div>');
                     $("#loadingmessage").css('display','none');
					  }	  
				  else{
                    //$("#demo").html(forgotData);
                    $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+forgotData+'</div>');
                    $("#loadingmessage").css('display','none');
                  }
              }
           });
        }

        function cancle() {
            $('#forgotBox').hide();
            $('#loginBox').show();
            $('#signinForm form').trigger('reset');
             location.href = "<?= base_url('signin');?>";
        };  

</script>  
<div class="credentialPage">
  <h1 class="credentialLogo"><img src="<?= base_url('assets/img/logo.png')?>" alt="City Explorers" /></h1>
  <div class="credentialForm">
  <p class="cform-logo"><img src="<?= base_url('assets/img/logo_black.png')?>" alt="City Explorers" /></p>
  <h2 class="cform-title">With us you can safely discover India of "Now"</h2>
  <div id="alert-msg"></div>
    <div class="cform-box clearfix">
      <div id="thanksBox" class="thanksBox clearfix">
        <h2 class="col-form-label">Thank you</h2>
        <p>We have recieved your registration request. Please check your email for verification:</p>
        <ul>
          <li><span><img src="<?= base_url('assets/img/icon/verify.svg')?>" alt="verify" /></span>
            <p><strong class="d-block text-uppercase">VERIFY YOUR ACCOUNT</strong>Click on the link shared on your email along with your new password.</p>
          </li>
          <li><span><img src="<?= base_url('assets/img/icon/setup.svg')?>" alt="setup" /></span>
            <p><strong class="d-block text-uppercase">SETUP YOUR PROFILE</strong>Create your profile with the link shared on your email so we can process it.</p>
          </li>
          <li><span><img src="<?= base_url('assets/img/icon/complete.svg')?>" alt="complete" /></span>
            <p><strong class="d-block text-uppercase">REGISTRATION COMPLETE</strong>Once your details have been approved, your registration will be complete. You will recieve a confirmation email.</p>
          </li>
        </ul>
        <?=  anchor('home', 'Back to Home',['class'=>'btn btn-primary btn-lg float-right']) ?>  </div>
      <div id='loadingmessage' class="loaderBox">
        <span><img src="<?= base_url('assets/img/loader.svg')?>"/></span>  
      </div>
      <ul class="nav nav-tabs cform-tab" role="tablist">
        <li class="nav-item"> 
          <!-- <a id="signup-tab" data-toggle="tab" href="#signupForm"> -->
         <?=  anchor('signup', 'Join as a host', ["class"=>"nav-link $regTab","role"=>"tab" ,"ria-selected"=>"true","aria-controls"=>"signupForm","aria-selected"=>"true","id"=>"signup-tab"]) ?> 
        </li>
        <li>
        <?=  anchor('signin', 'Host login', ["class"=>"nav-link $logTab","role"=>"tab","ria-selected"=>"false","aria-controls"=>"signinForm","aria-selected"=>"false","id"=>"signin-tab"]) ?> 
	      <!-- <a id="signin-tab" data-toggle="tab" href="#signinForm"> -->
       </li> 
      </ul>
      <div class="tab-content cform-content">
        <div class="tab-pane fade <?php echo $regact_class; ?>" id="signupForm" role="tabpanel" aria-labelledby="signup-tab">
          <!-- Register form start-->         
            <?= form_open('',["id"=>"signupBox","onsubmit"=>"registerHere(); return false;"]);?>
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <?= form_input(['name'=>'first_name','id'=>'first_name','class'=>'form-control charText','placeholder'=>'First Name','value'=>set_value('fist_name'),"type"=>"text","required"=>"required"]); ?>
              <div id="first_name"></div>
              <?= form_input(['name'=>'last_name','id'=>'last_name','class'=>'form-control charText','placeholder'=>'Last Name','value'=>set_value('last_name'),'required'=>'required']);?>
            </div>
            <div class="form-group">
              <label class="col-form-label">Contact</label>
              <?= form_input(['name'=>'mob_num','id'=>'mob_num','class'=>'form-control','placeholder'=>'Mobile Number','value'=>set_value('mob_num'),'type'=>'number','minlength'=>'10','required'=>'required','maxlength'=>'14']);?>
              <span id="mob_num_error" style="display:none; margin-bottom: .625rem; font-size: 11px; color:red; margin-top: -12px;">Contact Number should be minimum  10 digit</span>
              <?= form_input(['name'=>'email_Id','id'=>'email_Id','class'=>'form-control','placeholder'=>'Email ID','value'=>set_value('email_Id'),'type'=>'email','required'=>'required']); ?>
              <span id="email_error" style="display: none; font-size: 14px; color:red;">Enter Currect email ID </span>
            </div>
            <div class="form-group">
              <label class="col-form-sublabel align-middle  mr-2 ml-2">I am</label>
              <div class="custom-control custom-radio custom-control-inline align-middle ml-3">
                <input type="radio" id="iamIndividual" name="iam" class="custom-control-input"  value="individual">
                <label class="custom-control-label" for="iamIndividual"> An Individual</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline align-middle ml-3">
                <input type="radio" id="iamCompany" name="iam" class="custom-control-input"  value="company" checked="">
                <label class="custom-control-label" for="iamCompany"> A Company</label>
              </div>
            </div>
           
            <div class="form-group text-right pt-3 clearfix">
  
      <a href="#" class="btn btn-link">Learn, Beacome a host</a>
              <?= form_submit(['name'=>'submit','id'=>'callOTP','value'=>'Continue','class'=>'btn btn-primary btn-lg','type'=>'submit']) ?>
            </div>
            <!-- <div class="form-thirdParty">
              <p>You can also Signup with-</p>
              <a href="javascript:void(0);" title="Facebook" class="facebook" onclick="FBRegistration()" data-logger="Facebook Page"><img src="<?= base_url('assets/img/icon/facebook.png');?>" width="25" alt="facebook" /> Facebook</a>
			  <a href="javascript:void(0);" title="Googleplus" class="googleplus" id="gp_registration" onclick="googleAuthenticate()" data-logger="Google Page"><img src="<?= base_url('assets/img/icon/gmail.png');?>" width="25" alt="gmail" /> Gmail</a> </div> -->
          <?= form_close();?>

          <!-- form otp start -->
          <?= form_open('',["id"=>"otpBox", "class"=>"hidden","onsubmit"=>"otpCheck(); return false;"]);?>
            <div class="form-group">
              <label class="col-form-label">OTP Verification</label>
              <p class="col-form-sublabel">Please enter the OTP shared on your email</p>
              <?= form_input(['name'=>'otp','id'=>'otp','class'=>'form-control','placeholder'=>'OTP','value'=>set_value('otp'),'required'=>'required','type'=>'number']); ?>
            </div>
            <div class="form-group text-right pt-4 clearfix">
              <?=  anchor('signup', 'Cancel', ['class'=>'btn btn-link btn-lg text-default float-left']) ?>
              <?= form_submit(['name'=>'submit','value'=>'Confirm','class'=>'btn btn-primary btn-lg float-right']) ?>
              <?=  anchor('', 'Resend', ['class'=>'btn btn-link btn-lg float-right',"onclick"=>"resendOtp(); return false;"]) ?> 
            </div>
         <?= form_close(); ?>

        </div>
<!-- form otp esnd -->
<!-- Login  Form  start -->
        <div class="tab-pane fade <?php echo $loginact_class; ?>" id="signinForm" role="tabpanel" aria-labelledby="signin-tab">
          <?= form_open('',['id'=>'loginBox',"onsubmit"=>"loginUser(); return false;"]);?>
		  <div class="form-group">
              <label class="col-form-label">Login Details</label>
              <?= form_input(['name'=>'email','id'=>'email','class'=>'form-control','placeholder'=>'Email ID','value'=>set_value('email'),'type'=>'email','required'=>'required']); ?>
              <?= form_input(['name'=>'password','id'=>'password','class'=>'form-control','type'=>'password','placeholder'=>'Password','value'=>set_value('password'),'required'=>'required']); ?>
            </div>

            <div class="form-group text-right pt-3 clearfix">
              <?=  anchor('', 'Forgot Password', ['class'=>'btn btn-link btn-sm mt-2 float-left', "id"=>"callForgot","onclick"=>"forgotPass(); return false;"]); ?>
              <?= form_submit(['name'=>'submit','value'=>'Continue','class'=>'btn btn-primary btn-lg float-right']) ?>
   <!-- login form end-->           
            </div>
            <?php /*
            <div class="form-thirdParty">
              <p>You can also login with-</p>
              <a href="javascript:void(0);" title="Facebook" class="facebook" onclick="FBRegistration()" data-logger="Facebook Page"><img src="<?= base_url('assets/img/icon/facebook.png');?>" width="25" alt="facebook" /> Facebook</a>
			  <a href="javascript:void(0);" title="Googleplus" class="googleplus" id="gp_registration" onclick="googleAuthenticate()" data-logger="Google Page"><img src="<?= base_url('assets/img/icon/gmail.png');?>" width="25" alt="gmail" /> Gmail</a>
			  <!--<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark"></div>-->
			  </div> */ ?>
         <?= form_close();?>
  <!-- login form end-->
          <!-- forgot form start-->       
         <?= form_open('',["id"=>"forgotBox","class"=>"hidden","onsubmit"=>"getPass(); return false;"]);?>
            <div class="form-group">
              <label class="col-form-label">Forgot Password</label>
              <p class="col-form-sublabel">Please enter your registered Email ID</p>
            
              <?= form_input(['name'=>'reg_email','id'=>'reg_email','class'=>'form-control','placeholder'=>'Email ID','value'=>set_value('reg_email'),'type'=>'email','required'=>'required']); ?>
            </div>
            <div class="form-group text-right pt-4">
              <?=  anchor('', 'Cancel', ['class'=>'btn btn-link text-default  btn-lg', 'id'=>'callCancel',"onclick"=>"cancle(); return false;"]) ?>
              <?= form_submit(['name'=>'submit','value'=>'Continue','class'=>'btn btn-primary btn-lg']) ?>
            </div>
            <?= form_close();?>
  <!-- forgot form start-->      
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
        <div class="carousel-item active" style="background-image:url(assets/img/banners/register/banner_01.jpg);"> <img src="<?= base_url('assets/img/banners/register/banner_01.jpg')?>" alt="banner_01" />
          <div class="carousel-caption">
          <!--  <p><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="Loc" /> Chhatarpur, Madhya Pradesh</p> -->
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/img/banners/register/banner_02.jpg);"> <img src="<?= base_url('assets/img/banners/register/banner_02.jpg')?>" alt="banner_02" />
          <div class="carousel-caption">
          <!--  <p><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="Loc" /> Taj ul Masajid, Madhya Pradesh</p>-->
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/img/banners/register/banner_03.jpg);"> <img src="<?= base_url('assets/img/banners/register/banner_03.jpg')?>" alt="banner_03" />
          <div class="carousel-caption">
           <!-- <p><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="Loc" /> Tomb of  Mohammad Ghaus,  Madhya Pradesh</p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL -->
<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h5 class="modal-title pb-3 pt-3"> <span class="modal-titleIcon"><img src="<?php echo base_url();?>assets/img/icon/namaste.svg" alt="namaste" /></span> Hello, <span id="userName"></span></h5>
        <p class="font-weight-semibold text-center">A IWL Account is already registered with your email address <span id="email_id"></span>.</p><small class="text-center d-block pt-2">Type your registered account password to associate with it.</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-link text-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- script Start --> 
<?php include('script.php'); ?>

<!-- Script Start-->
<script type="text/javascript">
(function($) {

//IMAGE SLIDER
$('.carousel').carousel({
    interval: 5000
});

 
})(jQuery);

/*.............Social Media Registration.................*/
var countryCode = null;
var ipAddress = null;
var currencyType = null;
var currentModel = '';

(function(d, s, id) 
	{
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js";
		  fjs.parentNode.insertBefore(js, fjs);
	}
	(document, 'script', 'facebook-jssdk'));
	window.fbAsyncInit = function() 
	{
		FB.init({
		  appId      : '308743896492615',
		  cookie     : true,  // enable cookies to allow the server to access 
							  // the session
		  xfbml      : true,  // parse social plugins on this page
		  version    : 'v2.3' // use version 2.3
		});  
	};
	
function FBRegistration()
{    	
      FB.login(function(response) 
	  {
          if (response.authResponse) 
          {
            getUserDetl();
          } else
          {
          // alert('Authorization failed.');
          }
       },
	   {scope: 'public_profile,email'});
}
function getUserDetl() 
{ 
    FB.api('/me', { locale: 'en_US', fields: 'id,first_name,last_name,email,picture,name' }, function(response) 
	{  
	   //console.log(response);return false;
	    var fname=response.first_name;
		var lname=response.last_name;
		var name=response.name;
		var email=response.email;
		var id=response.id;
		var profilurl=response.picture.data.url;
		var provider = "facebook";
		var userDetails = {};		 
		  userDetails.provider = "facebook"; //google/facebook/twitter
		  userDetails.locale = "en_US";
		  userDetails._csrf=$("meta[name=_csrf]").attr('content');

		  //below information will come from social sites
		  userDetails.userMailId = email;
		  userDetails.providerId = id;
		  userDetails.userFirstName = fname;
		  userDetails.userLastName = lname;
		  //userDetails.gender = "male";
		  userDetails.profilePicUrl = profilurl;
		  //userDetails.location = "";
		  userDetails.profileUrl = profilurl;	  
		var jsonData = JSON.stringify(userDetails);
		  //console.log(jsonData);return false;
		  //send JSON to API using curl
		  //curlCallLogin(jsonData);
		  curlCallLogin(fname,lname,email,id,profilurl,provider);

    });
}

function curlCallLogin(fname,lname,email,id,profilurl,provider)
{	
	$.ajax({
			url: '<?php echo base_url();?>Account/facebookLogin',
			//dataType: "json",
			//headers:{"accept": "application/json"},
			type: "POST",
			//contentType: "application/json",
			data: {fname:fname,lname:lname,email:email,id:id,profilurl:profilurl,provider:provider},
		    success: function (data) 
			{	console.log(data);
			    if(data==='email_error'){
				    $('#userName').html(fname+' '+lname);
					$('#email_id').html(email);
					$('#errorModal').modal();
					return false;
					}
				else if(data==='facebook_login'){
					 window.location.href = "<?php echo base_url();?>profile";
					}
					
			   else if(data==='login_success'){
					 window.location.href = "<?php echo base_url();?>profile";
					}
					
				else if(data=='my_itinerary'){
				       //location.href = "<?= base_url('itineraries');?>";
					   window.location.href = "<?php echo base_url();?>itineraries";
					}
					
				
			},
			error: function (data, errorThrown) 
			{
			} 			
		}); 
}

//=========== Google Login Js ================//
(function() {
    var e = document.createElement("script");
    e.type = "text/javascript";
    e.async = true;
    e.src = "https://apis.google.com/js/client:platform.js?onload=gPOnLoad";
    var t = document.getElementsByTagName("script")[0];
    t.parentNode.insertBefore(e, t)
})();

function googleAuthenticate() 
{	
    gapi.auth.signIn({
        callback: gPRegistrationInCallback,
        clientid: '1068375123183-pao0rolvdko1vrhpll7rhhi8nr8bttd9.apps.googleusercontent.com',
        cookiepolicy: "single_host_origin",
        requestvisibleactions: "http://schema.org/AddAction",
        scope: "https://www.googleapis.com/auth/plus.login email"
    })
}

function gPRegistrationInCallback(e) 
{
    if (e["status"]["signed_in"]) 
	{
        gapi.client.load("plus", "v1", function() 
		{
            if (e["access_token"]) 
			{
                getProfile_detl()
            } else if (e["errormsg"]) 
			{
                console.log("There was an errormsg: " + e["errormsg"])
            }
        })
    } else 
	{
        console.log("Sign-in state: " + e["errormsg"])
    }
}

var call0nce=0;
function getProfile_detl() 
{
    var e = gapi.client.plus.people.get({
        userId: "me"
    });
    e.execute(function(e) 
	{   
        if (e.errormsg) 
		{
			call0nce=0;
            console.log(e.message);
            return
        } 
		else if (e.id) 
		{		
			if(call0nce==1)
			return false
			else
			call0nce=1;
			var name=e.displayName;
			var id=e.id;
			for(i = 0; i < e['emails'].length; i++)
			{
				if(e['emails'][i]['type'] == 'account')
				{
					email = e['emails'][i]['value'];
				}
			}  
			var img=e.image.url;
			var profilurl=e.url;
			var userDetails = {};	  
	        var provider = "google";
			
	  //userDetails.provider = "google"; //google/facebook/twitter
	  //userDetails.locale = "en_US";		  
	  userDetails.userMailId = email;
	  userDetails.providerId = id;
	  userDetails.userFirstName = name;	  
	  //userDetails.gender = "male";
	  userDetails.profilePicUrl = img;	  
	  userDetails.profileUrl = profilurl;  
	  var jsonData = JSON.stringify(userDetails);
	  //console.log(jsonData);
	  
	  GoogleLogin(name,id,email,profilurl,provider);
	 
        }
    })
}

function GoogleLogin(name,id,email,profilurl,provider){
	$.ajax({
		 type:'post',
		 url:'<?php echo base_url();?>Account/googleLogin',
		 data:{userFullName:name,userId:id,userEmail:email,userPic:profilurl,userProvider:provider},
		 success:function(data){
			   console.log(data);
			   if($.trim(data)==='email_error'){
				    $('#userName').html(userFullName);
					$('#email_id').html(email);
					$('#errorModal').modal();
					return false;
					}
				else if($.trim(data)==='google_login'){
					 window.location.href = "<?php echo base_url();?>profile";
					}
					
			   else if($.trim(data)==='login_success'){
					 window.location.href = "<?php echo base_url();?>profile";
					}
					
				else if($.trim(data)=='my_itinerary'){				      
					   window.location.href = "<?php echo base_url();?>itineraries";
					}
			 }
	});
}

/*$('.charText').keypress(function(e) {
		var key = e.keyCode;
		if (key >= 48 && key <= 57) {
			e.preventDefault();
		}
	});*/
</script>
<?php include('footer.php'); ?>

