<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Gallery_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function tableName() {
        return 'gallery';
    }

    function get_all_gallery($where_in) {
        $query = $this->db->select('g.*,gd.title,gd.description,gd.lang')->from('gallery g')
                        ->join('gallery_detail gd', 'gd.gallery_id = g.id')
                        ->where_in('gd.gallery_id',$where_in)->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }

    function limit_query($per_page = 10, $start_from = 0) {
        $query = $this->db->select('id')->from('gallery')->limit($per_page, $start_from)->get();
        if ($query->num_rows() > 0) {
            $result = [];
            foreach ($query->result_array() as $value) {
                $result[] = $value['id'];
            }
            return $result;
        }
        return false;
    }

    function verify_gallery($where) {
//        $this->db->select()->from($this->tableName())->where($where);
        $result = $this->db->select('g.*,gd.title,gd.description,gd.lang')->from('gallery g')
                        ->join('gallery_detail gd', 'gd.gallery_id = g.id')
                        ->where($where)->get();
        if ($result->num_rows())
            return $result->result_array();
        else
            return FALSE;
    }

    // Yasir work
    function get_gallery($lang, $per_page, $start_from) {
        $query = $this->db->select('g.*,gd.title,gd.description,gd.lang')->from('gallery g')
                        ->join('gallery_detail gd', 'gd.gallery_id = g.id')->where('gd.lang', $lang)->limit($per_page, $start_from)->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }

}
