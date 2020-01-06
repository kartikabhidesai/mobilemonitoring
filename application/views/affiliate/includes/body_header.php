<div class="page-header navbar navbar-fixed-top">
    <div class="page-header-inner ">
        <div class="page-logo">
            <a href="<?= affiliate_url('dashboard'); ?>">
                <img src="<?= base_url() . DISPLAY_LOGO; ?>" alt="<?= get_project_name(); ?>" class="logo-default" height="40" style="margin-top:4px;"/>
            </a>
            <div class="menu-toggler sidebar-toggler"></div>
        </div>
        <div class="close-manu-logo">
            
            <a href="<?= affiliate_url('dashboard'); ?>">
                <img src="<?= base_url() . DISPLAY_LOGO; ?>" alt="<?= get_project_name(); ?>" class="logo-default" height="40" style="margin-top:4px;"/>
            </a>
        </div>
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                       
                        <img alt="" class="img-circle" style="width: 29px;"
                             src=""/>
                        <span class="username username-hide-on-mobile">
                            <?php echo $this->session->userdata['valid_login']['name'];?>
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo base_url() . 'account/logout/login_user'; ?>">
                                <i class="icon-key"></i> Log Out
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="clearfix"></div>