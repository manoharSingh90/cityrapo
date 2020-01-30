<?php
$url = $this->uri->segment(2);
$itineraryUrl = $this->uri->segment(1);

if (!empty($hostimage) && !empty($allowItinerary)) { ?>
<header>
    <div class="container clearfix">
        <h1 class="cmyLogo"><img src="<?php echo base_url(); ?>assets/img/iwl_hr_org_logo.svg" alt="City Explorers" /></h1>
        <nav class="navbar navbar-expand-lg">
            <div id="navbarContent" class="collapse navbar-collapse">
                <ul class="menuLinks">
                    <li class="<?php if ($url == 'itineraries' || $url == 'walk' || $url == 'session' || $url == 'experience' || $url == 'meetup' || $url == '') echo 'active'; ?>"> <a href="<?php echo base_url(); ?>itineraries">My Itineraries</a></li>
                    <li class="<?php if ($url == 'browse_itineraries') echo 'active'; ?>"><a href="<?php echo base_url(); ?>itineraries/browse_itineraries">Browse Itineraries</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <?php if ($hostimage[0]->profile_picture !== '') {
                  $profilePic = 'assets/upload/profile_pic/' . $hostimage[0]->profile_picture;
                } else {
                  $profilePic = 'assets/img/placeholder.jpg';
                } ?>
                <div class="profileMenu"> <span class="profileImage"><img
                            src="<?php echo base_url(); ?><?php echo $profilePic; ?>" alt="user" /></span>
                    <ul class="profileLinks">
                        <li>
                            <?php if ($allowItinerary[0]->admin_status != 5) { ?>
                            <a href="<?php echo base_url(); ?>profile">Profile</a>
                            <?php } else {
                              echo '<a href="myprofile">Profile</a>';
                            } ?>
                        </li>
                        <li><a href="<?php echo base_url(); ?>log_out">Logout</a></li>
                    </ul>
                </div>
            </div>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarContent"> <span class="navbar-toggler-icon"></span> </button>
        </nav>
    </div>
</header>
<?php } else { ?>
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
<?php } ?>