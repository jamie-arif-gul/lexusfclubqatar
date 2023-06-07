<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('create_unique_slug')) 
{
    function create_unique_slug($string, $table, $page_id=0) 
    {
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array();
        $params['alias'] = $slug;
        if ($page_id > 0) 
        {
            $params['page_id !='] = $page_id;
        }
        $CI = & get_instance();
        
        while ($CI->db->where($params)->get($table)->num_rows()) 
        {
            if (!preg_match('/-{1}[0-9]+$/', $slug)) 
            {
                $slug .= '-' . ++$i;
            } 
            else 
            {
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);
            }
            $params ['alias'] = $slug;
        }
        return $slug;
    }

}
?>