<?php
class Affiliate_model extends My_model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getAffiliateUser($id){
        $data['select'] = ['id','user_name','phone_no','email','monitoring_status'];
        $data['where'] = ['parent_id' => $id];
        $data['table'] = TABLE_USER;
        $result = $this->selectRecords($data);
        
        return $result;
    }
    
    public function handleUserStatus($postData){
        
        $id = $this->utility->decode($postData['id']);
        
        if($postData['status'] == 'Deactive'){
            $status = '1';
            $message = "User Active successfully";
        }else if($postData['status'] == 'Active'){
            $status = '2';
            $message = "User Deactive successfully";
        }
        
        $data['update']['status'] = $status;
        $data['update']['subscription_start_date'] = DATE_TIME;
        $data['update']['subscription_end_date'] = date('Y-m-d', strtotime('+1 years'));
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_USER;
        $result = $this->updateRecords($data);
        
        unset($data);
        
        if($result){
            $json_reponse['status'] = 'success';
            $json_reponse['message'] = $message;
        }else{
            $json_reponse['status'] = 'error';
            $json_reponse['message'] = DEFAULT_MESSAGE;
        }
        
        return $json_reponse;
    }
    
    public function handleMonitoringStatus($postData){
        
        $id = $this->utility->decode($postData['id']);
        
        
        if($postData['status'] == 'Stop'){
            $statusText = 'Start';
            $status = '1';
            $mgs = "Monitoring Start successfully";
        }else if($postData['status'] == 'Start'){
            $statusText = 'Stop';
            $status = '0';
            $mgs = "Monitoring Stop successfully";
        }
        
        $deviceData = $this->getDeviceData($id);
        if (!empty($deviceData)) {

            for ($i = 0; $i < count($deviceData); $i++) {
                $message = array(
                    'message' => 'Monitoring Status',
                    'type' => 'Monitoring Status',
                    'status' => $statusText
                );

                $notificationSend = $this->utility->sendNotification($deviceData[$i]->token, $message, 'status');
            }
        }

        $data['update']['monitoring_status'] = $status;
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_USER;
        $result = $this->updateRecords($data);
        
        unset($data);
        
        if($result){
            
            /*Notificartion code goes here*/
            $json_reponse['status'] = 'success';
            $json_reponse['message'] = $mgs;
            
        }else{
            $json_reponse['status'] = 'error';
            $json_reponse['message'] = DEFAULT_MESSAGE;
        }
        
        return $json_reponse;
    }
    
    public function handleUserEdit($postData,$id){
        $data['update']['limit_user'] = $postData['user_limit'];
        $data['update']['updated_date'] = DATE_TIME;
        $data['where'] = ['id' => $id];
        $data['table'] = TABLE_USER;
        $result = $this->updateRecords($data);
        
        if($result){
            $json_respose['status'] = 'success';
            $json_respose['message'] = 'user limit update successfully';
            $json_respose['redirect'] = admin_url().'affiliate';
        }else{
            $json_respose['status'] = 'error';
            $json_respose['message'] = DEFAULT_MESSAGE;
        }
        
        return $json_respose;
    }
    
    public function getDeviceData($id){
        $userId = array();
        
        $data['select'] = ['id'];
        $data['where'] = ['parent_id' => $id];
        $data['table'] = TABLE_USER;
        $userData = $this->selectRecords($data);
        
        if(!empty($userData)){
            for($i=0; $i<count($userData); $i++){
                $userId[] = $userData[$i]->id;
            }
        }
        
        unset($data);
        
        if(!empty($userId)){
            
            $data['select'] = ['device_id', 'token', 'device_name'];
            $data['where_in'] = ['user_id' => $userId];
            $data['table'] = TABLE_DEVICE;
            $deviceData = $this->selectRecords($data);
        }
        
        return $deviceData;
    }
}
?>