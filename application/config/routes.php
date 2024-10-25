<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Login routes
$route['default_controller'] = 'auth/login';
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

// Admin routes
$route['admin/dashboard'] = 'admin/dashboard';   
$route['admin/search'] = 'admin/search';
$route['admin/profile'] = 'admin/profile'; 
$route['admin/manage'] = 'admin/manage';       
$route['admin/manage/add'] = 'admin/add';       
$route['admin/manage/insert'] = 'admin/insert'; 
$route['admin/manage/update'] = 'admin/update';  
$route['admin/account_review'] = 'admin/account_review';
$route['admin/app-list'] = 'admin/app_list';
$route['applicant/accept/(:num)'] = 'applicant/accept/$1';
$route['applicant/decline/(:num)'] = 'admin/decline_applicant/$1';

// Scholarship Coordinator routes
$route['sc/dashboard'] = 'sc/dashboard';   
$route['sc/app-list'] = 'sc/app_list';   

$route['sc/scholarship-program'] = 'sc/scholarship_program';
$route['sc/manage_requirements'] = 'sc/manage_requirements';
$route['sc/school-year'] = 'sc/school_year';
$route['sc/app_evaluation'] = 'sc/app_evaluation';    
$route['sc/view_list/(:any)/(:any)'] = 'sc/view_list/$1/$2';
$route['sc/view_shortlist_applicant/(:num)'] = 'sc/view_shortlist_applicant/$1';
$route['sc/reports'] = 'sc/reports';
$route['sc/update_info'] = 'sc/update_info';
$route['sc/update_profile'] = 'sc/update_profile';
$route['sc/change_password'] = 'sc/change_password';
$route['sc/update_password'] = 'sc/update_password';
$route['sc/program_app_list'] = 'sc/program_app_list';
$route['sc/final_list'] = 'sc/final_list';
$route['sc/final_list/(:any)'] = 'sc/final_list/$1';

// TWC routes
$route['twc/dashboard'] = 'twc/dashboard';      
$route['twc/app-review'] = 'twc/app_review';
$route['twc/update_status'] = 'twc/update_status';
$route['twc/view_applicant/(:num)'] = 'twc/view_applicant/$1';
$route['twc/shortlist'] = 'twc/shortlist';
$route['twc/view_shortlist_applicant/(:num)'] = 'Twc/view_shortlist_applicant/$1';  
$route['twc/reports'] = 'Twc/reports';
$route['twc/update_info'] = 'twc/update_info';
$route['twc/update_profile'] = 'twc/update_profile';
$route['twc/change_password'] = 'twc/change_password';
$route['twc/update_password'] = 'twc/update_password';

// Applicant routes
$route['applicant/register'] = 'applicant/register'; 
$route['applicant/register/submit'] = 'applicant/submit';
$route['applicant_registration'] = 'applicant_registration/index';
$route['auth/applicant_login'] = 'auth/applicant_login';
$route['applicant/dashboard_applicant'] = 'applicant/dashboard_applicant';
$route['applicant/edit-info'] = 'applicant/edit_info';
$routes['applicant/change_password'] = 'applicant/change_password';
$routes['applicant/update_password'] = 'applicant/update_password';
$route['applicant/merit_programs'] = 'applicant/merit_programs';
$route['applicant/non_merit_programs'] = 'applicant/non_merit_programs';
$route['applicant/apply_scholarship'] = 'applicant/apply_scholarship'; 
$route['applicant/submit_application'] = 'applicant/submit_application'; 
$route['applicant/my_application'] = 'applicant/my_application';
$route['applicant/view_form/(:num)'] = 'applicant/view_form/$1';
$route['applicant/edit_application/(:num)'] = 'applicant/edit_application/$1';
$route['applicant/update-info'] = 'applicant/update_info';



// Route for 404 errors
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;