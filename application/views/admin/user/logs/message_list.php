<script type="text/javascript">
    var userId = '<?= $user_id; ?>';
</script>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="col-md-3" style="padding-left: 0">
            <div class="caption">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject font-green-haze sbold uppercase"> User Information </span>
            </div>
        </div>
        <div class="actions usename">
            <?php echo $user_name; ?>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">
            <!--<div class="col-md-3">-->
                <?php //echo userSidebar('logs', $user_name, $user_id); ?>
            <!--</div>-->
            <div class="col-md-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="portlet light">
                            <?php //echo userTabBar('message', $user_id); ?>
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Message List</span>
                                </div>
                                <div class="actions">
                                    <select class="form-control slectOption">
                                        <option value="all">All Time</option>
                                        <option value="<?php echo date('Y-m-d');?>">Today</option>
                                        <option value="<?php echo date('Y-m-d',strtotime("yesterday"));?>">Yesterday</option>
                                        <option value="<?php echo date('Y-m-d', strtotime('-7 days')).'TO'.date('Y-m-d');?>">Last 7 Days</option>
                                        <option value="<?php echo date('Y-m-d', strtotime('-30 days')).'TO'.date('Y-m-d');?>">Last 30 days</option>
                                        <option value="thismonth">This Month</option>
                                        <option value="lastmonth">Last Month</option>
                                    </select>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="message_table">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Number</th>
                                            <th>Text</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Type</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>