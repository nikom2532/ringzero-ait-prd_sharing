<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

//########### MYSQL

// $db['default']['hostname'] = 'localhost';
// $db['default']['username'] = 'iming';
// $db['default']['password'] = 'iming';
// $db['default']['database'] = 'ringzero_ait_prd_sharing';
// $db['default']['dbdriver'] = 'mysql';

//########### SQL Server

// $db['default']['hostname'] = 'NIKOM2532-PC:1433';
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'nikom2532';
$db['default']['password'] = 'cominter';
$db['default']['database'] = 'ringzero_ait_prd_sharing';
$db['default']['dbdriver'] = 'sqlsrv';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

//######### 2nd Database Connection #########

$db['nnt_data_center_old']['hostname'] = 'localhost';
$db['nnt_data_center_old']['username'] = 'nikom2532';
$db['nnt_data_center_old']['password'] = 'cominter';
$db['nnt_data_center_old']['database'] = 'NNT_DataCenter_2';
$db['nnt_data_center_old']['dbdriver'] = 'sqlsrv';

$db['nnt_data_center_old']['dbprefix'] = '';
$db['nnt_data_center_old']['pconnect'] = TRUE;
$db['nnt_data_center_old']['db_debug'] = TRUE;
$db['nnt_data_center_old']['cache_on'] = FALSE;
$db['nnt_data_center_old']['cachedir'] = '';
$db['nnt_data_center_old']['char_set'] = 'utf8';
$db['nnt_data_center_old']['dbcollat'] = 'utf8_general_ci';
$db['nnt_data_center_old']['swap_pre'] = '';
$db['nnt_data_center_old']['autoinit'] = TRUE;
$db['nnt_data_center_old']['stricton'] = FALSE;

//##################

// $db['nnt_data_center_pooh']['hostname'] = '111.223.32.9:1433';
$db['nnt_data_center_pooh']['hostname'] = '111.223.32.9';
$db['nnt_data_center_pooh']['username'] = 'dbuser_km';
$db['nnt_data_center_pooh']['password'] = '123456';
$db['nnt_data_center_pooh']['database'] = 'NNT_DataCenter';
$db['nnt_data_center_pooh']['dbdriver'] = 'sqlsrv';

$db['nnt_data_center_pooh']['dbprefix'] = '';
$db['nnt_data_center_pooh']['pconnect'] = TRUE;
$db['nnt_data_center_pooh']['db_debug'] = TRUE;
$db['nnt_data_center_pooh']['cache_on'] = FALSE;
$db['nnt_data_center_pooh']['cachedir'] = '';
$db['nnt_data_center_pooh']['char_set'] = 'utf8';
$db['nnt_data_center_pooh']['dbcollat'] = 'utf8_general_ci';
$db['nnt_data_center_pooh']['swap_pre'] = '';
$db['nnt_data_center_pooh']['autoinit'] = TRUE;
$db['nnt_data_center_pooh']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */
