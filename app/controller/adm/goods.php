<?php
class controller_adm_goods extends controller_adm {

	function __construct() {
		parent::__construct ();
		$this->assign ( 'gcs', m ( 'goodsCate' )->findSuper () );
	}
	
	function actionIndex() {
		$array = array ();
		if (! empty ( $_REQUEST ['gc_idsea'] ))
			$array ['gc_id'] = $_REQUEST ['gc_idsea'];
		$this->_pager ( $this->dao, $array, 'createtime desc' );
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
		$ob ['gc_id'] = $_POST ['gc_id'];
		$ob ['name'] = h ( $_POST ['name'] );
		$ob ['photo'] = upload_photo ( $ob ['photo'] );
		$ob ['model'] = h ( $_POST ['model'] );
		$ob ['price'] = h ( $_POST ['price'] );
		$ob ['other'] = clear_js ( $_POST ['other'] );
		cScript ( $_POST ['lastUrl'], $this->dao->save ( $ob ), '编辑' );
	}
	function actionDel() {
		$this->delete();
	}
	function actionSort() {
		$this->sort ();
	}
	function actionUp() {
		$this->logic ();
	}
	function actionIlock() {
		$this->logic ();
	}
	function actionNew() {
		$this->logic ();
	}
	function actionHot() {
		$this->logic ();
	}
}
?>