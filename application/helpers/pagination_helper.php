<?php

/* 
 * This function creates pagination links
 * and returns those links
 */
if (!function_exists('paginate'))
{
    function paginate($base_url, $total_rows, $per_page, $num_links, $uri_segment) 
    {
        $CI = & get_instance();
        $CI->load->library('pagination');
        $config['base_url'] = $base_url; 
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['num_links'] = $num_links;
        //$config['full_tag_open'] = '<a class="btn btn-primary">';
        //$config['full_tag_close'] = '</a>';
        $config['anchor_class'] = 'class="btn btn-primary width_auto"';
        $config['uri_segment'] = $uri_segment;
        $config['cur_tag_open'] = '&nbsp;<a class="btn btn-primary width_auto active">';
        $config['cur_tag_close'] = '</a>';
        $CI->pagination->initialize($config);
        return $CI->pagination->create_links();
    }
}

?>
