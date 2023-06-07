<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Property_controller extends CI_Controller {
  
  	private $_data;
  
  	public function __construct() {
        parent::__construct();
        login_persists();
        /*if (!$this->session->userdata('logged_in'))
            redirect('login');*/
        $this->load->model('property_model');
        $this->load->model('comman_model');
        $this->load->helper('upload_helper');
    }

    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }

    private function __get_location($location = 'United States') {
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . urlencode($location) . '&sensor=false');
        $output = json_decode($geocode);
        return $output->results[0]->geometry->location;
    }

    private function __is_login(){
        if (!$this->session->userdata('logged_in'))
            redirect('login');
    }

    /*function index(){
        $youtube_data = file_get_contents('https://www.googleapis.com/youtube/v3/search?key=AIzaSyDlWyiJQgYAGiGwcuIGPOM4lZWp4AH6ckw&channelId=UCXEAOtWSleezLtF6qQTZWAQ&part=snippet,id&order=date&maxResults=20');
        $youtube_data = json_decode($youtube_data,true);
        $youtube_data = $youtube_data['items'];
        $videos = array();
        for ($i=0; $i < count($youtube_data)-1; $i++) { 
            $videos[$i] = $youtube_data[$i]['id']['videoId'];
        }
        
        foreach ($videos as $video) {
            //echo $video;
            echo '<iframe width="420" height="315" src="http://www.youtube.com/embed/'.$video.'"></iframe>';
        }
        //echo '<pre>'; print_r($videos); echo '</pre>';
    }*/

    function index(){
    	$start_from = $this->uri->segment(2);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('status' => 1);
        $total = $this->property_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 2;
        $this->data['pagination'] = paginate(base_url() . 'properties/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->property_model->get_all_properties($per_page, $start_from,$where);
        //echo "<pre>"; print_r($this->data['results']); die();
        $this->_data['main_content'] = 'frontend/property/properties';
        $this->__loadView();       
    }

    function lan(){
        $this->_data['main_content'] = 'frontend/property/lan';
        $this->__loadView(); 
    }

    function fblogin(){
        $this->load->view('frontend/property/facebook_login');
        //$this->__loadView(); 
    }
    function glogin(){
        $this->load->view('frontend/property/google_login');
        //$this->__loadView(); 
    }

    function myProperties(){
        $this->__is_login();
    	$start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('user_id' => $this->session->userdata('user_id'));
        $total = $this->property_model->get_total($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->_data['pagination'] = paginate(base_url() . 'properties/myProperties/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->property_model->get_my_properties($per_page, $start_from,array('p.user_id' => $this->session->userdata('user_id')));
        //echo "<pre>"; print_r($this->_data['results']); die();
        $this->_data['main_content'] = 'frontend/property/myProperties';
        $this->__loadView();       
    }

    function createProperty(){
        $this->__is_login();
    	if ($this->input->server('REQUEST_METHOD') === 'POST'){
    		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('date_from', 'Date from', 'trim|required|max_length[45]|xss_clean');
            $this->form_validation->set_rules('date_to', 'Date to', 'trim|required|max_length[45]|xss_clean');
    		$this->form_validation->set_rules('zip_code', 'Zip code', 'trim|required|integer|xss_clean');
    		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
    		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price_pre', 'Price', 'trim|xss_clean');
    		$this->form_validation->set_rules('price', 'Price', 'trim|required|integer|greater_than[0]|xss_clean');
    		$this->form_validation->set_rules('bedrooms', 'Bedrooms', 'trim|required|xss_clean');
            $this->form_validation->set_rules('bathrooms', 'Bathrooms', 'trim|required|xss_clean');
            $this->form_validation->set_rules('area', 'Square Feet', 'trim|required|integer|greater_than[0]|xss_clean');
    		$this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
            //$this->form_validation->set_rules('country_id', 'Country', 'trim|xss_clean');
            $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('unit', 'Unit', 'trim|xss_clean');
            $this->form_validation->set_rules('pets_allowed', 'pets allowed', 'trim|required|xss_clean');
            $this->form_validation->set_rules('parking', 'parking', 'trim|required|xss_clean');
    		if ($this->form_validation->run() == FALSE) {
                $this->_data['errors'] = validation_errors();
            }else {
                date_default_timezone_set('US/Eastern');
                $time = strtotime($this->input->post('date_from')); 
                //echo date('m/d/Y H:i:s',$time);
                //die();
                $address = ucfirst($this->input->post('address')).', '.ucfirst($this->input->post('city')).', '.ucfirst($this->input->post('state')).', '.ucfirst($this->input->post('country_id'));
                $gps = $this->__get_location($address); 
            	$propertyData = array(
            			'user_id' => $this->session->userdata('user_id'),
                       	'name' => $this->input->post('name'),
                        'date_from' => strtotime($this->input->post('date_from')),
                        'date_to' => strtotime($this->input->post('date_to')),
                       	'type' => $this->input->post('type'),
                        'description' => $this->input->post('description'),
                        'address' => ucfirst($this->input->post('address')),
                        'city' => ucfirst($this->input->post('city')),
                        'state' => ucfirst($this->input->post('state')),
                        'zip_code' => $this->input->post('zip_code'),
                        'country' => ucfirst($this->input->post('country_id')),
                        'price' => $this->input->post('price'),
                        'bedrooms' => $this->input->post('bedrooms'),
                        'bathrooms' => $this->input->post('bathrooms'),
                        'area' => $this->input->post('area'),
                        'country_id' => $this->input->post('country_id'),
                        'pets_allowed' => $this->input->post('pets_allowed'),
                        'parking' => $this->input->post('parking'),
                        'building_size' => $this->input->post('building_size'),
                        'unit' => $this->input->post('unit'),
                        'gps' => $gps->lat.','.$gps->lng,
                        'created' => date('Y-m-d H:i:s')
                    );
            	$created = $this->property_model->save($propertyData);
            	if($created){
            		
            		redirect('properties/createPropertyStepTow/'.encode_url($created));
            	}
            	else{
            		$this->_data['errors'] = 'An error occurred, try later.';
            	}
            }
    	}
    	$this->_data['main_content'] = 'frontend/property/createProperty';
        $this->__loadView();

    }
    function createPropertyStepTow(){
        $this->__is_login();
        $property_id = decode_uri($this->uri->segment(3));
        //echo $property_id; die();
        $where = array('property_id' => $property_id);
        $this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
        if($property_data){
            if($this->input->server('REQUEST_METHOD') === 'POST'){
                //print_r($_POST); die();
                $propertyData = array(
                            'amenities' => json_encode($this->input->post('amenities'),true),
                            'additional_description' => $this->input->post('additional_description'),
                        );
                //echo "<pre>"; print_r($propertyData); die();
                    $updated = $this->property_model->update($where,$propertyData);
                    /*if($updated){
                        //$this->session->set_flashdata('success','Step tow successfully completed.');
                    }else{
                        $this->session->set_flashdata('errors','Step tow not successfully completed.');
                    }*/
                    redirect('properties/createPropertyStepThree/'.$this->uri->segment(3)); 
            }
            $this->_data['amenities'] = json_decode($property_data[0]['amenities']);
            $this->_data['main_content'] = 'frontend/property/createPropertyStepTow';
            $this->__loadView();
        }else{
            $this->session->set_flashdata('errors','Property not exists please create property first.');
            redirect('properties/createProperty');  
        }
    }
    
    function upload_property_image_main(){
        $this->__is_login();
        $response = array('success' => FALSE);
        $table = 'property_images';
        if (isset($_FILES['property_image']['name']) && trim($_FILES['property_image']['name']) != "") {
            $uploaded_image = upload_image('property_image', realpath(APPPATH . '../uploads/img_gallery/property_images/'));
            //echo '<pre>'; print_r($uploaded_image['file_name']); die();
            //$this->session->set_userdata('profile_pic', $profile_pic['file_name']);
            if (isset($uploaded_image['error'])) {
                if ($uploaded_image['error'] < 0) {
                    $response['msg'] = $uploaded_image['error'];
                }
            }else {
                $imageData = array(
                    'property_id' => decode_uri($this->input->post('property_id')),
                    'image' => $uploaded_image['file_name'],
                    'type' => 1
                    );
                //print_r($imageData); die('');
                if(decode_uri($this->input->post('image_id')) > 0){
                    $where = array('image_id' => decode_uri($this->input->post('image_id')));
                    $updated = $this->comman_model->update($table,$where,$imageData);
                    if($updated){
                        $response['image_id'] = $this->input->post('image_id');
                        $response['image'] = $uploaded_image['file_name'];
                        $response['msg'] = 'Image successfully updated.';
                        $response['success'] = TRUE;
                    }else{
                        $response['msg'] = 'Image not updated successfully.';
                    }

                }else{
                    $saved = $this->comman_model->save($table,$imageData);
                    if($saved){
                          $response['image_id'] = encode_url($saved);
                          $response['image'] = $uploaded_image['file_name'];
                          $response['msg'] = 'Image successfully uploaded.';
                          $response['success'] = TRUE;
                    }else{
                        $response['msg'] = 'Image not uploaded successfully.';
                    }   
                }
                
                /*$thumb_sizes = array(
                    array(270, 270)
                    );
                $thumb_data = resize_image($uploaded_image, $thumb_sizes);
                if (isset($thumb_data['error'])) {
                    $this->session->set_flashdata('errors', $thumb_data['error']);
                    redirect('profile');
                }*/
                
            }
        }
        echo json_encode($response,TRUE);
    }

    function upload_property_image(){
        $this->__is_login();
        $response = array('success' => FALSE);
        $table = 'property_images';
        if (isset($_FILES['property_image']['name']) && trim($_FILES['property_image']['name']) != "") {
            $uploaded_image = upload_image('property_image', realpath(APPPATH . '../uploads/img_gallery/property_images/'));
            //echo '<pre>'; print_r($uploaded_image['file_name']); die();
            //$this->session->set_userdata('profile_pic', $profile_pic['file_name']);
            if (isset($uploaded_image['error'])) {
                if ($uploaded_image['error'] < 0) {
                    $response['msg'] = $uploaded_image['error'];
                }
            }else {
                $imageData = array(
                    'property_id' => decode_uri($this->input->post('property_id')),
                    'image' => $uploaded_image['file_name'],
                    'type' => 2
                    );
                //print_r($imageData); die('');
                if(decode_uri($this->input->post('image_id')) > 0){
                    $where = array('image_id' => decode_uri($this->input->post('image_id')));
                    $updated = $this->comman_model->update($table,$where,$imageData);
                    if($updated){
                        $response['image_id'] = $this->input->post('image_id');
                        $response['image'] = $uploaded_image['file_name'];
                        $response['msg'] = 'Image successfully updated.';
                        $response['success'] = TRUE;
                    }else{
                        $response['msg'] = 'Image not updated successfully.';
                    }

                }else{
                    $saved = $this->comman_model->save($table,$imageData);
                    if($saved){
                          $response['image_id'] = encode_url($saved);
                          $response['image'] = $uploaded_image['file_name'];
                          $response['msg'] = 'Image successfully uploaded.';
                          $response['success'] = TRUE;
                    }else{
                        $response['msg'] = 'Image not uploaded successfully.';
                    }   
                }
                
                /*$thumb_sizes = array(
                    array(270, 270)
                    );
                $thumb_data = resize_image($uploaded_image, $thumb_sizes);
                if (isset($thumb_data['error'])) {
                    $this->session->set_flashdata('errors', $thumb_data['error']);
                    redirect('profile');
                }*/
                
            }
        }
        echo json_encode($response,TRUE);
    }
    
    function add_image_description(){
        $this->__is_login();
        $image_id = decode_uri($this->input->post('image_id'));
        if($image_id > 0){
            $table = 'property_images';
            $where = array('image_id' => $image_id);
            $imageData = array('image_description' => $this->input->post('image_description'));
            $updated = $this->comman_model->update($table,$where,$imageData);
            if($updated){
              echo '<p style="color:green;">Image Description updated</p>';  
            }else{
                echo '<p style="color:red;">Image Description not updated</p>';
            }
        }
    }

    function createPropertyStepThree(){
        $this->__is_login();
        $property_id = decode_uri($this->uri->segment(3));
        //echo $property_id; die();
        $where = array('property_id' => $property_id);
        $this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
        if($property_data){
            if($this->input->server('REQUEST_METHOD') === 'POST'){
                //print_r($_POST); die();
                $propertyData = array(
                            'stereotype' => json_encode($this->input->post('stereotype'),true),
                        );
                //echo "<pre>"; print_r($propertyData); die();
                    $updated = $this->property_model->update($where,$propertyData);
                    /*if($updated){
                        //$this->session->set_flashdata('success','Step three successfully completed.');
                    }else{
                        $this->session->set_flashdata('errors','Step three not successfully completed.');
                    }*/
                    redirect('properties/createPropertyStepFour/'.$this->uri->segment(3)); 
            }
            $this->_data['stereotype'] = json_decode($property_data[0]['stereotype']);
            //print_r($this->_data['stereotype']); die();
            $this->_data['main_content'] = 'frontend/property/createPropertyStepThree';
            $this->__loadView();
        }else{
            $this->session->set_flashdata('errors','Property not exists please create property first.');
            redirect('properties/createProperty');  
        }
    }

    function createPropertyStepFour(){
        $this->__is_login();
        $property_id = decode_uri($this->uri->segment(3));
        //echo $property_id; die();
        $where = array('property_id' => $property_id);
        $this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
        if($property_data){

        }else{
            $this->session->set_flashdata('errors','Property not exists please create property first.');
            redirect('properties/createProperty');  
        }
        $this->_data['main_content'] = 'frontend/property/createPropertyStepFour';
        $this->__loadView();
    }

    function editProperty(){
        $this->__is_login();
    	$property_id = decode_uri($this->uri->segment(4));
    	//echo $property_id; die();
    	$where = array('property_id' => $property_id,'user_id' => $this->session->userdata('user_id'));
    	$this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
    	if($property_data){
    		//echo "<pre>"; print_r($property_data); die();
	    	if ($this->input->server('REQUEST_METHOD') === 'POST'){
	    		//echo "<pre>"; print_r($_POST); die();
	    		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[45]|xss_clean');
                $this->form_validation->set_rules('date_from', 'Date from', 'trim|required|max_length[45]|xss_clean');
                $this->form_validation->set_rules('date_to', 'Date to', 'trim|required|max_length[45]|xss_clean');
                $this->form_validation->set_rules('zip_code', 'Zip code', 'trim|required|integer|xss_clean');
                $this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
                $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('price_pre', 'Price', 'trim|xss_clean');
                $this->form_validation->set_rules('price', 'Price', 'trim|required|integer|greater_than[0]|xss_clean');
                $this->form_validation->set_rules('bedrooms', 'Bedrooms', 'trim|required|integer|xss_clean');
                $this->form_validation->set_rules('bathrooms', 'Bathrooms', 'trim|required|integer|xss_clean');
                $this->form_validation->set_rules('area', 'Square Feet', 'trim|required|integer|greater_than[0]|xss_clean');
                $this->form_validation->set_rules('type', 'Type', 'trim|required|xss_clean');
                $this->form_validation->set_rules('state', 'State', 'trim|required|xss_clean');
                //$this->form_validation->set_rules('country', 'Country', 'trim|xss_clean');
                $this->form_validation->set_rules('country_id', 'Country', 'trim|required|xss_clean');
                $this->form_validation->set_rules('unit', 'Unit', 'trim|xss_clean');
                $this->form_validation->set_rules('pets_allowed', 'pets allowed', 'trim|required|xss_clean');
                $this->form_validation->set_rules('parking', 'parking', 'trim|required|xss_clean');
	    		if ($this->form_validation->run() == FALSE) {
	                $this->_data['errors'] = validation_errors();
	            }else {
                    $address = ucfirst($this->input->post('address')).', '.ucfirst($this->input->post('city')).', '.ucfirst($this->input->post('state')).', '.ucfirst($this->input->post('country_id'));
                    $gps = $this->__get_location($address); 
	            	$propertyData = array(
	            			'user_id' => $this->session->userdata('user_id'),
                            'name' => $this->input->post('name'),
                            'date_from' => strtotime($this->input->post('date_from')),
                            'date_to' => strtotime($this->input->post('date_to')),
                            'type' => $this->input->post('type'),
                            'description' => $this->input->post('description'),
                            'address' => ucfirst($this->input->post('address')),
                            'city' => ucfirst($this->input->post('city')),
                            'state' => ucfirst($this->input->post('state')),                     
                            'zip_code' => $this->input->post('zip_code'),
                            'country' => ucfirst($this->input->post('country_id')),
                            'price' => $this->input->post('price'),
                            'bedrooms' => $this->input->post('bedrooms'),
                            'bathrooms' => $this->input->post('bathrooms'),
                            'area' => $this->input->post('area'),
                            'country_id' => $this->input->post('country_id'),
                            'pets_allowed' => $this->input->post('pets_allowed'),
                            'parking' => $this->input->post('parking'),
                            'building_size' => $this->input->post('building_size'),
                            'unit' => $this->input->post('unit'),
                            'gps' => $gps->lat.','.$gps->lng
    	                    );
	            	$updated = $this->property_model->update($where,$propertyData);
                    redirect('properties/createPropertyStepTow/'.$this->uri->segment(4));
	            	/*if($updated){
	            		if($_FILES['image']['name'] != ''){
                        $upload = $this->uplaod_image('image');
                        if($upload){
                            $updated = $this->property_model->update($where,array('image'=> $this->session->userdata('image_name')));
                            if($updated){
                                $this->session->unset_userdata('image_name');
                                //$this->session->set_flashdata('success','Your property has been updated successfully.');    
                            }
                        }else{
                            //$this->session->set_flashdata('success','Your property has been updated successfully.');
                        }   
                        }else{
                            //$this->session->set_flashdata('success','Your property has been updated successfully.');
                        }
	            		//$this->session->set_flashdata('success','Your property has been updated successfully.');
	            		redirect('properties/createPropertyStepTow/'.$this->uri->segment(4));
	            	}
	            	else{
	            		$this->_data['errors'] = 'An error occurred, try later.';
	            	}*/
	            } 
	        }
    		$this->_data['main_content'] = 'frontend/property/editProperty';
        	$this->__loadView();
    	}
    	else{
    		$this->session->set_flashdata('errors','Requested property not found,please try later.');
    		redirect('properties/myProperties/'.$this->uri->segment(3));

    	}
    }

    function editPropertyStepTow(){
        $this->__is_login();
        $property_id = decode_uri($this->uri->segment(4));
        //echo $property_id; die();
        $where = array('property_id' => $property_id);
        $this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
        if($property_data){
            if($this->input->server('REQUEST_METHOD') === 'POST'){
                //print_r($_POST); die();
                $propertyData = array(
                            'amenities' => json_encode($this->input->post('amenities'),true),
                            'additional_description' => $this->input->post('additional_description'),
                        );
                //echo "<pre>"; print_r($propertyData); die();
                    $updated = $this->property_model->update($where,$propertyData);
                    if($updated){
                        $this->session->set_flashdata('success','Step tow successfully updated.');
                    }else{
                        $this->session->set_flashdata('errors','Step tow not successfully updated.');
                    }
                    redirect('properties/editPropertyStepThree/'.$this->uri->segment(3).'/'.$this->uri->segment(4)); 
            }
            $this->_data['amenities'] = json_decode($property_data[0]['amenities']);
            $this->_data['main_content'] = 'frontend/property/editPropertyStepTow';
            $this->__loadView();
        }else{
            $this->session->set_flashdata('errors','Property not exists please create property first.');
            redirect('properties/createProperty');  
        }
    }
    
    function editPropertyStepThree(){
        $this->__is_login();
            $property_id = decode_uri($this->uri->segment(4));
            //echo $property_id; die();
            $where = array('property_id' => $property_id);
            $this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
            if($property_data){
                if($this->input->server('REQUEST_METHOD') === 'POST'){
                    //print_r($_POST); die();
                    $propertyData = array(
                                'stereotype' => json_encode($this->input->post('stereotype'),true),
                            );
                    //echo "<pre>"; print_r($propertyData); die();
                        $updated = $this->property_model->update($where,$propertyData);
                        if($updated){
                            $this->session->set_flashdata('success','Step three successfully updated.');
                        }else{
                            $this->session->set_flashdata('errors','Step three not successfully updated.');
                        }
                        redirect('properties/editPropertyStepFour/'.$this->uri->segment(3).'/'.$this->uri->segment(4));
                }
                $this->_data['stereotype'] = json_decode($property_data[0]['stereotype']);
                //print_r($this->_data['stereotype']); die();
                $this->_data['main_content'] = 'frontend/property/editPropertyStepThree';
                $this->__loadView();
            }else{
                $this->session->set_flashdata('errors','Property not exists please create property first.');
                redirect('properties/createProperty');  
            }
        }

        function editPropertyStepFour(){
            $this->__is_login();
            $property_id = decode_uri($this->uri->segment(4));
            //echo $property_id; die();
            $where = array('property_id' => $property_id);
            $this->_data['property_data'] = $property_data = $this->property_model->getProperty($where);
            if(!$property_data){
                $this->session->set_flashdata('errors','Property not exists please create property first.');
                redirect('properties/createProperty');
            }
            $this->_data['main_content'] = 'frontend/property/editPropertyStepFour';
            $this->__loadView();
        }
    
    function deleteProperty(){
        $this->__is_login();
    	$property_id = decode_uri($this->uri->segment(4));
    	$where = array('property_id' => $property_id);
    	$deleted = $this->property_model->delete($where);
    	if($deleted){
    		$this->session->set_flashdata('success','Property Deleted Successfully.');
    		redirect('properties/myProperties/'.$this->uri->segment(3));
    	}
    	$this->session->set_flashdata('errors','Requested property not found,please try later.');
    	redirect('properties/myProperties/'.$this->uri->segment(3));
    }

    function getProperty(){
    	$property_id = decode_uri($this->uri->segment(3));
    	//echo $property_id; die();
    	$where = array('property_id' => $property_id);
    	$property_data = $this->property_model->getProperty($where);
    	if($property_data){
    		$this->_data['property_data'] = $property_data[0];
    		echo '<pre>'; print_r($this->_data['property_data']); die();
    		$this->_data['main_content'] = 'frontend/property/propertyDetail';
        	$this->__loadView();
    	}else{
    		$this->session->set_flashdata('errors','Requested property not found.');
    		redirect();
    	}
    }

    function addFavorite(){

       $redirect = $_SERVER['HTTP_REFERER'];
       $this->__is_login();
       //echo $redirect; die();
       $property_id = decode_uri($this->uri->segment(4));
       $favoriteData = array(
          'user_id' => $this->session->userdata('user_id'),
          'property_id' => $property_id
        );
        if($this->property_model->is_favorite($favoriteData)){
            $this->session->set_flashdata('errors','Already exists in favorites.');
            redirect($redirect);
        }
       
        $favoriteData['created'] = time();
        $created = $this->property_model->save_favorite($favoriteData);
       if($created){
         $this->session->set_flashdata('success','Property has been added to favorites successfully.');
         //redirect('properties/'.$this->uri->segment(3));
         redirect($redirect);
       }else{
          $this->session->set_flashdata('errors','An error occurred.plase try later.');
          //redirect('properties/'.$this->uri->segment(3));
          redirect($redirect);
       }
    }

    function isFavorite(){

    }

    function removeFavorite(){
        $this->__is_login();
        $property_id = decode_uri($this->uri->segment(4));
        $where = array(
          'user_id' => $this->session->userdata('user_id'),
          'property_id' => $property_id
        );
        $deleted = $this->property_model->delete_favorite($where);
        if($deleted){
            $this->session->set_flashdata('success','Property has been removed successfully.');
            redirect('properties/favorite/'.$this->uri->segment(3));
        }else{
            $this->session->set_flashdata('errors','An error occurred.plase try later..');
            redirect('properties/favorite/'.$this->uri->segment(3));
        } 
    }

    function getFavorite(){
        $this->__is_login();
       $property_id = decode_uri($this->uri->segment(3));
       $start_from = $this->uri->segment(2);
        if (!is_numeric($start_from))
            $start_from = 0;
        $where = array('pf.user_id' => $this->session->userdata('user_id'));
        $total = $this->property_model->get_total_favorite($where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->_data['pagination'] = paginate(base_url() . 'properties/favorite/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->property_model->get_favorite_properties($per_page, $start_from,$where);
        //echo "<pre>"; print_r($this->_data['results']); die();
        $this->_data['main_content'] = 'frontend/property/favoriteProperties';
        $this->__loadView();
    }

    function getSearches(){
        $this->__is_login();
       $property_id = decode_uri($this->uri->segment(3));
       $start_from = $this->uri->segment(2);
        if (!is_numeric($start_from))
            $start_from = 0;
        $table = 'user_search';
        $where = array('user_id' => $this->session->userdata('user_id'));
        $total = $this->comman_model->get_total($table,$where);
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->_data['pagination'] = paginate(base_url() . 'properties/searches/', $total, $per_page, $num_links, $uri_segment);
        
        $this->_data['results'] = $this->comman_model->get_all_limited($table,$per_page, $start_from,$where);
        //echo "<pre>"; print_r($this->_data['results']); die();
        $this->_data['main_content'] = 'frontend/property/searchedProperties';
        $this->__loadView();
    }

    function removeSearch(){
        $this->__is_login();
        $search_id = decode_uri($this->uri->segment(4));
        $table = 'user_search';
        $where = array(
          'user_id' => $this->session->userdata('user_id'),
          'search_id' => $search_id
        );
        $deleted = $this->comman_model->delete($table,$where);
        if($deleted){
            $this->session->set_flashdata('success','Search has been removed successfully.');
            redirect('properties/searches/'.$this->uri->segment(3));
        }else{
            $this->session->set_flashdata('errors','An error occurred.plase try later..');
            redirect('properties/searches/'.$this->uri->segment(3));
        } 
    }

    function propertyDetail(){
        $property_id = decode_uri($this->uri->segment(3));
        $where = array('p.property_id' => $property_id,'p.status' => 1);
        $this->_data['result'] = false;
        $this->_data['reviews'] = false;
        $property_data = $this->property_model->get_property($where);
        //echo '<pre>'; print_r($property_data); die();
        if($property_data){
            $this->_data['result'] = $property_data[0];
            $this->_data['reviews'] = $this->property_model->get_reviews(array('property_id' => $property_data[0]['property_id'],'reviews !=' => ''));
        }
        if($this->uri->segment(4) == 'map' && $this->session->userdata('logged_in')){
           $this->__property_viewed($property_id);
        }
        $this->_data['main_content'] = 'frontend/property/property_detail';
        $this->__loadView();
    }
    
    function uplaod_image($file_name){
    $profile_pic = array();
    $uploaded = FALSE;
    if (isset($file_name) && trim($file_name) != "") {
        $uploade_image = upload_image($file_name, realpath(APPPATH . '../uploads/img_gallery/property_images/'));
        $this->session->set_userdata('image_name', $uploade_image['file_name']);
        if (isset($uploade_image['error'])) {
            if ($uploade_image['error'] < 0) {
                echo $uploade_image['error'];
            }
        } else {
            $thumb_sizes = array(
                array(100, 100)
                );
            $thumb_data = resize_image($uploade_image, $thumb_sizes);
            if (isset($thumb_data['error'])) {
                $this->session->set_flashdata('errors', $thumb_data['error']);
                redirect('profile');
            }
            $uploaded = TRUE;
        }
    }
    return $uploaded;
}

function purchase(){
    $this->__is_login();
         //echo 'purchase';
        //$this->__is_login();
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->session->userdata('logged_in') == TRUE) {
            $request_id = decode_uri($this->uri->segment(3));
            $request_data = $this->comman_model->get('request_property',array('request_id' => $request_id));
            $data_array = array(
              'pay_by' => $request_data[0]['sender_id'],
              'pay_to' => $request_data[0]['receiver_id'],
              'product_id' => $request_data[0]['property_id'],
              'amount' => $_POST['mc_gross'],                       
              'added_on' => date("Y-m-d H:i:s"),
              'payment_type' => 'paypal'
            );
           //print_r($data_array); die();
           $created = $this->comman_model->save('payments',$data_array);
           if($created){
                $updated = $this->comman_model->update('request_property',array('request_id' => $request_id), array('payment_id' => $created));
                $this->session->set_flashdata('success','Ammount successfully paid.');
            }else{
               $this->session->set_flashdata('errors','Transection not completed successfully, please try later.');  
            }
            redirect('properties/property_detail/'.encode_url($request_data[0]['property_id']));
        }
        
    }


function addRatings(){
    $this->__is_login();
    $response = array('success' => false,'already_voted' => false);
    $property_id = $this->input->post('id')/99;
    
    $table = 'property_rating';
    $where = array('property_id' => $property_id);
    $already_voted = $this->comman_model->get($table,array('property_id' => $property_id,'user_id' => $this->session->userdata('user_id'),'reviews !=' => ''));
    if($already_voted){
       $response['already_voted'] = true;
    }
    elseif($this->input->server('REQUEST_METHOD') === 'POST'){
       $ratingData = array(
          'user_id' => $this->session->userdata('user_id'),
          'property_id' => $property_id,
          'rating' => $this->input->post('value')
        );
       if(!$this->comman_model->get($table,array('property_id' => $property_id,'user_id' => $this->session->userdata('user_id'))) ){
            $saved = $this->comman_model->save($table,$ratingData);
       }
    }
    $total_rating = 0;
    $total_vots = $this->comman_model->get_total($table,$where);
    $ratings = $this->comman_model->get($table,$where,'rating');
    if($ratings){
            foreach ($ratings as $rating) {
                $total_rating += $rating['rating'];
            }

            $rating = round($total_rating/$total_vots,1);
            $floor_rating = floor($total_rating/$total_vots);
            if(($floor_rating + .5) == $rating){
                $total_rating = $rating;
            }
            else if(($floor_rating + .5) < $rating){
                $total_rating = $floor_rating + .5; 
            }else{
                $total_rating = $floor_rating;
            }        
    }
    
    $response['total_vots'] = $total_vots;
    $response['ratings'] = $total_rating;
    //print_r($total_rating); die();
    echo json_encode($response,true);
}

function addReview(){
    $this->__is_login();
   $response = array('success' => false,'errors' => false);
    $property_id = $this->input->post('id')/99;
    //echo $property_id; die();
    $table = 'property_rating';
    $where = array('property_id' => $property_id,'user_id' => $this->session->userdata('user_id'));
    //$already_voted = $this->comman_model->get($table,array('property_id' => $property_id,'user_id' => $this->session->userdata('user_id')));
    /*if($already_voted){
       $response['errors'] = true;
    }*/
    if($this->input->server('REQUEST_METHOD') === 'POST'){
       $this->form_validation->set_rules('value', 'review', 'trim|required|min_length[5]|max_length[50]|xss_clean');
       if ($this->form_validation->run() == FALSE) {
                $response['errors'] = validation_errors();
        }else{
            $ratingData = array(
              //'user_id' => $this->session->userdata('user_id'),
              //'property_id' => $property_id,
              'reviews' => $this->input->post('value'),
              'updated' => date('Y-m-d H:i:s')
            );
           //print_r($ratingData); die();
           $updated = $this->comman_model->update($table,$where,$ratingData);
        }
    }
    
    echo json_encode($response,true); 
}

private function __property_viewed($id){
       $property_id = $id;
       $data = array(
          'user_id' => $this->session->userdata('user_id'),
          'property_id' => $property_id
        );
        if($this->comman_model->get('views_property',$data) == 0){
            $this->comman_model->save('views_property',$data);
            $views_counter = $this->comman_model->get('properties',array('property_id'=>$property_id),'views_counter');
            $views_counter = $views_counter[0]['views_counter']+1;
            //print_r($views_counter); die();
            $this->comman_model->update('properties',array('property_id'=>$property_id),array('views_counter'=> $views_counter));
            //$this->db->query('UPDATE properties SET views_counter = 50 WHERE property_id = '.$property_id);
        }
    }

}