<?php
class controller_adm_urlP extends controller_adm {
	
	function __construct() {
		parent::__construct ();
	}
	function actionIndex() {
		$this->_pager ( $this->dao, null, 'sort_order' );
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
		if (! empty ( $_POST ['id'] ))
			$ob = $this->dao->find ( $_POST ['id'] );
		$ob ['photo'] = upload_photo ( $ob ['photo'] );
		$ob ['url'] = h ( $_POST ['url'] );
		$ob ['name'] = h ( $_POST ['name'] );
		cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
	}
	function actionDel() {
		$this->delete ();
	}
	function actionSort() {
		$this->sort ();
	}
}
?>