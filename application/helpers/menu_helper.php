<?php

function userSidebar($class, $userName, $userId) {

    if ($class == 'overview') {
        $overview = 'active';
    } else if($class == 'application'){
        $application = 'active';
    }else if($class == 'gallary'){
        $gallary = 'active';
    } else if($class == 'video'){
        $video = 'active';
    } else if($class == 'screen_video'){
        $screen_video = 'active';
    } else if($class == 'screen_photo'){
        $screen_photo = 'active';
    } else if($class == 'geo_location'){
        $geo_location = 'active';
    }else {
        $logs = 'active';
    }

    $html = '<div class="profile-sidebar">
                    <div class="profile-sidebar-portlet ">
                        <div class="profile-userpic">
                            <img src="<?= NO_IMAGE; ?>" class="img-responsive" alt=""> </div>
                        <div class="profile-usertitle">
                            <div class="profile-usertitle-name"> ' . $userName . ' </div>
                        </div>
                        <div class="profile-usermenu">
                            <ul class="nav">
                                <li class="' . $overview . '">
                                    <a href="' . admin_url() . 'user/overview/' . $userId . '">
                                        <i class="icon-home"></i> Overview </a>
                                </li>
                                <li class="' . $application . '">
                                    <a href="' . admin_url() . 'user/application/' . $userId . '">
                                        <i class="icon-home"></i> Application </a>
                                </li>
                                <li class="' . $logs . '">
                                    <a href="' . admin_url() . 'user/contact/' . $userId . '">
                                        <i class="icon-settings"></i> Logs </a>
                                </li>
                                <li class="' . $gallary . '">
                                    <a href="' . admin_url() . 'user/gallary/' . $userId . '">
                                        <i class="icon-settings"></i> Gallary </a>
                                </li>
                                <li class="' . $screen_photo . '">
                                    <a href="' . admin_url() . 'user/screen_photo/' . $userId . '">
                                        <i class="icon-settings"></i> Screen Photo </a>
                                </li>
                                <li class="' . $video . '">
                                    <a href="' . admin_url() . 'user/video/' . $userId . '">
                                        <i class="icon-settings"></i> Videos </a>
                                </li>
                                <li class="' . $screen_video . '">
                                    <a href="' . admin_url() . 'user/screen_video/' . $userId . '">
                                        <i class="icon-settings"></i> Screen Video </a>
                                </li>
                                <li class="' . $geo_location . '">
                                    <a href="' . admin_url() . 'user/geo_location/' . $userId . '">
                                        <i class="icon-settings"></i> Geo Location </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>';

    return $html;
}


function userTabBar($class,$userId){
    
    if($class == 'contact'){
        $contact = 'active';
        
    }else if($class == 'call'){
        $call = 'active';
        
    }else if($class == 'message'){
        $message = 'active';
        
    }else if($class == 'key_logger'){
        $key_logger = 'active';
        
    }else if($class == 'browser_history'){
        $browser_history = 'active';
        
    }else if($class == 'social_media'){
        $social_media = 'active';
        
    }
    
    $html = '<ul class="nav nav-tabs">
                <li>
                    <a href="javascript:;" data-toggle="tab" aria-expanded="true"></a>
                </li>
                <li class="'.$contact.'">
                    <a href="'. admin_url().'user/contact/'.$userId.'">Contact</a>
                </li>
                <li class="'.$call.'">
                    <a href="'.admin_url().'user/call/'.$userId.'">Call</a>
                </li>
                <li class="'.$message.'">
                    <a href="'.admin_url().'user/message/'.$userId.'">Message</a>
                </li>
                <li class="'.$key_logger.'">
                    <a href="'.admin_url().'user/key_logger/'.$userId.'">Key Logger</a>
                </li>
                <li class="'.$browser_history.'">
                    <a href="'.admin_url().'user/browser_history/'.$userId.'">Browser History</a>
                </li>
                <li class="'.$social_media.'">
                    <a href="'.admin_url().'user/social_media/'.$userId.'">Social Media</a>
                </li>            
            </ul>';
    
    return $html;
}

?>