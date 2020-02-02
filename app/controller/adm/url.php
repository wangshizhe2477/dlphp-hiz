<?php
class controller_adm_url extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->assign ( 'uc', m ( 'urlCate' )->find ( $_REQUEST ['uc_id'] ) );
	}
	
	function actionIndex() {
		$array = array ();
		$array ['uc_id'] = $_REQUEST ['uc_id'];
		$this->_pager ( $this->dao, $array, 'sort_order, id desc' );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (empty ( $_POST ['name'] ) || strlen ( $_POST ['name'] ) > 40)
			js_alert ( '名称不能为空，并且不能超过40字符', lastUrl());
		else {
			if (! empty ( $_POST ['id'] ))
				$ob = $this->dao->find ( $_POST ['id'] );
			$ob ['uc_id'] = $_REQUEST ['uc_id'];
			$ob ['name'] = h ( $_POST ['name'] );
			$ob ['url'] = h ( $_POST ['url'] );
			cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
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