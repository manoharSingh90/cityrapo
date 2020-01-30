<?php include('head.php')?>
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
<?php include('leave_msg.php');?>
<!-- SCRIPT --> 
<!-- SCRIPT --> 
<?php include('foot.php')?>
</body>
</html>
