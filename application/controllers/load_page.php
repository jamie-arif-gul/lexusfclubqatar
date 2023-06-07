<?php

class Load_Page extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }
    
    function index() 
    {
        $page = $this->uri->segment(1);
        
    }

}

?>
