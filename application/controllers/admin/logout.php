<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    function admin_logout(){
        if($this->session->userdata('admin_logged_in') == TRUE || is_numeric($this->session->admin_user_id)){
            if($this->input->cookie('remember_me') != "")
                delete_cookie('remember_me');
            $this->session->admin_user_id = NULL;
            $this->session->unset_userdata('admin_logged_in');
            $this->session->unset_userdata('admin_user_id');
            $this->session->unset_userdata('admin_password');
            $this->session->unset_userdata('admin_first_name');
            $this->session->unset_userdata('admin_last_name');
            $this->session->unset_userdata('admin_full_name');
            $this->session->unset_userdata('admin_user_name');
            $this->session->unset_userdata('admin_email');
            $this->session->unset_userdata('admin_country');
            $this->session->unset_userdata('admin_state');
            $this->session->unset_userdata('admin_city');
            $this->session->unset_userdata('admin_gender');
            $this->session->unset_userdata('admin_registered_on');
            $this->session->unset_userdata('admin_modified_on');
            $this->session->unset_userdata('admin_account_status');
            $this->session->unset_userdata('admin_email_confirmed');
            $this->session->unset_userdata('admin_activation_hash');
            $this->session->unset_userdata('admin_password_reset_hash');
            $this->session->unset_userdata('admin_user_role');
            $this->session->unset_userdata('admin_is_deleted');
            $this->session->unset_userdata('admin_paypal');
            $this->session->unset_userdata('admin_credit_card_number');
            $this->session->unset_userdata('admin_card_expire_date');
            $this->session->unset_userdata('admin_cvv_code');
            $this->session->unset_userdata('admin_referral_username');
            $this->session->unset_userdata('admin_refer_friend_hash');
            $this->session->unset_userdata('admin_referral_user_id');
            
        }
        redirect('administrator');
    }
    
    
}