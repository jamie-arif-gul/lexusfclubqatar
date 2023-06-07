<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages_management extends CI_Controller {
  
  	private $data;
  
  	public function __construct() {
        parent::__construct();
        $this->load->model('messages_model');
        $this->load->model('comman_model');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

   
    function manage_messages(){
       $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('thread_id !=' => 0);
        $total = $this->comman_model->get_total('threads',$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_messages/', $total, $per_page, $num_links, $uri_segment);

        $this->data['results'] = $this->messages_model->get_threads_admin($per_page, $start_from,$where);
        //echo '<pre>'; print_r($this->data['results']); '</pre>'; die();
        $this->data['view_path'] = "admin/messages/manage_messages";
        $this->data['page'] = "manage_messages";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

    function messages_detail(){
    	$thread_id = decode_uri($this->uri->segment(4));
        $messages = $this->messages_model->get_messages_admin($thread_id);
        //echo '<pre>'; print_r($messages); die();
        if($messages){
            $this->data['results'] = $messages;
        }

    	$this->data['view_path'] = "admin/messages/messages_detail";
        $this->data['page'] = "manage_messages";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

}