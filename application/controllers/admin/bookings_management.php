<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookings_Management extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('comman_model');
        $this->check_login_again();
    }

    public function check_login_again()
    {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function manage_bookings() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('bookings',array());
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_bookings/', $total, $per_page, $num_links, $uri_segment);
        $where = array();
//
        $this->data['result'] = $this->comman_model->get_all_limited('bookings',$per_page, $start_from, $where);
//        echo "<pre>";
//        print_r($result);die;
        $this->data['view_path'] = "admin/bookings/manage_bookings";
        $this->data['page'] = "manage_bookings";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }
    function view_booking(){
        $booking_id = $this->uri->segment(3);
        $booking_data = $this->comman_model->get('bookings', array('id' => $booking_id));
        if ($booking_data) {
            $this->data['result'] = $booking_data;
            $this->data['view_path'] = "admin/bookings/view_booking";
            $this->data['page'] = "manage_bookings";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'Booking not found.');
            redirect('administrator/manage_bookings');
        }
    }
    function delete_booking() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))){
//            var_dump(is_numeric($this->uri->segment(3)));die;
            $where = array('id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('bookings',$where);
            if ($delete){
                $this->session->set_flashdata('success', "Booking deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_bookings/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_bookings/10/');
    }
}