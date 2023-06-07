<?php

class Users_management extends CI_Controller {

    public $data = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('pagination_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function email_ext($value){
        if (substr($value, -4) != '.edu'){
            $this->form_validation->set_message('email_ext','Your email address must end with “.edu” to ensure you are/were a member of a student community.');
            return FALSE;
        }
        return TRUE;
    }

    function create_user() {
        $this->data['view_path'] = "admin/users/create_user";
        $this->data['page'] = "create_user";
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]|callback_email_ext|max_length[255]|xss_claen');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[password_confirm]|min_length[6]|max_length[32]|xss_clean');
            $this->form_validation->set_rules('school', 'School/Employment', 'trim|required|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]|xss_clean');
            //$number = $this->input->post('number1').','.$this->input->post('number2').','.$this->input->post('number3');
            if ($this->form_validation->run() !== FALSE) {
                /*if(!is_numeric($this->input->post('number1')) || !is_numeric($this->input->post('number2')) || !is_numeric($this->input->post('number3'))){
                    $this->data['errors'] = 'Please enter valid phone number.';
                    $this->load->view('admin_template', $this->data);                    
                    return;
                }*/
                $save = $this->user_model->create_user(
                    array(
                        'user_role' => 2,
                        'name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'email' => $this->input->post('email'),
                        'password' => md5($this->input->post('password')),
                        'gender' => $this->input->post('gender'),
                        'school' => $this->input->post('school'),
                        //'description' => $this->input->post('description'),
                        //'number' => $number,
                        'activation_hash' => '',
                        'password_reset_hash' => '',
                        'registered_on' => date("Y-m-d H:i:s"),
                        'modified_on' => 0,
                        'email_confirmed' => 1,
                        'account_status' => 1
                    )
                );

                if ($save) {
                    $this->session->set_flashdata('success','User Created successfully.');
                    redirect('administrator/manage_users');
                } else {
                    $this->data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }

    function edit_user(){
        $user_id = $this->uri->segment(3);
        $user_data = $this->user_model->verify_user(array('user_id' => $user_id));
//            $user_data = $this->user_model->verify_user(array('user_id' => $user_id,'user_role' => 2));
        if ($user_data) {
            $this->data['user'] = $user_data[0];
            $this->data['view_path'] = "admin/users/edit_user";
            $this->data['page'] = "edit_user";

            if ($this->input->server('REQUEST_METHOD') === 'POST'){
                $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|max_length[45]|xss_clean');
                $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[45]|xss_clean');
//                    $this->form_validation->set_rules('school', 'School/Employment', 'trim|required|xss_clean');
//                    $this->form_validation->set_rules('gender', 'Gender', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('description', 'Description', 'trim|required|min_length[10]|xss_clean');
                //$number = $this->input->post('number1').','.$this->input->post('number2').','.$this->input->post('number3');

                if ($this->form_validation->run() == FALSE) {
                    $this->data['errors'] = validation_errors();
                }
                else{
                    /*if(!is_numeric($this->input->post('number1')) || !is_numeric($this->input->post('number2')) || !is_numeric($this->input->post('number3'))){
                        $this->data['errors'] = 'Please enter valid phone number.';
                        $this->load->view('admin_template', $this->data);
                        return;
                    }*/

                    $updated = $this->user_model->update_user_account(
                        array(
                            'name' => $this->input->post('first_name'),
                            'last_name' => $this->input->post('last_name'),
//                            'gender' => $this->input->post('gender'),
//                            'school' => $this->input->post('school'),
                            //'description' => $this->input->post('description'),
                            //'number' => $number,
                            'modified_on' => date("Y-m-d H:i:s"),
                        ),
                        array(
                            'user_id' => $user_id
                        )

                    );
                    if ($updated){
                        $this->session->set_flashdata('success', "User Updated successfully.");
                        redirect('administrator/manage_users');
                    }else {
                        $this->data['errors'] = 'An error occurred, try later.';
                    }
                }

                //$this->load->view('admin_template', $this->data);
            }

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'User not found.');
            redirect('administrator/manage_users');
        }
    }

    function view_user(){
        $user_id = $this->uri->segment(3);
        $user_data = $this->user_model->verify_user(array('user_id' => $user_id));
//            $user_data = $this->user_model->verify_user(array('user_id' => $user_id,'user_role' => 2));
        if ($user_data) {
            $this->data['user'] = $user_data[0];
            $this->data['view_path'] = "admin/users/view_user";
            $this->data['page'] = "manage_users";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'User not found.');
            redirect('administrator/manage_users');
        }
    }


    function manage_users() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->user_model->get_total();
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_users/', $total, $per_page, $num_links, $uri_segment);
        $where = array('is_deleted' => 0,'user_role !=' => 1);
        $this->data['result'] = $this->user_model->get_all_users($per_page, $start_from,$where);
        $this->data['view_path'] = "admin/users/manage_users";
        $this->data['page'] = "manage_users";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }

    function update_status() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4)) && is_numeric($this->uri->segment(5))) {
            $status = $this->uri->segment(5);
            //$this->load->model('user');
            $update = $this->user_model->update_user_account(
                array(
                    'account_status' => $status,
                    'email_confirmed' => $status,
                    'modified_on' => date('Y-m-d h:m:s', time())
                ),

                array(
                    'user_id' => $this->uri->segment(4)
                )
            );
            if ($update){
                $msg = ($status == 1) ? "enabled" : "disabled";
                $this->session->set_flashdata('success', "User account $msg successfully.");
            }else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_users/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_users/0/');
    }

    function delete_user() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))){
            $delete = $this->user_model->update_user_account(array('email' => 'empty','is_deleted' => 1), array('user_id' => $this->uri->segment(4)));
            if ($delete){
                $this->session->set_flashdata('success', "User deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_users/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_users/10/');
    }

}

?>
