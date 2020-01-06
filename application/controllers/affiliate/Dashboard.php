<?php

class Dashboard extends Affiliate_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('affiliate/dashboard_model', 'this_model');
    }

    function index() {
        
        $data['page'] = "affiliate/account/dashboard";
        $data['dashboard'] = 'active open';
        $data['dashboard'] = 'active';
        $data['var_meta_title'] = 'Dashboard';
        $data['var_meta_description'] = 'Dashboard';
        $data['var_meta_keyword'] = 'Dashboard';
        $data['css'] = array('page_level.css');
        $data['js'] = array('affiliate/dashboard.js');
        $data['init'] = array('Dashboard.init()');
        
//      $data['getIncoming'] = $this->this_model->getCallType('incoming');
//      $data['getOutGoing'] = $this->this_model->getCallType('outgoing');
//      $data['getMissedCall'] = $this->this_model->getCallType('missedcall');
//      $data['getInbox'] = $this->this_model->getMessageType('sent');
//      $data['getSent'] = $this->this_model->getMessageType('inbox');
        
        $data['overAllCalls'] = $this->this_model->overAllCalls();
        $data['overAllMessages'] = $this->this_model->overAllMessages();
        $data['overAllSocial'] = $this->this_model->overAllSocial();
        $data['topSocialUser'] = $this->this_model->topSocialUser();
        $data['getBrowserDetail'] = $this->this_model->getBrowserDetail();
        
//        echo "<pre/>"; print_r($data['getBrowserDetail']); exit();
        
        $this->load->view(AFFILIATE_LAYOUT, $data);
    }
}
?>