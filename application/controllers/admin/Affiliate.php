<?php

class Affiliate extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model('datatable_model', 'datatable_model');
        $this->load->model('admin/affiliate_model', 'this_model');
    }

    function index() {
        $data['page'] = "admin/affiliate/list";
        $data['affiliateinfo'] = 'active open';
        $data['affiliateinfo'] = 'active';
        $data['var_meta_title'] = 'Affiliate';
        $data['var_meta_description'] = 'Affiliate';
        $data['var_meta_keyword'] = 'Affiliate';
        $data['css'] = array('page_level.css');
        $data['js'] = array('admin/user.js');
        $data['init'] = array('User.affiliate_init()');
        $this->load->view(ADMIN_LAYOUT, $data);
    }

    function manageAffiliate() {
        $result = $this->datatable_model->getAffiliateDatatable();
        echo json_encode($result);
        exit();
    }
    
    function overview($id){
        $ids = $this->utility->decode($id);
        
        if(!ctype_digit($ids)){
            redirect(affiliate_url());
        }
        
        $data['page'] = "admin/affiliate/overview";
        $data['affiliateinfo'] = 'active open';
        $data['affiliateinfo'] = 'active';
        $data['var_meta_title'] = 'Affiliate Overview';
        $data['var_meta_description'] = 'Affiliate Overview';
        $data['var_meta_keyword'] = 'Affiliate Overview';
        $data['userData'] = $this->getUserData($ids);
        $data['css'] = array('page_level.css');
        $data['id'] = $id;
        $this->load->view(ADMIN_LAYOUT, $data);
        
    }
    
    function getUserData($id){
        return $this->db->get_where(TABLE_USER , array('id' => $id))->result();
    }
    
    
    function user($id){
        $ids = $this->utility->decode($id);
        
        if(!ctype_digit($ids)){
            redirect(affiliate_url());
        }
        
        $data['page'] = "admin/affiliate/user_list";
        $data['affiliateinfo'] = 'active open';
        $data['affiliateinfo'] = 'active';
        $data['var_meta_title'] = 'Affiliate User info';
        $data['var_meta_description'] = 'Affiliate User info';
        $data['var_meta_keyword'] = 'Affiliate User info';
        $data['css'] = array('page_level.css');
        $data['js'] = array('admin/user.js');
        $data['init'] = array('User.affiliate_init()');
        
        $data['getAffiliateUser'] = $this->this_model->getAffiliateUser($ids);
        $this->load->view(ADMIN_LAYOUT, $data);
    }
    
    public function monitoringStatus(){
        if(($this->input->post()) && ($this->input->is_ajax_request())){
            $result = $this->this_model->handlemonitoringStatus($this->input->post());
            echo json_encode($result); exit();
        }
    }
    
    public function userStatus(){
        if(($this->input->post()) && ($this->input->is_ajax_request())){
            $result = $this->this_model->handleuserStatus($this->input->post());
            echo json_encode($result); exit();
        }
    }
    
    public function user_edit($id){
        $ids = $this->utility->decode($id);
         
        if(!ctype_digit($ids)){
            redirect(affiliate_url());
        }
        
        $data['page'] = "admin/affiliate/user_edit";
        $data['affiliateinfo'] = 'active open';
        $data['affiliateinfo'] = 'active';
        $data['var_meta_title'] = 'Affiliate User Edit';
        $data['var_meta_description'] = 'Affiliate User Edit';
        $data['var_meta_keyword'] = 'Affiliate User Edit';
        $data['css'] = array('page_level.css');
        $data['js'] = array('admin/user.js');
        $data['init'] = array('User.user_edit()');
        $data['userData'] = $this->getUserData($ids);
        
        if(($this->input->post()) && ($this->input->is_ajax_request())){
            $result = $this->this_model->handleUserEdit($this->input->post(),$ids);
            echo json_encode($result); exit();
        }
        
        $this->load->view(ADMIN_LAYOUT, $data);
    }

}

?>