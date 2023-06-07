<?php

class Show404 extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() 
    {
        set_status_header(404);
        $this->load->view('404');
    }
    
}

?>
