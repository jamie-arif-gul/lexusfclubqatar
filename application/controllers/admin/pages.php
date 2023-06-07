<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public $data = array();
    
    function __construct() {
        parent::__construct();
        $this->check_login_again();
        $this->load->model('page');
    }
    
    public function check_login_again() {
        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
            redirect('administrator', 'refresh');
        }
    }

    function index() {
        
        $this->init_ckeditor();
        $this->data['view_path'] = "admin/new_page";
        $this->data['page'] = "new_page";
        $this->data['pages'] = $this->page->get_pages();
        
        if ($this->session->flashdata('success')!="")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors')!="")
            $this->data['errors'] = $this->session->flashdata('errors');
        $this->load->view('admin_template', $this->data);
    }
    
    function init_ckeditor() 
    {
        $this->load->helper('ckeditor');
        //$images = json_encode($this->get_images());
        
        //Ckeditor's configuration
        $this->data['ckeditor'] = array(
            //ID of the textarea that will be replaced
            'id' => 'content',
            'path' => 'resources/admin/ckeditor',
            //Optionnal values
            'config' => array(
                'toolbar' => "Full", //Using the Full toolbar
                'width' => "550px", //Setting a custom width
                'resize_minWidth' => '250',
                'resize_maxWidth' => '850',
                'height' => '250px', //Setting a custom height
                'resize_enable' => 'true', //Enable resizing of the editor
                'resize_dir' => 'both',
                'extraPlugins' => 'imagepaste',
                'filebrowserUploadUrl' => base_url('administrator/ckeditor_upload')//,
                //'tabbedimages' => '',
                //'tabbedthumbimages' => ''
            ),
            //Replacing styles from the "Styles tool"
            'styles' => array(
                //Creating a new style named "style 1"
                'style 1' => array(
                    'name' => 'Blue Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Blue',
                        'font-weight' => 'bold'
                    )
                ),
                //Creating a new style named "style 2"
                'style 2' => array(
                    'name' => 'Red Title',
                    'element' => 'h2',
                    'styles' => array(
                        'color' => 'Red',
                        'font-weight' => 'bold',
                        'text-decoration' => 'underline'
                    )
                )
            )
        );
    }
        
    function add_page() 
    {
        $page_id = $this->uri->segment(3);
        if ($_POST)
        {
            $this->load->library('form_validation');
            $this->data['view_path'] = "admin/new_page";
            $this->data['page'] = "new_page";
            if ($this->form_validation->run()!==FALSE)
            {
                $status = ($this->input->post('publish_page')!="on") ? 0:1;
                $this->load->helper('slug_helper');
                $save = $this->page->save(
                        array(
                            'page_title' => $this->input->post('page_title'),
                            'content' => $this->input->post('content'),
                            'alias' => create_unique_slug($this->input->post('page_title'), 'pages'),
                            'parent' => $this->input->post('parent_page'),
                            'status' => $status,
							'user_id' => $this->session->userdata('admin_user_id'),
                            'modified_on' => 0
                        )
                        );
                if ($save)
                {
                    $this->session->set_flashdata('success', 'Page added successfully.');
                }
                else 
                {
                    $this->session->set_flashdata('errors', 'An error occurred, try later.');
                }
            }
            else
            {
                $this->session->set_flashdata('errors', validation_errors());
            }
        }
        else if (is_numeric($page_id))
        {
            $this->data['result'] = $this->page->get_page($page_id);
            $this->data['pages'] = $this->page->get_pages();
            $this->data['view_path'] = "admin/new_page";
            $this->data['page'] = "edit_page";
            $this->init_ckeditor();
            
            if ($this->session->flashdata('success')!="")
                $this->data['success'] = $this->session->flashdata('success');
            if ($this->session->flashdata('errors')!="")
                $this->data['errors'] = $this->session->flashdata('errors');
            
            $this->load->view('admin_template', $this->data);
            return;
        }
        redirect('administrator/add_page');
    }
    
    function manage_pages() 
    {
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        
        $this->load->library('pagination');
        
        $config['base_url'] = base_url().'/administrator/manage_pages/';
        $total = $this->page->get_total();
        $config['total_rows'] = $total[0]['total'];
        $config['per_page'] = 20;
        $config['num_links'] = 2;
        $config['full_tag_open'] = '<div class="row-fluid"><div class="btn-row col-sm-6"><div class="btn-toolbar col-sm-offset1"><div class="btn-group">';
        $config['full_tag_close'] = '</div></div></div></div>';
        $config['anchor_class'] = 'class="btn btn-info"';
        $config['uri_segment'] = 3;
        $config['cur_tag_open'] = '<button class="btn btn-info active">';
        $config['cur_tag_close'] = '</button>';
        $this->pagination->initialize($config);
        $this->data['pagination'] = $this->pagination->create_links();
        
        $this->data['result'] = $this->page->get_all_pages($config['per_page'], $start_from);
        $this->data['view_path'] = "admin/manage_pages";
        $this->data['page'] = "manage_pages";
        if ($this->session->flashdata('success')!="")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors')!="")
            $this->data['errors'] = $this->session->flashdata('errors');
        $this->data['lower_limit'] = $start_from;
        $this->load->view('admin_template', $this->data);
    }
    
    function update_page() 
    {
        if ($_POST)
        {
            $this->load->library('form_validation');
            if ($this->form_validation->run()!==FALSE)
            {
                $status = ($this->input->post('publish_page')!="on") ? 0:1;
                $this->load->helper('slug_helper');
                $update = $this->page->update($this->input->post('id'), 
                        array(
                            'page_title' => $this->input->post('page_title'),
                            'content' => $this->input->post('content'),
                            'alias' => create_unique_slug($this->input->post('page_title'), 'pages', $this->input->post('id')),
                            'parent' => $this->input->post('parent_page'),
                            'status' => $status,
                            'modified_on' => date('Y-m-d h:m:s', time())
                        )
                        );
                if ($update)
                {
                    $this->session->set_flashdata('success', 'Page updated successfully.');
                    //$this->data['result'] = $this->page->get_page($this->input->post('id'));
                }
                else 
                {
                    $this->session->set_flashdata('errors', 'An error occurred, try later.');
                }
            }
            else
            {
                $this->session->set_flashdata('errors', validation_errors());
                //$this->data['errors'] = validation_errors();
            }
            
            // uesed redirect because if we load view, the URI does not change
            // we have to make sure that the URI is same as before (on edit)
            redirect('administrator/edit_page/'.$this->input->post('id'));
        }
        redirect("administrator/manage_pages/10/");
    }
    
    function update_status() 
    {
        // URI structure
        // 3rd segment is for lower limit for pagination
        // 4th and 6th segments are page id and page status
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4)) && is_numeric($this->uri->segment(5)))
        {
            $status = $this->uri->segment(5);
            
            $update = $this->page->update($this->uri->segment(4), 
                    array(
                        'status' => $status,
                        'modified_on' => time()
                    )
                    );
            if ($update)
            {
                $msg = ($status==1) ? "published":"unpublished";
                $this->session->set_flashdata('success', "Page $msg successfully.");
            }
            else 
            {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_pages/'.$this->uri->segment(3));
        }
        redirect('administrator/manage_pages/10/');
    }
    
    function delete_page() 
    {
        // URI structure
        // 3rd segment is lower limit for pagination
        // 4th segment is page id 
        if (is_numeric($this->uri->segment(3)) && is_numeric($this->uri->segment(4)))
        {
            
            $delete = $this->page->update($this->uri->segment(4), array(
                'is_deleted' => 1
            ));
            if ($delete)
            {
                $this->session->set_flashdata('success', "Page deleted successfully.");
            }
            else 
            {
                $this->session->set_flashdata('errors', 'An error occurred, try later.');
            }
            redirect('administrator/manage_pages/'.$this->uri->segment(3));
        }
        redirect('administrator/manage_pages/10/');
    }
    
    function do_ckeditor_file_upload() 
    {
        // Upload script for CKEditor.
        // Use at your own risk, no warranty provided. Be careful about who is able to access this file
        // The upload folder shouldn't be able to upload any kind of script, just in case.
        // If you're not sure, hire a professional that takes care of adjusting the server configuration as well as this script for you.
        // (I am not such professional)

        // Step 1: change the true for whatever condition you use in your environment to verify that the user
        // is logged in and is allowed to use the script
//        if ( true ) {
//                echo("You're not allowed to upload files");
//                die(0);
//        }

        // Step 2: Put here the full absolute path of the folder where you want to save the files:
        // You must set the proper permissions on that folder (I think that it's 644, but don't trust me on this one)
        // ALWAYS put the final slash (/)
        $basePath = FCPATH.DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'ckeditor/';

        // Step 3: Put here the Url that should be used for the upload folder (it the URL to access the folder that you have set in $basePath
        // you can use a relative url "/images/", or a path including the host "http://example.com/images/"
        // ALWAYS put the final slash (/)
        $baseUrl = base_url('uploads/ckeditor').'/';

        // Done. Now test it!



        // No need to modify anything below this line
        //----------------------------------------------------

        // ------------------------
        // Input parameters: optional means that you can ignore it, and required means that you
        // must use it to provide the data back to CKEditor.
        // ------------------------

        // Optional: instance name (might be used to adjust the server folders for example)
        $CKEditor = $_GET['CKEditor'] ;

        // Required: Function number as indicated by CKEditor.
        $funcNum = $_GET['CKEditorFuncNum'] ;

        // Optional: To provide localized messages
        $langCode = $_GET['langCode'] ;

        // ------------------------
        // Data processing
        // ------------------------

        // The returned url of the uploaded file
        $url = '' ;

        // Optional message to show to the user (file renamed, invalid file, not authenticated...)
        $message = '';

        // in CKEditor the file is sent as 'upload'
        if (isset($_FILES['upload'])) {
            // Be careful about all the data that it's sent!!!
            // Check that the user is authenticated, that the file isn't too big,
            // that it matches the kind of allowed resources...
            $name = $_FILES['upload']['name'];

                // It doesn't care if the file already exists, it's simply overwritten.
                move_uploaded_file($_FILES["upload"]["tmp_name"], $basePath . $name);

            // Build the url that should be used for this file   
            $url = $baseUrl . $name ;

            // Usually you don't need any message when everything is OK.
        //    $message = 'new file uploaded';   
        }
        else
        {
            $message = 'No file has been sent';
        }
        // ------------------------
        // Write output
        // ------------------------
        // We are in an iframe, so we must talk to the object in window.parent
        echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
    }
    
    
}

?>
