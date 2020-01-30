<?php include('head.php');?>
  <!-- HEADER START-->
<?php 
	$basedir = realpath(__DIR__);
	 $link_array = explode('/',$basedir);
     $page = end($link_array);
	if($page=='footer_page'){
		$path = str_replace('/footer_page','/itineraries',$basedir);
		}
	if(isset($loggedInUser)){
		include ($path.'/header.php');
		}
	else{
		include ('header.php');
		}	
	?>
<!--  HEADER END -->
<main>  
 <div class="container">
  <br>
  <div id="alert"></div>
  <h2>Contact form</h2>
  <form class="form-horizontal" id="contactForm">
    <div class="form-group placeVaild">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" required data-rule-required="true" autocomplete="off">
      </div>
    </div>
    <div class="form-group placeVaild">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required data-rule-required="true" autocomplete="off">
      </div>
    </div>
	 <div class="form-group placeVaild">
      <label class="control-label col-sm-2" for="mobile">Mobile Number:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" id="mobile" placeholder="Enter Your Mobile Number" name="mobile" 
		required data-rule-required="true" autocomplete="off">
      </div>
    </div>
    <div class="form-group placeVaild">
      <label class="control-label col-sm-2" for="message">Message:</label>
      <div class="col-sm-10">          
        <textarea class="form-control" id="message" placeholder="Enter Message" name="message" required data-rule-required="true"></textarea>
      </div>
    </div>    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-danger sendQuery">Send Query</button>
      </div>
    </div>
  </form>
</div>
    
</main>
<!-- FOOTER START-->
<?php include('footer.php');?>
<!-- FOOTER END-->
<!-- LEAVE MESSAGE -->
<?php include('leave_msg.php');?>
<!-- SCRIPT --> 
<!-- foot start-->
<?php include('foot.php');?>
<!-- foot end -->

<script type="text/javascript">
// submit Contact Form
	$("#contactForm").validate({
		errorElement: 'small',
		errorPlacement: function(error, element) {
		error.appendTo(element.closest(".placeVaild"));
	},
	  submitHandler: function() {		 
		 contactQueryForm();
	   }
});

function contactQueryForm(){
	var formData = $('#contactForm').serialize();
	var proceed = true;
	$('.sendQuery').html('....Please Wait Loading');
	if(proceed){
		 $.ajax({
			  type:'post',
			  url:'<?php echo base_url()?>Footer/sendContactForm',
			  data:formData,
			  success:function(html){
			       console.log(html);
			       $('.sendQuery').html('Send Query')
				   if(html=='success'){
				      $('#alert').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> Your Query has been Send Successfully.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
					   $('#contactForm')[0].reset();
					   }
				   else{
					   $('#alert').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Oops!</strong> Somthing is wrong.<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span></button></div>');
					   }	   
				  }
			 });
		}
}
</script>
</body>
</html>
