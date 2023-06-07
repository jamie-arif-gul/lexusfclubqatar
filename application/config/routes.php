<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = 'site/users';
$route['404_override'] = 'show404';


/*
 * ultimateesports Admin Panel Routing - start here
 */


// Dashboard Controller
$route['administrator'] = 'admin/admin_logins/index';
$route['administrator/dashboard'] = 'admin/admin/index';



// Change password Controller
$route['administrator/change_password'] = 'admin/adminSetting/change_password';
$route['administrator/admin_logout'] = 'admin/logout/admin_logout';
$route['administrator/password'] = 'admin/adminSetting/password';


// Pages Controller
//$route['administrator/manage_pages'] = 'admin/pages/manage_pages';
//$route['administrator/manage_pages/(:num)'] = 'admin/pages/manage_pages';
//$route['administrator/add_menu'] = 'admin/menus/add_menu';
//$route['administrator/manage_menus'] = 'admin/menus/manage_menus';
//$route['administrator/edit_page/(:num)'] = 'admin/pages/add_page';
//$route['administrator/delete_page/(:num)/(:num)'] = 'admin/pages/delete_page';
//$route['administrator/update_page_status/(:num)/(:num)/(:num)'] = 'admin/pages/update_status';
//$route['administrator/add_page'] = 'admin/pages/index';
//$route['administrator/save_page'] = 'admin/pages/add_page';
//$route['administrator/update_page'] = 'admin/pages/update_page';
//$route['administrator/update_page/(:num)'] = 'admin/pages/update_page';
//$route['administrator/ckeditor_upload'] = 'admin/pages/do_ckeditor_file_upload';

// Pages Controller
//$route['administrator/manage_settings'] = 'admin/settings_management/manage_settings';
//$route['administrator/manage_settings/(:num)'] = 'admin/settings_management/manage_settings';
//$route['administrator/edit_setting/(:num)/(:any)'] = 'admin/settings_management/edit_setting';

// Users Controller
$route['administrator/create_user'] = 'admin/users_management/create_user';
$route['administrator/edit_user/(:num)'] = 'admin/users_management/edit_user';
$route['administrator/manage_users'] = 'admin/users_management/manage_users';
$route['administrator/manage_users/(:num)'] = 'admin/users_management/manage_users';
//$route['administrator/update_user'] = 'admin/users_management/update_user';
$route['administrator/update_user_status/(:num)/(:num)/(:num)'] = 'admin/users_management/update_status';
$route['administrator/delete_user/(:num)/(:num)'] = 'admin/users_management/delete_user';
$route['administrator/view_user/(:num)'] = 'admin/users_management/view_user';

// Events Controller
$route['administrator/create_event'] = 'admin/events_management/create_event';
$route['administrator/manage_events'] = 'admin/events_management/manage_events';
$route['administrator/manage_events/(:num)'] = 'admin/events_management/manage_events';
$route['administrator/view_event/(:num)'] = 'admin/events_management/view_event';
$route['administrator/view_event/(:num)/(:num)'] = 'admin/events_management/view_event';
$route['administrator/edit_event/(:num)'] = 'admin/events_management/edit_event';
$route['administrator/delete_event/(:num)/(:num)'] = 'admin/events_management/delete_event';

// News Controller
$route['administrator/create_news'] = 'admin/news_management/create_news';
$route['administrator/manage_news'] = 'admin/news_management/manage_news';
$route['administrator/manage_news/(:num)'] = 'admin/news_management/manage_news';
$route['administrator/view_news/(:num)'] = 'admin/news_management/view_news';
$route['administrator/edit_news/(:num)'] = 'admin/news_management/edit_news';
$route['administrator/delete_news/(:num)/(:num)'] = 'admin/news_management/delete_news';


// Frange Controller


$route['administrator/create_frange'] = 'admin/frange_management/create_frange';
$route['administrator/manage_frange'] = 'admin/frange_management/manage_frange';
$route['administrator/manage_frange/(:num)'] = 'admin/frange_management/manage_frange';
$route['administrator/view_frange/(:num)'] = 'admin/frange_management/view_frange';
$route['administrator/edit_frange/(:num)'] = 'admin/frange_management/edit_frange';
$route['administrator/delete_frange/(:num)/(:num)'] = 'admin/frange_management/delete_frange';
// Frange Content Controller
$route['administrator/frange'] = 'admin/frange_c_management/frange';
$route['administrator/frange_content_create'] = 'admin/frange_c_management/frange_content_create';
$route['administrator/frange_content_edit'] = 'admin/frange_c_management/frange_content_edit';
// ACCESSORIES Controller

