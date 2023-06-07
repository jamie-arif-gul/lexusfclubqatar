<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_logins extends CI_Controller {

    //private $user_id;
    //private $user_type;
    //private $is_logged_in;
    private $data;

    function __construct() {
        parent::__construct();
        if ($this->uri->segment(2) != 'logout')
        $this->check_login_again();
        $this->load->model('admin_login');
    }
    public function check_login_again() {

        if ($this->session->userdata('admin_user_role') == 1 && $this->session->userdata('admin_user_id') != '') {
          redirect('administrator/dashboard');
        }  
    }


    function index() {
        if ($this->session->flashdata('login_success') != "")
            $this->data['success'] = $this->session->flashdata('login_success');
        if ($this->session->flashdata('login_errors') != "")
            $this->data['errors'] = $this->session->flashdata('login_errors');

        $this->load->view('admin/admin_login', $this->data);
    }

    function admin_portal() {
        if ($this->form_validation->run()) {
            $result = $this->admin_login->login();
            //echo "<pre>"; print_r($result); exit;
            if (sizeof($result) > 0) {
                foreach ($result[0] as $key => $value)
                {
                   $adminData['admin_'.$key] = $value;
                }
                unset($result[0]);

                
                $this->session->set_userdata(array('admin_logged_in' => TRUE));
                $this->session->set_userdata($adminData);
                redirect('administrator');
            } else {
                $this->session->set_flashdata('login_errors', 'Invalid Email ID/Password');
                //echo 'please enter the valid Email/Passwrd';
            }
        }
       
        redirect('administrator');
    }

 /*   function admin_portal() {

        if ($this->form_validation->run()) {
            $result = $this->admin_login->login();
			//echo "<pre>"; print_r($result); exit;
            if (sizeof($result) > 0) {
                $this->session->set_userdata($result[0]);
                redirect('administrator');
            } else {
                $this->session->set_flashdata('login_errors', 'Invalid Email ID/Password');
                //echo 'please enter the valid Email/Passwrd';
            }
        }
       
        redirect('administrator');
    }

    function admin_logout(){
        if($this->session->userdata('admin_logged_in') == TRUE || is_numeric($this->session->admin_user_id)){
            if($this->input->cookie('remember_me') != "")
                delete_cookie('remember_me');
            $this->session->admin_user_id = NULL;
            $this->session->set_userdata('admin_logged_in', FALSE);
            $this->session->unset_userdata('admin_logged_in');
            $this->session->unset_userdata('admin_user_id');
            $this->session->unset_userdata('admin_user_role_id');
            $this->session->unset_userdata('admin_email_address');
            $this->session->unset_userdata('admin_password');
            $this->session->unset_userdata('admin_first_name');
            $this->session->unset_userdata('admin_last_name');
            $this->session->unset_userdata('admin_gender');
            $this->session->unset_userdata('admin_dob');
            $this->session->unset_userdata('admin_zip_code');
            $this->session->unset_userdata('admin_service_type');
            $this->session->unset_userdata('admin_oauth_token');
            $this->session->unset_userdata('admin_oauth_token_secret');
            $this->session->unset_userdata('admin_registered_on');
            $this->session->unset_userdata('admin_modified_on');
            $this->session->unset_userdata('admin_password_reset_hash');
            $this->session->unset_userdata('admin_account_status');
            
        }
        redirect('administrator');
    }
*/
    function forgot_password() {
        if($this->form_validation->run()==TRUE){
        $msg = 'Hi Change your password please click on the below link';
        $activation = $this->generate_activation_hash();
        $subject = 'Forgot Email';
        $reset = $this->admin_login->forgotPassword();
        //print_r($reset); die();
        //die(sizeof($reset[0]));
        if (!empty($reset[0])) {
            mail($this->input->post('forgot_password'), $subject, $msg . '<br/>' .
                    base_url('administrator/reset_password') . "/" . $activation);

            $this->load->model('admin_login');
            $this->admin_login->activate_hash(
                    array(
                'email' => $this->input->post('forgot_password')), array(
                'password_reset_hash' => $activation
                    )
            );

            $this->session->set_flashdata('login_success', 'Forgot password email sent.');
            redirect('administrator');
        } else if (empty($reset[0])) {
            $this->data['error'] = '          
                <h1>Something went wrong</h1><br/>
                <h2>Please try again.<h2>
                  <p class="page-404">Something went wrong or that page doesn\'t exist yet.<a href="' . base_url('administrator') . '">Return Home</a></p>';
            $this->load->view('admin/error_occur', $this->data);
            return;
        } else {
            $this->data['error'] = '          
                <h1>Error</h1>
                <h2>Please try again.<h2>
                  <p class="page-404">Something went wrong or that page doesn\'t exist yet.<a href="' . base_url('administrator') . '">Return Home</a></p>';
            $this->load->view('admin/error_occur', $this->data);
            return;
        }
        }else
        $this->session->set_flashdata('login_errors',  validation_errors());
        redirect('administrator');
    }

    function reset() {
        
        $row = $this->admin_login->reset_password($this->uri->segment(3));
        
        if (!$row) {
            $this->data['error'] = '          
                <h1>Error</h1>
                <h2>Please try again.<h2>
                  <p class="page-404">Something went wrong or that page doesn\'t exist yet.<a href="' . base_url('administrator') . '">Return Home</a></p>';
            $this->load->view('admin/error_occur', $this->data);
        } else {
            $this->session->set_userdata('tmp_hash',$row[0]['password_reset_hash']);
            if($this->session->flashdata('login_errors')!=''){
                $this->data['errors'] = $this->session->flashdata('login_errors');
            }
            $this->session->set_userdata('tmp_user_id',$row[0]['user_id']); 
            $this->load->view('admin/forgot_password',  $this->data);
        }
    }

    function generate_activation_hash() {
        $this->load->helper('string');
        return random_string('unique');
    }

    function cnf_pass() {
        if($this->form_validation->run()){
            $update = $this->admin_login->change_password(             
             array(
            'password' => md5($this->input->post('conf_pass')),
            'modified_on' => time()
                ),
            $this->session->userdata('tmp_user_id')    
        );
        if ($update == TRUE) {
            $this->session->set_flashdata('login_success', 'your password successfully changed');
            $this->session->unset_userdata(array('tmp_user_id', 'tmp_hash'));
            redirect('administrator');        
            return;
        }  
        }else
        $this->session->set_flashdata('login_errors', validation_errors());
        redirect('administrator/reset_password/'.$this->session->userdata('tmp_hash').'/');
    }

}
