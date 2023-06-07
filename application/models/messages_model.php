<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messages_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tableName() {
        return 'messages';
    }

    function get_thread_id($sender_id,$receiver_id,$property_id,$message){
    	
    	$query = $this->db->select('thread_id')->from('threads')->where('sender_id =' .$sender_id.' && receiver_id = '. $receiver_id.' && property_id ='.$property_id.' || sender_id = '. $receiver_id.' && receiver_id =' .$sender_id.' && property_id ='.$property_id)->get();
    	if($query->num_rows() > 0){
    		$thread_id = $query->result_array();

    		$this->db->update('threads', array('subject'=> substr($message, 0,25).'...','updated_on'=> date('Y-m-d H:i:s')), array('thread_id' => $thread_id[0]['thread_id']));
	        if ($this->db->affected_rows() == 1)
	            return $thread_id[0]['thread_id'];
	        return false;
    	}else{
    		$this->db->insert('threads', array('sender_id'=>$sender_id,'receiver_id'=>$receiver_id,'property_id'=>$property_id,'subject'=> substr($message, 0,25).'...','updated_on'=> date('Y-m-d H:i:s')));
            if ($this->db->insert_id() > 0)
            return $this->db->insert_id();
           return FALSE;
    	}
    }

    function get_threads($per_page=10, $start_from=0){
    	$this->db->select('th.*,u_s.name as sender_first_name,u_s.last_name as sender_last_name, u_r.name as receiver_first_name, u_r.last_name as receiver_last_name,p.name as property_name');
       	$this->db->from('threads as th');
       	$this->db->join('users as u_s','u_s.user_id = th.sender_id');
        $this->db->join('users as u_r','u_r.user_id = th.receiver_id');
        $this->db->join('properties as p','p.property_id = th.property_id');
       	$this->db->where('sender_id',$this->session->userdata('user_id'));
       	$this->db->or_where('receiver_id',$this->session->userdata('user_id'));
       	$this->db->order_by('updated_on', 'desc')->limit($per_page, $start_from);
       	$query = $this->db->get();
       	if($query->num_rows() > 0)
            return $query->result_array();
       	return false;
    }

    function total_threads(){
    	$this->db->select('thread_id');
       	$this->db->from('threads');
       	$this->db->where('sender_id',$this->session->userdata('user_id'));
       	$this->db->or_where('receiver_id',$this->session->userdata('user_id'));
       	$query = $this->db->get();
       	if($query->num_rows() > 0)
            return $query->num_rows();
       	return false;
    }

    function get_unread_messages($id){
    	$this->db->select('message_id');
       	$this->db->from('messages');
       	$this->db->where('sender_id !=',$this->session->userdata('user_id'));
       	$this->db->where('thread_id',$id);
       	$this->db->where('is_readed',0);
       	$query = $this->db->get();
       	if($query->num_rows() > 0)
            return $query->num_rows();
       	return false;
    }

    function total_messages($id){
    	$this->db->select('message_id');
       	$this->db->from('messages');
       	$this->db->where('thread_id',$id);
       	$query = $this->db->get();
       	if($query->num_rows() > 0)
            return $query->num_rows();
       	return false;
    }

    function get_messages($thread_id){
    	$this->db->select('msg.*, u.gender,u.name');
       	$this->db->from('messages as msg');
       	$this->db->join('users as u','u.user_id = msg.sender_id');
       	$this->db->where('msg.thread_id',$thread_id);
       	$this->db->order_by('updated_on', 'asc');
       	$query = $this->db->get();
       	if($query->num_rows() > 0)
            return $query->result_array();
       	return false;
    }

    function get_new_messages(){
    	//return 1;
    	$this->db->select('message_id');
       	$this->db->from('messages');
       	//$this->db->where('sender_id',$this->session->userdata('user_id'));
       	$this->db->where('receiver_id',$this->session->userdata('user_id'));
       	$this->db->where('is_readed',0);
       	$query = $this->db->get();
       	if($query->num_rows() > 0)
            return $query->num_rows();
       	return false;
    }

    //=========admin functions====

    function get_threads_admin($per_page=10, $start_from=0){
      $this->db->select('th.*,u_s.name as sender_first_name,u_s.last_name as sender_last_name, u_r.name as receiver_first_name, u_r.last_name as receiver_last_name');
        $this->db->from('threads as th');
        $this->db->join('users as u_s','u_s.user_id = th.sender_id');
        $this->db->join('users as u_r','u_r.user_id = th.receiver_id');
        //$this->db->where('sender_id',$this->session->userdata('user_id'));
        //$this->db->or_where('receiver_id',$this->session->userdata('user_id'));
        $this->db->order_by('updated_on', 'desc')->limit($per_page, $start_from);
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }

    function get_messages_admin($thread_id){
      $this->db->select('msg.*, u_s.name as sender_first_name,u_s.last_name as sender_last_name, u_r.name as receiver_first_name, u_r.last_name as receiver_last_name');
        $this->db->from('messages as msg');
        $this->db->join('users as u_s','u_s.user_id = msg.sender_id');
        $this->db->join('users as u_r','u_r.user_id = msg.receiver_id');
        $this->db->where('msg.thread_id',$thread_id);
        $this->db->order_by('updated_on', 'desc');
        $query = $this->db->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }


}