<?php
class Dashboard_model extends My_model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function addVideos($postData){
        $categoryId = $this->checkCategoy($postData['category']);
        $playlistId = $postData['playlistid'];
        
        
        for($i=0; $i<count($postData['videoId']); $i++){
            
            $checkVideo = $this->checkVideo($postData['videoId'][$i]);
            if(empty($checkVideo)){
                
                $data['insert']['category_id'] = $categoryId;
                $data['insert']['playlist_id'] = $playlistId;
                $data['insert']['video_url'] = $postData['videoId'][$i]; 
                $data['insert']['image_url'] = $postData['imageUrl'][$i];
                $data['insert']['title'] = $postData['title'][$i];
                $data['insert']['discription'] = $postData['discription'][$i];
                $data['insert']['dt_created'] = DATE_TIME;
                $data['insert']['dt_updated'] = DATE_TIME;
                $data['table'] = TABLE_VIDEO; 
                $result = $this->insertRecord($data);
                
//                if($result){
//                    $checkUserSubcribe = $this->checkSubscribeCategory($categoryId);
//                }
            }
        }
    }
    
    /*Send Notification code*/
    public function checkSubscribeCategory($categoryId){
        $data['select'] = ['id','user_id'];
        $data['where'] = ['category_id' => $categoryId];
        $data['table'] = TABLE_SUBSCRIBE_CATEGORY;
        $result = $this->selectRecords($data);
        
        unset($data);
        
        if(!empty($result)){
            for($i=0; $i<count($result); $i++){
                
                $data['select'] = ['u.notification_type', 'td.device_id', 'td.token', 'td.type'];
                $data['table'] = TABLE_USER . ' u';
                $data['join'] = [
                    TABLE_DEVICE . " as td" => [
                        "u.id = td.user_id",
                        "LEFT"
                    ],
                ];
                $data['where'] = ['u.id' => $result[$i]->user_id];
                $ceheckNotify = $this->selectFromJoin($data);

                if(!empty($ceheckNotify)){
                   if($ceheckNotify[0]->notification_type == '1'){
                       $message = array(
                                'message' => 'New video added video in your subscribe category',
                                'category_id' => $checkPossibilies[0]->service_center_id,
                                'type' => 'Video Added',
                            );
                      $notificationSend = $this->utility->sendNotification($ceheckNotify, $message);
                   } 
                }
            }
        }
        return TRUE;
    }

    public function checkVideo($videoId){
        $data['select'] = $data['id'];
        $data['where'] = ['video_url' => $videoId];
        $data['table'] = TABLE_VIDEO;
        $result = $this->selectRecords($data);
        return $result;
    }

    public function checkCategoy($category){
        $data['select'] = ['id'];
        $data['where'] = ['name' => $category];
        $data['table'] = TABLE_CATEGORY;
        $result = $this->selectRecords($data);
        
        unset($data);
        
        if(!empty($result)){
            $categoryId = $result[0]->id;
        }else{
            $data['insert']['name'] = $category;
            $data['insert']['dt_created'] = DATE_TIME;
            $data['insert']['dt_updated'] = DATE_TIME;
            $data['table'] = TABLE_CATEGORY;
            $res = $this->insertRecord($data);
            
            $categoryId = $res;
        }
        
        return $categoryId;
    }
}