$route['administrator/manage_accessories'] = 'admin/accessories_management/manage_accessories';
$route['administrator/manage_accessories/(:num)'] = 'admin/accessories_management/manage_accessories';
$route['administrator/view_accessories/(:num)'] = 'admin/accessories_management/view_accessories';
$route['administrator/delete_accessories/(:num)/(:num)'] = 'admin/accessories_management/delete_accessories';
// Gallery Controller
$route['administrator/create_gallery'] = 'admin/gallery_management/create_gallery';
$route['administrator/manage_gallery'] = 'admin/gallery_management/manage_gallery';
$route['administrator/manage_gallery/(:num)'] = 'admin/gallery_management/manage_gallery';
$route['administrator/view_gallery/(:num)'] = 'admin/gallery_management/view_gallery';
$route['administrator/edit_gallery/(:num)'] = 'admin/gallery_management/edit_gallery';
$route['administrator/delete_gallery/(:num)/(:num)'] = 'admin/gallery_management/delete_gallery';

// Offers Controller
$route['administrator/create_offers'] = 'admin/offers_management/create_offers';
$route['administrator/manage_offers'] = 'admin/offers_management/manage_offers';
$route['administrator/manage_offers/(:num)'] = 'admin/offers_management/manage_offers';
$route['administrator/view_offers/(:num)'] = 'admin/offers_management/view_offers';
$route['administrator/edit_offers/(:num)'] = 'admin/offers_management/edit_offers';
$route['administrator/delete_offers/(:num)/(:num)'] = 'admin/offers_management/delete_offers';
// Offers  Controller For changing the content
$route['administrator/offers'] = 'admin/offers_management/offers';
$route['administrator/offers_content_create'] = 'admin/offers_management/offers_content_create';
$route['administrator/offers_content_edit'] = 'admin/offers_management/offers_content_edit';
// Bookings Controller
$route['administrator/manage_bookings'] = 'admin/bookings_management/manage_bookings';
$route['administrator/manage_bookings/(:num)'] = 'admin/bookings_management/manage_bookings';
$route['administrator/view_booking/(:num)'] = 'admin/bookings_management/view_booking';
$route['administrator/delete_booking/(:num)/(:num)'] = 'admin/bookings_management/delete_booking';
//// Properties Controller
////$route['administrator/create_property'] = 'admin/users_management/create_property';
//$route['administrator/edit_user/(:num)'] = 'admin/users_management/edit_user';
//$route['administrator/manage_properties'] = 'admin/property_management/manage_properties';
//$route['administrator/manage_properties/(:num)'] = 'admin/property_management/manage_properties';
//$route['administrator/deleteProperty/(:num)/(:any)'] = "admin/property_management/deleteProperty";
//$route['administrator/updateStatus/(:num)/(:any)/(:num)'] = "admin/property_management/updateStatus";
//$route['administrator/featured/(:num)/(:any)/(:num)'] = "admin/property_management/featured";
//$route['administrator/property_detail/(:num)/(:any)'] = "admin/property_management/propertyDetail";
//$route['administrator/add_property_views'] = "admin/property_management/add_property_views";

//$route['administrator/popular_properties'] = 'admin/property_management/popular_properties';
//$route['administrator/popular_properties/(:num)'] = 'admin/property_management/popular_properties';

//$route['administrator/delete_review/(:num)/(:any)/(:any)'] = "admin/property_management/deleteReview";

// Orders Controller
//$route['administrator/manage_requests'] = 'admin/request_management/manage_requests';
//$route['administrator/manage_requests/(:any)'] = 'admin/request_management/manage_requests';
//$route['administrator/deleteRequest/(:num)/(:any)'] = "admin/request_management/deleteRequest";
//$route['administrator/acceptRequest/(:num)/(:any)'] = "admin/request_management/accept";
//$route['administrator/rejectRequest/(:num)/(:any)'] = "admin/request_management/reject";
//$route['administrator/acceptPayment/(:any)'] = "admin/request_management/acceptPayment";
//$route['administrator/request_detail/(:num)/(:any)'] = "admin/request_management/request_detail";
// Forgot Password
//$route['administrator/reset_password/(:any)'] = "admin/admin_logins/reset";
//$route['administrator/confirom_password'] = "admin/admin_logins/cnf_pass";
$route['administrator/forgot_password'] = "admin/admin_logins/forgot_password";
$route['administrator/do_login'] = "admin/admin_logins/admin_portal";

