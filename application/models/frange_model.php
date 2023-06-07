<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frange_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function tableName()
    {
        return 'frange';
    }

    function get_all_frange($per_page=10, $start_from=0,$where)
    {
        $query = $this->db->select('f.*,fd.title,fd.description,fd.lang')->from('frange f')
            ->join('frange_detail fd', 'fd.frange_id = f.id')
            ->where($where)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function get_all($where)
    {
        $query = $this->db->select('f.*,fd.title,fd.description,fd.lang')->from('frange f')
            ->join('frange_detail fd', 'fd.frange_id = f.id')
            ->where($where)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function get_frange($lang,$per_page, $start_from)
    {
         $query = $this->db->select('f.*,fd.title,fd.description,fd.lang')->from('frange f')
            ->join('frange_detail fd', 'fd.frange_id = f.id')->where('fd.lang',$lang)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function verify_frange($where)
    {
//        $this->db->select()->from($this->tableName())->where($where);
        $result = $this->db->select('f.*,fd.title,fd.description,fd.lang')->from('frange f')
             ->join('frange_detail fd', 'fd.frange_id = f.id')
            ->where($where)->get();
        if ($result->num_rows())
            return $result->result_array();
        else
            return FALSE;
    }
}