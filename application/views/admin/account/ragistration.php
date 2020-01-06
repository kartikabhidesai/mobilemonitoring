<style>
    .error{ color:#ed6b75;}
</style>
<div class="content">
    <!-- BEGIN REGISTRATION FORM -->
    <form method="post" id="registration_form" action="<?= base_url().'account/registration'?>">
        <h3 class="font-green">Register Admin </h3>
        <br/>
        <div class="form-group">  
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control placeholder-no-fix" type="hidden" name="type" value="3"/>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Enter Username" name="name" value="<?php echo set_value('name');?>"/>
            <span for="name" class="help-inline text-danger customeMessage">
                <?php echo form_error('name'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Enter Email" name="email" value="<?php echo set_value('email');?>"/> 
            <span for="email" class="help-inline text-danger customeMessage">
                <?php echo form_error('email'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" value="<?php echo set_value('password');?>" id="register_password" placeholder="Enter Password" name="password" /> 
            <span for="password" class="help-inline text-danger customeMessage">
                <?php echo form_error('password'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" />
            <span for="rpassword" class="help-inline text-danger customeMessage">
                <?php echo form_error('rpassword'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Phone no</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="<?php echo set_value('phone');?>" placeholder="Enter Your Phone" name="phone" />
            <span for="phone" class="help-inline text-danger customeMessage">
                <?php echo form_error('phone'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Company name</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="<?php echo set_value('company_name');?>" placeholder="Enter Your Company name" name="company_name" />
            <span for="company_name" class="help-inline text-danger customeMessage">
                <?php echo form_error('company_name'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Url</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="<?php echo set_value('url');?>" placeholder="Enter Your url" name="url" />
            <span for="url" class="help-inline text-danger customeMessage">
                <?php echo form_error('url'); ?>
            </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Total Ueser</label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="<?php echo set_value('total_users');?>" placeholder="Enter Number of User" name="total_users" />
            <span for="total_users" class="help-inline text-danger customeMessage">
                <?php echo form_error('total_users'); ?>
            </span>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn btn-default">Back</button>
            <button type="submit" id="register-submit-btn" class="btn btn green uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>