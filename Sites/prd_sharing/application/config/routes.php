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
$route['(:any)'] = 'prd_authen';
$route['index'] = 'prd_authen';
$route['authen_proc'] = 'prd_authen/authen';


$route['homePRD'] = 'prd_homeprd';
$route['sentNew'] = 'prd_sentnew';
$route['sentNew_Upload'] = 'prd_sentNew/sentnew_process';

$route['rss'] = 'prd_rss';
$route['manageNew'] = 'prd_managenew';

$route['manageUser'] = 'prd_manageuser';
$route['manageInfo_Category'] = 'prd_manageinfo_category';
$route['reportPRD'] = 'prd_reportprd';

$route['detail_prd'] = 'prd_managenew_detail_prd';
$route['detail_grov'] = 'prd_managenew_detail_grov';
$route['homeGOVE'] = 'prd_homegove';
$route['infoDepartment'] = 'prd_infodepartment';
$route['infoDepartmentNew'] = 'prd_infodepartment_new';
$route['infoMinistry'] = 'prd_infoministry';
$route['infoMinistryNew'] = 'prd_infoministry_new';
$route['manageInfo_Department'] = 'prd_manageinfo_department';
$route['manageInfo_Ministry'] = 'prd_manageinfo_ministry';
$route['manageNewApproveGROV'] = 'prd_managenewapprovegrov';
$route['manageNewEditGROV'] = 'prd_manageneweditgrov';
$route['manageNewEditPRD'] = 'prd_manageneweditprd';
$route['manageNewGROV'] = 'prd_managenewgrov';
$route['manageNewPRD'] = 'prd_managenewprd';
$route['reportGOVE'] = 'prd_reportgove';
$route['userInfo'] = 'prd_userinfo';
$route['register'] = 'prd_userinfo_register';



// $route['testdb'] = 'testsite_db2';






/* End of file routes.php */
/* Location: ./application/config/routes.php */