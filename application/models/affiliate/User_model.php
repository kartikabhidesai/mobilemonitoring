<?php
class User_model extends My_model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function addUser($postData){
        
        $randNum = $this->randomString();
        $checkRandom = $this->checkRandomeStr($randNum);
        
        if(!empty($checkRandom)){
            $this->addUser($postData);
            return FALSE;
        }
        
        $checkUserLimit = $this->checkUserLimit($this->userId);
        
        if($checkUserLimit[0]->total_user < $checkUserLimit[0]->limit_user){
            $data['insert']['user_name'] = $postData['name'];
            $data['insert']['email'] = $postData['email'];
            $data['insert']['password'] = md5($randNum);
            $data['insert']['phone_no'] = $postData['phone'];
            $data['insert']['type'] = '2';
            $data['insert']['status'] = '1';
            $data['insert']['monitoring_status'] = '1';
            $data['insert']['user_pin'] = $randNum;
            $data['insert']['parent_id'] = $this->userId;
            $data['insert']['created_date'] = DATE_TIME;
            $data['insert']['updated_date'] = DATE_TIME;
            $data['table'] = TABLE_USER;
            $result = $this->insertRecord($data);

            unset($data);

            if($result){

                $data['update']['total_user'] = ($checkUserLimit[0]->total_user) + 1;
                $data['where'] = ['id' => $this->userId];
                $data['table'] = TABLE_USER;
                $updateUser = $this->updateRecords($data);

                unset($data);
                
                $getApplication = $this->getApplicationStatus();
                
                for($i=0; $i<count($getApplication); $i++){
                    
                    $data['insert']['user_id'] = $result;
                    $data['insert']['app_id'] = $getApplication[$i]->id;
                    $data['insert']['status'] = $getApplication[$i]->status;
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_USER_HAS_APPLICATION;
                    $userApplication = $this->insertRecord($data);
                    
                }
                
                $json_response['status'] = 'success';
                $json_response['message'] = 'User added successfully';
                $json_response['redirect'] = affiliate_url().'user';

            }else{

                $json_response['status'] = 'error';
                $json_response['message'] = DEFAULT_MESSAGE;
                $json_response['redirect'] = affiliate_url().'user';

            }
        }else{
            $json_response['status'] = 'error';
            $json_response['message'] = 'Sorry, You have reached maximum user limit as per your define plan. Please contact to admin to increse your user limit';
            $json_response['redirect'] = affiliate_url().'user';
        }
        
        return $json_response;
    }
    
    function getApplicationStatus(){
        
        $data['select'] = ['id','name','status'];
        $data['table'] = TABLE_APPLICATION;
        $result = $this->selectRecords($data);
        
        return $result;
    }
    
    function checkUserLimit($user_id){
        $data['select'] = ['limit_user','total_user'];
        $data['where'] = ['id' => $user_id];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);
        
        return $result;
    }
    
    
    public function handleMonitoringStatus($postData){
        $id = $this->utility->decode($postData['id']);
       
        if($postData['status'] == 'Stop'){
            $statusText = 'Start';
            $status = '1';
            $mgs = 'Monitoring status start successfully';
            
        }else if($postData['status'] == 'Start'){
            $statusText = 'Stop';
            $status = '0';
            $mgs = 'Monitoring status stop successfully';
            
        }
        
        $deviceData = $this->getDeviceData($postData['id']);
        
        if (!empty($deviceData)) {

            $message = array(
                'message' => 'Monitoring Status',
                'type' => 'Monitoring Status',
                'status' => $statusText
            );
            
            $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message, 'status');
        }

        $data['update']['monitoring_status'] = $status;
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_USER;
        $result = $this->updateRecords($data);
        
        
        if($result){
            $json_response['status'] = 'success';
            $json_response['message'] = $mgs;
        }else{
            $json_response['status'] = 'error';
            $json_response['message'] = DEFAULT_MESSAGE;
        }
        
        return $json_response;
    }
    
    function handleAppStatus($postData){
        $id = $this->utility->decode($postData['id']);
       
//        if($postData['status'] == 'hide'){
            $statusText = 'show';
            $mgs = 'Application show successfully';
            
//        }else if($postData['status'] == 'show'){
//            $statusText = 'hide';
//            $mgs = 'Application hide successfully';
//        }
        
        $deviceData = $this->getDeviceData($postData['id']);
        
        if (!empty($deviceData)) {

            $message = array(
                'message' => 'Application Visible status',
                'type' => 'Application Visible status',
                'app_setting' => ucfirst($statusText),
            );
            
            $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message, 'app_setting');
        }

        $data['update']['app_setting'] = $statusText;
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_USER;
        $result = $this->updateRecords($data);
        
        
