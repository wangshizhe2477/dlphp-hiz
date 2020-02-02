<?php
class controller_adm_photoPhoto extends controller_adm {
	
	function __construct() {
		parent::__construct ();
		$this->ph_id = $_REQUEST ['ph_id'];
		$this->assign ( 'ph_id', $this->ph_id );
		$this->assign ( 'ph', m ( 'photo' )->find ( $this->ph_id ) );
	}
	
	function actionIndex() {
		$para = array ();
		$para ['ph_id'] = $this->ph_id;
		$this->_pager ( $this->dao, $para, 'createtime desc' );
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
		$ob ['ph_id'] = $this->ph_id;
		$ob ['photo'] = upload_photo ( $ob ['photo'] );
		$ob ['name'] = h ( $_POST ['name'] );
		$this->dao->save($ob);
		js_alert('编辑成功', $_POST ['lastUrl']);
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
