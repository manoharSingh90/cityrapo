<?phpinclude('header.php'); 

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
               
              if(data == 'Please check OTP On Your Email And Verify'){

                $('#otpBox').show();
                $('#signupBox').hide();
                //$("#demo").html(data);
                $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+data+'</div>');

                 $("#loadingmessage").css('display','none');
              }else{
                $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+data+'</div>');
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
              //alert(otpData);
              if(otppData == 'Registration Successfull'){
                $('.alert').remove();
                $('#otpBox').hide();
                $('#thanksBox').show();
                $("#loadingmessage").css('display','none');
              }else{
                 $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+otppData+'</div>');
                 //$("#demo").html(otppData).css('display','block');
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
              if(otpData == 'Please Check Next OTP On Your Email And Verify'){
                $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+otpData+'</div>');
                $("#loadingmessage").css('display','none');
             
              }else{
                 //$("#demo").html(otpData);
                 $('#alert-msg').html('<div class="alert alert-danger mb-0 mt-3 text-center" role="alert" id="demo" >'+otpData+'</div>');
                 //$("#demo").html(otpData).css('display','block');
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


        function forgotPass()
        {
          $('#forgotBox').show();
          $('#loginBox').hide();
          var forgot = 'Please enter your registered Email ID';
          //$("#demo").html(forgot);
          $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+forgot+'</div>');
        //$("#demo").html(forgot).css('display','block'); 
        };

        function getPass()
        {
          var reg_email = $('#reg_email').val();
          $.ajax({
              type: "POST",
              data: {reg_email:reg_email},
              url: "<?= base_url('account/check_email')?>",
              beforeSend:function(){
              $("#loadingmessage").css('display','block');
              },

              success: function(forgotData){

                  if(forgotData == 'success'){

                   var msg =  'Check Your Mail And Get Password';
                    $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+msg+'</div>');
                    //$("#demo").html('Check Your Mail And Get Password').css('display','block'); 
                    $('#loginBox').show();
                    $('#forgotBox').hide();
                    $("#loadingmessage").css('display','none'); 
                    
                    
                  }else{

                    //$("#demo").html(forgotData);
                    $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+forgotData+'</div>');
                   // $("#demo").html(forgotData).css('display','block'); 
                    $("#loadingmessage").css('display','none');
                  }
                 
              }
           });
        }

        function cancle()
        {

            $('#forgotBox').hide();
            $('#loginBox').show();
            //$('#signinForm form').trigger('reset');
             location.href = "<?= base_url('signin');?>";

        };  

             

</script>  
<div class="credentialPage">
  <h1 class="credentialLogo"><img src="<?= base_url('assets/img/logo.png')?>" alt="India with locals" /></h1>
  <div class="credentialForm">
    <p class="cform-logo"><img src="<?= base_url('assets/img/logo_black.png')?>" alt="India with locals" /></p>
    <h2 class="cform-title">With us you can safely discover India of Now</h2>
<!-- Error and Success Msg-->
   

<div id="alert-msg">
  
</div>
   
	  
    <div class="cform-box clearfix">

      <div id="thanksBox" class="thanksBox clearfix">
        <h2 class="col-form-label">Thank you</h2>
        <p>We have recieved your registration request. Please check your email for verification:</p>
        <ul>
          <li><span></span>
            <p><strong class="d-block text-uppercase">VERIFY YOUR ACCOUNT</strong>Click on the link shared on your email along with your new password.</p>
          </li>
          <li><span></span>
            <p><strong class="d-block text-uppercase">SETUP YOUR PROFILE</strong>Create your profile with the link shared on your email so we can process it.</p>
          </li>
          <li><span></span>
            <p><strong class="d-block text-uppercase">REGISTRATION COMPLETE</strong>Once your details have been approved, your registration will be complete. You will recieve a confirmation email.</p>
          </li>
        </ul>
        <?=  anchor('home', 'Back to Home',['class'=>'btn btn-primary btn-lg float-right']) ?>  </div>
      <div id='loadingmessage' class="loaderBox">
        <span><img src="<?= base_url('assets/img/loader.svg')?>"/></span>  
      </div>
      <ul class="nav nav-tabs cform-tab" role="tablist">
        <li class="nav-item"> 
         <a id="signup-tab" data-toggle="tab" href="#" class="nav-link" > 
          
          <!--<?=  anchor('#', 'Join as a host', ["class"=>"nav-link ","role"=>"tab" ,"ria-selected"=>"true","aria-controls"=>"signup","aria-selected"=>"true","id"=>"signup-ta"]) ?>--> 
        </li>
        <li>
        <?=  anchor('signin', 'Host login', ["class"=>"nav-link active","role"=>"tab","ria-selected"=>"false","aria-controls"=>"signinForm","aria-selected"=>"false","id"=>"signin-tab"]) ?> 

        <!-- <a id="signin-tab" data-toggle="tab" href="#signinForm" > -->
       </li> 
      </ul>
      <div class="tab-content cform-content">
        <div class="tab-pane fade " id="signupForm" role="tabpanel" aria-labelledby="signup-tab">
          <!-- Register form start-->         
            <?= form_open('',["id"=>"signupBox","onsubmit"=>"registerHere(); return false;"]);?>
            <div class="form-group">
              <label class="col-form-label">Name</label>
              <?= form_input(['name'=>'first_name','id'=>'first_name','class'=>'form-control','placeholder'=>'First Name','value'=>set_value('fist_name'),"type"=>"text","required"=>"required"]); ?>
              <div id="first_name"></div>
              <?= form_input(['name'=>'last_name','id'=>'last_name','class'=>'form-control','placeholder'=>'Last Name','value'=>set_value('last_name'),'required'=>'required']);?>
              
             
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
              
              <?= form_submit(['name'=>'submit','id'=>'callOTP','value'=>'Continue','class'=>'btn btn-primary btn-lg','type'=>'submit']) ?>
            </div>
            <div class="form-thirdParty">
              <p>You can also Signup with-</p>
              <a href="#"><img src="<?= base_url('assets/img/icon/facebook.png');?>" width="25" alt="facebook" /> Facebook</a> <a href="#"><img src="<?= base_url('assets/img/icon/gmail.png');?>" width="25" alt="gmail" /> Gmail</a> </div>
          <?= form_close();?>
