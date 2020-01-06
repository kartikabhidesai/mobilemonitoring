<?php

class Login_model extends MY_Model {

    function loginCheck($data) {

        $this->db->where('email', $data['email']);
        $this->db->where('type !=', '2');
        $row = $this->db->get('user')->row_array();

        if (!empty($row)) {
            /* Set Session */
            if ($row['password'] == md5($data['password'])) {
                    
                    /* Check User Type and redirect to respective login */
                    if($row['type'] == '1'){
                        
                        $url = admin_url() . 'affiliate';
                        $json_response['status'] = 'success';
                        $json_response['message'] = 'Well done Login Successfully Done';
                        $json_response['redirect'] = $url;
                        
                    }else if($row['type'] == '3'){
                        if($row['status'] == '0'){
                            $json_response['status'] = 'error';
                            $json_response['message'] = 'Sorry! Please check you email inbox verify link which we sent to you';
                            
                            return $json_response;
                        }else if($row['status'] == '2'){
                            
                            $json_response['status'] = 'error';
                            $json_response['message'] = 'Sorry! Please contact your superadmin for approve account';
                            
                            return $json_response;
                        }else{
                            
                            $url = affiliate_url() . 'dashboard';
                            $json_response['status'] = 'success';
                            $json_response['message'] = 'Well done Login Successfully Done';
                            $json_response['redirect'] = $url;
                            
                        }
                    }
                
                    $sessionData['valid_login'] = [
                        'id' => $row['id'],
                        'email' => $row['email'],
                        'name' => $row['user_name'],
                        'type' => $row['type'],
                    ];

                    $this->session->set_userdata($sessionData);
                    delete_cookie("username");
                    delete_cookie("password");

                    if ($this->input->post('remember') == 'true') {

                        $userName = array(
                            'name' => 'username',
                            'value' => $row['email'],
                            'expire' => '86500',
                            'prefix' => '',
                            'secure' => FALSE
                        );
                        $this->input->set_cookie($userName);

                        $password = array(
                            'name' => 'password',
                            'value' => $data['password'],
                            'expire' => '86500',
                            'prefix' => '',
                            'secure' => FALSE
                        );
                        $this->input->set_cookie($password);
                    }
                
            } else {
                /* Check Password Match */
                $json_response['status'] = 'error';
                $json_response['message'] = 'Password does not match';
                return $json_response;
            }
        } else {
            /* User name and passwod does not match */
            $json_response['status'] = 'error';
            $json_response['message'] = 'Email address and password does not match';
            return $json_response;
        }

        return $json_response;
    }
    
    public function registration($postData){
        
        $data['insert']['user_name'] = $postData['name'];
        $data['insert']['email'] = $postData['email'];
        $data['insert']['password'] = md5($postData['password']);
        $data['insert']['phone_no'] = $postData['phone'];
        $data['insert']['token'] = md5($this->utility->encode($postData['email']));
        $data['insert']['type'] = $postData['type'];
        $data['insert']['company_name'] = $postData['company_name'];
        $data['insert']['url'] = $postData['url'];
        $data['insert']['limit_user'] = $postData['total_users'];
        $data['insert']['created_date'] = DATE_TIME;
        $data['insert']['updated_date'] = DATE_TIME;
        $data['table'] = TABLE_USER;
        $lastId = $this->insertRecord($data);
        
        if($lastId){
            $data ['username'] = $postData['name'];
            $data ['link'] = base_url() . 'verifyAccount/' . md5($this->utility->encode($postData['email']));
            $data ['message'] = $this->load->view('email_template/registration_mail', $data, true);
            $data ['from_title'] = SITE_TITLE;
            $data ['subject'] = 'Verify user email address';
            $data ["to"] = $postData['email'];
            $response = $this->utility->sendMailSMTP($data);
            
            return $response;
        }
        
    }
    
    
     public function verifyUserByToken($token) {
         
        $data ['select'] = ['id'];
        $data ['table'] = TABLE_USER;
        $data ['where'] = ['token' => $token,'status' => '0'];
        $response = $this->selectRecords($data);
        
        /* if got token in database then update token as empty and user status is active */
        if (count($response) > 0) {
            unset($data);
            $data ['update'] ['token'] = '';
            $data ['update'] ['status'] = '2';
            $data ['where'] = ['id' => $response [0]->id];
            $data ['table'] = TABLE_USER;
            $this->updateRecords($data);
            
            return true;
            
        } else {
            
            return false;
            
        }
    }
    
