<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboards extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function get_count($where){
        $this->db->where($where); 
        $query = $this->db->get('users');
        return $query->num_rows();                
    }
    
    function get_account_status($where){
        $this->db->where($where); 
        $query = $this->db->get('users');
        return $query->num_rows();                
    }
    
    function get_all_user(){
        $query = $this->db->query('Select count(*) as total From users');
        return $query->result_array();
    }
    
    function get_users_by_date($year) {
        $where = "year(registered_on) = '$year' and (month(registered_on) = '1' || month(registered_on) = '2' || month(registered_on) = '3'
             || month(registered_on) = '4' || month(registered_on) = '5' || month(registered_on) = '6'
             || month(registered_on) = '7' || month(registered_on) = '8' || month(registered_on) = '9'
             || month(registered_on) = '10' || month(registered_on) = '11' || month(registered_on) = '12')";
        $this->db->select('count(*) as total, month(registered_on) as ymonth')->from('users')->where($where)
                ->group_by('month(registered_on)')->order_by('month(registered_on)');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    
}