<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /*function get_search_sesults($where = array('status'=> 1)){
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
SELECT id FROM table_name WHERE field_name REGEXP '"key_name":"([^"])key_word([^"])"';
or
SELECT id FROM table_name WHERE field_name RLIKE '"key_name":"[[:<:]]key_word[[:>:]]"';

    */

    function get_search_sesults(){
        $address = $this->input->get('address');
        //echo $address;
        $this->session->set_userdata('state',false);
        $this->session->set_userdata('country',false);
        $city = false;
        $this->session->set_userdata('city',false);
        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . urlencode($this->input->get('address')) . '&sensor=false');
        $output = json_decode($geocode,true);
        //echo $output['status']; //'ZERO_RESULTS OR OK';
        //echo '<pre>'; print_r($output); echo '</pre>';
        //die();
        $address_components = $output['results'][0]['address_components'];
        foreach ($address_components as $key => $value) {
            if($value['types'][0] == 'country' ){
                $where['p.country'] = $value['long_name'];
                $this->session->set_userdata('country',$where['p.country']);
            }
            if($value['types'][0] == 'administrative_area_level_1' ){
                $where['p.state'] = $value['long_name'];
                $this->session->set_userdata('state',$where['p.state']);
            }
            if($value['types'][0] == 'locality'){
                $city[] = $value['long_name'];
                $city[] = $value['short_name'];
                //$where['p.city'] = $value['long_name'];
                $this->session->set_userdata('city',$value['long_name']);
            }
        }
        
        /*foreach ($where as $value) {

            $address = str_replace(strtolower($value), '', strtolower($address));
        }*/
        /*$where['p.status'] = 1;
        $where['p.date_to > '] = time();
        $address = trim($address, ', ');
        if(strlen($address) > 0){
            //$where['p.address']= $address;
        }*/
        //echo '<pre>'; print_r($where); echo '</pre>'; die();
        if($this->input->get('check-in') != ''){
            $where['p.date_to >'] = strtotime($this->input->get('check-in'));
        }
        if($this->input->get('check-in') == '' && $this->input->get('check-out') != ''){
            $where['p.date_to <='] = strtotime($this->input->get('check-out')) + (30*24*60*60);
        }
        
        if($this->input->get('min') != ''){
            $where['p.price >= '] = $this->input->get('min');
        }
        if($this->input->get('max') != ''){
            $where['p.price <='] = $this->input->get('max');
        }
//======================================
        if($this->input->get('pets_allowed') != ''){
            $where['p.pets_allowed'] = $this->input->get('pets_allowed');
        }

        if($this->input->get('parking') != ''){
            $where['p.parking'] = $this->input->get('parking');
        }

        if($this->input->get('area') != ''){
            $where['p.area'] = $this->input->get('area');
        }

        if($this->input->get('bathrooms') != ''){
            $where['p.bathrooms'] = $this->input->get('bathrooms');
        }

        if($this->input->get('bedrooms') != ''){
            $where['p.bedrooms'] = $this->input->get('bedrooms');
        }
        //echo '<pre>'; print_r($where); echo '</pre>'; die();
        if($city){
            $this->db->select()
            ->from('properties');
              foreach($city as $key => $value){
                    if($key == 0) {
                        $this->db->where('city', $value);
                    } else {
                        $this->db->or_where('city', $value);
                    }
                }
                $this->db->group_by('property_id');
                $sub_query =  $this->db->get();
                
                $sub_query = '('.$this->db->last_query().')';
        }else{
            $sub_query = 'properties';
        }
//=====================================     
        $this->db->select('p.*,pimg.image')
            ->from($sub_query.' as p')
            ->join('users as u', 'u.user_id = p.user_id and u.is_deleted = 0 and account_status = 1')
            ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
            ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && rp.check_out_date > '.time(),'left')
            ->where($where)
            ->where('rp.request_id',NULL);
//===================================== 
        
       if($this->input->get('amenities') != ''){
           $ameniti = $this->input->get('amenities');
            
            for ($i=0; $i < count($ameniti) ; $i++) { 
                $this->db->like('amenities', $ameniti[$i]);
            }
        }
