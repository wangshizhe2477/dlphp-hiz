<?php
/**
 * HIZ framework 1.3.4
 * dlphp.com 版权所有,未经允许禁止商业使用
 * @author Wang Shizhe
 * @date 2012-1-31
 */

ini_set ( 'display_errors', 'off' );
//DIR config
define ( 'ROOT', dirname ( __FILE__ ) . '/' );
define ( 'APP', ROOT . 'app/' );
define ( 'APP_UTIL', APP . 'util/' );
define ( 'LIB', ROOT . 'lib/' );
define ( 'DS', DIRECTORY_SEPARATOR );
define ( 'UPLOAD', ROOT . 'upload/' );
define ( 'BASEURL', 'http://localhost/hiz/' );

//Smarty config
define ( 'SMARTY_TEMPLATE_DIR', APP . 'view/' );
define ( 'SMARTY_COMPILE_DIR', APP . 'temp/' );
define ( 'SMARTY_CACHE_DIR', APP . 'temp/cache/' );
define ( 'SMARTY_LEFT_DELIMITER', '#{' );
define ( 'SMARTY_RIGHT_DELIMITER', '}' );
define ( 'SMARTY_PLUGINS_DIR', APP . 'plugin/' );

//include
require_once LIB . 'Smarty/Smarty.class.php';
require_once LIB . 'FLEA/FLEA.php';
require_once APP_UTIL . 'fileUploader.php';
require_once APP_UTIL . 'global.php';
require_once APP . 'model' . DS . 'base.php';
require_once APP_UTIL . 'controller.php';

//FLEA config
FLEA::setAppInf ( 'dbTablePrefix', '' );
$dbDSN ['driver'] = 'mysql';
$dbDSN ['host'] = 'localhost';
$dbDSN ['login'] = 'root';
$dbDSN ['password'] = '';
$dbDSN ['database'] = 'sq_hiz';
FLEA::setAppInf ( 'dbDSN', $dbDSN );
//FLEA::setAppInf ( 'displayErrors', false );
//FLEA::setAppInf ( 'urlMode', URL_REWRITE );
FLEA::import ( APP );
FLEA::runMVC ();
?>