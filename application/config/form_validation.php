<?php

$config = array(
    'pages/add_page' => array(
        array(
            'field' => 'page_title',
            'label' => 'Page Title',
            'rules' => 'trim|required|xss_clean|min_length[3]|max_length[255]'
        ),
        array(
            'field' => 'parent_page',
            'label' => 'Parent',
            'rules' => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required|min_length[20]'
        ),
        array(
            'field' => 'publish',
            'label' => 'Publish Page',
            'rules' => 'xss_clean'
        )
    ),
    'pages/update_page' => array(
        array(
            'field' => 'page_title',
            'label' => 'Page Title',
            'rules' => 'trim|required|xss_clean|min_length[3]|max_length[255]'
        ),
        array(
            'field' => 'parent_page',
            'label' => 'Parent',
            'rules' => 'trim|required|xss_clean|numeric'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required|min_length[20]'
        ),
        array(
            'field' => 'publish',
            'label' => 'Publish Page',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'id',
            'label' => 'id',
            'rules' => 'trim|required|numeric|xss_clean'
        )
    ),
    'users/register' => array(
        array(
            'field' => 'user_name',
            'label' => 'User Name',
            'rules' => 'trim|required|xss_clean|min_length[5]|max_length[35]|callback_is_valid_username'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|xss_clean|valid_email|is_unique[users.email]|max_length[60]'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|xss_clean|min_length[6]|max_length[32]'
        ),
        array(
            'field' => 'conf_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|xss_clean|min_length[6]|max_length[32]|matches[password]'
        ),
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => 'trim|required|xss_clean|min_length[5]|max_length[35]'
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => 'trim|required|xss_clean|min_length[5]|max_length[35]'
        ),
        array(
            'field' => 'bio',
            'label' => 'Bio',
            'rules' => 'xss_clean'
        ),
        array(
            'field' => 'enable',
            'label' => 'Enable Account',
            'rules' => 'xss_clean'
        )
    ),
    'email_templates/upload_template' => array(
        array(
            'field' => 'email_title',
            'label' => 'Title',
            'rules' => 'trim|required|min_length[4]|max_length[255]|xss_clean'
        ),
        array(
            'field' => 'email_subject',
            'label' => 'Subject',
            'rules' => 'trim|required|min_length[4]|max_length[255]|xss_clean'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required|min_length[20]|xss_clean'
        )
    ),
    'email_templates/update_template' => array(
        array(
            'field' => 'email_title',
            'label' => 'Title',
            'rules' => 'trim|required|min_length[4]|max_length[255]|xss_clean'
        ),
        array(
            'field' => 'email_subject',
            'label' => 'Subject',
            'rules' => 'trim|required|min_length[4]|max_length[255]|xss_clean'
        ),
        array(
            'field' => 'content',
            'label' => 'Content',
            'rules' => 'trim|required|min_length[20]|xss_clean'
        )
    ),
    
    'admin_logins/admin_portal' => array(
        array(
            'field' => 'email_login',
            'label' => 'User Email',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'fiel' => 'password',
            'label'=> 'Password',
            'rules'=> 'trim|required|xss_clean'
        )
    ),
   'adminSetting/password' => array(
       array(
           'field' => 'old_password',
           'label' => 'Old Ppassword',
           'rules' => 'trim|required|xss_clean'
       ),
      array(
           'field' => 'new_password',
           'label' => 'New Password',
           'rules' => 'trim|required|min_length[6]|xss_clean'
       ),
      array(
           'field' => 'confirm_password',
           'label' => 'Confirm Password',
           'rules' => 'trim|required|min_length[6]|matches[new_password]|xss_clean'
       )
   ),
    
    'admin_logins/forgot_password' => array(        
        array(
           'field' => 'forgot_password',
           'label' => 'Forgot Password',
           'rules' => 'trim|required|valid_email|max_length[255]|xss_clean' 
        )        
    ),
    'admin_logins/cnf_pass' => array(
        array(
           'field' => 'pass',
           'label' => 'Forgot Password',
           'rules' => 'trim|required|min_length[6]|max_length[255]|xss_clean'    
        ),
        array(
           'field' => 'conf_pass',
           'label' => 'Confirm Password',
           'rules' => 'trim|required|matches[pass]|min_length[6]|max_length[255]|xss_clean'   
        )
    ),
    
    'orbits/save_orbit' => array(
        array(
          'field' => 'orbit_name', 
          'label' => 'Orbit name',
          'rules' => 'trim|required|xss_clean'  
        ),
        array(
          'field' => 'orbit_des',
          'label' => 'Orbit Description',
          'rules' => 'trim|required|min_length[20]|xss_clean'  
        ),
        array(
            'field' => 'orbit_privacy',
            'label' => 'Privacy',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'publish_orbit',
            'label' => 'Publish Orbit',
            'rules' => 'trim|xss_clean'
        )     
        
    ),
    'adminSetting/admin_profile_update' => array(
           array(
               'field' => 'admin_user_name',
               'label' => 'Admin name',
               'rules' => 'trim|required|min_length[4]|max_length[15]|xss_clean'               
           )
       ),
    'adminSetting/admin_email_change' => array(
        array(
            'field' => 'admin_email',
            'label' => 'Admin email',
            'rules' => 'trim|required|valid_email|xss_clean'
        )
        
    ),
    
    'admin_message/send_message' => array(
        array(
            'field' => 'select_flag',
            'label' => 'Flag',
            'rules' => 'trim|required|numeric|greater_than[0]|less_than[4]|xss_clean'
        ),
        array(
            'field' => 'all_users[]',
            'label' => 'Users',
            'rules' => 'trim|required|xss_clean'
        ),
        array(
            'field' => 'admin_message',
            'label' => 'Message',
            'rules' => 'trim|required|xss_clean'
        )
    )
    
    
      
    
    
);
?>