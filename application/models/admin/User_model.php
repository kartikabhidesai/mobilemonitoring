<?php
class User_model extends My_model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function handleStatus($postData){
        
        $data['update']['status'] = $postData['status'];
        $data['where'] = ['id' => $postData['id']];
        $data['table'] = TABLE_APPLICATION;
        $updateStatus = $this->updateRecords($data);
        
        unset($data);
        
        $data['select'] = ['name','status'];
        $data['table'] = TABLE_APPLICATION;
        $applicationList = $this->selectRecords($data);
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
        
        $checkStartEnd = $this->checkStartEnd($postData['start_date_time'], TABLE_SCREEN_PHOTO_HAS_TIME);

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
            $json_response['message'] = 'Sorry this date alreay exists';
                
        }


        return $json_response;
    }

    public function setVideoTimeingSetting($postData) {
        
        $checkStartEnd = $this->checkStartEnd($postData['start_date_time'], TABLE_SCREEN_VIDEO_HAS_TIME);

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

    public function checkStartEnd($startDate,$table){
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
    
//    public function getRecentFeeds($id){
//        $data['select'] = ['user_id','name','number','text','type','time','date'];
//        $data['where'] = ['user_id' => $id];
//        $data['limit'] = '1';
//        $data['order'] = 'id DESC';
//        $data['table'] = TABLE_MESSAGE;
//        $messageData = $this->selectRecords($data);
//        
//        unset($data);
//        
//        $data['select'] = ['user_id','name','number','call_type','time','date','duration'];
//        $data['where'] = ['user_id' => $id];
//        $data['limit'] = '1';
//        $data['order'] = 'id DESC';
//        $data['table'] = TABLE_CALL_LOG;
//        $callData = $this->selectRecords($data);
//        
//        unset($data);
//        
//        $data['select'] = ['user_id','package_name','text','date','time'];
//        $data['where'] = ['user_id' => $id];
//        $data['limit'] = '1';
//        $data['order'] = 'id DESC';
//        $data['table'] = TABLE_SOCIAL_MEDIA;
//        $socialData = $this->selectRecords($data);
//        
//        unset($data);
//        
//        $data_array = array(
//            'call_data' => $callData,
//            'message_data' => $messageData,
//            'social_data' => $socialData
//        );
//        
//        return $data_array;
//    }
    
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
            'gallary' => $gallaryCount[0]->totalGallry,
            'screen_photo' => $screenPicCount[0]->totalScreenPic,
            'video' => $videoCount[0]->totalVideo,
            'screen_video' => $videoScreenCount[0]->totalscreenVideo,
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
}
?>