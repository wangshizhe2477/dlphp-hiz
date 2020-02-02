<?php
class controller_adm_order extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->_pager($this->dao, null, 'createtime desc');
		$this->_view ();
	}
	function actionX() {
		$this->assign('ob', $this->order->find ( $_REQUEST ['id'] ));
		$this->_view ();
	}
}
?>