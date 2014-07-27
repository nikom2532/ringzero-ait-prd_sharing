<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

//$route['default_controller'] = "welcome";
$route['404_override'] = '';

$route['default_controller'] = 'prd_authen';
// $route['(:any)'] = 'prd_authen';
// $route['index'] = 'prd_authen';
$route['authen_proc'] = 'prd_authen/authen';
$route['authen_proc2'] = 'prd_authen_normal_1';
$route['logout'] = 'PRD_Authen_Logout';


$route['homePRD'] = 'prd_homeprd';
$route['homePRD/(:num)'] = "prd_homeprd/index/$1";


$route['sentNew'] = 'prd_sentnew';

// $route['sentNew/(:any)'] = 'prd_sentnew';

$route['sentNew_Department'] = 'prd_sentnew/get_Department';

$route['sentNew_Upload'] = 'prd_sentNew/sentnew_process';

$route['rss'] = 'prd_rss';
$route['rss/(:num)'] = 'prd_rss/index/$1';

$route['rss_detail_prd'] = 'prd_rss_detail_prd';
$route['rss_detail_grov'] = 'prd_rss_detail_gove';


$route['manageNew'] = 'prd_managenew';

$route['manageUser'] = 'prd_manageuser';
$route['manageUserPRD'] = 'prd_manageuser_prd';
$route['manageUserPRD/(:num)'] = 'prd_manageuser_prd/index/$1';
$route['manageUserGOVE'] = 'prd_manageuser_gove';
$route['manageUserGOVE/(:num)'] = 'prd_manageuser_gove/index/$1';

$route['manageInfo_Category'] = 'prd_manageinfo_category';
$route['manageInfo_Category/(:num)'] = "prd_manageinfo_category/index/$1";

$route['detail_prd'] = 'prd_managenew_detail_prd';
$route['detail_grov'] = 'prd_managenew_detail_grov';

$route['homeGOVE'] = 'prd_homegove';
$route['homeGOVE/(:num)'] = "prd_homegove/index/$1";

$route['infoDepartment'] = 'prd_infodepartment';
$route['infoDepartmentNew'] = 'prd_infodepartment_new';
$route['infoMinistry'] = 'prd_infoministry';
$route['infoMinistryNew'] = 'prd_infoministry_new';

$route['manageInfo_Department'] = 'prd_manageinfo_department';
$route['manageInfo_Department/(:num)'] = 'prd_manageinfo_department/index/$1';
$route['manageInfo_Ministry'] = 'prd_manageinfo_ministry';
$route['manageInfo_Ministry/(:num)'] = 'prd_manageinfo_ministry/index/$1';

$route['manageNewApproveGROV'] = 'prd_managenewapprovegrov';
$route['manageNewEditGROV'] = 'prd_manageneweditgrov';
$route['manageNewEditPRD'] = 'prd_manageneweditprd';


$route['manageNewGROV'] = 'prd_managenewgrov';
$route['manageNewGROV/(:num)'] = 'prd_managenewgrov/index/$1';

$route['manageNewPRD'] = 'prd_managenewprd';
$route['manageNewPRD/(:num)'] = 'prd_managenewprd/index/$1';

$route['reportPRD'] = 'prd_reportprd';
$route['reportPRD/(:num)'] = 'prd_reportprd/index/$1';
$route['reportDetailPRD'] = 'prd_report_detail_prd';


$route['reportGOVE'] = 'prd_reportgove';
$route['reportGOVE/(:num)'] = 'prd_reportgove/index/$1';
$route['reportDetailGROV'] = 'prd_report_detail_grov';

$route['userInfo_PRD'] = 'prd_userinfo_prd';
$route['userInfo_GOVE'] = 'prd_userinfo_gove';

$route['register'] = 'prd_userinfo_register';

// $route['testdb'] = 'testsite_db2';


/* End of file routes.php */
/* Location: ./application/config/routes.php */