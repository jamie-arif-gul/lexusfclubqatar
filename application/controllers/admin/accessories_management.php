<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accessories_management extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function manage_accessories() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('accessories', array());
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_accessories/', $total, $per_page, $num_links, $uri_segment);
        $where = array();

        $this->data['result'] = $this->comman_model->get_all_limited('accessories', $per_page, $start_from, array());
        $this->data['view_path'] = "admin/accessories/manage_accessories";
        $this->data['page'] = "manage_accessories";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }

    function view_accessories() {
        $accessories_id = $this->uri->segment(3);
        $accessories_data = $this->comman_model->get_single_row('accessories',array('id' => $accessories_id));
        
        if ($accessories_data) {
            $this->data['accessories'] = $accessories_data;
            $this->data['view_path'] = "admin/accessories/view_accessories";
            $this->data['page'] = "manage_accessories";

            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'Accessory not found.');
            redirect('administrator/manage_accessories');
        }
    }

    function delete_accessories() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))) {

            $where = array('id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('accessories', $where);
            if ($delete) {
                $this->session->set_flashdata('success', "Accessory deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_accessories/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_accessories');
    }

}
