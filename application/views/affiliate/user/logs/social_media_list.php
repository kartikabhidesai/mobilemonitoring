<script type="text/javascript">
    var userId = '<?= $user_id; ?>';
    var type = '<?= $type; ?>';
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
                            <?php //echo userTabBar('social_media', $user_id); ?>
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Social Media List</span>
                                </div>
                                <div class="actions">
                                    <select class="form-control slectOption">
                                        <option value="all">All</option>
                                        <option value="1" <?php if($type == '1') {echo "selected = 'selected'"; }?>>WhatsApp</option>
                                        <option value="2" <?php if($type == '2') {echo "selected = 'selected'"; }?>>Facebook</option>
                                        <option value="3" <?php if($type == '3') {echo "selected = 'selected'"; }?>>Gmail</option>
                                    </select>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <table class="table table-striped table-bordered table-hover" id="social_media_table">
                                    <thead>
                                        <tr role="row" class="heading">
                                             <th>No</th>
                                            <th>Icon</th>
                                            <th>Application Name</th>
                                            <th>Text</th>
                                            <th>Date time</th>
                                            <th>Sender Name</th>
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