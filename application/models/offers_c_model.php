<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Offers_c_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function tableName()
    {
        return 'offer_content';
    }

   
    function get_offers_content()
    {
        $query = $this->db->select('*')->from('offers_content')->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function get_offers_c($lang)
    {
        $query = $this->db->select('*')->from('offers_content')->where('lang',$lang)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    
}