<?php 
	$uri = $this->uri->segment(1);	
	$ses = $this->session->userdata('adminSes');
	$itinerary_url = $this->uri->segment(2);
	?>
<header class="clearfix">
  <h1 class="cmyLogo"><img src="<?php echo base_url();?>adminassets/assets/img/iwl_hr_white_logo.svg" alt="India with locals" /></h1>
  <nav class="navbar navbar-expand-lg">
    <div id="navbarContent" class="collapse navbar-collapse">
      <ul class="menuLinks">
	  <?php 
	      if($ses['admin_type']==4 || $ses['admin_type']==5){
		       $action = 'translator_reqitineraries';
			  }
		else{
			$action = 'all_itineraries';
			}
				
		  if($ses['admin_type']==1 || $ses['admin_type']==3 || $ses['admin_type']==4 || $ses['admin_type']==5 || $ses['admin_type']==6
		  || $ses['admin_type']==7){
		  ?>
        <li class="nav-item <?php if($uri=='all_itineraries' || $uri=='itineraries_request' || $itinerary_url=='admin_detail_itineraries_sessions' || $itinerary_url=='admin_detail_itineraries_meetup' || $itinerary_url=='admin_detail_itineraries_experience' || $itinerary_url=='detail_itineraries' || $uri=='translator_reqitineraries' ||
		$uri=='translator_all_itineraries')
			echo 'active';?>"> <a class="nav-link" href="<?php echo base_url();?><?php echo $action;?>">Itineraries</a> </li>
		 <?php } 
		if($ses['admin_type']==1 || $ses['admin_type']==2 || $ses['admin_type']==6 || $ses['admin_type']==7){ 
		  ?>
        <li class="nav-item <?php if($uri=='host' || $uri=='request')echo 'active';else{}?>"> <a class="nav-link" href="<?php echo base_url();?>host">Host</a> </li>
		<?php } ?>
      </ul>
      <div class="startLinks"> <a href="<?php echo base_url();?>admin/logout">Logout</a> </div>
    </div>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarContent"> <img src="<?php echo base_url();?>assets/img/icon/menu.svg" alt="menu"></button>
  </nav>
</header>