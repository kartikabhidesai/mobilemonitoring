<?php
class Dashboard_model extends My_model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function getCallType($type){
        
        
        
        
        
        $query = "SELECT cl.user_id , count(cl.id) as total , cl.name , cl.number , u.user_name
                  FROM `call_log` as cl LEFT JOIN `user` as `u` ON `u`.`id` = `cl`.`user_id` 
                  WHERE `cl`.`call_type` = '$type' AND `u`.`parent_id` = '$this->userId'
                  GROUP BY `cl`.`number`,`cl`.`user_id` 
                  ORDER BY total DESC 
                  LIMIT 0,5";
        $getCall = $this->db->query($query)->result();
        return $getCall;
    }
    
    public function getMessageType($type){
        $query = "SELECT m.user_id , count(m.id) as total , m.number , m.number , u.user_name
                  FROM `message` as m
                  LEFT JOIN `user` as `u` ON `u`.`id` = `m`.`user_id` 
                  WHERE `m`.`type` = '$type' AND `u`.`parent_id` = '$this->userId'
                  GROUP BY `m`.`number`,`m`.`user_id` 
                  ORDER BY total DESC 
                  LIMIT 0,5";
        $getMessage = $this->db->query($query)->result();
        return $getMessage;
    }
    
    public function overAllCalls(){
        $data['select'] = ['COUNT(cl.id) as totalIncoming','cl.user_id'];
        $data['table'] = TABLE_CALL_LOG.' cl';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = cl.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['cl.call_type' => 'incoming','u.parent_id' => $this->userId];
        $incomingCall = $this->selectFromJoin($data);
        unset($data);
        
        $data['select'] = ['COUNT(cl.id) as totalOutgoing','cl.user_id'];
        $data['table'] = TABLE_CALL_LOG.' cl';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = cl.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['cl.call_type' => 'outgoing','u.parent_id' => $this->userId];
        
        $outgoingCall = $this->selectFromJoin($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(cl.id) as totalMisscall','cl.user_id'];
        $data['table'] = TABLE_CALL_LOG.' cl';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = cl.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['cl.call_type' => 'missedcall','u.parent_id' => $this->userId];
        $missCall = $this->selectFromJoin($data);
        
        unset($data);
        
        $data_array = array(
            'incoming' => $incomingCall[0]->totalIncoming,
            'outgoing' => $outgoingCall[0]->totalOutgoing,
            'missedcall' => $missCall[0]->totalMisscall,
        );
        
        return $data_array;
    }
    
    public function overAllMessages(){
        
        $data['select'] = ['COUNT(m.id) as totaltInbox','m.user_id'];
        $data['table'] = TABLE_MESSAGE.' m';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = m.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['m.type' => 'inbox','u.parent_id' => $this->userId];
        $messageInbox = $this->selectFromJoin($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(m.id) as totaltSent','m.user_id'];
        $data['table'] = TABLE_MESSAGE.' m';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = m.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['m.type' => 'sent','u.parent_id' => $this->userId];
        $messageSent = $this->selectFromJoin($data);
        
        unset($data);
        
        $data_array = array(
            'sent' => $messageSent[0]->totaltSent,
            'inbox' => $messageInbox[0]->totaltInbox,
        );
        
        return $data_array;
    }
    
    public function overAllSocial(){
        
        $data['select'] = ['COUNT(sm.id) as totalWhatsapp','sm.user_id'];
        $data['table'] = TABLE_SOCIAL_MEDIA.' sm';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = sm.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['sm.application_id' => '1','u.parent_id' => $this->userId];
        $whatsApp = $this->selectFromJoin($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(sm.id) as totalFacebbok','sm.user_id'];
        $data['table'] = TABLE_SOCIAL_MEDIA.' sm';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = sm.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['sm.application_id' => '2','u.parent_id' => $this->userId];
        $facebook = $this->selectFromJoin($data);
        
        unset($data);
        
        $data['select'] = ['COUNT(sm.id) as totalGmail','sm.user_id'];
        $data['table'] = TABLE_SOCIAL_MEDIA.' sm';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = sm.user_id",
                "LEFT"
            ],
        ];
        $data['where'] = ['sm.application_id' => '3','u.parent_id' => $this->userId];
        $gmail = $this->selectFromJoin($data);
        
        unset($data);
        
        $data_array = array(
            'whatsapp' => $whatsApp[0]->totalWhatsapp,
            'facebbox' => $facebook[0]->totalFacebbok,
            'gmail' => $gmail[0]->totalGmail,
        );
        
        return $data_array;
        
    }
    
    /*Get top social user*/
    
    public function topSocialUser(){
        $data['select'] = ['COUNT(sm.id) as topSocialUser','sm.user_id','u.user_name'];
        $data['table'] = TABLE_SOCIAL_MEDIA.' sm';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = sm.user_id",
                "LEFT"
            ],
        ];
        $data['groupBy'] = 'sm.user_id';
        $data['where'] = ['u.parent_id' => $this->userId];
        $data['order'] = 'topSocialUser desc';
        $data['limit'] = '10';
        $result = $this->selectFromJoin($data);
        
        return $result;
    }
    
    public function getBrowserDetail(){
        $data['select'] = ['COUNT(bh.id) as totalCount','bh.title'];
        $data['table'] = TABLE_BROWSER_HISTORY.' bh';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = bh.user_id",
                "LEFT"
            ],
        ];
        $data['groupBy'] = 'bh.title';
        $data['where'] = ['u.parent_id' => $this->userId];
        $result = $this->selectFromJoin($data);
         
        return $result;
    }
    
}
