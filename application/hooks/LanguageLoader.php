<?php

class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        $ci->config->set_item('language', $siteLang);
//        var_dump($siteLang);die;
        if ($siteLang) {
            $ci->lang->load('calendar',$siteLang);
            $ci->lang->load('date',$siteLang);
            $ci->lang->load('db',$siteLang);
            $ci->lang->load('email',$siteLang);
            $ci->lang->load('form_validation',$siteLang);
            $ci->lang->load('ftp',$siteLang);
            $ci->lang->load('imglib',$siteLang);
//            $ci->lang->load('message',$siteLang);
            $ci->lang->load('migration',$siteLang);
            $ci->lang->load('number',$siteLang);
//            $ci->lang->load('pagination',$siteLang);
            $ci->lang->load('profiler',$siteLang);
            $ci->lang->load('unit_test',$siteLang);
            $ci->lang->load('upload',$siteLang);
        } else {
            $ci->lang->load('calendar','english');
            $ci->lang->load('date','english');
            $ci->lang->load('db','english');
            $ci->lang->load('email','english');
            $ci->lang->load('form_validation','english');
            $ci->lang->load('ftp','english');
            $ci->lang->load('imglib','english');
//            $ci->lang->load('message','english');
            $ci->lang->load('migration','english');
            $ci->lang->load('number','english');
//            $ci->lang->load('pagination','english');
            $ci->lang->load('profiler','english');
            $ci->lang->load('unit_test','english');
            $ci->lang->load('upload','english');
        }
    }
}