<?php include('head.php')?>
<?php include('header.php');?>

<main>
  <div class="soonPage" style="background-image: url(assets/img/banners/soon/cover.png)">
    <div class="container-fluid">
      <div class="row no-gutters">
        <div class="col-12 col-sm-12 col-md-6">
          <div class="soonBox">
            <h2>Coming Soon!</h2>
            <p>We are currently working on this section and will have it up and running shortly!</p>
            <p class="contactLine"><span class="d-block font-weight-semibold">You can reach us at</span> <span class="text-primary">+91 729 197 2715</span> <span class="text-primary">ask@iwl.help</span></p>
          </div>
        </div>
        <div class="col-12 col-sm-12 col-md-6">
          <div class="newsletterForm">
            <div class="form-group form-row">
              <div class="col-12">
                <label class="col-form-sublabel text-white pb-4">In the meantime, you can sign up to our newsletter and get updates about the latest tours added every day!</label>
                <input type="email" class="form-control text-white" placeholder="Email">
              </div>
              <div class="col-12 text-right">
                <button class="btn btn-secondary btn-lg mt-4">Subscribe Now</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
<?php include('foot.php')?>
</body>
</html>
