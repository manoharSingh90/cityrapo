<!-- SCRIPT --> 
<script type="text/javascript" src="<?= base_url('assets/js/jquery-3.3.1.min.js')?>"></script> 
<script type="text/javascript" src="<?= base_url('assets/js/jquery-migrate-1.4.1.min.js')?>"></script> 
<script type="text/javascript" src="<?= base_url('assets/dependencies/popper/popper.min.js')?>"></script> 
<script type="text/javascript" src="<?= base_url('assets/dependencies/bootstrap-4.1.2/dist/js/bootstrap.min.js')?>"></script> 
<script type="text/javascript">
	
	var url = '<?php echo SITEURL?>';

//COUNT LEAVE MSG CHARTACTERS 
	function countChar(val) {
        var len = val.value.length;
        if (len >= 400) {
          val.value = val.value.substring(0, 400);
        } else {
          $('#charNum').text(400 - len);
        }
      }; 

//LEAVE MSG SEND      
      function leaveMsg(){
        //alert('leave msg');

        var user_name  = $('#full_name').val();
        var user_email = $('#email').val();
        var user_phone = $('#phone').val();
        var user_msg   = $('#msg').val();
        var len = user_phone.length;
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
          type:"POST",
          data:{user_name:user_name,user_email:user_email,user_phone:user_phone,user_msg:user_msg},
           url:url+'leave_msg',
           beforeSend:function(){
              $("#loadingmessage").css('display','block');
            },
           success: function(data){
            //alert(data);
            $('#alert-msg').html('<div class="alert alert-success mb-0 mt-3 text-center" role="alert" id="demo" >'+data+'</div>');
            $("#loadingmessage").css('display','none');
           }

        });


      }
	
</script>