//Messages Controller
//$route['administrator/manage_messages'] = 'admin/messages_management/manage_messages';
//$route['administrator/manage_messages/(:num)'] = 'admin/messages_management/manage_messages';
//$route['administrator/messages_detail/(:num)/(:any)'] = 'admin/messages_management/messages_detail';

//profile
$route['administrator/profile'] = "admin/adminSetting/profile";
$route['administrator/admin_email'] = "admin/adminSetting/admin_change_email";







/*
 * End here - ultimateesports admin panel routing
 */




/*
 * ultimateesports Sports Frontend Routing - start here
 */

// users controller
$route['signup'] = 'site/users/signup';
$route['registration-message'] = 'site/users/registration_message';
$route['upgrade_role'] = 'site/users/upgrade_role';
//$route['signup_ajax'] = 'site/users/signup_ajax';
//$route['signup/(:any)'] = 'site/users/signup';
//$route['home'] = 'site/users/index';
$route['login'] = 'site/users/login';
//$route['login_ajax'] = 'site/users/login_ajax';
$route['logout'] = 'site/users/logout';
$route['activate_account/(:any)/(:any)'] = "site/users/activate_account";
//$route['refer_friend'] = 'site/users/refer_friend';
//$route['referred_friends'] = 'site/users/referred_friends';
//$route['referred_friends/(:num)'] = 'site/users/referred_friends';
$route['update_profile_pic'] = 'site/users/update_profile_pic';
$route['registr_success'] = 'site/users/registr_success';


// Booking controller
$route['booking'] = 'site/home_controller/booking';
$route['accessories'] = 'site/home_controller/accessories';
$route['offers'] = 'site/home_controller/offers';
$route['news/(:num)'] = 'site/home_controller/news';
$route['news'] = 'site/home_controller/news';
$route['frange/(:num)'] = 'site/home_controller/frange';
$route['frange'] = 'site/home_controller/frange';
$route['offers/(:num)'] = 'site/home_controller/offers';
$route['offers'] = 'site/home_controller/offers';
$route['events'] = 'site/home_controller/events';
$route['gallery'] = 'site/home_controller/gallery';
$route['contact'] = 'site/home_controller/contact';

//$route['profile'] = 'site/users/profile';
//$route['profile/(:num)'] = 'site/users/profile';
//$route['profile/profile_view'] = 'site/users/profile_view';
//$route['update_user_profile'] = 'site/users/update_user_profile';
//$route['profile/change_my_password'] = "site/users/change_my_password";
//$route['update_my_password'] = "site/users/update_my_password";
//$route['profile/deactivate_account'] = 'site/users/deactivate_account';
//
//$route['forgot_password'] = "site/users/forgot_password";
//$route['forgot_password_email'] = "site/users/forgot_password_email";
//$route['forgot_password_email_ajax'] = "site/users/forgot_password_email_ajax";
//$route['reset_password/(:any)'] = "site/users/reset_password";
//$route['change_password'] = "site/users/change_password";

