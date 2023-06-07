<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    function save($data) 
    {
        $this->db->insert('pages', $data);
        if ($this->db->insert_id()>0)
            return TRUE;
        return FALSE;
    }
    
    function get_all_pages($per_page=10, $start_from=0) 
    {
        $this->db->select()->from('pages')->where(array('is_deleted' => 0))->limit($per_page, $start_from);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_total() 
    {
        $total = $this->db->query('select count(*) as total from pages where is_deleted = 0');
        return $total->result_array();
    }
    
    function get_page($id) 
    {
        $this->db->select()->from('pages')->where(array('page_id' => $id, 'is_deleted' => 0));
        $query = $this->db->get();
        //return $query->result_array();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    
    function update($id, $data) 
    {
        $this->db->where('page_id', $id);
        $this->db->update('pages', $data);
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }
    
    function delete($id) 
    {
        $this->db->where('page_id', $id);
        $this->db->delete('pages');
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }
    
    function get_pages() 
    {
        $this->db->select()->from('pages')->where(array('status' => 1, 'is_deleted' => 0));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    
    /*
     * FUNCTIONS RELATED TO FRONTEND MENU FORMATION
     */
    
    function get_child_pages() {
        $this->db->select()->from('pages')->where(array('parent >' => 0, 'is_deleted' => 0));
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
    
    /*
     * END HERE
     */

    function get_page_against_alias($page_alias) 
    {
        $this->db->select()->from('pages')->where(array('alias' => $page_alias, 'is_deleted' => 0, 'status' => 1));
        $query = $this->db->get();
        //return $query->result_array();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return FALSE;
    }
}

?>
