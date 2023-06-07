<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages_controller extends CI_Controller {
  
  	private $_data;
  
  	public function __construct() {
        parent::__construct();
        login_persists();
        if (!$this->session->userdata('logged_in'))
            redirect('login');
        $this->load->model('messages_model');
        $this->load->model('comman_model');
    }

    private function __loadView() {
        if ($this->session->flashdata('success')!="")
            $this->_data['success'] = $this->session->flashdata ('success');
        if ($this->session->flashdata('errors')!="")
            $this->_data['errors'] = $this->session->flashdata ('errors');
        $this->load->view('frontend/home_template', $this->_data);
    }

    function index(){

        $this->_data['main_content'] = 'frontend/messages/index';
        $this->__loadView();       
    }

    function create(){
       
        if( $this->input->server('REQUEST_METHOD') == 'POST'){
          $sender_id = $this->session->userdata('user_id');
          $receiver_id = decode_uri($this->input->post('receiver_id'));
          $message = $this->input->post('message');

          $thread_id = $this->messages_model->get_thread_id($sender_id,$receiver_id,$message);
          if($thread_id){
            $message_data = array(
                'thread_id' => $thread_id,
                'sender_id' => $this->session->userdata('user_id'),
                'receiver_id' => $receiver_id,
                'message'    => $this->input->post('message'),
                'updated_on'    => date('Y-m-d H:i:s')
              );
            $saved = $this->comman_model->save('messages',$message_data);
            
            if($saved){
                $this->session->set_flashdata('success','Message sent successfully.');
                redirect('messages/create');  
            }else{
                $this->session->set_flashdata('errors','Error accur,Please try later.');
                redirect('messages/create');  
            }

          }else{
            $this->session->set_flashdata('errors','Error accur,Please try later.');
            redirect('messages/create'); 
          }
        }
        $this->_data['main_content'] = 'frontend/messages/create_message';
        $this->__loadView();  
    }
    
    function conversation(){
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $total = $this->messages_model->total_threads();
        $per_page = 10;
        $num_links = 4;
        $uri_segment = 3;
        $this->_data['pagination'] = paginate(base_url() . 'messages/conversation/', $total, $per_page, $num_links, $uri_segment);
        $this->_data['results'] = $this->messages_model->get_threads($per_page, $start_from);
       //echo '<pre>'; print_r($this->_data['results']); die;
        $this->_data['main_content'] = 'frontend/messages/conversation';
        $this->__loadView(); 
    }

    function conversation_detail(){
        $thread_id = decode_uri($this->uri->segment(3));
        
        $this->_data['results'] = $this->messages_model->get_messages($thread_id);
        $this->comman_model->update('messages',array('thread_id' => $thread_id,'sender_id !=' => $this->session->userdata('user_id')),array('is_readed' => 1));

        $this->_data['main_content'] = 'frontend/messages/conversation_detail';
        $this->__loadView(); 
    }


    function message_alert(){
       $unread_messages = $this->messages_model->get_new_messages();
       echo  $unread_messages;
    }

    function create_message_ajax(){
        $response = array('success' => false,'errors' => false);
       if($this->input->server('REQUEST_METHOD') === 'POST'){
            $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
           if ($this->form_validation->run() == FALSE) {
                    $response['errors'] = validation_errors();
            }else{

                  $sender_id = $this->session->userdata('user_id');
                  $receiver_id = decode_uri($this->input->post('receiver_id'));
                  $property_id = decode_uri($this->input->post('property_id'));
                  $message = $this->input->post('message');
//echo $property_id; die();
                  $thread_id = $this->messages_model->get_thread_id($sender_id,$receiver_id,$property_id,$message);
                  if($thread_id){
                    $message_data = array(
                        'thread_id' => $thread_id,
                        'sender_id' => $this->session->userdata('user_id'),
                        'receiver_id' => $receiver_id,
                        'property_id' => $property_id,
                        'message'    => $this->input->post('message'),
                        'updated_on'    => date('Y-m-d H:i:s')
                      );
                    $saved = $this->comman_model->save('messages',$message_data);
                    
                    if($saved){
                        $response['success_message'] = 'Message sent successfully.';
                        $response['date'] = date('m-d-Y h:i A');
                        $this->session->set_flashdata('success','Message sent successfully.'); 
                    }else{
                        $response['errors'] = 'Error accur,Please try later.'; 
                    }

                  }else{
                    $response['errors'] = 'Error accur,Please try later.'; 
                  }

            }
        }   
        
        echo json_encode($response,true); 
    }

}