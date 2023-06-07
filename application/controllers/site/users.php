<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {
    private $_data;

    public function __construct() {
        parent::__construct();
        login_persists();
        $this->load->model('user_model');
        $this->load->model('property_model');
        $this->load->model('admin_login');
        $this->load->helper('upload_helper');
        $this->load->helper('email_helper');
        $this->load->model('comman_model');
    }

    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');
        if($this->session->userdata('site_lang'))
            $lang = $this->session->userdata('site_lang');
        else
            $lang = 'english';
        $this->load->view($lang.'/frontend/home_template', $this->_data);
    }

    function index() {
//        $where = array('p.date_to > '=> time(),'p.is_feature' => 1, 'p.status' => 1);
//        $this->_data['featured'] = $this->property_model->get_featured($where);
//        $this->_data['most_popular'] = $this->property_model->get_most_popular(array('p.date_to > '=> time(),'p.status' => 1));
        //echo '<pre>'; print_r($this->_data['most_popular']); die();
        $this->_data['main_content'] = 'frontend/home/home';
        $this->__loadView();
    }

    function mail_test() {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: share@quadcopters.com". "\r\n";
        // the message
        $msg = '<html>
                          <body bgcolor="#EDEDEE">
                          <p><strong>Hello Irfan!</strong></p>
                          <p style="margin-top:20px;">Please verify your email address by clicking on the link below: <br><p style="margin-top:15px; margin-bottom:15px; font-size:16px;">link</p></p>
                          <p>Once you visit the URL, your account will be activated. *If you don\'t verify your email address, we are required to temporarily put your account on hold until verification is complete.<p>
                          <p>If you have any problems or questions, please reply to this email.</p>
                          <p>Thank you for signing up for Theqatarclub.com!<p>
                          </body>
                          </html>';

        // use wordwrap() if lines are longer than 70 characters
        //$msg = wordwrap($msg,70);

        // send email
        $mail = mail("test.irfan123@gmail.com", "Theqatarclub.com Email Confirmation—Action Required", $msg, $headers);

        print_r($mail);

        die('mail');
    }

    function signup() {
        $this->_data['signup'] = true;
        if ($this->session->userdata('logged_in') == TRUE)
            redirect('profile');
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('name', 'First Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('qid', 'QID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|callback_email_ext|max_length[255]|xss_claen');
            $this->form_validation->set_rules('phone', 'Phone Number', 'trim|required|numeric|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_password_validation|max_length[32]|xss_clean');
            $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|xss_clean');
            //$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_confirm]|min_length[6]|max_length[32]|xss_clean');
            $this->form_validation->set_rules('vehicle', 'Vehicle', 'trim|required|xss_clean');
            $this->form_validation->set_rules('year_of_make', 'Year Make', 'trim|required|xss_clean');
            $this->form_validation->set_rules('chassis_number', 'Chassis Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('registration_number', 'Registration Number', 'trim|required|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                if($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false )
                    $this->_data['errors'] = 'There are some errors in the form. Please solve them first.';
                else
                    $this->_data['errors'] = 'هناك بعض الأخطاء في النموذج. يرجى حلها أولا.';
            }
            else {
                $qid = $this->input->post('qid');
                $qid4 = substr($qid,0,4);
                $user_name = $this->input->post('name').$this->input->post('last_name').$qid4;

                $activation_hash = $this->generate_hash();
                $userData = array(
//                        'user_role' => $this->input->post('user_role'),
//                        'user_role' => 2,
                    'name' => $this->input->post('name'),
                    'last_name' => $this->input->post('last_name'),
                    'qid' => $this->input->post('qid'),
                    'user_name' => $user_name,
                    'email' => $this->input->post('email'),
                    'password' => $this->__encrip_password($this->input->post('password')),
                    'vehicle' => $this->input->post('vehicle'),
                    'year_of_make' => $this->input->post('year_of_make'),
                    'chassis_number' => $this->input->post('chassis_number'),
                    'registration_number' => $this->input->post('registration_number'),
                    'number' => $this->input->post('phone'),
                    't_shirt_size' => $this->input->post('t_shirt_size'),
                    'activation_hash' => $activation_hash,
                    'password_reset_hash' => '',
                    'registered_on' => date("Y-m-d H:i:s"),
                    'pass' => $this->input->post('password'),
                    'modified_on' => 0,
                    'email_confirmed' => 0,
                    'account_status' => 1
                );
                //echo "<pre>"; print_r($userData); exit();
                $registered = $this->user_model->createUserAccount($userData);
                if ($registered) {
                    if($this->input->post('email')){
                    if($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false) {
                        $subject = 'F Club Registration';
                        $message = '<html>
                          <body bgcolor="#EDEDEE">
<p>Thank you for registering, you are now a member in Lexus F Club Qatar</p>
<p>These are your login details.</p>
<p><strong>Username</strong>:'.$user_name.'</p>
<p><strong>Password</strong>:'.$this->input->post('password').'</p>
                          </body>
                          </html>';
                    }
                    else{
                        $subject = 'F تأكيد التسجيل – نادي ملاك لكزس';
                        $message = '<html>
                          <body bgcolor="#EDEDEE">
                          <p style="margin-top:20px;"> تهانينا!</p>
<p>.Fclub هذه الرسالة لتأكيد تسجيلكم كعضو في </p>
<p>.هذه هي تفاصيل تسجيل الدخول الخاصة بك</p>
<p><strong>اسم المستخدم</strong>:'.$user_name.'</p>
<p><strong>كلمه السر</strong>:'.$this->input->post('password').'</p>
                          </body>
                          </html>';

                    }
                          $admin_email = $this->admin_login->get_admin_email();
                          do_email($this->input->post('email'), 'Lexus F Club Qatar', $subject, $message);
                    if($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false)
                        $this->session->set_flashdata('success','Thank you for completing your registration.</br>
You will soon receive a confirmation email.');
                    else
                        $this->session->set_flashdata('success','شكراً لانضمامكم.</br>
سوف يتم إرسال التأكيد عبر البريد الإلكتروني.');
                    redirect('/registration-message');
                }
                    redirect('/registration-message');
                }
                else {
                    $this->_data['errors'] = 'An error occurred, try later.';
                    $this->_data['main_content'] = 'frontend/home/registration';
                    $this->__loadView();
                }
            }
        }
        $this->_data['main_content'] = 'frontend/home/home';
        $this->__loadView();
    }

    function registration_message()
    {
        if ($this->session->userdata('logged_in') == TRUE)
            redirect('profile');
        $this->_data['main_content'] = 'frontend/home/registration_message';
        $this->__loadView();
    }

    function upgrade_role(){
        //die('upgrade_role');
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('user_role') == 3) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_ext_upgrade|max_length[255]|xss_claen');
            if ($this->form_validation->run() == FALSE) {
                echo validation_errors();
                //die();
            }
            else {
                $activation_hash = $this->generate_hash();
                $updated_data = array(
                    'user_role' => 2,
                    'email' => $this->input->post('email'),
                    'activation_hash' => $activation_hash,
                    'password_reset_hash' => '',
                    'email_confirmed' => 0,
                    'account_status' => 1
                );
                $update = $this->user_model->updateUserProfile($updated_data, array('user_id' => $this->session->user_id));
                if ($update == 1) {
                    $subject = 'Theqatarclub.com Email Confirmation—Action Required';
                    $message = '<html>
                        <body bgcolor="#EDEDEE">
                        <p><strong>Hello '.$this->input->post('name').'!</strong></p>
                        <p style="margin-top:20px;">Please verify your email address by clicking on the link below: <br><p style="margin-top:15px; margin-bottom:15px; font-size:16px;">'
                        . anchor(base_url('activate_account/' . $activation_hash . '/' . urlencode($this->input->post('email'))), "Activate Account"). '</p></p>
                        <p>Once you visit the URL, your account will be activated. *If you don\'t verify your email address, we are required to temporarily put your account on hold until verification is complete.<p>
                        <p>If you have any problems or questions, please reply to this email.</p>
                        <p>Thank you for signing up for Theqatarclub.com!<p>
                        </body>
                        </html>';

                    do_email($this->input->post('email'), 'theqatarclub@gmail.com', $subject, $message);
                    $this->session->set_flashdata('notActive', 'Your account has been upgrated successfully. <br>An email has been sent to the address you provided.<br>Please verify your email address in order to activate your account.<br>If you did not see an email from us in your Inbox, please remember to check your Spam folder.');
                    echo 'done';
                }else{
                    echo '<p style="color:red;">Profile not upgrated successfully</p>';
                }
            }
        }
    }

    function email_ext_upgrade($value){
        if($this->comman_model->get('users',array('email' => $value),'email')){
            $this->form_validation->set_message('email_ext_upgrade','This email already exists, please try another.');
            return FALSE;
        }
        if (substr($value, -4) != '.edu'){
            $this->form_validation->set_message('email_ext_upgrade','Your email address must end with “.edu” to ensure you are/were a member of a student community.');
            return FALSE;
        }
        return TRUE;
    }

    function email_ext($value){
        if($this->comman_model->get('users',array('email' => $value,'is_deleted' => 0),'email')){
            $this->form_validation->set_message('email_ext','This email already exists, please try another.');
            return FALSE;
        }
        if (substr($value, -4) != '.edu' && $this->input->post('user_role') == 2){
            $this->form_validation->set_message('email_ext','Your email address must end with “.edu” to ensure you are/were a member of a student community.');
            return FALSE;
        }
        return TRUE;
    }

    function validate_age($value){
        $d1 = new DateTime($value);
        $d2 = new DateTime(date('Y'));

        $difference = $d1->diff($d2);
        $years_between = $difference->y;
        if ($years_between < 18){
            $this->form_validation->set_message('validate_age','Only older than 18 years old can singnup.');
            return FALSE;
        }
        return TRUE;
    }

    function password_validation($value){
        if ($value != $this->input->post('password_confirm')){
            $this->form_validation->set_message('password_validation','Your passwords do not match.');
            return FALSE;
        }

        if (strlen($value) < 5){
            $this->form_validation->set_message('password_validation','The Password must be at least 6 characters in length.');
            return FALSE;
        }
        return TRUE;
    }

    function login() {
        if ($this->session->userdata('logged_in') == TRUE)
            redirect('/');

        $this->_data['main_content'] = 'frontend/home/login';
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('user_name', 'Username', 'trim|required|xss_claen');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            $this->form_validation->set_rules('remember_me', 'Remember Me', 'trim|max_length[1]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_data['errors'] = validation_errors();
            }
            else {
                $user_data = $this->user_model->verify_user(array(
                    'user_name' => $this->input->post('user_name'),
                    'password' => $this->__encrip_password($this->input->post('password')),
//                    'user_role >=' => 2,
//                    'user_role <=' => 3
                ));
                if (!$user_data) {
                    if($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false )
                        $this->_data['errors'] = 'Invalid username or password';
                    else
                        $this->_data['errors'] = 'خطأ في اسم المستخدم أو كلمة مرور';
                }
//                elseif($user_data[0]['account_status'] == 0){
//                    $this->_data['errors'] = 'account deactivated by admin.';
//                }elseif($user_data[0]['email_confirmed'] == 0){
//                    $this->_data['errors'] = 'Email  not confirmed.';
//                }
                else {
                    $this->session->set_userdata('logged_in', TRUE);
                    $this->session->user_id = $user_data[0]['user_id'];
                    //echo $this->session->userdata('logged_in'); exit;
                    $this->session->set_userdata($user_data[0]);
                    // echo "<pre>"; print_r($this->session->all_userdata()); echo "</pre>"; exit;
                    if ($this->input->post('remember_me') == 1) {
                        $cookie = array(
                            'name' => 'remember_me',
                            'value' => $this->session->userdata('user_id'),
                            'expire' => 24 * 60 * 60
                        );
                        set_cookie($cookie);
                    }

                    $after_login_redirect = '/';
                    if($this->session->userdata('after_login_redirect')) {
                        $after_login_redirect = $this->session->userdata('after_login_redirect');
                        $this->session->unset_userdata('login_redirect');
                    }
                    redirect($after_login_redirect);
                }
            }
        }
        if ($this->session->userdata('logged_in') != TRUE) {
            $this->__loadView();
        }
        else
            redirect('signup');
    }

    function logout() {
        if($this->session->userdata('logged_in') == TRUE){
            if($this->input->cookie('remember_me') != "")
                delete_cookie('remember_me');

            $this->session->sess_destroy();
            $this->session->set_userdata('logged_in', FALSE);
        }

        redirect();
    }

    public function update_user_profile() {

        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') == TRUE) {
            $this->form_validation->set_rules('name', 'First Name', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[45]|xss_clean');
            if($this->session->userdata('user_role') == 2){
                $this->form_validation->set_rules('school', 'School/Employment', 'trim|required|xss_clean');
            }
            //$this->form_validation->set_rules('dob', 'Birth Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('DOBmonth', 'Birth Date Month', 'trim|required|xss_clean');
            $this->form_validation->set_rules('DOBday', 'Birth Date Day', 'trim|required|xss_clean');
            $this->form_validation->set_rules('DOByear', 'Birth Date Year', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]|xss_clean');
            //$number = $this->input->post('number1').','.$this->input->post('number2').','.$this->input->post('number3');
            if (is_numeric($this->session->user_id)){
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('errors', validation_errors());
                    redirect('profile/profile_view');
                }
                else{
                    /*if(!is_numeric($this->input->post('number1')) || !is_numeric($this->input->post('number2')) || !is_numeric($this->input->post('number3'))){
                        $this->session->set_flashdata('errors', 'Please enter valid phone number.');
                        redirect('profile/profile_view');
                    }*/

                    $updated_data = array(
                        'name' => $this->input->post('name'),
                        'last_name' => $this->input->post('last_name'),
                        'gender' => $this->input->post('gender'),
                        //'dob' => $this->input->post('dob'),
                        'dob' => $this->input->post('DOBmonth').'/'.$this->input->post('DOBday').'/'.$this->input->post('DOByear'),
                        'school' => $this->input->post('school'),
                        'description' => $this->input->post('description'),
                        //'number' => $number,
                        'modified_on' => date("Y-m-d H:i:s"),
                    );
                    $update = $this->user_model->updateUserProfile($updated_data, array('user_id' => $this->session->user_id));
                    if ($update == 1) {
                        $this->session->set_userdata($updated_data);
                        $this->session->set_flashdata('success', 'Updated successfully.');
                        redirect('profile');
                    }
                    else if ($update == 0)
                    {
                        $this->session->set_flashdata('errors', 'Nothing updated. You did not updated anything.');
                        redirect('profile/profile_view');
                    }
                    else
                    {
                        $this->session->set_flashdata('errors', 'An error occurred, try later');
                        redirect('profile/profile_view');
                    }
                }
            }
            else{
                $this->session->set_flashdata('errors', 'Bad Request');
                redirect('profile/profile_view');
            }
        }
        else{
            $this->session->set_flashdata('errors', 'Bad Request');
            redirect('profile/profile_view');
        }
    }

    function change_my_password() {
        if ($this->session->userdata('logged_in') == TRUE) {
            if ($this->session->flashdata('success') != "") {
                $this->_data['success'] = $this->session->flashdata('success');
                $this->_data['auto_logout'] = TRUE;
                $this->session->set_userdata('logged_in', FALSE);
            }
            $this->_data['main_content'] = 'frontend/home/change_password';
            $this->__loadView();
            return;
        }
        else
            redirect('login');
    }

    function validate_password($current_password) {
        if ($this->__encrip_password($current_password) === $this->session->userdata('password')) {
            return TRUE;
        } else {
            $this->form_validation->set_message('validate_password', 'The %s field do not match your old password.');
            return FALSE;
        }
    }

    function update_my_password() {
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') === TRUE) {
            $this->form_validation->set_rules('current_password', 'Current Password', 'trim|required|callback_validate_password|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]|xss_clean');
            $this->form_validation->set_rules('password_confirm', 'Repeat Password', 'trim|required|matches[password]|xss_clean');
            if ($this->form_validation->run() == TRUE) {
                $update = $this->user_model->updateUserProfile(array(
                    'password' => $this->__encrip_password($this->input->post('password')),
                    'modified_on' => time()
                ), array(
                    'user_id' => $this->session->user_id
                ));
                if ($update) {
                    $this->session->set_flashdata('success', 'Password changed successfully! <br> Login with your new password.');
                } else {
                    $this->session->set_flashdata('errors', 'An error occurred, try again');
                }
            } else {
                $this->session->set_flashdata('errors', validation_errors());
            }
        }
        redirect('profile/change_my_password');
    }

    function forgot_password() {
        if (!$this->session->userdata('logged_in')) {
            $this->_data['main_content'] = 'frontend/home/forgot_password';
            $this->__loadView();
        }
        else
            redirect('home');
    }

    function forgot_password_email() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[100]|xss_claen');
            if ($this->form_validation->run() == TRUE) {
                $user_data = $this->user_model->verify_user(array('email' => $this->input->post('email')));
                if ($user_data) {
                    $reset_hash = $this->generate_hash();
                    // send password reset email 
                    $name = 'Administrator - qatarclub.com';
                    $subject = 'Theqatarclub.com Password Reset';
                    $message = '<html><body><strong>Hi '.$user_data[0]['name'].'!</strong><br>' .
                        '<br>Please click the link below to reset your password:<br>' . anchor(base_url('reset_password/' . $reset_hash), "Reset Password") .
                        '<br><br>Best,<br>
                                <a href='.base_url().'>Theqatarclub.com</a> Team
                                </body></html>';
                    if (do_email($user_data[0]['email'], 'admin@qatarclub.com', $subject, $message)) {

                        $update = $this->user_model->updateUserProfile(array('password_reset_hash' => $reset_hash),array('user_id' => $user_data[0]['user_id']));
                        if ($update) {
                            $this->session->set_flashdata('success', 'An email has been sent to the address you provided.<br>If you did not see an email from us in your Inbox, please remember to check your Spam folder.');
                        }
                        else {
                            $this->session->set_flashdata('errors', 'An error occurred, try again');
                        }
                    }
                    else {
                        // could not send email
                        $this->session->set_flashdata('errors', 'Could not send email, try later.');
                    }
                } else {
                    // no user found
                    $this->session->set_flashdata('errors', 'User does not exist');
                }
            } else {
                // validation error
                $this->session->set_flashdata('errors', validation_errors());
            }
        }
        redirect('forgot_password');
    }

    function reset_password() {
        if (!$this->session->userdata('logged_in')) {
            if (strlen($this->uri->segment(2)) == 32) {
                $user_data = $this->user_model->verify_user(array('password_reset_hash' => $this->uri->segment(2)));
                if ($user_data) {
                    $this->session->set_userdata('password_reset_hash', $this->uri->segment(2));
                    $this->_data['main_content'] = 'frontend/home/reset_password';
                    $this->__loadView();
                    return;
                }
                else {
                    // no user found
                    $this->session->set_flashdata('errors', 'Invalid password reset link');
                }
            }
            else {
                $this->session->set_flashdata('errors', 'Invalid password reset link');
            }
            redirect('forgot_password');
        }
        else
            redirect('home');
    }

    function change_password() {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[32]|xss_clean');
            $this->form_validation->set_rules('password_confirm', 'Repeat Password', 'trim|required|matches[password]|xss_clean');
            $hash = $this->session->userdata('password_reset_hash');
            //echo $hash; die();
            $this->session->unset_userdata('password_reset_hash');
            if ($this->form_validation->run() == TRUE) {
                $update = $this->user_model->updateUserProfile(array(
                    'password' => $this->__encrip_password($this->input->post('password')),
                    'modified_on' => time(),
                    'password_reset_hash' => ''
                ), array(
                    'password_reset_hash' => $hash
                ));
                if ($update) {
                    $this->session->set_flashdata('success', 'Password changed successfully! <br> Login with your new password.');
                    redirect('login');
                }
                else {
                    $this->session->set_flashdata('errors', 'An error occurred, try again');
                }
            }
            else {
                $this->session->set_flashdata('errors', validation_errors());
            }
            redirect('reset_password/' . $hash);
        }
        else
            redirect('reset_password/' . $this->session->flashdata('password_reset_hash'));
    }

    function generate_hash() {
        $this->load->helper('string');
        return random_string('unique');
    }

    function profile() {
        if ($this->session->userdata('logged_in') == TRUE) {
            $start_from = $this->uri->segment(2);
//            if (!is_numeric($start_from))
//                $start_from = 0;
//            $where = array('p.date_to > '=> time(), 'p.status' => 1);
//            $total = $this->property_model->get_total_properties($where);
//            $per_page = 9;
//            $num_links = 4;
//            $uri_segment = 2;
//            $this->_data['pagination'] = paginate(base_url() . 'profile/', $total, $per_page, $num_links, $uri_segment);
            //$where = array('p.date_to > '=> time(), 'p.status' => 1);
//            $this->_data['results'] = $this->property_model->get_all_properties($per_page, $start_from,$where);
            //echo '<pre>'; print_r($this->_data['results']); die();
            $this->_data['user_data'] = $this->session->all_userdata();
            $this->_data['main_content'] = 'frontend/home/profile';
            $this->__loadView();
        }
        else{
            redirect('login');
        }
    }

    function __encrip_password($password) {
        return md5($password);
    }

    function activate_account() {
        if ($this->uri->segment(2) != "" && $this->uri->segment(3) != "") {
            $hash = $this->uri->segment(2);
            $email = urldecode($this->uri->segment(3));

            if (strlen($hash) == 32 && filter_var($email, FILTER_VALIDATE_EMAIL) != "") {
                $activated = $this->user_model->activate_user_account(array
                    (
                        'activation_hash' => $hash,
                        'email' => $email
                    )
                );
                if (!$activated) {
                    $this->session->set_flashdata('errors', "Link is not valid");
                } else {
                    $this->session->set_flashdata('success', "Email account confirmed. Your account has been activated successfully.");
                }
            } else {
                $this->session->set_flashdata('errors', 'Activation link is not valid');
            }
        }
        redirect('login');
    }

    function profile_view() {
        if ($this->session->userdata('logged_in') == TRUE) {
            $this->_data['user_data'] = $this->session->all_userdata();
            $this->_data['main_content'] = 'frontend/home/profile_view';
            $this->__loadView();
        }
        else{
            redirect('login');
        }
    }

    public function update_profile_pic() {
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') == TRUE) {

            if ($this->uplaod_profile_pic()) {
                $updated_data = array(
                    'profile_pic' => $this->session->userdata('profile_pic'),
                    'modified_on' => date('Y-m-d h:m:s', time())
                );
                $update = $this->user_model->updateUserProfile($updated_data, array('user_id' => $this->session->userdata('user_id')));
                if ($update == 1) {

                    echo 'Updated successfully.';
                } else if ($update == 0) {

                    echo 'Nothing updated. You did not updated anything.';
                } else {
                    echo 'An error occurred, try later';
                }
            }
        }
    }

    function uplaod_profile_pic(){
        $profile_pic = array();
        $updated = FALSE;
        if (isset($_FILES['profile_pic']['name']) && trim($_FILES['profile_pic']['name']) != "") {
            $profile_pic = upload_image('profile_pic', realpath(APPPATH . '../uploads/img_gallery/user_images/'));
            $this->session->set_userdata('profile_pic', $profile_pic['file_name']);
            if (isset($profile_pic['error'])) {
                if ($profile_pic['error'] < 0) {
                    echo $profile_pic['error'];
                }
            } else {
                $thumb_sizes = array(
                    array(270, 270)
                );
                $thumb_data = resize_image($profile_pic, $thumb_sizes);
                if (isset($thumb_data['error'])) {
                    $this->session->set_flashdata('errors', $thumb_data['error']);
                    redirect('profile');
                }
                $updated = TRUE;
            }
        }
        return $updated;
    }

    function deactivate_account(){
        if ($this->session->userdata('logged_in')){
            $delete = $this->comman_model->delete('users', array('user_id' => $this->session->userdata('user_id')));
            if ($delete) {
                $this->session->set_flashdata('success', 'Your Account successfully successfully.');
                redirect('logout');
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try again');
                redirect('profile');
            }
        }

    }

}