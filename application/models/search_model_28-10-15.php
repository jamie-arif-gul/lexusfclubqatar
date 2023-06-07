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
        if($this->input->get('address') != ''){
            $address = $this->input->get('address');
            //echo $address; die();
            $address = str_replace($this->input->get('country'), '', $address);
            $address = str_replace($this->input->get('city'), '', $address);
            $address = str_replace($this->input->get('state'), '', $address);
            $address = rtrim($address, ", \t\n");
            //echo $address; die();
            if($address != ''){
               $where['address'] = $address;
            }
            
        }
        if($this->input->get('check-in') != ''){
            //echo strtotime($this->input->get('check-in')); die();
            $where['date_from >='] = strtotime($this->input->get('check-in'));
        }
        if($this->input->get('check-out') != ''){
            //echo strtotime($this->input->get('check-out')); die();
            $where['date_to <='] = strtotime($this->input->get('check-out'));
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