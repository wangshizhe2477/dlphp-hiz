<?php
class controller_adm_infoCate extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	
	function actionIndex() {
		$this->assign ( 'obs', $this->dao->findAll () );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] )) {
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		}
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['name'] ))
			js_alert ( '名称不能为空', lastUrl () );
		else {
			if (! empty ( $_REQUEST ['id'] ))
				$ob = $this->dao->find ( ( int ) $_REQUEST ['id'] );
			$ob ['name'] = h($_POST ['name']);
			cScript ( $this->_url (), $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete();
	}
	//----------AJAX----------
	function actionSort() {
		$this->sort ();
	}
}
?>
