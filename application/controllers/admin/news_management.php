<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_management extends CI_Controller
{

    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
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

    function manage_news() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('news',array());
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_news/', $total, $per_page, $num_links, $uri_segment);
        $where = array();
//
        $this->data['result'] = $this->news_model->get_all_news($per_page*2, $start_from*2, $where);
//        echo "<pre>";
//        print_r($this->data['result']);die;
        $this->data['view_path'] = "admin/news/manage_news";
        $this->data['page'] = "manage_news";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }

    function create_news()
    {
        $this->data['view_path'] = "admin/news/create_news";
        $this->data['page'] = "manage_news";
        if ($this->input->server('REQUEST_METHOD') === 'POST'){

            $this->form_validation->set_rules('title_en', 'News Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|xss_clean');

            $this->form_validation->set_rules('title_ar', 'News Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|xss_clean');
            if(empty($_FILES['news_image']['name']))
                $this->form_validation->set_rules('news_image', 'News Image', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                $img = upload_image('news_image', 'uploads/news_image');
                if (isset($img['error'])) {
                    $this->data['errors'] = $img['error'];
                    return $this->load->view('admin_template', $this->data);
                }
                $save = $this->comman_model->save('news',
                    array(
                        'news_image' => $img['file_name'],
                        'admin_id' => $this->session->userdata('admin_user_id')
                    )
                );

                if ($save) {
                    $news_en = $this->comman_model->save('news_detail',
                        array(
                            'news_id' => $save,
                            'title' => $this->input->post('title_en'),
                            'description' => $this->input->post('description_en'),
                            'lang' => 1,
                        )
                    );
                    $news_ar = $this->comman_model->save('news_detail',
                        array(
                            'news_id' => $save,
                            'title' => $this->input->post('title_ar'),
                            'description' => $this->input->post('description_ar'),
                            'lang' => 2,
                        )
                    );
                    $this->session->set_flashdata('success','News Created successfully.');
                    redirect('administrator/manage_news');
                } else {
                    $this->data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }
    function edit_news(){
        $news_id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->data['view_path'] = "admin/news/edit_news";
            $this->data['page'] = "manage_news";

            $this->form_validation->set_rules('title_en', 'News Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|xss_clean');

            $this->form_validation->set_rules('title_ar', 'News Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {
                if(($_FILES['news_image']['name'] != '')){
                    $img = upload_image('news_image', 'uploads/news_image');
                    if (isset($img['error'])) {
                        $this->session->set_flashdata('errors', $img['error']);
                        return redirect('administrator/edit_news/9');
                    }
                    $save = $this->comman_model->update('news',
                        array(
                          'id' => $news_id
                        ),
                        array(
                            'news_image' => $img['file_name'],
                            'admin_id' => $this->session->userdata('admin_user_id')
                        )
                    );
                }
                $news_en = $this->comman_model->update('news_detail',
                    array(
                        'lang' => 1,
                        'news_id' => $news_id
                    ),
                    array(
                        'title' => $this->input->post('title_en'),
                        'description' => $this->input->post('description_en'),
                    )
                );
                $news_ar = $this->comman_model->update('news_detail',
                    array(
                        'lang' => 2,
                        'news_id' => $news_id
                    ),
                    array(
                        'title' => $this->input->post('title_ar'),
                        'description' => $this->input->post('description_ar'),
                    )
                );
                $this->session->set_flashdata('success','News Updated successfully.');
                redirect('administrator/manage_news');
//                $where = array('id' => $news_id);
//                $this->news_model->update($where,$data);
            }
            else{
                $this->session->set_flashdata('errors', validation_errors());
                return redirect('administrator/edit_news/'.$news_id);
//                return $this->load->view('admin_template', $this->data);
            }
        }
        $news_data = $this->news_model->verify_news(array('n.id' => $news_id));
//        var_dump($news_data);die;
//            $user_data = $this->user_model->verify_user(array('user_id' => $user_id,'user_role' => 2));
        if ($news_data) {
            $this->data['news'] = $news_data;
            $this->data['view_path'] = "admin/news/edit_news";
            $this->data['page'] = "manage_news";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'news not found.');
            redirect('administrator/manage_news');
        }
    }
    function view_news(){
        $news_id = $this->uri->segment(3);
        $news_data = $this->news_model->verify_news(array('n.id' => $news_id));
//        var_dump($news_data);die;
//            $user_data = $this->user_model->verify_user(array('user_id' => $user_id,'user_role' => 2));
        if ($news_data) {
            $this->data['news'] = $news_data;
            $this->data['view_path'] = "admin/news/view_news";
            $this->data['page'] = "manage_news";

            $this->load->view('admin_template', $this->data);
        }else {
            $this->session->set_flashdata('errors', 'news not found.');
            redirect('administrator/manage_news');
        }
    }
    function delete_news() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))){
//            var_dump(is_numeric($this->uri->segment(3)));die;
            $where = array('id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('news',$where);
            if ($delete){
                $this->session->set_flashdata('success', "News deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_news/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_news/10/');
    }
}