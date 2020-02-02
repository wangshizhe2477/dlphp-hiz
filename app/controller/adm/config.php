<?php
/**
 * 网站参数配置
 */
class controller_adm_config extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$cos = $this->dao->findAll ();
		$ins = array ();
		foreach ( $cos as $key => $value ) {
			$ins [$value ['name']] = $value ['value'];
		}
		$this->assign ( 'inis', $ins );
		$this->_view ();
	}
	function actionEdit() {
		foreach ( $_POST as $key => $value ) {
			$ob = $this->dao->find ( array ('name' => $key ) );
			$ob ['name'] = $key;
			$ob ['value'] = $value;
			$this->dao->save ( $ob );
		}
		js_alert ( '修改完毕', lastUrl () );
	}
}
?>
