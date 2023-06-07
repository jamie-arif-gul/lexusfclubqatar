<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Property_management extends CI_Controller {
  
  	private $data;
  
  	public function __construct() {
        parent::__construct();
        $this->load->model('property_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
        $this->check_login_again();
    }

    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function create_property(){
        $this->data['view_path'] = "admin/property/manage_properties";
        $this->data['page'] = "manage_properties";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

    
    function manage_properties(){
       $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('property_id !=' => 0);
        $total = $this->property_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_properties/', $total, $per_page, $num_links, $uri_segment);

        $this->data['results'] = $this->property_model->get_all_properties($per_page, $start_from,array('p.property_id !=' => 0));
        
        $this->data['view_path'] = "admin/property/manage_properties";
        $this->data['page'] = "manage_properties";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

    function popular_properties(){
       $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('property_id !=' => 0);
        $total = $this->property_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/popular_properties/', $total, $per_page, $num_links, $uri_segment);

        $this->data['results'] = $this->property_model->popular_properties($per_page, $start_from,array('p.property_id !=' => 0));
        
        $this->data['view_path'] = "admin/property/popular_properties";
        $this->data['page'] = "popular_properties";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }

    function deleteProperty(){
    	$property_id = decode_uri($this->uri->segment(4));
    	$where = array('property_id' => $property_id);
    	$deleted = $this->property_model->delete($where);
    	if($deleted){
    		$this->session->set_flashdata('success','Property Deleted Successfully.');
    		redirect('administrator/manage_properties/'.$this->uri->segment(3));
    	}
    	$this->session->set_flashdata('errors','Requested property not found,please try later.');
    	redirect('administrator/manage_properties/'.$this->uri->segment(3));
    }

    function updateStatus(){
        $property_id = decode_uri($this->uri->segment(4));
        $status = $this->uri->segment(5);
        $where = array('property_id' => $property_id);
        $propertyData = array('status' => $status);
        $updated = $this->property_model->update($where,$propertyData);
        if($updated){
            $msg = ($status == 1)? 'Property Activated Successfully.' : 'Property Deactivated Successfully.';
            $this->session->set_flashdata('success',$msg);
            redirect('administrator/manage_properties/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Requested property not found,please try later.');
        redirect('administrator/manage_properties/'.$this->uri->segment(3));
    }

    function featured(){
        //die('bghk');
        $property_id = decode_uri($this->uri->segment(4));
        $status = $this->uri->segment(5);
        $where = array('property_id' => $property_id);
        $propertyData = array('is_feature' => $status);
        $updated = $this->property_model->update($where,$propertyData);
        if($updated){
            $msg = ($status == 1)? 'Property Featured Successfully.' : 'Property Unfeatured Successfully.';
            $this->session->set_flashdata('success',$msg);
            redirect('administrator/manage_properties/'.$this->uri->segment(3));
        }
        $this->session->set_flashdata('errors','Requested property not found,please try later.');
        redirect('administrator/manage_properties/'.$this->uri->segment(3));
    }

    function propertyDetail(){
        //die('fdfsfsdf');
        $property_id = decode_uri($this->uri->segment(4));
        $this->data['view_path'] = "admin/property/property_detail";
        $this->data['page'] = "property_detail";
        $property_data = get('properties',array('property_id' => $property_id));
        if($property_data){
            $this->data['property_data'] = $property_data;
            $this->data['reviews'] = $this->property_model->get_reviews(array('property_id' => $property_data[0]['property_id'],'reviews !=' => ''));
        }
            //$this->data['success'] = $this->session->set_flashdata('success','dfsdfsf');
        
            //$this->data['errors'] = $this->session->set_flashdata('errors','fsdfsdf');
        
        $this->load->view('admin_template', $this->data);
    }

    function deleteReview(){
        $rating_id = decode_uri($this->uri->segment(5));
        $where = array('rating_id' => $rating_id);
        $data = array('reviews' => '');
        $updated = $this->comman_model->update('property_rating',$where,$data);
        if($updated){
            $this->session->set_flashdata('success','Review deleted Successfully.');
            redirect('administrator/property_detail/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
        }
        $this->session->set_flashdata('errors','Requested review not found,please try later.');
        redirect('administrator/property_detail/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
    }

    function add_property_views(){
        //echo 'add_property_views'; die();
        $property_id = ($this->input->post('property_id')/99);
        if($property_id > 0){
            $table = 'properties';
            $where = array('property_id' => $property_id);
            $imageData = array('views_counter' => $this->input->post('views_counter'));
            $updated = $this->comman_model->update($table,$where,$imageData);
            if($updated){
              echo '<p style="color:green;">updated</p>';  
            }else{
                echo '<p style="color:red;">not updated</p>';
            }
        }
    }


}