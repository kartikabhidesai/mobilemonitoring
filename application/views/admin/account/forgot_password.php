<style>
    .error{ color:#ed6b75;}
</style>
<div class="content">
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form action="<?= base_url().'account/forgetPassword'?>" id="forgotPass" method="post">
        <h3 class="font-green">Forget Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>Enter Email Address Is Invalid. </span>
        </div>
        <div class="alert alert-success display-hide">
            <button class="close" data-close="alert"></button>
            <span> Password Sent To your Email. </span>
        </div>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" id="forgetemail" type="text" autocomplete="off" placeholder="Email" name="email" />
            <span for="fname" class="help-inline text-danger customeMessage">
                <?php echo form_error('email'); ?>
            </span>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">Back</button>
            <button type="submit" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
   
</div>