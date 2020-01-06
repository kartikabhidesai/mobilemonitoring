<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">User Add</span>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" id="userAdd" method="post" action="<?= affiliate_url().'user/add_user/'; ?>">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">User Name : </label>
                            <div class="col-md-4"> 
                                <input class="form-control placeholder-no-fix" type="text" placeholder="Enter Username" name="name" value="<?php echo set_value('name');?>"/>
                                <span for="name" class="help-inline text-danger customeMessage">
                                    <?php echo form_error('name'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email : </label>
                            <div class="col-md-4">
                                <input class="form-control placeholder-no-fix" type="text" placeholder="Enter Email" name="email" value="<?php echo set_value('email');?>"/> 
                                <span for="email" class="help-inline text-danger customeMessage">
                                    <?php echo form_error('email'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Phone : </label>
                            <div class="col-md-4">
                               <input class="form-control placeholder-no-fix" type="text" autocomplete="off" value="<?php echo set_value('phone');?>" placeholder="Enter Your Phone" name="phone" />
                                <span for="phone" class="help-inline text-danger customeMessage">
                                    <?php echo form_error('phone'); ?>
                                </span>
                            </div>
                        </div>
                        <div class="form-actions">
                        <div class="row">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn blue">Submit</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>