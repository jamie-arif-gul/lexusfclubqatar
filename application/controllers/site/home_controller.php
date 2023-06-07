<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_Controller extends CI_Controller {

    private $_data;

    public function __construct() {
        parent::__construct();
//        login_persists();
//        $this->load->model('user_model');
//        $this->load->model('property_model');
//        $this->load->model('admin_login');
//        $this->load->helper('upload_helper');
//        $this->load->helper('email_helper');
        $this->load->model('frange_c_model');
        $this->load->model('comman_model');
        $this->load->model('offers_model');
        $this->load->model('offers_c_model');
        $this->load->model('frange_model');
        $this->load->model('news_model');
        $this->load->model('event_model');
    }

    private function __loadView() {
        if ($this->session->flashdata('success') != "")
            $this->_data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->_data['errors'] = $this->session->flashdata('errors');
        if ($this->session->userdata('site_lang'))
            $lang = $this->session->userdata('site_lang');
        else
            $lang = 'english';
        $this->load->view($lang . '/frontend/home_template', $this->_data);
    }
    public function booking() {
        $this->__is_login();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
            $this->form_validation->set_rules('model', 'Model', 'trim|required');
            $this->form_validation->set_rules('drive_date', 'Drive Date', 'trim|required');
            $this->form_validation->set_rules('drive_time', 'Drive Time', 'trim|required');

            if ($this->form_validation->run()) {
                $data = $this->input->post();
                $save = $this->comman_model->save('bookings', array(
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'model' => $data['model'],
                    'drive_date' => $data['drive_date'],
                    'drive_time' => $data['drive_time'],
                    'comments' => $data['comments']
                        )
                );
                if ($save) {
                    if ($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false) {
                        $this->session->set_flashdata('success', 'Request for test drive sent successfully.');
                        return redirect('booking');
                    } else {
                        $this->session->set_flashdata('success', 'تم إرسال طلب اختبار القيادة بنجاح.');
                        return redirect('booking');
                    }
//                        $this->_data['success'] = 'تم إرسال طلب اختبار القيادة بنجاح.';
                } else {
                    if ($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false)
                        $this->_data['errors'] = 'Oops! An error occurred. Please try later.';
                    else
                        $this->_data['errors'] = 'وجه الفتاة! حدث خطأ. يرجى المحاولة في وقت لاحق.';
                }
            }
            else
            if ($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false)
                $this->_data['errors'] = 'Please remove the errors in the form. Thanks';
            else
                $this->_data['errors'] = 'يرجى إزالة الأخطاء في النموذج. شكر';
        }
        $this->_data['main_content'] = 'frontend/home/booking';
        $this->__loadView();
    }

    public function accessories() {
        $this->__is_login();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('name', 'Full Name', 'trim|required');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'trim|required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
            $this->form_validation->set_rules('model', 'Model', 'trim|required');
            $this->form_validation->set_rules('chassis_number', 'Chassis Number', 'trim|required');
            $this->form_validation->set_rules('part_description', 'Part Description', 'trim|required');

            if ($this->form_validation->run()) {
                $data = $this->input->post();
                $save = $this->comman_model->save('accessories', array(
                    'name' => $data['name'],
                    'phone_number' => $data['phone_number'],
                    'email' => $data['email'],
                    'model' => $data['model'],
                    'chassis_number' => $data['chassis_number'],
                    'part_description' => $data['part_description'],
                    'part_number' => $data['part_number']
                        )
                );
                if ($save) {
                    if ($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false) {
                        $this->session->set_flashdata('success', 'Request submitted successfully.');
                        return redirect('accessories');
                    } else {
                        $this->session->set_flashdata('success', 'تم إرسال الطلب بنجاح');
                        return redirect('accessories');
                    }
                } else {
                    if ($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false)
                        $this->_data['errors'] = 'Oops! An error occurred. Please try later.';
                    else
                        $this->_data['errors'] = 'وجه الفتاة! حدث خطأ. يرجى المحاولة في وقت لاحق.';
                }
            }
            else
            if ($this->session->userdata('site_lang') == 'english' || $this->session->userdata('site_lang') == false)
                $this->_data['errors'] = 'Please remove the errors in the form. Thanks';
            else
                $this->_data['errors'] = 'يرجى إزالة الأخطاء في النموذج. شكر';
        }
        $this->_data['main_content'] = 'frontend/home/accessories';
        $this->__loadView();
    }

    public function contact() {
        $this->_data['main_content'] = 'frontend/home/contact';
        $this->__loadView();
    }

    public function offers() {
        $this->__is_login();
        $lang = 0;
        ($this->session->userdata('site_lang') == 'arabic') ? $lang = 2 : $lang = 1;

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('offers', array());
        $per_page = 10;
        $num_links = 5;
        $uri_segment = 2;
        $this->_data['pagination'] = paginate(base_url() . 'offers/', $total, $per_page, $num_links, $uri_segment);

        $this->_data['result_c'] = $this->offers_c_model->get_offers_c($lang);
        $this->_data['result'] = $this->offers_model->get_offers($lang, $per_page, $start_from);
        $this->_data['main_content'] = 'frontend/home/offers';
        
        $this->__loadView();
    }

    public function news() {
        $this->__is_login();
        $lang = 0;
        ($this->session->userdata('site_lang') == 'arabic') ? $lang = 2 : $lang = 1;

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('news', array());
        $per_page = 10;
        $num_links = 5;
        $uri_segment = 2;
        $this->_data['pagination'] = paginate(base_url() . 'news/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['result'] = $this->news_model->get_news($lang, $per_page, $start_from);
        $this->_data['main_content'] = 'frontend/home/news';
        $this->__loadView();
    }

    public function frange() {
        $lang = 0;
        ($this->session->userdata('site_lang') == 'arabic') ? $lang = 2 : $lang = 1;

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('frange', array());
        $per_page = 10;
        $num_links = 5;
        $uri_segment = 2;
        $this->_data['pagination'] = paginate(base_url() . 'frange/', $total, $per_page, $num_links, $uri_segment);


        $this->_data['result'] = $this->frange_model->get_frange($lang, $per_page, $start_from);
        $this->_data['result_c'] = $this->frange_c_model->get_frange_c($lang);
        
        $this->_data['main_content'] = 'frontend/home/frange';
        $this->__loadView();
    }

    public function events()
    {
        $this->__is_login();
        $lang = 0;
        ($this->session->userdata('site_lang') == 'arabic') ? $lang = 2 : $lang = 1;

        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('events', array());
        $per_page = 10;
        $num_links = 5;
        $uri_segment = 2;
        $this->_data['pagination'] = paginate(base_url() . 'events/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['result'] = $this->event_model->get_all_events($per_page, $start_from, array('lang' => $lang));
        $join_status = $this->comman_model->get('event_users', array('user_id' => $this->session->userdata('user_id')),'event_id');
        $events = array();
        if($join_status){
            foreach($join_status as $key => $value){
                $events[] = $value['event_id'];
            }
        }
        $this->_data['join_status'] = $events;
        $this->_data['main_content'] = 'frontend/home/events';
        $this->__loadView();
    }

    public function eventStatus()
    {
        $event_id = $this->input->post('event_id');
        $user_id = $this->session->userdata('user_id');
        $user_exist = $this->comman_model->get('event_users',array('event_id' => $event_id, 'user_id' => $user_id));
        if($user_exist != 0)
            $this->comman_model->delete('event_users',array('event_id' => $event_id, 'user_id' => $user_id));
        else
            $this->comman_model->save('event_users', array('event_id' => $event_id, 'user_id' => $user_id));
    }

    public function gallery()
    {
        $lang = 0;
        ($this->session->userdata('site_lang') == 'arabic') ? $lang = 2 : $lang = 1;
        $result = $this->_data['result'] = $this->frange_model->get_all(array('lang' => $lang));
        $this->_data['main_content'] = 'frontend/home/gallery';
        $this->__loadView();
    }

    private function __is_login() {
        if (!$this->session->userdata('logged_in'))
            redirect('login');
    }
}
