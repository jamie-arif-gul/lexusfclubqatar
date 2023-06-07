<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class admin extends CI_Controller {

    private $user_id;
    private $user_type;
    private $is_logged_in;
    private $data;

    //default constructor
    function __construct() {
        parent::__construct();
        $this->check_login_again();
        $this->load->model('dashboards');
    }

    public function check_login_again() {

        if ($this->session->userdata('admin_user_role') != 1 || $this->session->userdata('admin_user_id') == '') {
          redirect('administrator');
     }  
    }

    function index() {
        $data['view_path'] = 'admin/dashboard';
        $data['page'] = 'dashboard';        
        $data['male'] = $this->dashboards->get_count(
                array(
                    'gender' => 'Male'
                ));
        $data['female'] = $this->dashboards->get_count(
                array(
                    'gender' => 'Female'
                ));

        $data['active_account'] = $this->dashboards->get_account_status(
               array(
                    'email_confirmed' => '1',
                    'account_status' => '1'
                ));        
        $data['all_user'] = $this->dashboards->get_all_user();
        $year = date('Y');
        if ($_POST){
            $this->form_validation->set_rules('year', 'Year', 'trim|required|numeric|exact_length[4]|xss_clean');
            if ($this->form_validation->run()==FALSE)
            {
                $data['errors'] = validation_errors();
            }
            else
            {
                $year = $this->input->post('year');
            }
        }
        $total_users_by_date = $this->dashboards->get_users_by_date($year);
		//echo "<pre>"; print_r($total_users_by_date); exit;
        $user_count = array(0,0,0,0,0,0,0,0,0,0,0,0,0);
        if ($total_users_by_date)
        {
            for($i=0;$i<=11;++$i)
            {
                if (isset($total_users_by_date[$i]['ymonth']))
                {
                    $user_count[$total_users_by_date[$i]['ymonth']] = $total_users_by_date[$i]['total'];  
                }
            }
        }
        $users_by_date = "";
		$i = 0;
        foreach ($user_count as $total) {
			if($i>0)
            $users_by_date .= $total.",";
			$i = 1;
        }
        $data['year'] = $year;
		
        $data['users_by_date'] = rtrim($users_by_date, ",");
		//echo $data['users_by_date']; exit;
        $this->load->view('admin_template', $data);
        //print_r($_SESSION);
    }
    
    

}
