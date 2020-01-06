<?php

class Account extends Admin_Controller {

    function __construct() {
        parent::__construct();
        
         $this->load->helper('cookie');
        $this->load->model('Login_model', 'this_model');
    }

    function index() {
        if (isset($this->session->userdata['valid_login'])) {
            if ($this->session->userdata['valid_login']['type'] == '1') {
                redirect(admin_url() . 'affiliate');
            } else if ($this->session->userdata['valid_login']['type'] == '3') {
                redirect(affiliate_url() . 'user');
            }
        } else {
            $this->login();
        }
    }

    function login() {
        $data['page'] = "admin/account/login";
        $data['var_meta_title'] = 'Login';
        $data['var_meta_description'] = 'Login';
        $data['var_meta_keyword'] = 'Login';
        $data['js'] = array(
            'admin/login.js'
        );
        $data['init'] = array(
            'Login.init()'
        );

        if ($this->input->post()) {
            $loginCheck = $this->this_model->loginCheck($this->input->post());
            echo json_encode($loginCheck); exit();
        }

        $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
    }

    function registration() {
        $data['page'] = "admin/account/ragistration";
        $data['var_meta_title'] = 'Registration';
        $data['var_meta_description'] = 'Registration';
        $data['var_meta_keyword'] = 'Registration';
        $data['js'] = array(
            'admin/login.js'
        );
        $data['init'] = array(
            'Login.registration()',
        );
        if ($this->input->post()) {
            $validation = $this->setRules();
            if ($validation) {
                $response = $this->this_model->registration($this->input->post());
                if ($response) {
                    $this->utility->setFlashMessage('success', 'you have succesfully created account in ' . PROJECT_NAME . ' open your mail and verify your email beofre login');
                } else {
                    $this->utility->setFlashMessage('danger', 'error while you creating an account please try again');
                }
                redirect(base_url());
            }
        }
        $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
    }

    function setRules() {
        $config = array(
            array('field' => 'name',
                'label' => 'name',
                'rules' => 'trim|required',
                "errors" => [
                    'required' => "please enter name",
                ]
            ),
            array('field' => 'email',
                'label' => 'email',
                'rules' => "trim|required|valid_email|is_unique[user.email]",
                "errors" => [
                    'required' => "please enter email address",
                    'valid_email' => "please enter a valid email address",
                    'is_unique' => 'This email is already exist'
                ]
            ),
            array('field' => 'password',
                'label' => 'password',
                'rules' => "trim|required|min_length[6]",
                "errors" => [
                    'required' => "Please enter password",
                    'min_length' => "password length must be greater then 6"
                ]
            ),
            array('field' => 'rpassword',
                'label' => 'rpassword',
                'rules' => "trim|required|matches[password]|min_length[6]",
                "errors" => [
                    'required' => "please enter password",
                    'min_length' => "password length must be greater then 6",
                    'matches' => 'password does not match',
                ]
            ),
            array('field' => 'phone',
                'label' => 'phone',
                'rules' => "trim|required|numeric|min_length[10]",
                "errors" => [
                    'required' => "Please enter phone",
                    'min_length' => "password length must be greater then 10",
                    'numeric' => "please enter valid phone number",
                ]
            ),
            array('field' => 'company_name',
                'label' => 'company_name',
                'rules' => 'trim|required',
                "errors" => [
                    'required' => "please enter company name",
                ]
            ),
            array('field' => 'url',
                'label' => 'url',
                'rules' => 'trim|required',
                "errors" => [
                    'required' => "please enter url",
                ]
            ),
            array('field' => 'total_users',
                'label' => 'total_users',
                'rules' => 'trim|required|numeric',
                "errors" => [
                    'required' => "please enter total users",
                    'numeric' => "please enter valid number",
                ]
            ),
        );

        $this->form_validation->set_rules($config);
        return ($this->form_validation->run());
    }

    function verifyEmail($token) {
        $response = $this->this_model->verifyUserByToken($token);
        
        if (!$response) {
            $this->utility->setFlashMessage('danger', 'Sorry! We did not recognized your email address in our system');
        } else {
            $this->utility->setFlashMessage('success', 'Thank you!  you have successfull verfied your email address');
        }
        redirect(base_url());
    }


    function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    public function forgetPassword() {
		
		/* if user request to login with username and password */
            $data['page'] = "admin/account/forgot_password";
            $data['var_meta_title'] = 'Forgot Password';
            $data['var_meta_description'] = 'Forgot Password';
            $data['var_meta_keyword'] = 'Forgot Password';
            $data['js'] = array(
                'admin/login.js'
            );
            $data['init'] = array(
                'Login.init()',
            );
            
            if ($this->input->post ()) {
                
                   $validation = $this->setRulesForgotPassword ();
                    
                    /* after verify validation this conditon will exicute */
                    if ($validation) {
                            $response = $this->this_model->genrateForgotPasswordLink ();
                            $this->utility->setFlashMessage ( $response [0], $response [1] );
                            redirect ( base_url() );
                    }
            }
            
            $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
	}
        
        
        function changePassword($token) {
         
        $tokenResponse = $this->this_model->checkUserToken($token);
        
        if ($tokenResponse === true) {
            $data['page'] = "admin/account/reset_password";
            $data['var_meta_title'] = 'Reset Password';
            $data['var_meta_description'] = 'Reset Password';
            $data['var_meta_keyword'] = 'Reset Password';
            $data['formAction'] = $token;
            $data['js'] = array(
                'admin/login.js'
            );
            $data['init'] = array(
                'Login.resetPass()',
            );
            if ($this->input->post()) {
                $validation = $this->setRulesForResetPassword();
                if ($validation) {
                    $response = $this->this_model->updateUserPassword($token);
                    if($response[2] == '2'){
                        $this->session->set_flashdata('message','You have successfully updated your password');
                        $this->load->view('admin/account/user_page');
                        return false;
                    }else{
                        $this->utility->setFlashMessage($response [0], $response [1]);
                        redirect(base_url());
                    }
                    
                }
            }
        } else {
            $this->utility->setFlashMessage($tokenResponse [0], $tokenResponse [1]);
            redirect(base_url());
        }
        $this->load->view(ADMIN_LAYOUT_LOGIN, $data);
    }

    function setRulesForResetPassword(){
        $config = array(
            array('field' => 'password', 
                  'label' => 'password', 
                  'rules' => "trim|required|min_length[6]",
                   "errors" => [
                        'required' => "Please enter password",
			'min_length' => "password length must be greater then 6"  
                    ] 
                ),
            array('field' => 'rpassword', 
                  'label' => 'rpassword', 
                  'rules' => "trim|required|matches[password]|min_length[6]",
                   "errors" => [
                        'required' => "Please enter password",
			'min_length' => "password length must be greater then 6",
                        'matches' => 'password does not match',
                    ] 
                ),
        );

        $this->form_validation->set_rules($config);
        return ($this->form_validation->run());
    }
    
    function setRulesForgotPassword() {
            $config = array(
            
            array('field' => 'email',
                'label' => 'email',
                'rules' => "trim|required|valid_email",
                "errors" => [
                    'required' => "please enter email address",
                    'valid_email' => "please enter a valid email address",
                    'is_unique' => 'This email is already exist'
                ]
            ),
        );

            $this->form_validation->set_rules($config);
            return ($this->form_validation->run());
        }
}

?>