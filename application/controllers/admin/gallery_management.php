<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_management extends CI_Controller {

    private $data;

    public function __construct() {
        parent::__construct();
        $this->load->model('gallery_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function manage_gallery() {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->comman_model->get_total('gallery', array());
        $per_page = 4;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_gallery/', $total, $per_page, $num_links, $uri_segment);
        $where = array();
        $where_in = $this->gallery_model->limit_query($per_page, $start_from);// getting limited record from first table
        $this->data['result'] = $this->gallery_model->get_all_gallery($where_in);// getting records from both tables on behalf of first query
        $this->data['result'] = array_chunk($this->data['result'], 2);//making futher array to get record english and arabic
        $this->data['view_path'] = "admin/gallery/manage_gallery";
        $this->data['page'] = "manage_gallery";

        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');

        $this->load->view('admin_template', $this->data);
    }

    function create_gallery() {
        $this->data['view_path'] = "admin/gallery/create_gallery";
        $this->data['page'] = "manage_gallery";
        if ($this->input->server('REQUEST_METHOD') === 'POST') {

            $this->form_validation->set_rules('title_en', 'gallery Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|xss_clean');

            $this->form_validation->set_rules('title_ar', 'gallery Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|xss_clean');
            if (empty($_FILES['gallery_image']['name']))
                $this->form_validation->set_rules('gallery_image', 'gallery Image', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {

                $img = upload_image('gallery_image', 'uploads/gallery_image');
                if (isset($img['error'])) {
                    $this->data['errors'] = $img['error'];
                    return $this->load->view('admin_template', $this->data);
                }
                $save = $this->comman_model->save('gallery', array(
                    'gallery_image' => $img['file_name'],
                        )
                );

                if ($save) {
                    $gallery_en = $this->comman_model->save('gallery_detail', array(
                        'gallery_id' => $save,
                        'title' => $this->input->post('title_en'),
                        'description' => $this->input->post('description_en'),
                        'lang' => 1,
                            )
                    );
                    $gallery_ar = $this->comman_model->save('gallery_detail', array(
                        'gallery_id' => $save,
                        'title' => $this->input->post('title_ar'),
                        'description' => $this->input->post('description_ar'),
                        'lang' => 2,
                            )
                    );
                    $this->session->set_flashdata('success', 'gallery Created successfully.');

                    redirect('administrator/manage_gallery');
                } else {
                    $this->data['errors'] = 'An error occurred, try later';
                }
            } else {
                $this->data['errors'] = validation_errors();
            }
        }

        $this->load->view('admin_template', $this->data);
    }

    function edit_gallery() {
        $gallery_id = $this->uri->segment(3);
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->data['view_path'] = "admin/gallery/edit_gallery";
            $this->data['page'] = "manage_gallery";

            $this->form_validation->set_rules('title_en', 'gallery Title', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_en', 'Description', 'trim|required|xss_clean');

            $this->form_validation->set_rules('title_ar', 'gallery Title Arabic', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('description_ar', 'Description Arabic', 'trim|required|xss_clean');

            if ($this->form_validation->run() !== FALSE) {
                if (($_FILES['gallery_image']['name'] != '')) {
                    $img = upload_image('gallery_image', 'uploads/gallery_image');
                    if (isset($img['error'])) {
                        $this->session->set_flashdata('errors', $img['error']);
                        return redirect('administrator/edit_gallery/9');
                    }
                    $save = $this->comman_model->update('gallery', array(
                        'id' => $gallery_id
                            ), array(
                        'gallery_image' => $img['file_name'],
                            )
                    );
                }
                $gallery_en = $this->comman_model->update('gallery_detail', array(
                    'lang' => 1,
                    'gallery_id' => $gallery_id
                        ), array(
                    'title' => $this->input->post('title_en'),
                    'description' => $this->input->post('description_en'),
                        )
                );
                $gallery_ar = $this->comman_model->update('gallery_detail', array(
                    'lang' => 2,
                    'gallery_id' => $gallery_id
                        ), array(
                    'title' => $this->input->post('title_ar'),
                    'description' => $this->input->post('description_ar'),
                        )
                );
                $this->session->set_flashdata('success', 'gallery Updated successfully.');
                redirect('administrator/manage_gallery');
            } else {
                $this->session->set_flashdata('errors', validation_errors());
                return redirect('administrator/edit_gallery/' . $gallery_id);
            }
        }
        $gallery_data = $this->gallery_model->verify_gallery(array('g.id' => $gallery_id));

        if ($gallery_data) {
            $this->data['gallery'] = $gallery_data;
            $this->data['view_path'] = "admin/gallery/edit_gallery";
            $this->data['page'] = "manage_gallery";

            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'gallery not found.');
            redirect('administrator/manage_gallery');
        }
    }

    function view_gallery() {
        $gallery_id = $this->uri->segment(3);
        $gallery_data = $this->gallery_model->verify_gallery(array('g.id' => $gallery_id));

        if ($gallery_data) {
            $this->data['gallery'] = $gallery_data;
            $this->data['view_path'] = "admin/gallery/view_gallery";
            $this->data['page'] = "manage_gallery";

            $this->load->view('admin_template', $this->data);
        } else {
            $this->session->set_flashdata('errors', 'gallery not found.');
            redirect('administrator/manage_gallery');
        }
    }

    function delete_gallery() {
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4))) {

            $where = array('id' => $this->uri->segment(4));
            $where2 = array('gallery_id' => $this->uri->segment(4));
            $delete = $this->comman_model->delete('gallery', $where);
            $delete2 = $this->comman_model->delete('gallery_detail', $where2);
            if ($delete) {
                $this->session->set_flashdata('success', "gallery deleted successfully.");
            } else {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_gallery/' . $this->uri->segment(3));
        }
        redirect('administrator/manage_gallery/10/');
    }

}
