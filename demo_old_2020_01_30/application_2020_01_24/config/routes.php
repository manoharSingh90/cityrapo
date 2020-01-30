<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller']     = 'home';
$route['home/(:any)']     = 'home/$1';
$route['hosters']                = 'home/search_host';
$route["viewitineraries/(.*)"]   = "home/detail_itinerarie/$1";
$route["bookitineraries/(.*)"]   = "home/book_itinerarie/$1";

$route['signin']                 = 'account';
$route['signup']                 = 'account';
$route['profile']                = 'account/profile';
$route['save_profile']           = 'account/user_profile_save';
$route['done_profile']           = 'account/user_profile_done';
$route['log_out']                = "account/log_out";

$route["book"]                   = "booking/book_itenerary";
$route["payment"]                = "booking/payment";
$route["thanks/(.*)"]            = "booking/thanks/$1";
$route["fail/(.*)"]              = "booking/bookingfail/$1";

//ITINERARIES
$route['itineraries']            = 'itineraries'; 
$route['itineraries/(:any)']            = 'itineraries/$1'; 
$route['create_itineraries']     = 'itineraries/create_itineraries';
$route['create_itineraries_experiences']     = 'itineraries/create_itineraries_experiences';
$route['create_itineraries_meetup']     = 'itineraries/create_itineraries_meetup';
$route['create_itineraries_session'] = 'itineraries/create_itineraries_session';
$route['leave_msg']              = 'itineraries/leave_msg';

$route['contact']                = 'footer/contact';
$route['policies']               = 'footer/policies';
$route['cancellation']           = 'footer/cancellation';
$route['terms_and_conditions']   = 'footer/terms_and_conditions';
$route['legal']                  = 'footer/legal';
$route['about']                  = 'footer/about';
$route['advertise']              = 'footer/advertisement';
$route['copyright']              = 'footer/copyright';
$route['photocredits']           = 'footer/photo_credites';
$route["soon"]                   = "footer/soon";
$route["media"]                  = "footer/media";
$route["why_host"]               = "footer/why_host";
$route["know_india"]             = "footer/knowmore_india";
$route["take_a_pledge"]          = "footer/take_pledge";

//====== START:: new route by robin on 28-06-19 =========//
$route["how_it_works"]         = "footer/how_it_works";
$route["feedback"]             = "footer/feedback";
$route["cookies"]             = "footer/cookies";
$route["privacy"]             = "footer/privacy";
$route["faq"]             = "footer/faq";
$route["work_with_us"]        = "footer/work_with_us";

//====== END:: new route by robin on 28-06-19 =========//

$route["north_india"]            = "footer/knowmore_north";
$route["north_indian_culture"]   = "footer/knowmore_north_culture";
$route["north_indian_food"]      = "footer/knowmore_north_food";
$route["north_indian_heritage"]  = "footer/knowmore_north_heritage";
$route["north_indian_people"]    = "footer/knowmore_north_people";

$route["north_east_india"]            = "footer/knowmore_north_east";
$route["north_east_indian_culture"]   = "footer/knowmore_north_east_culture";
$route["north_east_indian_food"]      = "footer/knowmore_north_east_food";
$route["north_east_indian_heritage"]  = "footer/knowmore_north_east_heritage";
$route["north_east_indian_people"]    = "footer/knowmore_north_east_people";

$route["east_india"]             = "footer/knowmore_east";
$route["east_indian_culture"]    = "footer/knowmore_east_culture";
$route["east_indian_food"]       = "footer/knowmore_east_food";
$route["east_indian_heritage"]   = "footer/knowmore_east_heritage";
$route["east_indian_people"]     = "footer/knowmore_east_people";

$route["west_india"]             = "footer/knowmore_west";
$route["west_indian_culture"]    = "footer/knowmore_west_culture";
$route["west_indian_food"]       = "footer/knowmore_west_food";
$route["west_indian_heritage"]   = "footer/knowmore_west_heritage";
$route["west_indian_people"]     = "footer/knowmore_west_people";

$route["south_india"]            = "footer/knowmore_south";
$route["south_indian_culture"]   = "footer/knowmore_south_culture";
$route["south_indian_food"]      = "footer/knowmore_south_food";
$route["south_indian_heritage"]  = "footer/knowmore_south_heritage";
$route["south_indian_people"]    = "footer/knowmore_south_people";

$route["central_india"]          = "footer/knowmore_central";
$route["central_indian_culture"] = "footer/knowmore_central_culture";
$route["central_indian_food"]    = "footer/knowmore_central_food";
$route["central_indian_heritage"]= "footer/knowmore_central_heritage";
$route["central_indian_people"]  = "footer/knowmore_central_people";


$route["trademarkcautionnotice"]  = "footer/trademark_caution_notice";


$route['404_override']           = '';
$route['translate_uri_dashes']   = FALSE;

//=========START::Admin route ===============//
$route['host']   = 'admin/host';
$route['all_itineraries']   = 'admin/itineraries';
$route['itineraries_request']   = 'admin/itineraries_request';
$route['request']   = 'admin/request';
$route['translator_reqitineraries']   = 'admin/translator_reqitineraries';
$route['translator_all_itineraries'] = 'admin/translator_all_itineraries';
//$route['host_detail_itineraries/(.*)']   = 'admin/host_detail_itineraries/$1';


//========= login from mail link =========//
$route['loginMailHost'] = "account/loginMailHost";
$route['saveItinerary'] = "Itineraries/saveItinerary";
$route['doneItinerary'] = "Itineraries/doneItinerary";
$route['itinerary_edit_view/(.*)'] = "Itineraries/itinerary_edit_view/$1";
$route['myprofile']   = "Itineraries/myprofile";
$route['saveExperienceItinerary'] = "Itineraries/saveExperienceItinerary";
$route['doneExperienceItinerary'] = "Itineraries/doneExperienceItinerary";
$route['itinerary_experience_edit_view/(.*)'] = "Itineraries/itinerary_experience_edit_view/$1";
$route['saveMeetupItinerary'] = "Itineraries/saveMeetupItinerary";
$route['doneMeetupItinerary'] = "Itineraries/doneMeetupItinerary";
$route['itinerary_meetup_edit_view/(.*)'] = "Itineraries/itinerary_meetup_edit_view/$1";
$route['saveSessionItinerary'] = "Itineraries/saveSessionItinerary";
$route['doneSessionItinerary'] = "Itineraries/doneSessionItinerary";
$route['itinerary_session_edit_view/(.*)'] = "Itineraries/itinerary_session_edit_view/$1";
$route['book_itineraries'] = 'Booking/book_itineraries';
//$route["detail_itineraries/(.*)"]   = "home/detail_itineraries/$1";

$route['walk/(.*)'] = "home/detail_itineraries/$1";
$route['session/(.*)'] = "home/detail_itineraries_sessions/$1";
$route['experience/(.*)'] = "home/detail_itineraries_experiences/$1";
$route['meetup/(.*)'] = "home/detail_itineraries_meetup/$1";
$route['reset_password'] = 'account/resetPassword';



