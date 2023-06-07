<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frange_c_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function tableName()
    {
        return 'frange';
    }

   
    function get_frange_content()
    {
        $query = $this->db->select('*')->from('frange_content')->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function get_frange_c($lang)
    {
        $query = $this->db->select('*')->from('frange_content')->where('lang',$lang)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    
}