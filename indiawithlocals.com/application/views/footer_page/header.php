<header class="clearfix">
  <h1 class="cmyLogo"><img src="<?= base_url('assets/img/iwl_hr_white_logo.svg')?>" alt="India with locals" /></h1>
  <nav class="navbar navbar-expand-lg">
    <div id="navbarContent" class="collapse navbar-collapse">
      <ul class="menuLinks">
        <li class="nav-item ">  
         <?=  anchor('home', 'Home',['class'=>'nav-link']) ?>
        </li>
        <!-- <li class="nav-item"> <a class="nav-link" href="#">Browse Tours</a> </li> -->
      </ul>
      <div class="startLinks"> <?=  anchor("contact", 'Support') ?> 
    
    <!-- <?=  anchor('signup', 'Become A Host') ?> 
    
    <?php if($this->session->userdata('id')){ ?>
        <?=  anchor('log_out', 'Logout') ?>
    <?php }else{ ?>
      <?=  anchor('signin', 'Login') ?> 
    <?php } ?> -->
  </div>
    </div>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarContent"> <span class="navbar-toggler-icon"></span> </button>
  </nav>
</header>