// property controller
//$route['properties'] = "site/property_controller/index";
//$route['properties/(:num)'] = "site/property_controller/index";
//$route['properties/createProperty'] = "site/property_controller/createProperty";
//$route['properties/createPropertyStepTow/(:any)'] = "site/property_controller/createPropertyStepTow";
//$route['properties/createPropertyStepThree/(:any)'] = "site/property_controller/createPropertyStepThree";
//$route['properties/createPropertyStepFour/(:any)'] = "site/property_controller/createPropertyStepFour";
//
//$route['properties/editProperty/(:num)/(:any)'] = "site/property_controller/editProperty";
//$route['properties/editPropertyStepTow/(:num)/(:any)'] = "site/property_controller/editPropertyStepTow";
//$route['properties/editPropertyStepThree/(:num)/(:any)'] = "site/property_controller/editPropertyStepThree";
//$route['properties/editPropertyStepFour/(:num)/(:any)'] = "site/property_controller/editPropertyStepFour";
//
//$route['properties/deleteProperty/(:num)/(:any)'] = "site/property_controller/deleteProperty";
//$route['properties/myProperties'] = "site/property_controller/myProperties";
//$route['properties/myProperties/(:num)'] = "site/property_controller/myProperties";
//$route['properties/propertyDetail/(:any)'] = "site/property_controller/getProperty";
//$route['upload_property_image_main'] = "site/property_controller/upload_property_image_main";
//$route['upload_property_image'] = "site/property_controller/upload_property_image";
//$route['add_image_description'] = "site/property_controller/add_image_description";
//
//$route['properties/addFavorite/(:num)/(:any)'] = "site/property_controller/addFavorite";
//$route['properties/removeFavorite/(:num)/(:any)'] = "site/property_controller/removeFavorite";
//$route['properties/favorite'] = "site/property_controller/getFavorite";
//$route['properties/favorite/(:num)'] = "site/property_controller/getFavorite";
//$route['properties/searches'] = "site/property_controller/getSearches";
//$route['properties/searches/(:num)'] = "site/property_controller/getSearches";
//$route['properties/removeSearch/(:num)/(:any)'] = "site/property_controller/removeSearch";
//
//$route['properties/addRatings'] = "site/property_controller/addRatings";
//$route['properties/addReview'] = "site/property_controller/addReview";
//
//$route['properties/property_detail/(:any)'] = "site/property_controller/propertyDetail";
//
//$route['properties/purchase'] = "site/property_controller/purchase";
//$route['properties/purchase/(:any)'] = "site/property_controller/purchase";
//
//search controller
//$route['search'] = "site/search_controller/index";
//$route['search/(:num)'] = "site/search_controller/index";
//$route['save_search'] = "site/search_controller/save_search";
//
// Request controller
//$route['request'] = "site/request_controller/index";
//$route['requests/request_step_one/(:any)/(:any)'] = "site/request_controller/request_step_one";
//$route['requests/request_step_two/(:any)/(:any)'] = "site/request_controller/request_step_two";
//$route['requests/send_requests'] = "site/request_controller/send_requests";
//$route['requests/received_requests'] = "site/request_controller/received_requests";
//$route['requests/send_requests/(:num)'] = "site/request_controller/send_requests";
//$route['requests/received_requests/(:num)'] = "site/request_controller/received_requests";
//$route['requests/deleteRequest/(:num)/(:any)'] = "site/request_controller/delete";
//$route['requests/acceptRequest/(:num)/(:any)'] = "site/request_controller/accept";
//$route['requests/rejectRequest/(:num)/(:any)'] = "site/request_controller/reject";
//$route['requests/notification_alerts'] = "site/request_controller/notification_alerts";
//$route['requests/request_detail/(:any)'] = "site/request_controller/request_detail";
//$route['requests/request_detail_1/(:any)/(:num)'] = "site/request_controller/request_detail_1";
//$route['requests/cancelRequest/(:num)/(:any)'] = "site/request_controller/cancelRequest";

// messages controller
//$route['messages/create'] = "site/messages_controller/create";
//$route['messages/conversation'] = "site/messages_controller/conversation";
//$route['messages/conversation/(:num)'] = "site/messages_controller/conversation";
//$route['messages/conversation_detail/(:any)'] = "site/messages_controller/conversation_detail";
//$route['messages/conversation_detail/(:any)/(:num)'] = "site/messages_controller/conversation_detail";
//$route['messages/message_alert'] = "site/messages_controller/message_alert";
//$route['messages/create_message_ajax'] = "site/messages_controller/create_message_ajax";
// index controller for dynamically pages
//$route['pages/(:any)'] = 'site/index/pages';
//$route['help_pages/(:any)'] = 'site/index/help_pages';
//$route['pages_popup/(:any)'] = 'site/index/pages_popup';
//$route['contact_us'] = 'site/index/contact_us';
//$route['message_us'] = 'site/index/message_us';

/*require_once( BASEPATH .'database/DB'. EXT );
$db =& DB();
$query = $db->get( 'pages' );
$result = $query->result();
foreach( $result as $row )
{
  $route[ $row->alias ] = 'site/index/pages';
}*/

/*
 * ultimateesports Frontend Routing - end here
 */


/* End of file routes.php */
/* Location: ./application/config/routes.php */