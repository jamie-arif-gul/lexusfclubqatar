<?php 

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page');
        $this->load->helper('email_helper');		
    }

    function pages() {
        if($this->uri->segment(2, 1) != '')
        {
            $data = array();
            $page_alias = $this->uri->segment(2, 1); 
            $data['page_data'] = $this->page->get_page_against_alias($page_alias);
            if ($data['page_data'])
            {
                $data['main_content'] = 'frontend/index/index';
                $this->load->view('frontend/home_template', $data);
            }
            else
            {
                set_status_header(404);
                $this->load->view('404');
            }
        }
        else
            redirect('profile');
    }

    function pages_popup() {
        if($this->uri->segment(2, 1) != '')
        {
            $data = array();
            $page_alias = $this->uri->segment(2, 1); 
            $data['page_data'] = $this->page->get_page_against_alias($page_alias);
            if ($data['page_data'])
            {
                $this->load->view('frontend/index/index_popup',$data);
            }
            else
            {
                set_status_header(404);
                $this->load->view('404');
            }
        }
        else
            redirect('profile');
    }
    
    function contact_us() {
        $data = array();
        if ($this->input->server('REQUEST_METHOD')==='POST')
        {  
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_claen');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
            if ($this->form_validation->run()==FALSE)
            {
                $data['errors'] = validation_errors();
            }
            else 
            {   
                $this->load->model('admin_login');
                //$admin_email = $this->admin_login->get_admin_email();
                $admin_email = 'thebindel@gmail.com';
                $message = '<html>
                    <body bgcolor="#EDEDEE">
                    <p><strong> Dear Admin!</strong></p>
                     <p>Below is the message sent by a user</p>
                     <p>'.$this->input->post('message').'</p>
                     <p>Regards<p>
                     <p><strong>'.$this->input->post('name').'</strong><p>
                  </body>
                  </html>';
                if (do_email('TheBindel@gmail.com', $this->input->post('email'), 'bindel.com user feedback message', $message))
                {
                    $this->session->set_flashdata('success', 'Email sent successfully.');
                    redirect('contact_us');
                }
                else
                {
                    $data['errors'] = 'An error occurred, try later.';
                }
            }
        }
        if ($this->session->flashdata('success')!="")
            $data['success'] = $this->session->flashdata ('success');
        $data['main_content'] = 'frontend/index/contact_us';
        $this->load->view('frontend/home_template', $data);
    }

    function help_pages() {
       $data['main_content'] = 'frontend/index/'.$this->uri->segment(2);
       $this->load->view('frontend/home_template', $data);
    }

    function message_us() {
        $data = array();
        if ($this->input->server('REQUEST_METHOD')==='POST'){ 
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_claen');
            $this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email|xss_clean');
            $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
            if ($this->form_validation->run()==FALSE)
            {
                echo validation_errors();
            }
            else 
            {  
                $message = '<html>
                    <body bgcolor="#EDEDEE">
                    <p><strong> Dear Admin!</strong></p>
                     <p>Below is the message sent by a user</p>
                     <p>'.$this->input->post('message').'</p>
                     <p>Regards<p>
                     <p><strong>'.$this->input->post('name').'</strong><p>
                  </body>
                  </html>';
                if (do_email('info@thebindel.com', $this->input->post('email'), 'bindel.com user have a question about the property? ', $message) ||
                    do_email('thebindel@gmail.com', $this->input->post('email'), 'bindel.com user have a question about the property? ', $message))
                {
                    echo 'done';
                }
                else
                {
                    echo'An error occurred, try later.';
                }
            }
        }
    }
}


?>