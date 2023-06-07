<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Request_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tableName() {
        return 'request_property';
    }

    function get_total($where){
       $this->db->select('rp.*,p.name,p.price');
       $this->db->from($this->tableName().' as rp');
       $this->db->join('properties as p','p.property_id = rp.property_id');
       $this->db->where($where);
       $this->db->where('p.status',1);
       $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function get_send_requests($per_page=10, $start_from=0,$where) {
       $this->db->select('rp.*,p.name,p.price');
       $this->db->from($this->tableName().' as rp');
       $this->db->join('properties as p','p.property_id = rp.property_id');
       $this->db->where($where);
       $this->db->where('p.status',1);
       $this->db->order_by('created', 'asc')->limit($per_page, $start_from);
       $query = $this->db->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function get_all_requests($per_page=10, $start_from=0,$where) {  
       $this->db->select('rp.*,p.name,p.date_from,p.date_to,s.name as sender_name,r.name as receiver_name');
       $this->db->from($this->tableName().' as rp');
       $this->db->join('properties as p','p.property_id = rp.property_id');
       $this->db->join('users as s','s.user_id = rp.sender_id');
       $this->db->join('users as r','r.user_id = rp.receiver_id');
       $this->db->where($where)->order_by('created', 'asc')->limit($per_page, $start_from);
       $query = $this->db->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function get_notifications() 
    {
        $query = $this->db->select()
                      ->from($this->tableName().' as rp')
                      ->join('properties as p','p.property_id = rp.property_id')
                      ->where(array('rp.receiver_id' => $this->session->userdata('user_id'),'rp.request_status' => 0,'p.status' => 1))
                      ->get();
        if($query->num_rows() > 0)
            return $query->num_rows();

        return 0;
    }

    function received_request_detail($request_id){
      $this->db->select('rp.*,u_s.name,u_s.last_name,u_s.email,u_s.school,u_s.gender,p.date_from,p.date_to');
      $this->db->from($this->tableName().' as rp');
      $this->db->join('properties as p','p.property_id = rp.property_id');
      $this->db->join('users as u_s','u_s.user_id = rp.sender_id');
      $this->db->where('rp.request_id',$request_id);
      $this->db->where('rp.receiver_id',$this->session->userdata('user_id'));
      $query = $this->db->get();
      if($query->num_rows() > 0)
            return $query->result_array();
      return false;
    }

    function sended_request_detail($request_id){
      $this->db->select('rp.*,u_r.name,u_r.last_name,u_r.email,u_r.school,u_r.gender,p.date_from,p.date_to');
      $this->db->from($this->tableName().' as rp');
      $this->db->join('properties as p','p.property_id = rp.property_id');
      $this->db->join('users as u_r','u_r.user_id = rp.receiver_id');
      $this->db->where('rp.request_id',$request_id);
      $this->db->where('rp.sender_id',$this->session->userdata('user_id'));
      $query = $this->db->get();
      if($query->num_rows() > 0)
            return $query->result_array();
      return false;
    }

    function get_payment_data($id){
      $this->db->select('r_pyments.*,rp.payment_profile_id,rp.profile_id,rp.request_status');
      $this->db->from('request_payments as r_pyments');
      $this->db->join('request_property as rp','rp.request_id = r_pyments.request_id');
      $this->db->where('r_pyments.payment_id',$id);
      $query = $this->db->get();
      if($query->num_rows() > 0)
            return $query->result_array();
      return false;
    }
}