<script type="text/javascript">
    var userId = '<?= $user_id; ?>';
</script>
<link rel="stylesheet" href="https://rawgit.com/LeshikJanz/libraries/master/Bootstrap/baguetteBox.min.css">
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
                                    <span class="caption-subject font-blue-madison bold uppercase">Snapshots List</span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="grid">
                                    <div class="tz-gallery" id="appendData" last-id="<?php echo $last_id; ?>">

                                        <?php
                                        for ($i = 0; $i < count($gallaryData); $i++) {
                                            $img = explode('.', $gallaryData[$i]->image);
                                            ?>
                                            <div class="lightbox">

                                                <figure class="effect-goliath">
                                                    <img src="<?php echo base_url() . 'public/upload/screen_photo/' . $img[0] . '_thumb.' . $img[1]; ?>" alt="img23"/>
                                                    <figcaption>
                                                        <p>
                                                            <a href="#">Download</a> 
                                                            <a href="<?php echo base_url() . 'public/upload/screen_photo/' . $gallaryData[$i]->image; ?>">View Large</a>
                                                        </p>
                                                    </figcaption>			
                                                </figure>
                                            </div>
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
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
 <script>
    baguetteBox.run('.tz-gallery');
</script> 