    public function genrateForgotPasswordLink($postData) {

        $email = $this->input->post('email');

        if (!empty($postData)) {
            $email = $postData['email'];
        }
        $txtEmail = $this->utility->encodeText($email);
        $data ['where'] = [
            'email' => $txtEmail
        ];
        $data ['table'] = TABLE_USER;
        $response = $this->isDuplicate($data);

        /* if email is registered in our system this condition will be exicute */
        if ($response === true) {
            unset($data);
            $data ['select'] = [
                'user_name',
                'id'
            ];
            $data ['table'] = TABLE_USER;
            $data ['where'] = [
                'email' => $txtEmail
            ];
            $response = $this->selectRecords($data);
            $response = $response [0];

            /* always delete old links then gen. new token */
            unset($data);
            $data ["where"] = [
                "user_id" => $response->id
            ];
            $data ["table"] = TABLE_FORGOT_PASSWORD;
            $this->deleteRecords($data);

            unset($data);
            $dataToken = md5(time() . $txtEmail);
            $data ['insert'] ['user_id'] = $response->id;
            $data ['insert'] ['token'] = $dataToken;
            $data ['insert'] ['created_date'] = date('Y-m-d h:i:s');
            $data ['table'] = TABLE_FORGOT_PASSWORD;
            $insertionResponse = $this->insertRecord($data);
            /* if record not inserted then exicute this condition */
            if (!$insertionResponse) {
                return [
                    'danger',
                    DEFAULT_MESSAGE
                ];
            }

            $data ['username'] = $response->user_name;
            $data ['link'] = base_url() . 'account/changePassword/' . $dataToken;
            $data ['message'] = $this->load->view('email_template/forgot_password_mail', $data, true);
            $data ['from_title'] = 'Forgot Password';
            $data ['subject'] = 'Forgot Password';
            $data ["to"] = $txtEmail;
            $this->utility->sendMailSMTP($data);
            return [
                'success',
                'An email sent to your registered email address please check email and change your password'
            ];
        } else {

            return [
                'danger',
                'Sorry! this email not found in our system'
            ];
        }
    }
    
    public function updateUserPassword($token) {
        $data ['select'] = [
            'fp.user_id', 'u.type'
        ];
        $data ['table'] = TABLE_FORGOT_PASSWORD . ' fp';
        $data['join'] = [
            TABLE_USER . " as u" => [
                "u.id = fp.user_id",
                "LEFT"
            ],
        ];
        $data ['where'] = [
            'fp.token' => $token
        ];

        $response = $this->selectFromJoin($data);

        $response = $response [0];
        if (!empty($response->user_id)) {

            unset($data);

            $data ['update'] ['password'] = md5($this->input->post('password'));
            $data ['where'] = [
                'id' => $response->user_id
            ];
            $data ['table'] = TABLE_USER;
            $this->updateRecords($data);

            unset($data);
            $data ["where"] = [
                "user_id" => $response->user_id
            ];
            $data ["table"] = TABLE_FORGOT_PASSWORD;
            $this->deleteRecords($data);

            return [
                'success',
                'You have successfully updated your password',
                $response->type,
            ];
        } else {
            return [
                'danger',
                DEFAULT_MESSAGE
            ];
        }
    }
    
    public function checkUserToken($token) {
        $data ['select'] = [
            "user_id",
            "(TIME_TO_SEC('" . date('Y-m-d h:i:s') . "') - TIME_TO_SEC(created_date))/60 AS hrdiff"
        ];
        $data ['where'] = [
            'token' => $token
        ];
        $data ['table'] = TABLE_FORGOT_PASSWORD;
        $response = $this->selectRecords($data);

        if (!empty($response)) {

            $timediff = abs($response [0]->hrdiff);
            $newTimeDiff = explode('.', $timediff);

            // checking hours diffrence of 4hrs
            if ($newTimeDiff [0] > 240) {

                return [
                    'danger',
                    'your link time has been expired please genrate new link to reset password'
                ];
            } else {

                return true;
            }
        } else {

            return [
                'danger',
                DEFAULT_MESSAGE
            ];
        }
    }

}
?>