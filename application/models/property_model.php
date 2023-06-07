<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Property_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tableName() {
        return 'properties';
    }

    function save($data) {
        $this->db->insert($this->tableName(), $data);
        if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
        	return FALSE;
    }
    function update_property($data, $where) {
        $this->db->update($this->tableName(), $data, $where);
        if ($this->db->affected_rows() == 1)
            return true;
        else 
            return false;
    }

    function get_total($where) 
    {
        $query = $this->db->select()->from($this->tableName())->where($where)->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function get_total_properties($where) 
    {
        $query = $query = $this->db->select('p.*,pimg.image')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && cancel_on = 0 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->where('rp.request_id',NULL)
                       ->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function get_all_properties($per_page=10, $start_from=0,$where) {  
       $query = $this->db->select('p.*,pimg.image,rp.request_id,rp.request_status,rp.cancel_on')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && cancel_on = 0 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->order_by('created', 'asc')
                       ->limit($per_page, $start_from)
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function get_my_properties($per_page=10, $start_from=0,$where) {  
       $query = $this->db->select('p.*,pimg.image,rp.request_id,rp.request_status,rp.cancel_on')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->order_by('created', 'asc')
                       ->limit($per_page, $start_from)
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function get_popular($where) {  
       $query = $this->db->select('p.*,pimg.image,rp.request_id')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    /*function get_all_properties($per_page=10, $start_from=0,$where) {  
       $query = $this->db->select()->from($this->tableName())->where($where)->order_by('created', 'asc')->limit($per_page, $start_from)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }*/
    function delete($where){
    	$this->db->where($where)->delete($this->tableName());
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }

    function update($where,$data){
    	$this->db->where($where)->update($this->tableName(),$data);
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }

    function getProperty($where){
    	$query = $this->db->select()->from($this->tableName())->where($where)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function save_favorite($data){
        $this->db->insert('property_favourites', $data);
        if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
            return FALSE;
    }
    function delete_favorite($where){
        $this->db->where($where)->delete('property_favourites');
        if ($this->db->affected_rows()==1)
            return TRUE;
        return FALSE;
    }

    function get_total_favorite($where){
        $query = $this->db->select('pf.favorite_id')
                ->from('property_favourites as pf')
                ->join($this->tableName() .' as p', 'p.property_id = pf.property_id')
                ->where($where)->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }
    
    function get_favorite_properties($per_page=10, $start_from=0,$where) {  
       $query = $this->db->select('pf.favorite_id,p.*,pimg.image')
                ->from('property_favourites as pf')
                ->join($this->tableName() .' as p', 'p.property_id = pf.property_id')
                ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                ->where($where)
                ->order_by('created', 'asc')
                ->limit($per_page, $start_from)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    /*function get_property($where){
        $query = $this->db->select('p.*,u.name as first_name,u.last_name,u.profile_pic')
                ->from($this->tableName() .' as p')
                ->join('users as u', 'u.user_id = p.user_id and u.is_deleted = 0 and account_status = 1')
                ->where($where)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }*/
    
    function get_property($where){
        $sender_id = ($this->session->userdata('user_id') != '')? $this->session->userdata('user_id') : 0;
        $query = $this->db->select('p.*,u.name as first_name,u.last_name,u.profile_pic,rp.request_id,rp.request_status,rp.payment_id')
                ->from($this->tableName() .' as p')
                ->join('users as u', 'u.user_id = p.user_id and u.is_deleted = 0 and account_status = 1')
                ->join('request_property as rp', 'rp.property_id = p.property_id and rp.sender_id = '.$sender_id,'left')
                ->where($where)->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function is_favorite($where){
        $query = $this->db->select()->from('property_favourites')->where($where)->get();
       if($query->num_rows() > 0)
            return true;
       return false;
    }

    function get_reviews($where){
         $this->db->select('pr.rating_id,pr.reviews,pr.updated,u.name,u.last_name')->from('property_rating as pr');
         $this->db->join('users as u', 'u.user_id = pr.user_id');
         $this->db->where($where);
         $query = $this->db->get();
           if($query->num_rows() > 0)
                return $query->result_array();
           return false;   
    }

    /*function get_most_popular($where){
        $query = $this->db->select('v_p.property_id,count(v_p.property_id) as total_views')
                       ->from('views_property as v_p')
                       ->group_by('v_p.property_id')
                       ->group_by('v_p.property_id')
                       ->order_by('total_views','desc')
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }*/

    function get_most_popular($where){
        $query = $this->db->select('p.*,pimg.image')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && cancel_on = 0 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->where('rp.request_id',NULL)
                       ->order_by('views_counter', 'desc')
                       ->limit(3, 0)
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function get_featured($where){
        $query = $this->db->select('p.*,pimg.image')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && cancel_on = 0 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->where('rp.request_id',NULL)
                       ->order_by('created', 'asc')
                       ->limit(3, 0)
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function popular_properties($per_page=10, $start_from=0,$where) {  
       $query = $this->db->select('p.*,pimg.image,rp.request_id,rp.request_status,rp.cancel_on')
                       ->from($this->tableName() .' as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->order_by('views_counter', 'desc')
                       ->limit($per_page, $start_from)
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }
}