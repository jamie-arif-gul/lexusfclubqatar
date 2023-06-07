<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Event_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    function tableName()
    {
        return 'events';
    }

    function get_all_events($per_page=10, $start_from=0,$where)
    {
        $query = $this->db->select('e.*,ed.name,ed.description,ed.location,ed.lang')->from('events e')
            ->join('event_detail ed', 'ed.event_id = e.id', 'left')
            ->where($where)->limit($per_page, $start_from)->get();
        if($query->num_rows() > 0)
            return $query->result_array();
        return false;
    }
    function verify_event($where)
    {
//        $this->db->select()->from($this->tableName())->where($where);
        $result = $this->db->select('e.*,ed.name,ed.description,ed.location,ed.lang')->from('events e')
            ->join('event_detail ed', 'ed.event_id = e.id')
            ->where($where)->get();
        if ($result->num_rows())
            return $result->result_array();
        else
            return FALSE;
    }
}