    <?php


/*if (!function_exists('do_email'))
{
    function do_email($to, $from, $subject, $message) 
    {
        $config = array(
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'wordwrap' => TRUE
            );
        $CI = & get_instance();
        $CI->load->library('Email', $config);   
         $headers = 'From: Bindel.com sqaiser@leadconcept.net' . "\r\n" ;
         $headers .='Reply-To: sqaiser@leadconcept.net' . "\r\n" ;
         $headers .='X-Mailer: PHP/' . phpversion();
         $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
         if(mail($to, $subject, $message, $headers)){
             return TRUE;
        }
        else {
            return FALSE;
        }
    }
}*/

if (!function_exists('do_email'))
{
    function do_email($to, $from, $subject, $message) 
    {
//        $config = array(
//                'mailtype' => 'html',
//                'charset' => 'utf-8',
//                'wordwrap' => TRUE
//            );
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.dotster.com";
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "info@lexusfclubqatar.com";
        $config['smtp_pass'] = "Lfc1321*";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        $CI = & get_instance();
        $CI->load->library('Email', $config);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '. $from . '<info@lexusfclubqatar.com>'."\r\n";
        if(mail($to, $subject, $message, $headers)){
             return TRUE;
        }
        else {
            return FALSE;
        }
    }
}

if (!function_exists('do_email_admin'))
{
    function do_email_admin($to, $from, $subject, $message) 
    {
        
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.thebindel.com";
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "admin@thebindel.com"; 
        $config['smtp_pass'] = "P&*DUnBD@b3!d!$";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        $CI = & get_instance();
        $CI->load->library('Email', $config);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '. $from . "\r\n";
        if(mail($to, $subject, $message, $headers)){
             return TRUE;
        }
        else {
            return FALSE;
        }
    }
}

if (!function_exists('do_email_support'))
{
    function do_email_support($to, $from, $subject, $message) 
    {
        
        $config['protocol'] = "smtp";
        $config['smtp_host'] = 'mail.thebindel.com';
        $config['smtp_port'] = '25';
        $config['smtp_user'] = "support@thebindel.com"; 
        $config['smtp_pass'] = "P&*DUnBD@b3!d!$";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        $CI = & get_instance();
        $CI->load->library('Email', $config);
        /*$headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '. $from . "\r\n";
*/      $CI->email->from($from, ' user');
        //$list = array('xxx@gmail.com');
        $CI->email->to($to);
        //$this->email->reply_to('my-email@gmail.com', 'Explendid Videos');
        $CI->email->subject($subject);
        $CI->email->message($message);

        if($CI->email->send()){
             return TRUE;
        }
        else {
            return FALSE;
        }
    }
}

if (!function_exists('do_email_info'))
{
    function do_email_info($to, $from, $subject, $message) 
    {
        
        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.thebindel.com";
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "info@thebindel.com"; 
        $config['smtp_pass'] = "P&*DUnBD@b3!d!$";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";

        $CI = & get_instance();
        $CI->load->library('Email', $config);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '. $from . "\r\n";
        if(mail($to, $subject, $message, $headers)){
             return TRUE;
        }
        else {
            return FALSE;
        }
    }
}

?>