<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events_management extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('event_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again()
    {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function manage_events() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('events',array());
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_events/', $total, $per_page, $num_links, $uri_segment);
        $where = array();
//
        $result = $this->data['result'] = $this->event_model->get_all_events($per_page*2, $start_from*2, $where);
//        echo "<pre>";
//        print_r($result);die;
        $this->data['view_path'] = "admin/events/manage_events";
        $this->data['page'] = "manage_events";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }

    function create_event()
    {
        $this->data['view_path'] = "admin/events/create_event";
        $this->data['page'] = "manage_events";
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('name_en', 'Event Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('location_en', 'Location', 'trim|required|xss_clean');

            $this->form_validation->set_rules('name_ar', 'Event Name Arabic', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|xss_clean');
            $this->form_validation->set_rules('location_ar', 'Location Arabic', 'trim|required|xss_clean');

            $this->form_validation->set_rules('event_date', 'Event Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('event_time', 'Event Time', 'trim|required|xss_clean');
//            $this->form_validation->set_rules('event_image', 'Event Image', 'trim|required|xss_clean');
            if(empty($_FILES['event_image']['name']))
                $this->form_validation->set_rules('event_image', 'Event Image', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                $img = upload_image('event_image', 'uploads/event_image');
                if (isset($img['error'])) {
                    $this->data['errors'] = $img['error'];
                    return $this->load->view('admin_template', $this->data);
                }

                $save = $this->comman_model->save('events',
                    array(
                        'event_date' => $this->input->post('event_date'),
                        'event_time' => $this->input->post('event_time'),
                        'event_image' => $img['file_name']
                    )
                );

                if ($save) {
                    $event_en = $this->comman_model->save('event_detail',
                        array(
                            'event_id' => $save,
                            'name' => $this->input->post('name_en'),
                            'description' => $this->input->post('description_en'),
                            'location' => $this->input->post('location_en'),
                            'lang' => 1,
                        )
                    );
                    $event_ar = $this->comman_model->save('event_detail',
                        array(
                            'event_id' => $save,
                            'name' => $this->input->post('name_ar'),
                            'description' => $this->input->post('description_ar'),
                            'location' => $this->input->post('location_ar'),
                            'lang' => 2,
                        )
                    );
                    $this->session->set_flashdata('success','Event Created successfully.');
                    redirect('administrator/manage_events');
                } else {
                    $this->data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }
    function edit_event(){
        $event_id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('name_en', 'Event Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('location_en', 'Location', 'trim|required|xss_clean');

            $this->form_validation->set_rules('name_ar', 'Event Name Arabic', 'trim|required|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|xss_clean');
            $this->form_validation->set_rules('location_ar', 'Location Arabic', 'trim|required|xss_clean');

            $this->form_validation->set_rules('event_date', 'Event Date', 'trim|required|xss_clean');
            $this->form_validation->set_rules('event_time', 'Event Time', 'trim|required|xss_clean');
            if ($this->form_validation->run() !== FALSE) {
                if($_FILES['event_image']['name']){
//                    echo 'img';die;
                $img = upload_image('event_image', 'uploads/event_image');
                    if (isset($img['error'])) {
                        $this->data['errors'] = $img['error'];
                        return $this->load->view('admin_template', $this->data);
                    }
                    $data = array(
                        'event_date' => $this->input->post('event_date'),
                        'event_time' => $this->input->post('event_time'),
                        'event_image' => $img['file_name']
                    );
                }
                else{
                    $data = array(
                        'event_date' => $this->input->post('event_date'),
                        'event_time' => $this->input->post('event_time'),
                    );
                }
                $save = $this->comman_model->update('events',
                    array('id' => $event_id),
                    $data
                );

//                if ($save) {
                    $event_en = $this->comman_model->update('event_detail',
                        array(
                            'event_id' => $event_id,
                            'lang' => 1
                        ),
                        array(
                            'name' => $this->input->post('name_en'),
                            'description' => $this->input->post('description_en'),
                            'location' => $this->input->post('location_en'),
                        )
                    );
                    $event_ar = $this->comman_model->update('event_detail',
                        array(
                            'event_id' => $event_id,
                            'lang' => 2
                        ),
                        array(
                            'name' => $this->input->post('name_ar'),
                            'description' => $this->input->post('description_ar'),
                            'location' => $this->input->post('location_ar'),
                        )
                    );
                    $this->session->set_flashdata('success','Event updated successfully.');
                    redirect('administrator/manage_events');
//                } else {
//                    $this->data['errors'] = 'An error occurred, try later';
//                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }
        $event_data = $this->event_model->verify_event(array('e.id' => $event_id));
        if ($event_data) {
            $this->data['event'] = $event_data;
            $this->data['view_path'] = "admin/events/edit_event";
            $this->data['page'] = "manage_events";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'Event not found.');
            redirect('administrator/manage_events');
        }
    }
    function view_event(){
        $event_id = $this->uri->segment(3);
        $event_data = $this->event_model->verify_event(array('e.id' => $event_id));
        if ($event_data) {
            $this->data['event'] = $event_data;
            $this->data['view_path'] = "admin/events/view_event";
            $this->data['page'] = "manage_events";

            $start_from = $this->uri->segment(4);
            if (!is_numeric($start_from))
                $start_from = 0;
            $total = $this->comman_model->get_total('event_users',array());
            $per_page = 10;
            $num_links = 4;
            $uri_segment = 4;
            $this->data['pagination'] = paginate(base_url() . 'administrator/view_event/'.$event_id.'/', $total, $per_page, $num_links, $uri_segment);
            $where = array('event_id' => $event_id);
//
            $result = $this->comman_model->get_all_limited('event_users',$per_page, $start_from, $where);
            $user_ids = array();
            if($result){
            foreach($result as $key => $value){
                $user_ids[] = $value['user_id'];
            }
                $this->data['event_users'] = $this->comman_model->getWhereIn('users', implode(',',$user_ids));
            }
//        echo "<pre>";
//        print_r($users);die;
            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'Event not found.');
            redirect('administrator/manage_events');
        }
    }
    function delete_event() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))){
//            var_dump(is_numeric($this->uri->segment(3)));die;
            $where = array('id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('events',$where);
            if ($delete){
                $this->session->set_flashdata('success', "Event deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_events/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_events/10/');
    }
}