<!-- form otp start -->
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
        <div class="tab-pane fade show active " id="signinForm" role="tabpanel" aria-labelledby="signin-tab">
          <?= form_open('',['id'=>'loginBox',"onsubmit"=>"loginUser(); return false;"]);?>

            <div class="form-group">
              <label class="col-form-label">Login Details</label>
              <?= form_input(['name'=>'email','id'=>'email','class'=>'form-control','placeholder'=>'Email ID','value'=>set_value('email'),'type'=>'email','required'=>'required']); ?>
              <?= form_input(['name'=>'password','id'=>'password','class'=>'form-control','type'=>'password','placeholder'=>'Password','value'=>set_value('password'),'required'=>'required']); ?>
              
            </div>

            <div class="form-group text-right pt-3 clearfix">
              
              <?=  anchor('', 'Forgot Password', ['class'=>'btn btn-link btn-lg float-left', "id"=>"callForgot","onclick"=>"forgotPass(); return false;"]); ?>
              <?= form_submit(['name'=>'submit','value'=>'Continue','class'=>'btn btn-primary btn-lg float-right']) ?>
   <!-- login form end-->           
            </div>
            <div class="form-thirdParty">
              <p>You can also login with-</p>
              <a href="#"><img src="<?= base_url('assets/img/icon/facebook.png');?>" width="25" alt="facebook" /> Facebook</a> <a href="#"><img src="<?= base_url('assets/img/icon/gmail.png');?>" width="25" alt="gmail" /> Gmail</a> </div>
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
            <p><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="Loc" /> Chhatarpur, Madhya Pradesh</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/img/banners/register/banner_02.jpg);"> <img src="<?= base_url('assets/img/banners/register/banner_02.jpg')?>" alt="banner_02" />
          <div class="carousel-caption">
            <p><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="Loc" /> Taj ul Masajid, Madhya Pradesh</p>
          </div>
        </div>
        <div class="carousel-item" style="background-image:url(assets/img/banners/register/banner_03.jpg);"> <img src="<?= base_url('assets/img/banners/register/banner_03.jpg')?>" alt="banner_03" />
          <div class="carousel-caption">
            <p><img src="<?= base_url('assets/img/icon/loc.svg')?>" alt="Loc" /> Tomb of  Mohammad Ghaus,  Madhya Pradesh<</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('script.php'); ?>

<!-- Script Start-->
<script type="text/javascript">           
(function($) {
//IMAGE SLIDER
$('.carousel').carousel({
    interval: 3000
});


// GO BACK TO SIGNIN


// GO BACK TO SIGNUP
// $('#callSignup').on('click', function() {
//     $('#otpBox').hide();
//     $('#signupBox').show();
//     $('#signupForm form').trigger('reset');
// });

// TAB FUNCTION
// var hash = window.location.hash;
// hash && $('ul.cform-tab a[href="' + hash + '"]').tab('show');

// $('a[data-toggle="tab"]').on('show.bs.tab', function() {
//    // window.location.hash = this.hash;
//     $('.alert').remove();
// });

// $('a[data-toggle="tab"]').on('shown.bs.tab', function() {
//     $('form').trigger('reset');
//   $('#signupBox, #loginBox').show();
//     $('#otpBox, #forgotBox').hide();
// });
  
})(jQuery);
  </script>
<?php include('footer.php'); ?>
<!-- Script Start-->

