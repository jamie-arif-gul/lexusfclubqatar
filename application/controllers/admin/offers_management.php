<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Offers_management extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('offers_model');
        $this->load->model('offers_c_model');
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

    function manage_offers() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('offers',array());
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_offers/', $total, $per_page, $num_links, $uri_segment);
        $where = array();
        $this->data['result'] = $this->offers_model->get_all_offers($per_page*2, $start_from*2, $where);

        $this->data['view_path'] = "admin/offers/manage_offers";
        $this->data['page'] = "manage_offers";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

    function create_offers()
    {
        $this->data['view_path'] = "admin/offers/create_offers";
        $this->data['page'] = "manage_offers";
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('title_en', 'Offers Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|max_length[200]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'Offers Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|max_length[200]|xss_clean');
            if(empty($_FILES['offers_image']['name']))
                $this->form_validation->set_rules('offers_image', 'Offers Image', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                $img = upload_image('offers_image', 'uploads/offers_image');
                if (isset($img['error'])) {
                    $this->data['errors'] = $img['error'];
                    return $this->load->view('admin_template', $this->data);
                }

                $save = $this->comman_model->save('offers',
                    array(
                        'offers_image' => $img['file_name']
                    )
                );

                if ($save) {
                    $offers_en = $this->comman_model->save('offers_detail',
                        array(
                            'offers_id' => $save,
                            'title' => $this->input->post('title_en'),
                            'description' => $this->input->post('description_en'),
                            'lang' => 1,
                        )
                    );
                    $offers_ar = $this->comman_model->save('offers_detail',
                        array(
                            'offers_id' => $save,
                            'title' => $this->input->post('title_ar'),
                            'description' => $this->input->post('description_ar'),
                            'lang' => 2,
                        )
                    );
                    $this->session->set_flashdata('success','Offer Created successfully.');
                    
                    redirect('administrator/manage_offers');
                } else {
                    $this->data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }
    function edit_offers(){
        $offers_id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->data['view_path'] = "admin/offers/edit_offers";
            $this->data['page'] = "manage_offers";

            $this->form_validation->set_rules('title_en', 'Offers Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|max_length[200]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'Offers Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|max_length[200]|xss_clean');

            if ($this->form_validation->run() !== FALSE) {
                if(($_FILES['offers_image']['name'] != '')){
                    $img = upload_image('offers_image', 'uploads/offers_image');
                    if (isset($img['error'])) {
                        $this->session->set_flashdata('errors', $img['error']);
                        return redirect('administrator/edit_offers/'.$offers_id);
                    }
                    $save = $this->comman_model->update('offers',
                        array(
                          'id' => $offers_id
                        ),
                        array(
                            'offers_image' => $img['file_name']
                        )
                    );
                }
                $offers_en = $this->comman_model->update('offers_detail',
                    array(
                        'lang' => 1,
                        'offers_id' => $offers_id
                    ),
                    array(
                        'title' => $this->input->post('title_en'),
                        'description' => $this->input->post('description_en'),
                    )
                );
                $offers_ar = $this->comman_model->update('offers_detail',
                    array(
                        'lang' => 2,
                        'offers_id' => $offers_id
                    ),
                    array(
                        'title' => $this->input->post('title_ar'),
                        'description' => $this->input->post('description_ar'),
                    )
                );
                $this->session->set_flashdata('success','Offer Updated successfully.');
                redirect('administrator/manage_offers');

            }
            else{
                $this->session->set_flashdata('errors', validation_errors());
                return redirect('administrator/edit_offers/'.$offers_id);

            }
        }
        $offers_data = $this->offers_model->verify_offers(array('o.id' => $offers_id));
//        var_dump($offers_data);die;
//            $user_data = $this->user_model->verify_user(array('user_id' => $user_id,'user_role' => 2));
        if ($offers_data) {
            $this->data['offers'] = $offers_data;
            $this->data['view_path'] = "admin/offers/edit_offers";
            $this->data['page'] = "manage_offers";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'offer not found.');
            redirect('administrator/manage_offers');
        }
    }
    function view_offers(){
        $offers_id = $this->uri->segment(3);
        $offers_data = $this->offers_model->verify_offers(array('o.id' => $offers_id));
        
        if ($offers_data) {
            $this->data['offers'] = $offers_data;
            $this->data['view_path'] = "admin/offers/view_offers";
            $this->data['page'] = "manage_offers";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'Offer not found.');
            redirect('administrator/manage_offers');
        }
    }
    function delete_offers() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))){
//            var_dump(is_numeric($this->uri->segment(3)));die;
            $where = array('id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('offers',$where);
            if ($delete){
                $this->session->set_flashdata('success', "Offer deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_offers/');
        }
        redirect('administrator/manage_offers');
    }
    function offers() {
        $total = $this->comman_model->get_total('offers_content', array());
        if ($total > 0) {
            redirect('administrator/offers_content_edit');
        } else {
            redirect('administrator/offers_content_create');
        }
    }

    function offers_content_create() {
        $this->data['view_path'] = "admin/offers_c/create_offers_c";
        $this->data['page'] = "manage_offers";
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title_en', 'offers Content Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'offers Content Description', 'trim|required|max_length[2500]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'offers Content Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'offers Content Description Arabic', 'trim|required|max_length[2500]|xss_clean');
            if ($this->form_validation->run() !== FALSE) {


                $offers_en = $this->comman_model->save('offers_content', array(
                    'title' => $this->input->post('title_en'),
                    'description' => $this->input->post('description_en'),
                    'lang' => 1,
                        )
                );
                $offers_en = $this->comman_model->save('offers_content', array(
                    'title' => $this->input->post('title_ar'),
                    'description' => $this->input->post('description_ar'),
                    'lang' => 2,
                        )
                );
                $this->session->set_flashdata('success', 'offers Content Created successfully.');

                redirect('administrator/manage_offers');
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }

    function offers_content_edit() {

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->data['view_path'] = "admin/offers_c/edit_offers_c";
            $this->data['page'] = "manage_offers";

            $this->form_validation->set_rules('title_en', 'offers Content Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'offers Content Description', 'trim|required|max_length[2500]|xss_clean');

            $this->form_validation->set_rules('title_ar', 'offers Content Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'offers Content Description Arabic', 'trim|required|max_length[2500]|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                

                $offers_en = $this->comman_model->update('offers_content', array(
                    'lang' => 1
                        ), array(
                    'title' => $this->input->post('title_en'),
                    'description' => $this->input->post('description_en'),
                        )
                );
                $offers_ar = $this->comman_model->update('offers_content', array(
                    'lang' => 2
                        ), array(
                    'title' => $this->input->post('title_ar'),
                    'description' => $this->input->post('description_ar'),
                        )
                );
                $this->session->set_flashdata('success', 'offers Content Updated successfully.');
                redirect('administrator/manage_offers');
            } else {
                $this->session->set_flashdata('errors', validation_errors());

                return redirect('administrator/edit_offers_c');
            }
        }
        $offers_data = $this->offers_c_model->get_offers_content();

        if ($offers_data) {
            $this->data['offers'] = $offers_data;
            $this->data['view_path'] = "admin/offers_c/edit_offers_c";
            $this->data['page'] = "manage_offers";
            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'offer not found.');
            redirect('administrator/offers');
        }
    }
}