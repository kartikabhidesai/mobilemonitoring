<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit portlet-form bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-bubble font-green"></i>
                    <span class="caption-subject font-green bold uppercase">User Edit</span>
                </div>
                <div class="actions">
                </div>
            </div>
            <div class="portlet-body">
                <!-- BEGIN FORM-->
                <form class="form-horizontal" id="userEdit" method="post" action="<?= admin_url().'affiliate/user_edit/'.$this->utility->encode($userData[0]->id); ?>">
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
                            <label class="control-label col-md-3">User Limit: </label>
                            <div class="col-md-4">
                                <input type="text" name="user_limit" class="form-control" value="<?= $userData[0]->limit_user; ?>">
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