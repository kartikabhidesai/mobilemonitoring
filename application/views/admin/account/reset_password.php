<style>
    .error{ color:#ed6b75;}
</style>
<div class="content">
    <!-- BEGIN REGISTRATION FORM -->
    <form method="post" id="resetPass" action="<?= base_url().'account/changePassword/'.$formAction?>">
        <h3 class="font-green">Reset Password</h3>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" value="<?php echo set_value('password'); ?>" type="password" autocomplete="off" id="resetpassword" placeholder="Password" name="password" /> 
            <span for="password" class="help-inline text-danger customeMessage">
                <?php echo form_error('password'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <input class="form-control placeholder-no-fix" value="<?php echo set_value('rpassword'); ?>" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" />
            <span for="rpassword" class="help-inline text-danger customeMessage">
                <?php echo form_error('rpassword'); ?>
            </span>
        </div>
        <div class="form-actions">
            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>