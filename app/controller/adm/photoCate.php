<?php
class controller_adm_photoCate extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		$this->assign ( 'obs', $this->dao->findSuper () );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] )) {
			$ob = $this->dao->find ( $_REQUEST ['id'] );
			if ($ob != NULL)
				$this->assign ( 'ob', $ob );
		}
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
			$ob ['name'] = $_POST ['name'];
			$ob ['pid'] = empty ( $_POST ['pid'] ) ? 0 : $_POST ['pid'];
			cScript ( $this->_url (), $this->dao->save ( $ob ), '编辑' );
		}
	}
	function actionDel() {
		$this->delete();
	}
	function actionSort() {
		$this->sort ();
	}
}
?>