<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_controller extends CI_Controller {
  private $_data;

  public function __construct() {
        parent::__construct();
        login_persists();
        $this->load->model('search_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->load->helper('email_helper');
    }

    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }

    function index() {
        /*$start_from = $this->input->get('per_page');
        if (!is_numeric($start_from))
            $start_from = 0;
        $get = $_GET;
        unset($get['per_page']);
        $suffix = '&'.http_build_query($get, '', "&");
        $config['page_query_string'] = TRUE;
        $config['base_url'] = base_url('search').'?';
        $config['suffix'] = $suffix;
        $config['first_url'] = base_url('search').'?'.$suffix;
        $config['total_rows'] = $this->search_model->get_search_sesults_total();
        //echo $config['total_rows']; die();
        $config['per_page'] = 1;
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        //$config['uri_segment'] = 3;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';

        $this->pagination->initialize($config);

        echo $this->pagination->create_links(); 

        die();*/

        $this->_data['results'] = $this->search_model->get_search_sesults();
        //echo '<pre>'; print_r($this->_data['results']); die();
        $favorits = $this->comman_model->get('property_favourites',array('user_id'=> $this->session->userdata('user_id')),'group_concat(property_id) as favorits_ids');
        $this->_data['favorits'] = explode(',', $favorits[0]['favorits_ids']);
        $visited = $this->comman_model->get('views_property',array('user_id'=> $this->session->userdata('user_id')),'group_concat(property_id) as visited_ids');
        $this->_data['visited'] = explode(',', $visited[0]['visited_ids']);
        $this->_data['main_content'] = 'frontend/search/index';
        $this->__loadView();
    }

    function save_search(){
        if (!$this->session->userdata('logged_in'))
            redirect('login');
        
        if ($this->input->server('REQUEST_METHOD') === 'POST'){
            $search_url = $_SERVER['HTTP_REFERER'];
            $this->form_validation->set_rules('title', 'Serach Title', 'trim|required|max_length[45]|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('errors',validation_errors());
            }else {
                $table_name = 'user_search';
                $search_date = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'search' => $search_url,
                    'name' => $this->input->post('title'),
                    'created' => date('Y-m-d H:i:s')
                    );
                
                $save = $this->comman_model->save($table_name,$search_date);
                if($save){
                    $this->session->set_flashdata('success','Search saved successfully.');
                }else{
                    $this->session->set_flashdata('errors','An error occurred, try later.');
                }
        }
    }
        redirect($search_url);
    }

    function tags(){
        /*$string = 'fsfddfsczxcxzcvbfg><';
        if($string != strip_tags($string)){
            $result = 'string has HTML tags';
        }else{
            $result = 'No HTML tags found in string';
        }
        echo $result;*/
        $str = "<p> helo </p><b>je</b>ghhhhhhhg";

        //echo $str;

        echo preg_replace ('/<[^>]*>/', ' ', $str);

        //$str = "<p> helo </p><b>je</b>irfan";

        //echo $str;

        //echo preg_match ('/<[^>]*>/', $str);
    }

}