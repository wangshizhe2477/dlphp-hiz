<?php
/**
 * 管理员管理
 */
class controller_adm_index extends controller_adm {
	
	function __construct() {
		parent::__construct();
		$this->defaultModel = false;
	}
	
	function actionIndex() {
		$this->display ( 'adm/common/layout.html' );
	}
	
	function actionWelcome() {
		$info ['rip'] = $_SERVER ["REMOTE_ADDR"];
		$info ['sip'] = $_SERVER ['SERVER_ADDR'];
		$info ['os'] = PHP_OS;
		$info ['service'] = $_SERVER ['SERVER_SOFTWARE'];
		$info ['php'] = PHP_VERSION;
		$info ['mysql'] = mysql_get_server_info ();
		$info ['upload'] = ini_get ( 'upload_max_filesize' );
		$this->assign ( 'info', $info );
		
		$this->_view ('welcome');
	}
	function actionTop() {
		$this->display ( 'adm/static/top.html' );
	}
	function actionLeft() {
		$this->display ( 'adm/static/left.html' );
	}
}
?>