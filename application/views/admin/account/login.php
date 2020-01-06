<style type="text/css">
    .login .content .create-account{
        background-color : #096284cc !important;
    }
    .login .content .create-account p a{
        color : #ffffff !important;
    }
</style>
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" id="login_form" action="<?= base_url() . 'account/login' ?>" method="post">
        <h3 class="form-title font-green">Sign In</h3>
        <?php echo $this->session->flashdata('myMessage'); ?>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Email address and password not match. </span>
        </div>
        <div class="alert alert-success display-hide">
            <button class="close" data-close="alert"></button>
            <span> Login successfully done  </span>
        </div>
        <div class="alert warnings alert-warning display-hide">
            <button class="close" data-close="alert"></button>
            <span> Please Varify Your Email Address  </span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" value="<?php echo get_cookie('username'); ?>" type="text" autocomplete="off" placeholder="Username" id="user" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" value="<?php echo get_cookie('password'); ?>" type="password" autocomplete="off" id="pass" placeholder="Password" name="password" /> </div>
        <div class="form-actions">

            <button type="submit" class="btn green uppercase" value="login">Login</button>
            <label class="rememberme check">
                <input type="checkbox" id="remember" name="remember" value="1" <?php
                if (get_cookie('username') != '') {
                    echo 'checked="checked"';
                }
                ?> />Remember</label>
            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        </div>
        <div class="create-account">
            <p>
                <a href="<?php echo base_url().'account/registration'?>" class="uppercase">Register Admin</a>
            </p>
        </div>
    </form>
</div>