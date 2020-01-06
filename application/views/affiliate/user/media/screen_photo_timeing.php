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
                <?php //echo userSidebar('screen_photo' , $user_name , $user_id); ?>
            <!--</div>-->
            <div class="col-md-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Snapshots timeing</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="col-md-12">
                                    <form class="form-wizard" action="<?php echo $formAction; ?>" method="post" id="screenPicId">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                                <input type="text" class="form-control form_datetime" name="start_date_time" placeholder="Start date time">
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control form_datetime" name="end_date_time" placeholder="End date time">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="time_interval" class="form-control" placeholder="Select Time Interval">
                                                    <option value="">Select Interval</option>
                                                    <?php for($i=1; $i<= 60; $i++){ ?>
                                                        <option value="<?php echo $i;?>"><?php echo $i.' Min'; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="screen_pic_time">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th>No</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Time Interval</th>
                                            <th>View</th>
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