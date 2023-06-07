<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comman_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function save($table,$data) {
        $this->db->insert($table, $data);
        if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
            return FALSE;
    }

    function get_total($table,$where) 
    {
        $query = $this->db->select()->from($table)->where($where)->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function get($table,$where = false,$fields = '*',$order=false) 
    {
        $this->db->select($fields)->from($table);
        
        if($where){
            $this->db->where($where);
        }
        
        if($order){
            foreach ($order as $key => $value) {
                $this->db->order_by($key,$value);
            }
        }
        
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();

        return 0;
    }

    function get_all_limited($table,$per_page=10, $start_from=0,$where) {  
       $query = $this->db->select()->from($table)->where($where)->order_by('created', 'desc')->limit($per_page, $start_from)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function getWhereIn($table,$user_ids){
        $query = $this->db->query("SELECT * FROM `$table` WHERE user_id IN ($user_ids)");
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }

    function update($table,$where,$data){
        $this->db->update($table, $data, $where);
        if ($this->db->affected_rows() == 1)
            return true;
        return false;
    }

    function delete($table,$where){
    	$this->db->where($where)->delete($table);
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }
    function get_single_row($table,$where){
       $query = $this->db->select()->from($table)->where($where)->get();
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results[0];
        }
        return false; 
    }

    function get_max_price(){
        $this->db->select_max('price','max_price');
        $query = $this->db->get('properties');
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results[0]['max_price'];
        }
        return false; 
    }

    function get_field_value($table,$where,$field){
        $this->db->select($field)->from($table)->where($where);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            $results = $query->result_array();
            return $results[0][$field];
        }
        return false; 
    }
}