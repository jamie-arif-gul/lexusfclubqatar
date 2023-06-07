<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings_management extends CI_Controller {

    public $data = array();
    
    function __construct() {
        parent::__construct();
        $this->check_login_again();
        $this->load->model('comman_model');
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
    
    function manage_settings() 
    {
        //$data = get('settings',array('st_alias' => 'site_title'));
        //print_r($data); die();
        $start_from = $this->uri->segment(3);
        if (!is_numeric($start_from))
            $start_from = 0;
        $table = 'settings';
        $where = array('st_parent' => 0);
        $total = $this->comman_model->get_total($table,$where);
        
        $per_page = 5;
        $num_links = 4;
        $uri_segment = 3;
        $this->data['pagination'] = paginate(base_url() . 'administrator/manage_settings/', $total, $per_page, $num_links, $uri_segment);
        $where = array('st_parent' => 0);
        $this->data['results'] = $this->comman_model->get_all_limited($table,$per_page,$start_from,$where);
        
        $this->data['view_path'] = "admin/settings/manage_settings";
        $this->data['page'] = "manage_settings";
        
        if ($this->session->flashdata('success') != "")
            $this->data['success'] = $this->session->flashdata('success');
        if ($this->session->flashdata('errors') != "")
            $this->data['errors'] = $this->session->flashdata('errors');
        
        $this->load->view('admin_template', $this->data);
    }
    
    function edit_setting() 
    {
        $st_id = decode_uri($this->uri->segment(4));
        $this->init_ckeditor();
        $table = 'settings';
        $where = array('st_id' => $st_id);
        $this->data['results'] = $this->comman_model->get($table,$where);
        if($this->data['results']){
            $this->data['view_path'] = "admin/settings/edit_setting";
            $this->data['page'] = "edit_setting";
                
            if ($this->input->server('REQUEST_METHOD') === 'POST'){
                $this->form_validation->set_rules('st_content', 'Content', 'trim|required|min_length[10]|xss_clean');
                if ($this->form_validation->run() == FALSE) {
                        $this->data['errors'] = validation_errors();
                    }
                else{
                    $data = array('st_content' => $this->input->post('st_content'));
                    $updated = $this->comman_model->update($table,$where,$data);
                    if($updated){
                        $this->session->set_flashdata('success','Successfully Updated.');
                        redirect("administrator/manage_settings/".$this->uri->segment(3)); 
                    }else{
                        $this->session->set_flashdata('errors','Not Updated.');
                        redirect("administrator/manage_settings/".$this->uri->segment(3));  
                    }
                }
            }
            $this->load->view('admin_template', $this->data);

      }else{
        $this->session->set_flashdata('errors','not found try again.');
        redirect("administrator/manage_settings/".$this->uri->segment(3));
      }
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