//        if($result){
            $json_response['status'] = 'success';
            $json_response['message'] = $mgs;
//        }else{
//            $json_response['status'] = 'error';
//            $json_response['message'] = DEFAULT_MESSAGE;
//        }
        
        return $json_response;
    }
            
    function checkRandomeStr($randNum){
        
        $data['where'] = ['user_pin' => $randNum];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);
        
        return $result;
    }
    
    function randomString() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        
        for ($i = 0; $i < 6; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        
        return implode($pass); //turn the array into a string
    }

    public function handleStatus($postData){
        
        $data['update']['status'] = $postData['status'];
        $data['where'] = ['id' => $postData['id'],'user_id' => $this->utility->decode($postData['user_id'])];
        $data['table'] = TABLE_USER_HAS_APPLICATION;
        $updateStatus = $this->updateRecords($data);
        
        unset($data);
        
        $data['select'] = ['a.name','au.status'];
        $data['table'] = TABLE_USER_HAS_APPLICATION . ' au';
        $data['join'] = [
            TABLE_APPLICATION . " as a" => [
                "a.id = au.app_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['au.user_id' => $this->utility->decode($postData['user_id'])];
        $applicationList = $this->selectFromJoin($data);
        $applicationData = json_encode($applicationList);
        
        unset($data);
        
        $deviceData = $this->getDeviceData($postData['user_id']);
        
        if (!empty($deviceData)) {
            
            $message = array(
                'message' => 'Change in application setting',
                'type' => 'Application Setting',
                'application_data' => $applicationData,
            );
            
            $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message , 'application_data');
        }
        
        
        return TRUE;
    }
    
    public function getDeviceData($userId){
        $userId = $this->utility->decode($userId);
        
        $data['select'] = ['device_id','token','device_name'];
        $data['where'] = ['user_id' => $userId];
        $data['table'] = TABLE_DEVICE;
        $deviceData = $this->selectRecords($data);
        
        return $deviceData;
    }

    public function getGallaryData($userId , $status , $timeId = NULL , $offset = NULL){
        $data['select'] = ['id','image','date','time'];
        if($timeId){
            $data['where'] = ['user_id' => $userId , 'type' => $status , 'screen_id' => $timeId];
        }else{
            $data['where'] = ['user_id' => $userId , 'type' => $status];
        }
        
        if(($offset)){
            $data['limit'] = "28";
            $cal = $offset - 1;
            $data['skip'] = $cal * 28;
        }else{
            $data['limit'] = '28';
        }
        $data['order'] = 'id desc';
        $data['table'] = TABLE_GALLARY;
        $result = $this->selectRecords($data);
        return $result;
    }
    
    public function getVideoData($userId , $status , $timeId = NULL , $offset = NULL){
        $data['select'] = ['id','video','date','time'];
        if($timeId){
            $data['where'] = ['user_id' => $userId , 'type' => $status , 'screen_id' => $timeId];
        }else{
            $data['where'] = ['user_id' => $userId , 'type' => $status];
        }
        
        if(($offset)){
            $data['limit'] = "28";
            $cal = $offset - 1;
            $data['skip'] = $cal * 28;
        }else{
            $data['limit'] = '28';
        }
        $data['order'] = 'id desc';
        $data['table'] = TABLE_VIDEO;
        $result = $this->selectRecords($data);
        return $result;
    }
    
    public function setScreenPicTimeingSetting($postData) {
        
        $checkStartEnd = $this->checkStartEnd($postData['start_date_time'], TABLE_SCREEN_PHOTO_HAS_TIME , $this->utility->decode($postData['user_id']));

        if (empty($checkStartEnd)) {
            $checkDate = $this->checkDate($postData['start_date_time'], $postData['end_date_time']);
            if ($checkDate) {

                $data['insert']['user_id'] = $this->utility->decode($postData['user_id']);
                $data['insert']['start_date_time'] = date('Y-m-d H:i:s', strtotime($postData['start_date_time']));
                $data['insert']['end_date_time'] = date('Y-m-d H:i:s', strtotime($postData['end_date_time']));
                $data['insert']['time_interval'] = $postData['time_interval'];
                $data['insert']['dt_created'] = DATE_TIME;
                $data['insert']['dt_updated'] = DATE_TIME;
                $data['table'] = TABLE_SCREEN_PHOTO_HAS_TIME;
                $result = $this->insertRecord($data);

                if ($result) {
                    $deviceData = $this->getDeviceData($postData['user_id']);
                    if (!empty($deviceData)) {

                        $data_array = array(
                            'id' => $result,
                            'start_date_time' => date('Y-m-d H:i:s', strtotime($postData['start_date_time'])),
                            'end_date_time' => date('Y-m-d H:i:s', strtotime($postData['end_date_time'])),
                            'time_interval' => $postData['time_interval'],
                        );

                        $screenData = json_encode($data_array);

                        $message = array(
                            'message' => 'New timeing added in screen picture setting',
                            'type' => 'Screen picture setting',
                            'screen_data' => $screenData,
                        );

                        $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message, 'screen_data');
                    }
                    
                    $json_response['status'] = 'success';
                    $json_response['message'] = 'Timeing added successfully for screen photo';
                    $json_response['reload'] = TRUE;
                    
                } else {
                    
                    $json_response['status'] = 'error';
                    $json_response['message'] = 'Something went wrong';
                    
                }
            } else {
                
                $json_response['status'] = 'warning';
                $json_response['message'] = 'End date must be grater than start date';
                
            }
        } else {
            
            $json_response['status'] = 'warning';
            $json_response['message'] = 'Sorry this date already exists';
                
        }


        return $json_response;
    }

    public function setVideoTimeingSetting($postData) {
        
        $checkStartEnd = $this->checkStartEnd($postData['start_date_time'], TABLE_SCREEN_VIDEO_HAS_TIME , $this->utility->decode($postData['user_id']));

        if (empty($checkStartEnd)) {
            $checkDate = $this->checkDate($postData['start_date_time'], $postData['end_date_time']);

            if ($checkDate) {
                $data['insert']['user_id'] = $this->utility->decode($postData['user_id']);
                $data['insert']['start_date_time'] = date('Y-m-d H:i:s', strtotime($postData['start_date_time']));
                $data['insert']['end_date_time'] = date('Y-m-d H:i:s', strtotime($postData['end_date_time']));
                $data['insert']['dt_created'] = DATE_TIME;
                $data['insert']['dt_updated'] = DATE_TIME;
                $data['table'] = TABLE_SCREEN_VIDEO_HAS_TIME;
                $result = $this->insertRecord($data);

                if ($result) {
                    $deviceData = $this->getDeviceData($postData['user_id']);
                    if (!empty($deviceData)) {

                        $data_array = array(
                            'id' => $result,
                            'start_date_time' => date('Y-m-d H:i:s', strtotime($postData['start_date_time'])),
                            'end_date_time' => date('Y-m-d H:i:s', strtotime($postData['end_date_time'])),
                        );

                        $videoData = json_encode($data_array);

                        $message = array(
                            'message' => 'New timeing added in screen picture setting',
                            'type' => 'Video screen setting',
                            'video_data' => $videoData,
                        );

                        $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message, 'video_data');
                    }
                    
                    $json_response['status'] = 'success';
                    $json_response['message'] = 'Timeing added successfully for screen video';
                    $json_response['reload'] = TRUE;
                    
                } else {

                    $json_response['status'] = 'error';
                    $json_response['message'] = 'Something went wrong';
                
                }
            } else {
                
                $json_response['status'] = 'warning';
                $json_response['message'] = 'End date must be grater than start date';
                
            }
        } else {
            
            $json_response['status'] = 'warning';
            $json_response['message'] = 'Sorry this date alreay exists';
        }


        return $json_response;
    }

    public function checkStartEnd($startDate,$table , $user_id){
        $this->db->where('user_id' , $user_id);
        $this->db->where('end_date_time >=' , $startDate);
        $result = $this->db->get($table)->row();
        return $result;
    }

    public function checkDate($startDate,$endDate){
        $startDate = strtotime($startDate);
        $endDate = strtotime($endDate);
        
        
        if($endDate > $startDate){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    /* Handle Pic Status */
    
    public function handlePicStatus($postData){
        $user_id = $this->utility->decode($postData['user_id']);
        $id = $this->utility->decode($postData['id']);
        
        $data['update']['status'] = $postData['status'];
        $data['update']['end_date_time'] = DATE_TIME;
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_SCREEN_PHOTO_HAS_TIME;
        $result = $this->updateRecords($data);
        
        unset($data);
        
        if($result){
            if ($postData['status'] == '0') {
                $deviceData = $this->getDeviceData($postData['user_id']);
                
                if (!empty($deviceData)) {
                    
                    $data['select'] = ['id','start_date_time','end_date_time','time_interval'];
                    $data['where'] = ['id' => $id];
                    $data['table'] = TABLE_SCREEN_PHOTO_HAS_TIME;
                    $getData = $this->selectFromJoin($data, $array = TRUE);
                    
                    unset($data);
                    
                    $screenData = json_encode($getData[0]);

                    $message = array(
                        'message' => 'New timeing added in screen picture setting',
                        'type' => 'Screen picture setting stop',
                        'screen_data' => $screenData,
                    );

                    $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message, 'screen_data');
                }
            }
        }
        return $result;
    }
    
    /* Handle Video Status */
    
    public function handleVideoStatus($postData){
        $id = $this->utility->decode($postData['id']);
        
        $data['update']['status'] = $postData['status'];
        $data['update']['end_date_time'] = DATE_TIME;
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_SCREEN_VIDEO_HAS_TIME;
        $result = $this->updateRecords($data);
        
        if($result){
            if ($postData['status'] == '0') {
                $deviceData = $this->getDeviceData($postData['user_id']);
                
                if (!empty($deviceData)) {
                    
                    $data['select'] = ['id','start_date_time','end_date_time'];
                    $data['where'] = ['id' => $id];
                    $data['table'] = TABLE_SCREEN_VIDEO_HAS_TIME;
                    $getData = $this->selectFromJoin($data, $array = TRUE);
                    
                    unset($data);
                    
                    $videoData = json_encode($getData[0]);

                    $message = array(
                        'message' => 'New timeing added in screen picture setting',
                        'type' => 'Video screen setting stop',
                        'video_data' => $videoData,
                    );

                    $notificationSend = $this->utility->sendNotification($deviceData[0]->token, $message , 'video_data');
                }
            }
        }
        
        return $result;
    }
    
    /*Get Recent Feeds*/
    
    public function getRecentFeeds($id){
        $data['select'] = ['user_id','name','number','text','type','time','date'];
        $data['where'] = ['user_id' => $id];
        $data['limit'] = '5';
        $data['order'] = 'id DESC';
        $data['table'] = TABLE_MESSAGE;
        $messageData = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['user_id','name','number','call_type','time','date','duration'];
        $data['where'] = ['user_id' => $id];
        $data['limit'] = '5';
        $data['order'] = 'id DESC';
        $data['table'] = TABLE_CALL_LOG;
        $callData = $this->selectRecords($data);
        
        unset($data);
//        
//        $data['select'] = ['user_id','package_name','text','date','time'];
//        $data['where'] = ['user_id' => $id];
//        $data['limit'] = '1';
//        $data['order'] = 'id DESC';
//        $data['table'] = TABLE_SOCIAL_MEDIA;
//        $socialData = $this->selectRecords($data);
//        
//        unset($data);
        
        $data_array = array(
            'call_data' => $callData,
            'message_data' => $messageData,
//            'social_data' => $socialData
        );
        
        return $data_array;
    }
    
    /*Get Chart Data*/
    
    public function getChartData($id){
        $data['select'] = ['COUNT(id) as totaltContact'];
        $data['where'] = ['user_id' => $id];
        $data['table'] = TABLE_CONTACT;
        $contactCount = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totaltCalls'];
        $data['where'] = ['user_id' => $id];
        $data['table'] = TABLE_CALL_LOG;
        $callCount = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totaltMessages'];
        $data['where'] = ['user_id' => $id];
        $data['table'] = TABLE_MESSAGE;
        $messageCount = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalSocialMedia'];
        $data['where'] = ['user_id' => $id];
        $data['table'] = TABLE_SOCIAL_MEDIA;
        $socialMedaiCount = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalGallry'];
        $data['where'] = ['user_id' => $id ,'type' => 'G'];
        $data['table'] = TABLE_GALLARY;
        $gallaryCount = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalScreenPic'];
        $data['where'] = ['user_id' => $id ,'type' => 'SP'];
        $data['table'] = TABLE_GALLARY;
        $screenPicCount = $this->selectRecords($data);
        
        unset($data);
        
        
        $data['select'] = ['COUNT(id) as totalVideo'];
        $data['where'] = ['user_id' => $id ,'type' => 'V'];
        $data['table'] = TABLE_VIDEO;
        $videoCount = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalscreenVideo'];
        $data['where'] = ['user_id' => $id ,'type' => 'VS'];
        $data['table'] = TABLE_VIDEO;
        $videoScreenCount = $this->selectRecords($data);
        
        unset($data);
        
        $data_array = array(
            'contact' => $contactCount[0]->totaltContact,
            'call' => $callCount[0]->totaltCalls,
            'message' => $messageCount[0]->totaltMessages,
            'social_media' => $socialMedaiCount[0]->totalSocialMedia,
            'gallery' => $gallaryCount[0]->totalGallry,
            'snapshots' => $screenPicCount[0]->totalScreenPic,
            'video' => $videoCount[0]->totalVideo,
            'video_recording' => $videoScreenCount[0]->totalscreenVideo,
        );
        
        return $data_array;
    }
    
    
    public function getGeoLocation($id){
       $ids = $this->utility->decode($id);
       
       $data['select'] = ['id','latitude','longitude','date','time'];
       $data['where'] = ['user_id' => $ids];
       $data['table'] = TABLE_GEO_LOCATION;
       $result = $this->selectRecords($data);
       
       return $result;
       
    }
    
    public function getCallType($id){
        
      
        $data['select'] = ['COUNT(id) as totalIncoming'];
        $data['where'] = ['user_id' => $id , 'call_type' => 'incoming'];
        $data['table'] = TABLE_CALL_LOG;
        $incomingCall = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalOutgoing'];
        $data['where'] = ['user_id' => $id , 'call_type' => 'outgoing'];
        $data['table'] = TABLE_CALL_LOG;
        $outgoingCall = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalMisscall'];
        $data['where'] = ['user_id' => $id , 'call_type' => 'missedcall'];
        $data['table'] = TABLE_CALL_LOG;
        $missCall = $this->selectRecords($data);
        
        unset($data);
        
        $data_array = array(
            'incoming' => $incomingCall[0]->totalIncoming,
            'outgoing' => $outgoingCall[0]->totalOutgoing,
            'missedcall' => $missCall[0]->totalMisscall,
        );
        
        return $data_array;
    }
    
    public function getMessageType($id){
        
        $data['select'] = ['COUNT(id) as totaltInbox'];
        $data['where'] = ['user_id' => $id , 'type' => 'inbox'];
        $data['table'] = TABLE_MESSAGE;
        $messageInbox = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totaltSent'];
        $data['where'] = ['user_id' => $id , 'type' => 'sent'];
        $data['table'] = TABLE_MESSAGE;
        $messageSent = $this->selectRecords($data);
        
        unset($data);
        
        $data_array = array(
            'sent' => $messageSent[0]->totaltSent,
            'inbox' => $messageInbox[0]->totaltInbox,
        );
        
        return $data_array;
    }
    
    public function getSocialype($id){
        
        $data['select'] = ['COUNT(id) as totalWhatsapp'];
        $data['where'] = ['user_id' => $id ,'application_id' => '1'];
        $data['table'] = TABLE_SOCIAL_MEDIA;
        $whatsApp = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalFacebbok'];
        $data['where'] = ['user_id' => $id ,'application_id' => '2'];
        $data['table'] = TABLE_SOCIAL_MEDIA;
        $facebook = $this->selectRecords($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(id) as totalGmail'];
        $data['where'] = ['user_id' => $id ,'application_id' => '3'];
        $data['table'] = TABLE_SOCIAL_MEDIA;
        $gmail = $this->selectRecords($data);
        
        unset($data);
        
        $data_array = array(
            'whatsapp' => $whatsApp[0]->totalWhatsapp,
            'facebbox' => $facebook[0]->totalFacebbok,
            'gmail' => $gmail[0]->totalGmail,
        );
        
        return $data_array;
    }
    
}
?>