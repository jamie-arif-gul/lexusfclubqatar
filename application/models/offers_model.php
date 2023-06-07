<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Offers_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function tableName()
    {
        return 'offers';
    }

    function get_all_offers($per_page=10, $start_from=0,$where)
    {
        $query = $this->db->select('o.*,od.title,od.description,od.lang')->from('offers o')
            ->join('offers_detail od', 'od.offers_id = o.id')
            ->where($where)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function verify_offers($where)
    {

        $result = $this->db->select('o.*,od.title,od.description,od.lang')->from('offers o')
            ->join('offers_detail od', 'od.offers_id = o.id')
            ->where($where)->get();
        if ($result->num_rows())
            return $result->result_array();
        else
            return FALSE;
    }
    function get_offers($lang, $per_page=10, $start_from=0)
    {
        $query = $this->db->select('o.*,od.title,od.description,od.lang')->from('offers o')
            ->join('offers_detail od', 'od.offers_id = o.id')
            ->where('lang',$lang)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
}