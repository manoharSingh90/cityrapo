<?php
	$url = $this->uri->segment(1);	
	?>
<header>
    <div class="container clearfix">
    <h1 class="cmyLogo"><a href="<?= base_url(); ?>home"><img src="<?php echo base_url(); ?>assets/img/iwl_hr_org_logo.svg" alt="City Explorers" /></a></h1>
        <nav class="navbar navbar-expand-lg">
            <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="menuLinks">
                    <li class="nav-item active">
                        <?= anchor('home', 'Home', ['class' => 'nav-link gradientText']) ?>
                    </li>
                </ul>
                <div class="startLinks">
                    <?= anchor("contact", 'Support') ?>
                    <?= anchor('signup', 'Become A Host', ['id' => 'abc']) ?>
                    <?php if ($this->session->userdata('id')) { ?>
                    <?= anchor('log_out', 'Logout', ['id' => 'abc']) ?>
                    <?php } else { ?>
                    <?= anchor('signin', 'Login', ['id' => 'abc']) ?>
                    <?php } ?>
                </div>
            </div>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarContent"> <img src="<?= base_url('assets/img/icon/menu.svg') ?>" alt="menu"></button>
        </nav>
    </div>
</header>
