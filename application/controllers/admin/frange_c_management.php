<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frange_c_management extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('frange_c_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function frange() {
        $total = $this->comman_model->get_total('frange_content', array());
        if ($total > 0) {
            redirect('administrator/frange_content_edit');
        } else {
            redirect('administrator/frange_content_create');
        }
    }

    function frange_content_create() {
        $this->data['view_path'] = "admin/frange_c/create_frange_c";
        $this->data['page'] = "frange_c";
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title_en', 'Frange Content Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Content Description', 'trim|required|max_length[2500]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'Frange Content Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', ' Content Description Arabic', 'trim|required|max_length[2500]|xss_clean');
            if (empty($_FILES['frange_c_image']['name']))
                $this->form_validation->set_rules('frange_c_image', 'Frange Content Image', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                $img = upload_image('frange_c_image', 'uploads/frange_c_image');
                if (isset($img['error'])) {
                    $this->data['errors'] = $img['error'];
                    return $this->load->view('admin_template', $this->data);
                }

                $frange_en = $this->comman_model->save('frange_content', array(
                    'frange_c_image' => $img['file_name'],
                    'title' => $this->input->post('title_en'),
                    'description' => $this->input->post('description_en'),
                    'description' => $this->input->post('description_en'),
                    'lang' => 1,
                        )
                );
                $frange_ar = $this->comman_model->save('frange_content', array(
                    'frange_c_image' => $img['file_name'],
                    'title' => $this->input->post('title_ar'),
                    'description' => $this->input->post('description_ar'),
                    'lang' => 2,
                        )
                );
                $this->session->set_flashdata('success', 'Frange Content Created successfully.');

                redirect('administrator/frange');
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }

    function frange_content_edit() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->data['view_path'] = "admin/frange_c/edit_frange_c";
            $this->data['page'] = "frange_c";

            $this->form_validation->set_rules('title_en', 'Frange Content Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Content Description', 'trim|required|max_length[2500]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'Frange Content Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', ' Content Description Arabic', 'trim|required|max_length[2500]|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                if (($_FILES['frange_c_image']['name'] != '')) {
                    $img = upload_image('frange_c_image', 'uploads/frange_c_image');
                    if (isset($img['error'])) {
                        $this->session->set_flashdata('errors', $img['error']);
                    }
                    $save = $this->comman_model->update('frange_content', array(
                        'lang' => 1,
                        'lang' => 2
                            ), array(
                        'frange_c_image' => $img['file_name']
                            )
                    );
                }

                $frange_en = $this->comman_model->update('frange_content', array(
                    'lang' => 1
                        ), array(
                    'title' => $this->input->post('title_en'),
                    'description' => $this->input->post('description_en'),
                        )
                );
                $frange_ar = $this->comman_model->update('frange_content', array(
                    'lang' => 2
                        ), array(
                    'title' => $this->input->post('title_ar'),
                    'description' => $this->input->post('description_ar'),
                        )
                );
                $this->session->set_flashdata('success', 'Frange Content Updated successfully.');
                redirect('administrator/manage_frange');
            } else {
                $this->session->set_flashdata('errors', validation_errors());
                
               return redirect('administrator/edit_frange_c');

            }
        }
        $frange_data = $this->frange_c_model->get_frange_content();
        
        if ($frange_data) {
            $this->data['frange'] = $frange_data;
            $this->data['view_path'] = "admin/frange_c/edit_frange_c";
            $this->data['page'] = "manage_frange";
            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'frange not found.');
            redirect('administrator/frange');
        }
    }

    function view_frange() {
        $frange_id = $this->uri->segment(3);
        $frange_data = $this->frange_model->verify_frange(array('f.id' => $frange_id));

        if ($frange_data) {
            $this->data['frange'] = $frange_data;
            $this->data['view_path'] = "admin/frange/view_frange";
            $this->data['page'] = "manage_frange";
            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'frange not found.');
            redirect('administrator/manage_frange');
        }
    }

}
