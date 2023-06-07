<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function get_search_sesults($where = array('status'=> 1)){
    	if($this->input->get('country') != ''){
    		$where['country'] = $this->input->get('country');
    	}
    	if($this->input->get('state') != ''){
    		$where['state'] = $this->input->get('state');
    	}
    	if($this->input->get('city') != ''){
    		$where['city'] = $this->input->get('city');
    	}
    	if($this->input->get('min') != ''){
    		$where['price >= '] = $this->input->get('min');
    	}
    	if($this->input->get('max') != ''){
    		$where['price <='] = $this->input->get('max');
    	}
    	$query = $this->db->select()->from('properties')->where($where)->order_by('created', 'desc')->get();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

}