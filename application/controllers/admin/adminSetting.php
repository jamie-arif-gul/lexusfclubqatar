<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminSetting extends CI_Controller {

    // private $user_id;
    // private $user_type;
    // private $is_logged_in;
    private $data;

    //default constructor
    function __construct() {
        parent::__construct();
        $this->check_login_again();
        $this->data = array();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function change_password() {
        if ($this->session->flashdata('change_pass_success') != "")
            $this->data['success'] = $this->session->flashdata('change_pass_success');
        if ($this->session->flashdata('change_pass_errors') != "")
            $this->data['errors'] = $this->session->flashdata('change_pass_errors');

        $this->data['view_path'] = 'admin/changePassword';
        $this->data['page'] = 'changePassword';
        $this->load->view('admin_template', $this->data);
    }

    function password() {
        if (md5($this->input->post('old_password')) == $this->session->userdata('admin_password') && $this->input->post('new_password') == $this->input->post('confirm_password')) {
            $this->load->library('form_validation');
            if ($this->form_validation->run() != FALSE) {
                $this->load->model('admin_login');
                $update = $this->admin_login->changePassword(
                        array(
                    'password' => md5($this->input->post('confirm_password')),
                    'modified_on' => time(),
                        ), $this->session->userdata('admin_user_id')
                );
                if ($update == TRUE) {
                    $this->session->set_flashdata('change_pass_success', 'Password Successfully Changed');
                    redirect('administrator/admin_logout');
                } else {
                    $this->session->set_flashdata('change_pass_errors', 'An Error Occured Try Later');
                    redirect('administrator/change_password');
                }
            } else {
                $this->session->set_flashdata('change_pass_errors', validation_errors());
                redirect('administrator/change_password');
            }
        } else {

            $this->session->set_flashdata('change_pass_errors', 'Old Password not matched Or New Password');
            redirect('administrator/change_password');
        }
    }

    function profile() {
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->data['view_path'] = 'admin/profile';
        $this->data['page'] = 'profile';
        $this->load->view('admin_template', $this->data);
    }

    function admin_profile_update() {
        //print_r($this->session->all_userdata()['admin_id']);
        if ($this->form_validation->run() != FALSE) {
            $this->load->model('admin_login');
            $this->load->helper('upload_helper');
            //$admin_img = upload_image('admin_image', 'uploads/image_gallery');
            if (isset($_FILES['admin_image']['name']) && trim($_FILES['admin_image']['name']) != "") {
                $admin_img = upload_image('admin_image', 'uploads/img_gallery/admin_images');
                if (isset($admin_img['error'])) {
                    $this->session->set_flashdata('errors', $admin_img['error']);
                    redirect('administrator/profile');
                }
                $save_profile = $this->admin_login->admin_save_profile(
                        array(
                            'name' => $this->input->post('admin_user_name'),
                            'profile_pic' => $admin_img['file_name']
                        )
                );
                if ($save_profile) {
                    $this->session->set_userdata('admin_user_name', $this->input->post('admin_user_name'));
                    $this->session->set_userdata('admin_profile_pic',$admin_img['file_name']);
                    $this->session->set_flashdata('success', 'Profile Successfully updated');
                    redirect('administrator/admin_logout');
                } else {
                    $this->session->set_flashdata('success', 'An Error occured try again');
                    redirect('administrator/profile');
                }
            } else {
                $this->session->set_flashdata('errors', 'Image required');
                redirect('administrator/profile');
            }
        }
        $this->session->set_flashdata('errors', validation_errors());
        redirect('administrator/profile');
    }

    function admin_change_email() {
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->data['view_path'] = 'admin/admin_email';
        $this->data['page'] = 'admin_email';
        $this->load->view('admin_template', $this->data);
    }

    function admin_email_change() {
        if($this->input->post('old_email') !='' && $this->input->post('old_email')==$this->session->userdata('admin_email')){
        if ($this->form_validation->run() != FALSE) {
            
            $this->load->model('admin_login');
            $admin_email = $this->admin_login->admin_email(
                    array(
                        'email' => $this->input->post('admin_email')
                    )
            );
            if($admin_email){
              $this->session->set_flashdata('success', 'Admin email successfully changed.');
              redirect('admin/logout/admin_logout');
            }else
              $this->session->set_flashdata('errors', 'An Error occured try again.');
              redirect('administrator/admin_email');
        }
              $this->session->set_flashdata('errors', validation_errors());
              redirect('administrator/admin_email');  
    
            } 
              $this->session->set_flashdata('errors', 'Old email mismatch');
              redirect('administrator/admin_email');  
             
    }

}