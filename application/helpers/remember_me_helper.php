<?php
/*
 * Check for remember me cookie
 * 
 * This function checks for remember me cookie 
 * on visitors browser
 */
if (!function_exists('login_persists'))
{
    function login_persists() 
    {
        $CI = & get_instance();
        if ($CI->input->cookie('remember_me')!="" && !$CI->session->userdata('logged_in'))
        {
            $user_id = $CI->encrypt->decode($CI->input->cookie('remember_me'));
            $CI->load->model('user');
            $user_data = $CI->user->get_user($user_id);
            if ($user_data)
            {
                $user_data[0]['user_id'] = $CI->encrypt->encode($user_data[0]['user_id']);
                $CI->session->set_userdata($user_data[0]);
                $CI->session->set_userdata('logged_in', TRUE);
                $cookie = array(
                    'name'   => 'remember_me',
                    'value'  => $CI->session->userdata('user_id'),
                    'expire' => 24*60*60
                );
                set_cookie($cookie);
            }
        }
    }
}

?>
