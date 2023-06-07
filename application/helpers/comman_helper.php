<?php 


if (!function_exists('get_pages'))
{
    function get_pages()
    {
        $CI = & get_instance();
        $CI->load->model('page');
        $pages = $CI->page->getPages();
         if($pages){
             return $pages;
        }
        else {
            return FALSE;
        }
    }
}

if (!function_exists('get_single_row'))
{
    function get_single_row($table,$data)
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get_single_row($table,$data);
         if($result){
             return $result;
        }
        else {
            return FALSE;
        }
    }
}

if (!function_exists('get'))
{
    function get($table,$where = false,$fields='*',$order=false)
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get($table,$where,$fields,$order);
         if($result){
             return $result;
        }
        else {
            return FALSE;
        }
    }
}

if (!function_exists('get_rating'))
{
    function get_rating($id)
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $total_rating = 0;
        //$result = array('rating' => 0, 'votes' => 0);
        $where = array('property_id' => $id);
        $total_vots = $CI->comman_model->get_total('property_rating',$where);
        $ratings = $CI->comman_model->get('property_rating',$where,'rating');
        if($ratings){
                foreach ($ratings as $rating) {
                    $total_rating += $rating['rating'];
                }
                $rating = round($total_rating/$total_vots,1);
                $floor_rating = floor($total_rating/$total_vots);
                if(($floor_rating + .5) == $rating){
                    $total_rating = $rating;
                }
                else if(($floor_rating + .5) < $rating){
                    $total_rating = $floor_rating + .5; 
                }else{
                    $total_rating = $floor_rating;
                }        
        }
        if($total_rating > 0){
          return $total_rating;  
      }else{
        return 5;
      }
        
    }
}

if (!function_exists('get_request'))
{
    function get_request($id)
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $where = array('property_id' => $id,'sender_id' => $CI->session->userdata('user_id'));
        $request = $CI->comman_model->get('request_property',$where,'request_id,request_status,payment_id');
        if($request){
           return $request[0]; 
        }
        return false;
        
    }
}

if (!function_exists('get_max_price'))
{
    function get_max_price()
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get_max_price();
         if($result){
             return $result;
        }
        else {
            return 1000;
        }
    }
}

if (!function_exists('get_total'))
{
    function get_total($table,$where = false)
    {
        $CI = & get_instance();
        $CI->load->model('comman_model');
        $result = $CI->comman_model->get_total($table,$where);
        return $result;
    }
}

?>