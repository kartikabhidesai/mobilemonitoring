<style>
    a.Stop{color: red;}
    a.Start{color: green;}
</style>
<div class="row">
    <div class="col-md-12 col-sm-12">
        <div class="portlet light portlet-fit portlet-datatable bordered">
            <div class="portlet-title">
                <div class="col-md-3" style="padding-left: 0">
                    <div class="caption">
                        <i class="icon-settings font-green-haze"></i>
                        <span class="caption-subject font-green-haze sbold uppercase"> User List </span>
                    </div>
                </div>
                <div class="actions">
                    <a href="<?php echo affiliate_url().'user/add_user'?>" class="btn blue">
                     <i class="fa fa-plus"></i> Add </a>
                </div>
            </div>
            <div class="portlet-body">
                <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="user_table">
                        <thead>
                        <tr role="row" class="heading">
                            <th>No</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone no</th>
                            <th>User Pin</th>
                            <th>Device name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>