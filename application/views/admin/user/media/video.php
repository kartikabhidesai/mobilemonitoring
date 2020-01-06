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
                <?php //echo userSidebar('video', $user_name, $user_id); ?>
            <!--</div>-->
            <div class="col-md-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Video List</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="grid" id="appendData" last-id="<?php echo $last_id; ?>">
                                    <?php
                                    for($i=0; $i<count($videoData); $i++){ ?>
                                    <figure class="effect-goliath">
					<video width="226" height="170" controls>
                                          <source src="<?php echo base_url().'public/upload/videos/'.$videoData[$i]->video; ?>" type="video/mp4">
                                        </video>
                                    </figure>
                                    <?php } ?>
				</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>