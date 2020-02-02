<?php
class controller_adm_example extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->assign ( 'ec', m ( 'exampleCate' )->find ( $_REQUEST ['ec_id'] ) );
	}
	
	function actionIndex() {
		$this->_pager ( $this->dao, array ('ec_id' => $_REQUEST ['ec_id'] ), 'createtime desc' );
		$this->_view ();
	}
	function actionToEdit() {
		if (! empty ( $_REQUEST ['id'] ))
			$this->assign ( 'ob', $this->dao->find ( $_REQUEST ['id'] ) );
		$this->_view ();
	}
	function actionEdit() {
		if (! empty ( $_POST ['id'] ))
			$ob = $this->dao->find ( $_POST ['id'] );
		$ob ['photo'] = upload_photo ( $ob ['photo'] );
		$ob ['ec_id'] = h ( $_REQUEST ['ec_id'] );
		$ob ['name'] = h ( $_POST ['name'] );
		$ob ['other'] = clear_js ( $_POST ['other'] );
		cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
	}
	function actionDel() {
		$this->delete ();
	}
	//----------AJAX----------
	function actionSort() {
		$this->sort ();
	}
	function actionUp() {
		$this->logic ();
	}
}
?>