//=====================================
        $this->db->group_by('p.property_id');
        $this->db->order_by('p.date_from', 'asc');
        $query =  $this->db->get();
       //echo $this->db->last_query(); die();
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

    function get_search_sesults_total($where = array('p.status'=> 1)){
        $where['p.date_to > '] = time();
        $this->session->set_userdata('state',false);
        $this->session->set_userdata('country',false);
        $address = str_replace('Washington, D.C.', 'Washington, ', $this->input->get('address'));
        $address = explode(',', str_replace(', ', ',', $address));
        $city = false;
        if($this->input->get('city') != ''){
            $city[] = $this->input->get('city');
        }
        $size = count($address);
        for ($i=0; $i < $size; $i++) {
            if($i == 0){
                $country = end($address);
                if($this->comman_model->get('countries',array('country_name'=>$country))){
                    $where['p.country'] = end($address);
                    $this->session->set_userdata('country',$where['p.country']);
                    unset($address[end(array_keys($address))]);
                }else{
                  $size++;  
                }
            }
            
            if($i == 1){
                $where['p.state'] = end($address);
                if(strlen($where['p.state']) == 2){
                    $state = $this->comman_model->get_single_row('states',array('state_code' => $where['p.state']));
                    $where['p.state'] = $state['state'];
                }
                $this->session->set_userdata('state',$where['p.state']);
                unset($address[end(array_keys($address))]);
            }
            
           /* if($i == 2){
                $where['p.city'] = end($address);
                unset($address[end(array_keys($address))]);
            }*/
             if($i == 2){
                /*if($this->input->get('city') != ''){
                    $where['p.city'] = $this->input->get('city');
                }else{
                   $where['p.city'] = end($address); 
                }*/

                   $city[] = end($address);
                //$city = explode(' ', $city_str);
                unset($address[end(array_keys($address))]);
            }
            if($i == 3){
                $where['p.address'] = implode(', ', $address);
                break;
            }
        }
        
        //echo $where['p.city']; die();
        //===sub query start===
        if($city){
            $this->db->select()
            ->from('properties');
              foreach($city as $key => $value){
                    if($key == 0) {
                        $this->db->where('city', $value);
                    } else {
                        $this->db->or_where('city', $value);
                    }
                }
                $sub_query =  $this->db->get();
                $this->db->group_by('p.property_id');
                $sub_query = '('.$this->db->last_query().')';
        }else{
            $sub_query = 'properties';
        }
            //echo $this->db->last_query(); die();
        //print_r($city); die();
        //===sub query end===    
        
        if($this->input->get('check-in') != ''){
            $where['p.date_to >'] = strtotime($this->input->get('check-in'));
        }
        if($this->input->get('check-in') == '' && $this->input->get('check-out') != ''){
            $where['p.date_to <='] = strtotime($this->input->get('check-out')) + (30*24*60*60);
        }
        
        if($this->input->get('min') != ''){
            $where['p.price >= '] = $this->input->get('min');
        }
        if($this->input->get('max') != ''){
            $where['p.price <='] = $this->input->get('max');
        }
        /*if($this->input->get('city') != ''){
            $google_city = $this->input->get('city');
        }*/
//======================================
        if($this->input->get('pets_allowed') != ''){
            $where['p.pets_allowed'] = $this->input->get('pets_allowed');
        }

        if($this->input->get('parking') != ''){
            $where['p.parking'] = $this->input->get('parking');
        }

        if($this->input->get('area') != ''){
            $where['p.area'] = $this->input->get('area');
        }

        if($this->input->get('bathrooms') != ''){
            $where['p.bathrooms'] = $this->input->get('bathrooms');
        }

        if($this->input->get('bedrooms') != ''){
            $where['p.bedrooms'] = $this->input->get('bedrooms');
        }
//=====================================     
        $this->db->select('p.*,pimg.image')
            ->from($sub_query.' as p')
            ->join('users as u', 'u.user_id = p.user_id and u.is_deleted = 0 and account_status = 1')
            ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
            ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && rp.check_out_date > '.time(),'left')
            ->where($where)
            ->where('rp.request_id',NULL);
            //->where_in('p.city', array($address_city, $google_city));
            /*if($city){
              foreach($city as $key => $value){
                    if($key == 0) {
                        $this->db->like('p.city', $value);
                    } else {
                        $this->db->or_like('p.city', $value);
                    }
                }  
            }*/
            
//===================================== 
        
       if($this->input->get('amenities') != ''){
           $ameniti = $this->input->get('amenities');
            
            for ($i=0; $i < count($ameniti) ; $i++) { 
                $this->db->like('amenities', $ameniti[$i]);
            }
        }
//=====================================
        $this->db->group_by('p.property_id');
        $this->db->order_by('p.date_from', 'asc');
                /*if($this->input->get('check-in') != ''){
                    $this->db->order_by('p.date_from', 'asc');
                }else{
                   $this->db->order_by('p.created', 'desc'); 
                }*/ 
                
        $query =  $this->db->get();
       //echo $this->db->last_query(); die();
       if($query->num_rows() > 0)
            return $query->num_rows();
       return 0;
    }

    function get_all_properties($where) {  
       $query = $this->db->select('p.*,pimg.image,rp.request_id,rp.request_status,rp.cancel_on')
                       ->from('properties as p')
                       ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
                       ->join('request_property as rp','rp.property_id = p.property_id && request_status = 1 && cancel_on = 0 && rp.check_out_date > '.time(),'left')
                       ->where($where)
                       ->order_by('created', 'asc')
                       ->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }

}