<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('upload_video'))
{
    function upload_video($input_name, $path = "default_bio_video_path")
    {
        if ($path=="default_bio_video_path")
            $config['upload_path'] = FCPATH.'/uploads/videos/';
        else 
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'flv|mp4|3gp';
        $config['max_size'] = '25600';
        $config['max_filename'] = '255';
        $config['remove_spaces'] = TRUE;
        $config['overwrite'] = FALSE;
        $CI = & get_instance();
        $CI->load->library('upload');
        $CI->upload->initialize($config);
        if (!$CI->upload->do_upload($input_name))
        {
            return array('error' => $CI->upload->display_errors());
        }
        else
        {
            return $CI->upload->data();
        }
    }
}

if (!function_exists('upload_image'))
{
    function upload_image($input_name, $path)
    {
//        $image_info = getimagesize($_FILES[$input_name]["tmp_name"]);
//        if ($image_info[0] < 400)
//        {
//            return array('error' => -1);
//        }
//        else if ($image_info[1]<=floor($image_info[0]/1.333) && $image_info[0]<=ceil($image_info[1]*1.333))
//        {
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'jpg|png|gif|jpeg';
            $config['max_size'] = '50600';
            $config['max_filename'] = '255';
            $config['file_name'] = time();
            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = TRUE;
            $CI = & get_instance();
            $CI->load->library('upload');
            $CI->upload->initialize($config);

            if (!$CI->upload->do_upload($input_name))
            {
                return array('error' => $CI->upload->display_errors());
            }
            else
            {
                return $CI->upload->data();
            }
//        }
//        else
//        {
//            return array('error' => -20);
//        }
    }
}


if (!function_exists('resize_image'))
{
    function resize_image($upload_data, $thumb_size=array(array(300,225)))
    {
        $CI = & get_instance();
        $CI->load->library('image_lib');

        $i = 0;
        foreach ($thumb_size as $dimentions) {
            $config['image_library'] = 'gd2';
            $config['source_image'] =  $upload_data['full_path'];
            $config['maintain_ratio'] = FALSE;
            $config['new_image'] = $upload_data['file_path'].$upload_data['raw_name'].'_'.$dimentions[0].'x'.$dimentions[1].$upload_data['file_ext'];
            $config['width'] = $dimentions[0];
            $config['height'] = $dimentions[1];
            $CI->image_lib->initialize($config);
            $CI->image_lib->resize();
            $CI->image_lib->clear();
            $upload_data["thumb_$i"] = $upload_data['raw_name'].'_'.$dimentions[0].'x'.$dimentions[1].$upload_data['file_ext'];
            ++$i;
        }
        if ($i!=0)
        {
            return $upload_data;
        }
        else
        {
            return array('error' => $CI->image_lib->display_errors());
        }
    }
}

?>
