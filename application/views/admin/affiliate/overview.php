<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">Affiliate view</span>
                </div>
                <div class="actions">
                    <a href="<?php echo admin_url() . 'affiliate/user/' . $id; ?>" class="btn green-haze">
                        <i class="fa fa-eye"></i> User List </a>
                        <a href="<?php echo admin_url() . 'affiliate/user_edit/' . $id; ?>" class="btn green-haze">
                        <i class="fa fa-edit"></i> Edit User Limit</a>
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" method="post">
                    <div class="form-body">
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">User Name : </label>
                            <div class="col-md-4"> <label class="control-label"><?= $userData[0]->user_name; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Email : </label>
                            <div class="col-md-4"> <label class="control-label"><?= $userData[0]->email; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Phone no : </label>
                            <div class="col-md-4"> <label class="control-label"><?= $userData[0]->phone_no; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Company Name : </label>
                            <div class="col-md-4"> <label class="control-label"><?= $userData[0]->company_name; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Url : </label>
                            <div class="col-md-4"> <label class="control-label"><?= $userData[0]->url; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">User Limit: </label>
                            <div class="col-md-4"> <label class="control-label"><?= $userData[0]->limit_user; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Subscription Start Date: </label>
                            <div class="col-md-4"> <label class="control-label"><?= ($userData[0]->subscription_start_date) ? $userData[0]->subscription_start_date : '-'; ?></label></div>
                        </div>
                        <div class="form-group  margin-top-20">
                            <label class="control-label col-md-3">Subscription End Date: </label>
                            <div class="col-md-4"> <label class="control-label"><?= ($userData[0]->subscription_end_date) ? $userData[0]->subscription_end_date : '-'; ?></label></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>