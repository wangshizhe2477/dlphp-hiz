<?php
class controller_adm_message extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		$this->_pager($this->dao, NULL, 'createtime desc');
		$this->_view ();
	}
	function actionToRe() {
		$me = $this->dao->find ( $_REQUEST ['id'] );
		if ($me != NULL) {
			$this->assign ( 'ob', $me );
			$this->_view ();
		}
	}
	function actionRe() {
		$me = $this->dao->find ( $_REQUEST ['id'] );
		if ($me != null) {
			$me ['reother'] = $_POST ['reother'];
			cScript ( $this->_url ( 'toRe', array ('id' => $_REQUEST ['id'] ) ), $this->dao->update ( $me ), '回复' );
		}
	}
	function actionX(){
		$this->x();
	}
	
	function actionDel() {
		$this->delete();
	}
}
?>