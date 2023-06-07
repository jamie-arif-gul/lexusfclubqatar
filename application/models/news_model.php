<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class News_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function tableName()
    {
        return 'news';
    }

    function get_all_news($per_page=10, $start_from=0,$where)
    {
        $query = $this->db->select('n.*,nd.title,nd.description,nd.lang')->from('news n')
            ->join('news_detail nd', 'nd.news_id = n.id')
            ->where($where)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function verify_news($where)
    {
//        $this->db->select()->from($this->tableName())->where($where);
        $result = $this->db->select('n.*,nd.title,nd.description,nd.lang')->from('news n')
            ->join('news_detail nd', 'nd.news_id = n.id')
            ->where($where)->get();
        if ($result->num_rows())
            return $result->result_array();
        else
            return FALSE;
    }
    // Yasir work
    function get_news($lang,$per_page, $start_from)
    {
        $query = $this->db->select('n.*,nd.title,nd.description,nd.lang')->from('news n')
            ->join('news_detail nd', 'nd.news_id = n.id')->where('nd.lang',$lang)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
}