<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class admin_login extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function admin_logins() {
        $query = $this->db->get('admin_login');
        return $query->result_array();
    }

    function login() {
        $result = md5($this->input->post("password"));        
        $this->db->select();
        $this->db->from('users');
        $array = array('email' => $this->input->post("email_login"), 'password' => $result , 'user_role' => 1 );
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result_array();
    }

    function changePassword($data,$user_id) {
        $this->db->where('user_id',$user_id );
        $this->db->update('users', $data);
        if($this->db->affected_rows()>0){
            return TRUE;            
        }
        else        
            return FALSE;
    }
    
    
    function forgotPassword(){
        $this->db->select('user_id, email');
        $this->db->where('email', $this->input->post('forgot_password')); 
        $query  = $this->db->get('users');
        //print_r($query);
        return $query->result_array();
        
    }
    function reset_password($hash){
        $this->db->select();
        $this->db->where('password_reset_hash',$hash );
        $query = $this->db->get('users');
        if ($query->num_rows()>0)
            return $query->result_array();
        else
            return FALSE;
    }
    function change_password($data,$id){
        $this->db->where('user_id',$id);
        $this->db->update('users', $data);  
        if($this->db->affected_rows()>0){
            return TRUE;
        }  else {
            return FALSE;            
        }
    }
    function activate_hash($where,$set){
        $this->db->update('users',$set,$where);
    }

    function admin_save_profile($data){
    $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->update('users', $data); 
        if($this->db->affected_rows()>0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    
    function show_profile(){
        $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->select('user_name,image_profile');
        $query = $this->db->get('users');
        if ($query->num_rows()>0)
            return $query->result_array();
        else
            return FALSE;
    }
    
    function admin_email($data){
        $this->db->where('user_id', $this->session->userdata('admin_user_id'));
        $this->db->update('users', $data);
        if($this->db->affected_rows()>0){
            return TRUE;
        }  else {
            return FALSE;
        }
    }
     function get_admin_email(){
        $this->db->select('email');
        $this->db->where('user_role', 1); 
        $query  = $this->db->get('users');
        //print_r($query);
        return $query->result_array();
     }

}
