<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tableName() {
        return 'users';
    }

    function createUserAccount($data) {
        $this->db->insert($this->tableName(), $data);
        if ($this->db->insert_id() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    function verify_user($where) 
    {
        $this->db->select()->from($this->tableName())->where($where);
        $result = $this->db->get();
        if ($result->num_rows()==1)
            return $result->result_array();
        else
            return FALSE;
    }

    function updateUserProfile($data, $where) {
        $this->db->update($this->tableName(), $data, $where);
        if ($this->db->affected_rows() == 1)
            return 1;
        else if ($this->db->affected_rows() == 0)
            return 0;
        else
            return -1;
    }

    function activate_user_account($where) 
    {
        $set = array(
            'activation_hash' => '',
            'email_confirmed' => 1
            );
        $this->db->update('users', $set, $where);
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }

    //==============Admin Functions======
    function create_user($data) 
    {
        $this->db->insert('users', $data);
        if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
        return FALSE;
    }

    function get_total() 
    {
        $query = $this->db->select('user_id')->from('users')->where(array('user_role !=' => 1 , 'is_deleted' => 0))->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function get_all_users($per_page=10, $start_from=0,$where) 
    {  
       $query = $this->db->select()->from('users')->where($where)->limit($per_page, $start_from)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function update_user_account($data, $where) 
    {
        $this->db->update('users', $data, $where);
        if ($this->db->affected_rows()==1)
            return true;
        return false;
    }

}