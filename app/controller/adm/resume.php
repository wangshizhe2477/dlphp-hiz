<?php
class controller_adm_resume extends controller_adm{
	
	function __construct() {
		parent::__construct();
	}
	function actionIndex() {
		$this->_pager($this->dao, null, 'createtime desc');
		$this->_view ();
	}
	function actionX(){
		$this->assign('re', $this->dao->find((int)$_GET['id']));
		$this->_view ();
	}
	
	function actionDel() {
		$this->delete();
	}
}
?>
