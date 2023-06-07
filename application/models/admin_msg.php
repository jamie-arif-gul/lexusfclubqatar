<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ADMIN_MSG extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
    
    
    function all_users(){
        $this->db->select('user_id,user_name');
        $this->db->from('users');
        $query = $this->db->get();
        
        if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return FALSE;
        }
    }
    
    function save_message($save){
        $this->db->insert('admin_messages', $save);  
        if($this->db->insert_id()>0){
           return $this->db->insert_id();   
        }        
        else {
            return FALSE;
        }
    }
    
    function save_messsage_users($data_to_store){
        $this->db->insert_batch('admin_message_users', $data_to_store);        
        if($this->db->insert_id()>0){
            return TRUE;
        }  else {
            return FALSE;
        }
                
    }
    
    function show_history_message(){
        $this->db->select('admin_message_id,message_text,message_flag,is_email,sent_on');
        $query = $this->db->get('admin_messages');
        if($query->num_rows()>0){
            return $query->result_array();
        }  else {
            return FALSE;            
        }
    }
    
    function full_msg_details($id){

        $this->db->select('a_msg.*,a_msg_usr.*,users.user_name,users.email,user_profile.*');
        $this->db->from('admin_messages AS a_msg, admin_message_users AS a_msg_usr, user_profile');
        $this->db->join('users', 'a_msg_usr.user_id = users.user_id');
        $this->db->where("a_msg.admin_message_id = $id AND a_msg_usr.admin_message_id = a_msg.admin_message_id AND users.user_id = user_profile.user_id");
        $query = $this->db->get();
        if($query->num_rows()){
            return $query->result_array();
        }else{
            return FALSE;
        }
    }
    
    function email_send_users($user_id){
        $this->db->select('email');
        $this->db->from('users');
        $this->db->where_in('user_id' , $user_id);
        $query = $this->db->get();        
        if($query->num_rows()>0){
            return $query->result_array();
        }  else {
            return FALSE;
        }
    }
    
    
    
    
}
?>
