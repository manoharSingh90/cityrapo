<?php include('head.php');?>
<?php include('header.php');?>
<main>
  <div class="thanksPage">
    <div class="container-fluid">
      <h2 class="pb-3 text-uppercase"> <span class="filled"><img src="<?= base_url('assets/img/icon/walk_cancel.svg')?>" alt="cancel" /></span>Booking Unsuccessful!</h2>
      <h3 class="font-weight-bold text-center">BOOKING ID:<?php echo $bookingId;?></h3>
      <p class="font-weight-semibold text-center pl-2 pr-2">Your booking is unsuccessful. This may be due to technical reasons,<br>connection error or your bank declined the payment. Please check and try again.</p>
      <?= anchor('home','Go Back',['class'=>'btn btn-link text-primary'])?></div>
  </div>
</main>
<?php include('footer.php');?>
	
	<!-- LEAVE MESSAGE -->
<div class="leaveMessage"> <a href="#" class="msgLink">Leave a message</a>
  <div class="messageForm">
    <form>
      <h2 class="text-secondary">Leave a message</h2>
      <ul class="form-row">
        <li class="form-group col-12">
          <label class="col-form-sublabel">Full Name</label>
          <input type="text" class="form-control" placeholder="Full Name" required />
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Email</label>
          <input type="email" class="form-control" placeholder="Email" required/>
        </li>
        <li class="form-group col-12">
          <label class="col-form-sublabel">Phone</label>
          <input type="number" class="form-control" placeholder="Phone" required/>
        </li>
        <li class="form-group col-12">
          <textarea class="form-control" placeholder="Write your message (max. 400 chartacters)" maxlength="400" required></textarea>
        </li>
        <li class="form-group col-12 text-right">
          <button class="btn btn-primary">Send</button>
        </li>
      </ul>
    </form>
  </div>
</div>

<!-- SCRIPT --> 
<?php include('head.php');?>
</body>
</html>
