<?php
class controller_adm_goodsCate extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		$this->assign ( 'obs', $this->dao->findSuper () );
		$this->_view ();
	}
	function actionToEdit() {
		$this->assign ( 'obs', $this->dao->findSuper () );
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['name'] ))
			js_alert ( '名称不能为空', lastUrl () );
		elseif (! empty ( $_REQUEST ['id'] ) && $_REQUEST ['id'] == $_POST ['pid'])
			js_alert ( '父类不能选择自己', lastUrl () );
		else {
			if (! empty ( $_REQUEST ['id'] ))
				$ob = $this->dao->find ( ( int ) $_REQUEST ['id'] );
			$ob ['name'] = h($_POST ['name']);
			$ob ['pid'] = $_POST ['pid'];
			cScript ( $this->_url (), $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete();
	}
}
?>