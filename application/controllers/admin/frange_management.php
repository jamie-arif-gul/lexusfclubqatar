<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frange_management extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('frange_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function manage_frange() {
        $start_from = $this->uri->segment(3);

        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('frange', array());
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_frange/', $total, $per_page, $num_links, $uri_segment);
        $where = array();
//
        $this->data['result'] = $this->frange_model->get_all_frange($per_page*2, $start_from*2, $where);
//        echo "<pre>";
//        print_r($this->data['result']);die;
        $this->data['view_path'] = "admin/frange/manage_frange";
        $this->data['page'] = "manage_frange";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }

    function create_frange() {
        $this->data['view_path'] = "admin/frange/create_frange";
        $this->data['page'] = "manage_frange";
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title_en', 'Frange Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|max_length[200]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'Frange Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|max_length[200]|xss_clean');
            if (empty($_FILES['frange_image']['name']))
                $this->form_validation->set_rules('frange_image', 'Frange Image', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                $img = upload_image('frange_image', 'uploads/frange_image');
                if (isset($img['error'])) {
                    $this->data['errors'] = $img['error'];
                    return $this->load->view('admin_template', $this->data);
                }

                $save = $this->comman_model->save('frange', array(
                    'frange_image' => $img['file_name'],
                    'admin_id' => $this->session->userdata('admin_user_id'),
                        )
                );

                if ($save) {
                    $frange_en = $this->comman_model->save('frange_detail', array(
                        'frange_id' => $save,
                        'title' => $this->input->post('title_en'),
                        'description' => $this->input->post('description_en'),
                        'lang' => 1,
                            )
                    );
                    $frange_ar = $this->comman_model->save('frange_detail', array(
                        'frange_id' => $save,
                        'title' => $this->input->post('title_ar'),
                        'description' => $this->input->post('description_ar'),
                        'lang' => 2,
                            )
                    );
                    $this->session->set_flashdata('success', 'Frange Created successfully.');

                    redirect('administrator/manage_frange');
                } else {
                    $this->data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }

    function edit_frange() {
        $frange_id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->data['view_path'] = "admin/frange/edit_frange";
            $this->data['page'] = "manage_frange";

            $this->form_validation->set_rules('title_en', 'Frange Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|max_length[200]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'Frange Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|max_length[200]|xss_clean');

            if ($this->form_validation->run() !== FALSE) {
                if (($_FILES['frange_image']['name'] != '')) {
                    $img = upload_image('frange_image', 'uploads/frange_image');
                    if (isset($img['error'])) {
                        $this->session->set_flashdata('errors', $img['error']);
                        return redirect('administrator/edit_frange/9');
                    }
                    $save = $this->comman_model->update('frange', array(
                        'id' => $frange_id
                            ), array(
                        'frange_image' => $img['file_name']
                            )
                    );
                } 
                $save = $this->comman_model->update('frange', array(
                    'id' => $frange_id
                        ), array(
                    'admin_id' => $this->session->userdata('admin_user_id')
                        )
                );
                $frange_en = $this->comman_model->update('frange_detail', array(
                    'lang' => 1,
                    'frange_id' => $frange_id
                        ), array(
                    'title' => $this->input->post('title_en'),
                    'description' => $this->input->post('description_en'),
                        )
                );
                $frange_ar = $this->comman_model->update('frange_detail', array(
                    'lang' => 2,
                    'frange_id' => $frange_id
                        ), array(
                    'title' => $this->input->post('title_ar'),
                    'description' => $this->input->post('description_ar'),
                        )
                );
                $this->session->set_flashdata('success', 'frange Updated successfully.');
                redirect('administrator/manage_frange');
            } else {
                $this->session->set_flashdata('errors', validation_errors());
                return redirect('administrator/edit_frange/' . $frange_id);
//                return $this->load->view('admin_template', $this->data);
            }
        }
        $frange_data = $this->frange_model->verify_frange(array('f.id' => $frange_id));

        if ($frange_data) {
            $this->data['frange'] = $frange_data;
            $this->data['view_path'] = "admin/frange/edit_frange";
            $this->data['page'] = "manage_frange";

            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'frange not found.');
            redirect('administrator/manage_frange');
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

    function delete_frange() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))) {
//            var_dump(is_numeric($this->uri->segment(3)));die;
            $where = array('id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('frange', $where);
            if ($delete) {
                $this->session->set_flashdata('success', "frange deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_frange');
        }
        redirect('administrator/manage_frange');
    }

}
